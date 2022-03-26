@extends('admin_dashboard.layout.master')

@section('title')
    {{__('Edit Section')}}
@stop


@section('content')

    <form action="{{route('sections.update','test')}}" method="POST">

        {{method_field('patch')}}

        @csrf
        <input type="hidden" value="{{$section->id}}" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Section Name_ar')}}</label><br>
                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input value="{{$section->name_ar}}" type="text" name="name_ar" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('Section Name_en')}}</label><br>
                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input value="{{$section->name_en}}" type="text" name="name_en" class="form-control">


            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName" class="control-label">{{__('Choose Grade')}}</label><br>
                @error('grade_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select  name="grade_id" class="custom-select"
                        onchange="console.log($(this).val())">
                    <!--placeholder-->
                    <option value="{{$section->grades->id}}" selected >{{$section->grades['name_'.app()->getLocale()]}}</option>

                    @foreach ($grades as $grade)
                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputName"
                       class="control-label">{{__('Classroom')}}</label><br>
                @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select name="classroom_id" class="custom-select">
                    <option value="{{$section->classrooms->id}}" selected >{{$section->classrooms['name_'.app()->getLocale()]}}</option>


                </select>
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName" class="control-label">{{__('Choose Teacher')}}</label><br>
                <select  name="teacher_id[]" class="custom-select {{ $errors->has('teacher_id') ? ' is-invalid' : '' }}" multiple aria-label="multiple select example">
                    @foreach($section->teachers as $teacher)
                        <option selected value="{{$teacher->id}}">{{$teacher->admin['name_'.app()->getLocale()]}}</option>
                    @endforeach


                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->admin['name_'.app()->getLocale()]}}</option>
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
                    <input name="status" type="hidden" value="0">
                    <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        {{__('status')}}
                    </label>
                </div>
            </div>

        </div>
        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('Submit')}}</button>
        <a href="{{route('sections.index')}}" class="btn btn-danger" type="button">{{__('Back')}}</a>
    </form>
@endsection
@section('js')

@endsection

