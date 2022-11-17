<div class="filter-wrap" style="margin-bottom:20px">
	<button class="order_tab_btn tap__button" tab_status="MNG_ALL" style="background-color: #000;color: #fff;font-weight: 500;" onClick="orderTabBtnClick(this);">전체</button>
	<button class="order_tab_btn tap__button" tab_status="OC" onClick="orderTabBtnClick(this);">주문취소</button>
	<button class="order_tab_btn tap__button" tab_status="OE" onClick="orderTabBtnClick(this);">주문교환</button>
	<button class="order_tab_btn tap__button" tab_status="OR" onClick="orderTabBtnClick(this);">주문환불</button>
</div>

<input id="tab_status" type="hidden" value="MNG_ALL">

<div id="order_tab_MNG_ALL" class="order_tab">
	<?php include_once("order-management-all.php"); ?>
</div>

<div id="order_tab_OC" class="order_tab" style="display:none;">
	<?php include_once("order-management-oc.php"); ?>
</div>

<div id="order_tab_OE" class="order_tab" style="display:none;">
	<?php include_once("order-management-oe.php"); ?>
</div>

<div id="order_tab_OR" class="order_tab" style="display:none;">
	<?php include_once("order-management-or.php"); ?>
</div>

<script>
$(document).ready(function() {
	$('.detail_hidden').hide();
});

function orderTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	$('.order_tab').hide();
	$('#order_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.order_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.order_tab_btn').not($(obj)).css('color','#000000');
}

function detailToggleClick(obj) {
	let tab_status = $('#tab_status').val();
	
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기 +');
	}
	$('#frm-list_' + tab_status).find('.detail_hidden').toggle();
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');
	
	var date_type = $(obj).attr('date_type');

	if (date_type == "deposit") {
		$('.search_date_deposit').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_deposit').val(date);
		
		$('#deposit_from').val('');
		$('#deposit_to').val('');
	} else if (date_type == "cancel") {
		$('.search_date_cancel').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_cancel').val(date);
		
		$('#cancel_from').val('');
		$('#cancel_to').val('');
	} else if (date_type == "exchange") {
		$('.search_date_exchange').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_exchange').val(date);
		
		$('#exchange_from').val('');
		$('#exchange_to').val('');
	} else if (date_type == "return") {
		$('.search_date_return').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_return').val(date);
		
		$('#return_from').val('');
		$('#return_to').val('');
	} else if (date_type == "refund") {
		$('.search_date_refund').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_refund').val(date);
		
		$('#refund_from').val('');
		$('#refund_to').val('');
	} else if (date_type == "card") {
		$('.search_date_card').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_card').val(date);
		
		$('#card_from').val('');
		$('#card_to').val('');
	} else if (date_type == "admin") {
		$('.search_date_admin').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_admin').val(date);
		
		$('#admin_from').val('');
		$('#admin_to').val('');
	}
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');

	if (date_type == "deposit") {
		$('.search_date_deposit').css('background-color','#ffffff');
		$('.search_date_deposit').css('color','#000');
		$('#search_date_deposit').val('');
	} else if (date_type == "cancel") {
		$('.search_date_cancel').css('background-color','#ffffff');
		$('.search_date_cancel').css('color','#000');
		$('#search_date_cancel').val('');
	} else if (date_type == "exchange") {
		$('.search_date_exchange').css('background-color','#ffffff');
		$('.search_date_exchange').css('color','#000');
		$('#search_date_exchange').val('');
	} else if (date_type == "return") {
		$('.search_date_return').css('background-color','#ffffff');
		$('.search_date_return').css('color','#000');
		$('#search_date_return').val('');
	} else if (date_type == "refund") {
		$('.search_date_refund').css('background-color','#ffffff');
		$('.search_date_refund').css('color','#000');
		$('#search_date_refund').val('');
	} else if (date_type == "card") {
		$('.search_date_card').css('background-color','#ffffff');
		$('.search_date_card').css('color','#000');
		$('#search_date_card').val('');
	} else if (date_type == "admin") {
		$('.search_date_admin').css('background-color','#ffffff');
		$('.search_date_admin').css('color','#000');
		$('#search_date_admin').val('');
	}
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
</script>