@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      {{ $trip->name }}
    %strong
      @include('shared.date_range', [ 'obj' => $trip ])
.row
  .col
    %div.trip-map#map{'style' => 'width:100%;height:500px'}
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
        %a{ 'href' => route('highlights.show', ['trip' => $trip, 'highlight' => $highlight]) }
          {{ $highlight->name }}
        ( @include('shared.date_range', [ 'obj' => $highlight ]))

      @endforeach
    @can('update', $trip)
    %a.btn.btn-primary{ 'href' => route('highlights.create', $trip)}
      Add Highlight
    @endcan
.row
  .col
    %a.btn.btn-primary{ 'href' => route('trips.index')}
      Back to trips
    @can('update', $trip)
    %a.btn.btn-secondary{ 'href' => route('trips.edit', $trip)}
      Edit
    @can('delete', $trip)
    @include('trips._delete_button')
    @endcan
    @endcan
@endsection

@section('footer_js')
%script{ 'src' => "https://maps.googleapis.com/maps/api/js?key=" . env('GOOGLE_MAP_API', '') . "&callback=initMap", 'async' => true, 'defer' => true }
:javascript
  var markers = [
    @foreach($trip->highlights as $highlight)
    [{{$highlight->lat}},{{$highlight->lon}},"{{$highlight->name}}"],
    @endforeach
  ];
  var map;
  function initMap() {
    if (markers.length > 0) {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: new google.maps.LatLng(markers[0][0],markers[0][1]),
        mapTypeId: 'terrain'
      });
      var latlngbounds = new google.maps.LatLngBounds();
      for (i = 0; i < markers.length; ++i) {
        var latLng = new google.maps.LatLng(markers[i][0],markers[i][1]);
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
          label: markers[i][2]
        });
        latlngbounds.extend(latLng);
      }
      map.fitBounds(latlngbounds);
    }
  }
@endsection