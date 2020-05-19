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
                <th>Title</th>
                <th>Client</th>
                <th class="dateList">Date</th>
                <th>Views</th>
                <th>Unique Visitor</th>
                <th>Target View</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="video_input.php" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="video_analytic.php" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="video_input.php" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="video_analytic.php" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="video_input.php" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="video_analytic.php" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>

              <tr>
                <td>
                  <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </td>
                <td>
                  <div class="img_vid"><img src="images/material/thumb_video.png"></div>
                </td>
                <td>
                  <h3 class="title_tab">Good mood - Tajir melintir</h3>
                  <p>Mau tajir melintir dapatkan bonus uang cash dari good mood caranya lihat disini, kapan lagi </p>
                  <div class="abs_action">
                    <a href="#" class="action_menu"><img src="images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>
                    <a href="#" class="action_menu"><img src="images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>
                  </div>
                </td>
                <td>
                  <p>Dentsu </p>
                </td>
                <td class="dateList">
                  <p>30 Juni 2020</p>
                  <span class="grey_text">Published</span>
                </td>
                <td>
                  <p>1.000.000 </p>
                </td>
                <td>
                  <p>500.000 </p>
                </td>
                <td>
                  <p>1.500.000</p>
                </td>
              </tr>
            </tbody>
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