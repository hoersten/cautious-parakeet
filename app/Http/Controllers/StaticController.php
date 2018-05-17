<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class StaticController extends Controller {
  public function home() {
    $trips = Trip::limit(10)->orderBy('created_at', 'desc');
    return view('static.home', ['trips' => $trips->get()]);
  }
}
