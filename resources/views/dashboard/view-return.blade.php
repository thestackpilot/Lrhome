@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

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
                        <input type="date" name = "from_date" class="form-control">
                     </div>
                     <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                        <label for="PhoneNumber*" class="form-label">To Date</label>
                        <input type="date" name = "to_date" class="form-control">
                     </div>
                     <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                     </div>
                  </form>
                  @if(isset($rmas['RMAs']))
                  @foreach($rmas['RMAs'] as $rma)
                  <div class="d-flex flex-column mt-2">
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa">RMA Order Number {{$rma['RMANo']}}</h1>
                     <div class="account-content p-5">
                        <div class="d-flex flex-lg-row flex-sm-column flex-dir-col">
                           <div class="col-md-4 p-sm-3 py-3 col-sm-12">
                              <div class="admin-card min-height-420" >
                                 <h4 class="d-flex">RMA Info</h4>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">RMA Number</span> <span style="color:#086AD8;"> {{$rma['RMANo']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Customer ID</span> <span style="color:#086AD8;"> {{$rma['CustomerID']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Customer PO</span> <span style="color:#086AD8;"> {{$rma['CustomerName']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Sales Invoice Number</span> <span style="color:#086AD8;"> {{$rma['SalesinvoiceNo']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Invoice Date</span> <span style="color:#086AD8;"> {{$rma['SalesInvoiceDate']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Total Ammount</span> <span style="color:#086AD8;"> {{$rma['PackingSlipNo']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Sales Order Number</span> <span style="color:#086AD8;"> {{$rma['SalesOrderNo']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Total Quantity</span> <span style="color:#086AD8;"> {{$rma['TotalQuantity']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">Total Amount</span> <span style="color:#086AD8;"> {{$rma['TotalAmount']}} </span> </p>
                                 <p class="d-flex flex-row justify-content-between"> <span class="font-crimson">RMA Date</span> <span style="color:#086AD8;"> {{$rma['RMADate']}} </span> </p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 mt-4 tabs-all">
                           <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                 <div class="table-responsive">
                                    @if(isset($rma['Details']))
                                    <table class="table mt-4 text-center">
                                       <thead class="table-dark">
                                          <tr>
                                             <th>Line No</th>
                                             <th>Item ID</th>
                                             <th>UPC</th>
                                             <th>SKU</th>
                                             <th>Item Description</th>
                                             <th>Price</th>
                                          </tr>
                                       </thead>
                                       @foreach($rma['Details'] as $key => $details)
                                       <tbody>
                                          <tr>
                                             <td>{{$details['LineNo']}}</td>
                                             <td>{{$details['ItemID']}}</td>
                                             <td>{{$details['UPC']}}</td>
                                             <td>{{$details['SKU']}}</td>
                                             <td>{{$details['ItemDescription']}}</td>
                                             <td>{{$details['Price']}}</td>
                                          </tr>
                                       </tbody>
                                       @endforeach
                                    </table>
                                 </div>
                                 @else
                                 <h3>No Detials Available</h3>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @endif
               </div>
            </div>
         </div>
      </section>
   </main>
   @include('dashboard.components.footer')
</div>
@endsection
