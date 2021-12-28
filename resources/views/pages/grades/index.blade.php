@extends('layouts.master')

@section('title')
{{__('List of grades')}}
@stop
@section('content')
    <!-- start error messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- end error messages -->
    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
        {{ __('Add Grade') }}
    </button>
    <br><br>
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__("Name")}}</th>
                    <th>{{__("Notes")}}</th>
                    <th>{{__("Processes")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{$loop->index}}</td>
                        <td>{{$grade['name_'.app()->getLocale()]}}</td>
                        <td>{{$grade ->notes}}</td>
                        <td>
                            <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$grade ->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$grade ->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @include('pages.grades.edit')
                    @include('pages.grades.delete')
                @endforeach
            </tbody>
        </table>
    </div>
    @include('pages.grades.create')

@endsection
