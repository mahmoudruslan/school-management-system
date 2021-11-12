@extends('layouts.master')

@section('title')
{{__('main-side-bar.List of grades')}}
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
        {{ trans('grades.add_Grade') }}
    </button>
    <br><br>

    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>

                <tr>
                    <th>#</th>
                    <th>{{__("grades.Name")}}</th>
                    <th>{{__("grades.Notes")}}</th>
                    <th>{{__("grades.Processes")}}</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($grades as $grade)
                <?php $i++; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$grade -> name}}</td>
                        <td>{{$grade ->notes}}</td>

                        <td>
                            <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$grade ->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$grade ->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                        <!-- start edit_modal_Grade -->
                        <div class="modal fade" id="edit{{$grade ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades.edit_Grade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('grades.update', 'test')}}" method="post">
                                            {{ method_field('patch') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name_ar" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                        :</label>
                                                    <input value="{{ $grade->name_ar }}" type="text" name="name_ar" class="form-control">
                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">

                                                </div>

                                                <div class="col">
                                                    <label for="name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                        :</label>
                                                    <input value="{{ $grade->name_en }}" type="text" class="form-control" name="name_en">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{ trans('grades.Notes') }}
                                                    :</label>
                                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                                        rows="3">{{ $grade->notes}}</textarea>
                                            </div>
                                            <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                        <button type="submit" class="btn btn-success">{{ trans('grades.submit') }}</button>
                                    </div>
                                    </form>
                                    <!-- end add_form -->

                                </div>
                            </div>
                        </div>
                        <!-- end edit_modal_Grade -->
                        <!-- start delete_modal_Grade -->
                        <div class="modal fade" id="delete{{$grade ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades.Are you sure you want to delete the stage?') }}
                                        </h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('grades.destroy', 'test') }}" method="POST">
                                            {{ method_field('Delete') }}
                                            @csrf
                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                {{ trans('grades.Close') }}
                                            </button>
                                            <button type="submit" class="btn btn-danger">
                                                {{ trans('grades.Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end delete_modal_Grade -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <!-- start add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name_ar" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                        :</label>
                                    <input id="name_ar" type="text" name="name_ar" class="form-control">

                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="name_en">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('grades.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('grades.submit') }}</button>
                    </div>
                    </form>
                        <!-- end add_form -->
                </div>
            </div>
    </div>
    <!-- end add_modal_Grade -->

@endsection
