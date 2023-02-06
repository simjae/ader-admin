<div class="body">
	<h1>
		상품정보 일괄변경 - 소재
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
    <div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_wkla_material">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD>소재<br>(한국몰)</TD>
							<TD>
								<textarea class="width-100p" id="material_kr" name="material_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>소재<br>(영문몰)</TD>
							<TD>
								<textarea class="width-100p" id="material_en" name="material_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>소재<br>(중문몰)</TD>
							<TD>
								<textarea class="width-100p" id="material_cn" name="material_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>적용</a>
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
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "W/K/L/A Material 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>