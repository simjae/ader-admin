<style>
#add_product_btn {width:120px;height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;}
.product__img__wrap {display: flex;align-items: center;width:300px;}
.product__img {width: 100px;height: 130px;border: 1px solid #000000;margin-right: 10px;background-repeat: no-repeat;background-size: cover;background-position: center;}
.product_txt {font-size: 12px!important;font-family: 'NanumSquareRound',sans-serif;}
.display_num_btn{width:30px;height:25px;padding:6px;text-align:center;margin-right:5px;font-size:0.5rem;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card modal__view" style="margin: 0;">
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$page_idx = getUrlParamter($page_url, 'page_idx');
	?>
	<div class="card__header">
		<h3>추천상품 리스트 수정</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-put" action="product/recommend/put">
			<input id="page_idx" type="hidden" name="page_idx" value="<?=$page_idx?>">
			<input id="update_flg" type="hidden" name="update_flg" value="true">
		
			<div class="content__wrap">
				<div class="content__title">리스트 타이틀</div>
				<div class="content__row">
					<input id="page_title" type="text" name="page_title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">리스트 메모</div>
				<div class="content__row">
					<textarea id="page_memo" type="text" name="page_memo" style="width:100%; height:150px; border:solid 1px #bfbfbf; padding:14px;"></textarea>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">추천상품 활성상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="active_flg_false" type="radio" name="active_flg" value="false" checked>
							<label for="active_flg_false">비활성</label>
							
							<input id="active_flg_true" type="radio" name="active_flg" value="true">
							<label for="active_flg_true">활성</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">추천리스트 옵션</div>
				<div class="content__row">
					<div class="table table__wrap">
						<TABLE style="width:80%;" class="table_put">
							<THEAD>
								<TR>
									<TH style="width:3%;">
										<label>
											<input type="checkbox" table_type="put" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</TH>
									<TH>추천옵션 타이틀</TH>
									<TH>추천옵션 변수명</TH>
									<TH>추천옵션 타입</TH>
									<TH>추천옵션 조건</TH>
									<TH>추천옵션 값</TH>
								</TR>
							</THEAD>
							<TBODY id="option_table">
								<?php
									$option_sql = "
										SELECT
											RO.IDX					AS OPTION_IDX,
											RO.OPTION_TITLE			AS OPTION_TITLE,
											RO.OPTION_NAME			AS OPTION_NAME,
											RO.OPTION_TYPE			AS OPTION_TYPE,
											RO.OPTION_CONDITION		AS OPTION_CONDITION,
											RO.OPTION_VALUE			AS OPTION_VALUE
										FROM
											RECOMMEND_OPTION RO
									";
									
									$db->query($option_sql);
									
									foreach($db->fetch() as $data) {
								?>
								<TR>
									<TD>
										<label>
											<input class="option_idx select" type="checkbox" name="recommend_idx[]" value="<?=$data['OPTION_IDX']?>">
											<span></span>
										</label>
									</TD>
									<TD><?=$data['OPTION_TITLE']?></TD>
									<TD><?=$data['OPTION_NAME']?></TD>
									<TD><?=$data['OPTION_TYPE']?></TD>
									<TD><?=$data['OPTION_CONDITION']?></TD>
									<TD><?=$data['OPTION_VALUE']?></TD>
								</TR>
								<?php
									}
								?>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</div>
			<div style="display:flex;">
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
										<div class="tree__area" style="height:28vh;overflow-y:auto;">
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
													<tbody class="recommand_result_table" style="">
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
			<div class="content__wrap" style="margin-top:20px;">
				<div class="content__title">
					<font style="margin-left:5px;">추천상품</font>
					</br>
					<div class="btn" style="margin-top:10px;" onClick="modal('/get')">상품검색</div>
				</div>
				<div id="recommend_body" class="content__row" style="display:flex;flex-wrap:wrap;">
					
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div toggle="hide"></div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="putPageRecommend();"><span>추천상품 리스트 수정</span></div>
				<div class="defult__color__btn" onClick="location.href='/product/recommend';"><span>취소</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getPageRecommend();
});

function getPageRecommend() {
	let page_idx = $('#page_idx').val();
	
	$.ajax({
		type: "post",
		data: {
			'page_idx':page_idx
		},
		dataType: "json",
		url: config.api + "product/recommend/get",
		error: function() {
			alert('추천상품 리스트 조회 처리중 오류가 발생했습니다.')
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				data.forEach(function(row) {
					$('#page_title').val(row.page_title);
					$('#page_memo').val(row.page_memo);
					
					let recommend_idx = row.recommend_idx;
					let option_idx_arr = [];
					
					if (recommend_idx != null) {
						option_idx_arr = recommend_idx.split(",");
						
						if (option_idx_arr.length > 0) {
							let cnt = $('.option_idx').length;
							
							for (let i=0; i<cnt; i++) {
								let option_idx = $('.option_idx').eq(i);
								let result = option_idx_arr.indexOf(option_idx.val());
								if (result >= 0) {
									option_idx.prop('checked',true);
								}
							}
						}
					}
					
					let active_flg = row.active_flg;
					if (active_flg == true) {
						$('#active_flg_true').prop('checked',true);
					} else {
						$('#active_flg_false').prop('checked',true);
					}
					
					let product_info = row.product_info;
					
					product_info.forEach(function(product) {
						let strDiv = "";
						strDiv += '        <div id="recommend_product_' + product.product_idx + '" class="product__img__wrap">';
						strDiv += '            <input class="product_idx" type="hidden" name="product_idx[]" value="' + product.product_idx + '">';
						
						let background_url = "background-image:url('" + product.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p class="product_txt">' + product.product_code + '</p><br>';
						strDiv += '                <p class="product_txt">' + product.product_name + '</p><br>';
						strDiv += '                <div class="btn" product_code="' + product.product_code + '" style="margin-right:10px;" onClick="removeRecommendProduct(' + product.product_idx + ');">삭제</div>';
						
						strDiv += '                <div class="btn display_num_btn" onclick="displayNumCheck(' + product.product_idx + ',\'up\')">';
						strDiv += '                    <i class="xi-angle-left"></i>';
						strDiv += '                    <span class="tooltip top">위로</span>';
						strDiv += '                </div>';
						strDiv += '                <div class="btn display_num_btn" onclick="displayNumCheck(' + product.product_idx + ',\'down\')">';
						strDiv += '                    <i class="xi-angle-right"></i>';
						strDiv += '                    <span class="tooltip top">아래로</span>';
						strDiv += '                </div>';
						strDiv += '            </div>';						
						
						
						strDiv += '        </div>';
						
						$('#recommend_body').append(strDiv);
					});
				});
			}
		}
	});
	
	getProductCategoryInfo('put');
}

