<style>
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
<form id="frm-sub-material-filter" action="pm/ordersheet/td/sub_material/list/get">
	<input type="hidden" class="sort_type" name="sort_type" value="DESC">
	<input type="hidden" class="sort_value" name="sort_value" value="SUB_MATERIAL_CODE">
	<input type="hidden" class="rows" name="rows" value="10">
	<input type="hidden" class="page" name="page" value="1">

	<input type="hidden" id="sub_material_type" name="sub_material_type" value="ALL">
	<input type="hidden" id="sub_material_name" name="sub_material_name" value="">
	<input type="hidden" id="sub_material_code" name="sub_material_code" value="">
</form>

<div class="content__card" style="margin: 0;">
	<h3>
		상품정보 변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="">	
			<input id="product_idx" type="hidden" name="product_idx" value="<?=$product_idx?>">
			<input id="product_type" type="hidden" name="product_type" value="">
			<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="">
			<div class="table table__wrap set_product">
				<button type="button" toggle_table="ordersheet_set"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
					onClick="toggleTableClick(this);">세트상품 등록 - 오더시트 항목</button>
				<div class="overflow-x-auto" id="insert_table_ordersheet_set">
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
								<TD colspan="3">
									<div class="flex" style="gap: 10px;">
										<label class="rd__square">
											<input type="radio" name="preorder_flg" value="false" checked>
											<div><div></div></div>
											<span>일반 상품</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="preorder_flg" value="true">
											<div><div></div></div>
											<span>프리오더 상품</span>
										</label>
									</div>
								</TD>
								<TD>교환 환불 가능유무</TD>
								<TD colspan="3">
									<div class="flex" style="gap: 10px;">
										<label class="rd__square">
											<input type="radio" name="refund_flg" value="false" checked>
											<div><div></div></div>
											<span>교환 불가</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="refund_flg" value="true">
											<div><div></div></div>
											<span>교환 가능</span>
										</label>
									</div>
								</TD>
							</TR>
							<tr>
								<TD>라인 유형</TD>
								<TD colspan="7">
									<div class="content__row" >
										<select id="line_idx" name="line_idx" class="fSelect eSearch" style="width:163px;">
											<option value="0">라인을 선택해주세요</option>
										</select>
									</div>
									<div id="line_table" class="line_table" style="margin-top:5px">
									</div>
								</TD>
							</tr>
							<TR>
								<TD>소재</TD>
								<TD colspan="3">
								<input type="text" id="material" name="material" value="">
								</TD>
								<TD>상품 그래픽</TD>
								<TD colspan="3">
									<input id="graphic" type="text" name="graphic" value="">
								</TD>
							</TR>
							<TR>
								<TD>상품 핏</TD>
								<TD colspan="3">
									<input id="fit" type="text" name="fit" value="">
								</TD>
								<TD>상품 이름</TD>
								<TD colspan="3">
									<input type="text" id="product_name" name="product_name" value="">
								</TD>
							</TR>
							<TR>
								<TD>상품 사이즈</TD>
								<TD>
									<input type="text" id="product_size" name="product_size" value="">
								</TD>
								<TD>상품 색상</TD>
								<TD>
									<input id="color" type="text" name="color" value="">
								</TD>
								<TD>RGB 코드</TD>
								<TD>
									<input id="color_rgb" type="text" name="color_rgb" value="">
								</TD>
								<TD>팬톤 코드</TD>
								<TD>
									<input id="pantone_code" type="text" name="pantone_code" value="">
								</TD>
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
							<tr>
								<TD>W/K/L/A</TD>
								<TD  colspan="3">
									<div class="content__row" >
										<select id="wkla_idx" name="wkla_idx" class="fSelect eSearch" style="width:163px;">
											<option value="0">WKLA을 선택해주세요</option>
										</select>
									</div>
									<div id="wkla_table" class="wkla_table" style="margin-top:5px">
									</div>
								</TD>
							</tr>
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
							<tr>
								<TD>상품 적재박스 유형</TD>
								<TD colspan="3">
									<div class="content__row" >
										<select id="load_box_idx" name="load_box_idx" box-type="load" class="fSelect eSearch" style="width:163px;">
											<option value="0">박스를 선택해주세요</option>
										</select>
									</div>
									<div id="load_box_table" class="box_table" style="margin-top:5px">
									</div>
								</TD>
							</tr>
							<tr>
								<TD>상품 적재중량 (kg)</TD>
								<TD>
									<input id="load_weight" class="product_volume" type="number" step="0.01"
										name="load_weight" value="0">
								</TD>
								<TD>상품 적재수량</TD>
								<TD>
									<input id="load_qty" class="product_volume" type="number"
										name="load_qty" value="0">
								</TD>
							</tr>
							<tr>
								<td>부자재 검색</td>
								<td colspan="3">
									<div class="card__header">
										<h3>
											부자재 검색창
										</h3>
									</div>
									<div class="card__body">
										<div class="card__header">
										</div>
										<div class="drive--x"></div>
										<div class="card__body">
											<div claszs="body__info--count" style="display: block;margin:20px 0;">
												<div class="drive--left"></div>
												<div class="flex justify-between" style="gap:20px;">
												</div>
											</div>
											<div class="content__wrap">
												<div class="content__title">부자재 타입</div>
												<div class="content__row">
													<label class="rd__square">
														<input type="radio" name="sub_material_type" value="ALL" checked>
														<div><div></div></div>
														<span>전체</span>
													</label>
													<label class="rd__square">
														<input type="radio" name="sub_material_type" value="T" >
														<div><div></div></div>
														<span>포장부자재</span>
													</label>
													<label class="rd__square">
														<input type="radio" name="sub_material_type" value="D">
														<div><div></div></div>
														<span>배송부자재</span>
													</label>
												</div>
											</div>
											<div class="content__wrap grid__half">
												<div class="half__box__wrap">
													<div class="content__title">부자재명</div>
													<div class="content__row">
														<input type="text" name="sub_material_name" value="">
													</div>
												</div>
												<div class="half__box__wrap">
													<div class="content__title">부자재코드</div>
													<div class="content__row">
														<input type="text" name="sub_material_code" value="">
													</div>
												</div>
											</div>
										</div>
										<div class="card__footer">
											<div class="footer__btn__wrap" style="grid: none;">
												<div class="btn__wrap--lg">
												<div  class="blue__color__btn" onClick="getSubMaterialTabInfo()"><span>검색</span></div>
													<div class="defult__color__btn" onClick="init_fileter('frm-filter','getSubMaterialTabInfo()');"><span>초기화</span></div>
												</div>
											</div>
										</div> 
										<div class="card__header">
											<h3>부자재 검색결과</h3>
											<div class="drive--x"></div>
										</div>
										<div class="card__body">
											<div class="body__info--count">
												<div class="drive--left"></div>
												총 부자재 수 <font class="cnt_total sub_material info__count" >0</font>개 / 검색결과 <font class="cnt_result sub_material info__count" >0</font>개
											</div>
											<div class="table__wrap table">
												<TABLE>
													<colgroup>
														<col width="3%">
														<col width="5%">
														<col width="5%">
														<col width="25%">
														<col>
													</colgroup>
													<THEAD>
														<TR>
															<TH>선택</TH>
															<TH>부자재 타입</TH>
															<TH>부자재 코드</TH>
															<TH>부자재 명</TH>
															<TH>부자재 메모</TH>
														</TR>
													</THEAD>
													
													<TBODY id="result_sub_material_table">
														<TD class="default_td" colspan="5">
															부자재를 검색해주세요.
														</TD>
													</TBODY>
												</TABLE>
											</div>
											<div class="padding__wrap">
												<input type="hidden" class="total_cnt" list_type="sub_material" value="0" onChange="setPaging(this);">
												<input type="hidden" class="result_cnt" list_type="sub_material" value="0" onChange="setPaging(this);">
												<div class="sub_material_paging"></div>
											</div>
											<div class="drive--x"></div>
											<div class="grid__half">
												<div class="half__box__wrap" style="grid-template-columns: 1fr!important;">
													<div class="table table__wrap" style="width:90%!important;height: 100%;">
														<div class="overflow-x-auto" >
															<h3 style="margin-bottom:20px">포장부자재</h3>
															<TABLE>
																<colgroup>
																	<col width="10%">
																	<col width="30%">
																	<col width="50%">
																	<col width="10%">
																</colgroup>
																<THEAD>
																	<TR>
																		<TH>선택</TH>
																		<TH>부자재명</TH>
																		<TH>메모</TH>
																		<TH>삭제</TH>
																	</TR>
																</THEAD>
																<TBODY id="sel_td_sub_table" class="td">
																</TBODY>
															</TABLE>
														</div>
													</div>
												</div>
												<div class="half__box__wrap" style="grid-template-columns: 1fr!important;">
													<div class="table table__wrap" style="width:90%!important;height: 100%;">
														<div class="overflow-x-auto" >
															<h3 style="margin-bottom:20px">배송부자재</h3>
															<TABLE id="">
																<colgroup>
																	<col width="10%">
																	<col width="30%">
																	<col width="50%">
																	<col width="10%">
																</colgroup>
																<THEAD>
																	<TR>
																		<TH>선택</TH>
																		<TH>부자재명</TH>
																		<TH>메모</TH>
																		<TH>삭제</TH>
																	</TR>
																</THEAD>
																<TBODY id="sel_delivery_sub_table" class="delivery">
																</TBODY>
															</TABLE>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
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
								<TD colspan="3" class="preorder_flg">
								<TD>교환 환불 가능유무</TD>
								<TD colspan="3" class="refund_flg">
							</TR>
							<tr>
								<TD>라인 유형</TD>
								<TD colspan="7" class="line_info_table">
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
								<TD colspan="3" class="material"></TD>
								<TD>상품 그래픽</TD>
								<TD colspan="3" class="graphic"></TD>
							</TR>
							<TR>
								<TD>상품 핏</TD>
								<TD colspan="3" class="fit"></TD>
								<TD>상품 이름</TD>
								<TD colspan="3" class="product_name"></TD>
							</TR>
							<TR>
								<TD>상품 사이즈</TD>
								<TD class="product_size"></TD>
								<TD>상품 색상</TD>
								<TD class="color"></TD>
								<TD>RGB 코드</TD>
								<TD class="color_rgb"></TD>
								<TD>팬톤 코드</TD>
								<TD class="pantone_code"></TD>
							</TR>
							<TR>
								<TD>MD 카테고리 가이드</TD>
								<TD colspan="3" id="md_category_guide"></TD>
								<TD>구매 수량 제한</TD>
								<TD class="limit_qty"></TD>
								<TD>구매 멤버 제한</TD>
								<TD class="limit_member"></TD>
							</TR>
						</TBODY>
					</TABLE>
					<div style="margin-top:5px;">
						<div id="currency_table" class="row form-group" style="margin-top:5px;display:none;"></div>
						<div class="overflow-x-auto">
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
								<TD colspan="11"  class="wkla_info_table">
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
								<TD class="load_weight"></TD>
								<TD>상품 적재수량</TD>
								<TD class="load_qty"></TD>
							</tr>
							<tr>
								<TD>포장부자재</TD>
								<TD>
									<table style="width:50%">
										<tbody class="td_sub_material"></tbody>
									</table>
								</TD>
								<TD>배송부자재</TD>
								<TD>
									<table style="width:50%">
										<tbody class="delivery_sub_material"></tbody>
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
								<TD>상품 이름</TD>
								<TD colspan="11">
									<input type="text" id="shop_product_name" name="shop_product_name" value="" style="width:40%">
								</TD>
							</TR>
							
							<TR>
								<TD>MD 제품 카테고리</TD>
								<TD colspan="11">
									<div class="content__row">
										<input type="hidden" class="md_category" id="md_category_1" name="md_category_1" value="">
										<input type="hidden" class="md_category" id="md_category_2" name="md_category_2" value="">
										<input type="hidden" class="md_category" id="md_category_3" name="md_category_3" value="">
										<input type="hidden" class="md_category" id="md_category_4" name="md_category_4" value="">
										<input type="hidden" class="md_category" id="md_category_5" name="md_category_5" value="">
										<input type="hidden" class="md_category" id="md_category_6" name="md_category_6" value="">
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
								<TD>한국몰 가격</TD>
								<TD colspan="3"><input id="shop_price_kr" class="price" type="number" step="0.01" name="price_kr" value="0"></TD>
								<TD>한국몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
								<TD>한국몰 할인율</TD>
								<TD colspan="3"><input id="discount_kr" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount">
								<TD>영문몰 가격</TD>
								<TD colspan="3"><input id="shop_price_en" class="price" type="number" step="0.01" name="price_en" value="0"></TD>
								<TD>영문몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0"></TD>
								<TD>영문몰 할인율</TD>
								<TD colspan="3"><input id="discount_en" class="result" type="number" step="0.01" name="discount_en" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount"> 
								<TD>중국몰 가격</TD>
								<TD colspan="3"><input id="shop_price_cn" class="price" type="number" step="0.01" name="price_cn" value="0"></TD>
								<TD>중국몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
								<TD>중국몰 할인율</TD>
								<TD colspan="3"><input id="discount_cn" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>

							</TR>
							<tr>
								<TD >구매 멤버 제한</TD>
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
								<TD>구매 수량 제한 최소값</TD>
								<TD colspan="3"><input id="limit_purchase_qty_min" type="number" step="1" name="limit_purchase_qty_min" value="1"></TD>
								<TD >구매 수량 제한 최대값</TD>
								<TD colspan="3"><input id="limit_purchase_qty_max" type="number" step="1" name="limit_purchase_qty_max" value="0"></TD>
							</TR>
							<TR>
								<TD>상품 검색어</TD>
								<TD colspan="11"><input type="text" id="product_keyword" name="product_keyword" value="" style="width:90%"></TD>
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
										<span id="select_clearance_msg">통관번호 : ADAP0000<span>
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
								<TD>상품 재고<br>품절 임박 수량</TD>
								<TD colspan="11">
									<input id="sold_out_qty" type="number" step="1" style="width:30%" name="sold_out_qty" value="0">
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(한글)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_kr" name="care_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(영문)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_en" name="care_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 취급 유의사항<br>(중문)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="care_cn" name="care_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (한글)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_kr" name="detail_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (영문)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_en" name="detail_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>제품 상세정보 (중문)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_cn" name="detail_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (한글)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="material_kr" name="material_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (영문)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="material_en" name="material_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>소재 (중문)</TD>
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
										<input type="text" id="refund_msg" name="refund_msg">
									</div>
								</TD>
							</TR>
							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(한국몰)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_kr" name="refund_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(영문몰)</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_en" name="refund_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TD>추가 교환/환불<br>상세정보<br>(중국몰)</TD>
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
								<TD>검색엔진<br>브라우저 타이틀</TD>
								<TD colspan="11">
									<input type="text" id="seo_title" name="seo_title" value="">
								</TD>
							</TR>
							<TR>
								<TD>메타태그<br>Author</TD>
								<TD colspan="11">
									<input type="text" id="seo_author" name="seo_author" value="">
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
									<input type="text" id="seo_keywords" name="seo_keywords" value="">
								</TD>
							</TR>
							<TR>
								<TD>검색엔진<br>상품이미지<br>ALT 텍스트</TD>
								<TD colspan="11">
									<textarea class="width-100p" id="seo_alt_text" name="seo_alt_text"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<TR>
								<TD>상품 이미지 불러오기</TD>
								<TD colspan="11">
									<div class="flex" style="gap: 10px;margin-bottom:10px">
										<label class="rd__square">
											<input type="radio" name="ftp_img_flg" value="false" checked>
											<div><div></div></div>
											<span>FTP 이미지 갱신안함</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="ftp_img_flg" value="true">
											<div><div></div></div>
											<span>FTP 이미지 갱신</span>
										</label>
									</div>
									<div style="margin-bottom:15px">
										<span>FTP 폴더경로 :</span>
										<input type="text" id="img_url" name="img_url" style="width:40%;margin-left:5px;margin-right:20px">
										<input type="button" class="gray_btn" value="체크" style="margin-right:10px" onclick="imgExistChk()">
										<input type="button" class="gray_btn" value="미리보기" onclick="previewImg()">
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
								<td class="filter_cl" colspan="11">
									
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
											<td>상의</td>
											<td class="filter_sz_up" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>하의</td>
											<td class="filter_sz_lw" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>모자</td>
											<td class="filter_sz_ht" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>신발</td>
											<td class="filter_sz_sh" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>주얼리</td>
											<td class="filter_sz_jw" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>악세서리</td>
											<td class="filter_sz_ac" style="text-align:left;"></td>
										</tr>
										<tr>
											<td>테크 악세서리</td>
											<td class="filter_sz_ta" style="text-align:left;"></td>
										</tr>
									</table>
								</td>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			<div class="table table__wrap set_product">
				<button type="button" toggle_table="td"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
				>세트상품 등록 - 개별상품 선택</button>
				<div class="overflow-x-auto">
					<div id="set_product_list_area" style="visibility:hidden">
						<h3 style="margin-top:15px;margin-bottom:10px;">세트 구성 상품 리스트</h3>
						<TABLE style="width:99%">
							<thead>
								<tr>
									<TH style="width:3%;">삭제</TH>
									<TH style="width:3%;">상품<br>구분</TH>
									<TH>스타일 코드</TH>
									<TH>컬러 코드</TH>
									<TH>상품 코드</TH>
									<TH>상품명</TH>
									<TH style="width:8%;">판매가<br>(한국몰)</TH>
									<TH style="width:8%;">판매가<br>(영문몰)</TH>
									<TH style="width:8%;">판매가<br>(중국몰)</TH>
									<TH style="width:50px;">총 재고량</TH>
									<TH style="width:50px;">재고수량</TH>
									<TH style="width:50px;">판매수량</TH>
									<TH style="width:50px;">안전재고</TH>
									<TH style="width:15%;">상품 상세 페이지 링크</TH>
								</tr>
							</thead>
							<tbody id="set_product_table">
							</tbody>
						</TABLE>
					</div>
				</div>
			</div>
		</form>
		<div class="set_product" style="margin-top:30px;">
			<div class="overflow-x-auto">
				<form id="frm-product_add" action="search/modal/product/list/get">
					<input class="page" type="hidden" name="page" value="1">
					<input class="rows" type="hidden" name="rows" value="5">
					<input type="hidden" class="sort_type" name="sort_type" value="DESC">
					<input type="hidden" class="sort_value" name="sort_value" value="IDX">
					
					<div class="card__header">
						<h3>세트 구성상품 검색</h3>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body">
						<div class="content__wrap">
							<div class="content__title">검색 분류</div>
							<div class="content__row search_type_div" style="display: block;">
								<div class="search_type">
									<select class="fSelect eSearch search_type_select" name="search_type[]" style="width:163px;" onChange="changeSearchType(this);">
										<option value="ALL" selected>검색분류 선택</option>
										<option value="name">상품명</option>
										<option value="code">상품코드</option>
									</select>
									
									<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
									
									<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">-</button>
									<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">+</button>
								</div>
							</div>
						</div>
						
						<div class="content__wrap">
							<div class="content__title">상품 구분</div>
							<div class="content__row">
								<div class="rd__block">
									<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
									<label for="product_type_all">전체</label>
									
									<input id="product_type_b" type="radio" name="product_type" value="B" >
									<label for="product_type_b">기본상품</label>
									
									<input id="product_type_s" type="radio" name="product_type" value="S" >
									<label for="product_type_s">세트상품</label>
								</div>
							</div>
						</div>
						
						<div class="content__wrap grid__half">
							<div class="half__box__wrap">
								<div class="content__title">재고수량</div>
								<div class="content__row">
									<select class="fSelect" name="stock_type" style="width:163px;">
										<option value="stock">재고수량</option>
										<option value="safe">안전재고</option>
									</select>
									
									<input type="number" name="stock_min" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
									~
									<input type="number" name="stock_max" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title">품절 상태</div>
								<div class="content__row">
									<div class="rd__block">
										<input id="sold_out_status_all" type="radio" name="sold_out_status" value="all" checked>
										<label for="sold_out_status_all">전체</label>
										

										<input id="sold_out_status_false" type="radio" name="sold_out_status" value="false">
										<label for="sold_out_status_false">품절</label>
										
										<input id="sold_out_status_true" type="radio" name="sold_out_status" value="true">
										<label for="sold_out_status_true">품절 아님</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="content__wrap">
							<div class="content__title">상품 가격</div>
							<div class="price_type_div">
								<div class="content__row price_type">
									<select class="fSelect price_type_select" name="price_type[]" style="width:163px;" onChange="changePriceType(this);">
										<option value="">상품가격 선택</option>	
										<option value="SALES_PRICE_KR">한국몰 가격</option>
										<option value="SALES_PRICE_EN">영문몰 가격</option>
										<option value="SALES_PRICE_CN">중국몰 가격</option>
									</select>
									
									<input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
									<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> 
									<font>~</font>
									<input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
									<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>
									
									<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">-</button>
									<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">+</button>
								</div>
							</div>
						</div>
						
						<div class="card__footer">
							<div class="footer__btn__wrap">
								<div class="tmp" toggle="tmp"></div>
								<div class="btn__wrap--lg">
									<div  class="blue__color__btn" onClick="getModalProductList();"><span>검색</span></div>
									<div class="defult__color__btn" onClick="init_fileter('frm-product_add','getModalProductList()');"><span>초기화</span></div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<form id="frm-list">
					<div class="card__header">
						<h3>상품 목록 검색 결과</h3>
						<div class="drive--x"></div>
					</div>
					
					<div class="card__body">
						<div class="info__wrap " style="justify-content:space-between; align-items: center;">
							<div class="body__info--count">
								<div class="drive--left"></div>
								총 상품 수 <font class="cnt_total set_product info__count" >0</font>개 / 검색결과 <font class="cnt_result set_product info__count" >0</font>개
							</div>
								
							<div class="content__row">
								<select style="width:163px;float:right;margin-right:10px;" onChange="changeOrderProduct(this);">
									<option value="CREATE_DATE|DESC">등록일 역순</option>
									<option value="CREATE_DATE|ASC">등록일 순</option>
									<option value="PRODUCT_NAME|DESC">상품명 역순</option>
									<option value="PRODUCT_NAME|ASC">상품명 순</option>
									<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
									<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
									<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
									<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
									<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
									<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
								</select>
								<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="changeRowsProduct(this);">
									<option value="5" selected>5개씩보기</option>
									<option value="10">10개씩보기</option>
									<option value="20">20개씩보기</option>
									<option value="30">30개씩보기</option>
									<option value="50">50개씩보기</option>
									<option value="100">100개씩보기</option>
									<option value="200">200개씩보기</option>
									<option value="300">300개씩보기</option>
									<option value="500">500개씩보기</option>
								</select>
							</div>
						</div>
						
						<div class="table table__wrap">
							<div class="table__filter">
								<input id="set_product_list" type="hidden" value="">
								<div class="tmp_set_product_wrap">
									
								</div>
							</div>
							
							<div class="overflow-x-auto">
								<TABLE>
									<THEAD>
										<TR>
											<TH style="width:3%;">
												<div class="cb__color">
													<label>
														<input type="checkbox" checkbox_type="modal_product" onClick="clickSelectAll(this);">
														<span></span>
													</label>
												</div>
											</TH>
											<TH style="width:3%;">상품<br>구분</TH>
											<TH>스타일 코드</TH>
											<TH>컬러 코드</TH>
											<TH>상품 코드</TH>
											<TH>상품명</TH>
											<TH style="width:8%;">판매가<br>(한국몰)</TH>
											<TH style="width:8%;">판매가<br>(영문몰)</TH>
											<TH style="width:8%;">판매가<br>(중국몰)</TH>
											<TH style="width:50px;">총 재고량</TH>
											<TH style="width:50px;">재고수량</TH>
											<TH style="width:50px;">판매수량</TH>
											<TH style="width:50px;">안전재고</TH>
											<TH style="width:15%;">상품 상세 페이지 링크</TH>
										</TR>
									</THEAD>
									<TBODY id="result_set_product_table">
									</TBODY>
								</TABLE>
							</div>
						</div>
						
						<div class="padding__wrap">
							<input type="hidden" class="total_cnt set_product" list_type="set_product" value="0" onChange="setPaging(this);">
							<input type="hidden" class="result_cnt set_product" list_type="set_product" value="0" onChange="setPaging(this);">
							<div class="modal_product_paging"></div>
						</div>
					</div>
					
					<div class="card__footer">
						<div class="footer__btn__wrap">
							<div class="tmp" toggle="hide"></div>
							<div class="btn__wrap--lg">
								<div  class="blue__color__btn" onClick="addSetProduct();"><span>세트 상품 추가</span></div>
								<div class="defult__color__btn" onClick="init_fileter('frm-filter','getProdTabInfo');"><span>초기화</span></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card__footer">
			<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
			<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
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
					let filter_cl = data.filter_cl;
					filter_cl.forEach(function(cl) {
						console.log(cl);
					});
					
					let filter_sz = data.filter_sz;
					filter_sz.forEach(function(sz) {
						console.log(sz);
					});
				}
			}
		}
	});
}

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
/*
var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://203.245.9.174/ader_prod_img/BLAFWKV01BL/product/img_BLAFWKV01BL_09_P_S_202210210000.jpg', true);
xhr.responseType = 'blob';
xhr.onload = function(e) {
  if (this.status == 200) {
    var myBlob = this.response;
    // myBlob is now the blob that the object URL pointed to.
  }
};
xhr.send();
*/

