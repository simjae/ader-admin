<h1>
	STOCKIST
	<div class="tools">
		<a onclick="modal('put');"><i class="xi-plus"></i><span class="tooltip left">정보 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>웹컨텐츠</li>
		<li>STOCKIST</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="stockist/get">
				<input type="hidden" name="pagenum" value="100">
				<table class="list">
				<thead>
					<tr>
						<!--
						<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th width="50px">순서</th>
						-->
						<th width="200px">지역</th>
						<th>상점</th>
						<th width="160px">위치</th>
						<th width="80px">상태</th>
						<th width="170px">작업</th>
					</tr>
				</thead>
				<!--<tbody id="list" class="dragable-vertical" data-sorturl="/api/stockist/seq">-->
				<tbody>
					<tr>
						<td colspan="5" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<!--
				<div class="float-left">
					<a class="btn btn-large red" onClick="select_delete();"><i class="xi-trash-o"></i> 선택 삭제</a>
				</div>
				-->
				<div class="float-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	get_contents($("#frm-list"),{
		empty : `<td colspan="5" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>`,
		html : function(d) {
			let locate = { online : '온라인', offline : '오프라인', plugshop : '플러그샵' };

			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				let store = '';
				if(row.store) {
					row.store.forEach(function(row2) {
						let thumbnail = (row2.movie_image)?'<img src="' + row2.movie_thumbnail + '">':'';
						if(row2.images) {
							for(let i=0;i<row2.images.length;i++) {
								thumbnail += `<img src="${row2.images[i].thumbnail}">`;
							}
						}
						store += `
							<tr data-no="${row2.no}">
								<td style="width:60px" class="text-center"><i class="xi-arrows-v cursor-move"></i></td>
								<td style="width:30%" class="click">${row2.name}</td>
								<td class="click">${thumbnail}</td>
								<td style="width:70px">
									<div class="form-group">
										<div class="switch minimal">
											<input type="checkbox" name="status_store" value="${row2.no}" ${(row2.status)?'checked':''}>
											<div class="switch-container">
												<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
											</div>
										</div>
									</div>
								</td>
								<td style="width:110px">
									<a href="javascript:;" class="btn blue"><i class="xi-eye"></i><span class="tooltip top">상세</span></a>
									<a href="javascript:;" class="btn red storeinfo-delete"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
								</td>
							</tr>
						`;
					});
					store = `
						<table class="list" style="min-width:auto">
							<tbody class="dragable-vertical" data-sorturl="stockist/store/seq">${store}</tbody>
						</table>
					`;
				}

				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<!--
						<td><input type="checkbox" name="no" value="${row.no}"><i></i></td>
						<td class="text-center"><i class="xi-arrows-v cursor-move"></i></td>
						-->
						<td class="click">${row.city}</td>
						<td class="has-table">${store}</td>
						<td>${locate[row.locate]}</td>
						<!--<td>${row.finput_date}</td>
						<td>
							<div class="form-group">
								<div class="switch minimal">
									<input type="checkbox" name="status" value="${row.no}" ${(row.status)?'checked':''}>
									<div class="switch-container">
										<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
									</div>
								</div>
							</div>
						</td>
						<td>
							<a href="javascript:;" class="btn purple margin-bottom-5"><i class="xi-shop"></i> 상점 추가</a><br>
							<a href="javascript:;" class="btn blue"><i class="xi-eye-o"></i> 수정</a>
							<a href="javascript:;" class="btn red"><i class="xi-trash"></i> 삭제</a>
						</td>
					</tr>
				`);
			});


			$("#frm-list input[name='status'],#frm-list input[name='status_store']").click(function() {
				var obj = $(this);
				$.ajax({
					type: "post",
					url: config.api + "stockist/" + (($(this).attr("name") == "status")?"status":"store/status"),
					data: {
						no : $(this).val()
					},
					dataType: "json",
					error: function() {
						toast("스토어 표시 상태 변경 실패하였습니다");
					},
					success: function(d) {
						if($(obj).prop("checked")) {
							toast("해당 스토어를 표시합니다.");
						}
						else {
							toast("해당 스토어를 표시하지 않습니다.");
						}
					}
				});
			});

			$("#frm-list a.storeinfo-delete").click(function() {
				let no = $(this).parent().parent().data("no");
				confirm("해당 상점 정보를 삭제할까요?",function() {
					$.ajax({
						type: "post",
						url: config.api + "stockist/store/delete",
						data: {
							no : no
						},
						dataType: "json",
						error: function() {
							toast("스토어 정보 삭제 실패하였습니다");
						},
						success: function(d) {
							$("#frm-list").submit();
						}
					});
				});
			});

			$("#frm-list .has-table td.click,#frm-list .has-table a.btn.blue").click(function() {
				var stock_no,store_no;
				if($(this).hasClass("click")) {
					stock_no = $(this).parent().parent().parent().parent().parent().data("no");
					store_no = $(this).parent().data("no");
				}
				else {
					stock_no = $(this).parent().parent().parent().parent().parent().parent().data("no");
					store_no = $(this).parent().parent().data("no");
				}
				modal('add-detail',{ stock_no : stock_no, store_no : store_no});
			});
			$("#frm-list tbody > tr > td.click").click(function() {
				modal('put',{ no : $(this).parent().data("no") });
			});
			$("#frm-list a.btn.red").click(function() {
				let no = $(this).parent().parent();
				confirm("해당 스토어 정보를 삭제할까요?",function() {
					$.ajax({
						url: config.api + "stockist/delete",
						data: { no : no },
						dataType: "json",
						error: function() {
							toast("스토어 정보 삭제 실패하였습니다");
						},
						success: function(d) {
							$("#frm-list").submit();
						}
					});
				});
			});
		},
	});

});
</script>