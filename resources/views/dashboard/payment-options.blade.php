@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Payments')
@section('content')
<div class="wrapper admin-side">
    @include('dashboard.components.header')
    <main class="main-content">
        <section class="collection-section">
            <div class="container">
                <div class="d-flex payment-options-main-div">
                    <div class="col-lg-3 col-sm-6 col-6 sidebar-main">
                        @include('dashboard.components.sidebar')
                    </div>
                    <div class="col-xl-9 col-lg-12 col-sm-12 col-12 py-0">
                        @if (Session::has('message'))
                        <div class="alert alert-{{Session::get('message')['type']}}">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {!!Session::get('message')['body']!!}
                        </div>
                        @endif
                        <div class="account-content p-5 px-sm-3 balanced_options">
                            @if(!$payments_enabled)
                            <h1 class="section-title text-center mb-3 mt-3 font-ropa">Payments are not configured yet.</h1>
                            @else
                            <h1 class="section-title text-center mb-3 mt-3 font-ropa">Customer Credit Card</h1>
                            @if($customers)
                            <form class="row customer-selection">
                                <div class="col-md-12 mb-1">
                                    <label class="text-lg">Active Customer: </label>
                                    <select name="customer" class="form-control">
                                        @foreach($customers as $customer)
                                        <option value="{{$customer['value']}}" {{$active_customer && $active_customer == $customer['value'] ? 'selected' : '' }}>
                                            {{$customer['label']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            @endif
                            <div class="col-md-12 mt-4 tabs-all p-0">
                                <ul class="nav nav-pills tabular mb-3 flex-row flex-nowrap ms-0" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Credit Card on File</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? 'Replace Existing Credit Card' : 'Add Credit Card'}}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade pb-4 show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <h2 style="font-size:24px;color: #EA7410;">
                                            @if(isset($customer_payment_options['customers']) && $customer_payment_options['customers'])
                                            Card on File
                                            @else
                                            No Card Attached
                                            @endif
                                        </h2>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(isset($customer_payment_options['customers']) && $customer_payment_options['customers'])
                                                <p class="mr-2 pull-left">{{$customer_payment_options['customers'][0]['credit_card']['masked_number']}}</p>
                                                <span class="pull-left" style="font-size:16px;color: #EA7410;">Expires On</span>
                                                <p class="ml-2 pull-left">{{$customer_payment_options['customers'][0]['credit_card']['expiration_month']}}/{{$customer_payment_options['customers'][0]['credit_card']['expiration_year']}} </p>
                                                @endif
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <img style="width: 200px;min-width: 180px;" src="{{url('/').'/LR/images/cards.png?v=0.2'}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <form method="POST" action="{{route('dashboard.savepaymentoptions')}}" class="d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3 credit-card">
                                            {{csrf_field()}}
                                            <input type="hidden" name="customer" value="{{$active_customer}}" />
                                            <div class="payment-card col p-0 px-md-3 px-lg-3 py-0">
                                                <div class="new-cc-section">
                                                    <div class="card-key-details row">
                                                        <div class="form-group col-md-12">
                                                            <label for="ccNumber" class="p-0 m-0">Card Number</label>
                                                            <div class="input-group">
                                                                <input type="text" data-inputmask="'mask': '9999 9999 9999 9999'" {{$card_required}} id="ccNumber" class="form-control pt-encrypt" />
                                                                <input type="hidden" name="ccNumber" value="" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-credit-card"></span> -->
                                                                    <span class="bi bi-credit-card-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-key-details row">
                                                        <div class="form-group col-md-6">
                                                            <label for="expiry_date" class="p-0 m-0">Expiry Date</label>
                                                            <div class="input-group">
                                                                <input type="text" data-inputmask="'mask': '99 / 99'" name="ccExpiry" {{$card_required}} id="expiry_date" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-calendar"></span> -->
                                                                    <span class="bi bi-calendar-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="ccCSC" class="p-0 m-0">CVV/CVC</label>
                                                            <div class="input-group">
                                                                <input type="text" data-inputmask="'mask': '9999'" {{$card_required}} id="ccCSC" class="form-control pt-encrypt" />
                                                                <input type="hidden" name="ccCSC" value="" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-lock"></span> -->
                                                                    <span class="bi bi-lock-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="billing-address-section row">
                                                        <div class="col-md-12">
                                                            <h4 class="font-ropa mb-3 mt-3">Billing Address</h4>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="name" class="p-0 m-0">Name</label>
                                                            <div class="input-group">
                                                                <input type="text" {{$card_required}} id="name" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? $customer_payment_options['customers'][0]['billing_address']['name'] : ''}}" name="billing_address[name]" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-user"></span> -->
                                                                    <span class="bi bi-person-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="address" class="p-0 m-0">Address</label>
                                                            <div class="input-group">
                                                                <input type="text" {{$card_required}} id="address" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? $customer_payment_options['customers'][0]['billing_address']['street_address'] : ''}}" name="billing_address[address]" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-address-card"></span> -->
                                                                    <span class="bi bi-person-badge-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="city" class="p-0 m-0">City</label>
                                                            <div class="input-group">
                                                                <input type="text" {{$card_required}} id="city" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? $customer_payment_options['customers'][0]['billing_address']['city'] : ''}}" name="billing_address[city]" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-location-arrow"></span> -->
                                                                    <span class="bi bi-geo-alt-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="state" class="p-0 m-0">State</label>
                                                            <div class="input-group">
                                                                <input type="text" {{$card_required}} id="state" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? $customer_payment_options['customers'][0]['billing_address']['state'] : ''}}" name="billing_address[state]" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-location-arrow"></span> -->
                                                                    <span class="bi bi-geo-alt-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="zip" class="p-0 m-0">Zip</label>
                                                            <div class="input-group">
                                                                <input type="text" {{$card_required}} id="zip" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? $customer_payment_options['customers'][0]['billing_address']['zip'] : ''}}" name="billing_address[zip]" class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="fa fa-location-arrow"></span> -->
                                                                    <span class="bi bi-geo-alt-fill"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 pull-right">
                                                    <button type="submit" name="submit" value="{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? 'update' : 'create'}}" class="btn btn-primary text-uppercase mt-2">{{isset($customer_payment_options['customers']) && $customer_payment_options['customers'] ? 'Update' : 'Save'}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    @include('dashboard.components.footer')
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{asset('/LR/css/vendor/vendor.min.css')}}">
<style>
    .input-group-addon {
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #e4e4e4;
    }
</style>
@endsection
@section('head_scripts')
<script language="javascript" src="https://api.paytrace.com/assets/e2ee/paytrace-e2ee.js"></script>
@endsection
@section('scripts')
<!-- INPUT MASK -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if (typeof paytrace !== 'undefined')
            {{--paytrace.setKeyAjax('{{route("checkout.security")}}');--}}
            paytrace.setKeyAjax('/checkout/pt/security');

        $("[data-inputmask]").inputmask({
            greedy: false,
            placeholder: ""
        });

        $('form.customer-selection select[name="customer"]').on('change', function() {
            $(this).closest('form').submit();
        });

        $('form.credit-card').on('submit', function() {
            var allOk = true;
            $('.payment-card input[data-required="true"], .payment-card select[data-required="true"]').each(function() {
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
                $('input.pt-encrypt').each(function() {
                    $(`[name="${$(this).attr('id')}"]`).val(paytrace.encryptValue($.trim($(this).val())));
                });
            }

            return allOk;
        });

    });
</script>
@endsection
