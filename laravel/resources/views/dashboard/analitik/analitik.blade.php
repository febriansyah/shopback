@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">

        <a href="{{ url('cms/video')}}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_back.png') }}">
          <span>Video List</span>
        </a>
        <div class="row_vid_info">
          <div class="thumb_video">
            <img src="{{ upload_url('video/'.$video->photo)}}">
          </div>
          <div class="caption_video">
            <h3>Video</h3>
            <p>{{ $video->title}}</p>
          </div>
        </div>

        <a href="{{ url('cms/video/detail/'.$video->id)}}" class="row_menu">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_detail.png') }}">
          <span>Detail</span>
        </a>
        <a href="{{ url('cms/analitik/'.$video->id)}}" class="row_menu active">
          <img class="icon_menu" src="{{ asset('dashboard/images/material/icon_analytic.png') }}">
          <span>Analytics</span>
        </a>
    </div><!--emd.menu_list-->
  </div>


  <div class="mainSection whiteBg">
    <div class="inner_main">
      <div class="section_titleSearch" style="border-bottom: none;">
        <h3> Video Analytic </h3>
        <div class="right">
          <div class="period">
            <div class="inline_form">
              <span>Periode:</span>
              <input type="text" class="input_form" name="from" id="from">
              <span>s/d</span>
              <input type="text" class="input_form" id="to" name="to">
              <a href="#" class="blue_bt2 submit-date">Submit</a>
            </div><!--end.inline_form-->
          </div>
        </div>
      </div>

      <div class="rows">
        <div class="content_video_analytic">
          <div class="rows">
            <div class="box_analytic">
              <div class="row_top">
                <div class="left">
                  <div class="inline_row">
                    <span class="text_num">Total Views</span>
                    <span class="numbering totalView">{{ number_format($total_view) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Target Views</span>
                    <span class="numbering targetView">{{ number_format($video->target_view) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Unique Visitors</span>
                    <span class="numbering uniqUser">{{ number_format($uniq_user) }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">100% View</span>
                    <span class="numbering ">{{ number_format('0') }}</span>
                  </div><!--end.inline_row-->
                  <div class="inline_row">
                    <span class="text_num">Avg. Watch Time</span>
                    <span class="numbering avgWatch">

                        @if(floor($avg/3600)==0)
                            {{ $avg }} Second
                        @else
                            {{ floor($avg/3600) }} Hours
                        @endif
                        </span>
                  </div><!--end.inline_row-->
                </div>
                <div class="right">
                  <span class="info_update">Updated Apr 30, 2020, 2:00 PM </span>
                  <div class="dropdownMenu">
                    <a href="#" class="trigger_dropdown blue_bt2">Share report  <img src="{{ asset('dashboard/images/material/arrow_bottom.png') }}"></a>
                    <div class="dropdownMenu_expand" style="display: none;">
                      <a href="#" id="export-pdf"><img src="{{ asset('dashboard/images/material/icon_download.png') }}"> <span>Download </span></a>

                      <a href="#sendUrl" class="popupShow"><img src="{{ asset('dashboard/images/material/icon_sendlink.png') }}"> <span>Send Link URL</span></a>

                      <a href="#" class="copyUrl"><img src="{{ asset('dashboard/images/material/icon_copy.png') }}"> <span>Copy Link URL </span></a>
                    </div>
                  </div><!--end.dropdownMenu-->
                </div>
              </div><!--end.row_top-->

              <div class="chart_analytic line_chart" id="line_chart">

              </div>
            </div><!--end.box_analytic-->
          </div><!--end.rows-->
          <div class="rows">
            <div class="row-list">
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3>Geography</h3>
                  </div>
                  <div class="content_box">
                    <img src="{{ asset('dashboard/images/material/geography.jpg') }}">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3>View by genders </h3>
                  </div>
                  <div class="content_box">
                    <img src="{{ asset('dashboard/images/material/view_genders.jpg') }}">
                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
            </div><!--end.row-list-->
          </div>

          <div class="rows">
            <div class="row-list">
              <div class="cols2">
                <div class="box_analytic">
                  <div class="title_box">
                    <h3> Audience Retention</h3>
                  </div>
                  <div class="content_box chart_bar" id="chart_bar">

                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
            </div><!--end.row-list-->
          </div><!--end.rows-->
        </div><!--end.content_video_input-->
      </div><!--end.rows-->
    </div><!--end.inner_main-->
  </div><!--end.mainSection-->
</div>
@include('dashboard.layouts.popup')
@endsection
@section('javascript')
<script>
var base_url = '{{ url("") }}';
var id = '{{ $video->id }}';
$( function() {
var date= <?php echo $chartViwer['date'] ?>;

var data =  [{name: 'Viwers',data: <?php echo $chartViwer['data']?>}];
var title ='Data Viwer';
var subtitle = '';
var yAxis= 'total';
var chartLine,chartBar;
chartLine('line_chart',title,subtitle,yAxis,date,data);


var categoryPersentase= <?php echo $chartPersentase['category'] ?>;

var dataPersentase =  [{name: 'User',data: <?php echo $chartPersentase['data']?>}];
var titlePersentase ='Data Persentase';
var subtitlePersentase = '';
var yAxisPersentase= 'User';
chartBar('chart_bar',titlePersentase,subtitlePersentase,yAxisPersentase,categoryPersentase,dataPersentase);
var dateFormat = "dd/mm/yy",
  from = $( "#from" )
    .datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );

    }),
  to = $( "#to" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3
  })
  .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );

  });
  $( ".submit-date" ).click(function(){
      getData();

  });
