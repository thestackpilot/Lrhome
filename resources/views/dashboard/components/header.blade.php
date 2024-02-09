@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
@if($active_theme_json->general->use_theme_header)
@include('frontend.'.$active_theme->theme_abrv.'.components.header')
@include('dashboard.components.mobile-header')
@else
<header class="d-flex flex-row flex-wrap dashboardHead">
    <div class="container d-flex header mt-3 align-items-center only-for-desktop">
        <div class="col-6 col-xs-4 col-sm-3 col-md-4">
            <address>{{$basicSettings -> address}}</address>
        </div>
        <div class="col-6 col-xs-2 col-sm-2 col-md-3 text-center">
            <a href="{{route('frontend.home')}}" class="logo">
                <img src="{{ asset($basicSettings -> logo_dark) }}" alt="{{$basicSettings -> name}}" />
            </a>
        </div>
        <div class="col-6 col-xs-4 col-sm-2 col-md-4 text-right infoS">
            <a href="mailto:{{$basicSettings -> email}}">{{$basicSettings -> email}}</a>
            <a href="tel:{{$basicSettings -> contact}}">{{$basicSettings -> contact}}</a>
            <a href="//{{$basicSettings -> website}}" class="link">{{$basicSettings -> website}}</a>
        </div>
        <div class="col-6 col-xs-2 col-sm-2 col-md-1 dropdown no-arrow text-center" >
            <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="ture" > 
                <img class="img-profile rounded-circle"
                    src="{{asset('/Admin/images/undraw_profile.svg')}}" width="40px" height="40px" >
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-center">
                    <span> {{Auth::user()->firstname}} {{Auth::user()->lastname}} - {{Auth::user()->customer_id}} </span>
                </a>
            </div>
        </div>
    </div>

    <div class="container d-flex header mt-3 align-items-center only-for-mobile">
        <div class="mbl-dropdown-info">
            <i class="bi bi-info-circle-fill mbl-dropbtn-info"></i>
            <div class="mbl-dropdown-content-info">
                <a href="#0"> <address>{{$basicSettings -> address}}</address></a>
                <a href="mailto:{{$basicSettings -> email}}">{{$basicSettings -> email}}</a>
                <a href="tel:{{$basicSettings -> contact}}">{{$basicSettings -> contact}}</a>
                <a href="//{{$basicSettings -> website}}" class="link">{{$basicSettings -> website}}</a>
            </div>
        </div>
        <div class="col-6 col-xs-2 col-sm-2 col-md-2 text-center">
            <a href="{{route('frontend.home')}}" class="logo">
                <img src="{{ asset($basicSettings -> logo_dark) }}" alt="{{$basicSettings -> name}}" />
            </a>
        </div>
        <div class="this-is-main">
            <div id="nav-sidebar-dashboard">
                <div class="bg-sidebar-dashboard"></div>
                <div class="button-sidebar-dashboard" id="dashboard-head-menu-btn" tabindex="0">
                    <i class="bi bi-list icon-bar-sb-db"></i>
                </div>
                <div id="nav-content-sb-db" tabindex="0">
                    <div class="mobile-menu-close-box text-right">
                        <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"> 
                            <i class="bi bi-x-lg"></i>
                        </span> 
                    </div>
                    <div class="main-item-nav-sb-db">
                        <nav class="offcanvas-navigation-sb-db">
                            <ul class="nav-items-sb-db">
                                @foreach($sidebar as $item)
                                @if($item['permission'] && strcmp(ConstantsController::USER_ROLES['staff'], Auth::user()->role) === 0 && !in_array($item['permission'], Auth::user()->getPermissions())) {{''}}
                                @else
                                <li> <a href="{{route($item['slug'])}}" class="{{ str_contains(url()->current(),route($item['slug']))  ?'active': '' }}"> {{$item['label']}} </a></li>
                                @endif
                                @endforeach
                                <li> <a href="{{route('auth.logout')}}" class=""> Logout </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endif
@section('scripts')
@parent
<script>
    $(document).ready(function(){
        $('#dashboard-head-menu-btn').on('click', function () {
            $('#nav-sidebar-dashboard').addClass('focus-within');
            $('.bg-sidebar-dashboard').addClass('focus-within');
        });
        $("#mobile-menu-close-trigger").on('click', function () {
            $('#nav-sidebar-dashboard').removeClass('focus-within');
            $('.bg-sidebar-dashboard').removeClass('focus-within');
        });
        $("#userDropdown").on("click", function(e)
        {
            e.stopPropagation();
            $(".dropdown").toggleClass("show","hide");
            $(".dropdown-menu").toggleClass("show","hide");
        });
        $(document).click(function(){
            $(".dropdown").removeClass("show");
            $(".dropdown-menu").removeClass("show");
        });
    });
</script>
@endsection
