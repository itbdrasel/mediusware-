<script async src="https://www.googletagmanager.com/gtag/js?id=UA-209776320-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-209776320-1');
</script>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
@stack('css_plugin')
<link rel="stylesheet" href="{{url('backend')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Flaticon -->
<link rel="stylesheet" href="{{url('backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{url('backend')}}/fonts/flaticon.css">
<!-- materials icon -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Theme style -->
<link rel="stylesheet" href="{{url('backend')}}/css/adminlte.min.css">
<link rel="stylesheet" href="{{url('backend')}}/css/style.css">
<!-- Toaster Css -->
<link rel="stylesheet" href="{{url('/')}}/backend/plugins/timepicker/jquery.timepicker.min.css">
<link rel="stylesheet" href="{{url('/')}}/backend/plugins/datepicker/jquery-ui.css">
<link href="{{asset('backend/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

<!-- New Added Start -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('backend/plugins/date_range_picker/daterangepicker.css') }}">
<!-- New Added End -->
<style>
    @media print {
        #print_aria{
            -webkit-print-color-adjust: exact !important;
        }
    }
</style>
@stack('css')
