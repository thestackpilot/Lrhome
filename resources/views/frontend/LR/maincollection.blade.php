@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Main Categories')
@section('content')
    <div class="wrapper">
    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
        <main class="main-content">
            <section class="collection-section">
                <div class="container">
                    <div class="d-flex flex-row  flex-wrap all-cat-page my-5">
                        <div class="col-lg-12 mt-5">
                            <div class="section-title text-center mb-20">
                                <h2 class="section-title--one section-title--center">MAIN COLLECTIONS</h2>
                            </div>
                        </div>
                        @foreach($main_collections['MainCollections'] as $collection)
                        <div class="single-product-item text-center col-sm-12 col-md-3">
                            <figure class="products-images m-0">
                                <a href="{{ route('frontend.favourite' , $collection['MainCollectionID'] ) }}">
                                    <img src="{{ CommonController::getApiFullImage($collection['ImageName'])}}" class="img-responsive" onerror="this.onerror=null; this.src='{{ url('/').ConstantsController::IMAGE_PLACEHOLDER }}'" />
                                </a>
                            </figure>
                            <div class="product-content">
                                <h6 class="prodect-title"> <a title="{{ $collection['Description'] }}" href="{{ route('frontend.favourite' , $collection['MainCollectionID'] ) }}"> {{ $collection['Description'] }} </a> </h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </section>
        </main>
    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
    </div>
@endsection

