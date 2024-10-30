@extends('layout.sidenav-layout')
@section('content')
    @include('components.storeCategorie.store-category-create')
    @include('components.storeCategorie.store-category-list')
    @include('components.storeCategorie.store-category-delete')
    @include('components.storeCategorie.store-category-update')
@endsection