
@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="{!! route('dashboard.users.profile') !!}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_profile.png') }}">
          <span>Profile</span>
        </a>
        <a href="{!! route('dashboard.users.change_password') !!}" class="row_menu active">
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
            <form action="{{ route('dashboard.users.change_password') }}" method="POST">
                @csrf
            <div class="group_form">
              <label class="lab_form"> Current Password  </label>
              <input type="password" class="input_form" name="password_old">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form"> New Password  </label>
              <input type="password" class="input_form" name="password">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form"> Verify New Password  </label>
              <input type="password" class="input_form" name="password_confirmation">
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
