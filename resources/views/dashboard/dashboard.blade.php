@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Home')
@section('content')
<div class="wrapper admin-side">
    @include('dashboard.components.header')
    <main class="main-content">

        <section class="collection-section">
            <div class="container">

                <div class="d-flex flex-row">
                    <div class="col-lg-3 col-sm-6 col-6 sidebar-main">
                        @include('dashboard.components.sidebar')
                    </div>
                    <div class="col-xl-9 col-lg-12 col-sm-12 col-12 py-0">
                        <div class="account-content p-5">
                            @if(count($client_address))
                            <h1 class="section-title text-center mb-3 font-ropa">What would you like to do?</h1>
                            {{-- <div class="alert alert-warning text-center" role="alert">
                                    You have currently selected to order as customer <i> {{$client_address['CustomerAddress']['BillToAddresses'][0]['FirstName'].' '.$client_address['CustomerAddress']['BillToAddresses'][0]['LastName']}} </i>. You have the following options as the customer. The customer information is listed below.
                        </div> --}}
                        @elseif ( Auth::user()->is_sale_rep )
                            <h1 class="section-title text-center mb-3 font-ropa">Please select a customer to enjoy features of this Dashboard.</h1>
                            <div class="alert alert-warning text-center" role="alert">
                                You have currently selected no customer. Selecting customer is a very easy process. Just go to an item page and add an item in the cart and during the process you will be asked to select a customer. Once done the Dashboard will also reflect the selected customer.
                            </div>
                        @endif
                        <div class="d-flex flex-row flex-md-wrap flex-sm-wrap justify-content-between">
                            @php
                                $hasManageOrdersPermission = !empty(Auth::user()->getPermissions()) && in_array('manage-orders', Auth::user()->getPermissions());
                                $hasManageFinacialPermission = !empty(Auth::user()->getPermissions()) && in_array('manage-financials', Auth::user()->getPermissions());
                            @endphp
                            @if($hasManageOrdersPermission || empty(Auth::user()->getPermissions()))
                                <a href="{{ route('dashboard.placeorder') }}" class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('Dashboard/images/icon-dashboard-bag.svg') }}" class="icon-img" style="width:23.69px;" />
                                        <h5 class="card-title font-ropa">Place An Order</h5>
                                        <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                                    </div>
                                </a>
                            @endif
                            <a href="{{url('/')}}" class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body text-center">
                                    <img src="{{asset('Dashboard/images/icon-dashboard-box.svg')}}" class="icon-img" style="width:28.74px;" />
                                    <h5 class="card-title font-ropa">Browse Products</h5>
                                    <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                                </div>
                            </a>
                            @if($hasManageOrdersPermission || empty(Auth::user()->getPermissions()))
                            <a href="{{route('dashboard.vieworder')}}" class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body text-center">
                                    <img src="{{asset('Dashboard/images/icon-dashboard-status.svg')}}" class="icon-img" style="width:26.87px;" />
                                    <h5 class="card-title font-ropa">Check Order Status</h5>
                                    <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                                </div>
                            </a>
                            @endif
                            @if($hasManageOrdersPermission || empty(Auth::user()->getPermissions()))
                            <a href="{{$active_theme_json->general->use_company_credit ? route('dashboard.companycredit', ['rtype' => 'invoices']) : route('dashboard.invoice')}}" class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-body text-center">
                                    <img src="{{asset('Dashboard/images/icon-dashboard-invoice.svg')}}" class="icon-img" style="width:26.44px;" />
                                    <h5 class="card-title font-ropa">Review Invoice</h5>
                                    <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                                </div>
                            </a>
                            @endif
                        </div>
                        @if(count($client_address))
                        <div class="d-flex light-grey-bg p-4 mt-3 flex-column">
                            {{--
                            <h2 class="section-title text-center mb-3 font-ropa"> {{$client_address['CustomerAddress']['BillToAddresses'][0]['FirstName'].' '.$client_address['CustomerAddress']['BillToAddresses'][0]['LastName']}}</h2>
                            <div class="d-flex justify-content-between mb-5 flex-sm-wrap">
                                <div class="d-flex flex-column bill-to mt-3 col-md-7">
                                    <h6 class="font-ropa">Bill To</h6>
                                    <p>{{$client_address['CustomerAddress']['BillToAddresses'][0]['Address1']}} <br /> {{$client_address['CustomerAddress']['BillToAddresses'][0]['Address2']}},{{$client_address['CustomerAddress']['BillToAddresses'][0]['City']}} {{$client_address['CustomerAddress']['BillToAddresses'][0]['State']}} {{$client_address['CustomerAddress']['BillToAddresses'][0]['Zip']}}, {{$client_address['CustomerAddress']['BillToAddresses'][0]['Country']}}</p>
                                    <p class="mt-2">P: {{$client_address['CustomerAddress']['BillToAddresses'][0]['Phone1']}}</p>
                                    <p class="mt-2">F: {{$client_address['CustomerAddress']['BillToAddresses'][0]['Fax']}}</p>
                                </div>
                                <div class="d-flex flex-column bill-to mt-3 col-md-3">
                                    <h6 class="font-ropa">Account Info</h6>
                                    <p>Your Account Representative:</p>
                                    <p>Oriental Rug Gallery, L.P</p>
                                    <p style="color: #086AD8;">oriental@example.com</p>
                                    <h6 class="font-ropa mt-4">Reward Level: Bronze</h6>
                                    <p>Last Login: 1/18//2021 6:42:42 AM</p>
                                </div>
                            </div>
                            --}}
                        </div>
                        @endif
                    </div>
                    @if($active_theme_json->general->show_recent_orders && ($hasManageOrdersPermission || empty(Auth::user()->getPermissions())))
                    <div class="card mt-4 p-4">
                        <h3 class="font-ropa">
                            <span>Recent Orders</span>
                            <a href="{{route('dashboard.vieworder')}}" class="font-black-14 ml-2 text-decoration-underline text-primary">View All</a>
                        </h3>
                        <div class="table-container font-ropa">
                            <!-- TODO - ADD THEME CONDITION HERE -->
                            @if(isset($view_orders['Orders']))
                            @include('dashboard.components.table')
                            @else
                            <h4 class="font-ropa">Data not available.</h4>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
</div>
</section>

</main>

@include('dashboard.components.footer')
</div>
@endsection
