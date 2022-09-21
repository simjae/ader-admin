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
</style>

<div class="content__card">
    <div class="card__header">
        <h3>개별상품등록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="delete_tab_01" class="row delete_tab" style="margin-top:0px;">
            <form id="frm-regist" action="product/add" enctype="multipart/form-data">
                <div class="table table__wrap">
                    <button type="button" toggle_table="ordersheet"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_ordersheet">
							<TBODY>
								<TR>
									<TD style="width:10%;">스타일코드</TD>
									<TD colspan="2">
										<input id="product_style_code" type="text" name="product_style_code" value="">
									</TD>

									<TD style="width:10%;">상품코드</TD>
									<TD colspan="2">
										<div >
											<input id="duplicate_check" type="hidden" value="false">
											<input id="product_code" type="text" name="product_code" style="width:70%;"
												value="">
											<button id="duplicate_btn" class="btn__gray" type="button"onClick="productDuplicateCheck();">상품코드 중복체크</button>
										</div>

									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">오더시트 상품분류</TD>
									<TD colspan="5">
										<div >
											<input id="pl_lrg_category" type="text" name="pl_lrg_category" placeholder=""
												style="width:15%;" value="">
											<input id="pl_mdl_category" type="text" name="pl_mdl_category" placeholder=""
												style="width:15%;" value="">
											<input id="pl_sml_category" type="text" name="pl_sml_category" placeholder=""
												style="width:15%;" value="">
											<input id="pl_dtl_category" type="text" name="pl_dtl_category" placeholder=""
												style="width:15%;" value="">
										</div>
									</TD>
								</TR>
					
								<TR>
									<TD style="width:10%;">온라인 MD 상품분류</TD>
									<TD colspan="5" style="width:90%;overflow:scroll;">
										<div class="flex"  style="width:1500px;height:300px;">
											<input type="hidden" name="md_category_1" value="">
											<input type="hidden" name="md_category_2" value="">
											<input type="hidden" name="md_category_3" value="">
											<input type="hidden" name="md_category_4" value="">
											<input type="hidden" name="md_category_5" value="">
											<input type="hidden" name="md_category_6" value="">

											<input type="hidden" name="category_idx" value="">

											<div id="md_category_1" depth="1" style="width:200px;height:100%;">

											</div>

											<div id="md_category_2" depth="2" style="width:200px;height:100%;">

											</div>

											<div id="md_category_3" depth="3" style="width:200px;height:100%;">

											</div>

											<div id="md_category_4" depth="4" style="width:200px;height:100%;">

											</div>

											<div id="md_category_5" depth="5" style="width:200px;height:100%;">

											</div>

											<div id="md_category_6" depth="6" style="width:200px;height:100%;">

											</div>
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">소재</TD>
									<TD>
										<input id="material" type="text" name="material" value="">
									</TD>

									<TD style="width:10%;">상품 그래픽</TD>
									<TD>
										<input id="graphic" type="text" name="graphic" value="">
									</TD>

									<TD style="width:10%;">상품 핏</TD>
									<TD>
										<input id="fit" type="text" name="fit" value="">
									</TD>
								</TR>

								<TR>
									<TD>상품 이름</TD>
									<TD colspan="2">
										<input type="text" name="product_name" value="">
									</TD>
									<TD>상품 사이즈</TD>
									<TD colspan="2">
										<input type="text" id="size" name="size" value="One Size">
									</TD>
								</TR>

								<TR>
									<TD>상품 컬러</TD>
									<TD colspan="2">
										<input id="color" type="text" name="color" value="">
									</TD>
									<TD>컬러코드</TD>
									<TD colspan="2">
										<input id="color_code" type="text" name="color_code" value="">
									</TD>
								</TR>

								<TR>
									<TD>네비게이션</TD>
									<TD colspan="2">
										<input type="text" name="navigation" value="">
									</TD>
									<TD>구매제한</TD>
									<TD colspan="2">
										<input type="text" name="limit_purchase_member_ext" value="">
									</TD>
								</TR>

								<TR>
									<TD>기획수량</TD>
									<TD colspan="2">
										<input type="text" name="pl_qty" step="0.01" value="0">
									</TD>
									<TD>프리오더 체크</TD>
									<TD colspan="2">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input type="radio" name="pre_order_flg" value="false" checked>
												<div><div></div></div>
												<span>고객상품</span>
											</label>
											<label class="rd__square">
												<input type="radio" name="pre_order_flg" value="true">
												<div><div></div></div>
												<span>프리오더상품</span>
											</label>
										</div>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="material"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">W/K/L/A & Material</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_material">
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TD>W/K/L/A</TD>
									<TD>
										<input id="wkla" type="text" name="wkla" value="">
									</TD>
								</TR>

								<TR>
									<TD>Material 한글</TD>
									<TD>
										<textarea class="width-100p" id="material_kr" name="material_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>Material 영문</TD>
									<TD>
										<textarea class="width-100p" id="material_en" name="material_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>Material 중문</TD>
									<TD>
										<textarea class="width-100p" id="material_cn" name="material_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						<TABLE>
					</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="size_detail"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">Size Detail</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_size_detail">
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
										<textarea class="width-100p" id="size_detail_a1_kr" name="size_detail_a1_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A2한글</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a2_kr" name="size_detail_a2_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A3한글</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a3_kr" name="size_detail_a3_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A4한글</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a4_kr" name="size_detail_a4_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A5한글</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a5_kr" name="size_detail_a5_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>ONESIZE한글</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_onesize_kr"
											name="size_detail_onesize_kr" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A1영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a1_en" name="size_detail_a1_en"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A2영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a2_en" name="size_detail_a2_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A3영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a3_en" name="size_detail_a3_en"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A4영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a4_en" name="size_detail_a4_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A5영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a5_en" name="size_detail_a5_en"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>ONESIZE영문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_onesize_en"
											name="size_detail_onesize_en" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A1중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a1_cn" name="size_detail_a1_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A2중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a2_cn" name="size_detail_a2_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A3중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a3_cn" name="size_detail_a3_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>A4중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a4_cn" name="size_detail_a4_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD>A5중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_a5_cn" name="size_detail_a5_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>

									<TD>ONESIZE중문</TD>
									<TD>
										<textarea class="width-100p" id="size_detail_onesize_cn"
											name="size_detail_onesize_cn" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TD ID = "option_btn_td" colspan="4">
										<button type="button"
											style="width:100px;height:30px;background-color:#140f82;color:#ffffff;float:right;cursor:pointer;"
											onClick="productOptionRegister();">옵션 저장</button>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="detail"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">Detail</button>
					<div class="overflow-x-auto">
                    	<TABLE id="insert_table_detail">
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
					</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="care"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">Care</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_care">
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TD style="width:10%;">Care 한글</TD>
									<TD>
										<textarea class="width-100p" id="care_kr" name="care_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">Care 영문</TD>
									<TD>
										<textarea class="width-100p" id="care_en" name="care_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">Care 중문</TD>
									<TD>
										<textarea class="width-100p" id="care_cn" name="care_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="price"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">Price</button>

                    <div id="insert_table_price"  style="margin-top:5px;">
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
                                            <input id="price_kr" type="number" step="0.01" name="price_kr" value="0">
                                        </TD>
                                        <TD>
                                            <input id="price_kr_gb" type="number" step="0.01" name="price_kr_gb"
                                                value="0">
                                        </TD>
                                        <TD>
                                            <input id="price_en" type="number" step="0.01" name="price_en" value="0">
                                        </TD>
                                        <TD>
                                            <input id="price_cn" type="number" step="0.01" name="price_cn" value="0">
                                        </TD>
                                    </TR>
                                </TBODY>
                            </TABLE>
                        </div>
                    </div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="sales_info"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">판매정보</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_sales_info">
							<TBODY>
								<TR>
									<TD style="width:10%;">한국몰 판매가격</TD>
									<TD>
										<input id="sales_price_kr" type="number" step="0.01" name="sales_price_kr"
											value="0">
									</TD>

									<TD style="width:10%;">영문몰 판매가격</TD>
									<TD>
										<input id="sales_price_en" type="number" step="0.01" name="sales_price_en"
											value="0">
									</TD>

									<TD style="width:10%;">중문몰 판매가격</TD>
									<TD>
										<input id="sales_price_cn" type="number" step="0.01" name="sales_price_cn"
											value="0">
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">
										이미 등록한 옵션정보 불러오기
									</TD>
									<TD colspan="5" id="history_option_td">
										<div class="content__row">
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
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">
										옵션정보설정
										<input id="option_stock_set" type="hidden" name="option_stock_set" value="0">
										<input id="option_code_list" type="hidden" value="">
									</TD>
									<TD id="option_td" colspan="5">
										옵션정보를 등록해주세요.
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">구매멤버 제한</TD>
									<TD colspan="5">
										<div class="flex" style="gap:10px">
											<label class="cb__wh">
												<input id="limit_purchase_member_all" class="limit_purchase_member"
													type="checkbox" name="limit_purchase_member[]" value="0"
													onClick="limitPurchaseMemberClick(this);" checked>
												<div class="on"></div>
												<span>전체</span>
											</label>

											<label class="cb__wh">
												<input id="limit_purchase_member_1" class="limit_purchase_member"
													type="checkbox" name="limit_purchase_member[]" value="1"
													onClick="limitPurchaseMemberClick(this);">
												<div class="on"></div>
												<span>ADER family</span>
											</label>

											<label class="cb__wh">
												<input id="limit_purchase_member_2" class="limit_purchase_member"
													type="checkbox" name="limit_purchase_member[]" value="2"
													onClick="limitPurchaseMemberClick(this);">
												<div class="on"></div>
												<span>일반회원</span>
											</label>
										</div>
									</TD>
								</TR>

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
												<input class="limit_purchase_single" type="radio"
													name="limit_purchase_single_input" value="false" checked
													onClick="limitPurchaseSingleFlgClick(this);">
												<div><div></div></div>
												<span>단독구매 제한 없음</span>
											</label>
											<label class="rd__square">
												<input class="limit_purchase_single" type="radio"
													name="limit_purchase_single_input" value="true"
													onClick="limitPurchaseSingleFlgClick(this);">
												<div><div></div></div>
												<span>단독구매 제한</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">구매수량 제한</TD>
									<TD colspan="5">
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty"
													value="false" onClick="limitPurchaseQtyFlgClick(this);" checked>
												<div><div></div></div>
												<span>구매수량 제한 없음</span>
											</label>
											<label class="rd__square">
												<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty"
													value="true" onClick="limitPurchaseQtyFlgClick(this);">
												<div><div></div></div>
												<span>구매수량 제한</span>
											</label>
										</div>


										<div id="limit_purchase_qty_input" 
											style="display:none;margin-top:10px;">
											<input type="number" step="0" name="limit_purchase_qty_min_num"
												style="width:163px;" value="0">
											~
											<input type="number" step="0" name="limit_purchase_qty_max_num"
												style="width:163px;" value="0">
											<br>
											<font style="margin-top:5px;">*구매제한수량의 최대값이 없을 경우 0을 입력해 주세요.</font>
										</div>
									</TD>
								</TR>

								<TR>
									<TD colspan="6">
										<TABLE style="font-size:0.5rem;">
											<THEAD>
												<TR>
													<TH style="width:10%;">상품유형 선택</TH>
													<TH>
														<div class="content__row">
															<input type="hidden" name="refund_idx" value="">
															<select id="refund_category" class="fSelect eSearch"
																name="refund_category" style="width:163px;">
															</select>

															<button type="button"
																style="width:120px;height:30px;cursor:pointer;"
																onClick="getRefundInfo();">환불정보 조회</button>
														</div>
													</TH>
												</TR>
											</THEAD>
											<TBODY id="refund_body">

											</TBODY>
										</TABLE>
									</TD>
								</TR>

								<TR>
									<TD colspan="6">
										<div>
											<input type="text" name="refund_category" style="width:163px;margin-right:10px;"
												value="">
											<input type="text" name="refund_title" style="width:450px;" value="">
											<button type="button"
												style="width:50px;height:30px;background-color:#000000;color:#ffffff;float:right;cursor:pointer;"
												onClick="addRefundInfo();">등록</button>
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">한국몰 추가 상세 정보<br>(교환/환불)</TD>
									<TD colspan="5">
										<textarea class="width-100p" id="detail_refund_kr" name="detail_refund_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">영문몰 추가 상세 정보<br>(교환/환불)</TD>
									<TD colspan="5">
										<textarea class="width-100p" id="detail_refund_en" name="detail_refund_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">중문몰 추가 상세 정보<br>(교환/환불)</TD>
									<TD colspan="5">
										<textarea class="width-100p" id="detail_refund_cn" name="detail_refund_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 태그</TD>
									<TD colspan="5">
										<div >
											<input id="product_tag" type="text" value="" style="width:70%;">
											<button
												style="border:1px solid #000000;background-color:#ffffff;color:#000000;width:80px;height:30px;font-size:0.5rem;cursor:pointer;"
												onClick="addProductTagBtnClick();">추가</button>
											<button
												style="background-color:#000000;color:#ffffff;width:150px;height:30px;font-size:0.5rem;cursor:pointer;"
												onClick="confirm('상품태그를 불러올 경우 기존에 추가한 상품태그는 초기화됩니다.','getProductTag()');">상품태그
												불러오기</button>
										</div>
										<div  id="product_tag_div">
										</div>
									</TD>
								</TR>

								<TR>
									<TD>관련상품 검색</TD>
									<TD colspan="5">
										<di class="content__row">
											<input id="relevant_idx" type="hidden" name="relevant_idx" value="0">

											<select id="relevant_type" class="fSelect eSearch" name="product_category"
												style="width:163px;">
												<option value="product_name">상품 이름</option>
												<option value="product_code">상품 코드</option>
												<option value="product_category">상품 카테고리</option>
											</select>

											<input id="relevant_keyword" type="text" style="width:300px;" value="">

											<button type="button"
												style="width:100px;height:38px;float:right;cursor:pointer;border:1px solid #000000;"
												onClick="getRelevantProduct();">관련상품 검색</button>

											<div id="relevant_product_div" ></div>
										</di>
									</TD>
								</TR>

								<TR>
									<TD>관련상품</TD>
									<TD colspan="5">
										<div id="relevant_list" >
											관련상품 없음
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 이미지<br>아웃핏</TD>
									<TD colspan="5">
										<div class="form-group">
											<span class="btn btn-large blue">
												<i class="xi-image"></i> 상품 이미지 선택
												<input class="product_img" id="img_outfit" type="file" name="img_outfit"
													class="input-image">
											</span><br>
											<img class="preview img_outfit" src="" style="display:none;">
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 이미지<br>상품</TD>
									<TD colspan="5">
										<div class="form-group">
											<span class="btn btn-large blue">
												<i class="xi-image"></i> 상품 이미지 선택
												<input class="product_img" id="img_product" type="file" name="img_product"
													class="input-image">
											</span><br>
											<img class="preview img_product" src="" style="display:none;">
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 이미지<br>착장</TD>
									<TD colspan="5">
										<div class="form-group">
											<span class="btn btn-large blue">
												<i class="xi-image"></i> 상품 이미지 선택
												<input class="product_img" id="img_wear" type="file" name="img_wear"
													class="input-image">
											</span><br>
											<img class="preview img_wear" src="" style="display:none;">
										</div>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 이미지<br>상품상세</TD>
									<TD colspan="5">
										<textarea class="width-100p" id="img_product_detail" name="img_product_detail"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">상품 이미지<br>착장상세</TD>
									<TD colspan="5">
										<textarea class="width-100p" id="img_wear_detail" name="img_wear_detail"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
                	</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="deliver_info"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">배송정보</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_deliver_info">
							<TBODY>
								<TR>
									<TD style="width:10%;">HS코드</TD>
									<TD>
										<input type="text" name="hs_code" value="">
									</TD>
									<TD style="width:10%;">상품 전체 중량</TD>
									<TD>
										<input type="text" name="product_total_weight" value="">
									</TD>
									<TD style="width:10%;">상품 구분(해외통관)</TD>
									<TD>
										<input type="text" name="product_division" value="">
									</TD>
								</TR>
								<TR>
									<TD style="width:10%;">상품소재</TD>
									<TD>
										<input type="text" name="product_material_kr" value="">
									</TD>
									<TD style="width:10%;">영문 상품소재</TD>
									<TD>
										<input type="text" name="product_material_en" value="">
									</TD>
									<TD style="width:10%;">옷감</TD>
									<TD>
										<input type="text" name="fabric" value="">
									</TD>
								</TR>
							</TBODY>
						</TABLE>
                	</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="manufacture_info"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">제작정보</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_manufacture_info">
							<TBODY>
								<TR>
									<TD style="width:10%;">제조사</TD>
									<TD colspan="3">
										<input type="text" name="manufacturer" value="">
									</TD>

									<TD style="width:10%;">공급사</TD>
									<TD colspan="3">
										<input type="text" name="supplier" value="">
									</TD>

									<TD style="width:10%;">원산지</TD>
									<TD colspan="3">
										<input type="text" name="origin_country" value="">
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">브랜드</TD>
									<TD colspan="3">
										<input type="text" name="brand" value="">
									</TD>

									<TD style="width:10%;">트랜드</TD>
									<TD colspan="3">
										<input type="text" name="trend" value="">
									</TD>

									<TD style="width:10%;">자체분류</TD>
									<TD colspan="3">
										<input type="text" name="self_classification" value="">
									</TD>
								</TR>

								<TR>
									<TD style="width:10%;">제조일자</TD>
									<TD colspan="3">
										<input id="manufacturing_date" class="dateParam" type="date"
											name="manufacturing_date" class="margin-bottom-6" placeholder="From" readonly
											style="width:150px;">
									</TD>

									<TD style="width:10%;">출시일자</TD>
									<TD colspan="3">
										<input id="release_date" class="dateParam" type="date" name="release_date"
											class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									</TD>

									<TD style="width:10%;">유효기간</TD>
									<TD colspan="3">
										<div >
											<input id="validate_start_date" class="dateParam" type="date"
												name="validate_start_date" class="margin-bottom-6" placeholder="From"
												readonly style="width:150px;">
											<input id="validate_end_date" class="dateParam" type="date"
												name="validate_end_date" class="margin-bottom-6" placeholder="From" readonly
												style="width:150px;">
										</div>
									</TD>
								</TR>

								<TR>
									<TD>상품 가로길이</TD>
									<TD colspan="2">
										<input id="product_width" class="product_volume" type="number" step="0.01"
											name="product_width" value="0">
									</TD>

									<TD>상품 세로길이</TD>
									<TD colspan="2">
										<input id="product_depth" class="product_volume" type="number" step="0.01"
											name="product_depth" value="0">
									</TD>

									<TD>상품 높이</TD>
									<TD colspan="2">
										<input id="product_height" class="product_volume" type="number" step="0.01"
											name="product_height" value="0">
									</TD>

									<TD>상품 부피</TD>
									<TD colspan="2">
										<input id="product_volume" type="text" name="product_volume" value="0" readonly>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
                	</div>
                </div>

                <div class="table table__wrap">
                    <button type="button" toggle_table="search_seo_info"
                        style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
                        onClick="toggleTableClick(this);">검색엔진 최적화 SEO</button>
					<div class="overflow-x-auto">
						<TABLE id="insert_table_search_seo_info">
							<TBODY>
								<TR>
									<TD style="width:10%;">검색엔진<br>노출설정</TD>
									<TD>
										<div class="flex" style="gap: 10px;">
											<label class="rd__square">
												<input id="seo_exposure_flg" type="hidden" name="seo_exposure_flg" value="true">
												<div><div></div></div>
												<span>노출함</span>
											</label>
											<label class="rd__square">
											<input class="seo_exposure_flg" type="radio" name="seo_exposure_flg_input" value="false" onClick="seoExposureFlgClick(this);">
												<div><div></div></div>
												<span>노출안함</span>
											</label>
										</div>
									</TD>

								<TR>
									<TD>브라우저<br>타이틀</TD>
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
								</TR>
							</TBODY>
						</TABLE>	
                	</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;"
				onClick="confirm('상품을 등록하시겠습니까?.','productRegister()');">개별상품 등록</button>
		</div>
    </div>
