@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Form - ' . $title)
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
                    <h1 class="h3 mb-0 text-gray-800">{{$title}} Submissions</h1>
                </div>
                <!-- Page Content -->
                <div class="card shadow mb-4 t-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(count($form_entries))
                            <table class="data-list table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0 rounded-start">#</th>
                                        @foreach($table['thead'] as $heading)
                                        <th class="border-0">{{ucwords(str_replace('_', ' ', $heading))}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < count($table['tbody']); $i++) <tr>
                                        <td>{{$i + 1}}</td>
                                        @foreach($table['thead'] as $key)
                                        <td>{!!isset($table['tbody'][$i][$key]) ? $table['tbody'][$i][$key] : '-'!!}</td>
                                        @endforeach
                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                            @else
                            No records found!
                            @endif
                        </div>
                        <div class="pagination">
                            {{ $form_entries->appends($_GET)->links() }}
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
    @section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    @endsection
    @section('scripts')
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script><!-- Bootstrap core CSS -->
    <script>
        $(document).ready(function() {
            $('textarea').each(function() {
                $(this).html(JSON.stringify(JSON.parse($(this).html()), undefined, 4));
            });
            $('table.data-list').DataTable({
                'paging': false,
                'info': false,
                'autoWidth': true,
                'scrollX': true,
            });
        });
    </script>
    @endsection
