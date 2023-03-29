<style>
.toggle_table_btn {background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;}
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.btn__gray{height: 20px;color: #fff;padding: 3.5px 20px;border-radius: 2px;background-color: #bfbfbf;cursor:pointer;}
.size_info_text {height:150px;}
.smart_editer_text {height:180px;}
.required_title{color:red;font-weight:bold}
</style>


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
            <h3>개별상품수정 [MD]</h3>
        </div>
        <div class="drive--x"></div>
    </div>
	
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
				<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="<?=$ordersheet_idx?>">
                
				<input type="hidden" name="update_date" value="">
				<input type="hidden" name="overwrite_flg" value="false">
                
				<div class="table table__wrap">
                    <button class="toggle_table_btn" type="button" onClick="toggleTableClick('DSN');">오더시트 - 디자인</button>
                    <div class="overflow-x-auto" id="insert_table_DSN">
					<TABLE class="size_info_table">
                            <colgroup>
                                <col width="10%">
                                <col width="auto">
                                <col width="10%">
                                <col width="auto">
                                <col width="10%">
                                <col width="auto">
								<col width="10%">
                                <col width="auto">
                            </colgroup>
                            <TBODY>
                                <TR>
									<TD colspan="8">
										<div class="content__row">
											<select id="size_guide_category" name="size_guide_category" class="fSelect eSearch" style="width:163px;" onChange="getSizeGuideList();">
												<?php
													$select_size_guide_sql = "
														SELECT
															SG.CATEGORY_TYPE	AS CATEGORY_TYPE
														FROM
															ORDERSHEET_MST OM
															LEFT JOIN SIZE_GUIDE SG ON
															OM.SIZE_GUIDE_CATEGORY = SG.CATEGORY_TYPE
														WHERE
															OM.IDX = ".$ordersheet_idx." AND
															SG.COUNTRY = 'KR'
													";
													
													$db->query($select_size_guide_sql);

													foreach ($db->fetch() as $size_data) {
														$size_idx = $size_data['CATEGORY_TYPE'];
														if (!empty($size_idx)) {
												?>
													<option value="<?=$size_data['CATEGORY_TYPE']?>" readonly><?=$size_data['CATEGORY_TYPE']?></option>
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
                            </TBODY>
                        </TABLE>
						
                        <TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
								<TR>
									<TH>최초 TP 작성일</TH>
									<TD id="tp_completion_date"></TD>
								</TR>
                                <TR>
                                    <TH style="width:10%;">제품 상세정보 (한글)</TH>
                                    <TD class="smart_editer_text" id="detail_kr"></TD>
                                </TR>

                                <TR>
                                    <TH style="width:10%;">제품 상세정보 (영문)</TH>
                                    <TD class="smart_editer_text" id="detail_en"></TD>
                                </TR>

                                <TR>
                                    <TH style="width:10%;">제품 상세정보 (중문)</TH>
                                    <TD class="smart_editer_text" id="detail_cn"></TD>
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
						<TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TH style="width:10%;">디자인-소재 (한글)</TH>
                                    <TD class="smart_editer_text" id="material_dsn_kr"></TD>
                                </TR>

                                <TR>
                                    <TH style="width:10%;">디자인-소재 (영문)</TH>
                                    <TD class="smart_editer_text" id="material_dsn_en"></TD>
                                </TR>

                                <TR>
                                    <TH style="width:10%;">디자인-소재 (중문)</TH>
                                    <TD class="smart_editer_text" id="material_dsn_cn"></TD>
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
									<TH>제품 취급 유의사항<br>생산 (한글)</TH>
									<TD class="smart_editer_text" id="care_td_kr"></TD>
								</TR>
                                <TR>
									<TH>제품 취급 유의사항<br>생산 (영문)</TH>
									<TD class="smart_editer_text" id="care_td_en"></TD>
								</TR>
                                <TR>
									<TH>제품 취급 유의사항<br>생산 (중문)</TH>
									<TD class="smart_editer_text" id="care_td_cn"></TD>
								</TR>
								<TR>
									<TH>생산-소재 (한글)</TH>
									<TD class="smart_editer_text" id="material_td_kr"></TD>
								</TR>

								<TR>
									<TH>생산-소재 (영문)</TH>
									<TD class="smart_editer_text" id="material_td_en"></TD>
								</TR>

								<TR>
									<TH>생산-소재 (중문)</TH>
									<TD class="smart_editer_text" id="material_td_cn"></TD>
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
									<TH>제조사</TH>
									<TD id="manufacturer"></TD>
									
									<TH>공급사</TH>
									<TD id="supplier"></TD>
									
									<TH>원산지</TH>
									<TD id="origin_country"></TD>
									
									<TH>브랜드</TH>
									<TD id="brand"></TD>
								</TR>
                                
								<tr>
                                    <TH>상품 적재박스 유형</TH>
									<TD colspan="7"  id="load_box_info_table">
                                </tr>
								
                                <tr>
                                    <TH>상품 적재중량 (kg)</TH>
									<TD colspan="3" id="load_weight"></TD>
                                    
									<TH>상품 적재수량</TH>
									<TD colspan="3" id="load_qty"></TD>
                                </tr>
								
                                <tr>
                                    <TH>포장부자재</TH>
									<TD colspan="3">
										<table style="width:100%">
											<tbody id="package_sub_material"></tbody>
										</table>
									</TD>
									
									<TH>배송부자재</TH>
									<TD colspan="3">
										<table style="width:100%">
											<tbody id="delivery_sub_material"></tbody>
										</table>
									</TD>
                                </tr>
							</TBODY>
						</TABLE>
					</div>
                </div>
            
                <div class="table table__wrap">
                    <button class="toggle_table_btn" type="button" onClick="toggleTableClick('MD');">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_MD">
                        <TABLE>
                            <colgroup>
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="auto">
							</colgroup>
							<TBODY>
								<TR>
									<TH><p class="required_title">* 스타일코드</p></TH>
									<TD>
										<input id="style_code" type="text" name="style_code" value="">
									</TD>
									
									<TH><p class="required_title">* 컬러코드</p></TH>
									<TD>
										<input id="color_code" type="text" name="color_code" value="">
									</TD>
									
									<TH><p class="required_title">* 상품코드</p></TH>
									<TD>
										<input id="product_code" type="text" name="product_code" value="">
									</TD>
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
									<TH>소재</TH>
									<TD colspan="3">
										<input type="text" id="material" name="material" value="">
									</TD>
									
									<TH>fit</TH>
									<TD colspan="3">
										<input type="text" id="fit" name="fit" value="">
									</TD>
								</TR>
								<TR>
									<TH>프리오더 사용여부</TH>
									<TD colspan="3">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="false" checked>
												<div><div></div></div>
												<span>일반 상품</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="true">
												<div><div></div></div>
												<span>프리오더 상품</span>
											</label>
										</div>
									</TD>
									
									<TH>교환 환불 가능유무</TH>
									<TD colspan="3">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="refund_flg" value="false" checked>
												<div><div></div></div>
												<span>교환 불가</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="refund_flg" value="true">
												<div><div></div></div>
												<span>교환 가능</span>
											</label>
										</div>
									</TD>
								</TR>
								<tr>
                                	<TH>라인 유형</TH>
									<TD colspan="7">
                                        <div class="content__row" >
                                            <select id="line_idx" name="line_idx" class="fSelect eSearch" style="width:280px;" onChange="getLineInfo();">
												<option value="0">라인을 선택해주세요</option>
<?php
	$get_line_info_sql = "
		SELECT
			IDX,
			LINE_NAME
		FROM
			LINE_INFO
	";
	$db->query($get_line_info_sql);
	foreach($db->fetch() as $line_info){
?>
                                                <option value="<?=$line_info['IDX']?>"><?=$line_info['LINE_NAME']?></option>
<?php
	}
?>
                                            </select>
                                        </div>
                                        <div id="div_line" style="margin-top:5px">
                                        </div>
									</TD>
                                </tr>
								<tr>
                                	<TH>W/K/L/A</TH>
									<TD colspan="7">
                                        <div class="content__row" >
                                            <select id="wkla_idx" name="wkla_idx" class="fSelect eSearch" style="width:175px;" onChange="getWklaInfo();">
												<option value="0">W/K/L/A를 선택해주세요</option>
<?php
	$get_wkla_info_sql = "
		SELECT
			IDX,
			WKLA_NAME
		FROM
			WKLA_INFO
	";
	$db->query($get_wkla_info_sql);
	foreach($db->fetch() as $wkla_info){
?>
                                                <option value="<?=$wkla_info['IDX']?>"><?=$wkla_info['WKLA_NAME']?></option>
<?php
	}
?>
                                            </select>
                                        </div>
										<div id="div_wkla" style="margin-top:5px">
                                        </div>
									</TD>
                                </tr>
								<tr>	
                                    <TH>MD 카테고리</TH>
									<TD colspan="7">
										<div class="content__row">
											<input type="hidden" id="md_category_2" value="0">
											<input type="hidden" id="md_category_3" value="0">
											<input type="hidden" id="md_category_4" value="0">

											<select class="fSelect category eCategory eCategory1" depth="1" name="md_category[]" style="font-size:0.5rem;width:15%;" onChange="mdCategoryChange(this);">
												<option value="0">대분류</option>	
											</select>
											
											<select class="fSelect category eCategory eCategory2" depth="2" name="md_category[]" style="font-size:0.5rem;width:15%;" onChange="mdCategoryChange(this);">
												<option value="0">중분류</option>
											</select>
											
											<select class="fSelect category eCategory eCategory3" depth="3" name="md_category[]" style="font-size:0.5rem;width:15%;" onChange="mdCategoryChange(this);">
												<option value="0">소분류</option>
											</select>
											
											<select class="fSelect category eCategory eCategory4" depth="4" name="md_category[]" style="font-size:0.5rem;width:15%;" onChange="mdCategoryChange(this);">
												<option value="0">세분류</option>
											</select>
										</div>
									</TD>
								</TR>
								
                                <TR>
									<TH><p class="required_title">* 상품 이름</p></TH>
									<TD colspan="3">
										<input type="text" id="product_name" name="product_name" value="">
									</TD>
									
									<TH>상품 그래픽</TH>
									<TD colspan="3">
                                        <input id="graphic" type="text" name="graphic" value="">
									</TD>
								</TR>
								
								<TR>
									<TH>상품 사이즈</TH>
									<TD colspan="3">
										<input type="text" id="product_size" name="product_size" value="">
									</TD>
									
									<TH><p class="required_title">* 상품 색상</p></TH>
									<TD colspan="3">
										<input id="color" type="text" name="color" value="">
									</TD>
								</TR>
								
								<TR>
									<TH>MD 카테고리 가이드</TH>
									<TD colspan="3">
										<input type="text" id="md_category_guide" name="md_category_guide" value="">
									</TD>
									
									<TH>구매수량 제한 유무</TH>
									<TD>
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="limit_product_qty_flg" value="false" checked>
												<div><div></div></div>
												<span>제한안함</span>
											</label>
											
											<label class="rd__square">
												<input type="radio" name="limit_product_qty_flg" value="true">
												<div><div></div></div>
												<span>제한함</span>
											</label>
										</div>
									</TD>
									
									<TH>구매제한 수량</TH>
									<TD>
										<input type="text" id="limit_product_qty" name="limit_product_qty" value="">
									</TD>
								</TR>
								
								<TR>
									<TH>ID당 구매 제한우뮤</TH>
									<TD colspan="3">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="limit_id_flg" value="false" checked>
												<div><div></div></div>
												<span>제한안함</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="limit_id_flg" value="true">
												<div><div></div></div>
												<span>제한함</span>
											</label>
										</div>
									</TD>
									
									<TH>구매 멤버 제한</TH>
									<TD colspan="3">
										<input type="text" id="limit_member" name="limit_member" value="">
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<div style="margin-top:5px;">
							<div class="row form-group">
								<button type="button" style="width:120px;height:30px;border:1px solid #000000;cursor:pointer;float:right;" onClick="$('#currency_table').toggle();">환율정보 조회</button>
									
								<button type="button" style="width:80px;height:30px;border:1px solid #000000;cursor:pointer;margin-right:10px;float:right;" onClick="productPriceCalc();">계산</button>
									
								<input id="calc_val" type="text" style="width:163px;height:30px;margin-right:10px;float:right;" placeholder="배율" value="1.4">
							</div>

							<div id="currency_table" class="row form-group" style="margin-top:5px;float:right;display:none;">
								<TABLE style="font-size:0.5rem;width:200px;margin-bottom:5px;float:right;">
									<THEAD>
										<TR>
											<TH>국가</TH>
											<TH>환율 비율</TH>
										</TR>
									</THEAD>
									<TBODY>
								<?php
									$select_currency_sql = "
										SELECT
											COUNTRY			AS COUNTRY,
											CURRENCY		AS CURRENCY
										FROM
											PRODUCT_CURRENCY
										ORDER BY
											IDX ASC
									";

									$db->query($select_currency_sql);
								
									foreach($db->fetch() as $currency_data) {
								?>
									<TR>
										<TD><?=$currency_data['COUNTRY']?></TD>
										<TD id="currency_<?=$currency_data['COUNTRY']?>"><?=$currency_data['CURRENCY']?></TD>
									</TR>
								<?php
									}
								?>
									</TBODY>
								</TABLE>
							</div>
						
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
											<TH><p class="required_title">* 기획원가</p></TH>
											<TH><p class="required_title">* 한국몰 판매가격 (KRW)</p></TH>
											<TH><p class="required_title">* 한국몰 변환가격 (KRW)</p></TH>
											<TH><p class="required_title">* 영문몰 판매가격 (USD)</p></TH>
											<TH><p class="required_title">* 중문몰 판매가격 (USD)</p></TH>
										</TR>
										<TR>
											<TD>
												<input id="price_cost" type="number" step="0.01" name="price_cost" value="0">
											</TD>
											
											<TD>
												<input id="price_kr" type="number" step="0.01" name="price_kr" value="0">
											</TD>
											
											<TD>
												<input id="price_kr_gb" type="number" step="0.01" name="price_kr_gb"
													value="0">
											</TD>
											
											<TD>
												<input id="price_en" type="number" step="0.01" name="price_en" value="0">
											</TD>
											
											<TD>
												<input id="price_cn" type="number" step="0.01" name="price_cn" value="0">
											</TD>
										</TR>
									</TBODY>
								</TABLE>
							</div>
						</div>
						
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
								<tr>
									<TH>기획재고 수량</TH>
									<TD>
										<input id="product_qty" type="number" name="product_qty" value="">
									</TD>
									
									<TH>안전재고 수량</TH>
									<TD>
										<input id="safe_qty" type="number" name="safe_qty"
												value="">
									</TD>
									
									<TH>입고 요청일</TH>
									<TD>
										<input id="receive_request_date" type="date" name="receive_request_date" value="" date_type="receive_request">
									</TD>
									
									<TH>런칭일</TH>
									<TD>
										<input id="launching_date" type="date" name="launching_date" value="" date_type="launching">
									</TD>
								</tr>
							</TBODY>
						</TABLE>
					</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
            <button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="confirm('상품을 수정하시겠습니까?.','ordersheetMdUpdate()');">개별상품 수정</button>
		</div>
    </div>
</div>
<script>
var size_category_info = {};

$(document).ready(function() {
	getMdCategory(0,0);
	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});
	
    $('#insert_table_DSN').toggle();
	$('#insert_table_TD').toggle();
	
	getOrdersheetInfo_MD();
});

function toggleTableClick(toggle_val) {
	$('#insert_table_' + toggle_val).toggle();
}

function getOrdersheetInfo_MD() {
	let ordersheet_idx = $('#ordersheet_idx').val();
	
	$.ajax({
		type: "post",
		url: config.api + "pcs/ordersheet_copy/get",
		data:{
			'sel_idx':ordersheet_idx
		},
		dataType: "json",
		error: function() {
			alert("오더시트 조회처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				$('input[name=update_date]').val(data.update_date);
				$('input[name=product_name]').val(data.product_name);
				$('input[name=product_code]').val(data.product_code);

				$('#tp_completion_date').text(data.tp_completion_date);
				
				if (data.model.length > 0 && data.model != null) {
					$('#model').text(data.model);
				}
				
				if (data.model_wear.length > 0 && data.model_wear != null) {
					$('#model_wear').text(data.model_wear);
				}
				
				$('#size_category').text(data.size_category);
				$('#detail_kr').html(data.detail_kr);
				$('#detail_en').html(data.detail_en);
				$('#detail_cn').html(data.detail_cn);
				$('#care_dsn_kr').html(data.care_dsn_kr);
				$('#care_dsn_en').html(data.care_dsn_en);
				$('#care_dsn_cn').html(data.care_dsn_cn);
				$('#material_dsn_kr').html(data.material_dsn_kr);
				$('#material_dsn_en').html(data.material_dsn_en);
				$('#material_dsn_cn').html(data.material_dsn_cn);
				
				let option_info = data.option_info;
				getSizeGuideList(option_info);
			
				//생산
				$('#care_td_kr').html(data.care_td_kr);
				$('#care_td_en').html(data.care_td_en);
				$('#care_td_cn').html(data.care_td_cn);
				$('#material_td_kr').html(data.material_td_kr);
				$('#material_td_en').html(data.material_td_en);
				$('#material_td_cn').html(data.material_td_cn);
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
				sub_info.forEach(function(sub_data){
					if(sub_data.sub_material_type == 'T'){
						$('#package_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');

					} else if(sub_data.sub_material_type == 'D'){
						$('#delivery_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');
					}
				});

				//기획 MD
				$('#style_code').val(data.style_code);
				$('#color_code').val(data.color_code);
				$('#product_code').val(data.product_code);
				switch(data.preorder_flg){
					case 0:
						$('input:radio[name=preorder_flg]:input[value="false"]').attr("checked",true);
						break;
					case 1:
						$('input:radio[name=preorder_flg]:input[value="true"]').attr("checked",true);
						break;
				}
				switch(data.refund_flg){
					case 0:
						$('input:radio[name=refund_flg]:input[value="false"]').attr("checked",true);
						break;
					case 1:
						$('input:radio[name=refund_flg]:input[value="true"]').attr("checked",true);
						break;
				}
				$('#material').val(data.material);
				$('#fit').val(data.fit);

				$('#line_idx').val(data.line_idx);
				getLineInfo();
				$('#wkla_idx').val(data.wkla_idx);
				getWklaInfo();

				$('.eCategory1').val(data.category_lrg).attr("selected","selected").change();
				//$('#md_category_1').val(data.category_lrg);
				$('#md_category_2').val(data.category_mdl);
				$('#md_category_3').val(data.category_sml);
				$('#md_category_4').val(data.category_dtl);

				$('#graphic').val(data.graphic);
				$('#product_name').val(data.product_name);
				$('#product_size').val(data.product_size);
				$('#color').val(data.color);
				$('#md_category_guide').val(data.md_category_guide);
				switch(data.limit_id_flg){
					case 0:
						$('input:radio[name=limit_id_flg]:input[value="false"]').attr("checked",true);
						break;
					case 1:
						$('input:radio[name=limit_id_flg]:input[value="true"]').attr("checked",true);
						break;
				}
				switch(data.limit_product_qty_flg){
					case 0:
						$('input:radio[name=limit_product_qty_flg]:input[value="false"]').attr("checked",true);
						break;
					case 1:
						$('input:radio[name=limit_product_qty_flg]:input[value="true"]').attr("checked",true);
						break;
				}
				$('#limit_product_qty').val(data.limit_product_qty);
				$('#limit_member').val(data.limit_member);
				$('#price_cost').val(data.price_cost);
				$('#price_kr').val(data.price_kr);
				$('#price_kr_gb').val(data.price_kr_gb);
				$('#price_en').val(data.price_en);
				$('#price_cn').val(data.price_cn);
				$('#product_qty').val(data.product_qty);
				$('#safe_qty').val(data.safe_qty);
				$('#receive_request_date').val(data.receive_request_date);
				$('#launching_date').val(data.launching_date);
			}
		}
	});
}

function productDuplicateCheck() {
	var product_code = $('#product_code').val();
	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
		return false;
	} else {
		$.ajax({
			type: "post",
			data:{
				'product_code':product_code
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet/md/check",
			error: function() {
				alert("상품코드 중목체크처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					if (data[0].product_cnt > 0) {
						alert('이미 수정된 상품코드입니다.');
						$('#duplicate_check').val(false);
						$('#duplicate_btn').css('background-color','#E43A45');
						$('#duplicate_btn').text('상품코드 중복체크');
						return false;
					} else {
						$('#duplicate_check').val(true);
						$('#duplicate_btn').css('background-color','#140f8');
						$('#duplicate_btn').text('중복체크 완료');
					}
				}
			}
		});
	}
}

