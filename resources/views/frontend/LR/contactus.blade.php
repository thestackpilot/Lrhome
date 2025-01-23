@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Contact Us')
@section('content')
<div id="main-wrapper">

  @include('frontend.'.$active_theme -> theme_abrv.'.components.header')

  <div class="site-wrapper-reveal">
    <div class="contact-us-info-area mt-30 section-space--mb_60">
      <div class="container">
        <div class="row" id="Showrooms">
          <div class="col-lg-12">
            <div class="section-title text-center mb-20">
              <h2 class="section-title--one section-title--center">Our Showrooms</h2>
            </div>
          </div>
        </div>
        <div class="row">
            @if(isset($showrooms -> lr_showrooms))
                @foreach($showrooms -> lr_showrooms -> metas as $showroom)

                  <div class="col-md-4">
                    <div class="showroom text-center">
                      @if(!empty($showroom->image))
                        <img class="img-full" src="{{asset($showroom->image)}}" alt="{{ $showroom -> title }}">
                      @endif
                      <p> <strong>{{ $showroom -> title }}</strong></p>
                      <p>{!! $showroom -> address !!}</p>
                    </div>
                  </div>

                @endforeach
            @endif
        </div>
        <div class="border-top border-bottom services-sec" id="Service">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title text-center mb-20">
                <h2 class="section-title--one section-title--center">Customer Service</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="single-contact-info-item">
                <div class="icon"> <i class="icon-clock3"></i> </div>
                <div class="iconbox-desc">
                  <h6 class="mb-10">Open Hours</h6>
                  <p>Mon – Thur : 9:00 AM – 5:00 PM EST </p>
                  <p>Fri : 9:00 AM – 4:00 PM EST </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="single-contact-info-item">
                <div class="icon"> <i class="icon-telephone"></i> </div>
                <div class="iconbox-desc">
                  <h6 class="mb-10">Phone number</h6>
                  <p>(706)-259-0155 <br>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="single-contact-info-item">
                <div class="icon"> <i class="icon-envelope-open"></i> </div>
                <div class="iconbox-desc">
                  <h6 class="mb-10">Inquiry &amp; Order Submission</h6>
                  <p>orderdesk@lrhome.us</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="single-contact-info-item">
                <div class="icon"> <i class="icon-envelope-open"></i> </div>
                <div class="iconbox-desc">
                  <h6 class="mb-10">Returns &amp; Claims</h6>
                  <p>claims@lrhome.us</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="contact-us-page-warpper section-space--pb_60 section-space--pt_70" id="contact-us">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title text-center mb-20">
              <h2 class="section-title--one section-title--center">Contact Us</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-7">
                <div class="contact-form-wrap  section-space--mt_60">
                  <h5 class="mb-10">Get in touch</h5>
                  <form action="{{route('form.submission', ['contact_us'])}}" method="post" id="contact-form-chnage">
                    @if (Session::has('message') && isset(Session::get('message')['referrer']) && Session::get('message')['referrer'] == 'contact_us')
                    <div class="alert alert-{{Session::get('message')['type']}}">
                      {{Session::get('message')['body']}}
                    </div>
                    @endif
                    @csrf
                    <div>
                      <div class="contact-input">
                        <div class="contact-inner">
                          <input name="name" type="text"  placeholder="Name *" data-required="true" required value={{old('name')}}>
                        </div>
                        <div class="contact-inner">
                          <input name="subject"  type="text" placeholder="Subject *" data-required="true" required value={{old('subject')}}>
                        </div>
                      </div>

                      <div class="contact-input">
                        <div class="contact-inner">
                          <input name="email" class="email" type="email" placeholder="Email *" data-required="true" required value={{old('email')}}>
                        </div>
                        <div class="contact-inner">
                          <input name="phone" type="number" placeholder="Phone *" data-required="true" required value={{old('phone')}}>
                        </div>
                      </div>

                      <div class="contact-input">
                        <div class="contact-inner">
                          <input name="company" type="text" placeholder="Company *" data-required="true" required value={{old('company')}}>
                        </div>
                        <div class="contact-inner">
                          <input name="city" type="text" placeholder="City *" data-required="true" required value={{old('city')}}>
                        </div>
                      </div>

                      <div class="contact-inner">
                        <input name="state" type="text" placeholder="State *" data-required="true" required value={{old('state')}}>
                      </div>

                      <div class="contact-inner contact-message">
                        <textarea name="message" placeholder="Please type a message here" data-required="true" required>{{old('message')}}</textarea>
                      </div>
                      <div class="captcha-container captcha_contact_container" style="width: 70%">
                        <div class="d-flex flex-col">
                            <div id="captcha_image" class="captcha_image">
                                {!! captcha_img('contact_us') !!}
                            </div>
                            <div id="captcha_image" class="captcha_image">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi64Rl_oZ-ygLyFWlgIUfRer0v21agZtQg0y_EKFjs31fqJ6aLmv5Aqjx6ySbw60enZ0U&usqp=CAU"
                                alt="refresg"  style="width:46px; height:38px;" onclick="refreshCaptcha()">
                            </div>
                        </div>
                        <input type="text" name="captcha_contact" id="captcha_contact" placeholder="Enter CAPTCHA"  class="form-control captcha-input mt-1" required>
                        <div>
                            @error('captcha_contact')
                                <div class="text-danger captcha_contact">The CAPTCHA entered is incorrect. Please try again.</div>
                            @enderror
                        </div>
                      </div>
                      <div class="submit-btn mt-20">
                        {{-- <input type="submit" class="btn btn--black btn--md"> --}}
                        <button class="btn btn--black btn--md" type="submit" id="submitBtn">Submit</button>
                          {{-- <button class="g-recaptcha btn btn--black btn--md"
                                  data-sitekey="{{ config('services.recaptcha.key') }}"
                                  data-callback='onSubmitContactUs'
                                  data-action='submit'>Submit</button> --}}
                        <!--<p class="form-messege"></p>-->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-4 ml-auto">
                <div class="conatact-info-text section-space--mt_60">
                  <div class="logo text-md-left"> <a href="/"><img src="{{asset($basicSettings -> logo_dark)}}" alt=""></a> </div>
                  <br>
                  <h5 class="mb-10">Our address</h5>
                  <p>3432 S Dug Gap Road,<br />
                    Dalton, GA 30720</p>
                  <p class="mt-30"><strong>Call Us</strong> <br>
                    (706)-259-0155 <br>
                  </p>
                  <div class="product_socials mt-30"> <span class="label">FOLLOW US:</span>
                    <ul class="helendo-social-share socials-inline">
                      <li> <a class="share-google-plus helendo-google-plus" href="{{$pages -> all_pages -> sections -> footer_social_media -> insta_url}}" target="_blank"><i class="social_instagram"></i></a> </li>
                      <li> <a class="share-facebook helendo-facebook" href="{{$pages -> all_pages -> sections -> footer_social_media -> facebook_url}}" target="_blank"><i class="social_facebook"></i></a> </li>
                      <li> <a class="share-pinterest helendo-pinterest" href="{{$pages -> all_pages -> sections -> footer_social_media -> pinterest_url}}" target="_blank"><i class="social_pinterest"></i></a> </li>
                      <li> <a class="share-twitter helendo-twitter" href="{{$pages -> all_pages -> sections -> footer_social_media -> twitter_url}}" target="_blank"><i class="social_twitter"></i></a> </li>
                      <li> <a class="share-linkedin helendo-linkedin" href="{{$pages -> all_pages -> sections -> footer_social_media -> linkedin_url}}" target="_blank"><i class="social_linkedin"></i></a> </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection
