@extends('dashboard.layouts.default')

@section('content')
<!-- middle -->
<div id="middle-content" class="loginPage">
	<div class="left_menu">
    <div class="menu_list">


        <a href="{{ url('cms/analitik/uniq_clnt?'.$link_id)}}" class="row_menu active">
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
                <span class="info_update">Updated {{ date('F d, Y, H:i A')}} </span>
                  <div class="dropdownMenu">
                    <a href="#" class="trigger_dropdown blue_bt2">Share report  <img src="{{ asset('dashboard/images/material/arrow_bottom.png') }}"></a>
                    <div class="dropdownMenu_expand" style="display: none;">
                      <a href="#" id="export-pdf"><img src="{{ asset('dashboard/images/material/icon_download.png') }}"> <span>Download </span></a>

                      <a href="#sendUrl" class="popupShow shareurl"><img src="{{ asset('dashboard/images/material/icon_sendlink.png') }}"> <span>Send Link URL</span></a>

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

                  <div class="content_box chart_dounat" id="chart_dounat">

                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
              <div class="cols2">
                <div class="box_analytic">

                  <div class="content_box"  id="chart_dounat_gender">

                  </div><!--emd.content_box-->
                </div>
              </div><!--end.cols2-->
            </div><!--end.row-list-->
          </div>

          <div class="rows">
            <div class="row-list">
              <div class="cols2">
                <div class="box_analytic">

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

<div id="sendUrl" class="popup_container" style="display: none;">
    <div class="bg_popup"></div>
    <div class="inner_abs_popup">
      <div class="inner_box">
        <div class="title_popup noBorder">
          <div class="left">
            <h3> Share Link URL</h3>
          </div>
          <div class="right"><a href="#" class="close_popup"><img src="{{ asset('dashboard/images/material/icon_close.png') }}"></a></div>
        </div><!--end.title_popup-->
        <div class="content_popup">
          <img src="{{ asset('dashboard/images/material/icon_popup_shareLink.png') }}" style="margin-bottom: 20px;">
          <div class="group_form">
            <input type="email" class="input_form emailsendurl" name=""  id="emailpopup">
          </div>
          <div class="group_form">
            <button type="submit" class="blue_bt2 submit-shareurl" disabled id="sendUrlMail">Submit</button>
          </div>
        </div>
      </div>
    </div><!--end.inner_abs_popup-->
  </div>



@endsection
@section('javascript')
<script>
var base_url = '{{ url("") }}';
var id = '{{ $video->id }}';
var link_id = '{{ $link_id }}';
$( function() {
var date= <?php echo $chartViwer['date'] ?>;

var data =  [{name: 'Viwers',data: <?php echo $chartViwer['data']?>}];
var title ='';
var subtitle = '';
var yAxis= 'total';
var chartLines= chartLine('line_chart',title,subtitle,yAxis,date,data);





var categoryPersentase= <?php echo $chartPersentase['category'] ?>;

var dataPersentase =  [{name: 'User',data: <?php echo $chartPersentase['data']?>}];
var titlePersentase ='Audience Retention';
var subtitlePersentase = '';
var yAxisPersentase= 'User';
var chartBars = chartBar('chart_bar',titlePersentase,subtitlePersentase,yAxisPersentase,categoryPersentase,dataPersentase);



var dataGACity = <?php echo $chartGACity['data']?>;
var titleGACity = 'Geography';
var subtitleGACity='';
var chartDounat = chartDonat('chart_dounat',titleGACity,subtitleGACity,'City',dataGACity);

var dataGAGender = <?php echo $chartGAGender['data']?>;
var titleGAGender = 'View by genders';
var subtitleGAGender='';
var chartDounatGender = chartDonat('chart_dounat_gender',titleGAGender,subtitleGAGender,'Gender',dataGAGender);

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
                url:base_url+'/cms/analitikshare/getData',
                type:'post',
                data: {
                            'startDate': startDate,
                            'endDate':endDate,
                            'id':id,
                            'link_id':link_id
                },
                dataType:'json'
            }).
            done(function(response) {
                if(response.status!='error'){
                    var date= response.chartViwer.date;
                    date = JSON.parse(date);
                    console.log(date);
                    var data =  [{name: 'Viwers',data: JSON.parse(response.chartViwer.data)}];
                    var title ='';
                    var subtitle = '';
                    var yAxis= 'total';
                    chartLines = chartLine('line_chart',title,subtitle,yAxis,date,data);

                    var categoryPersentase=response.chartPersentase.category;
                    categoryPersentase = JSON.parse(categoryPersentase);
                    var dataPersentase =  [{name: 'User',data: JSON.parse(response.chartPersentase.data)}];

                    var titlePersentase ='Audience Retention';
                    var subtitlePersentase = '';
                    var yAxisPersentase= 'User';
                    console.log(dataPersentase);
                    chartBars = chartBar('chart_bar',titlePersentase,subtitlePersentase,yAxisPersentase,categoryPersentase,dataPersentase);



                    var dataGACity = JSON.parse(response.chartGACity.data);
                    var titleGACity = 'Geography';
                    var subtitleGACity='';
                    var chartDounat = chartDonat('chart_dounat',titleGACity,subtitleGACity,'City',dataGACity);

                    var dataGAGender = JSON.parse(response.chartGAGender.data);
                    var titleGAGender = 'View by genders';
                    var subtitleGAGender='';
                    var chartDounatGender = chartDonat('chart_dounat_gender',titleGAGender,subtitleGAGender,'Gender',dataGAGender);

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
                }else{
                    alert(response.message);
                }




             });
    }
}
$('#export-pdf').click(function () {
    Highcharts.exportCharts([chartLines, chartBars, chartDounat], {
        type: 'application/pdf',
        filename: 'chart-pdf',
        sourceWidth : 2000,
								sourceHeight : 600,
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
     return Highcharts.chart(id, {
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
                        line: {
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

                text: title,

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

        return Highcharts.chart(id, {
            chart: {
                        type: 'bar'
                    },
                    title: {
                        text: title,
                        floating: true,
                        align: 'left'

                    },
                    subtitle: {
                        text: subtitle
                    },
                    xAxis: {
                        categories:  category
                    },
                    yAxis: {
                        min:0,
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
    function chartDonat(id,title,subtitle,yAxis,data){
       return Highcharts.chart(id, {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45
                        }
                    },
                    title: {
                        text: title,
                        floating: true,
                        align: 'left'

                    },
                    subtitle: {
                        text: subtitle
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 45
                        }
                    },
                    series: [{
                        name: yAxis,
                        data: data
                    }],
                    exporting: {
                        enabled: false // hide button
                    }
                });
    }
    $(document).on('click','.submit-shareurl',function(){

        var email = $('.emailsendurl').val();

        $.ajax({
                url:base_url+'/cms/analitikshare/sendemail',
                type:'post',
                data: {
                        'email': email,
                        'link_id':link_id
                },
                dataType:'json'
            }).
            done(function(data) {


             });
    })
});
</script>
@endsection