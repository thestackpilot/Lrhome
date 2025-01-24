@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

$meta_title = array_key_last($breadcrumbs) . " - " . $design_id . (isset($color) && $color ? substr($color, 0, 3) : '');
// $meta_url = $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
$meta_image = isset($items['Items'][0]['ImageNameArray']) && $items['Items'][0]['ImageNameArray'] ? $items['Items'][0]['ImageNameArray'][0] : url('/').ConstantsController::IMAGE_PLACEHOLDER;
$meta_description = trim($items['Items'][0]['ProductDescription']) == '' || strtolower(trim($items['Items'][0]['ProductDescription'])) == 'not available' ? '' : $items['Items'][0]['ProductDescription'];

$items_images = [];
foreach ($items['Items'] as $item) {
    if (isset($item['ImageNameArray']) && $item['ImageNameArray']) {
        foreach ($item['ImageNameArray'] as $image) {
            if (!in_array($image, $items_images)) {
                $items_images[] = $image;
            }
        }
    }
}

@endphp
@section('title', $meta_title )
@section('meta-image', $meta_image )
@section('meta-description', $meta_description )
@extends('frontend.' . $active_theme -> theme_abrv . '.layouts.app')

@section('content')
<div class="wrapper">
    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
    <main class="main-content">
        @include('frontend.'.$active_theme -> theme_abrv.'.components.breadcrumbs')
        <div class="d-none" id="item_json">{{$items_json}}</div>
        <div class="site-wrapper-reveal">
            <div class="single-product-wrap section-space--pt_40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                            <div class="product-details-left">
                                <div class="product-details-images-2 slider-lg-image-2">
                                    <div class="easyzoom-style">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="{{isset($items['Items'][0]['ImageNameArray']) && $items['Items'][0]['ImageNameArray'] ? $items['Items'][0]['ImageNameArray'][0] : url('/').ConstantsController::IMAGE_PLACEHOLDER}}" class="poppu-img" id="product-main-image">
                                                <img id="image_0" class="img-fluid" src="{{isset($items['Items'][0]['ImageNameArray']) && $items['Items'][0]['ImageNameArray'] ? $items['Items'][0]['ImageNameArray'][0] : url('/').ConstantsController::IMAGE_PLACEHOLDER}}" alt="{{$items['Items'][0]['ItemName']}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-details-thumbs-2 slider-thumbs-2" id="product_thumbnails">
                                    @php $i = 0 @endphp
                                    @foreach($items['Items'][0]['ImageNameArray'] as $image)
                                    <div class="sm-image"> <img id="thumbnail_{{$i++}}" onclick="setMainImage(this)" data-orig-src="{{$image}}" src="{{$image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$items['Items'][0]['ItemName']}}" /> </div>
                                    @endforeach
                                    {{-- @foreach ($items_images as $image)
                                    <div class="sm-image"> <img id="thumbnail_{{$i++}}" onclick="setMainImage(this)" data-orig-src="{{$image}}" src="{{$image}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'" alt="{{$items['Items'][0]['ItemName']}}" /> </div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                            <div class="product-details-content ">
                                <input type="hidden" id="cart_item_id" name="cart_item_id" value="">
                                <input type="hidden" id="cart_customer_id" name="cart_customer_id" value="">
                                <input type="hidden" id="cart_item_name" name="cart_item_name" value="">
                                <input type="hidden" id="cart_item_quantity" name="cart_item_quantity" value="">
                                <input type="hidden" id="cart_item_price" name="cart_item_price" value="">
                                <input type="hidden" id="cart_item_color" name="cart_item_color" value="">
                                <input type="hidden" id="cart_item_size" name="cart_item_size" value="">
                                <input type="hidden" id="cart_item_currency" name="cart_item_currency" value="">
                                <input type="hidden" id="cart_item_image" name="cart_item_image" value="">
                                <input type="hidden" id="cart_item_eta" name="cart_item_eta" value="">

                                <h3 class="price mb-2" id="product-heading">{{$items['Items'][0]['ItemName']}}{{isset($color) && $color ? substr($color, 0, 3) : ''}}</h3>
                                <div class="price align-items-center mb-2">
                                    <span class="base_price muted prefix {{!Auth::user() ? 'd-none' : ''}}"> $ </span>
                                    <span class="base_price muted {{!Auth::user() ? 'd-none' : ''}}" id="base_price">0</span>
                                    <span class="postfix base_price muted {{!Auth::user() ? 'd-none' : ''}}" style="text-transform: initial;margin-left: 5px;font-size: 16px;margin-top: 5px; opacity: 0.9;"></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="form-label font-crimson bg-secondary {{!Auth::user() ? '' : ''}}" id="qty_msg">Loading...</span>
                                </div>

                                <div class="section over-hide z-bigger" id="item_variant_parent">
                                    <h3 class="detiel-heading">Collection</h3>
                                    <div id="item_variant" class="d-flex flex-wrap justify-flex justify-content-start flex-row variant-details">
                                        <input class="checkbox-tools" value="" type="radio" name="variant" id="" checked="checked">
                                        <label class="for-checkbox-tools" for=""> </label>
                                    </div>
                                </div>

                                <div class="section over-hide z-bigger d-none" id="item_color_parent">
                                    <h3 class="detiel-heading">Color<span id="color_name"></span></h3>
                                    <div id="item_color" class="d-flex flex-wrap justify-flex justify-content-start flex-row variant-details">
                                        <input class="checkbox-tools" value="" type="radio" name="color" id="" checked="checked">
                                        <label class="for-checkbox-tools" for=""> </label>
                                    </div>
                                </div>

                                <div class="section over-hide z-bigger d-none" id="item_size_parent">
                                    <h3 class="detiel-heading">Size<span id="size_name"></span></h3>
                                    <div id="item_size" class="d-flex flex-wrap justify-flex justify-content-start flex-row variant-details">
                                        <input class="checkbox-tools" value="" type="radio" name="size" id="" checked="checked">
                                        <label class="for-checkbox-tools" for=""> </label>
                                    </div>
                                </div>

                                @if(isset($items['PillowCovers']) && $items['PillowCovers'])
                                <div class="section over-hide z-bigger d-none" id="item_cover_parent">
                                    <h3 class="detiel-heading">Insert Type<span id="cover_name"></span></h3>
                                    <div id="item_cover" class="d-flex flex-wrap justify-flex justify-content-start flex-row variant-details">
                                        <input class="checkbox-tools" value="" type="radio" name="cover" id="" checked="checked">
                                        <label class="for-checkbox-tools" for=""> </label>
                                    </div>
                                </div>
                                @endif

                                <input type="hidden" value="{{$items['Items'][0]['UserCustomerInfo']['IsSaleRep']}}" name="sale_rep">

                                <div class="section over-hide z-bigger d-none" id="item_customer_parent">
                                    <h3 class="detiel-heading d-flex">
                                        Customer
                                        <div class="ps-0 pe-0 pl-2 d-flex" id="active_customer_select">
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-html="true" data-placement="left" title="Please select the customer for whom the order needs to be created. Please note once selected than the customer cannot be changed till the order is placed or cart is emptied."></i>
                                        </div>
                                        <div class="ps-0 pe-0 pl-2 d-flex" id="disabled_customer_select">
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-html="true" data-placement="left" title="The item will be added in the cart for the selected customer. If the customer needs to be changed then either checkout the order or empty the cart."></i>
                                        </div>
                                    </h3>
                                    <select name="customer" class="form-select me-2" aria-label="Default select customer" id="item_customer">
                                        <option selected value="0">Select Customer</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between mt-2 over-hide section z-bigger mbl-qty-main-box">
                                    <div class="d-flex flex-column flex-wrap" id="qty-main">
                                        <h3 class="detiel-heading d-flex">Qty</h3>
                                        <div class="d-flex flex-row qty-styles mb-2">
                                            <a href="javascript:void(0);" class="qty-minus qty-action"> - </a>
                                            <input type="number" id="item_qty" name="quantity" autocomplete="off" onkeydown="if(this.key==='.'){this.preventDefault();}" class="form-control" min="1" max="9999" maxlength="4" step="1" required value="" />
                                            <a href="javascript:void(0);" class="qty-add qty-action"> + </a>
                                        </div>
                                        <span class="form-label font-crimson">&nbsp;</span>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end d-none cart_main_custom {{!Auth::user() ? 'w-100 mb-4' : ''}}" id="cart_main">
                                        <h3 class="detiel-heading d-flex {{!Auth::user() ? 'd-none' : ''}}">&nbsp;</h3>
                                        @auth()
                                        <button type="button" class="btn btn-dark add-to-cart d-none mb-2" id="add_to_cart">
                                            <span class="label-text">Add to Cart</span>
                                            <div class="spinner-border" role="status" style="margin: 0 auto;">
                                                <span class="sr-only" style="opacity:0;">Loading...</span>
                                            </div>
                                        </button>
                                        @endauth
                                        @guest()
                                        <button type="button" class="log-in-popup-button btn btn-dark d-none" id="login_by_popup">
                                        LOG IN TO ADD TO CART AND SEE PRICING
                                        </button>
                                        @endguest
                                        <span class="form-label font-crimson {{!Auth::user() ? 'd-none' : ''}}">&nbsp;</span>
                                    </div>
                                </div>
                                <!-- <div class="section over-hide z-bigger d-flex flex-row align-items-center justify-content-between mt-2" id="qty-main">
                                    <div class="d-flex align-items-center detiel-heading">
                                        <label class="base_price me-2 mb-0 mr-2"><b>Price: </b></label>
                                        <span class="base_price prefix"> $ </span>
                                        <span class="base_price" id="base_price"></span>
                                    </div>
                                </div> -->
                                <div class="m-5 spinner-border qty-loader d-none" role="status">
                                    <span class="sr-only" style="opacity:0;">Loading...</span>
                                </div>
                                <div class="quickview-peragraph">
                                    <h3 class="detiel-heading"> PRODUCT DETAILS</h3>
                                    <p id="product-description">{!! trim($items['Items'][0]['ProductDescription']) == '' || strtolower(trim($items['Items'][0]['ProductDescription'])) == 'not available' ? '' : $items['Items'][0]['ProductDescription'] !!}</p>

                                    <table class="table my-table" id="item-udf-fields">
                                        @foreach($items['Items'][0]['UDFFields'] as $field)
                                        @if (
                                            $field['FieldName'] == 'Color' ||
                                            $field['FieldName'] == 'Size' ||
                                            $field['Value'] == '-' ||
                                            $field['Value'] == 'N/A' ||
                                            !strlen($field['Value'])
                                        )
                                        @continue
                                        @endif
                                        <tr class="UDField">
                                            <td>{{$field['FieldName']}} :</td>
                                            <td> {{$field['Value']}} </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <hr style="margin: 0;"/>
                                <div class="section over-hide z-bigger item-accordion">
                                    <h3 class="detiel-heading item-accordion-heading item-care-instruction d-none" data-toggle="collapse" data-target="#care-instructions">CARE INSTRUCTIONS</h3>
                                    <div id="care-instructions" class="collapse">
                                        <p class="table my-table item-care-instruction d-none" id="item-care-instruction"></p>
                                    </div>
                                </div>
                                <hr class="d-none care-instruction-line" style="margin: 0;"/>
                                <div class="section over-hide z-bigger item-accordion">
                                    <!-- <h3 class="detiel-heading item-size-dimension d-none">Shipping Dimensions & Weight</h3>
                                    <table class="table my-table item-size-dimension d-none" id="item-size-dimension">

                                    </table> -->
                                    <h3 class="detiel-heading item-accordion-heading item-size-dimension d-none" data-toggle="collapse" data-target="#shipping-dimensions">SHIPPING INFO</h3>
                                    <div id="shipping-dimensions" class="collapse">
                                        <table class="table m-0 my-table item-size-dimension d-none" id="item-size-dimension">

                                        </table>
                                    </div>
                                </div>
                                <hr class="d-none size-dimension-line" style="margin: 0;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($related_designs) && isset($related_designs['Designs']) && count($related_designs['Designs']))
        <div class="container mt-5">
            <div class="col-lg-12">
                <div class="section-title text-center mb-30">
                    <h4 style="color: #444242;"> YOU MAY ALSO LIKE</h4>
                </div>
            </div>
            @if(!empty($related_designs))
            <div class="col-lg-12">
                <div class="product-slider-active">
                    @foreach($related_designs['Designs'] as $design)
                    <div class="single-product-item text-center">
                        <div class="products-images">
                            <a href="{{ $design['LinkUrl'] }}" class="product-thumbnail">
                                <figure class="align-items-center d-flex m-0 overflow-hidden">
                                    <img src="{{CommonController::getApiFullImage($design['ImageName'])}}" class="img-fluid" alt="{{ $design['Description']}}" title="{{ $design['CollectionID']}} - {{ $design['DesignID']}}" onerror="this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'">
                                    @php
                                        $badges = [
                                            [
                                                'condition'     => $design['SpecialBuy'],
                                                'background'    => 'special-buy',
                                                'label'         => 'Special Buy'
                                            ],
                                            [
                                                'condition'     => $design['Clearence'],
                                                'background'    => 'clearance',
                                                'label'         => 'Clearence'
                                            ],
                                            [
                                                'condition'     => $design['NewArrivalExpiry'],
                                                'background'    => 'new-arrival',
                                                'label'         => 'New Arrival'
                                            ],
                                            [
                                                'condition'     => $design['TopSeller'],
                                                'background'    => 'top-seller',
                                                'label'         => 'Top Seller'
                                            ],
                                            [
                                                'condition'     => $design['Discontinued'],
                                                'background'    => 'discontinued',
                                                'label'         => 'discontinued'
                                            ],
                                        ];
                                        $count      = 0;
                                        foreach($badges as $badge)
                                            if(strtolower($badge['condition']) != 'false' && strtolower($badge['condition']) !== '') {
                                                echo '<div style="background: url(/LR/images/labels/'.$badge['background'].'.png)" class="position-absolute handles-position"></div>';
                                            }
                                        @endphp
                                </figure>
                            </a>
                        </div>
                        <div class="product-content">
                            <h6 class="prodect-title"><a href="{{ $design['LinkUrl'] }}">{{$design['Description']}}</a></h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif
    </main>
    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@include('frontend.'.$active_theme -> theme_abrv.'.components.login-modal')
@endsection

@section('scripts')
<script>
    var item_object = ""; //get the json decoded object
    var customerID = $('input[name="sale_rep"]').val() == 1 ? '' : 1;
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom({
        loadingNotice: '',
        errorNotice: ''
    });

    // TODO : Please add taoster library as it is needed - Asfand needs to do it
    function init_sliders() {
        $('.product-details-thumbs-2').each(function() {
            var $this = $(this);
            var $details = $this.siblings('.product-details-images-2');
            $this.slick({
                arrows: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 3000,
                vertical: true,
                verticalSwiping: true,
                dots: false,
                infinite: false,
                focusOnSelect: true,
                centerMode: false,
                centerPadding: 0,
                prevArrow: '<i class="icon-arrow-up arrow-up"></i>',
                nextArrow: '<i class="icon-arrow-down arrow-down"></i>',
                // asNavFor: $details,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            vertical: false,
                            prevArrow: '<i class="icon-arrow-left arrow-prv"></i>',
                            nextArrow: '<i class="icon-arrow-right arrow-next"></i>'
                        }
                    },
                    {
                        breakpoint: 479,
                        settings: {
                            slidesToShow: 3,
                            vertical: false,
                            prevArrow: '<i class="icon-arrow-left arrow-prv"></i>',
                            nextArrow: '<i class="icon-arrow-right arrow-next"></i>'
                        }
                    }
                ]
            });
        });
    }

    function setMainImage(img) {
        $("#image_0").attr("src", img.src);
        $("#image_0").closest('a').attr("href", img.src);
        $easyzoom.data('easyZoom').swap(img.src, img.src);
    }

    function refreshItemJson(callback) {
        if ($('#item_json').length) {
            $.ajax({
                method: 'GET',
                url: window.location.href,
                data: {
                    '_token': '{{csrf_token()}}',
                    'refresh': true,
                },
                success: function(response) {
                    var new_html = $($.parseHTML(response));
                    $('#item_json').html(new_html.find('#item_json').html());

                    item_object = JSON.parse($('#item_json').html());

                    $('#cart-parent').html(new_html.find('#cart-parent').html());
                    $('#profile-parent').html(new_html.find('#profile-parent').html());

                    $('#cart_main').html(new_html.find('#cart_main').html());
                    $('#cart_main').find('#add_to_cart').removeClass('d-none');
                    $('#cart_main').find('#login_by_popup').remove();

                    $('#add_to_cart').off('click');
                    $('#add_to_cart').on('click', function(e) {
                        if (
                            $('input[name="sale_rep"]').val() == 1 &&
                            customerID.length == 0
                        )
                            toastr.warning('Please select a customer...', {
                                hideDuration: 10000,
                                closeButton: true,
                            });
                        else
                            pushToCart();
                    });
                    if (callback) {
                        callback();
                    }
                    getQuantity($("#item_size input:radio[name=size]:checked").val().trim());
                }
            });
        }
    }

    function refresh_product(ItemID) {
        $('#item-udf-fields').html("");
        item_object.Items.forEach(function(item, index) {
            if (item.ItemID == ItemID) {
                $('#product-main-image').fadeOut(100, function() {
                    $("#image_0").attr('src', item.ImageName).attr('onerror', "this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'");
                }).fadeIn(100);
                setMainImage({src: item.ImageName});
                $('#image_0').attr('alt', item.ItemName);
                $('#product_thumbnails').html('');
                $('.product-details-thumbs-2').slick('unslick');
                $('.product-details-thumbs-2').html('');
                for (var i = 0; i <= item.ImageNameArray.length; i++) {
                    var div = $('<div class="sm-image"> </div>');
                    div.append($('<img />', {
                        id: 'thumbnail_' + i,
                        src: item.ImageNameArray[i],
                        'data-orig-src': item.ImageNameArray[i],
                        onclick: "setMainImage(this)",
                        onerror: "this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'"
                    }));
                    $('#product_thumbnails').append(div);
                    //$('#thumbnail_'+i).attr('src',item.ImageNameArray[i]).attr('onerror', "this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'");
                }
                init_sliders();
                // console.log(`${item.ItemName}${($("label", $("input[name='color']:checked").parent()).attr('data-color')).replace(/^0+$/, '').replace(/0+$/, '')}`);
                $('#product-heading').html(`Design: ${item.DesignID}<b>${($(`label[for="color_${$("input[name='color']:checked").val()}"]`).attr('data-color')).substr(0, 3)}</b>`);

                if (item.ProductDescription == null) {
                    item.ProductDescription = '';
                }
                var description = item.ProductDescription.toString().trim();
                if (description.length == 0) {
                    // description = 'Not Available';
                }
                $('#product-description').html(description);


                // $('#item-udf-fields').html("");
                item.UDFFields.forEach(function(field, f_index) {
                    if (field.FieldName.trim() != 'Color' && field.FieldName.trim() != 'Size') {
                        var tr = $("<tr class = 'UDField'> </tr>");

                        tr.append($('<td>', {
                            html: field.FieldName.trim() + ": "
                        }));

                        tr.append($('<td>', {
                            text: field.Value.trim()
                        }));

                        $('#item-udf-fields').append(tr);
                    }
                });
            }
        });
    }

    function hide_components(class_arr) {
        class_arr.forEach(function(component) {
            $(component).removeClass('d-none');
            $(component).addClass('d-none');
        });
    }

    function show_components(class_arr) {
        class_arr.forEach(function(component) {
            $(component).removeClass('d-none');
        });
    }

    function init() {
        item_object = JSON.parse($('#item_json').html());
        var counter = 0;

        $('#item_variant').html('');
        item_object.Items.forEach(function(item, index) {
            if (!$('#item_variant input[name=variant]:contains(' + item.ItemName + ')').length) {
                $('#item_variant').append($('<input>', {
                    value: item.ItemID,
                    text: item.ItemName,
                    class: 'checkbox-tools',
                    type: 'radio',
                    name: 'variant',
                    id: 'variant_' + item.ItemID,
                    'data-design': item.DesignID
                }));

                $('#item_variant').append($('<label>', {
                    text: item.ItemName,
                    class: 'for-checkbox-tools variant',
                    for: 'variant_' + item.ItemID
                }));
                counter++;
            }
        });
        if (counter > 1) {
            $("#item_variant input:radio[name=variant]:first").attr('checked', true);
        } else if (counter == 1) {
            $("#item_variant input:radio[name=variant]:first").attr('checked', true);
            hide_components(['#item_variant_parent']);
        } else {
            hide_components(['#item_variant_parent']);
        }
        getColors($("#item_variant input:radio[name=variant]:checked").text());
    }

    function getColors(ItemName) {
        show_components(['#item_color_parent']);
        hide_components(['#item_size_parent', '#item_customer_parent', '#qty-main', '#cart_main', '#add_to_cart', '#login_by_popup']);
        $('#item_color').html('');
        item_object.Items.forEach(function(item, index) {
            // console.log(`ItemID: ${item.ItemID} | ItemColorID: ${item.ColorID} | ItemDesign: ${item.DesignID} | ItemColorDesign: ${item.ItemColorDesign} | ${item.ItemName.trim()} == ${ItemName.trim()}`);
            if (item.ItemName.trim() == ItemName.trim()) {
                var exists = false;
                $('#item_color input[name=color]').each(function(){
                    // console.log(`${$(this).text().trim()} | ${$(this).text().trim()} == ${item.ItemColor} && ${$(this).attr('data-design')} == ${item.ItemColorDesign}`);
                    if ( $(this).text().trim() == item.ItemColor.trim() && $(this).attr('data-design') == item.ItemColorDesign.trim() ) exists = true;
                });

                if ( !exists ) {
                    $('#item_color').append($('<input>', {
                        value: item.ItemID,
                        text: item.ItemColor,
                        class: 'checkbox-tools',
                        type: 'radio',
                        name: 'color',
                        id: 'color_' + item.ItemID,
                        'data-design': item.ItemColorDesign
                    }));

                    $('#item_color').append($('<label>', {
                        title: item.ItemColor,
                        'data-toggle': "tooltip",
                        'data-design': item.ItemColorDesign,
                        'data-color': item.ColorID,
                        class: 'for-checkbox-tools',
                        for: 'color_' + item.ItemID
                    }).append(
                        $('<img>', {
                            src: item.ItemColorImage,
                            'data-orig-src': item.ItemColorImage,
                            alt: item.ItemColor,
                            onerror: "this.onerror=null; this.src='{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}'"
                        })
                    ));
                }
            }
        });

        bindClicks();

        var color = `{{isset($color) && $color ? $color : ''}}`;
        var color_node = color.length ? `[data-color="${color}"][data-design="{{$design_id}}"]` : '#item_color label:first';
        $(color_node).click();
        setTimeout(function() {
            $(`${color_node}, #${$(color_node).attr('for')}`).click();
        }, 1500);
    }

    function getSizes(ItemName, ItemColor, ItemValue) {
        show_components(['#item_size_parent']);
        hide_components(['#item_cover_parent', '#item_customer_parent', '#qty-main', '#cart_main', '#add_to_cart', '#login_by_popup']);
        $('#item_size').html('');
        item_object.Items.forEach(function(item, index) {
            if ((item.DesignID.trim() == ItemName.trim()) && (item.ItemColor.trim() == ItemColor.trim())) {
                if (!$('#item_size input[name=size]:contains(' + item.ItemSize + ')').length) {
                    $('#item_size').append($('<input>', {
                        value: item.ItemID,
                        text: item.ItemSize,
                        class: 'checkbox-tools',
                        type: 'radio',
                        name: 'size',
                        id: 'size_' + item.ItemID,
                        'data-design': item.ItemSizeDesign
                    }));

                    $('#item_size').append($('<label>', {
                        text: item.ItemSize,
                        class: 'for-checkbox-tools',
                        for: 'size_' + item.ItemID
                    }));
                }
            }
        });
        bindClicks();

        $(`#item_size label:first, #item_size input[name=size]:first`).click();
        setTimeout(function() {
            $(`#item_size label:first, #item_size input[name=size]:first`).click();
        }, 1500);
    }

    function getCovers(Item) {
        hide_components(['#item_customer_parent', '#qty-main', '#cart_main', '#add_to_cart', '#login_by_popup']);
        $('#item_cover').html('');
        var ItemID = Item.val();
        var covers_available = false;
        item_object.PillowCovers.forEach(function(cover, index) {
            if (cover.ParentItemID.trim() == ItemID.trim()) {
                if (!$('#item_cover input[name=cover]:contains(' + cover.Description + ')').length) {
                    $('#item_cover').append($('<input>', {
                        value: cover.ItemID,
                        text: cover.Description,
                        class: 'checkbox-tools',
                        type: 'radio',
                        name: 'cover',
                        id: 'cover_' + cover.ItemID,
                        "data-parent": cover.ParentItemID,
                    }));

                    $('#item_cover').append($('<label>', {
                        text: cover.Description,
                        class: 'for-checkbox-tools',
                        for: 'cover_' + cover.ItemID
                    }));
                    covers_available = true;
                }
            }
        });
        if ( covers_available ) {
            show_components(['#item_cover_parent']);
            bindClicks();
            if ( !$('input[name=cover]').is(':checked') )
                $(`#item_cover label:first, #item_cover input[name=cover]:first`).click();
        } else {
            hide_components(['#item_cover_parent']);
            pupolateDimensions(Item.parent('#item_size_parent'), Item.val());
            pupolateInstructions(Item.parent('#item_size_parent'), Item.val());
            getQuantity(Item.val());
        }
    }

    function getQuantity(ItemID, ParentID) {
        // TODO : The radio button is working but not getting highlighted - Adil needs to fix this
        if (ItemID == '0') {
            hide_components(['#item_customer_parent']);
            hide_components(['#qty-main', '#cart_main', '#add_to_cart']);
            return true;
        }
        item_object.Items.forEach(function(item, index) {
            if ((item.ItemID == ItemID) || (typeof ParentID !== "undefined" && item.ItemID == ParentID)) {
                $('#item_customer').prop('disabled', false);
                if (item.UserCustomerInfo.IsSaleRep == 1) {
                    getCustomers(item);
                    if (item_object.Items[0].UserCustomerInfo.CustomerSet) {
                        $('#item_customer').prop('disabled', 'disabled');
                    }
                    var customer_id = item.UserCustomerInfo.CustomerSet ? item.UserCustomerInfo.CustomerSet : item.UserCustomerInfo.Customers[0].CustomerID;
                    
                    $('#qty-main, .base_price').addClass('muted');
                    $('#qty_msg').css('opacity', '0.4');
                    if (!$('#qty-main').is(':visible'))
                        show_components(['.qty-loader']);
                    $.post('{{route("frontend.item.ats")}}', {
                        _token: '{{csrf_token()}}',
                        item_id: ItemID,
                        customer_id: customer_id
                    }, function(response) {
                        // console.log(`getQuantity::customer_id: ${customer_id}`);
                        startBuying(ItemID, customer_id, response.data);
                    });

                    if (item.UserCustomerInfo.CustomerSet) {
                        // startBuying(item.ItemID, item.UserCustomerInfo.Customers[0].CustomerID , item.UserCustomerInfo.Customers[0].ATSInfo);
                    }
                } else {
                    $('#qty-main, .base_price').addClass('muted');
                    $('#qty_msg').css('opacity', '0.4');
                    if (!$('#qty-main').is(':visible'))
                        show_components(['.qty-loader']);
                    $.post('{{route("frontend.item.ats")}}', {
                        _token: '{{csrf_token()}}',
                        item_id: ItemID,
                        customer_id: typeof item.UserCustomerInfo.Customers[0].CustomerID !== "undefined" ? item.UserCustomerInfo.Customers[0].CustomerID : ''
                    }, function(response) {
                        // console.log(`getQuantity::item.UserCustomerInfo.Customers[0].CustomerID: ${item.UserCustomerInfo.Customers[0].CustomerID}`);
                        startBuying(ItemID, item.UserCustomerInfo.Customers[0].CustomerID, response.data);
                    });
                    // startBuying(item.ItemID, item.UserCustomerInfo.Customers[0].CustomerID , item.UserCustomerInfo.Customers[0].ATSInfo);
                }
                if ($('#checkOut_popup').is(':visible'))
                    $('#checkOut_popup').hide();
            }
        });

        bindClicks();
    }

    function getCustomers(item) {
        show_components(['#item_customer_parent']);
        hide_components(['#qty-main', '#cart_main', '#add_to_cart', '#login_by_popup']);
        $('#item_customer').html('<option value="0">Select Customer</option>');
        item.UserCustomerInfo.Customers.forEach(function(Customer, index) {
            if (item.UserCustomerInfo.CustomerSet) {
                $('#active_customer_select').addClass('d-none');
                $('#disabled_customer_select').removeClass('d-none');
                if (Customer.CustomerID == item.UserCustomerInfo.CustomerSet) {
                    customerID = Customer.CustomerID;
                    $('#item_customer').append($('<option>', {
                        value: item.ItemID + ' :: ' + Customer.CustomerID,
                        text: Customer.CompanyName,
                        selected: 'selected'
                    }));

                    /* $('#item_customer').append($('<label>', {
                        text: Customer.CompanyName,
                        class: 'for-checkbox-tools',
                        for: 'customer_' + item.ItemID + '-' + Customer.CustomerID
                    })); */
                }
            } else {
                $('#active_customer_select').removeClass('d-none');
                $('#disabled_customer_select').addClass('d-none');
                $('#item_customer').append($('<option>', {
                    value: item.ItemID + ' :: ' + Customer.CustomerID,
                    text: Customer.CompanyName
                }));

               /*  $('#item_customer').append($('<label>', {
                    text: Customer.CompanyName,
                    class: 'for-checkbox-tools',
                    for: item.ItemID + ' :: ' + Customer.CustomerID
                }));
                customerID = ''; */
            }
        });
        bindClicks();
    }

    function pupolateDimensions(parent, itemID) {
        item_object.Items.forEach(function(item, index) {
            if ((item.ItemID == itemID)) {
                if (
                    typeof item.ItemSizeDimension !== 'undefined' &&
                    typeof item.ItemSizeDimension.DimentionalWeight !== 'undefined'
                ) {
                    $('.item-size-dimension, .size-dimension-line').removeClass('d-none');
                    var dimensionsHTML = '';
                    if ( typeof item.ItemSizeDimension.DimentionalWeight !== "undefined" ) {
                        dimensionsHTML = dimensionsHTML + `
                        <tr>
                            <td>Weight (lbs)</td>
                            <td>${item.ItemSizeDimension.DimentionalWeight}</td>
                        </tr>
                        `;
                    }
                    if ( typeof item.ItemSizeDimension.ShippingDimension.length !== "undefined" && item.ItemSizeDimension.ShippingDimension.length ) {
                        dimensionsHTML += `
                        <tr>
                            <td>Package Dims (in)</td>
                            <td>${item.ItemSizeDimension.ShippingDimension}</td>
                        </tr>
                        `;
                    }
                    $('#item-size-dimension').html(dimensionsHTML);
                } else {
                    $('.item-size-dimension').addClass('d-none');
                    $('#item-size-dimension').html('');
                }
            }
        });
    }

    function pupolateInstructions(parent, itemID) {
        item_object.Items.forEach(function(item, index) {
            if ((item.ItemID == itemID)) {
                if (
                    typeof item.CareInstructions !== 'undefined' &&
                    item.CareInstructions !== ''
                ) {
                    $('.item-care-instruction, .care-instruction-line').removeClass('d-none');
                    $('#item-care-instruction').html(`
                        <span>
                            ${item.CareInstructions}
                        </span>
                    `);
                } else {
                    $('.item-care-instruction').addClass('d-none');
                    $('#item-care-instruction').html('');
                }
            }
        });
    }

    function getCartReady(item_customer_id) {
        $('#qty-main, .base_price').addClass('muted');
        var split_arr = item_customer_id.split(' :: ');
        var item_id = split_arr[0].trim();
        var customer_id = split_arr[1].trim();
        item_object.Items.forEach(function(item, index) {
            if ((item.ItemID == item_id)) {
                item.UserCustomerInfo.Customers.forEach(function(Customer, index) {
                    if (Customer.CustomerID == customer_id) {
                        $('#qty_msg').css('opacity', '0.4');
                        if (!$('#qty-main').is(':visible'))
                            show_components(['.qty-loader']);
                        $.post('{{route("frontend.item.ats")}}', {
                            _token: '{{csrf_token()}}',
                            item_id: item_id,
                            customer_id: customer_id
                        }, function(response) {
                            // console.log(`getCartReady::CustomerID: ${customer_id}`);
                            startBuying(item_id, customer_id, response.data, item_id);
                        });
                        // startBuying(item_id, customer_id , Customer.ATSInfo);
                    }
                });
            }
        });
    }

    function startBuying(ItemID, CustomerID, ATSInfo) {
        // console.log(`startBuying::CustomerID: ${CustomerID}`);
        if ($('#login_by_popup').length) {
            show_components(['#login_by_popup', '#cart_main']);
            hide_components(['#qty-main', '.qty-loader', '.base_price']);
        } else {
            hide_components(['.qty-loader', '#login_by_popup']);
            show_components(['#qty-main', '#cart_main', '#add_to_cart']);
            if (customerID.length != 0) {
                show_components(['.base_price', '#qty_msg']);
                $(".cart_main_custom").removeClass('w-100').removeClass('mb-4');
            }
        }
        $('#qty-main, .base_price').removeClass('muted');
        if (customerID.length != 0) $('#add_to_cart').removeAttr('disabled');
        $('#base_price').text(ATSInfo.Price);
        $('.postfix.base_price').text(ATSInfo.CostType.toUpperCase());
        $('#qty_msg').text(getQuantityMessage(ATSInfo)).css('opacity', '1').removeClass('bg-success').removeClass('bg-warning').removeClass('bg-img');
        var qty_message = $('#qty_msg').text().toLowerCase();
        $('#qty_msg').addClass((qty_message.indexOf('in stock') > -1 || qty_message.indexOf('units available') > -1) ? 'bg-success' : 'bg-warning');
        $('#item_qty').attr('max', ATSInfo.OnlyMaxQuantity ? ATSInfo.ATSQty : 9999);
        // console.log("item_object.Items.length:: ", item_object.Items.length);
        var item_title = $('#product-heading').clone();
        $('b', item_title).remove();
	    item_object.Items.forEach(function(item, index) {
            // console.log(`${item.ItemID} == ${ItemID} : ${item.ItemID == ParentID}`);
            // console.log(`startBuying forEach::CustomerID: ${CustomerID}`);
            if ((item.ItemID == ItemID)) {
                $('#cart_item_id').val(ItemID);
                $('#cart_customer_id').val(CustomerID);
                $('#cart_item_name').val(item_title.text());
                $('#cart_item_quantity').val($('#item_qty').val(0));
                // $('#cart_item_price').val(ATSInfo.Price);
                $('#cart_item_price').val(ATSInfo.OrignalPrice);
                $('#cart_item_color').val($("#item_color input:radio[name=color]:checked").text());
                $('#cart_item_size').val($("#item_size input:radio[name=size]:checked").text());
                $('#cart_item_currency').val('$');
                $('#cart_item_image').val(item.ImageNameArray[0]);
                $('#cart_item_eta').val(ATSInfo.ETADate);
            }
        });
        if ( ATSInfo.ATSQty <= 0 && ATSInfo.Discontinued ) {
            $('.mbl-qty-main-box').attr('style', 'opacity: 0.4; pointer-events: none;');
            if (!$('#discnt-msg').length)
            $('<p class="m-2" style="color: red;" id="discnt-msg">Item is no longer available.</p>').insertBefore($('.mbl-qty-main-box'));
        } else {
            $('.mbl-qty-main-box').removeAttr('style');
            $('#discnt-msg').remove();
        }
    }

    function getQuantityMessage(ATSInfo) {
        var date = new Date(ATSInfo.ETADate);
        var formattedDate = new Intl.DateTimeFormat('en-US', { 
            month: 'short', 
            day: 'numeric', 
            year: 'numeric' 
        }).format(date);

        if ($('#login_by_popup').length) {
            if (ATSInfo.ATSQty <= 0)
                return `Backorder ETA: ${formattedDate}`;
            else if (ATSInfo.ATSQty > 30)
                return `In stock, 30+`;
            else
                return `In stock, ${ATSInfo.ATSQty}`;
        } else {
	    if (ATSInfo.ATSQty <= 0)	
		return `Backorder ETA: ${formattedDate}`;            
	    return `In stock, ${ATSInfo.ATSQty}`;

            if (ATSInfo.ATSQty == 0)
                return `Backorder Backorder. ETA: ${formattedDate}`;
            else if (ATSInfo.ATSQty <= 5)
                return `Limited Quantity Available, please email to confirm`;
            else if (ATSInfo.ATSQty > 5 && ATSInfo.ATSQty <= 15)
                return `${ATSInfo.ATSQty} Available`;
            else
                return `15+ Available`;
        }
    }

    function pushToCart() {
        // console.log("customer id in pushToCart :: ", $('#cart_customer_id').val());
        $('#add_to_cart').addClass('btn-muted');
        $('#cart_item_quantity').val($('#item_qty').val());
        if ((/^\+?[1-9]\d*/).test(parseInt($('#item_qty').val()))) {
            $.ajax({
                method: 'POST',
                url: '{{route("frontend.cart.add")}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'cart_item_id': $('#cart_item_id').val(),
                    'cart_customer_id': $('#cart_customer_id').val(),
                    'cart_item_name': $('#cart_item_name').val(),
                    'cart_item_quantity': $('#cart_item_quantity').val(),
                    'cart_item_price': $('#cart_item_price').val(),
                    'cart_item_color': $('#cart_item_color').val(),
                    'cart_item_size': $('#cart_item_size').val(),
                    'cart_item_currency': $('#cart_item_currency').val(),
                    'cart_item_image': $('#cart_item_image').val(),
                    'cart_item_data': $('#item_json').html(),
                    'cart_item_eta': $('#cart_item_eta').val()
                },
                success: function(response) {
                    if (response.success) {
                        if ($('#item_json').length) {
                            refreshItemJson(function() {
                                toastr.success(response.message, {
                                    hideDuration: 10000,
                                    closeButton: true,
                                });
                                $('#add_to_cart').removeClass('btn-muted');
                                window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
                                // $('.quickCart-opener').trigger('click');
                            });
                        } else {
                            refreshUser('quick-cart', function() {
                                refreshUser('profile', function() {
                                    $("#quick_cart").removeClass('d-none');
                                    toastr.success(response.message, {
                                        hideDuration: 10000,
                                        closeButton: true,
                                    });
                                    $('#add_to_cart').removeClass('btn-muted');
                                    window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
                                    // $('.quickCart-opener').trigger('click');
                                });
                            });
                        }
                    } else {
                        toastr.warning(response.message, {
                            hideDuration: 10000,
                            closeButton: true,
                        });
                        $('#add_to_cart').removeClass('btn-muted');
                    }
                },
                error: function(response) {
                    toastr.warning(response.message, {
                        hideDuration: 10000,
                        closeButton: true,
                    });
                    $('#add_to_cart').removeClass('btn-muted');
                }
            });
        } else {
            toastr.warning("Please enter a valid value", {
                hideDuration: 10000,
                closeButton: true,
            });
            $('#add_to_cart').removeClass('btn-muted');
        }
    }

    function bindClicks() {

        $("#item_variant input[name='variant']")
            .off('click')
            .on('click', function() {
                refresh_product($(this).val());
                getColors($("#item_variant input[name='variant']:checked").text().trim());
            });

        $("#item_color input[name='color']")
            .off('click')
            .on('click', function() {
                refresh_product($(this).val());
                $('#color_name').html(`: ${$("#item_color input[name='color']:checked").text().trim()}`);
                getSizes($("#item_color input[name='color']:checked").attr('data-design').trim(), $("#item_color input[name='color']:checked").text().trim(), $(this).val());
            });

        $("#item_size input[name='size']")
            .off('click')
            .on('click', function() {
                refresh_product($(this).val());
                $(this).attr('checked', true);
                $('#size_name').html(`: ${$("#item_size input[name='size']:checked").text().trim()}`);
                if ( typeof $('#item_cover_parent').length !== "undefined" && $('#item_cover_parent').length ) {
                    refresh_product($(this).val());
                    getCovers($(this));
                } else {
                    pupolateDimensions($(this).parent('#item_size_parent'), $(this).val());
                    pupolateInstructions($(this).parent('#item_size_parent'), $(this).val());
                    getQuantity($(this).val());
                }
            });

        $("#item_cover input[name='cover']")
            .off('click')
            .on('click', function() {
                $(this).attr('checked', true);
                $('#cover_name').html(`: ${$("#item_cover input[name='cover']:checked").text().trim()}`);
                refresh_product($(this).val());
                getQuantity($(this).val(), $(this).attr('data-parent'));
            });

        $("#item_customer").off('click').on('click', function() {
                var split_arr = $(this).val().split(' :: ');
                var item_id = split_arr[0].trim();
                refresh_product(item_id);
                customerID = $(this).val();
                getCartReady($(this).val());
            });

        if (customerID.length == 0) $('#add_to_cart').attr('disabled', true);

        $('#add_to_cart')
            .off('click')
            .on('click', function(e) {
                if (
                    $('input[name="sale_rep"]').val() == 1 &&
                    customerID.length == 0
                )
                    toastr.warning('Please select a customer...', {
                        hideDuration: 10000,
                        closeButton: true,
                    });
                else
                    pushToCart();
            });
    }

    $(document).ready(function() {
        $('.qty-add').on('click', function() {
            var value = $('input[type="number"]', $(this).parent()).val();
            $('input[type="number"]', $(this).parent()).val((parseInt(value) + 1) < 1001 ? parseInt(value) + 1 : 1000).change();
        });

        $('.qty-minus').on('click', function() {
            var value = $('input[type="number"]', $(this).parent()).val();
            $('input[type="number"]', $(this).parent()).val((parseInt(value) - 1) > 0 ? parseInt(value) - 1 : 0).change();
        });

        $('.product-slider-active').slick({
            dots: false,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: false,
            prevArrow: '<i class="icon-arrow-left arrow-prv"></i>',
            nextArrow: '<i class="icon-arrow-right arrow-next"></i>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            }, {
                breakpoint: 762,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });

        init();
        bindClicks();
        init_sliders();

        // $('.owl-carousel').owlCarousel(
        // {
        //     loop: true,
        //     margin: 20,
        //     responsiveClass: true,
        //     responsive:
        //     {
        //         0:
        //         {
        //             items: 2,
        //             nav: true,
        //             dots: true
        //         },
        //         600:
        //         {
        //             items: 3,
        //             dots: true,
        //             nav: false
        //         },
        //         1000:
        //         {
        //             items: 4,
        //             autoplay: true,
        //             autoplaySpeed: 1000,
        //             nav: true,
        //             dots: true,
        //             loop: true
        //         }
        //     }
        // });
        $('.detiel-heading').click(function(){
            if(!$(this).siblings('.collapse').hasClass('show'))
            {
                $(this).siblings('.collapse').addClass('show');
            }
        });
    });
</script>
@endsection
