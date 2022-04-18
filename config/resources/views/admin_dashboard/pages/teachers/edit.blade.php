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
        <input type="hidden" value="{{$admin->id}}" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Email')}}</label><br>
                @error('email')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->email}}" name="email" type="email" class="form-control" id="inputEmail4" >
            </div>



            <div class="form-group col-md-6">
                <label for="inputZip">{{__('Joining Date')}}</label><br>
                @error('joining_date')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->teacher->joining_date}}" class="form-control" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('Teacher Name_ar')}}</label><br>
                @error('name_ar')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->name_ar}}" name="name_ar" type="text" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('Teacher Name_en')}}</label><br>
                @error('name_en')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->name_en}}" name="name_en" type="text" class="form-control">
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{__('Address')}}</label><br>
                @error('address')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->teacher->address}}" name="address" type="text" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">{{__('phone number')}}</label><br>
                @error('phone')<span class="error text-danger">{{ $message }}</span>@enderror
                <input value="{{$admin->teacher->phone}}" name="phone" type="number" class="form-control">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">

                <label for="inputState">{{__('Specialization')}}</label><br>
                <select name="specialization_id" class="custom-select">

                    <option value="{{$admin->teacher->specialization_id}}">{{$admin->teacher->specializations['name_'.app()->getLocale()]}}
                    </option>
                    @foreach($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputState">{{__('Roles')}}</label><br>
                <select name="role_id" class="custom-select">
                    <option value="{{$admin->role_id}}">{{$admin->roles['name_'.app()->getLocale()]}}
                    </option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
        </div>
    </div>
        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('Submit')}}</button>
        <a href="{{route('teachers.index')}}" class="btn btn-danger" type="button">{{__('Back')}}</a>
    </form>
@endsection
