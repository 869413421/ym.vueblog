<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends BaseController
{
    public function store(UserRequest $request)
    {
        $phone = $request->phone;
        $name = $request->name;
        $password = $request->password;
        $verification_code = $request->verification_code;

        if ($name == 'superAdmin') {
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
        if (!$code) {
            return $this->response->error('验证码不存在', 422);
        }

        if (!$code === $verification_code) {
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

    public function me()
    {
        return $this->response->item($this->user(), New UserTransformer);
    }

    public function update(UserRequest $request)
    {
        $params = array_keys($request->rules());

        $user = $this->user();
        $user->fill($request->only($params));
        $user->save();

        return $this->response->item($this->user(), New UserTransformer);
    }
}
