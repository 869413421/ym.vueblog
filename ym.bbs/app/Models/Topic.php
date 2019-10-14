<?php

namespace App\Models;

use App\Events\TopicEvent\TopicCreated;
use App\Events\TopicEvent\TopicRetrieved;
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
        'saving' => TopicSaving::class,
//        'retrieved' => TopicRetrieved::class,
    ];

    //模型关联
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    //获取模型的属性要转小写如Category应该$this->category
    public function Category()
    {
        return $this->belongsTo(Category::class, 'categorie_id', 'id');
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }

    //重写BASEMODEL的方法
    public function getPageData(array $where = [], $pageSize = 20, $order = 'created_at', $sort = 'DESC', $append = [])
    {
        return $this->newQuery()->where($where)->orderBy($order, $sort)->paginate($pageSize)->appends($append);
    }

    public function updateCommentCount()
    {
        $this->comment_count = $this->Comment()->count();
        $this->save();
    }

    public function updateViewCount()
    {
        $this->view_count = $this->view_count + 1;
        $this->save();
    }
}