function mdCategoryChange(obj, callback) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
	getMdCategory(depth,no);
}

function getMdCategory(depth,no) {
	if (depth == 0) {
		depth = 1;
	} else {
		depth += 1;
	}
	$.ajax({
		type: "post",
		data: {
			'depth':depth,
			'no':no
		},
		dataType: "json",
		url: config.api + "pcs/ordersheet/md/category/get",
		error: function() {
			data.instance.refresh();
		},
		success: function(d) {
			if(d.code == 200) {
				setMdCategory(depth,d.data);
			}
		}
	});
}

function setMdCategory(depth,d){
	var md_cate_name = '';
	var category_dir = '';
	switch(depth){
		case 1:
			md_cate_name = '대분류';
			break;
		case 2:
			md_cate_name = '중분류';
			category_dir = '#md_category_2';
			break;
		case 3:
			md_cate_name = '소분류';
			category_dir = '#md_category_3';
			break;
		case 4:
			md_cate_name = '세분류';
			category_dir = '#md_category_4';
			break;
	}
	var eCategory = $('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="0">' + md_cate_name + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	

	for(var i = depth + 1; i <= 4; i++){
		$('.eCategory' + i).val(0).prop('selected', true);
	}

	if($(category_dir).val() > 0){
		eCategory.val($(category_dir).val()).prop('selected', true);
		getMdCategory(depth,$(category_dir).val());
		$(category_dir).val(0);
	}
}

function productPriceCalc() {
	var price_kr = $('#price_kr').val();
	var calc_val = $('#calc_val').val();
	
	var currency_en = $('#currency_EN').text();
	var currency_cn = $('#currency_CN').text();
	
	if (price_kr > 0 && calc_val > 0) {
		var sales_price_kr = (price_kr * calc_val).toFixed();
		var sales_price_en = 0;
		var sales_price_cn = 0;
		
		if (currency_en != null) {
			sales_price_en = (sales_price_kr * parseFloat(currency_en)).toFixed(2);
		}
		
		if (currency_cn != null) {
			sales_price_cn = (sales_price_kr * parseFloat(currency_cn)).toFixed(2);
		}
		
		$('#price_kr_gb').val(sales_price_kr);
		$('#price_en').val(sales_price_en);
		$('#price_cn').val(sales_price_cn);
		
		$('#sales_price_kr').val(sales_price_kr);
		$('#sales_price_en').val(sales_price_en);
		$('#sales_price_cn').val(sales_price_cn);
	}
}

function exclusiveFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#exclusive_flg').val(flg_val);
}

