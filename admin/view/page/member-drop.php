<h1>탈퇴 회원</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>회원</li>
		<li>탈퇴 계정</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<!-- BEGIN 문의목록 -->
				<form id="frm-list" action="member/drop/get">
				<input type="hidden" name="idxs">
				<table class="list">
				<thead>
					<tr>
						<th style="width:30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th style="width:7%" class="sort" data-query="code">번호</th>
						<th style="width:120px" class="sort" data-query="level">분류</th>
						<th style="width:10%" class="sort" data-query="code">아이디</th>
						<th style="width:10%" class="sort" data-query="code">이름</th>
						<th>탈퇴 사유</th>
						<th style="width:15%" class="sort" data-query="code">탈퇴일</th>
						<th style="width:120px"></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th>
							<select name="s_level">
								<option value="">- 전체 -</option>
								<option value="일반">일반</option>
								<option value="파트너">파트너</option>
							</select>
						</th>
						<th><input type="text" name="id"></th>
						<th><input type="text" name="name"></th>
						<th><input type="text" name="email"></th>
						<th><input type="text" name="price_from" class="margin-bottom-6" placeholder="From"><input type="text" name="price_to" placeholder="To"></th>
						<th>
							<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
							<a class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
						</th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="8" class="nodata"><i class="xi-ban"></i><br>탈퇴 회원이 없습니다</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="col-2">
					<a class="btn btn-large red" onClick="select_delete();"><i class="xi-trash"></i> 선택 삭제</a>
				</div>
				<div class="col-2 text-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>
<!-- END 문의목록 -->


<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		html : function(d) {
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td></td>
						<td>${row.num}</td>
						<td><a class="btn ${(row.level=='일반')?'blue':'red'}">${row.level}</a></td>
						<td>${row.id}</td>
						<td>${row.name}</td>
						<td>${row.email}</td>
						<td>${tel_format(row.tel)}</td>
						<td></td>
						<td></td>
						<td>${row.drop_date}</td>
						<td>
							<a class="btn red"><i class="xi-trash"></i> 삭제</a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('put',{ no : $(this).parent().data("no") });
			});
		},
	});
});
</script>