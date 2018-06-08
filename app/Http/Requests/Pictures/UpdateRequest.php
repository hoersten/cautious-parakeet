<?php
namespace App\Http\Requests\Pictures;

use Illuminate\Http\Request;
use App\Highlight;
use Carbon\Carbon;

class UpdateRequest extends StoreRequest {

  public function update(Highlight $highlight) {
    $this->model = $this->picture();
    $input = Request::input();
    $input['datetime_taken'] = Carbon::createFromFormat("Y-m-d\\TH:i", $input['datetime_taken']);
    return $this->model->update($input);
  }

  protected function picture() {
    return request()->picture;
  }
}