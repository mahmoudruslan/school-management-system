@extends('layouts.master')

@section('title')
    {{__('Student List')}}
@stop


@section('content')
    <a href="{{route('Students.create')}}" type="button" class="button x-small" >
        {{ __('Add Student') }}
    </a>


    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
                <tr id="myUL">
                    <th>#</th>
                    <th>{{__("Name")}}</th>
                    <th>{{__("Religion")}}</th>
                    <th>{{__("Gender")}}</th>
                    <th>{{__("Educational grade")}}</th>
                    <th>{{__("Classroom")}}</th>
                    <th>{{__("Section")}}</th>
                    <th>{{__("Nationality")}}</th>
                    <th>{{__("Date of birth")}}</th>
                    <th class="pl-5 pr-4">{{__("Processes")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$student['name_'.app()->getLocale()]}}</td>
                        <td>{{$student->religions['name_'.app()->getLocale()]}}</td>
                        <td>{{__($student->gender)}}</td>
                        <td>{{$student->grades['name_'.app()->getLocale()]}}</td>
                        <td>{{$student->classrooms['name_'.app()->getLocale()]}}</td>
                        <td>{{$student->sections['name_'.app()->getLocale()]}}</td>
                        <td>{{$student->nationalities['name_'.app()->getLocale()]}}</td>
                        <td>{{$student->date_of_birth}}</td>
                        <td>
                            <a href="{{route('Students.show',$student->id)}}" class="btn btn-warning" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>

                            <form style="display: inline-block"action="{{route('Students.edit','test')}}">
                                @csrf
                                <input value="{{$student->id}}" name="id" type="hidden">
                                <button  class="btn btn-info" type="submit" >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>


                            <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$student->id}}"  class="btn btn-danger" type="button" >
                                <i class="fa fa-trash"></i>
                            </button>


                            <form action="{{route('Students.destroy','test')}}" method="POST">
                                {{ method_field('Delete') }}
                                @csrf
                                <input type="hidden" name="id" value="{{$student->id}}">
                            <div class="modal fade" id="exampleModal{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>{{__('Warning: When you delete a student, all attachments will be deleted...')}}</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>

                                            <button type="submit" class="btn btn-danger">{{__('delete')}}</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
