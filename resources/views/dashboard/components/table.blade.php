@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

$tabs = [];
if ( isset($tabular) && $tabular == 'yes' ) {
    // $tabs = ['Pending Orders', 'Open Orders', 'Back Orders', 'Complete Orders'];
    $tabs = ['All', 'Open', 'Back Orders', 'Completed'];
    /*
    foreach($table['tbody'] as $row ) {
        if ( isset($row['tab']) && !in_array($row['tab'], $tabs) ) {
            $tabs[$row['tab']] = $row['tab'];
        }
    }
    */
}

function get_table( $table, $tab = '' ) {
    $return = '
        <table class="table data-table mt-4 text-center" data-tab-name="'.$tab.'">
            <thead class="table-dark">
                <tr>';

    foreach($table['thead'] as $label ) {
        $return .= '<th class="font-ropa">'.$label.'</th>';
    }

    $return .= '</tr>
        </thead>
        <tbody>';
    $table_body = '';

    if ( $table['tbody'] ) {
        foreach($table['tbody'] as $row ) {
            if ($tab && isset($row['tab']) && $tab != $row['tab']  && $tab != 'All') continue;
            $table_body .= '<tr>';
            foreach( $table['thead'] as $key => $label ) {
                if ( $key == 'actions' ) {
                    $table_body .= '<td>';
                    foreach($row['actions'] as $action) {
                        if($action['type'] == 'modal' ) {
                            $table_body .= '
                            <button class="btn btn-sm btn-primary view-details" type="button">'.$action['label'].'</button>
                            <span class="row-details" style="display: none !important;">'.json_encode($row['details']).'</span>
                            ';
                        }
                    }
                    $table_body .= '</td>';
                } else {
                    $table_body .= '<td>'.$row[$key].'</td>';
                }
            }
            $table_body .= '</tr>';
        }
    } else {
        $table_body = '<tr>
                <td class="font-ropa" colspan="'.count($table['thead']).'">Data not available...</td>
            </tr>';
    }

    $return .= $table_body . '</tbody></table>';
    return $return;
}

@endphp

<div class="table-responsive p-lg-3">
    @if ( count($tabs) )
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach($tabs as $k => $tab)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{$k == 0 ? 'active': ''}}" id="{{substr(hash('sha256',$tab), 0, 8)}}-tab" data-bs-toggle="tab" data-bs-target="#{{substr(hash('sha256',$tab), 0, 8)}}" type="button" role="tab" aria-controls="{{substr(hash('sha256',$tab), 0, 8)}}" aria-selected="true">{{$tab}}</button>
        </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach($tabs as $k => $tab)
            <div class="tab-pane fade show {{$k == 0 ? 'active': ''}}" id="{{substr(hash('sha256',$tab), 0, 8)}}" role="tabpanel" aria-labelledby="{{substr(hash('sha256',$tab), 0, 8)}}-tab">
                {!!get_table($table, $tab)!!}
            </div>
        @endforeach
    </div>
    @else
    {!! get_table($table) !!}
    @endif
</div>
<div class="modal fade details-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
            </div>
            <div class="modal-body p-5" id="section-details" style="background: #fff;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section('styles')
@parent
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
<style>
    /* TODO: remove it once we enable the sorting */
    table.dataTable thead .sorting_asc {
        background: none;
        background-image: none !important;
    }
