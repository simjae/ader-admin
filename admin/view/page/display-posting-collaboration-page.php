<style>
.cola__left__area {width:17vw;padding:10px;}
	.cola__selector {width:100%;height:22vh;cursor:pointer;padding:5px;margin-bottom:10px;}
		.cola__selector__img {width:100%;height:17vh;background-image:url('/images/main/main_banner_sample.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;}
		.cola__selector__desc__wrap {width:100%;height:5vh;}
			.cola__title__wrap {padding-top:10px;width:50%;display:flex;}
				.page__title {overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size:14px;}
			.cola__btn__wrap {padding-top:10px;width:50%;}
				.get_collaboration_btn {width:65px;text-align:center;float:right;font-size:0.5rem;padding:0px;height:20px;padding-top:3px;}
				.copy_collaboration_btn {width:35px;text-align:center;float:right;font-size:0.5rem;padding:0px;height:20px;padding-top:3px;margin-right:10px;}

.cola__right__area {width:68vw;}
	.cola__title {font-family: NanumSquareRound;font-size:14px;}
	.delete_collaboration_product {margin-top:15px;float:right;background-color:#000000;color:white;margin-left:5px;}

.list_display_num_btn {width:25px;text-align:center;float:right;font-size:0.5rem;padding:0px;height:20px;padding-top:3px;margin-right:10px;}
.product_display_num_btn {margin-top:15px;float:right;margin-left:5px;}
</style>

<div class="content__card">
	<div class="card__header">
		<h3>메인랜딩</h3>
		<div class="drive--x"></div>
	</div>
	
	<form id="frm-put" action="display/posting/collaboration/put">
		<div class="card__body" style="display:flex;">
			<div class="cola__left__area" style="">
			</div>
			
			<div class="cola__right__area">
				<input id="collaboration_idx" type="hidden" name="collaboration_idx" value="">
				<input id="country" type="hidden" name="country" value="">
				<div style="display:flex;padding:10px;">
					<i id="bookmark_flg" class="xi-star-o" style="margin-right:5px;"></i>
					<p class="cola__title"></p>
				</div>
				
				<div class="content__card">
					<div class="card__header">
						<h5>분류 정보</h5>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body" style="display:flex;">
						<div class="table table__wrap" style="margin-top:0px;">
							<table>
								<tbody>
									<tr>
										<td style="width:15%;">상태</td>
										<td>
											<div class="rd__block">
												<input id="posting_status_FALSE" class="posting_status"  type="radio" name="posting_status" value="false">
												<label for="posting_status_FALSE">보류</label>
												
												<input id="posting_status_TRUE" class="posting_status" type="radio" name="posting_status" value="true">
												<label for="posting_status_TRUE">완료</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>제목</td>
										<td>
											<input class="page_title" type="text" name="page_title" value="" readonly>
										</td>
									</tr>
									<tr>
										<td>전시기간</td>
										<td>
											<div class="content__date__picker">
												<input id="display_start_date" class="date_param" type="date" name="display_start_date" class="margin-bottom-6" placeholder="From" style="width:150px;" readonly>
												<font>~</font>
												<input id="display_end_date" class="date_param" type="date" name="display_end_date" placeholder="To" readonly style="width:150px;">
											</div>
										</td>
									</tr>
									<tr>
										<td>정렬순서</td>
										<td>
											<input class="display_num" type="text" name="display_num" value="" style="width:150px;" readonly>
										</td>
									</tr>
									<tr>
										<td>즐겨찾기</td>
										<td>
											<div class="rd__block">
												<input id="bookmark_flg_FALSE" class="bookmark_flg" type="radio" name="bookmark_flg" value="false">
												<label for="bookmark_flg_FALSE">해제</label>
												
												<input id="bookmark_flg_TRUE" class="bookmark_flg"  type="radio" name="bookmark_flg" value="true">
												<label for="bookmark_flg_TRUE">설정</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>	
				</div>
				
				<div class="content__card">
					<div class="card__header">
						<h5>변수 수정</h5>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body" style="display:flex;">
						<div class="table table__wrap" style="margin-top:0px;">
							<table>
								<thead>
									<tr>
										<th style="width:15%;">항목 물리명</th>
										<th style="width:15%;">항목 논리명</th>
										<th>항목값</th>
										<th style="width:5%;">항목추가/삭제</th>
									</tr>
								</thead>
								<tbody class="column_table">
									<tr>
										<td>
											<input type="text" name="phs_column_name[]" value="" placeholder="항목 물리명을 입력해주세요.">
										</td>
										<td>
											<input type="text" name="lgc_column_name[]" value="" placeholder="항목 논리명을 입력해주세요.">
										</td>
										<td>
											<input type="text" name="column_value[]" value="" placeholder="항목값을 입력해주세요.">
										</td>
										<td>
											<div style="display:flex">
												<div class="btn" style="margin-right:5px;" action_type="ADD" onClick="checkColumnAction(this);">
													<i class="xi-plus-min"></i>
												</div>
												<div class="btn" action_type="DEL" onClick="checkColumnAction(this)">
													<i class="xi-minus-min"></i>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>	
				</div>
				
				<div class="content__card">
					<div class="card__header">
						<h5>상품 분류 설정</h5>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body" style="display:flex;">
						<div style="width:100%;height:28vh;overflow-y:auto;">
							<div class="table table__wrap" style="width:100%;margin-top:0px;">
								<table>
									<thead>
										<tr>
											<th colspan="2">대표제품</th>
										</tr>
									</thead>
									<tbody style="height:30vh;">
										<tr>
											<td style="width:25%;">
												<div id="tree__area" style="height:28vh;overflow-y:auto;">
													<div class="js--tree"></div>
												</div>
											</td>
											<td colspan="3" style="width:39vw;vertical-align:top;">
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
																<th>상품코드</th>
																<th>상품이름</th>
																<th>판매가(한국몰)</th>
																<th>판매가(영문몰)</th>
																<th>판매가(중문몰)</th>
															</thead>
															<tbody class="product_table">
																<tr>
																	<td colspan="6">조회 결과가 없습니다.</td>
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
				
				<div class="content__card">
					<div class="card__header">
						<h5>진열 상품 관리</h5>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body" style="display:flex;">
						<div class="table table__wrap" style="margin-top:0px;">
							<table>
								<tbody class="result_table">
									<tr>
										<td style="width:15%;">
											제품 리스트
										</td>
										<td>
											<div class="rd__block">
												<input id="product_list_flg_FALSE" class="product_list_flg" type="radio" name="product_list_flg" value="false">
												<label for="product_list_flg_FALSE">표시안함</label>
												
												<input id="product_list_flg_TRUE" class="product_list_flg"  type="radio" name="product_list_flg" value="true">
												<label for="product_list_flg_TRUE">표시함</label>
											</div>
										</td>
									</tr>
									
									<tr>
										<td>
											제품 바로가기
										</td>
										<td>
											<div class="rd__block">
												<input id="product_link_flg_FALSE" class="product_link_flg" type="radio" name="product_link_flg" value="false">
												<label for="product_link_flg_FALSE">표시안함</label>
												
												<input id="product_link_flg_TRUE" class="product_link_flg"  type="radio" name="product_link_flg" value="true">
												<label for="product_link_flg_TRUE">표시함</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="cola__product__wrap">
					
				</div>
			</div>
		</div>
	</form>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="detail_toggle" toggle="hide"></div>
			<div class="btn__wrap--lg">
				<div  class="defult__color__btn"><span>미리보기</span></div>
				<div  class="blue__color__btn" onClick="putCollaborationInfo();"><span>적용</span></div>
				<div class="defult__color__btn" onClick="location.href='/display/posting'"><span>취소</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getCollaborationInfoList();
});

function getCollaborationInfoList() {
	let div_wrap = $('.cola__left__area');
	div_wrap.html('');
	
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "display/posting/collaboration/list/get",
		error: function() {
			alert("메인 배너 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					let strDiv = "";
					
					let collaboration_idx = data[0].collaboration_idx;
					$('#collaboration_idx').val(collaboration_idx);
					getCollaborationInfo(collaboration_idx);
					
					data.forEach(function(row) {
						let background_url = "background-image:url('" + row.main_img_location + "');background-repeat: no-repeat;background-size:cover;background-position:center;";
						
						strDiv += '<div class="cola__selector display_obj">';
						strDiv += '    <div class="cola__selector__img" style="' + background_url + '"></div>';
						strDiv += '    <div class="cola__selector__desc__wrap" style="display:flex;">';
						strDiv += '        <div class="cola__title__wrap">';
						
						let bookmark_flg = row.bookmark_flg;
						let star = "";
						if (bookmark_flg == true) {
							star = "xi-star";
						} else {
							star = "xi-star-o";
						}
						strDiv += '            <i class="' + star + '" style="margin-right:5px;"></i>';
						strDiv += '            <font class="page__title">' + row.page_title + '</font>';
						strDiv += '        </div>';
						strDiv += '        <div class="cola__btn__wrap">';
						strDiv += '            <div class="btn get_collaboration_btn" onClick="getCollaborationInfo(' + row.collaboration_idx + ');">불러오기</div>';
						strDiv += '            <div class="btn list_display_num_btn" onClick="displayNumCheck(\'LST\',\'down\',' + row.collaboration_idx + ',' + row.display_num + ');"><i class="xi-angle-down"></i></div>';
						strDiv += '            <div class="btn list_display_num_btn" onClick="displayNumCheck(\'LST\',\'up\',' + row.collaboration_idx + ',' + row.display_num + ');"><i class="xi-angle-up"></i></div>';
						strDiv += '        </div>';
						strDiv += '    </div>';
						strDiv += '</div>';
					});
					
					div_wrap.append(strDiv);
				}
			}
		}
	});
}

