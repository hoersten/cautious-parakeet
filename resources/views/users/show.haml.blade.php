@extends('layouts.app')
@section('title')
{{ $user->name }}
@endsection

@section('content')
@include('shared.breadcrumbs', [ 'breadcrumbs' => $breadcrumbs])
.row
  .col
    %h1
      {{ $user->name }}
    %p=$user->email
    @can('update', $user)
    %a.btn.btn-primary{ 'href' => route('users.edit')}
      Edit
    @endcan
    %a.btn.btn-secondary{ 'href' => route('home')}
      Cancel

@endsection