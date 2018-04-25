<?php

namespace App\Http\Requests\Trips;

use App\Attendee;
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
      'type' => 'required',
      'start_date' => 'required|date',
      'end_date' => 'required|date',
      'color' => 'required',
    ];
  }

  public function model() {
    return $this->model;
  }

  public function store() {
    $this->model = new Trip(Request::input());
    $this->model->user_id = auth()->id();
    if ($this->model->save()) {
      $this->updateAttendees();
    }
    return false;
  }

  protected function updateAttendees() {
    $this->model->attendees()->sync(Request::input('attendees'));
  }
}
