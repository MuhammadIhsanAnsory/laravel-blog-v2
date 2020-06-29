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

      Route::get('post/aktif', 'Admin\PostController@index')->name('post.index');
      Route::get('post/tidak-aktif', 'Admin\PostController@postNonactive')->name('post.postNonactive');
      Route::get('post/buat-post', 'Admin\PostController@create')->name('post.create');
      Route::post('post/tambah', 'Admin\PostController@store')->name('post.store');
      Route::get('post/edit-post/{id}/{slug}', 'Admin\PostController@edit')->name('post.edit');
      Route::get('post/publish-post/{id}/{slug}', 'Admin\PostController@publish')->name('post.publish');
      Route::get('post/detail-post/{id}/{slug}', 'Admin\PostController@show')->name('post.show');
      Route::put('post/update-post/{id}/{slug}', 'Admin\PostController@update')->name('post.update');
      Route::delete('post/hapus-post/{id}/{slug}', 'Admin\PostController@destroy')->name('post.destroy');
    });
  });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/home', 'HomeController@index')->name('home');
