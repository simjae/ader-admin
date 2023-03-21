<div class="content__card update__modal modal__view">
	<h3>
		상품정보 일괄변경 - 환불/교환 정보
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
    <div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<input type="hidden" name="refund_msg_kr_update_flg" value="true">
            <input type="hidden" name="refund_msg_en_update_flg" value="true">
            <input type="hidden" name="refund_msg_cn_update_flg" value="true">
			<input type="hidden" name="refund_kr_update_flg" value="true">
			<input type="hidden" name="refund_en_update_flg" value="true">
			<input type="hidden" name="refund_cn_update_flg" value="true">

			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_wkla_material">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
                        <TR>	
                            <TD>구매 전<br>환불정보 표시 플래그</TD>
                            <TD>
                                <div class="content__row">
                                    <label class="rd__square">
                                        <input type="radio" name="refund_msg_flg" value="true" checked>
                                        <div><div></div></div>
                                        <span>표시</span>
                                    </label>
                                    <label class="rd__square">
                                        <input type="radio" name="refund_msg_flg" value="false">
                                        <div><div></div></div>
                                        <span>표시안함</span>
                                    </label>
                                </div>
                            </TD>
                        </TR>
                        <TR>
                            <TD>구매 전<br>환불정보 표시 메세지(한국몰)</TD>
                            <TD colspan="11">
                                <input type="text" id="refund_msg_kr" name="refund_msg_kr">
                            </TD>
                        </TR>
                        <TR>
                            <TD>구매 전<br>환불정보 표시 메세지(영문몰)</TD>
                            <TD colspan="11">
                                <input type="text" id="refund_msg_en" name="refund_msg_en">
                            </TD>
                        </TR>
                        <TR>
                            <TD>구매 전<br>환불정보 표시 메세지(중국몰)</TD>
                            <TD colspan="11">
                                <input type="text" id="refund_msg_cn" name="refund_msg_cn">
                            </TD>
                        </TR>
                        <TR>
                            <TD>추가 교환/환불<br>상세정보<br>(한국몰)</TD>
                            <TD colspan="11">
                                <textarea class="width-100p" id="refund_kr" name="refund_kr"
                                    style="width:90%; height:150px;"></textarea>
                            </TD>
                        </TR>

                        <TR>
                            <TD>추가 교환/환불<br>상세정보<br>(영문몰)</TD>
                            <TD colspan="11">
                                <textarea class="width-100p" id="refund_en" name="refund_en"
                                    style="width:90%; height:150px;"></textarea>
                            </TD>
                        </TR>

                        <TR>
                            <TD>추가 교환/환불<br>상세정보<br>(중국몰)</TD>
                            <TD colspan="11">
                                <textarea class="width-100p" id="refund_cn" name="refund_cn"
                                    style="width:90%; height:150px;"></textarea>
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
var refund_kr = [];
var refund_en = [];
var refund_cn = [];

function setSmartEditor() {
	//material
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_kr,
		elPlaceHolder: "refund_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_en,
		elPlaceHolder: "refund_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_cn,
		elPlaceHolder: "refund_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
});

function productUpdateCheck() {	
	refund_kr.getById["refund_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	refund_en.getById["refund_en"].exec("UPDATE_CONTENTS_FIELD", []);
	refund_cn.getById["refund_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "환불정보 일괄변경", null);
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

    formSearchData.refund_msg_kr_update_flg = formData['refund_msg_kr_update_flg'];
    formSearchData.refund_msg_en_update_flg = formData['refund_msg_en_update_flg'];
    formSearchData.refund_msg_cn_update_flg = formData['refund_msg_cn_update_flg'];
    formSearchData.refund_kr_update_flg = formData['refund_kr_update_flg'];
    formSearchData.refund_en_update_flg = formData['refund_en_update_flg'];
    formSearchData.refund_cn_update_flg = formData['refund_cn_update_flg'];
    formSearchData.refund_msg_flg = formData['refund_msg_flg'];
    formSearchData.refund_msg_kr = formData['refund_msg_kr'];
    formSearchData.refund_msg_en = formData['refund_msg_en'];
    formSearchData.refund_msg_cn = formData['refund_msg_cn'];
    formSearchData.refund_kr = formData['refund_kr'];
    formSearchData.refund_en = formData['refund_en'];
    formSearchData.refund_cn = formData['refund_cn'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 환불정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "환불정보 일괄변경", null);
}

</script>