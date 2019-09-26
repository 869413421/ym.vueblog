<?php

namespace App\Models;

class Comment extends BaseModel
{
    protected $fillable = [
        'content',
    ];

    //模型关联
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //重写BASEMODEL的方法
    public function getPageData(array $where = [], $pageSize = 20, $order = 'created_at', $sort = 'DESC', $append = [])
    {
        return $this->newQuery()->with(['user','topic'])->where($where)->orderBy($order, $sort)->paginate($pageSize)->appends($append);
    }
}
