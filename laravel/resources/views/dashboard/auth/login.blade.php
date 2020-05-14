@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="wrapper">
    <div class="section_login">
      <div class="right_login">
        <div class="login_inner">
          <h3>Hello, have a good day</h3>
          <p>Its a fresh new day so, lets sell some stuff, and get shopback for a good start.</p>
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
            <form action="{{ route('dashboard.auth.login') }}" method="POST">
                @csrf
              <div class="group_form">
                <input type="email" class="line_form" name="email" value="{{ old('email') }}"  placeholder="Email">
              </div>
              <div class="group_form">
                <input type="password" class="line_form" name="password" value="{{ old('password') }}" placeholder="Password">
                <div class="inner_group">
                  <div class="left checkboxLeft">
                      <input type="checkbox" value="1" name="remember_me" id="rememberMe">
                     <span for="rememberMe">Remember me</span>
                  </div>
                  <div class="right">
                    <a href="#" class="forgot">Forgot password? </a>
                  </div>
                </div><!--end.inner_group-->
              </div><!--emd.group_form-->

              <div class="group_form bt_group">
                <button type="submit" class="blue_bt">Login</button>
              </div><!--emd.group_form-->
              <div class="group_form">
              <p> Want to join the force? You can <a href="{{ url('cms/register')}}" class="blue_text">register here</a></p>
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