function getCollaborationInfo(collaboration_idx) {
	let column_table = $('.column_table');
	
	$.ajax({
		type: "post",
		data : {
			'collaboration_idx' : collaboration_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collaboration/get",
		error: function() {
			alert("메인 배너 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						$('#collaboration_idx').val(row.collaboration_idx);
						$('#country').val(row.country);
						let bookmark_flg = row.bookmark_flg;
						let star = "";
						if (bookmark_flg == true) {
							star = "xi-star";
							$('#bookmark_flg_TRUE').prop('checked',true);
							$('#bookmark_flg_FALSE').prop('checked',false);
						} else {
							star = "xi-star-o";
							$('#bookmark_flg_TRUE').prop('checked',false);
							$('#bookmark_flg_FALSE').prop('checked',true);
						}
						
						$('#bookmark_flg').attr('class',star);
						
						$('.cola__title').text(row.page_title);
						
						let posting_status = row.posting_status;
						if (posting_status == true) {
							$('#posting_status_TRUE').prop('checked',true);
							$('#posting_status_FALSE').prop('checked',false);
						} else {
							$('#posting_status_TRUE').prop('checked',false);
							$('#posting_status_FALSE').prop('checked',true);
						}
						
						$('.page_title').val(row.page_title);
						$('#display_start_date').val(row.display_start_date);
						$('#display_end_date').val(row.display_end_date);
						$('.display_num').val(row.display_num);
						
						column_table.html('');
						let column_info = row.column_info;
						let strDiv = "";
						if (column_info != null) {
							column_info.forEach(function(column) {
								strDiv += '<tr>';
								strDiv += '    <td>';
								strDiv += '        <input type="text" name="phs_column_name[]" value="' + column.phs_column_name + '">';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <input type="text" name="lgc_column_name[]" value="' + column.lgc_column_name + '">';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <input type="text" name="column_value[]" value="' + column.column_value + '">';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <div style="display:flex">';
								strDiv += '            <div class="btn" style="margin-right:5px;" action_type="ADD" onClick="checkColumnAction(this);">';
								strDiv += '                <i class="xi-plus-min"></i>';
								strDiv += '            </div>';
								strDiv += '            <div class="btn" action_type="DEL" onClick="checkColumnAction(this);">';
								strDiv += '                <i class="xi-minus-min"></i>';
								strDiv += '            </div>';
								strDiv += '        </div>';
								strDiv += '    </td>';
								strDiv += '</tr>';
							});
						} else {
							strDiv += '<tr>';
							strDiv += '    <td>';
							strDiv += '        <input type="text" name="phs_column_name[]" value="" placeholder="항목 물리명을 입력해주세요.">';
							strDiv += '    </td>';
							strDiv += '    <td>';
							strDiv += '        <input type="text" name="lgc_column_name[]" value="" placeholder="항목 논리명을 입력해주세요.">';
							strDiv += '    </td>';
							strDiv += '    <td>';
							strDiv += '        <input type="text" name="column_value[]" value="" placeholder="항목값을 입력해주세요.">';
							strDiv += '    </td>';
							strDiv += '    <td>';
							strDiv += '        <div style="display:flex">';
							strDiv += '            <div class="btn" style="margin-right:5px;" action_type="ADD" onClick="checkColumnAction(this);">';
							strDiv += '                <i class="xi-plus-min"></i>';
							strDiv += '            </div>';
							strDiv += '            <div class="btn" action_type="DEL" onClick="checkColumnAction(this)">';
							strDiv += '                <i class="xi-minus-min"></i>';
							strDiv += '            </div>';
							strDiv += '        </div>';
							strDiv += '    </td>';
							strDiv += '</tr>';
						}
						column_table.append(strDiv);
						
						let product_list_flg = row.product_list_flg;
						if (product_list_flg == true) {
							$('#product_list_flg_TRUE').prop('checked',true);
							$('#product_list_flg_FALSE').prop('checked',false);
						} else {
							$('#product_list_flg_TRUE').prop('checked',false);
							$('#product_list_flg_FALSE').prop('checked',true);
						}
						
						let product_link_flg = row.product_list_flg;
						if (product_link_flg == true) {
							$('#product_link_flg_TRUE').prop('checked',true);
							$('#product_link_flg_FALSE').prop('checked',false);
						} else {
							$('#product_link_flg_TRUE').prop('checked',false);
							$('#product_link_flg_FALSE').prop('checked',true);
						}
						
						$('.cola__product__wrap').html('');
						let product_info = row.product_info;
						if (product_info != null) {
							let strDiv = "";
							product_info.forEach(function(product_row) {
								strDiv += '<div class="content__card display_obj">';
								strDiv += '    <input type="hidden" name="collabo_product_idx[]" value="' + product_row.collabo_product_idx + '">';
								strDiv += '    <div class="card__header">';
								strDiv += '        <h5>' + product_row.product_code + '</h5>';
								strDiv += '        <div class="drive--x"></div>';
								strDiv += '    </div>';
								strDiv += '    ';
								strDiv += '    <div class="card__body">';
								strDiv += '        <div class="table table__wrap" style="margin-top:0px;">';
								strDiv += '            <table>';
								strDiv += '                <tbody>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">상품명</td>';
								strDiv += '                        <td>' + product_row.product_name + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">가격</td>';
								strDiv += '                        <td>' + product_row.sales_price + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">색상</td>';
								strDiv += '                        <td>' + product_row.color + ' : ' + product_row.color_rgb + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">소재</td>';
								strDiv += '                        <td>' + product_row.material + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">이미지</td>';
								strDiv += '                        <td>' + product_row.img_location + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td style="width:15%;">상세페이지</td>';
								strDiv += '                        <td>/product/detail?product_idx=' + row.product_idx + '</td>';
								strDiv += '                    </tr>';
								strDiv += '                    <tr>';
								strDiv += '                        <td>진열여부</td>';
								
								let display_flg = product_row.display_flg;
								let checked_true = "";
								let checked_false = "";
								if (display_flg == true) {
									checked_true = "checked";
								} else if (display_flg == false) {
									checked_false = "checked";
								}
								
								strDiv += '                        <td>';
								strDiv += '                            <div class="rd__block">';
								strDiv += '                                <input id="display_flg_FALSE_' + product_row.collabo_product_idx + '" class="display_flg"  type="radio" name="display_flg_' + product_row.collabo_product_idx + '" value="false" ' + checked_false + '>';
								strDiv += '                                <label for="display_flg_FALSE_' + product_row.collabo_product_idx + '">표시안함</label>';
								strDiv += '                                ';
								strDiv += '                                <input id="display_flg_TRUE_' + product_row.collabo_product_idx + '" class="display_flg" type="radio" name="display_flg_' + product_row.collabo_product_idx + '" value="true" ' + checked_true + '>';
								strDiv += '                                <label for="display_flg_TRUE_' + product_row.collabo_product_idx + '">표시함</label>';
								strDiv += '                            </div>';
								strDiv += '                        </td>';
								strDiv += '                    </tr>';
								strDiv += '                </tbody>';
								strDiv += '            </table>';
								strDiv += '        </div>';
								strDiv += '        <div class="btn delete_collaboration_product" collabo_product_idx="' + product_row.collabo_product_idx + '" onClick="deleteCollaborationProduct(this)">삭제하기</div>';
								strDiv += '        <div class="btn product_display_num_btn" onClick="displayNumCheck(\'PRD\',\'up\',' + product_row.collabo_product_idx + ',' + product_row.display_num + ');"><i class="xi-angle-up"></i></div>';
								strDiv += '        <div class="btn product_display_num_btn" onClick="displayNumCheck(\'PRD\',\'down\',' + product_row.collabo_product_idx + ',' + product_row.display_num + ');"><i class="xi-angle-down"></i></div>';
								strDiv += '    </div>';
								strDiv += '</div>';
							});
							
							$('.cola__product__wrap').append(strDiv);
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
						
						let collaboration_idx = $('#collaboration_idx').val();
						getCollaborationProduct(collaboration_idx,md_category_node,md_category_depth);
					});
				}
			}
		}
	});
}

