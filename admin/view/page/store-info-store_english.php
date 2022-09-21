<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">회사정보</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="informationEn" name="informationEn" title="내용" required style="height:412px;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnEn(this ,'information');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnEn(this ,'information');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">이용약관</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="termsEn" title="내용" required style="height:412px;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnEn(this,'terms');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnEn(this,'terms');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">환불정책</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="refundPolicyEn" title="내용" required style="height:412px;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnEn(this, 'refundPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnEn(this, 'refundPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">개인정보취급방침</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="personalInfoPolicyEn" title="내용" required style="height:412px;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnEn(this,'personalInfoPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnEn(this,'personalInfoPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">온라인스토어이용가이드</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="guideEn" title="내용" required style="height:412px;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnEn(this,'guide');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnEn(this,'guide');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<form id="frm-info-en" action="store/info/get">
	<input type="hidden" name="country" value="en">
</form>

<script>

let informationEn = [];
let termsEn = [];
let refundPolicyEn = [];
let personalInfoPolicyEn = [];
let guideEn = [];

$(document).ready(function(){
	contentTabtoggle();
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: informationEn,
		elPlaceHolder: "informationEn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: termsEn,
		elPlaceHolder: "termsEn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refundPolicyEn,
		elPlaceHolder: "refundPolicyEn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: personalInfoPolicyEn,
		elPlaceHolder: "personalInfoPolicyEn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: guideEn,
		elPlaceHolder: "guideEn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	initTextarea_En();
});
function initTextarea_En(){
	$.ajax({
		url: config.api + "/store/info/get",
		type: "post",
		data: {
			"country":"EN"
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('#informationEn').html(row.information);
						$('#termsEn').html(row.terms);
						$('#refundPolicyEn').html(row.refundPolicy);
						$('#personalInfoPolicyEn').html(row.personalInfoPolicy);
						$('#guideEn').html(row.guide);
					});
				}
			}
		}
	});
}
function clickSaveBtnEn(e,id){
	var textarea = id;
	var action_str = '영문몰 ';

	var country = "EN";
	var content = null;

	switch(textarea) {
		case "information":
			informationEn.getById["informationEn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '회사정보';
			break;
		case "terms":
			termsEn.getById["termsEn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '이용약관';
			break;
		case "refundPolicy":
			refundPolicyEn.getById["refundPolicyEn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '환불정보';
			break;
		case "personalInfoPolicy":
			personalInfoPolicyEn.getById["personalInfoPolicyEn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '개인정보취급방침';
			break;
		case "guide":
			guideEn.getById["guideEn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '온라인스토어 이용 가이드';
			break;
	}
	
	content = $('#' + textarea + "En").val();

	if (content == null) {
		alert('???');
		return false;
	}
	
	confirm("저장하시겠습니까?",function() {
		$.post(config.api + 'store/info/put', { 
			'country' : country,
			'textarea' : textarea,
			'content' : content
		})
		.fail(function () {
				alert('store/info/put api fail');
			}
		)
		.success(function (d) {
			initTextarea_En();
			insertLog('상점관리 > 기본정보관리', action_str+' 수정: ', 1);
			alert("정상적으로 저장되었습니다.");
		});
	});
}
function clickInitBtnEn(e, id){
	confirm("저장 하기 전 내용으로 초기화하시겠습니까?",function() {
		textInitEn(e, id);
	});
}
function textInitEn(e, id){
	var textarea  = id;
	switch(textarea) {
		case "refundPolicy":
			textarea = "REFUND_POLICY";
		break;
		case "personalInfoPolicy":
			textarea = "PERSONAL_INFO_POLICY";
		break;
	}
	
	$.ajax({
		url: config.api + "/store/info/get",
		type: "post",
		data: {
			"country":"En",
			"textarea":textarea
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						switch(textarea) {
							case "information":
								informationEn.getById["informationEn"].exec("SET_IR", [""]);
								informationEn.getById["informationEn"].exec("PASTE_HTML", [row.information]);
								break;
							case "terms":
								termsEn.getById["termsEn"].exec("SET_IR", [""]);
								termsEn.getById["termsEn"].exec("PASTE_HTML", [row.terms]);
								break;
							case "refundPolicy":
								refundPolicyEn.getById["refundPolicyEn"].exec("SET_IR", [""]);
								refundPolicyEn.getById["refundPolicyEn"].exec("UPDATE_CONTEnTS_FIELD", []);
								break;
							case "personalInfoPolicy":
								personalInfoPolicyEn.getById["personalInfoPolicyEn"].exec("SET_IR", [""]);
								personalInfoPolicyEn.getById["personalInfoPolicyEn"].exec("PASTE_HTML", [row.personalInfoPolicy]);
								break;
							case "guide":
								guideEn.getById["guideEn"].exec("SET_IR", [""]);
								guideEn.getById["guideEn"].exec("PASTE_HTML", [row.guide]);
								break;
						}
					});
				}
			}
		}
	});
	
}


function contentTabtoggle(){
	$('.card__header').on('click', function(){
		$(this).next().toggleClass('hidden');
	});
}

</script>
