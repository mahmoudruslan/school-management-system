@extends('layouts.master')
@section('title')
    {{__('Add Student')}}
@stop
@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <form action="{{route('Students.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="inputEmail4">{{__('Name_ar')}}</label><br>
                @error('name_ar')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="name_ar" type="text" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('Name_en')}}</label><br>
                @error('name_en')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="name_en" type="text" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Email')}}</label><br>
                @error('email')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="email" type="email" class="form-control" id="inputEmail4" >
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('Password')}}</label><br>
                @error('password')<span class="error text-danger">{{ $message }}</span>@enderror
                <input name="password" type="password" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputPassword4">{{__('Nationality')}}</label><br>
                        @error('nationality_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="nationality_id" class="custom-select">

                            <option value="" selected disabled>{{__('Choose nationality')}}</option>
                            @foreach($data['nationalities'] as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputPassword4">{{__('Blood Type')}}</label><br>
                        @error('blood_type_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="blood_type_id" class="custom-select">

                            <option value="" selected disabled>{{__('Choose Blood type')}}</option>
                            @foreach($data['Blood_types'] as $Blood_type)
                                <option value="{{$Blood_type->id}}">{{$Blood_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-row">
                    <div class="col">
                        <label for="inputPassword4">{{__('Parent')}}</label><br>
                        @error('parent_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="parent_id" class="custom-select">
                            <option value="" selected disabled>{{__('Choose Parent')}}</option>
                            @foreach($data['TheParents'] as $TheParent)
                                <option value="{{$TheParent->id}}">{{$TheParent['name_father_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputPassword4">{{__('Academic Year')}}</label><br>
                        @error('academic_year')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="academic_year" class="custom-select">
                            <option value="" selected disabled>{{__('Choose Academic year')}}</option>
                            <?php $curren_year = date('Y');?>
                            <option value="{{$curren_year}}" >{{$curren_year}}</option>
                            <option value="{{$curren_year + 1}}" >{{$curren_year + 1}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-row">
                    <div class="col">
                        <label for="inputState">{{__('Grade')}}</label><br>
                        @error('grade_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="grade_id" class="custom-select">
                            <option value="" selected disabled>{{__('Choose Grade')}}</option>
                            @foreach($data['grades'] as $grade)
                                <option value="{{$grade->id}}" >{{$grade['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputPassword4">{{__('Classroom')}} {{__('(Optional)')}}</label><br>
                        @error('classroom_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="classroom_id" class="custom-select">
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputPassword4">{{__('Section')}} {{__('(Optional)')}}</label><br>
                        @error('section_id')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="section_id" class="custom-select">
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">{{__('Religion')}}</label><br>
                        @error('date_of_birth')<span class="error text-danger">{{ $message }}</span>@enderror
                        <select name="religion_id" class="custom-select">
                            <option value="" selected disabled>{{__('Choose Religion')}}</option>
                            @foreach($data['religions'] as $religion)
                                <option value="{{$religion->id}}" >{{$religion['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">{{__('Date of birth')}}</label><br>
                        @error('date_of_birth')<span class="error text-danger">{{ $message }}</span>@enderror
                        <input class="form-control" type="text"  id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-row">
                    <label for="inputState">{{__('Address')}}</label>
                    @error('address')<span class="error text-danger"><br>{{ $message }}</span>@enderror
                    <input class="form-control" type="text"  name="address">
                </div><br>
            </div>
            <div class="col">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">{{__('Gender')}}</label><br>
                        @error('gender')<span class="error text-danger">{{ $message }}<br></span>@enderror
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">{{__('Male')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">{{__('Female')}}</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">{{__('Attachments')}}  {{__('(Optional)')}}</label><br>
                        @error('photos')<span class="error text-danger">{{ $message }}</span>@enderror
                        <input name="photos[]" type="file" accept="image/*" multiple >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="entry_status" type="checkbox" value="1" id="flexCheckChecked" checked>
            <label class="form-check-label" for="flexCheckChecked">{{__('Noob')}}</label>
        </div><br>

        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('Submit')}}</button>
        <a href="{{route('Students.index')}}" class="btn btn-danger" type="button">{{__('Back')}}</a>
    </form>
@endsection






