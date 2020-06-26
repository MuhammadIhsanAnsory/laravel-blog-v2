<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');

Auth::routes();

Route::group(['middleware' => 'adminwriter'], function () {
  Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
      Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

      Route::get('user/nonaktif', 'Admin\UserController@trash')->name('user.trash');
      Route::get('user/aktifkan/{id}', 'Admin\UserController@restore')->name('user.restore');
      Route::get('user/hapus/{id}', 'Admin\UserController@forceDelete')->name('user.forceDelete');
      Route::resource('user', 'Admin\UserController');

      Route::get('post/{status}', 'Admin\PostController@index')->name('post.index');
      Route::get('post/buat-post', 'Admin\PostController@create')->name('post.create');
    });
  });
});

Route::get('/home', 'HomeController@index')->name('home');