@section('scripts')
<script>

    $('input[type="email"]').on('input', function() {
        var email = $(this).val(); // Get the current value of the email input
        var isValid = validateEmail(email); // Validate the email

        // Enable or disable the submit button based on the validity of the email
        if (isValid) {
            $('#submitBtn').prop('disabled', false); // Enable submit button if valid
            $(this).css('border', ''); // Remove red border if email is valid
        } else {
            $('#submitBtn').prop('disabled', true); // Disable submit button if invalid
            $(this).css('border', '1px solid red'); // Add red border if email is invalid
        }
    });

  function onSubmitContactUs(token) {
    // console.log("token: ", token);
    var allOk = true;
    $('input[data-required="true"], select[data-required="true"]').each(function() {
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

    if (allOk && !validateEmail($('input[type="email"]').val())) {
      $('input[type="email"]').addClass('is-invalid');
      allOk = false;
    }

    if (allOk && $('#captcha').val() != captchNo) {
        $('#captcha').addClass('is-invalid');
        allOk = false;
    }

    if(allOk) {
      document.getElementById("contact-form").submit();
    }
    else {
      return;
    }
  }
  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
</script>
<style>
  .grid-item {
    width: 25%;
  }

  .grid-item--width2 {
    width: 50%;
  }

  .captcha_image img{
    min-width: 40% !important;
  }
</style>
@endsection
