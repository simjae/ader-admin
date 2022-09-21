<style>
.table__wrap{
		overflow-x:hidden !important;
		overflow-y:hidden !important;
}
</style>
<div class="filter-wrap" style="margin-bottom:20px">
	<button class="board_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="boardTabBtnClick(this);">1:1문의</button>
	<button class="board_tab_btn tap__button" tab_num="02" onClick="boardTabBtnClick(this);">후기 게시판</button>
	<button class="board_tab_btn tap__button" tab_num="03" onClick="boardTabBtnClick(this);">공지 사항</button>
	<button class="board_tab_btn tap__button" tab_num="04" onClick="boardTabBtnClick(this);">FAQ</button>
</div>

	<input id="tab_num" type="hidden" value="01">
	
	<div id="board_tab_01" class="board_tab">
		<?php include_once("display-board-inquiry.php"); ?>
	</div>
	<div id="board_tab_02" class="board_tab" style="display:none;">
		<?php include_once("display-board-review.php"); ?>
	</div>
	<div id="board_tab_03" class="board_tab" style="display:none;">
		<?php include_once("display-board-notice.php"); ?> 
	</div>
	<div id="board_tab_04" class="board_tab" style="display:none;">
		<?php include_once("display-board-faq.php"); ?>
	</div>
<script>
$(document).ready(function() {
	getBoardTabInfo_01();
});
$(function(){
	$('.category__tab').click(function() {	
		var tab_num = $(this).attr('tab_num');	
		var subtab_num = $(this).attr('subtab_num');
		$('#board_tab_'+tab_num).find('input#subtab_num').val(subtab_num);
		if (subtab_num != null) {
			$('#board_tab_'+tab_num).find('div.tabNum').hide();
			$('#board_tab_'+tab_num).find('div.tabNum_' + subtab_num).show();
		}
		$('#board_tab_'+tab_num).find('div.category__tab').not($(this)).css('color','#707070');
		$('#board_tab_'+tab_num).find('div.category__tab').not($(this)).css('border-bottom','none');
		//var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
		
		$(this).css('color','#140f82');
		$(this).css('border-bottom','3px solid #140f82');

		var subtab_title = '';
		switch(subtab_num){
			case '01':
				subtab_title = '게시판 관리(후기 -> 전체 게시물)';;
				break;
			case '02':
				subtab_title = '게시판 관리(후기 -> 전체 댓글)';
				break;
			case '03':
				subtab_title = '게시판 관리(후기 -> 신고된 게시물)';
				break;
		}
		$('#board_tab_' + tab_num).find('h3').eq(0).text(subtab_title);
		getBoardTabInfo_02();
	});
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
	var tab_num = $(obj).attr('tab_num');
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();

	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);

	$('#tab_num').val(tab_num);
	$('.board_tab').hide();
	$('#board_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.board_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.board_tab_btn').not($(obj)).css('color','#000000');

	//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);

	switch(tab_num){
		case '01':
			getBoardTabInfo_01();
			break;
		case '02':
			getBoardTabInfo_02();
			break;
		case '03':
			getBoardTabInfo_03();
			break;
	}
}
function searchDateClick(obj) {
	var date = $(obj).attr('date');
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	
	var tab_div = $('#board_tab_'+tab_num);
	var subtab_div = tab_div.find('div.tabNum_'+subtab_num);

	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	subtab_div.find('.date__picker').not($(obj)).css('color','#000');
	subtab_div.find('.date__picker').not($(obj)).css('background-color','#ffffff');
	
	subtab_div.find('.search_date').css('color','#000');

	subtab_div.find('input[name="search_date"]').val(date);
	subtab_div.find('input[name="create_from"]').val('');
	subtab_div.find('input[name="create_to"]').val('');
}
function dateParamChange(obj) {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	
	var tab_div = $('#board_tab_'+tab_num);
	var subtab_div = tab_div.find('div.tabNum_'+subtab_num);
	
	subtab_div.find('.date__picker').css('background-color','#ffffff');
	subtab_div.find('.date__picker').css('color','#000');
	subtab_div.find('input[name="search_date"]').val('');

	var search_start_date = subtab_div.find("input[name='create_from']").val();
	var search_end_date = subtab_div.find("input[name='create_to']").val();

	var start_date = new Date(search_start_date);
	var end_date = new Date(search_end_date);
	var now_date = new Date();

	if(start_date > now_date) {
		alert('진행 시작일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
	if(start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function selectAllClick(obj) {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();

	if ($(obj).prop('checked') == true) {
		$("#result_table_"+tab_num+"_"+subtab_num).find('.select').prop('checked',true);
	} else {
		$("#result_table_"+tab_num+"_"+subtab_num).find('.select').prop('checked',false);
	}
}
function setPaging(obj) {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('#board_tab_'+tab_num).find('.cnt_total').text(total_cnt.val());
	$('#board_tab_'+tab_num).find('.cnt_result').text(result_cnt.val());

	//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
}
function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	var rows = $(obj).val();
	$('#frm-list_'+tab_num+"_"+subtab_num).find('.rows').val(rows);
	//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
	
	switch(tab_num){
		case '01':
			getBoardTabInfo_01();
			break;
		case '02':
			getBoardTabInfo_02();
			break;
		case '03':
			getBoardTabInfo_03();
			break;
		case '04':
			getBoardTabInfo_04();
			break;
	}
}
function CommentChange(obj){
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	var select_value = $(obj).val();

	$('#frm-list_'+tab_num+"_"+subtab_num).find('.eSearchComment').val(select_value);
	//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
	switch(tab_num){
		case '01':
			getBoardTabInfo_01();
			break;
		case '02':
			getBoardTabInfo_02();
			break;
		case '03':
			getBoardTabInfo_03();
			break;
		case '04':
			getBoardTabInfo_04();
			break;
	}
}
function orderChange(obj) {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();

	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list_'+tab_num+"_"+subtab_num).find('.sort_value').val(order_value[0]);
	$('#frm-list_'+tab_num+"_"+subtab_num).find('.sort_type').val(order_value[1]);
	
	//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
	switch(tab_num){
		case '01':
			getBoardTabInfo_01();
			break;
		case '02':
			getBoardTabInfo_02();
			break;
		case '03':
			getBoardTabInfo_03();
			break;
		case '04':
			getBoardTabInfo_04();
			break;
	}
}
function boardActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var tab_num 	= $('#tab_num').val();
		var subtab_num  = $('#board_tab_'+tab_num).find('#subtab_num').val();
		var action_type = $(obj).attr('action_type');
		var btn_class 	= $(obj).attr('class');
		var action_name = "";
		var select_idx	= "";
		var tab_title = $('#board_tab_' + tab_num).find('h3').eq(0).text();
		var formData = new FormData();

		$("#frm-"+tab_num+"-"+subtab_num).find('input[name="action_type"]').val(action_type);
		formData = $("#frm-"+tab_num+"-"+subtab_num).serializeObject();

		console.log(tab_title);
		if(btn_class == 'mileage_flg_btn'){
			select_idx 			= $(obj).parents('tr').find('.select');
			formData.board_idx 		= [select_idx.val()];
			formData.action_type 	= 'mlieage_set';
		}
		else{
			select_idx = $("#frm-"+tab_num+"-"+subtab_num).find('.select:checked');
		}

		var mileage_cnt 	= 0;
		var fix_false_cnt 	= 0;
		var del_cnt 		= 0;
		
		select_idx.each(function(){
			var select_tr = $(this).parents('tr');
			if(select_tr.find('.mileage_flg_btn').text() == '적립금 적용'){
				mileage_cnt++;
			}
			if(select_tr.find('.del_flg_td').text() == '삭제됨'){
				del_cnt++;
			}
		})

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
		$("#frm-"+tab_num+"-"+subtab_num).find('.action_type').val(action_type);

		if (select_idx.length == 0) {
			alert(action_name + ' 처리 할 PAGE를 선택해주세요.');
		} else {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "display/board/list/put",
				error: function() {
					alert(action_name + " 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert(action_name + ' 처리에 성공했습니다.');
						insertLog("전시관리 > 게시판 관리 ", tab_title + " " + action_name, select_idx.length);
						//$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
						$("#frm-"+tab_num+"-"+subtab_num).find('input[name="selectAll"]').prop('checked', false);
						switch(tab_num){
							case '01':
								getBoardTabInfo_01();
								break;
							case '02':
								getBoardTabInfo_02();
								break;
							case '03':
								getBoardTabInfo_03();
								break;
							case '04':
								getBoardTabInfo_04();
								break;
						}
					}
				}
			});
		}
	});
}
function openExposureDateModal(obj){
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();

	var length = $("#result_table_"+tab_num+"_"+subtab_num).find('.select').length;
	
	if(length > 0){
		var board_idx_arr = [];
		for (var i=0; i<length; i++) {
			var select = $("#result_table_"+tab_num+"_"+subtab_num).find('.select').eq(i);
			if (select.prop('checked') == true) {
				board_idx_arr.push(select.val());
			}
		}
		if(board_idx_arr.length > 0){
			modal('exposure/put', 'board_idx_arr=' + board_idx_arr);
		}
		else{
			alert('변경할 게시물을 선택하세요');
			return false;
		}
	}
}
function openAnswerModal(idx){
	if(idx != null){
		modal('answer/put', 'idx='+idx);
	}
}
function openBoardPreviewModal(idx, type){
	if(type != null){
		switch(type){
			case 'inquiry':
				modal('inquiry/preview', 'idx='+idx);
				break;
			case 'review':
				modal('review/preview', 'idx='+idx);
				break;
			case 'notice':
				modal('notice/preview', 'idx='+idx);
				break;
			case 'faq':
				modal('faq/preview', 'idx='+idx);
				break;
		}
	}
}
</script>
