<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'avatar', 'city', 'company', 'title', 'nickname', 'introduction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'remember_token', 'email', 'email_verified_at'
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 生成token
     *
     * @param $phone
     * @param $password
     * @return false|string
     */
    public function getToken($phone, $password)
    {
        $credentials['phone'] = $phone;
        $credentials['password'] = $password;
        return JWTAuth::attempt($credentials);
    }

    /**
     * @return Topic
     */
    public function Topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function Action()
    {
        return $this->hasMany(Action::class);
    }

    /**
     * 统计用户文章总数
     */
    public function updateTopicCount()
    {
        $this->topic_count = $this->Topic()->count();
        $this->save();
    }

    /**
     * 统计用户所有点赞数
     */
    public function updateGoodCount()
    {
        $this->good_count = $this->Topic()->sum('good_count');
        $this->save();
    }

    /**
     * 更新用户最后活跃时间
     */
    public function updateLastActiveDate()
    {
        $this->last_active_time = now();
        $this->save();
    }

    /**
     * 返回用户是否用户当前模型的操作权限
     * @param $model
     * @return bool
     */
    public function isAuthorOf($model)
    {
        return $this->id === $model->user_id;
    }
}