var img_check_flg = false;

$(document).ready(function() {	
	setSmartEditor();
	getProductCategory(0,0);
	$('#insert_table_ordersheet').toggle();
	$('#insert_table_dsn').toggle();
	$('#insert_table_td').toggle();

	$('#insert_table_set_search').toggle();

	var product_idx = $('#product_idx').val();
	shopProductGet(product_idx);
	getFilterInfo();
	
	$('.cal_discount').keyup(function(){
		var price = $(this).find('.price').val();
		var sales_price = $(this).find('.sales_price').val();

		if(price * sales_price > 0){
			$(this).find('.result').val( ((price - sales_price) / price * 100 ).toFixed(2))
		}
	});
	$('input:radio[name=refund_msg_flg]:input[value="false"]').on('click',function(){
		$('#refund_msg').val('');
		$('#refund_msg').attr('readonly',true);
	});
	$('input:radio[name=refund_msg_flg]:input[value="true"]').on('click',function(){
		$('#refund_msg').attr('readonly',false);
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

	lineInfoGet();
	$('#line_idx').change(function() {	
        var sel_tr = $(this).parents('tr');
        var sel_line_idx = sel_tr.find('.eSearch option:checked').val();
		
        sel_tr.find('.line_table').html('');
		if(sel_line_idx > 0){
			$.ajax({
				type: "post",
				data: {
                    'sel_line_idx' : sel_line_idx
                },
				dataType: "json",
				url: config.api + "pm/ordersheet/md/line/get",
				error: function() {
					alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						if(d.data != null){
							var line_info = d.data[0];
							var type_str = '';
							switch(line_info.line_type){
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
                                            <th>비고</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${line_info.line_name}</td>
                                            <td>${type_str}</td>
                                            <td>${line_info.line_memo}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            `;
                            sel_tr.find('.line_table').append(strTable);
						}
					}
				}
			});
		}
	});

	wklaInfoGet();
	$('#wkla_idx').change(function() {	
        var sel_tr = $(this).parents('tr');
        var sel_wkla_idx = sel_tr.find('.eSearch option:checked').val();
		
        sel_tr.find('.wkla_table').html('');
		if(sel_wkla_idx > 0){
			$.ajax({
				type: "post",
				data: {
                    'sel_wkla_idx' : sel_wkla_idx
                },
				dataType: "json",
				url: config.api + "pm/ordersheet/dsn/wkla/get",
				error: function() {
					alert("WKLA 불러오기 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						if(d.data != null){
							var wkla_info = d.data[0];
                            strTable = `
                                <table style="width:40%">
                                    <thead>
                                        <tr>
                                            <th>WKLA</th>
                                            <th>비고</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${wkla_info.wkla_name}</td>
                                            <td>${wkla_info.wkla_memo}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            `;
                            sel_tr.find('.wkla_table').append(strTable);
						}
					}
				}
			});
		}
	});

	boxInfoGet();
	$('#load_box_idx, #deliver_box_idx').change(function(obj) {	
        var box_type = $(this).attr('box-type');
        var sel_tr = $(this).parents('tr');
        var sel_box_idx = sel_tr.find('.eSearch option:checked').val();
		
        sel_tr.find('.box_table').html('');
		if(sel_box_idx > 0){
			$.ajax({
				type: "post",
				data: {
                    'sel_box_idx' : sel_box_idx,
                    'box_type' : box_type
                },
				dataType: "json",
				url: config.api + "pm/ordersheet/td/box/get",
				error: function() {
					alert("사이즈정보 입력창 불러오기 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						if(d.data != null){
							var box_info = d.data[0];
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
                            sel_tr.find('.box_table').append(strTable);
						}
					}
				}
			});
		}
	});
});
function toggleTableClick(obj) {
	var toggle_val = $(obj).attr('toggle_table');
	
	$('#insert_table_' + toggle_val).toggle();
}

function shopProductGet(product_idx) {
	
	var ordersheet_idx = 0;
    //$('input[name=ordersheet_idx]').val(idx);
	$.ajax({
		type: "post",
		data:{
			'sel_idx': product_idx
		},
		dataType: "json",
		url: config.api + "product/get_new",
        error: function() {
            alert("오더시트 불러오기가 실패했습니다.");
        },
        success: function(d) {
			if(d.code == 200){
				var data = d.data[0];
				//오더시트 -> 독립몰 데이터 불러오기
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

				var limit_member_arr = [];
				if(data.limit_member != null || data.limit_member.length > 0){
					limit_member_arr = data.limit_member.split(',');
				}
				limit_member_arr.forEach(function(mem_num){
					$('input:checkbox[name="limit_member[]"]:input[value="' + mem_num + '"]').attr("checked",true);
				})

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

				$('.eCategory1').val(data.md_category_1).attr("selected","selected").change();
				//getProductCategory(depth,no);
				$('#md_category_2').val(data.md_category_2);
				$('#md_category_3').val(data.md_category_3);
				$('#md_category_4').val(data.md_category_4);
				$('#md_category_5').val(data.md_category_5);
				$('#md_category_6').val(data.md_category_6);
				//
				$('#ordersheet_idx').val(data.ordersheet_idx);
				ordersheet_idx = data.ordersheet_idx;
				$('#product_type').val(data.product_type);
				if(data.product_type == 'B'){
					$('.basic').show();
					$('.set_product').hide();
				}
				else if(data.product_type == 'S'){
					$('.set_product').show();
					$('.basic').hide();
					if(data.set_product_info.length > 0){
						data.set_product_info.forEach(function(row){
							let strDiv = "";

							strDiv += '<TR>';
							strDiv += '    <td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>';
							var product_type = "";
							if (row.product_type == "B") {
								product_type = "일반";
							} else if (row.product_type == "S") {
								product_type = "세트";
							}
							strDiv += '    <td>' + product_type + '</td>';
							
							strDiv += '    <td>' + row.style_code + '</td>';
							strDiv += '    <td>' + row.color_code + '</td>';
							strDiv += '    <td>' + row.product_code + '</td>';

							let background_url = "background-image:url('" + row.img_location + "');";
							strDiv += '    <TD>';
							strDiv += '        <div class="product__img__wrap">';
							strDiv += '            <div class="product__img" style="' + background_url + '">';
							strDiv += '            </div>';
							strDiv += '            <div>';
							strDiv += '                <p>' + row.product_name + '</p><br>';
							strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
							strDiv += '            </div>';
							strDiv += '        </div>';
							strDiv += '    </TD>';

							let discount_kr = row.discount_kr;
							strDiv += '    <td style="text-align: right;">';
							if (discount_kr > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_kr != null){
									strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let discount_en = row.discount_en;
							strDiv += '    <td style="text-align: right;">';
							if (discount_en > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_en != null){
									strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let discount_cn = row.discount_cn;
							strDiv += '    <td style="text-align: right;">';
							if (discount_cn > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_cn != null){
									strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let stock_qty = row.stock_qty;
							let order_qty = row.order_qty;
							let safe_qty = row.safe_qty;

							let product_qty = stock_qty - order_qty;

							strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
							strDiv += '    <TD style="width:15%;">';
							strDiv += '        <input type="hidden" class="product_idx_list" name="product_idx_list[]" value="' + row.product_idx + '">';
							strDiv += '        <a href="http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '" onClick="window.open(this.href); return false;">상품 상세 페이지 이동</a>';
							strDiv += '    </TD>';
							strDiv += '</TR>';
							$('#set_product_list_area').css('visibility','visible');
							$('#set_product_table').append(strDiv);
						})
					}
				}
				if(data.product_tag.length > 0){
					var tag_arr = data.product_tag.split(',');
					tag_arr.forEach(function(item){
						$('#product_tag').val(item);
						addProductTagBtnClick();
					})
				}

				$('#relevant_idx').val(data.relevant_idx);
				if(data.relevant_product != null){
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
			}
		}
	}).then(function (){
			$.ajax({
			type: "post",
			data:{
				'sel_idx':ordersheet_idx
			},
			dataType: "json",
			url: config.api + "pm/ordersheet/get",
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
							$('.preorder_flg').text('고객상품');
							$('input:radio[name=preorder_flg]:input[value="false"]').attr("checked",true);
							break;
						case 1:
							$('.preorder_flg').text('프리오더 상품');
							$('input:radio[name=preorder_flg]:input[value="true"]').attr("checked",true);
							break;
					}

					switch(data.refund_flg){
						case 0:
							$('.refund_flg').text('교환 불가');
							$('input:radio[name=refund_flg]:input[value="false"]').attr("checked",true);
							break;
						case 1:
							$('.refund_flg').text('교환 가능');
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
						$('.line_info_table').append(strTable);
					}
					$('#line_idx').val(data.line_idx).attr("selected","selected").change();
					$('#category_lrg_title').text(data.category_lrg_title);
					$('#category_mdl_title').text(data.category_mdl_title);
					$('#category_sml_title').text(data.category_sml_title);
					$('#category_dtl_title').text(data.category_dtl_title);
					
					$('.graphic').text(data.graphic);
					$('#graphic').val(data.graphic);

					$('.fit').text(data.fit);
					$('#fit').val(data.fit);

					$('.material').text(data.material);
					$('#material').val(data.material);	

					$('.product_name').text(data.product_name);
					$('#product_name').val(data.product_name);

					$('.product_size').text(data.product_size);
					$('#product_size').val(data.product_size);

					$('.color').text(data.color);
					$('#color').val(data.color);

					$('.color_rgb').text(data.color_rgb);
					$('#color_rgb').val(data.color_rgb);

					$('.pantone_code').text(data.pantone_code);
					$('#pantone_code').val(data.pantone_code);

					$('#md_category_guide').text(data.md_category_guide);
					$('.limit_qty').text(data.limit_qty);
					$('#limit_qty').val(data.limit_qty);
					$('.limit_member').text(data.limit_member);
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
						$('.wkla_info_table').append(strTable);
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
					$('.load_weight').text(data.load_weight);
					$('#load_weight').val(data.load_weight);
					$('.load_qty').text(data.load_qty);
					$('#load_qty').val(data.load_qty);
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
							$('.td_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);

						}
						else if(sub_data.sub_material_type == 'D'){
							$('.delivery_sub_material').append(`<tr><td>${sub_data.sub_material_name}</td></tr>`);
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
        url: config.api + "pm/ordersheet/md/line/get",
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
        url: config.api + "pm/ordersheet/dsn/wkla/get",
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
        url: config.api + "pm/ordersheet/td/box/get",
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


function getSubMaterialTabInfo(){
	$('#sub_material_type').val($('#frm-update').find('input[name="sub_material_type"]:checked').val());
	$('#sub_material_name').val($('#frm-update').find('input[name="sub_material_name"]').val());
	$('#sub_material_code').val($('#frm-update').find('input[name="sub_material_code"]').val());

	$("#result_sub_material_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_sub_material_table").append(strDiv);
	
	var rows = $("#frm-sub-material-filter").find('.rows').val();
	var page = $("#frm-sub-material-filter").find('.page').val();
	get_contents($("#frm-sub-material-filter"),{
		pageObj : $(".sub_material_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_sub_material_table").html('');
			}
			data = d;
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '    	   <input type="hidden" value="' + row.sub_material_idx + '">	';
				strDiv += '        <input type="button" class="gray_btn" onclick="addSubRow(this)" value="선택">';
				strDiv += '        </button>';
				strDiv += '    </td>';
				
				var sub_material_type = "";
				if (row.sub_material_type == "T") {
					sub_material_type = "포장부자재";
				} else if (row.sub_material_type == "D") {
					sub_material_type = "배송부자재";
				}
				
				strDiv += '    <td>' + sub_material_type + '<input type="hidden" value="' + row.sub_material_type + '"></td>';
                strDiv += '    <td>' + row.sub_material_code + '</td>';
				strDiv += '    <td>' + row.sub_material_name + '</td>';
                strDiv += '    <td>' + row.sub_material_memo + '</td>';
				strDiv += '</tr>';
				
				$("#result_sub_material_table").append(strDiv);
			});
		},
	},rows, page);
}

function addSubRow(obj){
	var sel_tr = $(obj).parent().parent();
	var sel_sub_idx = sel_tr.find('input').eq(0).val();
	var sel_type = sel_tr.find('input').eq(2).val();
	var sel_name = sel_tr.find('td').eq(3).text();
	var sel_memo = sel_tr.find('td').eq(4).text();

	var table_id = "";
	var column_name = "";

	var cnt = $('#sel_td_sub_table, #sel_delivery_sub_table').find('.cb__color').find('input[value="' + sel_sub_idx + '"]').length;

	if(cnt < 1){
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
							<input type="checkbox" class="select" name="${column_name}" value="${sel_sub_idx}" checked>
							<span></span>
						</label>
					</div>
				</td>
				<td>${sel_name}</td>
				<td>${sel_memo}</td>
				<td><a class="btn red delete"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>
			</tr>
		`;
		$('#'+table_id).append(strDiv);
		$("a.btn.red.delete").click(function() {
			let sel_tr = $(this).parent().parent();
			sel_tr.remove();
		});
	}
	else{
		alert('이미 해당 부자재를 선택했습니다.');
	}	
}

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	console.log("depth: "+depth+",no:"+no);
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


	var eCategory = $('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="" selected>상품분류 0' + depth + '</option>'));
	eCategory.eq(1).find('option:eq(0)').prop("selected",true);
	if (data != null) {
		data.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	for(var i = depth + 1; i <= 6; i++){
		$('.eCategory' + i).eq(1).find('option:eq(0)').prop("selected",true);
	}

	if($(category_dir).val() != '0' && $(category_dir).val() > 0){
		eCategory.val($(category_dir).val()).prop('selected', true);
		getProductCategory(depth,$(category_dir).val());
	}
	else{
		$('.md_category').val('0');
	}
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
				} else {
					alert('검색 결과가 없습니다. FTP경로를 다시 입력해주세요.');
				}
			}
		}
	});
}

function previewImg(){
	$('.outfit__area').html('');
	$('.product__area').html('');
	$('.detail__area').html('');

	if(imgData.length == 0){
		alert('상품 이미지 체크를 먼저 진행해주세요');
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
	}
}




function checkSearchType(obj) {
	let action_type = $(obj).attr('action_type');
	let cnt = $('.search_type').length;
	
	if (action_type == "append") {
		if (cnt < 2) {
			let strDiv = "";
			strDiv += '<div class="search_type">';
			strDiv += '    <select class="fSelect eSearch search_type_select" name="search_type[]" style="width:163px;" onChange="changeSearchType(this);">';
			strDiv += '        <option value="" selected>검색분류 선택</option>';
			strDiv += '        <option value="name">상품명</option>';
			strDiv += '        <option value="code">상품코드</option>';
			strDiv += '    </select>';
			strDiv += '    <input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">';
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">+</button>';
			strDiv += '</div>';
			
			$('.search_type_div').append(strDiv);
		} else {
			alert('검색분류를 더이상 추가할 수 없습니다.');
			return false;
		}
	} else if (action_type == "remove") {
		if (cnt > 1) {
			let search_type = $(obj).parent();
			search_type.remove();
		} else if (cnt == 1) {
			alert('1개 이상의 검색분류를 지정해주세요.');
			return false;
		}
	}
}

function changeSearchType(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-product_add').find('.search_type_select').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-product_add').find('.search_type_select').eq(i).val();
		}
		
		const result = search_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 검색분류를 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
		}
	}
}

