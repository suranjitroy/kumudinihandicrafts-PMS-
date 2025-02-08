@extends('layout.sidenav-layout')
@section('content')
    @include('components.purchaseRequisition.purchase-requisition-list')
    @include('components.purchaseRequisition.purchase-requisition-details')
    @include('components.purchaseRequisition.purchase-requisition-updateview')
    @include('components.purchaseRequisition.purchase-requisition-delete')
@endsection
