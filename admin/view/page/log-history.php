<h1>
	상세 통계
	<div class="tools">
		<a onclick="list('page=1');"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>통계</li>
		<li>상세 기록</li>
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
		<form id="frm-list" action="log/history">
		<div class="row">
			<table class="list width-1200-min">
			<thead>
				<tr>
					<th style="width:160px">기록일</th>
					<th style="width:170px">회원 아이디</th>
					<th style="width:140px">IP주소</th>
					<th style="width:100px">디바이스</th>
					<th style="width:10%">OS</th>
					<th style="width:12%">브라우저</th>
					<th>유입경로</th>
				</tr>
				<tr>
					<td>
						<input type="date" name="sfrom" placeholder="From" class="margin-bottom-6">
						<input type="date" name="sto" placeholder="To">
					</td>
					<td><input type="text" name="sid"></td>
					<td><input type="text" name="sip"></td>
					<td>
						<select name="sdevice">
							<option value="">-- 전체 --</option>
							<option value="PC">PC</option>
							<option value="MOBILE">모바일</option>
						</select>
					</td>
					<td><input type="text" name="sos"></td>
					<td><input type="text" name="sbrowser"></td>
					<td>
						<input type="text" name="skeyword" class="margin-bottom-5"><br>
						<a class="btn purple" href="javascript:;" onclick="list_search(true);"><i class="xi-search"></i> 검색</a>
						<a class="btn green" href="javascript:;" onclick="list_search(false);"><i class="xi-close"></i> 초기화</a>
					</td>
				</tr>
			</thead>
			<tbody id="list">
				<tr>
					<td colspan="7" class="nodata"><i class="xi-ban"></i><br>기록이 없습니다</td>
				</tr>
			</tbody>
			</table>
		</div>
		<div class="padding-bottom-0">
			<div class="text-right paging" id="paging"></div>
		</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		empty : `<tr><td colspan="7" class="nodata"><i class="xi-ban"></i><br>기록이 없습니다</td></tr>`,
		html : function(d) {
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td>${row.regdate}</td>
						<td>${row.id}</td>
						<td>${row.ip}</td>
						<td>${row.device}</td>
						<td><span class="text-short" title="${row.os}">${row.os}</span></td>
						<td><span class="text-short" title="${row.browser}">${row.browser}</span></td>
						<td><a class="text-short" href="${row.referer}" target="_blank">${row.referer}</a></td>
					</tr>
				`);
			});
		},
	});
});
</script>