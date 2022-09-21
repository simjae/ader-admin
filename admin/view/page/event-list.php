<h1>
	이벤트
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>이벤트</li>
		<li>참여자 목록</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="event/get">
					<table class="list">
					<thead>
						<tr>
							<th width="60px">번호</th>
							<th>이벤트명</th>
							<th width="120px">참여자수</th>
							<th width="320px">이벤트 기간</th>
							<th width="160px">생성일</th>
							<th width="95px">상태</th>
							<th width="95px"></th>
						</tr>
					</thead>
					<tbody id="event-list">
						<tr>
							<td colspan="6" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td>
						</tr>
					</tbody>
					</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="float-right paging" id="event-paging"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="tools">
				<a href="javascript:;"  onclick="list_export('xls',$('#frm_list'));" class="btn">EXCEL<span class="tooltip left">엑셀 다운로드</span></a>
			</div>
			<div class="row">
				<form id="frm-list-join" action="event/submit/get">
				<input type="hidden" name="category">
				<input type="hidden" name="event_no">
				<table class="list">
				<thead>
					<tr>
						<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th width="60px">번호</th>
						<th width="200px">이벤트</th>
						<th width="120px">참여자</th>
						<th width="120px">생일</th>
						<th width="120px">연락처</th>
						<th width="95px">항목 #1</th>
						<th width="95px">항목 #2</th>
						<th width="95px">항목 #3</th>
						<th>이메일</th>
						<th width="140px">인스타그램ID</th>
						<th width="180px">참여일자</th>
						<th width="95px">상태</th>
						<th width="95px"></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th><input type="text" name="s_name"></th>
						<th><input type="date" name="s_birthday_from" class="margin-bottom-6" placeholder="From"><input type="date" name="s_birthday_to" placeholder="To"></th>
						<th><input type="text" name="s_tel"></th>
						<th><input type="text" name="s_info1"></th>
						<th><input type="text" name="s_info2"></th>
						<th><input type="text" name="s_info3"></th>
						<th><input type="text" name="s_email"></th>
						<th><input type="text" name="s_instagram_id"></th>
						<th><input type="date" name="s_input_from" class="margin-bottom-6" placeholder="From"><input type="date" name="s_input_to" placeholder="To"></th>
						<th></th>
						<th>
							<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
							<a class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
						</th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="float-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	/** 이벤트 전체 목록 **/
	get_contents($("#frm-list"),{
		pageObj : $("#event-paging"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			$("#frm-list tbody").empty();
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td>${row.num}</td>
						<td>${row.title}</td>
						<td class="text-right">${number_format(row.count)} 명</td>
						<td>${(row.date)?row.date.start + " ~ " + row.date.end:''}</td>
						<td>${row.reg_date}</td>
						<td>${(row.status)?'<a class="btn blue">진행중</a>':'<a class="btn">종료</a>'}</td>
						<td class="no-click">
							<a class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a>
							<a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() { // 셀 클릭시 상세 내용 표시
				$("#frm-list-join input[name='event_no']").val($(this).parent().data("no"));
				/** 이벤트 참여자 목록 **/
				get_contents($("#frm-list-join"),{
					pageObj : $("#paging"), // 페이징 표시할 element
					html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
						$("#frm-list-join tbody").empty();
						d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
							$("#frm-list-join tbody").append(`
								<tr data-no="${row.no}">
									<td class="no-click"><input type="checkbox" name="no" value="${row.no}"><i></i></td>
									<td>${row.num}</td>
									<td>${row.event}</td>
									<td>${row.name}</td>
									<td>${row.birthday}</td>
									<td>${row.tel}</td>
									<td>${row.info_1}</td>
									<td>${row.info_2}</td>
									<td>${row.info_3}</td>
									<td>${row.email}</td>
									<td><a href="https://www.instagram.com/${row.instagram_id}" target="_blank">${row.instagram_id}</a></td>
									<td>${row.join_date}</td>
									<td>${(row.status)?'<a class="btn blue">당첨</a>':'<a class="btn">참여</a>'}</td>
									<td class="no-click">
										<a class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a>
										<a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
									</td>
								</tr>
							`);
						});
						$("#frm-list-join tbody > tr > td:not(.no-click)").click(function() { // 셀 클릭시 상세 내용 표시
							
						});
						$("#frm-list-join a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
							let no = $(this).parent().parent().data("no");
							confirm("해당 참여자 정보를 삭제할까요?",function() {
								$.ajax({
									url: config.api + "event/submit/delete",
									data : { no : no },
									error: function() {
										toast("삭제에 실패하였습니다");
									},
									success: function(d) {
										$("#frm-list-join").submit();
									}
								});
							});
						});
					},
					nodata : function() { // 데이터가 없을 경우 처리
						$("#frm-list-join tbody").html('<tr><td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td></tr>');
					},
				});
			});
			$("#frm-list a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
				confirm("해당 이벤트 정보를 삭제할까요?",function() {
					$.ajax({
						url: config.api + "event/delete",
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
			$("#frm-list tbody").html('<tr><td colspan="6" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td></tr>');
		},
	});
});
</script>
