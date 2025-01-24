@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

<div class="col-lg-6 col-md-5 header-menu navbar-show justify-content-lg-end align-items-center">
    <ul class="menu text-left mb-0" style="float: unset;">
        <li class="parant"> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_1_url}}" class="main-item">{{$pages -> all_pages -> sections -> main_top_menu -> menu_1_caption}} <i class="icon-chevron-down"></i></a>
            <div class="drop-down-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> rug_header -> name }} </h5>
                            @foreach($menus -> rug_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        @foreach($menus -> rug_shop_header -> metas as $meta)
                        <div class="col-md-3">
                            <a class="menu-img-box" href="{{ $meta -> meta_url }}"><img src="{{$meta -> meta_image}}" class="img-fluid" alt="Featured Image">
                                <div><span>{{$meta -> meta_title}} </span></div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
        <li class="parant"> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_2_url}}" class="main-item">{{$pages -> all_pages -> sections -> main_top_menu -> menu_2_caption}} <i class="icon-chevron-down"></i></a>
            <div class="drop-down-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> pillow_header -> name }} </h5>
                            @foreach($menus -> pillow_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> pet_header -> name }} </h5>
                            @foreach($menus -> pet_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        @foreach($menus -> pillow_shop_header -> metas as $meta)
                        <div class="col-md-3">
                            <a class="menu-img-box" href="{{ $meta -> meta_url }}"><img src="{{$meta -> meta_image}}" class="img-fluid" alt="Featured Image">
                                <div><span>{{$meta -> meta_title}} </span></div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
        <li class="parant"> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_3_url}}" class="main-item">{{$pages -> all_pages -> sections -> main_top_menu -> menu_3_caption}} <i class="icon-chevron-down"></i></a>
            <div class="drop-down-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> furniture_header -> name }} </h5>
                            @foreach($menus -> furniture_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> dining_header -> name }} </h5>
                            @foreach($menus -> dining_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        @foreach($menus -> furniture_shop_header -> metas as $meta)
                        <div class="col-md-3">
                            <a class="menu-img-box" href="{{ $meta -> meta_url }}"><img src="{{$meta -> meta_image}}" class="img-fluid" alt="Featured Image">
                                <div><span>{{$meta -> meta_title}} </span></div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
        <li class="parant"> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_4_url}}" class="main-item">{{$pages -> all_pages -> sections -> main_top_menu -> menu_4_caption}} <i class="icon-chevron-down"></i></a>
            <div class="drop-down-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 sub-menu-item">
                            <h5>{{ $menus -> outdoor_header -> name }} </h5>
                            @foreach($menus -> outdoor_header -> metas as $meta)
                                <a href="{{ $meta -> meta_url }}">{{ $meta -> meta_title }}</a>
                            @endforeach
                        </div>

                        @foreach($menus -> outdoor_shop_header -> metas as $meta)
                        <div class="col-md-3">
                            <a class="menu-img-box" href="{{ $meta -> meta_url }}"><img src="{{$meta -> meta_image}}" class="img-fluid" alt="Featured Image">
                                <div><span>{{$meta -> meta_title}} </span></div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
        <li class="parant"> <a href="{{$pages -> all_pages -> sections -> main_top_menu -> menu_5_url}}" class="main-item">{{$pages -> all_pages -> sections -> main_top_menu -> menu_5_caption}} <i class="icon-chevron-down"></i></a>
            <div class="drop-down-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"> </div>
                        @foreach($menus -> aboutus_header -> metas as $meta)
                        <div class="col-md-4">
                            <a class="menu-img-box" href="{{ $meta -> meta_url }}"><img src="{{$meta -> meta_image}}" class="img-fluid" alt="Featured Image">
                                <div><span>{{$meta -> meta_title}} </span></div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
