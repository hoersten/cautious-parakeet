@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Edit a Highlight
    %form{ 'action' => route('highlights.update', [ 'trip' => $trip, 'highlight' => $highlight ]), 'method' => 'POST' }
      %input{ "name" => "_method", "type" => "hidden", "value" => "PUT" }
      @include('highlights._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('highlights.show', ['trip' => $trip, 'highlight' => $highlight])}
            Cancel
@endsection
