@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Teachers/Admins') }}
@stop


@section('content')

    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    @php
        $lang = app()->getLocale();
    @endphp
    <!-- end error messages -->
    <a href="{{ route('admins.create') }}" type="button" class="button x-small">
        {{ __('Add Teachers/Admins') }}
    </a>
    <br><br>
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Gender') }}</th>
                    <th>{{ __('Specialization') }}</th>
                    <th>{{ __('Joining Date') }}</th>
                    <th>{{ __('Permission') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $admin['name_' . $lang] }}</td>
                        <td>{{ __($admin->gender) }}</td>
                        <td>{{ $admin->specializations['name_' . $lang] }}</td>
                        <td>{{ $admin->joining_date }}</td>
                        <td>{{ $admin->roles['name_' . $lang] }}</td>
                        <td>{{ $admin->address }}</td>
                        <td>
                            <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger"
                                data-target="#delete{{ $admin->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a class="btn btn-info" type="button" href="{{ route('admins.edit', $admin->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-warning" href="{{ route('admins.show', $admin->id) }}">
                                <i class="far fa-eye"></i>&nbsp;
                            </a>
                        </td>
                    </tr>
                    @include('admin_dashboard.pages.admins.delete')
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
