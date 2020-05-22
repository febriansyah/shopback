

    $(".trigger-upload").click(function () {
      var inputId = $(this).attr("data-inputId");
        $("#"+inputId).trigger('click');

    })
    $("#video_upload_popup").change(function (e) {
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
            var _validFileExtensions = [".avi", ".mp4"];
            var sFileName = $(this).val();
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }


                if (!blnValid) {
                    $('.info-msg').html('format video salah (".avi atau .mp4")');
                    $(this).val("");
                    return false;
                }else{

                    var file = e.currentTarget.files[0];

                    objectUrl = URL.createObjectURL(file);

                    $("#vidcheck").attr("src", objectUrl);
                    var seconds="";
                    var filesize = file.size/1024/1024;
                    if(filesize > 3){
                        $('.info-msg').html('maksimal size 3 MB');
                        $(this).val("");
                        return false;
                    }else{
                        setTimeout(function(){
                            var seconds = $("#vidcheck")[0].duration;
                            console.log($("#vidcheck")[0].duration);
                            if (seconds > 6){
                                $('.info-msg').html('maksimal durasi 30 detik');
                                $(this).val("");
                                return false;
                            } else{
                                $(parentRow).find(".text_help").addClass("hide");
                                $(parentRow).find(".prgoressBar").addClass("activated");
                                $(parentRow).find(".file-text-info").html($("#video_upload_popup").val());
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
                         }, 300);
                    }




                }
            }


            /*
           */

        }
        //console.log($(this).parent());
      });
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
        $('.info-msg').html('Drag and drop video files to upload');
        $(this).removeClass("activated");
      });


    function ValidateVideoInput(oInput) {
        if (oInput.type == "file") {
            var _validFileExtensions = [".avi", ".mp4"];
            var sFileName = oInput.value;
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }


        $(".videoPopup").click(function(e) {
          e.preventDefault();
          $(".popup_container").hide();
          $('#upload_video').show();
        });
        $(".close_popup_video").on('click', function(e){
          e.stopPropagation();
            $(".popup_container").hide();
        });

