@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Out Story')
@section('content')
<div class="wrapper">
    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
    
<section class="inner-banner our-story">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="section-title text-center" style="margin-bottom: 5px;">
            <h2 class="section-title--one section-title--center">OUR STORY</h2>
            </div>
            <h1>Growth Beyond Belief</h1>
        </div>
        </div>
    </div>
    </section>
    <div class="site-wrapper-reveal  our-story">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-justify order-md-1 order-2">
              {!!$pages -> about_us -> sections -> about_us_items -> about_us_description_1!!}
            </div>
            <div class="col-lg-6 col-md-6  col-sm-12 order-md-2 order-1"> 
              <!-- <img src="https://lrhome.us/media/images/rug-makker2.jpg" class="catlog">  -->
              <img src="{{$pages -> about_us -> sections -> about_us_items -> about_us_image_1}}" class="catlog" />
            </div>
          </div>
        </div>
        <section class="about-story">
          <div class="container">
            <div class="row align-items-center" style="margin-top: 10px;">
              <div class="col-lg-6 col-md-6  col-sm-12"> 
                <!-- <img src="https://lrhome.us/media/images/rug-makker3.jpg" class="catlog">  -->
                <img src="{{$pages -> about_us -> sections -> about_us_items -> about_us_image_2}}" class="catlog" />
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-justify">
                {!!$pages -> about_us -> sections -> about_us_items -> about_us_description_2!!}
              </div>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-justify order-md-1 order-2">
                {!!$pages -> about_us -> sections -> about_us_items -> about_us_description_3!!}
              </div>
              <div class="col-lg-6 col-md-6  col-sm-12 order-md-2 order-1"> 
                <!-- <img src="https://lrhome.us/media/images/rug-makker4.jpg" class="catlog">  -->
                <img src="{{$pages -> about_us -> sections -> about_us_items -> about_us_image_3}}" class="catlog" />
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="our-blog-area inner-become">
        <div class="container-fluid">
          <div class="partner-apply grey-row" id="partner-apply">
            <div class="wrap">
              <div class="section-title"><span>apply to become a LR HOME partner</span></div>
              <div class="content"> 
                <!-- <p>Sign up to place orders and see pricing</p>-->
                <div class="actions-toolbar">
                  <div class="primary darkbtn">
                    <div class="button-box "> <a href="{{route('auth.register')}}" class="btn btn--md btn--border_1 d-inline">Apply Now <i class="icon-arrow-right"></i></a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection

