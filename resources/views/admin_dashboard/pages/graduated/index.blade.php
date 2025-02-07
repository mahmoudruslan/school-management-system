@extends('admin_dashboard.layout.master')
@section('title')
    {{ __('Graduation List') }}
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
    <button type="button" class="btn btn-danger" id="btn_delete_all">
        <i class="fas fa-check-square"></i>
    </button><span class="p-2">{{ __('Permanent delete') }}</span><br><br>

    <button type="button" class="btn btn-info" id="btn_return_all">
        <i class="fas fa-check-square"></i>
    </button><span class="p-2">{{ __('Return') }}</span><br><br>

    <button type="button" class="btn btn-primary" id="checked_all">
        <i class="fas fa-check-square"></i>
    </button><span class="p-2">{{ __('Select all') }}</span><br><br>
    {{-- myTable --}}
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr id="myUL">
                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Gender') }}</th>
                    <th>{{ __('Grade') }}</th>
                    <th>{{ __('Classroom') }}</th>
                    <th>{{ __('Section') }}</th>
                    <th class="pl-5 pr-4">{{ __('Processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <input type="checkbox" class="mr-4" value="{{ $student->id }}">{{ $loop->index + 1 }}
                        </td>
                        <td>{{ $student['name_' . $lang] }}</td>
                        <td>{{ __($student->gender) }}</td>
                        <td>{{ $student->grade['name_' . $lang] ?? '' }}</td>
                        <td>{{ $student->classroom['name_' . $lang] ?? '' }}</td>
                        <td>{{ $student->section['name_' . $lang] ?? '' }}</td>
                        <td>
                            <a href="{{ route('graduated.show', $student->id) }}" class="btn btn-warning" role="button"
                                aria-pressed="true">
                                <i class="far fa-eye"></i>
                            </a>
                            <!-- return student  -->

                            <button type="submit" data-toggle="modal" data-target="#return_all{{ $student->id }}"
                                class="btn btn-info">
                                {{ __('Return the student') }}
                            </button>
                            <!-- delete student  -->

                            <button style="color: white" data-toggle="modal" data-target="#exampleModal{{ $student->id }}"
                                class="btn btn-danger" type="button">
                                {{ __('Permanent delete') }}
                            </button>

                        </td>
                    </tr>
                    @include('admin_dashboard.pages.graduated.delete')
                    @include('admin_dashboard.pages.graduated.return-student')
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
