@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Edit a Picture
.row
  .col
    %img.img-fluid{ 'src' => route('pictures.show', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture ])}
  .col
    %form{ 'action' => route('pictures.update', [ 'trip' => $trip, 'highlight' => $highlight, 'picture' => $picture, 'enctype' => 'multipart/form-data' ]), 'method' => 'POST' }
      %input{ "name" => "_method", "type" => "hidden", "value" => "PUT" }
      @include('pictures._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('highlights.show', ['trip' => $trip, 'highlight' => $highlight])}
            Cancel
@endsection
