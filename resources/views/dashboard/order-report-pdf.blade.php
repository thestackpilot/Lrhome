@php
    use App\Http\Controllers\ConstantsController;
    use App\Http\Controllers\CommonController;
@endphp
@php
    function formatKey ($key) {
            $result = preg_replace('/([A-Z|0-9])/', ' $1', $key);
            $result = trim($result);
            $result = str_replace('_', ' ', $result);
            return ucfirst(preg_replace('/([A-Z])\s(?=[A-Z])/', '$1', $result));
        }
@endphp
<html>
<head>
    <title>Order Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        .content {
            padding: 20px;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-12 {
            width: 100%;
        }

        /* .col-md-4 {
            width: 33.33333333%;
            float: left;
        } */
        .col-md-3 {
            width: 25%;
            float: left;
            font-size: 12px;
        }

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            font-size: 10px;
            vertical-align: middle;
        }
    </style>

    <script>
        $(document).ready(function () {
            window.print()
        })
    </script>
    <style>
        .text-center {
            text-align: center !important;
        }

        .m-4 {
            margin: 3rem !important;
        }

        .w-6 {
            width: 49% !important;
            /*float: left;*/
        }

        .w-12 {
            width: 99% !important;
            display: inline-block;
        }

        .mb-3 {
            margin-bottom: 2rem;
        }
    </style>

</head>

<body>

<div class="content">
{{--    <div id="report_details">--}}
        <table>
            <tr>
                <td>
                    <div style="display: flex;align-items: center; border-bottom: 1px solid #ececec; padding-bottom: 20px;">
                        <div class="logo text-md-left">
                            <img src="{{asset($basicSettings -> logo_dark)}}" width="200" alt="LR Home">
                        </div>
                        <div style="margin-left: 20px;">
                            <p style="margin: 0"><strong>{{$basicSettings -> address}}</strong></p>
                            <p style="margin: 0"><strong>TEL {{$basicSettings -> contact}}</strong></p>
                            <p style="margin: 0"><strong>Fax (706)-259-0156</strong></p>
                            <p style="margin: 0"><strong>Email: {{$basicSettings->email}}</strong></p>
                            <p style="margin: 0"><strong>EIN: 58-2658997</strong></p>
                        </div>
                    </div>
                    @if(count($report_data['sections']))
                        <div class="details" style="margin-top: 10px; display: flex; flex-wrap: wrap">

                            @foreach($report_data['sections'] as $section)
                                <div class="w-{{ $section['cols'] }}">
                                    <h5 style="margin: 0"><strong>{{ $section['title'] }}</strong></h5>
                                    @if($section['title'] !== 'Detail' && $section['title'] !== 'Details' && $section['title'] !== 'Items List')
                                        @foreach($section['content'] as $key => $content)
                                            @if(($content !== 'N/A' && $content) || $key === 'Discount')
                                                @if($key === 'Discount')
{{--                                                    @if($content === 'N/A')--}}
                                                        @php
                                                            $content = number_format($content, ConstantsController::ALLOWED_DECIMALS)
                                                        @endphp
{{--                                                    @endif--}}
                                                @endif
                                                @if(empty($section['hide_labels']))
                                                    <p style="margin: 0; font-size: 10px"><strong>{{ formatKey($key) }}
                                                            : </strong>{{ $content }}</p>
                                                @else
                                                    <p style="margin: 0; font-size: 12px">{{ $content }}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                        <br>
                                    @else
                                        <div class="items" style="margin-top: 10px;">
                                            @if(!empty($section['content']))
                                                @if(!empty($section['content']['tabs']))
                                                    @foreach($section['content']['tabs'] as $key => $items)
                                                        <h5 style="margin: 0"><strong>{{ formatKey($key) }}</strong></h5>
                                                        <table class="table mt-2 details">
                                                            @if(count($items))
                                                                <thead>
                                                                @foreach($items[0] as $item_key => $item)
                                                                    @if($item_key !== 'href')
                                                                        <th>{{ formatKey($item_key) }}</th>
                                                                    @endif
                                                                @endforeach
                                                                </thead>
                                                                <tbody>
                                                                @foreach($items as $item_key => $item_data)
                                                                    <tr>
                                                                        @foreach($item_data as $item_key => $item)
                                                                            @if($item_key !== 'href' && $item_key !== 'ImageName')
                                                                                <td><span>{{ $item }}</span></td>
                                                                            @endif
                                                                            @if($item_key === 'ImageName')
                                                                                <td>
                                                                                    <img
                                                                                        src="{{$active_theme_json->theme_api_image_url . $item}}"
                                                                                        alt="{{ $item }}"
                                                                                        onerror="{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}"
                                                                                        width='50'>
                                                                                </td>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            @else
                                                                <div class="m-4 text-center">
                                                                    <h4>No Data Found</h4>
                                                                </div>
                                                            @endif
                                                        </table>
                                                    @endforeach
                                                @else
                                                    <div class="m-4 text-center">
                                                        <h4>No Data Found</h4>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="m-4 text-center">
                                                    <h4>No Data Found</h4>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="m-4 text-center">
                            <h4>No Data Found</h4>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
{{--    </div>--}}
</div>

</body>

</html>
