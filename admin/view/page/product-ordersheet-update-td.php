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
    .size_info_text {height:150px;}
    .smart_editer_text {height:180px;}
</style>

<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>개별상품수정 [TD]</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_td_tab" class="row regist_tab" style="margin-top:0px;">
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
                    <button type="button" toggle_table="dsn"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 디자인</button>
                    <div class="overflow-x-auto" id="insert_table_dsn">
                        <TABLE class="size_info_table">
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
                                    <TD colspan="10" id="wkla"></TD>
                                </TR>
                                <TR>
                                    <TD colspan="2">모델</TD>
                                    <TD colspan="4" id="model"></TD>
                                    <TD colspan="2">모델착용 사이즈</TD>
                                    <TD colspan="4" id="model_wear"></TD>
                                </TR>
                                <TR>
                                    <TD >A1한글</TD>
                                    <TD class="size_info_text" id="size_a1_kr"></TD>

                                    <TD>A2한글</TD>
                                    <TD class="size_info_text" id="size_a2_kr"></TD>

                                    <TD>A3한글</TD>
                                    <TD class="size_info_text" id="size_a3_kr"></TD>

                                    <TD>A4한글</TD>
                                    <TD class="size_info_text" id="size_a4_kr"></TD>

                                    <TD>A5한글</TD>
                                    <TD class="size_info_text" id="size_a5_kr"></TD>

                                    <TD>ONESIZE한글</TD>
                                    <TD class="size_info_text" id="size_onesize_kr"></TD>
                                </TR>

                                <TR>
                                    <TD>A1영문</TD>
                                    <TD class="size_info_text" id="size_a1_en"></TD>

                                    <TD>A2영문</TD>
                                    <TD class="size_info_text" id="size_a2_en"></TD>

                                    <TD>A3영문</TD>
                                    <TD class="size_info_text" id="size_a3_en"></TD>

                                    <TD>A4영문</TD>
                                    <TD class="size_info_text" id="size_a4_en"></TD>

                                    <TD>A5영문</TD>
                                    <TD class="size_info_text" id="size_a5_en"></TD>

                                    <TD>ONESIZE영문</TD>
                                    <TD class="size_info_text" id="size_onesize_en"></TD>
                                </TR>

                                <TR>
                                    <TD>A1중문</TD>
                                    <TD class="size_info_text" id="size_a1_cn"></TD>

                                    <TD>A2중문</TD>
                                    <TD class="size_info_text" id="size_a2_cn"></TD>

                                    <TD>A3중문</TD>
                                    <TD class="size_info_text" id="size_a3_cn"></TD>

                                    <TD>A4중문</TD>
                                    <TD class="size_info_text" id="size_a4_cn"></TD>

                                    <TD>A5중문</TD>
                                    <TD class="size_info_text" id="size_a5_cn"></TD>

                                    <TD>ONESIZE중문</TD>
                                    <TD class="size_info_text" id="size_onesize_cn"></TD>
                                </TR>
                                <TR>
                                    <TD colspan="2">
                                        사이즈 카테고리
                                    </TD>
                                    <TD colspan="10" id="size_category"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <div id="option_insert_div" style="margin-top:5px"></div>

                        <table style="margin-top:5px">
                            <thead id="product_size_table_head">
                            </thead>
                            <tbody id="product_size_regist_table">
                            </tbody>
                        </table>

                        <TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">Detail 한글</TD>
                                    <TD class="smart_editer_text" id="detail_kr"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">Detail 영문</TD>
                                    <TD class="smart_editer_text" id="detail_en"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">Detail 중문</TD>
                                    <TD class="smart_editer_text" id="detail_cn"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">유의사항 (한글)</TD>
                                    <TD class="smart_editer_text" id="care_kr"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">유의사항 (영문)</TD>
                                    <TD class="smart_editer_text" id="care_en"></TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">유의사항 (중문)</TD>
                                    <TD class="smart_editer_text" id="care_cn"></TD>
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
										<textarea class="width-100p" id="material_kr" name="material_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>재료 (영문)</TD>
									<TD>
										<textarea class="width-100p" id="material_en" name="material_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>재료 (영문)</TD>
									<TD>
										<textarea class="width-100p" id="material_cn" name="material_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						<TABLE style="margin-top:50px">
							<TBODY>
								<TR>
									<TD style="width:10%;">제조사</TD>
									<TD>
										<input type="text" id="manufacturer" name="manufacturer" value="">
									</TD>

									<TD style="width:10%;">공급사</TD>
									<TD>
										<input type="text" id="supplier" name="supplier" value="">
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">원산지</TD>
									<TD>
										<input type="text" id="origin_country" name="origin_country" value="">
									</TD>

									<TD style="width:10%;">브랜드</TD>
									<TD>
										<input type="text" id="brand" name="brand" value="">
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">트랜드</TD>
									<TD>
										<input type="text" id="trend" name="trend" value="">
									</TD>
								</TR>
                                <tr>
                                    <TD>상품 적재박스 유형</TD>
									<TD colspan="3">
                                        <div class="content__row" >
                                            <select id="box_idx" name="box_idx" class="fSelect eSearch" style="width:163px;">
                                                <option value="0">박스를 선택해주세요</option>
                                            </select>
                                            <button type="button" style="width:120px;height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;cursor:pointer;float:right;" onclick="openBoxInfoModal()">박스 정보</button>
                                        </div>
                                        <div id="box_info_table" style="margin-top:5px">
                                        </div>
									</TD>
                                </tr>
                                <tr>
                                    <TD>상품 적재중량 (kg)</TD>
									<TD colspan="3">
										<input id="product_weight" class="product_volume" type="number" step="0.01"
											name="product_weight" value="0">
									</TD>
                                </tr>
							</TBODY>
						</TABLE>
					</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
            <button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="confirm('상품을 등록하시겠습니까?.','ordersheetTdUpdate()');">개별상품[TD] 업데이트</button>
		</div>
    </div>
