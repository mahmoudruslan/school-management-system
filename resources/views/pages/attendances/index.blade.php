@extends('layouts.master')
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
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$attendance->students['name_'.app()->getLocale()]}}</td>
                        <td>{{$attendance->date}}</td>
                        <td>{{$attendance->grades['name_'.app()->getLocale()]}}</td>
                        <td>{{$attendance->classrooms['name_'.app()->getLocale()]}}</td>
                        <td>{{$attendance->sections['name_'.app()->getLocale()]}}</td>
                        <td>
                            {{-- <a href="{{route('Attendances.edit',$attendance->id)}}" class="btn btn-info" >
                                <i class="fa fa-edit"></i>
                            </a> --}}
                            <button style="color: white" data-toggle="modal" data-target="#exampleModal"
                            class="btn btn-danger" type="button" >
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection