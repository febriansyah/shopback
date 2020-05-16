<?php $page = "loginPage"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="wrapper">
    <div class="section_login">
      <div class="right_login">
        <div class="login_inner">
          <h3>Confirm yor new password</h3>
          <p>Input your new password and try to login again</p>
          <div class="login_form">
            <form>
              <div class="group_form">
                <input type="password" class="line_form" name="" placeholder="Password from email">
              </div> 
              <div class="group_form">
                <input type="password" class="line_form" name="" placeholder="New Password">
              </div> 
              <div class="group_form">
                <input type="password" class="line_form" name="" placeholder="Confirm New Password">
              </div>

              <div class="group_form bt_group">
                <button type="submit" class="blue_bt">Submit</button>
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
<?php include('inc_footer.php');?>