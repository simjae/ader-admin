<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
</style>

<div class="body">
	<h1>
		상품정보 변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input id="product_idx" type="hidden" name="product_idx" value="<?=$product_idx?>">
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="ordersheet" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
				
				<TABLE id="insert_table_ordersheet" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">스타일코드</TD>
							<TD colspan="2">
								<input id="product_style_code" readonly type="text" name="product_style_code" value="">
							</TD>
							
							<TD style="width:10%;">상품코드</TD>
							<TD colspan="2">
								<div class="row">
									<input id="product_code" readonly type="text" name="product_code" style="width:70%;" value="">
								</div>
								
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">오더시트 상품분류</TD>
							<TD colspan="5">
								<div class="row">
									<input id="pl_lrg_category" type="text" name="pl_lrg_category" placeholder="" style="width:20%;" value="">
									<input id="pl_mdl_category" type="text" name="pl_mdl_category" placeholder="" style="width:20%;" value="">
									<input id="pl_sml_category" type="text" name="pl_sml_category" placeholder="" style="width:20%;" value="">
									<input id="pl_dtl_category" type="text" name="pl_dtl_category" placeholder="" style="width:20%;" value="">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">온라인 MD 상품분류</TD>
							<TD colspan="5" style="width:90%;overflow:scroll;">
								<div class="row" style="width:1500px;height:300px;">
									<input type="hidden" name="md_category_1" value="">
									<input type="hidden" name="md_category_2" value="">
									<input type="hidden" name="md_category_3" value="">
									<input type="hidden" name="md_category_4" value="">
									<input type="hidden" name="md_category_5" value="">
									<input type="hidden" name="md_category_6" value="">
									
									<input type="hidden" name="category_idx" value="">
									
									<div id="md_category_1" depth="1" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_2" depth="2" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_3" depth="3" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_4" depth="4" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_5" depth="5" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_6" depth="6" style="width:250px;height:100%;">
										
									</div>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">소재</TD>
							<TD>
								<input type="text" name="material" value="">
							</TD>
							
							<TD style="width:10%;">상품 그래픽</TD>
							<TD>
								<input type="text" name="graphic" value="">
							</TD>
							
							<TD style="width:10%;">상품 핏</TD>
							<TD>
								<input type="text" name="fit" value="">
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
								<input type="text" name="color" value="">
							</TD>
							<TD>컬러코드</TD>
							<TD colspan="2">
								<input type="text" name="color_code" value="">
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
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="material" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">W/K/L/A & Material</button>
				
				<TABLE id="insert_table_material" class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD>W/K/L/A</TD>
							<TD>
								<input type="text" name="wkla" value="">
							</TD>
						</TR>
						
						<TR>
							<TD>Material 한글</TD>
							<TD>
								<textarea class="width-100p" id="material_kr" name="material_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>Material 영문</TD>
							<TD>
								<textarea class="width-100p" id="material_en" name="material_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>Material 중문</TD>
							<TD>
								<textarea class="width-100p" id="material_cn" name="material_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				<TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="size_detail" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">Size Detail</button>
				
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
								<textarea class="width-100p" id="size_detail_a1_kr" name="size_detail_a1_kr" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_kr" name="size_detail_a2_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_kr" name="size_detail_a3_kr" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_kr" name="size_detail_a4_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_kr" name="size_detail_a5_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						
							<TD>ONESIZE한글</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_kr" name="size_detail_onesize_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A1영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a1_en" name="size_detail_a1_en" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_en" name="size_detail_a2_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_en" name="size_detail_a3_en" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_en" name="size_detail_a4_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_en" name="size_detail_a5_en" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>ONESIZE영문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_en" name="size_detail_onesize_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A1중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a1_cn" name="size_detail_a1_cn" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A2중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a2_cn" name="size_detail_a2_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A3중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a3_cn" name="size_detail_a3_cn" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>A4중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a4_cn" name="size_detail_a4_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD>A5중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_a5_cn" name="size_detail_a5_cn" style="width:90%; height:150px;"></textarea>
							</TD>
							
							<TD>ONESIZE중문</TD>
							<TD>
								<textarea class="width-100p" id="size_detail_onesize_cn" name="size_detail_onesize_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD colspan="4">
								<button type="button" style="width:100px;height:30px;background-color:#000000;color:#ffffff;float:right;cursor:pointer;" onClick="productOptionRegister();">옵션 저장</button>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="detail" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">Detail</button>
				
				<TABLE id="insert_table_detail" class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD style="width:10%;">Detail 한글</TD>
							<TD>
								<textarea class="width-100p" id="detail_kr" name="detail_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Detail 영문</TD>
							<TD>
								<textarea class="width-100p" id="detail_en" name="detail_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Detail 중문</TD>
							<TD>
								<textarea class="width-100p" id="detail_cn" name="detail_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="care" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">Care</button>
				
				<TABLE id="insert_table_care" class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
						<TR>
							<TD style="width:10%;">Care 한글</TD>
							<TD>
								<textarea class="width-100p" id="care_kr" name="care_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Care 영문</TD>
							<TD>
								<textarea class="width-100p" id="care_en" name="care_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">Care 중문</TD>
							<TD>
								<textarea class="width-100p" id="care_cn" name="care_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="price" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">Price</button>
				
				<div id="insert_table_price" class="row" style="margin-top:5px;">
					<div class="row form-group">
						<button type="button" style="width:120px;height:30px;border:1px solid #000000;cursor:pointer;float:right;" onClick="$('#currency_table').toggle();">환율정보 조회</button>
						<button type="button" style="width:80px;height:30px;border:1px solid #000000;cursor:pointer;margin-right:10px;float:right;" onClick="productPriceCalc();">계산</button>
						<input id="calc_val" type="text" style="width:163px;height:30px;margin-right:10px;float:right;" placeholder="배율" value="1.4">
					</div>
					
					<div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
					
					<div class="row" style="margin-top:10px;">
						<TABLE class="list" style="font-size:0.7rem;">
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
										<input id="price_kr" type="number" step="0.01"  name="price_kr" value="0">
									</TD>
									<TD>
										<input id="price_kr_gb" type="number" step="0.01" name="price_kr_gb" value="0">
									</TD>
									<TD>
										<input id="price_en" type="number" step="0.01"  name="price_en" value="0">
									</TD>
									<TD>
										<input id="price_cn" type="number" step="0.01"  name="price_cn" value="0">
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="sales_info" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">판매정보</button>
				
				<TABLE id="insert_table_sales_info" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">한국몰 판매가격</TD>
							<TD>
								<input id="sales_price_kr" type="number" step="0.01" name="sales_price_kr" value="0">
							</TD>
							
							<TD style="width:10%;">영문몰 판매가격</TD>
							<TD>
								<input id="sales_price_en" type="number" step="0.01" name="sales_price_en" value="0">
							</TD>
							
							<TD style="width:10%;">중문몰 판매가격</TD>
							<TD>
								<input id="sales_price_cn" type="number" step="0.01" name="sales_price_cn" value="0">
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">
								이미 등록한 옵션정보 불러오기
							</TD>
							<TD colspan="5" id="history_option_td">
								<div class="row form-group">
									<select class="fSelect eSearch" id="search_type" style="width:163px;">
										<option value="product_code">상품 코드</option>
										<option value="product_name">상품 이름</option>
									</select>
									<input type="text" id="search_keyword" style="width:40%;" value="">
									<button type="button" style="width:120px;height:30px;border:1px solid #000000;background-color:#140f82;color:#ffffff;cursor:pointer;" onClick="productOptionCheck();">옵션정보 검색</button>
									<button type="button" style="width:50px;height:30px;border:1px solid #000000;cursor:pointer;background-color:#ffffff;color:#000000;"onClick="historyProductOptionReset();">초기화</button>
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
								<div class="row form-group">
									<label>
										<input id="limit_purchase_member_all" class="limit_purchase_member" type="checkbox" name="limit_purchase_member[]" value="0" onClick="limitPurchaseMemberClick(this);" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input id="limit_purchase_member_1" class="limit_purchase_member" type="checkbox" name="limit_purchase_member[]" value="1" onClick="limitPurchaseMemberClick(this);">
										<span>ADER family</span>
									</label>
									
									<label>
										<input id="limit_purchase_member_2" class="limit_purchase_member" type="checkbox" name="limit_purchase_member[]" value="2" onClick="limitPurchaseMemberClick(this);">
										<span>일반회원</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">적립금 사용</TD>
							<TD colspan="5">
								<div class="row form-group">
									<label>
										<input id="mileage_flg_true" type="radio" name="mileage_flg" value="true" checked>
										<span>사용</span>
									</label>
									
									<label>
										<input id="mileage_flg_false" type="radio" name="mileage_flg" value="false">
										<span>사용안함</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">단독구매 제한</TD>
							<TD colspan="5">
								<div class="form-group row">
									<input id="limit_purchase_single" type="hidden" name="limit_purchase_single" value="">
									<label>
										<input class="limit_purchase_single" type="radio" name="limit_purchase_single_input" value="false" checked onClick="limitPurchaseSingleFlgClick(this);">
										<span>단독구매 제한 없음</span>
									</label>
									
									<label>
										<input class="limit_purchase_single" type="radio" name="limit_purchase_single_input" value="true" onClick="limitPurchaseSingleFlgClick(this);">
										<span>단독구매 제한</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">구매수량 제한</TD>
							<TD colspan="5">
								<div class="row form-group">
									<label>
										<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty" value="false" onClick="limitPurchaseQtyFlgClick(this);" checked>
										<span>구매수량 제한 없음</span>
									</label>
									
									<label>
										<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty" value="true" onClick="limitPurchaseQtyFlgClick(this);">
										<span>구매수량 제한</span>
									</label>
								</div>
								
								<div id="limit_purchase_qty_input" class="row" style="display:none;margin-top:10px;">
									<input type="number" step="0" name="limit_purchase_qty_min_num" style="width:163px;" value="0">
									~
									<input type="number" step="0" name="limit_purchase_qty_max_num" style="width:163px;" value="0">
									<br>
									<font style="margin-top:5px;">*구매제한수량의 최대값이 없을 경우 0을 입력해 주세요.</font>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD colspan="6">
								<TABLE class="list" style="font-size:0.5rem;">
									<THEAD>
										<TR>
											<TH style="width:10%;">상품유형 선택</TH>
											<TH>
												<div class="form-group">
													<input type="hidden" name="refund_idx" value="">
													<select id="product_category" class="fSelect eSearch" name="product_category" style="width:163px;">
													</select>
													
													<button type="button" style="width:120px;height:30px;cursor:pointer;" onClick="getRefundInfo();">환불정보 조회</button>
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
								<div class="row">
									<input type="text" name="refund_category" style="width:163px;margin-right:10px;" value="">
									<input type="text" name="refund_title" style="width:450px;" value="">
									<button type="button" style="width:50px;height:30px;background-color:#000000;color:#ffffff;float:right;cursor:pointer;" onClick="addDetailRefund();">등록</button>
								</div>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">한국몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_kr" name="detail_refund_kr" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">영문몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_en" name="detail_refund_en" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">중문몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_cn" name="detail_refund_cn" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">상품 태그</TD>
							<TD colspan="5">
								<div class="row">
									<input id="product_tag" type="text" value="" style="width:60%;">
									<button style="border:1px solid #000000;background-color:#ffffff;color:#000000;width:80px;height:30px;font-size:0.5rem;cursor:pointer;" onClick="addProductTagBtnClick();">추가</button>
									<button style="background-color:#000000;color:#ffffff;width:150px;height:30px;font-size:0.5rem;cursor:pointer;" onClick="confirm('상품태그를 불러올 경우 기존에 추가한 상품태그는 초기화됩니다.','getProductTag()');">상품태그 불러오기</button>
								</div>
								<div class="row" id="product_tag_div" style="margin-top:10px;">
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
									
									<button type="button" style="width:100px;height:38px;float:right;cursor:pointer;border:1px solid #000000;" onClick="getRelevantProduct();">관련상품 검색</button>
									
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
							<TD style="width:10%;">상품 이미지<br>아웃핏</TD>
							<TD colspan="5">
								<div class="form-group">
									<span class="btn btn-large blue">
										<i class="xi-image"></i> 상품 이미지 선택
										<input class="product_img" id="img_outfit" type="file" name="img_outfit" class="input-image">
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
										<input class="product_img" id="img_product" type="file" name="img_product" class="input-image">
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
										<input class="product_img" id="img_wear" type="file" name="img_wear" class="input-image">
									</span><br>
									<img class="preview img_wear" src="" style="display:none;">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">상품 이미지<br>상품상세</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="img_product_detail" name="img_product_detail" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">상품 이미지<br>착장상세</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="img_wear_detail" name="img_wear_detail" style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="delivery" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">배송정보</button>
				
				<TABLE id="insert_table_delivery" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">HS코드</TD>
							<TD>
								<input type="text" name="hs_code" value="">
							</TD>
							<TD style="width:10%;">상품 전체 중량</TD>
							<TD>
								<input type="number" step="0.01" name="product_total_weight" value="">
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
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="manufacture" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">제작정보</button>
				
				<TABLE id="insert_table_manufacture" class="list" style="font-size:0.7rem;">
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
								<input id="manufacturing_date" class="dateParam" type="date" name="manufacturing_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							</TD>
							
							<TD style="width:10%;">출시일자</TD>
							<TD colspan="3">
								<input id="release_date" class="dateParam" type="date" name="release_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							</TD>
							
							<TD style="width:10%;">유효기간</TD>
							<TD colspan="3">
								<div class="row">
									<input id="validate_start_date" class="dateParam" type="date" name="validate_start_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									<input id="validate_end_date" class="dateParam" type="date" name="validate_end_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>상품 가로길이</TD>
							<TD colspan="2">
								<input id="product_width" class="product_volume" type="number" step="0.01" name="product_width" value="">
							</TD>
							
							<TD>상품 세로길이</TD>
							<TD colspan="2">
								<input id="product_depth" class="product_volume" type="number" step="0.01" name="product_depth" value="">
							</TD>
							
							<TD>상품 높이</TD>
							<TD colspan="2">
								<input id="product_height" class="product_volume" type="number" step="0.01" name="product_height" value="">
							</TD>
							
							<TD>상품 부피</TD>
							<TD colspan="2">
								<input id="product_volume" type="text" name="product_volume" value="0" readonly>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="release_info" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">출고정보</button>
				
				<TABLE id="insert_table_release_info" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">출고 예정기간</TD>
							<TD>
								<div class="row">
									<input id="release_start_date" class="dateParam" type="date" name="release_start_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									~
									<input id="release_end_date" class="dateParam" type="date" name="release_end_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								</div>
							</TD>
							
							<TD style="width:10%;">출고 표시 예정기간</TD>
							<TD>
								<div class="row">
									<input id="display_start_date" class="dateParam" type="date" name="display_start_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									~
									<input id="display_end_date" class="dateParam" type="date" name="display_end_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								</div>
							</TD>
							
							<TD style="width:10%;">미출고사유 입력</TD>
							<TD>
								<input type="text" name="non_release_reason" value="">
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<button type="button" toggle_table="search_seo_info" style="width:100%;border:1px solid #000000;height:30px;cursor:pointer;" onClick="toggleTableClick(this);">검색엔진 최적화 SEO</button>
				
				<TABLE id="insert_table_search_seo_info" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">검색엔진<br>노출설정</TD>
							<TD>
								<div class="row form-group">
									<input id="seo_exposure_flg" type="hidden" name="seo_exposure_flg" value="">
									<label>
										<input class="seo_exposure_flg" type="radio" name="seo_exposure_flg_input" value="true" onClick="seoExposureFlgClick(this);">
										<span>노출함</span>
									</label>
									
									<label>
										<input class="seo_exposure_flg" type="radio" name="seo_exposure_flg_input" value="false" onClick="seoExposureFlgClick(this);">
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
									<textarea class="width-100p" id="seo_description" name="seo_description" style="width:90%; height:150px;"></textarea>
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
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
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

