<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>برنامج مورا سوفت لادارة المدارس</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <!--=================================
preloader -->

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        <!--=================================
preloader -->

        <!--=================================
login-->
        <section style="background-color: #9e9e9e1f"
            class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url('{{ asset('assets/images/sativa.png') }}');">
            <div class="container">

                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 bg-white">
                        
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">
                                {{ __('Reset password') }}</h3>
                                @if (Session::has('error'))
                                <div class="text-danger">{{ Session::get('error') }}</div>
                            @endif
                            <form method="POST" action="{{ route('reset.password') }}">
                                @csrf
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">{{ __('Email') }}*</label>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        autofocus>
                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">{{ __("Father's National Id") }}*</label>
                                    @error('father_national_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input name="father_national_id" type="number"
                                        class="form-control @error('father_national_id') is-invalid @enderror">


                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">{{ __('New Password') }} * </label>
                                    @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="password" name="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror">
                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">{{ __('Confirm Password') }} *
                                    </label>
                                    @error('confirm_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="password" name="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror">
                                </div>
                                <button class="button"><span>{{ __('Login') }}</span><i
                                        class="fa fa-check"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
login-->

    </div>
    <!--start toastr pakage -->
    @toastr_js
    <!--end toastr pakage -->

    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>

    <!-- chart -->
    <script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
    <!-- calendar -->
    <script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
    <!-- charts sparkline -->
    <script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
    <!-- charts morris -->
    <script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
    <!-- toastr -->
    @yield('js')
    <script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
    <!-- validation -->
    <script src="{{ URL::asset('assets/js/validation.js') }}"></script>
    <!-- lobilist -->
    <script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
