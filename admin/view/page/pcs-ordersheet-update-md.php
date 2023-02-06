<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.btn__gray{
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor:pointer;
	}
    .size_info_text {height:150px;}
    .smart_editer_text {height:180px;}
</style>

<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>개별상품수정 [MD]</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
                <input type="hidden" name="ordersheet_idx" value="">
                <input type="hidden" name="update_date" value="">
                <input type="hidden" name="product_code" value="">
                <input type="hidden" name="product_name" value="">
                <input type="hidden" name="overwrite_flg" value="false">
                <div class="table table__wrap">
                    <button type="button" toggle_table="dsn"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 디자인</button>
                    <div class="overflow-x-auto" id="insert_table_dsn">
                        <TABLE class="size_info_table">
                            <colgroup>
                                <col width="3%">
                                <col width="11%">
                                <col width="3%">
                                <col width="11%">
                                <col width="3%">
                                <col width="11%">

                                <col width="3%">
                                <col width="11%">
                                <col width="3%">
                                <col width="11%">
                                <col width="3%">
                                <col width="11%">
                            </colgroup>
                            <TBODY>
								<tr>
                                    <TD>W/K/L/A</TD>
									<TD colspan="11"  id="wkla_info_table">
                                </tr>
                                <TR>
                                    <TD colspan="2">모델</TD>
                                    <TD colspan="4" id="model"></TD>
                                    <TD colspan="2">모델착용 사이즈</TD>
                                    <TD colspan="4" id="model_wear"></TD>
                                </TR>
                                
                                <TR>
                                    <TD colspan="2">
                                        사이즈 카테고리
                                    </TD>
                                    <TD colspan="10" id="size_category">dress</TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <div id="option_insert_div" style="margin-top:5px"></div>

                        <table style="margin-top:5px">
                            <thead id="product_size_table_head">
                            </thead>
                            <tbody id="product_size_regist_table">
                            </tbody>
                        </table>

                        <TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">제품 상세정보 (한글)</TD>
                                    <TD class="smart_editer_text" id="detail_kr"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">제품 상세정보 (영문)</TD>
                                    <TD class="smart_editer_text" id="detail_en"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">제품 상세정보 (중문)</TD>
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
                                    <TD style="width:10%;">제품 취급 유의사항<br>디자인 (한글)</TD>
                                    <TD class="smart_editer_text" id="care_dsn_kr"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">제품 취급 유의사항<br>디자인 (영문)</TD>
                                    <TD class="smart_editer_text" id="care_dsn_en"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">제품 취급 유의사항<br>디자인 (중문)</TD>
                                    <TD class="smart_editer_text" id="care_dsn_cn"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </div>
                </div>
                <div class="table table__wrap">
                    <button type="button" toggle_table="td"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 생산</button>
					<div class="overflow-x-auto" id="insert_table_td">
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
                                <TR>
									<TD>제품 취급 유의사항<br>생산 (한글)</TD>
									<TD class="smart_editer_text" id="care_td_kr"></TD>
								</TR>
                                <TR>
									<TD>제품 취급 유의사항<br>생산 (영문)</TD>
									<TD class="smart_editer_text" id="care_td_en"></TD>
								</TR>
                                <TR>
									<TD>제품 취급 유의사항<br>생산 (중문)</TD>
									<TD class="smart_editer_text" id="care_td_cn"></TD>
								</TR>
								<TR>
									<TD>소재 (한글)</TD>
									<TD class="smart_editer_text" id="material_kr"></TD>
								</TR>

								<TR>
									<TD>소재 (영문)</TD>
									<TD class="smart_editer_text" id="material_en"></TD>
								</TR>

								<TR>
									<TD>소재 (중문)</TD>
									<TD class="smart_editer_text" id="material_cn"></TD>
								</TR>
							</TBODY>
						</TABLE>
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="40%">
								<col width="10%">
								<col width="40%">
							</colgroup>
							<TBODY>
								<TR>
									<TD style="width:10%;">제조사</TD>
									<TD id="manufacturer"></TD>
									<TD style="width:10%;">공급사</TD>
									<TD id="supplier"></TD>
								</TR>
								<TR>
									<TD style="width:10%;">원산지</TD>
									<TD id="origin_country"></TD>
									<TD style="width:10%;">브랜드</TD>
									<TD id="brand"></TD>
								</TR>
                                <tr>
                                    <TD>상품 적재박스 유형</TD>
									<TD colspan="3"  id="load_box_info_table">
                                </tr>
                                <tr>
                                    <TD>상품 적재중량 (kg)</TD>
									<TD id="load_weight"></TD>
                                    <TD>상품 적재수량</TD>
									<TD id="load_qty"></TD>
                                </tr>
                                <tr>
                                    <TD>포장부자재</TD>
									<TD>
										<table style="width:50%">
											<tbody id="td_sub_material"></tbody>
										</table>
									</TD>
									<TD>배송부자재</TD>
									<TD>
										<table style="width:50%">
											<tbody id="delivery_sub_material"></tbody>
										</table>
									</TD>
                                </tr>
							</TBODY>
						</TABLE>
					</div>
                </div>
            
                <div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
						style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
						onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_ordersheet">
                        <TABLE>
                            <colgroup>
								<col width="10%">
								<col width="22%">
								<col width="10%">
								<col width="22%">
								<col width="10%">
								<col width="22%">
							</colgroup>
							<TBODY>
								<TR>
									<TD>스타일코드</TD>
									<TD id="style_code"></TD>
									<TD>컬러코드</TD>
									<TD id="color_code"></TD>
									<TD>상품코드</TD>
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
									<TD>프리오더 사용여부</TD>
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
									<TD>교환 환불 가능유무</TD>
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
                                	<TD>라인 유형</TD>
									<TD colspan="7">
                                        <div class="content__row" >
                                            <select id="line_idx" name="line_idx" class="fSelect eSearch" style="width:163px;">
                                                <option value="0">라인을 선택해주세요</option>
                                            </select>
                                        </div>
                                        <div id="line_table" class="line_table" style="margin-top:5px">
                                        </div>
									</TD>
                                </tr>
								<tr>
                                    <TD>MD 카테고리</TD>
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
									<TD>소재</TD>
									<TD colspan="3">
                                    <input type="text" id="material" name="material" value="">
									</TD>
									<TD>상품 그래픽</TD>
									<TD colspan="3">
                                        <input id="graphic" type="text" name="graphic" value="">
									</TD>
								</TR>
                                <TR>
									<TD>상품 핏</TD>
									<TD colspan="3">
                                        <input id="fit" type="text" name="fit" value="">
									</TD>
									<TD>상품 이름</TD>
									<TD colspan="3">
										<input type="text" id="product_name" name="product_name" value="">
									</TD>
								</TR>
								<TR>
									<TD>상품 사이즈</TD>
									<TD>
										<input type="text" id="product_size" name="product_size" value="">
									</TD>
									<TD>상품 색상</TD>
									<TD>
										<input id="color" type="text" name="color" value="">
									</TD>
									<TD>RGB 코드</TD>
									<TD>
										<input id="color_rgb" type="text" name="color_rgb" value="">
									</TD>
									<TD>팬톤 코드</TD>
									<TD>
										<input id="pantone_code" type="text" name="pantone_code" value="">
									</TD>
								</TR>
								<TR>
									<TD>MD 카테고리 가이드</TD>
									<TD colspan="3">
										<input type="text" id="md_category_guide" name="md_category_guide" value="">
									</TD>
									<TD>구매 수량 제한</TD>
									<TD>
										<input type="text" id="limit_qty" name="limit_qty" value="">
									</TD>
									<TD>구매 멤버 제한</TD>
									<TD>
										<input type="text" id="limit_member" name="limit_member" value="">
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						<div style="margin-top:5px;">
							<div class="row form-group">
								<button type="button"
									style="width:120px;height:30px;border:1px solid #000000;cursor:pointer;float:right;"
									onClick="$('#currency_table').toggle();">환율정보 조회</button>
								<button type="button"
									style="width:80px;height:30px;border:1px solid #000000;cursor:pointer;margin-right:10px;float:right;"
									onClick="productPriceCalc();">계산</button>
								<input id="calc_val" type="text"
									style="width:163px;height:30px;margin-right:10px;float:right;" placeholder="배율"
									value="1.4">
							</div>

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
											<TD>기획원가</TD>
											<TD>한국몰 판매가격 (KRW)</TD>
											<TD>한국몰 변환가격 (KRW)</TD>
											<TD>영문몰 판매가격 (USD)</TD>
											<TD>중문몰 판매가격 (USD)</TD>
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
									<TD>기획재고 수량</TD>
									<TD colspan="3">
										<input id="product_qty" type="number" name="product_qty"
												value="">
									</TD>
									<TD>안전재고 수량</TD>
									<TD colspan="3">
										<input id="safe_qty" type="number" name="safe_qty"
												value="">
									</TD>
								</tr>
								<tr>
									<TD>최초 TP작성 완료일</TD>
									<TD>
										<input id="tp_completion_date" type="date" name="tp_completion_date"
												value="" date_type="tp_completion" onchange="dateParamChange(this)">
									</TD>
									<TD>입고 요청일</TD>
									<TD>
										<input id="receive_request_date" type="date" name="receive_request_date"
												value="" date_type="receive_request" onchange="dateParamChange(this)">
									</TD>
									<TD>입고 요청 - 최초 TP작성 완료 날짜차이 </TD>
									<TD id="date_interval"></TD>
									<TD>런칭일</TD>
									<TD>
										<input id="launching_date" type="date" name="launching_date"
												value="" date_type="launching" onchange="dateParamChange(this)">
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
	
    $('#insert_table_dsn').toggle();
	$('#insert_table_td').toggle();

	getCurrencyInfo();

	$('#line_idx').change(function() {	
        var sel_tr = $(this).parents('tr');
        var sel_line_idx = sel_tr.find('.eSearch option:checked').val();
		
        sel_tr.find('.line_table').html('');
		if(sel_line_idx > 0){
			$.ajax({
				type: "post",
				data: {
                    'sel_line_idx' : sel_line_idx
                },
				dataType: "json",
				url: config.api + "pcs/ordersheet/md/line/get",
				error: function() {
					alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						if(d.data != null){
							var line_info = d.data[0];
							switch(line_info.line_type){
								case 'C':
									type_str = '컬렉션 라인';
									break;
								case 'O':
									type_str = '오리진 라인';
									break;
								case 'T':
									type_str = '티피컬 라인';
									break;
							}
                            strTable = `
                                <table style="width:40%">
                                    <thead>
                                        <tr>
                                            <th>라인명</th>
                                            <th>타입</th>
                                            <th>비고</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${line_info.line_name}</td>
                                            <td>${type_str}</td>
                                            <td>${line_info.line_memo}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            `;
                            sel_tr.find('.line_table').append(strTable);
						}
					}
				}
			});
		}
	});
	urlParsing();
});

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	var startDate = new Date($('#tp_completion_date').val());
	var endDate = new Date($('#receive_request_date').val()); 

	var dateInterval = 0;
	if(startDate.length != 0 && endDate != 0 ){
		dateInterval = getDateInterval(startDate, endDate);
	}

	if(dateInterval != NaN && dateInterval < 0){
		console.log('nan');
		alert('입고 요청일을 TP작성 완료일 이후 일자로 지정해주세요');
		$('#date_interval').text(dateInterval + '일');
		return false;
	}
	else if(dateInterval != NaN && dateInterval >= 0){
		$('#date_interval').text(dateInterval + '일');
	}
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");

		if(data_arr[0] == 'ordersheet_idx'){
			ordersheetMdGet(data_arr[1]);
		}
	}
}

