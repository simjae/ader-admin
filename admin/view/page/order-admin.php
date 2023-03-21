<?php include_once("check.php"); ?>

<style>
.double__table__container{display:grid;grid-template-columns:40px 1fr}
table.checkbox__table{width:30px;margin-bottom:14px;}
.memo_tab_btn{width:140px;padding:10px 0 10px 0}
</style>
<div class="filter-wrap" style="margin-bottom:20px">
	<button class="memo_tab_btn tap__button" tab_status="MB" style="background-color: #000;color: #fff;font-weight: 500;" onClick="memoTabBtnClick(this);">회원</button>
	<button class="memo_tab_btn tap__button" tab_status="PR" onClick="memoTabBtnClick(this);">상품</button>
	<button class="memo_tab_btn tap__button" tab_status="OR" onClick="memoTabBtnClick(this);">주문</button>
</div>

<input id="tab_status" type="hidden" value="MB">

<div id="memo_tab_MB" class="memo_tab">
	<?php include_once("order-admin-MB.php"); ?>
</div>

<div id="memo_tab_PR" class="memo_tab" style="display:none;">
	<?php include_once("order-admin-PR.php"); ?>
</div>

<div id="memo_tab_OR" class="memo_tab" style="display:none;">
	<?php include_once("order-admin-OR.php"); ?>
</div>

<script>
function memoTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	$('.memo_tab').hide();
	$('#memo_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.memo_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.memo_tab_btn').not($(obj)).css('color','#000000');
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	var date_type = $(obj).attr('date_type');
	
	let frm = $('#frm-filter_' + date_type);

	frm.find('.date__picker').css('background-color','#ffffff');
	frm.find('.date__picker').css('color','#000');

	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');

	$('#date_param_' + date_type).val(date);
	$('#date_from_' + date_type).val('');
	$('#date_to_' + date_type).val('');
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	
	let frm = $('#frm-filter_' + date_type);

	frm.find('.date__picker').css('background-color','#ffffff');
	frm.find('.date__picker').css('color','#000');

	$('#date_param_' + date_type).val('');
}

function orderChange(obj) {
	let tab_status = $(obj).attr('tab_status');
	let frm = $('#frm-filter_' + tab_status);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getMemoInfoList(tab_status);
}

function rowsChange(obj) {
	let tab_status = $(obj).attr('tab_status');
	let frm = $('#frm-filter_' + tab_status);
	
	var rows = $(obj).val();
	
	frm.find('.rows').val(rows);
	frm.find('.page').val(1);

	getMemoInfoList(tab_status);
}

function setPaging(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + tab_status + '_total').text(total_cnt.val());
	$('.cnt_' + tab_status + '_result').text(result_cnt.val());
}

function excelDownload(tab_status) {
	if ($('.result_table_' + tab_status).find('.default_td').length > 0) {
		alert('관리자 메모정보가 없습니다.');
	} else {
		let memo_type = "";
		switch (tab_status) {
			case "MB" :
				memo_type = "회원";
				break;
			
			case "PR" :
				memo_type = "상품";
				break;
			
			case "OR" :
				memo_type = "주문";
				break;
		}
		
		var sheet_name = '관리자메모_' + memo_type;
		var file_name = "_관리자_메모_리스트_" + memo_type;
		
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		file_name = file_date + file_name;
		insertLog("주문 > 관리자 메모 조회 > 관리자 메모 리스트 엑셀다운로드 : " + file_name + ".xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function getMemoInfoList(tab_status) {
	if (tab_status == "" || tab_status == null) {
		tab_status = $('#tab_status').val();
	}
	
	let frm = $('#frm-filter_' + tab_status);
	let result_body = frm.find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging_" + tab_status),
		html : function(d) {
			let strDiv = "";			
			switch (tab_status) {
				case "MB" :
					setMemberMemoList(d);
					break;
				
				case "PR" :
					setProductMemoList(d);
					break;
				
				case "OR" :
					setOrderMemoList(d);
					break;
			}
			
			result_body.append(strDiv);
		},
	},rows,1);
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
</script>
