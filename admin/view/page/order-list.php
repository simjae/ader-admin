<?php include_once("check.php"); ?>
<style>
.double__table__container{display:grid;grid-template-columns:40px 1fr}
table.checkbox__table{width:30px;margin-bottom:14px;}
.order_tab_btn{width:140px;padding:10px 0 10px 0}
</style>
<div class="filter-wrap" style="margin-bottom:20px">
	<button class="order_tab_btn tap__button" tab_status="ORD_ALL" style="background-color: #000;color: #fff;font-weight: 500;" onClick="orderTabBtnClick(this);">전체</button>
	<button class="order_tab_btn tap__button" tab_status="PCP" onClick="orderTabBtnClick(this);">결제완료</button>
	<button class="order_tab_btn tap__button" tab_status="PPR" onClick="orderTabBtnClick(this);">상품준비</button>
	<button class="order_tab_btn tap__button" tab_status="POP" onClick="orderTabBtnClick(this);">프리오더 준비</button>
	<button class="order_tab_btn tap__button" tab_status="POD" onClick="orderTabBtnClick(this);">프리오더 상품 생산</button>
	<button class="order_tab_btn tap__button" tab_status="DPR" onClick="orderTabBtnClick(this);">배송준비</button>
	<button class="order_tab_btn tap__button" tab_status="DPG" onClick="orderTabBtnClick(this);">배송중</button>
	<button class="order_tab_btn tap__button" tab_status="DCP" onClick="orderTabBtnClick(this);">배송완료</button>
</div>

<input id="tab_status" type="hidden" value="ORD_ALL">

<div id="order_tab_ORD_ALL" class="order_tab">
	<?php include_once("order-list-all.php"); ?>
</div>

<div id="order_tab_PCP" class="order_tab" style="display:none;">
	<?php include_once("order-list-pcp.php"); ?>
</div>

<div id="order_tab_PPR" class="order_tab" style="display:none;">
	<?php include_once("order-list-ppr.php"); ?>
</div>

<div id="order_tab_POP" class="order_tab" style="display:none;">
	<?php include_once("order-list-pop.php"); ?>
</div>

<div id="order_tab_POD" class="order_tab" style="display:none;">
	<?php include_once("order-list-pod.php"); ?>
</div>

<div id="order_tab_DPR" class="order_tab" style="display:none;">
	<?php include_once("order-list-dpr.php"); ?>
</div>

<div id="order_tab_DPG" class="order_tab" style="display:none;">
	<?php include_once("order-list-dpg.php"); ?>
</div>

<div id="order_tab_DCP" class="order_tab" style="display:none;">
	<?php include_once("order-list-dcp.php"); ?>
</div>

<script>
$(document).ready(function() {
	$('.detail_hidden').hide();
});
function selectAllClick(obj){
	var tab_status = $('#tab_status').val();
	
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_checkbox_table_" + tab_status).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_checkbox_table_" + tab_status).find('.select').prop('checked',false);
	}
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$(obj).parents('.order_tab').find('.sort_value').val(order_value[0]);
	$(obj).parents('.order_tab').find('.sort_type').val(order_value[1]);
	
	getOrderInfoList();
}
function rowsChange(obj) {
	var rows = $(obj).val();
	$(obj).parents('.order_tab').find('.rows').val(rows);
	$(obj).parents('.order_tab').find('.page').val(1);

	getOrderInfoList();
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$(obj).parents('form').find('.cnt_total').text(total_cnt.val());
	$(obj).parents('form').find('.cnt_result').text(result_cnt.val());
}

function orderTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	$('.order_tab').hide();
	$('#order_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.order_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.order_tab_btn').not($(obj)).css('color','#000000');

	let table_wrap_frm = $('#frm-action-' + tab_status);
	document.querySelectorAll('#frm-action-' + tab_status + ' .marker_td').forEach(
	(el,idx)=>
		{	
			table_wrap_frm.find('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
		}
	);
}

