<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Good;
use App\Models\Topic;

class GoodController extends BaseController
{
    public function store(Topic $topic, Good $good)
    {
        /**@var $user_good \App\Models\Good* */
        $user_good = $good->getGood($this->user()->id, $topic->id);

        if ($user_good)
        {
            if ($user_good->trashed())
            {
                $user_good->restore();
            }
            return $this->response->created();
        }
        else
        {
            $good->createGood($this->user()->id, $topic->id);
        }

        return $this->response->created();
    }

    public function destory(Topic $topic, Good $good)
    {
        /**@var $user_good \App\Models\Good * */
        $user_good = $good->getGood($this->user()->id, $topic->id);

        $this->authorize('delete', $user_good);
        $user_good->delete();

        return $this->response->created();
    }
}
