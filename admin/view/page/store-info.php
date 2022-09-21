<style>
.filter-wrap{
	display: flex;
	gap: 10px;	
	margin-bottom: 20px;
}
.tap__button{
	padding: 8px 40px;
	height: 36px;
}
.content__card__tap{
	margin: 10px 0;
}
.tab__title{
	background-color: #fafafa;
	border: solid 1px #bfbfbf;
	padding: 5px;
	margin: 3px 0;
}
.card__header{
	cursor: pointer;
}
.save__btn{
	background-color:#140f82; 
	color:#fff;
}
</style>
<div class="country__tap">
	<div class="country__btn checked" data-filter="한국몰">
		<img src="/images/korea-logo.svg" alt="">
		<span>국문몰</span>
	</div>
	<div class="country__btn" data-filter="영문몰">
		<img src="/images/engilsh-logo.svg" alt="">
		<span>영문몰</span>
	</div>
	<div class="country__btn" data-filter="중국몰">
		<img src="/images/china-logo.svg" alt="" >
		<span>중문몰</span>
	</div>
</div>

<form id="frm-store" action="store/info/get">
</form>

<input type="hidden" name="tab_num" value="01">
<input type="hidden" class="rows" name="rows" value="10">
<input type="hidden" class="page" name="page" value="1">
<div class="content__card">
	<div class="card__header">
		<h3>기본 정보 관리</h3>
		<div class="drive--x"></div>
	</div>
	<div class="korea-tap filter-tap">
		<?php include_once("store-info-store_korea.php"); ?>
	</div>

	<div class="hidden engilsh-tap filter-tap">
		<?php include_once("store-info-store_english.php"); ?>
	</div>
	<div class="hidden china-tap filter-tap">
		<?php include_once("store-info-store_china.php"); ?>
	</div>
</div>




<script>


var infoHtml = "Company ADER | Business Name FIVE SPACE CO.,LTD | Business License 760-87-01757 |MAIL-ORDER LICENSE NO. 2021-서울성동-01588 | CEO HANN| office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, KoreaC/S office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea TEL. 02-792-2232 | Office hour Mon - Fri AM 10:00 - PM 5:00 ©2021 ADER All Rights Reserved";

$(document).ready(function() {
	countryTapClick();
});
function countryTapClick(){
	$('.country__btn').on('click', function () {
		let $target  = $('.country__btn');
		let checkTab = $(this).data('filter');

		$target.not($(this)).removeClass('checked');
		$(this).addClass('checked');
		$('.filter-tap').addClass('hidden');

		switch (checkTab){
			case "한국몰" :
				$('.korea-tap').toggleClass('hidden');
				$('#korea-btn').addClass('checked');
				

				$('#informationKr_iframe').attr('src',$('#informationKr_iframe').attr('src')); 
				$('#termsKr_iframe').attr('src',$('#termsKr_iframe').attr('src')); 
				$('#refundPolicyKr_iframe').attr('src',$('#refundPolicyKr_iframe').attr('src')); 
				$('#personalInfoPolicyKr_iframe').attr('src',$('#personalInfoPolicyKr_iframe').attr('src')); 
				$('#guideKr_iframe').attr('src',$('#guideKr_iframe').attr('src')); 
				break;

			case "중국몰" :
				$('.china-tap').toggleClass('hidden');
				$('#china-btn').addClass('checked');
				
				$('#informationCn_iframe').attr('src',$('#informationCn_iframe').attr('src')); 
				$('#termsCn_iframe').attr('src',$('#termsCn_iframe').attr('src')); 
				$('#refundPolicyCn_iframe').attr('src',$('#refundPolicyCn_iframe').attr('src')); 
				$('#personalInfoPolicyCn_iframe').attr('src',$('#personalInfoPolicyCn_iframe').attr('src')); 
				$('#guideCn_iframe').attr('src',$('#guideCn_iframe').attr('src')); 
				break;

			case "영문몰" :
				$('.engilsh-tap').toggleClass('hidden');
				$('#engilsh-btn').addClass('checked');
				
				$('#informationEn_iframe').attr('src',$('#informationEn_iframe').attr('src')); 
				$('#termsEn_iframe').attr('src',$('#termsEn_iframe').attr('src')); 
				$('#refundPolicyEn_iframe').attr('src',$('#refundPolicyEn_iframe').attr('src')); 
				$('#personalInfoPolicyEn_iframe').attr('src',$('#personalInfoPolicyEn_iframe').attr('src')); 
				$('#guideEn_iframe').attr('src',$('#guideEn_iframe').attr('src')); 
				break;
		}
	});
}
</script>