function detailToggleClick(obj) {
	let tab_status = $('#tab_status').val();
	
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기 +');
	}
	$('#frm-list_' + tab_status).find('.detail_hidden').toggle();
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	var date_type = $(obj).attr('date_type');

	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000');

	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');

	$('#date_param_' + date_type).val(date);
	$('#date_from_' + date_type).val('');
	$('#date_to_' + date_type).val('');

}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');

	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000');

	$('#date_param_' + date_type).val('');
}

function searchTypeClick(obj){
	let name = $(obj).attr('name');
	let val = $(obj).val();
	if(val == 'searchCondition'){
		$('.search__status').hide()
		$('.search__condition').show();
	} else if( val =='searchStatus'){
		$('.search__condition').hide();
		$('.search__status').show();
	}
}
function searchKeywordBtnClick(obj) {
	var search_keyword = $(obj).parents('form').find('.search_keyword');
	var length = search_keyword.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 10) {
			var strDiv = "";
			strDiv += '<div class="row">';
			strDiv += '    <select class="fSelect search_keyword" name="search_keyword[]" style="width:163px;" onchange="searchKeywordChange(this)">';
			strDiv += '        <option value="ALL" selected>검색 키워드 선택</option>';
			strDiv += '        <option value="order_code">주문번호</option>';
			strDiv += '        <option value="delivery_num">운송장번호</option>';
			strDiv += '        <option value="member_name">멤버 이름</option>';
			strDiv += '        <option value="member_id">멤버 아이디</option>';
			strDiv += '        <option value="member_tel">멤버 핸드폰</option>';
			strDiv += '        <option value="member_email">멤버 이메일</option>';
			strDiv += '        <option value="to_place">배송지</option>';
			strDiv += '        <option value="to_name">수령자 이름</option>';
			strDiv += '        <option value="to_mobile">수령자 핸드폰</option>';
			strDiv += '        <option value="order_memo">주문 메모</option>';
			strDiv += '    </select>';

			strDiv += '    <input type="text" name="keyword_param[]" value="" style="width:60%;">';
			strDiv += '    <button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="append" onclick="searchKeywordBtnClick(this)">+</button>';
			strDiv += '    <button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="remove" onclick="searchKeywordBtnClick(this)">-</button>';
			strDiv += '</div>';
			
			$(obj).parents('form').find('.search_keyword_td').append(strDiv);
		} else {
			alert('검색분류는 10개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 검색분류를 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function searchKeywordChange(obj) {
	var this_val = $(obj).val();
	var search_keyword = $(obj).parents('form').find('.search_keyword');
	var length = search_keyword.length;
	
	if (length > 1) {
		var search_keyword_arr = [];
		for (var i=0; i<length; i++) {
			search_keyword_arr[i] = search_keyword.eq(i).val();
		}
		
		const result = search_keyword_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 검색분류를 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
		}
	}
}

function searchProductTypeBtnClick(obj) {
	var search_product = $(obj).parents('form').find('.search_product');
	var length = search_product.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 3) {
			var strDiv = "";
			strDiv += '<div class="row">';
			strDiv += '    <select class="fSelect eSearch search_product" name="search_product[]" style="width:163px;" onChange="searchProductTypeChange(this);">';
			strDiv += '        <option value="ALL" selected>상품정보 선택</option>';
			strDiv += '        <option value="code">상품 코드</option>';
			strDiv += '        <option value="name">상품 이름</option>';
			strDiv += '    </select>';

			strDiv += '    <input type="text" name="product_param[]" value="" style="width:60%;">';
			strDiv += '    <button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="append" onclick="searchProductTypeBtnClick(this)">+</button>';
			strDiv += '    <button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="remove" onclick="searchProductTypeBtnClick(this)">-</button>';
			strDiv += '</div>';
			
			$(obj).parents('form').find('.search_product_td').append(strDiv);
		} else {
			alert('검색분류는 3개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 검색분류를 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function searchProductTypeChange(obj) {
	var this_val = $(obj).val();
	var search_product = $(obj).parents('form').find('.search_product'); 
	var length = search_product.length;
	
	if (length > 1) {
		var search_product_arr = [];
		for (var i=0; i<length; i++) {
			search_product_arr[i] = search_product.eq(i).val();
		}
		
		const result = search_product_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 검색분류를 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
		}
	}
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=number]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}

