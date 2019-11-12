<?php

namespace App\Models;


class Action extends BaseModel
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function createAction($user_id, $model, $action_str, $model_id)
    {
        $action = new self();
        $action->user_id = $user_id;
        $action->model = $model;
        $action->action = $action_str;
        $action->model_id = $model_id;
        $action->save();
    }
}
