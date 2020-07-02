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


Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');

Auth::routes();

Route::name('front.')->group(function () {
  Route::get('/', 'User\FrontController@index')->name('index');
  Route::get('home', 'User\FrontController@index')->name('home');
  Route::get('berita/detail/{id}/{slug}', 'User\FrontController@show')->name('show');
  Route::get('berita/terbaru', 'User\FrontController@latest')->name('latest');
  Route::get('tag/{slug}', 'User\FrontController@tag_list')->name('tag');
  Route::get('kategori/{slug}', 'User\FrontController@category_list')->name('category');
});


















Route::group(['middleware' => 'adminwriter'], function () {
  Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
      Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

      Route::get('user/nonaktif', 'Admin\UserController@trash')->name('user.trash');
      Route::get('user/aktifkan/{id}', 'Admin\UserController@restore')->name('user.restore');
      Route::get('user/hapus/{id}', 'Admin\UserController@forceDelete')->name('user.forceDelete');
      Route::resource('user', 'Admin\UserController');

      Route::get('profil', 'Admin\UserController@profile')->name('profile');
      Route::get('profil/ubah', 'Admin\UserController@changeProfile')->name('profile.change');
      Route::put('profil/update', 'Admin\UserController@profileUpdate')->name('profile.update');

      Route::get('post/aktif', 'Admin\PostController@index')->name('post.index');
      Route::get('post/tidak-aktif', 'Admin\PostController@postNonactive')->name('post.postNonactive');
      Route::get('post/buat-post', 'Admin\PostController@create')->name('post.create');
      Route::post('post/tambah', 'Admin\PostController@store')->name('post.store');
      Route::get('post/edit/{id}/{slug}', 'Admin\PostController@edit')->name('post.edit');
      Route::get('post/publish/{id}/{slug}', 'Admin\PostController@publish')->name('post.publish');
      Route::get('post/unpublish/{id}/{slug}', 'Admin\PostController@unpublish')->name('post.unpublish');
      Route::get('post/detail/{id}/{slug}', 'Admin\PostController@show')->name('post.show');
      Route::put('post/update/{id}/{slug}', 'Admin\PostController@update')->name('post.update');
      Route::delete('post/hapus/{id}/{slug}', 'Admin\PostController@destroy')->name('post.destroy');
      Route::get('post/sampah', 'Admin\PostController@trash')->name('post.trash');
      Route::get('post/restore/{id}/{slug}', 'Admin\PostController@restore')->name('post.restore');
      Route::get('post/hapus-permanen/{id}/{slug}', 'Admin\PostController@forceDelete')->name('post.forceDelete');

      Route::get('kategori', 'Admin\CategoryController@index')->name('category.index');
      Route::post('kategori/tambah', 'Admin\CategoryController@store')->name('category.store');
      Route::delete('kategori/hapus/{id}/{slug}', 'Admin\CategoryController@destroy')->name('category.destroy');
      Route::put('kategori/update/{id}/{slug}', 'Admin\CategoryController@update')->name('category.update');
      Route::get('kategori/sampah', 'Admin\CategoryController@trash')->name('category.trash');
      Route::get('kategori/restore/{id}/{slug}', 'Admin\CategoryController@restore')->name('category.restore');
      Route::get('kategori/hapus-permanen/{id}/{slug}', 'Admin\CategoryController@forceDelete')->name('category.forceDelete');


      Route::get('tag', 'Admin\TagController@index')->name('tag.index');
      Route::post('tag/tambah', 'Admin\TagController@store')->name('tag.store');
      Route::delete('tag/hapus/{id}/{slug}', 'Admin\TagController@destroy')->name('tag.destroy');
      Route::put('tag/update/{id}/{slug}', 'Admin\TagController@update')->name('tag.update');
      Route::get('tag/sampah', 'Admin\TagController@trash')->name('tag.trash');
      Route::get('tag/restore/{id}/{slug}', 'Admin\TagController@restore')->name('tag.restore');
      Route::get('tag/hapus-permanen/{id}/{slug}', 'Admin\TagController@forceDelete')->name('tag.forceDelete');
    });
  });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});
