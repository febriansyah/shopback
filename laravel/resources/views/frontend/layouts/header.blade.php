<!doctype html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166080091-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166080091-1');
</script>

<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>video ads</title>
<script src="{{ asset('frontend/js/jquery-1.10.0.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
body{
	text-align:center;
	font-family: 'Roboto', sans-serif;
	font-size:14px;
	margin:0;
	padding:0;
}
img {
	border: 0;
	max-width: 100%;
	height: auto;
	margin-bottom: -3px
}
*, *:before, *:after {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	outline: none;
}
#canvas_banner{
	max-width: 600px;
	position: relative;
	margin: 0 auto;
	background: #000;
}
.abs_top{
	position: absolute;
	width: 100%;
	top: 0;
	left: 0;
}
.inside_abs{
	padding:40px 20px;
	text-align: center;
}
.img_text{
	display: inline-block;
}
.abs_bottom{
	position: absolute;
	width: 100%;
	bottom: 0;
	left: 0;
}
.inside_abs_bottom{
	padding: 4em 3em;
	text-align: center;
}
.button_hold{
	display: inline-block;
	font-weight: 400;
	width: 80%;
	border-radius: 10px;
	padding:15px 20px;
	text-align: center;
	cursor: pointer;
	-webkit-touch-callout: none;                /* prevent callout to copy image, etc when tap to hold */
    -webkit-user-select: none;
    text-transform: uppercase;
    color: #fff;
    font-size: 18px;
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fcb14b+0,f47e3b+100 */
background: #fcb14b; /* Old browsers */
background: -moz-linear-gradient(left, #fcb14b 0%, #f47e3b 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, #fcb14b 0%,#f47e3b 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, #fcb14b 0%,#f47e3b 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcb14b', endColorstr='#f47e3b',GradientType=1 ); /* IE6-9 */                 /* prevent copy paste, to allow, change 'none' to 'text' */

}
.frame_video{
	display: block;
	position: relative;
	background: #eaeaea;
}
.vid_cover{
	position: absolute;
	width: 100%;
	z-index: 2;
	top: 0;
	left: 0;
}
.vid_cover img{
	width: 100%;
}
.overflow{
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	margin: auto;
	background: rgba(0,0,0,0.6);
	z-index: 2;
	position: absolute;
	display: none;
}
.loader_gif{
	position: absolute;
	z-index: 3;
	top: 0;
	left: 0;
	text-align: center;
	width: 100%;
	padding-top: 20%;
}
.loader_gif img{
	display: inline-block;
	width:50px;
}
.close_button{
	display: inline-block;
	width:30px;
	height: 30px;
	border-radius: 50%;
	text-align: center;
	line-height: 25px;
	color: #fff;
	font-size: 15px;
	position: absolute;
	right: 10px;
	top: 10px;
	z-index: 99;
	background: #000;
	border:1px solid #fff;
}
.popup_upload {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 999;
    text-align: center;
    display: none;
}
.bg-popup {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    padding: 20px;
    box-sizing: border-box;
    background-color: rgba(0, 0, 0, 0.8);
    text-align: center;
}
.content-popup {
    position: absolute;
    left: 0;
    top:5vh;
    text-align: center;
    width: 100%;
}
.inner_popup {
    position: relative;
    max-width: 700px;
    background: #fff;
    display: inline-block;
    padding: 20px 40px;
    border-radius: 20px;
    z-index: 9999;
    text-align: left;
}
.form_group {
    display: block;
    width: 100%;
    overflow: hidden;
}
.submit_bt {
    float: left;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    font-size: 15px;
    color: #fff;
    background: #f99f19;
    border:none;
    border-radius: 20px;
}
.close_popup {
    float: right;
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    font-size: 15px;
    color: #fff;
    background: #ccc;
    border-radius: 20px;
    text-decoration: none;
}
.abs_videos{
	position: absolute;
	width: 100%;
	padding: 40px;
	top: 25vh;
	left: 0;
}
.video_wrapper{
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	height: 0;
}
.video_wrapper video {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}
.img_background{
	display: block;
	width: 100%;
}
.img_background img{
	width: 100%;
}
.bg_play{
	background: rgba(0,0,0,0.8);
	position: fixed;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	z-index: 99;
}
.abs_icon{
	position: absolute;
	width: 100%;
	text-align: center;
	top: 20%;
	left: 0;
	z-index: 100;
}
.icon_play{
	display: inline-block;
	max-width: 100px;
}
.video_cover{
	position: absolute;
	width: 100%;
	z-index: 3;
	left: 0;
	top: 0;
}
</style>

<script type="text/javascript">
function setHeight(videoHeight){
	var myvideo = document.getElementById("videoXl")
	myvideo.setAttribute("height", "videoHeight");
}

function setVideoInfo( videoUrl, videoThumb){
    console.log('video');
    console.log(videoUrl);
	var myvideo = document.getElementById("videoXl");
	myvideo.setAttribute("src", videoUrl);
	myvideo.setAttribute("poster", "");
	myvideo.setAttribute("type", "video/mp4");
}
</script>
</head>
<body>
