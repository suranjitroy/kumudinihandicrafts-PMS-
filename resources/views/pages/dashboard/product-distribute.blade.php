@extends('layout.sidenav-layout')
@section('content')
    @include('components.productDistribution.product-distribution-create')
    @include('components.productDistribution.product-distribution-list')
    @include('components.productDistribution.product-distribution-delete')
    @include('components.productDistribution.product-distribution-update')
@endsection