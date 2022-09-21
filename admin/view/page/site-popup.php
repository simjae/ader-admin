<h1>
	팝업
	<div class="tools">
		<a onclick="modal('add');"><i class="xi-plus"></i><span class="tooltip left">팝업 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>환경설정</li>
		<li>팝업</li>
	</ul>
</div>

<form id="frm-list" action="popup/get">
	<table class="list hidden">
		<thead>
			<tr class="disabled">
				<th width="60px">순서</th>
				<th width="20%">이미지</th>
				<th>제목</th>
				<th width="200px">게시기간</th>
				<th width="100px">게시</th>
				<th width="90px"></th>
			</tr>
		</thead>
		<tbody id="list" class="dragable-vertical" data-sorturl="popup/seq"></tbody>
	</table>
</form>
<div class="noitem">
	<i class="xi-file-excel"></i><br>
	설정된 팝업이 없습니다
</div>

<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		nodata : function() {
		},
		html : function(d) {
			$("div.noitem").remove();
			$("#frm-list > table.hidden").removeClass("hidden");
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td class="text-center">
							<i class="xi-arrows-v cursor-move"></i>
						</td>
						<td class="thumbnail"><img src="${row.image.thumbnail}"></td>
						<td class="click">${row.title}</td>
						<td>${row.start_date} ~ ${row.end_date}</td>
						<td>
							<div class="form-group">
								<div class="switch minimal">
									<input type="checkbox" name="status" ${(row.status)?'checked':''}>
									<div class="switch-container">
										<span class="label on">게시</span><span class="button"></span><span class="label off">미게시</span>
									</div>
								</div>
							</div>
						<td>
							<a class="btn blue"><i class="xi-eye"></i><span class="tooltip top">수정</span></a>
							<a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
						</td>
					</tr>
				`);
			});
			$("#frm-list td.click").click(function() {
				modal('add',{ no : $(this).parent().data("no") });
			});
			$("#frm-list a.btn.blue").click(function() {
				modal('add',{ no : $(this).parent().parent().data("no") });
			});
			$("#frm-list a.btn.red").click(function() {
				confirm('해당 팝업을 삭제할까요?',function() {
					$.ajax({
						url : config.api + 'popup/delete',
						data : { no : $(this).parent().parent().data("no") },
						success : function() {
						}
					});
				});
			});
		},
	});
});
</script>