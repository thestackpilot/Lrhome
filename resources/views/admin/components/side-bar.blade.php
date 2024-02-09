@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="">
            <img src="{{ asset($basicSettings -> logo_light) }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'">
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
    @if ( isset( $_GET['secret'] ) && $_GET['secret'] == md5( ConstantsController::ADMIN_SECRET_STRING ) )
    <li class="nav-item {{ url()->current() == route('admin.themes') ? 'active' :'' }}">
        <a class="nav-link" href="{{route('admin.themes')}}">
            <i class="fas fa-fw fa-images"></i>
            <span>Themes</span>
        </a>
    </li>
    @endif
    <li class="nav-item {{ url()->current() == route('admin.basic_settings') ? 'active' :'' }}">
        <a class="nav-link" href="{{route('admin.basic_settings')}}">
            <i class="fas fa-cogs"></i>
            <span>Basic Settings</span>
        </a>
    </li>
    <li class="nav-item {{ url()->current() == route('admin.orders') ? 'active' :'' }}">
        <a class="nav-link" href="{{route('admin.orders')}}">
            <i class="fas fa-luggage-cart"></i>
            <span>Orders</span>
        </a>
    </li>
    @if ( env( 'APP_URL', '' ) !== 'http://staging.lrhome.us/' )
    <li class="nav-item {{ url()->current() == route('admin.cache-management') ? 'active' :'' }}">
        <a class="nav-link" href="{{route('admin.cache-management')}}">
            <i class="fas fa-archive"></i>
            <span>Cache Management</span>
        </a>
    </li>
    @endif
    @if ( strpos(env( 'APP_URL', '' ), 'lrhome') < 0 )
    <li class="nav-item {{ url()->current() == route('admin.dealer-registrations') ? 'active' :'' }}">
        <a class="nav-link" href="{{route('admin.dealer-registrations')}}">
            <i class="fas fa-user"></i>
            <span>Dealership Requests</span>
        </a>
    </li>
    @endif
    @if(isset($menus))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseMenus" aria-expanded="false" aria-controls="collapseMenus">
            <i class="fas fa-list"></i>
            <span>Menus</span>
        </a>
        <div id="collapseMenus" class="collapse" aria-labelledby="headingMenus" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($menus as $menu)
                <a class="collapse-item {{ str_contains(url()->current(),route('admin.menu',['menu_id' => $menu->id])) ?'active': '' }}" href="{{route('admin.menu',['menu_id' => $menu->id])}}"> {{ucfirst($menu->name)}} </a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($maincollections['MainCollections']))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseFavourites" aria-expanded="false" aria-controls="collapseFavourites">
            <i class="fas fa-list"></i>
            <span>Favourite Pages</span>
        </a>
        <div id="collapseFavourites" class="collapse" aria-labelledby="headingFavourites" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($maincollections['MainCollections'] as $maincollection)
                <a class="collapse-item" href="{{ route('admin.favourite',[$maincollection['MainCollectionID']]) }}"> {{ucfirst($maincollection['Description'])}} </a>
                @endforeach
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCollections" aria-expanded="false" aria-controls="collapseCollections">
            <i class="fas fa-list"></i>
            <span>Collection Pages</span>
        </a>
        <div id="collapseCollections" class="collapse" aria-labelledby="headingCollections" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($maincollections['MainCollections'] as $maincollection)
                <a class="collapse-item" href="{{ route('admin.collections',[$maincollection['MainCollectionID']]) }}"> {{ucfirst($maincollection['Description'])}} </a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($sliders))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseSliders" aria-expanded="false" aria-controls="collapseSliders">
            <i class="fas fa-fw fa-images"></i>
            <span>Sliders</span>
        </a>

        <div id="collapseSliders" class="collapse" aria-labelledby="headingSliders" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($sliders as $slider)
                <a class="collapse-item {{ str_contains(url()->current(),route('admin.slider',[$slider->id])) ?'active': '' }}" href="{{route('admin.slider',[$slider->id])}}"> {{ucfirst($slider->name)}} </a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($showrooms))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseShowrooms" aria-expanded="false" aria-controls="collapseShowrooms">
            <i class="fas fa-fw fa-images"></i>
            <span>Showrooms</span>
        </a>

        <div id="collapseShowrooms" class="collapse" aria-labelledby="headingShowrooms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($showrooms as $showroom)
                <a class="collapse-item {{ str_contains(url()->current(),route('admin.showroom',[$showroom->id])) ?'active': '' }}" href="{{route('admin.showroom',[$showroom->id])}}"> {{ucfirst($showroom->name)}} </a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($catalogs))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCatalogs" aria-expanded="false" aria-controls="collapseCatalogs">
            <i class="fas fa-fw fa-images"></i>
            <span>Catalogs</span>
        </a>

        <div id="collapseCatalogs" class="collapse" aria-labelledby="headingCatalogs" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($catalogs as $catalog)
                <a class="collapse-item {{ str_contains(url()->current(),route('admin.catalog',[$catalog->id])) ?'active': '' }}" href="{{route('admin.catalog',[$catalog->id])}}"> {{ucfirst($catalog->name)}} </a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($pages))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <i class="fas fa-globe"></i>
            <span>Pages</span>
        </a>

        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($pages as $page)
                <a class="collapse-item {{ url()->current() ==  route('admin.page_setting',['id' => $page->id]) ? 'active' : ''  }}" href="{{route('admin.page_setting',['id' => $page->id])}}">{{ ucfirst($page->name) }}</a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @if(isset($forms))
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseForms" aria-expanded="false" aria-controls="collapseForms">
            <i class="fas fa-file"></i>
            <span>Form Enquiries</span>
        </a>

        <div id="collapseForms" class="collapse" aria-labelledby="headingForms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($forms as $form)
                <a class="collapse-item {{ url()->current() ==  route('admin.forms',['slug' => $form->slug]) ? 'active' : ''  }}" href="{{route('admin.forms',['slug' => $form->slug])}}">{{ ucfirst($form->name) }}</a>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
