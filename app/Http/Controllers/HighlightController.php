<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\Highlight;
use App\Trip;
use App\Helpers\State;
use App\Helpers\Country;
use App\Http\Requests\Highlights\StoreRequest;
use App\Http\Requests\Highlights\UpdateRequest;
use Illuminate\Http\Request;

class HighlightController extends Controller {
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Trip $trip) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name ],
                     [ 'url' => route('highlights.create', $trip), 'text' => 'New Highlight', 'active' => true]
                   ];
    $highlight = new Highlight;
    $attendees = Attendee::all();
    $states = State::get();
    $countries = Country::get();
    return view('highlights.create', ['trip' => $trip, 'highlight' => $highlight, 'attendees' => $attendees, 'states' => $states, 'countries' => $countries, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\Highlights\StoreRequest  $request
   * @param  \App\Trip $trip
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request, Trip $trip) {
    $request->store($trip);
    return redirect(route('trips.show', ['trip' => $trip]));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Trip  $trip
   * @param  \App\Highlight  $highlight
   * @return \Illuminate\Http\Response
   */
  public function show(Trip $trip, Highlight $highlight) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name],
                     [ 'url' => route('highlights.show', [ 'trip' => $trip, 'highlight' => $highlight]), 'text' => $highlight->name, 'active' => true ],
                   ];
    return view('highlights.show', ['trip' => $trip, 'highlight' => $highlight, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Highlight  $highlight
   * @return \Illuminate\Http\Response
   */
  public function edit(Trip $trip, Highlight $highlight) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name ],
                     [ 'url' => route('highlights.edit', [ 'trip' => $trip, 'highlight' => $highlight]), 'text' => 'Edit Highlight', 'active' => true]
                   ];
    $attendees = Attendee::all();
    $states = State::get();
    $countries = Country::get();
    return view('highlights.edit', ['trip' => $trip, 'highlight' => $highlight, 'attendees' => $attendees, 'states' => $states, 'countries' => $countries, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\Highlights\UpdateRequest  $request
   * @param  \App\Trip  $trip
   * @param  \App\Highlight  $highlight
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Trip $trip, Highlight $highlight) {
    $request->update();
    return redirect(route('highlights.show', ['trip' => $trip, 'highlight' => $highlight]));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Trip  $trip
   * @param  \App\Highlight  $highlight
   * @return \Illuminate\Http\Response
   */
  public function destroy(Trip $trip, Highlight $highlight) {
    $highlight->delete();
    return redirect(route('trips.show', $trip))->withFlash('Highlight deleted.');
  }
}
