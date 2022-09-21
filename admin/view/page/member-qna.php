<h1>1:1 문의</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>회원</li>
		<li>1:1 문의</li>
	</ul>
</div>


<div class="row">
	<div class="col-3">
		<div class="dashboard-stat">
			<h1>새로운 문의</h1>
			<div class="details">
				<i class="xi-comments bg-blue"></i>
				<div class="unit">개</div>
				<div class="number">0</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<div class="dashboard-stat">
			<h1>답변 대기</h1>
			<div class="details">
				<i class="xi-reply bg-red"></i>
				<div class="unit">개</div>
				<div class="number">0</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<div class="dashboard-stat">
			<h1>답변 완료</h1>
			<div class="details">
				<i class="xi-eye-o bg-green"></i>
				<div class="unit">개</div>
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
				<form id="frm1" name="frm1">
				<input type="hidden" name="idxs">
				<table class="list">
				<thead>
					<tr>
						<th style="width:30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th style="width:7%">번호</th>
						<?php if(MULTI_LANGUAGE==true) { ?><th style="width:9%" class="sort" data-query="code">접속국가</th><?php } ?>
						<th style="width:10%" class="sort" data-query="code">회원 아이디</th>
						<th style="width:10%" class="sort" data-query="code">분류</th>
						<th class="sort" data-query="code">제목</th>
						<th style="width:10%" class="sort" data-query="code">답변여부</th>
						<th style="width:15%" class="sort" data-query="code">접수일</th>
						<th style="width:120px"></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<?php if(MULTI_LANGUAGE==true) { ?>
						<th>
							<select name="lang">
								<option value="">전체</option>
								<?php for($i=0;$i<sizeof($_CONFIG['LANGUAGE']);$i++) { ?>
								<option value="<?=$_CONFIG['LANGUAGE'][$i]?>"><?=$_CONFIG['LANGUAGE_KOR'][$_CONFIG['LANGUAGE'][$i]]?></option>
								<?php } ?>
							</select>
						</th>
						<?php } ?>
						<th><input type="text" name="id"></th>
						<th><input type="text" name="category"></th>
						<th><input type="text" name="title"></th>
						<th></th>
						<th><input type="date" name="date_from" class="margin-bottom-6" placeholder="From"><input type="date" name="date_to" placeholder="To"></th>
						<th>
							<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
							<a class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
						</th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="9" class="nodata"><i class="xi-ban"></i><br>접수된 1:1문의가 없습니다</td>
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
<!-- END 문의목록 -->

<script>
function list(query) {
	query = list_query(query);

	$.ajax({
		type: "post",
		url: "modules/member/qna/",
		data: query,
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var html = "";

			if(d.data.length > 0) {

				for(var i=0;i<d.data.length;i++) {
					html += '<tr data-no="' + d.data[i].no + '">';
					html += '	<td><input type="checkbox" name="no" value="' + d.data[i].no + '"><i></i></td>';
					html += '	<td><input type="number" name="SEQ" value="' + d.data[i].seq + '"><i class="xi-arrows-v"></i></td>';
					html += '	<td>' + d.data[i].image_thumbnail + '</td>';
					html += '	<td>' + d.data[i].name + '</td>';
					html += '	<td>' + d.data[i].code + '</td>';
					html += '	<td>' + d.data[i].price + '</td>';
					html += '	<td>' + d.data[i].status + '</td>';
					html += '	<td>';
					html += '		<a href="javascript:;" onclick="modal(\'shop/goods/add\',\'no=' + d.data[i].no + '\');" class="btn blue"><i class="xi-eye-o"></i></a>';
					html += '		<a href="javascript:;" onclick="confirm(\'해당 상품을 삭제할까요?\',\'\');" class="btn red"><i class="xi-trash-o"></i></a>';
					html += '	</td>';
					html += '</tr>';
				}

				paging(d.total,d.page,20,9,$("#paging"));
			}
			else {
				html += '<tr>';
				html += '	<td colspan="9" class="nodata"><i class="xi-ban"></i>접수된 1:1문의가 없습니다.</td>';
				html += '</tr>';
				paging(1,1,20,9,$("#paging"));
			}
			$("#list").html(html);
		}
	});
}

$(document).ready(function() {
	list('page=1');
});
</script>