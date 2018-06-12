<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the list of users.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function index(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can view the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user2
   * @return mixed
   */
  public function view(User $user, User $user2) {
    return $user->id === $user2->id;
  }

  /**
   * Determine whether the user can create users.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can update the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user2
   * @return mixed
   */
  public function update(User $user, User $user2) {
    return $user->id === $user2->id;
  }

  /**
   * Determine whether the user can delete the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user2
   * @return mixed
   */
  public function delete(User $user, User $user2) {
    return $user->id === $user2->id;
  }
}
