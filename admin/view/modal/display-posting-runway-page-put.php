<div class="content__card modal__view" style="height:55vh;width:1024px;overflow-y:auto;">
	<div class="card__header">
		<h5>런웨이 상품 검색
			<a onclick="modal_close();" class="btn-close" style="float: right;">
				<i class="xi-close"></i>
			</a>
		</h5>
		<div class="drive--x"></div>
	</div>
    
	<div class="card__body" style="display:flex;">
		<div class="container_REP">
			<div style="width:100%;">
				<div class="table table__wrap" style="width:100%;margin-top:0px;">
					<table>
						<thead>
							<tr>
								<th colspan="2">런웨이 상품</th>
							</tr>
						</thead>
						<tbody style="height:30vh;">
							<tr>
								<td style="width:35%;">
									<div style="display:flex;justify-content: space-between;">
										<h3>런웨이 분류 검색</h3>
										<div style="display:flex;">
											<i class="xi-search"></i>
											<input type="text" id="tree_search" placeholder="카테고리 검색">
										</div>
									</div>
									<div id="tree__area" style="height:28vh;overflow-y:auto;">
										<div class="js--tree"></div>
									</div>
								</td>
								<td colspan="3" style="width:39vw;vertical-align:top;">
									<div class="card__header">
										<h5>상품 목록</h5>
										<div class="drive--x"></div>
									</div>
									<div style="height:28vh;overflow-y:auto;">
										<div class="table table__wrap" style="width:100%;margin-top:5px;">
											<table>
												<colgroup>
													<col width="5%;">
													<col width="20%;">
													<col width="75%;">
												</colgroup>
												<thead>
													<th>선택유무</th>
													<th>상품 코드</th>
													<th>상품 명</th>
												</thead>
												<tbody class="result_table_product" style="">
													<tr>
														<td colspan="4">조회 결과가 없습니다.</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid:none;">
			<div class="btn__wrap--lg">
				<button class="btn" style="width:110px;" onclick="modal_close();">완료</button>
			</div>
		</div>
	</div>
    	
</div>

<script>
$(document).ready(function(){
    getRunwayProductCategory();
})

function getRunwayProductCategory() {
	$('.js--tree').remove();
	$('#tree__area').append('<div class="js--tree"></div>');
	
	$('.js--tree').jstree({
		core : {
			data : {
				url : config.api + 'product/category/get',
				data :{
					'tab_num':'02'
				},
				dataType : "json"
			},
			'strings' : { 'loading' : "데이터 로딩중입니다.", 'New node' : "새 분류" },
			'check_callback' : function(o, n, p, i, m) {
				
				if(m && m.dnd && m.pos !== 'i') { return false; }
				if(o === "move_node") {
					if(this.get_node(n).parent === this.get_node(p).id) { return false; }
				}
				
				return true;
			},
			'themes' : {
				'responsive' : false,
				'variant' : 'small',
				'stripes' : false, 
				'dot' : true,
				'icons' : false
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
		'unique' : {
			'duplicate' : function (name, counter) {
				return name + ' ' + counter;
			}
		},
		"plugins": ["dnd", "search"],
		"search": {
			"show_only_matches": true,
			"show_only_matches_children": true,
		}
	}).on("select_node.jstree", function (e, data) {
		let md_category_node = 0;
		let md_category_depth = 0;
		
		sel_node = data.node;
		md_category_node = sel_node.original.no;
		md_category_depth = sel_node.parents.length;	
		
		getRunwayProduct(md_category_node,md_category_depth,page_idx);
	});
}

function getRunwayProduct(md_category_node,md_category_depth,page_idx) {
	let result_table = $('.result_table_product');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/runway/product/list/get",
		data: {
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth,
			'page_idx' : page_idx
		},
		dataType: "json",
		error: function() {
			alert("런웨이 상품 조회처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				result_table.html('');
				
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<tr>';
						strDiv += '    <td>';
						
						let action_type = row.action_type;
						if (action_type == "ADD") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + row.product_idx + '" onClick="putRunwayProduct(this);">선택</div>';
						} else if (action_type == "DEL") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + row.product_idx + '" onClick="putRunwayProduct(this);">선택완료</div>';
						}
						
						let background_url = "background-image:url('" + row.img_location + "');";
                        
						strDiv += '    </td>';
						strDiv += '    <td>' + row.product_code + '</td>';
						strDiv += '    <td>';
						strDiv += '        <div class="product__img__wrap">';
						strDiv += '            <div class="product__img" style="' + background_url + '" >';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p>' + row.product_name + '</p>';
						strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </td>';
						strDiv += '</tr>';
					});
					
					result_table.append(strDiv);
				} else {
					let strDiv = "";
					strDiv += '<tr>';
					strDiv += '    <td colspan="6" style="text-align:left;">조회 결과가 없습니다.</td>';
					strDiv += '</tr>';
					
					result_table.append(strDiv);
				}
			}
		}
	});
}

function putRunwayProduct(obj) {
	let action_type = $(obj).attr('action_type');
	let product_idx = $(obj).attr('product_idx');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/runway/product/put",
		data: {
			'select_flg' : true,
			'action_type' : action_type,
			'page_idx' : page_idx,
			'product_idx' : product_idx
		},
		dataType: "json",
		error: function() {
			alert("런웨이 상품 선택/해제 처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let strDiv = "";
				if (action_type == "ADD") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + product_idx + '" onClick="putRunwayProduct(this);">선택완료</div>';	
				} else if (action_type == "DEL") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + product_idx + '" onClick="putRunwayProduct(this);">선택</div>';	
				}
				
				let div_parent = $(obj).parent();
				div_parent.html(strDiv);
				
                getRunwayProductList(page_idx);
			} else {
				alert("런웨이 상품 선택/해제 처리에 실패했습니다. 관련상품을 확인해주세요.");
			}
		}
	});
}
</script>