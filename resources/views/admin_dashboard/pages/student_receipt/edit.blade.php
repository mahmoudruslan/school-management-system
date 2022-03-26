@extends('admin_dashboard.layout.master')

@section('title')
    {{__('Edit catch receipt')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ Session::get('error')}}</li>
            </ul>

        </div>
    @endif
    <!-- end error messages -->
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="post"  action="{{route('studentReceipt.update',$receipt->id)}}" autocomplete="off">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('Student Name')}} : <span class="text-danger">*</span></label>
                                    <input   value="{{$receipt->students['name_'.app()->getLocale()]}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('Amount')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="debit" type="number" value="{{$receipt->debit}}">
                                    <input  type="hidden" name="student_id"  value="{{$receipt->students->id}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('Description')}} : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description"  id="exampleFormControlTextarea1" rows="3">{{$receipt->description}}</textarea>
                                </div>
                            </div>
                        </div><br>
                        <button class="button" type="submit">{{__('Submit')}}</button>
                        <a class="btn btn-secondary" href="{{route('studentReceipt.index')}}">{{__('Back')}}</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@stop
