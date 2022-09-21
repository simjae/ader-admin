
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">회사정보</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="informationKr" name="informationKr" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnKr(this ,'information');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnKr(this ,'information');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">이용약관</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="termsKr" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnKr(this,'terms');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnKr(this,'terms');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">환불정책</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="refundPolicyKr" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnKr(this, 'refundPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnKr(this, 'refundPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">개인정보취급방침</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="personalInfoPolicyKr" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnKr(this,'personalInfoPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnKr(this,'personalInfoPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">온라인스토어이용가이드</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="guideKr" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnKr(this,'guide');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnKr(this,'guide');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>

<form id="frm-info-kr" action="store/info/get">
	<input type="hidden" name="country" value="kr">
</form>

<script>
let informationKr = [];
let termsKr = [];
let refundPolicyKr = [];
let personalInfoPolicyKr = [];
let guideKr = [];

$(document).ready(function(){
	contentTabtoggle();
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: informationKr,
		elPlaceHolder: "informationKr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: termsKr,
		elPlaceHolder: "termsKr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refundPolicyKr,
		elPlaceHolder: "refundPolicyKr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: personalInfoPolicyKr,
		elPlaceHolder: "personalInfoPolicyKr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: guideKr,
		elPlaceHolder: "guideKr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	initTextarea_Kr();
});

function initTextarea_Kr(){
	$.ajax({
		url: config.api + "/store/info/get",
		type: "post",
		data: {
			"country":"KR"
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('#informationKr').html(row.information);
						$('#termsKr').html(row.terms);
						$('#refundPolicyKr').html(row.refundPolicy);
						$('#personalInfoPolicyKr').html(row.personalInfoPolicy);
						$('#guideKr').html(row.guide);
					});
				}
			}
		}
	});
}
function clickSaveBtnKr(e,id){
	var textarea = id;
	var action_str = '한국몰 ';

	var country = "KR";
	var content = null;

	switch(textarea) {
		case "information":
			informationKr.getById["informationKr"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '회사정보';
			break;
		case "terms":
			termsKr.getById["termsKr"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '이용약관';
			break;
		case "refundPolicy":
			refundPolicyKr.getById["refundPolicyKr"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '환불정보';
			break;
		case "personalInfoPolicy":
			personalInfoPolicyKr.getById["personalInfoPolicyKr"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '개인정보취급방침';
			break;
		case "guide":
			guideKr.getById["guideKr"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '온라인스토어 이용 가이드';
			break;
	}
	
	content = $('#' + textarea + "Kr").val();

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
			initTextarea_Kr();
			insertLog('상점관리 > 기본정보관리', action_str+' 수정: ', 1);
			alert("정상적으로 저장되었습니다.");
		});
	});
}
function clickInitBtnKr(e, id){
	confirm("저장 하기 전 내용으로 초기화하시겠습니까?",function() {
		textInitKr(e, id);
	});
}
function textInitKr(e, id){
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
			"country":"KR",
			"textarea":textarea
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						switch(textarea) {
							case "information":
								informationKr.getById["informationKr"].exec("SET_IR", [""]);
								informationKr.getById["informationKr"].exec("PASTE_HTML", [row.information]);
								break;
							case "terms":
								termsKr.getById["termsKr"].exec("SET_IR", [""]);
								termsKr.getById["termsKr"].exec("PASTE_HTML", [row.terms]);
								break;
							case "refundPolicy":
								refundPolicyKr.getById["refundPolicyKr"].exec("SET_IR", [""]);
								refundPolicyKr.getById["refundPolicyKr"].exec("UPDATE_CONTKrTS_FIELD", []);
								break;
							case "personalInfoPolicy":
								personalInfoPolicyKr.getById["personalInfoPolicyKr"].exec("SET_IR", [""]);
								personalInfoPolicyKr.getById["personalInfoPolicyKr"].exec("PASTE_HTML", [row.personalInfoPolicy]);
								break;
							case "guide":
								guideKr.getById["guideKr"].exec("SET_IR", [""]);
								guideKr.getById["guideKr"].exec("PASTE_HTML", [row.guide]);
								break;
						}
					});
				}
			}
		}
	});
	
}
function pasteHTML(filepath) {
	// var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
	oEditorsKorea1.getById["editor-korea1"].exec("PASTE_HTML", [sHTML]);
}

function contentTabtoggle(){
	$('.card__header').on('click', function(){
		$(this).next().toggleClass('hidden');
	});
}

</script>
