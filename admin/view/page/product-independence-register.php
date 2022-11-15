<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.btn__gray{
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor:pointer;
	}
	.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
</style>
<div class="content__card">
    <div class="card__header">
        <h3>독립몰 상품등록[개인결제]</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
				<div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_ordersheet">
						<TABLE>
							<colgroup>
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
								<col width="8%">
							</colgroup>
							<TBODY>
								<TR>
									<TD>스타일코드</TD>
									<TD colspan="3">
										<input type="text" id="shop_style_code" name="shop_style_code" value=""> 
									</TD>
									<TD>컬러코드</TD>
									<TD colspan="3">
										<input type="text" id="shop_color_code" name="shop_color_code" value="">
									</TD>
									<TD>상품코드</TD>
									<TD colspan="3">
										<input type="text" id="shop_product_code" name="shop_product_code" value="">
									</TD>
								</TR>
								<TR>
									<TD>상품 이름</TD>
									<TD colspan="11">
										<input type="text" id="shop_product_name" name="shop_product_name" value="" style="width:40%">
									</TD>
								</TR>
								
								<TR>
									<TD>MD 제품 카테고리</TD>
									<TD colspan="11">
										<div class="content__row">
											<input type="hidden" id="md_category_1" name="md_category_1" value="">
											<input type="hidden" id="md_category_2" name="md_category_2" value="">
											<input type="hidden" id="md_category_3" name="md_category_3" value="">
											<input type="hidden" id="md_category_4" name="md_category_4" value="">
											<input type="hidden" id="md_category_5" name="md_category_5" value="">
											<input type="hidden" id="md_category_6" name="md_category_6" value="">
											<select class="fSelect category eCategory eCategory1" depth="1" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 01</option>	
											</select>
											<select class="fSelect category eCategory eCategory2" depth="2" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 02</option>
											</select>
											<select class="fSelect category eCategory eCategory3" depth="3" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 03</option>
											</select>
											<select class="fSelect category eCategory eCategory4" depth="4" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 04</option>
											</select>
											<select class="fSelect category eCategory eCategory5" depth="5" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 05</option>
											</select>
											<select class="fSelect category eCategory eCategory6" depth="6" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
												<option value="">상품분류 06</option>
											</select>
										</div>
									</TD>
								</TR>
								<TR class="cal_discount">
									<TD>한국몰 가격</TD>
									<TD colspan="3"><input id="price_kr" class="price" type="number" step="0.01" name="price_kr" value="0"></TD>
									<TD>한국몰 세일가격</TD>
									<TD colspan="3"><input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
									<TD>한국몰 할인율</TD>
									<TD colspan="3"><input id="discount_kr" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>

								</TR>
								<TR class="cal_discount">
									<TD>영문몰 가격</TD>
									<TD colspan="3"><input id="price_en" class="price" type="number" step="0.01" name="price_en" value="0"></TD>
									<TD>영문몰 세일가격</TD>
									<TD colspan="3"><input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0"></TD>
									<TD>영문몰 할인율</TD>
									<TD colspan="3"><input id="discount_en" class="result" type="number" step="0.01" name="discount_en" value="0" readonly></TD>

								</TR>
								<TR class="cal_discount"> 
									<TD>중국몰 가격</TD>
									<TD colspan="3"><input id="price_cn" class="price" type="number" step="0.01" name="price_cn" value="0"></TD>
									<TD>중국몰 세일가격</TD>
									<TD colspan="3"><input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
									<TD>중국몰 할인율</TD>
									<TD colspan="3"><input id="discount_cn" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>

								</TR>
								<tr>
									<TD >구매 멤버 제한</TD>
									<TD colspan="11">
										<div class="content__row">
											<label class="rd__square">
												<input id="limit_member" type="radio" name="limit_member" value="true" checked>
												<div><div></div></div>
												<span>전체</span>
											</label>
											<label class="rd__square">
												<input id="limit_member" type="radio" name="limit_member" value="false">
												<div><div></div></div>
												<span>비회원</span>
											</label>
											<label class="rd__square">
												<input id="limit_member" type="radio" name="limit_member" value="false">
												<div><div></div></div>
												<span>일반회원</span>
											</label>
											<label class="rd__square">
												<input id="limit_member" type="radio" name="limit_member" value="false">
												<div><div></div></div>
												<span>Ader Family</span>
											</label>
										</div>
									</TD>
								</tr>
								<TR>
									<TD>구매 수량 제한</TD>
									<TD colspan="3">
										<div class="content__row">
											<label class="rd__square">
												<input id="limit_purchase_qty_flg" type="radio" name="limit_purchase_qty_flg" value="true" checked>
												<div><div></div></div>
												<span>제한</span>
											</label>
											<label class="rd__square">
												<input id="limit_purchase_qty_flg" type="radio" name="limit_purchase_qty_flg" value="false">
												<div><div></div></div>
												<span>제한안함</span>
											</label>
										</div>
									</TD>
									<TD>구매 수량 제한 최소값</TD>
									<TD colspan="3"><input id="limit_purchase_qty_min" type="number" step="1" name="limit_purchase_qty_min" value="1"></TD>
									<TD >구매 수량 제한 최대값</TD>
									<TD colspan="3"><input id="limit_purchase_qty_max" type="number" step="1" name="limit_purchase_qty_max" value="0"></TD>
								</TR>
								<TR>
									<TD>상품 검색어</TD>
									<TD colspan="11"><input type="text" name="product_keyword" value="" style="width:90%"></TD>
								</TR>
								<TR>
									<TD >상품 태그</TD>
									<TD colspan="11">
										<div class="row">
											<input id="product_tag" type="text" value="" style="width:70%;">
											<button style="border:1px solid #000000;background-color:#ffffff;color:#000000;width:80px;height:30px;font-size:0.5rem;cursor:pointer;" onClick="addProductTagBtnClick();">추가</button>
											<button style="background-color:#000000;color:#ffffff;width:150px;height:30px;font-size:0.5rem;cursor:pointer;" onClick="confirm('상품태그를 불러올 경우 기존에 추가한 상품태그는 초기화됩니다.','getProductTag()');">상품태그 불러오기</button>
										</div>
										<div class="" id="product_tag_div" style="margin-top:10px;">
										</div>
									</TD>
								</TR>
								<TR>
									<TD>해외 통관 정보</TD>
									<TD colspan="11">
										<div class="content__row">
											<select id="custom_clearance" name="custom_clearance" class="fSelect eSearch" style="width:163px;">
												<option value="ADAP0000">남성 신발</option>
												<option value="AFAA0000">남성 지갑</option>
												<option value="AFAC0000">남성 스카프/머플러</option>
												<option value="AEAJ0000">양말</option>
												<option value="AEAP0000">기타악세</option>
												<option value="ADAG0000">남성 자켓</option>
												<option value="ADAJ0000">남성 티셔츠</option>
											</select>
											<span>통관번호 : ADAP0000<span>
										</div>
									</TD>
								</TR>
								<TR>
									<TD>관련상품 검색</TD>
									<TD colspan="11">
										<div class="content__row">
											<input id="relevant_idx" type="hidden" name="relevant_idx" value="0">
											
											<select id="relevant_type" class="fSelect eSearch" name="product_category" style="width:163px;">
												<option value="product_name">상품 이름</option>
												<option value="product_code">상품 코드</option>
												<option value="product_category">상품 카테고리</option>
											</select>
											
											<input id="relevant_keyword" type="text" style="width:300px;" value="">
											
											<button type="button" style="width:100px;float:right;cursor:pointer;border:1px solid #000000;" onClick="getRelevantProduct();">관련상품 검색</button>
											
											<div id="relevant_product_div" class="row" style="margin-top:10px;"></div>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD>관련상품</TD>
									<TD colspan="11">
										<div id="relevant_list" class="row">
											관련상품 없음
										</div>
									</TD>
								</TR>
								<TR>
									<TD>상품 재고<br>품절 임박 수량</TD>
									<TD colspan="5">
										<input id="sold_out_qty" type="number" step="1" name="sold_out_qty" value="0">
									</TD>
									<TD>구매 전<br>환불정보 표시 플래그</TD>
									<TD colspan="5">
										<div class="content__row">
											<label class="rd__square">
												<input id="refund_flg" type="radio" name="refund_flg" value="true" checked>
												<div><div></div></div>
												<span>표시</span>
											</label>
											<label class="rd__square">
												<input id="refund_flg" type="radio" name="refund_flg" value="false">
												<div><div></div></div>
												<span>표시안함</span>
											</label>
											<input type="text">
										</div>
									</TD>
								</TR>
								<TR>
									<TD>추가 교환/환불<br>상세정보 (한국몰)</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="refund_kr" name="refund_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>추가 교환/환불<br>상세정보 (영문몰)</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="refund_en" name="refund_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>추가 교환/환불<br>상세정보 (중국몰)</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="refund_cn" name="refund_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>메모</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="memo" name="memo"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TD>검색엔진<br>노출설정</TD>
									<TD colspan="11">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="seo_exposure_flg" value="true" checked>
												<div><div></div></div>
												<span>노출함</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="seo_exposure_flg" value="false">
												<div><div></div></div>
												<span>노출안함</span>
											</label>
										</div>
									</TD>
								<TR>
									<TD>검색엔진<br>브라우저 타이틀l_</TD>
									<TD colspan="11">
										<input type="text" name="seo_title" value="">
									</TD>
								</TR>
								<TR>
									<TD>메타태그<br>Author</TD>
									<TD colspan="11">
										<input type="text" name="seo_author" value="">
									</TD>
								</TR>
								<TR>
									<TD>메타태그<br>Description</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="seo_description" name="seo_description"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TD>메타태그<br>Keyword</TD>
									<TD colspan="11">
										<input type="text" name="seo_keywords" value="">
									</TD>
								</TR>
								<TR>
									<TD>검색엔진<br>상품이미지<br>ALT 텍스트</TD>
									<TD colspan="11">
										<textarea class="width-100p" id="seo_alt_text" name="seo_alt_text"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="confirm('상품을 등록하시겠습니까?.','independenceRegist()');">개별상품 등록</button>
		</div>
    </div>
