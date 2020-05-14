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

  <div id="sendUrl" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup noBorder">
          <div class="left">
            <h3> Share Link URL</h3>
          </div>
          <div class="right"><a href="#" class="close_popup"><img src="{{ asset('dashboard/images/material/icon_close.png') }}"></a></div>
        </div><!--end.title_popup-->
        <div class="content_popup">
          <img src="{{ asset('dashboard/images/material/icon_popup_shareLink.png') }}" style="margin-bottom: 20px;">
          <div class="group_form">
            <input type="email" class="input_form" name="" id="emailpopup">
          </div>
          <div class="group_form">
            <button type="submit" class="blue_bt2" disabled id="sendUrlMail">Submit</button>
          </div>
        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>





