</div>
<script>
var material_kr = [];
var material_en = [];
var material_cn = [];

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

var care_kr = [];
var care_en = [];
var care_cn = [];

var detail_kr = [];
var detail_en = [];
var detail_cn = [];

var detail_refund_kr = [];
var detail_refund_en = [];
var detail_refund_cn = [];

var img_product_detail = [];
var img_wear_detail = [];

var seo_description = [];

var size_category_info = {};

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
	
	//size_detail_kr
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_kr,
		elPlaceHolder: "size_detail_a1_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_kr,
		elPlaceHolder: "size_detail_a2_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_kr,
		elPlaceHolder: "size_detail_a3_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_kr,
		elPlaceHolder: "size_detail_a4_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_kr,
		elPlaceHolder: "size_detail_a5_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_kr,
		elPlaceHolder: "size_detail_onesize_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//size_detail_en
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_en,
		elPlaceHolder: "size_detail_a1_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_en,
		elPlaceHolder: "size_detail_a2_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_en,
		elPlaceHolder: "size_detail_a3_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_en,
		elPlaceHolder: "size_detail_a4_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_en,
		elPlaceHolder: "size_detail_a5_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_en,
		elPlaceHolder: "size_detail_onesize_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//size_detail_cn
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_cn,
		elPlaceHolder: "size_detail_a1_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_cn,
		elPlaceHolder: "size_detail_a2_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_cn,
		elPlaceHolder: "size_detail_a3_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_cn,
		elPlaceHolder: "size_detail_a4_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_cn,
		elPlaceHolder: "size_detail_a5_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_cn,
		elPlaceHolder: "size_detail_onesize_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
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
	
	//detail_refund
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_kr,
		elPlaceHolder: "detail_refund_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_en,
		elPlaceHolder: "detail_refund_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_cn,
		elPlaceHolder: "detail_refund_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//img
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: img_product_detail,
		elPlaceHolder: "img_product_detail",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: img_wear_detail,
		elPlaceHolder: "img_wear_detail",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//search_engine_seo
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_description,
		elPlaceHolder: "seo_description",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
}

