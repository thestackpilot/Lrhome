@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('title')</title>
    <script src="{{asset('Dashboard/vendor/jquery/jquery.min.js')}}"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('head_scripts')

    @if($active_theme_json->general->use_theme_header)
    <link rel="stylesheet" href="{{asset('/LR/css/vendor/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('/LR/css/style.css')}}?v=0.10">
    @endif

    <link href="{{asset('Dashboard/css/sb-dasboard-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('Dashboard/css/custom.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ropa+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('Dashboard/css/all.css')}}?v={{time()}}">
    <!-- MDBootstrap Datatables  -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    @yield('styles')
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="{{$active_theme -> theme_abrv}}">
    <!-- Page Wrapper -->
    @yield('content')
    @yield('scripts')

    <script>
    $(document).mouseup(function(e)
    {
        var container = $(".container-checker");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            $(".quickCart").addClass("d-none");
            $(".quick-profile").addClass("d-none");
        }
    });

    $(document).ready(function()
    {
        // $('[data-toggle="tooltip"]').tooltip();

        $("body").on("click", ".quickCart-opener", function()
        {
            $(".quickCart").toggleClass("d-none");
        });

        $("body").on("click", ".close-icon", function()
        {
            $(".quickCart").addClass("d-none");
        });

        $("body").on("click", ".quickProfile-opener", function()
        {
            $(".quick-profile").toggleClass("d-none");
        });

        $("body").on("click", ".closeProfile", function()
        {
            $(".quick-profile").addClass("d-none");
        });

        $("body").on("click", ".search_text_button", function()
        {
            var searchText = $("#search_text_container input[name=searchText]").val();
            var trimedText = btoa($.trim(searchText));
            if (trimedText !== '')
            {
                window.location.href = window.location.origin + "/search/" + trimedText;
            }
        });

        $("body").on('keyup', "#search_text_container", function(e)
        {
            if (e.key === 'Enter' || e.keyCode === 13)
            {
                var searchText = $("#search_text_container input[name=searchText]").val();
                var trimedText = btoa($.trim(searchText));
                if (trimedText !== '')
                {
                    window.location.href = window.location.origin + "/search/" + trimedText;
                }
            }
        });


        $(document).on('click', 'input[type="number"]', function(e) {
            if (typeof $(this).attr('max') !== 'undefined' && $(this).attr('max') <= 0) {
                $(this).val(0);
            }
        });

        $(document).on('keyup', 'input[type="number"]', function(e) {
            if ( typeof $(this).attr('data-double') !== 'undefined' && $(this).attr('data-double') ) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 96 || event.which > 106)) {
                    event.preventDefault();
                }
            } else {
                if ( !checkNumberInput(e) )
                {
                    this.value = this.value.replace(/\D/g, '');
                    return false;
                }
            }

            if ( typeof $(this).attr('maxlength') !== "undefined" && this.value.length > $(this).attr('maxlength')) {
                this.value = this.value.slice(0, (this.value.indexOf('.') > -1) ? parseFloat($(this).attr('maxlength')) + 1 : $(this).attr('maxlength'));
            }

            if ( typeof $(this).attr('max') !== 'undefined' && parseFloat($(this).attr('max')) < parseFloat(this.value) ) {
                $(this).val($(this).attr('max') >= 0 ? $(this).attr('max') : 0);
            }
        });

	    // $('#custom_cost').click(function(){
        //     $('.quick-profile').addClass("d-none");
        //     $('.cost-type').removeClass("d-none");
        // });

        // hide alert message on cross btn click
        $(document).on('click','.btn-close',function(){
            $('.alert').hide();
        });
    });

    function checkNumberInput(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        // if (charCode == 46 || charCode == 190) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 106))
            return false;
        return true;
    }

    function refreshUser(type,callback) //cart,profile
    {
        var url = '';
        if(type == 'quick-cart')
        {
            {{--url = '{{route('frontend.cart.refresh',['quick-cart'])}}';--}}
                url = '/cart/refresh/quick-cart';
        }
        else if(type == 'profile')
        {
            {{--url = '{{route('frontend.cart.refresh',['profile'])}}';--}}
                url = '/cart/refresh/profile';
        }
        else
        {
            return;
        }
        $.ajax(
        {
            method:'POST',
            url:url,
            data:
            {
                '_token' : '{{csrf_token()}}',
            },
            success:function(response)
            {
                if(callback)
                {
                    callback();
                }
                if(type == 'quick-cart')
                {
                    $('#cart-parent').html(response);
                }
                else if(type == 'profile')
                {
                    $('#profile-parent').html(response);
                }
                else
                {
                    return;
                }
            }
        });
    }

    function showUpdateCartButton(itemId)
    {
        $('#'+itemId+' .update-cart-button').show();
    }

    function updateCart(itemId,token,customerId,hideQuantity)
    {
        var quantity = $("#"+itemId+"__"+customerId+" input").val();

        $("#"+itemId+"__"+customerId+" .update-cart-button").hide();
        if (typeof hideQuantity !== "undefined" && hideQuantity)
            $("#"+itemId+"__"+customerId+" .cart-actions .qty-styles").removeClass('d-flex').hide();

        $("#"+itemId+"__"+customerId+" #updating-cart").removeClass('d-none');

        if( ! (/^\+?[1-9]\d*/).test(parseInt(quantity)) )
        {
            toastr.warning("Please enter a valid number.",
            {
                hideDuration: 10000,
                closeButton: true,
            });
            return;
        }

        var is_on_checkout = 0;
        if (window.location.origin+window.location.pathname == '{{route('frontend.checkout')}}')
        {
            is_on_checkout = 1;
        }

        var formData =
        {
            itemId:itemId,
            customerId:customerId,
            newQuantity:quantity,
            _token:token
        };

        $.ajax(
        {
            method: "POST",
            url: "{{route('frontend.cart.update')}}",
            data: formData
        })
        .done(function (response)
        {
            if(response.success == 1)
            {
                if (is_on_checkout)
                {
                    // location.reload();
                    $("#"+itemId+"__"+customerId+" #input-quantity").val(quantity).attr('value', quantity);
                    $('.total-amount .cart_total_price').text(response.cart_currency + response.cart_total);
                    $('#profile-parent .badge-on-cart').text(response.cart_count);

                    Object.keys(response.cart_items_total).forEach(key => {
                        if ( key == itemId ) {
                            $("#"+itemId+"__"+customerId+" .price").text(response.cart_currency + parseFloat(response.cart_items_total[key]).toFixed(2));
                        }
                    });
                    $("#"+itemId+"__"+customerId+" #updating-cart").addClass('d-none');
                }
                else
                {
                    if($('#item_json').length)
                    {
                        refreshItemJson(function ()
                        {
                            $("#"+itemId+"__"+customerId+" #updating-cart").addClass('d-none');
                            if (typeof hideQuantity !== "undefined" && hideQuantity)
                                $("#"+itemId+"__"+customerId+" .cart-actions input").show();
                        });
                    }
                    else
                    {
                        refreshUser('quick-cart', function ()
                        {
                            refreshUser('profile', function ()
                            {
                                $("#"+itemId+"__"+customerId+" #updating-cart").addClass('d-none');
                                if (typeof hideQuantity !== "undefined" && hideQuantity)
                                    $("#"+itemId+"__"+customerId+" .cart-actions input").show();
                            });
                        });
                    }
                }
            }
            else
            {
                toastr.error(response.message,
                {
                    hideDuration: 10000,
                    closeButton: true,
                });
            }
        });
    }

    function removeItemFromCart(itemId,token,customerId,hideQuantity)
    {
        if (confirm("Are you sure to remove this Item?"))
        {
            $("#"+itemId+"__"+customerId).addClass('all-muted');
            $("#"+itemId+"__"+customerId+" #updating-cart").removeClass('d-none');
            if (typeof hideQuantity !== "undefined" && hideQuantity)
                $("#"+itemId+"__"+customerId+" .cart-actions input").hide();

            var is_on_checkout = 0;
            if (window.location.origin+window.location.pathname == '{{route('frontend.checkout')}}')
            {
                is_on_checkout = 1;
            }

            var formData =
            {
                itemId:itemId,
                customerId:customerId,
                _token:token
            };

            $.ajax(
            {
                method: "POST",
                url: "{{route('frontend.cart.remove')}}",
                data: formData
            })
            .done(function (response)
            {
                if(response.success == 1)
                {
                    if (is_on_checkout)
                    {
                        location.reload();
                    }
                    else
                    {
                        if($('#item_json').length)
                        {
                            refreshItemJson(function ()
                            {
                                $("#"+itemId+"__"+customerId+" #updating-cart").addClass('d-none');
                                $("#"+itemId+"__"+customerId).next("hr").remove();
                                $("#"+itemId+"__"+customerId).remove();
                                if (typeof hideQuantity !== "undefined" && hideQuantity)
                                    $("#"+itemId+"__"+customerId+" .cart-actions input").show();
                            });
                        }
                        else
                        {
                            refreshUser('quick-cart', function ()
                            {
                                refreshUser('profile', function ()
                                {
                                    $("#"+itemId+"__"+customerId+" #updating-cart").addClass('d-none');
                                    $("#"+itemId+"__"+customerId).next("hr").remove();
                                    $("#"+itemId+"__"+customerId).remove();
                                    if (typeof hideQuantity !== "undefined" && hideQuantity)
                                        $("#"+itemId+"__"+customerId+" .cart-actions input").show();
                                });
                            });
                        }
                    }
                }
                else
                {
                    toastr.error(response.message,
                    {
                        hideDuration: 10000,
                        closeButton: true,
                    });
                    $("#"+itemId+"__"+customerId).removeClass('all-muted');
                    if (typeof hideQuantity !== "undefined" && hideQuantity)
                        $("#"+itemId+"__"+customerId+" .cart-actions input").show();
                }
            });
        }
    }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // hide alert message on cross btn click
            $(document).on('click','.btn-close',function(){
                $('.alert').hide();
            });

            $('.datepicker').datepicker({
                format: "{{isset($active_theme_json->general->date_format) && $active_theme_json->general->date_format ? str_replace('Y', 'yyyy', $active_theme_json->general->date_format) : 'yyyy-mm-dd'}}",
                startDate: "{{isset($datepicker_dates) && $datepicker_dates['min'] ? $datepicker_dates['min'] : '-10Y'}}",
                endDate: "{{isset($datepicker_dates) && $datepicker_dates['max'] ? $datepicker_dates['max'] : '+1D'}}",
                maxViewMode: 3,
                todayBtn: "linked",
                clearBtn: false,
                keyboardNavigation: false,
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
            $('[data-toggle="tooltip"]').tooltip();
            if ($('.table.data-table thead th').length > 1 && '{{isset($paginated) ? $paginated : "no"}}' != 'yes')
                setTimeout(() => {
                    $('.table.data-table').DataTable({
                        'pageLength': 25,
                        'info': false,
                        'columnDefs': [{
                            'targets': [$('th', $(this)).length - 1],
                            'orderable': false, // orderable false
                        }]
                    });
                }, 500);

            function validateEmail(email) {
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }

            $('form.dashboard-forms').on('submit', function() {
                var allOk = true;
                $('input[data-required="true"]:visible, select[data-required="true"]:visible').each(function() {
                    if (typeof $(this).val().length === 'undefined') {
                        $(this).addClass('is-invalid');
                        allOk = false;
                    } else if ($(this).val().trim().length < 1) {
                        $(this).addClass('is-invalid');
                        allOk = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return allOk;
            });
        });
    </script>
</body>
</html>
