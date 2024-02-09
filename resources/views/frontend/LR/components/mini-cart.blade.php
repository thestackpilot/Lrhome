@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
<div class="offcanvas-minicart_wrapper" id="miniCart">
    <div class="offcanvas-menu-inner">
        <div class="close-btn-box"> <a href="#" class="btn-close"><i class="icon-cross2"></i></a> </div>
        <div class="minicart-content">
            <ul class="minicart-list">
                <li class="minicart-product"> <a class="product-item_remove" href="javascript:void(0)"><i class="icon-cross2"></i></a>
                    <a class="product-item_img"> <img class="img-fluid" src="LR/images/product/small/cart-01.jpg" alt="Product Image"> </a>
                    <div class="product-item_content"> <a class="product-item_title" href="shop-fullwidth.html">Plant pots</a>
                        <label>Qty : <span>1</span></label>
                        <label class="product-item_quantity">Price: <span> $20.00</span></label>
                    </div>
                </li>
                <li class="minicart-product"> <a class="product-item_remove" href="javascript:void(0)"><i class="icon-cross2"></i></a>
                    <a class="product-item_img"> <img class="img-fluid" src="LR/images/product/small/cart-02.jpg" alt="Product Image"> </a>
                    <div class="product-item_content"> <a class="product-item_title" href="shop-fullwidth.html">Teapot with black tea</a>
                        <label>Qty : <span>1</span></label>
                        <label class="product-item_quantity">Price: <span> $20.00</span></label>
                    </div>
                </li>
                <li class="minicart-product"> <a class="product-item_remove" href="javascript:void(0)"><i class="icon-cross2"></i></a>
                    <a class="product-item_img"> <img class="img-fluid" src="LR/images/product/small/cart-03.jpg" alt="Product Image"> </a>
                    <div class="product-item_content"> <a class="product-item_title" href="shop-fullwidth.html">Simple Chair</a>
                        <label>Qty : <span>1</span></label>
                        <label class="product-item_quantity">Price: <span> $20.00</span></label>
                    </div>
                </li>
            </ul>
        </div>
        <div class="minicart-item_total"> <span class="font-weight--reguler">Subtotal:</span> <span class="ammount font-weight--reguler">$60.00</span> </div>
        <div class="minicart-btn_area"> <a href="cart.html" class="btn btn--full btn--border_1">View cart</a> </div>
        <div class="minicart-btn_area"> <a href="checkout.html" class="btn btn--full btn--black">Checkout</a> </div>
    </div>
</div>