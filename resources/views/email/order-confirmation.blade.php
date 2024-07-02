@php
    use App\Http\Controllers\ConstantsController;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        body{
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section{
           background-color: #f6f3eb;
           padding: 10px 20px;
        }
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .d-flex {
            display: flex;
            margin: 0;
            padding: 0;
            align-items: center;
            place-items: center;
        }
        .width-100 {
            width: 100%;
        }
        .width-50{
            width: 50%;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 5px;
            border: 1px solid ;
        }
        .border-bottom-0{
            border-bottom: 0;
        }
        .border-top-0{
            border-top: 0;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-right: 10px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
            table-layout:fixed;
        }
        table thead tr{
            background-color: #f2f2f2;
            text-align: center;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
            font-size: 16px;
            /* white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; */
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
            font-size: 16px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .text-right{
            text-align: end;
        }
        .w-50{
            width: 50%;
        }
        .float-right{
            float: right;
        }
        .width-10{
            width: 10%;
        }
        .width-15{
            width: 15%;
        }
        .width-20{
            width: 20%;
        }
        .width-55{
            width: 55%;
        }
        .width-60{
            width: 60%;
        }
        .width-30{
            width: 30%;
        }
        .width-50-data{
            width: 50%;
        }
        td.item-data {
            display: flex;
            text-align: left;
        }
        .inner-item-data{
            display: flex;
            flex-wrap: wrap;
        }
        .margin-right-10{
            margin-right: 10px;
        }
        .margin-bottom-5{
            margin-bottom: 5px;
        }
        .margin-bottom-15{
            margin-bottom: 15px;
        }
        .padding-20{
            padding: 0px 0 0 20px;
        }
        td.item-data div {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item-data img {
            width: 90px;
            height: 90px;
        }
        .padding-top-25{
            padding-top: 25px;
        }
        .padding-right-5{
            padding-right: 5px;
        }
        h3.heading span{
            font-weight: 400;
        }

        @media (max-width: 768px){
            .brand-section{
                padding: 20px;
            }
            .width-100 {
                width: auto;
            }
            .width-50-data{
                width: auto;
            }
            .inner-item-data{
                display: block;
            }
            .body-section{
                padding: 0px;
                border: 0px solid ;
            }
            .heading {
                font-size: 20px;
                margin-bottom: 1px;
            }
            .sub-heading {
                font-size: 10px;
            }
            table th, table td {
                font-size: 10px;
            }
            .item-data img {
                width: 50px;
                height: 50px;
            }
            h3.heading,
            td h3 {
                font-size: 14px;
            }
            .body-section p {
                font-size: 12px;
            }
            .padding-20{
                padding: 10px 0 0 10px;
            }
            .font-size-14{
                font-size: 10px;
            }
            .padding-20{
                padding: 0px 0 0 10px;
            }
            .width-25{
                width: 25%;
            }
            .padding-top-25{
                padding-top: 0;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid">
    <div class="brand-section">
            <div class="row">
                <div class="width-50">
                <img class="bi bi-x-circle-fill email-logo" src="https://www.lrhome.us/LR/images/LRHome-logo-wide-v7-inverted-color-1.png" onerror="this.onerror=null; this.src=''" height="50" width="100">
               <!--  <img class="bi bi-x-circle-fill" src="{{asset('storage/Gh36qvlXPylRqy1GR2oK9bx76OrPq0rsznpRzBov.png')}}" height="60" width="100"> -->
                </div>
            </div>
        </div>
        <div class="body-section border-bottom-0">
            <br>
            <h2 class="heading" ><strong>Customer Details</strong></h2>
            <div class="width-100 d-flex">
                <div class="width-50">
                    <div class="margin-bottom-5"><strong>Bill to:</strong></div>
                    <p class="sub-heading">{!! $data['shipping']['BillingFirstName'] == '' ? 'N/A' : $data['shipping']['BillingFirstName'].' '.$data['shipping']['BillingLastName'] !!}  </p>
                    <p class="sub-heading">{!!$data['shipping']['BillingAddress1'] == '' ? 'N/A' : $data['shipping']['BillingAddress1'] !!} </p>
                    {{-- <p class="sub-heading">{!!$data['shipping']['Address1'] == '' ? 'N/A' : $data['shipping']['Address1'] !!} </p> --}}
                    <p class="sub-heading">{!! $data['shipping']['BillingCity'] !!}, {!! $data['shipping']['BillingState'] !!}, {!! $data['shipping']['BillingZip'] !!} </p>
                    {{-- <p class="sub-heading">Address 2: {!! $data['shipping']['Address2'] == '' ? 'N/A' : $data['shipping']['Address2'] !!} </p> --}}
                    {{-- <p class="sub-heading">City: {!! $data['shipping']['City'] !!} </p>
                    <p class="sub-heading">State: {!! $data['shipping']['State'] !!}</p>
                    <p class="sub-heading">Postal Code: {!! $data['shipping']['Zip'] !!} </p> --}}
                </div>
                <div class="width-50">
                    <div class="margin-bottom-5"><strong>Ship to:</strong></div>
                    <p class="sub-heading">{!! $data['shipping']['FirstName'] == '' ? 'N/A' : $data['shipping']['FirstName'].' '.$data['shipping']['LastName'] !!}  </p>
                    <p class="sub-heading">{!!$data['shipping']['Address1'] == '' ? 'N/A' : $data['shipping']['Address1'] !!} </p>
                    <p class="sub-heading">{!! $data['shipping']['City'] !!}, {!! $data['shipping']['State'] !!}, {!! $data['shipping']['Zip'] !!} </p>
                    {{-- <p class="sub-heading">Address 2: {!! $data['shipping']['Address2'] == '' ? 'N/A' : $data['shipping']['Address2'] !!} </p> --}}
                    {{-- <p class="sub-heading">City: {!! $data['shipping']['City'] !!} </p>
                    <p class="sub-heading">State: {!! $data['shipping']['State'] !!}</p>
                    <p class="sub-heading">Postal Code: {!! $data['shipping']['Zip'] !!} </p> --}}
                </div>
            </div>
            <!-- <div class="d-flex width-100">
                <div class="width-50">
                    <div class="margin-bottom-5"><strong>Contact:</strong></div>
                    <p class="sub-heading">SO#: {!! $data['shipping']['SO_Number'] == '' ? 'N/A' : $data['shipping']['SO_Number'] !!} </p>
                    <p class="sub-heading">PO#: {!! $data['shipping']['CustomerPO'] == '' ? 'N/A' : $data['shipping']['CustomerPO'] !!} </p>
                    <p class="sub-heading">Shipping Date: {!! $data['shipping']['ShipDate'] !!} </p>
                    <p class="sub-heading">Email: {!! $data['shipping']['Email'] == '' ? 'N/A' : $data['shipping']['Email'] !!}</p>
                </div>
                <div class="width-50">
                    <div class="margin-bottom-5"><strong>Ship Contact:</strong></div>
                    <p class="sub-heading">SO#: {!! $data['shipping']['SO_Number'] == '' ? 'N/A' : $data['shipping']['SO_Number'] !!} </p>
                    <p class="sub-heading">PO#: {!! $data['shipping']['CustomerPO'] == '' ? 'N/A' : $data['shipping']['CustomerPO'] !!} </p>
                    <p class="sub-heading">Shipping Date: {!! $data['shipping']['ShipDate'] !!} </p>
                    <p class="sub-heading">Email: {!! $data['shipping']['Email'] == '' ? 'N/A' : $data['shipping']['Email'] !!}</p>
                </div>
            </div> -->
        </div>
        <div class="body-section border-top-0">


            <div class="margin-bottom-15">
                <h2 class="heading" ><strong>Order Details</strong></h2>
                <p class="sub-heading">SO#: {!! $data['shipping']['SO_Number'] == '' ? 'N/A' : $data['shipping']['SO_Number'] !!} </p>
                <p class="sub-heading">PO#: {!! $data['shipping']['CustomerPO'] == '' ? 'N/A' : $data['shipping']['CustomerPO'] !!} </p>
                <p class="sub-heading">Shipping Date: {!! $data['shipping']['ShipDate'] !!} </p>
                <p class="sub-heading">Email: {!! $data['shipping']['Email'] == '' ? 'N/A' : $data['shipping']['Email'] !!}</p>
                <p class="sub-heading ">Delivery Method: {!! $data['shipping']['ShipViaCode'] !!}</p>
            </div>

            <div class="scroll-the-table font-size-14">
                <hr>
                <div class="d-flex">
                    <div class="width-50"><strong>Item</strong></div>
                    <div class="width-20 text-right"><strong>Price</strong></div>
                    <div class="width-10 text-right"><strong>Qty</strong></div>
                    <div class="width-20 text-right"><strong>Sub total</strong></div>
                </div>
                <hr>
                @foreach($data['items'] as $item)
                <div class="d-flex" style="align-items: center;">
                    <div class="width-50 d-flex" style="align-items: center;">
                        <img class="bi bi-x-circle-fill width-15 width-25" src="{!! $item['Image'] !!}" onerror="this.onerror=null; this.src='{!! url('/').ConstantsController::IMAGE_PLACEHOLDER !!}'">
                        <div class="inner-item-data padding-20 padding-top-25">
                            <div>
                                <div class="margin-right-10">{!! $item['Color'] !!} {!! $item['Size'] !!}</div>
                                <div class="margin-right-10">{!! $item['ItemID'] !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="width-20 padding-top-25 text-right">${!! $item['UnitPrice'] !!}</div>
                    <div class="width-10 padding-top-25 text-right">{!! $item['OrderQty'] !!}</div>
                    <div class="width-20 padding-top-25 text-right">${!! $item['SubTotal'] !!}</div>
                </div>
                <hr>
                @endforeach

                <div class="text-right">
                    {{-- <div class=""><strong class="padding-right-5">Shipping:</strong>${!! $data['shipping']['ShippingCost'] !!}</div> --}}
                    <h3 class="heading"><strong class="padding-right-5">Grand Total:</strong><span>${!! $data['total'] !!}</span></h3>
                </div>

            </div>
            <br>
            <!-- <h3 class="heading">Delivery Method: <span class="sub-heading">{!! $data['shipping']['ShipViaCode'] !!}</span></h3> -->
            <h3 class="heading">Additional Info: <span class="sub-heading">{!! array_key_exists('Instructions',$data['shipping']) && $data['shipping']['Instructions'] != '' ? $data['shipping']['Instructions'] : 'N/A' !!}</span></h3>

        </div>

        <div class="body-section">
                <p>&copy; Copyright 2021 - LR Home. All rights reserved.
                    <a href="https://www.lrhome.us/" class="float-right">www.LRHome.us</a>
                </p>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
