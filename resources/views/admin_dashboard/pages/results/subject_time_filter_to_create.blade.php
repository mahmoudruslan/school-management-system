@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Add Results') }}
@stop

@section('content')

    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <!-- end error messages -->
    {{-- @if (!$students->isEmpty()) --}}
        <ul style="list-style: none;color:#3f51b5;font-size: 14px">
            <li>{{ __('today\'s date') }} : {{ date('Y-m-d') }}</li>
            <li>{{ __('Grade') }} : {{ $grade['name_' . app()->getLocale()] }}</li>
            <li>{{ __('Classroom') }} : {{ $classroom['name_' . app()->getLocale()] }}</li>
        </ul><br>
        <form method="post" action="{{ route('results.giving.degrees') }}">
            @csrf
            <div class="table-responsive">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputState">{{ __('Subject') }} : <span class="text-danger">*</span></label><br>
                        @error('subject_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="custom-select mr-sm-2" name="subject_id">
                            <option selected disabled>{{ __('Choose Subject') }}...</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject['name_' . app()->getLocale()] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="Classroom_id">{{ __('Academic Year') }}: <span class="text-danger">*</span></label><br>
                        @error('academic_year')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="custom-select mr-sm-2" name="academic_year">
                            <option selected disabled>{{ __('Choose Academic year') }}...</option>
                            <option value="{{ date('Y') - 2 . '-' . date('Y') - 1 }}">
                                {{ date('Y') - 2 . '-' . date('Y') - 1 }}</option>
                            <option value="{{ date('Y') - 1 . '-' . date('Y') }}">{{ date('Y') - 1 . '-' . date('Y') }}
                            </option>
                            <option value="{{ date('Y') . '-' . date('Y') + 1 }}">{{ date('Y') . '-' . date('Y') + 1 }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="section_id">{{ __('Term') }} : <span class="text-danger">*</span></label><br>
                        @error('term')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select name="term" class="custom-select">
                            <option selected disabled>{{ __('Choose term') }}...</option>
                            <option value="1">{{ __('First semester') }}</option>
                            <option value="2">{{ __('Second semester') }}</option>
                        </select>
                    </div>
                    <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                </div>
                <br><br>
            </div><br><br>
            <button class="button" type="submit">{{ __('Show students') }}</button>
        </form>
    {{-- @else
        <div class="alert alert-danger" role="alert">
            {{ __('There are no students') }}
        </div>
    @endif --}}
@endsection
