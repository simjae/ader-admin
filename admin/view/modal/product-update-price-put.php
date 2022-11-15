<div class="body">
	<h1>
		상품정보 일괄변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<!--
			<div class="row form-group">
				<button type="button" style="width:120px;height:30px;border:1px solid #000000;cursor:pointer;float:right;" onClick="$('#currency_table').toggle();">환율정보 조회</button>
				<button type="button" style="width:80px;height:30px;border:1px solid #000000;cursor:pointer;margin-right:10px;float:right;" onClick="productPriceCalc();">계산</button>
				<input id="calc_val" type="text" style="width:163px;height:30px;margin-right:10px;float:right;" placeholder="배율" value="1.4">
			</div>
			-->
			<div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_price" class="list" style="font-size:0.7rem;">
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
							<TD>한국몰 가격</TD>
							<TD><input id="price_kr" class="price" type="number" step="0.01" name="price_kr" value="0"></TD>
							<TD>한국몰 세일가격</TD>
							<TD><input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
							<TD>한국몰 할인율</TD>
							<TD><input id="discount_kr" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>

						</TR>
						<TR class="cal_discount">
							<TD>영문몰 가격</TD>
							<TD><input id="price_en" class="price" type="number" step="0.01" name="price_en" value="0"></TD>
							<TD>영문몰 세일가격</TD>
							<TD><input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0"></TD>
							<TD>영문몰 할인율</TD>
							<TD><input id="discount_en" class="result" type="number" step="0.01" name="discount_en" value="0" readonly></TD>

						</TR>
						<TR class="cal_discount"> 
							<TD>중국몰 가격</TD>
							<TD><input id="price_cn" class="price" type="number" step="0.01" name="price_cn" value="0"></TD>
							<TD>중국몰 세일가격</TD>
							<TD><input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
							<TD>중국몰 할인율</TD>
							<TD><input id="discount_cn" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>

						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
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
	insertLog("상품관리 > 상품 정보 일괄 변경", "가격정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>