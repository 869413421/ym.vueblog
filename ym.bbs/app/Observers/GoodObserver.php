<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\Good;

class GoodObserver
{
    public function created(Good $good)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $good->topic;
        $topic->updateGoodCount();
        $topic->user->updateGoodCount();

        $action = new Action();
        $action->createAction($good->user_id, Good::class,'create',$good->id);
    }

    public function updated(Good $good)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $good->topic;
        $topic->updateGoodCount();
        $topic->user->updateGoodCount();
    }

    public function deleted(Good $good)
    {
        /**@var $topic \App\Models\Topic * */
        $topic = $good->topic;
        $topic->updateGoodCount();
        $topic->user->updateGoodCount();
    }
}
