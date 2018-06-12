@extends('layouts.app')
@section('title')
Edit {{ $user->name }}
@endsection

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Edit Your Account
    %form.form-horizontal{'method' => 'POST', 'action' => route('users.update')}
      %input{ "name" => "_method", "type" => "hidden", "value" => "PUT" }
      {{ csrf_field() }}
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'name'}
            Name
        .col-sm-10
          %input#name.form-control{'type' => 'text', 'placeholder' => 'Enter name', 'required' => true, 'name' => 'name', 'value' => old('name', $user->name) }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'email'}
            Email
        .col-sm-10
          %input#email.form-control{'type' => 'email', 'placeholder' => 'Enter email', 'required' => true, 'name' => 'email', 'value' => old('email', $user->email) }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'password'}
            New Password
        .col-sm-10
          %input#password.form-control{'type' => 'password', 'placeholder' => 'Leave empty to not change password', 'name' => 'password' }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'password_confirmation'}
            Confirm Password
        .col-sm-10
          %input#password_confirmation.form-control{'type' => 'password', 'placeholder' => 'Confirm password if changing it', 'name' => 'password_confirmation' }
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Update
          %a.btn.btn-secondary{ 'href' => route('users.show') }
            Cancel
@endsection
