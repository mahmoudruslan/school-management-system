@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Promotions List')}}
@endsection

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- myTable --}}
    <button type="button" class="btn btn-danger" id="btn_delete_all">
        <i class="fas fa-check-square"></i>
    </button><span class="p-2">{{__('Delete')}}</span><br><br>

    <button type="button" class="btn btn-primary" id="checked_all">
        <i class="fas fa-check-square"></i>
    </button><span class="p-2">{{__('Select all')}}</span><br><br>
    
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Student Name")}}</th>

                <th class="alert-danger">{{__("Previous stage")}}</th>
                <th class="alert-danger">{{__("Previous classroom")}}</th>
                <th class="alert-success">{{__("Current stage")}}</th>
                <th class="alert-success">{{__("Current classroom")}}</th>
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($promotions as $promotion)
                <tr>
                    <td>
                        <input type="checkbox" class="mr-4" value="{{$promotion->id}}">{{$loop->index+1}}
                    </td>
                    <td>{{$promotion->students->name_ar}}</td>
                    <td>{{$promotion->f_grade['name_'.app()->getLocale()]}}</td>
                    <td>{{$promotion->f_classroom['name_'.app()->getLocale()]}}</td>
                    <td>{{$promotion->to_grade['name_'.app()->getLocale()]}}</td>
                    <td>{{$promotion->to_classroom['name_'.app()->getLocale()]}}</td>

                    <td>

                        <button data-toggle="modal" data-target="#exampleModal{{$promotion->id}}"  class="btn btn-outline-danger font-bold" type="button" >
                            {{__('Delete upgrade')}}
                        </button>
                        <form action="{{route('promotions.destroy','test')}}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                            <input type="hidden" name="ids" value="{{$promotion->id}}">
                            <div class="modal fade" id="exampleModal{{$promotion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ __('Delete Promotion') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{__('Warning')}}:{{ __('When the promotion is deleted, the student returns to the previous stage, and the registration status will remain for replay') }}.
                                            </h5>                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            <!-- حذف مجموعة ترقيات -->
            <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ __('Delete Promotion') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('promotions.destroy','test')}}" method="POST">
                            @csrf
                            {{ method_field('Delete') }}
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            </h5>
                            <div class="modal-body">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{__('Warning')}}:{{ __('When the promotion is deleted, the student returns to the previous stage, and the registration status will remain for replay') }}.
                                </h5>
                                <input class="text" type="hidden" id="delete_all_id" name="ids" value=''>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </tbody>
        </table>
    </div>
@endsection

