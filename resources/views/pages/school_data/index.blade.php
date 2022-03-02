@extends('layouts.master')
@section('title')
    {{ __('school data') }}
@stop

@section('content')
    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    @if(isset($school_data))
    <div class="card-body">
        <form enctype="multipart/form-data" method="POST" action="{{ route('school_data.update', 'test') }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <input name="id" value="{{ $school_data->id }}" type="hidden">
                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('School name in Arabic') }} : </h4>
                        <div class="col-lg-9">
                            <input name="name_ar" value="{{ $school_data->name_ar }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('School name in English') }}</h4>
                        <div class="col-lg-9">
                            <input name="name_en" value="{{ $school_data->name_en }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('school time') }}</h4>
                        <div class="col-lg-9">
                            <input name="school_time" value="{{ $school_data->school_time }}" type="text"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('school rating') }}</h4>
                        <div class="col-lg-9">
                            <input name="school_rating" value="{{ $school_data->school_rating }}" type="text"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('Year Founded') }}</h4>
                        <div class="col-lg-9">
                            <input name="year_founded" value="{{ $school_data->year_founded }}" type="text"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('Grade') }}</h4>
                        <div class="col-lg-9">
                            <input name="grade" value="{{ $school_data->grade }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('phone') }}</h4>
                        <div class="col-lg-9">
                            <input name="phone" value="{{ $school_data->phone }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('Email') }}</h4>
                        <div class="col-lg-9">
                            <input name="email" value="{{ $school_data->email }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('School Manager') }}</h4>
                        <div class="col-lg-9">
                            <input name="school_manager" value="{{ $school_data->school_manager }}" type="text"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('city') }}</h4>
                        <div class="col-lg-9">
                            <input name="city" value="{{ $school_data->city }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('Address') }}</h4>
                        <div class="col-lg-9">
                            <input name="address" value="{{ $school_data->address }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h4 class="col-lg-2 col-form-label font-weight-bold">{{ __('Logo') }}</h4>
                        <div class="col-lg-9">
                            <input name="logo" type="file" accept="image/*" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="col-lg-2 col-form-label font-weight-bold"></span>
                        <div class="col-lg-9">
                            <img src="{{URL('images/'.$school_data->logo)}}" alt="{{__('Logo')}}" title="{{__('Logo')}}" style="width: 15%;hight:15%">
                        </div>
                    </div>

                </div>
            </div><br>
            <hr>
            <button class="button" type="submit">{{ __('Updating data') }}</button>
        </form>
    </div>
    @else
    <div class="alert alert-danger"><h3>{{__('There are no data')}}</h3></div>
    @endif
@endsection
