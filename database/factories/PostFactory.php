<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
  $title = $faker->jobTitle;
  return [
    'user_id' => $faker->randomElement([1, 2, 3, 4]),
    'title' => $title,
    'content' => $faker->paragraph,
    'image' => 'test.jpg',
    'slug' => Str::slug($title),
    'status' => $faker->boolean,
  ];
});
