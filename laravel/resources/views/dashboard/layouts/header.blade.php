<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Shopback</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta property="og:title" content="One apps">
<meta property="og:description" content="">
<link rel="icon" href="images/material/favicon.ico">
<!--Style-->
<link rel="stylesheet" href="{{ asset('dashboard/css/reset.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/js/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
<link rel="stylesheet" href="{{ asset('dashboard/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/css/owl.carousel.css') }}">
<!--link rel="stylesheet" href="css/jquery.bxslider.min.css"-->
<link rel="stylesheet" href="{{ asset('dashboard/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/media1024.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/media768.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/media480.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/media320.css') }}"/>
<!--link rel="stylesheet" href="css/style-temp.css"-->

</head>
<body>

<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<!-- header -->
<header id="mainHeader" @if($login==false) class="h_dashboard" @endif>
	<div id="login_header" @if($login==false) class="hidden" @endif>
		<div class="wrapper">
			<div class="logo"><img src="{{ asset('dashboard/images/material/logo.png') }}"></div>
		</div><!--end.wrapper-->
	</div>
    @if($login === false)
	<div id="dashboard_header" @if($login==true) class="hidden" @endif >
		<div class="wrapper">
			<div class="logo"><img src="{{ asset('dashboard/images/material/logo.png') }}"></div>
			<div class="profile_log">
				<div class="profile_head" id="trigger_drop">
					<div class="circle_thumb">
                        @if($users->photo!='')

                        <img class="object_fit" src="{{ upload_url('users/'.$users->photo) }}">
                        @else
                        <img class="object_fit" src="{{ asset('dashboard/images/content/profpic_top.png') }}">

                        @endif


					</div>
					<span class="nameUser">{{$users->full_name}}</span>
					<span class="arrow"><img src="{{ asset('dashboard/images/material/arrow_down.png') }}"></span>
				</div>
                <div class="dropdownMenu_header" style="display: none;">
                  <a href="{{ route('dashboard.users.profile') }}"><img src="{{ asset('dashboard/images/material/icon_profile_drop.png') }}"> <span>Profile </span></a>

                  <a href="{{ route('dashboard.users.change_password') }}" ><img src="{{ asset('dashboard/images/material/icon_changePassword_drop.png') }}"> <span> Change Password </span></a>

                  <a href="{{ route('dashboard.auth.logout') }}"><img src="{{ asset('dashboard/images/material/icon_logout.png') }}"> <span> Log out</span></a>
                </div>
			</div><!--emd.profile_log-->
		</div><!--end.wrapper-->
    </div>
    @endif
</header>