$(document).ready(function() {	
	setSmartEditor();
	
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
	
	$.ajax({
		type: "post",
		data: { 'product_idx' : <?=$product_idx?> },
		dataType: "json",
		url: config.api + "product/get",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
				$("input[name='product_style_code']").val(data['data'][0].product_style_code);
				$("input[name='product_code']").val(data['data'][0].product_code);
				$("input[name='pl_lrg_category']").val(data['data'][0].pl_lrg_category);
				$("input[name='pl_mdl_category']").val(data['data'][0].pl_mdl_category);
				$("input[name='pl_sml_category']").val(data['data'][0].pl_sml_category);
				$("input[name='pl_dtl_category']").val(data['data'][0].pl_dtl_category);
				$("input[name='material']").val(data['data'][0].material);
				$("input[name='graphic']").val(data['data'][0].graphic);
				$("input[name='fit']").val(data['data'][0].fit);
				$("input[name='product_name']").val(data['data'][0].product_name);
				$("input[name='size']").val(data['data'][0].size);
				$("input[name='color']").val(data['data'][0].color);
				$("input[name='color_code']").val(data['data'][0].color_code);
				$("input[name='navigation']").val(data['data'][0].navigation);
				$("input[name='limit_purchase_member_ext']").val(data['data'][0].limit_purchase_member_ext);
				
				$("input[name='wkla']").val(data['data'][0].wkla);
				$("textarea[name='material_kr']").val(data['data'][0].material_kr);
				$("textarea[name='material_en']").val(data['data'][0].material_en);
				$("textarea[name='material_cn']").val(data['data'][0].material_cn);
				
				$("input[name='size_detail_model']").val(data['data'][0].size_detail_model);
				$("input[name='size_detail_wear']").val(data['data'][0].size_detail_wear);
				$("textarea[name='size_detail_a1_kr']").val(data['data'][0].size_detail_a1_kr);
				$("textarea[name='size_detail_a2_kr']").val(data['data'][0].size_detail_a2_kr);
				$("textarea[name='size_detail_a3_kr']").val(data['data'][0].size_detail_a3_kr);
				$("textarea[name='size_detail_a4_kr']").val(data['data'][0].size_detail_a4_kr);
				$("textarea[name='size_detail_a5_kr']").val(data['data'][0].size_detail_a5_kr);
				$("textarea[name='size_detail_onesize_kr']").val(data['data'][0].size_detail_onesize_kr);
				$("textarea[name='size_detail_a1_en']").val(data['data'][0].size_detail_a1_en);
				$("textarea[name='size_detail_a2_en']").val(data['data'][0].size_detail_a2_en);
				$("textarea[name='size_detail_a3_en']").val(data['data'][0].size_detail_a3_en);
				$("textarea[name='size_detail_a4_en']").val(data['data'][0].size_detail_a4_en);
				$("textarea[name='size_detail_a5_en']").val(data['data'][0].size_detail_a5_en);
				$("textarea[name='size_detail_onesize_en']").val(data['data'][0].size_detail_onesize_en);
				$("textarea[name='size_detail_a1_cn']").val(data['data'][0].size_detail_a1_cn);
				$("textarea[name='size_detail_a2_cn']").val(data['data'][0].size_detail_a2_cn);
				$("textarea[name='size_detail_a3_cn']").val(data['data'][0].size_detail_a3_cn);
				$("textarea[name='size_detail_a4_cn']").val(data['data'][0].size_detail_a4_cn);
				$("textarea[name='size_detail_a5_cn']").val(data['data'][0].size_detail_a5_cn);
				$("textarea[name='size_detail_onesize_cn']").val(data['data'][0].size_detail_onesize_cn);
				
				$("textarea[name='care_kr']").val(data['data'][0].care_kr);
				$("textarea[name='care_en']").val(data['data'][0].care_en);
				$("textarea[name='care_cn']").val(data['data'][0].care_cn);
				
				$("textarea[name='detail_kr']").val(data['data'][0].detail_kr);
				$("textarea[name='detail_en']").val(data['data'][0].detail_en);
				$("textarea[name='detail_cn']").val(data['data'][0].detail_cn);
				
				$("input[name='price_kr']").val(data['data'][0].price_kr);
				$("input[name='price_kr_gb']").val(data['data'][0].price_kr_gb);
				$("input[name='price_en']").val(data['data'][0].price_en);
				$("input[name='price_cn']").val(data['data'][0].price_cn);
				
				$("input[name='md_category_1']").val(data['data'][0].md_category_1);
				$("input[name='md_category_2']").val(data['data'][0].md_category_2);
				$("input[name='md_category_3']").val(data['data'][0].md_category_3);
				$("input[name='md_category_4']").val(data['data'][0].md_category_4);
				$("input[name='md_category_5']").val(data['data'][0].md_category_5);
				$("input[name='md_category_6']").val(data['data'][0].md_category_6);
				$("input[name='category_idx']").val(data['data'][0].category_idx);
				
				$("input[name='sales_price_kr']").val(data['data'][0].sales_price_kr);
				$("input[name='sales_price_en']").val(data['data'][0].sales_price_en);
				$("input[name='sales_price_cn']").val(data['data'][0].sales_price_cn);
				$("input[name='option_stock_set']").val(data['data'][0].option_stock_set);
				$("input[name='limit_purchase_member']").val(data['data'][0].limit_purchase_member);
				
				var member_idx_list = data['data'][0].limit_purchase_member;
				var member_idx_arr = member_idx_list.split(',');
				for (var i=0; i<member_idx_arr.length; i++) {
					var member_idx = $('#limit_member_' + member_idx_arr[i]);
					member_idx.prop('checked',true);
				}
				
				$("input[name='limit_purchase_single']").val(data['data'][0].limit_purchase_single);
				var single_purchase_flg = data['data'][0].limit_purchase_single;
				
				if (single_purchase_flg == "0") {
					$('.limit_purchase_single').eq(0).prop('checked',true);
					$('.limit_purchase_single').eq(1).prop('checked',false);
				} else if (single_purchase_flg == "1") {
					$('.limit_purchase_single').eq(0).prop('checked',false);
					$('.limit_purchase_single').eq(1).prop('checked',true);
				}
				
				$("input[name='limit_purchase_qty_min_num']").val(data['data'][0].limit_purchase_qty_min_num);
				$("input[name='limit_purchase_qty_max_num']").val(data['data'][0].limit_purchase_qty_max_num);
				
				var qty_min = data['data'][0].limit_purchase_qty_min_num;
				var qty_max = data['data'][0].limit_purchase_qty_max_num;
				
				if (qty_min > 0 || qty_max > 0) {
					$('.limit_purchase_qty').eq(0).prop('checked',false);
					$('.limit_purchase_qty').eq(1).prop('checked',true);
					$('#limit_purchase_qty_input').show();
				} else {
					$('.limit_purchase_qty').eq(0).prop('checked',true);
					$('.limit_purchase_qty').eq(1).prop('checked',false);
					
					$("input[name='limit_purchase_qty_min_num']").val(0);
					$("input[name='limit_purchase_qty_max_num']").val(0);
					
					$('#limit_purchase_qty_input').hide();
				}
				
				$("textarea[name='detail_refund_kr']").val(data['data'][0].detail_refund_kr);
				$("textarea[name='detail_refund_en']").val(data['data'][0].detail_refund_en);
				$("textarea[name='detail_refund_cn']").val(data['data'][0].detail_refund_cn);
				$("input[name='product_keyword']").val(data['data'][0].product_keyword);
				$("input[name='mileage_per']").val(data['data'][0].mileage_per);
				
				$("input[name='product_total_weight']").val(data['data'][0].product_total_weight);
				$("input[name='hs_code']").val(data['data'][0].hs_code);
				$("input[name='product_division']").val(data['data'][0].product_division);
				$("input[name='product_material_kr']").val(data['data'][0].product_material_kr);
				$("input[name='product_material_en']").val(data['data'][0].product_material_en);
				$("input[name='fabric']").val(data['data'][0].fabric);
				
				$("input[name='manufacturer']").val(data['data'][0].manufacturer);
				$("input[name='supplier']").val(data['data'][0].supplier);
				$("input[name='brand']").val(data['data'][0].brand);
				$("input[name='trend']").val(data['data'][0].trend);
				$("input[name='self_classification']").val(data['data'][0].self_classification);
				$("input[name='manufacturing_date']").val(data['data'][0].manufacturing_date);
				$("input[name='release_date']").val(data['data'][0].release_date);
				$("input[name='validate_start_date']").val(data['data'][0].validate_start_date);
				$("input[name='validate_end_date']").val(data['data'][0].validate_end_date);
				$("input[name='origin_country']").val(data['data'][0].origin_country);
				$("input[name='product_width']").val(data['data'][0].product_width);
				$("input[name='product_depth']").val(data['data'][0].product_depth);
				$("input[name='product_height']").val(data['data'][0].product_height);
				$("input[name='product_volume']").val(data['data'][0].product_volume);
				
				var relevant_product = data['data'][0].relevant_product;
				if (relevant_product != null && relevant_product.data != null) {
					relevant_product.data.forEach(function(relevant_row) {
						var product_idx = relevant_row.idx;
						var product_name = relevant_row.product_name;
						
						var strDiv = "";
						strDiv += '<div class="relevant_product" style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;cursor:pointer;">';
						strDiv += '    <font class="relevant_idx" relevant_idx="' + product_idx + '">' + product_name + '</font>';
						strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeRelevantProduct(this);">x</font>';
						strDiv += '</div>';
						
						$('#relevant_product_div').append(strDiv);
					});
				}
				
				$("input[name='release_start_date']").val(data['data'][0].release_start_date);
				$("input[name='release_end_date']").val(data['data'][0].release_end_date);
				$("input[name='display_start_date']").val(data['data'][0].display_start_date);
				$("input[name='display_end_date']").val(data['data'][0].display_end_date);
				$("input[name='non_release_reason']").val(data['data'][0].non_release_reason);
				
				$("input[name='seo_exposure_flg']").val(data['data'][0].seo_exposure_flg);
				var seo_exposure_flg = data['data'][0].seo_exposure_flg
				if (single_purchase_flg == "0") {
					$('.seo_exposure_flg').eq(0).prop('checked',false);
					$('.seo_exposure_flg').eq(1).prop('checked',true);
				} else if (single_purchase_flg == "1") {
					$('.seo_exposure_flg').eq(0).prop('checked',true);
					$('.seo_exposure_flg').eq(1).prop('checked',false);
				}
				
				$("input[name='seo_title']").val(data['data'][0].seo_title);
				$("input[name='seo_author']").val(data['data'][0].seo_author);
				$("textarea[name='seo_description']").val(data['data'][0].seo_description);
				$("input[name='seo_keywords']").val(data['data'][0].seo_keywords);
				$("input[name='seo_alt_text']").val(data['data'][0].seo_alt_text);
				//$("input[name='memo']").val(data['data'][0].memo);
				$("input[name='relevant_idx']").val(data['data'][0].relevant_idx);
				
				var product_tag_arr = [];
				var product_tag = data['data'][0].product_tag;
				if (product_tag != null) {
					product_tag_arr = product_tag.split(',');
				}
				
				if (product_tag_arr.length > 0) {
					for (var i=0; i<product_tag_arr.length; i++) {
						var strDiv = "";
						strDiv += '<div style="width:15%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
						strDiv += '    <input type="hidden" name="product_tag[]" value="' + product_tag_arr[i] + '">';
						strDiv += '    <font class="product_tag">' + product_tag_arr[i] + '</font>';
						strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeProductTag(this);">x</font>';
						strDiv += '</div>';
						
						$('#product_tag_div').append(strDiv);
					}
				}
				
				var img_result = data['data'][0].img_result;
				if (img_result.length > 0) {
					img_result.data.forEach(function(img_row) {
						var img_type = img_row.img_type;
						var img_size = img_row.img_size;
						
						var preview_img = $('.img_' + img_type);
						var img_location = img_row.img_location;
						img_location = img_location.replace('/var/www/admin/www','');
					
						preview_img.attr('src',img_location);
						preview_img.show();
					});
				}
				
				$("textarea[name='img_product_detail']").val(data['data'][0].img_product_detail);
				$("textarea[name='img_wear_detail']").val(data['data'][0].img_wear_detail);
			}
			getCurrencyInfo();
			setProductCategory();
			getProductOption(false);
			
			getProductCategory(0,0);
			if (data['data'][0].category_idx != 0) {
				for (var i=0; i<6; i++) {
					var category_idx = $("input[name='md_category_" + (i+1) + "']").val();
					if (parseInt(category_idx) > 0) {
						var depth = $('#md_category_' + (i+1)).attr('depth');
						getProductCategory(parseInt(depth),category_idx);
					}
				}
			}
		}
	});
	
	productVolumeCalc();
});

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
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
					strDiv += '<TABLE class="list" style="font-size:0.5rem;width:200px;float:right;">';
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
	var product_code = $('#product_code').val();
	if (product_code.length == 0) {
		alert('상품코드를 입력해 주세요.');
	} else {
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
		formData = $("#frm-update").serializeObject();
		
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
				} else if (d.code == 999) {
					alert(d.msg);
					return false;
				}
			}
		});
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
					strDiv += '<TABLE id="history_option_info_table" class="list" style="font-size:0.5rem;margin-top:10px;">';
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
							strDiv += '    <div class="form-group row">';
							strDiv += '        <label>';
							strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="true" ' + checked_true + '>';
							strDiv += '            <span>사용</span>';
							strDiv += '        </label>';
							strDiv += '        <label>';
							strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="false" ' + checked_false + '>';
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
						strDiv += '            <select class="fSelect" name="stock_grade[]" style="font-size:0.5rem;">';
						strDiv += '                <option value="A" ' + stock_type_a + '>일반</option>';
						strDiv += '                <option value="B" ' + stock_type_b + '>중요</option>';
						strDiv += '            </select>';
						strDiv += '        </TD>';
						
						var check_type_a = "";
						var check_type_b = "";
						if (row.qty_check_type == 'A') {
							check_type_a = "selected";
						} else {
							check_type_b = "selected";
						}
						
						strDiv += '        <TD>';
						strDiv += '            <select class="fSelect" name="qty_check_type[]" style="font-size:0.5rem;">';
						strDiv += '                <option value="A" ' + check_type_a + '>주문</option>';
						strDiv += '                <option value="B" ' + check_type_b + '>결제</option>';
						strDiv += '            </select>';
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
							strDiv += '        <div class="form-group row">';
							strDiv += '            <label>';
							strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="true" ' + checked_true + '>';
							strDiv += '                <span>사용</span>';
							strDiv += '            </label>';
							strDiv += '            <label>';
							strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="false" ' + checked_false + '>';
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
	
	var product_code = $('#product_code').val();
	var history_option_code = $(obj).attr('option_code');
	
	var cnt = 0;
	for (var i=0; i<option_code_arr.length; i++) {
		var history_option_code_size_arr = history_option_code.split('_');
		var option_code_size_arr = option_code_arr[i].split('_');
		
		if (history_option_code_size_arr[1] == option_code_size_arr[1]) {
			cnt++;
		}
	}
	
	if (cnt > 0) {
		alert('이미 선택된 옵션입니다.');
		return false;
	} else {
		if (product_code.length > 0 && product_code != null) {
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
		}
	}
}

