<h1>
	연도별 통계
	<div class="tools">
		<a onclick="list();"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>통계</li>
		<li>연도별 기록</li>
	</ul>
	<div class="action">
		<button>Actions</button>
		<ul>
			<li onclick="list_export('xls',$('#frm_list'))"><i class="xi-file-download-o"></i>엑셀 다운로드</li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div id="chart" class="width-100p height-400"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="log/year">
					<table class="list width-600-min">
						<thead></thead>
						<tbody id="list"></tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		empty : `<tr><td colspan="5" class="nodata"><i class="xi-ban"></i><br>기록이 없습니다</td></tr>`,
		html : function(d) {
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td>${row.regdate}</td>
						<td class="text-right">${number_format(row.counter.total)}</td>
						<td class="text-right">${number_format(row.counter.today)}</td>
						<td class="text-right">${number_format(row.view.total)}</td>
						<td class="text-right">${number_format(row.view.today)}</td>
					</tr>
				`);
			});
		},
		complete: function(d) {
			let chartData = Array();
			for(let i=0;i<d.counter.hour.length;i++) {
				chartData.push({
					time: d.counter.hour[i].time,
					visits: d.counter.hour[i].visits
				});
			}

			var chart = AmCharts.makeChart("chart", {
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
		}
	});
});
</script>