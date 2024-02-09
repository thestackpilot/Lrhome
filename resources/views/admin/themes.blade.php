@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('admin.layouts.app')
@section('title','Home Page')
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Slider Images</h1>
                    </div>

                    <!-- Page Content -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">THEMES</span> <a  href="{{route('admin.refresh_themes')}}" class="btn btn-primary float-right">Refresh Themes</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Theme Name</th>
                                        <th>API Slug</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($themes as $theme)
                                        <tr>
                                            <td>{{$theme['id']}}</td>
                                            <td>{{$theme['theme_name']}}</td>
                                            <td>{{$theme['theme_api_slug']}}</td>
                                            <td>
                                                @if($theme['is_active'] == 1)
                                                <a href="{{route('admin.de_activate_theme',['theme_id'=>$theme['id']])}}" class="btn btn-success">Activated</a>
                                                @else
                                                <a href="{{route('admin.activate_theme',['theme_id'=>$theme['id']])}}" class="btn btn-danger">Inactive</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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

