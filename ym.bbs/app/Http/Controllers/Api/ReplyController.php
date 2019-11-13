<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\ReplyRequest;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\ReplyTransformer;

class ReplyController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function store(ReplyRequest $request, Topic $topic, Comment $comment, Action $action)
    {
        $reply = new Reply();
        $reply->user_id = $this->user()->id;
        $reply->user_name = $this->user()->name;
        $reply->user_avatar = $this->user()->avatar;
        $reply->comment_id = $comment->id;
        $reply->content = $request['content'];

        $reply_user = User::find($request->reply_user_id);
        $reply->reply_user_id = $request->reply_user_id;
        $reply->reply_user_name = $reply_user->name;
        $reply->save();

        $action->createAction($this->user()->id,Reply::class,'create',$reply->id);
        return $this->response->item($reply, new ReplyTransformer())->setStatusCode(201);
    }
}
