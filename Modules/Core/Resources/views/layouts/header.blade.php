<!DOCTYPE html>
<html lang="en">
<head id="header_aria">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="nofollow">
    <meta name="googlebot" content="noindex">
    <title>{{$title??''}} | Dashboard</title>
    <script>
        (function(){
            window.Laravel = {
                csrfToken: '{{ csrf_token() }}'
            };
        })();
    </script>
    <noscript>
        <h1>This page needs JavaScript activated to work.</h1>
        <style>div,footer.main-footer { display:none; }</style>
    </noscript>
    @include('core::layouts.include.css')
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">

