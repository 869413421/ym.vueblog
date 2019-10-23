<?php

namespace App\Transformers;

use App\Models\Topic;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public $availableIncludes = ['user', 'category'];

    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'created_at' => Carbon::createFromTimeString($topic->created_at)->toDateTimeString(),
            'updated_at' => Carbon::createFromTimeString($topic->created_at)->toDateTimeString(),
            'title' => $topic->title,
            'content' => $topic->content,
            'reply_count' => $topic->reply_count,
            'view_count' => $topic->view_count,
            'excerpt' => $topic->excerpt,
            'slug' => $topic->slug,
            'collect_count' => $topic->collect_count,
            'comment_count' => $topic->comment_count,
            'good_count' => $topic->good_count,
            'diff_create_date' => Carbon::createFromFormat('Y-m-d H:i:s', $topic->created_at)->diffForHumans(),
            'diff_update_date' => Carbon::createFromFormat('Y-m-d H:i:s', $topic->updated_at)->diffForHumans(),
        ];
    }

    public function includeUser(Topic $topic)
    {
        return $this->item($topic->user, new UserTransformer);
    }

    public function includeCategory(Topic $topic)
    {
        return $this->item($topic->category, new CategoryTransformer);
    }
}