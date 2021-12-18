@extends('layouts.master')

@section('title')

    <style>



        .ui-widgets {
            display: inline-block;
            width: 10rem;
            height: 10rem;
            border-radius: 50%;
            margin-right: 11%;
            margin-left: 11%;
            margin-top: 100px;
            border: 10px solid #f84904;
            box-shadow: inset 0 0 7px grey;
        }

        .ui-widgets:nth-child(1) {
            border-right-color: #ffffff;

        }
        .ui-widgets:nth-child(2) {
            border-top-color:#ffffff ;
        }
        .ui-widgets:nth-child(3) {

            border-left-color: #ffffff;
        }
        .text {
            text-align: center;
            display: inline-block;
            width: 10rem;
            height: 10rem;
            margin-right: 11%;
            margin-left: 11%;
            margin-top: 20px;
        }

    </style>
@stop


@section('content')
    <div class="container-cirkle">
        <div class="ui-widgets"></div>
        <div class="ui-widgets"></div>
        <div class="ui-widgets"></div>

        <div class="text">kora</div>
        <div class="text">ahmed</div>
        <div class="text">mahmoud</div>
    </div>


@endsection

