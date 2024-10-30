@extends('layout.sidenav-layout')
@section('content')
    @include('components.supplier.supplier-create')
    @include('components.supplier.supplier-list')
    @include('components.supplier.supplier-delete')
    @include('components.supplier.supplier-update')
@endsection