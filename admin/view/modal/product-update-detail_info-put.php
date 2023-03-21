<div class="content__card update__modal modal__view">
	<h3>
		상품정보 일괄변경 - 상세정보
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<input type="hidden" name="detail_kr_update_flg" value="true">
			<input type="hidden" name="detail_en_update_flg" value="true">
			<input type="hidden" name="detail_cn_update_flg" value="true">
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_detail" >
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD>제품<br>상세정보<br>(한국몰)</TD>
							<TD>
								<textarea class="width-100p" id="detail_kr" name="detail_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>제품<br>상세정보<br>(영문몰)</TD>
							<TD>
								<textarea class="width-100p" id="detail_en" name="detail_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
						<TD>제품<br>상세정보<br>(중문몰)</TD>
							<TD>
								<textarea class="width-100p" id="detail_cn" name="detail_cn" required style="width:90%; height:150px;"></textarea>
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
var detail_kr = [];
var detail_en = [];
var detail_cn = [];

function setSmartEditor() {	
	//detail
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_kr,
		elPlaceHolder: "detail_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_en,
		elPlaceHolder: "detail_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_cn,
		elPlaceHolder: "detail_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
});

function productUpdateCheck() {	
	detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "Detail 일괄변경", null);
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

	formSearchData.detail_kr_update_flg = formData['detail_kr_update_flg'];
	formSearchData.detail_en_update_flg = formData['detail_en_update_flg'];
	formSearchData.detail_cn_update_flg = formData['detail_cn_update_flg'];
	formSearchData.detail_kr = formData['detail_kr'];
	formSearchData.detail_en = formData['detail_en'];
	formSearchData.detail_cn = formData['detail_cn'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 Detail정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "Detail정보 일괄변경", null);
}
</script>