@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('dashboard.layouts.app')
@section('title','Dashboard | Manage Staff')
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
                            <h1 class="section-title text-center mb-3 mt-0 font-ropa">Manage Staff</h1>
                            <form class="d-flex flex-row flex-wrap mt-3 dafault-form p-1 pt-3" action="{{route('dashboard.staff.search')}}" method="POST">
                                @csrf
                                @foreach($filters['fields'] as $key => $label)
                                <div class="mb-3 col-md-4 col-sm-12 col-12 pe-1 pe-lg-3">
                                    <label for="fullname" class="form-label">{{$label}}</label>
                                    <div class="d-flex manageUser-form justify-content-between">
                                        <select class="form-select" name="filters[{{$key}}][operation]">
                                            @foreach($filters['operations'] as $operation => $operation_label)
                                            <option value="{{$operation}}" {{isset($selected_filters) && strcmp($operation, $selected_filters[$key]['operation']) === 0 ? 'selected' : ''}}>{{$operation_label}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" value="{{isset($selected_filters) ? $selected_filters[$key]['value'] : ''}}" name="filters[{{$key}}][value]" class="form-control" placeholder="{{$label}}">
                                    </div>
                                </div>
                                @endforeach
                                <div class="d-flex flex-row flex-sm-wrap justify-content-between col-md-12 mt-3">
                                    <a href="{{route('dashboard.staff.create')}}" class="btn btn-dark btn-bg-all text-uppercase mt-2 me-3">Create a New Account</a>
                                    <div class="mb-3 justify-content-end pe-1 pe-lg-3 d-flex">
                                        <button id="reset-staff" type="submit" class="btn btn-dark text-uppercase mt-2 me-3 mr-3">Reset</button>
                                        <button type="submit" class="btn btn-primary text-uppercase mt-2">Show</button>
                                    </div>
                                </div>
                            </form>

                            <hr class="minicart-seprator mb-2">

                            <div class="d-flex justify-content-center flex-row">
                                @if($staff_users && count($staff_users))
                                <div class="table-responsive">
                                    <table class="table mt-4 table-striped text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>User ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Active Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            @foreach($staff_users as $user)
                                            <tr>
                                                <td>{{$user->uuid}}</td>
                                                <td>{{$user->getDataAttribute('firstname')}}</td>
                                                <td>{{$user->getDataAttribute('lastname')}}</td>
                                                <td>{{$user->getDataAttribute('email')}}</td>
                                                <td>{{$user->getDataAttribute('phone')}}</td>
                                                <td>{{ucwords($user->getDataAttribute('status'))}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.staff.fetch', ['id' => $user->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                                    @if(Auth::user()->id != $user->id)
                                                    <form onsubmit="return confirm('Do you really want to delete this user?');" class="delete-form" action="{{route('dashboard.staff.delete', ['id' => $user->id])}}" method="POST" style="display: inline;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </thead>
                                    </table>
                                </div>
                                @else
                                <h6 class="nothing-found mt-3"> No Data Found. </h6>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    @include('dashboard.components.footer')
</div>
@endsection