</div>
<script>
var care_kr = [];
var care_en = [];
var care_cn = [];

var detail_kr = [];
var detail_en = [];
var detail_cn = [];

var size_category_info = {};
var chk_list_arr = [];
var ordersheet_option = new Array();

var material_kr = [];
var material_en = [];
var material_cn = [];

var refund_kr       = [];
var refund_en       = [];
var refund_cn       = [];
var memo            = [];
var seo_description = [];
var seo_alt_text    = [];

function setSmartEditor() {
	//care
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_kr,
		elPlaceHolder: "care_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_en,
		elPlaceHolder: "care_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_cn,
		elPlaceHolder: "care_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//detail
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_kr,
		elPlaceHolder: "detail_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_en,
		elPlaceHolder: "detail_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_cn,
		elPlaceHolder: "detail_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});

    //material
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_kr,
		elPlaceHolder: "material_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_en,
		elPlaceHolder: "material_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_cn,
		elPlaceHolder: "material_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});

    //refund
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_kr,
		elPlaceHolder: "refund_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_en,
		elPlaceHolder: "refund_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: refund_cn,
		elPlaceHolder: "refund_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	//etc
    nhn.husky.EZCreator.createInIFrame({
		oAppRef: memo,
		elPlaceHolder: "memo",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
    nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_description,
		elPlaceHolder: "seo_description",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
    nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_alt_text,
		elPlaceHolder: "seo_alt_text",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	console.log(refund_cn);
}

$(document).ready(function() {
	getProductCategory(0,0);

	$('.product_code_unit').keyup(function(){
		setProductCode();
	});
	$('#product_name').keyup(function(){
		var product_name = $(this).val();1
		$('#shop_product_name').val(product_name);
	});
	$('.cal_discount').keyup(function(){
		var price = $(this).find('.price').val();
		var sales_price = $(this).find('.sales_price').val();

		if(price * sales_price > 0){
			$(this).find('.result').val( ((price - sales_price) / price * 100 ).toFixed(2))
		}
	});

	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});

	$('#size_category').change(function() {	
		var size_category = $('#size_category option:checked').text();
		if(size_category.length > 0){
			$.ajax({
				type: "post",
				data: {'size_category' : size_category},
				dataType: "json",
				//SIZE_DESCRIPTION table : get api url 경로확인
				url: config.api + "product/size/get",
				error: function() {
					alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						if(d.data != null){
							size_category_info = d.data[0];
							printOptionForm();
							$('#size_default_msg').css('display','none');
							$('#sizeFormBtn').css('display', 'block');
						}
					}
				}
			});
		}
	});
	setSmartEditor();
	getCurrencyInfo();

	$('#insert_table_ordersheet').toggle();
    $('#insert_table_td').toggle();
	$('#insert_table_dsn').toggle();
});

