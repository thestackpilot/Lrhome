@php
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
   <form method="GET" action="{{ route('dashboard.expressorder') }}" class="dashboard-forms d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3">
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="CustomerID*" class="form-label">Customer ID</label>
         <input data-required="true" type="text" name = "customer_id" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="CustomerPO*" class="form-label">Customer PO</label>
         <input type="text" name = "customer_po" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
         <label for="orderdate" class="form-label">Order Date</label>
         <div id="datepicker" data-date-format="dd-mm-yyyy">
            <input name = "order_date" class="form-control" type="date"/>
         </div>
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="shipid*" class="form-label">Ship Via Id</label>
         <input type="text" name = "shipment_id" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="firstname*" class="form-label">First Name</label>
         <input data-required="true" name = "first_name" type="text" value="{{Auth::user()->firstname}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="lastname*" class="form-label">Last Name</label>
         <input data-required="true" name = "last_name" type="text" value="{{Auth::user()->lastname}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="email*" class="form-label">Email</label>
         <input data-required="true" name = "email" type="text" value="{{Auth::user()->email}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="address1*" class="form-label">Address 1</label>
         <input data-required="true" name = "address1" value="{{Auth::user()->street_address}}" type="text"  class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="address2*" class="form-label">Address 2</label>
         <input data-required="true" name = "address2" type="text" value="{{Auth::user()->street_address}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="city*" class="form-label">City</label>
         <input data-required="true" name = "city" type="text" value="{{Auth::user()->city}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="state*" class="form-label">State</label>
         <input data-required="true" name = "state" type="text" value="{{Auth::user()->state}}" class="form-control">
      </div>
      <div class="mb-3 col-md-3 col-sm-12 col-12 pe-1 pe-lg-3">
         <label for="postalcode*" class="form-label">Postal Code</label>
         <input data-required="true" name = "postal_code" type="text" value="{{Auth::user()->postal_code}}" class="form-control">
      </div>
      <div class="table-responsive">
         @if(session('express_order_data'))
         <table class="table mt-4 text-center">
            <thead class="table-dark">
               <tr>
                  <th>Item ID</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
               </tr>
            </thead>
            <tbody>
               @foreach(session('express_order_data') as $express_order_data)
               @foreach($express_order_data as $express_data)
               <tr>
                  <td>{{$express_data[0]}}</td>
                  <input type="hidden" name="ItemID[]" value="{{$express_data[0]}}"/>
                  <td>{{$express_data[1]}}</td>
                  <input type="hidden" name="OrderQty[]" value="{{$express_data[1]}}"/>
                  <td>{{$express_data[2]}}</td>
                  <input type="hidden" name="UnitPrice[]" value="{{$express_data[2]}}"/>
               </tr>
               @endforeach
               @endforeach
            </tbody>
            @endif
         </table>
      </div>
      <div class="col-md-12 d-flex justify-content-end">
         <button type="button" class="btn btn-success text-uppercase mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Import Data
         </button>
         <button type="submit" class="btn btn-primary text-uppercase mt-2">Place Order</button>            
   </form>
   </div>
   <div class="table-container">
      @if(isset($place_orders['Message']))
      @include('dashboard.components.table')
      @endif
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="import" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="input-group mb-3">
                  <input type="file" name="file" class="form-control">
                  <button class="btn btn-primary" type="submit">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection