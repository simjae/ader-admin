<div class="body">
	<h1>
		상품정보 일괄변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_detail" class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD style="width:10%;">Detail 한글</TD>
							<TD>
								<textarea class="width-100p" id="detail_kr" name="detail_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Detail 영문</TD>
							<TD>
								<textarea class="width-100p" id="detail_en" name="detail_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Detail 중문</TD>
							<TD>
								<textarea class="width-100p" id="detail_cn" name="detail_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
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
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "Detail 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>