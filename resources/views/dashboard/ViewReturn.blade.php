@php
@endphp
@extends('dashboard.layouts.app')
@section('title','Dashboard | Returns')
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
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa"> View Return </h1>
                     <form method="GET" action="{{ route('dashboard.viewreturn') }}" class="dashboard-forms d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">RMA No</label>
                           <input data-required="true" type="text" name="rma_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Sales Invoice No</label>
                           <input type="text" name="invoice_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Packing Slip No</label>
                           <input type="text" name="packing_slip_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Sales Order No</label>
                           <input type="text" name="order_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">From Date</label>
                           <input type="date" name="from_date" class="form-control">
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">To Date</label>
                           <input type="date" name="to_date" class="form-control">
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                        </div>
                     </form>
                     @if(isset($rmas['RMAs']))
                     @include('dashboard.components.table')
                     @elseif(strstr($_SERVER['REQUEST_URI'], "?"))
                     <h4>Data not available.</h4>
                     @endif
                  </div>
               </div>
            </div>
      </section>
   </main>
   @include('dashboard.components.footer')
</div>
@endsection