function checkPriceType(obj) {
	let action_type = $(obj).attr('action_type');
	let cnt = $('.price_type_select').length;
	
	if (action_type == "append") {
		if (cnt < 3) {
			let strDiv = "";
			strDiv += '<div class="content__row price_type">';
			strDiv += '    <select class="fSelect price_type_select" name="price_type[]" style="width:163px;" onChange="changePriceType(this);">';
			strDiv += '        <option value="">상품가격 선택</option>';
			strDiv += '        <option value="SALES_PRICE_KR">한국몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_EN">영문몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_CN">중국몰 가격</option>';
			strDiv += '    </select>';
			
			strDiv += '    <input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> ';
			
			strDiv += '    <font>~</font>';
			
			strDiv += '    <input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>';
			
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">+</button>';
			strDiv += '</div>';
			
			$('.price_type_div').append(strDiv);
		} else {
			alert('검색분류를 더이상 추가할 수 없습니다.');
			return false;
		}
	} else if (action_type == "remove") {
		if (cnt > 1) {
			let search_type = $(obj).parent();
			search_type.remove();
		} else if (cnt == 1) {
			alert('1개 이상의 검색분류를 지정해주세요.');
			return false;
		}
	}
}

function changePriceType(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-product_add').find('.price_type_select').length;
	
	var unit_text = "";
	switch (this_val) {
		case "SALES_PRICE_KR" :
			unit_text = "KRW";
			break;
		
		case "SALES_PRICE_EN" :
			unit_text = "USD";
			break;
		
		case "SALES_PRICE_CN" :
			unit_text = "USD";
			break;
	}
	
	$(obj).parent().find('.price_type_unit').text(unit_text);
	
	if (length > 1) {
		var price_type_arr = [];
		for (var i=0; i<length; i++) {
			price_type_arr[i] = $('#frm-product_add').find('.price_type_select').eq(i).val();
		}
		
		const result = price_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 상품가격 유형을 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
			$('.price_type_unit').text('단위');
		}
	}
}

