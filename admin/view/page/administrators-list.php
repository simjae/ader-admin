<h1>
	관리자
	<div class="tools">
		<a onclick="modal('put');"><i class="xi-plus"></i><span class="tooltip left">관리자 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>관리자</li>
	</ul>
</div>

<!-- BEGIN 관리자 목록 -->
<div class="row">
	<div class="portlet">
		<div class="body">
			<form id="frm-list" action="admin/get">
				<table class="list">
				<thead>
					<tr>
						<th style="width:30px;text-align:center"><input type="checkbox"></th>
						<th style="width:15%">아이디</th>
						<th style="width:15%">이름</th>
						<th>관리권한</th>
						<th style="width:18%">생성일</th>
						<th style="width:120px"></th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="6" class="nodata"><i class="xi-ban"></i><br>검색된 관리자가 없습니다.</td>
					</tr>
				</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<!-- END 관리자 목록 -->

<div class="row">
	<div class="col-2">
		<!-- BEGIN 관리자 권한 목록 -->
		<div class="portlet">
			<div class="title">
				<h1>
					<i class="xi-unlock"></i>권한 <small>관리자 권한 설정</small>
					<div class="tools">
						<a class="btn" onClick="modal('permission-put');">권한설정 추가</a>
					</div>
				</h1>
			</div>
			<div class="body height-400-min">
				<table class="list width-100p width-400-min">
				<thead>
					<tr>
						<th style="width:40px">#</th>
						<th>권한명</th>
						<th style="width:130px">해당관리자수</th>
						<th style="width:70px">작업</th>
					</tr>
				</thead>
				<tbody id="permition-list">
					<tr>
						<td colspan="4" class="nodata"><i class="xi-ban"></i><br>등록된 권한정의 목록이 없습니다.</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END 관리자 권한 목록 -->
	</div>
	<div class="col-2">
		<div class="portlet">
			<div class="title">
				<h1>
					<i class="xi-calendar"></i>활동 내역 <small>관리자 행동 기록</small>
					<div class="tools">
						<a class="btn"><i class="xi-renew"></i><span class="tooltip top">새로고침</span></a>
					</div>
				</h1>
			</div>
			<div class="body height-400-min">
				<ul class="feed" id="history-list"></ul>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		empty : `<tr><td colspan="7" class="nodata"><i class="xi-ban"></i>검색된 관리자가 없습니다</td></tr>`,
		html : function(d) {
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-id="${row.id}">
						<td><input type="checkbox" name="no" value="${row.id}"><i></i></td>
						<td class="click">${row.id}</td>
						<td class="click">${row.name}</td>
						<td>${row.permition}</td>
						<td>${row.join_date}</td>
						<td class="no-click">
							<a href="javascript:;" class="btn blue"><i class="xi-eye-o"></i></a>
							<a href="javascript:;" class="btn red"><i class="xi-trash"></i></a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('put',{ id : $(this).parent().data("id") });
			});
			$("#frm-list a.btn.red").click(function() {
				confirm("해당 관리자를 삭제할까요?",function() {
				});
			});
		},
	});
});
</script>