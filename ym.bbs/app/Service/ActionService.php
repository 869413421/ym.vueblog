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
use App\Models\Reply;
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
                break;
            case Reply::class:
                return $this->getReplyInfoToAction($action);
                break;
        }
    }

    public function getReplyInfoToAction(Action $action)
    {
        $info=Reply::query()
            ->join('comments','replies.comment_id','comments.id')
            ->join('users','comments.user_id','users.id')
            ->join('topics','comments.topic_id','topics.id')
            ->where('replies.id',$action->model_id)
            ->select('users.name', 'users.avatar', 'comments.content as comment_content','replies.content','topics.title', 'topics.excerpt')
            ->first()
            ->toArray();

        $info['type'] = 'reply';

        return $info;
    }

    public function getCollectionIofoToAction(Action $action)
    {
        $info = Collection::query()
            ->join('topics', 'collections.topic_id', 'topics.id')
            ->join('users', 'topics.user_id', 'users.id')
            ->where('collections.id', $action->model_id)
            ->select('users.name', 'users.avatar', 'topics.title', 'topics.excerpt')
            ->first()
            ->toArray();

        $info['type'] = 'collect';

        return $info;
    }

    public function getCommentIofoToAction(Action $action)
    {
        $info = Comment::query()
            ->join('topics', 'comments.topic_id', 'topics.id')
            ->join('users', 'topics.user_id', 'users.id')
            ->where('comments.id', $action->model_id)
            ->select('users.name', 'users.avatar', 'topics.title', 'topics.excerpt','comments.content')
            ->first()
            ->toArray();

        $info['type'] = 'comment';

        return $info;
    }

    public function getTopicInfoToAction(Action $action)
    {
        $info = Topic::query()
            ->where('topics.id', $action->model_id)
            ->join('users', 'topics.user_id', 'users.id')
            ->select('users.name', 'users.avatar', 'topics.title', 'topics.excerpt')
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
            ->select('users.name', 'users.avatar', 'topics.title', 'topics.excerpt')
            ->first()
            ->toArray();

        $info['type'] = 'good';

        return $info;
    }
}