@extends('admin_dashboard.layout.master')

@section('title')
    {{__('Edit invoice')}}
@stop
@section('content')

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form  action="{{ route('feesInvoices.update',$feesInvoice->id) }}" method="POST">
                        {{method_field('patch')}}
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="Name" class="mr-sm-2">{{__("Student Name")}}</label>
                                <input class="form-control" readonly value="{{$student['name_'.app()->getLocale()]}}">
                            </div>
                            <div class="form-group col">
                                <label for="fee_id" class="mr-sm-2">{{__("Fee type")}}</label>
                                <select class="form-control p-0 h-73" name="fee_id" required>
{{--                                    <option selected disabled>{{$feesInvoice->fees['name_'.app()->getLocale()]}}</option>--}}
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}">{{$fee['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label for="description" class="mr-sm-2">{{__("Description")}}</label>
                            <input type="text" class="form-control" name="description" value="{{$feesInvoice->description}}">
                        </div>
                        <br><br>

                        <button type="submit" class="button">{{__("Submit")}}</button>
                        <a href="{{route('feesInvoices.index')}}" class="btn btn-secondary">{{__("Back")}}</a>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
