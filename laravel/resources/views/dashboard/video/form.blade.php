
@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">

        <a href="{{ url("cms/video")}}" class="row_menu">
        <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_back.png') }}">
          <span>Video List</span>
        </a>

        <a href="{{ url("cms/video/detail/") }}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_detail.png') }}">
          <span>Detail</span>
        </a>
        <a href="{{ url("cms/video/analitik/") }}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_analytic.png') }}">
          <span>Analytics</span>
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch">
        <h3>Input Video</h3>
        <div class="right_upload">
          <a href="#" class="blue_bt2">Publish</a>
        </div><!--end.right_upload-->
      </div>

      <div class="rows">
        <div class="content_video_input">
          <div class="form_left">
            <div class="group_line">
              <label class="label_line" for="title">
                <span> Title (required) </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title=" Title is for giving information what this ads is about. By giving title, your campaign will be easy to find and search, and give good presentation to your client.">
              </label>
              <input type="text" id="title" class="input_noline" value="{{ ( old('title') ? old('title') : ( (isset($data['title'])) ? $data['title'] : '') ) }}"  name="title">
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="description">
                <span> Description</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title=" Description is to explain about what this campaign is about, and give clear information about the story of this campaign.">
              </label>
              <textarea id="description" rows="5" name="description" cols="50" class="input_noline">{{ ( old('description') ? old('description') : ( (isset($data['description'])) ? $data['description'] : '') ) }}</textarea>
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Brand</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}">
              </label>
              <input type="text" id="brand" class="input_noline"  name="brand"  value="{{ ( old('brand') ? old('brand') : ( (isset($data['brand'])) ? $data['brand'] : '') ) }}"  title="Brand is to give an information about what brand is on this ads campaign, by giving this information it will make your report clear and easy to find">
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Client Name</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="This is for input your clients name. For example the Agency name. 'ex - Ogilvy'">
              </label>
              <div class="inline_form">
                <div class="custom-select">
                  <select name="slct" id="slct">
                    <option selected>Choose client name</option>
                    @foreach ($client as $row)
                        <option value="{!! $row['id'] !!}">{!! $row['name'] !!}</option>
                    @endforeach
                  </select>
                </div>
                <span>Or</span>
                <a href="#add_client" class="bt_white popupShow">Add Client</a>
              </div><!--end.inline_form-->
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Upload Video </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}">
              </label>
              <div class="inline_form">
                <input type="file" id="video_upload" name="">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Upload Background Template </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Background size must be 360 x 640">
              </label>
              <div class="inline_form">
                <input type="file" id="bg_upload" name="">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->


            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Upload Cover Video </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Select or upload a picture that shows what's in your video size must be 360 x 178">
              </label>
              <div class="inline_form">
                <input type="file" id="cover_video" name="">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->




            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Insert target views</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Insert the number that were given by your client that they spend off for this campaign ">
              </label>
              <input type="text" id="brand" class="input_noline"  name="">
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Schedule</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title=" Set time when your campaign will start to publish">
              </label>
              <p>Select a date to publish your video </p>
              <div class="inline_form">
                <input type="text" class="input_form" name="from" id="from">
                <span>s/d</span>
                <input type="text" class="input_form" id="to" name="to">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->
          </div><!--end.form_left-->

          <div class="form_right">
            <div class="preview_box">
              <div class="template_img">
                <img id="main_images" src="{{ asset('dashboard/images/material/bg_template.jpg') }}">
              </div>
              <div class="cover_video">
                <img id="img_cover" src="{{ asset('dashboard/images/material/thumb_video_dummy.jpg') }}">
              </div>
            </div>
          </div><!--end.form_right-->
        </div><!--end.content_video_input-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
@endsection
@section('javascript')

<script type="text/javascript">

  $( function() {

    $( document ).tooltip();

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
@endsection
@extends('dashboard.layouts.popup')
