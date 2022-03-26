<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->

        <div class="side-menu-fixed">

            <div class="scrollbar side-menu-bg">

                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    <!-- Subjects-->
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
                    


                    <!-- Exams-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                                <div class="pull-left"><i class="fas fa-book-open"></i><span
                                        class="right-nav-text">{{ __('Results') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('results.index1') }}">{{ __('Results List') }}</a> </li>
                                <li> <a
                                        href="{{ route('results.create1', $teacher_id = 2) }}">{{ __('Add Results') }}</a>
                                </li>
                            </ul>
                        </li>



                    <!-- Onlinec lasses-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Books-icon">
                                <div class="pull-left"><i class="fas fa-book-open"></i><span
                                        class="right-nav-text">{{ __('Books') }}</span></div>
                                <div class="pull-right"><i class="fas fa-chevron-down"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Books-icon" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{ route('books.index') }}">{{ __('Books') }}</a> </li>
                                <li> <a href="{{ route('books.create') }}">{{ __('Add book') }}</a> </li>

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