function setProductCode(){
	var style_code = $('#style_code').val();
	var color_code = $('#color_code').val();

	$('#product_code').val(style_code + color_code);
	
	$('#shop_style_code').val(style_code);
	$('#shop_color_code').val(color_code);
	$('#shop_product_code').val(style_code + color_code);
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function productDuplicateCheck() {
	var product_code = $('#product_code').val();
	var style_code = $('#style_code').val();

	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
		return false;
	} else {
		$.ajax({
			type: "post",
			data:{
				'product_code':product_code
			},
			dataType: "json",
			url: config.api + "pm/ordersheet/md/check",
			error: function() {
				alert("상품코드 중목체크처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					if (data[0].product_cnt > 0) {
						alert('이미 등록된 상품코드입니다.');
						$('#duplicate_check').val(false);
						$('#duplicate_btn').css('background-color','#E43A45');
						$('#duplicate_btn').text('상품코드 중복체크');
						return false;
					} else {
						$('#duplicate_check').val(true);
						$('#duplicate_btn').css('background-color','#140f8');
						$('#duplicate_btn').text('중복체크 완료');
					}
				}
			}
		});
	}
}

function productOptionCheck() {
	var category_name = $('#sel_category_name').val();
	var search_type = $('#search_type').val();
	var search_keyword = $('#search_keyword').val();
	
	if (search_keyword != null && search_keyword.length > 0) {
		getHistoryProductOption(category_name, search_type,search_keyword);
	} else {
		alert('옵션정보를 조회하기위해 검색유형과 검색값을 입력해주세요.');
		return false;
	}
}

