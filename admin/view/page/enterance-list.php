<h1>
	일일 상세 목록
	<div class="tools">
		<a onclick="$('#frm-list').submit();"><i class="xi-renew"></i><span class="tooltip left">통계를 새로 갱신합니다.</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>매장 방문 기록</li>
		<li>일일 상세 목록</li>
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
		<form id="frm-list" action="enterance/get">
		<!--
		<div class="row">
			<div class="form-group form-line-input">
				<select name="row" class="width-80">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				개씩 보기
			</div>
		</div>
		-->
		<div class="row">
			<table class="list width-1200-min">
			<thead>
				<tr>
					<th style="width:120px">#</th>
					<th style="width:160px">방문시각</th>
					<th style="width:170px">매장</th>
					<th style="width:140px">이름</th>
					<th style="width:160px">연락처</th>
					<th>이메일</th>
					<th style="width:18%">인스타그램</th>
					<th style="width:90px"></th>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="date" name="date_from" placeholder="From" class="margin-bottom-6">
						<input type="date" name="date_to" placeholder="To">
					</td>
					<td>
						<select name="store">
							<option value="">- 전체 -</option>
							<option value="성수">성수</option>
							<option value="한남">한남</option>
							<option value="홍대">홍대</option>
							<option value="신사">신사</option>
						</select>
					</td>
					<td><input type="text" name="name"></td>
					<td><input type="text" name="tel"></td>
					<td><input type="text" name="email"></td>
					<td><input type="text" name="instagram_id"></td>
					<td>
						<button type="submit" class="btn green margin-bottom-6"><i class="xi-search"></i> 검색</button><br>
						<a class="btn reset"><i class="xi-close"></i> 초기화</a>
					</td>
				</tr>
			</thead>
			<tbody id="list">
				<tr><td colspan="7" class="nodata"><i class="xi-slash-circle"></i>검색된 자료가 없습니다.</td></tr>
			</tbody>
			</table>
		</div>
		<div class="row padding-bottom-0">
			<div class="text-right paging" id="paging"></div>
		</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		pageObj : $("#paging"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			$("#frm-list tbody").empty();
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				let instagram = '';
				if(row.instagram_id) {
					instagram = `<a href="https://instagram.com/${row.instagram_id}" target="_blank">${row.instagram_id} <i class="xi-link"></i></a>`;
				}

				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td>${row.num}</td>
						<td>${row.reg_date}</td>
						<td>${row.store}</td>
						<td>${row.name}</td>
						<td>${tel_format(row.tel)}</td>
						<td>${row.email}</td>
						<td>${instagram}</td>
						<td class="no-click"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>
					</tr>
				`);
			});
			$("#frm-list a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
				confirm("해당 기록을 삭제할까요?",function() {
					$.ajax({
						url: config.api + "enterance/delete",
						data : { no : no },
						error: function() {
							toast("삭제에 실패하였습니다");
						},
						success: function(d) {
							$("#frm-list").submit();
						}
					});
				});
			});
		},
		nodata : function() { // 데이터가 없을 경우 처리
			$("#frm-list tbody").html('<tr><td colspan="7" class="nodata"><i class="xi-slash-circle"></i>검색된 자료가 없습니다.</td></tr>');
		},
	});
});
</script>