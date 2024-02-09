@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
<div class="search-overlay" id="search-overlay">
    <div class="search-overlay__header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-8">
                    <div class="search-title">
                        <h4 class="font-weight--normal">Search</h4>
                    </div>
                </div>
                <div class="col-md-6 ml-auto col-4">

                    <!-- search content -->

                    <div class="search-content text-right"> <span class="mobile-navigation-close-icon" id="search-close-trigger"><i class="icon-cross"></i></span> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-overlay__inner">
        <div class="search-overlay__body">
            <div class="search-overlay__form">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 ml-auto mr-auto">
                            <form action="#">
                                <div class="product-cats section-space--mb_60 text-center">
                                    <label>
                                        <input type="radio" name="product_cat" value="" checked="checked">
                                        <span class="line-hover">All</span> </label>
                                    <label>
                                        <input type="radio" name="product_cat" value="decoration">
                                        <span class="line-hover">Decoration</span> </label>
                                    <label>
                                        <input type="radio" name="product_cat" value="furniture">
                                        <span class="line-hover">Furniture</span> </label>
                                    <label>
                                        <input type="radio" name="product_cat" value="table">
                                        <span class="line-hover">Table</span> </label>
                                    <label>
                                        <input type="radio" name="product_cat" value="chair">
                                        <span class="line-hover">Chair</span> </label>
                                </div>
                                <div class="search-fields">
                                    <input type="text" placeholder="Search">
                                    <button class="submit-button"><i class="icon-magnifier"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>