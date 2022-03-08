<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
        <meta name="author" content="potenzaglobalsolutions.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>my school</title>
        <!-- css -->
        <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <section class="height-100vh d-flex align-items-center page-section-ptb login"
                style="background-image: url('{{ asset('assets/images/sativa.png') }}');">
                <div class="container">
                    <div class="row justify-content-center no-gutters vertical-align">
                        <div class=" col-lg-5">
                            <div class="login-fancy pb-40 clearfix alert">
                                <a style="width: 49%" class="btn btn-default " title="طالب"
                                    href="{{ route('login.show', 'student') }}">
                                    <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{ __('student') }}
                                    </h3>
                                    <img alt="user-img" width="98%;" src="{{ URL::asset('assets/images/student.png') }}">
                                </a>
                                <a style="width: 49%" class="btn btn-default " title="ادمن"
                                    href="{{ route('login.show', 'admin') }}">
                                    <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{ __('employee') }}
                                    </h3>
                                    <img alt="user-img" width="98%;" src="{{ URL::asset('assets/images/admin.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
