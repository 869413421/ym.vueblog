<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Topic;
use App\Transformers\CommentTransformer;

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
}
