<?php

namespace App\Listeners\TopicListen;

use App\Events\TopicEvent\TopicCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        \Log::error(cutString($topic->content . '111111'));
        $topic->save();
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
