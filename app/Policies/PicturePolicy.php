<?php

namespace App\Policies;

use App\User;
use App\Picture;
use Illuminate\Auth\Access\HandlesAuthorization;

class PicturePolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the list of pictures.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function index(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can view the picture.
   *
   * @param  \App\User  $user
   * @param  \App\Picture  $picture
   * @return mixed
   */
  public function view(User $user, Picture $picture) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can create pictures.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can update the picture.
   *
   * @param  \App\User  $user
   * @param  \App\Picture  $picture
   * @return mixed
   */
  public function update(User $user, Picture $picture) {
    return $picture->user_id === $user->id;
  }

  /**
   * Determine whether the user can delete the picture.
   *
   * @param  \App\User  $user
   * @param  \App\Picture  $picture
   * @return mixed
   */
  public function delete(User $user, Picture $picture) {
    return $picture->user_id === $user->id;
  }
}
