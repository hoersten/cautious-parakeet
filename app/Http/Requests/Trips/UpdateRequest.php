<?php
namespace App\Http\Requests\Trips;

use App\Trip;
use Illuminate\Http\Request;

class UpdateRequest extends StoreRequest {

  public function update() {
    $this->model = $this->trip();
    $this->model->update(Request::input());
    $this->updateAttendees();
    return $this->model->save();
  }

  protected function trip() {
    return request()->trip;
  }
}