@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Cache Management')
@section('content')
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.components.side-bar')
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            @include('admin.components.admin-topbar')
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                @if (Session::has('message'))
                <div class="alert alert-{{Session::get('message')['type']}}">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{Session::get('message')['body']}}
                </div>
                @endif
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        Cache Management
                        <form method="POST" class="ml-5" style="float: right;" action="{{route('admin.clear-cache')}}">
                            @csrf
                            <input type="hidden" name="cache" value="-1" />
                            <button value="clear" class="btn btn-danger" name="submit" type="submit">Clear All</button>
                        </form>
                    </h1>
                </div>
                <!-- Page Content -->
                <div class="card shadow mb-4 t-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            @foreach($cache_types as $key => $value)
                            <p>
                                <form method="POST" action="{{route('admin.clear-cache')}}">
                                    @csrf
                                    <input type="hidden" name="cache" value="{{$key}}" />
                                    <h4>{{$value}}  <button style="float: right;" name="submit" class="ml-5 btn btn-danger pull-right" value="clear" type="submit">Clear</button></h4>
                                </form>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    <!-- /Page Content -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('admin.components.sticky-footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    @include('admin.components.scroll-top')
    <!-- Logout Modal-->
    @include('admin.components.logout-model')
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function() {
            $('textarea').each(function() {
                $(this).html(JSON.stringify(JSON.parse($(this).html()), undefined, 4));
            });
        });
    </script>
    @endsection
