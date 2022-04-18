@extends('admin_dashboard.layout.master')
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
                        <div class="dropdown show">
                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('Processes')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('feesInvoices.show',$student->id)}}">
                                    <i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;{{__('Add a fee invoice')}}&nbsp;
                                </a>
                                <a class="dropdown-item" href="{{route('studentReceipt.show',$student->id)}}"><i style="color: #1e7e34" class="fas fa-dollar-sign"></i>&nbsp; &nbsp;{{__('Catch Receipt')}}</a>
                                <a class="dropdown-item" href="{{route('feeProcessing.show',$student->id)}}"><i style="color: #1e7e34" class="fad fa-money-check-edit-alt"></i>&nbsp; &nbsp;{{__('Fee exclusion')}}</a>
                                <a class="dropdown-item" href="{{route('payments.show',$student->id)}}"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp;{{__('Receipt')}}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
