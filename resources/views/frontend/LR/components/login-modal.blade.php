@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<div class="modal fade bd-example-modal-lg popupModal login-modal-popup login-popUp" id="checkOut_popup" tabindex="-1" role="dialog" aria-labelledby="checkOutLabel" aria-hidden="true">
    <div class="backdrop" style="display:none;"></div>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border:0; flex-direction: row-reverse;">
                <button type="button" class="close closePopup" data-dismiss="modal" aria-label="Close" id="close-checkout">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="dealer-heading">Sign in</h4>
                    <p>If you have an account, please sign in with your User ID.</p>
                    <p class="error_login"></p>
                </div>
                <form class="d-flex flex-column dafault-form px-5 py-2" id="popup_login_form">
                    @csrf
                    <div class="mb-2">
                        <label for="InputEmail1" class="form-label">Customer ID or Email*</label>
                        <input type="text" name="email" class="form-control" id="InputEmail1" aria-describedby="UserIDHelp" placeholder="Please enter your email or SPARS ID">
                    </div>
                    <div class="mb-2">
                        <label for="InputPassword1" class="form-label">Password*</label>
                        <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Customer Password">
                    </div>
                    <div class="mb-3 d-flex flex-row justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-dark text-uppercase checkout-signin">Login Here</button>
                    </div>
                </form>
                <div id="loading_msg" class="d-none d-flex flex-column text-center my-4">
                    <div class="spinner-border" role="status" style="margin: 0 auto;">
                        <span class="sr-only" style="opacity:0;">Loading...</span>
                    </div>
                    <p class="loadinMsg">Loading your details.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function LoginUser() 
{
    if($('#InputEmail1').val().length && $('#InputPassword1').val().length)
    {
        $('#popup_login_form').addClass('d-none');
        $('#loading_msg').removeClass('d-none');
        $('#close-checkout').addClass('d-none');
        
        $.ajax(
        {
            method:'POST',
            url:"{{route('auth.ajax.login')}}",
            data:
            {
                '_token' : '{{csrf_token()}}',
                'email' : $('#InputEmail1').val(),
                'password' : $('#InputPassword1').val()
            },
            success:function(response) 
            {
                if(response.success)
                {
                    if(response.ResetPassword && typeof response.ResetPassword != 'undefined') {
                        location.replace('/dashboard/my-account#change-password');
                    }
                    else {
                        if($('#item_json').length)
                        {
                            refreshItemJson(function () 
                            {
                                //Close Checkout Popup
                                $("#checkOut_popup").hide();
                                $("#checkOut_popup").removeClass("show");

                                //Close Backdrop
                                $(".backdrop").hide();
                                $(".backdrop").removeClass("zindex-4");

                                $('#popup_login_form').removeClass('d-none');
                                $('#loading_msg').addClass('d-none');
                            });
                        }
                        else
                        {
                            refreshUser('quick-cart', function () 
                            {
                                refreshUser('profile', function () 
                                {
                                    //Close Checkout Popup
                                    $("#checkOut_popup").hide();
                                    $("#checkOut_popup").removeClass("show");
                                    //Close Backdrop
                                    $(".backdrop").hide();
                                    $(".backdrop").removeClass("zindex-4");

                                    $('#popup_login_form').removeClass('d-none');
                                    $('#loading_msg').addClass('d-none');
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

                    $('#loading_msg').addClass('d-none');
                    $('#popup_login_form').removeClass('d-none');
                }
            }
        });
    }
    else
    {
        toastr.error("Please enter valid login and password details",
        {
            hideDuration: 10000,
            closeButton: true,
        });

        $('#loading_msg').addClass('d-none');
        $('#popup_login_form').removeClass('d-none');
    }
}
$(document).ready(function() 
{
    // TODO : The validation for the ajax login form needs to work - Adil
    /*
    $('#popup_login_form').validate(
    {
        rules: 
        {
            email:
            {
                required: true
            },
            password:
            {
                required: true
            }
        }
    });*/

    $('.closePopup, .backdrop, #close-modal' ).on('click', function (e) 
    {
        //Close Checkout Popup
        $("#checkOut_popup").hide();
        $("#checkOut_popup").removeClass("show");
        //Close Backdrop
        $(".backdrop").hide();
        $(".backdrop").removeClass("zindex-4");
    });

    $('#login_by_popup').on('click', function (e) 
    {
        $("#checkOut_popup").show();
        $("#checkOut_popup").addClass("show");
        $(".backdrop").show();
        $(".backdrop").addClass("zindex-4");
    });
    
    $('#popup_login_form').on('submit', function(e) 
    {
        LoginUser();
        return false;
    });
});
</script>

<style>
    .d-none.d-flex{
        display:none !important;
    }
</style>
