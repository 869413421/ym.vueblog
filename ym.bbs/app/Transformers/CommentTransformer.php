<?php

namespace App\Transformers;

use App\Models\Comment;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'content' => $comment->content,
            'avatar' => $comment->user->avatar,
            'name' => $comment->user->name,
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans(),
        ];
    }
}