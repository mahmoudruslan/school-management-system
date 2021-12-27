@extends('layouts.master')
@section('title')
    {{__('Student fees')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->



    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Student Name")}}</th>
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$student['name_'.app()->getLocale()]}}</td>
                    <td>
{{--                        <a href="{{route('fees.fay')}}" class="btn btn-warning" role="button" aria-pressed="true">--}}
{{--                            {{__('Pay the fees')}}--}}
{{--                        </a>--}}

{{--                        <a href="{{route('fees.payments')}}" class="btn btn-info" >--}}
{{--                            {{__('View Payments')}}--}}
{{--                        </a>--}}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
