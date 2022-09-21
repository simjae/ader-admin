<h1>
	<small>글 작성, 수정, 삭제</small>
	<div class="tools">
		<a onclick="modal('put');"><i class="xi-plus"></i><span class="tooltip left">글작성</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>게시판</li>
		<li>목록</li>
	</ul>
</div>

<div class="row">
	<div class="col-3">
		<div class="dashboard-stat">
			<h1>새로운 글</h1>
			<div class="details">
				<i class="xi-comments bg-blue"></i>
				<div class="unit">개</div>
				<div class="number">0</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<div class="dashboard-stat">
			<h1>새로운 댓글</h1>
			<div class="details">
				<i class="xi-reply bg-red"></i>
				<div class="unit">개</div>
				<div class="number">0</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<div class="dashboard-stat">
			<h1>조회</h1>
			<div class="details">
				<i class="xi-eye-o bg-green"></i>
				<div class="unit">회</div>
				<div class="number">0</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<!-- BEGIN 목록 -->
				<form id="frm-list" action="board/get">
				<input type="hidden" name="bbscode" value="<?=BBSCODE?>">
				<input type="hidden" name="idxs">
				<table class="list">
				<thead>
					<tr>
						<th style="width:30px"><input type="checkbox" class="checkbox-all-toggle"></th>
						<th style="width:7%">번호</th>
						<? if($_BOARD['USE_CATEGORY']) { ?><th style="width:12%;max-width:90px">분류</th><? } ?>
						<? if($_BOARD['USE_COVER']) { ?><th style="width:90px">커버이미지</th><? } ?>
						<th>제목</th>
						<th style="width:11%">작성자</th>
						<th style="width:70px">첨부</th>
						<th style="width:150px">작성일</th>
						<th style="width:80px">조회수</th>
						<th style="width:160px"></th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="8" class="nodata"><i class="xi-slash-circle"></i>등록된 글이 없습니다.</td>
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
<!-- END 문의목록 -->

<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		html : function(d) {
			$("#list").empty();
			d.forEach(function(row) {
				$("#list").append(`
					<tr data-no="${row.no}">
						<td><label class="check"><input type="checkbox" name="no[]" value="${row.no}"><i></i></label></td>
						<td>${row.vno}</td>
						<td>${row.title}</td>
						<td>${row.writer}</td>
						<td>${(row.file)?'<i class="xi-file"></i>':''}</td>
						<td>${row.reg_date}</td>
						<td>${row.hit}</td>
						<td class="no-click">
							<a class="btn blue"><i class="xi-eye-o"></i> 수정</a>
							<a class="btn red"><i class="xi-trash-o"></i> 삭제</a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('detail',{ no : $(this).parent().data("no") });
			});
			$("#frm-list .btn.blue").click(function() {
				modal('put',{ no : $(this).parent().parent().data("no") });
			});
			$("#frm-list .btn.red").click(function() {
				let no = $(this).parent().parent().data("no");
				confirm("해당 글을 삭제할까요?",function() {
					$.ajax({
						url: config.api + "board/delete",
						data: {
							bbscode : $("#frm-list input[name='bbscode']").val(),
							no : no
						},
						success: function(d) {
							if(d.code == 200) {
								toast("글이 삭제되었습니다.");
								get_contents();
							}
						}
					});
				});
			});
		},
	});
});
</script>