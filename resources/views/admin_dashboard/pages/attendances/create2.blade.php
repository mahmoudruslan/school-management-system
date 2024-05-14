@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Absence Recording')}}
@stop

@section('content')

    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    @php
        $lang = app()->getLocale();
    @endphp

    <ul style="list-style: none;color:#3f51b5;font-size: 14px">
        <li>{{__('today\'s date')}} : {{ date('Y-m-d') }}</li>
        <li>{{__('Grade')}} : {{$students->first()->grades['name_'.$lang]??''}}</li>
        <li>{{__('Classroom')}} : {{$students->first()->classrooms['name_'.$lang]??''}}</li>
        <li>{{__('Section')}} : {{$students->first()->sections['name_'.$lang]??''}}</li>
    </ul><br>
    <form method="post" action="{{ route('attendances.store') }}">

        @csrf
        <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                style="text-align: center">
                <thead>
                <tr>
                    <th class="alert-success">#</th>
                    <th class="alert-success">{{__('Name') }}</th>
                    <th class="alert-success">{{__('Email') }}</th>
                    <th class="alert-success">{{__('Gender') }}</th>
                    <th class="alert-success">{{__('Processes') }}</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$loop->index + 1 }}</td>
                            <td>{{$student['name_'.$lang]}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{__($student->gender)}}</td>
                            <td>
                                <div class="form-check inline">
                                    <input class="form-check-input"
                                    @if ($attendances
                                    ->where('student_id', $student->id)
                                    ->where('admin_id', auth()->id())
                                    ->where('date', date('Y-m-d'))
                                    ->count() > 0)
                                        checked disabled
                                    @endif
                                    type="checkbox" value="0" name="status[{{$student->id}}]" id="flexCheckCheckedDisabled" >
                                    <label class="form-check-label text-danger" for="flexCheckCheckedDisabled">
                                        {{__('Absent')}}
                                    </label>
                                </div>
                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <button class="button" type="submit" >{{__('Submit')}}</button>
    </form><br>
@endsection
@section('js')

@endsection

