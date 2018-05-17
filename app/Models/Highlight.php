<?php

namespace App;

class Highlight extends Model {
  /**
   * Global scope to order by start_date by default
   */
  protected static function boot() {
    parent::boot();
    static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
      $builder->orderBy('start_date', 'asc');
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'trip_id', 'name', 'road', 'road2', 'city', 'state', 'zip', 'country', 'lat', 'lon', 'start_date', 'end_date', 'description',
  ];

  public function trip() {
    return $this->belongsTo(Trip::class);
  }

  public function attendees() {
    return $this->belongsToMany(Attendee::class, 'highlights_attendees');
  }

  public function pictures() {
    return $this->hasMany(Picture::class);
  }
}
