@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 
@extends('admin.layouts.app')
@section('title','Menu')
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
                        <h1 class="h3 mb-0 text-gray-800">Menu Settings</h1>
                    </div>
                    <!-- Page Content -->
                    <div class="card shadow mb-4 t-left">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{route('admin.menu.update',['menu_id' => $menu->id])}}" enctype="multipart/form-data" method="post">
                                    @method('POST')
                                    @csrf
                                    <div class="card-body shadow-sm p-3 bg-white rounded field_wrapper">
                                        <label for="">{{ucfirst($menu->name)}}</label>
                                        <a class="add_button" title="Add Field">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                        @foreach($menu->menu_metas as $meta)
                                        <div class="meta-menu form-inline row my-2">
                                            <div class="form-group">
                                                <input name="key[]" placeholder="Menu Key" class="mx-2 form-control" value="{{$meta->meta_key}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="title[]" placeholder="Menu Title" class="mx-2 form-control" value="{{$meta->meta_title}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="url[]" class="mx-2 form-control" placeholder="Menu URL" value="{{$meta->meta_url}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="parent[]" class="mx-2 form-control" placeholder="Menu Parent" value="{{$meta->meta_parent_key}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="image[]" class="mx-2 form-control" placeholder="Menu Image" value="{{$meta->meta_image}}">
                                            </div>
                                            <div class="form-group">
                                                <a class="remove_button" title="Remove Field">
                                                    <i class="fas fa-minus-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="card-body mt-2 shadow-sm p-3 bg-white rounded">
                                        <label for="">Status</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                       name="is_active" id="rr1" value="1" {{ $menu-> is_active ==  '1' ? 'checked' : ''  }}>
                                                <label class="form-check-label font-weight-normal"
                                                       for="rr1">Show</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                       name="is_active" id="rr2" value="0" {{ $menu-> is_active ==  '0' ? 'checked' : ''  }}>
                                                <label class="form-check-label font-weight-normal"
                                                       for="rr2">Hide</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /Page Content -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            @include('admin.components.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    @include('admin.components.scroll-top')
    <!-- Logout Modal-->
    @include('admin.components.logout-model')
@endsection
