@extends('admin_dashboard.layout.master')


@section('title')
    {{__('Add Student')}}
@endsection
@section('content')

<livewire:student.create/>
@endsection