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
            <h3>독립몰 상품정보 수정</h3>
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

                <div class="drive--x"></div>
                <span>독립몰 상품 등록정보</span>
                <div class="table table__wrap">
					<div class="overflow-x-auto">
                        <TABLE>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%">스타일코드</TD>
                                    <TD style="width:23%">
                                        <span name="style_code">BLASSHD01</span>
                                    </TD>
                                    <TD style="width:10%">컬러코드</TD>
                                    <TD style="width:23%">
                                        <span name="color_code">BK</span>
                                    </TD>
                                    <TD style="width:10%">상품코드</TD>
                                    <TD style="width:23%">
                                        <span name="product_code">BLASSHD01BK</span>
                                    </TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <TABLE>
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">상품 이름</TD>
                                    <TD colspan="3" style="width:90%;">
                                        <input type="text" name="product_name" value="Trace Typhoon Air Pods Case" style="width:40%">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>MD 제품 카테고리</TD>
                                    <TD colspan="3">
										<div class="content__row">
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
                            </TBODY>
                        </TABLE>
                        <TABLE>
                            <colgroup>
                                <col width="10%">
                                <col width="23%">
                                <col width="10%">
                                <col width="23%">
                                <col width="10%">
                                <col width="23%">
                            </colgroup>
                            <TBODY>
                                <TR>
                                    <TD>한국몰 가격</TD>
                                    <TD><input id="price_kr" type="number" step="0.01" name="price_kr" value="0"></TD>
                                    <TD>한국몰 세일가격</TD>
                                    <TD><input id="sales_price_kr" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
                                    <TD>한국몰 할인율</TD>
                                    <TD><input id="discount_kr" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>
                                </TR>
                                <TR>
                                    <TD>영문몰 가격</TD>
                                    <TD><input id="price_en" type="number" step="0.01" name="price_en" value="0"></TD>
                                    <TD>영문몰 세일가격</TD>
                                    <TD><input id="sales_price_en" type="number" step="0.01" name="sales_price_en" value="0"></TD>
                                    <TD>영문몰 할인율</TD>
                                    <TD><input id="discount_en" type="number" step="0.01" name="discount_en" value="0" readonly></TD>
                                </TR>
                                <TR>
                                    <TD>중국몰 가격</TD>
                                    <TD><input id="price_cn" type="number" step="0.01" name="price_cn" value="0"></TD>
                                    <TD>중국몰 세일가격</TD>
                                    <TD><input id="sales_price_cn" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
                                    <TD>중국몰 할인율</TD>
                                    <TD><input id="discount_cn" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                        <TABLE class="list">
                            <TBODY>
                                <tr>
                                    <TD style="width:10%;">구매 멤버 제한</TD>
                                    <TD colspan="5" style="width:90%;">
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
                                    <TD style="width:10%;">구매 수량 제한</TD>
                                    <TD style="width:40%;">
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
                                    <TD style="width:10%;">구매 수량 제한 최소값</TD>
                                    <TD style="width:15%;"><input id="limit_purchase_qty_min" type="number" step="1" name="limit_purchase_qty_min" value="1"></TD>
                                    <TD style="width:10%;">구매 수량 제한 최대값</TD>
                                    <TD style="width:15%;"><input id="limit_purchase_qty_max" type="number" step="1" name="limit_purchase_qty_max" value="0"></TD>
                                </TR>
                                <TR>
                                    <TD>상품 검색어</TD>
                                    <TD colspan="5"><input type="text" name="product_keyword" value="" style="width:90%"></TD>
                                </TR>
                                <TR>
									<TD style="width:10%;">상품 태그</TD>
									<TD colspan="5">
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
                                    <TD colspan="5">
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
									<TD colspan="5">
										<div class="row">
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
									<TD colspan="5">
										<div id="relevant_list" class="row">
											관련상품 없음
										</div>
									</TD>
								</TR>
                                <TR>
                                    <TD style="width:10%">상품 재고<br>품절 임박 수량</TD>
                                    <TD style="width:23%">
                                        <input id="sold_out_qty" type="number" step="1" name="sold_out_qty" value="0">
                                    </TD>
                                    <TD style="width:10%">구매 전<br>환불정보 표시 플래그</TD>
                                    <TD colspan="3" style="width:23%">
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
                                        </div>
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>추가 교환/환불<br>상세정보 (한국몰)</TD>
                                    <TD colspan="5">
                                        <textarea class="width-100p" id="refund_kr" name="refund_kr"
                                            style="width:90%; height:150px;"></textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>추가 교환/환불<br>상세정보 (영문몰)</TD>
                                    <TD colspan="5">
                                        <textarea class="width-100p" id="refund_en" name="refund_en"
                                            style="width:90%; height:150px;"></textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>추가 교환/환불<br>상세정보 (중국몰)</TD>
                                    <TD colspan="5">
                                        <textarea class="width-100p" id="refund_cn" name="refund_cn"
                                            style="width:90%; height:150px;"></textarea>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>메모</TD>
                                    <TD colspan="5">
                                        <textarea class="width-100p" id="memo" name="memo"
                                            style="width:90%; height:150px;"></textarea>
                                    </TD>
                                </TR>
                            </TBODY>
                        </TABLE>

                        <TABLE id="insert_table_search_seo_info">
                            <TBODY>
                                <TR>
                                    <TD style="width:10%;">검색엔진<br>노출설정</TD>
                                        <TD>
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
                                        <TD>검색엔진<br>브라우저 타이틀</TD>
                                        <TD>
                                            <input type="text" name="seo_title" value="">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD>메타태그<br>Author</TD>
                                        <TD>
                                            <input type="text" name="seo_author" value="">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD>메타태그<br>Description</TD>
                                        <TD>
                                            <textarea class="width-100p" id="seo_description" name="seo_description"
                                                style="width:90%; height:150px;"></textarea>
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD>메타태그<br>Keyword</TD>
                                        <TD>
                                            <input type="text" name="seo_keywords" value="">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD>검색엔진<br>상품이미지<br>ALT 텍스트</TD>
                                        <TD>
                                            <textarea class="width-100p" id="seo_alt_text" name="seo_alt_text"
                                                style="width:90%; height:150px;"></textarea>
                                        </TD>
                                    </TR>
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
				onClick="confirm('상품을 등록하시겠습니까?.','independenceUpdate()');">독립몰 개별상품 등록</button>
		</div>
    </div>
</div>
<script>
var size_category_info = {};

var refund_kr       = [];
var refund_en       = [];
var refund_cn       = [];
var memo            = [];
var seo_description = [];
var seo_alt_text    = [];

function setSmartEditor() {
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
}

$(document).ready(function() {
    getProductCategory(0,0);
	setSmartEditor();
	productVolumeCalc();
	$('#insert_table_ordersheet').toggle();
	$('#insert_table_dsn').toggle();
    $('#insert_table_td').toggle();

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

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
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

function independenceUpdate() {
	material_kr.getById["material_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_en.getById["material_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_cn.getById["material_cn"].exec("UPDATE_CONTENTS_FIELD", []); 

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("독립몰 개별상품 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('독립몰 개별상품이 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/product/list_new';
				});
			}
            else{
                switch(d.code){
                    case 300:
                        alert(d.msg);
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