<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title'=>$faker->text(40),
        'description'=>$faker->text(250),
        'body'=>$faker->paragraph(20),
        'status'=>rand(0,1),
        'user_id'=>rand(1,2),
    ];
});
