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
  .col-sm-6
    %div.highlight-map#map{ 'style' => 'width:100%;height:250px;' }
  .col-sm-6
    %h2
      Pictures
    .row
      @foreach($highlight->pictures as $picture)
      .col-3
        @can('update', $highlight)
        .edit-tools.text-right
          %a.mr-1{'href' => route('pictures.edit', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture]) }><
            %i.fas.fa-edit
          @can('delete', $highlight)
          %a.mr-1{'href' => '#', 'data-toggle' => 'modal', 'data-target' => '#deletePicture', 'data-picture' => route('pictures.destroy', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture ]) }><
            %i.fas.fa-trash
          @endcan
        @endcan
        %a{'id' => 'pic-' . $picture->id, 'href' => route('pictures.show', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture ]), 'data-toggle' => 'lightbox', 'data-gallery' => 'highlights', 'data-footer' => $picture->caption,  'data-type' => 'image' }
          %img.img-fluid{'src' => route('pictures.show', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture ])}
          %p=$picture->caption
      @endforeach
    @can('update', $highlight)
    %a.btn.btn-primary{ 'href' => route('pictures.create', ['trip' => $trip, 'highlight' => $highlight])}
      Add Pictures
    @endcan
.row
  .col
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
    @can('update', $highlight)
    %a.btn.btn-secondary{ 'href' => route('highlights.edit', ['trip' => $trip, 'highlight' => $highlight])}
      Edit
    @can('delete', $highlight)
    @include('highlights._delete_button')
    @endcan
    @endcan


#deletePicture.modal.fade{'tabindex' => '-1', 'role' => 'dialog', 'aria-labelledby' => 'deleteTitle', 'aria-hidden' => 'true'}
  .modal-dialog{ 'role' => 'document'}
    .modal-content
      .modal-header
        %h5.modal-title#deleteTitle
          Delete Picture
        %button.close{'type' => 'button', 'data-dismiss' => 'modal', 'aria-label' => 'Close'}
          %span{ 'aria-hidden' => 'true'}
            &times;
      .modal-body
        %p
          Are you sure you want to delete this picture?
      .modal-footer
        %form#deleteForm{'method' => 'POST'}
          {{ csrf_field() }}
          %input{ "name" => "_method", "type" => "hidden", "value" => "DELETE" }
          %button.btn.btn-secondary{ 'type' => 'button', 'data-dismiss' => 'modal'}
            Cancel
          %button.btn.btn-danger
            Delete
@endsection

@section('footer_js')
%link{ 'href' => 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css', 'rel' => 'stylesheet' }
%script{ 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js', 'async' => true, 'defer' => true }
%script{ 'src' => "https://maps.googleapis.com/maps/api/js?key=" . env('GOOGLE_MAP_API', '') . "&callback=initMap", 'async' => true, 'defer' => true }
:javascript
  var map;
  var markers = [
    @foreach($highlight->pictures as $picture)
    [{{$picture->lat}},{{$picture->lon}},"",{{$picture->id}}],
    @endforeach
  ];
  function initMap() {
    var latLng = new google.maps.LatLng({{ $highlight->lat }}, {{ $highlight->lon }});
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: latLng,
      mapTypeId: 'satellite'
    });
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      label: "{{ $highlight->name }}"
    });
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(latLng);
    for (i = 0; i < markers.length; ++i) {
      var latLng = new google.maps.LatLng(markers[i][0],markers[i][1]);
      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        label: markers[i][2],
        icon: {
          path: "M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z",
          fillColor: 'white',
          fillOpacity: 0.8,
          scale: 1,
          strokeColor: 'black',
          strokeWeight: 1
        }
      });
      marker.data_id = markers[i][3];
      marker.addListener('click', function() {
        $('#pic-' + this.data_id).ekkoLightbox();
      });
      latlngbounds.extend(latLng);
    }
    map.fitBounds(latlngbounds);
  }
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({ alwaysShowClose: true });
  });

  $('#deletePicture').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var url = button.data('picture'); // Extract info from data-* attributes
    var form = $('#deleteForm');
    form.attr("action", url); 
  })
@endsection