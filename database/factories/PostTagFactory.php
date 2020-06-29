<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\post_tag;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(post_tag::class, function (Faker $faker) {
  return [
    'post_id' => factory(Post::class),
    'tag_id' => factory(Tag::class)
  ];
});
