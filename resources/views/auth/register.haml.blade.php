@extends('layouts.app')

@section('content')
.row
  .col
    %h1 Register
    %form.form-horizontal{'method' => 'POST', 'action' => route('register')}
      {{ csrf_field() }}
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'name'}
            Name
        .col-sm-10
          %input#name.form-control{'type' => 'text', 'placeholder' => 'Enter name', 'required' => true, 'name' => 'name' }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'email'}
            Email
        .col-sm-10
          %input#email.form-control{'type' => 'email', 'placeholder' => 'Enter email', 'required' => true, 'name' => 'email' }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'password'}
            Password
        .col-sm-10
          %input#password.form-control{'type' => 'password', 'placeholder' => 'Enter password', 'required' => true, 'name' => 'password' }
      .form-group.row
        .col-sm-2
          %label.col-form-label.col-sm-2{'for' => 'password_confirmation'}
            Confirm Password
        .col-sm-10
          %input#password_confirmation.form-control{'type' => 'password', 'placeholder' => 'Confirm password', 'required' => true, 'name' => 'password_confirmation' }
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Register
@endsection
