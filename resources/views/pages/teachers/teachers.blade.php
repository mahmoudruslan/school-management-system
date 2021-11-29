@extends('layouts.master')

@section('title')
    {{ __('List_teachers') }}
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
        {{ __('add_teachers') }}
    </a>
    <br><br>

    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>

            <tr>
                <th>#</th>
                <th>{{__("Name")}}</th>
                <th>{{__("gender")}}</th>
                <th>{{__("specialization")}}</th>
                <th>{{__("joining_date")}}</th>
                <th>{{__("address")}}</th>
                <th>{{__("Processes")}}</th>

            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach ($teachers as $teacher)
                <?php $i++; ?>
                <tr>
                    <td>{{$i}}</td>
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
                {{-- start delete_modal_section --}}
                <div class="modal fade" id="delete{{$teacher ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('teacher_delete') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-footer">
                                <form action="{{ route('Teachers.destroy','test') }}" method="POST">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <input type="hidden" name="id"  value="{{$teacher ->id}}">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        {{ __('close') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end delete_modal_section --}}
            @endforeach
            </tbody>
        </table>
    </div>


@endsection



