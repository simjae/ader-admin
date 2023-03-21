<style>
.table__wrap{overflow-x:hidden !important;overflow-y:hidden !important;}
</style>


<div class="filter-wrap" style="margin-bottom:20px">
	<button class="board_tab_btn tap__button" tab_status="ONE" style="width:150px;background-color: #000;color: #fff;font-weight: 500;" onClick="boardTabBtnClick(this);">1:1문의</button>
	<!--<button class="board_tab_btn tap__button" tab_num="RVW" onClick="boardTabBtnClick(this);">후기 게시판</button>-->
	<button class="board_tab_btn tap__button" tab_status="NTC" style="width:150px;" onClick="boardTabBtnClick(this);">공지 사항</button>
	<button class="board_tab_btn tap__button" tab_status="FAQ" style="width:150px;" onClick="boardTabBtnClick(this);">FAQ</button>
</div>

<input id="tab_status" type="hidden" value="ONE">

<div id="board_tab_ONE" class="board_tab">
	<?php include_once("display-board-ONE.php"); ?>
</div>
<div id="board_tab_RVW" class="board_tab" style="display:none;">
	<?php include_once("display-board-RVW.php"); ?>
</div>
<div id="board_tab_NTC" class="board_tab" style="display:none;">
	<?php include_once("display-board-NTC.php"); ?> 
</div>
<div id="board_tab_FAQ" class="board_tab" style="display:none;">
	<?php include_once("display-board-FAQ.php"); ?>
</div>
<script>
$(document).ready(function() {
	getBoardInfoList_ONE();
	getBoardInfoList_NTC();
});

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

function boardTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);

	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);

	$('.board_tab').hide();
	$('#board_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.board_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.board_tab_btn').not($(obj)).css('color','#000000');
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	var date_type = $(obj).attr('date_type');
	
	let frm = $('#frm-filter-' + date_type);
	
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
	
	let frm = $('#frm-filter-' + date_type);
	
	var date_from = $('#date_from_' + date_type).val();
	var date_to = $('#date_to_' + date_type).val();

	frm.find('.date__picker').css('background-color','#ffffff');
	frm.find('.date__picker').css('color','#000');
	
	$('#date_param_' + date_type).val('');

	if(date_from != null && date_to != null){
		if (date_to > date_from) {
			$(obj).val('');
			
			alert('검색일에 올바른 날짜를 입력해주세요.');
			return false;
		}
	}
}

function selectAllClick(obj){
	var tab_status = $('#tab_status').val();
	let result_table = $("#result_table_" + tab_status);
	
	if ($(obj).prop('checked') == true) {
		result_table.find('.select').prop('checked',true);
	} else {
		result_table.find('.select').prop('checked',false);
	}
}

function setPaging(obj) {
	let tab_status = $(obj).attr('tab_status');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + tab_status + '_total').text(total_cnt.val());
	$('.cnt_' + tab_status + '_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var tab_status = $('#tab_status').val();

	var rows = $(obj).val();
	$(obj).parents('.board_tab').find('.rows').val(rows);
	$(obj).parents('.board_tab').find('.page').val(1);
	
	window['getBoardInfoList_' + tab_status]();
}

function orderChange(obj) {
	var tab_status = $('#tab_status').val();
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$(obj).parents('.board_tab').find('.sort_value').val(order_value[0]);
	$(obj).parents('.board_tab').find('.sort_type').val(order_value[1]);
	
	window['getBoardInfoList_' + tab_status]();
}

function boardActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var tab_status = $('#tab_status').val();
		var action_type = $(obj).attr('action_type');
		var action_name = "";

		$("#frm-list-" + tab_status).find('input[name="action_type"]').val(action_type);
		var country = $("#frm-filter-" + tab_status).find('select[name=country]').val();
		console.log(country);
		var formData = new FormData();
		formData = $("#frm-list-" + tab_status).serializeObject();
		formData.action_type = action_type;
		formData.country = country;

		if(formData['board_idx[]'] != null || formData['board_idx[]'].length > 0){
			switch(action_type){
				case 'delete':
					action_name = "삭제";
					break;
				case 'fix_set':
					action_name = "글고정 지정";
					break;
				case 'fix_non':
					action_name = "글고정 해제";
					break;
				case 'hidden':
					action_name = "숨김";
					break;
				case 'non_hidden':
					action_name = "숨김 해제";
					break;
				case 'mlieage_set':
					if(mileage_cnt > 0 && del_cnt > 0){
						alert('적립금 적용/삭제된 후기는 적립금 적용을 할수 없습니다.');
						return false;
					}
					if(mileage_cnt > 0){
						alert('이미 적립금 적용이 완료된 후기입니다.');
						return false;
					}
					if(del_cnt > 0){
						alert('삭제된 후기에는 적용을 할 수 없습니다.');
						return false;
					}
					action_name = "적립금 일괄 적용";
					break;
			}

			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "page/board/list/put",
				error: function() {
					alert(action_name + " 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert(action_name + ' 처리에 성공했습니다.');
						$("#frm-list-" + tab_status).find('.page').val(1);
						window['getBoardTabInfo' + tab_status]();
					}
				}
			});
		}
		else{
			alert('하나이상의 게시물을 선택해주세요');
			return false;
		}
	});
}

