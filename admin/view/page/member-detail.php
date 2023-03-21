<style>
#container{overflow:hidden;}
.member__detail .table__wrap .overflow-x-auto{white-space: nowrap;}
.left-side{display:none;}
.member__detail__btn {vertical-align: middle;padding: 12px 0 12px 30px;text-align: left;font-size: 12px;text-align: left;font-weight: normal;color: #666;border:1px solid #dcdcdc;cursor:pointer;}
.mem_detail_tab{overflow:auto;height:calc(95vh - 110px)}
.member__detail__btn:hover{background-color:#dcdcdc;}
.detail__wrap{display:flex;gap:10px;margin-top:20px;overflow:hidden;}
.member__detail__btn__wrap{margin-top:30px;}
.left__area{width:12vw;}
.right__area{width:80vw;}
</style>

<?php
function getUrlParamter($url, $sch_tag) {
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];

$country = getUrlParamter($page_url, 'country');
$member_idx = getUrlParamter($page_url, 'member_idx');
$detail_status = getUrlParamter($page_url, 'detail_status');
?>

<input type="hidden" id="param_country" value="<?=$country?>">
<input type="hidden" id="param_member_idx" value="<?=$member_idx?>">
<input type="hidden" id="param_detail_status" value="<?=$detail_status?>">

<div class="content__card member__detail">
	<div class="card__hearder">
		<h3>멤버 상세 정보</h3>
	</div>
	<div class="detail__wrap">
		<div class="left__area">
			<div class="member__detail__btn__wrap">
				<div class="member__detail__btn" tab_status="MIF" style="background-color:#dcdcdc" onclick="memberDetailTabBtnClick(this)">회원상세정보</div>
				<div class="member__detail__btn" tab_status="ORD" onclick="memberDetailTabBtnClick(this)">주문내역</div>
				<div class="member__detail__btn" tab_status="INQ" onclick="memberDetailTabBtnClick(this)">문의정보</div>
				<div class="member__detail__btn" tab_status="MLG" onclick="memberDetailTabBtnClick(this)">적립금</div>
				<div class="member__detail__btn" tab_status="VOU" onclick="memberDetailTabBtnClick(this)">바우처</div>
				<div class="member__detail__btn" tab_status="WSH" onclick="memberDetailTabBtnClick(this)">위시리스트정보</div>
				<div class="member__detail__btn" tab_status="BSK" onclick="memberDetailTabBtnClick(this)">쇼핑백정보</div>
				<div class="member__detail__btn" tab_status="MSL" onclick="memberDetailTabBtnClick(this)">메세지발송내역</div>
			</div>
		</div>
		
		<input type="hidden" id="tab_status" value="MIF">
		
		<div class="right__area">
			<div id="mem_detail_tab_MIF" class="mem_detail_tab" >
				<?php include_once("member-detail-MIF.php"); ?>
			</div>

			<div id="mem_detail_tab_ORD" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-ORD.php"); ?>
			</div>

			<div id="mem_detail_tab_INQ" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-INQ.php"); ?> 
			</div>

			<div id="mem_detail_tab_MLG" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-MLG.php"); ?>
			</div>

			<div id="mem_detail_tab_VOU" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-VOU.php"); ?>
			</div>

			<div id="mem_detail_tab_WSH" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-WSH.php"); ?>
			</div>

			<div id="mem_detail_tab_BSK" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-BSK.php"); ?>
			</div>

			<div id="mem_detail_tab_MSL" class="mem_detail_tab" style="display:none;">
				<?php include_once("member-detail-MSL.php"); ?>
			</div>
		</div>
	</div>
	
	
	<div class="card_footer"></div>
</div>

<script>
let country = $('#param_country').val();
let member_idx = $('#param_member_idx').val();
let detail_status = $('#param_detail_status').val();

$(document).ready(function(){
	setDetailStatus();
});

function setDetailStatus() {
	if (detail_status != null) {
		if (detail_status == "ORD") {
			clickOrderPrice();
		} else if (detail_status == "MLG") {
			clickMileagePoint();
		}
	}
}

function memberDetailTabBtnClick(obj) {
	let tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	
	$('.mem_detail_tab').hide();
	$('#mem_detail_tab_' + tab_status).show();
	
	$(obj).css('background-color','#dcdcdc');
	
	$('.member__detail__btn').not($(obj)).css('background-color','#ffffff');
}

</script>