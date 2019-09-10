<?php

namespace App\Listeners\TopicListen;

use App\Events\TopicEvent\TopicCreated;
use App\Jobs\TranslateJob;

class TopicEventSubscriber
{
    /**
     * 监听到模型的时间并且做相应的处理
     * @param $event
     */
    public function onTopicCreated($event)
    {
        $topic = $event->topic;
        $topic->excerpt = cutString($topic->content);
        $topic->save();
        //分发任务交给baidu_translate这个队列
        if (!$topic->slug) {
            TranslateJob::dispatch($topic);
            \Log::error('分发成功');
        }
    }

    public function subscribe($events)
    {
        //为事件绑定监听者
        $events->listen(
            TopicCreated::class,
            TopicEventSubscriber::class . '@onTopicCreated'
        );
    }

}
