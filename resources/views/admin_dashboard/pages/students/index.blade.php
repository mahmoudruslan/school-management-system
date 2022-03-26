@extends('admin_dashboard.layout.master')


@section('title')
    {{__('Students')}}
@endsection
@section('content')

<livewire:student />
@endsection
