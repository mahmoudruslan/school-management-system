@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Edit Result')}}
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
                    <form method="post" action="{{route('results.update', $result->id)}}">
                        @csrf
                        {{method_field('patch')}}
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('Student Name')}} : <span
                                    class="text-danger">*</span>
                                </label><br>
                                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="text" readonly value="{{$result->students['name_' . app()->getLocale()]}}" name="student_id" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{__('Degree')}} : <span
                                        class="text-danger">*</span></label><br>
                                @error('degree') <span class="error text-danger">{{ $message }}</span> @enderror
                                <input type="number" value="{{$result->degree}}" name="degree" class="form-control">
                            </div>
                        </div><br>


                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('results.index1')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
