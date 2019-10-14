<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Topic;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Topic $topic, Comment $comment)
    {
        return $this->response->paginator($comment->getPageData(['topic_id' => $topic->id]), new CommentTransformer)->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $topic = Topic::find($request->id);
        if (!$topic) {
            return $this->response->error('TOPIC NOT FOUN', 422);
        }

        $comment = new Comment();
        $comment->topic_id = $topic->id;
        $comment->content = $request['content'];
        $comment->user_id = $this->user()->id;
        $comment->save();

        return $this->response->created();
    }
}