function excelDownload(str, type) {
	$('#excel_table_head_' + str).html('');
	$('#excel_result_table_' + str).html('');

	var formData = new FormData();
	formData = $('#frm-list_' + str).serializeObject();
	formData.excel_type = type;

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "order/excel/get",
		error: function() {
			alert('주문정보 엑셀 내려받기 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d != null){
				if(d.code == 200) {
					if(d.data != null && d.data.length > 0){
						
						let str_div_th = "";
						let str_div_td = "";
						
						if (type == 'DF') {
							sheet_name = "주문정보(기본양식)";
							file_name = "주문리스트_일반_";

							str_div_th += '<tr>';
							
							str_div_th += '    <th>국가</th>';
							str_div_th += '    <th>주문 코드</th>';
							str_div_th += '    <th>주문 상품 코드</th>';
							str_div_th += '    <th>주문일</th>';
							str_div_th += '    <th>상품 코드</th>';
							str_div_th += '    <th>상품 이름</th>';
							str_div_th += '    <th>옵션 이름</th>';
							str_div_th += '    <th>바코드</th>';
							str_div_th += '    <th>주문 수량</th>';
							
							str_div_th += '    <th>판매가(한국몰)</th>';
							str_div_th += '    <th>판매가(영문몰)</th>';
							str_div_th += '    <th>판매가(중문몰)</th>';
							str_div_th += '    <th>상품 구매금액</th>';
							str_div_th += '    <th>총 상품 금액</th>';
							str_div_th += '    <th>적립금 사용 금액</th>';
							str_div_th += '    <th>충전 포인트 사용 금액</th>';
							str_div_th += '    <th>바우처 할인금액</th>';
							str_div_th += '    <th>배송비</th>';
							str_div_th += '    <th>총 주문금액</th>';
							
							str_div_th += '    <th>수령 이름</th>';
							str_div_th += '    <th>수령 전화번호</th>';
							str_div_th += '    <th>수령 우편번호</th>';
							str_div_th += '    <th>수령 지번주소</th>';
							str_div_th += '    <th>수령 도로명주소</th>';
							str_div_th += '    <th>수령 상세주소</th>';
							
							str_div_th += '    <th>결제 상태</th>';
							str_div_th += '    <th>결제 수단</th>';
							str_div_th += '</tr>';

						} else if (type == 'SL') {
							sheet_name = "주문정보(매출자료용)";
							file_name = "주문리스트_매출_";

							str_div_th += '<tr>';
							
							str_div_th += '    <th>국가</th>';
							str_div_th += '    <th>주문 상태(주문)</th>';
							str_div_th += '    <th>주문 코드</th>';
							str_div_th += '    <th>주문 상품 코드</th>';
							str_div_th += '    <th>주문일</th>';
							str_div_th += '    <th>취소일</th>';
							str_div_th += '    <th>교환일</th>';
							str_div_th += '    <th>반품일</th>';
							
							str_div_th += '    <th>주문 상태(상품)</th>';
							str_div_th += '    <th>상품 코드</th>';
							str_div_th += '    <th>상품 이름</th>';
							str_div_th += '    <th>옵션 이름</th>';
							str_div_th += '    <th>바코드</th>';
							str_div_th += '    <th>주문 수량</th>';
							str_div_th += '    <th>판매가(한국몰)</th>';
							str_div_th += '    <th>판매가(영문몰)</th>';
							str_div_th += '    <th>판매가(중문몰)</th>';
							str_div_th += '    <th>주문자 ID</th>';
							str_div_th += '    <th>주문자 이름</th>';
							str_div_th += '    <th>주문자 생년월일</th>';
							
							str_div_th += '    <th>상품 구매금액</th>';			//product_price
							str_div_th += '    <th>상품 구매금액 (KRW)</th>';	//product_price_kr
							str_div_th += '    <th>총 결제 금액</th>';			//pg_price
							str_div_th += '    <th>총 결제 금액 (KRW)</th>';	//pg_price_kr
							str_div_th += '    <th>총 상품 금액</th>';			//price_product
							str_div_th += '    <th>총 상품 금액 (KRW)</th>';	//price_product_kr
							str_div_th += '    <th>적립금 사용 금액</th>';
							str_div_th += '    <th>충전 포인트 사용 금액</th>';
							str_div_th += '    <th>바우처 할인금액</th>';
							str_div_th += '    <th>배송비</th>';
							str_div_th += '    <th>총 환불금액</th>';			//price_refund
							str_div_th += '    <th>총 환불금액 (KRW)</th>';		//price_refund_kr
							str_div_th += '    <th>총 주문금액</th>';			//price_total
							str_div_th += '    <th>총 주문금액 (KRW)</th>';		//price_total_kr
							
							str_div_th += '    <th>수령 이름</th>';
							str_div_th += '    <th>수령 전화번호</th>';
							str_div_th += '    <th>수령 우편번호</th>';
							str_div_th += '    <th>수령 지번주소</th>';
							str_div_th += '    <th>수령 도로명주소</th>';
							str_div_th += '    <th>수령 상세주소</th>';
							
							str_div_th += '    <th>결제 상태</th>';
							str_div_th += '    <th>결제 수단</th>';
							
							str_div_th += '</tr>';
						}
						
						d.data.forEach(function(row){
							if (type == 'DF') {
								str_div_td += '<tr>';
								
								str_div_td += '    <td>' + row.txt_country + '</td>';
								str_div_td += '    <td>' + row.order_code + '</td>';
								str_div_td += '    <td>' + row.order_product_code + '</td>';
								str_div_td += '    <td>' + row.order_date + '</td>';
								str_div_td += '    <td>' + row.product_code + '</td>';
								str_div_td += '    <td>' + row.product_name + '</td>';
								str_div_td += '    <td>' + row.option_name + '</td>';
								str_div_td += '    <td>' + row.barcode + '</td>';
								str_div_td += '    <td>' + row.product_qty + '</td>';
								
								str_div_td += '    <td>' + row.sales_price_kr + '</td>';
								str_div_td += '    <td>' + row.sales_price_en + '</td>';
								str_div_td += '    <td>' + row.sales_price_cn + '</td>';
								str_div_td += '    <td>' + row.product_price + '</td>';
								str_div_td += '    <td>' + row.price_product + '</td>';
								str_div_td += '    <td>' + row.price_mileage_point + '</td>';
								str_div_td += '    <td>' + row.price_charge_point + '</td>';
								str_div_td += '    <td>' + row.price_discount + '</td>';
								str_div_td += '    <td>' + row.price_delivery + '</td>';
								str_div_td += '    <td>' + row.price_total + '</td>';
								
								str_div_td += '    <td>' + row.to_name + '</td>';
								str_div_td += '    <td>' + row.to_mobile + '</td>';
								str_div_td += '    <td>' + row.to_zipcode + '</td>';
								str_div_td += '    <td>' + row.to_lot_addr + '</td>';
								str_div_td += '    <td>' + row.to_road_addr + '</td>';
								str_div_td += '    <td>' + row.to_detail_addr + '</td>';
								
								str_div_td += '    <td>' + row.pg_status + '</td>';
								str_div_td += '    <td>' + row.pg_payment + '</td>';
								
								str_div_td += '</tr>';
							} else if (type == 'SL') {
								str_div_td += '<tr>';
								
								str_div_td += '    <td>' + row.txt_country + '</td>';
								str_div_td += '    <td>' + row.order_info_status + '</td>';
								str_div_td += '    <td>' + row.order_code + '</td>';
								str_div_td += '    <td>' + row.order_product_code + '</td>';
								str_div_td += '    <td>' + row.order_date + '</td>';
								str_div_td += '    <td>' + row.cancel_date + '</td>';
								str_div_td += '    <td>' + row.exchange_date + '</td>';
								str_div_td += '    <td>' + row.refund_date + '</td>';
								
								str_div_td += '    <td>' + row.order_product_status + '</td>';
								str_div_td += '    <td>' + row.product_code + '</td>';
								str_div_td += '    <td>' + row.product_name + '</td>';
								str_div_td += '    <td>' + row.option_name + '</td>';
								str_div_td += '    <td>' + row.barcode + '</td>';
								str_div_td += '    <td>' + row.product_qty + '</td>';
								str_div_td += '    <td>' + row.sales_price_kr + '</td>';
								str_div_td += '    <td>' + row.sales_price_en + '</td>';
								str_div_td += '    <td>' + row.sales_price_cn + '</td>';
								str_div_td += '    <td>' + row.member_id + '</td>';
								str_div_td += '    <td>' + row.member_name + '</td>';
								str_div_td += '    <td>' + row.member_birth + '</td>';

								str_div_td += '    <td>' + row.product_price + '</td>';
								str_div_td += '    <td>' + row.product_price_kr + '</td>';
								str_div_td += '    <td>' + row.pg_price + '</td>';
								str_div_td += '    <td>' + row.pg_price_kr + '</td>';
								str_div_td += '    <td>' + row.price_product + '</td>';
								str_div_td += '    <td>' + row.price_product_kr + '</td>';
								str_div_td += '    <td>' + row.price_mileage_point + '</td>';
								str_div_td += '    <td>' + row.price_charge_point + '</td>';
								str_div_td += '    <td>' + row.price_discount + '</td>';
								str_div_td += '    <td>' + row.price_delivery + '</td>';
								str_div_td += '    <td>' + row.price_refund + '</td>';
								str_div_td += '    <td>' + row.price_refund_kr + '</td>';
								str_div_td += '    <td>' + row.price_total + '</td>';
								str_div_td += '    <td>' + row.price_total_kr + '</td>';
								
								str_div_td += '    <td>' + row.to_name + '</td>';
								str_div_td += '    <td>' + row.to_mobile + '</td>';
								str_div_td += '    <td>' + row.to_zipcode + '</td>';
								str_div_td += '    <td>' + row.to_lot_addr + '</td>';
								str_div_td += '    <td>' + row.to_road_addr + '</td>';
								str_div_td += '    <td>' + row.to_detail_addr + '</td>';
								
								str_div_td += '    <td>' + row.pg_status + '</td>';
								str_div_td += '    <td>' + row.pg_payment + '</td>';
								
								str_div_td += '</tr>';
							}
						});
						
						$('#excel_table_head_' + str).append(str_div_th);
						$('#excel_result_table_' + str).append(str_div_td);
					}
					
					alert('주문정보 엑셀 내려받기 처리에 성공했습니다.');
				} else {
					alert(d.msg);
				}
			}
		}
	}).then(function(){
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		file_name += file_date;
		
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + str), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	});
}

