<div class="filter-wrap" style="margin-bottom:20px">
	<button class="order_tab_btn tap__button" tab_status="ALL" style="background-color: #000;color: #fff;font-weight: 500;" onClick="orderTabBtnClick(this);">전체</button>
	<button class="order_tab_btn tap__button" tab_status="PCP" onClick="orderTabBtnClick(this);">결제완료</button>
	<button class="order_tab_btn tap__button" tab_status="PPR" onClick="orderTabBtnClick(this);">상품준비</button>
	<button class="order_tab_btn tap__button" tab_status="POP" onClick="orderTabBtnClick(this);">프리오더 준비</button>
	<button class="order_tab_btn tap__button" tab_status="POD" onClick="orderTabBtnClick(this);">프리오더 상품 생산</button>
	<button class="order_tab_btn tap__button" tab_status="DPR" onClick="orderTabBtnClick(this);">배송준비</button>
	<button class="order_tab_btn tap__button" tab_status="DPG" onClick="orderTabBtnClick(this);">배송중</button>
	<button class="order_tab_btn tap__button" tab_status="DCP" onClick="orderTabBtnClick(this);">배송완료</button>
</div>

<input id="tab_status" type="hidden" value="ALL">

<div id="order_tab_ALL" class="order_tab">
	<?php include_once("order-list-all.php"); ?>
</div>

<div id="order_tab_PCP" class="order_tab" style="display:none;">
	<?php include_once("order-list-pcp.php"); ?>
</div>

<div id="order_tab_PPR" class="order_tab" style="display:none;">
	<?php include_once("order-list-ppr.php"); ?>
</div>

<div id="order_tab_POP" class="order_tab" style="display:none;">
	<?php include_once("order-list-pop.php"); ?>
</div>

<div id="order_tab_POD" class="order_tab" style="display:none;">
	<?php include_once("order-list-pod.php"); ?>
</div>

<div id="order_tab_DPR" class="order_tab" style="display:none;">
	<?php include_once("order-list-dpr.php"); ?>
</div>

<div id="order_tab_DPG" class="order_tab" style="display:none;">
	<?php include_once("order-list-dpg.php"); ?>
</div>

<div id="order_tab_DCP" class="order_tab" style="display:none;">
	<?php include_once("order-list-dcp.php"); ?>
</div>

<script>
$(document).ready(function() {
	$('.detail_hidden').hide();
});

function orderTabBtnClick(obj) {
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

	if (date_type == "order") {
		$('.search_date_order').not($(obj)).css('background-color','#ffffff');
		// $('.search_date_order').not($(obj)).css('color','#bfbfbf');
		
		$('#search_date_order').val(date);
		
		$('#order_from').val('');
		$('#order_to').val('');
	}
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	
	if (date_type == "order") {
		$('.search_date_order').css('background-color','#ffffff');
		$('.search_date_order').css('color','#000');
		
		$('#search_date_order').val('');
	} 
}

function searchTypeClick(obj){
	let name = $(obj).attr('name');
	let val = $(obj).val();
	if(val == 'searchCondition'){
		$('.search__status').hide()
		$('.search__condition').show();
	} else if( val =='searchStatus'){
		$('.search__condition').hide();
		$('.search__status').show();
	}
}
</script>
