@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
@php
//TODO : Move this into the quick cart blade
@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','About Us')
@section('content')
<div class="wrapper bg-EDECE9">
   @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
   <main class="main-content checkout-page">
      <section class="collection-section">
         <div class="container">
            <div class="d-flex flex-row justify-content-between flex-dir-col my-5">
               <div class="col-md-5 col-sm-12 col-12">
                  <div class="p-1">
                     <!-- <h2 class="text-center">Sign in with Email</h2> -->
                     <div class="d-flex flex-column dafault-form form-checkout" id="order_form">
                        <input type="hidden" value="SPARSC" name="customer_id">
                        <div class="mb-5 d-none">
                           <input type="email" disabled="" class="form-control bg-white" name="email" aria-describedby="emailHelp" placeholder="example@domainname.com" value="admin@gmail.com">
                           <div class="form-check mt-3">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                              <label class="form-check-label" for="flexCheckChecked"> Keep me up to date on news and exclusive offers </label>
                           </div>
                        </div>
                        <div class="mb-5">
                           <h5 class="mb-1">Delivery method </h5>
                           <div class="form-check bg-white ps-5 d-flex align-items-center styledCheckbox">
                              <input class="form-check-input" type="radio" name="ship-pickup" id="ship" value="3RDP">
                              <label class="form-check-label py-3" for="ship">
                              <img src="http://vcs.botguys.ai/images/truck.svg" class="icon-img icon-truck">
                              Standard ShipVia
                              </label>
                           </div>
                           <div class="form-check bg-white ps-5 d-flex align-items-center styledCheckbox">
                              <input class="form-check-input" type="radio" name="ship-pickup" value="Pickup" id="pickup">
                              <label class="form-check-label py-3" for="pickup">
                              <img src="http://vcs.botguys.ai/images/shop.svg" class="icon-img icon-shop">
                              Package Pickup
                              </label>
                           </div>
                        </div>
                        <div class="mb-5">
                           <h5 class="mb-1">Shipping address </h5>
                           <label class="order_form_validation_error d-none"></label>
                           <div class="col-md-12 address-cards">
                              <div class="card mb-3">
                                 <div class="card-body text-dark">
                                    <h5 class="card-title">
                                       <input type="radio" name="shipping-address" id="000000" value="000000">
                                       <input type="hidden" name="shipping-address-data" value="{&quot;AddressID&quot;:&quot;000000&quot;,&quot;FirstName&quot;:&quot;sparsUS&quot;,&quot;LastName&quot;:&quot;&quot;,&quot;Address1&quot;:&quot;spars USA&quot;,&quot;Address2&quot;:&quot;&quot;,&quot;City&quot;:&quot;London&quot;,&quot;State&quot;:&quot;AK&quot;,&quot;Zip&quot;:&quot;548200&quot;,&quot;Country&quot;:&quot;USA&quot;,&quot;Phone1&quot;:&quot;&quot;,&quot;Phone2&quot;:&quot;&quot;,&quot;Fax&quot;:&quot;&quot;,&quot;Email&quot;:&quot;farooqwaheed343@gmail.com&quot;}">
                                       <label style="width: 90%;" for="000000">000000</label>
                                    </h5>
                                    <p class="card-text">
                                       <label style="width: 100%;" for="000000">
                                       <span><b>Address: spars USA</b></span><br>
                                       <span><b>Name: sparsUS</b></span><br>
                                       <span>City: London</span>,
                                       <span>State: AK</span>,
                                       <span>Postal Code: 548200</span>,
                                       <span>Country: USA</span>
                                       </label>
                                    </p>
                                 </div>
                              </div>
                              <div class="card mb-3">
                                 <div class="card-body text-dark">
                                    <h5 class="card-title">
                                       <input type="radio" name="shipping-address" id="other" value="other">
                                       <label style="width: 90%;" for="other">Other</label>
                                    </h5>
                                 </div>
                              </div>
                           </div>
                           <div class="other-address" style="display: none;">
                              <div class="d-flex flex-row justify-content-between column-gap-20 mb-3">
                                 <input type="text" data-required="true" class="form-control bg-white " name="FirstName" aria-describedby="FirstName" placeholder="First Name*">
                                 <input type="text" data-required="true" class="form-control bg-white" name="LastName" aria-describedby="LastName" placeholder="Last Name*">
                              </div>
                              <div class="d-flex flex-row justify-content-between column-gap-20 mb-3">
                                 <input type="text" data-required="true" class="form-control bg-white" name="Email" aria-describedby="Email" placeholder="Email*">
                              </div>
                              <div class="d-flex flex-column">
                                 <!--                                            <input type="text" class="form-control bg-white mb-3" name="Company" aria-describedby="Company" placeholder="Company (optional)">-->
                                 <input type="text" data-required="true" class="form-control bg-white mb-3" name="Address1" aria-describedby="Address" placeholder="Address*">
                                 <input type="text" class="form-control bg-white mb-3" name="Address2" aria-describedby="Apartment" placeholder="Apartment, suite, etc. (optional)">
                                 <input type="text" data-required="true" class="form-control bg-white mb-3" name="State" aria-describedby="State" placeholder="State*">
                                 <input type="text" data-required="true" class="form-control bg-white mb-3" name="City" aria-describedby="City" placeholder="City*">
                              </div>
                              <div class="d-flex flex-row justify-content-between column-gap-20 mb-3">
                                 <input type="text" data-required="true" name="country" class="form-control bg-white" aria-describedby="Country" placeholder="Country*">
                                 <input type="text" data-required="true" class="form-control bg-white" name="Zip" aria-describedby="PostalCode" placeholder="Postal Code*">
                              </div>
                           </div>
                           <div class="d-flex flex-row justify-content-between order_form_button_outer">
                              <button type="button" class=" btn btn-primary text-uppercase place-order-btn">Place order</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12 m-md-2 bg-white checkout-balance col-12">
                  <div class="checkout_items_wrap">
                     <div class="d-flex flex-row justify-content-lg-between p-5 align-items-center pb-2 border-bottom-thick" id="ADAAN692A57337016__SPARSC">
                        <div class="col-md-3 products-thumbnails position-relative align-self-baseline p-0">
                           <a href="javascript:void(0)" class="d-flex">
                           <i class="bi bi-x-circle-fill remove-product-cart" onclick="removeItemFromCart('ADAAN692A57337016','ADANA - Transitional','tMzxC6XETbz5Aq2r3IoRPpQFj4TO9x8EyRb9n4A2','SPARSC')"></i>
                           <img src="https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ADAAN692A5733.jpg" onerror="this.onerror=null; this.src='http://vcs.botguys.ai/images/placeholder.jpg'" alt="ADANA - Transitional">
                           </a>
                        </div>
                        <div class="col-md-9">
                           <h3 class="font-ropa m-0">ADANA - Transitional</h3>
                           <p class="specs m-0"> <strong> Customer ID: </strong> <span> SPARSC </span> </p>
                           <p class="specs m-0"> <strong> Item ID: </strong> <span> ADAAN692A57337016 </span> </p>
                           <p class="specs m-0"> <strong> Color: </strong> <span> NAVY / GRAY </span> </p>
                           <p class="specs m-0"> <strong> Size: </strong> <span> 7' - 10" X 10' - 6" </span> </p>
                           <p class="price justify-content-end m-0"> $940 </p>
                           <hr>
                           <div class="action-item-sm p-2 px-0 d-flex flex-row align-items-center justify-content-between col-sm-12 cart-actions">
                              <input type="number" class="form-control" min="1" value="4" style="margin-right: 10px;">
                              <a href="#0"class="update-cart-button font-ropa ms-1"> Update </a>
                              <div class="d-none flex-column text-center">
                                 <div class="spinner-border" role="status">
                                    <span class="sr-only" style="opacity:0;">Loading...</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 px-5 py-1">
                     <hr class="minicart-seprator mb-2">
                     <p class="specs m-0 d-flex justify-content-between mb-2"> <strong class="font-crimson"> Sub Total </strong> <span class="font-ropa cart_sub_total"> $940 </span> </p>
                     <input type="hidden" value="940" id="cart_sub_total_hidden">
                     <p class="specs m-0 d-flex justify-content-between mb-2"> <strong class="font-crimson"> Shipping </strong> <span class="font-ropa shipping_price_value"> $0.00 </span> </p>
                     <hr class="minicart-seprator mb-2">
                     <p class="specs m-0 d-flex justify-content-between total-amount"> <strong class="font-crimson"> Total </strong> <span class="font-ropa cart_total_price"> $940 </span> </p>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection
