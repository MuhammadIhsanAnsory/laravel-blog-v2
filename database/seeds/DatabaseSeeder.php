<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $this->call(UserTableSeeder::class);
    // $this->call(CategoryTableSeeder::class);
    // $this->call(TagTableSeeder::class);
    $this->call(PostTableSeeder::class);
    // $this->call(PostTagTableSeeder::class);
    // $this->call(CategoryPostTableSeeder::class);
  }
}
