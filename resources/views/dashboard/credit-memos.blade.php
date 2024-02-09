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
                     <h1 class="section-title text-center mb-3 font-ropa d-none lr-theme-only">Credit Memos - LR Home</h1>
                     <form class="d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="fullname" class="form-label">Begin Date</label>
                           <div id="datepicker" data-date-format="dd-mm-yyyy">
                              <input name="from_date" class="form-control" type="date" />
                           </div>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="fullname" class="form-label">End Date</label>
                           <div id="datepickerEnd" data-date-format="dd-mm-yyyy">
                              <input name="to_date" class="form-control" type="date" />
                           </div>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">PO No</label>
                           <input type="text" name="po_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Invoice No</label>
                           <input data-required="true" type="text" name="invoice_number" class="form-control">
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                        </div>
                     </form>
                     <div class="table-container">
                        @if(isset($memos['CreditMemos']))
                        @include('dashboard.components.table')
                        @elseif(strstr($_SERVER['REQUEST_URI'], "?"))
                        <h4>Data not available.</h4>
                        @endif
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