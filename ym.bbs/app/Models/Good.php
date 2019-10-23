<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends BaseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getGood($user_id, $topic_id)
    {
        return $this->getFirst(['topic_id' => $user_id, 'topic_id' => $topic_id]);
    }

    public function createGood($user_id, $topic_id)
    {
        $good = new self();
        $good->user_id = $user_id;
        $good->topic_id = $topic_id;
        $good->save();
    }
}
