<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\TopicRequest;
use App\Models\Good;
use App\Models\Topic;
use App\Transformers\TopicTransformer;
use Illuminate\Http\Request;


class TopicController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Topic $topic, Request $request)
    {
        $type = $request->type;
        $order = 'created_at';
        $sort = 'DESC';
        switch ($type)
        {
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

    public function store(TopicRequest $request, Topic $topic)
    {
        $params = array_keys($request->rules());
        $topic->fill($request->only($params));
        $topic->user_id = $this->user()->id;
        $topic->save();

        return $this->response->item($topic, new TopicTransformer)->setStatusCode(200);
    }

    public function show(Topic $topic, Good $good)
    {
        $topic->updateViewCount();
        $give_good = false;
        $collect = false;
        if ($this->user())
        {
            /**@var $user_good \App\Models\Good * */
            $user_good = $good->getGood($this->user()->id, $topic->id);
            $user_good == true && !$user_good->trashed() ? $give_good = true : $give_good = false;
        }
        return $this->response->item($topic, new TopicTransformer)->setStatusCode(200)->setMeta([
            'give_good' => $give_good,
            'collect' => $collect
        ]);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return $this->response->item($topic, new TopicTransformer)->setStatusCode(201);
    }
}
