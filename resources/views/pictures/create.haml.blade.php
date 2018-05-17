@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Upload a New Picture
    %form{ 'action' => route('pictures.store', ['trip' => $trip, 'highlight' => $highlight]), 'method' => 'POST', 'enctype' => 'multipart/form-data' }
      .form-group.row
        .col
          %label.col-form-label{'for' => 'picture'}
            Picture(s)
          %input#picture.form-control{'type' => 'file', 'placeholder' => 'Select an image', 'name' => 'picture[]', 'multiple' => true, 'accept' => '.jpg, .jpeg, .png, .gif', 'required' => true }
      @include('pictures._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('highlights.show', ['trip' => $trip, 'highlight' => $highlight ] )}
            Cancel
@endsection
