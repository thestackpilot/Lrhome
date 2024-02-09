@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('admin.layouts.app')
@section('title','Basic Settings')
@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.components.side-bar',['pages'=>$pages])
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Basic Settings</h1>
                </div>

                <!-- Page Content -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('admin.update_settings',['id'=>$settings->id])}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card-body shadow-sm p-3 bg-white rounded">
                                <div class="form-group">
                                    <label for="">Store Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $settings->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Store Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $settings->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Store Contact</label>
                                    <input type="text" name="contact" class="form-control" value="{{ $settings->contact }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Store Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $settings->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Website</label>
                                    <input type="text" name="website" class="form-control" value="{{ $settings->website }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Existing Dark Logo</label>
                                    <div>
                                        <img src="{{ asset($settings->logo_dark) }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'" alt="existing image" class="w_200">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload Dark Logo</label>
                                    <div><input type="file" name="logo_dark"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Existing Light Logo</label><br>
                                    <div class="bg-secondary px-4 py-2 d-inline-block">
                                        <img src="{{ asset($settings->logo_light) }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'" alt="existing image" class="w_200">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload Light Logo</label>
                                    <div><input type="file" name="logo_light"></div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Page Content -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                <span>Copyright &copy; {{date('Y')}}</span>
                </div>
            </div>
        </footer>
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