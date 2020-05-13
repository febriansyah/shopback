<?php $page = "dashboard"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="profile_dashboard.php" class="row_menu active">
          <img class="icon_menu" src="images/material/icon_profile.png">
          <span>Profile</span> 
        </a>
        <a href="change_password_dashboard.php" class="row_menu">
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
              <label class="lab_form">Profile picture</label>
              <div class="thumb_big">
                <div class="circle_big_thumb"><img class="object_fit" id="circleProfpic" src="images/content/big_profpic.png"></div>
                <div class="icon_cam" id="trigger_upload"><img src="images/material/icon_cam.png"></div>
              </div>

              <input type="file" id="profPic" style="display: none;" name="">
            </div>
            <div class="group_form">
              <label class="lab_form"> Full name </label>
              <input type="text" class="input_form" name="" value="Raisa Dwirama">
            </div><!--end.group_form-->
            <div class="group_form">
              <label class="lab_form">  E-mail address </label>
              <input type="email" class="input_form" name="" value=" Raisa.dwirama@gmail.com">
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
<?php include('inc_footer.php');?>