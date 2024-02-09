@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title',$main_collection['Description'])
@section('content')
<div class="wrapper">
    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
    <main class="main-content">

        <section class="inner-banner our-story">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center" style="margin-bottom: 5px;">
                            <h1 class="section-title--one section-title--center" style="font-size:2em">{{$main_collection['Description']}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="banner-preduct-wrapper landing-wrap">
            <div class="container-fluid">
                <div class="row row--6">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="d-flex justify-content-center d-flex justify-content-center mb-xl-5 mt-xl-5 loader-section">
                            <div class="spinner-grow" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="row d-none" data-masonry='{"percentPosition": true }'>
                            @foreach($favourites['Favourities'] as $favs)
                            <div class="card">
                                <div class="banner-product-image">
                                    <a href="{{$favs['LinkUrl']}}">
                                        <img src="{{CommonController::getApiFullImage($favs['Image'])}}" onerror="{{url('/').'/images/placeholder-full.jpg'}}" />
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="product-banner-title">
                                        <h3> <a href="{{$favs['LinkUrl']}}"> {{$favs['Title']}} </a> </h3>
                                        <a href="{{$favs['LinkUrl']}}" class="text-btn-normal font-weight--reguler font-lg-p" tabindex="0">Shop Now <i class="icon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .row .card{
            width: 50%;
        }
        @media (max-width:520px) {
            .row .card{
                width: 100%;
            }
        }
    </style>

    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection
