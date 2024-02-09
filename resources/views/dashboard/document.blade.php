@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('dashboard.layouts.app')
@section('title','Dashboard | Documents')
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
                  <div class="account-content px-0 py-3">
                     <h1 class="section-title text-center mb-3 ml-3 mt-0 font-ropa">Documents</h1>
                     @if(isset($documents) && $documents)
                     <div class="d-flex flex-md-row flex-sm-row flex-dir-col justify-content-around document-buttons">
                        @foreach($documents as $document)
                        @if($document['title'])
                        <a href="{{$document['link']}}" target="_blank" class="btn btn-primary text-uppercase mt-2 height-40"> 
                           {{$document['title']}} 
                           <i class="bi bi-chevron-right d-none lr-theme-only"></i>
                        </a>
                        @endif
                        @endforeach
                     </div>
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
