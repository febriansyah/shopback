<?php $page = "dashboard"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="home_dashboard.php" class="row_menu">
          <img class="icon_menu" src="images/material/icon_dashboard.png">
          <span>Dashboard</span> 
        </a>
        <a href="#" class="row_menu active">
          <img class="icon_menu" src="images/material/icon_video.png">
          <span>Video List</span> 
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch">
        <h3>Video List </h3>
        <div class="input_search">
          <input type="text" name="" class="search" placeholder="Search">
        </div>
      </div>
      
      <div class="rows">
        <div class="content_video_list">
          <div class="left_action">
            <span>Sort By</span>
            <div class="custom-select">
              <select name="slct" id="slct">
                <option selected>All</option>
                <option value="1">Newest</option>
                <option value="2">Oldest</option>
              </select>
            </div>
          </div>
          <div class="right_upload">
            <a href="#upload_video" class="blue_bt2 popupShow">+ UPLOAD VIDEO</a>
          </div><!--end.right_upload-->
        </div><!--end.content_video_list-->
        <div class="table_video_list">
          <table class="table_video">
            <thead>
              <tr>
                <th>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </th>
                <th>Video</th>
                <th class="dateList">Title</th>
                <th>Client</th>
                <th class="dateList">Created Date</th>
                <th class="dateList">Start Date</th>
                <th class="dateList">End Date</th>
                <th>Status</th>
                <th>Views</th>
                <th>Unique Visitor</th>
                <th>Target View</th>
              </tr>
            </thead>
            <tbody class="lists-video"><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_42_202005270531.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">123</h3>123<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/42" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/42" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>agentzef</p></td><td class="dateList"><p>26-05-2020 22:33</p><span class="grey_text">aktive</span></td><td><p>27-05-2020</p></td><td><p>01-06-2020</p></td><td><p>aktive</p></td><td><p>8</p></td><td><p>3 </p></td><td><p>50</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_41_202005270518.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Test Test 2</h3>Test Test 2<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/41" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/41" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>kitaaja</p></td><td class="dateList"><p>26-05-2020 22:18</p><span class="grey_text">aktive</span></td><td><p>27-05-2020</p></td><td><p>01-06-2020</p></td><td><p>aktive</p></td><td><p>18</p></td><td><p>6 </p></td><td><p>50</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_36_202005261055.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Test</h3>test<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/36" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/36" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>densu</p></td><td class="dateList"><p>27-05-2020 00:00</p><span class="grey_text">aktive</span></td><td><p>26-05-2020</p></td><td><p>31-05-2020</p></td><td><p>aktive</p></td><td><p>13</p></td><td><p>8 </p></td><td><p>50</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_33_202005260942.png" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Video samsung</h3>samsung launch<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/33" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/33" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>samsung</p></td><td class="dateList"><p>26-05-2020 02:42</p><span class="grey_text">aktive</span></td><td><p>26-05-2020</p></td><td><p>06-06-2020</p></td><td><p>aktive</p></td><td><p>41</p></td><td><p>14 </p></td><td><p>50</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_28_202005260613.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">testing 26mei 2</h3>testing 26mei 2<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/28" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/28" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>kana</p></td><td class="dateList"><p>25-05-2020 23:13</p><span class="grey_text">aktive</span></td><td><p>26-05-2020</p></td><td><p>06-06-2020</p></td><td><p>aktive</p></td><td><p>45</p></td><td><p>11 </p></td><td><p>1000</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_23_202005221620.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Test File 19 Mb</h3>Test File 19 Mb<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/23" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/23" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>densu</p></td><td class="dateList"><p>22-05-2020 09:44</p><span class="grey_text">aktive</span></td><td><p>21-05-2020</p></td><td><p>30-06-2020</p></td><td><p>aktive</p></td><td><p>50</p></td><td><p>12 </p></td><td><p>1000</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_22_202005260506.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Samsung Galaxy M31- Official Launch Film</h3>Samsung Galaxy M31- Official Launch Film<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/22" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/22" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>tiket.com</p></td><td class="dateList"><p>25-05-2020 22:06</p><span class="grey_text">aktive</span></td><td><p>21-05-2020</p></td><td><p>27-05-2020</p></td><td><p>aktive</p></td><td><p>49</p></td><td><p>9 </p></td><td><p>10000</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_21_202005211220.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Samsung Galaxy Note10 Lite I Power of S Pen I AR Doodle</h3>Samsung Galaxy Note10 Lite I Power of S Pen I AR Doodle

Test Test<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/21" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/21" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>samsung</p></td><td class="dateList"><p>22-05-2020 09:35</p><span class="grey_text">tidak aktive</span></td><td><p>21-05-2020</p></td><td><p>25-05-2020</p></td><td><p>tidak aktive</p></td><td><p>4</p></td><td><p>2 </p></td><td><p>1000</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_19_202005201348.png" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">VIdeo tajir melintir</h3>Lorem ipsum dolor sit amet<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/19" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/19" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>tiket.com</p></td><td class="dateList"><p>25-05-2020 22:05</p><span class="grey_text">aktive</span></td><td><p>21-05-2020</p></td><td><p>27-05-2020</p></td><td><p>aktive</p></td><td><p>32</p></td><td><p>15 </p></td><td><p>10000</p></td></tr><tr><td><label class="container"><input type="checkbox"><span class="checkmark"></span></label></td><td><div class="img_vid"><img src="http://videoads.mfebriansyah.com/storage/uploads/video/photo_18_202005171710.jpg" style="width:150px;"></div></td><td class="dateList"><h3 class="title_tab">Testing Revisi</h3>lorem ipsum dolor sit amet<div class="abs_action"><a href="http://videoads.mfebriansyah.com/cms/video/detail/18" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a><a href="http://videoads.mfebriansyah.com/cms/analitik/18" class="action_menu"><img src="http://videoads.mfebriansyah.com/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a></div></td><td><p>tiket.com</p></td><td class="dateList"><p>17-05-2020 10:13</p><span class="grey_text">aktive</span></td><td><p>22-05-2020</p></td><td><p>26-06-2020</p></td><td><p>aktive</p></td><td><p>46</p></td><td><p>12 </p></td><td><p>122221</p></td></tr></tbody>
          </table>
          <div class="text-center">
            <div class="pagination" style="display: none;">
              <a href="#">&laquo;</a>
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#">5</a>
              <a href="#">6</a>
              <a href="#">&raquo;</a>
            </div>
            <div class="pagination">

            <ul class="pagination bootpag"><li data-lp="1" class="prev disabled"><a href="javascript:void(0);">«</a></li><li data-lp="1" class="active"><a href="javascript:void(0);">1</a></li><li data-lp="1" class="next disabled"><a href="javascript:void(0);">»</a></li></ul></div>

          </div>
        </div><!--end.table_video_list-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
<!-- end of middle -->
<?php include('inc_footer.php');?>