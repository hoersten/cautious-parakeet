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
      'lat' => 'required|numeric',
      'lon' => 'required|numeric',
      'start_date' => 'required|date',
      'end_date' => 'required|date|after_or_equal:start_date',
    ];
  }

  public function model() {
    return $this->model;
  }

  public function store(Trip $trip) {
    $this->model = new Highlight(Request::input());
    if ($trip->highlights()->save($this->model)) {
      $this->updateAttendees();
      return true;
    }
    return false;
  }

  protected function updateAttendees() {
    $this->model->attendees()->sync(Request::input('attendees'));
  }
}
