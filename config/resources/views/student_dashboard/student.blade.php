@extends('student_dashboard.layout.master')

@section('title')
{{ __('Student control panel') }}
@endsection

@section('content')
<livewire:student-calender />
@endsection