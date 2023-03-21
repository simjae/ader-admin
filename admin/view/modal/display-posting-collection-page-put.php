<div class="content__card modal__view" style="height:90vh;width:1024px;overflow-y:auto;">
    <input id="c_product_idx" type="hidden" value="<?=$c_product_idx?>">
	<div class="card__header">
		<h5>관련상품 수정하기
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
								<th colspan="2">관련 상품</th>
							</tr>
						</thead>
						<tbody style="height:30vh;">
							<tr>
								<td style="width:35%;">
									<div style="display:flex;justify-content: space-between;">
										<h3>관련상품 분류 설정</h3>
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
												<tbody class="result_table_CRP" style="">
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
			<div class="relevant__wrap" ></div>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid:none;">
			<div class="btn__wrap--lg">
				<button class="btn" style="width:110px;" onclick="putRelevantProductInfo()">적용</button>
				<button class="btn" style="width:110px;" onClick="modal_close();">취소</button>
			</div>
		</div>
	</div>
    	
</div>

<script>
$(document).ready(function(){
    getRelevantInfo();
})

function getRelevantInfo() {
	let country = $('#country').val();
	
	let div_container = $('.container_PRJ_' + country);
	var project_idx = div_container.find('.project_idx').val();
	let c_product_idx = $('#c_product_idx').val();
	
	let div_wrap = $('.relevant__wrap');
	
	$.ajax({
		type: "post",
		data: {
			'project_idx' : project_idx,
			'c_product_idx' : c_product_idx,
		},
		dataType: "json",
		url: config.api + "display/posting/collection/relevant/get",
		error: function() {
			alert("컬렉션 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				div_wrap.html('');
				
				let data = d.data;
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						let display_flg = "";
						var display_flg_T = '';
						var display_flg_F = '';
						
						if(row.display_flg == true){
							display_flg = "true";
							display_flg_T = 'checked';
						} else{
							display_flg = "false";
							display_flg_F = 'checked';
						}

						let soldout_flg = "";
						var sold_out_flg_T = '';
						var sold_out_flg_F = '';
						
						if(row.sold_out_flg == true){
							soldout_flg = "true";
							sold_out_flg_T = 'checked';
						} else{
							soldout_flg = "false";
							sold_out_flg_F = 'checked';
						}

						strDiv += '<div class="table table__wrap relevant__item">';
						strDiv += '    <input class="relevant_idx" type="hidden" value="' + row.relevant_idx + '">';
						strDiv += '    <div>';
						strDiv += '        <h4>' + row.product_code + '</h4>';
						strDiv += '        <div class="drive--x"></div>';
						strDiv += '    </div>';

						strDiv += '    <div class="btn" onclick="checkDisplayNum(\'' + country + '\',\'CRP\',\'up\',' + row.relevant_idx + ',' + row.display_num + ')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="checkDisplayNum(\'' + country + '\',\'CRP\',\'down\',' + row.relevant_idx + ',' + row.display_num + ')"">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <input type="hidden" name="relevant_idx[]" value="' + row.relevant_idx + '">';

						strDiv += '    <table style="margin-top:10px;">';
						strDiv += '        <tr>';
						strDiv += '            <td>상품명</td>';
						strDiv += '            <td>' + row.product_name + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>이미지</td>';
						strDiv += '            <td>' + row.img_location + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>상세페이지</td>';
						strDiv += '            <td>/product/detail?product_idx=' + row.product_idx + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>품절임박</td>';
						strDiv += '            <td>';
						strDiv += '                <div style="display:flex;">';
						strDiv += '                    <input class="display_flg" type="hidden" value="' + display_flg + '">';
						strDiv += '                    <label class="rd__square" style="margin-right:10px;">';
						strDiv += '                        <input type="radio" name="display_flg_' + row.relevant_idx + '" value="false" onClick="clickDisplayFlg(this);" ' + display_flg_F + '>';
						strDiv += '                        <div><div></div></div>';
						strDiv += '                        <span>표시안함</span>';
						strDiv += '                    </label>';
						strDiv += '                    <label class="rd__square">';
						strDiv += '                        <input type="radio" name="display_flg_' + row.relevant_idx + '" value="true"  onClick="clickDisplayFlg(this);" ' + display_flg_T + '>';
						strDiv += '                        <div><div></div></div>';
						strDiv += '                        <span>표시함</span>';
						strDiv += '                    </label>';
						strDiv += '                </div>';
						strDiv += '            </td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>진열여부</td>';
						strDiv += '            <td>';
						strDiv += '                <div style="display:flex;">';
						strDiv += '                    <input class="soldout_flg" type="hidden" value="' + soldout_flg + '">';
						strDiv += '                    <label class="rd__square" style="margin-right:10px;">';
						strDiv += '                        <input type="radio" name="sold_out_flg_' + row.relevant_idx + '" value="false" onClick="clickSoldoutFlg(this);" ' + sold_out_flg_F + '>';
						strDiv += '                        <div><div></div></div>';
						strDiv += '                        <span>표시안함</span>';
						strDiv += '                    </label>';
						strDiv += '                    <label class="rd__square">';
						strDiv += '                        <input type="radio" name="sold_out_flg_' + row.relevant_idx + '" value="true" onClick="clickSoldoutFlg(this);" ' + sold_out_flg_T + '>';
						strDiv += '                        <div><div></div></div>';
						strDiv += '                        <span>표시함</span>';
						strDiv += '                    </label>';
						strDiv += '                </div>';
						strDiv += '            </td>';
						strDiv += '        </tr>';
						strDiv += '    </table>';

						strDiv += '    <div style="display:flex;justify-content: space-between;margin-top:10px;">';
						strDiv += '        <div></div>';
						strDiv += '        <div>';
						strDiv += '            <button class="btn" onclick="deleteRelevantProduct(' + row.relevant_idx + ')">삭제하기</button>';
						strDiv += '        </div>';
						strDiv += '    </div>';

						strDiv += '</div>';
					});
					div_wrap.append(strDiv);
				}
			}
		}
	});
	
	$('.js--tree').remove();
	$('#tree__area').append('<div class="js--tree"></div>');
	
	$('.js--tree').jstree({
		core : {
			data : {
				url : config.api + 'product/category/get',
				data : {'tab_num' : '02'},
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
		
		getRelevantProduct(md_category_node,md_category_depth,project_idx,c_product_idx);
	});
}

function getRelevantProduct(md_category_node,md_category_depth,project_idx,c_product_idx) {
	let result_table = $('.result_table_CRP');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/collection/relevant/list/get",
		data: {
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth,
			'project_idx' : project_idx,
			'c_product_idx' : c_product_idx
		},
		dataType: "json",
		error: function() {
			alert("관련상품 조회처리중 오류가 발생했습니다.");
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
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + row.product_idx + '" onClick="putRelevantProduct(this);">선택</div>';
						} else if (action_type == "DEL") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + row.product_idx + '" onClick="putRelevantProduct(this);">선택완료</div>';
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

function putRelevantProduct(obj) {
	let country = $('#country').val();
	let div_container = $('.container_PRJ_' + country);
	
	var project_idx = div_container.find('.project_idx').val();
	let c_product_idx = $('#c_product_idx').val();
	
	let action_type = $(obj).attr('action_type');
	let product_idx = $(obj).attr('product_idx');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/collection/relevant/put",
		data: {
			'select_flg' : true,
			'action_type' : action_type,
			'project_idx' : project_idx,
			'c_product_idx' : c_product_idx,
			'product_idx' : product_idx
		},
		dataType: "json",
		error: function() {
			alert("관련상품 선택/해제 처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let strDiv = "";
				if (action_type == "ADD") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + product_idx + '" onClick="putRelevantProduct(this);">선택완료</div>';	
				} else if (action_type == "DEL") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + product_idx + '" onClick="putRelevantProduct(this);">선택</div>';	
				}
				
				let div_parent = $(obj).parent();
				div_parent.html(strDiv);

                getRelevantInfo(c_product_idx);
			} else {
				alert("관련상품 선택/해제 처리에 실패했습니다. 관련상품을 확인해주세요.");
			}
		}
	});
}