$(document).ready(function() {
	$('#product_code').change(function() {
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('상품코드 중복체크');
	});
	
	$('.product_img').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('이미지 파일만 등록 가능합니다. (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			var file = $(this).prop("files")[0];
			
			var img_id = $(this).attr('id');
			
			blobURL = window.URL.createObjectURL(file);
			$('.' + img_id).show();
			$('.' + img_id).attr('src', blobURL);
			$('.' + img_id).slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
	
	setSmartEditor();
	getCurrencyInfo();
	getProductCategory(0,0);
	getRefundCategory();
	productVolumeCalc();
});

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
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
			url: config.api + "product/check",
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

function getCurrencyInfo() {
	$.ajax({
		type: "post",
		dataType: "json",
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

function limitPurchaseSingleFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#limit_purchase_single').val(flg_val);
}

function limitPurchaseQtyFlgClick(obj) {
	var flg_val = $(obj).val();
	
	if (flg_val == 'true') {
		$('#limit_purchase_qty_input').show();
		$("input[name='limit_purchase_qty_min_num']").val(1);
		$("input[name='limit_purchase_qty_max_num']").val(99);
	} else {
		$('#limit_purchase_qty_input').hide();
		$("input[name='limit_purchase_qty_min_num']").val(0);
		$("input[name='limit_purchase_qty_max_num']").val(0);
	}
}

function seoExposureFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#seo_exposure_flg').val(flg_val);
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
			alert('MD 카테고리 정보를 불러오는데 실패했습니다.')
		},
		success: function(d) {
			if(d.code == 200) {
				setMdCategory(depth,d.data);
			}
		}
	});
}

