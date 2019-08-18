<?php

namespace App\Models;

class Topic extends BaseModel
{
    protected $fillable = [
        'title', 'body',
        'excerpt', 'slug',
        'category_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getPageData(array $where = [], $pageSize = 20, $order = 'create_at', $sort = 'DESC', $append = [])
    {
        return $this->newQuery()->with('user')->where($where)->orderBy($order, $sort)->paginate($pageSize)->appends($append);
    }
}
