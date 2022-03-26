@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Results List')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif

    {{-- myTable --}}

        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Student Name")}}</th>
                <th>{{__("Subject Name")}}</th>
                <th>{{__("Degree")}}</th>
                <th>{{__("From")}}</th>
                <th>{{__("Term")}}</th>
                <th>{{__("Academic Year")}}</th>
                <th>{{__("Teacher Name")}}</th>

                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$result->students['name_'.app()->getLocale()]}}</td>
                    <td>{{$result->subjects['name_'.app()->getLocale()]}}</td>
                    <td>{{$result->degree}}</td>
                    <td>{{$result->from}}</td>
                    <td>{{__($result->term)}}</td>
                    <td>{{$result->academic_year}}</td>
                    <td>{{$result->teachers['name_'.app()->getLocale()]}}</td>
                    <td>
                        <a href="{{route('results.edit',$result->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$result->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('admin_dashboard.pages.results.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