function getHistoryProductOption(category_name, search_type, search_keyword) {
	historyProductOptionReset();
	$.ajax({
		type: "post",
		data: {
			'category_name':category_name,
			'search_type':search_type,
			'search_keyword':search_keyword
		},
		dataType: "json",
		url: config.api + "pm/ordersheet/option/get",
		error: function() {
			alert("옵션정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null && data.length > 0) {
					var idx = 0;
					var size_key = [];
					for(var key in data[0].size){
						size_key.push(key);
						idx++;
					}
					var strTh = '';
					for(var i = 0; i < size_key.length; i++){
						strTh += `<TH style="width:7%;">${size_key[i]}<br>(cm)</TH>`;
					}
					var strDiv = "";
					strDiv += '<TABLE id="history_option_info_table"  style="font-size:0.5rem;margin-top:10px;">';
					strDiv += '    <THEAD>';
					strDiv += '        <TR>';
					strDiv += '            <TH style="width:5%;"></TH>';
					strDiv += '            <TH style="width:7%;">상품코드</TH>';
					strDiv += '            <TH style="width:10%;">상품이름</TH>';
					strDiv += '            <TH style="width:5%;">옵션이름</TH>';
					strDiv += '            <TH style="width:10%;">재고관리 등급</TH>';
					strDiv += 			   strTh;
					strDiv += '        </TR>';
					strDiv += '    </THEAD>';
					strDiv += '    <TBODY>';
					
					data.forEach(function(row) {
						var idx = 0;
						var size_key = [];
						var size_value = [];
						for(var key in row.size){
							size_key.push(key);
							size_value.push(row.size[size_key[idx]]);
							idx++;
						}
						var strTd = '';
						for(var i = 0; i < size_key.length; i++){
							strTd += `<TD>${size_value[i]}</TD>`;
						}

						strDiv += '    <TR id="option_row_' + row.no + '">';
						strDiv += '        <TD>';
						strDiv += '            <button size_code="' + row.option_code + '" style="width:50px;height:30px;background-color:#140f82;color:#ffffff;cursor:pointer;font-size:0.5rem;" onClick="historyOptionCheck(this);">적용</button>';
						strDiv += '        </TD>';
						strDiv += '        <TD>' + row.product_code + '</TD>';
						strDiv += '        <TD>' + row.product_name + '</TD>';
						strDiv += '        <TD>' + row.option_name + '</TD>';

						var stock_type_common = "";
						var stock_type_important = "";
						if (row.option_stock_grade == 'NML') {
							stock_type_common = "selected";
						} else {
							stock_type_important = "selected";
						}
						
						strDiv += '        <TD>';
						strDiv += '        		<div class="content__row">';
						strDiv += '            		<select class="fSelect" style="font-size:0.5rem;width:70px">';
						strDiv += '                		<option value="NML" ' + stock_type_common + '>일반</option>';
						strDiv += '                		<option value="IMP" ' + stock_type_important + '>중요</option>';
						strDiv += '           		 </select>';
						strDiv += '        		</div>';
						strDiv += '        </TD>';
						strDiv += 		   strTd;
						strDiv += '    </TR>';
					});
					
					strDiv += '    </TBODY>';
					strDiv += '</TABLE>';
					
					$('#history_option_td').append(strDiv);
				}
				else{
					alert('검색결과가 없습니다.');
				}
			}
		}
	});
}

function historyOptionCheck(obj){
	var sel_history_info = $(obj).parent().parent();
	var option_name = sel_history_info.children().eq(3).text();
	var stock_grade = sel_history_info.children().eq(4).find('select').val();
	var column_cnt 	= sel_history_info.children().length - 5;

	var option_info = $('#option_input_table').find('tbody').children();
	var option_row_cnt = option_info.length;

	for(var i = 0; i < option_row_cnt; i++){
		var regist_option_name = option_info.eq(i).children().eq(1).text().trim();
		
		if(regist_option_name == option_name){
			option_info.eq(i).find('.content__row').children().val(stock_grade).prop("selected",true);
			for(var j = 1; j <= column_cnt; j++){
				option_info.eq(i).find('.option_size_' + (j)).val(sel_history_info.children().eq(j+4).text());
			}
			return true;
		}
	}
	alert('일치하는 옵션이 없습니다.');
	return false;
}

function historyProductOptionReset() {
	$('#history_option_info_table').remove();
}

function printOptionForm(){
	chk_list_arr = [];
	chk_list_arr.push(['size_onesize','One','0']);
	chk_list_arr.push(['size_a1','A1','1']);
	chk_list_arr.push(['size_a2','A2','2']);
	chk_list_arr.push(['size_a3','A3','3']);
	chk_list_arr.push(['size_a4','A4','4']);
	chk_list_arr.push(['size_a5','A5','5']);

	$('#history_option_td').children('.content__row').html('');
	$('#history_option_td').children('.content__row').append(`
		<input type="text" id="sel_category_name" style="width:10%;" value="${size_category_info.category_name}" disabled>
		
		<select class="fSelect eSearch" id="search_type" style="width:163px;">
			<option value="product_code">상품 코드</option>
			<option value="product_name">상품 이름</option>
		</select>

		<input type="text" id="search_keyword" style="width:60%;" value="">
		
		<button type="button"
			style="width:120px;height:30px;border:1px solid #000000;background-color:#140f82;color:#ffffff;cursor:pointer;"
			onClick="productOptionCheck();">옵션정보 검색</button>
		
		<button type="button"
			style="width:50px;height:30px;border:1px solid #000000;cursor:pointer;background-color:#ffffff;color:#000000;"
			onClick="historyProductOptionReset();">초기화</button>
	`);
	historyProductOptionReset();
	setOptionForm();
}
function initSizeForm(){
	$('#size_default_msg').css('display','block');
	$('#sizeFormBtn').css('display','none');
	$('#option_insert_div').html('');
	$('#size_category option:eq(0)').prop("selected", true);

	$('#sel_category_name').val('');

	var history_init_str = `
						<div class="content__row">
							상품 카테고리를 먼저 선택해주세요
						</div>
	`;
	$('#history_option_td').html('');
	$('#history_option_td').append(history_init_str);
}

