
@php
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Catalogs')
@section('content')
    <div class="wrapper">
        @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
        <main class="main-content">
            <section class="about-lrhome pb-0">
                <div class="product-wrapper section-space--ptb_60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center mb-50">
                                    <h2 class="section-title--one section-title--center">Catalogs</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center align-items-start">
                            @if(count($catalog_meta) && $catalog_meta)
                                @foreach($catalog_meta as $meta)
                                <div class="col-12 col-md-4">
                                    <div class="row align-items-center featuted-product-wrap py-3 pb-5 catalog-wrap">
                                        <div class="col-lg-12 col-md-12">
                                            <a href="{{$meta['catalog_pdf']}}" class="catalog-section fetaure-ancher text-center" target="_blank">
                                                <img src="{{asset($meta['image'])}}" class="img-fluid" alt="{{ $meta['title'] }}">
                                            </a>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="featured-product-contect text-center">
                                                <h2 class="section-title--one pt-3">
                                                    <a href="{{$meta['catalog_pdf']}}" target="_blank">{{ $meta['title'] }}</a>
                                                </h2>
                                                <p>{{$meta['caption']}}</p>
                                                {{-- <div class="button-box section-space--mt_20">
                                                    <a href="{{$meta['catalog_pdf']}}" class="btn btn--md btn--border_1" target="_blank">View<i class="icon-arrow-right"></i></a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <h1 class="section-title mb-md-5 font-ropa col-md-12">NO ACTIVE CATALOG FOUND.</h1>
                            @endif
                        </div>
                    </div>
                   
            </section>
        </main>
        @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
    </div>
@endsection