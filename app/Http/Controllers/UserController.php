<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller {
  /**
   * Display the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function show() {
    $user = \Auth::user();
    $this->authorize('view', $user);
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('users.show', [ 'user' => $user]), 'text' => $user->name, 'active' => true ],
                   ];
    return view('users.show', ['user' => $user, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function edit() {
    $user = \Auth::user();
    $this->authorize('update', $user);
    $breadcrumbs = [ [ 'url' => route('home'), 'text' => 'Home' ],
                     [ 'url' => route('users.show', [ 'user' => $user]), 
                       'text' => 'Edit Account', 'active' => true ],
                   ];
    return view('users.edit', ['user' => $user, 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\Users\UpdateRequest  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request) {
    $user = \Auth::user();
    $this->authorize('update', $user);
    $request->update();
    return redirect(route('users.show'));
  }
}
