<style>
.update__flg__area{justify-content:flex-start!important}
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
.btn-close{float:right;color:'#000';}
.size_info_text {height:150px;}
.smart_editer_text {height:180px;}
.gray_btn{
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	width:80px;
	height:30px;
	font-size:0.5rem;
	cursor:pointer;
}
#seo {
	margin-top : 50px;
}
.sub {
	margin-top : 10px;
}
.tmp_set_product {
	width:230px;
	height:20px;
	line-height:10px;
	background-color:#140f82;
	border-radius:5px;
	color:#ffffff;
	font-size:0.5px;
	overflow:hidden;
	text-overflow:ellipsis;
	white-space:nowrap;
	padding:5px;
	margin-right:5px;
	margin-top:5px;
	float:left;
	cursor:pointer;
}
</style>
<div class="content__card" style="margin: 0;">
	<h3>
		상품정보 변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="">	
			<input id="param_json" type="hidden"  value='<?=$param_json?>'>
			<input id="product_idx" type="hidden" name="product_idx" value="">
			<input id="product_type" type="hidden" name="product_type" value="">

			<div class="table table__wrap basic">
				<button type="button" toggle_table="ordersheet"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
					onClick="toggleTableClick(this);">오더시트 - 기획MD</button>
				<div class="overflow-x-auto" id="insert_table_ordersheet">
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="22%">
							<col width="10%">
							<col width="22%">
							<col width="10%">
							<col width="22%">
						</colgroup>
						<TBODY>
							<TR>
								<TD>스타일코드</TD>
								<TD id="style_code"></TD>
								<TD>컬러코드</TD>
								<TD id="color_code"></TD>
								<TD>상품코드</TD>
								<TD id="product_code"></TD>
							</TR>
						</TBODY>
					</TABLE>
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="15%">
							<col width="10%">
							<col width="15%">
							<col width="10%">
							<col width="15%">
							<col width="10%">
							<col width="15%">
						</colgroup>
						<TBODY>
							<TR>
								<TD>프리오더 사용여부</TD>
								<TD colspan="3" id="preorder_flg">
								<TD>교환 환불 가능유무</TD>
								<TD colspan="3" id="refund_flg">
							</TR>
							<tr>
								<TD>라인 유형</TD>
								<TD colspan="7" id="line_info_table">
							</tr>
							<tr>
								<TD>MD 카테고리</TD>
								<TD colspan="7">
									<table style="width:40%">
										<tbody>
											<tr>
												<td style="width:25%" id="category_lrg_title"></td>
												<td style="width:25%" id="category_mdl_title"></td>
												<td style="width:25%" id="category_sml_title"></td>
												<td style="width:25%" id="category_dtl_title"></td>
											</tr>
										</tbody>
									</table>
								</TD>
							</TR>
							<TR>
								<TD>소재</TD>
								<TD colspan="3" id="material"></TD>
								<TD>상품 그래픽</TD>
								<TD colspan="3" id="graphic"></TD>
							</TR>
							<TR>
								<TD>상품 핏</TD>
								<TD colspan="3" id="fit"></TD>
								<TD>상품 이름</TD>
								<TD colspan="3" id="product_name"></TD>
							</TR>
							<TR>
								<TD>상품 사이즈</TD>
								<TD id="product_size"></TD>
								<TD>상품 색상</TD>
								<TD id="color"></TD>
								<TD>RGB 코드</TD>
								<TD id="color_rgb"></TD>
								<TD>팬톤 코드</TD>
								<TD id="pantone_code"></TD>
							</TR>
							<TR>
								<TD>MD 카테고리 가이드</TD>
								<TD colspan="3" id="md_category_guide"></TD>
								<TD>구매 수량 제한</TD>
								<TD id="limit_qty"></TD>
								<TD>구매 멤버 제한</TD>
								<TD id="limit_member"></TD>
							</TR>
						</TBODY>
					</TABLE>
					<div style="margin-top:5px;">
						<div id="currency_table" id="row form-group" style="margin-top:5px;display:none;"></div>
						<div id="overflow-x-auto">
							<TABLE>
								<colgroup>
									<col width="20%">
									<col width="20%">
									<col width="20%">
									<col width="20%">
									<col width="20%">
								</colgroup>
								<TBODY>
									<TR>
										<TD>기획원가</TD>
										<TD>한국몰 판매가격 (원)</TD>
										<TD>영문몰 변환가격 (원)</TD>
										<TD>영문몰 판매가격 (달러)</TD>
										<TD>중문몰 판매가격 (달러)</TD>
									</TR>
									<TR>
										<TD id="price_cost"></TD>
										<TD id="price_kr"></TD>
										<TD id="price_kr_gb"></TD>
										<TD id="price_en"></TD>
										<TD id="price_cn"></TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="40%">
							<col width="10%">
							<col width="40%">
						</colgroup>
						<TBODY>
							<tr>
								<TD>기획재고 수량</TD>
								<TD id="product_qty"></TD>
								<TD>안전재고 수량</TD>
								<TD id="safe_qty"></TD>
							</tr>
						</TBODY>
					</TABLE>
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="22%">
							<col width="10%">
							<col width="22%">
							<col width="10%">
							<col width="22%">
						</colgroup>
						<TBODY>
							<tr>
								<TD>런칭일</TD>
								<TD id="launching_date"></TD>
								<TD>입고 요청일</TD>
								<TD id="receive_request_date"></TD>
								<TD>최초 TP작성 완료일</TD>
								<TD id="tp_completion_date"></TD>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			<div class="table table__wrap basic">
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
							<tr>
								<TD>W/K/L/A</TD>
								<TD colspan="11"  id="wkla_info_table">
							</tr>
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
								<TD colspan="10" id="size_category">dress</TD>
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
								<TD style="width:10%;">제품 상세정보 (한글)</TD>
								<TD class="smart_editer_text" id="detail_dsn_kr"></TD>
							</TR>

							<TR>
								<TD style="width:10%;">제품 상세정보 (영문)</TD>
								<TD class="smart_editer_text" id="detail_dsn_en"></TD>
							</TR>

							<TR>
								<TD style="width:10%;">제품 상세정보 (중문)</TD>
								<TD class="smart_editer_text" id="detail_dsn_cn"></TD>
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
								<TD style="width:10%;">제품 취급 유의사항<br>디자인 (한글)</TD>
								<TD class="smart_editer_text" id="care_dsn_kr"></TD>
							</TR>

							<TR>
								<TD style="width:10%;">제품 취급 유의사항<br>디자인 (영문)</TD>
								<TD class="smart_editer_text" id="care_dsn_en"></TD>
							</TR>

							<TR>
								<TD style="width:10%;">제품 취급 유의사항<br>디자인 (중문)</TD>
								<TD class="smart_editer_text" id="care_dsn_cn"></TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
			<div class="table table__wrap basic">
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
								<TD>제품 취급 유의사항<br>생산 (한글)</TD>
								<TD class="smart_editer_text" id="care_td_kr"></TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>생산 (영문)</TD>
								<TD class="smart_editer_text" id="care_td_en"></TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>생산 (중문)</TD>
								<TD class="smart_editer_text" id="care_td_cn"></TD>
							</TR>
							<TR>
								<TD>소재 (한글)</TD>
								<TD class="smart_editer_text" id="material_td_kr"></TD>
							</TR>
							<TR>
								<TD>소재 (영문)</TD>
								<TD class="smart_editer_text" id="material_td_en"></TD>
							</TR>
							<TR>
								<TD>소재 (중문)</TD>
								<TD class="smart_editer_text" id="material_td_cn"></TD>
							</TR>
						</TBODY>
					</TABLE>
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="40%">
							<col width="10%">
							<col width="40%">
						</colgroup>
						<TBODY>
							<TR>
								<TD style="width:10%;">제조사</TD>
								<TD id="manufacturer"></TD>
								<TD style="width:10%;">공급사</TD>
								<TD id="supplier"></TD>
							</TR>
							<TR>
								<TD style="width:10%;">원산지</TD>
								<TD id="origin_country"></TD>
								<TD style="width:10%;">브랜드</TD>
								<TD id="brand"></TD>
							</TR>
							<tr>
								<TD>상품 적재박스 유형</TD>
								<TD colspan="3"  class="load_box_info_table">
							</tr>
							<tr>
								<TD>상품 적재중량 (kg)</TD>
								<TD id="load_weight"></TD>
								<TD>상품 적재수량</TD>
								<TD id="load_qty"></TD>
							</tr>
							<tr>
								<TD>포장부자재</TD>
								<TD>
									<table style="width:50%">
										<tbody id="td_sub_material"></tbody>
									</table>
								</TD>
								<TD>배송부자재</TD>
								<TD>
									<table style="width:50%">
										<tbody id="delivery_sub_material"></tbody>
									</table>
								</TD>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="table table__wrap">
				<button type="button" toggle_table="td"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
				>독립몰 상품 정보</button>
				<div class="overflow-x-auto">
					<TABLE style="width:99%">
						<colgroup>
							<col width="9%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="9%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="9%">
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
								<TD>상품 이름
									<label class="rd__square update__flg__area">
										<input type="radio" name="shop_product_name_update_flg" value="false" >
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="shop_product_name_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input type="text" id="shop_product_name" name="shop_product_name" value="" style="width:40%">
								</TD>
							</TR>
							
							<TR>
								<TD>MD 제품 카테고리
									<label class="rd__square update__flg__area">
										<input type="radio" name="md_category_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="md_category_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<div class="content__row">
										<input type="hidden" class="md_category" id="md_category_1" name="md_category_1" value="">
										<input type="hidden" class="md_category" id="md_category_2" name="md_category_2" value="">
										<input type="hidden" class="md_category" id="md_category_3" name="md_category_3" value="">
										<input type="hidden" class="md_category" id="md_category_4" name="md_category_4" value="">
										<input type="hidden" class="md_category" id="md_category_5" name="md_category_5" value="">
										<input type="hidden" class="md_category" id="md_category_6" name="md_category_6" value="">
										<select class="fSelect category eCategory eCategory1 basicProduct" depth="1" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 01</option>	
										</select>
										<select class="fSelect category eCategory eCategory2 basicProduct" depth="2" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 02</option>
										</select>
										<select class="fSelect category eCategory eCategory3 basicProduct" depth="3" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 03</option>
										</select>
										<select class="fSelect category eCategory eCategory4 basicProduct" depth="4" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 04</option>
										</select>
										<select class="fSelect category eCategory eCategory5 basicProduct" depth="5" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 05</option>
										</select>
										<select class="fSelect category eCategory eCategory6 basicProduct" depth="6" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="">상품분류 06</option>
										</select>
									</div>
								</TD>
							</TR>
							<tr>
								<TD>마일리지 사용유무</TD>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="mileage_flg" value="true" checked>
											<div><div></div></div>
											<span>제한</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="mileage_flg" value="false">
											<div><div></div></div>
											<span>제한안함</span>
										</label>
									</div>
								</TD>
								<TD>단독구매 제한유무</TD>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="exclusive_flg" value="true" checked>
											<div><div></div></div>
											<span>제한</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="exclusive_flg" value="false">
											<div><div></div></div>
											<span>제한안함</span>
										</label>
									</div>
								</TD>
							</tr>
							<TR class="cal_discount">
								<TD>한국몰 가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="shop_price_kr" class="price" type="number" step="0.01" name="price_kr" value="0"></TD>
								<TD>한국몰 세일가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
								<TD>한국몰 할인율
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="discount_kr" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount">
								<TD>영문몰 가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="shop_price_en" class="price" type="number" step="0.01" name="price_en" value="0"></TD>
								<TD>영문몰 세일가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0"></TD>
								<TD>영문몰 할인율
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="discount_en" class="result" type="number" step="0.01" name="discount_en" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount"> 
								<TD>중국몰 가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="price_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="shop_price_cn" class="price" type="number" step="0.01" name="price_cn" value="0"></TD>
								<TD>중국몰 세일가격
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="sales_price_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
								<TD>중국몰 할인율
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="discount_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="discount_cn" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>

							</TR>
							<tr>
								<TD >구매 멤버 제한
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_member_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_member_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<div class="content__row form-group">
										<label>
											<input type="checkbox" name="limit_member[]" value="1">
											<span>비회원</span>
										</label>
										<label>
											<input type="checkbox" name="limit_member[]" value="2">
											<span>일반회원</span>
										</label>
										<label>
											<input type="checkbox" name="limit_member[]" value="3">
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
											<input  type="radio" name="limit_purchase_qty_flg" value="true" checked>
											<div><div></div></div>
											<span>제한</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="limit_purchase_qty_flg" value="false">
											<div><div></div></div>
											<span>제한안함</span>
										</label>
									</div>
								</TD>
								<TD>구매 수량 제한 최소값
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_purchase_qty_min_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_purchase_qty_min_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="limit_purchase_qty_min" type="number" step="1" name="limit_purchase_qty_min" value="1"></TD>
								<TD >구매 수량 제한 최대값
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_purchase_qty_max_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_purchase_qty_max_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="3"><input id="limit_purchase_qty_max" type="number" step="1" name="limit_purchase_qty_max" value="0"></TD>
							</TR>
							<TR>
								<TD>상품 검색어
									<label class="rd__square update__flg__area">
										<input type="radio" name="product_keyword_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="product_keyword_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11"><input type="text" id="product_keyword" name="product_keyword" value="" style="width:90%"></TD>
							</TR>
							<TR>
								<TD >상품 태그
									<label class="rd__square update__flg__area">
										<input type="radio" name="product_tag_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="product_tag_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
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
								<TD>해외 통관 정보
									<label class="rd__square update__flg__area">
										<input type="radio" name="custom_clearance_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="custom_clearance_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<div class="content__row">
										<select id="custom_clearance" name="custom_clearance" class="fSelect eSearch" style="width:163px;">
											<option value="" selected>--해외 통관 분류--</option>	
											<option value="ADAP0000">남성 신발</option>
											<option value="AFAA0000">남성 지갑</option>
											<option value="AFAC0000">남성 스카프/머플러</option>
											<option value="AEAJ0000">양말</option>
											<option value="AEAP0000">기타악세</option>
											<option value="ADAG0000">남성 자켓</option>
											<option value="ADAJ0000">남성 티셔츠</option>
										</select>
										<span id="select_clearance_msg">통관번호 : <span>
									</div>
								</TD>
							</TR>
							<TR>
								<TD>관련상품 검색
									<label class="rd__square update__flg__area">
										<input type="radio" name="relevant_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="relevant_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
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
									</div>
									<div id="relevant_product_div"  style="margin-top:10px;"></div>
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
								<TD>상품 재고<br>품절 임박 수량
									<label class="rd__square update__flg__area">
										<input type="radio" name="sold_out_qty_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="sold_out_qty_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input id="sold_out_qty" type="number" step="1" style="width:30%" name="sold_out_qty" value="0">
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(한글)
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_kr" name="care_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(영문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_en" name="care_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(중문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="care_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_cn" name="care_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (한글)
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_kr" name="detail_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (영문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_en" name="detail_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (중문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="detail_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_cn" name="detail_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (한글)
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="material_kr" name="material_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (영문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="material_en" name="material_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (중문)
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="material_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="material_cn" name="material_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>	
								<TD>구매 전<br>환불정보 표시 플래그</TD>
								<TD colspan="11">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="refund_msg_flg" value="true" checked>
											<div><div></div></div>
											<span>표시</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="refund_msg_flg" value="false">
											<div><div></div></div>
											<span>표시안함</span>
										</label>
									</div>
								</TD>
							</TR>
							<TR>
								<TD>구매 전<br>환불정보 표시 메세지
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input type="text" id="refund_msg" name="refund_msg">
								</TD>
							</TR>
							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(한국몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_kr" name="refund_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(영문몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_en" name="refund_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(중국몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_cn" name="refund_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TD>메모
									<label class="rd__square update__flg__area">
										<input type="radio" name="memo_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="memo_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
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
								<TD>검색엔진<br>브라우저 타이틀
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_title_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_title_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input type="text" id="seo_title" name="seo_title" value="">
								</TD>
							</TR>
							<TR>
								<TD>메타태그<br>Author
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_author_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_author_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input type="text" id="seo_author" name="seo_author" value="">
								</TD>
							</TR>
							<TR>
								<TD>메타태그<br>Description
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_description_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_description_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="seo_description" name="seo_description"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>메타태그<br>Keyword
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_keywords_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_keywords_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<input type="text" id="seo_keywords" name="seo_keywords" value="">
								</TD>
							</TR>
							<TR>
								<TD>검색엔진<br>상품이미지<br>ALT 텍스트
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_alt_text_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="seo_alt_text_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="seo_alt_text" name="seo_alt_text"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>상품 이미지 불러오기
									<label class="rd__square update__flg__area">
										<input type="radio" name="ftp_img_flg" value="false" checked>
										<div><div></div></div>
										<span>이미지 갱신안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="ftp_img_flg" value="true">
										<div><div></div></div>
										<span>이미지 갱신</span>
									</label>
								</TD>
								<TD colspan="11">
									<div style="margin-bottom:15px">
										<span>FTP 폴더경로 :</span>
										<input type="text" id="img_url" name="img_url" style="width:40%;margin-left:5px;margin-right:20px">
										<input type="button" class="gray_btn" value="체크" style="margin-right:10px" onclick="imgExistChk()">
										<input type="button" class="gray_btn" active_flg="false" value="미리보기" onclick="previewImg()">
									</div>
									<table id="img_url_table" style="width:50%">
										<colgroup>
											<col width="10%">
											<col width="60%">
											<col width="30%">
										</colgroup>
										<TR>
											<TH>순서변경</TH>
											<TH>이미지 타입</TH>
											<TH>갯수</TH>
										</TR>
										<TR>
											<TD>
												<div class="btn" onclick="displayNumCheck(this)" action_type="up">
													<i class="xi-angle-up"></i>
													<span class="tooltip top">위로</span>
												</div>
												<div class="btn" onclick="displayNumCheck(this)" action_type="down">
													<i class="xi-angle-down"></i>
													<span class="tooltip top">아래로</span>
												</div>
											</TD>
											<TD>
												<input type="hidden" name="img_type[]" value="outfit">
												<p class="type__name">아웃풋</p>
											</TD>
											<TD>
												<div class="imgCnt outfit" style="width:15%"></div>
											</TD>
										</TR>
										<TR>
											<TD>
												<div class="btn" onclick="displayNumCheck(this)" action_type="up">
													<i class="xi-angle-up"></i>
													<span class="tooltip top">위로</span>
												</div>
												<div class="btn" onclick="displayNumCheck(this)" action_type="down">
													<i class="xi-angle-down"></i>
													<span class="tooltip top">아래로</span>
												</div>
											</TD>
											<TD>
												<input type="hidden" name="img_type[]" value="product">
												<p class="type__name">상품</p>
											</TD>
											<TD>
												<div class="imgCnt product" style="width:15%;dispaly:block!important"></div>
											</TD>
										</TR>
										<TR>
											<TD>
												<div class="btn" onclick="displayNumCheck(this)" action_type="up">
													<i class="xi-angle-up"></i>
													<span class="tooltip top">위로</span>
												</div>
												<div class="btn" onclick="displayNumCheck(this)" action_type="down">
													<i class="xi-angle-down"></i>
													<span class="tooltip top">아래로</span>
												</div>
											</TD>
											<TD>
												<input type="hidden" name="img_type[]" value="detail">
												<p class="type__name">디테일</p>
											</TD>
											<TD>
												<div class="imgCnt detail" style="width:15%"></div>
											</TD>
										</TR>
									</table>
								</TD>
							</TR>
							<tr id="img_preview">
								<td>미리보기</td>
								<td colspan="11">
									<div class="outfit__area">
									</div>
									<div class="product__area">
									</div>
									<div class="detail__area">
									</div>
								</td>
							</tr>
							
							<tr>
								<td>색상 필터 적용</td>
								<td colspan="11">
									<div class="content__row form-group filter_cl">
										
									</div>
								</td>
							</tr>
							<tr>
								<td>핏 필터 적용</td>
								<td colspan="11">
									<div class="rd__block">
										<input class="filter_ft_FALSE" id="filter_ft_FALSE" type="radio" name="filter_ft" value="true" checked>
										<label for="filter_ft_FALSE">미적용</label>
										
										<input class="filter_ft_TRUE" id="filter_ft_TRUE" type="radio" name="filter_ft" value="false">
										<label for="filter_ft_TRUE">적용</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>그래픽 필터 적용</td>
								<td colspan="11">
									<div class="rd__block">
										<input class="filter_gp_FALSE" id="filter_gp_FALSE" type="radio" name="filter_gp" value="true" checked>
										<label for="filter_gp_FALSE">미적용</label>
										
										<input class="filter_gp_TRUE" id="filter_gp_TRUE" type="radio" name="filter_gp" value="false">
										<label for="filter_gp_TRUE">적용</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>라인 필터 적용</td>
								<td colspan="11">
									<div class="rd__block">
										<input class="filter_ln_FALSE" id="filter_ln_FALSE" type="radio" name="filter_ln" value="true" checked>
										<label for="filter_ln_FALSE">미적용</label>
										
										<input class="filter_ln_TRUE" id="filter_ln_TRUE" type="radio" name="filter_ln" value="false">
										<label for="filter_ln_TRUE">적용</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>사이즈 필터 적용</td>
								<td class="filter_sz" colspan="11">
									<table>
										<tr>
											<td style="width:8%;">상의</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_UP">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>하의</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_LW">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>모자</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_HT">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>신발</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_SH">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>주얼리</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_JW">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>악세서리</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_AC">
													
												</div>
											</td>
										</tr>
										<tr>
											<td>테크 악세서리</td>
											<td style="text-align:left;">
												<div class="content__row form-group filter_sz_TA">
													
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div class="tmp" toggle="tmp"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
					<div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var img_chk_flg = false;
var img_dir_error_flg = false;

var care_kr = [];
var care_en = [];
var care_cn = [];

var detail_kr = [];
var detail_en = [];
var detail_cn = [];

var material_kr = [];
var material_en = [];
var material_cn = [];

var refund_kr = [];
var refund_en = [];
var refund_cn = [];

var memo = [];

var seo_description = [];
var seo_alt_text = [];

var originImg = [];
var productImg = [];
var detailImgData = [];

var imgData = [];
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
	//seo
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
	//memo
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: memo,
		elPlaceHolder: "memo",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
}

function getFilterInfo() {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "product/filter/put/get",
		error: function() {
			alert("필터 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				if (data != null) {
					let filter_cl = data[0].filter_cl;
					filter_cl.forEach(function(cl) {
						let strDiv = "";
						strDiv += '<label>';
						strDiv += '    <input id="filter_cl_' + cl.filter_idx + '" type="checkbox" name="filter_cl[]" value="' + cl.filter_idx + '">';
						strDiv += '    <span>' + cl.filter_name + '</span>';
						strDiv += '</label>';
						$('.filter_cl').append(strDiv);
					});
					
					let filter_sz = data[0].filter_sz;
					filter_sz.forEach(function(sz) {
						let size_type = sz.size_type;
						let div_td = $('.filter_sz_' + size_type);

						let strDiv = "";
						strDiv += '<label>';
						strDiv += '    <input id="filter_sz_' + sz.filter_idx + '" type="checkbox" name="filter_sz[]" value="' + sz.filter_idx + '">';
						strDiv += '    <span>' + sz.filter_name + '</span>';
						strDiv += '</label>';
						
						div_td.append(strDiv);
					});
				}
			}
		}
	});
}

$(document).ready(function() {	
	var param_json = $('#param_json').val();
    var json_data = eval("(" + param_json + ")");
	$('#product_idx').val(json_data.product_idx);

	setSmartEditor();
	getProductCategory(0,0);
	$('#insert_table_ordersheet').toggle();
	$('#insert_table_dsn').toggle();
	$('#insert_table_td').toggle();

	$('.cal_discount').keyup(function(){
		var price = $(this).find('.price').val();
		var sales_price = $(this).find('.sales_price').val();

		if(price * sales_price > 0){
			$(this).find('.result').val( ((price - sales_price) / price * 100 ).toFixed(2))
		}
	});
	
	$('.imgType').on('change', function(){
		var sel_type = $(this).val();
		var cnt = 0;
		if(sel_type != ''){
			for(var i = 0; i < 3; i++){
				if(sel_type == $('.imgType').eq(i).val()){
					cnt++;
				}
			}
			if(cnt > 1){
				alert('중복된 이미지타입 입니다.');
				$(this).val('').prop("selected", true);
			}
		}
	})

	$('#custom_clearance').on('change', function(){
		var msg = "통관번호 : " + $(this).val();
		$('#select_clearance_msg').text(msg);
	})
	var product_idx = $('#product_idx').val();
	getFilterInfo();
	shopProductGet(product_idx);
});

function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function shopProductGet(product_idx) {
	var ordersheet_idx = 0;
	$.ajax({
		type: "post",
		data:{
			'sel_idx': product_idx
		},
		dataType: "json",
		url: config.api + "product/get_new",
        error: function() {
            alert("독립몰 상품 불러오기가 실패했습니다.");
        },
        success: function(d) {
			if(d.code == 200){
				var data = d.data[0];
				//독립몰 데이터 불러오기
				$('#shop_style_code').val(data.style_code);
				$('#shop_color_code').val(data.color_code);
				$('#shop_product_code').val(data.product_code);
				$('#shop_product_name').val(data.product_name);
				$('#img_url').val('/ader_prod_img/' + data.product_code);

				$('#shop_price_kr').val(data.price_kr);
				$('#sales_price_kr').val(data.sales_price_kr);
				$('#discount_kr').val(data.discount_kr);
				$('#shop_price_en').val(data.price_en);
				$('#sales_price_en').val(data.sales_price_en);
				$('#discount_en').val(data.discount_en);
				$('#shop_price_cn').val(data.price_cn);
				$('#sales_price_cn').val(data.sales_price_cn);
				$('#discount_cn').val(data.discount_cn);

				if(data.mileage_flg == 0){
					$('input:radio[name=mileage_flg]:input[value="false"]').attr("checked",true);
				}
				else if(data.mileage_flg == 1){
					$('input:radio[name=mileage_flg]:input[value="true"]').attr("checked",true);
				}

				if(data.exclusive_flg == 0){
					$('input:radio[name=exclusive_flg]:input[value="false"]').attr("checked",true);
				}
				else if(data.exclusive_flg == 1){
					$('input:radio[name=exclusive_flg]:input[value="true"]').attr("checked",true);
				}

				if(data.limit_member != null && data.limit_member.length > 0){
					var limit_member_arr = [];
					limit_member_arr = data.limit_member.split(',');
					limit_member_arr.forEach(function(mem_num){
						$('input:checkbox[name="limit_member[]"]:input[value="' + mem_num + '"]').attr("checked",true);
					})
				}
				if(data.limit_purchase_qty_flg == 0){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="false"]').attr("checked",true);
				}
				else if(data.mileage_flg == 1){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="true"]').attr("checked",true);
				}limit_purchase_qty_min
				$('#limit_purchase_qty_min').val(data.limit_purchase_qty_min);
				$('#limit_purchase_qty_max').val(data.limit_purchase_qty_max);
				$('#product_keyword').val(data.product_keyword);
				$('#sold_out_qty').val(data.sold_out_qty);
				if(data.refund_msg_flg == 0){
					$('input:radio[name=refund_msg_flg]:input[value="false"]').attr("checked",true);
				}
				else if(data.refund_msg_flg == 1){
					$('input:radio[name=refund_msg_flg]:input[value="true"]').attr("checked",true);
				}
				$('#refund_msg').val(data.refund_msg);

				$('#detail_kr').html(data.detail_kr);
				$('#detail_en').html(data.detail_en);
				$('#detail_cn').html(data.detail_cn);
				$('#care_kr').html(data.care_kr);
				$('#care_en').html(data.care_kr);
				$('#care_cn').html(data.care_kr);
				$('#material_kr').html(data.material_kr);
				$('#material_en').html(data.material_en);
				$('#material_cn').html(data.material_cn);
				$('#refund_kr').html(data.refund_kr);
				$('#refund_en').html(data.refund_en);
				$('#refund_cn').html(data.refund_cn);
				$('#memo').html(data.memo);
				if(data.seo_exposure_flg == 0){
					$('input:radio[name=seo_exposure_flg]:input[value="false"]').attr("checked",true);
				}
				else if(data.seo_exposure_flg == 1){
					$('input:radio[name=seo_exposure_flg]:input[value="true"]').attr("checked",true);
				}
				$('#seo_alt_text').html(data.seo_alt_text);
				$('#seo_description').html(data.seo_description);
				$('#seo_title').val(data.seo_title);
				$('#seo_author').val(data.seo_author);
				$('#seo_keywords').val(data.seo_keywords);

				if(data.md_category_1 == '0'){
					data.md_category_1 = '';
				}
				$('.eCategory1.basicProduct').val(data.md_category_1).attr("selected","selected").change();
				//getProductCategory(depth,no);
				$('#md_category_2').val(data.md_category_2);
				$('#md_category_3').val(data.md_category_3);
				$('#md_category_4').val(data.md_category_4);
				$('#md_category_5').val(data.md_category_5);
				$('#md_category_6').val(data.md_category_6);
				//
				ordersheet_idx = data.ordersheet_idx;
				$('#product_type').val(data.product_type);
				
				if(data.product_tag != null && data.product_tag.length > 0){
					var tag_arr = data.product_tag.split(',');
					tag_arr.forEach(function(item){
						$('#product_tag').val(item);
						addProductTagBtnClick();
					})
				}
				
				$('#relevant_idx').val(data.relevant_idx);
				if(data.relevant_product != null && data.relevant_product.data.length > 0 && data.relevant_product!=[]){
					var relevant_prod = data.relevant_product.data;
					relevant_prod.forEach(function(item){
						var strDiv = "";
							strDiv += '<div class="relevant_product" style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;cursor:pointer;">';
							strDiv += '    <font class="relevant_idx" relevant_idx="' + item.idx + '">' + item.product_name + '</font>';
							strDiv += '    <font style="float:right;cursor:pointer;" onClick="removeRelevantProduct(this);">x</font>';
							strDiv += '</div>';
							
							$('#relevant_product_div').append(strDiv);
					})
				}
				
				let filter_cl = data.filter_cl;
				if (filter_cl != null) {
					let filter_cl_idx = filter_cl.split(",");
					for (let i=0; i<filter_cl_idx.length; i++) {
						$('input:checkbox[name="filter_cl[]"]:input[value="' + filter_cl_idx[i] + '"]').attr("checked",true);
					}
				}
				
				let filter_ft = data.filter_ft;
				if(filter_ft == false){
					$('input:radio[name=filter_ft]:input[value="false"]').attr("checked",true);
				} else if(filter_ft == true){
					$('input:radio[name=filter_ft]:input[value="true"]').attr("checked",true);
				}
				
				let filter_gp = data.filter_gp;
				if(filter_gp == false){
					$('input:radio[name=filter_gp]:input[value="false"]').attr("checked",true);
				} else if(filter_gp == true){
					$('input:radio[name=filter_gp]:input[value="true"]').attr("checked",true);
				}
				
				let filter_ln = data.filter_ln;
				if(filter_ln == false){
					$('input:radio[name=filter_ln]:input[value="false"]').attr("checked",true);
				} else if(filter_ln == true){
					$('input:radio[name=filter_ln]:input[value="true"]').attr("checked",true);
				}
				
				let filter_sz = data.filter_sz;
				if (filter_sz != null) {
					let filter_sz_idx = filter_sz.split(",");
					for (let i=0; i<filter_sz_idx.length; i++) {
						$('input:checkbox[name="filter_sz[]"]:input[value="' + filter_sz_idx[i] + '"]').attr("checked",true);
					}
				}
			}
		}
	}).then(function (){
		$.ajax({
			type: "post",
			data:{
				'sel_idx':ordersheet_idx
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet/get",
			error: function() {
				alert("오더시트 불러오기가 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;

					//기획 MD
					$('#style_code').text(data.style_code);
					$('#color_code').text(data.color_code);
					$('#product_code').text(data.product_code);
					switch(data.preorder_flg){
						case 0:
							$('#preorder_flg').text('고객상품');
							$('input:radio[name=preorder_flg]:input[value="false"]').attr("checked",true);
							break;
						case 1:
							$('#preorder_flg').text('프리오더 상품');
							$('input:radio[name=preorder_flg]:input[value="true"]').attr("checked",true);
							break;
					}

					switch(data.refund_flg){
						case 0:
							$('#refund_flg').text('교환 불가');
							$('input:radio[name=refund_flg]:input[value="false"]').attr("checked",true);
							break;
						case 1:
							$('#refund_flg').text('교환 가능');
							$('input:radio[name=refund_flg]:input[value="true"]').attr("checked",true);
					}

					if(data.line_idx != null && data.line_idx > 0){
						var type_str = '';
						switch(data.line_type){
							case 'C':
								type_str = '컬렉션 라인';
								break;
							case 'O':
								type_str = '오리진 라인';
								break;
							case 'T':
								type_str = '티피컬 라인';
								break;
						}
						strTable = `
							<table style="width:40%">
								<thead>
									<tr>
										<th>라인명</th>
										<th>타입</th>
										<th>색깔</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>${data.line_name}</td>
										<td>${type_str}</td>
										<td>${data.line_memo}</td>
									</tr>
								</tbody>
							</table>
						`;
						$('#line_info_table').append(strTable);
					}
					$('#line_idx').val(data.line_idx).attr("selected","selected").change();
					$('#category_lrg_title').text(data.category_lrg_title);
					$('#category_mdl_title').text(data.category_mdl_title);
					$('#category_sml_title').text(data.category_sml_title);
					$('#category_dtl_title').text(data.category_dtl_title);
					
					$('#graphic').text(data.graphic);
					$('#fit').text(data.fit);
					$('#material').text(data.material);	
					$('#product_name').text(data.product_name);
					$('#product_size').text(data.product_size);
					$('#color').text(data.color);
					$('#color_rgb').text(data.color_rgb);
					$('#pantone_code').text(data.pantone_code);

					$('#md_category_guide').text(data.md_category_guide);
					$('#limit_qty').text(data.limit_qty);
					$('#limit_member').text(data.limit_member);
					$('#price_cost').text(data.price_cost);
					$('#price_kr').text(data.price_kr);
					$('#price_kr_gb').text(data.price_kr_gb);
					$('#price_en').text(data.price_en);
					$('#price_cn').text(data.price_cn);
					$('#product_qty').text(data.product_qty);
					$('#safe_qty').text(data.safe_qty);
					$('#launching_date').text(data.launching_date);
					$('#receive_request_date').text(data.receive_request_date);
					$('#tp_completion_date').text(data.tp_completion_date);

					//디자인
					if(data.wkla_idx != null && data.wkla_idx > 0){
						strTable = `
							<table style="width:30%">
								<thead>
									<tr>
										<th>WKLA 명</th>
										<th>비고</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>${data.wkla_name}</td>
										<td>${data.wkla_memo}</td>
									</tr>
								</tbody>
							</table>
						`;
						$('#wkla_info_table').append(strTable);
					}
					$('#wkla_idx').val(data.wkla_idx).attr("selected","selected").change();
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
					$('#detail_dsn_kr').html(data.detail_kr);
					$('#detail_dsn_en').html(data.detail_en);
					$('#detail_dsn_cn').html(data.detail_cn);
					$('#care_dsn_kr').html(data.care_dsn_kr);
					$('#care_dsn_en').html(data.care_dsn_en);
					$('#care_dsn_cn').html(data.care_dsn_cn);

					if(data.option_info.length != 0){
						colunm_name_size_1 = data.option_info[0].size_title_1;
						colunm_name_size_2 = data.option_info[0].size_title_2;
						colunm_name_size_3 = data.option_info[0].size_title_3;
						colunm_name_size_4 = data.option_info[0].size_title_4;
						colunm_name_size_5 = data.option_info[0].size_title_5;
						colunm_name_size_6 = data.option_info[0].size_title_6;
						strTh = `
							<tr>
								<th style="width:5%">옵션 이름</th>
						`;
						strTh += colunm_name_size_1 != null ? `<th>${colunm_name_size_1}</th>` : '';
						strTh += colunm_name_size_2 != null ? `<th>${colunm_name_size_2}</th>` : '';
						strTh += colunm_name_size_3 != null ? `<th>${colunm_name_size_3}</th>` : '';
						strTh += colunm_name_size_4 != null ? `<th>${colunm_name_size_4}</th>` : '';
						strTh += colunm_name_size_5 != null ? `<th>${colunm_name_size_5}</th>` : '';
						strTh += colunm_name_size_6 != null ? `<th>${colunm_name_size_6}</th>` : '';

						strTh += `
							</tr>
						`;
						$('#product_size_table_head').append(strTh);

						for(var i = 0; i < data.option_info.length; i++){
							var row_data = data.option_info[i];

							strTr = '';
							var option_size_1 = row_data.option_size_1;
							var option_size_2 = row_data.option_size_2;
							var option_size_3 = row_data.option_size_3;
							var option_size_4 = row_data.option_size_4;
							var option_size_5 = row_data.option_size_5;
							var option_size_6 = row_data.option_size_6;

							strTrCol = ``;
							strTrCol += option_size_1 != '-' ? `<td name="size_info_1[]">${option_size_1} cm</td>` : '';
							strTrCol += option_size_2 != '-' ? `<td name="size_info_2[]">${option_size_2} cm</td>` : '';
							strTrCol += option_size_3 != '-' ? `<td name="size_info_3[]">${option_size_3} cm</td>` : '';
							strTrCol += option_size_4 != '-' ? `<td name="size_info_4[]">${option_size_4} cm</td>` : '';
							strTrCol += option_size_5 != '-' ? `<td name="size_info_5[]">${option_size_5} cm</td>` : '';
							strTrCol += option_size_6 != '-' ? `<td name="size_info_6[]">${option_size_6} cm</td>` : '';
							
							strTr += `
								<tr>
									<td id="option_name">${row_data.option_name}</td>
									${strTrCol}
								</tr>
							`;
							$('#product_size_regist_table').append(strTr);
						}
					}
					
					//생산
					$('#care_td_kr').html(data.care_td_kr);
					$('#care_td_en').html(data.care_td_en);
					$('#care_td_cn').html(data.care_td_cn);
					$('#material_td_kr').html(data.material_kr);
					$('#material_td_en').html(data.material_en);
					$('#material_td_cn').html(data.material_cn);
					$('#manufacturer').text(data.manufacturer);
					$('#supplier').text(data.supplier);
					$('#origin_country').text(data.origin_country);
					$('#brand').text(data.brand);

					if(data.load_box_idx != null && data.load_box_idx > 0){
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
										<td>${data.load_box_name}</td>
										<td>${data.load_box_width} cm</td>
										<td>${data.load_box_length} cm</td>
										<td>${data.load_box_height} cm</td>
										<td>${data.load_box_volume} cm³</td>
									</tr>
								</tbody>
							</table>
						`;
						$('.load_box_info_table').append(strTable);
					}
					$('#load_box_idx option:contains("' + data.load_box_idx + '")').attr("selected","selected").change();
					$('#load_weight').text(data.load_weight);
					$('#load_qty').text(data.load_qty);
					var sub_info = data.sub_material_info;

					sub_info.forEach(function(sub_data){
						var sel_type = sub_data.sub_material_type;
						var column_name = '';
						var table_id = "";
						if(sel_type == "T"){
							table_id = 'sel_td_sub_table';
							column_name = 'td_sub_material_idx[]';
						}
						else if(sel_type == "D"){
							table_id = 'sel_delivery_sub_table';
							column_name = 'delivery_sub_material_idx[]';
						}
						var strDiv = `
							<tr>
								<td>
									<div class="cb__color">
										<label>
											<input type="checkbox" class="select" name="${column_name}" value="${sub_data.sub_material_idx}" checked>
											<span></span>
										</label>
									</div>
								</td>
								<td>${sub_data.sub_material_name}</td>
								<td>${sub_data.sub_material_memo}</td>
								<td><a class="btn red delete"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>
							</tr>
						`;
						$('#'+table_id).append(strDiv);
						
						$("a.btn.red.delete").click(function() {
							let sel_tr = $(this).parent().parent();
							sel_tr.remove();
							/*
							confirm("해당 부자재항목을 삭제할까요?",function() {
								//sel_tr.remove();
							});
							*/
						});
						
						if(sub_data.sub_material_type == 'T'){
							$('#td_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);

						}
						else if(sub_data.sub_material_type == 'D'){
							$('#delivery_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);
						}
					});
				}
			}
		})
	}).then(
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
                                setOptionForm(size_category_info);
                            }
                        }
                    }
                });
            }
        }
    );
}

function lineInfoGet(){
	$.ajax({
        type: "post",
		dataType: "json",
        url: config.api + "pcs/ordersheet/md/line/get",
        error: function() {
            alert("라인정보 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
				var data = d.data;
					
                if (data != null) {
                    var strDiv = "";
                    
                    data.forEach(function(row) {
                        strDiv += ` <option value="${row.line_idx}">${row.line_name}</option>`;
                    });
                    $('#line_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. 라인 정보를 다시 입력해주세요.');
                    return false;
                }
            }
        }
    });
}

function wklaInfoGet(){
	$.ajax({
        type: "post",
		dataType: "json",
        url: config.api + "pcs/ordersheet/dsn/wkla/get",
        error: function() {
            alert("WKLA정보 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
				var data = d.data;
					
                if (data != null) {
                    var strDiv = "";
                    
                    data.forEach(function(row) {
                        strDiv += ` <option value="${row.wkla_idx}">${row.wkla_name}</option>`;
                    });
                    $('#wkla_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. WKLA 정보를 다시 입력해주세요.');
                    return false;
                }
            }
        }
    })
}

function boxInfoGet(){
	$.ajax({
        type: "post",
                data: {
                    'box_type' : 'all'
                },
                dataType: "json",
        url: config.api + "pcs/ordersheet/td/box/get",
        error: function() {
            alert("박스정보 불러오기가 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
                var load_box_info = d.load_box_data;
                var deliver_box_info = d.deliver_box_data;
                    
                if (load_box_info != null) {
                    var strDiv = "";
                    
                    load_box_info.forEach(function(row) {
                        strDiv += ` <option value="${row.box_idx}">${row.box_name}</option>`;
                    });
                    $('#load_box_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. 박스 정보를 다시 입력해주세요.');
                    return false;
                }

                if (deliver_box_info != null) {
                    var strDiv = "";
                    
                    deliver_box_info.forEach(function(row) {
                        strDiv += ` <option value="${row.box_idx}">${row.box_name}</option>`;
                    });
                    $('#deliver_box_idx').append(strDiv);
                } else {
                    alert('검색 결과가 없습니다. 박스 정보를 다시 입력해주세요.');
                    return false;
                }
            }
        }
    })
}

function setOptionForm(size_category_info){
    var strDiv = "";
	var strThDiv = "";
    var category_name = size_category_info['category_name'];
	var img_path = '/images/sizeguide/sizecategory/' + category_name;

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
        var size_title_str = size_category_info['size_title_' + i];
        var size_desc_str  = size_category_info['size_desc_' + i];
		
		if(size_title_str != null && size_title_str.length > 0){
			strDiv += `			
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

	var material = $('#material').text();
	if (material != null && material != "") {
		tag.push(material);
	}

	var graphic = $('#graphic').text();
	if (graphic != null && graphic != "") {
		tag.push(graphic);
	}

	var fit = $('#fit').text();
	if (fit != null && fit != "") {
		tag.push(fit);
	}

	var color = $('#color').text();
	if (color != null && color != "") {
		tag.push(color);
	}

	var rgb_code = $('#rgb_code').text();
	if (rgb_code != null && rgb_code != "") {
		tag.push(rgb_code);
	}
	
	var wkla = $('.wkla_info_table').find('td').eq(0).text();
	if (wkla != null && wkla != "") {
		tag.push(wkla);
	}
	addProductTag(tag,true);
}

function addProductTag(tag,reset_flg) {
	var strDiv = "";
	for (var i=0; i<tag.length; i++) {
		strDiv += '<div style="width:30%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
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

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	//$('#md_category_' + depth).val($('.eCategory'+depth+' option:selected').val());
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
function setProductCategory(depth,data){
	var category_dir = '';
	switch(depth){
		case 2:
			category_dir = '#md_category_2';
			break;
		case 3:
			category_dir = '#md_category_3';
			break;
		case 4:
			category_dir = '#md_category_4';
			break;
		case 5:
			category_dir = '#md_category_5';
			break;
		case 6:
			category_dir = '#md_category_6';
			break;
	}


	var eCategory = $('.eCategory' + depth + '.basicProduct');
	eCategory.empty();
	eCategory.append($('<option value="" selected>상품분류 0' + depth + '</option>'));
	eCategory.eq(1).find('option:eq(0)').prop("selected",true);
	if (data != null) {
		data.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	for(var i = depth + 1; i <= 6; i++){
		$('.eCategory' + i + '.basicProduct').eq(1).find('option:eq(0)').prop("selected",true);
	}

	if($(category_dir).val() != '0' && $(category_dir).val() > 0){
		eCategory.val($(category_dir).val()).prop('selected', true);
		getProductCategory(depth,$(category_dir).val());
	}
	else{
		$('.md_category').val('0');
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
			$(obj).parent().remove();
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

function displayNumCheck(obj) {
	let action_type = $(obj).attr('action_type');
	var num = $(obj).closest('tr').index();


	if (action_type == "up") {
		if (num == 1) {
			alert('URL입력창 순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum('up',num);
		}
	} else if (action_type == "down") {
		if (num == 3) {
			alert('URL입력창 순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum('down',num);
		}
	}
}

function updateDisplayNum(action_type,num) {
	var sel_tr = $('#img_url_table').find('tr').eq(num);
	
	var move_tr = '';
	if(action_type == "up"){
		move_tr = $('#img_url_table').find('tr').eq(num-1);
	}
	else if(action_type == "down"){
		move_tr = $('#img_url_table').find('tr').eq(num+1);
	}

	var tmp_html = sel_tr.html();
	sel_tr.html(move_tr.html());
	move_tr.html(tmp_html);
}

function imgExistChk(){
	$('.outfit__area').html('');
	$('.product__area').html('');
	$('.detail__area').html('');
	
	imgData = [];
	var url_path = $('#img_url').val();
	var param_code = $('#shop_product_code').val();
	$.ajax({
		type: "post",
		data: {
			"url_path":url_path,
			"product_code":param_code
		},
		dataType: "json",
		url: config.api + "product/image/check",
		error: function() {
			alert("이미지 검사 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(val, idx, arr){
						var type = val.type;
						var cnt = val.file_list.length;
						$('.imgCnt.' + type).text(cnt + '개');
					});
					imgData = data;
					img_chk_flg = true;
					img_dir_error_flg = true;
				} else {
					img_chk_flg = true;
					img_dir_error_flg = false;
					alert('검색 결과가 없습니다. FTP경로를 다시 입력해주세요.');
				}
			}
			else{
				img_chk_flg = true;
				img_dir_error_flg = false;
				$('.imgCnt').text('0 개');
				alert(d.msg + 'FTP경로를 다시 입력해주세요');
			}
		}
	});
}

function previewImg(){
	var active_flg = $(obj).attr('active_flg');
	$('.outfit__area').html('');
	$('.product__area').html('');
	$('.detail__area').html('');

	if(active_flg == 'false'){
		if(!img_chk_flg){
			alert('FTP 이미지 체크를 먼저 진행해주세요');
			return false;
		}
		if(!img_dir_error_flg){
			alert('입력하신 FTP 경로에 파일이 없습니다.');
			return false;
		}
		if(imgData.length == 0){
			alert('이미지가 존재하지 않습니다.');
			return false;
		}
		else{
			imgData.forEach(function(val, idx, arr){
				
				var typeDiv = '';
				var typeStr = '';
				switch(val.type){
					case 'outfit':
						typeDiv = $('.outfit__area');
						typeStr = '아웃핏';
						break;
					case 'product':
						typeDiv = $('.product__area');
						typeStr = '상품';
						break;
					case 'detail':
						typeDiv = $('.detail__area');
						typeStr = '디테일';
						break;
				}
				if(val.file_list.length > 0){
					typeDiv.append(`<div class="content__title" style="margin-bottom:5px;"><h3>${typeStr}</h3></div>`);
				
					val.file_list.forEach(function(img_val, idx, arr){
						typeDiv.append(`
										<div>
											<a href="${img_val}">
												<img src="${img_val}">
											</a>
										</div>
						`);
					})
					typeDiv.append('</div>');
				}
			});
			$(obj).attr('active_flg', 'true');
		}
	}
	else if(active_flg == 'true'){
		$(obj).attr('active_flg', 'false');
	}
}

function setPaging(obj) {
	var list_type = $(obj).attr('list_type');
	var total_cnt = $(obj).parent().find('.total_cnt.' + list_type);
	var result_cnt = $(obj).parent().find('.result_cnt.' + list_type);
	$('.cnt_total.' + list_type).text(total_cnt.val());
	$('.cnt_result.' + list_type).text(result_cnt.val());
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}

function productUpdateCheck(){
	confirm('해당 상품을 수정하시겠습니까?', function(){
		care_kr.getById["care_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		care_en.getById["care_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		care_cn.getById["care_cn"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []); 

		material_kr.getById["material_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		material_en.getById["material_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		material_cn.getById["material_cn"].exec("UPDATE_CONTENTS_FIELD", []); 

		refund_kr.getById["refund_kr"].exec("UPDATE_CONTENTS_FIELD", []); 
		refund_en.getById["refund_en"].exec("UPDATE_CONTENTS_FIELD", []); 
		refund_cn.getById["refund_cn"].exec("UPDATE_CONTENTS_FIELD", []); 

		memo.getById["memo"].exec("UPDATE_CONTENTS_FIELD", []); 
		seo_description.getById["seo_description"].exec("UPDATE_CONTENTS_FIELD", []); 
		seo_alt_text.getById["seo_alt_text"].exec("UPDATE_CONTENTS_FIELD", []); 
		
		var ftp_img_flg = $('input:radio[name=ftp_img_flg]').val();
		if(ftp_img_flg == "true"){
			if(!img_chk_flg){
				alert('FTP 이미지 체크를 먼저 진행해주세요');
				return false;
			}
			if(!img_dir_error_flg){
				alert('입력하신 FTP 경로에 파일이 없습니다.');
				return false;
			}
		}

		var product_type = $('#product_type').val();
		var formData = new FormData();
		formData = $("#frm-update").serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "product/put",
			error: function() {
				alert("독립몰 상품 수정 처리에 실패했습니다.");
			},
			beforeSend: function(){
				LoadingWithMask('/images/default/loading_img.gif')
			},
			success: function(d) {
				if(d.code == 200) {
					closeLoadingWithMask();
					alert('독립몰 상품 수정이 정상적으로 실행되었습니다.',function(){
						getProdTabInfo();
						modal_close();
					});
				}
			}
		});
	})
}

function LoadingWithMask(gif) {
	var maskHeight = $(document).height();
	var maskWidth  = window.document.body.clientWidth;
	var top = 0;
	var left = 0;

	top = ( $(window).height()) / 2 + $(window).scrollTop();
	left = ( $(window).width()) / 2 + $(window).scrollLeft();

	//화면에 출력할 마스크를 설정해줍니다.
	var mask       = "<div id='mask_loading' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
	var loadingImg = '';
	  
	loadingImg = `
		<div id='loadingImg' style="position:absolute;
									top:${top}px;
									left:${left}px;
									width:75px;
									height:75px;
									z-index:9999;
									background:#f0f0f0;
									filter:alpha(opacity=50);
									opacity:alpha*0.5;
									margin:auto;
									padding:0; ">
			<img src='${gif}' style="width:75px; height:75px;"/>
		</div>
	`;

	$('body').append(mask);
	$('body').append(loadingImg);

	$('#mask_loading').css({
			'width' : maskWidth,
			'height': maskHeight,
			'opacity' : '1'
	}); 

	$('#mask_loading').show();
	$('#loadingImg').show();
}

function closeLoadingWithMask() {
    $('#mask_loading, #loadingImg').hide();
    $('#mask_loading, #loadingImg').empty();  
}
</script>
