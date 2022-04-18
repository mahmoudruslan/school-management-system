<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->

        <div class="side-menu-fixed">

            <div class="scrollbar side-menu-bg">

                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{ __('Dashboard') }}</span>
                            </div>
                            <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('dashboard')}}">{{ __('Dashboard') }}</a> </li>

                        </ul>
                    </li>
                    @can('grades')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                                <div class="pull-left"><i class="ti-palette"></i><span
                                        class="right-nav-text">{{ __('Grades') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('grades.index') }}">{{ __('List of grades') }}</a></li>
                            </ul>
                        </li>
                    @endcan
                    <!-- classes-->
                    @can('classrooms')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                                <div class="pull-left"><i class="fa fa-building"></i><span
                                        class="right-nav-text">{{ __('Classrooms') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('classrooms.index') }}">{{ __('Classrooms List') }}</a></li>
                            </ul>
                        </li>
                    @endcan


                    <!-- sections-->
                    @can('sections')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                                        class="right-nav-text">{{ __('Sections') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('sections.index') }}">{{ __('Sections List') }}</a></li>
                                <li><a href="{{ route('sections.create') }}">{{ __('Add Section') }}</a></li>
                            </ul>
                        </li>
                    @endcan



                    <!-- students-->
                    @can('students')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i
                                    class="fas fa-user-graduate"></i>{{ __('Students') }}<div class="pull-right"><i
                                        class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="students-menu" class="collapse">
                                <li> <a href="{{ route('students.create') }}">{{ __('Add Student') }}</a></li>
                                <li> <a href="{{ route('students.index') }}">{{ __('All students') }}</a></li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Promotions-->
                    @can('promotions')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Promotions-menu">
                                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                        class="right-nav-text">{{ __('Promotions') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Promotions-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('promotions.index') }}">{{ __('Promotions List') }}</a> </li>
                                <li> <a href="{{ route('promotions.create') }}">{{ __('Add Promotion') }}</a></li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Graduations-->
                    @can('graduated')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduated-menu">
                                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                        class="right-nav-text">{{ __('Graduating students') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Graduated-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('graduated.index') }}">{{ __('Graduating students') }}</a>
                                </li>
                                <li> <a href="{{ route('graduated.create') }}">{{ __('Add to graduates') }}</a> </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Teachers-->
                    @can('teachers')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                        class="right-nav-text">{{ __('Teachers') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('teachers.index') }}">{{ __('List Teachers') }}</a> </li>
                                <li> <a href="{{ route('teachers.create') }}">{{ __('Add Teachers') }}</a> </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Parents-->
                    @can('parents')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                        class="right-nav-text">{{ __('Parents') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('parents.index') }}">{{ __('Parents List') }}</a> </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Accounts-->
                    @can('accounting')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                        class="right-nav-text">{{ __('Accounts') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('fees.index') }}">{{ __('Fees List') }}</a></li>
                                <li> <a href="{{ route('feesInvoices.index') }}">{{ __('Billing List') }}</a> </li>
                                <li> <a href="{{ route('studentReceipt.index') }}">{{ __('Arrest receipts') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('feeProcessing.index') }}">{{ __('Accounting treatments') }}</a>
                                </li>
                                <li> <a href="{{ route('payments.index') }}">{{ __('Payment List') }}</a> </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Attendance-->
                    @can('attendances')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                                        class="right-nav-text">{{ __('Attendance') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                                <li>
                                    <a href="{{ route('attendances.index') }}">{{ __('Student absence detection') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('attendances.create') }}">{{ __('Absence Recording') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- Subjects-->
                    @can('subjects')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects-icon">
                                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                                        class="right-nav-text">{{ __('Subjects') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Subjects-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('subjects.index') }}">{{ __('Subjects') }}</a> </li>
                                <li> <a href="{{ route('subjects.create') }}">{{ __('Add Subjects') }}</a> </li>
                            </ul>
                        </li>
                    @endcan


                    <!-- results-->
                    @can('results')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                                <div class="pull-left"><i class="fas fa-book-open"></i><span
                                        class="right-nav-text">{{ __('Results') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('results.index') }}">{{ __('Results List') }}</a> </li>
                                <li> <a href="{{ route('results.create') }}">{{ __('Add Results') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    <!-- books-->
                    @can('books')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Books-icon">
                                <div class="pull-left"><i class="fas fa-book-open"></i><span
                                        class="right-nav-text">{{ __('Books and exams timetable') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Books-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('books.index') }}">{{ __('Books') }}</a> </li>
                                <li> <a href="{{ route('books.create') }}">{{ __('Add book') }}</a> </li>

                            </ul>
                        </li>
                    @endcan
                    <!-- roles-->
                    @can('roles')
                        <li>

                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#role-icon">
                                <div class="pull-left"><i class="fas fa-users"></i><span
                                        class="right-nav-text">{{ __('Roles') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="role-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('roles.index') }}">{{ __('Roles') }}</a> </li>
                                <li> <a href="{{ route('roles.create') }}">{{ __('Add roles') }}</a> </li>
                            </ul>
                        </li>
                    @endcan
                    <!-- Settings-->
                    @can('school_data')
                        <li>
                            <a href="{{ route('school_data.index') }}">
                                <i class="fas fa-cogs"></i><span
                                    class="right-nav-text">{{ __('school data') }}</span>
                            </a>
                        </li>
                    @endcan
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                        class="default-color">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">@yield("title")</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
