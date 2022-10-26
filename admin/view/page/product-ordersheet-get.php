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
            <h3>오더시트 개별 조회</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_td_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
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
                                    <TD class="smart_editer_text" id="material_kr"></TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD class="smart_editer_text" id="material_en"></TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD class="smart_editer_text" id="material_cn"></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <TABLE style="margin-top:5px">
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
                                <tr>
                                    <td>상품 적재박스 유형<input type="hidden" id="box_idx" value="0"></td>
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
            </form>
        </div>
		<div class="flex justify-center">
            <button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="location.href='/product/ordersheet">돌아가기</button>
		</div>
    </div>
</div>
<script>
var size_category_info = {};

$(document).ready(function() {
    
	urlParsing();
});

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");
		if(data_arr[0] == 'ordersheet_idx'){
			ordersheetGet(data_arr[1]);
		}
	}
}

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function ordersheetGet(idx) {
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
                $('#manufacturer').text(data.manufacturer);
                $('#supplier').text(data.supplier);
                $('#origin_country').text(data.origin_country);
                $('#brand').text(data.brand);
                $('#trend').text(data.trend);
                $('#box_idx').val(data.box_idx);
                $('#product_weight').text(data.product_weight);
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
	).then(
        function(){
            var size_category = $('#size_category').text();
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
</script>