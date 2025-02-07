@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Student absence detection')}}
@endsection
@section('content')
        <!-- start error messages -->
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    @php
        $lang = app()->getLocale();
    @endphp

    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Student Name")}}</th>
                <th>{{__("Date")}}</th>
                <th>{{__("Grade")}}</th>
                <th>{{__("Classroom")}}</th>
                <th>{{__("Section")}}</th>
                <th>{{__("Teacher Name")}}</th>
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$attendance->student['name_'.$lang]}}</td>
                        <td>{{$attendance->date}}</td>
                        <td>{{$attendance->grade['name_'.$lang]}}</td>
                        <td>{{$attendance->classroom['name_'.$lang]}}</td>
                        <td>{{$attendance->section['name_'.$lang]}}</td>
                        <td>{{$attendance->admin['name_'.$lang]}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('students.show',$attendance->students->id)}}">
                                <i class="far fa-eye "></i>&nbsp;{{__('Show student information')}}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection