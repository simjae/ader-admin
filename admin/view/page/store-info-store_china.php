
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">회사정보</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="informationCn" name="informationCn" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnCn(this ,'information');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnCn(this ,'information');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">이용약관</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="termsCn" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnCn(this,'terms');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnCn(this,'terms');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">환불정책</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="refundPolicyCn" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnCn(this, 'refundPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnCn(this, 'refundPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">개인정보취급방침</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="personalInfoPolicyCn" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnCn(this,'personalInfoPolicy');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnCn(this,'personalInfoPolicy');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>
<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">온라인스토어이용가이드</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="guideCn" title="내용" required style="height:412px; display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn"onclick="clickSaveBtnCn(this,'guide');">저장</div>
			<div class="defult__color__btn"onclick="clickInitBtnCn(this,'guide');"><i class="xi-refresh"></i>이전값 초기화</div>
		</div>
	</div>
</div>




<form id="frm-info-cn" action="store/info/get">
	<input type="hidden" name="country" value="cn">
</form>

<script>
let informationCn = [];
let termsCn = [];
let refundPolicyCn = [];
let personalInfoPolicyCn = [];
let guideCn = [];


$(document).ready(function(){
	contentTabtoggle();
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: informationCn,
		elPlaceHolder: "informationCn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: termsCn,
		elPlaceHolder: "termsCn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refundPolicyCn,
		elPlaceHolder: "refundPolicyCn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: personalInfoPolicyCn,
		elPlaceHolder: "personalInfoPolicyCn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: guideCn,
		elPlaceHolder: "guideCn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	initTextarea_Cn();
});
function initTextarea_Cn(){
	$.ajax({
		url: config.api + "/store/info/get",
		type: "post",
		data: {
			"country":"Cn"
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('#informationCn').html(row.information);
						$('#termsCn').html(row.terms);
						$('#refundPolicyCn').html(row.refundPolicy);
						$('#personalInfoPolicyCn').html(row.personalInfoPolicy);
						$('#guideCn').html(row.guide);
					});
				}
			}
		}
	});
}


function clickSaveBtnCn(e,id){
	var textarea = id;
	var action_str = '중문몰 ';

	var country = "CN";
	var content = null;

	switch(textarea) {
		case "information":
			informationCn.getById["informationCn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '회사정보';
			break;
		case "terms":
			termsCn.getById["termsCn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '이용약관';
			break;
		case "refundPolicy":
			refundPolicyCn.getById["refundPolicyCn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '환불정보';
			break;
		case "personalInfoPolicy":
			personalInfoPolicyCn.getById["personalInfoPolicyCn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '개인정보취급방침';
			break;
		case "guide":
			guideCn.getById["guideCn"].exec("UPDATE_CONTENTS_FIELD", []);
			action_str += '온라인스토어 이용 가이드';
			break;
	}
	
	content = $('#' + textarea + "Cn").val();

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
			initTextarea_Cn();
			insertLog('상점관리 > 기본정보관리', action_str+' 수정: ', 1);
			alert("정상적으로 저장되었습니다.");
		});
	});
}


function clickInitBtnCn(e, id){
	confirm("저장 하기 전 내용으로 초기화하시겠습니까?",function() {
		textInitCn(e, id);
	});
}


function textInitCn(e, id){
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
			"country":"Cn",
			"textarea":textarea
		},
		success: function(d) {
			if (d != null) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						switch(textarea) {
							case "information":
								informationCn.getById["informationCn"].exec("SET_IR", [""]);
								informationCn.getById["informationCn"].exec("PASTE_HTML", [row.information]);
								break;
							case "terms":
								termsCn.getById["termsCn"].exec("SET_IR", [""]);
								termsCn.getById["termsCn"].exec("PASTE_HTML", [row.terms]);
								break;
							case "refundPolicy":
								refundPolicyCn.getById["refundPolicyCn"].exec("SET_IR", [""]);
								refundPolicyCn.getById["refundPolicyCn"].exec("UPDATE_CONTCnTS_FIELD", []);
								break;
							case "personalInfoPolicy":
								personalInfoPolicyCn.getById["personalInfoPolicyCn"].exec("SET_IR", [""]);
								personalInfoPolicyCn.getById["personalInfoPolicyCn"].exec("PASTE_HTML", [row.personalInfoPolicy]);
								break;
							case "guide":
								guideCn.getById["guideCn"].exec("SET_IR", [""]);
								guideCn.getById["guideCn"].exec("PASTE_HTML", [row.guide]);
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
