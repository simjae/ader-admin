<div class="filter-wrap" style="margin-bottom:20px">
	<button class="contents_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="contentsTabBtnClick(this);">이미지 관리</button>
	<button class="contents_tab_btn tap__button" tab_num="02" onClick="contentsTabBtnClick(this);">동영상 관리</button>
</div>

<input id="tab_num" type="hidden" value="01">

<div id="contents_tab_01" class="row contents_tab" style="margin-top:0px;">
	<?php include_once("display-contents-img.php"); ?>
</div>

<div id="contents_tab_02" class="row contents_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-contents-vid.php"); ?>
</div>


<script>
$(document).ready(function() {
	
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

function contentsTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.contents_tab').hide();
	$('#contents_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.contents_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.contents_tab_btn').not($(obj)).css('color','#000000');
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
	
	switch (tab_num) {
		case "01" :
			getContentsImg();
		break;
		
		case "02" :
			getContentsVid();
		break;
	}
}

function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var rows = $(obj).val();
	
	$('#frm-list_' + tab_num).find('.rows').val(rows);
	$('#frm-list_' + tab_num).find('.page').val(1);
	
	switch (tab_num) {
		case "01" :
			getDeleteTabInfo_01();
		break;
		
		case "02" :
			getDeleteTabInfo_02();
		break;
	}
}

function setPaging(obj) {
	var tab_num = $(obj).attr('tab_num');

	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');

	$('.cnt_' + tab_num + '_total').text(total_cnt.val());
	$('.cnt_' + tab_num + '_result').text(result_cnt.val());
}

</script>