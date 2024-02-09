@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Error')
@section('content')
    <div class="wrapper">
        @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
        <main class="main-content">

            <section class="about-lrhome mt-130 pb-0 pt-10">
                <div class="container">
                    @if($error_code >= 400 && $error_code < 500 && \File::exists(public_path($active_theme -> theme_abrv.'/images/errors/400.svg')))
                    <div class="col-md-12 flex-column flex-sm-column mt-5 mb-5 d-flex align-items-center justify-content-between flex-dir-col" style="min-height: 10vh;">
                        <img src="{{asset($active_theme -> theme_abrv.'/images/errors/400.svg')}}" alt="{{$error_code}}" />
                    </div>
                    @elseif($error_code >= 500 && \File::exists(public_path($active_theme -> theme_abrv.'/images/errors/500.svg')))
                    <div class="col-md-12 flex-column flex-sm-column mt-5 mb-5 d-flex align-items-center justify-content-between flex-dir-col" style="min-height: 10vh;">
                        <img src="{{asset($active_theme -> theme_abrv.'/images/errors/400.svg')}}" alt="{{$error_code}}" />
                    </div>
                    @else
                    <h1 class="section-title text-center mb-5">{{$heading}}</h1>
                    <div class="col-md-12 flex-column flex-sm-column mt-5 mb-5 d-flex align-items-center justify-content-between flex-dir-col" style="min-height: 10vh;">
                        <p>
                            {!! $body !!}
                        </p>
                    </div>
                    @endif
                </div>
            </section>

        </main>
        @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
    </div>
@endsection