function putCollaborationInfo() {
	
}

function checkColumnAction(obj) {
	let action_type = $(obj).attr('action_type');
	
	if (action_type == "DEL") {
		let div_tr = $(obj).parent().parent().parent().remove();
	} else if (action_type == "ADD") {
		let strDiv = "";
		strDiv += '<tr>';
		strDiv += '    <td>';
		strDiv += '        <input type="text" name="phs_column_name[]" value="" placeholder="항목 물리명을 입력해주세요.">';
		strDiv += '    </td>';
		strDiv += '    <td>';
		strDiv += '        <input type="text" name="lgc_column_name[]" value="" placeholder="항목 논리명을 입력해주세요.">';
		strDiv += '    </td>';
		strDiv += '    <td>';
		strDiv += '        <input type="text" name="column_value[]" value="" placeholder="항목값을 입력해주세요.">';
		strDiv += '    </td>';
		strDiv += '    <td>';
		strDiv += '        <div style="display:flex">';
		strDiv += '            <div class="btn" style="margin-right:5px;" action_type="ADD" onClick="checkColumnAction(this);">';
		strDiv += '                <i class="xi-plus-min"></i>';
		strDiv += '            </div>';
		strDiv += '            <div class="btn" action_type="DEL" onClick="checkColumnAction(this)">';
		strDiv += '                <i class="xi-minus-min"></i>';
		strDiv += '            </div>';
		strDiv += '        </div>';
		strDiv += '    </td>';
		strDiv += '</tr>';
		
		$('.column_table').append(strDiv);
	}
	
}

function getCollaborationProduct(collaboration_idx,md_category_node,md_category_depth) {
	let product_table = $('.product_table');
	
	$.ajax({
		type: "post",
		data: {
			'collaboration_idx' : collaboration_idx,
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth
		},
		dataType: "json",
		url: config.api + "display/posting/collaboration/product/get",
		error: function() {
			alert("메인 컨텐츠 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				product_table.html('');
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<tr>';
						strDiv += '    <td>';
						
						let action_type = row.action_type;
						if (action_type == "ADD") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + row.product_idx + '" onClick="putCollaborationProduct(this);">선택</div>';	
						} else if (action_type == "DEL") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + row.product_idx + '" onClick="putCollaborationProduct(this);">선택완료</div>';	
						}
						
						strDiv += '    </td>';
						strDiv += '    <td>' + row.product_code + '</td>';
						strDiv += '    <TD>';
						strDiv += '        <div class="product__img__wrap">';
						
						var background_url = "background-image:url('" + row.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p>' + row.product_name + '</p><br>';
						strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_kr = row.discount_kr;
						if (discount_kr > 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
							strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
						} else {
							if(row.price_kr != null){
								strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
							}
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_en = row.discount_en;
						if (discount_en > 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
							strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
						} else {
							if(row.price_en != null){
								strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
							}
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_cn = row.discount_cn;
						if (discount_cn > 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
							strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
						} else {
							if(row.price_cn != null){
								strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
							}
						}
						
						strDiv += '    </td>';
						strDiv += '</tr>';
					});
					
					product_table.append(strDiv);
				} else {
					let strDiv = "";
					strDiv += '<tr>';
					strDiv += '	<td colspan="6">조회 결과가 없습니다.</td>';
					strDiv += '</tr>';
					
					product_table.append(strDiv);
				}
			}
		}
	});
}

