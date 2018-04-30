@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      {{ $trip->name }} - {{ $highlight->name }}
    %h2
      {{ $highlight->start_date }}{{ (($highlight->start_date === $highlight->end_date) ? '' : ' - ' . $highlight->end_date) }}
.row
  .col
    %div.highlight-map#map{ 'style' => 'width:100%;height:500px;' }
    %div.highlight-description
      {{ $highlight->description }}
.row
  .col.attendees
    %h2 Attendees
    %ul
      @forelse($highlight->attendees as $attendee)
      %li
        {{ $attendee->first_name }} {{ $attendee->last_name }}
      @endforeach
.row
  .col
    %a.btn.btn-primary{ 'href' => route('trips.show', $trip)}
      Back to trip
    - if ($trip->user_id == Auth::id())
      %a.btn.btn-secondary{ 'href' => route('highlights.edit', ['trip' => $trip, 'highlight' => $highlight])}
        Edit
      @include('highlights._delete_button')
@endsection

@section('footer_js')
%script{ 'src' => "https://maps.googleapis.com/maps/api/js?key=" . env('GOOGLE_MAP_API', '') . "&callback=initMap", 'async' => true, 'defer' => true }
:javascript
  var map;
  function initMap() {
    var latLng = new google.maps.LatLng({{ $highlight->lat }}, {{ $highlight->lon }});
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: latLng,
      mapTypeId: 'terrain'
    });
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      label: "{{ $highlight->name }}"
    });
  }
@endsection