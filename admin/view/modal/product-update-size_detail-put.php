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
				<TABLE id="insert_table_size_detail" class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<TBODY>
						<TR>
							<TD>모델</TD>
							<TD>
								<input type="text" name="size_detail_model" value="">
							</TD>
							<TD>Wearing size</TD>
							<TD>
								<input type="text" name="size_detail_wear" value="">
							</TD>
						</TR>
						
						<TR>
							<TD>A1한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a1_kr" name="size_detail_a1_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_kr" name="size_detail_a2_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_kr" name="size_detail_a3_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_kr" name="size_detail_a4_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_kr" name="size_detail_a5_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						
							<TD>ONESIZE한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_kr" name="size_detail_onesize_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A1영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a1_en" name="size_detail_a1_en" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_en" name="size_detail_a2_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_en" name="size_detail_a3_en" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_en" name="size_detail_a4_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_en" name="size_detail_a5_en" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>ONESIZE영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_en" name="size_detail_onesize_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A1중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a1_cn" name="size_detail_a1_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_cn" name="size_detail_a2_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_cn" name="size_detail_a3_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_cn" name="size_detail_a4_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_cn" name="size_detail_a5_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>ONESIZE중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_cn" name="size_detail_onesize_cn" required style="width:90%; height:150px;"></textarea>
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
var size_detail_a1_kr = [];
var size_detail_a2_kr = [];
var size_detail_a3_kr = [];
var size_detail_a4_kr = [];
var size_detail_a5_kr = [];
var size_detail_onesize_kr = [];

var size_detail_a1_en = [];
var size_detail_a2_en = [];
var size_detail_a3_en = [];
var size_detail_a4_en = [];
var size_detail_a5_en = [];
var size_detail_onesize_en = [];

var size_detail_a1_cn = [];
var size_detail_a2_cn = [];
var size_detail_a3_cn = [];
var size_detail_a4_cn = [];
var size_detail_a5_cn = [];
var size_detail_onesize_cn = [];

function setSmartEditor() {
	//size_detail_kr
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_kr,
		elPlaceHolder: "size_detail_a1_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_kr,
		elPlaceHolder: "size_detail_a2_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_kr,
		elPlaceHolder: "size_detail_a3_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_kr,
		elPlaceHolder: "size_detail_a4_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_kr,
		elPlaceHolder: "size_detail_a5_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_kr,
		elPlaceHolder: "size_detail_onesize_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	
	
	//size_detail_en
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_en,
		elPlaceHolder: "size_detail_a1_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_en,
		elPlaceHolder: "size_detail_a2_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_en,
		elPlaceHolder: "size_detail_a3_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_en,
		elPlaceHolder: "size_detail_a4_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_en,
		elPlaceHolder: "size_detail_a5_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_en,
		elPlaceHolder: "size_detail_onesize_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	
	//size_detail_cn
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_cn,
		elPlaceHolder: "size_detail_a1_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_cn,
		elPlaceHolder: "size_detail_a2_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_cn,
		elPlaceHolder: "size_detail_a3_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_cn,
		elPlaceHolder: "size_detail_a4_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_cn,
		elPlaceHolder: "size_detail_a5_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_cn,
		elPlaceHolder: "size_detail_onesize_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
});

function productUpdateCheck() {
	size_detail_a1_kr.getById["size_detail_a1_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a2_kr.getById["size_detail_a2_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a3_kr.getById["size_detail_a3_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a4_kr.getById["size_detail_a4_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a5_kr.getById["size_detail_a5_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_onesize_kr.getById["size_detail_onesize_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	
	size_detail_a1_en.getById["size_detail_a1_en"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a2_en.getById["size_detail_a2_en"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a3_en.getById["size_detail_a3_en"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a4_en.getById["size_detail_a4_en"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a5_en.getById["size_detail_a5_en"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_onesize_en.getById["size_detail_onesize_en"].exec("UPDATE_CONTENTS_FIELD", []);

	size_detail_a1_cn.getById["size_detail_a1_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a2_cn.getById["size_detail_a2_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a3_cn.getById["size_detail_a3_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a4_cn.getById["size_detail_a4_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_a5_cn.getById["size_detail_a5_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	size_detail_onesize_cn.getById["size_detail_onesize_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "Size 정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>