<?php

namespace App\Policies;

use App\User;
use App\Highlight;
use Illuminate\Auth\Access\HandlesAuthorization;

class HighlightPolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the list of highlights.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function index(User $user) {
    return \Auth::check();
  }

 /**
   * Determine whether the user can view the highlight.
   *
   * @param  \App\User  $user
   * @param  \App\Highlight  $highlight
   * @return mixed
   */
  public function view(User $user, Highlight $highlight) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can create highlights.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can update the highlight.
   *
   * @param  \App\User  $user
   * @param  \App\Highlight  $highlight
   * @return mixed
   */
  public function update(User $user, Highlight $highlight) {
    return $highlight->trip->user_id === $user->id;
  }

  /**
   * Determine whether the user can delete the highlight.
   *
   * @param  \App\User  $user
   * @param  \App\Highlight  $highlight
   * @return mixed
   */
  public function delete(User $user, Highlight $highlight) {
    return $highlight->trip->user_id === $user->id;
  }
}
