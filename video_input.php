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

        <a href="#" class="row_menu active">
          <img class="icon_menu" src="images/material/icon_detail.png">
          <span>Detail</span> 
        </a>
        <a href="video_analytic.php" class="row_menu">
          <img class="icon_menu" src="images/material/icon_analytic.png">
          <span>Analytics</span> 
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch">
        <h3>Input Video</h3>
        <div class="right_upload">

          <a href="#" class="cancel_bt">Cancel</a>
          <a href="#" class="blue_bt2">Publish</a>
        </div><!--end.right_upload-->
      </div>
      
      <div class="rows">
        <div class="content_video_input">
          <div class="form_left">
            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="title">
                  <span> Title (required) </span>
                  <img src="images/material/icon_tanya.png" title=" Title is for giving information what this ads is about. By giving title, your campaign will be easy to find and search, and give good presentation to your client.">
                </label>
                <input type="text" id="title" class="input_noline"  name="">
              </div><!--end.group_line-->
              <span class="erorr_msg">Please insert title</span>
            </div><!--end.outher_group_line-->

            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="description">
                  <span> Description</span>
                  <img src="images/material/icon_tanya.png" title=" Description is to explain about what this campaign is about, and give clear information about the story of this campaign.">
                </label>
                <textarea id="description" rows="5" cols="50" class="input_noline"></textarea>
              </div><!--end.group_line-->
              <span class="erorr_msg">Please insert description</span>
            </div><!--end.outher_group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Brand</span>
                  <img src="images/material/icon_tanya.png" title="Brand is to give an information about what brand is on this ads campaign, by giving this information it will make your report clear and easy to find">
                </label>
                <input type="text" id="brand" class="input_noline"  name="" >
              </div><!--end.group_line-->
                <span class="erorr_msg">Please insert brand name</span>
            </div><!--end.outher_group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Client Name</span>
                  <img src="images/material/icon_tanya.png" title="This is for input your clients name. For example the Agency name. 'ex - Ogilvy'">
                </label>
                <div class="inline_form">
                  <div class="custom-select">
                    <select name="slct" id="slct">
                      <option selected>Choose client name</option>
                      <option value="1">Dentsu</option>
                      <option value="2">Tiket</option>
                    </select>
                  </div>
                  <span>Or</span>
                  <a href="#add_client" class="bt_white popupShow">Add Client</a>
                </div><!--end.inline_form-->
              </div><!--end.group_line-->
                <span class="erorr_msg"> Please choose client name</span>
            </div><!--end.outher_group_line-->


            <div class="group_line" style="display: none;">
              <label class="label_line" for="brand">
                <span> Upload Background Template </span>
                <img src="images/material/icon_tanya.png" title="Background size must be 360 x 640">
              </label>
              <div class="inline_form">
                <input type="file" id="bg_upload" name="" accept="image/*">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Upload Thumbnail Video </span>
                  <img src="images/material/icon_tanya.png" title="Select or upload a picture that shows what's in your video size must be 360 x 178">
                </label>
                <div class="inline_form">
                  <input type="file" id="cover_video" name="" accept="image/*">
                </div><!--end.inline_form-->
              </div><!--end.group_line-->
                <span class="erorr_msg">Please insert title</span>
            </div><!--end.outher_group_line-->

            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Insert URL background landing page</span>
                  <img src="images/material/icon_tanya.png" title="Insert the URL landing page for client ">
                </label>
                <input type="text" id="brand" class="input_noline"  name="">
              </div><!--end.group_line-->
                <span class="erorr_msg">Thumbnail Video must ( 360 X 178)</span>
            </div><!--end.outher_group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Insert target views</span>
                  <img src="images/material/icon_tanya.png" title="Insert the number that were given by your client that they spend off for this campaign ">
                </label>
                <input type="text" id="brand" class="input_noline"  name="">
              </div><!--end.group_line-->
              <span class="erorr_msg">Please insert target views</span>
            </div><!--end.outher_group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Insert target views per day</span>
                  <img src="images/material/icon_tanya.png" title="Insert the number that were given by your client that they spend off for this campaign each day of campaign ">
                </label>
                <input type="text" id="brand" class="input_noline"  name="">
              </div><!--end.group_line-->
               <span class="erorr_msg">target views per day must lower than target views</span>
            </div><!--end.outher_group_line-->


            <div class="outher_group_line">
              <div class="group_line error_line">
                <label class="label_line" for="brand">
                  <span> Schedule</span>
                  <img src="images/material/icon_tanya.png" title=" Set time when your campaign will start to publish">
                </label>
                <p>Select a date to publish your video </p>
                <div class="inline_form">
                  <input type="text" class="input_form" name="from" id="from">
                  <span>s/d</span>
                  <input type="text" class="input_form" id="to" name="to">
                </div><!--end.inline_form-->
              </div><!--end.group_line-->
              <span class="erorr_msg">Please insert schedule</span>
            </div><!--end.outher_group_line-->
          </div><!--end.form_left-->

          <div class="form_right">
            <div class="preview_box">
              <div class="template_img">
                <img id="main_images" src="">
              </div>
              <div class="cover_video">
                <img id="img_cover" src="images/material/thumb_video_dummy.jpg">
              </div>
              <div class="upload_bg_abs">
                <button type="button" class="grey_bt" id="trigger_add_bg">Add Background </button>
                <span>Background size must be 360 x 640</span>
                <span class="erorr_msg">Please background with equal size </span>
              </div>
            </div>
          </div><!--end.form_right-->
        </div><!--end.content_video_input-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>

<script type="text/javascript">

  $( function() {

    $( document ).tooltip();

    var dateToday = new Date();
    var dates = $("#from, #to").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        minDate: dateToday,
        onSelect: function(selectedDate) {
            var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);
        }
    });
    /*var dateToday = new Date();
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
          minDate: dateToday,
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
    }*/
  } );

  $("#trigger_add_bg").click(function() {
      $("#bg_upload").click();
  })
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#main_images').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function uploadCover(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#img_cover').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#cover_video").change(function() {
  uploadCover(this);
  });
  $("#bg_upload").change(function() {
  readURL(this);
  });
</script>
<!-- end of middle -->
<?php include('inc_footer.php');?>