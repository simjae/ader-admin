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
	.size_textarea{
		width:90%; 
		height:150px;
		resize: none;
		border: solid 1px #bfbfbf;
		overflow: hidden;
  		white-space: nowrap;
  		text-overflow: ellipsis;
	}
</style>

<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>개별상품수정 [DSN]</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_dsn_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">	
				<input type="hidden" name="ordersheet_idx" value="">
				<input type="hidden" name="update_date" value="">
				<input type="hidden" name="product_code" value="">
				<input type="hidden" name="product_name" value="">
				<input type="hidden" name="overwrite_flg" value="false">
				<div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
                    <div class="overflow-x-auto" id="insert_table_ordersheet">
                        <TABLE>
							<TBODY>
                                <TR>
                                    <TD style="width:10%;">스타일코드</TD>
                                    <TD id="style_code" style="width:23%;"></TD>
                                    <TD style="width:10%;">컬러코드</TD>
                                    <TD id="color_code" style="width:23%;"></TD>
                                    <TD style="width:10%;">상품코드</TD>
                                    <TD id="product_code" style="width:23%;"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <TABLE>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">프리오더 체크</TD>
                                    <TD style="width:35%;" id="preorder_flg"></TD>
                                    <TD style="width:10%;">오더시트 상품분류</TD>
                                    <TD style="width:45%;">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td style="width:25%" id="category_lrg"></td>
                                                    <td style="width:25%" id="category_mdl"></td>
                                                    <td style="width:25%" id="category_sml"></td>
                                                    <td style="width:25%" id="category_dtl"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>상품 그래픽</TD>
                                    <TD id="graphic"></TD>
                                    <TD>상품 핏</TD>
                                    <TD id="fit"></TD>
                                </TR>
                                <TR>
                                    <TD>소재</TD>
                                    <TD id="material"></TD>
                                    <TD>네비게이션</TD>
                                    <TD id="navigation"></TD>
                                </TR>
                                <TR>
                                    <TD>상품 이름</TD>
                                    <TD id="product_name"></TD>
                                    <TD>상품 사이즈</TD>
                                    <TD id="product_size"></TD>
                                </TR>
                                <TR>
                                    <TD>상품 컬러</TD>
                                    <TD id="color"></TD>
                                    <TD>색상코드</TD>
                                    <TD id="color_rgb"></TD>
                                </TR>
                                <TR>
                                    <TD>구매 수량 제한</TD>
                                    <TD id="limit_qty"></TD>
                                    <TD>구매 멤버 제한</TD>
                                    <TD id="limit_member"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <div style="margin-top:5px;">
                            <div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
                            <div class="overflow-x-auto">
                                <TABLE>
                                    <colgroup>
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                    </colgroup>
                                    <TBODY>
                                        <TR>
                                            <TD>ADER</TD>
                                            <TD>ADER GB</TD>
                                            <TD>ADER EN USD</TD>
                                            <TD>ADER CN USD</TD>
                                        </TR>
                                        <TR>
                                            <TD id="price_kr"></TD>
                                            <TD id="price_kr_gb"></TD>
                                            <TD id="price_en"></TD>
                                            <TD id="price_cn"></TD>
                                        </TR>
                                    </TBODY>
                                </TABLE>
                            </div>
                        </div>
                        <TABLE style="margin-top:5px;">
                            <TBODY>
                                <tr>
                                    <TD style="width:10%;">기획수량(총 수량)</TD>
                                    <TD style="width:35%;" id="product_qty"></TD>
                                    <TD style="width:10%;">상품옵션-재고관리 등급</TD>
                                    <TD style="width:45%;" id="product_stock_grade"></TD>
                                </tr>
                                <TR>
                                    <TD >적립금 사용</TD>
                                    <TD id="mileage_flg"></TD>
                                    <TD>단독구매 제한</TD>
                                    <TD id="exclusive_flg"></TD>
                                </TR>
                                <TR>
                                    <TD >런칭일자</TD>
                                    <TD colspan="3" id="launching_date">
                                    </TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </div>
                </div>
                
                <div class="table table__wrap">
                    <button type="button" toggle_table="td"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 생산</button>
                    <div class="overflow-x-auto" id="insert_table_td">
                        <TABLE>
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD>재료 (한글)</TD>
                                    <TD>
                                        <div class="width-100p nomal_textarea" id="material_kr" name="material_kr"
                                            style="width:90%; height:150px;" disabled></div>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD>
                                        <div class="width-100p nomal_textarea" id="material_en" name="material_en"
                                            style="width:90%; height:150px;" disabled></div>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD>
                                        <div class="width-100p nomal_textarea" id="material_cn" name="material_cn"
                                            style="width:90%; height:150px;" disabled></div>
                                    </TD>
                                </TR>
                            </TBODY>
						</TABLE>
                        <TABLE style="margin-top:50px">
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">제조사</TD>
                                    <TD id="manufacturer" style="width:38%;"></TD>
                                    <TD style="width:10%;">공급사</TD>
                                    <TD id="supplier" style="width:38%;"></TD>
                                </TR>
                                <TR>	
                                    <TD >원산지</TD>
                                    <TD id="origin_country"></TD>
                                    <TD >브랜드</TD>
                                    <TD id="brand"></TD>
                                </TR>
                                <TR>
                                    <TD >트랜드</TD>
                                    <TD id="trend"></TD>
								</TR>
								<TR> 
                                    <TD>상품 적재박스 유형<input type="hidden" id="box_idx" value="0"></TD>
									<TD colspan="3" id="box_div">
									</TD>
                                </TR>
                                <tr>
                                    <td>상자 정보</td>
                                    <td colspan="3" id="box_info_table">
                                    </td>
                                </tr>

                                <TR>
                                    <TD>상품 적재중량 (kg)</TD>
                                    <TD colspan="3" id="product_weight"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </div>
                </div>
            
				<div class="table table__wrap">
                    <button type="button" toggle_table="dsn"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 디자인</button>
					<div class="overflow-x-auto" id="insert_table_dsn">
						<TABLE>
							<colgroup>
								<col width="3%">
								<col width="11%">
								<col width="3%">
								<col width="11%">
								<col width="3%">
								<col width="11%">

								<col width="3%">
								<col width="11%">
								<col width="3%">
								<col width="11%">
								<col width="3%">
								<col width="11%">
							</colgroup>
							<TBODY>
                                <TR>
								    <TD colspan="2">W/K/L/A</TD>
									<TD colspan="10">
										<input type="text" id="wkla" name="wkla" value="">
									</TD>
								</TR>
                                <TR>
									<TD colspan="2">모델</TD>
									<TD colspan="4">
										<input type="text" id="model" name="model" value="">
									</TD>
									<TD colspan="2">모델착용 사이즈</TD>
									<TD colspan="4">
										<input type="text" id="model_wear" name="model_wear" value="">
									</TD>
								</TR>
								<TR>
									<TD>A1한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a1_kr" name="size_a1_kr"></textarea>
									</TD>

									<TD>A2한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a2_kr" name="size_a2_kr"></textarea>
									</TD>

									<TD>A3한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a3_kr" name="size_a3_kr"></textarea>
									</TD>

									<TD>A4한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a4_kr" name="size_a4_kr"></textarea>
									</TD>

									<TD>A5한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a5_kr" name="size_a5_kr"></textarea>
									</TD>

									<TD>ONESIZE한글</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_onesize_kr"
											name="size_onesize_kr"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A1영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a1_en" name="size_a1_en"></textarea>
									</TD>

									<TD>A2영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a2_en" name="size_a2_en"></textarea>
									</TD>
									
									<TD>A3영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a3_en" name="size_a3_en"></textarea>
									</TD>

									<TD>A4영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a4_en" name="size_a4_en"></textarea>
									</TD>

									<TD>A5영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a5_en" name="size_a5_en"></textarea>
									</TD>

									<TD>ONESIZE영문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_onesize_en"
											name="size_onesize_en"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A1중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a1_cn" name="size_a1_cn"></textarea>
									</TD>

									<TD>A2중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a2_cn" name="size_a2_cn"></textarea>
									</TD>

									<TD>A3중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a3_cn" name="size_a3_cn"></textarea>
									</TD>

									<TD>A4중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a4_cn" name="size_a4_cn"></textarea>
									</TD>
									<TD>A5중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_a5_cn" name="size_a5_cn"></textarea>
									</TD>

									<TD>ONESIZE중문</TD>
									<TD>
										<textarea class="width-100p size_textarea" id="size_onesize_cn"
											name="size_onesize_cn" ></textarea>
									</TD>
								</TR>
								<TR>
									<TD colspan="2">
										이미 등록한 옵션정보 불러오기
									</TD>
									<TD colspan="10" id="history_option_td">
										<div class="content__row">
											상품 카테고리를 먼저 선택해주세요
										</div>
									</TD>
								</TR>
								<TR>
									<TD ID = "option_td" colspan="12">
										<div colspan="5" id="option_category_td">
											<div class="content__row">
												<select id="size_category" name="size_category" class="fSelect eSearch" style="width:163px;">
													<option value="">---one piece---</option>
													<option value="dress">dress</option>
													<option value="">---two piece---</option>
													<option value="coat">coat</option>
													<option value="hoodie">hoodie</option>
													<option value="longSleeve">longSleeve</option>
													<option value="shirts">shirts</option>
													<option value="tailored-jacket">tailored-jacket</option>
													<option value="tShirts">tShirts</option>
													<option value="vest">vest</option>
													<option value="zipup">zipup</option>
													<option value="pants">pants</option>
													<option value="skirt">skirt</option>
													<option value="">---bag---------</option>
													<option value="backPack">backPack</option>
													<option value="crossBag">crossBag</option>
													<option value="toteBag">toteBag</option>
													<option value="">---hat---------</option>
													<option value="beanie">beanie</option>
													<option value="bucketHat">bucketHat</option>
													<option value="cap">cap</option>
													<option value="">---acc---------</option>
													<option value="belt">belt</option>
													<option value="necktie">necktie</option>
													<option value="sock">sock</option>
												</select>
												<span id="size_default_msg" style="color:red">카테고리 선택시, 옵션 입력창이 생성됩니다.</span>
												<button type="button" id="sizeFormBtn"
													style="width:50px;height:30px;border:1px solid #000000;cursor:pointer;background-color:#ffffff;color:#000000;display:none"
													onClick="initSizeForm();" >초기화</button>
											</div>
											<div id="option_insert_div">
											</div>
										</div>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TD style="width:10%;">Detail 한글</TD>
									<TD>
										<textarea class="width-100p" id="detail_kr" name="detail_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">Detail 영문</TD>
									<TD>
										<textarea class="width-100p" id="detail_en" name="detail_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">Detail 중문</TD>
									<TD>
										<textarea class="width-100p" id="detail_cn" name="detail_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
                    	</TABLE>
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TD style="width:10%;">유의사항 (한글)</TD>
									<TD>
										<textarea class="width-100p" id="care_kr" name="care_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">유의사항 (영문)</TD>
									<TD>
										<textarea class="width-100p" id="care_en" name="care_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">유의사항 (중문)</TD>
									<TD>
										<textarea class="width-100p" id="care_cn" name="care_cn"
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
				onClick="confirm('상품을 등록하시겠습니까?.','ordersheetDsnUpdate()');">개별상품 업데이트</button>
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

}

