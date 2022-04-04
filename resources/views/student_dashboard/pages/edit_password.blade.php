@extends('student_dashboard.layout.master')
@section('title')
{{__('Edit password')}}
@endsection
@section('content')


    @if (Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

<form action="{{route('edit.password')}}" method="POST">
    @csrf
    @method('patch')
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">{{__('Email')}}</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->email}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">{{__('Current Password')}}</label>
      <div class="col-sm-10">
        @error('curent_password')<div class="text-danger">{{ $message }}</div>@enderror
        <input type="password" name="curent_password" class="form-control @error('curent_password') is-invalid @enderror" placeholder="{{__('Current Password')}}">
      </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">{{__('New Password')}}</label>
        <div class="col-sm-10">
            @error('new_password')<div class="text-danger">{{ $message }}</div>@enderror
          <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="{{__('New Password')}}">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">{{__('Confirm Password')}}</label>
        <div class="col-sm-10">
            @error('confirm_password')<div class="text-danger">{{ $message }}</div>@enderror
          <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="{{__('Confirm Password')}}">
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </div>
      </div>

  </form>
@endsection
