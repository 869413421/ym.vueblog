<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->Topic->updateCommentCount();
        $action = new Action();
        $action->createAction($comment->user_id, Comment::class,'create');
    }
}
