<div id="editClient" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup noBorder">
          <div class="left">
            <h3> Edit Client Name</h3>
          </div>
          <div class="right"><a href="#" class="close_popup"><img src="images/material/icon_close.png"></a></div>
        </div><!--end.title_popup-->
        <div class="content_popup">
          <div class="group_form">
            <input type="text" class="input_form" name="" id="clientEdit" value="Semut Api">
          </div>
          <div class="group_form">
            <a href="#add_client" class="cancelBt popupShow">Cancel</a>
            <button type="submit" class="blue_bt2" >Save</button>
          </div>
        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>



<div id="upload_video" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup noBorder">
          <div class="left">
            <h3>Upload Video</h3>
          </div>
          <div class="right"><a href="#" class="close_popup_video"><img src="{{ asset('dashboard/images/material/icon_close.png') }}"></a></div>
        </div><!--end.title_popup-->
        <div class="content_popup">
          <form action="{{url('cms/video/upload')}}"  method="post" accept-charset="utf-8" id="form-data" role="form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="icon_relative_upload">
              <img src="{{ asset('dashboard/images/material/icon_upload.png') }}" style="margin-bottom: 20px;">
              <input type="file" id="video_upload_popup" name="video" accept="video/*">
              <video controls width="500px" id="vidcheck" src="" style="display: none"></video>
            </div>
            <div class="after_upload">
              <div class="prgoressBar">
                <div class="myBar"></div>
              </div>
              <span class="file-text-info">C:\fakepath\suntory.jpg</span>
              <span class="trash_icon" data-idFile="video_upload_popup"><img src="{{ asset('dashboard/images/material/garbage.png') }}"></span>
            </div>
            <p class="text_help info-msg">Drag and drop video files to upload </p>
            <div class="group_form">
              <button type="button" class="blue_bt2 trigger-upload" id="trigger_upload_video" data-inputId="video_upload_popup">Select File</button>
              <button type="submit" class="blue_bt2 submit_upload hide" id="trigger_next_upload">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>


















