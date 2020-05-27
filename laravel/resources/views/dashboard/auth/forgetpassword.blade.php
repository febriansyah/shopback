@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="wrapper">
    <div class="section_login">
      <div class="right_login">
        <div class="login_inner">
          <h3>Forgot your password?</h3>
          <p>Please input your email for rest the password.</p>
          <div class="login_form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-message">
                        @if (session('form_message')['status']=='danger')
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
            <form action="{{ route('dashboard.forgetpassword') }}" method="POST">
                @csrf
              <div class="group_form">
                <input type="email" class="line_form" name="email" placeholder="Email">
              </div>

              <div class="group_form bt_group">
                <button type="submit" class="blue_bt">Reset</button>
              </div><!--emd.group_form-->
              <div class="group_form">
                <p> Already have an account? <a href="{{url('cms')}}" class="blue_text">login here</a></p>
              </div>
            </form>
          </div><!--end.login_form-->
        </div><!--end.login_inner-->
      </div><!--emd.right_login-->
    </div>
  </div><!--end.wrapper-->
</div>
<!-- end of middle -->
<!-- end of middle -->
<div id="confirmRemove" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="content_popup">
          <div class="group_form">
            <h3 class="notif-remove">Proses Berhasil Coba cek email anda untuk reset password</h3>
          </div>

        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>
@endsection
@section('javascript')
<script type="text/javascript">
@if (session('form_message')['status']=='success')
    $('#confirmRemove').show();
@endif
</script>
@endsection
