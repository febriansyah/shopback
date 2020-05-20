
@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        @if(isset($data))
            <a href="{{ url("cms/video")}}" class="row_menu">
            <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_back.png') }}">
            <span>Video List</span>
            </a>
            @if($data['photo'] !='' )
            <div class="row_vid_info">
                <div class="thumb_video">
                  <img src="{{ upload_url('video/'.$data['photo'])}}">
                </div>
                <div class="caption_video">
                  <h3>Video</h3>
                  <p>{{ $data['title'] }}</p>
                </div>
              </div>
            @endif
            <a href="{{ url("cms/video/detail/".$data['id']) }}" class="row_menu active">
            <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_detail.png') }}">
            <span>Detail</span>
            </a>
            <a href="{{ url("cms/analitik/".$data['id']) }}" class="row_menu">
            <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_analytic.png') }}">
            <span>Analytics</span>
            </a>
        @else
            <a href="{{ url("cms")}}" class="row_menu">
                <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_dashboard.png') }}">
                <span>Dashboard</span>
            </a>
            <a href="{{ url("cms/video")}}" class="row_menu active">
                <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_video.png') }}">
                <span>Video List</span>
            </a>
        @endif
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch">
        <h3>Input Video</h3>
        <div class="right_upload">
          <a href="#" class="blue_bt2 btn-submit-video">Publish</a>
        </div><!--end.right_upload-->
      </div>

      <div class="rows">
        <div class="row">
            <div class="col-md-12">
                <div class="form-message">
                    @if (session('form_message'))
                    <div class="alert alert-warning alert-rounded alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php
                    $msg =session('form_message')['message'];
                        $html = (is_array($msg)) ? implode('<br/ >', $msg) : $msg;
                        $html .= '</div>';
                        echo $html;
                    ?>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{ $form_action }}" method="post" accept-charset="utf-8" id="form-data" role="form" enctype="multipart/form-data">
            {!! csrf_field() !!}
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
                  <select name="client_id" id="slct">
                    <option selected>Choose client name</option>
                    @foreach ($client as $row)
                        <option value="{!! $row['id'] !!}"  {!! ( (old('client_id') && old('client_id') == $row['id']) ? 'selected="selected"' : (isset($data['client_id']) && $data['client_id'] == $row['id']) ? 'selected="selected"' : '') !!}>{!! $row['name'] !!}</option>
                    @endforeach
                  </select>
                </div>
                <span>Or</span>
                <a href="#add_client" class="bt_white popupClient">Add Client</a>
              </div><!--end.inline_form-->
            </div><!--end.group_line-->



            <div class="group_line"  style="display: none;">
              <label class="label_line" for="brand">
                <span> Upload Background Template </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Background size must be 360 x 640">
              </label>
              <div class="inline_form">
                <input type="file" id="bg_upload" name="background">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->


            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Upload Thumbnail Video </span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Select or upload a picture that shows what's in your video size must be 360 x 178">
              </label>
              <div class="inline_form">
                <input type="file" id="cover_video" name="photo">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->




            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Insert target views</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}" title="Insert the number that were given by your client that they spend off for this campaign ">
              </label>
              <input type="text" id="brand" class="input_noline" value="{{ ( old('target_view') ? old('target_view') : ( (isset($data['target_view'])) ? $data['target_view'] : '') ) }}"  name="target_view">
            </div><!--end.group_line-->

            <div class="group_line">
              <label class="label_line" for="brand">
                <span> Schedule</span>
                <img src="{{ asset('dashboard/images/material/icon_tanya.png') }}"  title=" Set time when your campaign will start to publish">
              </label>
              <p>Select a date to publish your video </p>
              <div class="inline_form">
                <input type="text" class="input_form"  value="{{ ( old('start_publish') ? old('start_publish') : ( (isset($data['start_publish'])) ? date('m/d/Y', strtotime($data['start_publish'])) : '') ) }}" name="start_publish" id="from">
                <span>s/d</span>
                <input type="text" class="input_form"  value="{{ ( old('end_publish') ? old('end_publish') : ( (isset($data['end_publish'])) ? date('m/d/Y', strtotime($data['end_publish'])) : '') ) }}" id="to" name="end_publish">
              </div><!--end.inline_form-->
            </div><!--end.group_line-->
        </form>
          </div><!--end.form_left-->


          <div class="form_right">
            <div class="preview_box">
              <div class="template_img">
                <img id="main_images" src="{{ ( (isset($data['background'])) ? upload_url('video/background/'.$data['background']) : '' )  }}">
              </div>
              <div class="cover_video">
                <img id="img_cover" src="{{ ( (isset($data['photo'])) ? upload_url('video/'.$data['photo']) :  asset('dashboard/images/material/thumb_video_dummy.jpg') )  }}">
              </div>
              <div class="upload_bg_abs">
                <button type="button" class="grey_bt" id="trigger_add_bg">Add Background </button>
                <span>Background size must be 360 x 640</span>
              </div>
            </div>
          </div><!--end.form_right-->
        </div><!--end.content_video_input-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
