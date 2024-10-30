@extends('layout.sidenav-layout')
@section('content')
    @include('components.store.store-create')
    @include('components.store.store-list')
    @include('components.store.store-delete')
    @include('components.store.store-update')
@endsection