function putCollaborationProduct(obj) {
	let action_type = $(obj).attr('action_type');
	let collaboration_idx = $('#collaboration_idx').val();
	let product_idx = $(obj).attr('product_idx');
	
	$.ajax({
		type: "post",
		data: {
			'action_type' : action_type,
			'collaboration_idx' : collaboration_idx,
			'product_idx' : product_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collaboration/product/put",
		error: function() {
			alert("메인 컨텐츠 수정처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let strDiv = "";
				if (action_type == "ADD") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + product_idx + '" onClick="putCollaborationProduct(this);">선택완료</div>';	
				} else if (action_type == "DEL") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + product_idx + '" onClick="putCollaborationProduct(this);">선택</div>';	
				}
				
				let div_parent = $(obj).parent();
				div_parent.html(strDiv);
				
				getCollaborationProductList();
			} else {
				alert("메인 컨텐츠 상품 선택처리에 실패했습니다. 선택하려는 메인 컨텐츠의 상품을 확인해주세요.");
			}
		}
	});
}

function getCollaborationProductList() {
	let country = $('#country').val();
	let collaboration_idx = $('#collaboration_idx').val();
	
	$.ajax({
		type: "post",
		data : {
			'country' : country,
			'collaboration_idx' : collaboration_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collaboration/product/list/get",
		error: function() {
			alert("메인 배너 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				$('.cola__product__wrap').html('');
				
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<div class="content__card display_obj">';
						strDiv += '    <input type="hidden" name="collabo_product_idx[]" value="' + row.collabo_product_idx + '">';
						strDiv += '    <div class="card__header">';
						strDiv += '        <h5>' + row.product_code + '</h5>';
						strDiv += '        <div class="drive--x"></div>';
						strDiv += '    </div>';
						strDiv += '    ';
						strDiv += '    <div class="card__body">';
						strDiv += '        <div class="table table__wrap" style="margin-top:0px;">';
						strDiv += '            <table>';
						strDiv += '                <tbody>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">상품명</td>';
						strDiv += '                        <td>' + row.product_name + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">가격</td>';
						strDiv += '                        <td>' + row.sales_price + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">색상</td>';
						strDiv += '                        <td>' + row.color + ' : ' + row.color_rgb + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">소재</td>';
						strDiv += '                        <td>' + row.material + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">이미지</td>';
						strDiv += '                        <td>' + row.img_location + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td style="width:15%;">상세페이지</td>';
						strDiv += '                        <td>/product/detail?product_idx=' + row.product_idx + '</td>';
						strDiv += '                    </tr>';
						strDiv += '                    <tr>';
						strDiv += '                        <td>진열여부</td>';
						
						let display_flg = row.display_flg;
						let checked_true = "";
						let checked_false = "";
						if (display_flg == true) {
							checked_true = "checked";
						} else if (display_flg == false){
							checked_false = "checked";
						}
						
						strDiv += '                        <td>';
						strDiv += '                            <div class="rd__block">';
						strDiv += '                                <input id="display_flg_FALSE_' + row.collabo_product_idx + '" class="display_flg"  type="radio" name="display_flg_' + row.collabo_product_idx + '" value="false" ' + checked_false + '>';
						strDiv += '                                <label for="display_flg_FALSE_' + row.collabo_product_idx + '">표시안함</label>';
						strDiv += '                                ';
						strDiv += '                                <input id="display_flg_TRUE_' + row.collabo_product_idx + '" class="display_flg" type="radio" name="display_flg_' + row.collabo_product_idx + '" value="true" ' + checked_true + '>';
						strDiv += '                                <label for="display_flg_TRUE_' + row.collabo_product_idx + '">표시함</label>';
						strDiv += '                            </div>';
						strDiv += '                        </td>';
						strDiv += '                    </tr>';
						strDiv += '                </tbody>';
						strDiv += '            </table>';
						strDiv += '        </div>';
						strDiv += '        <div class="btn delete_collaboration_product" collabo_product_idx="' + row.collabo_product_idx + '" onClick="deleteCollaborationProduct(this)">삭제하기</div>';
						strDiv += '        <div class="btn product_display_num_btn" onClick="displayNumCheck(\'PRD\',\'up\',' + row.collabo_product_idx + ',' + row.display_num + ');"><i class="xi-angle-up"></i></div>';
						strDiv += '        <div class="btn product_display_num_btn" onClick="displayNumCheck(\'PRD\',\'down\',' + row.collabo_product_idx + ',' + row.display_num + ');"><i class="xi-angle-down"></i></div>';
						strDiv += '    </div>';
						strDiv += '</div>';
					});
					
					$('.cola__product__wrap').append(strDiv);
				}
			} else {
				alert(d.msg);
			}
		}
	});
}

