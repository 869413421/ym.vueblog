<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Collection;
use App\Models\Topic;

class CollectionController extends BaseController
{
    public function store(Topic $topic, Collection $collection)
    {
        /**@var $user_good \App\Models\Collection* */
        $user_collection = $collection->getCollection($this->user()->id, $topic->id);

        if ($user_collection)
        {
            if ($user_collection->trashed())
            {
                $user_collection->restore();
            }
            return $this->response->created();
        }
        else
        {
            $collection->createCollection($this->user()->id, $topic->id);
        }

        return $this->response->created();
    }

    public function destory(Topic $topic, Collection $collection)
    {
        /**@var $user_good \App\Models\Collection * */
        $user_collection = $collection->getCollection($this->user()->id, $topic->id);
        $this->authorize('delete', $user_collection);
        $user_collection->delete();

        return $this->response->created();
    }
}
