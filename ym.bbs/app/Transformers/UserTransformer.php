<?php

namespace App\Transformers;

use App\Models\User;
use Carbon\Carbon;
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
            'created_at'=>Carbon::createFromTimeString($user->created_at)->toDateTimeString(),
            'regirster_date'=>Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->diffForHumans(),
            'city' => $user->city,
            'company' => $user->company,
            'title' => $user->title,
            'nickname' => $user->nickname,
            'introduction' => $user->introduction,
            'last_active_time' => $user->last_active_time,
            'good_count' => $user->good_count,
            'topic_count' => $user->topic_count,
            'fans_count' => $user->fans_count,
            'integral' => $user->integral,
        ];
    }
}