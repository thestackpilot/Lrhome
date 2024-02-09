@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<footer>
    <div class="container">
        <div class="footer-bottom d-flex flex-row justify-content-between align-items-center mt-2 flex-md-row flex-sm-column flex-dir-col">
            <div class="col-md-3 col-sm-12">
                <small class="font-ropa">All Rights Reserved © {{date('Y')}}.</small>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3 col-sm-12">
                <div class="social-icons d-flex flex-row justify-content-lg-between">
                    <a href="{{$pages -> all_pages -> sections -> footer_social_media -> twitter_url}}"> <i class="bi bi-twitter"></i> </a>
                    <a href="{{$pages -> all_pages -> sections -> footer_social_media -> facebook_url}}"> <i class="bi bi-facebook"></i> </a>
                    <a href="{{$pages -> all_pages -> sections -> footer_social_media -> insta_url}}"> <i class="bi bi-instagram"></i> </a>
                    <!-- <a href="{{$pages -> all_pages -> sections -> footer_social_media -> pinterest_url}}"> <i class="bi bi-pinterest"></i> </a> -->
                    <a href="{{$pages -> all_pages -> sections -> footer_social_media -> linkedin_url}}"> <i class="bi bi-linkedin"></i> </a>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
<script src="{{asset('Dashboard/js/sb-dasboard-2.min.js')}}"></script>
<script src="{{asset('Dashboard/js/dasboard-custom-script.js')}}"></script>