function changeOrderProduct(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-product_add').find('.sort_value').val(order_value[0]);
	$('#frm-produc_add').find('.sort_type').val(order_value[1]);

	getModalProductList();
}

function changeRowsProduct(obj) {
	var rows = $(obj).val();
	
	$('#frm-product_add').find('.rows').val(rows);
	$('#frm-product_add').find('.page').val(1);

	getModalProductList();
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

function getModalProductList() {
	$("#result_set_product_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="14">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_set_product_table").append(strDiv);
	
	let rows = $("#frm-product_add").find('.rows').val();
	let page = $("#frm-product_add").find('.page').val();
	
	let set_product_list = $('#set_product_list');
	let tmp_product_idx = [];
	if (set_product_list.val().length > 0) {
		tmp_product_idx = set_product_list.val().split(',');
	}
	
	get_contents($("#frm-product_add"),{
		pageObj : $(".modal_product_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_set_product_table").html('');
			}
			d.forEach(function(row) {
				let strDiv = "";
				
				let checked_str = "";
				
				let result = -1;
				result = tmp_product_idx.indexOf(row.product_idx.toString());
				if (result > -1) {
					checked_str = "checked";
				}
				
				strDiv += '<TR>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input id="modal_product_checkbox_' + row.product_idx + '" class="modal_product_checkbox" type="checkbox" name="product_idx[]" value="' + row.product_idx + '" onChange="clickSetProduct(this);" ' + checked_str + '>';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				
				var product_type = "";
				if (row.product_type == "B") {
					product_type = "일반";
				} else if (row.product_type == "S") {
					product_type = "세트";
				}
				strDiv += '    <td>' + product_type + '</td>';
				
				strDiv += '    <td>' + row.style_code + '</td>';
				strDiv += '    <td>' + row.color_code + '</td>';
				strDiv += '    <td>' + row.product_code + '</td>';

				let background_url = "background-image:url('" + row.img_location + "');";
				strDiv += '    <TD>';
				strDiv += '        <div class="product__img__wrap">';
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </TD>';

				let discount_kr = row.discount_kr;
				strDiv += '    <td style="text-align: right;">';
				if (discount_kr > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_kr != null){
						strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let discount_en = row.discount_en;
				strDiv += '    <td style="text-align: right;">';
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_en != null){
						strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let discount_cn = row.discount_cn;
				strDiv += '    <td style="text-align: right;">';
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_cn != null){
						strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let stock_qty = row.stock_qty;
				let order_qty = row.order_qty;
				let safe_qty = row.safe_qty;

				let product_qty = stock_qty - order_qty;

				strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
				strDiv += '    <TD style="width:15%;">';
				strDiv += '        <a href="http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '" onClick="window.open(this.href); return false;">상품 상세 페이지 이동</a>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_set_product_table").append(strDiv);
			});
		},
	},rows, page);
}

