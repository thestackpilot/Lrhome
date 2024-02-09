@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Account Information')
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
                        <!-- TODO - ADD THEME CONDITION HERE -->
                        @if($active_theme_json->general->allow_sales_rep_details)
                        @if (1 || $active_customer)
                        <div class="p-3 account-content mb-4 py-5 lr-accountInfo">
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">
                                Customer Account Information
                                <i class="bi bi-info-circle" style="font-size: 20px;" data-toggle="tooltip" data-placement="top" title="This information is of the customer."></i>
                            </h1>
                            @if ( $customers )
                            <form class="d-flex" method="get">
                                <div class="col-md-8 d-inline">
                                    <select class="form-control" name="customer">
                                        @foreach($customers as $customer)
                                            <option value="{{$customer['value']}}" {{ $active_customer && $active_customer == $customer['value'] ? 'selected' : '' }}>{{$customer['label']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary w-100" type="submit" >Select</button>
                                </div>
                            </form>
                            @else
                            <p style="font-size:24px;color: #EA7410;" class="px-2">{{$active_customer ? $active_customer : 'You have a customer account.'}}</p>
                            @endif
                            @if ($active_customer)
                            @if ($client_address && isset($client_address['CustomerAddress']))
                            <div class="d-flex flex-column mt-4 kinda-table">
                                <div class="align-items-center d-flex justify-content-between">
                                    <h6 class="col-md-2">
                                        Customer Address : <br>
                                        <!-- <a href="javascript:void(0);" class="col-md-12 text-right add-address">Add New Address</a> -->
                                    </h6>
                                    <select class="form-control select-address">
                                        @foreach($client_address['CustomerAddress']['ShipToAddresses'] as $address)
                                        <option value="{{$address['AddressID']}}">{{$address['AddressID']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach($client_address['CustomerAddress']['ShipToAddresses'] as $address)
                            <div class="d-flex flex-column mt-4 kinda-table d-none address-section address-{{$address['AddressID']}}">
                                <a href="javascript:void(0);" class="col-md-12 text-right update-address">Edit</a>
                                <span class="d-none address-details">{{json_encode($address)}}</span>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>First Name</h6>
                                    <p>{{$address['FirstName']}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Address</h6>
                                    <p>{{$address['Address1']}} {{$address['Address2']}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Email</h6>
                                    <p>{{$address['Email']}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Office Phone</h6>
                                    <p>{{$address['Phone1']}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Postal Code</h6>
                                    <p>{{$address['Zip']}}</p>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endif
                        </div>
                        @endif
                        @if ($parent)
                        <div class="p-3 account-content mb-4 py-5 lr-accountInfo">
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">Admin Account</h1>
                            <p style="font-size:24px;color: #EA7410;" class="px-2">{{$parent->company}}</p>
                            <div class="d-flex flex-column mt-4 kinda-table ">
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>First Name</h6>
                                    <p>{{$parent->firstname}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Address</h6>
                                    <p>{{$parent->street_address}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Email</h6>
                                    <p>{{$parent->email}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Office Phone</h6>
                                    <p>{{$parent->phone}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Postal Code</h6>
                                    <p>{{$parent->postal_code}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="p-3 account-content mb-4 py-5 lr-accountInfo d-none">
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">My Account</h1>
                            <p style="font-size:24px;color: #EA7410;" class="px-2">{{Auth::user()->company}}</p>
                            <div class="d-flex flex-column mt-4 kinda-table ">
                                <!-- <h3 class="section-title text-center mb-3 mt-0 font-ropa d-none lr-theme-only"></h3> -->
                                <a href="{{route('dashboard.myaccount')}}" class="col-md-12 text-right">Edit</a>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>First Name</h6>
                                    <p>{{Auth::user()->firstname}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Address</h6>
                                    <p>{{Auth::user()->street_address}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Email</h6>
                                    <p>{{Auth::user()->email}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row">
                                    <h6>Office Phone</h6>
                                    <p>{{Auth::user()->phone}}</p>
                                </div>
                                <div class="d-flex justify-content-between flex-row even-row">
                                    <h6>Postal Code</h6>
                                    <p>{{Auth::user()->postal_code}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade address-details-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{route('dashboard.updatecustomeraddress')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header text-center">
                        Address Details
                    </div>
                    <div class="modal-body" id="section-details" style="background: #fff;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary border-0 close-modal" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save-details" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('dashboard.components.footer')
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('select.select-address').change(function() {
            $('.address-section').addClass('d-none');
            $('.address-' + $(this).val()).removeClass('d-none');
        }).change();

        $(document).on('click', '.address-details-modal .close-modal',function() {
            $('.address-details-modal').modal('hide');
        });

        $(document).on('submit', '.address-details-modal form', function() {
            var all_ok = true;
            const required_fields = ['FirstName', 'Address1', 'Phone1'];
            $('.address-details-modal form input').each(function() {
                if (required_fields.includes($(this).attr('name'))) {
                    if (typeof $(this).val().length == 'undefined' || $(this).val().length < 1) {
                        $(this).addClass('is-invalid');
                        all_ok = false;
                    } else
                        $(this).removeClass('is-invalid');
                }
            });
            return all_ok;
        });

        $(document).on('click', '.update-address', function() {
            var form = '';
            var i = 0;
            const data = JSON.parse($('span.address-details', $(this).closest('.address-section')).html());
            for (const key in data) {
                if (key != 'AddressID' && i % 2 == 0) form += `<div class="row">`;
                form += `
                    <div class="mb-3 col-md-6 ${(key == 'AddressID') ? 'd-none' : ''}">
                        <label class="form-label">${(key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ')}</label>
                        <input type="text" class="form-control bg-white" name="${key}" value="${data[key]}" placeholder="${key}">
                    </div>
                `;
                if (key != 'AddressID' && i % 2 == 1) form += `</div>`;
                if (key != 'AddressID') i++;
            }
            form += `
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Status</label>
                        <select class="form-control bg-white" name="Status">
                            <option value="A">Active</option>
                            <option value="N">In Active</option>
                        </select>
                    </div>
                </div>
            `;
            $('.address-details-modal .modal-body').html(`${form}`);
            $('.address-details-modal').modal('show');
        });
    });
</script>
@endsection