function putPageRecommend() {
	let page_title = $('#page_title').val();
	if (page_title == "" || page_title == null) {
		alert("추천상품 리스트의 타이틀을 입력해주세요.");
		return false;
	}
	
	let option_cnt = $('.option_idx').length;							
	let option_idx = [];
	for (let i=0; i<option_cnt; i++) {
		let checkbox = $('.option_idx').eq(i);
		if (checkbox.prop('checked') == true) {
			option_idx.push(checkbox.val());
		}
	}
	
	if (option_idx.length == 0) {
		alert('하나 이상의 추천상품 리스트 옵션을 선택해주세요.');
		return false;
	}
	
	let product_cnt = $('.product_idx').length;
	if (product_cnt == 0) {
		alert('하나 이상의 추천상품을 선택해주세요.');
		return false;
	}
	
	var formData = new FormData();
	formData = $("#frm-put").serializeObject();
	
	confirm(
		'추천상품 리스트를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "product/recommend/put",
				error: function() {
					alert('추천상품 리스트 수정처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if(d.code == 200) {
						alert(
							'추천상품 리스트가 수정되었습니다.',
							function(){
								location.href='/product/recommend';
							}
						);
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	)
}

function getProductCategoryInfo(action_type) {
	let frm = $('#frm-' + action_type);
	
	frm.find('.js--tree').remove();
	frm.find('.tree__area').append('<div class="js--tree"></div>');
	
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
				if (node.parent != "#") tmp.remove.label = "삭제";
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

		getProductCategoryList(action_type,md_category_node,md_category_depth);
	});
}

function getProductCategoryList(action_type,md_category_node,md_category_depth) {
	let frm = $('#frm-' + action_type);
	let result_table = frm.find('.recommand_result_table');
	
	$.ajax({
		type: "post",
		url: config.api + "product/recommend/category/list/get",
		data: {
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth
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
						
						if ($('#recommend_product_' + row.product_idx).length > 0) {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" onClick="putRecommendProduct(\'DEL\',' + row.product_idx + ');">선택완료</div>';
						} else {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" onClick="putRecommendProduct(\'ADD\',' + row.product_idx + ');">선택</div>';
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

function putRecommendProduct(action_type,product_idx) {
	if (action_type == "ADD" && product_idx != null) {
		$.ajax({
			type: "post",
			url: config.api + "product/recommend/category/get",
			data: {
				'product_idx' : product_idx
			},
			dataType: "json",
			error: function() {
				alert("추천상품 선택/해제 처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					let data = d.data[0];
					
					if (data != null) {
						let strDiv = "";
						strDiv += '        <div id="recommend_product_' + data.product_idx + '" class="product__img__wrap">';
						strDiv += '            <input class="product_idx" type="hidden" name="product_idx[]" value="' + data.product_idx + '">';
						
						let background_url = "background-image:url('" + data.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p class="product_txt">' + data.product_code + '</p><br>';
						strDiv += '                <p class="product_txt">' + data.product_name + '</p><br>';
						strDiv += '                <div class="btn" product_code="' + data.product_code + '" onClick="removeRecommendProduct(' + data.product_idx + ');">삭제</div>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						
						$('#recommend_body').append(strDiv);
					} else {
						alert("추천상품 선택/해제 처리에 실패했습니다. 관련상품을 확인해주세요.");
						return false;
					}
				} else {
					alert(d.msg);
				}
			}
		});
	} else if (action_type == "DEL" && product_idx != null) {
		confirm(
			'선택한 추천상품을 삭제하시겠습니까?',
			function() {
				$('#recommend_product_' + product_idx).remove();
			}
		)
	}
}

function removeRecommendProduct(product_idx) {
	confirm(
		'선택한 추천상품을 삭제하시겠습니까?',
		function() {
			$('#recommend_product_' + product_idx).remove();
		}
	)
}

function displayNumCheck(product_idx,action_type) {
	let recent_obj = $('#recommend_product_' + product_idx);
	let prev_obj = null;
	
	if (action_type == "up") {
		prev_obj = recent_obj.prev();
	} else if (action_type == "down") {
		prev_obj = recent_obj.next();
	}
	
	console.log(prev_obj);
	
	if (prev_obj != null) {
		let check_value = prev_obj.length;
		if (check_value > 0) {
			let tmp_html = document.getElementById("recommend_product_" + product_idx).outerHTML;
			recent_obj.remove();
			if (action_type == "up") {
				prev_obj.before(tmp_html);
			} else if (action_type == "down") {
				prev_obj.after(tmp_html);
			}
		}
	} else {
		alert('진열 순서를 변경할 수 없습니다.');
		return false;
	}
}
</script>