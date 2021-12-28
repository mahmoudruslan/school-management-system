@extends('layouts.master')
@section('title')
    {{__('Add Fees')}}
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
                    <form method="post" action="{{ route('Fees.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Fee Name_ar')}}</label><br>
                                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Fee Name_en')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_en" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{__('Amount')}} : <span
                                        class="text-danger">*</span> </label><br>
                                @error('amount') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="number" name="amount" class="form-control">
                            </div>

                        </div><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}}</label><br>
                                @error('grade_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option selected disabled>{{__('Choose Grade')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Classrooms')}}: <span
                                        class="text-danger">*</span></label><br>
                                @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select class="custom-select mr-sm-2" name="classroom_id" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">{{__('Year')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('year') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select name="year" class="custom-select">
                                    <option value="" selected disabled>{{__('Choose Year')}}</option>
                                    <?php $curren_year = date('Y');?>
                                    <option value="{{$curren_year}}">{{$curren_year}}</option>
                                </select>
                            </div>

                        </div><br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('Notes') }}:</label><br>
                            @error('notes') <span class="error text-danger">{{ $message }}</span> @enderror
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
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
