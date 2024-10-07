@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;


$card_required = '';
if (
   array_key_exists(md5( $payment_term ), $payment_terms_list) &&
   strtolower($payment_terms_list[md5( $payment_term )]['CreditCardTerms']) != 'false' &&
   strtolower($payment_terms_list[md5( $payment_term )]['CreditCardTerms']) != ''
){
    prr($payment_term);
   $card_required = 'data-required=true';
}
@endphp

@extends('frontend.' . $active_theme -> theme_abrv . '.layouts.app')
@section('title','Checkout')
@section('content')
<div class="wrapper bg-FBFBFB">
   @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
   <main class="main-content checkout-page">
      <section class="bg-EDECE9">
         <div class="container">
            @if(count((array)$cart->items))
               <div class="col mt-5">
                  <ul id="progressbar" class="text-center">
                     <li class="active go-to-start current" data-step="1" id="account">
                        <strong>Order</strong>
                     </li>
                     <li class="proceed-ahead" data-step="2" id="personal">
                        <strong>Shipping</strong>
                     </li>
                     @if(isset($card_required) && $card_required !== '')
                     <li class="go-to-payment muted" data-step="3" id="payment">
                        <strong>Payment</strong>
                     </li>
                     @endif
                     <li class="go-to-confirmation_ muted" data-step="4" id="confirm">
                        <strong>Confirmation</strong>
                     </li>
                  </ul>
               </div>
            @endif
         </div>
      </section>
      <section class="collection-section newStyle">
         <div class="container">

            <div class="new-selectables py-5 step-2 d-none shipping-method-s2">
               <div class="d-flex flex-column">
                  <h6 class="font-nexa-bold text-center"> Delivery Method </h6>
                  <div class="d-flex flex-row mt-4 align-items-center fixheight-32">
                     <select name="ship-pickup">
                        @if($shipping_options)
                           @foreach($shipping_options as $shipping_option)
                              <option {{ $default_ship_via_id == $shipping_option['ShipViaID'] ? 'selected' : '' }} value="{{$shipping_option['ShipViaID']}}">{{$shipping_option['Description']}}</option>
                           @endforeach
                        @else
                           <option value="3RDP">Standard ShipVia</option>
                        @endif
                     </select>
                  </div>
               </div>
               <div class="d-flex flex-column delivery-method">
                  <h6 class="font-nexa-bold text-center"> Shipping Address </h6>
                  <div class="d-flex mt-4 address-cards">
                     <div class="d-flex align-items-center address-card-info">
                     @if($shipping_addresses && isset($shipping_addresses['ShipToAddresses']) && count($shipping_addresses['ShipToAddresses']))
                        <div class="check-container">
                           <input type="radio" class="form-check-input m-0" name="shipping-address" id="existing-address" value="existing-address" />
                           <span class="checkmark"></span>
                        </div>
                        <select class="select-address">
                           @foreach($shipping_addresses['ShipToAddresses'] as $address)
                           <option selected="{{isset($address['DefaultAddress']) && $address['DefaultAddress'] === 'True' ? true : false}}" value="{{$address['AddressID']}}">
                           {{$address['AddressID']}} : {!!$address['FirstName'] ? $address['FirstName'] . ( $address['LastName'] ? " {$address['LastName']}" : '' ) : ''!!}
                           </option>
                           @endforeach
                        </select>
                        @foreach($shipping_addresses['ShipToAddresses'] as $address)
                           <p style="display: none !important;" class="card-text address-card d-none {{$address['AddressID']}}" id="{{$address['AddressID']}}">
                              <input type="hidden" name="shipping-address-data" value="{{json_encode($address)}}" />
                           </p>
                        @endforeach
                     @endif
                     </div>
                     <div class="d-flex fixheight-32 dropship-opt">
                        @if($shipping_addresses && isset($shipping_addresses['ShipToAddresses']) && count($shipping_addresses['ShipToAddresses']))
                        <span style="font-size: 12px;margin-right: 10px;text-align: center;">OR</span>
                        @endif
                        <div class="d-flex dropship-inner">
                           <div class="d-flex check-container">
                              <input type="radio" name="shipping-address" id="other" value="other" />
                              <span class="checkmark"></span>
                           </div>
                           <label for="other"> Dropship </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="new-selectables justify-content-center py-5 step-3 d-none flex-row payment-card">
               <div class="d-flex flex-column">
                  <h6 class="font-nexa-bold text-center "> Payment </h6>
                  <div class="d-flex mt-4 align-items-center s2-payment-pt">
                     @if(isset($payment_options['credit_card']))
                     <div class="d-flex flex-row ml-4 align-items-center fixheight-32">
                        <div class="check-container">
                           <input type="hidden" class="cc-existing-billing" value="{{json_encode($payment_options['billing_address'])}}" />
                           <input type="radio" name="ccType" value="existing" class="form-check-input m-0 card-type" id="card-type-existing" />
                           <span class="checkmark"></span>
                        </div>
                        <label for="card-type-existing" class="mb-0 ml-0">Use {{$payment_options['credit_card']['masked_number']}} expires in ({{$payment_options['credit_card']['expiration_month']}}/{{$payment_options['credit_card']['expiration_year']}})</label>
                     </div>
                     <div class="d-flex flex-row ml-4 align-items-center fixheight-32">
                        <div class="check-container">
                           <input type="radio" name="ccType" value="new" class="form-check-input m-0 card-type" id="card-type-new" />
                           <span class="checkmark"></span>
                        </div>
                        <label for="card-type-new"> Use a new payment method </label>
                     </div>
                     @else
                     <input type="radio" name="ccType" value="new" class="card-type d-none" checked="checked" id="card-type-new" />
                     @endif
                  </div>
               </div>
            </div>

            <div class="d-flex cust-order-details flex-dir-col p-5">
               <div class="col-md-8 col-sm-12 m-md-2 checkout-balance col-12">

                  <div class="checkout_items_wrap step-1 pt-3 pb-100 for-desktop-only">
                     @if(count((array)$cart->items))
                     <table class="table table-stripped d-inline">
                        <thead class="justify-content-around d-flex">
                           <tr class="row col-md-12">
                              <th class="col-md-6 border-top-0 text-center">Product</th>
                              <th class="col-md-2 border-top-0 text-center">Qty</th>
                              <th class="col-md-2 border-top-0 text-center">Price</th>
                              <th class="col-md-2 border-top-0 text-center">Sub Total</th>
                           </tr>
                        </thead>
                        <tbody class="flex-column justify-content-around d-flex">
                           @foreach($cart->items as $item)
                           <tr class="col-md-12 align-items-center d-flex flex-row" id="{{$item -> item_id}}__{{$item -> item_customer_id}}">
                              <td class="col-md-6 d-flex border-0">
                                 <!-- <div class="row"> -->
                                 <div class="col-md-3 products-thumbnails">
                                    <a href="javascript:void(0)" class="d-flex">
                                       <i class="position-absolute icon-cross removeProd" onclick="removeItemFromCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}','true')"></i>
                                       <img src="{{$item -> item_image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$item -> item_name}}">
                                    </a>
                                 </div>
                                 <div class="col-md-9 product-description">
                                    <div class="row mb-1">
                                       <h6 class="font-nexa-bold m-0">{{$item -> item_name}}</h6>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0"> Color: {{$item -> item_color}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0 d-none"> Backorder/ETA: {{date('Y-m-d', strtotime($item -> item_eta))}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0"> Size: {{$item -> item_size}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0 sidemark-section">
                                          <a href="javascript:void(0);" style="font-size: 12px;" class="btn--border-bottom m-0 mt-1 mb-1 add-sidemark"> Add Sidemark </a>
                                          <textarea class="form-control d-none" maxlength="35" name="sidemark[{{$item -> item_id}}]"></textarea>
                                       </p>
                                    </div>
                                 </div>
                              </td>
                              <td class="col-md-2 border-0 text-center">
                                 <div class="action-item-sm p-2 px-0 d-flex flex-column align-items-center justify-content-between col-sm-12 cart-actions">
                                    <div class="d-flex flex-row qty-styles">
                                       <a href="javascript:void(0);" class="qty-minus qty-action"> - </a>
                                       <input type="number" onchange="showUpdateCartButton('{{$item -> item_id}}__{{$item -> item_customer_id}}')" onkeydown="if(this.key==='.'){this.preventDefault();}" class="form-control" min="1" max="9999" maxlength="4" value="{{$item -> item_quantity}}" />
                                       <a href="javascript:void(0);" class="qty-add qty-action"> + </a>
                                    </div>
                                    <a href="javascript:void(0);" style="display: none; font-size: 12px;" class="btn--border-bottom update-cart-button m-0 mt-1" onclick="updateCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}','true')"> Update </a>
                                    <div id="updating-cart" class="d-none flex-column text-center cart-loader m-0 mt-1">
                                       <div class="spinner-border" role="status" style="width: 1.3rem; height: 1.3rem">
                                          <span class="sr-only" style="opacity:0;">Loading...</span>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="col-md-2 border-0 text-center">
                                 <p class="price justify-content-end m-0"> {{$item -> item_currency}}{{$item -> item_price}} </p>
                              </td>
                              <td class="col-md-2 border-0 text-center">
                                 <p class="price justify-content-end m-0"> {{$item -> item_currency}}{{$item -> item_total}} </p>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     @else
                        <div class="d-flex flex-row p-5 align-items-center">
                           <div class="col-md-12">
                              <h2 class="text-muted text-center mt-5 mb-3 emptyCart"> Cart is empty! </h2>
                           </div>
                        </div>
                     @endif
                     <div class="bottom-0 col p-4 row mt-5">
                        <a href="{{url('/')}}" class="btn btn--border_1 col mt-3">BACK TO SHOP</a>
                     </div>
                  </div>
                  <div class="checkout_items_wrap step-1 pt-3 pb-100 for-mobile-only">
                     @if(count((array)$cart->items))
                     <div class="">
                        <div class="mobile-cart-details">
                           @foreach($cart->items as $item)
                           <div class="mb-cart-inner" id="mob_{{$item -> item_id}}__{{$item -> item_customer_id}}">
                              <div class="mb-cart-info">
                                 <div class="products-thumbnails">
                                    <a href="javascript:void(0)" class="d-flex">
                                    <img src="{{$item -> item_image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$item -> item_name}}">
                                    <i class="position-absolute icon-cross removeProd" onclick="removeItemFromCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}','true', true)"></i>
                                    </a>
                                 </div>
                                 <div class="product-description">
                                    <h4>PRODUCT</h4>
                                    <div class="row mb-1">
                                       <h6 class="font-nexa-bold m-0">{{$item -> item_name}}</h6>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0"> Color: {{$item -> item_color}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0 d-none"> Backorder/ETA: {{date('Y-m-d', strtotime($item -> item_eta))}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0"> Size: {{$item -> item_size}}</p>
                                    </div>
                                    <div class="row">
                                       <p class="font-nexa-light m-0 sidemark-section">
                                          <a href="javascript:void(0);" style="font-size: 12px;" class="btn--border-bottom m-0 mt-1 mb-1 add-sidemark"> Add Sidemark </a>
                                          <textarea class="form-control d-none" maxlength="35" name="sidemark[{{$item -> item_id}}]"></textarea>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="order-qty border-0 text-center">
                                 <div class="action-item-sm px-0 d-flex cart-actions">
                                 <h4>QTY</h4>
                                    <div class="d-flex flex-row qty-styles">
                                       <a href="javascript:void(0);" class="qty-minus qty-action"> - </a>
                                       <input type="number" onchange="showUpdateCartButton('mob_{{$item -> item_id}}__{{$item -> item_customer_id}}')" onkeydown="if(this.key==='.'){this.preventDefault();}" class="form-control" min="1" max="9999" maxlength="4" value="{{$item -> item_quantity}}" />
                                       <a href="javascript:void(0);" class="qty-add qty-action"> + </a>
                                    </div>
                                    <a href="javascript:void(0);" style="display: none; font-size: 12px;" class="btn--border-bottom update-cart-button m-0 mt-1 ml-5" onclick="updateCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}','true', true)"> Update </a>
                                    <div id="updating-cart" class="d-none flex-column text-center cart-loader m-0 ml-5">
                                       <div class="spinner-border" role="status" style="width: 2rem; height: 2rem">
                                          <span class="sr-only" style="opacity:0;">Loading...</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="order-price border-0">
                              <h4>PRICE</h4>
                                 <p class="price justify-content-end m-0"> {{$item -> item_currency}}{{$item -> item_price}} </p>
                              </div>
                              <div class="order-price border-0">
                              <h4>SUB TOTAL</h4>
                                 <p class="price justify-content-end m-0"> {{$item -> item_currency}}{{$item -> item_total}} </p>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                     @else
                        <div class="d-flex flex-row p-5 align-items-center">
                           <div class="col-md-12">
                              <h2 class="text-muted text-center mt-5 mb-3 emptyCart"> Cart is empty! </h2>
                           </div>
                        </div>
                     @endif
                     <div class="bottom-0 col p-4 row mt-5">
                        <a href="{{url('/')}}" class="btn btn--border_1 col mt-3">BACK TO SHOP</a>
                     </div>
                  </div>

                  <div class="p-1 d-none step-2 step-3 step-4">
                     <div class="d-flex flex-column dafault-form form-checkout" id="order_form">
                        <div class="mb-4 step-2">
                           <h6 for="InputEmail1" class="form-label mb-5">Shipping Address </h6>
                           <label class="order_form_validation_error d-none"></label>
                           <div class="{{$shipping_addresses && isset($shipping_addresses['ShipToAddresses']) && count($shipping_addresses['ShipToAddresses']) ? 'muted-fields' : ''}} col-md-12 m-0 other-address p-0 pull-left">
                              <div class="d-flex flex-row justify-content-between column-gap-20 mb-4">
                                 <div class="d-flex flex-column fullwidth">
                                    <label class="p-0 m-0 mb-3">First Name <span class="color-red">*</span> </label>
                                    <input type="text" data-required="true" class="form-control bg-white " name="FirstName" maxlength="35" aria-describedby="FirstName" placeholder="First Name*">
                                 </div>
                                 <div class="d-flex flex-column fullwidth">
                                    <label class="p-0 m-0 mb-3">Last Name <span class="color-red d-none">*</span> </label>
                                    <input type="text" class="form-control bg-white" name="LastName" maxlength="35" aria-describedby="LastName" placeholder="Last Name">
                                 </div>
                              </div>
                              <div class="d-flex flex-column justify-content-between column-gap-20 mb-4">
                                    <label class="p-0 m-0 mb-3">Email <span class="color-red">*</span></label>
                                 <input type="email" data-required="true" class="form-control bg-white" name="Email" maxlength="60" aria-describedby="Email" placeholder="Email*">
                              </div>
                              <div class="d-flex flex-column mb-4">
                                 <!--                                            <input type="text" class="form-control bg-white mb-3" name="Company" aria-describedby="Company" placeholder="Company (optional)">-->
                                 <label class="p-0 m-0 mb-3">Address <span class="color-red">*</span></label>
                                 <input type="text" data-required="true" class="form-control bg-white mb-4" name="Address1" maxlength="35" aria-describedby="Address" placeholder="Address*">
                                 <label class="p-0 m-0 mb-3">Apartment, suite, etc. (optional) </label>
                                 <input type="text" class="form-control bg-white mb-4" name="Address2" maxlength="35" aria-describedby="Apartment" placeholder="Apartment, suite, etc. (optional)">
                                 <div class="d-flex flex-row justify-content-between column-gap-20 mb-4">
                                    <div class="d-flex flex-column fullwidth">
                                       <label class="p-0 m-0 mb-3">State <span class="color-red">*</span> </label>
                                       <input type="text" data-required="true" class="form-control bg-white" name="State" maxlength="50" aria-describedby="State" placeholder="State*">
                                    </div>
                                    <div class="d-flex flex-column fullwidth">
                                       <label class="p-0 m-0 mb-3">City <span class="color-red">*</span> </label>
                                       <input type="text" data-required="true" class="form-control bg-white" name="City" maxlength="35" aria-describedby="City" placeholder="City*">
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex flex-row justify-content-between column-gap-20 mb-3">
                                 <div class="d-flex flex-column fullwidth">
                                    <label class="p-0 m-0 mb-3">Country <span class="color-red">*</span> </label>
                                    <input type="text" data-required="true" name="Country" maxlength="30" class="form-control bg-white" aria-describedby="Country" placeholder="Country*">
                                 </div>
                                 <div class="d-flex flex-column fullwidth">
                                    <label class="p-0 m-0 mb-3">Postal Code <span class="color-red">*</span> </label>
                                    <input type="text" data-required="true" class="form-control bg-white" name="Zip" maxlength="10" aria-describedby="PostalCode" placeholder="Postal Code*">
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex flex-row">

                           </div>
                        </div>
                        <div class="mb-4 other-information step-2">
                           <h6 class="form-label mb-5">Additional Information</h6>
                           <div class="d-flex justify-content-between mb-3 user-add-info">
                              <div class="form-group col-md-6 col-sm-12 p-0 pr-3">
                                 <label for="reference_number" class="p-0 m-0 mb-3">P.O or Reference Number*</label>
                                 <input maxlength="250" type="text" data-required="true" class="form-control bg-white" id="reference_number" name="reference_number" placeholder="P.O or Reference Number*" />
                              </div>
                              <div class="form-group col-md-6 col-sm-12 p-0 pl-3">
                                 <label for="ship_date" class="p-0 m-0 mb-3">Ship Date & Time*</label>
                                 <div class='input-group date' id='datetimepicker'>
                                    <input type='text' autocomplete="off" data-required="true" id="ship_date" name="ship_date" class="form-control" />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>

                           <div class="d-flex flex-column justify-content-between column-gap-20 mb-3">
                              <label for="shipping_instructions" class="p-0 m-0 mb-3">Shipping Instructions</label>
                              <textarea maxlength="4000" name="shipping_instructions" class="form-control bg-white" placeholder="Shipping Instructions"></textarea>
                           </div>
                        </div>
                        <div class="mb-5 payment-summery step-3 d-none">
                           <div class="card payment-card">
                              {{-- <div class="card-header p-0">
                                 <h5 class="mb-0 p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                       <span>Payment</span>
                                       <div class="icons">
                                          <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                          <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                          <img src="https://cdn0.iconfinder.com/data/icons/flat-design-business-set-3/24/payment-method-amex-512.png" width="30">
                                          <img src="https://www.citypng.com/public/uploads/preview/discover-credit-card-payment-logo-icon-21635330062fdwm3er7oq.png" width="30">
                                       </div>
                                    </div>
                                 </h2>
                              </div> --}}
                              <div id="" class="show" aria-labelledby="headingOne">
                                 @php


                                 @endphp
                                 <div class="card-body">
                                    <div class="new-cc-section">
                                       <div class="card-key-details">
                                          <div class="form-group col-md-12 p-0 pl-3">
                                             <label for="card-number" class="p-0 m-0">Card Number</label>
                                             <div class="input-group">
                                                <input type="text"
                                                   data-inputmask="'mask': '9999 9999 9999 9999'"
                                                   {{$card_required}}
                                                   id="card-number"
                                                   name="ccNumber"
                                                   class="form-control pt-encrypt" />
                                                <span class="input-group-addon">
                                                   <span class="fa fa-credit-card"></span>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="card-key-details">
                                          <div class="form-group col-md-6 p-0 pl-3">
                                             <label for="expiry_date" class="p-0 m-0">Expiry Date</label>
                                             <div class="input-group">
                                                <input type="text"
                                                   data-inputmask="'mask': '99 / 99'"
                                                   {{$card_required}}
                                                   id="expiry_date"
                                                   name="ccExpiry"
                                                   class="form-control" />
                                                <span class="input-group-addon">
                                                   <span class="fa fa-calendar"></span>
                                                </span>
                                             </div>
                                          </div>
                                          <div class="form-group col-md-6 p-0 pl-3">
                                             <label for="csc" class="p-0 m-0">CVV/CVC</label>
                                             <div class="input-group">
                                                <input type="text"
                                                   data-inputmask="'mask': '9999'"
                                                   {{$card_required}}
                                                   id="csc"
                                                   name="ccCSC"
                                                   class="form-control pt-encrypt" />
                                                <span class="input-group-addon">
                                                   <span class="fa fa-lock"></span>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="align-items-center col d-flex mb-3 mt-3">
                                          <input type="checkbox" class="same-billing-address" id="same-billing-address">
                                          <label for="same-billing-address" class="mb-0 ml-0">Same as Shipping Address</label>
                                       </div>
                                       <div class="billing-address-section">
                                          <div class="form-group col-md-12 p-0 pl-3">
                                             <label for="name" class="p-0 m-0">Name</label>
                                             <div class="input-group">
                                                <input type="text" {{$card_required}} id="name" name="name" class="form-control" />
                                             </div>
                                          </div>
                                          <div class="form-group col-md-12 p-0 pl-3">
                                             <label for="address" class="p-0 m-0">Address</label>
                                             <div class="input-group">
                                                <input type="text" {{$card_required}} id="address" name="address" class="form-control" />
                                             </div>
                                          </div>
                                          <div class="form-group col-md-4 p-0 pl-3">
                                             <label for="city" class="p-0 m-0">City</label>
                                             <div class="input-group">
                                                <input type="text" {{$card_required}} id="city" name="city" class="form-control" />
                                             </div>
                                          </div>
                                          <div class="form-group col-md-4 p-0 pl-3">
                                             <label for="state" class="p-0 m-0">State</label>
                                             <div class="input-group">
                                                <input type="text" {{$card_required}} id="state" name="state" class="form-control" />
                                             </div>
                                          </div>
                                          <div class="form-group col-md-4 p-0 pl-3">
                                             <label for="zip" class="p-0 m-0">Zip</label>
                                             <div class="input-group">
                                                <input type="text" {{$card_required}} id="zip" name="zip" class="form-control" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="align-items-center col d-flex mb-3 mt-3">
                                          <input type="checkbox" class="save-update-card" id="save-update-card">
                                          <label for="save-update-card" class="mb-0 ml-0">{{isset($payment_options['credit_card']) ? 'Update this information to card.' : 'Save this card information.'}}</label>
                                       </div>
                                    </div>
                                    <span class="text-muted certificate-text col mt-5" style="color: #333 !important;"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="address-summery step-4 d-none mb-5">
                           <div class="d-flex column-gap-20 address-summery-inner">
                              <div class="d-flex flex-column fullwidth">
                                 <div class="d-flex flex-column">
                                    <h6 class="form-label font-nexa-bold">Delivery Method</h6>
                                    <div class="delivery-method preview-card">
                                    </div>
                                 </div>
                                 <div class="d-flex flex-column mt-3">
                                    <h6 class="form-label font-nexa-bold">Additional Information</h6>
                                    <div class="additional-information preview-card">
                                    </div>
                                 </div>
                                 <div class="d-flex flex-column mt-3">
                                    <h6 class="form-label font-nexa-bold">Payment Information</h6>
                                    <div class="payment-information preview-card">
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex flex-column fullwidth">
                                 <div class="d-flex flex-column">
                                    <h6 class="form-label font-nexa-bold">Shipping Address</h6>
                                    <div class="shipping-address preview-card">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mb-4">
                           <div class="d-flex flex-row justify-content-between order_form_button_outer">
                              <button type="button" class="border-radus-5 btn btn--border_1 btn-primary col m-1 go-back text-uppercase d-flex">Go Back</button>
                              <button type="button" class="border-radus-5 btn btn-dark {{ isset($card_required) && $card_required !== '' ? 'go-to-payment' : 'go-to-confirmation' }}  step-2 m-1 text-uppercase">{{ isset($card_required) && $card_required !== '' ? 'Next' : 'Confirm'}}</button>
                              <button type="button" data-skip="{{ isset($card_required) && $card_required === '' ? 'true': 'false'}}" class="border-radus-5 btn btn-dark go-to-confirmation m-1 step-3 text-uppercase d-none">{{ isset($card_required) && $card_required !== '' ? 'Confirm' : 'Skip'}}</button>
                              <button type="button" class="{{!count((array)$cart->items) ? 'btn-muted' : ''}} btn btn-dark m-1 text-uppercase place-order-btn step-4 d-none" style="max-width: 100%; border-radius: 0;">
                                 Place Order
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-12 col-12 m-md-2 p-0">
                  <div class="col-md-12 p-4 py-1 card" style="">
                     <h6 class="font-nexa-bold mb-4 text-center step-1 d-none"> Cart Totals </h6>
                     <div class="col-md-12 col-sm-12 m-md-2 bg-white checkout-balance m-md-2 col-12 d-none step-2 step-3 step-4 mb-5">
                        <div class="checkout_items_wrap mb-5">
                           @if(count((array)$cart->items))
                           @foreach($cart->items as $item)
                           <div class="d-flex flex-row justify-content-lg-between align-items-center pb-2 border-bottom-thick mt-4" id="{{$item -> item_id}}__{{$item -> item_customer_id}}">
                              <div class="col-md-3 products-thumbnails position-relative align-self-baseline p-0">
                                 <a href="javascript:void(0)" class="d-flex">
                                    <i class="position-absolute icon-cross removeProd" onclick="removeItemFromCart('{{$item -> item_id}}','{{csrf_token()}}','{{$item -> item_customer_id}}')"></i>
                                    <img src="{{$item -> item_image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$item -> item_name}}">
                                 </a>
                              </div>
                              <div class="col-md-9 step2-pd-info">
                                 <h6 class="font-ropa m-0">{{$item -> item_name}}</h6>
                                 <p class="specs m-0"> <strong class="font-crimson"> Item ID: </strong> <span class="font-ropa"> {{$item -> item_id}} </span> </p>
                                 <p class="specs m-0"> <strong class="font-crimson"> Color: </strong> <span class="font-ropa"> {{$item -> item_color}} </span> </p>
                                 <p class="specs m-0"> <strong class="font-crimson"> Size: </strong> <span class="font-ropa"> {{$item -> item_size}} </span> </p>
                                 <p class="specs m-0"> <strong class="font-crimson"> Qty: </strong> <span class="font-ropa"> {{$item -> item_quantity}} </span> </p>
                                 <p class="price justify-content-end m-0"> Sub Total: {{$item -> item_currency}}{{$item -> item_total}} </p>
                              </div>
                           </div>
                           @endforeach
                           @else
                           <div class="d-flex flex-row p-5 align-items-center">
                              <div class="col-md-12">
                                 <h2 class="text-muted text-center mt-5 mb-3 emptyCart"> Cart is empty! </h2>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                     <p class="specs m-0 d-flex justify-content-between mb-2" style="display: none !important;"> <strong class="font-crimson"> Sub Total </strong> <span class="font-ropa cart_sub_total"> {{$cart->cart_currency . $cart->cart_total}} </span> </p>
                     <input type="hidden" value="{{$cart->cart_total}}" id="cart_sub_total_hidden">
                     <p class="specs m-0 d-flex justify-content-between mb-2" style="display: none !important;"> <strong class="font-crimson"> Shipping </strong> <span class="font-ropa shipping_price_value"> $0.00 </span> </p>
                     <hr class="minicart-seprator mb-2" style="display: none; !important">
                     <p class="specs m-0 d-flex justify-content-between total-amount"> <strong class="font-crimson"> Total </strong> <span class="font-ropa cart_total_price"> {{$cart->cart_currency . $cart->cart_total}} </span> </p>
                     <br />
                     @if(count((array)$cart->items))
                     <button class="btn btn-dark proceed-ahead step-1">PROCEED TO CHECKOUT</button>
                     @endif
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="conatact-info-text py-5">
                           <h6 class="mb-10 font-nexa-bold">Our address</h6>
                           <p class="m-0 p-0">3432 S Dug Gap Road,<br>
                              Dalton, GA 30720</p>
                           <p class="m-0 mt-4"><strong>Call Us</strong> <br>
                              (706)-259-0155 <br>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
<div class="modal fade bd-example-modal-lg popupModal login-modal-popup" id="checkOut_popup" tabindex="-1" role="dialog" aria-labelledby="checkOutLabel" aria-hidden="true">
   <div class="backdrop" style="display:none;"></div>
   <div class="modal-dialog modal-lg wunst" role="document">
      <div class="modal-content">
         <div class="modal-header col-sm-12 justify-content-center flex-column">
            <h2 class="title d-flex flex-column justify-content-center text-center" style="margin: 0 auto;">
               <i class="bi bi-info-circle-fill d-none" style="color:#c90f41;font-size:30px;"></i>
               <i class="bi bi-check-circle-fill d-none" style="color:#127812;font-size:30px;"></i>
               Order Received
            </h2>
            <!-- <a href="http://vcs.ashtexsolutions.com" class="position-absolute close-icon" style="text-decoration: none;font-size: 30px;line-height: 12px;"><span aria-hidden="true" onclick="location.href='/'">&times;</span></a> -->
         </div>
         <div class="modal-body thanku flex-column justify-content-center" style="margin-top:-0;">
            <p class="thanku-msg text-center">Couldn't generate your order, please try again.</p>
            <a href="{{route('frontend.home')}}" style="padding: 6px 12px;" class="btn btn-dark text-uppercase checkout-signin mt-20 col pull-left btn-back-to-home">BACK TO HOME</a>
         </div>
      </div>
   </div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   #checkOut_popup.fade.show {
      opacity: 1;
   }
</style>
@endsection
@section('head_scripts')
<script language="javascript" src="https://api.paytrace.com/assets/e2ee/paytrace-e2ee.js"></script>
@endsection
@section('scripts')
<!-- INPUT MASK -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<!-- Propeller Bootstrap datetimepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script>
   $(document).ready(function() {
      var visited_tab = [1, 2];
      var shipping_address = '';
      var card_required = "{{$card_required}}";
      console.log(card_required == "" ? true : false);
      if (typeof paytrace !== 'undefined')
         {{--paytrace.setKeyAjax('{{route("checkout.security")}}');--}}
         paytrace.setKeyAjax('/checkout/pt/security');

      function validateEmail(email) {
         var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return re.test(email);
      }

      function update_active_step( step ) {
         $(`#progressbar li`).removeClass('active').removeClass('current');

         for(i = step; i < 4; i++)
            if ( ! visited_tab.includes(step) )
               $(`#progressbar li[data-step="${i}"]`).addClass('muted');

         if ( ! visited_tab.includes(step) )
            visited_tab.push(step);

         for(i = step; i > 0; i--)
            $(`#progressbar li[data-step="${i}"]`).removeClass('muted').addClass('active');

         $(`#progressbar li[data-step="${step}"]`).addClass('current');

         $('html, body').animate({scrollTop:0}, 'slow');
      }

      $('.qty-add').on('click', function() {
         var value = $('input[type="number"]', $(this).parent()).val();
         $('input[type="number"]', $(this).parent()).val((parseInt(value) + 1) < 1001 ? parseInt(value) + 1 : 1000).change();
      });

      $('.qty-minus').on('click', function() {
         var value = $('input[type="number"]', $(this).parent()).val();
         $('input[type="number"]', $(this).parent()).val((parseInt(value) - 1) > 1 ? parseInt(value) - 1 : 1).change();
      });

      // $('#datetimepicker').datetimepicker({minDate: new Date()});
      $('#datetimepicker').datepicker({
         format: "yyyy-mm-dd",
         startDate: "today",
         maxViewMode: 3,
         todayBtn: "linked",
         clearBtn: false,
         keyboardNavigation: false,
         autoclose: true,
         todayHighlight: true,
         toggleActive: true
      });
      $("[data-inputmask]").inputmask({greedy: false, placeholder:""});
      $('#cart-icon').removeAttr('id');
      $('#cart-parent .quickCart').remove();
      $('.address-cards input[type="radio"]').on('click, change', function() {
         if ($(this).val() === 'other') $('.other-address').removeClass('muted-fields');
         else {
            var address = JSON.parse($('input[name="shipping-address-data"]', $(`.${$('.select-address').val()}`)).val());
            for(key in address)
               $( `input[name="${key}"]`, $('.other-address')).val(address[key]);
            $('.other-address').addClass('muted-fields');
         }
      });

      $('.proceed-ahead').on('click', function() {
         $('.step-1, .step-3, .step-4').addClass('d-none');
         $('.step-2').removeClass('d-none');
         $('.go-back').attr('data-step', 'step-1');
         $('[name="ship-pickup"]').change();

         update_active_step( 2 );
      });
      $('.go-back').on('click', function() {
         $('.step-2, .step-3, .step-4').addClass('d-none');
         $(`.${$(this).attr('data-step')}`).removeClass('d-none');
         update_active_step( parseInt($('.go-back').attr('data-step').split('-')[1]) );
         $('.go-back').attr('data-step', $(this).attr('data-step') == 'step-2' ? 'step-1' : 'step-2');
         $('[name="ship-pickup"]').change();
      });

      $('.go-to-start').on('click', function() {
         $('.step-2, .step-3, .step-4').addClass('d-none');
         $('.step-1').removeClass('d-none');
         $('.go-back').attr('data-step', 'step-1');
         update_active_step( 1 );
      });

      $('.same-billing-address').click(function(){
         if($(this).is(':checked'))
            $('.billing-address-section').addClass('d-none');
         else
            $('.billing-address-section').removeClass('d-none');
      });

      $('.card-type').click(function(){
         if($(this).val() == 'new') {
            $('.new-cc-section').removeClass('d-none');
            $('.go-to-confirmation').html($('.go-to-confirmation').attr('data-skip') === 'true' ? 'Skip' : '<strong>Confirm</strong>');
         } else {
            $('.new-cc-section').addClass('d-none');
            $('.go-to-confirmation').html($('.go-to-confirmation').attr('data-skip') === 'true' ? 'Skip' : '<strong>Confirm</strong>');
         }
      });
      $('#card-type-new').click();


      $('input, select', $('.payment-card')).on('keyup', function() {
         var allOk = true;
         $('input, select', $('.payment-card')).each(function() {
            if (typeof $(this).val().length !== 'undefined' || $(this).val().trim().length > 0) {
               allOk = false;
            }
         });

         $('.go-to-confirmation').html(allOk && $('.go-to-confirmation').attr('data-skip') == "true" ? 'Skip' : 'Confirm');
      });

      $('.go-to-confirmation').on('click', function() {
         var allOk = true;
         var tryingToFill = false;

         $('input[data-required="true"]:visible, select[data-required="true"]:visible').each(function() {
            if (typeof $(this).val().length === 'undefined') {
               $(this).addClass('is-invalid');
               allOk = false;
            } else if ($(this).val().trim().length < 1) {
               $(this).addClass('is-invalid');
               allOk = false;
            } else {
               $(this).removeClass('is-invalid');
            }
         });

         if (!$('.go-to-confirmation').attr('data-skip')) {
            $('input[type="text"]:visible, select:visible', $('.payment-summery')).each(function() {
               if (typeof $(this).val().length === 'undefined') {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else if ($(this).val().trim().length < 1) {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else {
                  $(this).removeClass('is-invalid');
               }
            });
         }

         if ($('.same-billing-address').is(':checked')) {
            tryingToFill = true;
         }

         $('.billing-address-section input[type="text"]:visible', $('.payment-summery')).each(function() {
            if (typeof $(this).val().length !== 'undefined' && $(this).val().trim().length > 0 ) {
               tryingToFill = true;
            }
         });

         if (tryingToFill) {
            $('.billing-address-section input[type="text"]:visible', $('.payment-summery')).each(function() {
               if (typeof $(this).val().length === 'undefined') {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else if ($(this).val().trim().length < 1) {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else {
                  $(this).removeClass('is-invalid');
               }
            });
         }

         if (allOk) {
            $('input[type="text"]:visible').removeClass('is-invalid');
            $('.step-1, .step-2, .step-3').addClass('d-none');
            $('.step-4').removeClass('d-none');
            if(card_required == "")
            {
               shipping_address = '';
               $('.go-back').attr('data-step', 'step-2');
               if (!$('.other-address').hasClass('muted-fields')) {
               $('.other-address input[type="text"]').each(function() {
                  shipping_address += `<p class="m-0 mb-3"><b>${$(this).attr('placeholder').replace('*', '')}: </b> ${$(this).val()}</p>`;
               });
            } else {
               var address_data = JSON.parse($('input[name="shipping-address-data"]', $(`.${$('.select-address').val()}`)).val());
               for(const key in address_data) {
                  if (['address_id', 'address1', 'address2','firstname','lastname','city','zip','state','email'].includes(key.toLocaleLowerCase()))
                     shipping_address += `<p class="m-0 mb-3"><b>${key}: </b> ${address_data[key]}</p>`;
               }
            }
            }else{
               $('.go-back').attr('data-step', 'step-3');
            }

            var _parent = $('.address-summery');
            $('.delivery-method', _parent).html(`<p class="m-0 mt-3 mb-3">${$('[name="ship-pickup"]').val()}</p>`);
            $('.shipping-address', _parent).html(shipping_address);
            console.log(shipping_address);
            $('.additional-information', _parent).html(
               `
               <p class="m-0 mb-3"><b>P.O or Reference Number: </b>${$('[name="reference_number"]').val()}</p>
               <p class="m-0 mb-3"><b>Ship Date & Time: </b>${$('[name="ship_date"]').val()}</p>
               <p class="m-0 mb-3"><b>Shipping Instructions: </b>${$('[name="shipping_instructions"]').val()}</p>
               `
            );
            if ($('.payment-card input[name="ccType"]:checked').val() == 'existing') {
               $('.payment-information', _parent).html(`<p class="m-0 mb-3">{{isset($payment_options['credit_card']) ? $payment_options['credit_card']['masked_number'] : ''}} expires in ({{isset($payment_options['credit_card']) ? $payment_options['credit_card']['expiration_month'].'/'.$payment_options['credit_card']['expiration_year'] : ''}})</p>`);
            } else {
               if ( typeof $('.payment-card .card-key-details input[name="ccNumber"]').val().length !== 'undefined' && $('.payment-card .card-key-details input[name="ccNumber"]').val().length > 0 ) {
                  var ccNumberParts = $('.payment-card .card-key-details input[name="ccNumber"]').val().split(' ');
                  $('.payment-information', _parent).html(`<p class="m-0 mb-3">************${ccNumberParts[ccNumberParts.length - 1]} expires in (${$('.payment-card .card-key-details input[name="ccExpiry"]').val()})</p>`);
               } else {
                  $('.payment-information', _parent).html(`<p class="m-0 mb-3">N/A</p>`);
               }
            }
            update_active_step( 4 );
         }
      });

      $('.go-to-payment').on('click', function() {
         shipping_address = '';
         if (!$('.other-address').hasClass('muted-fields')) {
            $('.other-address input[type="text"]').each(function() {
               shipping_address += `<p class="m-0 mb-3"><b>${$(this).attr('placeholder').replace('*', '')}: </b> ${$(this).val()}</p>`;
            });
         } else {
            var address_data = JSON.parse($('input[name="shipping-address-data"]', $(`.${$('.select-address').val()}`)).val());
            for(const key in address_data) {
               if (['address_id', 'address1', 'address2','firstname','lastname','city','zip','state','email'].includes(key.toLocaleLowerCase()))
                  shipping_address += `<p class="m-0 mb-3"><b>${key}: </b> ${address_data[key]}</p>`;
            }
         }

         var allOk = true;
         if (!$('.other-address').hasClass('muted-fields'))
            $('.other-address input[data-required="true"], .other-address select[data-required="true"]').each(function() {
               if (typeof $(this).val().length === 'undefined') {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else if ($(this).val().trim().length < 1) {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else {
                  $(this).removeClass('is-invalid');
               }
            });

         if ($('.other-information').is(':visible')) {
            $('.other-information input[data-required="true"], .other-information select[data-required="true"]').each(function() {
               if (typeof $(this).val().length === 'undefined') {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else if ($(this).val().trim().length < 1) {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else {
                  $(this).removeClass('is-invalid');
               }
            });

            /*
            if (new Date($('[name="ship_date"]').val()).getTime() <= (new Date()).getTime()) {
               allOk = false;
               $('[name="ship_date"]').addClass('is-invalid');
            } else
               $('[name="ship_date"]').removeClass('is-invalid');
            */
         }

         if (!$('.other-address').hasClass('muted-fields') && allOk && $('input[type="email"]').is(':visible') && !validateEmail($('input[type="email"]').val())) {
            $('input[type="email"]').addClass('is-invalid');
            allOk = false;
         }

         if (allOk ) {
            $('.step-1, .step-2, .step-4').addClass('d-none');
            $('.step-3').removeClass('d-none');
            $('.go-back').attr('data-step', 'step-2');
            update_active_step( 3 );
         }
      });

      // $('[name="ship-pickup"]').on('change', function() {
      //    $.post("{{route('frontend.checkout.shipping-rate')}}", {
      //       "_token": "{{ csrf_token() }}",
      //       "shipping_method": $(this).val()
      //    }, function(data) {
      //       // data = JSON.parse(data);
      //       if (data.success) {
      //          var _total = "{{$cart->cart_total}}";
      //          _total = parseFloat(_total.replace(/,/g, '')) + data.data;

      //          $('.shipping_price_value').attr("price", data.data).html(data.data.toLocaleString('en-US', {
      //             style: 'currency',
      //             currency: 'USD',
      //          }));
      //          $('.cart_total_price').html(_total.toLocaleString('en-US', {
      //             style: 'currency',
      //             currency: 'USD',
      //          }));
      //       }
      //    });
      // });

      $('#checkOut_popup .btn-back-to-home').click(function() {
         if (typeof $(this).attr('data-dismiss') !== "undefined") {
            $('#checkOut_popup').modal('hide');
         } else
            return true;
      });

      $('.add-sidemark').click(function() {
         $('textarea', $(this).closest('.sidemark-section')).toggleClass('d-none');
      });

      $('.select-address').on('change', function() {
         $('.address-card').addClass('d-none');
         $('#existing-address').click();

         var address = JSON.parse($('input[name="shipping-address-data"]', $(`.${$(this).val()}`)).val());
         for(key in address)
            $( `input[name="${key}"]`, $('.other-address')).val(address[key]);
         // $(`.address-card.${$(this).val()}`).removeClass('d-none');
      }).change();

      $('[name="ship-pickup"], input[name="shipping-address"]:first').click().change();
      $('.place-order-btn').on('click', function() {
         var allOk = true;

         $('input[data-required="true"]:visible, select[data-required="true"]:visible').each(function() {
            if (typeof $(this).val().length === 'undefined') {
               $(this).addClass('is-invalid');
               allOk = false;
            } else if ($(this).val().trim().length < 1) {
               $(this).addClass('is-invalid');
               allOk = false;
            } else {
               $(this).removeClass('is-invalid');
            }
         });

         if (allOk) {
            $('.place-order-btn, .go-back').attr('disabled', 'disabled').addClass('btn-muted');

            var _formData = {};
            if (!$('.other-address').hasClass('muted-fields')) {
               $('.other-address input[type="text"], .other-address input[type="email"], .other-address select').each(function() {
                  _formData[$(this).attr('name')] = $(this).val();
               });
               _formData['shipping_method'] = $('[name="ship-pickup"]').val();
            } else {
               _formData = JSON.parse($('input[name="shipping-address-data"]', $(`.${$('.select-address').val()}`)).val());
            }

            $('input, select, textarea', $('.other-information')).each(function() {
               _formData[$(this).attr('name')] = $(this).val();
            });

            _formData['_token'] = "{{ csrf_token() }}";
            _formData['shipping_method'] = $('[name="ship-pickup"]').val();
            _formData['shipping_cost'] = $('.shipping_price_value').attr('price');
            _formData['payment_term'] = '{{array_key_exists(md5( $payment_term ), $payment_terms_list) && $payment_terms_list[md5( $payment_term )]["PaymentTermNo"] ? $payment_terms_list[md5( $payment_term )]["PaymentTermNo"] : ""}}';
            _formData['card'] = {
               "type": $('.payment-card input[name="ccType"]:checked').val(),
               "can-skip": $('.go-to-confirmation').attr('data-skip'),
               "save-update-card": $('.save-update-card').is(':checked')
            };

            $('.payment-card .card-key-details input').each(function() {
               if (typeof $(this).val().length !== 'undefined' && $(this).val().length > 0) {
                  _formData['card'][$(this).attr('name')] = $(this).val();
                  if ($(this).hasClass('pt-encrypt')){
                     _formData['card'][$(this).attr('name')] = paytrace.encryptValue($.trim($(this).val()));
                  }
               }
            });

            if ($('.payment-card .card-type:checked').val() == 'new') {
               if ($('.same-billing-address').is(':checked')) {
                  _formData['card']['billing_address'] = {
                     'name': `${_formData['FirstName']} ${_formData['LastName']}`,
                     'address': `${_formData['Address1']} ${_formData['Address2']}`,
                     'city': _formData['City'],
                     'state': _formData['State'],
                     'zip': _formData['Zip'],
                  };
               } else {
                  _formData['card']['billing_address'] = {};
                  $('.payment-card .billing-address-section input').each(function() {
                     if (typeof $(this).val().length !== 'undefined' && $(this).val().length > 0) {
                        _formData['card']['billing_address'][$(this).attr('name')] = $(this).val();
                     }
                  });
               }
            } else {
               if (
                  typeof $('.cc-existing-billing').length !== 'undefined' &&
                  $('.cc-existing-billing').length &&
                  typeof $('.cc-existing-billing').val().length !== 'undefined' &&
                  $('.cc-existing-billing').val().length
               ) {
                  _formData['card']['billing_address'] = JSON.parse($('.cc-existing-billing').val());
                  _formData['card']['billing_address']['address'] = `${_formData['card']['billing_address']['street_address']} ${_formData['card']['billing_address']['street_address2']}`;
               }
            }

            $('.sidemark-section textarea').each(function() {
               _formData[$(this).attr('name')] = $(this).val();
            });

            {{--$.post("{{route('frontend.checkout.place_order')}}", _formData, function(data) {--}}
            $.post("/checkout/place-order", _formData, function(data) {
               if ((typeof data).toLocaleLowerCase() != 'object')
                  data = JSON.parse(data);

               if (data.success) {
                  $('#checkOut_popup .title').html('<i class="bi bi-check-circle-fill" style="color:#127812;font-size:30px;"></i> Order Placed');
                  $("#checkOut_popup .btn-back-to-home").removeAttr('data-dismiss').attr('href', "{{route('frontend.home')}}").html("Back to Home");
               } else {
                  $('#checkOut_popup .title').html('<i class="bi bi-info-circle-fill" style="color:#c90f41;font-size:30px;"></i>' +
                      's!');
                  $('#checkOut_popup .btn-back-to-home').attr('data-dismiss', 'modal').attr('href', "#").html("Close");
                  $('.place-order-btn, .go-back').removeAttr('disabled').removeClass('btn-muted');
               }
               $('#checkOut_popup .thanku-msg').html(data.msg);
               $('#checkOut_popup .backdrop').show();
               $('#checkOut_popup').modal('show');
            });
         }

         return false;
      });
      var dwidth = jQuery(window).width();
      jQuery(window).bind('resize', function(e){
         var wwidth = jQuery(window).width();
         if(dwidth!==wwidth){
         dwidth = jQuery(window).width();
         if (window.RT) clearTimeout(window.RT);
         window.RT = setTimeout(function(){
            this.location.reload(false); /* false to get page from cache */
         }, 1000);
      }
      });
   });
</script>
@endsection
