@extends('layouts.master')

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

    <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
    <h5 style="font-family: 'Cairo', sans-serif;color: red">{{$students->first()->grades['name_'.app()->getLocale()]}}</h5>
    <h5 style="font-family: 'Cairo', sans-serif;color: red">{{$students->first()->classrooms['name_'.app()->getLocale()]}}</h5>
    <h5 style="font-family: 'Cairo', sans-serif;color: red">{{$students->first()->sections['name_'.app()->getLocale()]}}</h5>

    <form method="post" action="{{ route('Attendances.store') }}">

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
                            <td>{{$student['name_'.app()->getLocale()]}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{__($student->gender)}}</td>
                            <td>
                                <div class="form-check inline">
                                    <input class="form-check-input" type="checkbox" value="0" name="status[{{$student->id}}]" id="flexCheckCheckedDisabled" 
                                    @foreach($attendances as $attendance)
                                        @if($attendance->date == substr($attendance->date, 0, 2).date('y-m-d') && $attendance->student_id == $student->id && $attendance->status == 0)
                                            disabled checked
                                        @endif
                                    @endforeach
                                    >
                                    <label class="form-check-label text-danger" for="flexCheckCheckedDisabled">
                                        {{__('Absent')}}
                                    </label>
                                </div>
                                    
                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                                <input type="hidden" name="teacher_id" value="{{$teacher_id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <P>
            <button class="button"  type="submit" >{{__('Submit') }}</button>
        </P>
    </form><br>
@endsection

