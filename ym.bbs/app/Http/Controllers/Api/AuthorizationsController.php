<?php

namespace App\Http\Controllers\Api;

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

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