function setOrderHead(column_arr) {
	let tab_status = $('#tab_status').val();
	let select_product_flg = $('.select_product_flg_' + tab_status).val();
	
	let column_date_div = "";
	let column_product_div = "";
	let column_div = "";
	
	let head_date_div = "";
	let head_div = "";
	let head_product_div = "";
	
	if (select_product_flg == "true") {
		column_product_div += '<col width="300px;">';
		head_product_div += '<TH>상품정보</TH>';
	}
	
	if (column_arr.length > 0) {
		for (let i=0; i<column_arr.length; i++) {
			switch (column_arr[i]) {
				case "cancel_date" :
					column_date_div += '<col width="150px">';
					head_date_div += '<TH>주문<br/>취소일</TH>';
					break;
				
				case "exchange_date" :
					column_date_div += '<col width="150px">';
					head_date_div += '<TH>주문<br/>교환일</TH>';
					break;
				
				case "refund_date" :
					column_date_div += '<col width="150px">';
					head_date_div += '<TH>주문<br/>환불일</TH>';
					break;
				
				case "pg_date" :
					column_div += '<col width="150px">';
					head_div += '<TH>결제일</TH>';
					break;
				
				case "pg_payment" :
					column_div += '<col width="100px">';
					head_div += '<TH>결제수단</TH>';
					break;
				
				case "pg_status" :
					column_div += '<col width="100px">';
					head_div += '<TH>결제상태</TH>';
					break;
				
				case "pg_currency" :
					column_div += '<col width="100px">';
					head_div += '<TH>결제통화</TH>';
					break;
				
				case "pr_price" :
					column_div += '<col width="150px">';
					head_div += '<TH>결제가격</TH>';
					break;
				
				case "pg_mid" :
					column_div += '<col width="150px">';
					head_div += '<TH>결제ID</TH>';
					break;
				
				case "pg_payment_key" :
					column_div += '<col width="auto;">';
					head_div += '<TH>결제지불키</TH>';
					break;
				
				case "pg_receipt_url" :
					column_div += '<col width="auto;">';
					head_div += '<TH>결제영수증URL</TH>';
					break;
				
				case "delivery_num" :
					column_div += '<col width="150px">';
					head_div += '<TH>송장번호</TH>';
					break;
				
				case "delivery_type" :
					column_div += '<col width="50px">';
					head_div += '<TH>배송유형</TH>';
					break;
				
				case "delivery_date" :
					column_div += '<col width="150px">';
					head_div += '<TH>배송<br/>예정일</TH>';
					break;
				
				case "delivery_status" :
					column_div += '<col width="150px">';
					head_div += '<TH>배송상태</TH>';
					break;
				
				case "delivery_start_date" :
					column_div += '<col width="150px">';
					head_div += '<TH>배송<br/>시작일</TH>';
					break;
				
				case "delivery_end_date" :
					column_div += '<col width="150px">';
					head_div += '<TH>배송<br/>종료일</TH>';
					break;
				
				case "company_name" :
					column_div += '<col width="150px">';
					head_div += '<TH>배송회사<br/>이름</TH>';
					break;
				
				case "order_memo" :
					column_div += '<col width="auto;">';
					head_div += '<TH>주문메모</TH>';
					break;
			}
		}
	}
	
	let strDiv = "";
	strDiv += '<colgroup>';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="150px">';
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="150px">';
	
	strDiv += column_date_div;
	
	strDiv += '    <col width="150px">';
	
	strDiv += column_product_div;
	
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="100px">';
	strDiv += '    <col width="100px">';
	
	strDiv += column_div;
	
	strDiv += '</colgroup>';
	
	strDiv += '<THEAD>';
	strDiv += '    <TR>';
	strDiv += '        <TH class="marker_td">쇼핑몰</TH>';
	strDiv += '        <TH>주문코드</TH>';
	strDiv += '        <TH>주문 상태</TH>';
	strDiv += '        <TH>주문일</TH>';
	
	strDiv += head_date_div;
	
	strDiv += '        <TH>주문자</TH>';
	
	strDiv += head_product_div;
	
	strDiv += '        <TH>상품<br/>총가격</TH>';
	strDiv += '        <TH>사용<br/>적립포인트</TH>';
	strDiv += '        <TH>사용<br/>충전포인트</TH>';
	strDiv += '        <TH>할인금액</TH>';
	strDiv += '        <TH>배송비</TH>';
	strDiv += '        <TH>총 결제금액</TH>';
	
	strDiv += head_div;
	
	strDiv += '    </TR>';
	strDiv += '</THEAD>';
	
	return strDiv;
}


function setOrderBody(column_arr,d,order_status) {
	let result_checkbox_table = $("#result_checkbox_table_" + order_status);
	let select_product_flg = $('.select_product_flg_' + order_status).val();
	
	let strDiv = "";
	
	d.forEach(function(row) {
		let detail_link = "";
		if (row.country != null && row.member_idx != null) {
			detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
		}
		
		let order_link = "";
		if (row.order_code != null) {
			order_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))" ';
		}
		
		let detail_mileage_link = "";
		if (detail_link.length > 0 && row.price_mileage_point > 0) {
			detail_mileage_link = ' style="text-align:right;text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '&detail_status=MLG\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
		} else {
			detail_mileage_link = ' style="text-align:right"';
		}
		
		let detail_voucher_link = "";
		if (detail_link.length > 0 && row.price_discount > 0) {
			detail_voucher_link = ' style="text-align:right;text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '&detail_status=VOU\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
		} else {
			detail_voucher_link = ' style="text-align:right"';
		}
		
		let body_date_div = "";
		let body_div = "";
		let body_product_div = "";
		
		if (select_product_flg == "true") {
			let order_product_info = row.order_product_info;
			if (order_product_info.length > 0 && order_product_info != null) {
				body_product_div += '<td style="width:300px;">';
				body_product_div += '    <table style="width:100%;">';
				body_product_div += '        <colgroup>';
				body_product_div += '            <col width="30%;">';
				body_product_div += '            <col width="15%;">';
				body_product_div += '            <col width="15%;">';
				body_product_div += '            <col width="20%;">';
				body_product_div += '            <col width="20%;">';
				body_product_div += '        </colgroup>';
				body_product_div += '        <thead>';
				body_product_div += '            <th>상품이름 / 사이즈 / 상품코드</th>';
				body_product_div += '            <th>주문상태</th>';
				body_product_div += '            <th>바코드</th>';
				body_product_div += '            <th>상품수량</th>';
				body_product_div += '            <th>상품가격</th>';
				body_product_div += '        </thead>';
				body_product_div += '        <tbody>';

				order_product_info.forEach(function(product_row) {
					var background_url = "background-image:url('" + product_row.img_location + "');";
					
					body_product_div += '        <tr>';
					body_product_div += '            <td>';
					body_product_div += '                <div style="padding:5px;">';
					body_product_div += '                    <div class="product__img__wrap">';
					body_product_div += '                        <div>';
					body_product_div += '                            <p style="margin-bottom:5px;">' + product_row.product_name + '</p>';
					body_product_div += '                            <p style="margin-bottom:5px;">' + product_row.option_name + '</p>';
					body_product_div += '                            <p>' + product_row.product_code + '</p>';
					body_product_div += '                        </div>';
					body_product_div += '                    </div>';
					body_product_div += '                </div>';
					body_product_div += '            </td>';
					body_product_div += '            <TD>' + product_row.txt_order_status + '</TD>';
					body_product_div += '            <TD>' + product_row.barcode + '</TD>';
					body_product_div += '            <TD style="text-align:right;">' + product_row.product_qty + '</TD>';
					body_product_div += '            <TD style="text-align:right;">' + product_row.product_price + '</TD>';
					body_product_div += '        </tr>';
				});
				
				body_product_div += '            </tbody>';
				body_product_div += '        </table>';
				body_product_div += '    </td>';
			}
		}
		
		for (let i=0; i<column_arr.length; i++) {
			switch (column_arr[i]) {
				case "cancel_date" :
					body_date_div += '<TD>' + row.cancel_date + '</TD>';
					break;
				
				case "exchange_date" :
					body_date_div += '<TD>' + row.exchange_date + '</TD>';
					break;
				
				case "refund_date" :
					body_date_div += '<TD>' + row.refund_date + '</TD>';
					break
				
				case "pg_date" :
					body_div += '<TD>' + row.pg_date + '</TD>';
					break
				
				case "pg_payment" :
					body_div += '<TD>' + row.pg_payment + '</TD>';
					break;
				
				case "pg_status" :
					body_div += '<TD>' + row.pg_status + '</TD>';
					break;
				
				case "pg_currency" :
					body_div += '<TD>' + row.pg_currency + '</TD>';
					break
				
				case "pg_price" :
					body_div += '<TD>' + row.pg_price + '</TD>';
					break
					
				case "pg_mid" :
					body_div += '<TD>' + row.pg_mid + '</TD>';
					break
				
				case "pg_payment_key" :
					body_div += '<TD>' + row.pg_payment_key + '</TD>';
					break
				
				case "pg_receipt_url" :
					body_div += '<TD>' + row.pg_receipt_url + '</TD>';
					break
				
				case "delivery_num" :
					body_div += '<TD>' + row.delivery_num + '</TD>';
					break;
				
				case "delivery_type" :
					body_div += '<TD>' + row.delivery_type + '</TD>';
					break;
				
				case "delivery_date" :
					body_div += '<TD>' + row.delivery_date + '</TD>';
					break;
				
				case "delivery_status" :
					body_div += '<TD>' + row.delivery_status + '</TD>';
					break;
				
				case "delivery_start_date" :
					body_div += '<TD>' + row.delivery_start_date + '</TD>';
					break;
				
				case "delivery_end_date" :
					body_div += '<TD>' + row.delivery_end_date + '</TD>';
					break;
				
				case "company_name" :
					body_div += '<TD>' + row.company_name + '</TD>';
					break;
				
				case "order_memo" :
					body_div += '<TD>' + row.order_memo + '</TD>';
					break;
			}
		}
		
		strCheckboxDiv = "";
		strCheckboxDiv += '<tr style="width:30px;"class="checkbox_tr">';
		strCheckboxDiv += '    <td class="check__box__area">';
		strCheckboxDiv += '        <div class="cb__color">';
		strCheckboxDiv += '            <label>';
		strCheckboxDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.order_idx + '">';
		strCheckboxDiv += '                <span></span>';
		strCheckboxDiv += '            </label>';
		strCheckboxDiv += '        </div>';
		strCheckboxDiv += '    </td>';
		strCheckboxDiv += '</tr>';
		result_checkbox_table.append(strCheckboxDiv);

		strDiv += '	<tr>';
		strDiv += '    <TD class="marker_td">' + row.txt_country + '</TD>';
		strDiv += '    <TD ' + order_link + '>' + row.order_code + '</TD>';
		strDiv += '    <TD>' + row.txt_order_status + '</TD>';
		strDiv += '    <TD>' + row.order_date + '</TD>';
		
		strDiv += body_date_div;
		
		strDiv += '    <TD ' + detail_link + '>';
		strDiv += '        ' + row.member_id + '<br/>';
		strDiv += '        ' + row.member_name + '<br>';
		strDiv += '        ' + row.member_level;
		strDiv += '    </TD>';
		
		strDiv += body_product_div
		
		strDiv += '    <TD style="text-align:right;">' + row.price_product + '</TD>';
		strDiv += '    <TD ' + detail_mileage_link + '>' + row.price_mileage_point + '</TD>';
		strDiv += '    <TD style="text-align:right;">' + row.price_charge_point + '</TD>';
		strDiv += '    <TD ' + detail_voucher_link + '>' + row.price_discount + '</TD>';
		strDiv += '    <TD style="text-align:right;">' + row.price_delivery + '</TD>';
		strDiv += '    <TD style="text-align:right;">' + row.price_total + '</TD>';
		
		strDiv += body_div;
		
		strDiv += '</tr>';
	});
	
	return strDiv;
}