$(document).ready(function() {
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
	$('#insert_table_ordersheet').toggle();
	$('#insert_table_td').toggle();
	urlParsing();
	setSmartEditor();
});

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");
		if(data_arr[0] == 'ordersheet_idx'){
			ordersheetDsnGet(data_arr[1]);
		}
	}
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function ordersheetDsnGet(idx) {
    $('input[name=ordersheet_idx]').val(idx);
	$.ajax({
        type: "post",
        data:{
            'sel_idx':idx
        },
        dataType: "json",
        url: config.api + "pm/ordersheet/get",
        error: function() {
            alert("오더시트 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
                var data = d.data[0];
				$('input[name=update_date]').val(data.update_date);
				$('input[name=product_name]').val(data.product_name);
				$('input[name=product_code]').val(data.product_code);
				//기획 MD
				$('#style_code').text(data.style_code);
                $('#color_code').text(data.color_code);
                $('#product_code').text(data.product_code);

                switch(data.preorder_flg){
                    case 0:
                        $('#preorder_flg').text('고객상품');
                        break;
                    case 1:
                        $('#preorder_flg').text('프리오더 상품');
                        break;
                }
                $('#category_lrg').text(data.category_lrg);
                $('#category_mdl').text(data.category_mdl);
                $('#category_sml').text(data.category_sml);
                $('#category_dtl').text(data.category_dtl);
                $('#graphic').text(data.graphic);
                $('#fit').text(data.fit);
                $('#material').text(data.material);
                $('#navigation').text(data.navigation);
                $('#product_name').text(data.product_name);
                $('#product_size').text(data.product_size);
                $('#color').text(data.color);
                $('#color_rgb').text(data.color_rgb);
                $('#limit_qty').text(data.limit_qty);
                $('#limit_member').text(data.limit_member);
                $('#price_kr').text(data.price_kr);
                $('#price_kr_gb').text(data.price_kr_gb);
                $('#price_en').text(data.price_en);
                $('#price_cn').text(data.price_cn);
                $('#product_qty').text(data.product_qty);
                switch(data.product_stock_grade){
                    case 'NML':
                        $('#product_stock_grade').text('일반재고');
                        break;
                    case 'IMP':
                        $('#product_stock_grade').text('중요재고');
                        break;
                }
                switch(data.mileage_flg){
                    case 0:
						$('#mileage_flg').text('사용안함');
                        break;
                    case 1:
						$('#mileage_flg').text('사용');
                        break;
                }
                switch(data.exclusive_flg){
                    case 0:
						$('#exclusive_flg').text('단독구매 제한 없음');
                        break;
                    case 1:
						$('#exclusive_flg').text('단독구매 제한');
                        break;
                }
                $('#launching_date').text(data.launching_date);

                //생산
                $('#material_kr').html(data.material_kr);
                $('#material_en').html(data.material_en);
                $('#material_cn').html(data.material_cn);
                $('#manufacturer').text(data.manufacturer);
                $('#supplier').text(data.supplier);
                $('#origin_country').text(data.origin_country);
                $('#brand').text(data.brand);
                $('#trend').text(data.trend);
                $('#box_idx').val(data.box_idx);
                $('#product_weight').text(data.product_weight);
                
				//디자인
                $('#wkla').val(data.wkla);
                $('#model').val(data.model);
                $('#model_wear').val(data.model_wear);
                $('#size_a1_kr').val(xssDecode(data.size_a1_kr));
                $('#size_a2_kr').val(xssDecode(data.size_a2_kr));
                $('#size_a3_kr').val(xssDecode(data.size_a3_kr));
                $('#size_a4_kr').val(xssDecode(data.size_a4_kr));
                $('#size_a5_kr').val(xssDecode(data.size_a5_kr));
                $('#size_onesize_kr').val(xssDecode(data.size_onesize_kr));
                $('#size_a1_en').val(xssDecode(data.size_a1_en));
                $('#size_a2_en').val(xssDecode(data.size_a2_en));
                $('#size_a3_en').val(xssDecode(data.size_a3_en));
                $('#size_a4_en').val(xssDecode(data.size_a4_en));
                $('#size_a5_en').val(xssDecode(data.size_a5_en));
                $('#size_onesize_en').val(xssDecode(data.size_onesize_en));
                $('#size_a1_cn').val(xssDecode(data.size_a1_cn));
                $('#size_a2_cn').val(xssDecode(data.size_a2_cn));
                $('#size_a3_cn').val(xssDecode(data.size_a3_cn));
                $('#size_a4_cn').val(xssDecode(data.size_a4_cn));
                $('#size_a5_cn').val(xssDecode(data.size_a5_cn));
                $('#size_onesize_cn').val(xssDecode(data.size_onesize_cn));
                $('#detail_kr').html(data.detail_kr);
                $('#detail_en').html(data.detail_en);
                $('#detail_cn').html(data.detail_cn);
                $('#care_kr').html(data.care_kr);
                $('#care_en').html(data.care_en);
                $('#care_cn').html(data.care_cn);

				if(data.size_category.length != 0){
					$('#size_category').val(data.size_category).prop("selected",true).change();
				}
				ordersheet_option = data.ordersheet_option;
            }
        }
    }).then(
		function(){
			var box_idx = $('#box_idx').val();
			if(box_idx > 0){
				$.ajax({
					type: "post",
					data: {'box_idx' : box_idx},
					dataType: "json",
					url: config.api + "pm/ordersheet/td/box/get",
					error: function() {
						alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
							if(d.data != null){
								box_info = d.data[0];
								$('#box_div').text(box_info.box_name);
								strTable = `
									<table>
										<thead>
											<tr>
												<th>상자명</th>
												<th>너비</th>
												<th>길이</th>
												<th>높이</th>
												<th>부피</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>${box_info.box_name}</td>
												<td>${box_info.box_width} cm</td>
												<td>${box_info.box_length} cm</td>
												<td>${box_info.box_height} cm</td>
												<td>${box_info.box_volume} cm³</td>
											</tr>
										</tbody>
									</table>
								`;
								$('#box_info_table').append(strTable);
							}
						}
					}
				});
			}
		}
	);
}

