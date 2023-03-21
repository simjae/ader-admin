<div id="member_detail_BSK">
	<div class="content__card">
		<div class="card__header">
			<h3>위시리스트정보</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_BSK_total info__count" >0</font>개
				</div>
				
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange_BSK(this);">
						<option value="WL.CREATE_DATE|DESC">등록일 역순</option>
						<option value="WL.CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="PR.PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PR.PRODUCT_NAME|ASC">상품명 순</option>
						<option value="PR.SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="PR.SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="PR.SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="PR.SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="PR.SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="PR.SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
					</select>
					
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange_BSK(this);">
						<option value="10" selected>10개씩보기</option>
						<option value="20">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
				</div>
			</div>
			
			<div class="table__wrap" style="margin-top:15px;">
				<table>
					<colgroup>
						<col width="120px">
						<col width="auto">
						
						<col width="100px">
						<col width="100px">
						<col width="100px">
						
						<col width="100px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
						
						<col width="100px">
					</colgroup>
					<thead>
						<TH>쇼핑백<br/>등록일</TH>
						<TH>상품정보</TH>
						
						<TH>상품가격(한국몰)</TH>
						<TH>상품가격(영문몰)</TH>
						<TH>상품가격(중문몰)</TH>
						
						<TH>상품재고</TH>
						<TH>안전재고</TH>
						<TH>주문재고</TH>
						<TH>잔여재고</TH>
						
						<TH>적립금</TH>
					</thead>
					<tbody class="result_body">
						
					</tbody>
				</table>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging_BSK(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging_BSK(this);">
            	<div class="paging_BSK"></div>
        	</div>
		</div>
	</div>
	
	<form id="frm-BSK" action="modal/basket/get">
		<input type="hidden" class="page" name="country" value="<?=$country?>">
		<input type="hidden" class="rows" name="member_idx" value="<?=$member_idx?>">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
	</form>
</div>

<script>
$(document).ready(function() {
	getModalBasketInfo();
});

function getModalBasketInfo() {
	let frm = $('#frm-BSK');
	let result_body = $('#member_detail_BSK').find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_BSK"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					strDiv += '<tr>';
					strDiv += '    <td class="create_date">' + row.create_date + '<br/>' + row.create_time + '</td>';
					strDiv += '    <td>';
					strDiv += '        <div style="padding:5px; margin-bottom:10px;">';
					strDiv += '            <p style="margin-bottom:5px;">' + row.product_name + '</p>';
					strDiv += '            <div class="product__img__wrap">';
					strDiv += '                <div class="product__img" style="background-image:url(\'' + row.img_location + '\');"></div>';
					strDiv += '                <div>';
					strDiv += '                    <p>' + row.product_code + '</p><br>';
					strDiv += '                    <p>' + row.option_name + '</p><br>';
					strDiv += '                    <p>' + row.barcode + '</p><br>';
					strDiv += '                    <p style="color:#EF5012">' + row.update_date + '</p>';
					strDiv += '                </div>';
					strDiv += '            </div>';
					strDiv += '        </div>';
					strDiv += '    </td>';
					
					var discount_kr = row.discount_kr;
					var discount_en = row.discount_en;
					var discount_cn = row.discount_cn;
					
					strDiv += '    <td style="text-align: right;">';
					if (discount_kr > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
						strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
					} else {
						if(row.price_kr != null){
							strDiv += '        ' + row.price_kr;
						}
					}
					strDiv += '    </td>';
					
					strDiv += '    <td style="text-align: right;">';
					if (discount_en > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
						strDiv += '        <span>' + row.sales_price_en + "</span></br>";
					} else {
						if(row.price_en != null){
							strDiv += '        ' + row.price_en;
						}
					}
					strDiv += '    </td>';
					
					strDiv += '    <td style="text-align: right;">';
					if (discount_cn > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn + "</span></br>";
						strDiv += '        <span>' + row.sales_price_cn + "</span></br>";
					} else {
						if(row.price_cn != null){
							strDiv += '        ' + row.price_cn;
						}
					}
					strDiv += '    </td>';
					
					strDiv += '    <td>' + row.stock_qty + '</td>';
					strDiv += '    <td>' + row.safe_qty + '</td>';
					strDiv += '    <td>' + row.order_qty + '</td>';
					strDiv += '    <td>' + row.stock_qty + '</td>';
					
					strDiv += '    <td></td>';
					strDiv += '</tr>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD colspan="10" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}

function orderChange_BSK(obj) {	
	let frm = $('#frm-BSK');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getModalBasketInfo();
}

function rowsChange_BSK(obj) {
	let frm = $('#frm-BSK');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getModalBasketInfo();
}

function setPaging_BSK(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_BSK_total').text(total_cnt.val());
}

</script>