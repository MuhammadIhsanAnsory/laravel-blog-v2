<?php

use App\category_post;
use Illuminate\Database\Seeder;

class CategoryPostTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(category_post::class, 20)->create();
  }
}
