<div id="add_client" class="popup_container" style="display: none;">
  <div class="bg_popup"></div>
  <div class="inner_abs_popup">
    <div class="inner_box">
      <div class="title_popup">
        <div class="left"><h3>Add Client Name</h3></div>
        <div class="right"><a href="#" class="close_popup"><img src="images/material/icon_close.png"></a></div>
      </div><!--end.title_popup-->
      <div class="inline_rows">
        <input type="text" class="input_form" name="">
        <button type="submit" class="blue_bt2">Add</button>
      </div><!--end.inline_rows-->

      <div class="title_popup">
        <div class="left"><h3>Client name list</h3></div>
        <div class="right">
          <a href="#editClient" id="popupEdit" class="blueText popupShow hide">Edit</a>
          <a href="#confirmRemove" class="blueText hide popupShow" id="popupRemove">Remove</a>
        </div>
      </div><!--end.title_popup-->
      <div class="list_clientnya">
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Dentsu</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">KLY</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">TIKET</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">SemutApi</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">KANA</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Redcom</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Suntory</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Maja</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">KANA</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Redcom</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Suntory</span>
        </div><!--end.row_client-->
        <div class="row_client">
          <label class="container">
            <input type="checkbox" class="checkClient">
            <span class="checkmark"></span>
          </label>
          <span class="clientName">Maja</span>
        </div><!--end.row_client-->

      </div>

    </div>
  </div><!--end.inner_abs_popup-->
</div>

<div id=" editClient" class="popup_container" style="display: none;">
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
          <a href="#add_client" class="cancel_bt popupShow">Cancel</a>
          <button type="submit" class="blue_bt2" >Save</button>
        </div>
      </div>
    </div>
  </div><!--end.inner_abs_popup-->
</div>


<div id="confirmRemove" class="popup_container" style="display: none;">
  <div class="bg_popup"></div>
  <div class="inner_abs_popup">
    <div class="inner_box">
      <div class="content_popup">
        <div class="group_form">
          <h3>Apakah Anda yakin untuk menghapus 2 nama client ini?</h3>
        </div>
        <div class="group_form">
          <a href="#add_client" class="cancel_bt popupShow">Tidak</a>
          <a href="#add_client" class="blue_bt2 popupShow" >Ya</a>
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
        <div class="right"><a href="#" class="close_popup"><img src="images/material/icon_close.png"></a></div>
      </div><!--end.title_popup-->
      <div class="content_popup">
        <form action="video_input.php">
          <div class="icon_relative_upload">
            <img src="images/material/icon_upload.png" style="margin-bottom: 20px;">
            <input type="file" id="video_upload_popup" name="video_upload_popup" accept="video/*">
          </div>
          <div class="after_upload">
            <div class="prgoressBar">
              <div class="myBar"></div>
            </div>
            <span class="file-text-info">C:\fakepath\suntory.jpg</span>
            <span class="trash_icon" data-idFile="video_upload_popup"><img src="images/material/garbage.png"></span>
          </div>
          <p class="text_help">Drag and drop video files to upload </p>
          <div class="group_form">
            <button type="button" class="blue_bt2 trigger-upload" id="trigger_upload_video" data-inputId="video_upload">Select File</button>
            <button type="submit" class="blue_bt2 submit_upload hide" id="trigger_next_upload">Submit</button>
          </div>
        </form>
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
  /*$("#trigger_upload_video").click(function() {
      $("#video_upload").click();
  })*/

  function uploadFile(){
    $(".trigger-upload").click(function () {
      var inputId = $(this).attr("data-inputId");
      console.log(inputId)
      $("#"+inputId).click();
      $("#"+inputId).change(function () {
        var parentRow = $(this).closest(".content_popup");
        var progressbar = $(parentRow).find(".myBar");
        if($(this).val()==''){

          $(parentRow).find(".file-text-info").html($(this).val());
          $(parentRow).find(".trash_icon").removeClass("activated");
          $(parentRow).find(".file-text-info").removeClass("activated");
          $(parentRow).find(".prgoressBar").removeClass("activated");
          $(parentRow).find('.icon_relative_upload').removeClass("hide");
          $(parentRow).find(".text_help").removeClass("hide");
          $(parentRow).find(".submit_upload").addClass("hide");
          $(parentRow).find(".trigger-upload").removeClass("hide");
        }else{
          $(parentRow).find(".text_help").addClass("hide");
          $(parentRow).find(".prgoressBar").addClass("activated");
        $(parentRow).find(".file-text-info").html($(this).val());
        $(parentRow).find('.icon_relative_upload').addClass("hide");
          $(parentRow).find(".submit_upload").removeClass("hide");
          $(parentRow).find(".trigger-upload").addClass("hide");

          var id = setInterval(frame, 10);
          var percentBar = 1;
        function frame() {
          if (percentBar >= 100) {
            clearInterval(id);
            $(parentRow).find(".prgoressBar").removeClass("activated");
              $(parentRow).find(".trash_icon").addClass("activated");
              $(parentRow).find(".file-text-info").addClass("activated");
              
          } else {
            percentBar++; 
            //progressbar.style.width = width + '%';
            $(progressbar).css({width : percentBar +"%"});
                $(parentRow).find(".file-text-info").removeClass("activated");
                $(parentRow).find(".trash_icon").removeClass("activated");
          }
        }
          
        }
        //console.log($(this).parent());
      });
    })


    $(".trash_icon").click(function () {
      var inputId = $(this).attr("data-idFile");
      $("#"+inputId).val('');
      var parentRow = $(this).closest(".content_popup");
      $(parentRow).find(".file-text-info").html($(this).val());
      $(parentRow).find(".trash_icon").removeClass("activated");
      $(parentRow).find(".file-text-info").removeClass("activated");
      $(parentRow).find('.icon_relative_upload').removeClass("hide");
      $(parentRow).find(".submit_upload").addClass("hide");
      $(parentRow).find(".text_help").removeClass("hide");
      $(parentRow).find(".trigger-upload").removeClass("hide");
      $(this).removeClass("activated");
    });
  }


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
  $(document).ready(function() {

    $('input[class="checkClient"]').click(function(){
        var checkedNum = $('input[class="checkClient"]:checked').length;
          if(checkedNum == 1){
            $("#popupEdit").removeClass("hide");
            $("#popupRemove").removeClass("hide");
          }
          else if(checkedNum > 1){
            $("#popupEdit").addClass("hide");
            $("#popupRemove").removeClass("hide");
          }
          else{
            $("#popupEdit").addClass("hide");
            $("#popupRemove").addClass("hide");
          }

      });
    uploadFile();
    var checkedNum = $('input[class="checkClient"]:checked').length;
    if (!checkedNum) {
        // User didn't check any checkboxes
    }
  });
</script>






















