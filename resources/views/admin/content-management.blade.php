@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Content Management')
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
                    <h1 class="h3 mb-0 text-gray-800">Content Management</h1>
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
                        @if($template_type == 'display-collections')
                        <h3 class="mb-5">Collections</h3>
                        <div class="row">
                            @if(count($collections))
                            @foreach($collections as $collection)
                            @php
                            if (array_key_exists($collection['Title'], $content)) {
                                $collection['Image'] = $content[$collection['Title']]['image'];
                                $collection['Title'] = $content[$collection['Title']]['title'];
                            }
                            @endphp
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body text-center shadow-sm mt-2 p-3 bg-white rounded">
                                        <a href="{{$collection['URL']}}">
                                        <img style="height: 250px;" class="d-block w-100" alt="{{ $collection['Title'] }}" src="{{ $collection['Image'] }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" />
                                        <h4 class="mt-4">{{$collection['Title']}}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-md-12">
                                <h5>No collections available.</h5>
                            </div>
                            @endif
                        </div>
                        @elseif($template_type == 'update-collections')
                        <form action="{{route('admin.modify-api-content')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @foreach($api as $name => $value)
                            <input type="hidden" name="api_{{$name}}" value="{{$value}}" />
                            @endforeach

                            <div class="card-body shadow-sm mt-2 p-3 bg-white rounded">
                                @foreach($collections as $collection)
                                @php
                                if (!array_key_exists($collection['Description'], $content)) {
                                $content[$collection['Description']] = [
                                'title' => $collection['Description'],
                                'description' => '',
                                'image' => CommonController::getApiFullImage( $collection['Description'] )
                                ];
                                }
                                
                                @endphp
                                <input type="hidden" name="raw[{{$collection['Description']}}]" value="{{json_encode($collection)}}" />
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title[{{$collection['Description']}}]" class="form-control" value="{{ $content[$collection['Description']]['title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description[{{$collection['Description']}}]" class="form-control" >{{ $content[$collection['Description']]['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <div class="mt-1 mb-3 fav-image">
                                        <input type="hidden" name="image[{{$collection['Description']}}]" value="{{ $content[$collection['Description']]['image'] }}" />
                                        <img class="w_200" alt-src="{{CommonController::getApiFullImage($collection['ImageName'])}}" alt="{{ $content[$collection['Description']]['title'] }}" src="{{ $content[$collection['Description']]['image'] }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" />
                                        <a style="font-size: 12px;" class="d-none font-weight-bolder text-danger text-sm-left remove-image">
                                            Remove Custom Image
                                        </a>
                                    </div>
                                    <input type="file" accept="image/*" name="file[{{$collection['Description']}}]" class="" />
                                    <p class="font-italic font-weight-bold font-weight-lighter mt-2 text-danger" style="font-size: 12px;">Image should be 800px X 800px Or 600px X 800px Or 600px X 400px Or 800px X 600px Or 900px X 900px Or 900px X 1200px</p>
                                </div>
                                <br>
                                <hr>
                                @endforeach
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>

                        </form>
                        @elseif($template_type == 'update-favourites')
                        <form action="{{route('admin.modify-api-content')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @foreach($api as $name => $value)
                            <input type="hidden" name="api_{{$name}}" value="{{$value}}" />
                            @endforeach

                            <div class="card-body shadow-sm mt-2 p-3 bg-white rounded">
                                @foreach($favourites as $favourite)
                                @php
                                if (!array_key_exists($favourite['Title'], $content)) {
                                $content[$favourite['Title']] = [
                                'title' => $favourite['Title'],
                                'image' => CommonController::getApiFullImage( $favourite['Image'] )
                                ];
                                }
                                @endphp
                                <input type="hidden" name="raw[{{$favourite['Title']}}]" value="{{json_encode($favourite)}}" />
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title[{{$favourite['Title']}}]" class="form-control" value="{{ $content[$favourite['Title']]['title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <div class="mt-1 mb-3 fav-image">
                                        <input type="hidden" name="image[{{$favourite['Title']}}]" value="{{ $content[$favourite['Title']]['image'] }}" />
                                        <img class="w_200" alt-src="{{CommonController::getApiFullImage($favourite['Image'])}}" alt="{{ $content[$favourite['Title']]['title'] }}" src="{{ $content[$favourite['Title']]['image'] }}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" />
                                        <a style="font-size: 12px;" class="d-none font-weight-bolder text-danger text-sm-left remove-image">
                                            Remove Custom Image
                                        </a>
                                    </div>
                                    <input type="file" accept="image/*" name="file[{{$favourite['Title']}}]" class="" />
                                    <p class="font-italic font-weight-bold font-weight-lighter mt-2 text-danger" style="font-size: 12px;">Image should be 800px X 800px Or 600px X 800px Or 600px X 400px Or 800px X 600px Or 900px X 900px Or 900px X 1200px</p>
                                </div>
                                <br>
                                <hr>
                                @endforeach
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>

                        </form>
                        @endif
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
@section('scripts')
<script>
    $(document).ready(function() {
        $('.fav-image').each(function(){
            if (
                $('img', $(this)).attr('src') !== $('img', $(this)).attr('alt-src') && 
                $('img', $(this)).attr('src') !== '{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'
            ) {
                $('.remove-image', $(this)).addClass('d-block').removeClass('d-none');
            }
        });

        $('.remove-image').click(function(){
            $('img', $(this).closest('.fav-image')).attr('src', $('img', $(this).closest('.fav-image')).attr('alt-src'));
            $('input', $(this).closest('.fav-image')).val($('img', $(this).closest('.fav-image')).attr('src'));
            $(this).addClass('d-none').removeClass('d-block');
        });

        $('input[type="file"]').change(function(event) {
            let $this = $(this);
            let img = new Image()
            img.src = window.URL.createObjectURL(event.target.files[0])
            img.onload = () => {
                // 800px X 800px Or 600px X 800px Or 600px X 400px Or 800px X 600px Or 900px X 900px Or 900px X 1200px
                if ( true ||
                    (img.width == 800 && img.height == 800) ||
                    (img.width == 600 && img.height == 800) ||
                    (img.width == 600 && img.height == 400) ||
                    (img.width == 800 && img.height == 600) ||
                    (img.width == 900 && img.height == 900) ||
                    (img.width == 900 && img.height == 1200)
                ) {
                    return true;
                } else {
                    alert(`Selected image is of ${img.width}px X ${img.height}px which is not allowed. \nPlease make sure your selected image is of appropriate size.`);
                    $this.val('');
                    return false;
                }
            }
        });
    });
</script>
@endsection