function setOptionForm(){
	var strDiv = "";
	var strThDiv = "";
	var category_name = $('#size_category option:checked').val();
	var img_path = '/images/sizeguide/sizecategory/'+category_name;
	var column_cnt = 0;
	img_path += `/${category_name}.svg`;
	
	$('#option_insert_div').html('');
	strDiv = `
				<div class="row">
					<div style="float:left;width: 33%;">
						<img id="size_img" src="${img_path}" >
					</div>
					<div style="float:left;width: 50%;padding-top:50px;">
						<table id="size_desc_table">
	`;

	for(var i = 1; i <= 6; i++){
        var size_title_str = size_category_info['size_title_' + String(i)];
        var size_desc_str  = size_category_info['size_desc_' + String(i)];

		if(size_title_str != null && size_title_str.length > 0){
			strDiv +=	`			
							<tr data-idx="${i}" style="cursor:pointer">
								<td>${size_title_str}</td>
								<td>${size_desc_str}</td>
							</tr> 
						`;
			strThDiv += `
							<th style="width:12%">${size_title_str}</th> 
						`;
			column_cnt++;
		}
	}
	strDiv +=	`		</table>
					</div>
				</div>
				<div class="drive--x"></div>
				<input type="hidden" name="column_cnt" value="${column_cnt}">
				<table id="option_input_table">
					<thead>
						<tr>
							<TH style="width:3%;"></TH>
							<TH style="width:5%">옵션 이름</TH>
							<TH style="width:8%">재고관리 등급</TH>
							${strThDiv}
						</tr>
					</thead>
					<tbody id="product_size_regist_table">
					</tbody>
				</table>
	`;
	$('#option_insert_div').append(strDiv);

	addSizeRow();

	for(var i = 0; i < ordersheet_option.length; i++){
		var size_1_info = ordersheet_option[i].option_size_1_info.split('|')[1] * 1;
		var size_2_info = ordersheet_option[i].option_size_2_info.split('|')[1] * 1;
		var size_3_info = ordersheet_option[i].option_size_3_info.split('|')[1] * 1;
		var size_4_info = ordersheet_option[i].option_size_4_info.split('|')[1] * 1;
		var size_5_info = ordersheet_option[i].option_size_5_info.split('|')[1] * 1;
		var size_6_info = ordersheet_option[i].option_size_6_info.split('|')[1] * 1;

		var option_name = ordersheet_option[i].option_name;
		//동일한 옵션이름의 사이즈 정보 입력폼 row 객체
		var size_row = $(`input[name='option_name[]'][value='${option_name}']`).parent().parent();
		console.log(option_name);
		console.log(size_row);
		//버튼, 옵션이름, 재고관리 컬럼을 제외한 컬럼의 갯수
		var option_size_len = size_row.children().length - 3;

		size_row.find('input[name="stock_grade[]"]').val(ordersheet_option[i].stock_grade);
		size_row.find('input[name="option_size_1[]"]').val(size_1_info);
		size_row.find('input[name="option_size_2[]"]').val(size_2_info);
		size_row.find('input[name="option_size_3[]"]').val(size_3_info);
		size_row.find('input[name="option_size_4[]"]').val(size_4_info);
		size_row.find('input[name="option_size_5[]"]').val(size_5_info);
		size_row.find('input[name="option_size_6[]"]').val(size_6_info);
		console.log(size_row.find('input[name="option_size_1[]"]'));
	}
	
	$('#size_desc_table tr').mouseover(function(){
		var img_path = '/images/sizeguide/sizecategory/';
		var tr_idx = $(this).attr('data-idx');
		var category_name = $('#size_category option:checked').val();
		var img_specify_keyword = `/${category_name}_${String.fromCharCode(parseInt(tr_idx) + 96)}.svg`;

		img_path += category_name + '/';
		img_path += img_specify_keyword;

        $('#size_desc_table td').css('text-decoration', 'none');
        $(this).find('td').css('text-decoration', 'underline');
		
		$('#size_img').attr('src', img_path);
    })
	$('#size_desc_table tr').mouseout(function(){
		var img_path = '/images/sizeguide/sizecategory/';
		var tr_idx = $(this).attr('data-idx');
		var category_name = $('#size_category option:checked').val();
		var img_specify_keyword = `/${category_name}.svg`;

		img_path += category_name + '/';
		img_path += img_specify_keyword;

        $('#size_desc_table td').css('text-decoration', 'none');
		
		$('#size_img').attr('src', img_path);
    })
}
function addSizeRow(){
	var success_cnt = 0;

	for(var i=0; i<chk_list_arr.length;i++){
		var textarea_id = chk_list_arr[i][0];
		var size_name 	= chk_list_arr[i][1];
		var size_code 	= chk_list_arr[i][2];
		
		var kr_sizeinfo_len = $('#' + textarea_id + '_kr').val().length;
		var en_sizeinfo_len = $('#' + textarea_id + '_en').val().length;
		var cn_sizeinfo_len = $('#' + textarea_id + '_cn').val().length;

		var sizeinfo_len = kr_sizeinfo_len + en_sizeinfo_len + cn_sizeinfo_len
		
		if(sizeinfo_len > 0){
			success_cnt++;
			addSizeTd(i,size_name,size_code);
		}
	}
	if(success_cnt == 0){
		$('#product_size_regist_table').append(`<tr><td colspan="9">입력된 사이즈 옵션이 없습니다.</td></tr>`);
	}
}

