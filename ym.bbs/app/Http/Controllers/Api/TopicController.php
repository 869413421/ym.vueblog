<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Topic;
use App\Transformers\TopicTransformer;
use Illuminate\Http\Request;


class TopicController extends BaseController
{
    public function index(Topic $topic, Request $request)
    {
        $type = $request->type;
        $order = 'created_at';
        $sort = 'DESC';
        switch ($type) {
            case'Active':
                $order = 'view_count';
                break;
            case'Hot':
                $order = 'reply_count';
                break;
            case'Essence':
                $order = 'reply_count';
                break;
            case'New':
                $order = 'created_at';
                break;
            case'Zero':
                $order = 'reply_count';
                $sort = 'ASC';
                break;
        }
        return $this->response->paginator($topic->getPageData([], 10, $order, $sort, $request->all()), new TopicTransformer)->setStatusCode(200);
    }
}
