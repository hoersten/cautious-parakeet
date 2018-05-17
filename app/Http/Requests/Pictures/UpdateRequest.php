<?php
namespace App\Http\Requests\Pictures;

use Illuminate\Http\Request;
use App\Highlight;

class UpdateRequest extends StoreRequest {

  public function update(Highlight $highlight) {
    $this->model = $this->picture();
    $input = Request::input();
    return $this->model->update($input);
  }

  protected function picture() {
    return request()->picture;
  }
}