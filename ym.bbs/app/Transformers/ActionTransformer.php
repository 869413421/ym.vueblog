<?php

namespace App\Transformers;

use App\Models\Action;
use App\Service\ActionService;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ActionTransformer extends TransformerAbstract
{
    public function transform(Action $action)
    {
        $action_service = new ActionService();
        return [
            'id' => $action->id,
            'created_at' => Carbon::createFromTimeString($action->created_at)->toDateTimeString(),
            'updated_at' => Carbon::createFromTimeString($action->created_at)->toDateTimeString(),
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $action->created_at)->diffForHumans(),
            'model' => $action_service->getActionModelInfo($action)
        ];
    }
}