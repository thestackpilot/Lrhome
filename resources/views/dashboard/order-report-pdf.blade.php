@php
    use App\Http\Controllers\ConstantsController;
    use App\Http\Controllers\CommonController;
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
            font-size: 12px;
            vertical-align: middle;
        }
    </style>

    <script>
        {{--$(document).ready(function() {--}}
        {{--    var data = JSON.parse($('#report_details').html());--}}
        {{--    var content_body = '';--}}

        {{--    function formatText(key) {--}}
        {{--        return ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ')).replace(/([A-Z])\s(?=[A-Z])/g, '$1');--}}
        {{--    }--}}

        {{--    function getDetails(section) {--}}
        {{--        var modal_body = '';--}}
        {{--        if (section.length < 1) {--}}
        {{--            modal_body += '<div class="col-md-12">';--}}
        {{--            modal_body += '<h5>N/A</h5>';--}}
        {{--            modal_body += '</div>';--}}
        {{--        } else {--}}
        {{--            modal_body += '<div class="col-md-12">';--}}
        {{--            modal_body += '<table class="table mt-2 text-center details">';--}}
        {{--            modal_body += '<thead>';--}}
        {{--            modal_body += '<tr>';--}}
        {{--            Object.keys(section[0]).forEach(function(key) {--}}
        {{--                if (key !== 'href') modal_body += "<th style='text-align: center;'>" + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ')).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + "</th>";--}}
        {{--            });--}}
        {{--            modal_body += '</tr>';--}}
        {{--            modal_body += '</thead>';--}}
        {{--            modal_body += '<tbody>';--}}
        {{--            section.forEach(row => {--}}
        {{--                modal_body += '<tr>';--}}
        {{--                Object.keys(row).forEach(function(index) {--}}
        {{--                    if (index == 'href') {--}}
        {{--                        // continue;--}}
        {{--                    } else {--}}
        {{--                        if( (index == 'ImageName' || index == 'Image') && row[index] !== '')--}}
        {{--                        {--}}
        {{--                            modal_body += `<td><img src='{{$active_theme_json->theme_api_image_url}}${row[index]}' orig-src='{{$active_theme_json->theme_api_image_url}}${row[index]}' onerror='this.onerror=null;this.src="{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}"' width='110' ></td>`;--}}
        {{--                        }--}}
        {{--                        else--}}
        {{--                        {--}}
        {{--                            modal_body += "<td>" + (row[index] == null || row[index] == '' ? ((index == 'ImageName') ? 'No Image' : '-') : row[index]) + "</td>";--}}
        {{--                        }--}}
        {{--                    }--}}
        {{--                });--}}
        {{--                modal_body += '</tr>';--}}
        {{--            });--}}
        {{--            modal_body += '</tbody>';--}}
        {{--            modal_body += '</table>';--}}
        {{--            modal_body += '</div>';--}}
        {{--        }--}}

        {{--        return modal_body;--}}
        {{--    }--}}

        {{--    content_body += '<div class="row mt-5">';--}}
        {{--    data.sections.forEach((section, i) => {--}}
        {{--        content_body += '<div class="col-md-' + section.cols + '">';--}}
        {{--        // content_body += '<h4>' + section.title + '</h4>';--}}
        {{--        content_body += '<div class="row">';--}}
        {{--        if (Array.isArray(section.content) && typeof section.content.length !== 'undefined') {--}}
        {{--            content_body += getDetails(section.content);--}}
        {{--        } else if (typeof section.content.tabs !== 'undefined') {--}}
        {{--            content_body += '<div class="col-md-12">';--}}
        {{--            Object.keys(section.content.tabs).forEach(function(tab, i) {--}}
        {{--                content_body += `<h4 style="text-transform: capitalize">${tab}</h4>`;--}}
        {{--                content_body += `<div id="${tab}" role="tabpanel" aria-labelledby="${tab}-tab">`;--}}
        {{--                content_body += getDetails(section.content.tabs[tab]);--}}
        {{--                content_body += '</div>';--}}
        {{--            });--}}
        {{--            content_body += '</div>';--}}
        {{--        } else {--}}
        {{--            content_body += '<h4>' + section.title + '</h4>';--}}
        {{--            Object.keys(section.content).forEach(function(key) {--}}
        {{--                var value = section.content[key] == 0 || section.content[key] == '' ? 'N/A' : section.content[key];--}}
        {{--                content_body += '<p class="m-0"><strong>' + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase())).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + ' :</strong> ' + value + '</p>'--}}
        {{--                // content_body += '<div class="col-md-3">' + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase())).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + ' : ' + value + '</div>';--}}
        {{--            });--}}
        {{--        }--}}
        {{--        content_body += '</div>';--}}
        {{--        content_body += '</div>';--}}
        {{--    });--}}
        {{--    content_body += '</div>';--}}

        {{--    // $('#report_content').html(content_body);--}}
        {{--    window.print();--}}

        {{--});--}}
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
            width: 50% !important;
            float: left;
        }

        .w-12 {
            width: 100% !important;
            display: inline-block;
        }

        .mb-3 {
            margin-bottom: 2rem;
        }
    </style>

</head>

<body marginstyle="width:0" marginheight="0" topmargin="0">

<div class="content">
    <div
        style="display: flex;justify-content: space-between;align-items: center; border-bottom: 1px solid #ececec; padding-bottom: 20px;">
        <div class="logo text-md-left">
            <img src="{{asset($basicSettings -> logo_dark)}}" width="110" alt="LR Home">
        </div>
        <div>
            <p>{{$basicSettings -> address}} &nbsp; {{$basicSettings -> contact}}</p>
        </div>
    </div>
    <div id="report_details">
        @if(count($report_data['sections']))
            <div class="details" style="margin-top: 10px">
                @foreach($report_data['sections'] as $section)
                    <div class="w-{{ $section['cols'] }}">
                        <h5 style="margin: 0"><strong>{{ $section['title'] }}</strong></h5>
                        @if($section['title'] !== 'Detail')
                            @foreach($section['content'] as $key => $content)
                                <p style="margin: 0; font-size: 12px"><strong>{{ formatKey($key) }}: </strong>{{ $content }}</p>
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
                                                                        <img src="{{$active_theme_json->theme_api_image_url . $item}}" alt="{{ $item }}" onerror="{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}" width='50'>
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
    </div>
</div>

</body>

</html>
