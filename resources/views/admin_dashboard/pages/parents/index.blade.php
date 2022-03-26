@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Parents List') }}
@stop
@section('content')

    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <!-- end error messages -->

    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr class="alert-success">
                    <th>#</th>
                    <th>{{ __("Father's Name") }}</th>
                    <th>{{ __("Mother's Name") }}</th>
                    <th>{{ __("Father's Nationality") }}</th>
                    <th>{{ __("Father's Phone") }}</th>
                    <th>{{ __("Father's National Id") }}</th>
                    <th>{{ __("Mother's National Id") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parents as $parent)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $parent['father_name_' . app()->getLocale()] }}</td>
                        <td>{{ $parent['mother_name_' . app()->getLocale()] }}</td>
                        <td>{{ $parent->nationality['name_' . app()->getLocale()] }}</td>
                        <td>{{ $parent->father_phone }}</td>
                        <td>{{ $parent->father_nationality_id }}</td>
                        <td>{{ $parent->mother_national_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
