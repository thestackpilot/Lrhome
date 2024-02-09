@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@php
// TODO : The below section is a mess - needs to be improved
if(isset($showroom_meta))
{
    $showroom_meta_id = $showroom_meta -> id;
    $title = $showroom_meta-> title;
    $area = $showroom_meta-> area;
    $address = $showroom_meta-> address;
    $imageName = $showroom_meta-> image;
    $imageUrl = $showroom_meta-> image;
    $is_active = $showroom_meta->is_active;
}
else
{
    $showroom_meta_id = '';
    $title = '';
    $area = '';
    $address = '';
    $imageUrl = '';
    $is_active = '';
}
@endphp

@extends('admin.layouts.app')
@section('title','Home Page')
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
                    <h1 class="h3 mb-0 text-gray-800">{{($showroom_meta_id != '')?'Edit':'Add'}} Slide</h1>
                </div>

                <!-- Page Content -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <span class="m-0 font-weight-bold text-primary">ADD NEW</span> <a href="{{route('admin.showroom',['showroom_id' => $showroom_id])}}" class="btn btn-primary float-right"> Back to List</a>
                    </div>
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
                        <form action="{{ $showroom_meta_id == '' ?
                                 route('admin.showroom.store',['showroom_id' => $showroom_id])
                                 : route('admin.showroom.update',['showroom_id' => $showroom_id, 'meta_id' => $showroom_meta_id])}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card-body shadow-sm p-3 bg-white rounded">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$title}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Area</label>
                                    <input type="text" name="area" class="form-control" value="{{$area}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{$address}}">
                                </div>
                                @if($imageUrl != '')
                                <div class="form-group">
                                    <label for="">Existing Image</label>
                                    <div>
                                        <img src="{{asset($imageUrl)}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'" alt="existing image" class="w_200">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="">Upload slide image</label>
                                    <div><input type="file" name="image"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="rr1" value="1" {{ ($is_active==1)? 'checked' : '' }}>
                                            <label class="form-check-label font-weight-normal" for="rr1">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="rr2" value="0" {{ ($is_active==0)? 'checked' : '' }}>
                                            <label class="form-check-label font-weight-normal" for="rr2">Hide</label>
                                        </div>
                                    </div>
                                </div>
                                @if($showroom_meta_id == '')
                                <button type="submit" class="btn btn-success">Save</button>
                                @else
                                <button type="submit" class="btn btn-success">Update</button>
                                @endif
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
@php



@endphp