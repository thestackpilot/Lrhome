@php
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
@endphp 
@extends('admin.layouts.app')
@section('title','Menu')
@section('content')
<div id="wrapper">

    @include('admin.components.side-bar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            @include('admin.components.admin-topbar')

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Menu Settings</h1>
                </div>

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

                            <form action="{{route('admin.menu.update',['menu_id' => $menu->id])}}" 
                                  enctype="multipart/form-data" method="post">

                                @method('POST')
                                @csrf

                                <div class="card-body shadow-sm p-3 bg-white rounded field_wrapper">

                                    <label>{{ ucfirst($menu->name) }}</label>
                                    <a class="add_button" title="Add Field">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>

                                    @foreach($menu->menu_metas as $meta)

                                    <div class="meta-menu row align-items-center mb-3 p-3 border rounded bg-light">

                                        <!-- KEY -->
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label fw-bold">Key</label>
                                            <input name="key[]" class="form-control" value="{{ $meta->meta_key }}">
                                        </div>

                                        <!-- TITLE -->
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label fw-bold">Title</label>
                                            <input name="title[]" class="form-control" value="{{ $meta->meta_title }}">
                                        </div>

                                        <!-- URL -->
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label fw-bold">URL</label>
                                            <input name="url[]" class="form-control" value="{{ $meta->meta_url }}">
                                        </div>

                                        <!-- Parent -->
                                        <div class="col-md-2 mb-2">
                                            <label class="form-label fw-bold">Parent</label>
                                            <input name="parent[]" class="form-control" value="{{ $meta->meta_parent_key }}">
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-2 mb-2 text-center">
                                            <label class="form-label fw-bold">Image</label>

                                            <!-- Preview if exists -->
                                            @if($meta->meta_image)
                                                <div class="mb-2">
                                                    <input type="hidden" name="image[]" value="{{ $meta->meta_image }}">
                                                    <img src="{{ $meta->meta_image }}" 
                                                        class="img-thumbnail" 
                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endif

                                            <input type="file" name="image_file[]" class="form-control" type="image">
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="col-md-1 text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove_button mt-4">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </div>

                                    </div>
                                    @endforeach


                                    
                                </div>

                                <div class="card-body mt-2 shadow-sm p-3 bg-white rounded">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="is_active" id="rr1" value="1"
                                                {{ $menu->is_active == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rr1">Show</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="is_active" id="rr2" value="0"
                                                {{ $menu->is_active == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rr2">Hide</label>
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

            </div>

            @include('admin.components.footer')
        </div>
    </div>

</div>

@include('admin.components.scroll-top')
@include('admin.components.logout-model')

@endsection


