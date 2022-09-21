<h1>상품 창고</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>쇼핑몰</li>
		<li>상품 창고</li>
	</ul>
</div>

<div class="row">
	<div class="col-3">
		<div class="portlet">
			<div class="title">
				<h1><i class="xi-list"></i>분류</h1>
			</div>

			<div class="body height-500" id="category-tree">
			</div>
		</div>
	</div>
	<div class="col-3 col-3-2">
		<div class="portlet">
			<div class="body">
				<div class="tools">
					<a onclick="modal('put',{category_no:goods_category});" class="btn blue"><i class="xi-plus"></i> 제품 추가</a>
					<a onclick="excel_upload();" class="btn">ORDER SHEET EXCEL 추가<span class="tooltip left">오더 시트 엑셀로 상품 등록</span></a>
				</div>
				<div class="row">
					<form id="frm-list" action="shop/warehouse/get">
						<input type="hidden" name="category_no">
						<table class="list">
							<thead>
								<tr>
									<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
									<th width="180px">이미지</th>
									<th class="sort both" data-query="name">상품</th>
									<th width="140px" class="sort" data-query="code">코드</th>
									<th width="120px" class="sort" data-query="price">재고</th>
									<th width="120px">상태</th>
									<th width="95px">작업</th>
								</tr>
								<tr>
									<th></th>
									<th></th>
									<th><input type="text" name="name"></th>
									<th><input type="text" name="code"></th>
									<th><input type="text" name="price_from" class="margin-bottom-6" placeholder="From"><input type="text" name="price_to" placeholder="To"></th>
									<th></th>
									<th>
										<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
										<a class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
									</th>
								</tr>
							</thead>
							<tbody id="list" class="dragable-vertical" data-sorturl="shop/warehouse/seq">
								<tr>
									<td colspan="7" class="nodata"><i class="xi-slash-circle"></i>검색된 제품이 없습니다.</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="padding-bottom-0">
					<div class="text-right paging" id="paging"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var goods_category = 0;
function excel_upload() {
	var html = '<form id="--file-upload">'
		     //+ '	<input type="hidden" name="category_no" value="' + category_no + '">'
			 + '	<input type="file" name="file">'
			 + '</form>';

	$("body").append(html);
	$("#--file-upload > input").on("change",function() {
		$.ajax({
			type: "post",
			url: config.api + "shop/warehouse/add-xls",
			data: new FormData($(this).parent().get(0)),
			type: "post",  
			processData:false,
			contentType:false,
			dataType: "json",
			error: function() {
				alert("엑셀로 상품 정보를 추가하는데 실패하였습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("상품 정보가 업로드 되었습니다.");
					list();
				}
				else {
					alert(d.msg);
				}
			},
			complete: function() {
				$("body > #--file-upload").remove();
			}
		});
	});
	$("#--file-upload > input").click();
}


$(document).ready(function() {
	get_contents($("#frm-list"),{
		pageObj : $("#paging"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			$("#frm-list tbody").empty();
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				let thumbnail = (row.images.list.pc)?`<img src="${row.images.list.pc[0].url}">`:'';

				$("#frm-list tbody").append(`
					<tr data-no="${row.no}">
						<td class="no-click"><label><input type="checkbox" name="no[]" value="${row.no}"><i></i></label></td>
						<td>${thumbnail}</td>
						<td>${row.name}</td>
						<td>${row.barcode}</td>
						<td><input type="text" name="stock" value="${row.stock.online}"></td>
						<td>
							<div class="form-group">
								<div class="switch minimal">
									<input type="checkbox" name="status" value="${row.no}" ${(row.display_yn)?'checked':''}>
									<div class="switch-container">
										<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
									</div>
								</div>
							</div>
						</td>
						<td class="no-click">
							<button type="button" class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">수정</span></button>
							<button type="button" class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></button>
						</td>
					</tr>
				`);
			});
			$("#frm-list a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
				confirm("해당 상품을 삭제할까요?",function() {
					$.ajax({
						url: config.api + "shop/warehouse/delete",
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
			$("#frm-list tbody").html('<tr><td colspan="7" class="nodata"><i class="xi-slash-circle"></i>검색된 제품이 없습니다.</td></tr>');
		},
	});

	$('#category-tree')
		.jstree({
			'core' : {
				'data' : {
					'url' : config.api + 'shop/warehouse/category/get',
					'dataType' : "json"
				},
                'strings' : { 'loading' : "데이터 로딩중입니다.", 'New node' : "새 분류" },
				'check_callback' : function(o, n, p, i, m) {
					/*
					if(m && m.dnd && m.pos !== 'i') { return false; }
					if(o === "move_node") {
						if(this.get_node(n).parent === this.get_node(p).id) { return false; }
					}
					*/
					return true;
				},
				'themes' : {
					'responsive' : false,
					'variant' : 'small',
					'stripes' : true
				}
			},
			'sort' : function(a, b) {
				return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
			},
			'contextmenu' : {
				'items' : function(node) {
					var tmp = $.jstree.defaults.contextmenu.items();
					tmp.create.label = "새 분류";
					tmp.rename.label = "명칭 변경";
					if(node.parent != "#") tmp.remove.label = "삭제";
					else delete tmp.remove;
					delete tmp.ccp;
					return tmp;
				}
			},
			'types' : {
				'default' : { 'icon' : 'folder' },
				'file' : { 'valid_children' : [], 'icon' : 'file' }
			},
			'unique' : {
				'duplicate' : function (name, counter) {
					return name + ' ' + counter;
				}
			},
			'plugins' : ['state','dnd','types','contextmenu','unique']
		})
		.on('delete_node.jstree', function (e, data) {
			$.post(config.api + 'shop/warehouse/category/delete', { 'id' : data.node.id })
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('create_node.jstree', function (e, data) {
			$.post(config.api + 'shop/warehouse/category/put', { 'id' : data.node.id, 'parent' : data.parent, 'title' : data.node.text })
				.done(function (d) {
					//data.instance.set_id(data.node, d.id);
				})
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('rename_node.jstree', function (e, data) {
			$.post(config.api + 'shop/warehouse/category/rename', { 'id' : data.node.id, 'title' : data.text })
				.done(function (d) {
					//data.instance.set_id(data.node, d.id);
				})
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('move_node.jstree', function (e, data) {
			$.post(config.api + 'shop/warehouse/category/move', { 'id' : data.node.id, 'parent' : data.parent , 'old_position' : data.old_position , 'position' : data.position })
				.done(function (d) {
					//data.instance.load_node(data.parent);
					data.instance.refresh();
				})
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('changed.jstree', function (e, data) {
			if(data && data.selected && data.selected.length) {
				$("#frm-list input[name='category_no']").val(data.node.original.no);
				$("#frm-list input[name='page']").val('1');
				$("#frm-list").submit();
			}
		});

});
</script>
