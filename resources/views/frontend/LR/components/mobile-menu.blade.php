@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
        <div class="mobile-menu-overlay__inner">
            <div class="mobile-menu-close-box text-right"> <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"> <i class="icon-cross2"></i></span> </div>
            <div class="mobile-menu-overlay__body">
                <nav class="offcanvas-navigation">
                    <ul>
                        <li class="has-children">
                            <a class="nav-link" href="#">
                                {{$pages -> all_pages -> sections -> main_top_menu -> menu_1_caption}}
                            </a>
                            <ul class="sub-menu">
                                <li> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_1_url}}">VIEW ALL</a></li>
                                @foreach($menus -> rug_header -> metas as $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-children">
                            <a class="nav-link" href="#">
                                {{$pages -> all_pages -> sections -> main_top_menu -> menu_2_caption}}
                            </a>
                            <ul class="sub-menu">
                                <li> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_2_url}}"> VIEW ALL</a></li>
                                <li>
                                    <a href="#">
                                        <h3 style="font-weight: 600;font-size: 17px;">{{ $menus -> pillow_header -> name }}</h3>
                                    </a>
                                </li>
                                @foreach($menus -> pillow_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach

                                <li>
                                    <a href="#">
                                        <h3 style="font-weight: 600;font-size: 17px;">{{ $menus -> pet_header -> name }}</h3>
                                    </a>
                                </li>
                                @foreach($menus -> pet_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-children"> <a class="nav-link" href="#">{{$pages -> all_pages -> sections -> main_top_menu -> menu_3_caption}}</a>
                            <ul class="sub-menu">
                                <li> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_3_url}}"> VIEW ALL</a></li>
                                <li>
                                    <a href="#">
                                        <h3 style="font-weight: 600;font-size: 17px;">{{ $menus -> furniture_header -> name }}</h3>
                                    </a>
                                </li>
                                @foreach($menus -> furniture_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="#">
                                        <h3 style="font-weight: 600;font-size: 17px;">{{ $menus -> dining_header -> name }}</h3>
                                    </a>
                                </li>
                                @foreach($menus -> dining_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="has-children"> <a class="nav-link" href="#">{{$pages -> all_pages -> sections -> main_top_menu -> menu_4_caption}}</a>
                            <ul class="sub-menu">
                                <li> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_4_url}}"> VIEW ALL</a></li>
                                @foreach($menus -> outdoor_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-children"> <a class="nav-link" href="#">{{$pages -> all_pages -> sections -> main_top_menu -> menu_5_caption}}</a>
                            <ul class="sub-menu">
                                @foreach($menus -> aboutus_header -> metas as $k => $meta)
                                    <li>
                                        <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-children">
                            @if(!Auth::user())
                            <a class="nav-link" href="{{route('auth.register')}}"> Become a Partner</a>
                            @endif
                        </li>
                        <li class="has-children mb-icons ">
                            <span class="container-checker" id="cart-parent">
                                <a href="{{route('frontend.checkout')}}">
                                    <i class="headericons icon-cart quickCart-opener position-relative">
                                        @auth()
                                        <span class="badge badge-pill badge-primary position-absolute cartCount">{{$cart -> cart_count}}</span>
                                        @endauth
                                    </i>
                                </a>
                            </span>
                            <span class="container-checker" id="profile-parent">
                                <a href="{{route('dashboard')}}"><i class="headericons icon-user"></i></a>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
