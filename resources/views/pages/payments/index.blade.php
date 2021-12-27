@extends('layouts.master')
@section('title')
    {{__('Payment List')}}
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
                <th class="alert-danger">{{__("Description")}}</th>
                <th class="pl-5 pr-4 alert-danger">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$payment->students['name_'.app()->getLocale()]}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->description}}</td>
                    <td>

                        <a href="{{route('Payments.edit',$payment->id)}}" class="btn btn-info btn-sm" >
                            <i class="fa fa-edit"></i>
                        </a>

                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$payment->id}}"  class="btn btn-danger btn-sm" type="button">
                            <i class="fa fa-trash"></i>
                        </button>


                        <form action="{{route('Payments.destroy',$payment->id)}}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                            <div class="modal fade" id="exampleModal{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>{{__('Warning')}}:{{__('Are you sure you want to delete the payment?')}}</h6>
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
