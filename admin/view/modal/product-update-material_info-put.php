<div class="content__card update__modal modal__view">
	<h3>
		상품정보 일괄변경 - 소재
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<input type="hidden" name="material_kr_update_flg" value="true">
			<input type="hidden" name="material_en_update_flg" value="true">
			<input type="hidden" name="material_cn_update_flg" value="true">
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_wkla_material">
					<colgroup>
						<col width="120px">
						<col width="auto">
					</colgroup>
					<TBODY>
						<TR>
							<TH>
								소재 (한글)
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_kr_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_kr_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="material_kr" name="material_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TH>
								소재 (영문)
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_en_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_en_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="material_en" name="material_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TH>
								소재 (중문)
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_cn_update_flg" value="false" checked>
									<div><div></div></div>
									<span>수정안함</span>
								</label>
								<label class="rd__square update__flg__area">
									<input type="radio" name="material_cn_update_flg" value="true">
									<div><div></div></div>
									<span>수정함</span>
								</label>
							</TH>
							<TD>
								<textarea class="width-100p" id="material_cn" name="material_cn" required style="width:90%; height:150px;"></textarea>
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
var material_kr = [];
var material_en = [];
var material_cn = [];

function setSmartEditor() {
	//material
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_kr,
		elPlaceHolder: "material_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_en,
		elPlaceHolder: "material_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_cn,
		elPlaceHolder: "material_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
});

function productUpdateCheck() {	
	material_kr.getById["material_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	material_en.getById["material_en"].exec("UPDATE_CONTENTS_FIELD", []);
	material_cn.getById["material_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "W/K/L/A Material 일괄변경", null);
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

	formSearchData.material_kr_update_flg = formData['material_kr_update_flg'];
	formSearchData.material_en_update_flg = formData['material_en_update_flg'];
	formSearchData.material_cn_update_flg = formData['material_cn_update_flg'];
	formSearchData.material_kr = formData['material_kr'];
	formSearchData.material_en = formData['material_en'];
	formSearchData.material_cn = formData['material_cn'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 W/K/L/A Material정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "W/K/L/A Material정보 일괄변경", null);
}
</script>