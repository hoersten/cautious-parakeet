<?php
namespace App\Http\Requests\Users;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class UpdateRequest extends StoreRequest {

  public function update() {
    $this->model = \Auth::user();
    $input = Request::input();
    if (empty($input['password'])) {
      unset($input['password']);
    } else {
      $input['password'] = bcrypt($input['password']);
    }
    return $this->model->update($input);
  }
}