function addSizeTd(idx,size_name,size_code){
	strDiv = `
		<tr>
			<td>
				<a class="btn red" onclick="delOptionRow(this)">
					<i class="xi-trash"></i>
					<span class="tooltip top">삭제</span>
				</a>
			</td>
			<td>
				<input type="hidden" name="size_code[]" value="${size_code}">
				<input type="hidden" name="option_name[]" value="${size_name}">${size_name}</td>
			<td>
				<div class="content__row">
					<select class="fSelect" name="stock_grade[]" style="font-size:0.5rem;">
						<option value="NML" selected>일반</option>
						<option value="IMP" >중요</option>
					</select>
				</div>
			</td>
	`;
	for(var i = 1; i <= 6; i++){
        var size_title_str = size_category_info['size_title_' + String(i)];
        var size_desc_str  = size_category_info['size_desc_' + String(i)];
		
		if(size_title_str != null && size_title_str.length > 0){
			strDiv += `
				<td>
					<input type="number" name="option_size_${i}[]" class="option_size_${i}" value="" style="width:100px">cm
				</td>
			`;
		}
	}

	strDiv += `
		</tr>
	`;

	$('#product_size_regist_table').append(strDiv);	
}
function delOptionRow(obj){
	confirm('정말로 해당 옵션을 제외하시겠습니까?', function(){
		var row_cnt = $('#option_input_table > tbody tr').length
		var sel_tr = $(obj).parent().parent();

		if(row_cnt == 1){
			initSizeForm();
		}
		else{
			sel_tr.remove();
		}
	});
}

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
	$('#md_category_' + depth).val($('.eCategory'+depth+' option:selected').val());
	getProductCategory(depth,no);
}
function getProductCategory(depth,no) {
	if (depth == 0) {
		depth = 1;
	} else {
		depth += 1;
	}
	$.ajax({
		type: "post",
		data: {
			'depth':depth,
			'no':no
		},
		dataType: "json",
		url: config.api + "product/common/get",
		error: function() {
			data.instance.refresh();
		},
		success: function(d) {
			if(d.code == 200) {
				setProductCategory(depth,d.data);
			}
		}
	});
}
function setProductCategory(depth,d){

	var eCategory = $('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="">상품분류 0' + depth + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	eCategory.prop("selected", true);
}

function getCurrencyInfo() {
	$.ajax({
		type: "post",
		dataType: "json",
		//환율정보 get api경로 확인
		url: config.api + "product/currency/get",
		error: function() {
			alert("환율정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					
					var strDiv = "";
					strDiv += '<TABLE  style="font-size:0.5rem;width:200px;float:right;">';
					strDiv += '    <THEAD>';
					strDiv += '        <TR>';
					strDiv += '            <TH>국가</TH>';
					strDiv += '            <TH>환율 비율</TH>';
					strDiv += '        </TR>';
					strDiv += '    </THEAD>';
					strDiv += '    <TBODY>';
					
					data.forEach(function(row) {
						strDiv += '    <TR>';
						strDiv += '        <TD>' + row.country + '</TD>';
						strDiv += '        <TD id="currency_' + row.country + '">' + row.currency + '</TD>';
						strDiv += '    </TR>';
					});
					
					strDiv += '    </TBODY>';
					strDiv += '</TABLE>';
					
					$('#currency_table').append(strDiv);
				}
			}
		}
	});
}

function productPriceCalc() {
	var price_kr = $('#price_kr').val();
	var calc_val = $('#calc_val').val();
	
	var currency_en = $('#currency_EN').text();
	var currency_cn = $('#currency_CN').text();
	
	if (price_kr > 0 && calc_val > 0) {
		var sales_price_kr = (price_kr * calc_val).toFixed();
		var sales_price_en = 0;
		var sales_price_cn = 0;
		
		if (currency_en != null) {
			sales_price_en = (sales_price_kr * parseFloat(currency_en)).toFixed(2);
		}
		
		if (currency_cn != null) {
			sales_price_cn = (sales_price_kr * parseFloat(currency_cn)).toFixed(2);
		}
		
		$('#price_kr_gb').val(sales_price_kr);
		$('#price_en').val(sales_price_en);
		$('#price_cn').val(sales_price_cn);
		
		$('#sales_price_kr').val(sales_price_kr);
		$('#sales_price_en').val(sales_price_en);
		$('#sales_price_cn').val(sales_price_cn);
	}
}

function exclusiveFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#exclusive_flg').val(flg_val);
}

function addProductTagBtnClick() {
	var tag_val = $('#product_tag').val();
	
	var tag = [];
	if (tag_val != null && tag_val != "") {
		var cnt = 0;
		var length = $('.product_tag').length;
		
		if (length > 0) {
			for (var i=0; i<length; i++) {
				var product_tag = $('.product_tag').eq(i).text();
				if (tag_val == product_tag) {
					cnt++;
				}
			}
		}
		
		if (cnt > 0) {
			alert('중복된 상품태그를 등록할 수 없습니다.');
			return false;
		} else {
			tag.push(tag_val);
		}
		addProductTag(tag,false);
	} else {
		alert('추가할 상품의 태그를 입력하주세요.');
		return false;
	}
}

function getProductTag() {
	var tag = [];

	var category_lrg = $('#category_lrg').val();
	if (category_lrg != null && category_lrg != "") {
		tag.push(category_lrg);
	}

	var category_mdl = $('#category_mdl').val();
	if (category_mdl != null && category_mdl != "") {
		tag.push(category_mdl);
	}

	var category_sml = $('#category_sml').val();
	if (category_sml != null && category_sml != "") {
		tag.push(category_sml);
	}

	var category_dtl = $('#category_dtl').val();
	if (category_dtl != null && category_dtl != "") {
		tag.push(category_dtl);
	}

	var material = $('#material').val();
	if (material != null && material != "") {
		tag.push(material);
	}

	var graphic = $('#graphic').val();
	if (graphic != null && graphic != "") {
		tag.push(graphic);
	}

	var fit = $('#fit').val();
	if (fit != null && fit != "") {
		tag.push(fit);
	}

	var color = $('#color').val();
	if (color != null && color != "") {
		tag.push(color);
	}

	var rgb_code = $('#rgb_code').val();
	if (rgb_code != null && rgb_code != "") {
		tag.push(rgb_code);
	}
	
	var wkla = $('#wkla').val();
	if (wkla != null && wkla != "") {
		tag.push(wkla);
	}

	
	var size_a1_kr = $('#size_a1_kr').val();
	var size_a2_kr = $('#size_a2_kr').val();
	var size_a3_kr = $('#size_a3_kr').val();
	var size_a4_kr = $('#size_a4_kr').val();
	var size_a5_kr = $('#size_a5_kr').val();
	var size_onesize_kr = $('#size_onesize_kr').val();
	
	var size_a1_en = $('#size_a1_en').val();
	var size_a2_en = $('#size_a2_en').val();
	var size_a3_en = $('#size_a3_en').val();
	var size_a4_en = $('#size_a4_en').val();
	var size_a5_en = $('#size_a5_en').val();
	var size_onesize_en = $('#size_onesize_en').val();

	var size_a1_cn = $('#size_a1_cn').val();
	var size_a2_cn = $('#size_a2_cn').val();
	var size_a3_cn = $('#size_a3_cn').val();
	var size_a4_cn = $('#size_a4_cn').val();
	var size_a5_cn = $('#size_a5_cn').val();
	var size_onesize_cn = $('#size_onesize_cn').val();

	if (
		(size_a1_kr != null && size_a1_kr != "") ||
		(size_a1_en != null && size_a1_en != "") ||
		(size_a1_cn != null && size_a1_cn != "")
	) {
		tag.push('A1');
	}

	if (
		(size_a2_kr != null && size_a2_kr != "") ||
		(size_a2_en != null && size_a2_en != "") ||
		(size_a2_cn != null && size_a2_cn != "")
	) {
		tag.push('A2');
	}
	
	if (
		(size_a3_kr != null && size_a3_kr != "") ||
		(size_a3_en != null && size_a3_en != "") ||
		(size_a3_cn != null && size_a3_cn != "")
	) {
		tag.push('A3');
	}
	
	if (
		(size_a4_kr != null && size_a4_kr != "") ||
		(size_a4_en != null && size_a4_en != "") ||
		(size_a4_cn != null && size_a4_cn != "")
	) {
		tag.push('A4');
	}
	
	if (
		(size_a5_kr != null && size_a5_kr != "") ||
		(size_a5_en != null && size_a5_en != "") ||
		(size_a5_cn != null && size_a5_cn != "")
	) {
		tag.push('A5');
	}
	
	if (
		(size_onesize_kr != null && size_onesize_kr != "") ||
		(size_onesize_en != null && size_onesize_en != "") ||
		(size_onesize_cn != null && size_onesize_cn != "")
	) {
		tag.push('ONESIZE');
	}
	
	addProductTag(tag,true);
}

function addProductTag(tag,reset_flg) {
	var strDiv = "";
	for (var i=0; i<tag.length; i++) {
		strDiv += '<div style="width:15%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
		strDiv += '    <input type="hidden" name="product_tag[]" value="' + tag[i] + '">';
		strDiv += '    <font class="product_tag">' + tag[i] + '</font>';
		strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeProductTag(this);">x</font>';
		strDiv += '</div>';
	}
	
	if (reset_flg == true) {
		$('#product_tag_div').empty();
	}
	
	$('#product_tag_div').unbind();
	$('#product_tag_div').append(strDiv);
}