function productCategoryClick(obj) {
	var depth = parseInt($(obj).parent().attr('depth'));
	var no = $(obj).attr('category_idx');
	
	for (var i=depth; i<=6; i++) {
		$('#md_category_' + i).children('.md_category').css('background-color','#ffffff');
		$('#md_category_' + i).children('.md_category').css('color','#000000');
		$('#md_category_' + i).children('.md_category').removeClass('checked');
		$('#md_category_' + i).children('.md_category').addClass('unchecked');
	}
	
	$(obj).removeClass('unchecked');
	$(obj).addClass('checked');
	
	var category_idx = $('#md_category_' + depth).children('.checked').attr('category_idx');
	
	$("input[name='md_category_" + depth + "']").val(category_idx);
	$("input[name='category_idx']").val(category_idx);
	
	for (var i=(depth+1); i<=6; i++) {
		$("input[name='md_category_" + i + "']").val(0);
	}
	
	getProductCategory(depth,no);
}

function setMdCategory(depth,d){
	var eCategory = $('#md_category_' + depth);
	eCategory.empty();
	
	for (var i=(depth+1); i<=6; i++) {
		$('#md_category_' + i).empty();
	}
	
	var category_idx = $("input[name='md_category_" + depth + "']").val();
	
	if (d != null) {
		d.forEach(function(row) {
			var checked = "";
			if (category_idx == row.no) {
				checked = "checked";
			} else {
				checked = "unchecked";
			}
			
			eCategory.append($('<div id="md_category_idx_' + row.no + '" class="md_category ' + checked + '" category_idx="' + row.no + '" style="width:100%;height:50px;border:1px solid #000000;cursor:pointer;" onClick="productCategoryClick(this);">' + row.text + '</div>'));
		});
	}	
}

