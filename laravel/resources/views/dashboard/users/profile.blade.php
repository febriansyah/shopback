@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="{!! route('dashboard.users.profile') !!}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_profile.png') }}">
          <span>Profile</span>
        </a>
        <a href="{!! route('dashboard.users.change_password') !!}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_change_password.png') }}">
          <span>Change Password</span>
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_title">
        <h3>Profile</h3>
        <a href="{{ url('cms') }}" class="back_bt">< Back to dashboard</a>
      </div>

      <div class="rows">
        <div class="content_profile">
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
            <form action="{{ route('dashboard.users.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="group_form">
              <label class="lab_form">Profile picture</label>
              <div class="thumb_big">
                <div class="circle_big_thumb">
                    @if($data->photo!='')

                    <img class="object_fit"  id="circleProfpic" src="{{ upload_url('users/'.$data->photo) }}">
                    @else
                    <img class="object_fit"  id="circleProfpic" src="{{ asset('dashboard/images/content/big_profpic.png') }}">

                    @endif

                </div>
                <div class="icon_cam" id="trigger_upload">
                    <img src="{{ asset('dashboard/images/material/icon_cam.png') }}">

                </div>
              </div>
              <input type="file" id="profPic" style="display: none;" name="photo">
            </div>
            <div class="group_form">
              <label class="lab_form"> Full name </label>
              <input type="text" class="input_form" name="full_name" value="{!! $data->full_name !!}">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form">  E-mail address </label>
              <input type="email" class="input_form" name="email" value="{!! $data->email !!}">
            </div><!--end.group_form-->
            <div class="group_form">
              <button type="submit" class="blue_bt2">Save</button>
            </div>
          </form>
        </div><!--edm.content_dashboard-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
<!-- end of middle -->
@endsection
@section('javascript')
<script type="text/javascript">
    $("#trigger_upload").click(function() {
        $("#profPic").click();
    })
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#circleProfpic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#profPic").change(function() {
      readURL(this);
    });
    </script>
@endsection
