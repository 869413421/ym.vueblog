<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
class TopicTableSeeder extends Seeder
{
    public function run()
    {
        $user_ids=User::all()->pluck('id')->toArray();

        $category_ids=Category::all()->pluck('id')->toArray();

        $fake=app(Faker\Generator::class);

        $topics = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(function ($topic, $index)
            use($user_ids,$category_ids,$fake)
            {
                $topic->user_id=$fake->randomElement($user_ids);
            });

        Topic::insert($topics->toArray());
    }

}

