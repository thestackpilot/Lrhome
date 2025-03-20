@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

$filter_arr = array();
function getCount( $subfilters, $filter ) {
    foreach($subfilters as $subfilter) {
        if ( strcmp($filter, $subfilter['Description']) === 0 ) {
            return $subfilter['Count'];
        }
    }
}
@endphp
@if(($filters['Filters_Count']) > 0)
<div class="list-fillter" id="sub3">
    <div class="d-flex justify-content-between align-items-center px-3 pb-2 filter-headeing-area">
        <div class="mobile-show-new"><h5>Filter By</h5></div>
        <div>
            <button onclick="setVisibility('sub3', 'none');" ; class="close-fillter-btn"><i class="icon-cross2"></i></button>
            <input type="hidden" name="main_collection_id" value="{{$main_collection['MainCollectionID']}}" }}>
            <input type="hidden" name="return_type_id" value="{{$return_type_id}}" }}>
        </div>
    </div>
    <nav>
        <ul class="my-nav">
            @foreach($filters['Filters'] as $filter)
            @php
                if(strtolower(trim($filter['Description'])) != 'size' && strtolower(trim($filter['Description'])) != 'height')
                {
                    $filter_arr[] = $filter['Description'];
                }
            @endphp
            <li class="fillter-nav {{strtolower($filter['FilterID']) == 'sort' ? 'd-none' : ''}}">
                <div class="mobile-hide-new">
                    <a href="javascript:void(0);" class="fillter-nav-parant"> {{$filter['Description']}} <i class="icon-chevron-down"></i> </a>
                    <ul class="row fillter-sub-item" id="filter-id-desktop-{{str_replace(' ', '', $filter['FilterID'])}}">
                        <li class="col-md-12">
                            <input type="text" value="" id="searchColumn" class="form-control" autocomplete="off">
                        </li>
                        @php
                            $filters_data = array_chunk( $filter['Values'], ceil(count($filter['Values'])/ 2) );
                        @endphp
                        @foreach ($filters_data as $filter_value )
                        <li class="col-md-6">
                            @foreach($filter_value as $value)
                                <div id="lifestylebox">
                                    <input class="form-check-input sidebar-filters-input" type="{{ strtolower($filter['FilterID']) == 'sort' ? 'radio' : 'checkbox'}}" name="{{$filter['FilterID']}}" value="{{$value['value']}}" {!!($value['checked'])?'checked = "true"':''!!} id="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__desktop')}}">
                                    <label for="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__desktop')}}" class="tag_cnt" title="{{$value['value']}}">{{strlen($value['value']) > 20 ? substr($value['value'], 0, 17) . '...' : $value['value']}} {{ $filter['FilterID'] != 'Sort' ? '(' . getCount($filter['SubFilters'], $value['value']) . ')' : '' }}</label><br>
                                </div>
                            @endforeach
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="accordion filter-accordians mobile-show-new" id="accordionFilter">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{str_replace(' ', '_', $filter['FilterID'])}}" aria-expanded="true" aria-controls="collapse-{{str_replace(' ', '_', $filter['FilterID'])}}">
                                {{$filter['Description']}}
                            </button>
                        </h2>
                        <div id="collapse-{{str_replace(' ', '_', $filter['FilterID'])}}" class="accordion-collapse collapse" data-bs-parent="#accordionFilter">
                            <div class="accordion-body">
                                <ul class="row" id="filter-id-mobile-{{str_replace(' ', '', $filter['FilterID'])}}">
                                    <li class="col-md-12">
                                        <input type="text" value="" id="searchColumn" class="form-control" autocomplete="off">
                                    </li>
                                    @php
                                    $showMoreLimit = 8;
                                    $visibleItems = array_slice($filter['Values'], 0, $showMoreLimit);
                                    $hiddenItems = array_slice($filter['Values'], $showMoreLimit);
                                    $showMoreButton = count($hiddenItems) > 0;
                                    $hiddenClass = $showMoreButton ? 'hidden' : '';
                                    @endphp
                                    @foreach ($visibleItems as $index => $value)
                                    <li class="col-md-6 {{$hiddenClass}}" {{$index >= $showMoreLimit ? 'style=display:none' : ''}}>
                                        <div id="lifestylebox">
                                            <input class="form-check-input sidebar-filters-input" type="{{ strtolower($filter['FilterID']) == 'sort' ? 'radio' : 'checkbox'}}" name="{{$filter['FilterID']}}" value="{{$value['value']}}" {!!($value['checked'])?'checked = "true"':''!!} id="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__mobile')}}">
                                            <label for="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__mobile')}}" class="tag_cnt" title="{{$value['value']}}">{{strlen($value['value']) > 20 ? substr($value['value'], 0, 17) . '...' : $value['value']}} {{ $filter['FilterID'] != 'Sort' ? '(' . getCount($filter['SubFilters'], $value['value']) . ')' : '' }}</label><br>
                                        </div>
                                    </li>
                                    @endforeach
                                    @foreach ($hiddenItems as $index => $value)
                                    <li class="col-md-6 hidden-items" {{$index >= $showMoreLimit ? '' : 'style=display:none'}}>
                                        <div id="lifestylebox">
                                            <input class="form-check-input sidebar-filters-input" type="{{ strtolower($filter['FilterID']) == 'sort' ? 'radio' : 'checkbox'}}" name="{{$filter['FilterID']}}" value="{{$value['value']}}" {!!($value['checked'])?'checked = "true"':''!!} id="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__mobile')}}">
                                            <label for="{{base64_encode($filter['FilterID'].'__'.$value['value'].'__mobile')}}" class="tag_cnt" title="{{$value['value']}}">{{strlen($value['value']) > 20 ? substr($value['value'], 0, 17) . '...' : $value['value']}} {{ $filter['FilterID'] != 'Sort' ? '(' . getCount($filter['SubFilters'], $value['value']) . ')' : '' }}</label><br>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($showMoreButton)
                                    <li class="col-md-12">
                                        <button class="show-more btn btn-link py-0" type="button">Show More</button>
                                    </li>
                                    @endif
                                    <li class="col-md-12">
                                        <button class="show-less btn btn-link py-0" type="button">Show Less</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            <li class="fillter-nav d-none">
                <a class="fillter-nav-parant reset_filters"> Reset Filter </a>
            </li>
        </ul>
        <nav>
