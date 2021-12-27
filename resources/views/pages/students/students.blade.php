@extends('layouts.master')

@section('title')
    {{__('Students List')}}
@stop


@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <a href="{{route('Students.create')}}" type="button" class="button x-small" >
        {{ __('Add Student') }}
    </a><br><br>


    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
                <tr id="myUL">
                    <th>#</th>
                    <th>{{__("Name")}}</th>
                    <th>{{__("Religion")}}</th>
                    <th>{{__("Gender")}}</th>
                    <th>{{__("Grade")}}</th>
                    <th>{{__("Classroom")}}</th>
                    <th>{{__("Section")}}</th>
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
                        <td>{{$student->grades['name_'.app()->getLocale()] ?? ''}}</td>
                        <td>{{$student->classrooms['name_'.app()->getLocale()] ?? ''}}</td>
                        <td>{{$student->sections['name_'.app()->getLocale()] ??  ''}}</td>
                        <td>
                            <div class="dropdown show">
                                <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{__('Processes')}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('Students.show',$student->id)}}">
                                        <i style="color: #ffc107" class="far fa-eye "></i>&nbsp;{{__('Show student information')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('Students.edit',$student->id)}}">
                                        <i style="color:green" class="fa fa-edit"></i>&nbsp;{{__('Edit student data')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('FeesInvoices.show',$student->id)}}">
                                        <i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;{{__('Add a fee invoice')}}&nbsp;
                                    </a>
                                    <a class="dropdown-item" href="{{route('StudentReceipt.show',$student->id)}}"><i style="color: #1e7e34" class="fas fa-dollar-sign"></i>&nbsp; &nbsp;{{__('Catch Receipt')}}</a>
                                    <a class="dropdown-item" href="{{route('FeeProcessing.show',$student->id)}}"><i style="color: #1e7e34" class="fad fa-money-check-edit-alt"></i>&nbsp; &nbsp;{{__('Fee exclusion')}}</a>
                                    <a class="dropdown-item" href="{{route('Payments.show',$student->id)}}"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp;{{__('Receipt')}}</a>
                                    <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="#">
                                        <i style="color: red" class="fa fa-trash"></i>&nbsp;{{__('Delete student')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
{{--                        <td>--}}
{{--                            <a href="{{route('Students.show',$student->id)}}" class="btn btn-warning" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>--}}

{{--                            <form style="display: inline-block"action="{{route('Students.edit','test')}}">--}}
{{--                                @csrf--}}
{{--                                <input value="{{$student->id}}" name="id" type="hidden">--}}
{{--                                <button  class="btn btn-info" type="submit" >--}}
{{--                                    <i class="fa fa-edit"></i>--}}
{{--                                </button>--}}
{{--                            </form>--}}


{{--                            <button style="color: white" data-toggle="modal" data-target="#Delete_Student{{$student->id}}"  class="btn btn-danger" type="button" >--}}
{{--                                <i class="fa fa-trash"></i>--}}
{{--                            </button>--}}
{{--                        </td>--}}
                    <div class="modal fade" id="Delete_Student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{route('Students.destroy','test')}}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="{{$student->id}}">
                                        <h6>{{__('Warning').':'. __('When you delete a Student, all attachments will be deleted...')}}</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
