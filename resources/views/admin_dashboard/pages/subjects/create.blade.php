@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Add Subjects')}}
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
                    <form method="post" action="{{route('subjects.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Subject Name_ar')}} : <span
                                    class="text-danger">*</span>
                                </label><br>
                                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Subject Name_en')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_en" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="degree">{{__('Degree')}} ({{__('for two terms')}}) <span
                                        class="text-danger">*</span></label><br>
                                @error('degree') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="number" name="degree" class="form-control">
                            </div>

                        </div><br>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}} : <span
                                    class="text-danger">*</span></label><br>
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
                        </div><br><br>
                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('subjects.index')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
