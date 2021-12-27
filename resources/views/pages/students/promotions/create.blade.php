@extends('layouts.master')
@section('title')
    {{__('Add Promotion')}}
@stop


@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h6 style="color: #b70d00;font-family: Cairo;font-size: large">{{__('The old school stage')}}:-</h6><br>
                    <form method="post" action="{{ route('Promotions.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option selected disabled>{{__('Choose Grade')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="classroom_id">

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{__('Section')}} : <span
                                        class="text-danger">*</span> </label>
                                <select class="custom-select mr-sm-2" name="section_id">

                                </select>
                            </div>
{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="academic_year">{{trans('Academic Year')}} : <span class="text-danger">*</span></label>--}}
{{--                                    <select class="custom-select mr-sm-2" name="academic_year">--}}
{{--                                        <option value="" selected disabled>{{__('Choose Academic year')}}</option>--}}
{{--                                        <?php $curren_year = date('Y');?>--}}
{{--                                        <option value="{{$curren_year - 1}}">{{$curren_year - 1}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <br><h6 style="color: #b70d00;font-family: Cairo;font-size: large">{{__('The new school stage')}}:-</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id_new" required>
                                    <option selected disabled>{{__('Choose Grade')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="classroom_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">{{__('Section')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="section_id_new" >

                                </select>
                            </div>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="academic_year">{{__('Academic Year')}} : <span class="text-danger">*</span></label>--}}
{{--                                    <select class="custom-select mr-sm-2" name="academic_year_new">--}}
{{--                                        <option value="" selected disabled>{{__('Choose Academic year')}}</option>--}}
{{--                                        <?php $curren_year = date('Y');?>--}}
{{--                                        <option value="{{$curren_year}}">{{$curren_year}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                        </div><br>

                        <button type="submit" class="btn btn-info">{{__("Submit")}}</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
