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
          @can('delete', $picture)
          %a.btn.btn-danger.text-white{"title"=>'Delete Picture', "data-toggle"=>"modal", "data-target"=>"#deletePicture"}
            Delete
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
        %form#deleteForm{'action' => route('pictures.destroy', ['trip' => $trip, 'highlight' => $highlight, 'picture' => $picture]), 'method' => 'POST'}
          {{ csrf_field() }}
          %input{ "name" => "_method", "type" => "hidden", "value" => "DELETE" }
          %button.btn.btn-secondary{ 'type' => 'button', 'data-dismiss' => 'modal'}
            Cancel
          %button.btn.btn-danger
            Delete
@endsection
