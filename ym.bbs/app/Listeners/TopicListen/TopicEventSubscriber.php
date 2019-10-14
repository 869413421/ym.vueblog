<?php

namespace App\Listeners\TopicListen;

use App\Events\TopicEvent\TopicCreated;
use App\Events\TopicEvent\TopicRetrieved;
use App\Events\TopicEvent\TopicSaving;
use App\Jobs\TranslateJob;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;

class TopicEventSubscriber
{
    /**
     * 监听到模型的时间并且做相应的处理
     * @param $event
     */
    public function onTopicCreated($event)
    {
        $topic = $event->topic;
        $topic->excerpt = cutString($topic->content, 50) . '...';
        $topic->save();
        //分发任务交给baidu_translate这个队列
        if (!$topic->slug) {
            TranslateJob::dispatch($topic)->onConnection('baidu_translate')->onQueue('translate');
        }
    }

    public function onTopicSaving($event)
    {
        //清空配置不允许的标签，防止XSS攻击
        $topic = $event->topic;
        $topic->content = clean($topic->content, 'default');
        $topic->title = clean($topic->title, 'default');
    }

    public function onTopicRetrieved($event)
    {
        //增加访问阅读量
        DB::table('topics')->where('id', $event->topic->id)->increment('view_count');
    }

    public function subscribe($events)
    {
        //为事件绑定监听者
        $events->listen(
            TopicCreated::class,
            TopicEventSubscriber::class . '@onTopicCreated'
        );

        $events->listen(
            TopicSaving::class,
            TopicEventSubscriber::class . '@onTopicSaving'
        );

        $events->listen(
            TopicRetrieved::class,
            TopicEventSubscriber::class . '@onTopicRetrieved'
        );
    }

}
