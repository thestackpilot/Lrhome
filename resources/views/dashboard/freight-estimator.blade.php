@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Freight Estimator')
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
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa"> Freight Estimator </h1>
                     <form class="dashboard-forms d-flex flex-lg-row flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3 freight-estimator-form">
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="customer_id" class="form-label">Customer ID</label>
                           <select name="customer_id" class="form-control">
                              @foreach($customers as $customer)
                              <option value="{{$customer['value']}}">{{$customer['label']}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="ship_via_id" class="form-label">Ship Via ID</label>
                           <select name="ship_via_id" class="form-control">
                              @foreach($shippings as $shipping)
                              <option value="{{$shipping['ShipViaID']}}">{{$shipping['ShipViaID']}} - {{$shipping['Description']}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="button" class="add-row btn btn-primary text-uppercase mt-2 me-2">Insert new row</button>
                        </div>
                        <div class="table-responsive">
                           <table class="table mt-4 text-center line-items">
                              <thead class="table-dark">
                                 <tr>
                                    <th></th>
                                    <th>Item ID</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody id="data_body">
                                 @if(old('item_id'))
                                 @foreach(old('item_id') as $k => $item_id)
                                 <tr id="order_data_row" style="border-bottom: 1px solid #ddd;">
                                    <td class="d-flex justify-content-center">
                                       <i class="remove-row bi bi-x-lg"></i>
                                    </td>
                                    <td><input name="item_id[]" maxlength="250" class="form-control" type="text" value="{{$item_id}}" data-required="true" /></td>
                                    <td><input name="quantity[]" max="9999" maxlength="4" min="1" class="form-control" type="number" value="{{old('quantity')[$k]}}" data-required="true" /></td>
                                    <td><input name="price[]" maxlength="250" class="form-control" type="text" value="{{old('price')[$k]}}" data-required="true" /></td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr id="order_data_row" style="border-bottom: 1px solid #ddd;">
                                    <td class="d-flex justify-content-center">
                                       <i class="remove-row bi bi-x-lg"></i>
                                    </td>
                                    <td><input name="item_id[]" maxlength="250" class="form-control" type="text" value="" data-required="true" /></td>
                                    <td><input name="quantity[]" max="9999" maxlength="4" min="1" class="form-control" type="number" value="" data-required="true" /></td>
                                    <td><input name="price[]" maxlength="250" class="form-control" type="text" value="" data-required="true" /></td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                           <div class="col-md-12 d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary text-uppercase mt-2">Get Estimates</button>
                           </div>
                        </div>
                     </form>
                     <div class="table-container">
                        @if(isset($freights['ShippingRates']))
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
@section('scripts')
<script>
   $(document).ready(function() {
      $(document).on('click', ".remove-row", function() {
         if ($("table.line-items tbody tr").length > 1)
            $(this).closest('tr').remove();
         else
            $("input", $("table.line-items tbody tr")).val('');
      });

      $(".add-row").on("click", function(e) {
         var row = $("table.line-items tbody tr:first").clone();
         $("input", row).val("");
         row.appendTo($("table.line-items tbody"));
      });

      $('.freight-estimator-form').on('submit', function() {
         var allOk = true;

         $('input[data-required="true"], select[data-required="true"]').each(function() {
            if ($(this).is(':visible')) {
               if (typeof $(this).val().length === 'undefined') {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else if ($(this).val().trim().length < 1) {
                  $(this).addClass('is-invalid');
                  allOk = false;
               } else {
                  $(this).removeClass('is-invalid');
               }
            }
         });

         return allOk;
      });
   });
</script>
@endsection
