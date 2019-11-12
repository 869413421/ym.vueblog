<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Transformers\ActionTransformer;
use Illuminate\Http\Request;

class ActionController extends BaseController
{
    public function index()
    {
        /** @var  $user User */
        $user = $this->user;
        return $this->response->paginator($user->Action()->paginate(10), new ActionTransformer());
    }
}
