@extends('layouts.master')
@section('title')
    {{__('Edit Fees')}}
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
                    <form method="post" action="{{ route('Fees.update',$fee->id)}}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Fee Name_ar')}}</label>
                                <input type="text" name="name_ar" value="{{$fee->name_ar}}" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Fee Name_en')}} : <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name_en" value="{{$fee->name_en}}" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{__('Amount')}} : <span
                                        class="text-danger">*</span> </label>
                                <input type="text" name="amount" value="{{$fee->amount}}" class="form-control">
                            </div>

                        </div><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>

                                    @foreach($grades as $grade)
                                        <option selected disabled>{{$grade['name_'.app()->getLocale()]}}</option>
                                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="classroom_id" >
                                    <option selected disabled>{{$fee->classrooms['name_'.app()->getLocale()]}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">{{__('Year')}} : <span
                                        class="text-danger">*</span></label>
                                <select name="year" class="custom-select">
                                    <option value="" selected disabled>{{$fee->year}}</option>
                                    <?php $curren_year = date('Y');?>
                                    <option value="{{$curren_year}}">{{$curren_year}}</option>
                                </select>
                            </div>

                        </div><br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{__('Notes') }}:</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{$fee->notes}}</textarea>
                        </div>
                        <br><br>

                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('Fees.index')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
