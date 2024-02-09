@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
@endphp
@extends('dashboard.layouts.app')
@section('title','Dashboard | Report')
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
                     <h1 class="section-title text-center mb-3 font-ropa d-none lr-theme-only">{{$title}}</h1>
                     @include('dashboard.components.filters')
                     <div class="table-container">
                        @if(isset($memos['CreditMemos']) OR isset($transactions['FinancialTransactions']) OR isset($invoices['SalesInvoices']) OR isset($rmas['RMAs']) OR isset($view_orders['Orders']))
                        @include('dashboard.components.table')
                        @elseif(strstr($_SERVER['REQUEST_URI'], "?") && isset($_REQUEST['submit']))
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