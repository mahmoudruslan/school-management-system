@extends('admin_dashboard.layout.master')
@section('title')
    {{__('List of receipts')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th class="alert-danger">#</th>
                <th class="alert-danger">{{__("Student Name")}}</th>
                <th class="alert-danger">{{__("Amount")}}</th>
                <th class="alert-danger">{{__("Date")}}</th>
                <th class="alert-danger">{{__("Description")}}</th>
                <th class="pl-5 pr-4 alert-danger">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($receipts as $receipt)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$receipt->students['name_'.app()->getLocale()]}}</td>
                    <td>{{$receipt->debit}}</td>
                    <td>{{$receipt->date}}</td>
                    <td>{{$receipt->description}}</td>
                    <td>
                        <a href="{{route('studentReceipt.edit',$receipt->id)}}" class="btn btn-info btn-sm" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$receipt->id}}"  class="btn btn-danger btn-sm" type="button">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('admin_dashboard.pages.student_receipt.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@stop