function ordersheetMdUpdate(flg) {
    if(flg != undefined){
        $('input[name=overwrite_flg]').val(flg);
    }

	var category_lrg_idx = parseInt($('.eCategory1').val());
	var category_mdl_idx = parseInt($('.eCategory2').val());
	var category_sml_idx = parseInt($('.eCategory3').val());
	var category_dtl_idx = parseInt($('.eCategory4').val());

	/*if( !(category_lrg_idx && category_mdl_idx && category_sml_idx && category_dtl_idx) ){
		alert('세분류까지 모두 선택해주세요');
		return false;
	}*/

    var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
    $.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet_copy/md/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[MD] 수정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 수정되었습니다.',function pageLocation() {
					location.href = '/pcs/ordersheet/list/copy';
				});
			}
            else{
                switch(d.code){
                    case 300:
                        confirm(d.msg,function() {
                            ordersheetMdUpdate('true');
                        });
                        break;
                    case 301:
                        alert(d.msg);
                        break;
                }
            }
		}
	});
}

function getDateInterval(startDate, endDate){
	return (endDate.getTime() - startDate.getTime()) / ( 1000*60*60*24 );
}

function openLineInfoModal() {
	modal('line',null);
}

function getWklaInfo() {
	let wkla_idx = $('#wkla_idx').val();
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
						strDiv += '    <table style="width:40%">';
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

function getLineInfo() {
	let line_idx = $('#line_idx').val();
	$('#div_line').html('');

	if (line_idx > 0) {
		$.ajax({
			type: "post",
			url: config.api + "pcs/ordersheet/md/line/get",
			data: {
				'sel_line_idx' : line_idx
			},
			dataType: "json",
			error: function() {
				alert("라인정보 조회처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					if(d.data != null){
						var line_info = d.data[0];
						let strDiv = "";
						strDiv += '<table style="width:60%">';
						strDiv += '    <thead>';
						strDiv += '        <tr>';
						strDiv += '            <th>라인명</th>';
						strDiv += '            <th>타입</th>';
						strDiv += '            <th>비고</th>';
						strDiv += '        </tr>';
						strDiv += '    </thead>';
						strDiv += '    <tbody>';
						strDiv += '        <tr>';
						strDiv += '            <td>' + line_info.line_name + '</td>';
						strDiv += '            <td>' + line_info.line_type + ' 라인</td>';
						strDiv += '            <td>' + line_info.line_memo + '</td>';
						strDiv += '        </tr>';
						strDiv += '    </tbody>';
						strDiv += '</table>';
						
						$('#div_line').append(strDiv);
					}
				}
			}
		});
	}
	else {
		let strDiv = "";
		strDiv += '<table style="width:60%">';
		strDiv += '    <thead>';
		strDiv += '        <tr>';
		strDiv += '            <th>라인명</th>';
		strDiv += '            <th>타입</th>';
		strDiv += '            <th>비고</th>';
		strDiv += '        </tr>';
		strDiv += '    </thead>';
		strDiv += '    <tbody>';
		strDiv += '        <tr>';
		strDiv += '            <td colspan="3">등록된 라인 정보가 없습니다.</td>';
		strDiv += '        </tr>';
		strDiv += '    </tbody>';
		strDiv += '</table>';
		
		$('#div_line').append(strDiv);
	}
}

function getSizeGuideList(option_info) {
	let size_guide_category = $('#size_guide_category').val();
	
	$.ajax({
		type: "post",
		url: config.api + "product/size_guide/get",
		data: {
			'size_guide_category' : size_guide_category
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