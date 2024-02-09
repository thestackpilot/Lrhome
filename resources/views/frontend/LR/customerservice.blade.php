@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Customer Service')
@section('content')
    <div class="wrapper">
        @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
        <main class="main-content">
            <section class="about-rizzyhome pb-0">
                <div class="container">
                    <h1 class="section-title text-center mb-5">Coming Soon</h1>
                </div>
            </section>
        </main>
        @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
    </div>
@endsection
