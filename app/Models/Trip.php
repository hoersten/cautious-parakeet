<?php

namespace App;
use App\Attendee;
use App\Highlight;

class Trip extends Model {
  /**
   * Global scope to order by start_date by default
   */
  protected static function boot() {
    parent::boot();
    static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
      $builder->orderBy('start_date', 'asc');
    });
    // Cleanup files
    static::deleted(function(Trip $trip) {
      \Storage::deleteDirectory('pictures/' . $trip->id);
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'name', 'type', 'description', 'start_date', 'end_date',
  ];

  public function attendees() {
    return $this->belongsToMany(Attendee::class, 'trips_attendees');
  }

  public function highlights() {
    return $this->hasMany(Highlight::class);
  }
}

class TripTypes {
  public const CAMPING = 1;
  public const FAMILY = 2;
  public const HOTEL = 3;
  public const DAY = 4;

  static public function types() {
    return [
      TripTypes::CAMPING => 'Camping',
      TripTypes::FAMILY => 'Family/Friends',
      TripTypes::HOTEL => 'Hotel/Condo',
      TripTypes::DAY => 'Day',
    ];
  }
}