function getOrderInfoList(order_status) {
	if (order_status == "" || order_status == null) {
		order_status = $('#tab_status').val();
	}
	let frm = $('#frm-list_' + order_status);
	
	let table_wrap_frm = $('#frm-action-' + order_status);
	let result_checkbox_table = $("#result_checkbox_table_" + order_status);
	let result_table = $("#result_table_" + order_status);

	result_checkbox_table.html('');
	result_table.html('');
	
	let select_column = frm.find('.select_column').val()
	
	let column_arr = [];
	if (select_column.length > 0) {
		column_arr = select_column.split(",");
	}
	
	let div_head = setOrderHead(column_arr);
	result_table.append(div_head);
	
	var strCheckboxDiv = '';
	strCheckboxDiv += '<TD class="checkbox_tr"></TD>';

	var strDiv = '';
	strDiv += '<TBODY id="result_body_' + order_status + '">';
	strDiv += '    <TD class="default_td marker_td" colspan="' + (14 + column_arr.length) + '" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TBODY>';
	
	result_checkbox_table.append(strCheckboxDiv);
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $("#frm-action-" + order_status).find(".paging"),
		html : function(d) {			
			if (d != null) {
				let result_body = $('#result_body_' + order_status);
				result_body.remove();
				result_checkbox_table.html('');
				result_table.append('<TBODY id="result_body_' + order_status + '"></TBODY>');
				
				let div_body = setOrderBody(column_arr,d,order_status);
				
				$('#result_body_' + order_status).append(div_body);
			}
			document.querySelectorAll('#frm-action-' + order_status + ' .marker_td').forEach(
			(el,idx)=>
				{	
					table_wrap_frm.find('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
				}
			);
		},
	},rows,1);
}

function openSelectColumnModal(order_status) {
	modal('/get','order_status=' + order_status);
}
</script>