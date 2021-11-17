@extends('layouts.master')

@section('title')
    {{__('teachers.add_teachers')}}
@stop


@section('content')

    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('teachers.email')}}</label>
                <input name="email" type="email" class="form-control" id="inputEmail4" >
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('teachers.password')}}</label>
                <input name="password" type="password" class="form-control" id="inputPassword4" >
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">{{__('teachers.teacher_name_ar')}}</label>
                <input name="teacher_name_ar" type="email" class="form-control" id="inputEmail4" >
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">{{__('teachers.teacher_name_en')}}</label>
                <input name="teacher_name_en" type="password" class="form-control" id="inputPassword4" >
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{__('teachers.address')}}</label>
                <input name="address" type="text" class="form-control" id="inputCity">
            </div>

            <div class="form-group col-md-3">
                <label for="inputState">{{__('teachers.specialization')}}</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    @foreach($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization->name_ar}}</option>
                    @endforeach

                </select>
            </div>



            <div class="form-group col-md-3">
                <label for="inputZip">{{__('teachers.joining_date')}}</label>
                <input class="form-control" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd"  required>
            </div>

        </div>



        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1">{{__('teachers.male')}}</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2">{{__('teachers.submit')}}</label>
        </div>
        <br>
        <br>
        <button style="background: #72ab2a;color: white" type="submit" class="btn">{{__('teachers.submit')}}</button>
    </form>


@endsection
