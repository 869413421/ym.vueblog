<?php

namespace App\Transformers;

use App\Models\Comment;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    public $availableIncludes = ['reply', 'user'];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'content' => $comment->content,
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans()
        ];
    }

    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer());
    }

    public function includeReply(Comment $comment)
    {
        return $this->collection($comment->reply, new ReplyTransformer());
    }
}