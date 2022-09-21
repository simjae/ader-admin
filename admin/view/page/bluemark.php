<h1>
	정품 관리<small>BLUEMARK</small>
	<div class="tools">
		<a onclick="modal('add');"><i class="xi-plus"></i><span class="tooltip left">추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>정품 관리</li>
		<li>시리얼 목록</li>
	</ul>
	<div class="action">
		<button>Actions</button>
		<ul>
			<li onclick="list_export('xls',$('#frm-list'))"><i class="xi-file-download-o"></i>엑셀 다운로드</li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="bluemark/get">
					<table class="list">
						<thead>
							<tr>
								<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
								<th width="70px">번호</th>
								<th width="120px">정품 코드</th>
								<th width="9%">바코드</th>
								<th width="9%">시즌</th>
								<th width="160px">생성일</th>
								<th width="100px">상태</th>
								<th width="200px">회원</th>
								<th width="120px">이름</th>
								<th width="120px">연락처</th>
								<th width="160px">이메일</th>
								<th width="160px">인증일</th>
								<th width="90px">작업</th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th><input type="text" name="serialcode"></th>
								<th><input type="text" name="barcode"></th>
								<th>
									<select name="season">
										<option value="">전체</option>
									</select>
								</th>
								<th><input type="date" name="createdate_s" class="margin-bottom-6"><br><input type="date" name="createdate_e"></th>
								<th>
									<select name="certify">
										<option value="">전체</option>
										<option value="n">미인증</option>
										<option value="confirm">인증</option>
									</select>
								</th>
								<th><input type="text" name="id"></th>
								<th><input type="text" name="name"></th>
								<th><input type="text" name="tel" placeholder="끝자리 기준"></th>
								<th><input type="text" name="email"></th>
								<th><input type="date" name="confirmdate_s" class="margin-bottom-6"><br><input type="date" name="confirmdate_e"></th>
								<th>
									<button type="submit" class="btn green margin-bottom-6"><i class="xi-search"></i> 검색</button><br>
									<a class="btn reset"><i class="xi-close"></i> 취소</a>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="13" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="float-left">
					<!--<a class="btn btn-large red" onClick="select_delete($('#frm_list'));"><i class="xi-trash-o"></i> 선택 삭제</a>-->
				</div>
				<div class="float-right paging"></div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		pageObj : $(".paging"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			let status = {
				n : '<a class="btn">미인증</a>',
				submit : '<a class="btn">출고</a>',
				confirm : '<a class="btn blue">인증완료</a>'
			};
			$("#frm-list tbody").empty();
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td class="no-click"><label><input type="checkbox" name="no[]" value="${row.no}"><i></i></label></td>
						<td>${row.num}</td>
						<td>${row.serial_code}</td>
						<td>${(row.barcode!=null)?row.barcode:""}</td>
						<td>${(row.season!=null)?row.season:""}</td>
						<td>${row.create_date}</td>
						<td>${status[row.status]}</td>
						<td>${(row.id!=null)?row.id:""}</td>
						<td>${(row.name!=null)?row.name:""}</td>
						<td>${(row.mobile!=null)?row.mobile:""}</td>
						<td>${(row.email!=null)?row.email:""}</td>
						<td>${(row.confirm_date!=null)?row.confirm_date:""}</td>
						<td class="no-click"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() { // 셀 클릭시 상세 내용 표시
				/** 모달창 호출
					---------
					modal(모달창 명, 전달 변수 object)
					현재 페이지 url 기준으로 작성된 modal 페이지가 호출됩니다. 
					ex) /bluemark 에서 detail 호출시, view/modal/bluemark-detail.php 호출됨 

				**/
				modal('detail',{ no : $(this).parent().data("no") });
			});
			$("#frm-list a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
				confirm("해당 시리얼코드를 삭제할까요?",function() {
					$.ajax({
						url: config.api + "bluemark/delete",
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
			$("#frm-list tbody").html('<tr><td colspan="13" class="nodata"><i class="xi-slash-circle"></i>검색된 자료가 없습니다.</td></tr>');
		},
	});
});
</script>