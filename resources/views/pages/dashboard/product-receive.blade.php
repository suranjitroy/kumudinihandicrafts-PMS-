@extends('layout.sidenav-layout')
@section('content')
    @include('components.productReceive.product-receive-create')
    @include('components.productReceive.product-receive-list')
    @include('components.productReceive.product-receive-delete')
    @include('components.productReceive.product-receive-update')
@endsection