</div>
<div class="filler-show-btn pull-right">
    <button onclick="setVisibility('sub3', 'inline');" ;="">Filters <span class="icon-funnel"></span></button>
</div>
<div id="selected_filters">
    @if(($filters['Filters_Count']) > 0)
    @php
        $new_arrival = 0;
        if (false && request('filter')) {
            if ( $new_arrival ) {
                foreach($filters['Filters'] as $filter) {
                    if(strtolower($filter['FilterID']) == 'sort') {
                        foreach($filter['Values'] as $value) {
                            if ( $value['checked'] ) {
                                $new_arrival = 0;
                            }
                        }
                    }
                }
            }
        }
    @endphp
    @foreach($filters['Filters'] as $filter)
    @if( (!isset($is_collection) || !$is_collection) && strtolower($filter['FilterID']) == 'sort')
    <select class="sort-filter pull-left mb-3">
    @foreach($filter['Values'] as $value)
    <option value="{{$value['value']}}" {{$value['checked'] || $new_arrival ? 'selected' : ''}} >{{$value['value']}}</option>
    @endforeach
    </select>
    @endif
    @endforeach
    @endif

    <div class="pt-3 filter-content mb-1">
    @if( (!empty($filters['Filters'])) && ($filters['Selected_Filters_Count'] > 0) )
    <div class="filter-content-selected">
    @foreach($filters['Filters'] as $filter)
    @if (strtolower($filter['FilterID']) != 'sort')
    @foreach($filter['Values'] as $value)
    @if($value['checked'])
    <span class="mb-1 badge">
        {{$value['value']}}
        <button class="remove-filer-cross" type="button" class="close" aria-label="Dismiss">
            <input type="hidden" class="remove-filter-value" value="{{$filter['FilterID']}} : {{$value['value']}}">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    @endif
    @endforeach
    @endif
    @endforeach
    </div>
    <div>
    <span class="mb-1 badge clear-all">
        <button class="clear_all_filters">Clear All</button>
    </span>
    </div>
    @endif
    </div>
</div>
<div class="pageLoader d-none" id="pageLoader">
    <div id="loading_msg" class="d-flex flex-column text-center">
        <div class="spinner-border" role="status" style="margin: 0 auto;">
            <span class="sr-only" style="opacity:0;">Loading...</span>
        </div>
        <p class="loadinMsg">Loading...</p>
    </div>
</div>
@endif
@section('styles')
<style>
    select.sort-filter {
        width: auto;
        min-width: 150px;
        border: 1px solid #e0e0e0;
        height: 40px;
        margin-top: 20px;
        font-size: 14px;
        font-family: 'Conv_Nexa Light';
        font-weight: 500;
        color: #444343;
        padding: 5px 10px;
    }
