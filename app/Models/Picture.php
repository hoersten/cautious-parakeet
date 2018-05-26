<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {
  /**
   * Global scope to order by create_date by default
   */
  protected static function boot() {
    parent::boot();
    static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
      $builder->orderBy('date_taken', 'asc');
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
    'highlight_id', 'url', 'lat', 'lon', 'date_taken', 'caption',
  ];

  public function highlight() {
    return $this->belongsTo(Highlight::class);
  }
}
