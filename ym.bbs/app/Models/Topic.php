<?php

namespace App\Models;

use App\Events\TopicEvent\TopicCreated;
use App\Events\TopicEvent\TopicRetrieved;
use App\Events\TopicEvent\TopicSaving;
use Illuminate\Support\Facades\DB;

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

    public function Good()
    {
        return $this->hasMany(Good::class);
    }

    public function Collection()
    {
        return $this->hasMany(Collection::class);
    }

    public function updateGoodCount()
    {
        DB::table('topics')->where('id', $this->id)->update(['good_count' => $this->Good()->count()]);
    }

    public function updateCollectionCount()
    {
        DB::table('topics')->where('id', $this->id)->update(['collect_count' => $this->Collection()->count()]);
    }

    //重写BASEMODEL的方法
    public function getPageData(array $where = [], $pageSize = 20, $order = 'created_at', $sort = 'DESC', $append = [])
    {
        return $this->newQuery()->where($where)->orderBy($order, $sort)->paginate($pageSize)->appends($append);
    }

    public function updateCommentCount()
    {
        DB::table('topics')->where('id', $this->id)->update(['comment_count' => $this->Comment()->count()]);
    }

    public function updateViewCount()
    {
        DB::table('topics')->where('id', $this->id)->increment('view_count');
    }
}
