@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp
<div class="footer-area-wrapper">
    <div class="footer-area section-space--ptb_60">
        <div class="container-fluid">
            <div class="row footer-widget-wrapper">
                <div class="col-lg col-md col-sm-6 col-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">{{$menus -> first_footer -> name}}</h6>
                    <ul class="footer-widget__list">
                        @foreach($menus -> first_footer -> metas as $meta)
                        <li><a href={{ $meta -> meta_url }} class="hover-style-link">{{ $meta -> meta_title }}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg col-md col-sm-6 col-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">{{$menus -> second_footer -> name}}</h6>
                    <ul class="footer-widget__list">
                        @foreach($menus -> second_footer -> metas as $meta)
                        <li><a href="{{ $meta -> meta_url }}" class="hover-style-link">{{ $meta -> meta_title }}</a></li>
                        @endforeach

                    </ul>
                </div>

                <div class="col-lg col-md col-sm-6 col-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">{{$menus -> third_footer -> name}}</h6>
                    <ul class="footer-widget__list">
                        @foreach($menus -> third_footer -> metas as $meta)
                        <li><a href="{{ $meta -> meta_url }}" class="hover-style-link">{{ $meta -> meta_title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg col-md col-sm-6 col-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">{{$menus -> fourth_footer -> name}}</h6>
                    <ul class="footer-widget__list">
                        @foreach($menus -> fourth_footer -> metas as $meta)
                        <li><a href="{{ $meta -> meta_url }}" class="hover-style-link">{{ $meta -> meta_title }}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg col-md col-sm-12 footer-widget">
                    <h6 class="footer-widget__title mb-20">GET INSPIRED</h6>
                    <div class="footer-bottom-social">
                        <ul class="list footer-social-networks ">
                            <li class="item">
                                <a href="{{$pages -> all_pages -> sections -> footer_social_media -> insta_url}}" target="_blank" aria-label="Twitter"> <i class="social social_instagram"></i> </a>
                            </li>
                            <li class="item">
                                <a href="{{$pages -> all_pages -> sections -> footer_social_media -> facebook_url}}" target="_blank" aria-label="Facebook"> <i class="social social_facebook"></i> </a>
                            </li>
                            <li class="item">
                                <a href="{{$pages -> all_pages -> sections -> footer_social_media -> pinterest_url}}" target="_blank" aria-label="Pintrest"> <i class="social social_pinterest"></i> </a>
                            </li>
                            <li class="item">
                                <a href="{{$pages -> all_pages -> sections -> footer_social_media -> twitter_url}}" target="_blank" aria-label="Twitter"> <i class="social social_twitter"></i> </a>
                            </li>
                            <li class="item">
                                <a href="{{$pages -> all_pages -> sections -> footer_social_media -> linkedin_url}}" target="_blank" aria-label="LinkedIn"> <i class="social social_linkedin"></i> </a>
                            </li>
                        </ul>
                    </div>
                    <p>&nbsp; </p>
                    <p class="news-tile">Subscribe for alerts, promotions &amp; inspiration</p>
                    <form action="{{route('form.submission', ['newsletter'])}}" method="POST" id="newsletter-form">
                        @if (Session::has('message') && isset(Session::get('message')['referrer']) && Session::get('message')['referrer'] == 'newsletter')
                        <div class="alert alert-{{Session::get('message')['type']}}">
                            {{Session::get('message')['body']}}
                        </div>
                        @endif
                        @csrf
                        <div class="footer-widget__newsletter position-relative">
                            <input type="email" name="email" id="email" value="" required placeholder="Email Address">

                            {{-- <div class="captcha-container captcha_newsletter_container mt-2" style="min-width: 70%">
                                <!-- CAPTCHA Image -->
                                <div id="captcha_image_footer" style="width: 20%;">
                                    {!! captcha_img('news_letter') !!}
                                </div>
                                <div class="d-flex flex-col">
                                    <button type="button" id="refresh-captcha-footer" class="btn btn-secondary btn-sm ms-2" onclick="refreshCaptcha()">Refresh</button>
                                    <input type="text" name="captcha_newsletter" id="captcha_newsletter" placeholder="Enter CAPTCHA"  class="form-control captcha-input" required
                                    style="padding: 23px 0px !important;">
                                </div>
                                <div>
                                    @error('captcha_newsletter')
                                        <div class="text-danger captcha_newsletter">The CAPTCHA entered is incorrect. Please try again.</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="captcha-container captcha_newsletter_container mt-2" style="width: 70%">
                                <div class="d-flex">
                                    <div id="captcha_image_footer" class="captcha_image">
                                        {!! captcha_img('news_letter') !!}
                                    </div>
                                    <div id="captcha_image_footer" class="captcha_image">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi64Rl_oZ-ygLyFWlgIUfRer0v21agZtQg0y_EKFjs31fqJ6aLmv5Aqjx6ySbw60enZ0U&usqp=CAU"
                                        alt="refresg"  style="width:46px; height:38px;" onclick="refreshCaptcha()">
                                    </div>
                                </div>
                                <input type="text" name="captcha_newsletter" id="captcha_newsletter" class="form-control captcha-input" required>
                                <div>
                                    @error('captcha_newsletter')
                                        <div class="text-danger captcha_contact">The CAPTCHA entered is incorrect. Please try again.</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="submit-button" id="newsletter-submit-button">Join</button>
                            {{-- <button class="submit-button g-recaptcha"
                                data-sitekey="{{config('services.recaptcha.key')}}"
                                data-callback='onSubmitNewsletter'
                                data-action='submit'>Join</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.'.$active_theme -> theme_abrv.'.components.mobile-menu')
<a href="#" class="scroll-top" id="scroll-top"> <i class="arrow-top icon-arrow-up"></i> <i class="arrow-bottom icon-arrow-up"></i> </a>
<a href="/static/contactus#contact-us" class="askus-floating-btn" id="ask-us"> <img src="{{url('/')}}/LR/images/askus-icon.png" alt="Ask Us" /> </a>
