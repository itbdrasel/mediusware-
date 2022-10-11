<!DOCTYPE html>
<html lang="en">
<head id="header_aria">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="nofollow">
    <meta name="googlebot" content="noindex">
    <title>{{$title}} | Admin</title>
    <noscript>
        <h1>This page needs JavaScript activated to work.</h1>
        <style>div,footer.main-footer { display:none; }</style>
    </noscript>
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="{{asset('backend/plugins/date_range_picker/daterangepicker.css') }}">

@include('core::layouts.include.css')
    <!-- New Added End -->
    <style>
        @media print {
            #print_aria{
                -webkit-print-color-adjust: exact !important;
            }
        }
    </style>
</head>

@yield('content')


    </body>
</html>
<!-- jQuery -->
<script src="{{url('backend')}}/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{url('backend/plugins/bootstrap_old/js/bootstrap.bundle.min.js')}}"></script>

<!-- New Added End -->

@stack('plugin')

<!-- AdminLTE App -->
<script src="{{url('backend/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('backend/js/demo.js')}}"></script>

<script src="{{url('backend/js/app-helper.js')}}"></script>
<!-- <script src="{{url('backend/js/admin-scripts.js')}}"></script> -->


<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}" ></script>
<!--Show Toaster Notification -->
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
    </script>
@endif

@stack('js')
