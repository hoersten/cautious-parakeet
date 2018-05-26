@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Edit a Trip
    %form{ 'action' => route('trips.update', $trip), 'method' => 'POST' }
      %input{ "name" => "_method", "type" => "hidden", "value" => "PUT" }
      @include('trips._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('trips.show', ['trip' => $trip])}
            Cancel
@endsection
