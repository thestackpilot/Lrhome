@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

@if($filters)
<form class="d-flex flex-lg-row flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3 filters-form">
    @foreach($filters as $filter)
    @if($filter['type'] == 'hidden')
    <input name="{{str_replace(' ', '_', strtolower($filter['title']))}}" value="{{$filter['value']}}" class="form-control" type="{{$filter['type']}}" />
    @else
    <div class="mb-3 pe-1 pe-lg-3 {{isset($filter['filter_width']) ? $filter['filter_width'] : 'col-md-3 col-sm-12'}}">
        <label for="{{str_replace(' ', '_', strtolower($filter['title']))}}" class="form-label w-100">{{$filter['title']}}</label>
        @if($filter['type'] == 'select')
        <select name="{{str_replace(' ', '_', strtolower($filter['title']))}}" class="form-control" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!}>
            @foreach($filter['options'] as $option)
            <option value="{{$option['value']}}" {{$filter['value'] === $option['value'] ? 'selected' : ''}}>{{$option['label']}}</option>
            @endforeach
        </select>
        @elseif( in_array($filter['type'], ['radio', 'checkbox']) )
        <div class="d-flex">
            @foreach($filter['options'] as $value => $label )
            <div class="input-group w-auto">
                <input {{$filter['value'] === $value ? 'checked' : ''}} name="{{str_replace(' ', '_', strtolower($filter['title']))}}" id="{{substr(hash('sha256',$value), 0, 8)}}" value="{{$value}}" class="{{isset($filter['class']) ? $filter['class'] : ''}}" type="{{$filter['type']}}" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!} />
                <label style="border: none;" for="{{substr(hash('sha256',$value), 0, 8)}}">{!! $label !!}</label>
            </div>
            @endforeach
        </div>
        @elseif($filter['type'] == 'date')
        <div class="input-group">
            <input name="{{str_replace(' ', '_', strtolower($filter['title']))}}" value="{{$filter['value']}}" class="form-control datepicker {{isset($filter['class']) ? $filter['class'] : ''}}" type="text" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!} />
            <span class="input-group-addon">
                <i class="bi bi-calendar"></i>
            </span>
        </div>
        @else
        <input name="{{str_replace(' ', '_', strtolower($filter['title']))}}" value="{{$filter['value']}}" class="form-control {{isset($filter['class']) ? $filter['class'] : ''}}" type="{{$filter['type']}}" {!! isset($filter["attribues"]) ? $filter["attribues"] : "" !!} />
        @endif
    </div>
    @endif
    @endforeach
    <div class="col-md-12 d-flex justify-content-end">
        <button type="submit" name="submit" value="data" class="btn btn-primary text-uppercase mt-2">Search</button>
    </div>
</form>
@endif
@section('scripts')
@parent
<script>
   $(document).ready(function() {
      $('form.filters-form').on('submit', function() {
        console.log("on submit!!!!");
         var all_ok = true;
         if ($('.filters-form [data-required="true"]').length) {
            $('.filters-form [data-required="true"]').each(function() {
                console.log("$(this).val(): ", $(this).val());
               if ($(this).val() == '') {
                  $(this).addClass('is-invalid');
                  all_ok = false;
               } else
                  $(this).removeClass('is-invalid');
            });
         }

         return all_ok;
      });
   });
</script>
@endsection