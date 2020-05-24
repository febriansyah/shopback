
@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">
        <a href="{{ url("cms")}}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_dashboard.png') }}">
          <span>Dashboard</span>
        </a>
        <a href="{{ url("cms/video")}}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_video.png') }}">
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
              <select name="slct" id="slct" class="sort">
                <option selected>All</option>
                <option value="new">Newest</option>
                <option value="old">Oldest</option>
              </select>
            </div>
          </div>
          <div class="right_upload">
            <a href="#upload_video" class="blue_bt2 videoPopup">+ UPLOAD VIDEO</a>
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
                <th class="dateList">Created Date</th>
                <th class="dateList">Start Date</th>
                <th class="dateList">End Date</th>
                <th>Status</th>
                <th>Views</th>
                <th>Unique Visitor</th>
                <th>Target View</th>
              </tr>
            </thead>
            <tbody class="lists-video">
            </tbody>
          </table>
          <div class="text-center">
            <div class="pagination">

            </div>
          </div>
        </div><!--end.table_video_list-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
@include('dashboard.layouts.popup')
@endsection
@section('javascript')
<script>
$(document).ready(function() {
    var url = '{{ $url_data }}';
    var base_url = '{{ url("") }}'

    getData(0);
    function getData(start){
       var search = $('.search').val();
       var sort   = $('.sort').val();
       var start = start;

        $.ajax({
                url:url,
                type:'post',
                data: {
                            'search': search,
                            'sort':sort,
                            'start':start
                },
                dataType:'json'
            }).
            done(function(data) {
                if(start==0){
                    $('.pagination').bootpag({
                        total: data.recordsTotal,
                        maxVisible: 10
                    }).on('page', function(event, num){
                        // or some ajax content loading...
                        getData(num);

                    });
                }
                setTemplate(data.data);

             });
    }
    $('.search').on('propertychange input', function (e) {

        getData(0);

    })
    $('.sort').change(function(){
        getData(0);

    })
    function setTemplate(data){
        var str ='';
        $.each(data,function(k,v){
            str +='<tr>'
                +'<td>'
                  +'<label class="container">'
                    +'<input type="checkbox">'
                    +'<span class="checkmark"></span>'
                  +'</label>'
                +'</td>'
                +'<td>'
                  +'<div class="img_vid">'+v.photo+'</div>'
                +'</td>'
                +'<td>'
                  +'<h3 class="title_tab">'+v.title+'</h3>'
                  +v.description
                  +'<div class="abs_action">'
                    +'<a href="'+base_url+'/cms/video/detail/'+v.id+'" class="action_menu"><img src="'+base_url+'/dashboard/images/material/icon_detail.png" class="icon_action"> <span>Detail</span></a>'
                    +'<a href="'+base_url+'/cms/analitik/'+v.id+'" class="action_menu"><img src="'+base_url+'/dashboard/images/material/icon_analytic.png" class="icon_action"> <span>Analytic</span></a>'
                  +'</div>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.client+'</p>'
                +'</td>'
                +'<td class="dateList">'
                  +'<p>'+v.date+'</p>'
                  +'<span class="grey_text">'+v.status+'</span>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.start_publish+'</p>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.end_publish+'</p>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.status+'</p>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.total_view+'</p>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.uniq_visitor+' </p>'
                +'</td>'
                +'<td>'
                  +'<p>'+v.target_view+'</p>'
                +'</td>'
              +'</tr>';

        })
        $('.lists-video').html(str);
    }
});
    </script>
@endsection
