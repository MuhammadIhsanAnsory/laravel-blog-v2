<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name' => 'Admin',
      'email' => 'admin@test.com',
      'password' => bcrypt('123123123'),
      'role' => 'SuperAdmin',
    ]);

    User::create([
      'name' => 'Reza Fitriani',
      'email' => 'reza@gmail.com',
      'password' => bcrypt('123123123'),
      'role' => 'admin',
    ]);

    User::create([
      'name' => 'Fahrizal Nugraha',
      'email' => 'fahri@gmail.com',
      'password' => bcrypt('123123123'),
      'role' => 'writer',
    ]);
    User::create([
      'name' => 'Ridwan',
      'email' => 'ridwan@gmail.com',
      'password' => bcrypt('123123123'),
      'role' => 'user',
    ]);
  }
}
