@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Dealer Registrations')
@section('content')
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.components.side-bar')
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            @include('admin.components.admin-topbar')
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @if (Session::has('message'))
                <div class="alert alert-{{Session::get('message')['type']}}">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{Session::get('message')['body']}}
                </div>
                @endif
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dealers</h1>
                </div>
                <!-- Page Content -->
                <div class="card shadow mb-4 t-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="dealers-list table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0 rounded-start">#</th>
                                        <th class="border-0">Name</th>
                                        <th class="border-0">Email</th>
                                        <th class="border-0">Company</th>
                                        <th class="border-0">Phone #</th>
                                        <th class="border-0">Interested In</th>
                                        <th class="border-0">Postal Code</th>
                                        <th class="border-0">City</th>
                                        <th class="border-0">State/Province</th>
                                        <th class="border-0">Country</th>
                                        <th class="border-0">Created At</th>
                                        <th class="border-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dealers as $i => $dealer)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$dealer->getDataAttribute('firstname') . ' ' . $dealer->getDataAttribute('lastname') }}</td>
                                        <td>{{$dealer->getDataAttribute('email')}}</td>
                                        <td>{{$dealer->getDataAttribute('company')}}</td>
                                        <td>{{$dealer->getDataAttribute('phone')}}</td>
                                        <td>{{$dealer->getDataAttribute('interested-in')}}</td>
                                        <td>{{$dealer->getDataAttribute('postal_code')}}</td>
                                        <td>{{$dealer->getDataAttribute('city')}}</td>
                                        <td>{{$dealer->getDataAttribute('state')}}</td>
                                        <td>{{$dealer->getDataAttribute('country')}}</td>
                                        <td>{{date('Y-m-d H:i:s', strtotime($dealer->created_at))}}</td>
                                        <td>
                                            <form action="{{route('admin.process-dealer-registrations')}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$dealer->id}}" name="dealer" />
                                                <button type="submit" value="approve" name="submit" class="btn btn-primary">Send to SPARS</button>
                                                <button type="submit" value="decline" name="submit" class="btn btn-danger">Decline</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">No records found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            {{ $dealers->appends($_GET)->links() }}
                        </div>
                    </div>
                    <!-- /Page Content -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('admin.components.sticky-footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    @include('admin.components.scroll-top')
    <!-- Logout Modal-->
    @include('admin.components.logout-model')
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function() {
            $('textarea').each(function() {
                $(this).html(JSON.stringify(JSON.parse($(this).html()), undefined, 4));
            });
        });
    </script>
    @endsection
