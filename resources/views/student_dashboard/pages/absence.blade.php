@extends('student_dashboard.layout.master')
@section('title')
    {{__('Absence')}}
@endsection
@section('content')
        <!-- start error messages -->
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->

    {{-- myTable --}}
    <div class="table-responsive">
        <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr class="alert-success" id="myUL">
                <th>{{__("Date")}}</th>
                <th>{{__("Teacher Name")}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{$attendance->date}}</td>
                        <td>{{$attendance->admin['name_'.app()->getLocale()]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection