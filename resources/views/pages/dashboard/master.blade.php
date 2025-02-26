@extends('layout.sidenav-layout')
@section('content')
    @include('components.master.master-create')
    @include('components.master.master-list')
    @include('components.master.master-delete')
    @include('components.master.master-update')
@endsection
