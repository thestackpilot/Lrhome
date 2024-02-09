@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
@endphp
@extends('dashboard.layouts.app')
@section('title','Dashboard | Orders')
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
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa">View Orders</h1>
                     <form method="GET" action="{{ route('dashboard.vieworder') }}" class="dashboard-forms d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="fullname" class="form-label">Begin Date</label>
                           <div id="datepicker" data-date-format="dd-mm-yyyy">
                              <input name="date_from" class="form-control" type="date" />
                           </div>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="fullname" class="form-label">End Date</label>
                           <div id="datepickerEnd" data-date-format="dd-mm-yyyy">
                              <input name="date_to" class="form-control" type="date" />
                           </div>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Customer ID</label>
                           <input data-required="true" name="customer_id" type="text" name="customer_id" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">External ID</label>
                           <input name="external_id" type="text" name="external_id" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Sales Rep</label>
                           <input name="sales_rep" type="text" name="" class="form-control">
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                        </div>
                     </form>
                  </div>
                  <div class="table-container">
                     @if(isset($view_orders['Orders']))
                     @include('dashboard.components.table')
                     @elseif(strstr($_SERVER['REQUEST_URI'], "?"))
                     <h4>Data not available.</h4>
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