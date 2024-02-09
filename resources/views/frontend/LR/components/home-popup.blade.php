@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

<div class="home-popup-inner">
    <div class="modal-header" style="border:0; flex-direction: row-reverse;">
        <button type="button" class="close closePopup close-home-popup p-0 p-md-3 p-lg-3 pr-1 pr-md-3 pr-lg-3" aria-label="Close">
            <span aria-hidden="true" class="text-light">×</span>
        </button>
    </div>
    <div class="d-flex col-12 homepopup-info p-0">
        <div class="">
            <img src="{{asset('/LR/images/ihfc-home-popup.jpg')}}" class="img-fluid">
        </div>
    </div>
</div>