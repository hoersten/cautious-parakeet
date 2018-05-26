<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model {
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name', 'last_name',
  ];
}
