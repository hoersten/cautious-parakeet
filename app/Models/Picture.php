<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'datetime_taken' => 'datetime',
  ];

  /**
   * Global scope to order by create_date by default
   */
  protected static function boot() {
    parent::boot();
    static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
      $builder->orderBy('datetime_taken', 'asc');
    });
    // Cleanup files
    static::deleted(function(Picture $picture) {
      \Storage::cloud()->delete($picture->url);
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'highlight_id', 'url', 'lat', 'lon', 'datetime_taken', 'caption',
  ];

  public function highlight() {
    return $this->belongsTo(Highlight::class);
  }
}