function productOptionRegister(obj) {
	var duplicate_check = $('#duplicate_check').val();
	var product_code = $('#product_code').val();
	
	if (product_code != null && duplicate_check != "false") {
		size_detail_a1_kr.getById["size_detail_a1_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a1_en.getById["size_detail_a1_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a1_cn.getById["size_detail_a1_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		size_detail_a2_kr.getById["size_detail_a2_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a2_en.getById["size_detail_a2_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a2_cn.getById["size_detail_a2_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		size_detail_a3_kr.getById["size_detail_a3_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a3_en.getById["size_detail_a3_en"].exec("UPDATE_CONTENTS_FIELD", []);
		size_detail_a3_cn.getById["size_detail_a3_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		size_detail_a4_kr.getById["size_detail_a4_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a4_en.getById["size_detail_a4_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a4_cn.getById["size_detail_a4_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		size_detail_a5_kr.getById["size_detail_a5_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_a5_en.getById["size_detail_a5_en"].exec("UPDATE_CONTENTS_FIELD", []);		
		size_detail_a5_cn.getById["size_detail_a5_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		size_detail_onesize_kr.getById["size_detail_onesize_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_onesize_en.getById["size_detail_onesize_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		size_detail_onesize_cn.getById["size_detail_onesize_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		var formData = new FormData();
		formData = $("#frm-regist").serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "product/option/add",
			error: function() {
				alert("상품옵션 등록 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("상품옵션 등록 처리에 성공했습니다.");
					getProductOption();
				}
			}
		});
	} else {
		alert('옵션코드 등록을 위해 상품코드를 입력/중복체크가 필요합니다.');
		return false;
	}
}

function productOptionCheck() {
	var search_type = $('#search_type').val();
	var search_keyword = $('#search_keyword').val();
	
	var option_cnt = $('#option_info_table').length;
	if (search_type != null && search_keyword != null) {
		getHistoryProductOption();
	} else {
		alert('옵션정보를 조회하기위해 검색유형과 검색값을 입력해주세요.');
		return false;
	}
}

function getHistoryProductOption() {
	var search_type = $('#search_type').val();
	var search_keyword = $('#search_keyword').val();
	
	$.ajax({
		type: "post",
		data: {
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
					$('#history_option_info_table').remove();
					
					var strDiv = "";
					strDiv += '<TABLE id="history_option_info_table"  style="font-size:0.5rem;margin-top:10px;">';
					strDiv += '    <THEAD>';
					strDiv += '        <TR>';
					strDiv += '            <TH style="width:7%;"></TH>';
					strDiv += '            <TH>상품코드</TH>';
					strDiv += '            <TH style="width:15%;">상품이름</TH>';
					strDiv += '            <TH style="width:15%;">옵션코드</TH>';
					strDiv += '            <TH style="width:10%;">옵션이름</TH>';
					strDiv += '            <TH style="width:10%;">재고관리 사용유무</TH>';
					strDiv += '            <TH style="width:10%;">재고관리 등급</TH>';
					strDiv += '            <TH style="width:10%;">수량체크 기준</TH>';
					strDiv += '            <TH style="width:10%;">품절표시</TH>';
					strDiv += '        </TR>';
					strDiv += '    </THEAD>';
					strDiv += '    <TBODY>';
					
					data.forEach(function(row) {
						strDiv += '    <TR id="option_row_' + row.no + '">';
						strDiv += '        <TD>';
						strDiv += '            <button option_code="' + row.option_code + '" style="width:50px;height:30px;background-color:#140f82;color:#ffffff;cursor:pointer;font-size:0.5rem;" onClick="historyOptionCheck(this);">적용</button>';
						strDiv += '        </TD>';
						strDiv += '        <TD>' + row.product_code + '</TD>';
						strDiv += '        <TD>' + row.product_name + '</TD>';
						strDiv += '        <TD>' + row.option_code + '</TD>';
						strDiv += '        <TD>' + row.option_name + '</TD>';
						
						strDiv += '        <TD>';
						
						if (row.stock_management != null) {
							var checked_true = null;
							var checked_false = null;
							if (row.stock_management == true) {
								checked_true = "checked";
							} else {
								checked_false = "checked";
							}
							strDiv += '    <div class="flex" style="gap: 10px;">';
							strDiv += '        <label class="rd__square">';
							strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="true" ' + checked_true + '>';
							strDiv += '            <div><div></div></div>';
							strDiv += '            <span>사용</span>';
							strDiv += '        </label>';
							strDiv += '        <label class="rd__square">';
							strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="false" ' + checked_false + '>';
                            strDiv += '            <div><div></div></div>';
							strDiv += '            <span>미사용</span>';
							strDiv += '        </label>';
							strDiv += '    </div>';
						}
						
						strDiv += '        </TD>';
						
						var stock_type_a = "";
						var stock_type_b = "";
						if (row.stock_grade == 'A') {
							stock_type_a = "selected";
						} else {
							stock_type_b = "selected";
						}
						
						strDiv += '        <TD>';
						strDiv += '        		<div class="content__row">';
						strDiv += '            		<select class="fSelect" name="stock_grade[]" style="font-size:0.5rem;">';
						strDiv += '                		<option value="A" ' + stock_type_a + '>일반</option>';
						strDiv += '                		<option value="B" ' + stock_type_b + '>중요</option>';
						strDiv += '           		 </select>';
						strDiv += '        		</div>';
						strDiv += '        </TD>';
						
						var check_type_a = "";
						var check_type_b = "";
						if (row.qty_check_type == 'A') {
							check_type_a = "selected";
						} else {
							check_type_b = "selected";
						}
						
						strDiv += '        <TD>';
						strDiv += '        		<div class="content__row">';
						strDiv += '            		<select class="fSelect" name="qty_check_type[]" style="font-size:0.5rem;">';
						strDiv += '                		<option value="A" ' + check_type_a + '>주문</option>';
						strDiv += '                		<option value="B" ' + check_type_b + '>결제</option>';
						strDiv += '            		</select>';
						strDiv += '        		</div>';
						strDiv += '        </TD>';
						
						strDiv += '        <TD>';
						if (row.sold_out_flg != null) {
							var checked_true = null;
							var checked_false = null;
							if (row.sold_out_flg == true) {
								checked_true = "checked";
							} else {
								checked_false = "checked";
							}
							strDiv += '        <div class="flex" style="gap: 10px;">';
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="true" ' + checked_true + '>';
                            strDiv += '                <div><div></div></div>';
							strDiv += '                <span>사용</span>';
							strDiv += '            </label>';
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="false" ' + checked_false + '>';
                            strDiv += '                <div><div></div></div>';
							strDiv += '                <span>미사용</span>';
							strDiv += '            </label>';
							strDiv += '        </div>';
						}
						strDiv += '        </TD>';
						
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

function historyProductOptionReset() {
	$('#history_option_info_table').remove();
}

function historyOptionCheck(obj) {
	var option_code_list = $('#option_code_list').val();
	var option_code_arr = option_code_list.split(',');
	
	var duplicate_check = $('#duplicate_check').val();
	var product_code = $('#product_code').val();
	var history_option_code = $(obj).attr('option_code');
	
	var cnt = 0;
	for (var i=0; i<option_code_arr.length; i++) {
		var history_option_code_arr = history_option_code.split('_');
		var option_code_arr = option_code_arr[i].split('_');
		
		if (history_option_code_arr[1] == option_code_arr[1]) {
			cnt++;
		}
	}
	
	if (cnt > 0) {
		alert('이미 선택된 옵션입니다.');
		return false;
	} else {
		if (product_code.length > 0 && product_code != null && duplicate_check != "false") {
			$.ajax({
				type: "post",
				data: {
					'product_code':product_code,
					'history_option_code':history_option_code
				},
				dataType: "json",
				url: config.api + "product/option/add",
				error: function() {
					alert("상품옵션 등록 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getProductOption();
					}
				}
			});
		} else {
			alert('옵션코드 등록을 위해 상품코드를 입력/중복체크가 필요합니다.');
			return false;
		}
	}
}

function getProductOption() {
	var product_code = $('#product_code').val();
	
	if (product_code.length > 0 && product_code != null) {
		$.ajax({
			type: "post",
			data: {
				'product_code':product_code,
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
						$('#option_info_table').remove();
						
						var option_code_list = [];
						
						//추가된 부분 - 옵션 사이즈 관련 2022-09-20
						var strBtnStr = "";
						var strSelStr = "";
						//---

						var strDiv = "";
						strDiv += '<TABLE id="option_info_table"  style="font-size:0.5rem;">';
						strDiv += '    <THEAD>';
						strDiv += '        <TR>';
						strDiv += '            <TH colspan="8">';
						strDiv += '                <div class="row">';
						strDiv += '                    <input id="action_type" type="hidden" name="action_type" value="">';
						strDiv += '                    <button type="button" action_type="reset" style="width:150px;height:30px;background-color:#000000;color:#ffffff;float:left;cursor:pointer;" onClick="optionInfoCheck(this);">옵션정보 사용 안함</button>';
						strDiv += '                    <button type="button" action_type="delete" style="width:100px;height:30px;background-color:#E43A45;color:#ffffff;float:right;margin-right:5px;cursor:pointer;" onClick="optionInfoCheck(this);">옵션삭제</button>';
						strDiv += '                    <button type="button" action_type="update" style="width:100px;height:30px;background-color:#140f82;color:#ffffff;float:right;margin-right:5px;cursor:pointer;" onClick="optionInfoCheck(this);">옵션저장</button>';
						strDiv += '                    <button type="button" action_type="remove" style="width:100px;height:30px;background-color:#000000;color:#ffffff;float:right;margin-right:5px;cursor:pointer;" onClick="optionInfoCheck(this);">옵션제외</button>';
						strDiv += '                </div>';
						strDiv += '            </TH>';
						strDiv += '        </TR>';
						
						strDiv += '        <TR>';
						strDiv += '            <TH style="width:3%;">';
						strDiv += '                <div class="form-group">';
						strDiv += '                    <label>';
						strDiv += '                        <input type="checkbox" onClick="selectAllClick(this);" checked>';
						strDiv += '                        <span></span>';
						strDiv += '                    </label>';
						strDiv += '                </div>';
						strDiv += '            </TH>';
						strDiv += '            <TH>상품코드</TH>';
						strDiv += '            <TH style="width:15%;">옵션코드</TH>';
						strDiv += '            <TH style="width:6%;">옵션이름</TH>';
						strDiv += '            <TH style="width:10%;">재고관리 사용유무</TH>';
						strDiv += '            <TH style="width:10%;">재고관리 등급</TH>';
						strDiv += '            <TH style="width:10%;">수량체크 기준</TH>';
						strDiv += '            <TH style="width:10%;">품절표시</TH>';
						strDiv += '        </TR>';
						strDiv += '    </THEAD>';
						strDiv += '    <TBODY>';
						
						data.forEach(function(row) {
							//추가된 부분 - 옵션 사이즈 관련 2022-09-20
							strBtnStr += `
								<button type="button" class="size_btn" action-flg="false" style="display:none;width:100px;height:30px;background-color:#000000;color:#ffffff;float:left;margin-right:5px;cursor:pointer;" onClick="sizeBtnClick(this)">${row.option_name}</button>
							`;
							//---

							option_code_list.push(row.option_code);
							
							strDiv += '    <TR id="option_row_' + row.no + '">';
							strDiv += '        <TD>';
							strDiv += '            <div class="form-group">';
							strDiv += '                <label>';
							strDiv += '                    <input class="option_idx" type="checkbox" name="option_idx[]" value="' + row.no + '" onClick="optionIdxClick();" checked>';
							strDiv += '                    <span></span>';
							strDiv += '                </label>';
							strDiv += '            </div>';
							strDiv += '        </TD>';
							strDiv += '        <TD>' + row.product_code + '</TD>';
							strDiv += '        <TD>' + row.option_code + '</TD>';
							strDiv += '        <TD>' + row.option_name + '</TD>';
							
							strDiv += '        <TD>';
							
							if (row.stock_management != null) {
								var checked_true = null;
								var checked_false = null;
								if (row.stock_management == true) {
									checked_true = "checked";
								} else {
									checked_false = "checked";
								}
								strDiv += '        <div class="flex" style="gap: 10px;">';
								strDiv += '            <label class="rd__square">';
								strDiv += '                <input type="radio" name="stock_management_' + row.no + '" value="true" ' + checked_true + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>사용</span>';
								strDiv += '            </label>';
								strDiv += '            <label class="rd__square">';
								strDiv += '                <input type="radio" name="stock_management_' + row.no + '" value="false" ' + checked_false + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>미사용</span>';
								strDiv += '            </label>';
								strDiv += '        </div>';
							}
							
							strDiv += '        </TD>';
							
							var stock_type_a = "";
							var stock_type_b = "";
							if (row.stock_grade == 'A') {
								stock_type_a = "selected";
							} else {
								stock_type_b = "selected";
							}
							
							strDiv += '        <TD>';
							strDiv += '        		<div class="content__row">';
							strDiv += '            		<select class="fSelect" name="stock_grade[]" style="font-size:0.5rem;">';
							strDiv += '                		<option value="A" ' + stock_type_a + '>일반</option>';
							strDiv += '                		<option value="B" ' + stock_type_b + '>중요</option>';
							strDiv += '            		</select>';
							strDiv += '        		</div>';
							strDiv += '        </TD>';
							
							var check_type_a = "";
							var check_type_b = "";
							if (row.qty_check_type == 'A') {
								check_type_a = "selected";
							} else {
								check_type_b = "selected";
							}
							
							strDiv += '        <TD>';
							strDiv += '        		<div class="content__row">';
							strDiv += '            		<select class="fSelect" name="qty_check_type[]" style="font-size:0.5rem;">';
							strDiv += '                		<option value="A" ' + check_type_a + '>주문</option>';
							strDiv += '                		<option value="B" ' + check_type_b + '>결제</option>';
							strDiv += '            		</select>';
							strDiv += '        		</div>';
							strDiv += '        <TD>';
							if (row.sold_out_flg != null) {
								var checked_true = null;
								var checked_false = null;
								if (row.sold_out_flg == true) {
									checked_true = "checked";
								} else {
									checked_false = "checked";
								}
								strDiv += '        <div class="flex" style="gap: 10px;">';
								strDiv += '            <label class="rd__square">';
								strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="true" ' + checked_true + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>사용</span>';
								strDiv += '            </label>';
								strDiv += '            <label class="rd__square">';
								strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="false" ' + checked_false + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>미사용</span>';
								strDiv += '            </label>';
								strDiv += '        </div>';
							}
							strDiv += '        </TD>';
							
							strDiv += '    </TR>';
						});
						//추가된 부분 - 옵션 사이즈 관련 2022-09-20
						strSelStr = `
							<select id="size_category" style="width:200px;height:30px;float:left;margin-right:5px;">
								<option value="">---one piece---</option>
								<option value="/01_one_piece/dress">dress</option>
								<option value="">---two piece---</option>
								<option value="/02_two_piece/01_top/coat">coat</option>
								<option value="/02_two_piece/01_top/hoodie">hoodie</option>
								<option value="/02_two_piece/01_top/longSleeve">longSleeve</option>
								<option value="/02_two_piece/01_top/shirts">---one piece---</option>
								<option value="/02_two_piece/01_top/tailored-jacket">tailored-jacket</option>
								<option value="/02_two_piece/01_top/tShirts">tShirts</option>
								<option value="/02_two_piece/01_top/vest">vest</option>
								<option value="/02_two_piece/01_top/zipup">zipup</option>
								<option value="/02_two_piece/02_bottom/pants">pants</option>
								<option value="/02_two_piece/02_bottom/skirt">skirt</option>
								<option value="">---bag---------</option>
								<option value="/03_etc/01_bag/backPack">backPack</option>
								<option value="/03_etc/01_bag/crossBag">crossBag</option>
								<option value="/03_etc/01_bag/toteBag">toteBag</option>
								<option value="">---hat---------</option>
								<option value="/03_etc/02_hat/beanie">beanie</option>
								<option value="/03_etc/02_hat/bucketHat">bucketHat</option>
								<option value="/03_etc/02_hat/cap">cap</option>
								<option value="">---acc---------</option>
								<option value="/03_etc/03_acc/belt">belt</option>
								<option value="/03_etc/03_acc/necktie">necktie</option>
								<option value="/03_etc/03_acc/sock">sock</option>
							</select>
						`;
						$('#option_btn_td').prepend(strBtnStr);
						$('#option_btn_td').prepend(strSelStr);

						$('#size_category').change(function() {	
							$('.size_btn').css('display','block');
							var size_category = $('#size_category option:checked').text();
							$.ajax({
								type: "post",
								data: {'size_category' : size_category},
								dataType: "json",
								url: config.api + "product/size/get",
								error: function() {
									alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
								},
								success: function(d) {
									if(d.code == 200) {
										if(d.data != null){
											size_category_info = d.data[0];
											console.log(size_category_info['category_name']);
										}
									}
								}
							});
						});
						//---

						$('#option_code_list').val(option_code_list);
						
						strDiv += '    </TBODY>';
						strDiv += '</TABLE>';
						
						$('#option_td').append(strDiv);

					} else {
						$('#option_info_table').remove();
					}
				}
			}
		});
	} else {
		alert('등록한 옵션을 불러오기 위해 상품코드를 입력해주세요.');
		return false;
	}
}
function printSizeOptionForm(){
	$('#size_option_tr').remove();
	var strDiv = `
		<TR id = "size_option_tr">
			<TD colspan="4">
				<div class="row">
					<div style="float:left;width: 33%;">
						<img id="size_img" src="/images/sizeguide/02_two_piece/01_top/coat/coat_a.svg" >
					</div>
					<div style="float:left;width: 50%;padding-top:50px;">
						<table id="size_desc_table">
							<tr>
								<td>총장</td>
								<td>옆목점에서 끝단 까지의 수직길이</td>
							</tr> 
							<tr>
								<td>가슴단면</td>
								<td>암홀점에서 1CM아래 양끝의 수평길이</td>
							</tr>
							<tr>
								<td>어깨너비</td>
								<td>어깨점 양끝의 수평길이</td>
							</tr>
							<tr>
								<td>목너비</td>
								<td>옆목점 양끝의 수평길이</td>
							</tr>
							<tr>
								<td>소매장</td>
								<td>어깨점부터 소매끝단까지의 길이</td>
							</tr>  
							<tr>
								<td>소매입구</td>
								<td>옆목점에서소매 끝단의 양끝의 수평길이</td>
							</tr>
						</table>
					</div>
				</div>
			</TD>
		</TR>
	`;
	$('#insert_table_size_detail').append(strDiv);
	$('#size_desc_table tr').mouseover(function(){
        $('#size_desc_table td').css('text-decoration', 'none');
        $(this).find('td').css('text-decoration', 'underline');
        var size_part = $(this).find('td').eq(0).text();
		console.log(size_part);
		switch(size_part){
			case '총장':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_a.svg');
				break;
			case '가슴단면':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_b.svg');
				break;
			case '어깨너비':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_c.svg');
				break;
			case '목너비':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_d.svg');
				break;
			case '소매장':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_e.svg');
				break;
			case '소매입구':
				$('#size_img').attr('src','/images/sizeguide/02_two_piece/01_top/coat/coat_f.svg');
				break;
		}
    })
}
function sizeBtnClick(obj){
	var option_name = $(obj).text();
	if($(obj).attr('action-flg') == 'true'){
		$(obj).css('backgroundColor', '#000000');
		$(obj).attr('action-flg','false');
		removeSizeTd(option_name);
	}
	else{
		$(obj).css('backgroundColor', '#140f82');
		$(obj).attr('action-flg','true');
		addSizeTd(option_name);
	}
}
function removeSizeTd(name){
	console.log(name + ' remove');
}
function addSizeTd(name){
	console.log(name + ' add');
}
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$('.option_idx').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$('.option_idx').prop('checked',false);
	}
	
	optionIdxClick();
}

function optionIdxClick() {
	var length = $('.option_idx').length;
	var option_idx_arr = [];
	
	for (var i=0; i<length; i++) {
		var option_idx = $('.option_idx').eq(i);
		if (option_idx.prop('checked') == true) {
			option_idx_arr.push(option_idx.val());
		}
	}
	
	$('#option_stock_set').val(option_idx_arr);
}

function optionInfoCheck(obj) {
	var action_type = $(obj).attr('action_type');
	
	var action_name = "";
	if (action_type != null) {
		$('#action_type').val(action_type);
		
		switch (action_type) {
			case "remove":
				action_name = "제외";
			break;
			
			case "update":
				action_name = "갱신";
			break;
			
			case "delete":
				action_name = "삭제";
			break;
		}
	}
	
	if (action_type == "reset") {
		confirm('옵션정보를 삭제하시겠습니까?','optionInfoReset()');
	} else {
		var length = $('.option_idx').length;
		var option_idx_arr = [];
		for (var i=0; i<length; i++) {
			var option_idx = $('.option_idx').eq(i);
			if (option_idx.prop('checked') == true) {
				option_idx_arr.push(option_idx.val());
			}
		}
		
		if (option_idx_arr.length > 0) {
			if (action_type == "remove") {
				for (var i=0; i<option_idx_arr.length; i++) {
					$('#option_row_' + option_idx_arr[i]).remove();
				}
			} else {
				optionInfoAction(action_name);
			}
		} else {
			alert(action_name + '할 옵션을 선택해주세요.');
		}
	}
}

function optionInfoAction(action_name) {
	var formData = new FormData();
	formData = $("#frm-regist").serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/option/put",
		error: function() {
			alert("선택한 옵션의 " + action_name + " 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert("선택한 옵션의 " + action_name + " 처리에 성공했습니다.");
				getProductOption();
			}
		}
	});
}

function optionInfoReset() {
	$('#option_info_table').remove();
	$('#option_td').html('옵션정보 없음.');
}

function limitPurchaseSingleFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#limit_purchase_single').val(flg_val);
}

function getRefundCategory() {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "product/refund/get",
		error: function() {
			alert("환불정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					$('#refund_category').html('');
					
					var strDiv = "";
					strDiv += '<option value="all" selected>검색유형 선택</option>';
					data.forEach(function(row) {
						strDiv += '<option value="' + row.refund_category + '">' + row.refund_category + '</option>';
					});
					
					$('#refund_body').html('');
					
					$('#refund_category').unbind();
					$('#refund_category').append(strDiv);
				}
			}
		}
	});
}

function getRefundInfo() {
	var refund_category = $('#refund_category').val();
	
	$.ajax({
		type: "post",
		data: {
			'refund_category':refund_category
		},
		dataType: "json",
		url: config.api + "product/refund/get",
		error: function() {
			alert("환불정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					$('#refund_body').html('');
					var strDiv = "";
					data.forEach(function(row) {
						strDiv += '    <TR>';
						strDiv += '        <TD colspan="2">'
						strDiv += '            <div class="row">';
						strDiv += '                <font>' + row.refund_title + '</font>';
						strDiv += '                <button type="button" style="width:50px;height:30px;background-color:#E43A45;color:#ffffff;float:right;cursor:pointer;" onClick="deleteRefundInfo(' + row.idx + ');">삭제</button>';
						strDiv += '                <button type="button" style="width:50px;height:30px;background-color:#140f82;color:#ffffff;float:right;margin-right:10px;cursor:pointer;" onClick="setRefundInfo(' + row.idx + ');">선택</button>';
						strDiv += '            </div>';
						strDiv += '    </TR>';
					});
					
					$('#refund_body').append(strDiv);
				}
			}
		}
	});
}

function setRefundInfo(refund_idx) {	
	if (refund_idx != null) {
		$.ajax({
			type: "post",
			data: {
				'refund_idx':refund_idx
			},
			dataType: "json",
			url: config.api + "product/refund/get",
			error: function() {
				alert("환불정보 내용 불러오기 처리에 실패했습니다.");
			},
			success: function(data) {
				if(data.code == 200) {
					$("input[name='refund_category']").val(data['data'][0].refund_category);
					$("input[name='refund_title']").val(data['data'][0].refund_title);
					
					detail_refund_kr.getById["detail_refund_kr"].exec("SET_IR", [""]);
					detail_refund_kr.getById["detail_refund_kr"].exec("PASTE_HTML", [data['data'][0].refund_content_kr]);
					
					detail_refund_en.getById["detail_refund_en"].exec("SET_IR", [""]);
					detail_refund_en.getById["detail_refund_en"].exec("PASTE_HTML", [data['data'][0].refund_content_en]);
					
					detail_refund_cn.getById["detail_refund_cn"].exec("SET_IR", [""]);
					detail_refund_cn.getById["detail_refund_cn"].exec("PASTE_HTML", [data['data'][0].refund_content_cn]);
				}
			}
		});
	}
}

function addRefundInfo() {
	var refund_category = $("input[name='refund_category']").val();
	var refund_title = $("input[name='refund_title']").val();
	
	detail_refund_kr.getById["detail_refund_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_en.getById["detail_refund_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_cn.getById["detail_refund_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	var refund_content_kr = $('#detail_refund_kr').val();
	var refund_content_en = $('#detail_refund_en').val();
	var refund_content_cn = $('#detail_refund_cn').val();
	
	if (refund_category.length == 0 || refund_category == null) {
		alert('환불정보 내용을 등록할 상품의 카테고리를 입력해주세요.');
		return false;
	}
	
	if (refund_title.length == 0 || refund_title == null) {
		alert('환불정보 내용의 제목을 입력해주세요.');
		return false;
	}
	
	if ( (refund_content_kr == null) || (refund_content_en == null) || (refund_content_cn == null) ) {
		alert('환불정보 입력시 국가별 환불정보를 전부 입력해주세요.');
		return false;
	}
	
	$.ajax({
		type: "post",
		data: {
			'refund_category':refund_category,
			'refund_title':refund_title,
			'refund_content_kr':refund_content_kr,
			'refund_content_en':refund_content_en,
			'refund_content_cn':refund_content_cn,
		},
		dataType: "json",
		url: config.api + "product/refund/add",
		error: function() {
			alert("환불정보 내용 등록 처리에 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
				getRefundCategory();
			}
		}
	});
}

function deleteRefundInfo(obj) {
	var refund_idx = $(obj).attr('refund_idx');
	
	if (refund_idx != null) {
		$.ajax({
			type: "post",
			data: {
				'refund_idx':refund_idx
			},
			dataType: "json",
			url: config.api + "product/refund/put",
			error: function() {
				alert("환불정보 내용 삭제 처리에 실패했습니다.");
			},
			success: function(data) {
				if(data.code == 200) {
					getRefundInfo();
				}
			}
		});
	}
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

	var pl_lrg_category = $('#pl_lrg_category').val();
	if (pl_lrg_category != null && pl_lrg_category != "") {
		tag.push(pl_lrg_category);
	}

	var pl_mdl_category = $('#pl_mdl_category').val();
	if (pl_mdl_category != null && pl_mdl_category != "") {
		tag.push(pl_mdl_category);
	}

	var pl_sml_category = $('#pl_sml_category').val();
	if (pl_sml_category != null && pl_sml_category != "") {
		tag.push(pl_sml_category);
	}

	var pl_dtl_category = $('#pl_dtl_category').val();
	if (pl_dtl_category != null && pl_dtl_category != "") {
		tag.push(pl_dtl_category);
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

	var color_code = $('#color_code').val();
	if (color_code != null && color_code != "") {
		tag.push(color_code);
	}
	
	var wkla = $('#wkla').val();
	if (wkla != null && wkla != "") {
		tag.push(wkla);
	}

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
	
	var tmp_size_detail_a1_kr = $('#size_detail_a1_kr').val();
	tmp_size_detail_a1_kr = tmp_size_detail_a1_kr.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a2_kr = $('#size_detail_a2_kr').val();
	tmp_size_detail_a2_kr = tmp_size_detail_a2_kr.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a3_kr = $('#size_detail_a3_kr').val();
	tmp_size_detail_a3_kr = tmp_size_detail_a3_kr.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a4_kr = $('#size_detail_a4_kr').val();
	tmp_size_detail_a4_kr = tmp_size_detail_a4_kr.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a5_kr = $('#size_detail_a5_kr').val();
	tmp_size_detail_a5_kr = tmp_size_detail_a5_kr.replace('<p>&nbsp;</p>','');

	var tmp_size_detail_a1_en = $('#size_detail_a1_en').val();
	tmp_size_detail_a1_en = tmp_size_detail_a1_en.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a2_en = $('#size_detail_a2_en').val();
	tmp_size_detail_a2_en = tmp_size_detail_a2_en.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a3_en = $('#size_detail_a3_en').val();
	tmp_size_detail_a3_en = tmp_size_detail_a3_en.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a4_en = $('#size_detail_a4_en').val();
	tmp_size_detail_a4_en = tmp_size_detail_a4_en.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a5_en = $('#size_detail_a5_en').val();
	tmp_size_detail_a5_en = tmp_size_detail_a5_en.replace('<p>&nbsp;</p>','');

	var tmp_size_detail_a1_cn = $('#size_detail_a1_cn').val();
	tmp_size_detail_a1_cn = tmp_size_detail_a1_cn.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a2_cn = $('#size_detail_a2_cn').val();
	tmp_size_detail_a2_cn = tmp_size_detail_a2_cn.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a3_cn = $('#size_detail_a3_cn').val();
	tmp_size_detail_a3_cn = tmp_size_detail_a3_cn.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a4_cn = $('#size_detail_a4_cn').val();
	tmp_size_detail_a4_cn = tmp_size_detail_a4_cn.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_a5_cn = $('#size_detail_a5_cn').val();
	tmp_size_detail_a5_cn = tmp_size_detail_a5_cn.replace('<p>&nbsp;</p>','');


	var tmp_size_detail_onesize_kr = $('#size_detail_onesize_kr').val();
	tmp_size_detail_onesize_kr = tmp_size_detail_onesize_kr.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_onesize_en = $('#size_detail_onesize_en').val();
	tmp_size_detail_onesize_en = tmp_size_detail_onesize_en.replace('<p>&nbsp;</p>','');
	var tmp_size_detail_onesize_cn = $('#size_detail_onesize_cn').val();
	tmp_size_detail_onesize_cn = tmp_size_detail_onesize_cn.replace('<p>&nbsp;</p>','');
	
	if (
		(tmp_size_detail_a1_kr != null && tmp_size_detail_a1_kr != "") ||
		(tmp_size_detail_a1_en != null && tmp_size_detail_a1_en != "") ||
		(tmp_size_detail_a1_cn != null && tmp_size_detail_a1_cn != "")
	) {
		tag.push('A1');
	}

	if (
		(tmp_size_detail_a2_kr != null && tmp_size_detail_a2_kr != "") ||
		(tmp_size_detail_a2_en != null && tmp_size_detail_a2_en != "") ||
		(tmp_size_detail_a2_cn != null && tmp_size_detail_a2_cn != "")
	) {
		tag.push('A2');
	}
	
	if (
		(tmp_size_detail_a3_kr != null && tmp_size_detail_a3_kr != "") ||
		(tmp_size_detail_a3_en != null && tmp_size_detail_a3_en != "") ||
		(tmp_size_detail_a3_cn != null && tmp_size_detail_a3_cn != "")
	) {
		tag.push('A3');
	}
	
	if (
		(tmp_size_detail_a4_kr != null && tmp_size_detail_a4_kr != "") ||
		(tmp_size_detail_a4_en != null && tmp_size_detail_a4_en != "") ||
		(tmp_size_detail_a4_cn != null && tmp_size_detail_a4_cn != "")
	) {
		tag.push('A4');
	}
	
	if (
		(tmp_size_detail_a5_kr != null && tmp_size_detail_a5_kr != "") ||
		(tmp_size_detail_a5_en != null && tmp_size_detail_a5_en != "") ||
		(tmp_size_detail_a5_cn != null && tmp_size_detail_a5_cn != "")
	) {
		tag.push('A5');
	}
	
	if (
		(tmp_size_detail_onesize_kr != null && tmp_size_detail_onesize_kr != "") ||
		(tmp_size_detail_onesize_en != null && tmp_size_detail_onesize_en != "") ||
		(tmp_size_detail_onesize_cn != null && tmp_size_detail_onesize_cn != "")
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

function productRegister() {
	material_kr.getById["material_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_en.getById["material_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	material_cn.getById["material_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
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
	
	care_kr.getById["care_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	care_en.getById["care_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	care_cn.getById["care_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	detail_refund_kr.getById["detail_refund_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_refund_en.getById["detail_refund_en"].exec("UPDATE_CONTENTS_FIELD", []); 
	detail_refund_cn.getById["detail_refund_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	img_product_detail.getById["img_product_detail"].exec("UPDATE_CONTENTS_FIELD", []); 
	img_wear_detail.getById["img_wear_detail"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	var product_style_code = $('#product_style_code').val();
	if (product_style_code.length == 0 || product_style_code == null) {
		alert('스타일코드를 입력해주세요.');
		return false;
	}
	
	var product_code = $('#product_style_code').val();
	if (product_code.length == 0 || product_code == null) {
		alert('상품코드를 입력해주세요.');
		return false;
	}
	
	var duplicate_check = $('#duplicate_check').val();
	if (duplicate_check != 'true') {
		alert('등록하려는 상품의 상품코드를 확인해주세요.');
		return false;
	}
	
	var limit_purchase_qty = $('input[name=limit_purchase_qty]:checked').val();
	if (limit_purchase_qty == "true") {
		var min_num = $("input[name='limit_purchase_qty_min_num']").val();
		
		if (min_num < 1) {
			alert('구매제한수량의 최소값은 0보다 작을 수 없습니다.');
			return false;
		}
	}
	
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
			alert("개별상품 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('상품이 정상적으로 등록되었습니다.',function pageLocation() {
					location.href = '/product/list';
				});
			}
		}
	});
}

function limitPurchaseMemberClick(obj) {
	var member_level_idx = $(obj).val();
	var limit_purchase_id = $(obj).attr('id');
	
	var check_value = $(obj).prop('checked');
	if (check_value == true) {
		if (member_level_idx > 0) {
			$('#limit_purchase_member_all').prop('checked',false);
		} else {
			$('.limit_purchase_member').not($(obj)).prop('checked',false);
		}
	} else if (check_value == false) {
		var lengt = $('.limit_purchase_member').length;
		
		var cnt = 0;
		for (var i=0; i<length; i++) {
			if ($('.limit_purchase_member').eq(i).prop('checked') == true) {
				cnt++;
			}
		}
		
		if (cnt == 0) {
			$('#limit_purchase_member_all').prop('checked',true);
		}
	}
}
</script>