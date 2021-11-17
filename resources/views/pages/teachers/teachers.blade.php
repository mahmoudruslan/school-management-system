@extends('layouts.master')

@section('title')
    {{ __('teachers.List_teachers') }}
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
    <a href="{{route('Teachers.create')}}" type="button" class="button x-small">
        {{ trans('teachers.add_teachers') }}
    </a>
    <br><br>

    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>

            <tr>
                <th>#</th>
                <th>{{__("teachers.Name")}}</th>
                <th>{{__("teachers.gender")}}</th>
                <th>{{__("teachers.specialization")}}</th>
                <th>{{__("teachers.joining_date")}}</th>
                <th>{{__("teachers.address")}}</th>
                <th>{{__("teachers.Processes")}}</th>

            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach ($teachers as $teacher)
                <?php $i++; ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$teacher['name_'.app()->getLocale()]}}</td>
                    <td>{{$teacher ->gender}}</td>
                    <td>{{$teacher ->specializations['name_'.app()->getLocale()]}}</td>
                    <td>{{$teacher ->joining_date}}</td>
                    <td>{{$teacher ->address}}</td>
                    <td>
                        <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$teacher ->id}}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$teacher ->id}}">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection



