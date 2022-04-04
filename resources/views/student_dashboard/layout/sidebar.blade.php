<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->

        <div class="side-menu-fixed">

            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- show data-->
                    <li>
                        <a href="{{ route('student.data') }}">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text">{{ __('Personal Data') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- show data-->
                    <li>
                        <a href="{{ route('student.results') }}">
                            <div class="pull-left"><i class="fa fa-edit"></i><span
                                    class="right-nav-text">{{ __('Results') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- Courses-->
                    <li>
                        <a href="{{ route('student.courses') }}">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span
                                    class="right-nav-text">{{ __('Courses') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- sFees-->
                    <li>
                        <a href="{{ route('student.fees') }}">
                            <div class="pull-left"><i class="fa fa-dollar"></i><span
                                    class="right-nav-text">{{ __('Fees') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- Exams Table-->
                    <li>
                        <a href="{{ route('exams.table') }}">
                            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                                    class="right-nav-text">{{ __('Exams Table') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- Absence-->
                    <li>
                        <a href="{{ route('student.absence') }}">
                            <div class="pull-left"><i class="far fa-eye"></i><span
                                    class="right-nav-text">{{ __('Absence') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <!-- Books-->
                    <li>
                        <a href="{{ route('student.books') }}">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span
                                    class="right-nav-text">{{ __('Books and exams timetable') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <!-- change Password-->
                    <li>
                        <a href="{{ route('student.settings') }}">
                            <div class="pull-left"><i class="fas fa-cogs"></i><span
                                    class="right-nav-text">{{ __('change Password') }}</span></div>
                            <div class="clearfix"></div>
                        </a>
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
