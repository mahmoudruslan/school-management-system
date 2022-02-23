@extends('layouts.master')
@section('title')
    {{__('Edit Subject')}}
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
                    <form method="post" action="{{route('Subjects.update', $subject->id)}}">
                        @csrf
                        {{method_field('patch')}}
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Subject Name_ar')}} : <span
                                    class="text-danger">*</span>
                                </label><br>
                                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" value="{{$subject->name_ar}}" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Subject Name_en')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" value="{{$subject->name_en}}" name="name_en" class="form-control">
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Grade')}} : <span
                                    class="text-danger">*</span></label><br>
                                @error('grade_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option value="{{$subject->grade_id}}">{{$subject->grades['name_'.app()->getLocale()]}}</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Classrooms')}}: <span
                                        class="text-danger">*</span></label><br>
                                @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select class="custom-select mr-sm-2" name="classroom_id" >
                                    <option value="{{$subject->classroom_id}}">{{$subject->classrooms['name_'.app()->getLocale()]}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">{{__('Choose Teacher')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('teacher_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                <select name="teacher_id" class="custom-select">
                                    <option value="{{$subject->teacher_id}}">{{$subject->teachers['name_'.app()->getLocale()]}}</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher['name_'.app()->getLocale()]}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div><br><br>
                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('Subjects.index')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
