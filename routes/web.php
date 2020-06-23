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

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();

Route::group(['middleware' => 'adminwriter'], function () {
  Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
      Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

      Route::resource('user', 'Admin\UserController');
    });
  });
});

Route::get('/home', 'HomeController@index')->name('home');
