@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Show Rooms')
@section('content')
    <div class="wrapper">
        @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
        <main class="main-content">
            <section class="about-lrhome pb-0">
                <div class="container">
                    <h1 class="section-title text-center mb-5">ShowRooms Coming Soon</h1>
            </section>
        </main>
        @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
    </div>
@endsection
@section('scripts')
    <style>
        .grid-item {
            width: 25%;
        }

        .grid-item--width2 {
            width: 50%;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="assets/js/popper.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{url('/')}}/js/main.js"></script>
    <script>
        $( document ).ready(function() {
            $('#InputPassword, ConfirmInputPassword').on('keyup', function () {
                if ($('#password').val() == $('#ConfirmInputPassword').val()) {
                    $('#message').html('Matching').css('color', 'green');
                } else
                    $('#message').html('Not Matching').css('color', 'red');
            });
        });
    </script>
@endsection
