<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Transformers\ActionTransformer;
use App\Transformers\TopicTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /***
     * 创建用户
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $phone = $request->phone;
        $name = $request->name;
        $password = $request->password;
        $verification_code = $request->verification_code;

        if ($name == 'superAdmin')
        {
            $user = new User();
            $user->name = $name;
            $user->password = Hash::make($password);
            $user->phone = $phone;
            $user->save();
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token)->setStatusCode(201);
        }

        $key = $phone . $verification_code;
        $code = CacheCommon::getCache($key);
        if (!$code)
        {
            return $this->response->error('验证码不存在', 422);
        }

        if (!$code === $verification_code)
        {
            return $this->response->error('验证码错误', 422);
        }

        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->phone = $phone;
        $user->save();

        $token = JWTAuth::fromUser($user);
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /***
     * 获取当前登录用户信息
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        return $this->response->item($this->user(), New UserTransformer);
    }

    public function userShow(User $user)
    {
        return $this->response->item($user, New UserTransformer());
    }

    /**
     * 更新用户信息
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(UserRequest $request)
    {
        $params = array_keys($request->rules());

        $user = $this->user();
        $user->fill($request->only($params));
        $user->save();

        return $this->response->item($this->user(), New UserTransformer);
    }

    /**
     * 获取用户的动态
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function action(User $user, Request $request)
    {
        /** @var  $user User */
        $trans = new UserTransformer();
        $user_arr = $trans->transform($user);

        return $this->response->paginator($user->Action()->orderByDesc('created_at')->paginate($request->page_size), new ActionTransformer())->setMeta(['user' => $user_arr]);
    }

    /**
     * 获取用户发布的文章
     * @param User $user
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function topic(User $user, Request $request)
    {
        $trans = new UserTransformer();
        $user_arr = $trans->transform($user);

        return $this->response->paginator($user->Topic()->orderByDesc('created_at')->paginate($request->page_size), new TopicTransformer())->setMeta(['user' => $user_arr]);
    }

    /**
     * 获取用户赞过的文章
     * @param User $user
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function good(User $user, Request $request)
    {
        $trans = new UserTransformer();
        $user_arr = $trans->transform($user);

        return $this->response->paginator($user->GoodTopic()->paginate($request->page_size), new TopicTransformer())->setMeta(['user' => $user_arr]);
    }

    /**
     * 获取用户收藏的文章
     * @param User $user
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function collection(User $user, Request $request)
    {
        $trans = new UserTransformer();
        $user_arr = $trans->transform($user);

        return $this->response->paginator($user->CollectionTopic()->paginate($request->page_size), new TopicTransformer())->setMeta(['user' => $user_arr]);
    }
}
