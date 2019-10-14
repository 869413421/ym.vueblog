<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'city' => $user->city,
            'company' => $user->company,
            'title' => $user->title,
            'nickname' => $user->nickname,
            'introduction' => $user->introduction,
        ];
    }
}