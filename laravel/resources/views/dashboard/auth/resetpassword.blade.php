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
            <form action="{{ route('dashboard.reset-password-post') }}" method="POST">
                @csrf

              <div class="group_form">
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="password" class="line_form" name="password" placeholder="Password">
              </div>
              <div class="group_form">
                <input type="password" class="line_form" name="password_confirmation" placeholder="Ulangi Password">
              </div>

              <div class="group_form bt_group">
                <button type="submit" class="blue_bt">Reset</button>
              </div><!--emd.group_form-->
              <div class="group_form">
                <p> Already have an account? <a href="index.php" class="blue_text">login here</a></p>
              </div>
            </form>
          </div><!--end.login_form-->
        </div><!--end.login_inner-->
      </div><!--emd.right_login-->
    </div>
  </div><!--end.wrapper-->
</div>
<!-- end of middle -->
@endsection
