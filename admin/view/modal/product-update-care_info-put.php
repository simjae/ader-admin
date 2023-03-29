<div class="content__card update__modal modal__view">
	<h3>
		상품정보 일괄변경 - 제품취급 유의사항
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_care">
					<colgroup>
						<col width="120px">
						<col width="auto">
					</colgroup>
					<TBODY>
						<TR>
							<TH>
								제품 취급 유의사항<br>(한글)
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_kr_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_kr_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="care_kr" name="care_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TH>
								제품 취급 유의사항<br>(영문)
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_en_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_en_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="care_en" name="care_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TH>
								제품 취급 유의사항<br>(중문)
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_cn_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="care_cn_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="care_cn" name="care_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
var care_kr = [];
var care_en = [];
var care_cn = [];

function setSmartEditor() {
	//care
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_kr,
		elPlaceHolder: "care_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_en,
		elPlaceHolder: "care_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_cn,
		elPlaceHolder: "care_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
});

function productUpdateCheck() {	
	care_kr.getById["care_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	care_en.getById["care_en"].exec("UPDATE_CONTENTS_FIELD", []);
	care_cn.getById["care_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "Care 일괄변경", null);
		modal_submit($('#frm-update'),'getUpdateProductInfo');
	}
	else if($('input[name=product_idx_arr]').val() == 'select_all'){
		productAllUpdateCheck();
	}
}
function productAllUpdateCheck() {	
	var formSearchData = new FormData();
	var formData = new FormData();
	formSearchData = $("#frm-list").serializeObject();
	formData = $("#frm-update").serializeObject();

	formSearchData.care_kr_update_flg = formData['care_kr_update_flg'];
	formSearchData.care_en_update_flg = formData['care_en_update_flg'];
	formSearchData.care_cn_update_flg = formData['care_cn_update_flg'];
	formSearchData.care_kr = formData['care_kr'];
	formSearchData.care_en = formData['care_en'];
	formSearchData.care_cn = formData['care_cn'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 Care정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "Care정보 일괄변경", null);
}
</script>