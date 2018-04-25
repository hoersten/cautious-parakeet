@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      {{ $trip->name }}
.row
  .col
    %div.trip-map
      MAP
    %div.trip-description
      {{ $trip->description }}
.row
  .col.attendees
    %h2 Attendees
    %ul
      @forelse($trip->attendees as $attendee)
      %li
        {{ $attendee->first_name }} {{ $attendee->last_name }}
      @endforeach
  .col.highlights
    %h2 Highlights
    %ul.highlights
      @foreach($trip->highlights as $highlight)
      %li
        {{ $highlight->name }}
      @endforeach
.row
  .col
    %a.btn.btn-primary{ 'href' => route('trips.index')}
      Back to trips
    - if ($trip->user_id == Auth::id())
      %a.btn.btn-secondary{ 'href' => route('trips.edit', $trip)}
        Edit
      @include('trips._delete_button')
@endsection