function openExposureDateModal(obj){
	var tab_status = $('#tab_status').val();

	var formData = new FormData();
	formData = $('#frm-list-' + tab_status).serializeObject();

	if(formData['board_idx[]'] != null && formData['board_idx[]'].length > 0){
		modal('exposure/put', 'board_idx_arr=' + formData['board_idx[]']);
	}
	else{
		alert('하나이상의 게시물을 선택해주세요');
		return false;
	}
}
function displayNumCheck(action_type,recent_num,draw_idx,country) {
	var tab_status = $('#tab_status').val();
	let result_table = $('#result_table_' + tab_status);
	
	var display_num_max = result_table.find('.tr_notice').length;

	if (action_type == "up") {
		if (recent_num == 1) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('up',recent_num,draw_idx,country);
		}
	} else if (action_type == "down") {
		if (recent_num == display_num_max) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('down',recent_num,draw_idx,country);
		}
	}
}

function updateDisplayNum(action, num, idx,country){
	var tab_status = $('#tab_status').val();
	$.ajax({
		url: config.api + "page/board/notice/put",
		type: "post",
		data: {
			'recent_idx': idx,
			'recent_num': num,
			'country': country,
            'display_num_flg' : true,
			'action_type': action
		},
		dataType: "json",
		error: function() {
			alert('공지사항 순서번경 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			window['getBoardTabInfo' + tab_status]();
		}
	})
}

function openPutModal(idx, type, country){
	if(type != null){
		modal(type + '/put', `param=${idx},${country}`);
	}
}

function openBoardPreviewModal(idx, type, country){
	if(type != null){
		modal(type + '/preview', `param=${idx},${country}`);
	}
}

function getBoardInfoList_ONE() {
	var frm = $('#frm-filter-ONE');
	let result_table = $("#result_table_ONE");
	
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_ONE"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					result_table.html('');
				}
				
				d.forEach(function(row) {
					var writer_name = '-';
					var writer_level = '-';
					
					let detail_link = "";
					if (row.admin_name == null) {
						writer_name = row.creater_name;
						writer_level = row.creater_level;
						
						if (row.country != null && row.member_idx != null) {
							detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
						}
					} else {
						writer_name = row.admin_name;
						writer_level = row.admin_level;
					}
					
					if (row.answer_state == null) {
						row.answer_state = '-';
					}
					
					var strDiv = `
						<TR>
							<TD>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="board_idx[]" value="${row.idx}" >
										<span></span>
									</label>
								</div>
							</TD>
							<TD>${row.num}</TD>
							<TD>${row.category}</TD>
							<TD>
								<div class="row">
									<font style="cursor:pointer;" onClick="openBoardPreviewModal(${row.idx}, 'inquiry', '${row.country}');">${row.title}</font>
								</div>
							</TD>
							<TD>
					`;
					
					if(row.answer_state == '읽지 않음'){
						strDiv += `<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;" onclick="openPutModal(${row.idx}, 'inquiry', '${row.country}')">답변하기</button>`;
					} else if (row.answer_state == '답변완료') {
						strDiv += `<button style="width:50px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;font-size:0.5rem;" onclick="openBoardPreviewModal(${row.idx}, 'inquiry', '${row.country}');">답변완료</button>`;
					}
					
					strDiv += `
						</TD>
							<TD ${detail_link}>
								${writer_name}<br>
								${writer_level}
							</TD>
							<TD>${row.ip}</TD>
						</TR>
					`;
					
					result_table.append(strDiv);
				});
			}
		},
	},rows,1);
}

function getBoardInfoList_NTC() {
	let frm = $('#frm-filter-NTC');
	let result_table = $("#result_table_NTC");
	
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_NTC"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					result_table.html('');
				}
				
				d.forEach(function(row) {
					var exposure_date = '';
					var exposure_str = '';

					var today = new Date();
					var start_date = new Date(row.exposure_start_date);
					var end_date = new Date(row.exposure_end_date);	

					if (row.exposure_end_date == '9999-12-31 23:59') {
						exposure_date = "상시노출";
					} else {
						exposure_date = "노출시작 : " + row.exposure_start_date + "<br>노출종료 : " + row.exposure_end_date;
					}

					if (row.exposure_flg == false) {
						exposure_str = '노출안함';
					} else {
						if (today <= start_date){
							exposure_str = "노출 예약";
						}
						else if((today >= start_date) && (today <= end_date)){
							exposure_str = "노출 중";
						}
						else if (today > end_date){
							exposure_str = "노출 종료";
						}
					}
					
					var strDiv = `
						<TR class="tr_notice">
							<TD>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="board_idx[]" value="${row.idx}" >
										<span></span>
									</label>
								</div>
							</TD>
							<td>
								<div class="btn" onclick="displayNumCheck('up',${row.display_num},${row.idx},'${row.country}')">
									<i class="xi-angle-up"></i>
									<span class="tooltip top">위로</span>
								</div>
								<div class="btn" onclick="displayNumCheck('down',${row.display_num},${row.idx},'${row.country}')">
									<i class="xi-angle-down"></i>
									<span class="tooltip top">아래로</span>
								</div>
							</td>
							<TD>${row.display_num}</TD>
							<TD>${row.category}</TD>
							<TD>
								<div class="row">
									<font style="cursor:pointer;" onClick="openBoardPreviewModal(${row.idx}, 'notice', 'KR');">${row.title}</font>
								</div>
							</TD>
							<TD style="text-decoration:underline;line-height: 1.4;">
								${row.admin_id}<br>
								(${row.admin_name})
							</TD>
							<TD><div class="btn" onclick="openPutModal(${row.idx}, 'notice', '${row.country}','KR');">편집하기</div></TD>
							<TD>${row.fix_flg}</TD>
							<TD>${exposure_str}</TD>
							<TD>${exposure_date}</TD>
						</TR>
					`;
					
					result_table.append(strDiv);
				});
			}
		},
	},rows,1);
}
</script>
