@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('frontend.layouts.app')
@section('title','Dashboard | My Users')
@section('content')
    <div class="wrapper admin-side">
        @include('frontend.components.header',['basicSettings' => $basicSettings,'menus'=>$menus,'menuMetas' => $menuMetas ,'breadCrumbs'=>$breadCrumbs])
        <main class="main-content">
            <section class="collection-section">
                <div class="container">
                    <div class="d-flex flex-row">
                        <div class="col-lg-3 col-sm-6 col-6 sidebar-main">
                            @include('users-dashboard.components.sidebar')
                        </div>
                        <div class="col-xl-9 col-lg-12 col-sm-12 col-12 py-0">
                            <div class="account-content p-5">
                                <h1 class="section-title text-center mb-3 mt-0 font-ropa">Manage My User</h1>
                                <form class="d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3">

                                    <div class="mb-3 col-md-4 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="fullname" class="form-label">User Name*</label>
                                        <div class="d-flex manageUser-form justify-content-between">
                                            <select class="form-select">
                                                <option>Like</option>
                                            </select>
                                            <input type="text" class="form-control" placeholder="Oriental.Rug">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="InputEmail" class="form-label">Oriental</label>

                                        <div class="d-flex manageUser-form justify-content-between">
                                            <select class="form-select">
                                                <option>Not Like</option>
                                            </select>
                                            <input type="text" class="form-control" placeholder="Oriental">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4 col-sm-12 col-12 pe-1 pe-lg-3">
                                        <label for="PhoneNumber*" class="form-label">Middle Name</label>

                                        <div class="d-flex manageUser-form justify-content-between">
                                            <select class="form-select">
                                                <option> <> </option>
                                            </select>
                                            <input type="text" class="form-control" placeholder="Rug Gallery">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row flex-sm-wrap justify-content-between col-md-12 mt-3">

                                        <a href="{{url('/').'/user/dashboard/create-user'}}" class="btn btn-dark half-muted text-uppercase mt-2 me-3">Create a New Account</a>

                                        <div class="mb-3 justify-content-end pe-1 pe-lg-3 d-flex">
                                            <button type="submit" class="btn btn-dark text-uppercase mt-2 me-3">Reset</button>
                                            <button type="submit" class="btn btn-primary text-uppercase mt-2">Show</button>
                                        </div>

                                    </div>

                                </form>

                                <hr class="minicart-seprator mb-2">
                                <div class="table-responsive">
                                    <table class="table mt-4 text-center">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sub_users as $sub_user)
                                        <tr>
                                            <td>{{$sub_user->user_name}}</td>
                                            <td>{{$sub_user->email}}</td>
                                            <td>{{$sub_user->phone}}</td>
                                            <td class="text-center actions">
                                                <a href="{{url('/').'/user/dashboard/edit-user/'.$sub_user->id}}" class="action-edit-icon">
                                                    <button>Edit</button>
                                                </a>
                                                <a onclick="return confirm('Are you sure to delete?')" href="{{url('/').'/user/dashboard/delete-user/'.$sub_user->id}}" class="action-delete-icon">
                                                    <button>Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        @include('frontend.components.footer',['basicSettings' => $basicSettings, 'footers' => $footers, 'footerMeta' => $footerMeta])
    </div>
@endsection
