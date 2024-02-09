@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Page Builder')
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
                    <h1 class="h3 mb-0 text-gray-800">{{ucfirst($active_page -> name)}} Settings</h1>
                </div>
                <!-- Page Content -->
                <div class="card shadow mb-4 t-left">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($sections as $section)
                                    <a class="nav-link"
                                    id="v-pills-{{$section -> id}}-tab" data-toggle="pill"
                                    href="#v-pills-{{$section -> id}}" role="tab"
                                    aria-controls="v-pills-{{$section -> id}}"
                                    aria-selected="true">{{ucfirst($section -> name)}}</a>
                                @endforeach
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                    @foreach($sections as $section)
                                        <div class="tab-pane fade" id="v-pills-{{$section -> id}}" role="tabpanel"
                                        aria-labelledby="v-pills-{{$section -> id}}-tab">
                                            @if ($errors->any())
                                                <div class="alert alert-danger" role="alert">
                                                    <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{route('admin.page_setting.update',['page_id' => $active_page -> id])}}"
                                            enctype="multipart/form-data" method="post">
                                            @method('POST')
                                            @csrf
                                                <input type="hidden" name="section_id" value="{{$section -> id}}">
                                                @foreach($active_theme->pages->{$active_page -> slug}->sections->{$section -> slug}->metas as $meta_key => $meta_value)
                                                    <!--    Code start for New Arrivals form input    -->
                                                    <div class="card-body shadow-sm p-3 bg-white rounded">
                                                        <div class="form-group">
                                                            <label for="">{{$meta_key}}</label>
                                                            @if( ($meta_value == 'text') || ($meta_value == 'url') )
                                                                <input type="text" name="meta[{{$meta_key}}]"
                                                                class="form-control"
                                                                value="{{ isset($sections_meta[$section->id][$meta_key]) ? $sections_meta[$section->id][$meta_key] : '' }}">
                                                            @elseif( ($meta_value == 'para') || ($meta_value == 'textarea') )
                                                                <textarea type="text" name="meta[{{$meta_key}}]"
                                                                class="form-control h_200" cols="30" rows="5">{{ isset($sections_meta[$section->id][$meta_key]) ? $sections_meta[$section->id][$meta_key] : '' }}</textarea>
                                                            @elseif( ($meta_value == 'image') || ($meta_value == 'file') )
                                                                <!-- <input type="text" name="meta[{{$meta_key}}]"
                                                                class="form-control"
                                                                value="{{ isset($sections_meta[$section->id][$meta_key]) ? $sections_meta[$section->id][$meta_key] : '' }}"> -->
                                                                <br>
                                                                <img src="{{isset($sections_meta[$section->id][$meta_key]) ? asset($sections_meta[$section->id][$meta_key]) : ''}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::SPARS_LOGO}}'" alt="existing image" class="w_200">
                                                                <br>
                                                                <label for="">Upload image</label>
                                                                <br><input type="file" name="meta[{{$meta_key}}]">
                                                            @elseif( ($meta_value == 'video') )
                                                                <input type="text" name="meta[{{$meta_key}}]"
                                                                class="form-control"
                                                                value="{{ isset($sections_meta[$section->id][$meta_key]) ? $sections_meta[$section->id][$meta_key] : '' }}">
                                                            @elseif($meta_value == 'pdf')
                                                                <input type="file" name="meta[{{$meta_key}}]" class="form-control" accept="application/pdf"
                                                                value="{{ isset($sections_meta[$section->id][$meta_key]) ? $sections_meta[$section->id][$meta_key] : '' }}">
                                                            @else
                                                                <input type="text" name="meta[{{$meta_key}}]"
                                                                class="form-control"
                                                                value="{{ isset($section->sectionmeta[0]->meta_value) ? $section->sectionmeta[0]->meta_value : '' }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="card-body shadow-sm p-3 bg-white rounded">
                                                    <label for="">Status</label>
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                            name="is_active" id="rr1" value="1" {{ $section-> is_active ==  '1' ? 'checked' : ''  }}>
                                                            <label class="form-check-label font-weight-normal"
                                                            for="rr1">Show</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                            name="is_active" id="rr2" value="0" {{ $section-> is_active ==  '0' ? 'checked' : ''  }}>
                                                            <label class="form-check-label font-weight-normal"
                                                            for="rr2">Hide</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </form>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
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
@section('scripts')
<script>
    $(document).ready(function() {
        $('.nav-pills a.nav-link:first').click();
    });
</script>
@endsection