<div id="add_client" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup">
          <div class="left"><h3>Add Client Name w</h3></div>
          <div class="right"><a href="#" class="close_popup"><img src="{{ asset('dashboard/images/material/icon_close.png') }}"></a></div>
        </div><!--end.title_popup-->
        <div class="inline_rows">
          <input type="text" class="input_form client_add_name" name="client_add">
          <button type="submit" class="blue_bt2 action_add_client">Add</button>
        </div><!--end.inline_rows-->

        <div class="title_popup">
          <div class="left"><h3>Client name list</h3></div>
          <div class="right">
            <a href="#editClient" id="popupEdit" class="blueText popupEditClient hide">Edit</a>
            <a href="#confirmRemove" class="blueText hide action_remove_client" id="popupRemove">Remove</a>
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
            <input type="hidden" class="input_form" name="" id="idclientEdit" value="Semut Api">
          </div>
          <div class="group_form">
            <a href="#add_client" class="cancelBt popupShow">Cancel</a>
            <button type="submit" class="blue_bt2 action_edit_client" >Save</button>
          </div>
        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>
  @include('dashboard.layouts.popup')
@endsection
@section('javascript')

<script type="text/javascript">
    var url = '{{ url('') }}';
    var actionClient = '';
    var client_id = "{{ ( old('client_id') ? old('client_id') : ( (isset($data['client_id'])) ? $data['client_id'] : '') ) }}";
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
    $(".popupClient").click(function(e) {
        e.preventDefault();
        $.ajax({
                        type: "GET",
                        url : url + "/cms/client/list",
                    }).done(function(response){
                        var str='';

                        $.each(response.data,function(k,v){
                            str +=' <div class="row_client">'
                                        +'<label class="container">'
                                            +'<input type="checkbox"  value="'+v.id+'"  data-name="'+v.name+'" class="checkClient">'
                                            +'<span class="checkmark"></span>'
                                            +'</label>'
                                            +'<span class="clientName">'+v.name+'</span>'
                                            +'</div><!--end.row_client-->';

                        });

                        $('.list_clientnya').html(str);

                        $('#add_client').show();
                    });

    });
    $(document).on('click','.action_add_client',function(){
        $.ajax({
                type: "POST",
                url : url + "/cms/client/create",
                data: {
                        'name': $('.client_add_name').val()
                },
                dataType:'json'
        }).done(function(response){
            var str='';
            var strSleect =' <option>Choose client name</option>';
                        var selected='';
            $.each(response.data,function(k,v){
                str +=' <div class="row_client">'
                        +'<label class="container">'
                        +'<input type="checkbox" value="'+v.id+'"  data-name="'+v.name+'" class="checkClient">'
                        +'<span class="checkmark"></span>'
                        +'</label>'
                        +'<span class="clientName">'+v.name+'</span>'
                        +'</div><!--end.row_client-->';
                if(v.id==client_id){
                    selected='selected';
                }else{
                    selected ='';
                }
                strSleect +=' <option value="'+v.id+'">'+v.name+'</option>';

            });
            $('.list_clientnya').html(str);
            $('#slct').html(strSleect);
                        console.log( strSleect)
                        console.log( $('#slct'))
            $('#add_client').show();
        });

    })
    $(document).on('click','.action_edit_client',function(){
        $.ajax({
                type: "POST",
                url : url + "/cms/client/update",
                data: {
                        'id': $('#idclientEdit').val(),
                        'name': $('#clientEdit').val()
                },
                dataType:'json'
        }).done(function(response){
            var str='';
            var strSleect =' <option>Choose client name</option>';
                        var selected='';
            $.each(response.data,function(k,v){
                str +=' <div class="row_client">'
                        +'<label class="container">'
                        +'<input type="checkbox" value="'+v.id+'"  data-name="'+v.name+'" class="checkClient">'
                        +'<span class="checkmark"></span>'
                        +'</label>'
                        +'<span class="clientName">'+v.name+'</span>'
                        +'</div><!--end.row_client-->';
                if(v.id==client_id){
                    selected='selected';
                }else{
                    selected ='';
                }
                strSleect +=' <option value="'+v.id+'">'+v.name+'</option>';

            });
            $('.list_clientnya').html(str);
            $('#slct').html(strSleect);
            $(".popup_container").hide();
            $('#add_client').show();
        });

    });
    $(document).on('click','.action_remove_client',function(){

        var selected = new Array();
        var chks = $('.checkClient');
        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                selected.push(chks[i].value);
            }
        }
        $.ajax({
                type: "POST",
                url : url + "/cms/client/delete",
                data: {
                        'id': selected

                },
                dataType:'json'
        }).done(function(response){
            var str='';
            var strSleect =' <option>Choose client name</option>';
                        var selected='';
            $.each(response.data,function(k,v){
                str +=' <div class="row_client">'
                        +'<label class="container">'
                        +'<input type="checkbox" value="'+v.id+'"  data-name="'+v.name+'" class="checkClient">'
                        +'<span class="checkmark"></span>'
                        +'</label>'
                        +'<span class="clientName">'+v.name+'</span>'
                        +'</div><!--end.row_client-->';
                if(v.id==client_id){
                    selected='selected';
                }else{
                    selected ='';
                }
                strSleect +=' <option value="'+v.id+'">'+v.name+'</option>';

            });
            $('.list_clientnya').html(str);
            $('#slct').html(strSleect);
            $(".popup_container").hide();
            $('#add_client').show();
        });

    });
    $('.btn-submit-video').on('click',function(){
            console.log('submit');
            $('#form-data').trigger('submit');
            $(this).prop('disabled', true);
    })
    $(document).on('click','input[class="checkClient"]', function(){
        actionClient = $(this);
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
      $(document).on('click','.popupEditClient', function(){
        $(".popup_container").hide();
         $('#editClient').show();
        $('#clientEdit').val(actionClient.attr('data-name'));
        $('#idclientEdit').val(actionClient.val());

    });

  });
</script>
@endsection

