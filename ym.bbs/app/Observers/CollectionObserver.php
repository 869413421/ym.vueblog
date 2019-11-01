<?php

namespace App\Observers;

use App\Models\Collection;

class CollectionObserver
{
    public function created(Collection $collection)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $collection->topic;
        $topic->updateCollectionCount();
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
