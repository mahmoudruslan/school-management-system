@extends('admin_dashboard.layout.master')

@section('title')
    {{__('Edit Teachers')}}
@stop


@section('content')

    {{-- start show validation error --}}
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    {{-- end show validation error --}}
    <form action="{{route('teachers.update','test')}}" method="POST">
        {{method_field('patch')}}
        @csrf
        <input type="hidden" value="{{$teacher->id}}" name="id">
        <input type="hidden" value="{{$teacher->admin->id}}" name="admin_id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Email')}}</label><br>
                @error('email')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->admin->email}}" name="email" type="email" class="form-control" id="inputEmail4" >
            </div>



            <div class="form-group col-md-6">
                <label for="inputZip">{{__('Joining Date')}}</label><br>
                @error('joining_date')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->joining_date}}" class="form-control" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Teacher Name_ar')}}</label><br>
                @error('name_ar')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->admin->name_ar}}" name="name_ar" type="text" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('Teacher Name_en')}}</label><br>
                @error('name_en')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->admin->name_en}}" name="name_en" type="text" class="form-control">
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{__('Address')}}</label><br>
                @error('address')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->address}}" name="address" type="text" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputState">{{__('Specialization')}}</label><br>
                <select name="specialization_id" class="custom-select">

                    <option value="{{$teacher->specialization_id}}">{{$teacher->specializations['name_'.app()->getLocale()]}}
                    </option>
                    @foreach($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{__('phone number')}}</label><br>
                @error('phone')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$teacher->phone}}" name="phone" type="number" class="form-control">
            </div>

            {{-- <div class="form-group col-md-6">
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

            </div> --}}

        </div>








        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('Submit')}}</button>
        <a href="{{route('teachers.index')}}" class="btn btn-danger" type="button">{{__('Back')}}</a>
    </form>
@endsection
