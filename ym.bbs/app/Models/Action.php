<?php

namespace App\Models;

class Action extends BaseModel
{
    public function Model()
    {
        return $this->belongsTo($this->model);
    }

    public function createAction($user_id, $model,$action_str)
    {
        $action = new self();
        $action->user_id = $user_id;
        $action->model = $model;
        $action->action = $action_str;
        $action->save();
    }
}
