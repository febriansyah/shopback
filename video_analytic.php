<?php $page = "dashboard"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">

        <a href="video_list.php" class="row_menu">
          <img class="icon_menu" src="images/material/icon_back.png">
          <span>Video List</span> 
        </a>
        <div class="row_vid_info">
          <div class="thumb_video">
            <img src="images/material/thumb_video.png">
          </div>
          <div class="caption_video">
            <h3>Video</h3>
            <p>Good Mood - Tajir melintir</p>
          </div>
        </div>

        <a href="video_input.php" class="row_menu">
          <img class="icon_menu" src="images/material/icon_detail.png">
          <span>Detail</span> 
        </a>
        <a href="#" class="row_menu active">
          <img class="icon_menu" src="images/material/icon_analytic.png">
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
            <span class="date_rangenya">24 - 30 April, 2020</span>
            <div class="custom-select">
              <select name="slct" id="slct">
                <option selected value="0"> Last 7 days</option>
                <option value="1"> Last 30 days</option>
                <option value="2"> Last 90 days</option>
                <option value="2"> Last 365 days</option>
              </select>
            </div>
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
                    <span class="numbering">1.200.000</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Target Views</span>
                    <span class="numbering">1.500.000</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Unique Visitors</span>
                    <span class="numbering">1.500.000</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">100% View</span>
                    <span class="numbering">150.000</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Avg. Watch Time</span>
                    <span class="numbering">120 Hours</span>
                  </div><!--end.inline_row-->
                </div>
                <div class="right">
                  <span class="info_update">Updated Apr 30, 2020, 2:00 PM </span>
                  <div class="dropdownMenu">
                    <a href="#" class="trigger_dropdown blue_bt2">Share report  <img src="images/material/arrow_bottom.png"></a>
                    <div class="dropdownMenu_expand" style="display: none;">
                      <a href="#"><img src="images/material/icon_download.png"> <span>Download </span></a>
                    
                      <a href="#sendUrl" class="popupShow"><img src="images/material/icon_sendlink.png"> <span>Send Link URL</span></a>
                    
                      <a href="#" id="copyURl"><img src="images/material/icon_copy.png"> <span>Copy Link URL </span></a>
                      
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
                    <img src="images/material/geography.jpg">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3>View by genders </h3>
                  </div>
                  <div class="content_box">
                    <img src="images/material/view_genders.jpg">
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
                    <img src="images/material/audience.png">
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
<input type="hidden" id="input-url" value="Copied!">
<script type="text/javascript">

$(document).ready(function() {     
var clipboard = new Clipboard('#copyURl', {
    text: function() {
        return document.querySelector('input[type=hidden]').value;
    }
});
clipboard.on('success', function(e) {
  alert("Link Copied!");
  e.clearSelection();
});
$("#input-url").val(location.href);
//safari
if (navigator.vendor.indexOf("Apple")==0 && /\sSafari\//.test(navigator.userAgent)) {
   $('#copyURl').on('click', function() {
var msg = window.prompt("Copy this link", location.href);

});
  }

} );
  

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
<!-- end of middle -->
<?php include('inc_footer.php');?>
<?php include('popup.php');?>