function getProductOption(load_flg) {
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
						
						var strDiv = "";
						strDiv += '<TABLE id="option_info_table" class="list" style="font-size:0.5rem;">';
						strDiv += '    <THEAD>';
						strDiv += '        <TR>';
						strDiv += '            <TH colspan="8">';
						strDiv += '                <div class="row">';
						strDiv += '                    <input id="action_type" type="hidden" name="action_type" value="">';
						strDiv += '                    <button type="button" action_type="delete" style="width:100px;height:30px;background-color:#E43A45;color:#ffffff;float:right;margin-right:5px;cursor:pointer;" onClick="optionInfoCheck(this);">옵션삭제</button>';
						strDiv += '                    <button type="button" action_type="update" style="width:100px;height:30px;background-color:#140f82;color:#ffffff;float:right;margin-right:5px;cursor:pointer;" onClick="optionInfoCheck(this);">옵션저장</button>';
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
								strDiv += '    <div class="form-group row">';
								strDiv += '        <label>';
								strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="true" ' + checked_true + '>';
								strDiv += '            <span>사용</span>';
								strDiv += '        </label>';
								strDiv += '        <label>';
								strDiv += '            <input type="radio" name="stock_management_' + row.no + '" value="false" ' + checked_false + '>';
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
							strDiv += '            <select class="fSelect" name="stock_grade[]" style="font-size:0.5rem;">';
							strDiv += '                <option value="A" ' + stock_type_a + '>일반</option>';
							strDiv += '                <option value="B" ' + stock_type_b + '>중요</option>';
							strDiv += '            </select>';
							strDiv += '        </TD>';
							
							var check_type_a = "";
							var check_type_b = "";
							if (row.qty_check_type == 'A') {
								check_type_a = "selected";
							} else {
								check_type_b = "selected";
							}
							
							strDiv += '        <TD>';
							strDiv += '            <select class="fSelect" name="qty_check_type[]" style="font-size:0.5rem;">';
							strDiv += '                <option value="A" ' + check_type_a + '>주문</option>';
							strDiv += '                <option value="B" ' + check_type_b + '>결제</option>';
							strDiv += '            </select>';
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
								strDiv += '        <div class="form-group row">';
								strDiv += '            <label>';
								strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="true" ' + checked_true + '>';
								strDiv += '                <span>사용</span>';
								strDiv += '            </label>';
								strDiv += '            <label>';
								strDiv += '                <input type="radio" name="sold_out_flg_' + row.no + '" value="false" ' + checked_false + '>';
								strDiv += '                <span>미사용</span>';
								strDiv += '            </label>';
								strDiv += '        </div>';
							}
							strDiv += '        </TD>';
							
							strDiv += '    </TR>';
						});
						
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
	formData = $("#frm-update").serializeObject();
	
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
				getProductOption(action_name);
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

