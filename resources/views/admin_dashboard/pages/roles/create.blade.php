@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Add roles')}}
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
                    <form method="post" action="{{route('roles.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState"><h6>{{__('Role Name_ar')}} : <span
                                    class="text-danger">*</span></h6>
                                </label><br>
                                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="name_en"><h6>{{__('Role Name_en')}} : <span
                                        class="text-danger">*</span></h6></label><br>
                                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div><br>


                        <div class="form-group col">
                            <div class=" col-md-12">
                                    @foreach(config('global.permissions') as $name => $value)
                                    <div class="mr-5 d-inline">
                                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$name}}" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                        {{$value}}
                                        </label>
                                    </div>
                                    @endforeach 
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('roles.index')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
