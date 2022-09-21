<style>
	.tap__button{
		width: 200px;
	}
</style>
<div class="filter-wrap" style="margin-bottom:20px">
	<button class="visit_tab_btn tap__button" style="background-color: #000;color: #fff;font-weight: 500;" tab_num="01" onClick="visitTabBtnClick(this);">회원 로그인 관리</button>
	<button class="visit_tab_btn tap__button" tab_num="02" onClick="visitTabBtnClick(this);">부정의심 로그인 관리</button>
	<button class="visit_tab_btn tap__button" tab_num="03" onClick="visitTabBtnClick(this);">OFF 방문기록</button>
</div>

<input id="tab_num" type="hidden" value="01">

<div id="visit_tab_01" class="visit_tab" style="margin-top:0px;">
	<?php include_once("member-visit-member_login.php"); ?>
</div>

<div id="visit_tab_02" class="visit_tab" style="display:none;margin-top:0px;">
	<?php include_once("member-visit-member_suspicion.php"); ?>
</div>

<div id="visit_tab_03" class="visit_tab" style="display:none;margin-top:0px;">
	<?php include_once("member-visit-member_offline.php"); ?>
</div>

<script>
$(document).ready(function() {
	
});

function visitTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.visit_tab').hide();
	$('#visit_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.visit_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.visit_tab_btn').not($(obj)).css('color','#000000');
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	var date_type = $(obj).attr('date_type');

	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');

	$('.search_date_' + date_type).not($(obj)).css('background-color','#ffffff');
	$('.search_date_' + date_type).not($(obj)).css('color','#000');

	$('#search_date_' + date_type).val(date);

	$('#' + date_type + '_from').val('');
	$('#' + date_type + '_to').val('');
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

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');

	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000');
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

function excelDownload() {
	var tab_num = $('#tab_num').val();
	
	if ($('#result_table_' + tab_num).find('.default_td').length > 0) {
		alert('다운로드 할 멤버를 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_num) {
			case "01" :
				sheet_name = "회원 로그인 정보";
				file_name = "회원 로그인 정보_" + file_date;
				break;
			
			case "02" :
				sheet_name = "부정의심 로그인 정보";
				file_name = "부정의심 로그인 정보_" + file_date;
				break;
			
			case "03" :
				sheet_name = "OFF 방문기록";
				file_name = "OFF 방문기록_" + file_date;
				break;
		}
		insertLog("고객관리 > 회원 방문관리 > "+sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_num), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function orderChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list_' + tab_num).find('.sort_value').val(order_value[0]);
	$('#frm-list_' + tab_num).find('.sort_type').val(order_value[1]);
	switch (tab_num) {
		case "01" :
			getVisitTabInfo_01();
		break;
		
		case "02" :
			getVisitTabInfo_02();
		break;
		
		case "03" :
			getVisitTabInfo_03();
		break;
	}
}

function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var rows = $(obj).val();
	
	$('#frm-list_' + tab_num).find('.rows').val(rows);
	
	switch (tab_num) {
		case "01" :
			getVisitTabInfo_01();
		break;
		
		case "02" :
			getVisitTabInfo_02();
		break;
		
		case "03" :
			getVisitTabInfo_03();
		break;
	}
}

function memberIpBan(obj) {
	var tab_num = $('#tab_num').val();
	var action_type = $(obj).attr('action_type');
	var member_idx = $(obj).attr('member_idx');

	$.ajax({
		type: "post",
		data: {
			'action_type':action_type,
			'member_idx':member_idx
		},
		dataType: "json",
		url: config.api + "member/visit/ip/put",
		error: function() {
			alert("IP 차단설정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('IP 차단설정 처리에 성공했습니다.');
				switch (tab_num) {
					case "01" :
						getVisitTabInfo_01();
						break;
					
					case "02" :
						getVisitTabInfo_02();
						break;
					
					case "03" :
						getVisitTabInfo_03();
						break;
				}
			}
		}
	});
}

function setResultCount(obj) {
	var tab_num = $(obj).attr('tab_num');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + tab_num + '_total').text(total_cnt.val());
	$('.cnt_' + tab_num + '_result').text(result_cnt.val());
}
</script>
