@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      My Trips
    %ul
      @foreach($trips as $trip)
      %li
        %a{'href' => route('trips.show', ['trip' => $trip])}
          {{ $trip->name }}
      @endforeach
.row
  .col
    %a.btn.btn-primary{ 'href' => route('trips.create')}
      New Trip
@endsection