function productOptionCheck() {
	var search_type = $('#search_type').val();
	var search_keyword = $('#search_keyword').val();

	if (search_type != null && search_keyword != null) {
		getHistoryProductOption();
	} else {
		alert('옵션정보를 조회하기위해 검색유형과 검색값을 입력해주세요.');
		return false;
	}
}

function getHistoryProductOption() {
	var category_name 	= $('#sel_category_name').val();
	var search_type 	= $('#search_type').val();
	var search_keyword 	= $('#search_keyword').val();
	
	historyProductOptionReset();
	$.ajax({
		type: "post",
		data: {
			'category_name':category_name,
			'search_type':search_type,
			'search_keyword':search_keyword
		},
		dataType: "json",
		url: config.api + "product/option/get",
		error: function() {
			alert("옵션정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
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
						if (row.stock_grade == '0') {
							stock_type_common = "selected";
						} else {
							stock_type_important = "selected";
						}
						
						strDiv += '        <TD>';
						strDiv += '        		<div class="content__row">';
						strDiv += '            		<select class="fSelect" style="font-size:0.5rem;width:70px">';
						strDiv += '                		<option value="0" ' + stock_type_common + '>일반</option>';
						strDiv += '                		<option value="1" ' + stock_type_important + '>중요</option>';
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
			}
		}
	});
}

