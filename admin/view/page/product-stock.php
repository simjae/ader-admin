	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="stock_tab_btn tap__button" tab_num="01" style="background-color:#000000;color:#ffffff;font-weight:500;" onClick="stockTabBtnClick(this);">상품재고 등록</button>
		<button class="stock_tab_btn tap__button" tab_num="02" onClick="stockTabBtnClick(this);">상품재고 관리</button>
		<button class="stock_tab_btn tap__button" tab_num="03" onClick="stockTabBtnClick(this);">품절재고 관리</button>
	</div>

	<input id="tab_num" type="hidden" value="01">
	
	<div id="stock_tab_01" class="row stock_tab">
		<?php include_once("product-stock-regist.php"); ?>
	</div>
	
	<div id="stock_tab_02" class="row stock_tab" style="display:none;margin-top:0px;">
		<?php include_once("product-stock-list.php"); ?>
	</div>
	
	<div id="stock_tab_03" class="row stock_tab" style="display:none;margin-top:0px;">
		<?php include_once("product-stock-sold_out.php"); ?>
	</div>

<script>
$(document).ready(function() {
	getProductCategory(0,0);
});
function init_filter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
function stockTabBtnClick(obj) {	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	
	$('.stock_tab').hide();
	$('#stock_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.stock_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.stock_tab_btn').not($(obj)).css('color','#000000');
	
	if ($('#frm-list_' + tab_num).find('.eCategory1').children().length == 0) {
		getProductCategory(0,0);
	}
}

function searchTypeBtnClick(obj) {
	var tab_num = $('#tab_num').val();
	
	var search_type = $('#frm-list_' + tab_num).find('.search_type');
	var length = search_type.length;
	var action_type = $(obj).attr('action_type');
	console.log(length);
	if (action_type == "append") {
		if (length < 9) {
			var strDiv = "";
			strDiv += '<div class="">';
			strDiv += '    <select class="fSelect eSearch search_type" name="search_type[]" style="width:163px;" onChange="searchTypeChange(this);">';
			strDiv += '        <option value="" selected>검색분류 선택</option>';
			strDiv += '        <option value="name">상품명</option>';
			strDiv += '        <option value="code">상품코드</option>';
			strDiv += '        <option value="category">상품분류</option>';
			strDiv += '        <option value="size">사이즈</option>';
			strDiv += '        <option value="material">주원료</option>';
			strDiv += '        <option value="care">주의사항</option>';
			strDiv += '        <option value="detail">상품 상세정보</option>';
			strDiv += '        <option value="tag">상품태그</option>';
			strDiv += '        <option value="creater">등록아이디</option>';
			strDiv += '    </select>';
			
			strDiv += '    <input type="text" name="search_keyword[]" value="" style="width:70%;">';
			
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">+</button>';
			strDiv += '</div>';
			
			$(obj).unbind();
			$('#frm-list_' + tab_num).find('.search_type_td').append(strDiv);
		} else {
			alert('검색분류는 9개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 검색분류를 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function searchTypeChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var this_val = $(obj).val();
	var length = $('#frm-list_' + tab_num).find('.search_type').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-list_' + tab_num).find('.search_type').eq(i).val();
		}
		
		const result = search_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 검색분류를 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
		}
	}
}

function getProductCategory(depth,no) {
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
		url: config.api + "product/common/get",
		error: function() {
			data.instance.refresh();
		},
		success: function(d) {
			if(d.code == 200) {
				setProductCategory(depth,d.data);
			}
		}
	});
}

