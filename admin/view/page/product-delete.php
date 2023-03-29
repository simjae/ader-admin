<?php include_once("check.php"); ?>
<style>
.double__table__container{display:grid;grid-template-columns:40px 1fr}
table.checkbox__table{width:30px;margin-bottom:14px;}
</style>
<div class="filter-wrap" style="margin-bottom:20px">
	<button class="delete_tab_btn tap__button" tab_status="DEL" style="background-color: #000;color: #fff;font-weight: 500;" onClick="deleteTabBtnClick(this);">삭제 상품 목록</button>
	<button class="delete_tab_btn tap__button" tab_status="IND" onClick="deleteTabBtnClick(this);">개인 결제 목록</button>
</div>

<input id="tab_status" type="hidden" value="DEL">

<div id="delete_tab_DEL" class="row delete_tab" style="margin-top:0px;">
	<?php include_once("product-delete-delete_product.php"); ?>
</div>

<div id="delete_tab_IND" class="row delete_tab" style="display:none;margin-top:0px;">
	<?php include_once("product-delete-personal_order.php"); ?>
</div>


<script>
$(document).ready(function() {
	getProductCategory(0,0);
});
function init_fileter(frm_id, func_name){
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

function deleteTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	$('.delete_tab').hide();
	$('#delete_tab_' + tab_status).show();
	let table_wrap_frm = $('#frm-list_' + tab_status);
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.delete_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.delete_tab_btn').not($(obj)).css('color','#000000');
	
	if ($('#frm-filter_' + tab_status).find('.eCategory1').children().length == 0) {
		getProductCategory(0,0);
	}

	document.querySelectorAll('#frm-list_' + tab_status + ' .marker_td').forEach(
	(el,idx)=>
		{
			table_wrap_frm.find('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
		}
	);
}

function searchTypeBtnClick(obj) {
	var tab_status = $('#tab_status').val();
	
	var search_type = $('#frm-list_' + tab_status).find('.search_type');
	var length = search_type.length;
	
	var action_type = $(obj).attr('action_type');
	
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
			
			$('#frm-filter_' + tab_status).find('.search_type_td').append(strDiv);
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
	var tab_status = $('#tab_status').val();
	
	var this_val = $(obj).val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	var length = frm.find('.search_type').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = frm.find('.search_type').eq(i).val();
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

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
	getProductCategory(depth,no);
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

function setProductCategory(depth,d){
	var tab_status = $('#tab_status').val();
	
	var eCategory = $('#frm-filter_' + tab_status).find('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="">상품분류 0' + depth + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	eCategory.prop("selected", true);
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');

	
	var date_type = $(obj).attr('date_type');

	if (date_type == "product") {
		$('.search_date_product').not($(obj)).css('background-color','#ffffff');
		$('#search_date_product').val(date);
		$('#product_from').val('');
		$('#product_to').val('');


	
	} else if (date_type == "personal") {
		$('.search_date_personal').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_personal').val(date);
		
		$('#personal_from').val('');
		$('#personal_to').val('');
	}
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "product") {
		$('.search_date_product').css('background-color','#ffffff');
		$('.search_date_product').css('color','#000000');
		
		$('#search_date_product').val('');

	} else if (date_type == "personal") {
		$('.search_date_personal').css('background-color','#ffffff');
		$('.search_date_personal').css('color','#000000');
		
		$('#search_date_personal').val('');
	}
	var prod_date_from = $("#" + date_type + "_from").val();
	var prod_date_to = $("#" + date_type + "_to").val();

	var start_date = new Date(prod_date_from);
	var end_date = new Date(prod_date_to);
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
	let tab_status = $(obj).attr('tab_status');
	
	let frm = $('#frm-filter_' + tab_status)
	
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		frm.find('.detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		frm.find('.detail_toggle').text('상세검색 열기 +');
	}
	
	frm.find('.detail_hidden').toggle();
}


function priceTypeBtnClick(obj) {
	var tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	var price_type = frm.find('.price_type');
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
			
			frm.find('.price_type_td').append(strDiv);
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

function priceTypeChange(obj) {
	var tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	var this_val = $(obj).val();
	var length = frm.find('.price_type').length;
	
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
			price_type_arr[i] = frm.find('.price_type').eq(i).val();
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

function selectAllClick(obj) {
	var tab_status = $('#tab_status').val();
	
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table_" + tab_status).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table_" + tab_status).find('.select').prop('checked',false);
	}
}

function orderChange(obj) {
	var tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getDelProductInfoList(tab_status);
}

function rowsChange(obj) {
	var tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	var rows = $(obj).val();
	
	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getDelProductInfoList(tab_status);
}

function excelDownload() {
	var tab_status = $('#tab_status').val();
	
	if ($('#result_table_' + tab_status).find('.default_td').length > 0) {
		alert('다운로드 할 멤버를 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_status) {
			case "01" :
				sheet_name = "삭제상품목록";
				file_name = "삭제상품목록_" + file_date;
				break;
			
			case "02" :
				sheet_name = "개인결제목록";
				file_name = "개인결제목록_" + file_date;
				break;
		}
		
		insertLog("상품관리 > 삭제 상품 목록 > " + sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('result_table_' + tab_status), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function setPaging(obj) {
	var tab_status = $(obj).attr('tab_status');

	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');

	$('.cnt_' + tab_status + '_total').text(total_cnt.val());
	$('.cnt_' + tab_status + '_result').text(result_cnt.val());
}

function productActionClick(obj) {
	confirm(
		"작업을 진행하시겠습니까?",
		function() {
			var tab_status = $('#tab_status').val();
			
			let frm = $('#frm-list_' + tab_status);
			
			action_type = $(obj).attr('action_type');
			
			var action_name = "";
			if (action_type == "product_restore") {
				action_name = "상품복구";
			}  else if(action_type == "product_delete") {
				action_name = "완전삭제";
			} else if(action_type == "order_status_set") {
				action_name = "개인 결제 목록으로 이동";
			}
			
			$('.action_type').val(action_type);
			
			var formData = new FormData();
			formData = frm.serializeObject();

			var select_idx = frm.find('.select');
			var select_cnt = frm.find('.select:checked').length;
			
			console.log(select_idx);
			console.log(select_cnt);
			
			if (select_idx.is(':checked') == false) {
				alert(action_name + ' 처리 할 상품을 선택해주세요.');
			} else {
				$.ajax({
					type: "post",
					data: formData,
					dataType: "json",
					url: config.api + "product/delete/put",
					error: function() {
						alert(action_name + " 처리에 실패했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
							getDelProductInfoList(tab_status);
							
							if (action_type == "order_status_set") {
								getDelProductInfoList('IND');
							}
							
							switch(tab_status){
								case 'DEL':
									insertLog("상품관리 > 삭제 상품 목록 > 삭제상품목록", action_name, select_cnt);
									break;
								
								case 'IND':
									insertLog("상품관리 > 삭제 상품 목록 > 개인결제목록", action_name, select_cnt);
									break;
							}
							
							alert(action_name + ' 처리에 성공했습니다.');
						}
					}
				});
			}
		}
	);
}

function openDeleteProductWindow(obj) {
	var product_type = $(obj).attr('product_type');
	var product_idx = $(obj).attr('product_idx');

	switch(product_type){
		case '일반':
			window.open('http://116.124.128.246:81/product/detail/basic?product_idx=' + product_idx);
			break;
		case '세트':
			window.open('http://116.124.128.246:81/product/detail/set?product_idx=' + product_idx);
			break;
	}
}

function setProductHead(column_arr) {
	let column_div = "";
	let head_div = "";
	
	if (column_arr.length > 0) {
		for (let i=0; i<column_arr.length; i++) {
			switch (column_arr[i]) {
				case "md_category" :
					column_div += '<col width="200px;">';
					head_div += '<TH>상품<br/>카테고리</TH>';
					break;
				
				case "display_status" :
					column_div += '<col width="50px;">';
					head_div += '<TH>진열상태</TH>';
					break;
				
				case "sale_flg" :
					column_div += '<col width="50px;">';
					head_div += '<TH>판매상태</TH>';
					break;
				
				case "sold_out_flg" :
					column_div += '<col width="50px;">';
					head_div += '<TH>품절상태</TH>';
					break;
				
				case "manufacturer" :
					column_div += '<col width="150px;">';
					head_div += '<TH>제조사</TH>';
					break;
				
				case "supplier" :
					column_div += '<col width="150px;">';
					head_div += '<TH>공급사</TH>';
					break;
				
				case "brand" :
					column_div += '<col width="150px;">';
					head_div += '<TH>브랜드</TH>';
					break;
				
				case "origin_country" :
					column_div += '<col width="150px;">';
					head_div += '<TH>원산지</TH>';
					break;
				
				case "price" :
					column_div += '<col width="150px;">';
					column_div += '<col width="150px;">';
					column_div += '<col width="150px;">';
					head_div += '<TH>기획가격<br/>(한국몰)</TH>';
					head_div += '<TH>기획가격<br/>(영문몰)</TH>';
					head_div += '<TH>기획가격<br/>(중문몰)</TH>';
					break;
				
				case "model" :
					column_div += '<col width="100px;">';
					head_div += '<TH>모델</TH>';
					break;
				
				case "model_wear" :
					column_div += '<col width="100px;">';
					head_div += '<TH>모델<br/>사이즈</TH>';
					break;
				
				case "product_keyword" :
					column_div += '<col width="250px;">';
					head_div += '<TH>상픔<br/>키워드</TH>';
					break;
				
				case "product_tag" :
					column_div += '<col width="250px;">';
					head_div += '<TH>상품<br/>태그</TH>';
					break;
				
				case "whish_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>위시리스트<br/>카운트</TH>';
					break;
				
				case "basket_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>쇼핑백<br/>카운트</TH>';
					break;
				
				case "order_pcp_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>결제완료<br/>수량</TH>';
					break;
				
				case "order_dpg_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>배송중<br/>수량</TH>';
					break;
				
				case "order_dcp_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>배송완료<br/>수량</TH>';
					break;
				
				case "memo" :
					column_div += '<col width="500px;">';
					head_div += '<TH>상품메모</TH>';
					break;
			}
		}
	}
	
	let strDiv = "";
	strDiv += '<colgroup>';
	strDiv += '    <col width="50px;">';
	strDiv += '    <col width="80px;">';
	strDiv += '    <col width="30px;">';
	strDiv += '    <col width="100px;">';
	strDiv += '    <col width="30px;">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="auto;">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="150px;">';
	
	strDiv += column_div;
	
	strDiv += '    <col width="200px;">';
	strDiv += '</colgroup>';
	
	strDiv += '<THEAD>';
	strDiv += '    <TR>';
	strDiv += '        <TH class="marker_td">No.</TH>';
	strDiv += '        <TH>링크</TH>';
	strDiv += '        <TH>상품<br>구분</TH>';
	strDiv += '        <TH>스타일<br/>코드</TH>';
	strDiv += '        <TH>컬러<br/>코드</TH>';
	strDiv += '        <TH>상품 코드</TH>';
	strDiv += '        <TH>상품명</TH>';
	strDiv += '        <TH>상품<br/>재고</TH>';
	strDiv += '        <th>판매<br/>수량</th>';
	strDiv += '        <th>잔여<br/>재고</th>';
	strDiv += '        <TH>판매가<br>(한국몰)</TH>';
	strDiv += '        <TH>판매가<br>(영문몰)</TH>';
	strDiv += '        <TH>판매가<br>(중국몰)</TH>';
	
	strDiv += head_div;
	
	strDiv += '        <TH>바로구매 URL</TH>';
	strDiv += '    </TR>';
	strDiv += '</THEAD>';
	
	return strDiv;
}

function setProductBody(column_arr,d, delete_status) {
	let table_wrap_frm = $('#frm-list_' + delete_status);
	let result_checkbox_table = $("#result_checkbox_table_" + delete_status);

	let strDiv = "";
	d.forEach(function(row) {
		if (row.product_idx != null) {
			strCheckboxDiv = "";
			strCheckboxDiv += '<tr style="width:30px;"class="checkbox_tr" >';
			strCheckboxDiv += '    <td class="check__box__area">';
			strCheckboxDiv += '        <div class="cb__color">';
			strCheckboxDiv += '            <label>';
			strCheckboxDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.product_idx + '">';
			strCheckboxDiv += '                <span></span>';
			strCheckboxDiv += '            </label>';
			strCheckboxDiv += '        </div>';
			strCheckboxDiv += '    </td>';
			strCheckboxDiv += '</tr>';
			result_checkbox_table.append(strCheckboxDiv);
			
			strDiv += '<tr>';
			strDiv += '    <td class="marker_td">' + (row.num + 1) + '</td>';
			strDiv += '    <td>';
			strDiv += '        <div style="display:grid;grid-template-columns: 1fr">';
			strDiv += '            <button class="btn" onclick="openDeleteProductWindow(this)" ordersheet_idx="' + row.ordersheet_idx + '" product_type="' + row.product_type + '" product_idx="' + row.product_idx + '" style="cursor:pointer">상세보기</button>';
			strDiv += '            <button class="btn" onclick="location.href=\'http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '\'" style="margin-top:4px;cursor:pointer;">상세페이지</button>';
			strDiv += '        </div>';
			strDiv += '    </td>';
			strDiv += '    <td>' + row.product_type + '</td>';
			strDiv += '    <td>' + row.style_code + '</td>';
			strDiv += '    <td>' + row.color_code + '</td>';
			strDiv += '    <td>' + row.product_code + '</td>';
			
			strDiv += '    <td>';
			
			let set_product_info = row.set_product_info;
			if (row.product_type == "세트" && set_product_info != null) {
				set_product_info.forEach(function(set_row) {
					var background_url = "background-image:url('" + set_row.img_location + "');";
					
					strDiv += '    <div style="padding:5px; margin-bottom:10px;">';
					strDiv += '        <p style="margin-bottom:5px;">' + set_row.product_name + '</p>';
					strDiv += '        <div class="product__img__wrap">';
					strDiv += '            <div class="product__img" style="' + background_url + '">';
					strDiv += '            </div>';
					strDiv += '            <div>';
					strDiv += '                <p>' + set_row.product_name + '</p><br>';
					strDiv += '            	   <p style="color:#EF5012">' + set_row.update_date + '</p>';
					strDiv += '            </div>';
					strDiv += '        </div>';
					strDiv += '    </div>';
				})
			} else if (row.product_type == "일반") {
				var background_url = "background-image:url('" + row.img_location + "');";
				
				strDiv += '    <div style="padding:5px; margin-bottom:10px;">';
				strDiv += '        <p style="margin-bottom:5px;">' + row.product_name + '</p>';
				strDiv += '        <div class="product__img__wrap">';
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </div>';
			}
			
			strDiv += '</td>';
			
			strDiv  += '    <td>' + row.stock_qty + '</td>';
			strDiv  += '    <td>' + row.order_qty + '</td>';
			strDiv  += '    <td>' + row.product_qty + '</td>';
			
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
					strDiv += '        ' + row.sales_price_kr;
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
					strDiv += '        ' + row.sales_price_en;
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
					strDiv += '        ' + row.sales_price_cn;
				}
			}
			strDiv += '    </td>';
			
			for (let i=0; i<column_arr.length; i++) {
				switch (column_arr[i]) {
					case "md_category" :
						strDiv += '<TD>' + row.category_title + '</TD>';
						break;
					
					case "display_status" :
						strDiv += '<TD style="text-align:center;">' + row.display_status + '</TD>';
						break;
					
					case "sale_flg" :
						strDiv += '<TD style="text-align:center;">' + row.sale_flg + '</TD>';
						break;
					
					case "sold_out_flg" :
						strDiv += '<TD style="text-align:center;">' + row.sold_out_flg + '</TD>';
						break;
					
					case "manufacturer" :
						strDiv += '<TD>' + row.manufacturer + '</TD>';
						break;
					
					case "supplier" :
						strDiv += '<TD>' + row.supplier + '</TD>';
						break;
					
					case "brand" :
						strDiv += '<TD>' + row.brand + '</TD>';
						break;
					
					case "origin_country" :
						strDiv += '<TD>' + row.origin_country + '</TD>';
						break;
					
					case "price" :
						strDiv += '<TD style="text-align:right;">' + row.om_price_kr + '</TD>';
						strDiv += '<TD style="text-align:right;">' + row.om_price_en + '</TD>';
						strDiv += '<TD style="text-align:right;">' + row.om_price_cn + '</TD>';
						break;
					
					case "model" :
						strDiv += '<TD>' + row.model + '</TD>';
						break;
					
					case "model_wear" :
						strDiv += '<TD>' + row.model_wear + '</TD>';
						break;
					
					case "product_keyword" :
						strDiv += '<TD>' + row.product_keyword + '</TD>';
						break;
					
					case "product_tag" :
						strDiv += '<TD>' + row.product_tag + '</TD>';
						break;
					
					case "whish_cnt" :
						strDiv += '<TD>' + row.whish_cnt + '</TD>';
						break;
					
					case "basket_cnt" :
						strDiv += '<TD>' + row.basket_cnt + '</TD>';
						break;
					
					case "order_pcp_cnt" :
						strDiv += '<TD>' + row.order_pcp_cnt + '</TD>';
						break;
					
					case "order_dpg_cnt" :
						strDiv += '<TD>' + row.order_dpg_cnt + '</TD>';
						break;
					
					case "order_dcp_cnt" :
						strDiv += '<TD>' + row.order_dcp_cnt + '</TD>';
						break;
					
					case "memo" :
						strDiv += '<TD>' + row.memo + '</TD>';
						break;
				}
			}
			
			strDiv += '    <td>';
			strDiv += '        <input disabled type="text" value="" placeholder="지원하지 않는 상품입니다">';
			strDiv += '        ';
			strDiv += '        <div class="product__btn__wrap">';
			strDiv += '            <button class="product__btn" type="button">SMS 발송</button>';
			strDiv += '            <button class="product__btn" type="button">SMS 공유</button>';
			strDiv += '        	   <button class="product__btn" type="button">주소 복사</button>';
			strDiv += '        </div>';
			strDiv += '        ';
			strDiv += '    </td>';
			strDiv += '</tr>';
		}
	});
	
	return strDiv;
}

function getDelProductInfoList(tab_status){
	if (tab_status == "" || tab_status == null) {
		tab_status = $('#tab_status').val();
	}
	
	let frm = $('#frm-filter_' + tab_status);
	
	let table_wrap_frm = $('#frm-list_' + tab_status);

	let result_checkbox_table = $("#result_checkbox_table_" + tab_status);
	let result_table = $("#result_table_" + tab_status);

	result_checkbox_table.html('');
	result_table.html('');
	
	let select_column = $('#select_column_' + tab_status).val()
	
	let column_arr = [];
	if (select_column.length > 0) {
		column_arr = select_column.split(",");
	}
	
	let div_head = setProductHead(column_arr);
	result_table.append(div_head);
	
	var strCheckboxDiv = '';
	strCheckboxDiv += '<TD class="checkbox_tr"></TD>';

	var strDiv = '';
	strDiv += '<TBODY id="result_body_' + tab_status + '">';
	strDiv += '    <TD class="default_td marker_td" colspan="' + (15 + column_arr.length) + '">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TBODY>';
	
	result_checkbox_table.append(strCheckboxDiv);
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_" + tab_status),
		html : function(d) {
			if (d != null) {
				result_checkbox_table.html('');
				let product_cnt = d[0];
				
				let result_body = $('#result_body_' + tab_status);
				result_body.remove();
				
				result_table.append('<TBODY id="result_body_' + tab_status + '"></TBODY>');
				
				let div_body = setProductBody(column_arr,d,tab_status);
				
				$('#result_body_' + tab_status).append(div_body);
			}
			document.querySelectorAll('#frm-list_' + tab_status + ' .marker_td').forEach(
			(el,idx)=>
				{
					table_wrap_frm.find('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
				}
			);
		},
	},rows, page);
}

function openSelectColumnModal(tab_status) {
	modal('/get','tab_status=' + tab_status);
}
</script>