function clickSoldoutFlg(obj) {
	let soldout_flg = $(obj).parent().parent().find('.soldout_flg');
	soldout_flg.val($(obj).val());
}

function clickDisplayFlg(obj) {
	let display_flg = $(obj).parent().parent().find('.display_flg');
	display_flg.val($(obj).val());
}

function putRelevantProductInfo(){
	let result_table = $('.result_table_CRP');
	let radio_soldout = $('.soldout_flg');
	let radio_display = $('.display_flg');
	
	let cnt = $('.relevant_idx').length;
	
	let relevant_idx = [];
	let soldout_flg = [];
	let display_flg = [];
	
	for (let i=0; i<cnt; i++) {
		relevant_idx.push($('.relevant_idx').eq(i).val());
		soldout_flg.push(radio_soldout.eq(i).val());
		display_flg.push(radio_display.eq(i).val());
	}
	
	if (soldout_flg.length > 0 && display_flg.length > 0) {
		confirm(
			'관련상품 정보를 수정하시겠습니까?',
			function (){
				$.ajax({
					type: "post",
					data: {
						'update_flg' : true,
						'relevant_idx' : relevant_idx,
						'soldout_flg' : soldout_flg,
						'display_flg' : display_flg,
					},
					dataType: "json",
					url: config.api + "display/posting/collection/relevant/put",
					error: function() {
						alert("관련상품 수정처리에 실패했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
							getRelevantInfo();
							alert('관련상품을 수정하였습니다.');
						} else {
							alert("관련상품 수정처리에 실패했습니다. 수정하려는 상품을 확인해주세요.");
						}
					}
				});
			}
		);
	} else {
		alert('수정 할 관련상품 정보가 없습니다.');
		return false;
	}
}

function deleteRelevantProduct(relevant_idx) {
	let country = $('#country').val();
	let div_container = $('.container_PRJ_' + country);
	
	var project_idx = div_container.find('.project_idx').val();
	let c_product_idx = $('#c_product_idx').val();
	
	confirm(
		'선택하신 상품을 관련상품에서 제외하시겠습니까?',
		function(){
			$.ajax({
				type: "post",
				data: {
					'project_idx' : project_idx,
					'c_product_idx' : c_product_idx,
					'relevant_idx' : relevant_idx
				},
				dataType: "json",
				url: config.api + "display/posting/collection/relevant/delete",
				error: function() {
					alert("관련상품 삭제처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert('선택한 관련상품이 삭제되었습니다.');

						getRelevantInfo();
					} else {
						alert("관련상품 삭제처리에 실패했습니다. 삭제하려는 관련상품을 확인해주세요.");
					}
				}
			});
		}
	);
}
</script>