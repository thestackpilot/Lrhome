@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Staff')
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
                        <div class="account-content p-5">
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">
                                {{ $user ? "Create New Account" : "Edit Account" }}
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
                            <form class="staff-form d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3" action="{{$user ? route('dashboard.staff.fetch', ['id' => $user->id]) : route('dashboard.staff.create')}}" method="POST">
                                @csrf
                                <input type="hidden" name="user" value="{{$user ? $user->id : ''}}">
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="firstname" class="form-label">First Name*</label>
                                    <input type="text" maxlength="35" data-required="true" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{$user ? $user->getDataAttribute('firstname') : old('firstname')}}">
                                </div>
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="lastname" class="form-label">Last Name*</label>
                                    <input type="text" maxlength="35" data-required="true" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{$user ? $user->getDataAttribute('lastname') : old('lastname')}}">
                                </div>
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" maxlength="60" data-required="true" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com" name="email" value="{{$user ? $user->email : old('email')}}">
                                </div>
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="phone" class="form-label">Office Phone</label>
                                    <input type="text" maxlength="12" minlength="12" data-inputmask="'mask': '999-999-9999'" id="phone" class="form-control" placeholder="210-342-4362" name="phone" value="{{$user ? $user->getDataAttribute('phone') : old('phone')}}">
                                </div>
                                <!-- <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="username" class="form-label">User Name*</label>
                                    <input type="text" data-required="true" id="username" class="form-control" name="username" value="{{$user ? $user->getDataAttribute('username') : old('username')}}">
                                </div> -->
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="password" class="form-label">Password{{$user ? '' : '*'}}</label>
                                    <input type="password" data-required="{{$user ? 'false' : 'true'}}" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" name="password">
                                </div>
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="cpassword" class="form-label">Confirm Password{{$user ? '' : '*'}}</label>
                                    <input type="password" data-required="{{$user ? 'false' : 'true'}}" id="cpassword" class="form-control @error('password') is-invalid @enderror" placeholder="********" name="cpassword">
                                </div>
                                @if(isset($statuses))
                                <div class="mb-3 col-md-3 col-sm-12 pe-1 pe-lg-3">
                                    <label for="status" class="form-label">Active Type*</label>
                                    <select data-required="true" class="form-select" id="status" name="status">
                                        <option value="">Select an option</option>
                                        @foreach($statuses as $value => $label)
                                        <option value="{{$value}}" {{$user && $user->getDataAttribute('status') == $value ? 'selected' : (old('status') == $value ? 'selected' : '')}}> {{ucwords($label)}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @if(isset($permissions))
                                <div class="mb-3 col-md-12 col-sm-12 pe-1 pe-lg-3">
                                    <label for="Inquiry" class="form-label">Permissions</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        @foreach($permissions as $value => $label)
                                        <div class="form-check col-sm-12 me-3">
                                            <input class="form-check-input" id="{{$value}}" name="permissions[]" type="checkbox" value="{{$value}}" {{$user && in_array($value, $user->getDataAttribute('permissions', [])) ? 'checked' : (old('permissions') && in_array($value, old('permissions')) ? 'checked' : '')}}>
                                            <label class="form-check-label" for="{{$value}}"> {{$label}} </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <div class="mb-3 col-md-12 col-sm-12 pe-1 pe-lg-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" maxlength="5000" name="description" style="min-height:150px;" placeholder="Please fill in the details here...">{{$user ? $user->getDataAttribute('description', '') : old('description')}}</textarea>
                                </div>

                                <div class="mb-3 justify-content-end pe-1 pe-lg-3 col-md-12 d-flex">
                                    <a href="{{route('dashboard.staff')}}" class="btn btn-dark text-uppercase mt-2 me-3 mr-3">Cancel</a>
                                    <button type="submit " class="btn btn-primary text-uppercase mt-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
 @include('dashboard.components.footer')
</div>
@endsection
@section('styles')
<style>
    input[type="checkbox"]{
        border-width: 1px !important;
    }
    input[type="checkbox"], input[type="radio"] {
        border-width: 1px !important;
    }
</style>
@endsection
@section('scripts')
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        $("[data-inputmask]").inputmask({greedy: false, placeholder:""});
        var editMode = "{{$user ? true: false}}";
        $('form.staff-form').on('submit', function() {
            var allOk = true;
            $('input[data-required="true"], select[data-required="true"]').each(function() {
                if (typeof $(this).val().length === 'undefined') {
                    $(this).addClass('is-invalid');
                    allOk = false;
                }/* else if ($(this).val().trim().length < 1) {
                    $(this).addClass('is-invalid');
                    allOk = false;
                } */else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (allOk && !validateEmail($('input[type="email"]').val())) {
                $('input[type="email"]').addClass('is-invalid');
                allOk = false;
            }

            if (editMode == "1" || editMode == 1) {
                if (
                    allOk && (typeof $('input[name="password"]').val().length !== 'undefined' || typeof $('input[name="cpassword"]').val().length !== 'undefined') &&
                    $('input[name="password"]').val() != $('input[name="cpassword"]').val()
                ) {
                    $('input[name="password"], input[name="cpassword"]').addClass('is-invalid');
                    allOk = false;
                }
            } else {
                if (allOk && $('input[name="password"]').val() != $('input[name="cpassword"]').val()) {
                    $('input[name="password"], input[name="cpassword"]').addClass('is-invalid');
                    allOk = false;
                }
            }

            return allOk;
        });
    });
</script>
@endsection
