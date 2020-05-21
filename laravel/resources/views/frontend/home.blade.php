@extends('frontend.layouts.template')

@section('content')
<div id="canvas_banner" class="fit_height" style="overflow: hidden;">
    <div class="abs_top">
        <div class="frame_video">
            <div class="img_background"><a href="#" target="_blank"><img src="{{ upload_url('video/background/'.$video->background) }}"></a></div>
            <div id="close_button" class="close_button" style="display: none;">x</div>
            <div id="closeEnded" style="display: none;" class="close_button trigger_close_all">x</div>
            <div class="abs_videos">
                <div style="position: relative;">
                    <div class="video_wrapper">
                        <video id="videoXl" src="{{ upload_url('video/video/adaptive_'.$video->video_name.'250.m3u8') }}"  type="application/x-mpegURL" width="100%" height="300px" align="middle"
                        preload="auto"  playsinline>
                        </video>
                        <div class="icon_fullscreen">
                            <button class="fullscreen" onclick="openFullscreen();"><img src="icon_fullscreen.png"></button>
                        </div>
                    </div>
                    <div class="video_cover">
                        <img src="{{ upload_url('video/'.$video->photo)}}" width="100%">
                    </div>
                    <div class="abs_icon">
                        <a href="#" id="trigger_play" class="icon_play"><img src="{{ asset('frontend/images/icon_play.png') }}"></a>
                    </div>
                </div>
            </div>
        </div><!--end.frame_video-->
        <div id="current" style="color: #fff; font-size: 18px; opacity: 0;position: absolute;">0:00</div><br>
        <div id="duration" style="color: #fff; font-size: 18px; opacity: 0;position: absolute;">0:00</div>
    </div><!--end.abs_top-->
</div>
<div id="modal_popup" class="popup_upload" style="">
  <div class="bg-popup"></div>
  <div class="content-popup">
    <div class="inner_popup">
      <div class="info_data">
        <p id="data-video" style="text-align: center;">anda yakin ingin menutup video ? <br> Jika anda tutup anda tidak akan mendapatkan voucher</p>

        <!--p id="data-video">anda telah menonton sampai detik: <span id="detik_video"></span></p-->
      </div>
      <div class="form_group">
        <button type="button" id="resumeVideo" class="submit_bt" style="float: left;">Resume</button>
        <a href="#" class="close_popup trigger_close_all">Close</a>
        <input type="hidden" name="statusupdate" value="0" class="statusupdate">
			<input type="hidden" name="idUnix" value="0" class="idUnix">
      </div>
    </div>
  </div>
</div>
<script>
var videourl ="{{ asset('frontend/video/video_web.mp4 ') }}";
var url ="{{url('')}}";
var videoId = "{{ $video->id }}";

var elemVid = document.getElementById("videoXl");
function openFullscreen() {
  if (elemVid.requestFullscreen) {
    elemVid.requestFullscreen();
  } else if (elemVid.mozRequestFullScreen) { /* Firefox */
    elemVid.mozRequestFullScreen();
  } else if (elemVid.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elemVid.webkitRequestFullscreen();
  } else if (elemVid.msRequestFullscreen) { /* IE/Edge */
    elemVid.msRequestFullscreen();
  }
}
</script>
@endsection
