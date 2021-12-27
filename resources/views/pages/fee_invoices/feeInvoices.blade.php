@extends('layouts.master')
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
{{--                        <a href="{{route('Fees.show',$feeInvoice->id)}}" class="btn btn-warning" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>--}}


                        <a href="{{route('FeesInvoices.edit',$feeInvoice->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>


                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$feeInvoice->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>


                        <form action="{{route('FeesInvoices.destroy',$feeInvoice->id)}}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                            <div class="modal fade" id="exampleModal{{$feeInvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>{{__('Warning')}}:{{__('Are you sure you want to delete the invoice?')}}</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>

                                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
