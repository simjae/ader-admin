<style>
.toggle_table_btn {background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;}
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.btn__gray{height: 20px;color: #fff;padding: 3.5px 20px;border-radius: 2px;background-color: #bfbfbf;cursor:pointer;}
.size_info_text {height:150px;}
.smart_editer_text {height:180px;}
.price__text{text-align:right;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$ordersheet_idx = getUrlParamter($page_url, 'ordersheet_idx');
	?>
	
	<div class="card__header">
		<div class="flex justify-between">
			<h3>오더시트 개별 조회</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div id="regist_td_tab" class="row regist_tab" style="margin-top:0px;">
			<form id="frm-regist" action="" enctype="multipart/form-data">
				<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="<?=$ordersheet_idx?>">
				
				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('MD');">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_MD">
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>제품년도</TH>
									<TD id="year"></TD>
									
									<TH>스타일코드</TH>
									<TD id="style_code"></TD>
									
									<TH>컬러코드</TH>
									<TD id="color_code"></TD>
									
									<TH>상품코드</TH>
									<TD id="product_code"></TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>프리오더 사용여부</TH>
									<TD colspan="3" id="preorder_flg">
									
									<TH>교환 환불 가능유무</TH>
									<TD colspan="3" id="refund_flg">
								</TR>
								
								<tr>
									<TH>라인 유형</TH>
									<TD colspan="3" id="line_info_table">
									
									<TH>MD 카테고리</TH>
									<TD colspan="3">
										<table style="width:100%">
											<tbody>
												<tr>
													<td style="width:25%" id="category_lrg_title"></td>
													<td style="width:25%" id="category_mdl_title"></td>
													<td style="width:25%" id="category_sml_title"></td>
													<td style="width:25%" id="category_dtl_title"></td>
												</tr>
											</tbody>
										</table>
									</TD>
								</tr>
								
								<TR>
									<TH>상품 이름</TH>
									<TD colspan="3" id="product_name"></TD>
									
									<TH>상품 그래픽</TH>
									<TD colspan="3" id="graphic"></TD>
								</TR>
								
								<TR>
									<TH>상품 사이즈</TH>
									<TD colspan="3" id="product_size"></TD>
									
									<TH>상품 색상</TH>
									<TD colspan="3" id="color"></TD>
								</TR>
								
								<TR>
									<TH>MD 카테고리 가이드</TH>
									<TD colspan="3" id="md_category_guide"></TD>
									
									<TH>구매수량 제한 유무</TH>
									<TD id="limit_product_qty_flg"></TD>
									
									<TH>구매제한 수량</TH>
									<TD id="limit_product_qty"></TD>
								</TR>
								
								<TR>
									<TH>ID당 구매제한</TH>
									<TD colspan="3" id="limit_id_flg"></TD>
									
									<TH>구매 멤버 제한</TH>
									<TD colspan="3" id="limit_member"></TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<div style="margin-top:5px;">
							<div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
							<div class="overflow-x-auto">
								<TABLE>
									<colgroup>
										<col width="20%">
										<col width="20%">
										<col width="20%">
										<col width="20%">
										<col width="20%">
									</colgroup>
									<TBODY>
										<TR>
											<TH>기획원가</TH>
											<TH>한국몰 판매가격 (원)</TH>
											<TH>영문몰 변환가격 (원)</TH>
											<TH>영문몰 판매가격 (달러)</TH>
											<TH>중문몰 판매가격 (달러)</TH>
										</TR>
										<TR>
											<TD id="price_cost" class="price__text"></TD>
											<TD id="price_kr" class="price__text"></TD>
											<TD id="price_kr_gb" class="price__text"></TD>
											<TD id="price_en" class="price__text"></TD>
											<TD id="price_cn" class="price__text"></TD>
										</TR>
									</TBODY>
								</TABLE>
							</div>
						</div>
						
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="40%">
								<col width="10%">
								<col width="40%">
							</colgroup>
							<TBODY>
								<tr>
									<TH>기획재고 수량</TH>
									<TD id="product_qty"></TD>
									
									<TH>안전재고 수량</TH>
									<TD id="safe_qty"></TD>
								</tr>
								
								<tr>
									<TH>입고 요청일</TH>
									<TD id="receive_request_date"></TD>
									
									<TH>런칭일</TH>
									<TD id="launching_date"></TD>
								</tr>
							</TBODY>
						</TABLE>
					</div>
				</div>

				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('DSN');">오더시트 - 디자인</button>
					<div class="overflow-x-auto" id="insert_table_DSN">
						<TABLE class="size_info_table">
							<colgroup>
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
							</colgroup>
							<TBODY>
								<tr>
									<th>소재</th>
									<td id="material"></td>
									
									<th>상품 핏</th>
									<td id="fit"></td>
									
									<th>rgb코드</th>
									<td id="color_rgb"></td>
									
									<th>팬톤 코드</td>
									<td id="pantone_code"></td>
								</tr>
								<tr>
									<TH>W/K/L/A</TH>
									<TD colspan="3">
										<div id="div_wkla" style="margin-top:5px">
										</div>
									</TD>
									
									<th>모델</th>
									<TD id="model"></TD>
									
									<th>모델착용 사이즈</th>
									<TD id="model_wear"></TD>
								</TR>
								
								<TR>
									<TD colspan="8">
										<div class="content__row">
											<select id="size_guide_idx" name="size_guide_idx" class="fSelect eSearch" style="width:163px;" onChange="getSizeGuideList();">
												<?php
													$select_size_guide_sql = "
														SELECT
															SG.IDX				AS SIZE_IDX,
															SG.CATEGORY_TYPE	AS CATEGORY_TYPE
														FROM
															ORDERSHEET_MST OM
															LEFT JOIN SIZE_GUIDE SG ON
															OM.SIZE_GUIDE_IDX = SG.IDX
														WHERE
															OM.IDX = ".$ordersheet_idx."
													";
													
													$db->query($select_size_guide_sql);

													foreach ($db->fetch() as $size_data) {
														$size_idx = $size_data['SIZE_IDX'];
														if (!empty($size_idx)) {
												?>
													<option value="<?=$size_data['SIZE_IDX']?>" readonly><?=$size_data['CATEGORY_TYPE']?></option>
												<?php
														} else {
												?>
													<option value="" readonly>사이즈 가이드 미선택</option>
												<?php
														}
													}
												?>
											</select>
										</div>
										
										<div id="div_size_guide">
										</div>
									</TD>
								</TR>
								
								<TR id="ordersheet_option_info">
									
								</TR>
								
								<TR>
									<TH>최초 TP 작성일</TD>
									<TD id="tp_completion_date" colspan="7"></TD>
								</TR>
							</TBODY>
						</TABLE>

						<TABLE style="margin-top:5px">
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TH style="width:10%;">제품 상세정보 (한글)</TH>
									<TD class="smart_editer_text" id="detail_dsn_kr"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (영문)</TH>
									<TD class="smart_editer_text" id="detail_dsn_en"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (중문)</TH>
									<TD class="smart_editer_text" id="detail_dsn_cn"></TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<TABLE style="margin-top:5px">
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (한글)</TH>
									<TD class="smart_editer_text" id="care_dsn_kr"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (영문)</TH>
									<TD class="smart_editer_text" id="care_dsn_en"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (중문)</TH>
									<TD class="smart_editer_text" id="care_dsn_cn"></TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('TD');">오더시트 - 생산</button>
					<div class="overflow-x-auto" id="insert_table_TD">
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>제품 취급 유의사항<br>생산(한글)</TH>
									<TD class="smart_editer_text" id="care_td_kr"></TD>
								</TR>
								<TR>
									<TH>제품 취급 유의사항<br>생산(영문)</TH>
									<TD class="smart_editer_text" id="care_td_en"></TD>
								</TR>
								<TR>
									<TH>제품 취급 유의사항<br>생산(중문)</TH>
									<TD class="smart_editer_text" id="care_td_cn"></TD>
								</TR>
								<TR>
									<TH>소재(한글)</TH>
									<TD class="smart_editer_text" id="material_text_kr"></TD>
								</TR>

								<TR>
									<TH>소재(영문)</TH>
									<TD class="smart_editer_text" id="material_text_en"></TD>
								</TR>

								<TR>
									<TH>소재(중문)</TH>
									<TD class="smart_editer_text" id="material_text_cn"></TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
								<col width="10%">
								<col width="15%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>제조사</TD>
									<TD id="manufacturer"></TD>
									
									<TH>공급사</TD>
									<TD id="supplier"></TD>
								
									<TH>원산지</TH>
									<TD id="origin_country"></TD>
									
									<TH>브랜드</TH>
									<TD id="brand"></TD>
								</TR>
								
								<tr>
									<TH>상품 적재박스 유형</TH>
									<TD colspan="7" id="load_box_info_table">
								</tr>
								
								<tr>
									<TH>상품 적재중량 (kg)</TH>
									<TD id="load_weight" colspan="3"></TD>
									
									<TH>상품 적재수량</TH>
									<TD id="load_qty" colspan="3"></TD>
								</tr>
								
								<tr>
									<TH>포장부자재</TH>
									<TD colspan="3">
										<table>
											<tbody id="package_sub_material">
											</tbody>
										</table>
									</TD>
									
									<TH>배송부자재</TH>
									<TD colspan="3">
										<table>
											<tbody id="delivery_sub_material">
											</tbody>
										</table>
									</TD>
								</tr>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</form>
		</div>
		
		<div class="flex justify-center">
			<button type="button" style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px" onClick="location.href='/pcs/ordersheet/list'">돌아가기</button>
		</div>
	</div>
</div>
<script>
var size_category_info = {};

$(document).ready(function() {
	getOrdersheetInfo();
});

function toggleTableClick(toggle_val) {
	$('#insert_table_' + toggle_val).toggle();
}

function getOrdersheetInfo() {
	let ordersheet_idx = $('#ordersheet_idx').val();
	
	$.ajax({
		type: "post",
		url: config.api + "pcs/ordersheet/get",
		data:{
			'sel_idx' : ordersheet_idx
		},
		dataType: "json",
		error: function() {
			alert("오더시트 조회처리중 오루가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				
				//ORDERSHEET - MD
				$('#year').text(data.year);
				$('#style_code').text(data.style_code);
				$('#color_code').text(data.color_code);
				$('#product_code').text(data.product_code);
				
				if (data.preorder_flg == true) {
					$('#preorder_flg').text('일반상품');
				} else if (data.preorder_flg == false) {
					$('#preorder_flg').text('프리오더 상품');
				}
				
				if (data.refund_flg == true) {
					$('#refund_flg').text('교환 불가');
				} else if (data.refund_flg == false) {
					$('#refund_flg').text('교환 가능');
				}

				if (data.line_idx != null && data.line_idx > 0) {
					let strDiv = "";
					strDiv += '<table style="width:100%">';
					strDiv += '    <thead>';
					strDiv += '        <tr>';
					strDiv += '            <th>라인명</th>';
					strDiv += '            <th>타입</th>';
					strDiv += '            <th>라인 컬러</th>';
					strDiv += '        </tr>';
					strDiv += '    </thead>';
					strDiv += '    <tbody>';
					strDiv += '        <tr>';
					strDiv += '            <td>' + data.line_name + '</td>';
					strDiv += '            <td>' + data.line_type + '</td>';
					strDiv += '            <td>' + data.line_memo + '</td>';
					strDiv += '        </tr>';
					strDiv += '    </tbody>';
					strDiv += '</table>';
					
					$('#line_info_table').append(strDiv);
				}

				$('#category_lrg_title').text(data.category_lrg_title);
				$('#category_mdl_title').text(data.category_mdl_title);
				$('#category_sml_title').text(data.category_sml_title);
				$('#category_dtl_title').text(data.category_dtl_title);
				$('#product_name').text(data.product_name);
				$('#graphic').text(data.graphic);
				$('#product_size').text(data.product_size);
				$('#color').text(data.color);
				$('#md_category_guide').text(data.md_category_guide);
				
				if(data.limit_id_flg == false){
					$('input:radio[name=limit_id_flg]:input[value="false"]').attr("checked",true);
				} else if(data.limit_id_flg == true){
					$('input:radio[name=limit_id_flg]:input[value="true"]').attr("checked",true);
				}
				
				if (data.limit_product_qty_flg == true) {
					$('#limit_product_qty_flg').text('구매수량 제한');
				} else if (data.limit_product_qty_flg == false) {
					$('#limit_product_qty_flg').text('제한 없음');
				}
				
				if (data.limit_product_qty_flg == true) {
					$('#limit_id_flg').text('ID당 구매 제한');
				} else if (data.limit_product_qty_flg == false) {
					$('#limit_id_flg').text('ID당 구매 제한 없음');
				}
				
				$('#limit_product_qty').text(data.limit_product_qty);
				
				$('#price_cost').text(data.price_cost_format);
				$('#price_kr_gb').text(data.price_kr_gb_format);
				$('#price_kr').text(data.price_kr_format);
				$('#price_en').text(data.price_en_format);
				$('#price_cn').text(data.price_cn_format);
				$('#limit_member').text(data.limit_member);
				$('#product_qty').text(data.product_qty);
				$('#safe_qty').text(data.safe_qty);
				$('#receive_request_date').text(data.receive_request_date);
				$('#launching_date').text(data.launching_date);
				
				//ORDERSHEET - DSN
				$('#material').text(data.material);
				$('#fit').text(data.fit);
				$('#color_rgb').text(data.color_rgb);
				$('#pantone_code').text(data.pantone_code);

				let wkla_idx = data.wkla_idx;
				getWklaInfo(wkla_idx);
				$('#model').text(data.model);
				$('#model_wear').text(data.model_wear);
				
				let option_info = data.option_info;
				getSizeGuideList(option_info);
				
				$('#tp_completion_date').text(data.tp_completion_date);
				$('#detail_dsn_kr').html(data.detail_kr);
				$('#detail_dsn_en').html(data.detail_en);
				$('#detail_dsn_cn').html(data.detail_cn);
				$('#care_dsn_kr').html(data.care_dsn_kr);
				$('#care_dsn_en').html(data.care_dsn_en);
				$('#care_dsn_cn').html(data.care_dsn_cn);
				
				//ORDERSHEET - TD
				$('#care_td_kr').html(data.care_td_kr);
				$('#care_td_en').html(data.care_td_en);
				$('#care_td_cn').html(data.care_td_cn);
				$('#material_text_kr').html(data.material_kr);
				$('#material_text_en').html(data.material_en);
				$('#material_text_cn').html(data.material_cn);
				$('#manufacturer').text(data.manufacturer);
				$('#supplier').text(data.supplier);
				$('#origin_country').text(data.origin_country);
				$('#brand').text(data.brand);

				if(data.load_box_idx != null && data.load_box_idx > 0){
					let strDiv = "";
					strDiv += '<table>';
					strDiv += '    <thead>';
					strDiv += '        <tr>';
					strDiv += '            <th>상자명</th>';
					strDiv += '            <th>너비</th>';
					strDiv += '            <th>길이</th>';
					strDiv += '            <th>높이</th>';
					strDiv += '            <th>부피</th>';
					strDiv += '        </tr>';
					strDiv += '    </thead>';
					strDiv += '    <tbody>';
					strDiv += '        <tr>';
					strDiv += '            <td>' + data.load_box_name + '</td>';
					strDiv += '            <td>' + data.load_box_width + ' cm</td>';
					strDiv += '            <td>' + data.load_box_length + ' cm</td>';
					strDiv += '            <td>' + data.load_box_height + ' cm</td>';
					strDiv += '            <td>' + data.load_box_volume + ' cm³</td>';
					strDiv += '        </tr>';
					strDiv += '    </tbody>';
					strDiv += '</table>';
					
					$('#load_box_info_table').append(strDiv);
				}
				
				$('#load_weight').text(data.load_weight);
				$('#load_qty').text(data.load_qty);
				
				var sub_info = data.sub_material_info;
				console.log(sub_info);
				
				var sub_info = data.sub_material_info;
				sub_info.forEach(function(sub_data){
					if(sub_data.sub_material_type == 'T'){
						$('#package_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');

					} else if(sub_data.sub_material_type == 'D'){
						$('#delivery_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');
					}
				});
				
				$('#load_box_idx option:contains("' + data.load_box_idx + '")').attr("selected","selected").change();
				$('#deliver_box_idx option:contains("' + data.deliver_box_idx + '")').attr("selected","selected").change();
				$('#load_weight').val(data.load_weight);
				$('#load_qty').val(data.load_qty);
				$('#sub_material_code').val(data.sub_material_code);
			}
		}
	});
}

function getWklaInfo(wkla_idx) {
	let div_wkla = $('#div_wkla');
	div_wkla.html('');
	
	if (wkla_idx > 0) {
		$.ajax({
			type: "post",
			url: config.api + "pcs/ordersheet/dsn/wkla/get",
			data: {
				'sel_wkla_idx': wkla_idx
			},
			dataType: "json",
			error: function () {
				alert("W/K/L/A 정보 조회처리중 오류가 발생했습니다.");
			},
			success: function (d) {
				if (d.code == 200) {
					let data = d.data[0];
					if (data != null) {
						let strDiv = "";
						strDiv += '    <table style="width:100%">';
						strDiv += '        <thead>';
						strDiv += '            <tr>';
						strDiv += '                <th style="width:50%;">W/K/L/A</th>';
						strDiv += '                <th style="width:50%;">비고</th>';
						strDiv += '            </tr>';
						strDiv += '        </thead>';
						strDiv += '        <tbody>';
						strDiv += '            <tr>';
						strDiv += '                <td>' + data.wkla_name + '</td>';
						strDiv += '                <td>' + data.wkla_memo + '</td>';
						strDiv += '            </tr>';
						strDiv += '        </tbody>';
						strDiv += '    </table>';
						
						div_wkla.append(strDiv);
					}
				}
			}
		});
	} else {
		let strDiv = "";
		strDiv += '    <table style="width:40%">';
		strDiv += '        <thead>';
		strDiv += '            <tr>';
		strDiv += '                <th style="width:50%;">W/K/L/A</th>';
		strDiv += '                <th style="width:50%;">비고</th>';
		strDiv += '            </tr>';
		strDiv += '        </thead>';
		strDiv += '        <tbody>';
		strDiv += '            <tr>';
		strDiv += '                <td colspan="2">등록된 W/K/L/A 정보가 없습니다.</td>';
		strDiv += '            </tr>';
		strDiv += '        </tbody>';
		strDiv += '    </table>';
		
		div_wkla.append(strDiv);
	}
}

function getSizeGuideList(option_info) {
	let size_guide_idx = $('#size_guide_idx').val();
	
	$.ajax({
		type: "post",
		url: config.api + "product/size_guide/get",
		data: {
			'size_guide_idx' : size_guide_idx
		},
		dataType: "json",
		error: function () {
			alert("사이즈정보 조회처리중 오류가 발생했습니다.");
		},
		success: function (d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					let size_data = d.data[0];
					
					let str_div_option_th = "";
					let colspan_cnt = 0;
					
					let str_div_size_desc = "";
					str_div_size_desc += '    <div style="float:left;width: 33%;">';
					str_div_size_desc += '        <img id="size_img" src="/images/size/' + size_data.img_file_name + '.svg">';
					str_div_size_desc += '    </div>';
					str_div_size_desc += '    <div style="float:left;width: 50%;padding-top:50px;">';
					str_div_size_desc += '        <table>';
					
					if (size_data.size_title_1 != null && size_data.size_desc_1 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_1 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_1 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_1 + '</TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_2 != null && size_data.size_desc_2 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_2 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_2 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_2 + '</TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_3 != null && size_data.size_desc_3 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_3 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_3 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_3 + '</TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_4 != null && size_data.size_desc_4 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_4 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_4 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_4 + '</TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_5 != null && size_data.size_desc_5 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_5 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_5 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_5 + '</TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_6 != null && size_data.size_desc_6 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_6 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_6 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH>' + size_data.size_title_6 + '</TH>';
						colspan_cnt++;
					}
					
					str_div_size_desc += '        </table>';
					str_div_size_desc += '    </div>';
					
					$('#div_size_guide').html('');
					$('#div_size_guide').append(str_div_size_desc);
					
					let str_div_option_table = "";
					
					str_div_option_table += '<TD colspan="8">';
					str_div_option_table += '    <TABLE>';
					str_div_option_table += '        <THEAD>';
					str_div_option_table += '            <TR>';
					str_div_option_table += '                <TH>옵션이름</TH>';
					str_div_option_table += '                <TH>바코드</TH>';
					
					str_div_option_table += str_div_option_th;
					
					str_div_option_table += '                <TH>중량</TH>';
					str_div_option_table += '                <TH>구매수량제한</TH>';
					str_div_option_table += '            </TR>';
					str_div_option_table += '        </THEAD>';
					str_div_option_table += '        <TBODY id="option_info">';
					str_div_option_table += '            <TR>';
					str_div_option_table += '                <TD colspan="' + (colspan_cnt + 4) + '">등록된 옵션정보가 없습니다.</TD>';
					str_div_option_table += '            </TR>';
					str_div_option_table += '        </TBODY>';
					str_div_option_table += '    </TABLE>';
					str_div_option_table += '</TD>';
					
					$('#ordersheet_option_info').html('');
					$('#ordersheet_option_info').append(str_div_option_table);
					$('#ordersheet_option_info').show();
					
					if (option_info.length > 0) {
						setOptionInfo(option_info);
					}
				}
			} else {
				alert(d.msg);
			}
		}
	});
}

function setOptionInfo(option_info) {
	$('#option_info').html('');
	
	let strDiv = "";
	option_info.forEach(function(row) {
		strDiv += '<TR>';
		strDiv += '    <TD>' + row.option_name + '</TD>';
		strDiv += '    <TD>' + row.barcode + '</TD>';
			
		if (row.option_size_1 != "") {
			strDiv += '<TD>' + row.option_size_1 + '</TD>';
		}

		if (row.option_size_2 != "") {
			strDiv += '<TD>' + row.option_size_2 + '</TD>';
		}

		if (row.option_size_3 != "") {
			strDiv += '<TD>' + row.option_size_3 + '</TD>';
		}

		if (row.option_size_4 != "") {
			strDiv += '<TD>' + row.option_size_4 + '</TD>';
		}

		if (row.option_size_5 != "") {
			strDiv += '<TD>' + row.option_size_5 + '</TD>';
		}

		if (row.option_size_6 != "") {
			strDiv += '<TD>' + row.option_size_6 + '</TD>';
		}
			
		strDiv += '    <TD>' + row.option_weight + '</TD>';
		strDiv += '    <TD>' + row.limit_option_qty + '</TD>';
		strDiv += '</TR>';
	});
	
	$('#option_info').append(strDiv);
}
</script>