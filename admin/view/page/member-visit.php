<style>
.tap__button{width: 200px;}
.ip_ban_btn {padding:5px 10px;height:28px;color:#ffffff;background-color:#000000;cursor:pointer;}
.ip_unban_btn {padding:5px 10px;height:28px;border:solid 1px #000000;color:#000000;background-color:#fff;cursor:pointer;}
.receive_true_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;}
.receive_false_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;}
.more_info_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;}
</style>

<?php include_once("check.php"); ?>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="visit_tab_btn tap__button" tab_status="LIN" style="background-color: #000;color: #fff;font-weight: 500;" onClick="visitTabBtnClick(this);">회원 로그인 관리</button>
	<button class="visit_tab_btn tap__button" tab_status="SPC" onClick="visitTabBtnClick(this);">부정의심 로그인 관리</button>
	<button class="visit_tab_btn tap__button" tab_status="OFF" onClick="visitTabBtnClick(this);">OFF 방문기록</button>
</div>

<input id="tab_status" type="hidden" value="LIN">

<div id="visit_tab_LIN" class="visit_tab" style="margin-top:0px;">
	<?php include_once("member-visit-login.php"); ?>
</div>

<div id="visit_tab_SPC" class="visit_tab" style="display:none;margin-top:0px;">
	<?php include_once("member-visit-suspicion.php"); ?>
</div>

<div id="visit_tab_OFF" class="visit_tab" style="display:none;margin-top:0px;">
	<?php include_once("member-visit-offline.php"); ?>
</div>

<script>
$(document).ready(function() {
	
});

function visitTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	
	$('.visit_tab').hide();
	$('#visit_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.visit_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.visit_tab_btn').not($(obj)).css('color','#000000');
}

function getMemberVisitInfoList(tab_status) {
	if (tab_status == "" || tab_status == null) {
		tab_status = $('#tab_status').val();
	}
	
	let frm = $('#frm-filter_' + tab_status);
	
	let result_table = $('#result_table_' + tab_status);
	result_table.html('');
	
	var rows = frm.find('.rows').val();
	let page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging_" + tab_status),
		html : function(d) {
			switch (tab_status) {
				case "LIN" :
					setMemberVisitInfoList_LIN(d);
					break;
				
				case "SPC" :
					setMemberVisitInfoList_SPC(d);
					break;
				
				case "OFF" :
					setMemberVisitInfoList_OFF(d);
					break;
			}
		},
	},rows,1);
}

function searchDateClick(obj) {
	let tab_status = $('#tab_status').val();
	let frm = $('#frm-filter_' + tab_status);
	
	let date = $(obj).attr('date');
	let date_type = $(obj).attr('date_type');
	
	frm.find('.search_date').val(date);

	frm.find('.date__picker').css('color','#000000');
	frm.find('.date__picker').css('background-color','#ffffff');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#ffffff');

	$('#' + date_type + "_from").val('');
	$('#' + date_type + "_to").val('');

}

function dateParamChange(obj) {
	let tab_status = $('#tab_status').val();
	
	let date_type = $(obj).attr('date_type');
	
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
	
	let frm = $('#frm-filter_' + tab_status);
	
	frm.find('.date__picker').css('background-color','#ffffff');
	frm.find('.date__picker').css('color','#000000');
	
	frm.find('.search_date').val('');
}

function selectAllClick(obj) {
	var tab_status = $('#tab_status').val();
	
	if ($(obj).prop('checked') == true) {
		$("#result_table_" + tab_status).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table_" + tab_status).find('.select').prop('checked',false);
	}
}

function orderChange(obj) {
	let tab_status = $('#tab_status').val();
	let frm = $('#frm-filter_' + tab_status);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getMemberVisitInfoList(tab_status);
}

function rowsChange(obj) {
	var tab_status = $('#tab_status').val();
	let frm = $('#frm-filter_' + tab_status);
	
	var rows = $(obj).val();
	frm.find('.rows').val(rows);
	
	getMemberVisitInfoList(tab_status);
}

function banMemberIp(country,action_type,member_idx) {
	var tab_status = $('#tab_status').val();

	$.ajax({
		type: "post",
		url: config.api + "member/visit/ip/put",
		data: {
			'country':country,
			'action_type':action_type,
			'member_idx':member_idx
		},
		dataType: "json",
		error: function() {
			alert("IP 차단 설정/해제 처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('선택한 멤버의 IP가 차단되었습니다.');
				getMemberVisitInfoList(tab_status);
			}
		}
	});
}

function setPaging(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();
	
	$('.cnt_' + tab_status + '_total').text(total_cnt);
	$('.cnt_' + tab_status + '_result').text(result_cnt);
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
			case "LIN" :
				sheet_name = "회원 로그인 정보";
				file_name = "회원 로그인 정보_" + file_date;
				break;
			
			case "SPC" :
				sheet_name = "부정의심 로그인 정보";
				file_name = "부정의심 로그인 정보_" + file_date;
				break;
			
			case "OFF" :
				sheet_name = "OFF 방문기록";
				file_name = "OFF 방문기록_" + file_date;
				break;
		}
		
		insertLog("고객관리 > 회원 방문관리 > " + sheet_name,"엑셀다운로드 : " + file_name + "xlsx", 1);
		
		var wb = XLSX.utils.table_to_book(
			document.getElementById('excel_table_' + tab_status),
			{sheet:sheet_name,raw:true}
		);
		
		XLSX.writeFile(wb, (file_name + '.xlsx'));
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
</script>
