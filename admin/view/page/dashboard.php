<h1>
	대시보드
	<small>리포트 & 통계</small>
	<div class="tools">
		<a onclick="dashboard();"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>대시보드</li>
	</ul>
</div>
<div class="body">
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

	<div class="row">
		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>총 결제 금액</h1>
				<div class="details">
					<i class="xi-won bg-green"></i>
					<div class="unit">KRW</div>
					<div class="number count-number" data-speed="1000" id="count-number-6">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>오늘 결제 금액</h1>
				<div class="details">
					<i class="xi-won bg-red"></i>
					<div class="unit">KRW</div>
					<div class="number count-number" data-speed="1000" id="count-number-7">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>결제 전</h1>
				<div class="details">
					<i class="xi-basket bg-blue"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-8">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=refund" class="dashboard-stat">
				<h1>환불 전</h1>
				<div class="details">
					<i class="xi-fragile bg-purple"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-9">0</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>배송 준비,보류</h1>
				<div class="details">
					<i class="xi-box bg-purple"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-6">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>배송 대기</h1>
				<div class="details">
					<i class="xi-truck bg-blue"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-7">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>배송 중</h1>
				<div class="details">
					<i class="xi-truck bg-green"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-8">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>취소 신청</h1>
				<div class="details">
					<i class="xi-close bg-red"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-9">0</div>
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>교환 신청</h1>
				<div class="details">
					<i class="xi-exchange bg-red"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-6">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>교환 처리중</h1>
				<div class="details">
					<i class="xi-exchange bg-purple"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-7">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>반품 신청</h1>
				<div class="details">
					<i class="xi-emoticon-devil-o bg-red"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-8">0</div>
				</div>
			</a>
		</div>

		<div class="col-4">
			<a href="?m=shop&module=order" class="dashboard-stat">
				<h1>반품 신청중</h1>
				<div class="details">
					<i class="xi-emoticon-devil-o bg-purple"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-9">0</div>
				</div>
			</a>
		</div>
	</div>


	<div class="row">
		<div class="portlet">
			<div class="title">
				<h1>Revenue <small>매출 추이</small></h1>
			</div>
			<div class="body">
				<div id="chart-revenue" class="width-100p height-600"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
			<div class="portlet">
				<div class="title">
					<h1>SEOUL <small>한국 시간</small></h1>
				</div>
				<div class="body">
					<div id="world-clock-seoul" class="width-100p height-250"></div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="portlet">
				<div class="title">
					<h1>NEW YORK <small>미국 뉴욕 시간</small></h1>
				</div>
				<div class="body">
					<div id="world-clock-1" class="width-100p height-250"></div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="portlet">
				<div class="title">
					<h1>HONG KONG <small>홍콩 시간</small></h1>
				</div>
				<div class="body">
					<div id="world-clock-2" class="width-100p height-250"></div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="portlet">
				<div class="title">
					<h1>United Kingdom <small>영국 시간</small></h1>
				</div>
				<div class="body">
					<div id="world-clock-3" class="width-100p height-250"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="portlet">
			<div class="title">
				<h1>SALES BY REGION <small>국가별 매출</small></h1>
			</div>
			<div class="body">
				<div id="chart-sales-region" class="width-100p height-600"></div>
			</div>
		</div>
	</div>

</div>

<script src="/scripts/_static/world-clock.js"></script>
<script src="/scripts/_static/chart-sales-region.js"></script>
<script>
function dashboard() {
	$.ajax({
		url: config.api + "dashboard",
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