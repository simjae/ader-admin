<h1>
	장바구니분석<small>Cart Ranking</small>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>상품분석</li>
		<li>장바구니분석</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm_list" name="frm_list" data-module="contents/collaboration">
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
				<tbody id="list" class="dragable-vertical" data-sorturl="modules/contents/api/?m=seq">
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
function list(query) {
	query = list_query(query) + "&contents=collaboration";

	$.ajax({
		type: "post",
		url: "modules/contents/api/",
		data: query,
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var html,thumb;

			if(d.data.length > 0) {
				html = "";
				for(var i=0;i<d.data.length;i++) {
					thumb = "";
					if(d.data[i].thumb != "") {
						thumb = '<img src="' + d.data[i].thumb + '" class="preview">';
					}

					html += '<tr data-no="' + d.data[i].no + '">';
					html += '	<td><input type="checkbox" name="no" value="' + d.data[i].no + '"><i></i></td>';
					html += '	<td>' + d.data[i].no + '</td>';
					html += '	<td class="text-center"><!--<input type="number" name="SEQ" value="' + d.data[i].seq + '" style="width:50px">--><i class="xi-arrows-v cursor-move"></i></td>';
					html += '	<td>' + thumb + '</td>';
					html += '	<td class="click" onclick="modal(\'contents/api/add\',\'no=' + d.data[i].no + '\');">' + d.data[i].title + '</td>';
					html += '	<td>' + d.data[i].finput_date + '</td>';
					html += '	<td>' + ((d.data[i].status==true)?'<a class="btn green">게시</a>':'<a class="btn">미게시</a>') + '</td>';
					html += '	<td>';
					html += '		<a href="javascript:;" onclick="modal(\'contents/api/add\',\'no=' + d.data[i].no + '\');" class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">수정</span></a>';
					html += '		<a href="javascript:;" onclick="confirm(\'해당 컨텐츠를 삭제할까요?\',\'contents_delete(' + d.data[i].no + ')\');" class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
					html += '	</td>';
					html += '</tr>';
				}

				paging(d.total,d.page,20,9,$("#paging"));
			}
			else {
				html += '<tr>';
				html += '	<td colspan="8" class="nodata"><i class="xi-slash-circle"></i>검색된 상품이 없습니다.</td>';
				html += '</tr>';
				paging(1,1,20,9,$("#paging"));
			}
			$("#list").html(html);
		}
	});
}


$(document).ready(function() {
	list('contents=collaboration&page=1');
});
</script>