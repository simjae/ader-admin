<div class="body">
	<h1>
		상품정보 일괄변경 - 제품취급 유의사항
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_care">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD style="width:10%;">제품취급<br>유의사항<br>(한국몰)</TD>
							<TD>
								<textarea class="width-100p" id="care_kr" name="care_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">제품취급<br>유의사항<br>(영문몰)</TD>
							<TD>
								<textarea class="width-100p" id="care_en" name="care_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">제품취급<br>유의사항<br>(중국몰)</TD>
							<TD>
								<textarea class="width-100p" id="care_cn" name="care_cn" required style="width:90%; height:150px;"></textarea>
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
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "Care 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>