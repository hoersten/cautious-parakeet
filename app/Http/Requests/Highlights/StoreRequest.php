<?php

namespace App\Http\Requests\Highlights;

use App\Attendee;
use App\Highlight;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest {

  protected $model;

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function authorize() {
    return auth()->check();
  }

  public function rules() {
    return [
      'name' => 'required',
      'lat' => 'nullable|numeric',
      'lon' => 'nullable|numeric',
      'start_date' => 'required|date',
      'end_date' => 'required|date|after_or_equal:start_date',
    ];
  }

  public function model() {
    return $this->model;
  }

  public function store(Trip $trip) {
    $this->model = new Highlight($this->getInput());
    if ($trip->highlights()->save($this->model)) {
      $this->updateAttendees();
      return true;
    }
    return false;
  }

  protected function getGeoPoints() {
    $input = Request::input();
    $address = join(',', [$input['road'], $input['road2'], $input['city'], $input['state'], $input['zip'], $input['country']]);
    return app('geocoder')->geocode($address)->get()[0]->getCoordinates();
  }

  protected function updateAttendees() {
    $this->model->attendees()->sync(Request::input('attendees'));
  }

  protected function getInput() {
    $input = Request::input();
    if (empty($input['lat']) || empty($input['lon'])) {
      $coords = $this->getGeoPoints();
      $input['lat'] = $coords->getLatitude();
      $input['lon'] = $coords->getLongitude();
    }
    return $input;
  }
}
