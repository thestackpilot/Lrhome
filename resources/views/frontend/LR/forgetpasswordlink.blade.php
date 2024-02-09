@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Forget Password Link')
@section('content')
<div class="wrapper light-grey-bg p-0">
    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')
    <div class="breadcrumb-area become-form">
        <div class="container">
        <div class="row breadcrumb_box  align-items-center">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center text-sm-left">
            <h2 class="breadcrumb-title text-center">Forget Password</h2>
            </div>
        </div>
        </div>
    </div>
    <main class="login-form main-content">
        <section class="collection-section">
            <div class="container">
                <div class="d-flex flex-column flex-dir-col justify-content-center align-items-center mt-4 mb-4">
                    <div class="col-lg-6 col-sm-12 mb-sm-3 contact-mb3 contact-balance m-3">
                        <div class="bg-white p-5">
                            <form action="{{ route('reset.password.post') }}" method="POST" class="d-flex flex-column dafault-form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
        
                                <!-- <div class="mb-3">
                                    <label for="email_address" class="form-label">E-Mail Address</label>
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div> -->
        
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
        
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <input type="password" id="password-confirm" class="form-control" name="confirm_password" required autofocus>
                                    @if ($errors->has('confirm_password'))
                                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
        
                                <button type="submit" class="btn btn-primary text-uppercase mt-5">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')
</div>
@endsection
