<style>
.filter-wrap{display: flex;gap: 10px;	margin-bottom: 20px;}
.tap__button{padding: 8px 40px;height: 36px;}
.content__card__tap{margin: 10px 0;}
.tab__title{background-color: #fafafa;border: solid 1px #bfbfbf;padding: 5px;margin: 3px 0;}
.card__header{cursor: pointer;}
.save__btn{background-color:#140f82; color:#fff;}
</style>

<?php include_once("check.php"); ?>

<div class="country__tap">
	<div class="country__btn checked" country="KR" onClick="countryTabClick(this)">
		<img src="/images/korea-logo.svg" alt="">
		<span>한국몰</span>
	</div>
	
	<div class="country__btn" country="EN" onClick="countryTabClick(this)">
		<img src="/images/engilsh-logo.svg" alt="">
		<span>영문몰</span>
	</div>
	
	<div class="country__btn" country="CN" onClick="countryTabClick(this)">
		<img src="/images/china-logo.svg" alt="" >
		<span>중문몰</span>
	</div>
</div>

<input type="hidden" name="country" value="KR">

<div class="content__card">
	<div class="card__header">
		<div id="store_info_KR" class="store_info">
			<?php include_once("store-policy-kr.php"); ?>
		</div>

		<div id="store_info_EN" class="store_info" style="display:none;">
			<?php include_once("store-policy-en.php"); ?>
		</div>

		<div id="store_info_CN" class="store_info" style="display:none;">
			<?php include_once("store-policy-cn.php"); ?>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('.card__header').on('click', function(){
		$(this).next().toggle();
	});
});

function countryTabClick(obj){
	let country = $(obj).attr('country');
	
	$('#country').val(country);
	
	$('.country__btn').not($(obj)).removeClass('checked');
	$(obj).addClass('checked');
	
	$('.store_info').hide();
	$('#store_info_' + country).show();
	
	$('#policy_GUD_' + country + '_iframe').attr('src',$('#policy_GUD_' + country + '_iframe').attr('src')); 
	$('#policy_TRM_' + country + '_iframe').attr('src',$('#policy_TRM_' + country + '_iframe').attr('src')); 
	$('#policy_PNL_' + country + '_iframe').attr('src',$('#policy_PNL_' + country + '_iframe').attr('src')); 
	$('#policy_ABT_' + country + '_iframe').attr('src',$('#policy_ABT_' + country + '_iframe').attr('src')); 
	$('#policy_INF_' + country + '_iframe').attr('src',$('#policy_INF_' + country + '_iframe').attr('src')); 
}

function getPolicyInfoList(country){
	$.ajax({
		type: "post",
		url: config.api + "store/policy/get",
		data: {
			'country' : country
		},
		dataType: "json",
		error: function() {
			alert('기본정보 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code = 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						$('#policy_' + row.policy_type + '_' + country).html(row.policy_txt);
					});
				}
			}
		}
	});
}

function resetPolicyInfo(country,policy_type) {
	confirm(
		"저장 하기 전 내용으로 초기화하시겠습니까?",
		function() {
			switch(country) {
				case "KR" :
					getPolicyInfo_KR(country,policy_type);
					break;
				
				case "EN" :
					getPolicyInfo_KR(country,policy_type);
					break
				
				case "CN" :
					getPolicyInfo_KR(country,policy_type);
					break;
			}
			
		}
	);
}

function getPolicyName(policy_type) {
	let policy_name = "";
	
	switch(policy_type) {
		case "GUD":
			policy_name = '온라인 스토어 이용 가이드';
			break;
		
		case "TRM":
			policy_name = '이용약관';
			break;
		
		case "PNL":
			policy_name = '개인정보 처리방침';
			break;
		
		case "ABT":
			policy_name = 'About ADERERROR';
			break;
		
		case "INF":
			policy_name = '회사정보';
			break;
	}
	
	return policy_name;
}

</script>