
@extends('admin_dashboard.layout.master')

@section('title')
    {{__("Classrooms List")}}
@stop
@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    @php
        $lang = app()->getLocale();
    @endphp
    <!-- end error messages -->
    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
        {{ __('Add Classroom') }}
    </button>
    <br><br>
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__("Classroom Name")}}</th>
                    <th>{{__("Grade Name")}}</th>
                    <th>{{__("Processes")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                    <tr>
                        <td>{{ $loop->index + 1}}</td>
                        <td>{{$classroom['name_'. $lang]}}</td>
                        <td>{{$classroom->grades['name_'. $lang]}}</td>
                        <td>
                            <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$classroom ->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$classroom ->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <form class="d-inline" action="{{route('classrooms.show',$classroom->id)}}" method="">
                                @csrf
                                <button class="btn btn-warning" type="submit">
                                    <i class="fa fa-eye"></i> {{__('Show students')}}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @include('admin_dashboard.pages.myclassroom.edit')
                    @include('admin_dashboard.pages.myclassroom.delete')
                @endforeach
            </tbody>
        </table>
    </div>
@include('admin_dashboard.pages.myclassroom.create')
@endsection
