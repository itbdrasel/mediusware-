<input type="hidden" id="userDateFormat" value="{{str_replace(["Y",'d','m'],["yy",'dd','mm'],config('settings')['date_format']) }}">
<input type="hidden" id="db_date_format" value="{{config('settings')['date_format']}}">
<input type="hidden" id="c_symbol" value="{{config('settings')['c_symbol']}}">
<input type="hidden" id="c_order" value="{{config('settings')['c_order']}}">

<script>var APP_URL = {!! json_encode(url('/')) !!};</script>
<script>var pageUrl = {!! json_encode(url($pageUrl ?? '')) !!};</script>

@include('core::layouts.include.js_plugin')

@if((Session::has('success')) || (Session::has('error')) || Session::has('message')))
<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }
    @if (Session::has('success'))
    toastr.success('{{ Session::get('success') }}');
    @elseif(Session::has('message'))
    toastr.info('{{Session::get('message')}}');
    @elseif(Session::has('error'))
    toastr.error('{{ Session::get('error') }}');
    @endif
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()
        //Date range picker
    });
</script>
@endif
@stack('js')
