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
                  @if (Session::has('message'))
                  <div class="alert alert-{{Session::get('message')['type']}}">
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     {!!Session::get('message')['body']!!}
                  </div>
                  @endif
                  <div class="account-content p-5">
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa"> Initiate A Return </h1>
                     <form action="{{ route('dashboard.initreturn') }}" class="dashboard-forms d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Customer ID</label>
                           <select name="customer_id" class="form-control">
                              @foreach($customers as $customer)
                              <option {{old('customer_id') && $customer['value'] == old('customer_id') ? 'selected' : '' }} value="{{$customer['value']}}">{{$customer['label']}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           <label for="PhoneNumber*" class="form-label">Requested By</label>
                           <input data-required="true" type="text" maxlength="50" value="{{old('requested_by')}}" name="requested_by" class="form-control">
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="button" class="add-row btn btn-primary text-uppercase mt-2 me-2">Insert new row</button>
                        </div>
                        <div class="table-responsive">
                           <table class="table mt-4 text-center return-line-items">
                              <thead class="table-dark">
                                 <tr>
                                    <th></th>
                                    <th>Sales Invoice No</th>
                                    <th>LineNo</th>
                                    <th>Item ID</th>
                                    <th>Return Quantity</th>
                                    <th>Reason</th>
                                 </tr>
                              </thead>
                              <tbody id="data_body">
                                 @if(old('ItemID'))
                                 @foreach(old('ItemID') as $k => $item_id)
                                 <tr class="data_row" id="order_data_row" style="border-bottom: 1px solid #ddd;">
                                    <td class="d-flex justify-content-center">
                                       <i class="remove-row bi bi-x-lg"></i>
                                    </td>
                                    <td><input data-required="true" maxlength="50" name="SalesInvoiceNo[]" class="form-control" type="number" value="{{old('SalesInvoiceNo')[$k]}}" /></td>
                                    <td><input data-required="true" maxlength="50" name="LineNo[]" class="form-control" type="number" value="{{old('LineNo')[$k]}}" /></td>
                                    <td><input data-required="true" maxlength="250" name="ItemID[]" class="form-control" type="text" value="{{$item_id}}" /></td>
                                    <td><input data-required="true" maxlength="4" max="9999" name="ReturnQuantity[]" min="1" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" type="number" value="{{old('ReturnQuantity')[$k]}}" /></td>
                                    @if($reasons)
                                    <td>
                                       <select name="Reason[]" class="form-control">
                                          @foreach($reasons as $reason)
                                          <option {!! $reason['Description']==old('Reason')[$k] ? 'selected' : '' !!} value="{{$reason['Description']}}">{{$reason['Description']}}</option>
                                          @endforeach
                                       </select>
                                    </td>
                                    @endif
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr class="data_row" id="order_data_row" style="border-bottom: 1px solid #ddd;">
                                    <td class="d-flex justify-content-center">
                                       <i class="remove-row bi bi-x-lg"></i>
                                    </td>
                                    <td><input data-required="true" maxlength="50" name="SalesInvoiceNo[]" class="form-control" type="number" value="" /></td>
                                    <td><input data-required="true" maxlength="50" name="LineNo[]" class="form-control" type="number" value="" /></td>
                                    <td><input data-required="true" maxlength="250" name="ItemID[]" class="form-control" type="text" value="" /></td>
                                    <td><input data-required="true" maxlength="4" max="9999" name="ReturnQuantity[]" min="1" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" type="number" value="" /></td>
                                    @if($reasons)
                                    <td>
                                       <select name="Reason[]" class="form-control">
                                          @foreach($reasons as $reason)
                                          <option value="{{$reason['Description']}}">{{$reason['Description']}}</option>
                                          @endforeach
                                       </select>
                                    </td>
                                    @endif
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                           <div class="d-flex col-md-12 justify-content-end">
                              <button type="submit" class="btn btn-primary text-uppercase mt-2">Initiate Claim</button>
                           </div>
                        </div>
                     </form>
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
         if ($("table.return-line-items tbody tr").length > 1)
            $(this).closest('tr').remove();
         else
            $("input", $("table.return-line-items tbody tr")).val('');
      });

      $(".add-row").on("click", function(e) {
         var row = $("table.return-line-items tbody tr:first").clone();
         $("input", row).val("");
         row.appendTo($("table.return-line-items tbody"));
      });
   });
</script>
@endsection
