@extends('layouts.app')

@section('content')
.row
  .col
    %h1
      Welcome to Our Travel Photos
-if (Auth::check())
  .row
    .col
      %h2
        Newest Trips
      %ul
        @foreach($trips as $trip)
        %li
          %a{'href' => route('trips.show', ['trip' => $trip])}
            {{ $trip->name }}
          ( @include('shared.date_range', ['obj' => $trip]))
        @endforeach

  .row
    .col
      %a.btn.btn-primary{'href' => route('trips.index')}
        View all the trips
@endsection