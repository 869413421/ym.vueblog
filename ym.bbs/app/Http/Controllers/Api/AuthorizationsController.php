<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use Auth;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\AuthorizationRequest;


class AuthorizationsController extends BaseController
{
    public function store(AuthorizationRequest $request)
    {
        $phone = $request->phone;
        $password = $request->password;

        $credentials['phone'] = $phone;
        $credentials['password'] = $password;

        if (!$token = Auth::guard('api')->attempt($credentials))
        {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }
        $user = $this->user();
        return $this->respondWithToken($user, $token)->setStatusCode(200);
    }

}