</div>
<script>
var size_category_info = {};

var material_kr = [];
var material_en = [];
var material_cn = [];

function setSmartEditor() {
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
}

$(document).ready(function() {
	setSmartEditor();
	productVolumeCalc();
	$('#insert_table_ordersheet').toggle();
	$('#insert_table_dsn').toggle();

    $('#box_idx').change(function() {	
		var box_idx = $('#box_idx option:checked').val();
        $('#box_info_table').html('');
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
	});
    urlParsing();
});

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");
		if(data_arr[0] == 'ordersheet_idx'){
			ordersheetTdGet(data_arr[1]);
		}
	}
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function ordersheetTdGet(idx) {
    $('input[name=ordersheet_idx]').val(idx);

    $.ajax({
        type: "post",
        dataType: "json",
        url: config.api + "pm/ordersheet/td/box/get",
        error: function() {
            alert("박스정보 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
                var data = d.data;
					
                if (data != null) {
                    var strDiv = "";
                    
                    data.forEach(function(row) {
                        strDiv += ` <option value="${row.box_idx}">${row.box_name}</option>`;
                    });
                    $('#box_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. 박스 정보를 다시 입력해주세요.');
                }
            }
        }
    }).then(
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

                    //디자인
                    $('#wkla').text(data.wkla);
                    $('#model').text(data.model);
                    $('#model_wear').text(data.model_wear);
                    $('#size_a1_kr').html(data.size_a1_kr);
                    $('#size_a2_kr').html(data.size_a2_kr);
                    $('#size_a3_kr').html(data.size_a3_kr);
                    $('#size_a4_kr').html(data.size_a4_kr);
                    $('#size_a5_kr').html(data.size_a5_kr);
                    $('#size_onesize_kr').html(data.size_onesize_kr);
                    $('#size_a1_en').html(data.size_a1_en);
                    $('#size_a2_en').html(data.size_a2_en);
                    $('#size_a3_en').html(data.size_a3_en);
                    $('#size_a4_en').html(data.size_a4_en);
                    $('#size_a5_en').html(data.size_a5_en);
                    $('#size_onesize_en').html(data.size_onesize_en);
                    $('#size_a1_cn').html(data.size_a1_cn);
                    $('#size_a2_cn').html(data.size_a2_cn);
                    $('#size_a3_cn').html(data.size_a3_cn);
                    $('#size_a4_cn').html(data.size_a4_cn);
                    $('#size_a5_cn').html(data.size_a5_cn);
                    $('#size_onesize_cn').html(data.size_onesize_cn);
                    $('#size_category').text(data.size_category);
                    $('#detail_kr').html(data.detail_kr);
                    $('#detail_en').html(data.detail_en);
                    $('#detail_cn').html(data.detail_cn);
                    $('#care_kr').html(data.care_kr);
                    $('#care_en').html(data.care_en);
                    $('#care_cn').html(data.care_cn);

                    if(data.ordersheet_option.length != 0){
                        colunm_name_size_1 = data.ordersheet_option[0].option_size_1_info.split('|')[0];
                        colunm_name_size_2 = data.ordersheet_option[0].option_size_2_info.split('|')[0];
                        colunm_name_size_3 = data.ordersheet_option[0].option_size_3_info.split('|')[0];
                        colunm_name_size_4 = data.ordersheet_option[0].option_size_4_info.split('|')[0];
                        colunm_name_size_5 = data.ordersheet_option[0].option_size_5_info.split('|')[0];
                        colunm_name_size_6 = data.ordersheet_option[0].option_size_6_info.split('|')[0];
                        strTh = `
                            <tr>
                                <th style="width:5%">옵션 이름</th>
                                <th style="width:8%">재고관리 등급</th>
                        `;
                        strTh += colunm_name_size_1.length > 0 ? `<th>${colunm_name_size_1}</th>` : '';
                        strTh += colunm_name_size_2.length > 0 ? `<th>${colunm_name_size_2}</th>` : '';
                        strTh += colunm_name_size_3.length > 0 ? `<th>${colunm_name_size_3.split('|')[0]}</th>` : '';
                        strTh += colunm_name_size_4.length > 0 ? `<th>${colunm_name_size_4}</th>` : '';
                        strTh += colunm_name_size_5.length > 0 ? `<th>${colunm_name_size_5}</th>` : '';
                        strTh += colunm_name_size_6.length > 0 ? `<th>${colunm_name_size_6}</th>` : '';

                        strTh += `
                            </tr>
                        `;
                        $('#product_size_table_head').append(strTh);

                        for(var i = 0; i < data.ordersheet_option.length; i++){
                            var row_data = data.ordersheet_option[i];

                            strTr = '';
                            strGrade = '';
                            switch(row_data.option_stock_grade){
                                case "0":
                                    strGrade = '일반재고';
                                    break;
                                case "1":
                                    strGrade = '중요재고';
                                    break;
                            }
                            var option_size_1 = row_data.option_size_1_info.split('|')[1];
                            var option_size_2 = row_data.option_size_2_info.split('|')[1];
                            var option_size_3 = row_data.option_size_3_info.split('|')[1];
                            var option_size_4 = row_data.option_size_4_info.split('|')[1];
                            var option_size_5 = row_data.option_size_5_info.split('|')[1];
                            var option_size_6 = row_data.option_size_6_info.split('|')[1];

                            strTrCol = ``;
                            strTrCol += option_size_1 != undefined ? `<td name="size_info_1[]">${option_size_1} cm</td>` : '';
                            strTrCol += option_size_2 != undefined ? `<td name="size_info_1[]">${option_size_2} cm</td>` : '';
                            strTrCol += option_size_3 != undefined ? `<td name="size_info_1[]">${option_size_3} cm</td>` : '';
                            strTrCol += option_size_4 != undefined ? `<td name="size_info_1[]">${option_size_4} cm</td>` : '';
                            strTrCol += option_size_5 != undefined ? `<td name="size_info_1[]">${option_size_5} cm</td>` : '';
                            strTrCol += option_size_6 != undefined ? `<td name="size_info_1[]">${option_size_6} cm</td>` : '';
                            
                            strTr += `
                                <tr>
                                    <td id="option_name">${row_data.option_name}</td>
                                    <td>
                                        <div class="content__row">
                                            <span id="stock_grade">${strGrade}</span>
                                        </div>
                                    </td>
                                    ${strTrCol}
                                </tr>
                            `;
                            $('#product_size_regist_table').append(strTr);
                        }
                    } 
                    
                    //생산
                    $('#material_kr').html(data.material_kr);
                    $('#material_en').html(data.material_en);
                    $('#material_cn').html(data.material_cn);
                    $('#manufacturer').val(data.manufacturer);
                    $('#supplier').val(data.supplier);
                    $('#origin_country').val(data.origin_country);
                    $('#brand').val(data.brand);
                    $('#trend').val(data.trend);
                    $('#box_idx option:contains("' + data.box_idx + '")').attr("selected","selected").change();
                    $('#product_weight').val(data.product_weight);
                }
            }
        }).then(
            function(){
                var size_category = $('#size_category').text();
                console.log('size_category: '+size_category);
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
                                    setOptionForm();
                                }
                            }
                        }
                    });
                }
            }
        )
    );
}
function setOptionForm(){
    var strDiv = "";
	var strThDiv = "";
    var category_name = size_category_info['category_name'];
	var img_path = '/images/sizeguide/sizecategory/'+category_name;

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
		}
	}
	strDiv +=	`		</table>
					</div>
				</div>
	`;
	$('#option_insert_div').append(strDiv);

	$('#size_desc_table tr').mouseover(function(){
        var category_name = size_category_info['category_name'];
	    var img_path = '/images/sizeguide/sizecategory/'+category_name;
		var tr_idx = $(this).attr('data-idx');
		img_path += `/${category_name}_${String.fromCharCode(parseInt(tr_idx) + 96)}.svg`;

        $('#size_desc_table td').css('text-decoration', 'none');
        $(this).find('td').css('text-decoration', 'underline');
		
		$('#size_img').attr('src', img_path);
    })
	$('#size_desc_table tr').mouseout(function(){
		var category_name = size_category_info['category_name'];
	    var img_path = '/images/sizeguide/sizecategory/'+category_name;
		var tr_idx = $(this).attr('data-idx');
		img_path += `/${category_name}.svg`;

        $('#size_desc_table td').css('text-decoration', 'none');
		
		$('#size_img').attr('src', img_path);
    })
}

