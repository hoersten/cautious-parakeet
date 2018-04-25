@extends('layouts.app')

@section('content')
.row
  .col
    %h1
      Login
    %form{ 'action' => route('login'), 'method' => 'POST' }
      {{ csrf_field() }}
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
        .col
          .form-check
            %input#remember.form-check-input{'type' => 'checkbox', 'name' => 'remember' }
            %label.form-check-label{'for' => 'remember'}
              Remember Me
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Login
      .form-group.row
        .col
          %a.btn.btn-link{ 'href' => route('password.request') }
            Forgot Your Password?
@endsection
