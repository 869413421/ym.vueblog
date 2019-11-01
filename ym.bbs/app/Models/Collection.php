<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends BaseModel
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

    public function getCollection($user_id, $topic_id)
    {
        return $this->getFirstWithTrashed(['user_id' => $user_id, 'topic_id' => $topic_id]);
    }

    public function createCollection($user_id, $topic_id)
    {
        $collection = new self();
        $collection->user_id = $user_id;
        $collection->topic_id = $topic_id;
        $collection->save();
    }
}
