<?php

namespace App\Transformers;

use App\Models\Reply;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    public $availableIncludes = ['user', 'replyuser'];

    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id,
            'content' => $reply->content,
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $reply->created_at)->diffForHumans(),
            'user_id' => $reply->user_id,
            'user_name' => $reply->user_name,
            'user_avatar' => $reply->user_avatar,
            'reply_user_id' => $reply->reply_user_id,
            'reply_user_name' => $reply->reply_user_name,
        ];
    }

}