function historyOptionCheck(obj){
	var sel_history_info = $(obj).parents('tr').children();
	var option_name = sel_history_info.eq(3).text();
	var stock_grade = sel_history_info.eq(4).find('select').val();
	var column_cnt 	= sel_history_info.length - 4;

	var option_info = $('#option_input_table').find('tbody').children();
	var option_row_cnt = option_info.length;

	for(var i = 0; i < option_row_cnt; i++){
		if(option_info.eq(i).children().eq(1).text() == option_name){
			option_info.eq(i).find('select').val(stock_grade).prop("selected",true);
			for(var j = 0; j < column_cnt; j++){
				option_info.eq(i).find('input').eq(j+1).val(sel_history_info.eq(j+5).text());
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
	chk_list_arr.push(['size_onesize_kr','One','0']);
	chk_list_arr.push(['size_a1_kr','A1','1']);
	chk_list_arr.push(['size_a2_kr','A2','2']);
	chk_list_arr.push(['size_a3_kr','A3','3']);
	chk_list_arr.push(['size_a4_kr','A4','4']);
	chk_list_arr.push(['size_a5_kr','A5','5']);

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
	setOptionForm();
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
        var size_desc_str  = size_category_info['size_title_' + String(i)];

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
		
		if($('#' + textarea_id).val() != ''){
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
						<option value="0" selected>일반</option>
						<option value="1" >중요</option>
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
					<input type="number" name="option_size_${i}[]" value="" style="width:100px">cm
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
		$(obj).parent().parent().remove();
	});
}

function ordersheetDsnUpdate(flg) {
	care_kr.getById["care_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	care_en.getById["care_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	care_cn.getById["care_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	if(flg != undefined){
        $('input[name=overwrite_flg]').val(flg);
    }

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/ordersheet/dsn/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[DSN] 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품정보가 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/product/ordersheet';
				});
			}
			else{
                switch(d.code){
                    case 300:
                        confirm(d.msg,function() {
                            ordersheetDsnUpdate('true');
                        });
                        break;
                    case 301:
                        alert(d.msg);
                        break;
                }
            }
		}
	});
}
function updateFormReload(){
    location.reload();
}
function xssDecode(data){
	var decode_str = null;
    if(data != null){
        decode_str = data.replace(/&amp;/g, '&');
        decode_str = decode_str.replace(/&quot;/g, '\"');
        decode_str = decode_str.replace(/&apos;/g, "'");
        decode_str = decode_str.replace(/&lt;/g, '<');
        decode_str = decode_str.replace(/&gt;/g, '>');
        decode_str = decode_str.replace(/<br>/g, '\r');
        decode_str = decode_str.replace(/<p>/g, '\n');
    }
    return decode_str;
}
</script>