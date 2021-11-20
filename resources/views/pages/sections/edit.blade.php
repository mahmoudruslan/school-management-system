@extends('layouts.master')

@section('title')
    {{__('sections.edit_section')}}
@stop


@section('content')

    <form action="{{route('Sections.update','test')}}" method="POST">

        {{method_field('patch')}}

        @csrf
        <input type="hidden" value="{{$section->id}}" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('sections.section_name_ar')}}</label><br>
                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input value="{{$section->name_ar}}" type="text" name="name_ar" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('sections.section_name_en')}}</label><br>
                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input value="{{$section->name_en}}" type="text" name="name_en" class="form-control">


            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName" class="control-label">{{__('sections.select_grade')}}</label><br>
                @error('grade_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select  name="grade_id" class="custom-select"
                        onchange="console.log($(this).val())">
                    <!--placeholder-->
                    <option value="" selected
                            disabled>{{__('sections.select_grade')}}
                    </option>
                    @foreach ($grades as $grade)
                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputName"
                       class="control-label">{{__('sections.select_classroom')}}</label><br>
                @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select name="classroom_id" class="custom-select">


                </select>
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName" class="control-label">{{__('sections.select_teacher')}}</label><br>
                <select  name="teacher_id[]" class="custom-select {{ $errors->has('teacher_id') ? ' is-invalid' : '' }}" multiple aria-label="multiple select example">
                    @foreach($section->teachers as $teacher)
                        <option selected value="{{$teacher->id}}">{{$teacher->name_en}}</option>
                    @endforeach


                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name_en}}</option>
                    @endforeach
                </select>
                @if($errors->has('teacher_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('teacher_id') }}</strong>
                    </span>
                @endif
                <br>
                <br>
                <div class="form-check">
                    <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        {{__('sections.status')}}
                    </label>
                </div>
            </div>

        </div>
        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('sections.submit')}}</button>
        <a href="{{route('Sections.index')}}" class="btn btn-danger" type="button">{{__('sections.back')}}</a>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classrooms') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection

