@extends('layouts.app')
@section('title')
Create a New Trip
@endsection

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Create a New Trip
    %form{ 'action' => route('trips.store'), 'method' => 'POST' }
      @include('trips._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('trips.index')}
            Cancel
@endsection
