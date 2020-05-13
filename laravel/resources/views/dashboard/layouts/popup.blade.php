<div id="add_client" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup">
          <div class="left"><h3>Add Client Name</h3></div>
          <div class="right"><a href="#" class="close_popup"><img src="{{ asset('dashboard/images/material/icon_close.png') }}"></a></div>
        </div><!--end.title_popup-->
        <div class="inline_rows">
          <input type="text" class="input_form" name="">
          <button type="submit" class="blue_bt2">Add</button>
        </div><!--end.inline_rows-->

        <div class="title_popup">
          <div class="left"><h3>Client name list</h3></div>
          <div class="right">
            <a href="#editClient" class="blueText popupShow">Edit</a>
            <a href="#" class="blueText">Remove</a>
          </div>
        </div><!--end.title_popup-->
        <div class="list_clientnya">
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Dentsu</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">KLY</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">TIKET</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">SemutApi</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">KANA</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Redcom</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Suntory</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Maja</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">KANA</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Redcom</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Suntory</span>
          </div><!--end.row_client-->
          <div class="row_client">
            <label class="container">
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <span class="clientName">Maja</span>
          </div><!--end.row_client-->

        </div>

      </div>
    </div><!--end.inner_abs_popup-->
  </div>

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
          <div class="right"><a href="#" class="close_popup"><img src="images/material/icon_close.png"></a></div>
        </div><!--end.title_popup-->
        <div class="content_popup">
          <img src="images/material/icon_popup_shareLink.png" style="margin-bottom: 20px;">
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

  <script type="text/javascript">
    var emailInput =$("#email");
    var email_regex = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.(?:com|org|co.id|net|id))+$/;
    //var email_regex2 = /.com\s*$/;
    //var email_regex3 = /.net\s*$/;

    $('#emailpopup').bind('keyup blur',function(){
      var emailVal = $("#emailpopup").val();
      //console.log($('#email').val(emailVal.substring(emailVal.lastIndexOf('.'))));

      if (!$.trim($("#emailpopup").val()).length) {
        $('#sendUrlMail').attr('disabled', true);
      }

          else if(!(emailVal).match(mailformat)){
              $('#sendUrlMail').attr('disabled', true);
          }
          /*else if(!mailformat.test($("#email").val())){
              $('#nextPage4').attr('disabled', true);
          }*/
          /*else if (!/.com\s*$/|/.co.id\s*$/.test(emailVal) ){
            $('#nextPage4').attr('disabled', true);
          }*/
          else{
              $('#sendUrlMail').attr('disabled',false);
          }
      });
  </script>






















