@include('core::layouts.header')
@if ($moduleName =='scms')
    @include($moduleName.'::layouts.top_ber')
@else
    @include('core::layouts.top_ber')
@endif
@include('core::layouts.left_sidebar')
@include('core::layouts.breadcrumb')
@yield('content')
@include('core::layouts.footer')
