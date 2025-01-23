@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<!doctype html>
<html lang="en">
<head>

    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="description" content="@yield('meta-description')">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('meta-description')">
    <meta itemprop="image" content="@yield('meta-image')">

    <meta property="og:url" content="@yield('meta-url')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:image" itemprop="image" content="@yield('meta-image')" />
    <meta property="og:image:secure_url" itemprop="image" content="@yield('meta-image')" />
    <meta property="og:description" content="@yield('meta-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" type="image/x-icon" href="{{asset('/LR/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png"><meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('/LR/css/vendor/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('/LR/css/plugins/plugins.min.css')}}?v=0.01">
    @yield('styles')
    <link rel="stylesheet" href="{{asset('/LR/css/style.css')}}?v=0.03">
    <link rel="stylesheet" href="{{asset('/LR/css/toastr.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        .footer-widget__newsletter .submit-button.red {
                background: #ef9000 !important;
        }
        .footer-widget__newsletter .submit-button.green {
            background: #c3c3c3 !important;
        }
    </style>

    @yield('head_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="{{asset('/LR/js/plugins/plugins.js')}}"> </script>
    <script src="{{asset('/LR/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <script src="{{asset('/LR/js/toastr.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    @if ( env('APP_ENV') == 'prod' )
    <!-- Google tag (gtag.js) -->
    <script async src=https://www.googletagmanager.com/gtag/js?id=G-NRS85ZK87F></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-NRS85ZK87F');
    </script>
    <!--End Google tag (gtag.js) -->
    @endif
</head>
<body>
    @yield('content')
    <script>
    // TODO : The page loads with a jerk and white screen shows - Asfand needs to look into this
    $(document).mouseup(function(e)
    {
        var container = $(".container-checker");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            $(".quickCart").addClass("d-none");
            $(".quick-profile").addClass("d-none");
        }
    });

    function onSubmitNewsletter(token) {
        document.getElementById("newsletter-form").submit();
    }

    function onSubmitPartnerRequest(token) {
        $('button#submitForm').trigger('click');
        // document.getElementById("regForm").submit();
    }

    $(document).ready(function()
    {
        toastr.options = {
            "closeButton": true,
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        }
        // $('[data-toggle="tooltip"]').tooltip();

        $("body").on("click", ".quickCart-opener", function()
        {
            $(".quickCart").toggleClass("d-none");
            if ( typeof window.localStorage.getItem('ap') !==  window.location.href && typeof window.localStorage.getItem('ccc') !== "undefined" && window.localStorage.getItem('ccc') !== null && window.localStorage.getItem('ccc') !== localStorage.getItem('occ')) {
                $(".cartLoader").removeClass("d-none");
                refreshUser('quick-cart', function () {
                    $(".cartLoader").addClass("d-none");
                    window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
                    window.localStorage.setItem('occ', parseInt($('.quickCart-opener .cartCount').html()));
                    setTimeout(function(){
                        $(".quickCart").removeClass("d-none");
                    }, 100);
                });
            } else
                $(".cartLoader").addClass("d-none");
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
            $(".cost-type").addClass("d-none");
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

        $('.carousel').carousel(
        {
            interval: false,
        });

        $('[data-masonry]').imagesLoaded(function () {
            $('.loader-section').remove();
            $('[data-masonry]').removeClass('d-none');
            $('[data-masonry]').masonry();
        });

        $('.page-content-div').imagesLoaded(function () {
            $('.page-loader-section').remove();
            $('.page-content-div').removeClass('d-none');
        });

        $(document).on('click', 'input[type="number"]', function(e) {
            if (typeof $(this).attr('max') !== 'undefined' && $(this).attr('max') < 0) {
                $(this).val(0);
            }
        });

        // hide alert message on cross btn click
        $(document).on('click','.btn-close',function(){
            $('.alert').hide();
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

        $('#custom_cost').click(function(){
            $('.quick-profile').addClass("d-none");
            $('.cost-type').removeClass("d-none");
        });

        $('select[name="cost-type"]').change(function() {
            if ($(this).val() != 'msrp') {
                $('.my-msrp').addClass('d-none');
            } else {
                $('.my-msrp').removeClass('d-none');
            }
        }).change();

        if($('select[name="cost-type"]').val() != 'msrp') {
            $('.my-msrp').addClass('d-none');
        } else {
            $('.my-msrp').removeClass('d-none');
        }
        // homepage popup
        $(".overlay-home-popup, .close-home-popup").click(function() {
            $(".home-popup").hide();
            // document.cookie = "homepage_popup=true;expires=" + new Date(new Date().getTime() + 1 * 24 * 60 * 60 * 1000).toUTCString();
        });

    });

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

    function updateCart(itemId,token,customerId,hideQuantity,isMobile)
    {
        var itemNode = typeof isMobile !== "undefined" && isMobile ? "#mob_"+itemId+"__"+customerId : "#"+itemId+"__"+customerId;
        var quantity = $(itemNode+" input").val();

        $(itemNode+" .update-cart-button").hide();
        if (typeof hideQuantity !== "undefined" && hideQuantity)
            $(itemNode+" .cart-actions .qty-styles").removeClass('d-flex').hide();

        $(itemNode+" #updating-cart").removeClass('d-none');

        if( ! (/^\+?[1-9]\d*/).test(parseInt(quantity)) || parseInt(quantity) < 1 )
        {
            toastr.warning("Please enter a valid quantity.",
            {
                hideDuration: 10000,
                closeButton: true,
            });

            $(itemNode+" #updating-cart").addClass('d-none');
            if (typeof hideQuantity !== "undefined" && hideQuantity) {
                $(itemNode+" .cart-actions .qty-styles").addClass('d-flex').show();
                $(itemNode+" .cart-actions input").show();
            }
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

        // console.log(`is_on_checkout: ${is_on_checkout}`);

        $.ajax(
        {
            method: "POST",
            {{--url: "{{route('frontend.cart.update')}}",--}}
            url: "/cart/update",
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
                            $(itemNode+" #updating-cart").addClass('d-none');
                            if (typeof hideQuantity !== "undefined" && hideQuantity)
                                $(itemNode+" .cart-actions input").show();
                            window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
                        });
                    }
                    else
                    {
                        refreshUser('quick-cart', function ()
                        {
                            refreshUser('profile', function ()
                            {
                                $(itemNode+" #updating-cart").addClass('d-none');
                                if (typeof hideQuantity !== "undefined" && hideQuantity)
                                    $(itemNode+" .cart-actions input").show();
                                window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
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

    function removeItemFromCart(itemId,token,customerId,hideQuantity,isMobile)
    {
        if (confirm("Are you sure to remove this Item?"))
        {
            var itemNode = typeof isMobile !== "undefined" && isMobile ? "#mob_"+itemId+"__"+customerId : "#"+itemId+"__"+customerId;
            $(itemNode).addClass('all-muted');
            $(itemNode+" #updating-cart").removeClass('d-none');
            if (typeof hideQuantity !== "undefined" && hideQuantity)
                $(itemNode+" .cart-actions input").hide();

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
                {{--url: "{{route('frontend.cart.remove')}}",--}}
                url: "/cart/remove",
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
                                $(itemNode+" #updating-cart").addClass('d-none');
                                $(itemNode).next("hr").remove();
                                $(itemNode).remove();
                                if (typeof hideQuantity !== "undefined" && hideQuantity)
                                    $(itemNode+" .cart-actions input").show();
                                window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
                            });
                        }
                        else
                        {
                            refreshUser('quick-cart', function ()
                            {
                                refreshUser('profile', function ()
                                {
                                    $(itemNode+" #updating-cart").addClass('d-none');
                                    $(itemNode).next("hr").remove();
                                    $(itemNode).remove();
                                    if (typeof hideQuantity !== "undefined" && hideQuantity)
                                        $(itemNode+" .cart-actions input").show();
                                    window.localStorage.setItem('ccc', parseInt($('.quickCart-opener .cartCount').html()));
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
                    $(itemNode).removeClass('all-muted');
                    if (typeof hideQuantity !== "undefined" && hideQuantity)
                        $(itemNode+" .cart-actions input").show();
                }
            });
        }
    }

    function checkNumberInput(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 106))
            return false;
        return true;
    }
    window.localStorage.setItem('ap', window.location.href);
    $(window).blur(function() {
        // console.log('Tab Switched');
        window.localStorage.setItem('ap', window.location.href);
    });
    if (typeof $('.quickCart-opener .cartCount').length !== "undefined" && $('.quickCart-opener .cartCount').length > 0) {
        window.localStorage.setItem('occ', parseInt($('.quickCart-opener .cartCount').html()));
        setInterval(function() {
            if ( typeof window.localStorage.getItem('ap') !==  window.location.href && typeof window.localStorage.getItem('ccc') !== "undefined" && window.localStorage.getItem('ccc') !== null && window.localStorage.getItem('ccc') !== localStorage.getItem('occ')) {
                // console.log(`${window.localStorage.getItem('ccc')} VS ${window.localStorage.getItem('occ')}`);
                $('.quickCart-opener .cartCount').html(window.localStorage.getItem('ccc')).text(window.localStorage.getItem('ccc'));
            }
        }, 3000);
    }

    $(document).ready(function() {
        // CAPTCHA WORK
        refreshCaptcha();
        $('.captcha-container').hide();

        if($('.captcha_newsletter').length > 0){
            $('.captcha_newsletter_container').show();
            $('html, body').animate({
                scrollTop: $('#newsletter-form').offset().top // Scroll to the top of the newsletter-form section
            }, 1000);
        }
        if($('.captcha_contact').length > 0){
            $('.captcha_contact_container').show();
            $('html, body').animate({
                scrollTop: $('#contact-form-chnage').offset().top // Scroll to the top of the newsletter-form section
            }, 1000);
        }
        if($('.captcha_partner').length > 0){
            $('.captcha_partner_container').show();
        }
        $('form input, form textarea').on('focus', function () {
            var parentForm = $(this).closest('form');
            $('.captcha-container').hide();
            parentForm.find('.captcha-container').show();
        });
    });
    function refreshCaptcha() {
        $.ajax({
            url: '{{ route('captcha.refresh') }}',
            type: 'GET',
            success: function(data) {
                $('#captcha_image').html(data);
                $('#captcha_image_footer').html(data);
                $('#captcha_image_form_partner').html(data);
            }
        });
    }

    function updateButtonStateFooter() {
        let email = $("#newsletter-form #email").val().trim();
    let other = $("#newsletter-form #captcha_newsletter").val().trim();

    if (email !== "" && other !== "") {
        $(".footer-widget__newsletter .submit-button")
            .removeClass("green")
            .addClass("red")
            .prop("disabled", false);
    } else {
        $(".footer-widget__newsletter .submit-button")
            .removeClass("red")
            .addClass("green")
            .prop("disabled", true);
    }
    }
    $("#newsletter-form #email, #newsletter-form #captcha_newsletter").on(
        "input",
        updateButtonStateFooter
    );
    </script>
    @yield('scripts')
    <script src="{{asset('/LR/js/main.js')}}?v={{time()}}"> </script>
</body>
</html>
