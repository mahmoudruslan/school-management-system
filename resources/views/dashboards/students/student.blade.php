@extends('layouts.master')
@section('sidebar')
            <div class="scrollbar side-menu-bg">

                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{__('Grades')}}</span></div>
                            <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades.index')}}">{{__('List of grades')}}</a></li>

                        </ul>
                    </li>
                   <!-- classes-->
                   <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                        <div class="pull-left"><i class="fa fa-building"></i><span
                                class="right-nav-text">{{__('Classrooms')}}</span></div>
                        <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('Classrooms.index')}}">{{__('Classrooms List')}}</a></li>
                    </ul>
                </li>

                <!-- sections-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                        <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                                class="right-nav-text">{{__('Sections')}}</span></div>
                        <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('Sections.index')}}">{{__('Sections List')}}</a></li>
                    </ul>
                </li>

                <!-- students-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{__('Students')}}<div class="pull-right"><i class="fas fa-chevron-down"></i></div><div class="clearfix"></div></a>
                    <ul id="students-menu" class="collapse">
                        <li> <a href="{{route('Students.index')}}">{{__('Students List')}}</a></li>
                        <li> <a href="{{route('Students.create')}}">{{__('Add Student')}}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                        <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{__('Attendance')}}</span></div>
                        <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('Attendances.indexx',$teacher_id = 2)}}">{{__('Student absence detection')}}</a> </li>
                        <li> <a href="{{route('Attendances.showLayout',$teacher_id = 2)}}">{{__('Absence Recording')}}</a> </li>
                    </ul>
                </li>
                <!-- Subjects-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects-icon">
                        <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{__('Subjects')}}</span></div>
                        <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Subjects-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('Subjects.index')}}">{{__('Subjects')}}</a> </li>
                        <li> <a href="{{route('Subjects.create')}}">{{__('Add Subjects')}}</a> </li>
                    </ul>
                </li>

                <!-- Books-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Books-icon">
                        <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{__('Books')}}</span></div>
                        <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Books-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('books.index')}}">{{__('Books')}}</a> </li>
                        <li> <a href="{{route('books.create')}}">{{__('Add book')}}</a> </li>

                    </ul>
                </li>
            </ul>
        </div>
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> لوحة تحكم الطلاب</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
            </ol>
        </div>
    </div>
</div><br>
@endsection