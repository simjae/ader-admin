<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">온라인 스토어 이용가이드</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="policy_GUD_EN" name="policy_txt" required style="height:412px;display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn" onclick="putPolicyInfo_EN('EN','GUD');">
				저장
			</div>
			
			<div class="defult__color__btn" onclick="resetPolicyInfo('EN','GUD');">
				<i class="xi-refresh"></i>
				이전값 초기화
			</div>
		</div>
	</div>
</div>

<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">이용약관</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="policy_TRM_EN" name="policy_txt" required style="height:412px;display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn" onclick="putPolicyInfo_EN('EN','TRM');">
				저장
			</div>
			
			<div class="defult__color__btn" onclick="resetPolicyInfo('EN','TRM');">
				<i class="xi-refresh"></i>
				이전값 초기화
			</div>
		</div>
	</div>
</div>

<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">개인정보 처리방침</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="policy_PNL_EN" name="policy_txt" required style="height:412px;display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn" onclick="putPolicyInfo_EN('EN','PNL');">
				저장
			</div>
			
			<div class="defult__color__btn" onclick="resetPolicyInfo('EN','PNL');">
				<i class="xi-refresh"></i>
				이전값 초기화
			</div>
		</div>
	</div>
</div>

<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">About ADERERROR</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="policy_ABT_EN" name="policy_txt" required style="height:412px;display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn" onclick="putPolicyInfo_EN('EN','ABT');">
				저장
			</div>
			
			<div class="defult__color__btn" onclick="resetPolicyInfo('EN','ABT');">
				<i class="xi-refresh"></i>
				이전값 초기화
			</div>
		</div>
	</div>
</div>

<div class="content__card__tap">
	<div class="card__header">
		<div class="tab__title">회사정보</div>
	</div>
	<div class="card__body">
		<textarea class="width-100p" id="policy_INF_EN" name="policy_txt" required style="height:412px;display:none;"></textarea>
		<div class="btn__wrap--sm" style="padding-top:20px;">
			<div class="defult__color__btn save__btn" onclick="putPolicyInfo_EN('EN','INF');">
				저장
			</div>
			
			<div class="defult__color__btn" onclick="resetPolicyInfo('EN','INF');">
				<i class="xi-refresh"></i>
				이전값 초기화
			</div>
		</div>
	</div>
</div>

<script>
let policy_GUD_EN = [];
let policy_TRM_EN = [];
let policy_PNL_EN = [];
let policy_ABT_EN = [];
let policy_INF_EN = [];

$(document).ready(function(){
	initSmartEditor_EN();
	getPolicyInfoList('EN');
});

function initSmartEditor_EN() {
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: policy_GUD_EN,
		elPlaceHolder: "policy_GUD_EN",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: policy_TRM_EN,
		elPlaceHolder: "policy_TRM_EN",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: policy_PNL_EN,
		elPlaceHolder: "policy_PNL_EN",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: policy_ABT_EN,
		elPlaceHolder: "policy_ABT_EN",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: policy_INF_EN,
		elPlaceHolder: "policy_INF_EN",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
}

function getPolicyInfo_EN(country,policy_type) {
	$.ajax({
		type: "post",
		url: config.api + "store/policy/get",
		data: {
			'country' : country,
			'policy_type' : policy_type
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
						//$('#policy_' + policy_type + '_' + country).html(row.policy_txt);
						
						switch(policy_type) {
							case "GUD":
								policy_GUD_EN.getById["policy_GUD_EN"].exec("SET_IR", [""]);
								policy_GUD_EN.getById["policy_GUD_EN"].exec("PASTE_HTML", [row.policy_txt]);
								break;
							
							case "TRM":
								policy_TRM_EN.getById["policy_TRM_EN"].exec("SET_IR", [""]);
								policy_TRM_EN.getById["policy_TRM_EN"].exec("PASTE_HTML", [row.policy_txt]);
								break;
							
							case "PNL":
								policy_PNL_EN.getById["policy_PNL_EN"].exec("SET_IR", [""]);
								policy_PNL_EN.getById["policy_PNL_EN"].exec("UPDATE_CONTEnTS_FIELD", [row.policy_txt]);
								break;
							
							case "ABT":
								policy_ABT_EN.getById["policy_ABT_EN"].exec("SET_IR", [""]);
								policy_ABT_EN.getById["policy_ABT_EN"].exec("PASTE_HTML", [row.policy_txt]);
								break;
							
							case "INF":
								policy_INF_EN.getById["policy_INF_EN"].exec("SET_IR", [""]);
								policy_INF_EN.getById["policy_INF_EN"].exec("PASTE_HTML", [row.policy_txt]);
								break;
						}
					});
				}
			}
		}
	});
}

function putPolicyInfo_EN(country,policy_type) {
	switch(policy_type) {
		case "GUD":
			policy_GUD_EN.getById["policy_GUD_EN"].exec("UPDATE_CONTENTS_FIELD", []);
			break;
		
		case "TRM":
			policy_TRM_EN.getById["policy_TRM_EN"].exec("UPDATE_CONTENTS_FIELD", []);
			break;
		
		case "PNL":
			policy_PNL_EN.getById["policy_PNL_EN"].exec("UPDATE_CONTENTS_FIELD", []);
			break;
		
		case "ABT":
			policy_ABT_EN.getById["policy_ABT_EN"].exec("UPDATE_CONTENTS_FIELD", []);
			break;
		
		case "INF":
			policy_INF_EN.getById["policy_INF_EN"].exec("UPDATE_CONTENTS_FIELD", []);
			break;
	}
	
	let policy_name = getPolicyName(policy_type);
	let policy_txt = $('#policy_' + policy_type + '_' + country).val();
	
	confirm(
		"선택한 기본정보를 저장하시겠습니까?",
		function() {
			$.ajax({
				type: "post",
				url: config.api + "store/policy/put",
				data: {
					'country' : country,
					'policy_type' : policy_type,
					'policy_txt' : policy_txt
				},
				dataType: "json",
				error: function() {
					alert('기본정보 저장처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code = 200) {
						getPolicyInfo_EN(country,policy_type);
						insertLog('상점관리 > 기본정보관리', policy_name + ' 수정: ', 1);
						
						alert(policy_name + " 이(가) 저장되었습니다.");
					}
				}
			});
		}
	);
}

</script>
