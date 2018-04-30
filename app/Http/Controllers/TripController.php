<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\Trip;
use App\TripTypes;
use App\Http\Requests\Trips\StoreRequest;
use App\Http\Requests\Trips\UpdateRequest;
use Illuminate\Http\Request;

class TripController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ], 
                     [ 'url' => route('trips.index'), 'text' => 'Trips', 'active' => true ],
                   ];
    $trips = Trip::all();
    return view('trips.index', ['trips' => $trips, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ], 
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.create'), 'text' => 'New Trip', 'active' => true ],
                   ];
    $trip = new Trip;
    $trip->color = $this->generateRGB();
    $types = TripTypes::types();
    $attendees = Attendee::all();
    return view('trips.create', ['trip' => $trip, 'types' => $types, 'attendees' => $attendees, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\Trips\StoreRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request) {
    $request->store();
    return redirect(route('trips.show', ['trip' => $request->model]));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Trip  $trip
   * @return \Illuminate\Http\Response
   */
  public function show(Trip $trip) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ], 
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name, 'active' => true ],
                   ];
    $types = TripTypes::types();
    return view('trips.show', ['trip' => $trip, 'types' => $types, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Trip  $trip
   * @return \Illuminate\Http\Response
   */
  public function edit(Trip $trip) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ], 
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.edit', $trip), 'text' => 'Edit Trip', 'active' => true ],
                   ];
    $types = TripTypes::types();
    $attendees = Attendee::all();
    return view('trips.edit', ['trip' => $trip, 'types' => $types, 'attendees' => $attendees, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\Trips\UpdateRequest  $request
   * @param  \App\Trip  $trip
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Trip $trip) {
    $request->update();
    return redirect(route('trips.show', ['trip' => $request->model]));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Trip  $trip
   * @return \Illuminate\Http\Response
   */
  public function destroy(Trip $trip) {
    Trip::destroy($trip->id);
    return redirect(route('trips.index'))->withFlash('Trip deleted.');
  }

  private function generateRGB() {
    $hash = md5('color' . rand(0,100));
    return '#' . hexdec(substr($hash, 0, 5));
  }
}
