@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Fee billing list')}}
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
                <th>#</th>
                <th>{{__("Student Name")}}</th>
                <th>{{__("Date")}}</th>
                <th>{{__("Fee Name")}}</th>
                <th>{{__("Amount")}}</th>
                <th>{{__("Description")}}</th>
                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($feeInvoices as $feeInvoice)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$feeInvoice->students['name_'.app()->getLocale()]}}</td>
                    <td>{{$feeInvoice->date}}</td>
                    <td>{{$feeInvoice->fees['name_'.app()->getLocale()]}}</td>
                    <td>{{$feeInvoice->fees->amount}}</td>
                    <td>{{$feeInvoice->description}}</td>
                    <td>
                        <a href="{{route('feesInvoices.edit',$feeInvoice->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$feeInvoice->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('admin_dashboard.pages.fee_invoices.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@stop
