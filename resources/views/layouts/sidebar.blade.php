<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{__('Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="index.html">{{__('Dashboard')}} 01</a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{__('Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
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
                                class="right-nav-text">{{__('classes')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('Classrooms.index')}}">{{__('List_classes')}}</a></li>
                    </ul>
                </li>


                <!-- sections-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                        <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                class="right-nav-text">{{__('sections')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('Sections.index')}}">{{__('List_sections')}}</a></li>
                    </ul>
                </li>


                <!-- students-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{__('students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="students-menu" class="collapse">
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{__('Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>--}}
{{--                            <ul id="Student_information" class="collapse">--}}
                        <li> <a href="{{route('Students.index')}}">{{__('list students')}}</a></li>

                        <li> <a href="{{route('Students.create')}}">{{__('add student')}}</a></li>
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{__('Students_Promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>--}}
{{--                            <ul id="Students_upgrade" class="collapse">--}}
{{--                                <li> <a href="{{route('Promotion.index')}}">{{__('add_Promotion')}}</a></li>--}}
{{--                                <li> <a href="{{route('Promotion.create')}}">{{__('list_Promotions')}}</a> </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{__('Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>--}}
{{--                            <ul id="Graduate students" class="collapse">--}}
{{--                                <li> <a href="{{route('Graduated.create')}}">{{__('add_Graduate')}}</a> </li>--}}
{{--                                <li> <a href="{{route('Graduated.index')}}">{{__('list_Graduate')}}</a> </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                    </ul>
                </li>



                <!-- Teachers-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                        <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                class="right-nav-text">{{__('Teachers')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('Teachers.index')}}">{{__('List_Teachers')}}</a> </li>
                    </ul>
                </li>


                <!-- Parents-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                        <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                class="right-nav-text">{{__('parents')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('Parents.index')}}">{{__('list_parents')}}</a> </li>

                    </ul>
                </li>

                <!-- Accounts-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                        <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                class="right-nav-text">{{__('Accounts')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{route('Fees.index')}}">الرسوم الدراسية</a> </li>
                        <li> <a href="calendar-list.html">List Calendar</a> </li>
                    </ul>
                </li>

                <!-- Attendance-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                        <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{__('Attendance')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>

                <!-- Exams-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                        <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{__('Exams')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>


                <!-- library-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                        <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{__('library')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>


                <!-- Onlinec lasses-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                        <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{__('Onlineclasses')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>


                <!-- Settings-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Settings-icon">
                        <div class="pull-left"><i class="fas fa-cogs"></i><span class="right-nav-text">{{__('Settings')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Settings-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>


                <!-- Users-->
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                        <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{__('Users')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                        <li> <a href="themify-icons.html">Themify icons</a> </li>
                        <li> <a href="weather-icon.html">Weather icons</a> </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>


    <!-- Left Sidebar End-->

    <!--================================= -->



                <div class="content-wrapper">
            <div class="page-title">



                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-0"> @yield("title")</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">@yield("title")</li>
                            </ol>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
