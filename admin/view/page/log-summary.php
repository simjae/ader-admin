<h1>
	통계<small>브라우저별 유입량, 시간별, 일별, 월별, 연도별 방문자 및 뷰</small>
	<div class="tools">
		<a onclick="dashboard();"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>통계</li>
		<li>요약</li>
	</ul>
</div>


<div class="row">
	<div class="col-4">
		<div class="dashboard-stat">
			<h1>총 방문자</h1>
			<div class="details">
				<i class="xi-users bg-green"></i>
				<div class="unit">명</div>
				<div class="number count-number" data-speed="1000" id="count-number-1">0</div>
			</div>
		</div>
	</div>

	<div class="col-4">
		<div class="dashboard-stat">
			<h1>총 페이지뷰</h1>
			<div class="details">
				<i class="xi-desktop bg-red"></i>
				<div class="unit">회</div>
				<div class="number count-number" data-speed="1000" id="count-number-2">0</div>
			</div>
		</div>
	</div>

	<div class="col-4">
		<div class="dashboard-stat">
			<h1>오늘 방문자</h1>
			<div class="details">
				<i class="xi-eye bg-purple"></i>
				<div class="unit">명</div>
				<div class="number count-number" data-speed="1000" id="count-number-3">0</div>
			</div>
		</div>
	</div>

	<div class="col-4">
		<div class="dashboard-stat">
			<h1>오늘 페이지뷰</h1>
			<div class="details">
				<i class="xi-eye-o bg-blue"></i>
				<div class="unit">회</div>
				<div class="number count-number" data-speed="1000" id="count-number-4">0</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-2">

		<!-- BEGIN 오늘 방문 통계 -->
		<div class="portlet">
			<div class="title">
				<h1>Today Visits <small>오늘 방문 통계</small></h1>
			</div>
			<div class="body">
				<div id="chart-today-visit" class="width-100p height-400"></div>
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="portlet">
			<div class="title">
				<h1>Visits by Region <small>국가별 방문 통계</small></h1>
			</div>
			<div class="body">
				<div id="chart-region-visit" class="width-100p height-400"></div>
			</div>
		</div>
	</div>
</div>


<script>
function dashboard() {
	$.ajax({
		url: config.api + "dashboard/main",
		dataType: "json",
		success: function(d) {
			if(d.code==200) {
				$("#count-number-1").data("to",d.counter.total);
				$("#count-number-2").data("to",d.counter.view_total);
				$("#count-number-3").data("to",d.counter.today);
				$("#count-number-4").data("to",d.counter.view_today);

				$("#count-number-5").data("to",d.member);
				$("#count-number-6").data("to",d.payment);
				$("#count-number-7").data("to",d.articles);
				
				apply_counter();


				/** 01. TODAY VISITS **/
				var chartData = Array();
				for(var i=0;i<d.counter.hour.length;i++) {
					chartData.push({
						time: d.counter.hour[i].time,
						visits: d.counter.hour[i].visits
					});
				}

				var chart = AmCharts.makeChart("chart-today-visit", {
					"type": "serial",
					"theme": "light",
					"marginRight": 0,
					"dataProvider": chartData,
					"graphs": [{
						"id": "g1",
						"fillAlphas": 0.4,
						"bullet":"round",
						"valueField": "visits",
						"balloonText": "<div style='margin:5px; font-size:19px;'><b>[[value]]</b></div>"
					}],
					"startDuration": 0.5,
					"categoryField": "time",
					"categoryAxis": {
						"minPeriod": "mm",
						"parseDates": false
					},
					"export": {
						"enabled": false,
						 "dateFormat": "YYYY-MM-DD HH:NN:SS"
					}
				});


				/** 02. VISITS BY REGION **/
				chartData = Array();
				for(var i=0;i<d.counter.global.length;i++) {
					chartData.push({
						country: d.counter.global[i].country,
						visits: d.counter.global[i].visits
					});
				}

				var chart = AmCharts.makeChart( "chart-region-visit", {
					"type": "pie",
					"theme": "light",
					"startDuration": 0.5,
					"dataProvider": chartData,
					"valueField": "visits",
					"titleField": "country",
					"outlineAlpha": 0.4,
					"depth3D": 15,
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"angle": 30,
					"export": {
						"enabled": false
					}
				});


				/** 03. REVENUE **/
var chartData = generateChartData();
var chart = AmCharts.makeChart("chart-revenue", {
    "type": "serial",
    "theme": "light",
    "marginRight": 20,
    "autoMarginOffset": 20,
    "marginBottom": 15,
    "dataProvider": chartData,
    "valueAxes": [{
        "axisAlpha": 0.2,
        "dashLength": 1,
        "position": "left"
    }],
    "mouseWheelZoomEnabled": true,
    "graphs": [{
        "id": "g1",
        "balloonText": "[[value]]",
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "hideBulletsCount": 50,
        "title": "red line",
        "valueField": "visits",
        "useLineColorForBulletBorder": true,
        "balloon":{
            "drop":true
        }
    }],
    "chartScrollbar": {
        "autoGridCount": true,
        "graph": "g1",
        "scrollbarHeight": 40
    },
    "chartCursor": {
       "limitToGraph":"g1"
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true,
		"position": "bottom-left"
    }
});

chart.addListener("rendered", zoomChart);
zoomChart();

// this method is called when chart is first inited as we listen for "rendered" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
}


// generate some random data, quite different range
function generateChartData() {
    var chartData = [];
    var firstDate = new Date();
    firstDate.setDate(firstDate.getDate() - 5);

    for (var i = 0; i < 1000; i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        var newDate = new Date(firstDate);
        newDate.setDate(newDate.getDate() + i);

        var visits = Math.round(Math.random() * (40 + i / 5)) + 20 + i;

        chartData.push({
            date: newDate,
            visits: visits
        });
    }
    return chartData;
}
			}
		}
	});

}

$(document).ready(function() {
	dashboard();
});
</script>