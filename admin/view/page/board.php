<h1>
	게시판 설정
	<small>게시판 환경설정</small>
	<div class="tools hidden">
		<a onclick="modal('config/put');"><i class="xi-plus"></i><span class="tooltip left">게시판 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>게시판</li>
		<li>환경설정</li>
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
				<!-- BEGIN 문의목록 -->
				<form id="frm-list" action="board/config/get">
				<table class="list">
				<thead>
					<tr>
						<th style="width:14%">게시판코드</th>
						<th>게시판명</th>
						<th style="width:8%">게시글 수</th>
						<th style="width:7%">상태</th>
						<th style="min-width:120px;width:15%">생성일</th>
						<th style="width:90px"></th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="6">등록된 게시판이 없습니다</td>
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
					<tr data-bbscode="${row.bbscode}">
						<td>${row.bbscode}</td>
						<td>${row.title}</td>
						<td>${row.article_count}</td>
						<td class="no-click">
							<div class="form-group">
								<div class="switch minimal">
									<input type="checkbox" name="status" value="y" ${(row.status)?'checked':''}>
									<div class="switch-container">
										<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
									</div>
								</div>
							</div>
						</td>
						<td>${row.reg_date}</td>
						<td class="no-click">
							<a class="btn blue"><i class="xi-eye-o"></i></a>
							<a class="btn red"><i class="xi-trash-o"></i></a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('config',{ bbscode : $(this).parent().data("bbscode") });
			});
		},
	});
});
</script>