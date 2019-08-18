<?php

namespace App\Transformers;

use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'created_at' => $topic->created_at,
            'updated_at' => $topic->updated_at,
            'title' => $topic->title,
            'content' => $topic->content,
            'user_id' => $topic->user_id,
            'categorie_id' => $topic->categorie_id,
            'reply_count' => $topic->reply_count,
            'view_count' => $topic->view_count,
            'excerpt' => $topic->excerpt,
            'slug' => $topic->slug,
            'collect_count' => $topic->collect_count,
            'user_name' => $topic->user->name,
        ];
    }
}