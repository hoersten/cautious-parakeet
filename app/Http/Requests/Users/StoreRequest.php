<?php

namespace App\Http\Requests\Users;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

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
      'name' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255',
                   \Illuminate\Validation\Rule::unique('users')->ignore(\Auth::user()->id),
                 ],
      'password' => 'nullable|string|min:6|confirmed',
    ];
  }

  public function model() {
    return $this->model;
  }

  public function store(User $user) {
  }
}
