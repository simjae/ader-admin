<style>
	.tap__button{
		width: 160px;
	}
	.content__card .content__wrap{
		padding: 5px;
	}
</style>
	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="member_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="memberTabBtnClick(this);">회원조회</button>
		<button class="member_tab_btn tap__button" tab_num="02" onClick="memberTabBtnClick(this);">휴면회원</button>
		<button class="member_tab_btn tap__button" tab_num="03" onClick="memberTabBtnClick(this);">탈퇴회원</button>
		<button class="member_tab_btn tap__button" tab_num="04" onClick="memberTabBtnClick(this);">주문회원</button>
		<button class="member_tab_btn tap__button" tab_num="05" onClick="memberTabBtnClick(this);">구매액순 조회</button>
		<button class="member_tab_btn tap__button" tab_num="06" onClick="memberTabBtnClick(this);">회원등급 관리</button>
	</div>



	<input id="tab_num" type="hidden" value="01">
	
	<div id="member_tab_01" class="row member_tab">
		<?php include_once("member-info-member_list.php"); ?>
	</div>
	<div id="member_tab_02" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_sleep.php"); ?>
	</div>
	<div id="member_tab_03" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_drop.php"); ?> 
	</div>
	<div id="member_tab_04" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_order.php"); ?>
	</div>
	<div id="member_tab_05" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_price.php"); ?>
	</div>
	<div id="member_tab_06" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_level.php"); ?>
		
	</div>

<script>


function memberTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.member_tab').hide();
	$('#member_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.member_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.member_tab_btn').not($(obj)).css('color','#000000');
}

function searchDateClick(obj) {
	var tab_num = $('#tab_num').val();
	var date = $(obj).attr('date');
	var date_type = $(obj).attr('date_type');

	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.search_date_' + date_type).not($(obj)).css('color','#000');
	$('.search_date_' + date_type).not($(obj)).css('background-color','#ffffff');
	$('#search_date_' + date_type).val(date);
	
	$('#frm-list_'+tab_num).find('.date_param').css('color','#000');

	$('#' + date_type + "_from").val('');
	$('#' + date_type + "_to").val('');

}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');

	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000000');
	
	$('#search_date_' + date_type).val('');

	var date_from = $("#" + date_type + "_from").val();
	var date_to = $("#" + date_type + "_to").val();

	var start_date = new Date(date_from);
	var end_date = new Date(date_to);
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

function resultTableReset(colspan) {
	var tab_num = $('#tab_num').val();
	$("#result_table_" + tab_num).html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="' + colspan + '">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_" + tab_num).append(strDiv);
	
	$('.paging_' + tab_num).html('');
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

function orderChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list_' + tab_num).find('.sort_value').val(order_value[0]);
	$('#frm-list_' + tab_num).find('.sort_type').val(order_value[1]);

	//$('#frm-list_' + tab_num).find('.page').val(1);
	
	switch (tab_num) {
		case "01" :
			getMemberTabInfo_01();
		break;
		
		case "02" :
			getMemberTabInfo_02();
		break;
		
		case "03" :
			getMemberTabInfo_03();
		break;
		
		case "04" :
			getMemberTabInfo_04();
		break;
		
		case "05" :
			getMemberTabInfo_05();
		break;
		
		case "06" :
			getMemberTabInfo_06();
		break;
	}
}

function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var rows = $(obj).val();
	
	$('#frm-list_' + tab_num).find('.rows').val(rows);
	//$('#frm-list_' + tab_num).find('.page').val(1);
	
	switch (tab_num) {
		case "01" :
			getMemberTabInfo_01();
		break;
		
		case "02" :
			getMemberTabInfo_02();
		break;
		
		case "03" :
			getMemberTabInfo_03();
		break;
		
		case "04" :
			getMemberTabInfo_04();
		break;
		
		case "05" :
			getMemberTabInfo_05();
		break;
		
		case "06" :
			getMemberTabInfo_06();
		break;
	}
}
function init_filter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value=""]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
function excelDownload() {
	var tab_num = $('#tab_num').val();
	
	if ($('#result_table_' + tab_num).find('.default_td').length > 0) {
		alert('다운로드 할 멤버를 검색해주세요.');
	} else {
		var menu_str = '';
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_num) {
			case "01" :
				sheet_name = "회원조회";
				file_name = "회원조회_" + file_date;
				break;
			
			case "02" :
				sheet_name = "휴면회원";
				file_name = "휴면회원_" + file_date;
				break;
			
			case "03" :
				sheet_name = "탈퇴회원";
				file_name = "탈퇴회원_" + file_date;
				break;
			
			case "04" :
				sheet_name = "주문회원";
				file_name = "주문회원_" + file_date;
				break;
			
			case "05" :
				sheet_name = "구매액순 조회";
				file_name = "구매액순 조회_" + file_date;
				break;
			
			case "06" :
				sheet_name = "회원등급 관리_";
				file_name = "회원등급 관리_" + file_date;
				break;
		}
		insertLog("고객관리 > 회원 조회 > "+sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_num), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}


function setResultCount(obj) {
	var tab_num = $(obj).attr('tab_num');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + tab_num + '_total').text(total_cnt.val());
	$('.cnt_' + tab_num + '_result').text(result_cnt.val());

	//$('#frm-list_' + tab_num).find('.page').val(1);
}
</script>
