@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
<div class="header-area header-area--default">
    <header class="header-area header_absolute header_height-90 header-sticky">
        <div class="container-fluid menu-container">
            <div class="row align-items-center">
                <!-- <div class="col-lg-2 col-md-2 col-sm-12 d-none d-md-block">-->
                <div class="col-lg-2 col-md-2 col-sm-2 d-md-block">
                    <div class="logo text-md-left">
                        <a href="/" class="img-fluid"><img src="{{asset($basicSettings -> logo_dark)}}" alt=""></a>
                    </div>
                </div>
                @include('frontend.'.$active_theme -> theme_abrv.'.components.menu')

                <div class="col-lg-4 col-md-5  col-sm-10">
                    <div class="header-right-side text-right mobile-serch-box">
                        <div class="header-left-search" id="search_text_container">
                            <div class="header-search-box">
                                <input type="text" name="searchText" class="search-field" id="formGroupExampleInput" placeholder="Search" value="">
                                <button class="search_text_button search-icon"><i class="icon-magnifier"></i></button>
                            </div>
                        </div>
                        <div class="header-right-items mobile-hide">
                            @if(!Auth::user())
                            <span> <a href="{{route('auth.register')}}"> Become a Partner</a></span>
                            @endif
                            <span class="container-checker" id="cart-parent">
                                @include('frontend.'.$active_theme -> theme_abrv.'.components.quick-cart')
                            </span>
                            <span class="container-checker" id="profile-parent">
                                @include('frontend.'.$active_theme -> theme_abrv.'.components.profile')
                            </span>
                        </div>
                    </div>
                    <div class="mobile-menu">
                        <a href="#" class="mobile-navigation-icon" id="mobile-menu-trigger"> <i class="icon-menu"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="cartoverlay"> </div>
