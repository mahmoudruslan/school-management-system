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

    <ul style="list-style: none;color:#3f51b5;font-size: 14px">
        <li>{{__('today\'s date')}} : {{ date('Y-m-d') }}</li>
        <li>{{__('Grade')}} : {{$students->first()->grades['name_'.app()->getLocale()]??''}}</li>
        <li>{{__('Classroom')}} : {{$students->first()->classrooms['name_'.app()->getLocale()]??''}}</li>
        <li>{{__('Section')}} : {{$students->first()->sections['name_'.app()->getLocale()]??''}}</li>
    </ul><br>
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
                                        @if(count($attendances->where('date',substr(now(), 0, 10))) > 0 && count($attendances->where('section_id',$section_id)) > 0)
                                            disabled 
                                        @endif
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
        @if(count($attendances->where('date',substr(now(), 0, 10))) > 0 && count($attendances->where('section_id',$section_id)) > 0)
            <button disabled class="btn btn-danger" type="submit" >{{__('Absence is recorded') }}</button>
        @else
            <button class="button" type="submit" >{{__('Submit')}}</button>
        @endif
    </form><br>
@endsection
@section('js')

@endsection

