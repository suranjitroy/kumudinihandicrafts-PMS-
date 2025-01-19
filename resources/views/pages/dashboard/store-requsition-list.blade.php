@extends('layout.sidenav-layout')
@section('content')
    @include('components.storeRequisition.store-requisition-create')
    @include('components.storeRequisition.store-requisition-list')
    @include('components.storeRequisition.store-requisition-details')
    @include('components.storeRequisition.store-requisition-updateview')
    @include('components.storeRequisition.store-requisition-delete')
@endsection