function lineInfoGet(){
	
}

function ordersheetMdGet(idx) {
	$('input[name=ordersheet_idx]').val(idx);
	
	$.ajax({
        type: "post",
		dataType: "json",
        url: config.api + "pcs/ordersheet/md/line/get",
        error: function() {
            alert("라인정보 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
				var data = d.data;
					
                if (data != null) {
                    var strDiv = "";
                    
                    data.forEach(function(row) {
                        strDiv += ` <option value="${row.line_idx}">${row.line_name}</option>`;
                    });
                    $('#line_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. 라인 정보를 다시 입력해주세요.');
                    return false;
                }
            }
        }
    }).then(
		$.ajax({
			type: "post",
			data:{
				'sel_idx':idx
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet/get",
			error: function() {
				alert("오더시트 불러오기가 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					$('input[name=update_date]').val(data.update_date);
					$('input[name=product_name]').val(data.product_name);
					$('input[name=product_code]').val(data.product_code);

					//디자인
					if(data.wkla_idx != null && data.wkla_idx > 0){
						strTable = `
							<table style="width:30%">
								<thead>
									<tr>
										<th>WKLA 명</th>
										<th>비고</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>${data.wkla_name}</td>
										<td>${data.wkla_memo}</td>
									</tr>
								</tbody>
							</table>
						`;
						$('#wkla_info_table').append(strTable);
					}
					$('#model').text(data.model);
					$('#model_wear').text(data.model_wear);
					$('#size_a1_kr').html(data.size_a1_kr);
					$('#size_a2_kr').html(data.size_a2_kr);
					$('#size_a3_kr').html(data.size_a3_kr);
					$('#size_a4_kr').html(data.size_a4_kr);
					$('#size_a5_kr').html(data.size_a5_kr);
					$('#size_onesize_kr').html(data.size_onesize_kr);
					$('#size_a1_en').html(data.size_a1_en);
					$('#size_a2_en').html(data.size_a2_en);
					$('#size_a3_en').html(data.size_a3_en);
					$('#size_a4_en').html(data.size_a4_en);
					$('#size_a5_en').html(data.size_a5_en);
					$('#size_onesize_en').html(data.size_onesize_en);
					$('#size_a1_cn').html(data.size_a1_cn);
					$('#size_a2_cn').html(data.size_a2_cn);
					$('#size_a3_cn').html(data.size_a3_cn);
					$('#size_a4_cn').html(data.size_a4_cn);
					$('#size_a5_cn').html(data.size_a5_cn);
					$('#size_onesize_cn').html(data.size_onesize_cn);
					$('#size_category').text(data.size_category);
					$('#detail_kr').html(data.detail_kr);
					$('#detail_en').html(data.detail_en);
					$('#detail_cn').html(data.detail_cn);
					$('#care_dsn_kr').html(data.care_dsn_kr);
					$('#care_dsn_en').html(data.care_dsn_en);
					$('#care_dsn_cn').html(data.care_dsn_cn);

					if(data.option_info.length != 0){
						colunm_name_size_1 = data.option_info[0].size_title_1;
						colunm_name_size_2 = data.option_info[0].size_title_2;
						colunm_name_size_3 = data.option_info[0].size_title_3;
						colunm_name_size_4 = data.option_info[0].size_title_4;
						colunm_name_size_5 = data.option_info[0].size_title_5;
						colunm_name_size_6 = data.option_info[0].size_title_6;
						strTh = `
							<tr>
								<th style="width:5%">옵션 이름</th>
						`;
						strTh += colunm_name_size_1 != null ? `<th>${colunm_name_size_1}</th>` : '';
						strTh += colunm_name_size_2 != null ? `<th>${colunm_name_size_2}</th>` : '';
						strTh += colunm_name_size_3 != null ? `<th>${colunm_name_size_3}</th>` : '';
						strTh += colunm_name_size_4 != null ? `<th>${colunm_name_size_4}</th>` : '';
						strTh += colunm_name_size_5 != null ? `<th>${colunm_name_size_5}</th>` : '';
						strTh += colunm_name_size_6 != null ? `<th>${colunm_name_size_6}</th>` : '';

						strTh += `
							</tr>
						`;
						$('#product_size_table_head').append(strTh);

						for(var i = 0; i < data.option_info.length; i++){
							var row_data = data.option_info[i];

							strTr = '';
							var option_size_1 = row_data.option_size_1;
							var option_size_2 = row_data.option_size_2;
							var option_size_3 = row_data.option_size_3;
							var option_size_4 = row_data.option_size_4;
							var option_size_5 = row_data.option_size_5;
							var option_size_6 = row_data.option_size_6;

							strTrCol = ``;
							strTrCol += option_size_1 != '-' ? `<td name="size_info_1[]">${option_size_1} cm</td>` : '';
							strTrCol += option_size_2 != '-' ? `<td name="size_info_2[]">${option_size_2} cm</td>` : '';
							strTrCol += option_size_3 != '-' ? `<td name="size_info_3[]">${option_size_3} cm</td>` : '';
							strTrCol += option_size_4 != '-' ? `<td name="size_info_4[]">${option_size_4} cm</td>` : '';
							strTrCol += option_size_5 != '-' ? `<td name="size_info_5[]">${option_size_5} cm</td>` : '';
							strTrCol += option_size_6 != '-' ? `<td name="size_info_6[]">${option_size_6} cm</td>` : '';
							
							strTr += `
								<tr>
									<td id="option_name">${row_data.option_name}</td>
									${strTrCol}
								</tr>
							`;
							$('#product_size_regist_table').append(strTr);
						}
					}
				
					//생산
					$('#care_td_kr').html(data.care_td_kr);
					$('#care_td_en').html(data.care_td_en);
					$('#care_td_cn').html(data.care_td_cn);
					$('#material_kr').html(data.material_kr);
					$('#material_en').html(data.material_en);
					$('#material_cn').html(data.material_cn);
					$('#manufacturer').text(data.manufacturer);
					$('#supplier').text(data.supplier);
					$('#origin_country').text(data.origin_country);
					$('#brand').text(data.brand);

					if(data.load_box_idx != null && data.load_box_idx > 0){
						strTable = `
							<table>
								<thead>
									<tr>
										<th>상자명</th>
										<th>너비</th>
										<th>길이</th>
										<th>높이</th>
										<th>부피</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>${data.load_box_name}</td>
										<td>${data.load_box_width} cm</td>
										<td>${data.load_box_length} cm</td>
										<td>${data.load_box_height} cm</td>
										<td>${data.load_box_volume} cm³</td>
									</tr>
								</tbody>
							</table>
						`;
						$('#load_box_info_table').append(strTable);
					}
					$('#load_weight').text(data.load_weight);
					$('#load_qty').text(data.load_qty);
					var sub_info = data.sub_material_info;
					sub_info.forEach(function(sub_data){
						if(sub_data.sub_material_type == 'T'){
							$('#td_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);

						}
						else if(sub_data.sub_material_type == 'D'){
							$('#delivery_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);
						}
					})

					//기획 MD
					$('#style_code').text(data.style_code);
					$('#color_code').text(data.color_code);
					$('#product_code').text(data.product_code);
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
					$('#line_idx').val(data.line_idx).attr("selected","selected").change();

					$('.eCategory1').val(data.category_lrg).attr("selected","selected").change();
					//$('#md_category_1').val(data.category_lrg);
					$('#md_category_2').val(data.category_mdl);
					$('#md_category_3').val(data.category_sml);
					$('#md_category_4').val(data.category_dtl);

					$('#graphic').val(data.graphic);
					$('#fit').val(data.fit);
					$('#material').val(data.material);
					$('#product_name').val(data.product_name);
					$('#product_size').val(data.product_size);
					$('#color').val(data.color);
					$('#color_rgb').val(data.color_rgb);
					$('#pantone_code').val(data.pantone_code);
					$('#md_category_guide').val(data.md_category_guide);
					$('#limit_qty').val(data.limit_qty);
					$('#limit_member').val(data.limit_member);
					$('#price_cost').val(data.price_cost);
					$('#price_kr').val(data.price_kr);
					$('#price_kr_gb').val(data.price_kr_gb);
					$('#price_en').val(data.price_en);
					$('#price_cn').val(data.price_cn);
					$('#product_qty').val(data.product_qty);
					$('#safe_qty').val(data.safe_qty);
					$('#tp_completion_date').val(data.tp_completion_date);
					$('#receive_request_date').val(data.receive_request_date);
					$('#launching_date').val(data.launching_date);
					
					if(data.tp_completion_date.length != 0 && data.receive_request_date != 0){
						var startDate = new Date(data.tp_completion_date);
						var endDate = new Date(data.receive_request_date);
						var intervalDate = getDateInterval(startDate, endDate);
						if(intervalDate != NaN && intervalDate > 0)
						$('#date_interval').text(intervalDate + '일');
					}
				}
			}
		}).then(
			function(){
				var size_category = $('#size_category').text();
				if(size_category.length > 0){
					$.ajax({
						type: "post",
						data: {'size_category' : size_category},
						dataType: "json",
						//SIZE_DESCRIPTION table : get api url 경로확인
						url: config.api + "product/size/get",
						error: function() {
							alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
						},
						success: function(d) {
							if(d.code == 200) {
								if(d.data != null){
									size_category_info = d.data[0];
									setOptionForm();
								}
							}
						}
					});
				}
			}
		)
	);
}

function setOptionForm(){
    var strDiv = "";
	var strThDiv = "";
    var category_name = size_category_info['category_name'];
	var img_path = '/images/sizeguide/sizecategory/'+category_name;

	img_path += `/${category_name}.svg`;

	$('#option_insert_div').html('');
	strDiv = `
				<div class="row">
					<div style="float:left;width: 33%;">
						<img id="size_img" src="${img_path}" >
					</div>
					<div style="float:left;width: 50%;padding-top:50px;">
						<table id="size_desc_table">
	`;

	for(var i = 1; i <= 6; i++){
        var size_title_str = size_category_info['size_title_' + String(i)];
        var size_desc_str  = size_category_info['size_desc_' + String(i)];

		if(size_title_str != null && size_title_str.length > 0){
			strDiv +=	`			
							<tr data-idx="${i}" style="cursor:pointer">
								<td>${size_title_str}</td>
								<td>${size_desc_str}</td>
							</tr> 
			`;
		}
	}
	strDiv +=	`		</table>
					</div>
				</div>
	`;
	$('#option_insert_div').append(strDiv);

	$('#size_desc_table tr').mouseover(function(){
        var category_name = size_category_info['category_name'];
	    var img_path = '/images/sizeguide/sizecategory/'+category_name;
		var tr_idx = $(this).attr('data-idx');
		img_path += `/${category_name}_${String.fromCharCode(parseInt(tr_idx) + 96)}.svg`;

        $('#size_desc_table td').css('text-decoration', 'none');
        $(this).find('td').css('text-decoration', 'underline');
		
		$('#size_img').attr('src', img_path);
    })
	$('#size_desc_table tr').mouseout(function(){
		var category_name = size_category_info['category_name'];
	    var img_path = '/images/sizeguide/sizecategory/'+category_name;
		var tr_idx = $(this).attr('data-idx');
		img_path += `/${category_name}.svg`;

        $('#size_desc_table td').css('text-decoration', 'none');
		
		$('#size_img').attr('src', img_path);
    })
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

function getCurrencyInfo() {
	$.ajax({
		type: "post",
		dataType: "json",
		//환율정보 get api경로 확인
		url: config.api + "product/currency/get",
		error: function() {
			alert("환율정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					
					var strDiv = "";
					strDiv += '<TABLE  style="font-size:0.5rem;width:200px;float:right;">';
					strDiv += '    <THEAD>';
					strDiv += '        <TR>';
					strDiv += '            <TH>국가</TH>';
					strDiv += '            <TH>환율 비율</TH>';
					strDiv += '        </TR>';
					strDiv += '    </THEAD>';
					strDiv += '    <TBODY>';
					
					data.forEach(function(row) {
						strDiv += '    <TR>';
						strDiv += '        <TD>' + row.country + '</TD>';
						strDiv += '        <TD id="currency_' + row.country + '">' + row.currency + '</TD>';
						strDiv += '    </TR>';
					});
					
					strDiv += '    </TBODY>';
					strDiv += '</TABLE>';
					
					$('#currency_table').append(strDiv);
				}
			}
		}
	});
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

	if( !(category_lrg_idx && category_mdl_idx && category_sml_idx && category_dtl_idx) ){
		alert('세분류까지 모두 선택해주세요');
		return false;
	}

    var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
    $.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet/md/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[MD] 수정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 수정되었습니다.',function pageLocation() {
					location.href = '/pcs/ordersheet/list';
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

function updateFormReload(){
    location.reload();
}

function openLineInfoModal() {
	modal('line',null);
}
</script>