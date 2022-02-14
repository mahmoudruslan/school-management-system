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
    <?php $x = 0;?>
    <!-- end error messages -->

    <!-- teacher's grades -->
    
    <div class="accordion gray plus-icon round">
        
        @foreach ($uniqueGradeId as $sectionGrade)
        
            <div class="acd-group">
                <a href="#" class="acd-heading">{{$sectionGrade->grades['name_'.app()->getLocale()]}}</a>
                <div class="acd-des">
                    <!-- teacher's classrooms -->
                    @include('pages.attendances.teachers_classrooms')
                </div>
            </div>
        @endforeach
    </div>
@endsection
