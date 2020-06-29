<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\category_post;
use App\Post;
use Faker\Generator as Faker;

$factory->define(category_post::class, function (Faker $faker) {
  return [
    'category_id' => factory(Category::class),
    'post_id' => factory(Post::class)
  ];
});
