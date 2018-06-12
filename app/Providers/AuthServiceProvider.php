<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    \App\User::class => \App\Policies\UserPolicy::class,
    \App\Trip::class => \App\Policies\TripPolicy::class,
    \App\Highlight::class => \App\Policies\HighlightPolicy::class,
    \App\Picture::class => \App\Policies\PicturePolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot() {
      $this->registerPolicies();
  }
}
