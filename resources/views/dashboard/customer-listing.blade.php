@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
@endphp
@extends('dashboard.layouts.app')
@section('title','Dashboard | Customers')
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
                     <h1 class="section-title text-center mb-3 mt-3 font-ropa">View Customers</h1>
                     @if($filters)
                     <form method="GET" action="{{ route('dashboard.customerlisting') }}" class="dashboard-forms d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                        @foreach($filters as $filter)
                        <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                           @if($filter['type'] == 'text')
                              <label for="{{str_replace(' ', '_', strtolower($filter['title']))}}" class="form-label">{{$filter['title']}}</label>
                              <input name="{{str_replace(' ', '_', strtolower($filter['title']))}}" value="{{$filter['value']}}" class="form-control {{isset($filter['class']) ? $filter['class'] : ''}}" type="{{$filter['type']}}" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!} readonly />
                           @elseif($filter['type'] == 'select')   
                              <label for="{{str_replace(' ', '_', strtolower($filter['title']))}}" class="form-label">{{$filter['title']}}</label>
                                 <select name="{{str_replace(' ', '_', strtolower($filter['title']))}}" class="form-control" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!}>
                             
                                 @foreach($filter['options'] as $option)
                                    <option value="{{$option['value']}}">{{$option['label']}}</option>
                                    @endforeach
                                 </select>
                           @endif
                        </div>
                        
                        @endforeach
                        <div class="col-md-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                        </div>
                       
                     </form>
                     @endif
                     
                  </div>
                  <div class="table-container">
                        @if(isset($view_customer))
                        @include('dashboard.components.table')
                        @elseif(strstr($_SERVER['REQUEST_URI'], "?"))
                        <h4>Data not Available.</h4>
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