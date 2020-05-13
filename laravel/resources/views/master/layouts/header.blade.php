<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CMS - Megazine</title>
    <meta name="description" content="@yield('head_description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="/favicon.png" />

    @stack('prepend_style')
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/icheck/skins/all.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/vendor.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/add.css') }}" />

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        var token_name="csrfToken";
        var token_key = {{csrf_token()}};

    </script>
    @stack('append_style')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="adminlte2 hold-transition {{ (request()->segment(2)) ? request()->segment(2). '-page' : 'home-page' }} {{ (request()->segment(2) != 'login') ? 'skin-blue sidebar-mini' : '' }}">
<div class="wrapper">
