@extends('layouts.master')

@section('title')
    {{ __('List Teachers') }}
@stop


@section('content')

    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <a href="{{route('Teachers.create')}}" type="button" class="button x-small">
        {{ __('Add Teachers') }}
    </a>
    <br><br>
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__("Name")}}</th>
                <th>{{__("Gender")}}</th>
                <th>{{__("Specialization")}}</th>
                <th>{{__("Joining Date")}}</th>
                <th>{{__("Address")}}</th>
                <th>{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$teacher['name_'.app()->getLocale()]}}</td>
                    <td>{{__($teacher ->gender)}}</td>
                    <td>{{$teacher ->specializations['name_'.app()->getLocale()]}}</td>
                    <td>{{$teacher ->joining_date}}</td>
                    <td>{{$teacher ->address}}</td>
                    <td>
                        <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$teacher ->id}}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <a  class="btn btn-info" type="button" href="{{route('Teachers.edit',$teacher ->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @include('pages.teachers.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection



