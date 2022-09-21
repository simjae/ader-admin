<div class="filter-wrap" style="margin-bottom:20px">
	<button class="include_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="includeTabBtnClick(this);">전체</button>
	<button class="include_tab_btn tap__button" tab_num="02" onClick="includeTabBtnClick(this);">입금전</button>
	<button class="include_tab_btn tap__button" tab_num="03" onClick="includeTabBtnClick(this);">배송준비중</button>
	<button class="include_tab_btn tap__button" tab_num="04" onClick="includeTabBtnClick(this);">배송중</button>
	<button class="include_tab_btn tap__button" tab_num="05" onClick="includeTabBtnClick(this);">배송완료</button>
</div>

<input id="tab_num" type="hidden" value="01">

<div id="include_tab_01" class="include_tab">
	<?php include_once("order-list-order_all.php"); ?>
</div>
<div id="include_tab_02" class="include_tab" style="display:none;">
</div>
<div id="include_tab_03" class="include_tab" style="display:none;">
</div>
<div id="include_tab_04" class="include_tab" style="display:none;">
</div>

<script>
$(document).ready(function() {
	$('.category__tab').click(function() {		
		var tabNum = $(this).attr('tabNum');
		if (tabNum != null) {
			$('.tabNum').hide();
			$('.tabNum_' + tabNum).show();
		}
		
		$('.category__tab').not($(this)).css('color','#707070');
		$('.category__tab').not($(this)).css('border-bottom','none');
		
		$(this).css('color','#140f82');
		$(this).css('border-bottom','3px solid #140f82');
	});

	$('.detail_hidden').hide();
});

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

function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기 +');
	}
	$('.detail_hidden').toggle();
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
