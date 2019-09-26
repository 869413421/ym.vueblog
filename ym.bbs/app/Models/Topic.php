<?php

namespace App\Models;

use App\Events\TopicEvent\TopicCreated;
use App\Events\TopicEvent\TopicSaving;

class Topic extends BaseModel
{
    protected $fillable = [
        'title', 'content',
        'excerpt', 'slug',
        'categorie_id'
    ];

    /**
     * 分发时间到对应的事件类中
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TopicCreated::class,
        'saving' => TopicSaving::class
    ];

    //模型关联
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class,'categorie_id','id');
    }

    //重写BASEMODEL的方法
    public function getPageData(array $where = [], $pageSize = 20, $order = 'created_at', $sort = 'DESC', $append = [])
    {
        return $this->newQuery()->with('user')->where($where)->orderBy($order, $sort)->paginate($pageSize)->appends($append);
    }
}
