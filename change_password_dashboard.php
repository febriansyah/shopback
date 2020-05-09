<?php $page = "dashboard"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="profile_dashboard.php" class="row_menu">
          <img class="icon_menu" src="images/material/icon_profile.png">
          <span>Profile</span> 
        </a>
        <a href="change_password_dashboard.php" class="row_menu active">
          <img class="icon_menu" src="images/material/icon_change_password.png">
          <span>Change Password</span> 
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_title">
        <h3>Profile</h3>
        <a href="home_dashboard.php" class="back_bt">< Back to dashboard</a>
      </div>
      
      <div class="rows">
        <div class="content_profile">
          <form>
            <div class="group_form">
              <label class="lab_form"> Current Password  </label>
              <input type="password" class="input_form" name="">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form"> New Password  </label>
              <input type="password" class="input_form" name="">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form"> Verify New Password  </label>
              <input type="password" class="input_form" name="">
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
<?php include('inc_footer.php');?>