function limitPurchaseQtyFlgClick(obj) {
	var flg_val = $(obj).val();
	
	if (flg_val == 'true') {
		$('#limit_purchase_qty_input').show();
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

function getRefundInfo() {
	var refund_category = $('#product_category').val();
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
						strDiv += '                <button refund_idx="' + row.idx + '" type="button" style="width:50px;height:30px;background-color:#E43A45;color:#ffffff;float:right;cursor:pointer;" onClick="removeDetailRefund(this);">삭제</button>';
						strDiv += '                <button refund_idx="' + row.idx + '" type="button" style="width:50px;height:30px;background-color:#140f82;color:#ffffff;float:right;margin-right:10px;cursor:pointer;" onClick="setDetailRefund(this);">선택</button>';
						strDiv += '            </div>';
						strDiv += '    </TR>';
					});
					
					$('#refund_body').append(strDiv);
				}
			}
		}
	});
}

function setDetailRefund(obj) {
	var refund_idx = $(obj).attr('refund_idx');
	
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

function addDetailRefund() {
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
	
	if (
		(refund_content_kr.length == 0 || refund_content_kr == null) ||
		(refund_content_en.length == 0 || refund_content_en == null) ||
		(refund_content_cn.length == 0 || refund_content_cn == null)
	) {
		alert('환불정보 내용의 제목을 입력해주세요.');
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
				setProductCategory();
			}
		}
	});
}

