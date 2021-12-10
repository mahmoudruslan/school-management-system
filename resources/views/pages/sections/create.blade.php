@extends('layouts.master')

@section('title')
    {{__('Add Section')}}
@stop


@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <form action="{{route('Sections.store')}}" method="POST">
        @csrf
        <input type="hidden" name="create" value="1">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">{{__('Section name_ar')}}</label><br>
            @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
            <input type="text" name="name_ar" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="inputPassword4">{{__('Section name_en')}}</label><br>
            @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
            <input type="text" name="name_en" class="form-control">


        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputName" class="control-label">{{__('Grade')}}</label><br>
            @error('grade_id') <span class="error text-danger">{{ $message }}</span> @enderror
            <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                <!--placeholder-->
                <option value="" selected disabled>{{__('Choose Grade')}}</option>
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

            </select>
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputName" class="control-label">{{__('Choose Teacher')}}</label><br>

            <select name="teacher_id[]" class="custom-select {{$errors->has('teacher_id') ? "is-invalid":" "}}" multiple aria-label="multiple select example">

                @foreach($teachers as $teacher)

                    <option value="{{$teacher->id}}">{{$teacher->name_ar}}</option>
                @endforeach
            </select>
            @if($errors->has('teacher_id'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('teacher_id') }}</strong>
                    </span>
            @endif
            <br><br>

            <div class="form-check">
                <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    {{__('Status')}}
                </label>
            </div>
        </div>

    </div>
        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('Submit')}}</button>
        <a href="{{route('Sections.index')}}" class="btn btn-danger" type="button">{{__('Back')}}</a>
</form>
@endsection

