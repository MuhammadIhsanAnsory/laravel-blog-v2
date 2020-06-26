<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function superAdmin(User $user)
  {
    return $user->role == 'SuperAdmin';
  }
}