</style>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function() {

        $('.close-modal').click(function() {
            $('.details-modal').modal('hide');
        });

        $(document).off('click', '#myTab button').on('click', '#myTab button', function (e) {
            e.preventDefault();
            $('button', $(this).closest('#myTab')).removeClass('active');
            $(this).addClass('active');
            $('.tab-pane', $(this).closest('#myTab').siblings('#myTabContent')).removeClass('active');
            $(`${$(this).attr('data-bs-target')}`).addClass('active');
            initTable( typeof $(this).attr("data-type") !== "undefined" ? $(this).attr("data-type") : "" );
        });

        $(document).on('click', '.view-details', function() {
            // console.log('Details Clicked');
            var data = JSON.parse($('span.row-details', $(this).parent()).html());
            var modal_body = '';
            modal_body += '<div class="row mt-5">';
            data.body.sections.forEach((section, i) => {
                modal_body += '<div class="mb-3 col-md-' + section.cols + '">';

                if (Array.isArray(section.content) && typeof section.content.length !== 'undefined') {
                    modal_body += getDetails(section.content);
                } else if (typeof section.content.tabs !== 'undefined') {
                    modal_body += '<ul class="nav nav-tabs" id="myTab" role="tablist">';
                    Object.keys(section.content.tabs).forEach(function(tab, i) {
                        modal_body += '<li class="nav-item" role="presentation">';
                        modal_body += `<button data-type="modal" class="nav-link ${i == 0 ? 'active': ''}" id="${tab}-tab" data-bs-toggle="tab" data-bs-target="#${tab}" type="button" role="tab" aria-controls="${tab}" aria-selected="true">${tab}</button>`;
                        modal_body += '</li>';
                    });
                    modal_body += '</ul>';
                    modal_body += '<div class="tab-content" id="myTabContent">';
                    Object.keys(section.content.tabs).forEach(function(tab, i) {
                        modal_body += `<div class="tab-pane fade show ${i == 0 ? 'active': ''}" id="${tab}" role="tabpanel" aria-labelledby="${tab}-tab">`;
                        modal_body += getDetails(section.content.tabs[tab]);
                        modal_body += '</div>';

                    });
                    modal_body += '</div>';
                } else {
                    // modal_body += '<div class="col-12">';
                    modal_body += '<h4>' + section.title + '</h3>';
                    Object.keys(section.content).forEach(function(key) {
                        var value = section.content[key] == 0 || section.content[key] == '' ? 'N/A' : section.content[key];
                        modal_body += '<p class="m-0"><strong>' + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase())).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + ' :</strong> ' + value + '</p>'
                        // modal_body += '<div class="col-md-4">' + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ').replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase())).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + ' : ' + value + '</div>';
                    });
                    // modal_body += '</div>';
                }
                modal_body += '</div>';
            });
            modal_body += '</div>';
            $('.details-modal .modal-header').html(`
                <form action="{{ route('dashboard.orders-print-download') }}" class="w-100" method="POST" target="_blank">
                @csrf
                    <button type="submit" class="btn btn-secondary" style="float: right;">Print</button>
                    <textarea style="display: none;" name="report_data">${JSON.stringify(data.body)}</textarea>
                </form>
            `);
            $('.details-modal .modal-body').html(modal_body);
            $('.details-modal').modal('show');
            $('table.table.details', $('.details-modal .modal-body')).DataTable().destroy();
            $('table.table.details', $('.details-modal .modal-body')).dataTable({
                'fixedHeader': {
                    'header': true,
                    'footer': true
                },
                'pageLength': 50,
                'autoWidth': true,
                'scrollX': true,
                // 'scroller': true
            });
        });

        function initTable( type ) {
            if (type == 'modal') {
                $('table.table.details', $('.details-modal .modal-body')).DataTable().destroy();
                $('table.table.details', $('.details-modal .modal-body')).dataTable({
                    'fixedHeader': {
                        'header': true,
                        'footer': true
                    },
                    'pageLength': 50,
                    'autoWidth': true,
                    'scrollX': true,
                    // 'scroller': true
                });
            } else {
                if ('{{$paginated ?? ""}}' == 'yes') {
                    // && $.fn.DataTable.isDataTable('.table.data-table')) {
                    var columns = [];
                    @foreach($table['thead'] as $key => $label)
                    columns.push({
                        data: '{{$key}}'
                    });
                    @endforeach
                    $('.table.data-table:visible').DataTable().destroy();
                    $('.table.data-table:visible').dataTable({
                        'pageLength': 25,
                        // 'dom': 'Bfrtip',
                        // 'buttons': [
                        //     'copy', 'csv', 'excel', 'pdf', 'print'
                        // ],
                        'searching': false,
                        'lengthChange': false,
                        'processing': true,
                        'serverSide': true,
                        'ajax': {
                            "url": window.location.href,
                            "type": "GET",
                            // "data": $('form.dafault-form').serialize(),
                            "dataSrc": function(json) {
                                var data = [];
                                for (var i = 0; i < json.data.length; i++) {
                                    if (
                                        '{{$tabular ?? ""}}' == 'yes' &&
                                        typeof json.data[i]['tab'] !== 'undefined' &&
                                        typeof $('.table.data-table:visible').attr('data-tab-name') !== 'undefined' &&
                                        $('.table.data-table:visible').attr('data-tab-name') != json.data[i]['tab'] &&
                                        $('.table.data-table:visible').attr('data-tab-name') != 'All'
                                    ) continue;

                                    if (json.data[i]['actions'][0]['type'] == 'modal')
                                        json.data[i]['actions'] = `
                                            <button class="btn btn-sm btn-primary view-details" type="button">${json.data[i]['actions'][0]['label']}</button>
                                            <span class="row-details" style="display: none !important;">${JSON.stringify(json.data[i]['details'])}</span>
                                        `;

                                    data.push(json.data[i]);
                                }

                                if (data.length != json.data.length) {
                                    json.recordsFiltered = data.length;
                                    json.recordsTotal = data.length;
                                }

                                return data;
                            }
                        },
                        'columns': columns,
                        'ordering': false,
                        // 'columnDefs': [{
                        //     'targets': [$('th', $(this)).length - 1],
                        //     'orderable': false, // orderable false
                        // }]
                    });
                }
            }
        }

        initTable('');

        function getDetails(section) {
            var modal_body = '';
            if (section.length < 1) {
                modal_body += '<div class="col-md-12">';
                modal_body += '<h5>N/A</h5>';
                modal_body += '</div>';
            } else {
                modal_body += '<div class="col-md-12">';
                modal_body += '<table class="table mt-2 text-center details">';
                modal_body += '<thead>';
                modal_body += '<tr>';
                Object.keys(section[0]).forEach(function(key) {
                    if ( key !== 'href' ) modal_body += "<th>" + ((key.replace(/([A-Z|0-9])/g, ' $1').trim()).replace('_', ' ')).replace(/([A-Z])\s(?=[A-Z])/g, '$1') + "</th>";
                });
                modal_body += '</tr>';
                modal_body += '</thead>';
                modal_body += '<tbody>';
                section.forEach(row => {
                    modal_body += '<tr>';
                    Object.keys(row).forEach(function(index) {
                        if ( index == 'href' )
                        {
                            // continue;
                        }
                        else
                        {
                            if( index == 'ImageName' && row[index] !== '')
                            {
                                modal_body += `<td><a href="${( typeof row['href'] !== 'undefined' ? row['href'] : '#' )}" target='_blank'><img src='{{$active_theme_json->theme_api_image_url}}${row[index]}' orig-src='{{$active_theme_json->theme_api_image_url}}${row[index]}' onerror='this.onerror=null;this.src="{{url('/').ConstantsController::IMAGE_PLACEHOLDER}}"' width='100%' ></a></td>`;
                            }
                            else
                            {
                                modal_body += "<td>" + (row[index] == null || row[index] == '' ? ((index == 'ImageName') ? 'No Image' : '-') : row[index]) + "</td>";
                            }
                        }
                    });
                    modal_body += '</tr>';
                });
                modal_body += '</tbody>';
                modal_body += '</table>';
                modal_body += '</div>';
            }

            return modal_body;
        }
    });
</script>
@endsection
