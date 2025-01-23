@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

$login_page = isset(Session::get('message')['referrer']) ? false : $login_page;
@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Login')
@section('content')

<div class="wrapper light-grey-bg p-0">
  @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
  <div class="breadcrumb-area become-form">
    <div class="container">
      <div class="row breadcrumb_box  align-items-center">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center text-sm-left">
          <h2 class="breadcrumb-title text-center">{{$login_page ? 'SIGN IN' : 'BECOME A PARTNER'}}</h2>
        </div>
      </div>
    </div>
  </div>
  <main class="main-content">
    <section class="collection-section">
      <div class="container">
        <div class="d-flex flex-column flex-dir-col justify-content-center align-items-center mt-4 mb-4">
          <div class="col-lg-6 col-sm-12 mb-sm-3 contact-mb3 contact-balance m-3 lr-login-mode" style="{{$login_page ? '' : 'display:none;'}}">
            <div class="bg-white p-5 ">
              <form class="user d-flex flex-column dafault-form" method="POST" action="{{ route('auth.login') }}">
                @csrf
                @if (Session::has('message') && isset(Session::get('message')['referer']) && Session::get('message')['referer'] == 'login' )
                <div class="alert alert-{{Session::get('message')['type']}}">
                  {{Session::get('message')['body']}}
                </div>
                @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Customer ID or Email</label>
                  <input type="text" name="email" required value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Please enter your email or SPARS ID">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" required name="password" class="form-control @error('password') is-invalid @enderror " id="password" placeholder="*********">
                </div>
                <button type="submit" class="btn btn-primary text-uppercase mt-5">Sign In</button>
                <div class="d-flex alternate-check">
                  <!-- <p><a href="#0" class="show-reset-mode">Forgot password?</a></p> -->
                  <p><a href="{{ route('forget.password.get') }}">Forget Password?</a></p>
                </div>
              </form>
            </div>
            <div class="d-flex alternate-check">
              <p>Don't Have an account <a href="#0" class="show-register-mode">Click here to create an account</a></p>
            </div>
          </div>

          <div class="col-lg-12 col-sm-12 mb-sm-3 contact-mb3 contact-balance mt-2 mb-3 lr-register-mode" style="{{$login_page ? 'display:none;' : ''}}">
            @if (Session::has('message') && isset(Session::get('message')['referrer']) && Session::get('message')['referrer'] == 'partner_requests')
            <div class="alert alert-{{Session::get('message')['type']}}">
              {{Session::get('message')['body']}}
            </div>
            @endif
            @if ($errors->any() && $errors->has('captcha_partner'))
            <div class="alert alert-danger">
              <ul>
                {{-- @foreach ($errors->all() as $error) --}}
                @foreach ($errors->get('captcha_partner') as $error)
                    @if($error == "validation.captcha")
                    <li>The CAPTCHA entered is incorrect. Please try again.</li>
                    @else
                    <li>{{ $error }}</li>
                    @endif
                @endforeach
              </ul>
            </div>
            @endif

            <form id="regForm" class="partner-form" action="{{route('form.submission', ['partner_requests'])}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="all-step"> <span class="step active"> Step 1</span> <span class="step"> Step 2</span> <span class="step"> Step 3</span> </div>
              <!-- step 1 start--->
              <div class="tab" style="display: block;">
                <h4 class="regular-title">Step 1: Tell Us About Your Company</h4>
                <h2 class="review-title d-none mb-4 review-title text-center" style="font-size: 22px;">Step 1: About Your Company</h2>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <select required class="form-control" id="sel1" name="business_type">
                        <option value="">Select a Type of Business</option>
                        <option value="E-commerce Only" @if(old('business_type') == 'E-commerce Only')selected @endif>E-Commerce Only</option>
                        <option value="Furniture Store" @if(old('business_type') == 'Furniture Store')selected @endif>Furniture Store</option>
                        <option value="Gift Store" @if(old('business_type') == 'Gift Store')selected @endif>Gift Store</option>
                        <option value="Home Decor Store" @if(old('business_type') == 'Home Decor Store')selected @endif> Home Décor Store</option>
                        <option value="Interior Designer" @if(old('business_type') == 'Interior Designer')selected @endif> Interior Designer</option>
                        <option value="Rug Store" @if(old('business_type') == 'Rug Store')selected @endif> Rug Store</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select required class="form-control" id="sel1" name="entity_type">
                        <option value="">Select a Type of Entity</option>
                        <option value="Proprietorship" @if(old('entity_type') == 'Proprietorship')selected @endif>Proprietorship</option>
                        <option value="Partnership" @if(old('entity_type') == 'Partnership')selected @endif>Partnership</option>
                        <option value="Limited Partnership" @if(old('entity_type') == 'Limited Partnership')selected @endif>Limited Partnership</option>
                        <option value="Corporation" @if(old('entity_type') == 'Corporation')selected @endif>Corporation</option>
                        <option value="Limited Liability Company (LLC)" @if(old('entity_type') == 'Limited Liability Company (LLC)')selected @endif>Limited Liability Company (LLC)</option>
                        <option value="Nonprofit Organization" @if(old('entity_type') == 'Nonprofit Organization')selected @endif>Nonprofit Organization</option>
                        <option value="Corporation" @if(old('entity_type') == 'Corporation')selected @endif>Cooperative</option>
                        <option value="Others" @if(old('entity_type') == 'Others')selected @endif>Others</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" maxlength="9" placeholder="DUNS#" oninput="this.className = ''" name="DUNS" id="duns" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" data-required="true" value="{{ old('company') }}" name="company" class="form-control @error('company') is-invalid @enderror" id="business_name" aria-describedby="CompanyName" placeholder="Owner/Business Name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Owner/Business Email" type="email" value="{{ old('business_email') }}" oninput="this.className = ''" name="business_email" id="business_email" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Owner/Business Contact No." value="{{ old('business_contact') }}" oninput="this.className = ''" name="business_contact" id="business_contact" class="form-control">
                    </div>
                  </div>
                  <!--
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" data-required="true" name="reg-password" maxlength="12" minlength="8" class="form-control @error('password') is-invalid @enderror" id="regPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" data-required="true" name="cpassword" maxlength="12" minlength="8" class="form-control @error('password') is-invalid @enderror" id="cpassword" placeholder="Confirm Password">
                    </div>
                  </div>
                  -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" data-required="true" value="{{ old('firstname') }}" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="buyer_name" aria-describedby="Name" placeholder="Buyer Name">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="email" data-required="true" value="{{ old('reg-email') }}" name="reg-email" class="form-control @error('reg-email') is-invalid @enderror" id="buyer_email" aria-describedby="emailHelp" placeholder="Buyer Email">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="buyer_contact" aria-describedby="PhoneNumber" placeholder="Buyer Contact No.">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="SO Acknowledgement Recipient Contact Name" value="{{ old('acknowledgement_recipient_contact_name') }}"  oninput="this.className = ''" name="acknowledgement_recipient_contact_name" id="ack_contname" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="SO Acknowledgement Recipient Email" value="{{ old('acknowledgement_recipient_email') }}" type="email" oninput="this.className = ''" name="acknowledgement_recipient_email" id="ack_rec_email" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="SO Acknowledgement Recipient Contact No." oninput="this.className = ''" name="acknowledgement_recipient_contact" value="{{ old('acknowledgement_recipient_contact') }}" id="ack_rec_contact" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="Accounts Payable Name" oninput="this.className = ''" name="accounts_payable_name" value="{{ old('accounts_payable_name') }}" id="accnts_payable_name" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="Accounts Payable Email" type="email" oninput="this.className = ''" name="accounts_payable_email" value="{{ old('accounts_payable_email') }}" id="accnts_payable_email" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input placeholder="Accounts Payable Contact No." oninput="this.className = ''" name="accounts_payable_phone" value="{{ old('accounts_payable_phone') }}" id="accnts_payable_phone" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Sales Rep" oninput="this.className = ''" name="sales_rep" id="sales_rep" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Tax ID / EIN / Federal tax ID" oninput="this.className = ''" name="tax_id" value="{{ old('tax_id') }}" id="tax_id" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <input type="hidden" name="dba_certificate" id="dba_certificate" value="dba certificate">
                  <input type="hidden" name="duns_certificate" id="duns_certificate" value="duns certificate">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Sales &amp; tax exemption certificate</label>
                      <input oninput="this.className = ''" name="attachment" id="stax_certificate" class="form-control" type="file" accept=".jpeg, .jpg, .pdf" onchange="Filevalidation('stax_certificate')">
                      Please Upload upto 3MB Pdf or Jpeg file
                    </div>
                  </div>
                </div>
              </div>

              <!-- step 2 start--->
              <div class="tab">
                <h4 class="regular-title">Step 2: Tell us about yourself</h4>
                <h2 class="review-title d-none mb-4 review-title text-center" style="font-size: 22px;">Step 2: About Yourself</h2>
                <h3 class="inner-form-heading">Billing Address</h3>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Business Name" oninput="this.className = ''" name="billing_buisname" value="{{ old('billing_buisname') }}" id="billing_buisname" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="DBA" oninput="this.className = ''" name="billing_dba" id="billing_dba" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Billing Address Line 1" oninput="this.className = ''" name="billing_address" value="{{ old('billing_address') }}" id="billing_address" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Billing Address Line 2" oninput="this.className = ''" name="billing_address_two" id="billing_address_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select required class="form-control" id="sel1" name="billing_cntry">
                        <option value="">Select Country</option>
                        <option value="United States" selected="selected">United States</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                    <select required class="form-control" data-state-type="billing" id="billing_state" name="billing_state"></select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="div_billing_city">
                      <select class="form-control" id="billing_city" name="billing_city">
                        <option value="">Select City</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Zip" oninput="this.className = ''" name="billing_zip" id="billing_zip" value="{{ old('billing_zip') }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Phone No." oninput="this.className = ''" name="billing_phone" id="billing_phone" value="{{ old('billing_phone') }}"  class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Email Id" oninput="this.className = ''" name="billing_email" id="billing_email" value="{{ old('billing_email') }}" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>
                <h3 class="inner-form-heading">Shipping Address</h3>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="chk_sameshipping" id="chk_sameshipping" value="Yes" style="width:20px" onclick="sameAsBilling();">
                    if shipping address is same as billing address</label>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Business Name" oninput="this.className = ''" name="shipping_buisname" value="{{ old('shipping_buisname') }}" id="shipping_buisname" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="DBA" oninput="this.className = ''" name="shipping_dba" id="shipping_dba" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Shipping Address Line 1" oninput="this.className = ''" name="shipping_address" value="{{ old('shipping_address') }}" id="shipping_address" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Shipping Address Line 2" oninput="this.className = ''" name="shipping_address_two" id="shipping_address_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select required class="form-control" name="shipping_cntry">
                        <option value="">Select Country</option>
                        <option value="United States" selected="selected">United States</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select required class="form-control" data-state-type="shipping" name="shipping_state" id="shipping_state"></select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="div_shipping_city">
                      <select class="form-control" name="shipping_city" id="shipping_city">Select City</select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Zip" oninput="this.className = ''" name="shipping_zip" id="shipping_zip" value="{{ old('shipping_zip') }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Phone No." oninput="this.className = ''" name="shipping_phone" id="shipping_phone" value="{{ old('shipping_phone') }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Email Id" oninput="this.className = ''" name="shipping_email" id="shipping_email" value="{{ old('shipping_email') }}"  class="form-control">
                    </div>
                  </div>
                </div>

              </div>
              <!-- step 3 start--->
              <div class="tab">
                <h4 class="regular-title">Step 3: Tell Us About Your Payment Method</h4>
                <h2 class="review-title d-none mb-4 review-title text-center" style="font-size: 22px;">Step 3: About Your Payment Method</h2>
                <label class="radio-inline">
                  <input type="radio" name="payment_method" checked="" value="Payment on Terms">
                  Payment on Terms*</label>
                <label class="radio-inline">
                  <input type="radio" name="payment_method" value="Payment By Card">
                  Payment By Card</label>
                <small style="display:block">*Disclaimer: Payment on terms will be reviewed and confirmed as per company policy only.</small>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Bank name" oninput="this.className = ''" name="bank_name" id="bank_name" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control" id="sel1" name="bank_type">
                        <option value="">Select a Bank Account Type</option>
                        <option value="Checking">Checking</option>
                        <option value="Saving">Savings</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input placeholder="Address" oninput="this.className = ''" name="bank_address" id="bank_address" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Phone" oninput="this.className = ''" name="bank_phone" id="bank_phone" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Bank Account No./ Card No." name="bank_accnt_number" id="bank_accnt_number" class="form-control" onblur="show_acnt_number(this.value);">
                    </div>
                  </div>
                </div>
                <input type="hidden" value="routing numebr" placeholder="Bank Routing #" oninput="this.className = ''" name="bank_routing_number" id="bank_routing_number" class="form-control">
                <!--<div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <input placeholder="Bank Routing #" oninput="this.className = ''" name="bank_routing_number" id="bank_routing_number" class="form-control">
                          </div>
                        </div>
                        <input type="hidden" name="bank_sales_tax" id="bank_sales_tax" value="">

                      </div>-->
                <h4>Please List Three Other Credit Reference Which We May Check</h4>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Name" oninput="this.className = ''" name="cdt_refname_one" id="cdt_refname_one" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Address" oninput="this.className = ''" name="cdt_refaddress_one" id="cdt_refaddress_one" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Phone" oninput="this.className = ''" name="cdt_refphne_one" id="cdt_refphne_one" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Email" oninput="this.className = ''" name="cdt_refemail_one" id="cdt_refemail_one" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Name" oninput="this.className = ''" name="cdt_refname_two" id="cdt_refname_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Address" oninput="this.className = ''" name="cdt_refaddress_two" id="cdt_refaddress_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Phone" oninput="this.className = ''" name="cdt_refphne_two" id="cdt_refphne_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Email" type="email" oninput="this.className = ''" name="cdt_refemail_two" id="cdt_refemail_two" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Name" oninput="this.className = ''" name="cdt_refname_three" id="cdt_refname_three" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Address" oninput="this.className = ''" name="cdt_refaddress_three" id="cdt_refaddress_three" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Phone" oninput="this.className = ''" name="cdt_refphne_three" id="cdt_refphne_three" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input placeholder="Email" oninput="this.className = ''" name="cdt_refemail_three" id="cdt_refemail_three" class="form-control">
                    </div>
                  </div>
                </div>
                <p>In making this application, I/We understand that all accounts are payable according to the terms as shown on each invoice, and if not paid on or before said date, are
                  then delinquent. All charges are due and payable in full at P.O. Box 6131, Dalton, GA 30720, unless otherwise notified in writing to the contrary. If credit is granted,
                  I/we agree to the above terms and the undersigned is/are responsible for the payment of the account. I/We do further agree that if my/our account must be placed
                  in the hands of an attorney of collection, or if collection is made through proceedings. I/We will pay a reasonable amount in attorney’s fees. It is further understood
                  that when payment is not made in accordance with terms of each invoice, shipment of future orders will be withheld. </p>
                <hr>
                <h4> Credit Card Payment Authorization Form</h4>
                <div class="row">
                  <div class="col-md-12">
                    <p>I <strong id="owner_name">Name Will come Auto fill</strong> authorize L.R. Resources to charge my Bank Account No./ Card No. (as mentioned above) <strong id="owner_cc_no"></strong> for payment of my Invoice(s).
                      l understand that L.R. Resources charge 2% fee for Paying by Bank Account No./ Card No.</p>
                  </div>
                </div>
                <div class="row" style="margin-top:15px;">

                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Billing Address Line 1" oninput="this.className = ''" name="cdt_billing_address" id="cdt_billing_address" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Billing Address Line 2" oninput="this.className = ''" name="cdt_billing_address_two" id="cdt_billing_address_two" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select class="form-control" id="cdt_cntry" name="cdt_cntry">
                        <option value="">Select Country</option>
                        <option value="United States" selected="selected">United States</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select class="form-control" data-state-type="cdt" id="cdt_state" name="cdt_state">
                        <option value="">State</option>
                        <option value="3919">Alabama</option>
                        <option value="3920">Alaska</option>
                        <option value="3921">Arizona</option>
                        <option value="3922">Arkansas</option>
                        <option value="3923">Byram</option>
                        <option value="3924">California</option>
                        <option value="3925">Cokato</option>
                        <option value="3926">Colorado</option>
                        <option value="3927">Connecticut</option>
                        <option value="3928">Delaware</option>
                        <option value="3929">District of Columbia</option>
                        <option value="3930">Florida</option>
                        <option value="3931">Georgia</option>
                        <option value="3932">Hawaii</option>
                        <option value="3933">Idaho</option>
                        <option value="3934">Illinois</option>
                        <option value="3935">Indiana</option>
                        <option value="3936">Iowa</option>
                        <option value="3937">Kansas</option>
                        <option value="3938">Kentucky</option>
                        <option value="3939">Louisiana</option>
                        <option value="3940">Lowa</option>
                        <option value="3941">Maine</option>
                        <option value="3942">Maryland</option>
                        <option value="3943">Massachusetts</option>
                        <option value="3944">Medfield</option>
                        <option value="3945">Michigan</option>
                        <option value="3946">Minnesota</option>
                        <option value="3947">Mississippi</option>
                        <option value="3948">Missouri</option>
                        <option value="3949">Montana</option>
                        <option value="3950">Nebraska</option>
                        <option value="3951">Nevada</option>
                        <option value="3952">New Hampshire</option>
                        <option value="3953">New Jersey</option>
                        <option value="3954">New Jersy</option>
                        <option value="3955">New Mexico</option>
                        <option value="3956">New York</option>
                        <option value="3957">North Carolina</option>
                        <option value="3958">North Dakota</option>
                        <option value="3959">Ohio</option>
                        <option value="3960">Oklahoma</option>
                        <option value="3961">Ontario</option>
                        <option value="3962">Oregon</option>
                        <option value="3963">Pennsylvania</option>
                        <option value="3964">Ramey</option>
                        <option value="3965">Rhode Island</option>
                        <option value="3966">South Carolina</option>
                        <option value="3967">South Dakota</option>
                        <option value="3968">Sublimity</option>
                        <option value="3969">Tennessee</option>
                        <option value="3970">Texas</option>
                        <option value="3971">Trimble</option>
                        <option value="3972">Utah</option>
                        <option value="3973">Vermont</option>
                        <option value="3974">Virginia</option>
                        <option value="3975">Washington</option>
                        <option value="3976">West Virginia</option>
                        <option value="3977">Wisconsin</option>
                        <option value="3978">Wyoming</option>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-md-3">
                          <div class="form-group" id="div_cdt_city">
                             <input placeholder="Billing Address Line 1" oninput="this.className = ''" name="fname" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input placeholder="Billing Address Line 2" oninput="this.className = ''" name="fname" class="form-control">
                          </div>
                        </div>-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <input placeholder="Phone No." oninput="this.className = ''" name="cdt_phone" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input placeholder="Email Id" oninput="this.className = ''" name="cdt_email" class="form-control">
                    </div>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input data-disable="1" type="checkbox" name="chk_terms" value="form-name" style="width:20px" checked="checked">
                      Authorization/ I agree to all the terms &amp; conditions of L R Home as per their company policy</label>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="captcha-container captcha_partner_container" style="width: 40%">
                        <!-- CAPTCHA Image -->
                        <div class="d-flex flex-col">
                            <div id="captcha_image_form_partner" class="captcha_image" style="width: 30%">
                                {!! captcha_img('partner_requests') !!}
                            </div>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi64Rl_oZ-ygLyFWlgIUfRer0v21agZtQg0y_EKFjs31fqJ6aLmv5Aqjx6ySbw60enZ0U&usqp=CAU"
                            alt="refresh" id="refresh-captcha" class="mx-1"  style="width:46px; height:38px; min-width: 0% !important" onclick="refreshCaptcha()">

                        </div>
                        <input type="text" name="captcha_partner" id="captcha_partner" placeholder="Enter CAPTCHA"  class="form-control captcha-input mt-1" required>
                        <div>
                            @error('captcha_partner')
                                <div class="text-danger captcha_partner">The CAPTCHA entered is incorrect. Please try again.</div>
                            @enderror
                        </div>
                      </div>
                    </div>
                <!-- <a href="#" class="btn btn--md btn--border_1"> Make Payment Now </a> -->
              </div>
              <div>
                <div class="d-flex pull-right">
                  <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn--md btn--border_1 mr-2" style="display: none;"> Previous </button>
                  <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn--md btn--border_1">Next</button>
                  <button type="button" id="review" class="btn btn--md btn--border_1 d-none">Review Details</button>
                  <button type="submit" id="submitForm" class="btn btn--md btn--border_1 d-none">Submit</button>
                  {{-- <button type="button" id="submit" class="g-recaptcha btn btn--md btn--border_1 d-none"
                          data-sitekey="{{config('services.recaptcha.key')}}"
                          data-callback='onSubmitPartnerRequest'
                          data-action='submit'>Submit</button> --}}
                          <button type="submit" id="submit" class="btn btn--md btn--border_1 d-none">Submit</button>

                </div>
              </div>
              <!-- Circles which indicates the steps of the form: -->
            </form>
            <div class="d-flex alternate-check mt-3" style="margin-top: 100px !important;">
              <p>Already have an account <a href="#0" class="show-login-mode">Click here to login</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection
@section('scripts')
<style>
    @media (max-width:520px) {
        .all-step .step{
            width: 65px;
        }
    }
</style>
@parent
<script type="text/javascript">
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab
  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:

    if (n == 1 && !validateForm()) return false;

    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      //document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    console.log('x val', x);
    console.log('cur tab', currentTab);
    console.log('y val', y);
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {

    if(y[i].id != "duns" && y[i].id != "sales_rep" && y[i].id != "billing_address_two" && y[i].id != "billing_dba" && y[i].id != "shipping_dba"  && y[i].id != "shipping_address_two"){
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
            document.getElementById(y[i].id).style.borderColor = 'red';
        } else {
            document.getElementById(y[i].id).style.borderColor = 'green';
        }
    }

      if (y[i].id == "business_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Owner business email is invalid");
          document.getElementById("business_email").style.borderColor = 'red';
          valid = false;
        }
      } else if (y[i].id == "buyer_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Buyer email is invalid");
          document.getElementById("buyer_email").style.borderColor = 'red';
          valid = false;
        }

      } else if (y[i].id == "ack_rec_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("SO Acknowledgement recipient email is invalid.");
          document.getElementById("ack_rec_email").style.borderColor = 'red';
          valid = false;
        }

      } else if (y[i].id == "accnts_payable_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Accounts payable email is invalid.");
          document.getElementById("accnts_payable_email").style.borderColor = 'red';
          valid = false;
        }

      } else if (y[i].id == "billing_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Billing Email is invalid.");
          document.getElementById("billing_email").style.borderColor = 'red';
          valid = false;
        }

      } else if (y[i].id == "shipping_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Shipping Email is invalid.");
          document.getElementById("shipping_email").style.borderColor = 'red';
          valid = false;
        }
      } else if (y[i].id == "cdt_refemail_one" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Credit reference email is invalid.");
          document.getElementById("cdt_refemail_one").style.borderColor = 'red';
          valid = false;
        }
      } else if (y[i].id == "cdt_refemail_two" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Credit reference email is invalid.");
          document.getElementById("cdt_refemail_two").style.borderColor = 'red';
          valid = false;
        }
      } else if (y[i].id == "cdt_refemail_three" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Credit reference email is invalid.");
          document.getElementById("cdt_refemail_three").style.borderColor = 'red';
          valid = false;
        }
      } else if (y[i].id == "cdt_email" && y[i].value != "") {
        if (!isValidEmailAddress(y[i].value)) {
          alert("Credit card email is invalid.");
          document.getElementById("cdt_email").style.borderColor = 'red';
          valid = false;
        }

      } else if (y[i].id == "chk_terms") {
        if (y[i].checked == false) {
          alert("I accept terms and conditions.");
          valid = false;

        }

      }
      /*
      if (valid && $('input[name="reg-password"]').val() != $('input[name="cpassword"]').val()) {
        $('input[name="reg-password"], input[name="cpassword"]').css({'border-color': 'red'});
        valid = false;
      }
      */
    }


    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      $('#nextBtn').addClass('d-none');
      $('#review').removeClass('d-none');
      // document.getElementById("nextBtn").innerHTML = "<input type='submit' name='btnSubmit' value='Submit' class='btn btn--md btn--border_1 set-btn'>";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }

  function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
  }


  function sameAsBilling() {
    if (document.getElementById("chk_sameshipping").checked == true) {
      $("#shipping_state").val($("#billing_state").val()).change();
      $("#shipping_city").val($("#billing_city").val()).attr('data-default', $("#billing_city").val());
      $("#shipping_buisname").val($("#billing_buisname").val());
      $("#shipping_dba").val($("#billing_dba").val());
      $("#shipping_address").val($("#billing_address").val());
      $("#shipping_address_two").val($("#billing_address_two").val());
      $("#shipping_zip").val($("#billing_zip").val());
      $("#shipping_phone").val($("#billing_phone").val());
      $("#shipping_email").val($("#billing_email").val());
    } else {
      $("#shipping_buisname").val('');
      $("#shipping_dba").val('');
      $("#shipping_address").val('');
      $("#shipping_address_two").val('');
      $("#shipping_state").val('');
      $("#shipping_zip").val('');
      $("#shipping_phone").val('');
      $("#shipping_email").val('');
    }
  }


  function Filevalidation(field_id) {
    var extension = $("#" + field_id).val().split('.').pop().toLowerCase();
    var validFileExtensions = ['jpeg', 'jpg', 'pdf'];
    if ($.inArray(extension, validFileExtensions) == -1) {
      alert("Only PDF and Jpeg extension(s) are allowed to upload.")
      $(this).replaceWith($("#" + field_id).val('').clone(true));
    } else {
      const fi = document.getElementById(field_id);
      if (fi.files.length > 0) {
        for (var i = 0; i <= fi.files.length - 1; i++) {

          const fsize = fi.files.item(i).size;
          const file = Math.round((fsize / 1024));
          if (file >= 4096) {
            alert("Uploaded file is too big. Please upload less than 3 MB size");
          }
        }
      }
    }
  }

  function show_cities(stateID, cName, divName) {
    if (stateID) {
      var cities_parameters = 'state_id=' + stateID + '&cntl_name=' + cName + '&div_name=' + divName;
      $.ajax({
        url: "https://lrhome.us/ajax/cities.php", // TODO : need check the algo
        type: "POST",
        data: cities_parameters,
        success: function(response) {
          var parsed_cont = jQuery.parseJSON(response);
          $("#" + divName).html(parsed_cont.output);
        }
      });
    }
  }

  function show_businessinfo(enterVal) {
    $("#owner_name").html(enterVal)
  }

  function show_acnt_number(actVal) {
    $("#owner_cc_no").html(actVal)
  }

  $(document).ready(function() {
    $.ajax({
      "url": "https://countriesnow.space/api/v0.1/countries/states",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json"
      },
      "data": JSON.stringify({
        "country": "United States"
      }),
    }).done(function (response) {
      var options = "<option>Select State</option>";
      if ( !response.error ) {
        response.data.states.map((state) => {
          options += `<option value="${state.name}">${state.name}</option>`;
        });
      }
      $('#shipping_state, #billing_state, #cdt_state').html(options);
    });

    $('#shipping_state, #billing_state').change(function() {
      var _this = $(this);
      $(`#${_this.attr('data-state-type')}_city`).html('<option>Loading...</option>').attr('disabled', 'disabled');
      $.ajax({
        "url": "https://countriesnow.space/api/v0.1/countries/state/cities",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "country": "United States",
          "state": _this.val()
        }),
      }).done(function (response) {
        var options = "<option>Select City</option>";
        if ( !response.error ) {
          response.data.map((city) => {
            options += `<option value="${city}" ${typeof $(`#${_this.attr('data-state-type')}_city`).attr('data-default') !== "undefined" && $(`#${_this.attr('data-state-type')}_city`).attr('data-default') == city ? 'selected' : ''}>${city}</option>`;
          });
        }
        $(`#${_this.attr('data-state-type')}_city`).html(options).removeAttr('disabled');
      });
    });

    $('button#review').off('click').on('click', function() {
      $('.regular-title, .all-step, #prevBtn, #nextBtn').hide().addClass('d-none');
      $('.review-title').show().removeClass('d-none');
      $('#regForm input').each(function(){
        if ( typeof $(this).attr('data-disable') !== 'undefined' )
          $(this).parent().attr('readonly', 'readonly').css({'pointer-events': 'none'});
        else
          $(this).removeAttr('style');
      });
      $('#regForm input[type="text"], #regForm input[type="file"]').removeAttr('style');
      // $('#regForm input').removeAttr('style').attr('readonly', 'readonly').css({'pointer-events': 'none'});
      $(this).addClass('d-none');
      $('.tab').show();
      window.scroll({
        top: $('.become-form').offset().top,
        left: 0,
        behavior: 'smooth'
      });
      $('.breadcrumb-title').html('REVIEW PARTNER FORM');
      $('button#submit').removeClass('d-none');
    });

    $(".show-register-mode").on("click", function() {
      $(".lr-register-mode").fadeIn();
      $(".lr-login-mode").fadeOut();
      $('.breadcrumb-title').html('BECOME A PARTNER');
    });
    $(".show-login-mode").on("click", function() {
      $(".lr-register-mode").fadeOut();
      $(".lr-login-mode").fadeIn();
      $('.breadcrumb-title').html('SIGN IN');
    });

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    $('form.partner-form').on('submit', function() {
      var allOk = true;
      /*
      $('input[data-required="true"], select[data-required="true"]').each(function() {
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

      if (allOk && !validateEmail($('input[name="reg-email"]').val())) {
        $('input[name="reg-email"]').addClass('is-invalid');
        allOk = false;
      }
      */

      if (allOk && $('input[name="reg-password"]').val() != $('input[name="cpassword"]').val()) {
        $('input[name="reg-password"], input[name="cpassword"]').addClass('is-invalid');
        allOk = false;
      }

      return allOk;
    });
  });
</script>
@endsection