</style>
@endsection
@section('scripts')
@parent
<script>
    var pageLoaded = false;
    function setVisibility(id, visibility) {
        document.getElementById(id).style.display = visibility;
    }

    function fill_filter_array(type) {
        var temp = [];
        var str = '';
        $.each($("input[name='" + type + "']:checked"), function() {
            temp.push('"' + $(this).val() + '"');
        });
        if (temp.length != 0) {
            return '{"FilterID":"' + type + '","Values":[' + temp + ']}';
        }
        return '';
    }

    function filterManager(Filterarr, clearAll = false) {
        if ($('#pageLoader').length) {
            $('#pageLoader').removeClass('d-none');
        }

        if (xhr != null) {
            xhr.abort();
        }
        var filter_types = "{{ implode( ',', $filter_arr ) }}".split(','); //'Color', 'Shape', 'Style', 'Material', 'Weaving', 'Designer', 'Discount', 'Collection'
        @php
            if (isset($default_filter) && $default_filter)
            {
                // $default_filter = str_replace("'", "\'", $default_filter);
            }
        @endphp
        var FiltersArray = '{!!base64_encode(isset($default_filter) && $default_filter ? $default_filter : ConstantsController::NO_FILTER_FLAG)!!}';
        if (Filterarr == null) {
            var Filters =[];
            if ('{{isset($default_filter) && $default_filter}}' == '1') {
                var defaultFilter = {!!$default_filter ?? "''"!!};
                defaultFilter['Filters'].forEach(function(filter){
                    if (!filter_types.includes(filter.FilterID) && (filter.FilterID !== 'Size' || filter.FilterID !== 'Height') && typeof filter.FilterID.length !== 'undefined')
                        Filters.push(JSON.stringify(filter));
                });
            }

            filter_types.forEach(function(filter) {
                var response = fill_filter_array(filter);
                if (response.length) {
                    Filters.push(response);
                }
            });

            var sizes = [];
            $.each($("input[name='Size']:checked"), function() {
                var val = $(this).val();
                sizes.push('"' + val.replace(/"/g, '\\"') + '"');
            });

            if (sizes.length != 0) {
                Filters.push('{"FilterID":"Size","Values":[' + sizes + ']}')
            }

	    console.log('Filters: ', Filters);

            var heights = [];
            $.each($("input[name='Height']:checked"), function() {
                var val = $(this).val();
                heights.push('"' + val.replace(/"/g, '\\"') + '"');
            });

            if (heights.length != 0) {
                Filters.push('{"FilterID":"Height","Values":[' + heights + ']}')
            }

            if (Filters.length != 0) {
                FiltersArray = btoa('{"Filters": [' + Filters + ']}');
            } else if ('{{isset($default_filter) && $default_filter}}' == '1') {
                var defaultFilter = {!!$default_filter ?? "''"!!};
                var count = 0;
                defaultFilter['Filters'].forEach(function(filter){
                    if (filter_types.includes(filter.FilterID))
                        count++;
                });

                if ( count == (defaultFilter['Filters']).length )
                    FiltersArray = btoa('{!!ConstantsController::NO_FILTER_FLAG!!}');
            }
        } else {
            if (
                '{{isset($default_filter) && $default_filter}}' == '1' && !clearAll
            ) {
                var defaultFilter = {!!$default_filter ?? "''"!!};
                defaultFilter['Filters'].forEach(function(filter){
                    if (!filter_types.includes(filter.FilterID) && typeof filter.FilterID.length !== 'undefined')
                        Filterarr.push(JSON.stringify(filter));
                });
                FiltersArray = btoa('{"Filters": [' + Filterarr + ']}');
            } else {
                const FILTERS = {
                    Rugs: 'Rugs',
                    New_Arrivals: 'New_Arrivals',
                    NATURALS: 'NATURALS',
                    Indoor_Outdoor: 'Indoor_Outdoor',
                    Discontinued: 'Discontinued',
                    PILLOWS: 'PILLOWS',
                    POUFS: 'POUFS',
                    Throws: 'Throws',
                    Baskets: 'Baskets',
                    Chair_Pads: 'Chair_Pads',
                    TABLE_TOPS: 'TABLE_TOPS',
                    COVERLETS: 'COVERLETS',
                    Pet_Bowls: 'Pet_Bowls',
                    Pet_Beds: 'Pet_Beds',
                    Chairs: 'Chairs',
                    BENCHES: 'BENCHES',
                    Cabinets: 'Cabinets',
                    coffee_tables: 'coffee_tables',
                    Consoles: 'Consoles',
                    Side_Tables: 'Side_Tables',
                    sideboards: 'sideboards',
                    stools_ottoman: 'stools_ottoman',
                    Bar_Table: 'Bar_Table',
                    Mirrors: 'Mirrors',
                    drink_tables: 'drink_tables',
                    sofas: 'sofas',
                    Dining_Tables: 'Dining_Tables',
                    Dining_Benches: 'Dining_Benches',
                    Dining_Chairs: 'Dining_Chairs',
                };
                const decodedString = atob(Filterarr);
                const jsonData = JSON.parse(decodedString);
                const filteredFilters = jsonData.Filters.filter((filter) => FILTERS.hasOwnProperty(filter.FilterID));
                const result = { Filters: filteredFilters, };
                FiltersArray = jsonToBase64(result);
                // FiltersArray = Filterarr;
            }
        }

        var mainCollectionId = $('input[name="main_collection_id"]').val();
        var return_type = $('input[name="return_type_id"]').val();
        var url = window.location.origin + "/designs/" + mainCollectionId + "/" + FiltersArray + "/" + return_type;
        var designPagePath = window.location.origin + '/designs';
        var currentPagePath = window.location.origin + window.location.pathname;
        // console.log(`currentPagePath: ${currentPagePath}`);
        // console.log(`designPagePath: ${designPagePath}`);
        // console.log(`URL: ${url}`);
        initialLoad = false;
        if (currentPagePath.match(designPagePath) == null) {
            window.location.href = url;
        } else {
            xhr = $.ajax({
                method: 'GET',
                url: url,
                data: {
                    '_token': '{{csrf_token()}}',
                }
            }).
            done(function(response) {
                var base_url = window.location.origin;
                window.history.pushState('', '', url);
                var new_html = $($.parseHTML(response));

                $('#sub_collections_wrapper').html(new_html.find('#sub_collections_wrapper').html());
                $('#collection_heading').html(new_html.find('#collection_heading').html());
                $('#selected_filters').html(new_html.find('#selected_filters').html());
                $('.list-fillter .my-nav').html(new_html.find('.list-fillter .my-nav').html());

                if ($('#pageLoader').length) {
                    $('#pageLoader').addClass('d-none');
                }
                applyFilterTrigger();
                bindClicks();
            });
        }
    }

    function jsonToBase64(jsonData) {
        const jsonString = JSON.stringify(jsonData);
        const base64String = btoa(jsonString);
        return base64String;
    }

    function applyFilterTrigger() {
        $('.remove-filer-cross').off('click');
        $('.remove-filer-cross').on('click', function() {
	    initialLoad = false;
            var sel_filter = $(this).find('.remove-filter-value').val().toString().trim().split(':');
            removeFilter(sel_filter[0].trim(), sel_filter[1].trim());
        });
    }

    function removeFilter(filterType, filterValue) {
        $("#filter-id-desktop-" + (filterType.replace(' ', ''))).find("input[name='" + filterType + "']:checked").each(function(index, filter) {
            if ($(filter).val().trim() == filterValue) {
                $(this).prop("checked", false);
                $(this).removeAttr("checked");
            }
        });
        $("#filter-id-mobile-" + (filterType.replace(' ', ''))).find("input[name='" + filterType + "']:checked").each(function(index, filter) {
            if ($(filter).val().trim() == filterValue) {
                $(this).prop("checked", false);
                $(this).removeAttr("checked");
            }
        });

        filterManager();
    }

    var xhr = null;
    var initialLoad = true;

    function bindClicks() {
        $(document)
        .off('click', '.reset_filters, .clear_all_filters')
        .on('click', '.reset_filters, .clear_all_filters', function() {
            var FiltersArray = '{!!base64_encode(isset($default_filter) && $default_filter ? $default_filter : ConstantsController::NO_FILTER_FLAG)!!}';
            var noFiltersArray = '{!!base64_encode(ConstantsController::NO_FILTER_FLAG)!!}';
            //filterManager(initialLoad ? noFiltersArray : FiltersArray, true);
            filterManager(noFiltersArray, true);
            $('input:checkbox').removeAttr('checked');
        });

        $(document)
        .off('change', 'select.sort-filter')
        .on('change', 'select.sort-filter', function() {
            $(`input[value="${$(this).val()}"]`).trigger('click');
        });

        $(document)
        .off('change', '.sidebar-filters-input')
        .on('change', '.sidebar-filters-input', function() {
            filterManager();
        });

        applyFilterTrigger();
        $('.fillter-nav').each( function () {
            var rightEdge = $(this).width() + $(this).offset().left;
            var containerWidth = $('ul.my-nav').width() * .75;
            if ( rightEdge > containerWidth ) {
                $('.fillter-sub-item', $(this)).addClass('move-right');
            }
        });
    }

    $(document).ready(function() {
        bindClicks();
        $('.hidden-items').hide();
        $('.show-less').hide();

        $('.show-more').click(function() {
            $('.hidden-items').slideDown();
            $(this).hide();
            $('.show-less').show();
        });

        $('.show-less').click(function() {
            $('.hidden-items').slideUp();
            // $('.hidden-items').hide();
            $(this).hide();
            $('.show-more').show();
        });
    });
</script>
@endsection
