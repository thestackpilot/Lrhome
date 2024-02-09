@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Forget Password')
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
                    <div class="col-lg-6 col-sm-12 mb-sm-3 contact-mb3 contact-balance m-3 lr-reset-pswrd">
                        <div class="bg-white p-5 ">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
        
                            <form action="{{ route('forget.password.post') }}" method="POST" class="user d-flex flex-column dafault-form">
                                @csrf
                                <div class="mb-3">
                                    <label for="email_address" class="form-label">E-Mail Address</label>
                                    <input type="text" placeholder="Please enter your email" id="email_address" class="form-control" name="email" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary text-uppercase mt-5">Send Password Reset Link</button>
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
