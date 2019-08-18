<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Narbar;
use Faker\Generator as Faker;

$factory->define(Narbar::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
