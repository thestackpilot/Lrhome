@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Hang Tags')
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
                        @if (Session::has('message'))
                        <div class="alert alert-{{Session::get('message')['type']}}">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{Session::get('message')['body']}}
                        </div>
                        @endif
                        <div class="account-content p-5 hang-tags-main">
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">
                                Hang Tags
                            </h1>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (isset($mode) && $mode === 'search')
                            <form class="hangtags-form d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3" enctype="multipart/form-data" action="{{route('dashboard.hangtags-fetch')}}" method="POST">
                                @csrf
                                <div class="card col-md-12 p-0">
                                    @if(Auth::user()->is_customer)
                                    <input type="hidden" name="customer" value="{{Auth::user()->customer_id}}" />
                                    @else
                                    <div class="row mb-3 p-3">
                                        <div class="col-md-12">
                                            <label for="customer" class="form-label">Customer</label>
                                            <select data-required="true" name="customer" id="customer" class="form-control">
                                                @foreach($customers as $customer)
                                                <option value="{{$customer['value']}}">{{$customer['label']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="align-items-center card-header d-flex p-3">
                                        <input type="radio" checked id="search-type" name="search-type" value="user-search">
                                        <label for="search-type" class="m-0 pl-2">User Search</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label for="collections" class="form-label">Collections</label>
                                                <select data-required="true" name="collections" id="collections" class="form-control">
                                                    <option value="">Select an option</option>
                                                    @foreach($collections as $collection)
                                                        @foreach($collection['Colections'] as $sub_collection)
                                                        <option value="{{$sub_collection['KeyID']}}">{{$sub_collection['ViewDescription']}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <label for="designs" class="form-label">Designs</label>
                                                <select disabled name="designs" id="designs" class="form-control">
                                                    <option value="">Select an option</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <label for="colors" class="form-label">Colors</label>
                                                <select disabled name="colors" id="colors" class="form-control">
                                                    <option value="">Select an option</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md-12 p-0">
                                    <div class="align-items-center card-header d-flex p-3">
                                        <input type="radio" id="file-upload" name="search-type" value="file-upload">
                                        <label for="file-upload" class="m-0 pl-2">CSV File Upload</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="csv-file" class="form-label">Upload CSV</label>
                                                <input data-required="true" type="file" accept=".csv" class="form-control-file" name="csv-file" id="csv-file" />
                                                <p>Download <a target="_blank" href="{{route('dashboard.samplefiles', 'hangtag')}}">sample.csv</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md-12 p-0 mb-3">
                                    <div class="align-items-center card-header d-flex p-3">
                                        <input type="radio" id="csv-designs" name="search-type" value="csv-designs">
                                        <label for="csv-designs" class="m-0 pl-2">Copy/Paste Designs</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <label for="csv-designs-text" class="form-label">Designs</label>
                                                <textarea data-required="true" style="height: auto !important;" rows="5" class="form-control" id="csv-designs-text" name="csv-designs" placeholder="i.e. Design 1,Design 2,Design 3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 justify-content-end pe-1 pe-lg-3 col-md-12 d-flex">
                                    <a href="{{route('dashboard.hangtags')}}" class="btn btn-dark text-uppercase mt-2 me-3">Cancel</a>
                                    <button type="submit" class="btn btn-primary text-uppercase mt-2">Search</button>
                                </div>
                            </form>
                            @elseif (isset($mode) && $mode === 'fetch')
                            <form class="download-print-form d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3" target="_blank" enctype="multipart/form-data" action="{{route('dashboard.hangtags-print-download')}}" method="POST">
                                @csrf
                                <input type="hidden" name="customer" value="{{$customer}}" />
                                <div class="card col-md-12 p-0">
                                    <div class="align-items-center card-header d-flex p-3">
                                        <label for="search-type" class="m-0 pl-2">Options</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row p-2">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="header" class="form-label">Change Header</label>
                                                <input type="text" class="form-control" value="" name="header" id="header" maxlength="50" />
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="footer" class="form-label">Change Footer</label>
                                                <input type="text" class="form-control" value={{ str_replace(['http://', 'https://'], '', url('/')) }} name="footer" id="footer" maxlength="50" />
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="price-multiplier" class="form-label">Pricing Multiplier (Dealer Price)</label>
                                                <input type="number" min="1" data-double="true" max="99.99" maxlength="4" class="form-control" value="" name="price-multiplier" id="price-multiplier" step="0.1" />
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="custom-logo" class="form-label">Custom Logo</label>
                                                <div class="d-flex align-items-baseline custom_logo_hangtag">
                                                    <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" name="custom-logo" id="custom-logo" />
                                                    {{-- <span>Optimal image size 300 x 300</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="checkbox" name="without-price" id="without-price" />
                                                <label for="without-price" class="form-label ml-2">Hang Tag without price</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="checkbox" name="include-barcode" id="include-barcode" />
                                                <label for="include-barcode" class="form-label ml-2">Include Barcode</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="checkbox" name="with-map" id="with-map" />
                                                <label for="with-map" class="form-label ml-2">Hang Tag with MAP</label>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="radio" name="round-price" value=".00" id="to-0" />
                                                <label for="to-0" class="form-label ml-2">Round to the nearest .00</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="radio" name="round-price" value=".99" id="to-99" />
                                                <label for="to-99" class="form-label ml-2">Round to the nearest .99</label>
                                            </div>
                                            <div class="col-md-4 col-sm-12 mb-3 pe-1 pe-lg-3">
                                                <input type="radio" name="round-price" value="-1" id="none" />
                                                <label for="none" class="form-label ml-2">No Round</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-dark m-2 p-2" type="submit" name="submit" value="download">Download Hang Tag(s)</button>
                                        <button class="btn btn-dark m-2 p-2" type="submit" name="submit" value="print">Print Hang Tag(s)</button>
                                        <a href="{{route('dashboard.hangtags')}}" class="btn btn-dark m-2 p-2">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="select-all" />
                                                </th>
                                                <th>Image</th>
                                                <th>Item ID</th>
                                                <th>Description</th>
                                                <th>Color</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($items && count($items))
                                            @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="item[]" value="{{json_encode($item)}}" />
                                                </td>
                                                <td>
                                                    <img width="50px" src="{{CommonController::getApiFullImage( $item['ImageName'] )}}" data-orig-src="{{CommonController::getApiFullImage( $item['ImageName'] )}}" alt="{{$item['ItemID']}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" />
                                                </td>
                                                <td>{{$item['ItemID']}}</td>
                                                <td>{{$item['Description']}}</td>
                                                <td>{{$item['ColorDescription']}}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="5">Data not available.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select-all').click(function(){
            if ($(this).is(':checked')) {
                $('[name="item[]"]').prop('checked', true);
            } else {
                $('[name="item[]"]').prop('checked', false);
            }
        });

        $('[name="without-price"]').click(function(e){
            if ($(this).is(':checked'))
                $('[name="round-price"]').prop('disabled', true);
            else
                $('[name="round-price"]').prop('disabled', false);
        });

        $('[name="item[]"]').click(function(e){
            e.stopPropagation();

            if (
                $(this).is(':checked') &&
                $('[name="item[]"]:checked').length == $('[name="item[]"]').length
            ) {
                $('.select-all').prop('checked', true);
            } else {
                $('.select-all').prop('checked', false);
            }
        });

        $('[name="collections"]').change(function() {
            if (typeof $(this).val().length !== 'undefined' && $(this).val().length) {
                $('[name="designs"]').html('<option value="">Loading options</option>').attr('disabled', 'disabled');
                $.post('{{route("dashboard.hangtags-collection-designs")}}', {
                    _token: '{{csrf_token()}}',
                    collection: $(this).val(),
                }, function(response) {
                    if (typeof response.data['OutPut'].Designs !== 'undefined') {
                        var options = '<option value="">Select an option</option>';
                        $('[name="designs"]').html(options);
                        response.data['OutPut'].Designs.forEach(function(design) {
                            options += `<option value="${design.KeyID}">${design.ViewDescription}</option>`;
                        });
                        $('[name="designs"]').html(options).removeAttr('disabled');
                    }
                });
            } else {
                $('[name="designs"], [name="colors"]').attr('disabled', 'disabled');
            }
        });

        $('[name="designs"]').change(function() {
            if (typeof $(this).val().length !== 'undefined' && $(this).val().length) {
                $('[name="colors"]').html('<option value="">Loading options</option>').attr('disabled', 'disabled');
                $.post('{{route("dashboard.hangtags-collection-colors")}}', {
                    _token: '{{csrf_token()}}',
                    collection: $('select[name="collections"] option:selected').val(),
                    design: $(this).val(),
                }, function(response) {
                    if (typeof response.data['OutPut'].Colors !== 'undefined') {
                        var options = '<option value="">Select an option</option>';
                        $('[name="colors"]').html(options);
                        response.data['OutPut'].Colors.forEach(function(color) {
                            options += `<option value="${color.KeyID}">${color.ViewDescription}</option>`;
                        });
                        $('[name="colors"]').html(options).removeAttr('disabled');
                    }
                });
            } else {
                $('[name="designs"], [name="colors"]').attr('disabled', 'disabled');
            }
        });

        // $('[name="designs"]').change(function() {
        //     if (typeof $(this).val().length !== 'undefined' && $(this).val().length) {
        //         $('[name="colors"]').attr('disabled', 'disabled');
        //         $('[name="colors"]').html(`
        //             <option value="">Select an option</option>
        //             <option value="${$(`option[value="${$(this).val()}"]`, $(this)).attr('data-color')}">${$(`option[value="${$(this).val()}"]`, $(this)).attr('data-color')}</option>
        //         `).removeAttr('disabled');
        //     }
        // });

        $('[name="search-type"]').click(function() {
            $('.card-body').addClass('muted');
            $('.card-body input, .card-body textarea, .card-body select').attr('disabled', 'disabled');
            $('.card-body', $(this).closest('.card')).removeClass('muted');
            $('.card-body input, .card-body textarea, .card-body select:first', $(this).closest('.card')).removeAttr('disabled');
        });
        $('[name="search-type"]:first').click();

        $('form.download-print-form').on('submit', function() {
            if ( $('[name="item[]"]:checked').length < 1 ) {
                alert('Please select atleast 1 item.');
                return false;
            }
        });

        $('#csv-designs-text').on('keyup', function() {
            let pattern1 = /^[0-9|A-Z|a-z, ]*$/g;
            if (pattern1.test($(this).val())) {
                $(this).removeClass('is-invalid');
            } else {
                $(this).addClass('is-invalid');
            }
        });

        // $('input[type="file"]').change(function(event) {
        //     let $this = $(this);
        //     let img = new Image()
        //     img.src = window.URL.createObjectURL(event.target.files[0])
        //     img.onload = () => {
        //         if (img.width == 300 && img.height == 300) {
        //             return true;
        //         } else {
        //             alert(`Selected image is of ${img.width}px X ${img.height}px which is not allowed. \nPlease make sure your selected image is of appropriate size.`);
        //             $this.val('');
        //             return false;
        //         }
        //     }
        // });

        $('form.hangtags-form').on('submit', function() {
            var allOk = true;
            $('input[data-required="true"], textarea[data-required="true"], select[data-required="true"]').each(function() {
                if (!$(this).is(':disabled')) {
                    // console.log(`${$(this).attr('name')}: `, $(this).val().trim().length);
                    if (typeof $(this).val().length === 'undefined') {
                        $(this).addClass('is-invalid');
                        allOk = false;
                    } else if ($(this).val().trim().length < 1) {
                        $(this).addClass('is-invalid');
                        allOk = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        allOk = true;
                    }
                }
            });

            if (!$('#csv-designs-text').is(':disabled')) {
                let pattern1 = /^[0-9|A-Z|a-z, ]*$/g;
                if (pattern1.test($('#csv-designs-text').val())) {
                    $(this).removeClass('is-invalid');
                } else {
                    $(this).addClass('is-invalid');
                    allOk = false;
                }
            }

            return allOk;
        });
    });
</script>
@endsection