function clickSetProduct(obj) {
	let checked = $(obj).prop('checked');
	let product_idx = $(obj).val();
	
	if (checked == true) {
		checkSetProduct(product_idx);
	} else {
		removeSetProduct(product_idx);
	}
}

function checkSetProduct(product_idx) {
	let set_product_list = $('#set_product_list');
	let tmp_idx_arr = [];
	
	if (set_product_list.val().length > 0) {
		tmp_idx_arr = set_product_list.val().split(',');
	}
	
	let result = -1;
	result = tmp_idx_arr.indexOf(product_idx);
	
	if (result < 0) {
		tmp_idx_arr.push(product_idx);
		set_product_list.val(tmp_idx_arr);
		
		addTmpSetProduct(product_idx);
	} else {
		alert('중복된 상품을 세트 상품으로 등록할 수 없습니다.');
		return false;
	}
}

function removeSetProduct(product_idx) {
	let product_idx_arr = [];
	
	$('.set_product_' + product_idx).remove();
	$('#modal_product_checkbox_' + product_idx).prop('checked',false);
	
	let cnt = $('.tmp_set_product').length;
	for (let i=0; i<cnt; i++) {
		let tmp_product_idx = $('.tmp_set_product').eq(i).attr('product_idx');
		product_idx_arr.push(tmp_product_idx);
	}
	
	$('#set_product_list').val(product_idx_arr);
}

