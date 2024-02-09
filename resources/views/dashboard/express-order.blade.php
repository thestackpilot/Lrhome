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
                            <div class="account-content p-5">
                                <h1 class="section-title text-center mb-3 mt-3 font-ropa">Express Order</h1>
                                <form class="d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3">
                                    <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="PhoneNumber*" class="form-label">SKU</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="PhoneNumber*" class="form-label">Quantity</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="PhoneNumber*" class="form-label">Comments</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-12 col-12">
                                        <label for="PhoneNumber*" class="form-label">Sidemark</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="mb-3 justify-content-end col-md-12 d-flex">
                                        <button type="submit " class="btn btn-primary text-uppercase mt-2">Add to Cart</button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table mt-4 text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>SKU</th>
                                            <th>Quantity</th>
                                            <th>Available</th>
                                            <th>Unit Price</th>
                                            <th>Comments</th>
                                            <th>Sidemark</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>WW-DR-GR-XS-001</td>
                                            <td>02</td>
                                            <td>Yes</td>
                                            <td>$50.00</td>
                                            <td>Dummy Text</td>
                                            <td>Dummy Text</td>
                                            <td>$50.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="d-flex justify-content-end balanced_btn">
                                    <a href="../checkout.php" class="btn btn-dark text-uppercase">Checkout</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        @include('dashboard.components.footer')
    </div>
@endsection
