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
	.nomal_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
</style>

<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>개별상품수정 [MD]</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
                <input type="hidden" name="ordersheet_idx" value="">
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
                                    <TD colspan="10" id="wkla">Leather</TD>
                                </TR>
                                <TR>
                                    <TD colspan="2">모델</TD>
                                    <TD colspan="4" id="model">model name</TD>
                                    <TD colspan="2">모델착용 사이즈</TD>
                                    <TD colspan="4" id="model_wear">One Size</TD>
                                </TR>
                                <TR>
                                    <TD>A1한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a1_kr" name="size_a1_kr" disabled></textarea>
                                    </TD>

                                    <TD>A2한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a2_kr" name="size_a2_kr" disabled></textarea>
                                    </TD>

                                    <TD>A3한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a3_kr" name="size_a3_kr" disabled></textarea>
                                    </TD>

                                    <TD>A4한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a4_kr" name="size_a4_kr" disabled></textarea>
                                    </TD>

                                    <TD>A5한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a5_kr" name="size_a5_kr" disabled></textarea>
                                    </TD>

                                    <TD>ONESIZE한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_onesize_kr" name="size_onesize_kr" disabled>
    One size
    Length 26cm
    Width 6cm
    Height 16cm
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>A1영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a1_en" name="size_a1_en" disabled></textarea>
                                    </TD>

                                    <TD>A2영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a2_en" name="size_a2_en" disabled></textarea>
                                    </TD>
                                    
                                    <TD>A3영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a3_en" name="size_a3_en" disabled></textarea>
                                    </TD>

                                    <TD>A4영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a4_en" name="size_a4_en" disabled></textarea>
                                    </TD>

                                    <TD>A5영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a5_en" name="size_a5_en" disabled></textarea>
                                    </TD>

                                    <TD>ONESIZE영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_onesize_en" name="size_onesize_en" disabled>
    One size
    Length 26cm
    Width 6cm
    Height 16cm
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>A1중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a1_cn" name="size_a1_cn" disabled></textarea>
                                    </TD>

                                    <TD>A2중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a2_cn" name="size_a2_cn" disabled></textarea>
                                    </TD>

                                    <TD>A3중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a3_cn" name="size_a3_cn" disabled></textarea>
                                    </TD>

                                    <TD>A4중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a4_cn" name="size_a4_cn" disabled></textarea>
                                    </TD>
                                    <TD>A5중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_a5_cn" name="size_a5_cn" disabled></textarea>
                                    </TD>

                                    <TD>ONESIZE중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="size_onesize_cn" name="size_onesize_cn" disabled>
    One size
    Length 26cm
    Width 6cm
    Height 16cm
                                        </textarea>
                                    </TD>
                                </TR>
                                <TR>
                                    <TD colspan="2">
                                        사이즈 카테고리
                                    </TD>
                                    <TD colspan="10" id="size_category">dress</TD>
                                </TR>
                                <TR>
                                </TR>
                            </TBODY>
                        </TABLE>
                        
                        <div id="option_insert_div">
                            <div class="drive--x"></div>
                            <table id="option_input_table">
                                <thead>
                                    <tr>
                                        <th style="width:5%">옵션 이름</th>
                                        <th style="width:8%">재고관리 등급</th>
                                        
                                        <th style="width:12%">총장</th> 
                                    
                                        <th style="width:12%">가슴단면</th> 
                                    
                                        <th style="width:12%">어깨너비</th> 
                                    
                                        <th style="width:12%">목너비</th> 
                                    
                                        <th style="width:12%">소매장</th> 
                                    
                                        <th style="width:12%">소매입구</th> 
                                    
                                    </tr>
                                </thead>
                                <tbody id="product_size_regist_table">
                                    <tr>
                                        <td id="option_name">One</td>
                                        <td>
                                            <div class="content__row">
                                                <span id="stock_grade">일반</span>
                                            </div>
                                        </td>
                                        <td name="size_info_1[]">76 cm</td>
                                        <td name="size_info_2[]">38 cm</td>
                                        <td name="size_info_3[]">48 cm</td>
                                        <td name="size_info_4[]">18 cm</td>
                                        <td name="size_info_5[]">20 cm</td>
                                        <td name="size_info_6[]">10 cm</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <TABLE>
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">Detail 한글</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="detail_kr" name="detail_kr"
                                            style="width:90%; height:150px;" disabled>
        파이핑 디테일의 베이직 토트백
        테트리스 메탈 핀 디테일
        지그재그 메탈 핀 디테일
        탈부착 가능한 테트리스 체인
        리벳 디테일의 크로스 스트랩
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">Detail 영문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="detail_en" name="detail_en"
                                            style="width:90%; height:150px;" disabled>
        Piping detail
        Tetris metal pin detail
        Zigzag metal pin detail
        Detachable tetris chain
        Rivet detail strap
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">Detail 중문</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="detail_cn" name="detail_cn"
                                            style="width:90%; height:150px;" disabled>
        管道细节
        四边形金属销细节
        之字形金属销细节
        可分离四边形链
        铆钉装饰带
                                        </textarea>
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
                                        <textarea class="width-100p nomal_textarea" id="care_kr" name="care_kr"
                                            style="width:90%; height:150px;" disabled>
    1. 이 제품은 세탁이 불가합니다. 세탁하면 제품 형태가 변형되거나 손상될 수 있습니다.
    2. 부분적인 오염은 발생 즉시 닦아주십시오.
    3. 세탁이 필요할 경우 반드시 전문 세탁업체에 문의하십시오.
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">유의사항 (영문)</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="care_en" name="care_en"
                                            style="width:90%; height:150px;" disabled>
    DO NOT WASH
    DO NOT DRY CLEAN
    DO NOT TUMBLE DRY
    DO NOT BLEACH
                                        </textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD style="width:10%;">유의사항 (중문)</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="care_cn" name="care_cn"
                                            style="width:90%; height:150px;" disabled>
    切勿清洗
    切勿干洗
    切勿滚干
    切勿漂白
                                        </textarea>
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
                        <TABLE >
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD>재료 (한글)</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="material_kr" name="material_kr"
                                            style="width:90%; height:150px;" disabled>양가죽</textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="material_en" name="material_en"
                                            style="width:90%; height:150px;" disabled>Lamb skin</textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>재료 (영문)</TD>
                                    <TD>
                                        <textarea class="width-100p nomal_textarea" id="material_cn" name="material_cn"
                                            style="width:90%; height:150px;" disabled>羔皮</textarea>
                                    </TD>
                                </TR>
                            </TBODY>
                        <TABLE>
                        <TABLE>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">제조사</TD>
                                    <TD id="manufacturer">AA 생산공장</TD>
                                    <TD style="width:10%;">공급사</TD>
                                    <TD id="supplier">Ader error</TD>
                                </TR>
                                <TR>	
                                    <TD style="width:10%;">원산지</TD>
                                    <TD id="origin_country">한국</TD>
                                    <TD style="width:10%;">브랜드</TD>
                                    <TD id="brand">Ader</TD>
                                </TR>
                                <TR>
                                    <TD style="width:10%;">트랜드</TD>
                                    <TD id="trend">[trend]</TD>
                                    <TD>상품 적재박스 유형</TD>
                                    <TD id="box_idx"></TD>
                                </TR>
                                <TR>
                                    <TD>상품 적재중량</TD>
                                    <TD colspan="3" id="product_weight">1.4 kg</TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </div>
                </div>
            
                <div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
						style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
						onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
					<div class="overflow-x-auto" id="insert_table_ordersheet">
						<TABLE>
							<TBODY>
                                <TR>
                                    <TD style="width:10%;">스타일코드</TD>
                                    <TD id="style_code">BLASSTB02</TD>

                                    <TD style="width:10%;">컬러코드</TD>
                                    <TD id="color_code" style="width:10%;">BA</TD>

                                    <TD style="width:10%;">상품코드</TD>
                                    <TD id="product_code">BLASSTB02BA</TD>
                                </TR>
								<TR>
									<TD>프리오더 체크</TD>
									<TD colspan="5">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="false" checked>
												<div><div></div></div>
												<span>고객상품</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="preorder_flg" value="true">
												<div><div></div></div>
												<span>프리오더상품</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">오더시트 상품분류</TD>
									<TD colspan="5">
										<div>
											<input id="category_lrg" type="text" name="category_lrg" placeholder=""
												style="width:15%;" value="">
											<input id="category_mdl" type="text" name="category_mdl" placeholder=""
												style="width:15%;" value="">
											<input id="category_sml" type="text" name="category_sml" placeholder=""
												style="width:15%;" value="">
											<input id="category_dtl" type="text" name="category_dtl" placeholder=""
												style="width:15%;" value="">
										</div>
									</TD>
								</TR>
                                <TR>
									<TD>상품 그래픽</TD>
									<TD colspan="2">
                                        <input id="graphic" type="text" name="graphic" value="">
									</TD>
									<TD>상품 핏</TD>
									<TD colspan="2">
                                        <input id="fit" type="text" name="fit" value="">
									</TD>
								</TR>
                                <TR>
									<TD>소재</TD>
									<TD colspan="2">
                                    <input id="material" type="text" name="material" value="">
									</TD>
									<TD>네비게이션</TD>
									<TD colspan="2">
                                        <input type="text" name="navigation" value="">
									</TD>
								</TR>
								<TR>
									<TD>상품 이름</TD>
									<TD colspan="2">
										<input type="text" name="product_name" value="">
									</TD>
									<TD>상품 사이즈</TD>
									<TD colspan="2">
										<input type="text" id="product_size" name="size" value="">
									</TD>
								</TR>
								<TR>
									<TD>상품 컬러</TD>
									<TD colspan="2">
										<input id="color" type="text" name="color" value="">
									</TD>
									<TD>색상코드</TD>
									<TD colspan="2">
										<input id="color_rgb" type="text" name="color_rgb" value="">
									</TD>
								</TR>
                                <TR>
									<TD>구매 수량 제한</TD>
									<TD colspan="2">
										<input type="text" name="limit_qty" value="">
									</TD>
									<TD>구매 멤버 제한</TD>
									<TD colspan="2">
										<input type="text" name="limit_member" value="">
									</TD>
								</TR>
							</TBODY>
						</TABLE>
                        <div style="margin-top:5px;">
                            <div class="row form-group">
                                <button type="button"
                                    style="width:120px;height:30px;border:1px solid #000000;cursor:pointer;float:right;"
                                    onClick="$('#currency_table').toggle();">환율정보 조회</button>
                                <button type="button"
                                    style="width:80px;height:30px;border:1px solid #000000;cursor:pointer;margin-right:10px;float:right;"
                                    onClick="productPriceCalc();">계산</button>
                                <input id="calc_val" type="text"
                                    style="width:163px;height:30px;margin-right:10px;float:right;" placeholder="배율"
                                    value="1.4">
                            </div>

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
                                            <TD>
                                                <input id="price_kr" type="number" step="0.01" name="price_kr" value="">
                                            </TD>
                                            <TD>
                                                <input id="price_kr_gb" type="number" step="0.01" name="price_kr_gb"
                                                    value="">
                                            </TD>
                                            <TD>
                                                <input id="price_en" type="number" step="0.01" name="price_en" value="">
                                            </TD>
                                            <TD>
                                                <input id="price_cn" type="number" step="0.01" name="price_cn" value="">
                                            </TD>
                                        </TR>
                                    </TBODY>
                                </TABLE>
                            </div>
                            <TABLE>
                                <TBODY>
                                    <tr>
                                        <TD style="width:10%;">기획수량(총 수량)</TD>
                                        <TD colspan="2">
                                            <input id="product_qty" type="number" name="product_qty"
                                                    value="">
                                        </TD>
                                        <TD style="width:10%;">상품옵션-재고관리 등급</TD>
                                        <TD colspan="2">
                                            <input id="product_stock_grade" type="text" name="product_stock_grade"
                                                    value="">
                                        </TD>
                                    </tr>
                                    <TR>
                                        <TD style="width:10%;">적립금 사용</TD>
                                        <TD colspan="5">
                                            <div class="flex" style="gap: 10px;">
                                                <label class="rd__square">
                                                    <input id="mileage_flg_true" type="radio" name="mileage_flg" value="true"
                                                    checked>
                                                    <div><div></div></div>
                                                    <span>사용</span>
                                                </label>
                                                <label class="rd__square">
                                                    <input id="mileage_flg_false" type="radio" name="mileage_flg" value="false">
                                                    <div><div></div></div>
                                                    <span>사용안함</span>
                                                </label>
                                            </div>
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD style="width:10%;">단독구매 제한</TD>
                                        <TD colspan="5">
                                            <div class="flex" style="gap: 10px;">
                                                <label class="rd__square">
                                                    <input class="exclusive_flg" type="radio"
                                                        name="exclusive_flg" value="false" checked
                                                        onClick="exclusiveFlgClick(this);">
                                                    <div><div></div></div>
                                                    <span>단독구매 제한 없음</span>
                                                </label>
                                                <label class="rd__square">
                                                    <input class="exclusive_flg" type="radio"
                                                        name="exclusive_flg" value="true"
                                                        onClick="exclusiveFlgClick(this);">
                                                    <div><div></div></div>
                                                    <span>단독구매 제한</span>
                                                </label>
                                            </div>
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD style="width:10%;">런칭일자</TD>
                                        <TD colspan="5">
                                            <input id="launching_date" class="dateParam" type="date"
                                                name="launching_date" class="margin-bottom-6" placeholder="From" readonly
                                                style="width:150px;" value="">
                                        </TD>
                                    </TR>
                                </TBODY>
                            </TABLE>
                        </div>
					</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="confirm('상품을 수정하시겠습니까?.','ordersheetMdUpdate()');">개별상품 수정</button>
		</div>
    </div>
</div>
<script>

$(document).ready(function() {
	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});
	
    $('#insert_table_dsn').toggle();
	$('#insert_table_td').toggle();

	getCurrencyInfo();
	urlParsing();
});

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");

		if(data_arr[0] == 'ordersheet_idx'){
			ordersheetMdGet(data_arr[1]);
		}
	}
}
function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function ordersheetMdGet(idx) {
	$('input[name=ordersheet]').val(idx);
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
            }
        }
    });
}

function productDuplicateCheck() {
	var product_code = $('#product_code').val();
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
						alert('이미 수정된 상품코드입니다.');
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

function ordersheetMdUpdate() {
	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/ordersheet/md/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("개별상품[MD] 수정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 수정되었습니다.',function pageLocation() {
					location.href = '/product/ordersheet';
				});
			}
		}
	});
}

</script>