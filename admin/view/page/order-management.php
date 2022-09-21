<div class="filter-wrap" style="margin-bottom:20px">
	<button class="include_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="includeTabBtnClick(this);">입금 전 취소</button>
	<button class="include_tab_btn tap__button" tab_num="02" onClick="includeTabBtnClick(this);">취소</button>
	<button class="include_tab_btn tap__button" tab_num="03" onClick="includeTabBtnClick(this);">교환</button>
	<button class="include_tab_btn tap__button" tab_num="04" onClick="includeTabBtnClick(this);">반품</button>
	<button class="include_tab_btn tap__button" tab_num="05" onClick="includeTabBtnClick(this);">환불</button>
	<button class="include_tab_btn tap__button" tab_num="06" onClick="includeTabBtnClick(this);">카드 취소 조회 </button>
	<button class="include_tab_btn tap__button" tab_num="07" onClick="includeTabBtnClick(this);">관리자 환불 관리 </button>
</div>





<input id="tab_num" type="hidden" value="01">

<div id="include_tab_01" class="include_tab">
<?php include_once("order-management-order_beforeDeposit.php"); ?>
</div>
<div id="include_tab_02" class="include_tab" style="display:none;">
<?php include_once("order-management-order_cancel.php"); ?>
</div>
<div id="include_tab_03" class="include_tab" style="display:none;">
<?php include_once("order-management-order_exchange.php"); ?>
</div>
<div id="include_tab_04" class="include_tab" style="display:none;">
	<?php include_once("order-management-order_return.php"); ?>
</div>
<div id="include_tab_05" class="include_tab" style="display:none;">
	<?php include_once("order-management-order_refund.php"); ?>
</div>
<div id="include_tab_06" class="include_tab" style="display:none;">
	<?php include_once("order-management-order_cardCancel.php"); ?>
</div>
<div id="include_tab_07" class="include_tab" style="display:none;">
	<?php include_once("order-management-order_admin.php"); ?>
</div>


<script>
$(function() {
	$('.listType').click(function() {
		var listType = $(this).attr('type');
		
		$('.listType').not($(this)).css('color','#000000');
		$('.listType').not($(this)).css('font-weight','500');
		$('.listType').not($(this)).css('border-bottom','3px solid #000000');
		
		$(this).css('color','#3971FF');
		$(this).css('font-weight','800');
		$(this).css('border-bottom','3px solid #3971FF');
		
		$('.listTarget').hide();
		$('.' + listType).show();
	});
});
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
function includeTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.include_tab').hide();
	$('#include_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.include_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.include_tab_btn').not($(obj)).css('color','#000000');
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