function addTmpSetProduct(product_idx) {
	$.ajax({
		url: config.api + "search/modal/product/get",
		type: "post",
		data: {
			'product_idx': product_idx
		},
		dataType: "json",
		error: function() {
			alert('실시간 인게 제품 등록처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				
				let strDiv = '<div class="tmp_set_product set_product_' + data[0].product_idx + '" product_idx="' + data[0].product_idx + '" onClick="removeSetProduct(' + data[0].product_idx + ')">' + data[0].product_code + ' | ' + data[0].product_name + '</div>';
				$('.tmp_set_product_wrap').append(strDiv);
			} else {
				alert('세트 상품 추가 처리에 실패했습니다. 추가하려는 세트 상품을 확인해주세요.');
				return false;
			}
		}
	});
}

function addSetProduct() {
    confirm('선택한 상품을 세트상품으로 등록하시겠습니까?',function(){
        //let set_product_list = $('#set_product_list').val();
        var list_cnt = $('.tmp_set_product_wrap').children().length;
        $('#set_product_list_area').css('visibility','visible');
        for(var i = 0; i < list_cnt; i++){
            var sel_prod = $('.tmp_set_product_wrap').children().eq(i);
			var sel_idx = sel_prod.attr('product_idx');
			if($('#set_product_table').find('input[value="' + sel_idx + '"]').length > 0){
				alert('이미 등록된 상품이 포함되어있습니다.<br>다시 선택해주세요');
			}
			else{
				$.ajax({
					url: config.api + "product/get_new",
					type: "post",
					data: {
						'product_idx': sel_idx
					},
					dataType: "json",
					error: function() {
						alert('상품 읽기 처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						let code = d.code;
						if (code == 200) {
							var row = d.data[0];
							let strDiv = "";

							strDiv += '<TR>';
							strDiv += '    <td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>';
							var product_type = "";
							if (row.product_type == "B") {
								product_type = "일반";
							} else if (row.product_type == "S") {
								product_type = "세트";
							}
							strDiv += '    <td>' + product_type + '</td>';
							
							strDiv += '    <td>' + row.style_code + '</td>';
							strDiv += '    <td>' + row.color_code + '</td>';
							strDiv += '    <td>' + row.product_code + '</td>';

							let background_url = "background-image:url('" + row.img_location + "');";
							strDiv += '    <TD>';
							strDiv += '        <div class="product__img__wrap">';
							strDiv += '            <div class="product__img" style="' + background_url + '">';
							strDiv += '            </div>';
							strDiv += '            <div>';
							strDiv += '                <p>' + row.product_name + '</p><br>';
							strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
							strDiv += '            </div>';
							strDiv += '        </div>';
							strDiv += '    </TD>';

							let discount_kr = row.discount_kr;
							strDiv += '    <td style="text-align: right;">';
							if (discount_kr > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_kr != null){
									strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let discount_en = row.discount_en;
							strDiv += '    <td style="text-align: right;">';
							if (discount_en > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_en != null){
									strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let discount_cn = row.discount_cn;
							strDiv += '    <td style="text-align: right;">';
							if (discount_cn > 0) {
								strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
								strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
								strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
							} else {
								if(row.price_cn != null){
									strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
								}
							}
							strDiv += '    </td>';

							let stock_qty = row.stock_qty;
							let order_qty = row.order_qty;
							let safe_qty = row.safe_qty;

							let product_qty = stock_qty - order_qty;

							strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
							strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
							strDiv += '    <TD style="width:15%;">';
							strDiv += '        <input type="hidden" class="product_idx_list" name="product_idx_list[]" value="' + row.product_idx + '">';
							strDiv += '        <a href="http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '" onClick="window.open(this.href); return false;">상품 상세 페이지 이동</a>';
							strDiv += '    </TD>';
							strDiv += '</TR>';

							$('#set_product_table').append(strDiv);

							$('#insert_table_set_search').toggle();
						} else {
							alert('상품 읽기에 실패했습니다.');
							return false;
						}
					}
				});
			}
        }
    })
}

function setProductDelete(obj){
	var tr_cnt = $(obj).parent().parent().find('tr').length;
	if(tr_cnt <= 2){
		alert('세트 구성 상품이 2개 이하면,<br>구성상품을 삭제할 수 없습니다.')
	}
	else{
		$(obj).parent().remove();
	}
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
		
		var product_type = $('#product_type').val();
		var formData = new FormData();
		formData = $("#frm-update").serializeObject();
		
		var api_addr = '';
		var action_str = '';
		if(product_type == 'B'){
			api_addr = 'put';
			action_str = '독립몰 상품 수정';
		}
		else if(product_type == 'S'){
			api_addr = 'set/put';
			action_str = '세트 상품 수정';
		}
		else{
			alert('모듈에 문제가 발생했습니다.');
			return false;
		}
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "product/" + api_addr,
			error: function() {
				alert(action_str + " 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert(action_str + '이 정상적으로 실행되었습니다.');//,function pageLocation() {
						//location.href = '/product/list';
					//});
				}
			}
		});
	})
}
</script>