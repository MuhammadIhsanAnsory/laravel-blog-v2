<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
  $tag_name = $faker->word;
  return [
    'name' => $tag_name,
    'slug' => Str::slug($tag_name)
  ];
});
