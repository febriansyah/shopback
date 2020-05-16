<?php $page = "loginPage"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="wrapper">
    <div class="section_login">
      <div class="right_login">
        <div class="login_inner">
          <h3>Hello, have a good day</h3>
          <p>Its a fresh new day so, lets sell some stuff, and get shopback for a good start.</p>
          <div class="login_form">
            <form action="home_dashboard.php">
              <div class="group_form">
                <input type="email" class="line_form" name="" placeholder="Email">
              </div>
              <div class="group_form">
                <input type="password" class="line_form" name="" placeholder="Password">
                <div class="inner_group">
                  <div class="left checkboxLeft">
                      <input type="checkbox" value="lsRememberMe" id="rememberMe"> 
                     <span for="rememberMe">Remember me</span>
                  </div>
                  <div class="right">
                    <a href="forgot.php" class="forgot">Forgot password? </a>
                  </div>
                </div><!--end.inner_group-->
              </div><!--emd.group_form-->

              <div class="group_form bt_group">
                <button type="submit" class="blue_bt">Login</button>
              </div><!--emd.group_form-->
              <div class="group_form">
                <p> Want to join the force? You can <a href="register.php" class="blue_text">register here</a></p>
              </div>
            </form>
          </div><!--end.login_form-->
        </div><!--end.login_inner-->
      </div><!--emd.right_login-->
    </div>
  </div><!--end.wrapper-->
</div>
<!-- end of middle -->
<?php include('inc_footer.php');?>