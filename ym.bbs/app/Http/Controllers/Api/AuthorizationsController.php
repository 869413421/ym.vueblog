<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Auth;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthorizationsController extends BaseController
{
    public function store(AuthorizationRequest $request)
    {
        $phone = $request->phone;
        $password = $request->password;

        $credentials['phone'] = $phone;
        $credentials['password'] = $password;

        //根据账号密码生成一个token
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

}
