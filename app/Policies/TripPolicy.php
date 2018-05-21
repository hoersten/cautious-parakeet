<?php

namespace App\Policies;

use App\User;
use App\Trip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the list of trips.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function index(User $user) {
    return true;
  }

  /**
   * Determine whether the user can view the trip.
   *
   * @param  \App\User  $user
   * @param  \App\Trip  $trip
   * @return mixed
   */
  public function view(User $user, Trip $trip) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can create trips.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user) {
    return \Auth::check();
  }

  /**
   * Determine whether the user can update the trip.
   *
   * @param  \App\User  $user
   * @param  \App\Trip  $trip
   * @return mixed
   */
  public function update(User $user, Trip $trip) {
    return $trip->user_id === $user->id;
  }

  /**
   * Determine whether the user can delete the trip.
   *
   * @param  \App\User  $user
   * @param  \App\Trip  $trip
   * @return mixed
   */
  public function delete(User $user, Trip $trip) {
    return $trip->user_id === $user->id;
  }
}
