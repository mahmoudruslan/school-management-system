@extends('layouts.master')
@section('title')
    {{__('Fees List')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <a href="{{route('Fees.create')}}" type="button" class="button x-small" >
        {{ __('Add Fees') }}
    </a><br><br>


    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Fee Name")}}</th>
                <th>{{__("Amount")}}</th>
                <th>{{__("Grade")}}</th>
                <th>{{__("Classroom")}}</th>
                <th>{{__("Year")}}</th>
                <th>{{__("Notes")}}</th>
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fees as $fee)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$fee['name_'.app()->getLocale()]}}</td>
                    <td>{{$fee->amount}}</td>
                    <td>{{$fee->grades['name_'.app()->getLocale()]}}</td>
                    <td>{{$fee->classrooms['name_'.app()->getLocale()]}}</td>
                    <td>{{$fee->year}}</td>
                    <td>{{$fee->notes}}</td>
                    <td>
                        <a href="{{route('Fees.edit',$fee->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$fee->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('pages.fees.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
