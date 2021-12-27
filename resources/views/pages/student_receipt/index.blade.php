@extends('layouts.master')
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
                    <td>{{$receipt->description}}</td>
                    <td>

                        <a href="{{route('StudentReceipt.edit',$receipt->id)}}" class="btn btn-info btn-sm" >
                            <i class="fa fa-edit"></i>
                        </a>

                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$receipt->id}}"  class="btn btn-danger btn-sm" type="button">
                            <i class="fa fa-trash"></i>
                        </button>


                        <form action="{{route('StudentReceipt.destroy',$receipt->id)}}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                            <div class="modal fade" id="exampleModal{{$receipt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>{{__('Warning')}}:{{__('Are you sure you want to delete the arrest receipt?')}}</h6>
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
