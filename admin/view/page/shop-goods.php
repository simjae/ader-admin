<h1>
	상품 분류 및 진열
	<small>상품 분류 변경, 진열상품 추가, 삭제</small>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>쇼핑몰</li>
		<li>상품 분류 및 진열</li>
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
			<div class="title">
				<h1>
					<i class="xi-wrench"></i>분류 설정
					<div class="tools">
						<a onclick="modal('category-config',{ category : goods_category });" class="btn"><i class="xi-cog"></i> 추가 설정</a>
					</div>
				</h1>
			</div>
			<div class="body height-500">
				<form id="frm_config" name="frm_config" action="shop/goods/category-config">
				<input type="hidden" name="node">
				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="status" value="Y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">분류 노출</label>
				</div>
				<div class="form-group">
					<input type="text" name="url" maxlength="30">
					<label class="control-label">URL</label>
				</div>
				<div class="form-group">
					<input type="text" name="title_hover" maxlength="20">
					<label class="control-label">마우스오버 텍스트</label>
				</div>
				<div class="form-group">
					<label><input type="radio" name="access" value="everyone"><span>비회원</span></label>
					<label><input type="radio" name="access" value="member"><span>회원</span></label>
					<label><input type="radio" name="access" value="group"><span>특정 회원그룹</span></label>
					<label><input type="radio" name="access" value="admin"><span>운영자</span></label>
					<label class="control-label">분류 이용 권한</label>
				</div>
				<div class="form-group">
					<select name="member_group_no"></select>
					<label class="control-label">이용 가능 그룹</label>
				</div>
				<div class="form-group">
					<select name="box_no">
						<option value="0">-- 미지정 --</option>
					</select>
					<label class="control-label">기본 배송 박스</label>
				</div>
				<div class="form-group">
					<label><input type="radio" name="order_addgoods" value="desc"><span>최근상품 목록 상단 노출</span></label>
					<label><input type="radio" name="order_addgoods" value="asc"><span>최근상품 목록 하단 노출</span></label>
					<label class="control-label">최근 등록 상품 정렬</label>
				</div>
				<div class="form-group">
					<label><input type="checkbox" name="order_soldout_back" value="y"><span>판매 가능 상품 우선적으로 정렬합니다.</span></label>
					<label class="control-label">품절 상품 정렬</label>
				</div>
				<div class="form-group">
					<label><input type="radio" name="create_exchage_price" value="n" checked><span>미변환</span></label>
					<label><input type="radio" name="create_exchage_price" value="current"><span>해당 분류에 적용</span></label>
					<label><input type="radio" name="create_exchage_price" value="all"><span>하위 분류까지 적용</span></label>
					<label class="control-label">원화대비 해외가격 변환</label>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-4">
							<select name="country">
								<option value="en" selected>$ USD</option>
							</select>
						</div>
						<div class="col-4">
							<input type="text" name="currency" value="1150">
						</div>
						<div class="col-2">
							<label><input type="radio" name="exchage" value="1" checked><span>1배수 변환</span></label>
							<label><input type="radio" name="exchage" value="1.5"><span>1.5배수 변환</span></label>
						</div>
					</div>
					<label class="control-label"></label>
				</div>
				</form>
				<div class="footer">
					<a class="btn green btn-large" onclick="fnsubmit($('#frm_config'));"><i class="xi-check"></i> 적용</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="tools">
				<a onclick="modal('put',{category_no: goods_category});" class="btn blue"><i class="xi-plus"></i> 제품 추가</a>
			</div>
			<div class="row">
				<form id="frm-list" action="shop/goods/get">
					<input type="hidden" name="category_no">
					<table class="list">
						<thead>
							<tr>
								<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
								<th width="60px">순서</th>
								<th width="180px">이미지</th>
								<th class="sort both" data-query="name">제품명</th>
								<th width="140px" class="sort" data-query="barcode">바코드</th>
								<th width="120px" class="sort" data-query="price">판매가</th>
								<th width="120px">상태</th>
								<th width="95px">작업</th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th><input type="text" name="name"></th>
								<th><input type="text" name="code"></th>
								<th><input type="text" name="price_from" class="margin-bottom-6" placeholder="From"><input type="text" name="price_to" placeholder="To"></th>
								<th></th>
								<th>
									<button type="submit" class="btn green margin-bottom-6"><i class="xi-search"></i> 검색</button><br>
									<button type="button" class="btn reset"><i class="xi-close"></i> 취소</button>
								</th>
							</tr>
						</thead>
						<tbody class="dragable-vertical" data-sorturl="shop/goods/seq">
							<tr>
								<td colspan="8" class="nodata"><i class="xi-slash-circle"></i>검색된 제품이 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="row padding-bottom-0">
				<div class="col-2">
					<a class="btn btn-large purple" onClick="select_goods_status();"><i class="xi-close"></i> 품절 처리</a>
					<a class="btn btn-large blue" onClick="select_goods_display();"><i class="xi-eye"></i> 진열 상태 변경</a>
					<a class="btn btn-large green" onClick="select_goods_move();"><i class="xi-refresh"></i> 분류 변경</a>
					<a class="btn btn-large red" onClick="select_delete();"><i class="xi-trash-o"></i> 선택 삭제</a>
				</div>
				<div class="col-2 text-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>

