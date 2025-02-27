<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Gate::define('isSuperAdmin', function ($user) {
      return $user->role == 'SuperAdmin';
    });

    Gate::define('isAdmin', function ($user) {
      return $user->role == 'admin';
    });

    Gate::define('isWriter', function ($user) {
      return $user->role == 'writer';
    });

    Gate::define('isUser', function ($user) {
      return $user->role == 'user';
    });
  }
}
