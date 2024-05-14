@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Add fee invoices') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

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

                    <form class=" row mb-30" action="{{ route('feesInvoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="list_feesInvoices">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ __('Student Name') }}</label>
                                                <select class="fancyselect" name="student_id">
                                                    <option value="{{ $student->id }}">
                                                        {{ $student['name_' . $lang] }}</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                
                                                <label for="Name_en" class="mr-sm-2">{{ __('Fee type') }}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id">
                                                        <option value=""> -- {{ __('Choose from the list') }} -- </option>
                                                        @foreach ($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee['name_' . $lang] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('list_feesInvoices.*.fee_id')
                                                    <span class="error text-danger">{{ $message }}</span><br>
                                                @enderror 
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="description" class="mr-sm-2">{{ __('Description') }}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ __('Processes') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                    value="{{ __('Delete row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="btn btn-secondary" data-repeater-create type="button"
                                            value="{{ __('Add row') }}" />
                                    </div>
                                </div><br>
                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                <button type="submit" class="button">{{ __('Submit') }}</button>
                                <a href="{{ route('students.index') }}" class="btn btn-danger">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@stop
