@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<div class="d-flex flex-row flex-wrap dashboardHead">
    <div class="container d-flex header mt-3 align-items-center only-for-mobile">
        <div class="this-is-main">
            <div id="nav-sidebar-dashboard">
                <div class="bg-sidebar-dashboard"></div>
                <div class="button-sidebar-dashboard d-none" id="" tabindex="0">
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
</div>
@section('scripts')
@parent
<script>
    $(document).ready(function(){
        $('#mobile-menu-trigger').on('click', function () {
            $('#nav-sidebar-dashboard').addClass('focus-within');
            $('.bg-sidebar-dashboard').addClass('focus-within');
        });
        $("#mobile-menu-close-trigger").on('click', function () {
            $('#nav-sidebar-dashboard').removeClass('focus-within');
            $('.bg-sidebar-dashboard').removeClass('focus-within');
        });
    });
</script>
@endsection
