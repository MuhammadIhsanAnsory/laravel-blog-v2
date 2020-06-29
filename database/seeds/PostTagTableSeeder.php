<?php

use Illuminate\Database\Seeder;
use App\post_tag;

class PostTagTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(post_tag::class, 20)->create();
  }
}
