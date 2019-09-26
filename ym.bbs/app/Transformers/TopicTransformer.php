<?php

namespace App\Transformers;

use App\Models\Topic;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'created_at' => Carbon::createFromTimeString($topic->created_at)->toDateTimeString(),
            'updated_at' => Carbon::createFromTimeString($topic->created_at)->toDateTimeString(),
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
            'avatar' => $topic->user->avatar,
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $topic->created_at)->diffForHumans(),
            'diff_update_date' => Carbon::createFromFormat('Y-m-d H:i:s', $topic->updated_at)->diffForHumans(),
            'categorie_name' => $topic->Category->title
        ];
    }
}