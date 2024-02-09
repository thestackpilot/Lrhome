@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

<div class="product-modal-box modal fade" id="prodect-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="icon-cross" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="quickview-product-active mr-lg-5">
                                <a href="#" class="images"> <img src="LR/images/product/2-570x570.jpg" class="img-fluid" alt=""> </a>
                                <a href="#" class="images"> <img src="LR/images/product/3-600x600.jpg" class="img-fluid" alt=""> </a>
                                <a href="#" class="images"> <img src="LR/images/product/4-768x768.jpg" class="img-fluid" alt=""> </a>
                            </div>

                            <!-- Thumbnail Large Image End -->

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="product-details-content quickview-content-wrap ">
                                <h5 class="font-weight--reguler mb-10">Teapot with black tea</h5>
                                <div class="quickview-ratting-review mb-10">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting"> <i class="yellow icon_star"></i> <i class="yellow icon_star"></i> <i class="yellow icon_star"></i> <i class="yellow icon_star"></i> <i class="yellow icon_star"></i> </div>
                                        <a href="#"> 2 customer review</a> </div>
                                </div>
                                <h3 class="price">�59.99</h3>
                                <div class="stock in-stock mt-10">
                                    <p>Available: <span>In stock</span></p>
                                </div>
                                <div class="quickview-peragraph mt-10">
                                    <p>At vero accusamus et iusto odio dignissimos blanditiis praesentiums dolores molest.</p>
                                </div>
                                <div class="quickview-action-wrap mt-30">
                                    <div class="quickview-cart-box">
                                        <div class="quickview-quality">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                            </div>
                                        </div>
                                        <div class="quickview-button">
                                            <div class="quickview-cart button"> <a href="product-details.html" class="btn--lg btn--black font-weight--reguler text-white">Add to cart</a> </div>
                                            <div class="quickview-wishlist button"> <a title="Add to wishlist" href="#"><i class="icon-heart"></i></a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_meta mt-30">
                                    <div class="sku_wrapper item_meta"> <span class="label"> SKU: </span> <span class="sku"> 502 </span> </div>
                                    <div class="posted_in item_meta"> <span class="label">Categories: </span><a href="#">Furniture</a>, <a href="#">Table</a> </div>
                                    <div class="tagged_as item_meta"> <span class="label">Tag: </span><a href="#">Pottery</a> </div>
                                </div>
                                <div class="product_socials section-space--mt_60"> <span class="label">Share this items :</span>
                                    <ul class="helendo-social-share socials-inline">
                                        <li> <a class="share-twitter helendo-twitter" href="#" target="_blank"><i class="social_twitter"></i></a> </li>
                                        <li> <a class="share-facebook helendo-facebook" href="#" target="_blank"><i class="social_facebook"></i></a> </li>
                                        <li> <a class="share-google-plus helendo-google-plus" href="#" target="_blank"><i class="social_googleplus"></i></a> </li>
                                        <li> <a class="share-pinterest helendo-pinterest" href="#" target="_blank"><i class="social_pinterest"></i></a> </li>
                                        <li> <a class="share-linkedin helendo-linkedin" href="#" target="_blank"><i class="social_linkedin"></i></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>