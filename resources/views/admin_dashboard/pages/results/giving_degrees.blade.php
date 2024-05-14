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

    <ul style="list-style: none;color:#3f51b5;font-size: 14px">
        <li>{{ __('Academic Year') }} : {{ $data['academic_year'] }}</li>
        <li>{{ __('Subject') }} : {{ $data['subject']['name_' . app()->getLocale()]}}</li>
        <li>{{ __('Grade') }} : {{ $data['grade']['name_' . app()->getLocale()]}}</li>
        <li>{{ __('Classroom') }} : {{ $data['classroom']['name_' . app()->getLocale()]}}</li>
        <li>{{ __('Term') }} : {{ $data['term']}}</li>
    </ul><br>
    <form method="post" action="{{ route('results.store') }}">
        @csrf
        <input type="hidden" name="grade_id" value="{{ $data['grade']['id'] }}">
                    <input type="hidden" name="classroom_id" value="{{ $data['classroom']['id'] }}">
                    <input type="hidden" name="subject_id" value="{{ $data['subject']['id'] }}">
                    <input type="hidden" name="term" value="{{ $data['term'] }}">
                    <input type="hidden" name="academic_year" value="{{ $data['academic_year'] }}">
        <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                style="text-align: center">
                <thead>
                    <tr>
                        <th class="alert-success">#</th>
                        <th class="alert-success">{{ __('Name') }}</th>
                        <th class="alert-success">{{ __('Degree') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $student['name_' . app()->getLocale()] }}</td>
                            <td>
                                <div class="form-check inline">
                                    @if (!$student->results->count() > 0)
                                        
                                    <input style="width: 10%" type="number" name="degree[{{$student->id}}]" >
                                    @else
                                    {{$student->results->first()->degree}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>{{__('There are no students')}}</tr>
                    @endforelse
                </tbody>
            </table>
        </div><br><br>
        <button class="button" type="submit">{{ __('Submit') }}</button>
    </form>
@endsection