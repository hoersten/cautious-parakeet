<?php

namespace App\Http\Controllers;

use App\Highlight;
use App\Picture;
use App\Trip;
use App\Http\Requests\Pictures\StoreRequest;
use App\Http\Requests\Pictures\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller {

  /**
   * Show the form for creating a new resource.
   *
   * @param  \App\Trip      $trip
   * @param  \App\Highlight $highlight
   * @return \Illuminate\Http\Response
   */
  public function create(Trip $trip, Highlight $highlight) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name ],
                     [ 'url' => route('highlights.show', [ 'trip' => $trip, 'highlight' => $highlight]), 'text' => $highlight->name ],
                     [ 'url' => route('pictures.create', [ 'trip' => $trip, 'highlight' => $highlight]), 'text' => 'Upload Picture', 'active' => true]
                   ];
    $picture = new Picture;
    return view('pictures.create', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\Pictures\StoreRequest  $request
   * @param  \App\Trip $trip
   * @param  \App\Highlight $highlight
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request, Trip $trip, Highlight $highlight) {
    $request->store($highlight);
    return redirect(route('highlights.show', ['trip' => $trip, 'highlight' => $highlight]));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Trip      $trip
   * @param  \App\Highlight $highlight
   * @param  \App\Picture   $picture
   * @return \Illuminate\Http\Response
   */
  public function show(Trip $trip, Highlight $highlight, Picture $picture) {
    return \Image::make(Storage::path($picture->url))->response();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Trip      $trip
   * @param  \App\Highlight $highlight
   * @param  \App\Picture   $picture
   * @return \Illuminate\Http\Response
   */
  public function edit(Trip $trip, Highlight $highlight, Picture $picture) {
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('trips.index'), 'text' => 'Trips' ],
                     [ 'url' => route('trips.show', $trip), 'text' => $trip->name ],
                     [ 'url' => route('highlights.show', [ 'trip' => $trip, 'highlight' => $highlight]), 'text' => $highlight->name ],
                     [ 'url' => route('pictures.edit', [ 'trip' => $trip, 'highlight' => $highlight, 'picture' => $picture]), 'text' => 'Edit Picture', 'active' => true]
                   ];
    return view('pictures.edit', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\Pictures\UpdateRequest  $request
   * @param  \App\Trip $trip
   * @param  \App\Highlight $highlight
   * @param  \App\Picture  $picture
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Trip $trip, Highlight $highlight, Picture $picture) {
    $request->update($highlight);
    return redirect(route('highlights.show', ['trip' => $trip, 'highlight' => $highlight]));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Picture  $picture
   * @return \Illuminate\Http\Response
   */
  public function destroy(Trip $trip, Highlight $highlight, Picture $picture) {
    if (auth()->check()) {
      $picture->delete();
      return redirect(route('highlights.show', ['trip' => $trip, 'highlight' => $highlight]));
    }
  }
}
