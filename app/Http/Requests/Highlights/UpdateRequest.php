<?php
namespace App\Http\Requests\Highlights;

use App\Trip;
use Illuminate\Http\Request;

class UpdateRequest extends StoreRequest {

  public function update() {
    $this->model = $this->highlight();
    $this->model->update(Request::input());
    $this->updateAttendees();
    return $this->model->save();
  }

  protected function highlight() {
    return request()->highlight;
  }
}