<style>
	.cb__color > label {
		padding: 2px 0;
	}
</style>
<div class="country__tap">
	<div class="tab__btn checked" data-filter="01">
		<img src="/images/korea-logo.svg" alt="">
		<span>국문몰</span>
	</div>
	<div class="tab__btn" data-filter="02">
		<img src="/images/engilsh-logo.svg" alt="">
		<span>영문몰</span>
	</div>
	<div class="tab__btn" data-filter="03">
		<img src="/images/china-logo.svg" alt="" >
		<span>중문몰</span>
	</div>
</div>

<input id="tab_num" type="hidden" value="01">

<div id="include_tab_01" class="include_tab">
<?php include_once("order-deliver-order_korea.php"); ?>
</div>
<div id="include_tab_02" class="include_tab" style="display: none;">
<?php include_once("order-deliver-order_english.php"); ?>
</div>
<div id="include_tab_03" class="include_tab" style="display: none;">
<?php include_once("order-deliver-order_china.php"); ?>
</div>

<script>
$(function(){
	tabClick();
});
</script>
