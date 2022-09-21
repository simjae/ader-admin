<h1>
	콜라보레이션<small>Collaboration</small>
	<div class="tools">
		<a onclick="modal('put',{ page_code : 'collaboration' });"><i class="xi-plus"></i><span class="tooltip left">컨텐츠 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>컨텐츠</li>
		<li>콜라보레이션</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="contents/get">
					<input type="hidden" name="page_code" value="editorial">
					<table class="list">
						<thead>
							<tr>
								<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
								<th width="70px">번호</th>
								<th width="50px">순서</th>
								<th width="200px">메인이미지</th>
								<th>제목</th>
								<th width="160px">등록일</th>
								<th width="90px">상태</th>
								<th width="90px">작업</th>
							</tr>
						</thead>
						<tbody id="list" class="dragable-vertical" data-sorturl="contents/api/seq">
							<tr>
								<td colspan="8" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="float-left">
					<a class="btn btn-large red" onClick="select_delete();"><i class="xi-trash-o"></i> 선택 삭제</a>
				</div>
				<div class="float-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		pageObj : $("#paging"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			$("#frm-list tbody").empty();
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				let thumb = '';
				if(row.image) {
					thumb = `<img src="${row.image}" class="preview">`;
				}
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td class="no-click"><label><input type="checkbox" name="no[]" value="${row.no}"><i></i></label></td>
						<td class="text-center"><i class="xi-arrows-v cursor-move"></i></td>
						<td>${row.num}</td>
						<td>${thumb}</td>
						<td>${row.title}</td>
						<td>${row.reg_date}</td>
						<td>${status}</td>
						<td class="no-click">
							<button type="button" class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">수정</span></button>
							<button type="button" class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></button>
						</td>
					</tr>
				`);
			});
			$("#frm-list a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
				confirm("해당 콜렉션을 삭제할까요?",function() {
					$.ajax({
						url: config.api + "contents/delete",
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