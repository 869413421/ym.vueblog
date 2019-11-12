<?php
/**
 * Created by PhpStorm.
 * User: 、、、、、、、、、、、
 * Date: 2019/7/3
 * Time: 23:09
 */

namespace App\Service;


use App\Models\Action;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Good;
use App\Models\Topic;

class ActionService
{
    public function getActionModelInfo(Action $action)
    {
        switch ($action->model) {
            case Topic::class:
                return $this->getTopicInfoToAction($action);
                break;
            case Good::class:
                return $this->getGoodInfoToAction($action);
                break;
            case Comment::class:
                return $this->getCommentIofoToAction($action);
                break;
            case Collection::class:
                return $this->getCollectionIofoToAction($action);
        }
    }

    public function getCollectionIofoToAction($action)
    {
        $info['type'] = 'collect';

        return $info;
    }

    public function getCommentIofoToAction(Action $action)
    {

        $info['type'] = 'comment';

        return $info;
    }

    public function getTopicInfoToAction(Action $action)
    {
        $info = Topic::query()
            ->where('topics.id', $action->model_id)
            ->join('users', 'topics.user_id', 'users.id')
            ->select('users.name','users.avatar','topics.title','topics.excerpt')
            ->first()
            ->toArray();

        $info['type'] = 'topic';

        return $info;
    }

    public function getGoodInfoToAction(Action $action)
    {
        $info = Good::query()
            ->where('goods.id', $action->model_id)
            ->join('topics', 'topic_id', 'topics.id')
            ->join('users', 'topics.user_id', 'users.id')
            ->select('users.name','users.avatar','topics.title','topics.excerpt')
            ->first()
            ->toArray();

        $info['type'] = 'good';

        return $info;
    }
}