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
<title>Shopback</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta property="og:title" content="One apps">
<meta property="og:description" content="">
<link rel="icon" href="images/material/favicon.ico">
<!--Style-->
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<!--link rel="stylesheet" href="css/jquery.bxslider.min.css"-->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/media1024.css"/>
<link rel="stylesheet" type="text/css" href="css/media768.css"/>
<link rel="stylesheet" type="text/css" href="css/media480.css"/>
<link rel="stylesheet" type="text/css" href="css/media320.css"/>
<!--link rel="stylesheet" href="css/style-temp.css"-->
<!--js-->
<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="js/source/jquery.fancybox.js?v=2.1.5"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--script src="js/jquery.bxslider.min.js"></script-->
<script src="js/owl.carousel.min.js"></script>
<!--CDN link for  TweenMax-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/js_lib.js"></script>
<script src="js/js_run.js"></script>
</head>
<body>

<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]--> 

<!-- header -->
<header id="mainHeader" <?php if($page == 'dashboard') { echo "class=h_dashboard"; } ?>>
	<div id="login_header" <?php if($page !== 'loginPage') { echo "class=hidden"; } ?>>
		<div class="wrapper">
			<div class="logo"><img src="images/material/logo.png"></div>
		</div><!--end.wrapper-->
	</div>

	<div id="dashboard_header" <?php if($page !== 'dashboard') { echo "class=hidden"; } ?>>
		<div class="wrapper">
			<div class="logo"><img src="images/material/logo.png"></div>
			<div class="profile_log">
				<div class="profile_head" id="trigger_drop">
					<div class="circle_thumb">
						<img class="object_fit" src="images/content/profpic_top.png">
					</div>
					<span class="nameUser">Raisa Dwinara</span>
					<span class="arrow"><img src="images/material/arrow_down.png"></span>
				</div>
                <div class="dropdownMenu_header" style="display: none;">
                  <a href="profile_dashboard.php"><img src="images/material/icon_profile_drop.png"> <span>Profile </span></a>
                
                  <a href="change_password_dashboard.php" ><img src="images/material/icon_changePassword_drop.png"> <span> Change Password </span></a>
                
                  <a href="index.php"><img src="images/material/icon_logout.png"> <span> Log out</span></a>
                </div>
			</div><!--emd.profile_log-->
		</div><!--end.wrapper-->
	</div>
</header>
<!-- end of header -->