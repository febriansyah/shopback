@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">

        <a href="{{ url('cms/video')}}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_back.png') }}">
          <span>Video List</span>
        </a>
        <div class="row_vid_info">
          <div class="thumb_video">
            <img src="{{ upload_url('video/'.$video->photo)}}">
          </div>
          <div class="caption_video">
            <h3>Video</h3>
            <p>{{ $video->title}}</p>
          </div>
        </div>

        <a href="{{ url('cms/video/detail/'.$video->id)}}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_detail.png') }}">
          <span>Detail</span>
        </a>
        <a href="{{ url('cms/analitik/'.$video->id)}}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_analytic.png') }}">
          <span>Analytics</span>
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch" style="border-bottom: none;">
        <h3> Video Analytic </h3>
        <div class="right">
          <div class="period">
            <div class="inline_form">
              <span>Periode:</span>
              <input type="text" class="input_form" name="from" id="from">
              <span>s/d</span>
              <input type="text" class="input_form" id="to" name="to">
              <a href="#" class="blue_bt2">Submit</a>
            </div><!--end.inline_form-->
          </div>
        </div>
      </div>

      <div class="rows">
        <div class="content_video_analytic">
          <div class="rows">
            <div class="box_analytic">
              <div class="row_top">
                <div class="left">
                  <div class="inline_row">
                    <span class="text_num">Total Views</span>
                    <span class="numbering">{{ number_format($total_view) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Target Views</span>
                    <span class="numbering">{{ number_format($video->target_view) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Unique Visitors</span>
                    <span class="numbering">{{ number_format($uniq_user) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">100% View</span>
                    <span class="numbering">{{ number_format('0') }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Avg. Watch Time</span>
                    <span class="numbering">{{ number_format($avg) }} Hours</span>
                  </div><!--end.inline_row-->
                </div>
                <div class="right">
                  <span class="info_update">Updated Apr 30, 2020, 2:00 PM </span>
                  <div class="dropdownMenu">
                    <a href="#" class="trigger_dropdown blue_bt2">Share report  <img src="{{ asset('dashboard/images/material/arrow_bottom.png') }}"></a>
                    <div class="dropdownMenu_expand" style="display: none;">
                      <a href="#"><img src="{{ asset('dashboard/images/material/icon_download.png') }}"> <span>Download </span></a>

                      <a href="#sendUrl" class="popupShow"><img src="{{ asset('dashboard/images/material/icon_sendlink.png') }}"> <span>Send Link URL</span></a>

                      <a href="#"><img src="{{ asset('dashboard/images/material/icon_copy.png') }}"> <span>Copy Link URL </span></a>
                    </div>
                  </div><!--end.dropdownMenu-->
                </div>
              </div><!--end.row_top-->

              <div class="chart_analytic">
                <img src="images/material/line_chart.png">
              </div>
            </div><!--end.box_analytic-->
          </div><!--end.rows-->
          <div class="rows">
            <div class="row-list">
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3>Geography</h3>
                  </div>
                  <div class="content_box">
                    <img src="{{ asset('dashboard/images/material/geography.jpg') }}">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3>View by genders </h3>
                  </div>
                  <div class="content_box">
                    <img src="{{ asset('dashboard/images/material/view_genders.jpg') }}">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
            </div><!--end.row-list-->
          </div>

          <div class="rows">
            <div class="row-list">
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3> Audience Retention</h3>
                  </div>
                  <div class="content_box">
                    <img src="{{ asset('dashboard/images/material/audience.pngg') }}">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
            </div><!--end.row-list-->
          </div><!--end.rows-->
        </div><!--end.content_video_input-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
@include('dashboard.layouts.popup')
@endsection
@section('javascript')
<script>

$( function() {

var dateFormat = "dd/mm/yy",
  from = $( "#from" )
    .datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
  to = $( "#to" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3
  })
  .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
  });

function getDate( element ) {
  var date;
  try {
    date = $.datepicker.parseDate( dateFormat, element.value );
  } catch( error ) {
    date = null;
  }

  return date;
}
} );
</script>
@endsection
