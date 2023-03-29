<style>
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.btn__gray{height: 20px;color: #fff;padding: 3.5px 20px;border-radius: 2px;background-color: #bfbfbf;cursor:pointer;}
.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
.required_title{color:red;font-weight:800;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
    <div class="card__header">
        <h3>개별상품등록 [MD]</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
				<div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_ordersheet">
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
									<TD>
										<input id="year" type="text" name="year" value="">
									</TD>
									
									<TH class="required_title">스타일코드</TH>
									<TD>
										<input id="style_code" class="product_code_unit" type="text" name="style_code" maxlength="15" value="" >
									</TD>
									
									<TH class="required_title">컬러코드</TD>
									<TD>
										<input id="color_code" class="product_code_unit" type="text" name="color_code" maxlength="15" value="" >
									</TD>
									
									<TH class="required_title">상품코드</TH>
									<TD>
										<div>
											<input id="duplicate_check" type="hidden" value="false">
											<input id="product_code" type="text" readonly name="product_code" style="width:65%;" value="">
											<button id="duplicate_btn" class="btn__gray" type="button"onClick="productDuplicateCheck();">중복체크</button>
										</div>
									</TD>
								</TR>
								
								<tr>
									<TH>소재</td>
									<TD>
										<input id="material" type="text" name="material" value="">
									</td>
									
									<TH>상품 핏</TH>
									<TD>
										<input id="fit" type="text" name="fit" value="">
									</td>
									
									<TH>프리오더 사용여부</TH>
									<TD>
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
									<TD>
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
									<TD colspan="3">
                                        <div class="content__row" >
                                            <select id="line_idx" name="line_idx" class="fSelect eSearch" style="width:100%;" onChange="getLineInfo();">
                                                <option value="0">라인을 선택해주세요</option>
												<?php
													$select_line_sql = "
														SELECT
															IDX				AS LINE_IDX,
															LINE_NAME		AS LINE_NAME
														FROM
															LINE_INFO
													";
													
													$db->query($select_line_sql);
													
													foreach ($db->fetch() as $line_data) {
												?>
												<option value="<?=$line_data['LINE_IDX']?>"><?=$line_data['LINE_NAME']?></option>
												<?php
													}
												?>
                                            </select>
                                        </div>
										
                                        <div id="div_line" style="margin-top:5px">
                                        </div>
									</TD>
									
                                    <TH>MD 카테고리</TH>
                                    <TD colspan="3">
										<div class="content__row">
											<select class="fSelect category eCategory eCategory1" depth="1" name="md_category[]" style="font-size:0.5rem;width:25%;" onChange="mdCategoryChange(this);">
												<option value="0">대분류</option>	
											</select>
											<select class="fSelect category eCategory eCategory2" depth="2" name="md_category[]" style="font-size:0.5rem;width:25%;" onChange="mdCategoryChange(this);">
												<option value="0">중분류</option>
											</select>
											<select class="fSelect category eCategory eCategory3" depth="3" name="md_category[]" style="font-size:0.5rem;width:25%;" onChange="mdCategoryChange(this);">
												<option value="0">소분류</option>
											</select>
											<select class="fSelect category eCategory eCategory4" depth="4" name="md_category[]" style="font-size:0.5rem;width:25%;" onChange="mdCategoryChange(this);">
												<option value="0">세분류</option>
											</select>
										</div>
									</TD>
                                </TR>
                                <TR>
									<TH class="required_title">상품 이름</TH>
									<TD>
										<input type="text" id="product_name" name="product_name" value="">
									</TD>
									
									<TH>상품 그래픽</TH>
									<TD>
                                        <input id="graphic" type="text" name="graphic" value="">
									</TD>
									
									<TH>상품 사이즈</TH>
									<TD>
										<input type="text" id="product_size" name="product_size" value="">
									</TD>
									
									<TH class="required_title">상품 색상</TH>
									<TD>
										<input id="color" type="text" name="color" value="">
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
									<TH>MD 카테고리 가이드</TH>
									<TD colspan="3">
										<input type="text" id="md_category_guide" name="md_category_guide" value="">
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
											<TH class="required_title">기획원가</TH>
											<TH class="required_title">한국몰 판매가격 (KRW)</TH>
											<TH class="required_title">한국몰 변환가격 (KRW)</TH>
											<TH class="required_title">영문몰 판매가격 (USD)</TH>
											<TH class="required_title">중문몰 판매가격 (USD)</TH>
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
										<input id="safe_qty" type="number" name="safe_qty" value="">
									</TD>
									
									<TH>입고 요청일</TH>
									<TD>
										<input id="receive_request_date" type="date" name="receive_request_date" style="width:100%;" value="" date_type="receive_request">
									</TD>
									<TH>런칭일</TH>
									<TD>
										<input id="launching_date" type="date" name="launching_date" style="width:100%;" value="" date_type="launching">
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
				onClick="confirm('상품을 등록하시겠습니까?.','ordersheetRegister()');">개별상품 등록</button>
		</div>
    </div>
</div>
<script>

$(document).ready(function() {
	getMdCategory(0,0)
	$('.product_code_unit').keyup(function(){
		setProductCode();
	});

	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});
	lineInfoGet();
	getCurrencyInfo();
});
function lineInfoGet(){
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
    });
}

function mdCategoryChange(obj) {
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
	switch(depth){
		case 1:
			md_cate_name = '대분류';
			break;
		case 2:
			md_cate_name = '중분류';
			break;
		case 3:
			md_cate_name = '소분류';
			break;
		case 4:
			md_cate_name = '세분류';
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
	
	eCategory.prop("selected", true);
}

function setProductCode(){
	var style_code = $('#style_code').val();
	var color_code = $('#color_code').val();

	$('#product_code').val(style_code + color_code);
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
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
						alert('이미 등록된 상품코드입니다.');
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

function ordersheetRegister() {
	var style_code = $('#style_code').val();
	if (style_code.length == 0 || style_code == null) {
		alert('스타일코드를 입력해주세요.');
		return false;
	}
	
	var color_code = $('#color_code').val();
	if (style_code.length == 0 || style_code == null) {
		alert('색깔코드를 입력해주세요.');
		return false;
	}
	
	var product_code = $('#product_code').val();
	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
		return false;
	}

	var product_name = $('#product_name').val();
	if (product_name.length == 0 || product_name == null) {
		alert('상품명을 입력해주세요.');
		return false;
	}
	
	var category_lrg_idx = parseInt($('.eCategory1').val());
	var category_mdl_idx = parseInt($('.eCategory2').val());
	var category_sml_idx = parseInt($('.eCategory3').val());
	var category_dtl_idx = parseInt($('.eCategory4').val());

	if( !(category_lrg_idx && category_mdl_idx && category_sml_idx && category_dtl_idx) ){
		alert('세분류까지 모두 선택해주세요');
		return false;
	}

	var duplicate_check = $('#duplicate_check').val();
	if (duplicate_check != 'true') {
		alert('등록하려는 상품의 상품코드를 확인해주세요.');
		return false;
	}

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet/md/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[MD] 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 등록되었습니다.',function pageLocation() {
					location.href = '/pcs/ordersheet/list';
				});
			}
		}
	});
}

function getDateInterval(startDate, endDate){
	return (endDate.getTime() - startDate.getTime()) / ( 1000*60*60*24 );
}

function getLineInfo() {
	let line_idx = $('#line_idx').val();
	
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
						
						$('#div_line').html('');
						
						let strDiv = "";
						strDiv += '<table style="width:100%">';
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
}
</script>