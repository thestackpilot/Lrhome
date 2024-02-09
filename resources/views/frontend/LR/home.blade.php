@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Home')
@section('content')
@include('frontend.'.$active_theme -> theme_abrv.'.components.header')

<div class="site-wrapper-reveal">
    <div class="hero-box-area mt-md-0 ">
        <div class="home-row hp-video" style="background-image: url({{$pages -> home -> sections -> banner -> image}}) !important;">
            <div class="hpmt-video-text">
                <div class="hpmt-video-text-content">
                    <h2 class="title">{{$pages -> home -> sections -> banner -> caption_1}}</h2>
                    <a href="{{$pages -> home -> sections -> banner -> url}}" class="cta-btn" target="_blank">{{$pages -> home -> sections -> banner -> caption_2}}</a>
                    <a href="https://lrhome.us/images-bkp/LR_Home_Retail_Partner_Appreciation_Promotion_FINAL_Oct_2_2022_v2.pdf" class="" target="_blank" style="font-size: 12px;text-decoration: underline;font-weight: bold;">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-wrapper section-space--ptb_60">
        <div class="container-fluid">
            <div class="set-lr-pad">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-20">
                            <h2 class="section-title--one section-title--center">{{$pages -> home -> sections -> key_categories -> title}}</h2>
                        </div>
                    </div>
                </div>
                <div class="product-main-content">
                    <div class="row product-slider-active">
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_1_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_1_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_1_title}}">
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_1_url}}">{{$pages -> home -> sections -> key_categories -> image_1_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_2_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_2_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_2_title}}"> </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_2_url}}">{{$pages -> home -> sections -> key_categories -> image_2_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_3_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_3_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_3_title}}"> </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_3_url}}">{{$pages -> home -> sections -> key_categories -> image_3_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_4_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_4_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_4_title}}">
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_4_url}}">{{$pages -> home -> sections -> key_categories -> image_4_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_5_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_5_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_5_title}}"> </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_5_url}}">{{$pages -> home -> sections -> key_categories -> image_5_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="{{$pages -> home -> sections -> key_categories -> image_6_url}}" class="product-thumbnail"> <img src="{{$pages -> home -> sections -> key_categories -> image_6_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> key_categories -> image_6_title}}"> </a>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="{{$pages -> home -> sections -> key_categories -> image_6_url}}">{{$pages -> home -> sections -> key_categories -> image_6_title}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($pages -> home -> sections -> new_arrivals -> is_active) && $pages -> home -> sections -> new_arrivals -> is_active)
    <div class="product-wrapper section-space--ptb_60" style="padding-top:0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="section-title--one section-title--center">{{$pages -> home -> sections -> new_arrivals -> title}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="set-lr-pad">
                <div class="featuted-product-wrap">
                    <div class="row align-items-center featuted-product-one">
                        <div class="col-lg-6 col-md-6 order-md-1 order-1" style="padding-right:0px">
                            <a href="{{$pages -> home -> sections -> new_arrivals -> image_1_url}}" class="fetaure-ancher"><img src="{{$pages -> home -> sections -> new_arrivals -> image_1_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> new_arrivals -> image_1_title}}"></a>
                        </div>
                        <div class="col-lg-6 col-md-6 order-md-2 order-2">
                            <div class="featured-product-contect text-center">
                                <h2 class="section-title--one"><a href="{{$pages -> home -> sections -> new_arrivals -> image_1_url}}">{{$pages -> home -> sections -> new_arrivals -> image_1_title}}</a></h2>
                                <p class="mt-30 key-p">{{$pages -> home -> sections -> new_arrivals -> image_1_caption}}</p>
                                <div class="button-box section-space--mt_20"> <a href="{{$pages -> home -> sections -> new_arrivals -> image_1_url}}" class="btn btn--md btn--border_1 d-inline">Shop Now <i class="icon-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="featuted-product-wrap">
                    <div class="row align-items-center featuted-product-one">
                        <div class="col-lg-6 col-md-6 order-md-2 order-1" style="padding-left:0px">
                            <a href="{{$pages -> home -> sections -> new_arrivals -> image_2_url}}" class="fetaure-ancher">
                                <img src="{{$pages -> home -> sections -> new_arrivals -> image_2_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> new_arrivals -> image_2_title}}">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 order-md-1 order-2">
                            <div class="featured-product-contect text-center">
                                <h2 class="section-title--one"><a href="{{$pages -> home -> sections -> new_arrivals -> image_2_url}}">{{$pages -> home -> sections -> new_arrivals -> image_2_title}}</a></h2>
                                <p class="mt-30 key-p">{{$pages -> home -> sections -> new_arrivals -> image_2_caption}}</p>
                                <div class="button-box section-space--mt_20"> <a href="{{$pages -> home -> sections -> new_arrivals -> image_2_url}}" class="btn btn--md btn--border_1 d-inline">Shop Now <i class="icon-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="featuted-product-wrap">
                    <div class="row align-items-center featuted-product-one">
                        <div class="col-lg-6 col-md-6 order-md-1 order-1" style="padding-right:0px">
                            <a href="{{$pages -> home -> sections -> new_arrivals -> image_3_url}}" class="fetaure-ancher"><img src="{{$pages -> home -> sections -> new_arrivals -> image_3_image}}" class="img-fluid" alt="{{$pages -> home -> sections -> new_arrivals -> image_3_title}}"></a>
                        </div>
                        <div class="col-lg-6 col-md-6  order-md-2 order-2">
                            <div class="featured-product-contect text-center">
                                <h2 class="section-title--one"><a href="{{$pages -> home -> sections -> new_arrivals -> image_3_url}}">{{$pages -> home -> sections -> new_arrivals -> image_3_title}}</a></h2>
                                <p class="mt-30 key-p">{{$pages -> home -> sections -> new_arrivals -> image_3_caption}}</p>
                                <div class="button-box section-space--mt_20"> <a href="{{$pages -> home -> sections -> new_arrivals -> image_3_url}}" class="btn btn--md btn--border_1 d-inline">Shop Now <i class="icon-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="offer-colection-area container-fluid">
        <div class="text-center catalog" style="background-image: url({{$pages -> home -> sections -> catalog -> catalog_img}}) !important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="catalog-txt">
                        <h3>{{$pages -> home -> sections -> catalog -> caption}}</h3>
                        <h2> {{$pages -> home -> sections -> catalog -> title}}</h2>
                        <a href="/catalogs" >{{$pages -> home -> sections -> catalog -> button_text}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-blog-area inner-become">
        <div class="container-fluid">
            <div class="partner-apply grey-row" id="partner-apply">
                <div class="wrap">
                    <div class="section-title"><span>{{$pages -> home -> sections -> partnership -> title}}</span></div>
                    <div class="content">
                        <div class="actions-toolbar">
                            <div class="primary darkbtn">
                                <div class="button-box "> <a href="{{$pages -> home -> sections -> partnership -> button_url}}" class="btn btn--md btn--border_1 d-inline">{{$pages -> home -> sections -> partnership -> button_text}} <i class="icon-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @if(!isset($_COOKIE['homepage_popup'])) --}}
    {{-- <div class="home-popup position-fixed">
            <div class="overlay-home-popup"></div>
            <div class="position-absolute home-popup-main">
                @include('frontend.'.$active_theme -> theme_abrv.'.components.home-popup')
            </div>
        </div> --}}
    {{-- @endif --}}
    
</div>
@include('frontend.'.$active_theme -> theme_abrv.'.components.footer')

<style>
    .slick-slide {
        height: auto !important;
    }
</style>
@endsection

@section('scripts')
<script>
    $('.product-slider-active').slick({
        dots: false,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
        prevArrow: '<i class="icon-arrow-left arrow-prv"></i>',
        nextArrow: '<i class="icon-arrow-right arrow-next"></i>',
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 762,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            }
        }]
    });
</script>
@endsection
