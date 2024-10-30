@extends('layout.sidenav-layout')
@section('content')
    @include('components.unit.unit-create')
    @include('components.unit.unit-list')
    @include('components.unit.unit-delete')
    @include('components.unit.unit-update')
@endsection