@extends('student_dashboard.layout.master')
@section('title')
    {{__('Subjects List')}}
@stop

@section('content')
    <div class="table-responsive">
        <table  class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr class="alert-success" id="myUL">
                <th>#</th>
                <th>{{__("Subject Name")}}</th>
                <th>{{__("Degree")}}({{__('for two terms')}})</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$subject['name_'.app()->getLocale()]}}</td>
                    <td>{{$subject->degree}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection