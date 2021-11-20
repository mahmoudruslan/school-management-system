@extends('layouts.master')

@section('title')
    {{__('teachers.add_teachers')}}
@stop


@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <form action="{{route('Teachers.store')}}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('teachers.email')}}</label><br>
                @error('email')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="email" type="email" class="form-control" id="inputEmail4" >
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('teachers.password')}}</label><br>
                @error('password')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="password" type="password" class="form-control">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('teachers.teacher_name_ar')}}</label><br>
                @error('name_ar')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="name_ar" type="text" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('teachers.teacher_name_en')}}</label><br>
                @error('name_en')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="name_en" type="text" class="form-control">
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{__('teachers.address')}}</label><br>
                @error('address')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="address" type="text" class="form-control">
            </div>


            <div class="form-group col-md-6">
                <label for="inputZip">{{__('teachers.joining_date')}}</label><br>
                @error('joining_date')<span class="error text-danger">{{ $message }}</span>@enderror
                <input class="form-control" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd">
            </div>

        </div>


        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputState">{{__('teachers.specialization')}}</label><br>
            @error('specialization_id')<span class="error text-danger">{{ $message }}</span>@enderror
            <select name="specialization_id" class="custom-select">

                <option value="" selected disabled>{{__('teachers.select_specialization')}}
                </option>
                    @foreach($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization['name_'.app()->getLocale()]}}</option>
                    @endforeach
            </select>

        </div>

            <div class="form-group col-md-6">
                <label for="inputState">{{__('teachers.gender')}}</label><br>
                @error('gender')<span class="error text-danger">{{ $message }}<br></span>@enderror
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="$2y$10$NgiCAwLGJ6yMl/ZDlNmBBu07oegjK1JG9VGiRhdMrmI4VmdzuRQQS">
                <label class="form-check-label" for="inlineRadio1">{{__('teachers.male')}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="$2y$10$FkGE1UxATWFSWUuRPxqdu.uccMpntdV6r3662YMA.HDyssiNlJdYa">
                <label class="form-check-label" for="inlineRadio2">{{__('teachers.female')}}</label>
            </div>
            </div>
        </div>


        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('teachers.submit')}}</button>
        <a href="{{route('Teachers.index')}}" class="btn btn-danger" type="button">{{__('sections.back')}}</a>
    </form>


@endsection