function getDate( element ) {
  var date;
  try {
    date = $.datepicker.parseDate( dateFormat, element.value );
  } catch( error ) {
    date = null;
  }

  return date;
}
function getData(){
    var startDate = $("#from").val();
    var endDate = $("#to").val();
    if(startDate !='' && endDate !=''){
        $.ajax({
                url:base_url+'/cms/analitik/getData',
                type:'post',
                data: {
                            'startDate': startDate,
                            'endDate':endDate,
                            'id':id
                },
                dataType:'json'
            }).
            done(function(response) {
                var date= response.chartViwer.date;
                date = JSON.parse(date);
                console.log(date);
                var data =  [{name: 'Viwers',data: JSON.parse(response.chartViwer.data)}];
                var title ='Data Viwer';
                var subtitle = '';
                var yAxis= 'total';
                chartLine('line_chart',title,subtitle,yAxis,date,data);

                var categoryPersentase=response.chartPersentase.category;

                var dataPersentase =  [{name: 'User',data: response.chartPersentase.data}];
                var titlePersentase ='Data Persentase';
                var subtitlePersentase = '';
                var yAxisPersentase= 'User';
                chartBar('chart_bar',titlePersentase,subtitlePersentase,yAxisPersentase,categoryPersentase,dataPersentase);


                console.log($('.totalView'));
                $('.totalView').html(response.total_view);
                 $('.uniqUser').html(response.uniq_visitor);
                 var avs = Math.floor(response.avg/3600);
                 if(avs == 0)
                 {
                    $('.avgWatch').html(response.avg+' Second');
                 }else{
                    $('.avgWatch').html(Math.floor(response.avg/3600)+' Hours');
                 }

             });
    }
}
$('#export-pdf').click(function () {
    Highcharts.exportCharts([chartLine, chartBar], {
        type: 'application/pdf',
        filename: 'chart-pdf',
        sourceWidth: 800,
        sourceHeight: 400,
    });
});
Highcharts.getSVG = function (charts, options, callback) {
    var svgArr = [],
        top = 0,
        width = 0,
        addSVG = function (svgres) {
            // Grab width/height from exported chart
            var svgWidth = +svgres.match(
                    /^<svg[^>]*width\s*=\s*\"?(\d+)\"?[^>]*>/
                )[1],
                svgHeight = +svgres.match(
                    /^<svg[^>]*height\s*=\s*\"?(\d+)\"?[^>]*>/
                )[1],
                // Offset the position of this chart in the final SVG
                svg = svgres.replace('<svg', '<g transform="translate(0,' + top + ')" ');
            svg = svg.replace('</svg>', '</g>');
            top += svgHeight;
            width = Math.max(width, svgWidth);
            svgArr.push(svg);
        },
        exportChart = function (i) {
            if (i === charts.length) {
                return callback('<svg height="' + top + '" width="' + width +
                  '" version="1.1" xmlns="http://www.w3.org/2000/svg">' + svgArr.join('') + '</svg>');
            }
            charts[i].getSVGForLocalExport(options, {}, function () {
                console.log("Failed to get SVG");
            }, function (svg) {
                addSVG(svg);
                return exportChart(i + 1); // Export next only when this SVG is received
            });
        };
    exportChart(0);
};

/**
 * Create a global exportCharts method that takes an array of charts as an argument,
 * and exporting options as the second argument
 */
Highcharts.exportCharts = function (charts, options) {
    options = Highcharts.merge(Highcharts.getOptions().exporting, options);

    // Get SVG asynchronously and then download the resulting SVG
    Highcharts.getSVG(charts, options, function (svg) {
        Highcharts.downloadSVGLocal(svg, options, function () {
            console.log("Failed to export on client side");
        });
    });
};
/**
 * create chart line
 *
 * @param  {String} val
 *
 * @return {String} converted value
 */
 function chartLine(id,title,subtitle,yAxis,date,data)
{
    chartLine = Highcharts.chart(id, {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: title
                    },
                    subtitle: {
                        text: subtitle
                    },
                    xAxis: {
                        categories: date
                    },
                    yAxis: {
                        title: {
                            text:yAxis
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: true
                        }
                    },
                    series: data,
                    exporting: {
                        enabled: false // hide button
                    }
                });

}
/**
 * create chart line
 *
 * @param  {String} val
 *
 * @return {String} converted value
 */
 function chartPie(id,title,yAxis,date,data)
    {
        // Build the chart
        Highcharts.chart(id, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: title
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: yAxis,
                data: data
            }]
        });
    }
    /**
 * create chart line
 *
 * @param  {String} val
 *
 * @return {String} converted value
 */
 function chartBar(id,title,subtitle,yAxis,category,data)
    {
        // Build the chart
        console.log('data ');
        console.log(data);
        console.log('category');
        console.log(category);
        chartBar = Highcharts.chart(id, {
            chart: {
                        type: 'bar'
                    },
                    title: {
                        text: title
                    },
                    subtitle: {
                        text: subtitle
                    },
                    xAxis: {
                        categories:  category
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text:yAxis
                        }
                    },

                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: true
                        }
                    },
                    series: data,
                    exporting: {
                        enabled: false // hide button
                    }
        });
    }
});
</script>
@endsection
