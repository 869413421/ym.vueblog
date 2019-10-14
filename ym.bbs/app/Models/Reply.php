<?php

namespace App\Models;

use App\Events\TopicEvent\TopicCreated;
use App\Events\TopicEvent\TopicRetrieved;
use App\Events\TopicEvent\TopicSaving;

class Reply extends BaseModel
{
    protected $fillable = [
        'content'
    ];

    //模型关联
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function ReplyUser()
    {
        return $this->belongsTo(User::class, 'reply_user_id', 'id');
    }

}
