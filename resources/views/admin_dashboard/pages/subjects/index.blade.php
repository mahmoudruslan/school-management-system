@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Subjects List')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <a href="{{route('subjects.create')}}" type="button" class="button x-small" >
        {{ __('Add Subjects') }}
    </a><br><br>


    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Subject Name")}}</th>
                <th>{{__("Grade")}}</th>
                <th>{{__("Classroom")}}</th>
                <th>{{__("Teacher Name")}}</th>

                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$subject['name_'.app()->getLocale()]}}</td>
                    <td>{{$subject->grades['name_'.app()->getLocale()]}}</td>
                    <td>{{$subject->classrooms['name_'.app()->getLocale()]}}</td>
                    <td>{{$subject->teachers['name_'.app()->getLocale()]}}</td>

                    <td>
                        <a href="{{route('subjects.edit',$subject->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$subject->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('admin_dashboard.pages.subjects.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
