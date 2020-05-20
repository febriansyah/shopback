@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="{{ url('cms') }}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_dashboard.png') }}">
          <span>Dashboard</span>
        </a>
        <a href="{{ url('cms/video') }}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_video.png') }}">
          <span>Video List</span>
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection">
    <div class="inner_main">
      <div class="section_title">
        <h3>Dasboard</h3>
      </div>

      <div class="rows">
        <div class="content_dashboard">
          <div class="row-list">
            <div class="cols3">
              <div class="box_white">
                <div class="box_upload">
                  <img src="{{ asset('dashboard/images/material/frame_upload.png') }}">
                  <p>Mau upload video iklan klien , yang keren banget disini tempatnya </p>
                  <a href="#upload_video" class="blue_bt videoPopup">Upload Video</a>
                </div><!--end.box_upload-->
              </div><!--emd.box_white-->
            </div><!--emd.cols3-->

            <div class="cols3">
              <div class="box_white">
                <div class="list_ads_report">
                  <div class="rows">
                    <h4>Total Ads</h4>
                    <div>
                      <h3>{{ $ads }}</h3> <span class="small_text">ads</span>
                    </div>
                  </div>

                  <div class="rows">
                    <h4> Recent Ads</h4>
                    <div>
                      <h3>{{ $recent }}</h3> <span class="small_text">ads</span>
                    </div>
                  </div>

                  <div class="rows">
                    <h4> Total Clients</h4>
                    <div>
                      <h3>{{ $client }}</h3> <span class="small_text">Clients</span>
                    </div>
                  </div>


                </div><!--end.list_ads_report-->
              </div><!--emd.box_white-->
            </div><!--emd.cols3-->

            <div class="cols3">
              <div class="box_white">
                <div class="latest_vid">
                  <h3>Latest Video Upload </h3>
                  <table>
                      <?php $i=0; ?>
                    @foreach ($video as $row)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row['title']}}</td>
                            <td>{{ date('Y-m-d',strtotime($row['created_at'])) }}</td>
                        </tr>
                    @endforeach

                  </table>
                </div><!--end.latest_vid-->
              </div><!--emd.box_white-->
            </div><!--emd.cols3-->

          </div><!--end.row-list-->
        </div><!--edm.content_dashboard-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
@include('dashboard.layouts.popup')
@endsection
