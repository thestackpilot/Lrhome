@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@extends('admin.layouts.app')
@section('title','Orders')
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
                    <h1 class="h3 mb-0 text-gray-800">Orders</h1>
                </div>
                <!-- Page Content -->
                <div class="card shadow mb-4 t-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="orders-list table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0 rounded-start">#</th>
                                        <th class="border-0">Reference #</th>
                                        <th class="border-0">Order Status</th>
                                        <th class="border-0">Payment Status</th>
                                        <th class="border-0">Order Resposne</th>
                                        <th class="border-0">Order Data</th>
                                        <th class="border-0">Created At</th>
                                        <th class="border-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $i => $order)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$order->hash}}</td>
                                        <td>
                                            <div class="badge badge-pill {{ConstantsController::BADGES[$order->order_status]}}">
                                                {{$order->order_status}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-pill {{$order->payment_status ? ConstantsController::BADGES[$order->payment_status] : 'badge-dark'}}">
                                                {{$order->payment_status ? $order->payment_status : 'N/A'}}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                            $order_response = json_decode($order->order_response, 1);
                                            if (is_array($order_response)) {
                                                $message = isset($order_response['Message']) ? $order_response['Message'] : 'N/A';
                                                if ( $order_response['ErrorDetail'] )
                                                {
                                                    if ( is_array( $order_response['ErrorDetail'] ) )
                                                    {
                                                        $errorDetails = '';

                                                        foreach ( $order_response['ErrorDetail'] as $errorDetail )
                                                        {
                                                            $errorDetails .= $errorDetail['ErrorDescription'].'<br>';
                                                        }

                                                        if ( $errorDetails )
                                                        {
                                                            $message = '<b style="color: red">'.$message.'</b> <br/><br/>Following are the details: <br/>'.$errorDetails;
                                                        }

                                                    }
                                                    else
                                                    {
                                                        $message = $message.' ['.$order_response['ErrorDetail']['ErrorDescription'].']';
                                                    }
                                                }
                                                echo $message;
                                            }
                                            else
                                            echo 'N/A';
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            $order_data = unserialize($order->order_data);
                                            $data = ['General' => $order_data[0], 'Items' => $order_data[1]];
                                            echo '<textarea style="width: 300px;" class="form-control" rows="5">'.print_r(json_encode($data), 1).'</textarea>';
                                            @endphp
                                        </td>
                                        <td>{{ CommonController::get_date_format($order->created_at) }}</td>
                                        <td>
                                            <form action="{{route('admin.process-orders')}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$order->hash}}" name="order" />
                                                <input type="hidden" value="" name="order-data" />
                                                <button type="submit" value="submit" name="submit" class="btn btn-primary">Process</button>
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
                            {{ $orders->appends($_GET)->links() }}
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
            $('button[type="submit"]').off('click').on('click' , function(e){
                var data = $(this).closest("tr").find('textarea').val();
                $(this).closest("tr").find('input[name="order-data"]').val(data);
            });
        });
    </script>
    @endsection
