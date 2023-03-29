
<div class="content__card update__modal">
	<h3>
		상품정보 일괄변경 - 가격
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
			
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_price">
					<colgroup>
						<col width="10%">
						<col width="23%">
						<col width="10%">
						<col width="23%">
						<col width="10%">
						<col width="23%">
					</colgroup>
					<TBODY>
						<TR class="cal_discount">
							<TH>
								한국몰 가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_kr_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_kr_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							
							<TD>
								<input id="shop_price_KR" class="price" country="KR" type="number" step="0.01" name="price_kr" value="0">
							</TD>

							<TH>
								영문몰 가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_en_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_en_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<input id="shop_price_EN" class="price" country="EN" type="number" step="0.01" name="price_en" value="0">
							</TD>

							<TH>중국몰 가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_cn_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="price_cn_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<input id="shop_price_CN" class="price" country="CN" type="number" step="0.01" name="price_cn" value="0">
							</TD>
						</TR>
						
						<TR class="cal_discount">
							<TH>한국몰 세일가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_kr_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_kr_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="sales_price_KR" class="sales_price" country="KR" type="number" step="0.01" name="sales_price_kr" value="0">
							</TD>
							
							<TH>영문몰 세일가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_en_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_en_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="sales_price_EN" class="sales_price" country="EN" type="number" step="0.01" name="sales_price_en" value="0">
							</TD>

							<TH>중국몰 세일가격
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_cn_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								
								<label class="rd__square update__flg__area">
									<input type="radio" name="sales_price_cn_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="sales_price_CN" class="sales_price" country="CN" type="number" step="0.01" name="sales_price_cn" value="0">
							</TD>
						</TR>
						
						<TR class="cal_discount" > 
							<TH>한국몰 할인율
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_kr_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_kr_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="discount_KR" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly>
							</TD>

							<TH>영문몰 할인율
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_en_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_en_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="discount_EN" class="result" type="number" step="0.01" name="discount_en" value="0" readonly>
							</TD>

							<TH>중국몰 할인율
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_cn_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								
								<label class="rd__square update__flg__area">
									<input type="radio" name="discount_cn_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TD>
							<TD>
								<input id="discount_CN" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('.cal_discount').keyup(function(){
		var price = $(this).find('.price').val();
		var sales_price = $(this).find('.sales_price').val();

		if(price * sales_price > 0){
			$(this).find('.result').val( ((price - sales_price) / price * 100 ).toFixed(2))
		}
	});
	$('.cal_discount').change(function(){
		var price = $(this).find('.price').val();
		var sales_price = $(this).find('.sales_price').val();

		if(price * sales_price > 0){
			$(this).find('.result').val( ((price - sales_price) / price * 100 ).toFixed(2))
		}
	});
	getCurrencyInfo();
});

function getCurrencyInfo() {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "product/currency/get",
		error: function() {
			alert("환율정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					
					var strDiv = "";
					strDiv += '<TABLE class="list" style="font-size:0.5rem;width:200px;float:right;">';
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

		$('#sales_price_kr').change();
		$('#sales_price_en').change();
		$('#sales_price_cn').change();
	}
}
function productUpdateCheck() {	
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		
		insertLog("상품관리 > 상품 정보 일괄 변경", "가격정보 일괄변경", null);
		modal_submit($('#frm-update'),'getUpdateProductInfo');
	}
	else if($('input[name=product_idx_arr]').val() == 'select_all'){
		productAllUpdateCheck();
	}
}
function productAllUpdateCheck() {	
	var formSearchData = new FormData();
	var formData = new FormData();
	formSearchData = $("#frm-list").serializeObject();
	formData = $("#frm-update").serializeObject();

	formSearchData.price_kr_update_flg 			= formData['price_kr_update_flg'];
	formSearchData.price_en_update_flg 			= formData['price_en_update_flg'];
	formSearchData.price_cn_update_flg 			= formData['price_cn_update_flg'];
	formSearchData.discount_kr_update_flg 		= formData['discount_kr_update_flg'];
	formSearchData.discount_en_update_flg 		= formData['discount_en_update_flg'];
	formSearchData.discount_cn_update_flg 		= formData['discount_cn_update_flg'];
	formSearchData.sales_price_kr_update_flg 	= formData['sales_price_kr_update_flg'];
	formSearchData.sales_price_en_update_flg 	= formData['sales_price_en_update_flg'];
	formSearchData.sales_price_cn_update_flg 	= formData['sales_price_cn_update_flg'];
	formSearchData.price_kr 					= formData['price_kr'];
	formSearchData.sales_price_kr 				= formData['sales_price_kr'];
	formSearchData.discount_kr 					= formData['discount_kr'];
	formSearchData.price_en 					= formData['price_en'];
	formSearchData.sales_price_en 				= formData['sales_price_en'];
	formSearchData.discount_en 					= formData['discount_en'];
	formSearchData.price_cn 					= formData['price_cn'];
	formSearchData.sales_price_cn 				= formData['sales_price_cn'];
	formSearchData.discount_cn 					= formData['discount_cn'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 가격정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "가격정보 일괄변경", null);
}
</script>