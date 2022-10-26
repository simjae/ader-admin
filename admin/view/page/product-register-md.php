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
	.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
</style>
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
							<TBODY>
								<TR>
									<TD style="width:10%;">스타일코드</TD>
									<TD>
										<input id="style_code" class="product_code_unit" type="text" name="style_code" value="" >
									</TD>
									<TD style="width:10%;">컬러코드</TD>
									<TD>
										<input id="color_code" class="product_code_unit" type="text" name="color_code" value="" >
									</TD>
									<TD style="width:10%;">상품코드</TD>
									<TD>
										<div>
											<input id="duplicate_check" type="hidden" value="false">
											<input id="product_code" type="text" name="product_code" style="width:70%;"
												value="">
											<button id="duplicate_btn" class="btn__gray" type="button"onClick="productDuplicateCheck();">상품코드 중복체크</button>
										</div>
									</TD>
								</TR>
								<TR>
									<TD>프리오더 체크</TD>
									<TD colspan="5">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="false" checked>
												<div><div></div></div>
												<span>고객상품</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="true">
												<div><div></div></div>
												<span>프리오더상품</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">오더시트 상품분류</TD>
									<TD colspan="5">
										<div>
											<input id="category_lrg" type="text" name="category_lrg" placeholder=""
												style="width:15%;" value="">
											<input id="category_mdl" type="text" name="category_mdl" placeholder=""
												style="width:15%;" value="">
											<input id="category_sml" type="text" name="category_sml" placeholder=""
												style="width:15%;" value="">
											<input id="category_dtl" type="text" name="category_dtl" placeholder=""
												style="width:15%;" value="">
										</div>
									</TD>
								</TR>
                                <TR>
									<TD>상품 그래픽</TD>
									<TD colspan="2">
                                        <input id="graphic" type="text" name="graphic" value="">
									</TD>
									<TD>상품 핏</TD>
									<TD colspan="2">
                                        <input id="fit" type="text" name="fit" value="">
									</TD>
								</TR>
                                <TR>
									<TD>소재</TD>
									<TD colspan="2">
                                    <input id="material" type="text" name="material" value="">
									</TD>
									<TD>네비게이션</TD>
									<TD colspan="2">
                                        <input type="text" name="navigation" value="">
									</TD>
								</TR>
								<TR>
									<TD>상품 이름</TD>
									<TD colspan="2">
										<input type="text" name="product_name" value="">
									</TD>
									<TD>상품 사이즈</TD>
									<TD colspan="2">
										<input type="text" id="size" name="product_size" value="One Size">
									</TD>
								</TR>
								<TR>
									<TD>상품 컬러</TD>
									<TD colspan="2">
										<input id="color" type="text" name="color" value="">
									</TD>
									<TD>색상코드</TD>
									<TD colspan="2">
										<input id="color_rgb" type="text" name="color_rgb" value="">
									</TD>
								</TR>
                                <TR>
									<TD>구매 수량 제한</TD>
									<TD colspan="2">
										<input type="text" name="limit_qty" value="">
									</TD>
									<TD>구매 멤버 제한</TD>
									<TD colspan="2">
										<input type="text" name="limit_member" value="">
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
										<col width="25%">
										<col width="25%">
										<col width="25%">
										<col width="25%">
									</colgroup>
									<TBODY>
										<TR>
											<TD>ADER</TD>
											<TD>ADER GB</TD>
											<TD>ADER EN USD</TD>
											<TD>ADER CN USD</TD>
										</TR>
										<TR>
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
							<TBODY>
								<tr>
									<TD style="width:10%;">기획수량(총 수량)</TD>
									<TD colspan="2">
										<input id="product_qty" type="number" name="product_qty"
												value="">
									</TD>
									<TD style="width:10%;">상품옵션-재고관리 등급</TD>
									<TD colspan="2">
										<input id="product_stock_grade" type="text" name="product_stock_grade"
												value="">
									</TD>
								</tr>
								<TR>
									<TD style="width:10%;">적립금 사용</TD>
									<TD colspan="5">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input id="mileage_flg_true" type="radio" name="mileage_flg" value="true"
												checked>
												<div><div></div></div>
												<span>사용</span>
											</label>
											<label class="rd__square">
												<input id="mileage_flg_false" type="radio" name="mileage_flg" value="false">
												<div><div></div></div>
												<span>사용안함</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">단독구매 제한</TD>
									<TD colspan="5">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input class="exclusive_flg" type="radio"
													name="exclusive_flg" value="false" checked
													onClick="exclusiveFlgClick(this);">
												<div><div></div></div>
												<span>단독구매 제한 없음</span>
											</label>
											<label class="rd__square">
												<input class="exclusive_flg" type="radio"
													name="exclusive_flg" value="true"
													onClick="exclusiveFlgClick(this);">
												<div><div></div></div>
												<span>단독구매 제한</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">런칭일자</TD>
									<TD colspan="5">
										<input id="launching_date" class="dateParam" type="date"
											name="launching_date" class="margin-bottom-6" placeholder="From" readonly
											style="width:150px;">
									</TD>
								</TR>
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
	$('.product_code_unit').keyup(function(){
		setProductCode();
	});

	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});
	
	getCurrencyInfo();
});

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
			url: config.api + "pm/ordersheet/md/check",
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
	
	var product_code = $('#product_code').val();
	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
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
		url: config.api + "pm/ordersheet/md/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[MD] 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 등록되었습니다.',function pageLocation() {
					location.href = '/product/ordersheet';
				});
			}
		}
	});
}
</script>