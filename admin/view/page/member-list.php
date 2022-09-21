<h1>
	일반 회원
	<div class="tools">
		<a onclick="modal('put');"><i class="xi-plus"></i><span class="tooltip left">회원 등록</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>회원</li>
		<li>활동 계정</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="tools">
				<a onclick="" class="btn has-tooltip">EXCEL<span class="tooltip left">엑셀 다운로드</span></a>
			</div>

			<div class="row">
				<!-- BEGIN 목록 -->
				<form id="frm-list" action="member/get">
				<input type="hidden" name="status" value="정상">
				<input type="hidden" name="idxs">
				<table class="list">
				<thead>
					<tr>
						<th style="width:30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th style="width:80px" class="sort" data-query="num">번호</th>
						<th style="width:120px" class="sort" data-query="level">분류</th>
						<th style="width:120px" class="sort" data-query="id">아이디</th>
						<th style="width:120px" class="sort" data-query="name">이름</th>
						<th style="width:15%" class="sort" data-query="email">이메일</th>
						<th style="width:120px" class="sort" data-query="tel">연락처</th>
						<th style="width:120px" class="sort" data-query="deposit">마일리지</th>
						<th>최근 이용 내역</th>
						<th style="width:160px" class="sort" data-query="joindate">가입일</th>
						<th style="width:90px">작업</th>
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
						<th><input type="text" name="s_id"></th>
						<th><input type="text" name="s_name"></th>
						<th><input type="text" name="s_email"></th>
						<th><input type="text" name="s_buyfee_from" class="margin-bottom-6" placeholder="From"><input type="text" name="s_buyfee_to" placeholder="To"></th>
						<th><input type="text" name="s_deposit_from" class="margin-bottom-6" placeholder="From"><input type="text" name="s_deposit_to" placeholder="To"></th>
						<th></th>
						<th><input type="date" name="s_joindate_from" class="margin-bottom-6" placeholder="From"><input type="date" name="s_joindate_to" placeholder="To"></th>
						<th>
							<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
							<a class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
						</th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="13" class="nodata"><i class="xi-ban"></i><br>조회 결과가 없습니다</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="float-left">
					<a class="btn btn-large purple" onClick="select_member_drop($('#frm_list'));"><i class="xi-close"></i> 선택 탈퇴</a>
					<a class="btn btn-large red" onClick="select_delete($('#frm_list'));"><i class="xi-trash"></i> 선택 삭제</a>
				</div>
				<div class="float-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>
<!-- END 목록 -->

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
						<td>${row.join_date}</td>
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