function removeProductTag(obj) {
	$(obj).parent().remove();
}

function getRelevantProduct() {
	var relevant_type = $('#relevant_type').val();
	var relevant_keyword = $('#relevant_keyword').val();
	
	if (relevant_type != null && relevant_keyword != null) {
		$.ajax({
			type: "post",
			data: {
				'relevant_type':relevant_type,
				'relevant_keyword':relevant_keyword
			},
			dataType: "json",
			url: config.api + "product/relevant/get",
			error: function() {
				alert("관련상품정보 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					
					if (data != null) {
						$('#relevant_list').html('');
						var strDiv = "";
						
						data.forEach(function(row) {
							strDiv += '<div class="relevant_product" style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;cursor:pointer;">';
							strDiv += '    <font class="relevant_idx" relevant_idx="' + row.no + '" onClick="addRelevantProduct(this);">' + row.product_code + ' - ' + row.product_name + '</font>';
							strDiv += '</div>';
						});
						
						$('#relevant_list').unbind();
						$('#relevant_list').append(strDiv);
					} else {
						alert('검색 결과가 없습니다. 관련상품 정보를 다시 입력해주세요.');
					}
				}
			}
		});
	} else {
		alert('검색 할 관련상품 정보를 정확히 입력해주세요.');
		return false;
	}
}

function addRelevantProduct(obj) {
	var relevant_idx_arr = [];
	var relevant_idx = $('#relevant_idx').val();
	
	var obj_idx = $(obj).attr('relevant_idx');
	var product_name = $(obj).text();
	
	if (relevant_idx != "0") {
		relevant_idx_arr = relevant_idx.split(',');
	}
	
	var result_cnt = 0;
	if (relevant_idx_arr.length > 0) {
		if (relevant_idx_arr.indexOf(obj_idx) < 0) {
			relevant_idx_arr.push(obj_idx);
			result_cnt++;
		} else {
			alert('중복된 관련상품을 선택할 수 없습니다. 다른 관련상품을 선택해주세요.');
			return false;
		}
	} else {
		relevant_idx_arr.push(obj_idx);
		result_cnt++;
	}
	
	if (result_cnt > 0) {
		$('#relevant_idx').val(relevant_idx_arr);
		
		var strDiv = "";
		strDiv += '<div class="relevant_product" style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;cursor:pointer;">';
		strDiv += '    <font class="relevant_idx" relevant_idx="' + obj_idx + '">' + product_name + '</font>';
		strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeRelevantProduct(this);">x</font>';
		strDiv += '</div>';
		
		$('#relevant_product_div').append(strDiv);
	}
}

function removeRelevantProduct(obj) {
	$(obj).parent().remove();
	
	var length = $('#relevant_product_div').find('.relevant_idx').length;
	var relevant_idx_arr = [];
	for (var i=0; i<length; i++) {
		var relevant_idx = $('#relevant_product_div').find('.relevant_idx').eq(i).attr('relevant_idx');
		relevant_idx_arr.push(relevant_idx);
	}
	
	if (relevant_idx_arr.length == 0) {
		$('#relevant_idx').val('0');
	} else {
		$('#relevant_idx').val(relevant_idx_arr);
	}
}

function independenceRegist() {
	var style_code = $('#style_code').val();
	if (style_code.length == 0 || style_code == null) {
		alert('스타일코드를 입력해주세요.');
		return false;
	}
	
	var color_code = $('#color_code').val();
	if (style_code.length == 0 || style_code == null) {
		alert('색깔코드를 입력해주세요.');
		return false;
	}
	
	var product_code = $('#product_code').val();
	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
		return false;
	}
	
	
	var duplicate_check = $('#duplicate_check').val();
	if (duplicate_check != 'true') {
		alert('등록하려는 상품의 상품코드를 확인해주세요.');
		return false;
	}
	
	var color_rgb = $('#color_rgb').val();
	var result = color_rgb.indexOf(';');
	if(result < 0){
		color_rgb += ';';
	}
	var color_rgb_arr = color_rgb.split(";");
	var err_cnt = 0;
	for(var i = 0; i < color_rgb_arr.length; i++){
		var code_regex = /#[A-Za-z0-9]{6,8}/;
		if(color_rgb_arr[i].length > 0 && color_rgb_arr[i].length <= 9){
			if(code_regex.test(color_rgb_arr[i]) == false){
				err_cnt++;
			}
		}
		else{
			if(color_rgb_arr[i].length != 0){
				err_cnt++;
			}
		}
	}
	if(err_cnt > 0){
		alert('색상코드가 유효하지 않습니다. 정확한 색상코드를 입력해주세요.');
		return false;
	}

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/add_new",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("독립몰 개별상품 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('독립몰 개별상품이 정상적으로 등록되었습니다.',function pageLocation() {
					location.href = '/product/ordersheet';
				});
			}
		}
	});
}
</script>