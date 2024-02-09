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
                    <h1 class="h3 mb-0 text-gray-800">Manage Catalogs</h1>
                </div>

                <!-- Page Content -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <span class="m-0 font-weight-bold text-primary">Catalogs</span> <a href="{{route('admin.catalog_meta.create',['catalog_id' => $catalog_id])}}" class="btn btn-primary float-right"> Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Caption</th>
                                        <th>Catalog PDF</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($catalog_meta as $k => $meta)
                                    <tr>
                                        <td>{{$k + 1}}</td>
                                        <td>
                                            <div style="max-width: 300px; margin: 0 auto;">
                                                <img src="{{asset($meta->image)}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'" alt="existing image" class="w-100">
                                            </div>
                                        </td>
                                        <td>{{$meta->title}}</td>
                                        <td>{{isset($meta->caption) ? $meta->caption : null}}</td>
                                        <td>{!!$meta->catalog_pdf!!}</td>
                                        <td>{!!$meta->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'!!}</td>
                                        <td class="text-center actions">
                                            <a href="{{route('admin.catalog_meta.edit',['catalog_id' => $catalog_id, 'meta_id' => $meta->id])}}" class="action-edit-icon">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure to delete?')" href="{{route('admin.catalog_meta.delete',['catalog_id' => $catalog_id, 'meta_id' => $meta->id])}}" class="action-delete-icon">
                                                <i class="far fa-trash-alt"></i>
                                            </a>

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
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
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