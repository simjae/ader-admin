<h1>
	월별 통계
	<div class="tools">
		<a onclick="list('page=1');"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>통계</li>
		<li>일별 기록</li>
	</ul>
	<div class="action">
		<button>Actions</button>
		<ul>
			<li onclick="list_export('xls',$('#frm_list'))"><i class="xi-file-download-o"></i>엑셀 다운로드</li>
		</ul>
	</div>
</div>

<div class="portlet">
	<div class="body">
		<div class="row">
			<form id="frm-list" action="log/month">
				<table class="list width-600-min">
					<thead>
						<tr>
							<th style="width:20%">기록일</th>
							<th style="width:20%">누적 방문</th>
							<th style="width:20%">일일 방문</th>
							<th style="width:20%">누적 페이지뷰</th>
							<th style="width:20%">일일 페이지뷰</th>
						</tr>
						<tr>
							<td>
								<input type="date" name="sfrom" placeholder="From" class="margin-bottom-6">
								<input type="date" name="sto" placeholder="To">
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<a class="btn purple margin-bottom-6" href="javascript:;" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
								<a class="btn green" href="javascript:;" onclick="list_search(false);"><i class="xi-close"></i> 초기화</a>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="5" class="nodata"><i class="xi-ban"></i><br>기록이 없습니다</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<div class="padding-bottom-0">
			<div class="text-right paging" id="paging"></div>
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
						<td class="text-right">${number_format(row.counter.month)}</td>
						<td class="text-right">${number_format(row.view.total)}</td>
						<td class="text-right">${number_format(row.view.month)}</td>
					</tr>
				`);
			});
		},
	});
});
</script>