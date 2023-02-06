
<style>
.tap__button{width: 160px;}
.content__card .content__wrap{padding: 5px;}
.receive_true_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;}
.receive_false_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;}
.more_info_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;}
</style>
	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="member_tab_btn tap__button" tab_status="INF" style="background-color: #000;color: #fff;font-weight: 500;" onClick="memberTabBtnClick(this);">회원조회</button>
		<button class="member_tab_btn tap__button" tab_status="SLP" onClick="memberTabBtnClick(this);">휴면회원</button>
		<button class="member_tab_btn tap__button" tab_status="DRP" onClick="memberTabBtnClick(this);">탈퇴회원</button>
		<button class="member_tab_btn tap__button" tab_status="ORD" onClick="memberTabBtnClick(this);">주문회원</button>
		<button class="member_tab_btn tap__button" tab_status="PRC" onClick="memberTabBtnClick(this);">구매액순 조회</button>
		<button class="member_tab_btn tap__button" tab_status="MLV" onClick="memberTabBtnClick(this);">회원등급 관리</button>
	</div>
	
	<input id="tab_status" type="hidden" value="INF">
	
	<div id="member_tab_INF" class="row member_tab">
		<?php include_once("member-info-member_list.php"); ?>
	</div>
	
	<div id="member_tab_SLP" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_sleep.php"); ?>
	</div>
	
	<div id="member_tab_DRP" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_drop.php"); ?> 
	</div>
	
	<div id="member_tab_ORD" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_order.php"); ?>
	</div>
	
	<div id="member_tab_PRC" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_price.php"); ?>
	</div>
	
	<div id="member_tab_MLV" class="row member_tab" style="display:none;">
		<?php include_once("member-info-member_level.php"); ?>
	</div>

<script>
function memberTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	
	$('#tab_status').val(tab_status);
	
	$('.member_tab').hide();
	$('#member_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.member_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.member_tab_btn').not($(obj)).css('color','#000000');
}

function searchDateClick(obj) {
	let tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	
	let date = $(obj).attr('date');
	let date_type = $(obj).attr('date_type');
		
	let param_date_type = "";
	switch (date_type) {
		case "sleep" :
			param_date_type = "SLEEP_DATE";
			break;
		
		case "drop" :
			param_date_type = "DROP_DATE";
			break;
		
		case "order" :
			param_date_type = "ORDER_DATE";
			break;
	}
	
	frm.find('.search_date').val(date);
	frm.find('.search_date_type').val(param_date_type);

	frm.find('.date__picker').css('color','#000000');
	frm.find('.date__picker').css('background-color','#ffffff');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#ffffff');

	$('#' + date_type + "_from").val('');
	$('#' + date_type + "_to").val('');

}

function dateParamChange(obj) {
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
	
	let tab_status = $('#tab_status').val();
	let frm = $('#frm-filter_' + tab_status);
	
	let param_date_type = "";
	switch (date_type) {
		case "sleep" :
			param_date_type = "SLEEP_DATE";
			break;
		
		case "drop" :
			param_date_type = "DROP_DATE";
			break;
		
		case "order" :
			param_date_type = "ORDER_DATE";
			break;
	}
	
	frm.find('.search_date_type').val(param_date_type);
	
	frm.find('.date__picker').css('background-color','#ffffff');
	frm.find('.date__picker').css('color','#000000');
	
	frm.find('.search_date').val('');
}

function selectAllClick(obj) {
	let tab_status = $('#tab_status').val();
	
	if ($(obj).prop('checked') == true) {
		$("#result_table_" + tab_status).find('.select').prop('checked',true);
	} else {
		$("#result_table_" + tab_status).find('.select').prop('checked',false);
	}
}

function getCheckedMemberIdx(tab_status) {
	let result_table = $('#result_table_INF');
	let checkbox = result_table.find('.select')
	let cnt = checkbox.length;
	
	let member_idx = [];
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			member_idx.push(checkbox.eq(i).val());
		}
	}
	
	return member_idx;
}

function setSuspicionMember(suspicion_flg) {
	let tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	let country = frm.find('.country').val();
	
	let member_idx = getCheckedMemberIdx(tab_status);
	
	if (member_idx.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'country' : country,
				'suspicion_flg' : suspicion_flg,
				'member_idx' : member_idx
			},
			dataType: "json",
			url: config.api + "member/info/put",
			error: function() {
				alert('의심회원 설정/해제 처리에 실패했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					getMemberInfoList(tab_status);
				} else {
					alert(d.msg);
				}
			}
		});
	} else {
		alert('의심회원으로 설정/해제 하려는 멤버를 선택해주세요.');
		return false;
	}
}

function setDropMember() {
	let tab_status = $('#tab_status').val();
	
	let frm = $('#frm-filter_' + tab_status);
	let country = frm.find('.country').val();
	
	let member_idx = getCheckedMemberIdx(tab_status);
	
	if (member_idx.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'country' : country,
				'drop_flg' : true,
				'member_idx' : member_idx
			},
			dataType: "json",
			url: config.api + "member/info/put",
			error: function() {
				alert('의심회원 설정/해제 처리에 실패했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					getMemberInfoList(tab_status);
				} else {
					alert(d.msg);
				}
			}
		});
	} else {
		alert('의심회원으로 설정/해제 하려는 멤버를 선택해주세요.');
		return false;
	}
}

function orderChange(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter_' + tab_status).find('.sort_value').val(order_value[0]);
	$('#frm-filter_' + tab_status).find('.sort_type').val(order_value[1]);
	
	getMemberInfoList(tab_status);
}

function rowsChange(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var rows = $(obj).val();
	
	$('#frm-filter_' + tab_status).find('.rows').val(rows);
	
	getMemberInfoList(tab_status);
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
	var tab_status = $('#tab_status').val();
	
	if ($('#result_table_' + tab_status).find('.default_td').length > 0) {
		alert('다운로드 할 멤버를 검색해주세요.');
	} else {
		var menu_str = '';
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_status) {
			case "INF" :
				sheet_name = "회원조회";
				file_name = "회원조회_" + file_date;
				break;
			
			case "SLP" :
				sheet_name = "휴면회원";
				file_name = "휴면회원_" + file_date;
				break;
			
			case "DRP" :
				sheet_name = "탈퇴회원";
				file_name = "탈퇴회원_" + file_date;
				break;
			
			case "ORD" :
				sheet_name = "주문회원";
				file_name = "주문회원_" + file_date;
				break;
			
			case "PRC" :
				sheet_name = "구매액순 조회";
				file_name = "구매액순 조회_" + file_date;
				break;
			
			case "MLV" :
				sheet_name = "회원등급 관리_";
				file_name = "회원등급 관리_" + file_date;
				break;
		}
		insertLog("고객관리 > 회원 조회 > "+sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_status), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function setPaging(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();
	
	$('.cnt_' + tab_status + '_total').text(total_cnt);
	$('.cnt_' + tab_status + '_result').text(result_cnt);
}

function getMemberInfoList(tab_status) {
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
				case "INF" :
					setMemberInfoList_INF(d);
					break;
				
				case "SLP" :
					setMemberInfoList_SLP(d);
					break;
				
				case "DRP" :
					setMemberInfoList_DRP(d);
					break;
				
				case "ORD" :
					setMemberInfoList_ORD(d);
					break;
				
				case "PRC" :
					setMemberInfoList_PRC(d);
					break;
			}
		},
	},rows,1);
}
</script>