function removeDetailRefund(obj) {
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

function setProductCategory() {
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
					$('#product_category').html('');
					
					var strDiv = "";
					strDiv += '<option value="all" selected>검색분류 선택</option>';
					data.forEach(function(row) {
						strDiv += '<option value="' + row.refund_category + '">' + row.refund_category + '</option>';
					});
					
					$('#refund_body').html('');
					
					$('#product_category').unbind();
					$('#product_category').append(strDiv);
				}
			}
		}
	});
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

function getProductTag() {
	var tag = [];

	var pl_lrg_category = $('#pl_lrg_category').val();
	if (pl_lrg_category != null) {
		tag.push(pl_lrg_category);
	}

	var pl_mdl_category = $('#pl_mdl_category').val();
	if (pl_mdl_category != null) {
		tag.push(pl_mdl_category);
	}

	var pl_sml_category = $('#pl_sml_category').val();
	if (pl_sml_category != null) {
		tag.push(pl_sml_category);
	}

	var pl_dtl_category = $('#pl_dtl_category').val();
	if (pl_dtl_category != null) {
		tag.push(pl_dtl_category);
	}

	var material = $('#material').val();
	if (material != null) {
		tag.push(material);
	}

	var graphic = $('#graphic').val();
	if (graphic != null) {
		tag.push(graphic);
	}

	var fit = $('#fit').val();
	if (fit != null) {
		tag.push(fit);
	}

	var color = $('#color').val();
	if (color != null) {
		tag.push(color);
	}

	var color_code = $('#color_code').val();
	if (color_code != null) {
		tag.push(color_code);
	}
	
	var wkla = $('#wkla').val();
	if (wkla != null) {
		tag.push(wkla);
	}

	if (size_detail_a1_kr != null || size_detail_a1_kr != null || size_detail_a1_kr != null) {
		tag.push('A1');
	}

	if (size_detail_a2_kr != null || size_detail_a2_kr != null || size_detail_a2_kr != null) {
		tag.push('A2');
	}

	if (size_detail_a3_kr != null || size_detail_a3_kr != null || size_detail_a3_kr != null) {
		tag.push('A3');
	}

	if (size_detail_a4_kr != null || size_detail_a4_kr != null || size_detail_a4_kr != null) {
		tag.push('A4');
	}

	if (size_detail_a5_kr != null || size_detail_a5_kr != null || size_detail_a5_kr != null) {
		tag.push('A5');
	}

	if (size_detail_onesize_kr != null || size_detail_onesize_kr != null || size_detail_onesize_kr != null) {
		tag.push('ONESIZE');
	}
	
	addProductTag(tag);
}

function addProductTag(tag) {
	var strDiv = "";
	for (var i=0; i<tag.length; i++) {
		strDiv += '<div style="width:15%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
		strDiv += '    <input type="hidden" name="product_tag[]" value="' + tag[i] + '">';
		strDiv += '    <font>' + tag[i] + '</font>';
		strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeProductTag(this);">x</font>';
		strDiv += '</div>';
	}
	
	$('#product_tag_div').unbind();
	$('#product_tag_div').empty();
	$('#product_tag_div').append(strDiv);
}

function removeProductTag(obj) {
	$(obj).parent().remove();
}

function productUpdateCheck() {
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
	
	seo_description.getById["seo_description"].exec("UPDATE_CONTENTS_FIELD", []);
	
	img_product_detail.getById["img_product_detail"].exec("UPDATE_CONTENTS_FIELD", []); 
	img_wear_detail.getById["img_wear_detail"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	modal_submit($('#frm-update'),'getProdTabInfo');
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
</script>