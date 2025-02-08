@extends('layout.sidenav-layout')
@section('content')
    @include('components.consumption.consumption-setting-create')
    @include('components.consumption.consumption-setting-list')
    @include('components.consumption.consumption-setting-delete')
    @include('components.consumption.consumption-setting-update')
@endsection