function addBox(obj) {
	var box_idx = $('#box_idx').val();
	
	var obj_idx = $(obj).children().eq(0).attr('box_idx');
	var box_name = $(obj).children().eq(0).text();

    if(box_idx == obj_idx){
        alert('중복된 박스는 선택할 수 없습니다. 다른 박스를 선택해주세요.');
		return false;
    }
    $('#box_idx').val(obj_idx);
	
    $('#box_div').html('');
	var strDiv = "";
    strDiv += ` <div style="width:70px;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;cursor:pointer;float:left">
                    <font box_idx="${obj_idx}">${box_name}</font>
                    <font style="float:right;cursor:pointer;" onClick="removeBox();">x</font>
                </div>`;
    
    $('#box_div').append(strDiv);
}

function productVolumeCalc() {
	$('.product_volume').change(function() {
		var product_width = $('#product_width').val();
		var product_depth = $('#product_depth').val();
		var product_height = $('#product_height').val();
		
		if (product_width == "" || product_height == "" || product_depth == "") {
			$('#product_volume').val(0);
		} else if (product_width > 0 && product_depth > 0 && product_height > 0) {
			$('#product_volume').val(parseInt(product_width) * parseInt(product_depth) * parseInt(product_height));
		}
	})
}

function ordersheetTdUpdate(flg) {
	material_kr.getById["material_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_en.getById["material_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_cn.getById["material_cn"].exec("UPDATE_CONTENTS_FIELD", []); 

    if(flg != undefined){
        $('input[name=overwrite_flg]').val(flg);
    }

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/ordersheet/td/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[TD] 작성 처리에 실패했습니다.");
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
                            ordersheetTdUpdate('true');
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

function openBoxInfoModal() {
	modal('/box',null);
}
</script>