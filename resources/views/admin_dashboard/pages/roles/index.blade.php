@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Roles List')}}
@stop

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <a href="{{route('roles.create')}}" type="button" class="button x-small" >
        {{ __('Add roles') }}
    </a><br><br>


    {{-- myTable --}}
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr id="myUL">
                <th>#</th>
                <th>{{__("Role name")}}</th>
                <th>{{__("Permissions")}}</th>

                <th class="pl-5 pr-4">{{__("Processes")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$role['name_'.app()->getLocale()]}}</td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            {{__($permission)}},
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$role->id}}"  class="btn btn-danger" type="button" >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @include('admin_dashboard.pages.roles.delete')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
