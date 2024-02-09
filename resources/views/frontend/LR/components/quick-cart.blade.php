@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
@php
// TODO : If the cart is empty then what visual will come up
// TODO : On click of the product image in the cart the page should go to that item page
@endphp

    <i class="headericons icon-cart quickCart-opener position-relative">
        @auth()
        <span class="badge badge-pill badge-primary position-absolute cartCount">{{$cart -> cart_count}}</span>
        @endauth
    </i>
    @if(isset($cart -> items) && count((array)$cart -> items))
    <div class="quickCart position-absolute d-none">
        <div class="cartLoader d-none">
            <div id="loading_msg" class="d-flex flex-column text-center">
                <div class="spinner-border" role="status" style="margin: 0 auto;">
                    <span class="sr-only" style="opacity:0;">Loading...</span>
                </div>
                <p class="loadinMsg">Loading...</p>
            </div>
        </div>
        <div class="col-sm-12 m-md-2 checkout-balance col-12 position-absolute">
            <i class="close-icon icon-cross position-absolute quickcart-closer"> </i>
            <div class="checkout_items_wrap mt-4">
                @foreach($cart -> items as $item)
                <div class="d-flex flex-row justify-content-between align-items-center p-3 pt-3 border-bottom-thick" id="{{$item -> item_id}}__{{$item -> item_customer_id}}">
                    <div class="col-md-3 products-thumbnails position-relative align-self-baseline p-0">
                        <a href="javascript:void(0)" class="d-block newStyle">
                            <i class="position-absolute icon-cross removeProd" onclick="removeItemFromCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}')"> </i>
                            <img src="{{$item -> item_image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$item -> item_name}}">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <h3 class="font-ropa m-0">{{$item -> item_name}}</h3>
                        {{-- 
                        <p class="specs m-0"> <strong> Customer ID: </strong> <span> {{$item -> item_customer_id}} </span> </p>
                        <p class="specs m-0"> <strong> Item ID: </strong> <span> {{$item -> item_id}} </span> </p>
                        --}}
                        <p class="specs m-0"> <strong> Color: </strong> <span> {{$item -> item_color}} </span> </p>
                        <p class="specs m-0"> <strong> Size: </strong> <span> {{$item -> item_size}} </span> </p>
                        <p class="price justify-content-end m-0">{{$item -> item_currency}}{{$item -> item_total}} </p>
                        <hr>
                        <div class="action-item-sm p-2 px-0 d-flex flex-row align-items-center justify-content-between col-sm-12 overflow-hidden">
                            <input type="number" oninput="showUpdateCartButton('{{$item -> item_id}}__{{$item -> item_customer_id}}')" onkeydown="if(this.key==='.'){this.preventDefault();}" class="form-control" min="1" value="{{$item -> item_quantity}}" style="margin-right: 10px; max-width: 80px;">
                            <a href="javascript:void(0);" style="display: none;" onclick="updateCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}')" class="update-cart-button font-ropa ms-1"> Update </a>
                            <div id="updating-cart" class="d-none flex-column text-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only" style="opacity:0;">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <h2 class="text-muted text-center mt-5 mb-3 emptyCart"> Cart is empty! </h2> -->
            </div>
            <div class="col-md-12 px-5 py-1">
                <hr>
                <p class="specs m-0 d-flex justify-content-between mb-2" style="display: none !important;">
                    <strong class="font-crimson"> Sub Total </strong>
                    <span class="font-ropa cart_sub_total"> {{$cart -> cart_currency}}{{$cart -> cart_total}} </span>
                </p>
                <input type="hidden" value="940">
                <p class="specs m-0 d-flex justify-content-between mb-2" style="display: none !important;">
                    <strong class="font-crimson"> Shipping</strong>
                    <span class="font-ropa shipping_price_value"> (will be calculated on checkout) </span>
                </p>
                {{-- <hr> --}}
                <p class="specs m-0 d-flex justify-content-between total-amount">
                    <strong class="font-crimson"> Total </strong>
                    <span class="font-ropa cart_total_price"> {{$cart -> cart_currency}}{{$cart -> cart_total}} </span>
                </p>
                <a href="{{route('frontend.checkout')}}" class="btn btn--md btn--border_1 mt-3 quick-cart-btn d-block">View Cart & Checkout<i class="icon-arrow-right"></i></a>
            </div>
        </div>
    </div>
    @else
    <div class="quickCart position-absolute d-none" style="min-height: 130px;padding-bottom: 0;">
        <div class="align-items-center col-md-12 d-flex justify-content-center p-5 px-5 py-1">
            <i class="close-icon icon-cross position-absolute quickcart-closer"> </i>
            <div class="col-md-12 px-5 py-1">
                <h3 class="d-flex footer-widget__title justify-content-center m-0 mb-2 specs">
                    <strong class="font-crimson cart-is-empty"> Cart is Empty </strong>
                </h3>
            </div>
        </div>
    </div>
    @endif