function setProductCategory(depth,d) {
	var tab_num = $('#tab_num').val();
	
	var eCategory = $('#frm-list_' + tab_num).find('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="">상품분류 0' + depth + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	eCategory.prop("selected", true);
}

function productCategoryChange(obj) {
	var tab_num = $('#tab_num').val();
	
	$('#frm-list_' + tab_num).find('input[name=category_all_flg]').removeAttr("checked");
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
	getProductCategory(depth,no);
}

function search_date_set(e){
	var date_val = "";
	switch($(e).val()){
		case '오늘':
			date_val = 'today';
			break;
		case '3일':
			date_val = '3d';
			break;
		case '7일':
			date_val = '1w';
			break;
		case '1개월':
			date_val = '1m';
			break;
		case '3개월':
			date_val = '3m';
			break;
		case '1년':
			date_val = '1y';
			break;
		case '전체':
			date_val = 'all';
			break;
	}
	$("input[name='search_date']").val(date_val);
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');

	var date_type = $(obj).attr('date_type');
	$('.search_date_' + date_type).not($(obj)).css('background-color','#ffffff');
	$('#search_date_' + date_type).val(date);
	$('#' + date_type + '_from').val('');
	$('#' + date_type + '_to').val('');
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000000');
	
	$('#search_date_' + date_type).val('');

	var stock_date_from = $("#" + date_type + "_from").val();
	var stock_date_to = $("#" + date_type + "_to").val();

	var start_date = new Date(stock_date_from);
	var end_date = new Date(stock_date_to);
	var now_date = new Date();

	if(start_date > now_date) {
		alert('검색 시작일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
	if(start_date > end_date) {
		alert('검색 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}

function detailToggleClick(obj) {
	var tab_num = $('#tab_num').val();
	
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('.detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('.detail_toggle').text('상세검색 열기 +');
	}
	//$('#frm-list_' + tab_num).find('.detail_hidden').show();
	$('#frm-list_' + tab_num).find('.detail_hidden').toggle();
}

function priceTypeChange(obj) {
	var tab_num = $('#tab_num').val();
	var this_val = $(obj).val();
	var length = $('#frm-list_' + tab_num).find('.price_type').length;
	
	var unit_text = "";
	switch (this_val) {
		case "SALES_PRICE_KR" :
			unit_text = "KRW";
			break;
		
		case "SALES_PRICE_EN" :
			unit_text = "USD";
			break;
		
		case "SALES_PRICE_CN" :
			unit_text = "USD";
			break;
	}
	
	$(obj).parent().find('.price_type_unit').text(unit_text);
	
	if (length > 1) {
		var price_type_arr = [];
		for (var i=0; i<length; i++) {
			price_type_arr[i] = $('#frm-list_' + tab_num).find('.price_type').eq(i).val();
		}
		
		const result = price_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 상품가격 유형을 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
			$('.price_type_unit').text('단위');
		}
	}
}

function priceTypeBtnClick(obj) {
	var tab_num = $('#tab_num').val();
	var price_type = $('#frm-list_' + tab_num).find('.price_type');
	var length = price_type.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 3) {
			var strDiv = '<div class="content__row country_price">';
			strDiv += '    <input type="hidden" class="price_type_list" value="">';

			strDiv += '    <select id="price_type" class="fSelect price_type" name="price_type[]" style="width:163px;" onChange="priceTypeChange(this);">';
			strDiv += '        <option value="">상품가격 선택</option>    ';
			strDiv += '        <option value="SALES_PRICE_KR">한국몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_EN">영문몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_CN">중국몰 가격</option>';
			strDiv += '    </select>';

			strDiv += '    <input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> ';
			strDiv += '    <font>~</font>';
			strDiv += '    <input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>';

			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">+</button>';
			strDiv += '</div>';
			
			$(obj).unbind();
			$('#frm-list_' + tab_num).find('.price_type_td').append(strDiv);
		} else {
			alert('상품가격 유형은 3개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 상품가격 유형을 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function setPaging(obj) {
	var tab_num = $(obj).attr('tab_num');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + tab_num + '_total').text(total_cnt.val());
	$('.cnt_' + tab_num + '_result').text(result_cnt.val());
}

function selectAllClick(obj) {
	var tab_num = $('#tab_num').val();
	
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table_" + tab_num).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table_" + tab_num).find('.select').prop('checked',false);
	}
}

function excelDownload() {
	var tab_num = $('#tab_num').val();
	if ($('#result_table_'+ tab_num).find('.default_td').length > 0) {
		alert('다운로드 할 상품을 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "상품 재고목록";
		file_name = "상품 재고목록_" + file_date;
	
		insertLog("상품관리 > 상품 재고 관리 > " + sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_num), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	var rows = $(obj).val();
	
	$('#frm-list_' + tab_num).find('.rows').val(rows);
	$('#frm-list_' + tab_num).find('.page').val(1);

	switch(tab_num){
		case '01':
			getProductStockList();
			break;
		case '02':
			getProductStockInfo_02();
			break;
		case '03':
			getProductStockInfo_03();
			break;
	}
}

function orderChange(obj) {
	var tab_num = $('#tab_num').val();
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list_' + tab_num).find('.sort_value').val(order_value[0]);
	$('#frm-list_' + tab_num).find('.sort_type').val(order_value[1]);

	switch(tab_num){
		case '01':
			getProductStockList();
			break;
		case '02':
			getProductStockInfo_02();
			break;
		case '03':
			getProductStockInfo_03();
			break;
	}
}

function selectGroupCheck(obj) {
	var tab_num = $('#tab_num').val();
	
	var product_code = $(obj).attr('product_code');
	
	var length = $('#result_table_' + tab_num).find('.select_' + product_code).length;
	var group_check_arr = [];
	
	for (var i=0; i<length; i++) {
		var select_product = $('#result_table_' + tab_num).find('.select_' + product_code).eq(i);
		if (select_product.prop('checked') == true) {
			group_check_arr.push(select_product.attr('product_code'));
		}
	}
	
	if (length > group_check_arr.length) {
		$('#result_table_' + tab_num).find('.select_group_' + product_code).attr('group_check','group_unchecked');
		
		$('#result_table_' + tab_num).find('.select_group_' + product_code).css('background-color','#ffffff');
		$('#result_table_' + tab_num).find('.select_group_' + product_code).css('color','#000000');
	} else if (length == group_check_arr.length) {
		$('#result_table_' + tab_num).find('.select_group_' + product_code).attr('group_check','group_checked');
		
		$('#result_table_' + tab_num).find('.select_group_' + product_code).css('background-color','#000000');
		$('#result_table_' + tab_num).find('.select_group_' + product_code).css('color','#ffffff');
	}
}

function selectGroupClick(obj) {
	var tab_num = $('#tab_num').val();
	
	var product_code = $(obj).attr('product_code');
	
	var checked_val = $(obj).attr('group_check');
	
	if (checked_val == "group_unchecked"){
		$(obj).attr('group_check','group_checked');
		$('#result_table_' + tab_num).find('.select_' + product_code).prop('checked',true);
		
		$(obj).css('background-color','#000000');
		$(obj).css('color','#ffffff');
	} else if (checked_val == "group_checked") {
		$(obj).attr('group_check','group_unchecked');
		$('#result_table_' + tab_num).find('.select_' + product_code).prop('checked',false);
		
		$(obj).css('background-color','#ffffff');
		$(obj).css('color','#000000');
	}
}

function setStockOptionAll() {
	var tab_num = $('#tab_num').val();
	
	var length = $("#result_table_" + tab_num).find('.select').length;
	var option_idx = [];
	for (var i=0; i<length; i++) {
		var select = $("#result_table_" + tab_num).find('.select').eq(i);
		var option_idx_tmp = select.attr('option_idx');
		if (select.prop('checked') == true) {
			option_idx.push(option_idx_tmp);
		}
	}
	
	if (option_idx.length > 0) {
		modal("option/all/put", 'option_idx=' + option_idx);
	} else {
		alert('재고관리 일괄설정할 상품의 옵션을 선택해주세요.');
		return false;
	}
}
</script>