function deleteCollaborationProduct(obj) {
	let collaboration_idx = $('#collaboration_idx').val();
	let collabo_product_idx = $(obj).attr('collabo_product_idx');
	
	confirm(
		'선택한 콜라보레이션 상품을 삭제하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data : {
					'collaboration_idx' : collaboration_idx,
					'collabo_product_idx' : collabo_product_idx
				},
				dataType: "json",
				url: config.api + "display/posting/collaboration/product/delete",
				error: function() {
					alert("메인 배너 조회처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						$(obj).parent().parent().remove();
						alert("선택한 콜라보레이션 상품이 삭제되었습니다.");
					} else {
						alert(d.msg);
					}
				}
			});
		}
	)
}

function displayNumCheck(obj_type,action_type,recent_idx,recent_num) {
	let div_container = null;
	if (obj_type == "LST") {
		div_container = $('.cola__left__area');
	} else if (obj_type == "PRD") {
		div_container = $('.cola__product__wrap');
	}
	
	if (recent_idx > 0 && recent_num > 0) {
		let cnt = div_container.find('.display_obj').length;
		
		if (action_type == "up") {
			if (recent_num == 1) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				updateDisplayNum(obj_type,action_type,recent_idx,recent_num);
			}
		} else if (action_type == "down") {
			if (recent_num == cnt) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		}
	} else {
		alert('진열순서 변경 대상을 선택해주세요.');
		return false;
	}
}

function updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num) {
	let dir_api = "";
	let collaboration_idx = 0
	if (obj_type == "PRD") {
		dir_api = "product/";
		collaboration_idx = $('#collaboration_idx').val();
	}
	
	$.ajax({
		url: config.api + "display/posting/collaboration/" + dir_api + "put",
		type: "post",
		data: {
			'display_num_flg': true,
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num,
			'collaboration_idx':collaboration_idx
		},
		dataType: "json",
		error: function() {
			alert('게시물 스토리 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				if (obj_type == "LST") {
					getCollaborationInfoList();
				} else if (obj_type == "PRD") {
					getCollaborationProductList();
				}
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 진열순서를 확인해주세요.');
			}
		}
	});
}

function putCollaborationInfo() {
	let frm = $('#frm-put');
	let formData = new FormData();
	formData = frm.serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/posting/collaboration/put",
		error: function() {
			alert("메인 배너 수정처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					'콜라보레이션 정보가 정상적으로 수정되었습니다.',
					function() {
						location.href="/display/posting";
					}
				);
			} else {
				alert("메인 배너 수정처리에 실패했습니다. 수정하려는 메인 배너를 확인해주세요.");
			}
		}
	});
}
</script>