<script>
function excel_upload(category_no) {
	var html = '<form id="--file-upload">'
		     + '	<input type="hidden" name="category_no" value="' + category_no + '">'
			 + '	<input type="file" name="file">'
			 + '</form>';

	$("body").append(html);
	$("#--file-upload > input").on("change",function() {
		$.ajax({
			type: "post",
			url: config.api + "shop/goods/add-xls",
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



let goods_category = 1;

$(document).ready(function() {
	$.ajax({
		url: config.api + "member/level/get",
		success: function(d) {
			var html;

			if(d.data) {
				d.data.forEach(function(row) {
					$("#frm_config select[name='access_group']").append(`<option value="${row.lv}">(${row.lv}) ${row.title}</option>`);
				});
			}
		}
	});

	$.ajax({
		url: config.api + "shop/box/get",
		success: function(d) {
			var html;

			if(d.total > 0) {
				d.data.forEach(function(row) {
					if(row.status) {
						$("#frm_config select[name='box_no']").append(`<option value="${row.no}">${row.name}</option>`);
					}
				});
			}
		}
	});
	
	$('#category-tree')
		.jstree({
			core : {
				data : {
					url : config.api + 'shop/goods/category/get',
					dataType : "json"
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
			$.post(config.api + 'shop/goods/category/delete', { 'id' : data.node.id })
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('create_node.jstree', function (e, data) {
			$.post(config.api + 'shop/goods/category/put', { 'id' : data.node.id, 'parent' : data.parent, 'title' : data.node.text })
				.done(function (d) {
					//data.instance.set_id(data.node, d.id);
				})
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('rename_node.jstree', function (e, data) {
			$.post(config.api + 'shop/goods/category/rename', { 'id' : data.node.id, 'title' : data.text })
				.done(function (d) {
					//data.instance.set_id(data.node, d.id);
				})
				.fail(function () {
					data.instance.refresh();
				});
		})
		.on('move_node.jstree', function (e, data) {
			$.post(config.api + 'shop/goods/category/move', { 'id' : data.node.id, 'parent' : data.parent , 'old_position' : data.old_position , 'position' : data.position })
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
				//goods_category = data.node.original.no;
				$.post(config.api + 'shop/goods/category/get', { 'id' : data.selected.join(':') })
					.done(function (d) {
						if(d) {
							$("#frm-list input[name='category_no']").val(d.no);
							/*
							frm_config.node.value = d.node;
							frm_config.status.checked = d.status;
							frm_config.url.value = d.url;
							frm_config.title_hover.value = d.title_hover;
							$("#frm_config input[name='access']:radio[value='" + d.access + "']").prop("checked",true);
							$("#frm_config select[name='member_group_no'] > option[value='" + d.member_group_no + "']").prop("selected",true);
							$("#frm_config select[name='box_no'] > option[value='" + d.box_no + "']").prop("selected",true);
							*/
							$("#frm-list").submit();
						}
					});
			}
		});


	get_contents($("#frm-list"),{
		empty : `<tr><td colspan="8" class="nodata"><i class="xi-slash-circle"></i>검색된 상품이 없습니다.</td></tr>`,
		html : function(d) {			
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				let price = new Array();
				for(let i=0;i<row.price.length;i++) {
					price.push(`${row.price[i].currency} ${row.price[i].price}`);
				}
				$("#frm-list tbody").append(`
					<tr>
						<td><input type="checkbox" name="no" value="${row.no}"><i></i></td>
						<td class="text-center">
							<i class="xi-arrows-v cursor-move"></i>
							<input type="number" name="seq" value="${row.seq}" class="width-100p text-center margin-top-10">
						</td>
						<td class="click"><img src="${row.images.detail.pc[0].url}"></td>
						<td>${row.name}</td>
						<td>${row.barcode}</td>
						<td>${price.join("<br>")}</td>
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
						<td>
							<button type="button" class="btn blue margin-bottom-6"><i class="xi-eye-o"></i> 상세</button>
							<button type="button" class="btn red"><i class="xi-trash-o"></i> 삭제</button>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('put',{ id : $(this).parent().data("id") });
			});
			$("#frm-list a.btn.red").click(function() {
				confirm("해당 상품을 삭제할까요?",function() {
					$.ajax({
						url: config.api + "shop/goods/delete",
						data: { no : no },
						dataType: "json",
						error: function() {
							toast("제품 삭제에 실패하였습니다");
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
