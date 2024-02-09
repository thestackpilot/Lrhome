@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center text-sm-left">
                        <h2 class="breadcrumb-title">
                            @php
                            $i = 0;
                            $numItems = count($breadcrumbs);
                            @endphp
                            <ul class="breadcrumb-list">
                                @foreach ($breadcrumbs as $key => $value)
                                <li class="breadcrumb-item">
                                    <a href="{{$value}}">{{$key}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-6"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="bottom-line" />