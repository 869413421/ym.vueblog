<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    use Helpers;

    protected function respondWithToken($token)
    {
        return $this->response->array(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            ]);
    }
}
