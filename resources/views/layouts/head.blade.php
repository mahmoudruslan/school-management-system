<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
        <meta name="author" content="potenzaglobalsolutions.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Title -->
        <title>
            @yield("title")
        </title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

        <!-- Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">



        @yield('css')
        <!--- Style css -->
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
        {{-- form wizard --}}
        @livewireStyles
        <link href="{{ URL::asset('multiform.css') }}" rel="stylesheet" id="bootstrap-css">

        {{-- form wizard --}}

        <!--- Style css -->
        @if (App::getLocale() == 'en')
            <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
        @else
            <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
        @endif
    </head>
<body>
    <div class="wrapper"  style="font-family: 'Cairo', sans-serif">

        <!--================================= loading  =========================================== -->

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

<!--start toastr pakage -->
{{-- alrt error messages --}}
                @jquery
                @toastr_js
                @toastr_render
<!--end toastr pakage -->

