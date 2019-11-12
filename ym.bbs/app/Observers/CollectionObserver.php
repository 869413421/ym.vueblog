<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\Collection;
use App\Models\Topic;

class CollectionObserver
{
    public function created(Collection $collection)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $collection->topic;
        $topic->updateCollectionCount();

        $action = new Action();
        $action->createAction($topic->user_id, Collection::class,'create',$collection->id);
    }

    public function updated(Collection $collection)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $collection->topic;
        $topic->updateCollectionCount();
    }

    public function deleted(Collection $collection)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $collection->topic;
        $topic->updateCollectionCount();
    }
}
