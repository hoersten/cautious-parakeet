@extends('layouts.app')

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      Create a New Highlight
    %form{ 'action' => route('highlights.store', $trip), 'method' => 'POST' }
      @include('highlights._form')
      .form-group.row
        .col
          %button.btn.btn-primary{ 'type' => 'submit' }
            Save
          %a.btn.btn-secondary{ 'href' => route('trips.show', $trip)}
            Cancel
@endsection
