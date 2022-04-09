@extends('admin_dashboard.layout.master')


@section('title')
    {{__('Edit student data')}}
@endsection
@section('content')

<livewire:student.edit :student="$student"/>
@endsection
