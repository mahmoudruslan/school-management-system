
@extends('layouts.master')

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
    <!-- end error messages -->

    <!-- start add_modal_classroom button -->
    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
        {{ __('Add Classroom') }}
    </button>

    <br><br>
    <!-- end add_modal_classroom button -->
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
                        <td>{{ $loop->count }}</td>
                        <td>{{$classroom['name_'.app()->getLocale()]}}</td>
                        <td>{{$classroom->gradess['name_'.app()->getLocale()]}}</td>
                        <td>
                            <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$classroom ->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$classroom ->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- start edit_modal_Grade -->
                    <div class="modal fade" id="edit{{$classroom ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                        {{ __('Edit Classroom') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('Classrooms.update','test') }}" method="POST">
                                        {{method_field('patch')}}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="name_ar" class="mr-sm-2">{{ __('Classroom Name_ar') }}:</label>
                                                <input id="name_ar" value="{{ $classroom->name_ar }}" type="text" name="name_ar" class="form-control">
                                                <input value="{{ $classroom->id }}" type="hidden" name="id" class="form-control">
                                            </div>

                                            <div class="col">
                                                <label for="name_en" class="mr-sm-2">{{ __('Classroom Name_en') }}:</label>
                                                <input value="{{ $classroom->name_en }}" type="text" class="form-control" name="name_en">
                                            </div>
                                            <div class="col"><label for="grade_id" class="mr-sm-2">{{ __('Grade Name') }}:</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id">
                                                        <option value="{{$classroom ->gradess->id}}">
                                                            {{$classroom ->gradess['name_'.app()->getLocale()]}}
                                                        </option>
                                                        @foreach ($grades as $grade)
                                                            <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                        </div>
                                    </form>
                                    <!-- end add_form -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end edit_modal_Grade -->
                    <!-- start delete_modal_Grade -->
                    <div class="modal fade" id="delete{{$classroom ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Are you sure you want to delete the classroom?') }}</h5>
                                    <form action="{{route('Classrooms.destroy', 'test')}}" method="POST">
                                        {{method_field('Delete')}}
                                        @csrf
                                        <input type="hidden" name="id" value="{{$classroom->id}}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            <button type="submit" class="btn btn-danger">{{ __('Delete')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end delete_modal_Grade -->
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- start add_modal_classroom -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('Add Classroom') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Classrooms.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ __('Classroom Name_ar') }}:</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ __('Classroom Name_en') }}:</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>

                            <div class="col">
                                <label for="grade_id" class="mr-sm-2">{{ __('Grade Name') }}:</label>
                                <div class="box">
                                    <select class="fancyselect" name="grade_id">
                                        @foreach ($grades as $grade)
                                            <option value="{{$grade ->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                        </div>
                    </form>
                    <!-- end add_form -->
                </div>
            </div>
        </div>
    </div>
    <!-- end add_modal_classroom -->
@endsection


