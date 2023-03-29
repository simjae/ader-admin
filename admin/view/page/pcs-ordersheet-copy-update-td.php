<style>
	.toggle_table_btn {
		background-color: #fafafa;
		width: 100%;
		border: 1px solid #000000;
		height: 30px;
		cursor: pointer;
	}

	.price__text {
		text-align: right;
	}

	.checked {
		background-color: #707070 !important;
		color: #ffffff !important;
	}

	.unchecked {
		background-color: #ffffff !important;
		color: #000000 !important;
	}

	.btn__gray {
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor: pointer;
	}

	.size_info_text {
		height: 150px;
	}

	.smart_editer_text {
		height: 180px;
	}

	.required_title {
		color: red;
		font-weight: bold
	}
</style>


<div class="content__card">
	<?php
	function getUrlParamter($url, $sch_tag)
	{
		$parts = parse_url($url);
		parse_str($parts['query'], $query);
		return $query[$sch_tag];
	}

	$page_url = $_SERVER['REQUEST_URI'];
	$ordersheet_idx = getUrlParamter($page_url, 'ordersheet_idx');
	?>
	<div class="card__header">
		<div class="flex justify-between">
			<h3>개별상품수정 [TD]</h3>
		</div>
		<div class="drive--x"></div>
	</div>

	<div class="card__body">
		<div id="regist_td_tab" class="row regist_tab" style="margin-top:0px;">
			<form id="frm-regist" action="" enctype="multipart/form-data">
				<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="<?= $ordersheet_idx ?>">

				<input type="hidden" name="update_date" value="">
				<input type="hidden" name="product_code" value="">
				<input type="hidden" name="product_name" value="">

				<input type="hidden" name="overwrite_flg" value="false">

				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('MD');">오더시트 -
						기획MD</button>
					<div class="overflow-x-auto" id="insert_table_MD">
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
									<TH>제품년도</TH>
									<TD id="year"></TD>

									<TH>스타일코드</TH>
									<TD id="style_code"></TD>

									<TH>컬러코드</TH>
									<TD id="color_code"></TD>

									<TH>상품코드</TH>
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
									<TH>소재</TH>
									<TD colspan="3" id="material"></TD>

									<TH>fit</TH>
									<TD colspan="3" id="fit"></TD>
								</TR>
								<TR>
									<TH>프리오더 사용여부</TH>
									<TD colspan="3" id="preorder_flg">

									<TH>교환 환불 가능유무</TH>
									<TD colspan="3" id="refund_flg">
								</TR>
								<tr>
									<TH>라인 유형</TH>
									<TD colspan="3" id="line_info_table">
									<TH>W/K/L/A</TH>
									<TD colspan="3" id="wkla_info_table">
								</tr>
								<tr>
									<TH>MD 카테고리</TH>
									<TD colspan="7">
										<table style="width:100%">
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
									<TH>상품 이름</TH>
									<TD colspan="3" id="product_name"></TD>

									<TH>상품 그래픽</TH>
									<TD colspan="3" id="graphic"></TD>
								</TR>
								<TR>
									<TH>상품 사이즈</TH>
									<TD colspan="3" id="product_size"></TD>

									<TH>상품 색상</TH>
									<TD colspan="3" id="color"></TD>
								</TR>
								<TR>
									<TH>MD 카테고리 가이드</TH>
									<TD colspan="3" id="md_category_guide"></TD>


									<TH>구매수량 제한 유무</TH>
									<TD id="limit_product_qty_flg"></TD>

									<TH>구매 수량 제한</TH>
									<TD id="limit_product_qty"></TD>
								</TR>
								<TR>
									<TH>ID당 구매제한</TH>
									<TD colspan="3" id="limit_id_flg"></TD>

									<TH>구매 멤버 제한</TH>
									<TD colspan="3" id="limit_member"></TD>
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
											<TH>기획원가</TH>
											<TH>한국몰 판매가격 (원)</TH>
											<TH>영문몰 변환가격 (원)</TH>
											<TH>영문몰 판매가격 (달러)</TH>
											<TH>중문몰 판매가격 (달러)</TH>
										</TR>
										<TR>
											<TD id="price_cost" class="price__text"></TD>
											<TD id="price_kr" class="price__text"></TD>
											<TD id="price_kr_gb" class="price__text"></TD>
											<TD id="price_en" class="price__text"></TD>
											<TD id="price_cn" class="price__text"></TD>
										</TR>
									</TBODY>
								</TABLE>
							</div>
						</div>

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
								<tr>
									<TH>기획재고 수량</TH>
									<TD id="product_qty"></TD>

									<TH>안전재고 수량</TH>
									<TD id="safe_qty"></TD>

									<TH>입고 요청일</TH>
									<TD id="receive_request_date"></TD>

									<TH>런칭일</TH>
									<TD id="launching_date"></TD>
								</tr>
							</TBODY>
						</TABLE>
					</div>
				</div>

				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('DSN');">오더시트 -
						디자인</button>
					<div class="overflow-x-auto" id="insert_table_DSN">
						<TABLE class="size_info_table">
							<colgroup>
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="auto">
							</colgroup>
							<TBODY>
								<TR>
									<TD colspan="8">
										<div class="content__row">
											<select id="size_guide_category" name="size_guide_category"
												class="fSelect eSearch" style="width:163px;"
												onChange="getSizeGuideList();">
												<?php
												$select_size_guide_sql = "
														SELECT
															SG.CATEGORY_TYPE	AS CATEGORY_TYPE
														FROM
															ORDERSHEET_MST OM
															LEFT JOIN SIZE_GUIDE SG ON
															OM.SIZE_GUIDE_CATEGORY = SG.CATEGORY_TYPE
														WHERE
															OM.IDX = " . $ordersheet_idx . " AND
															SG.COUNTRY = 'KR'
													";

												$db->query($select_size_guide_sql);

												foreach ($db->fetch() as $size_data) {
													$size_idx = $size_data['CATEGORY_TYPE'];
													if (!empty($size_idx)) {
														?>
														<option value="<?= $size_data['CATEGORY_TYPE'] ?>" readonly>
															<?= $size_data['CATEGORY_TYPE'] ?></option>
														<?php
													} else {
														?>
														<option value="" readonly>사이즈 가이드 미선택</option>
														<?php
													}
												}
												?>
											</select>
										</div>

										<div id="div_size_guide">
										</div>
									</TD>
								</TR>

								<TR id="ordersheet_option_info">

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
									<TH>최초 TP 작성일</TH>
									<TD id="tp_completion_date"></TD>
								</TR>
								<TR>
									<TH style="width:10%;">제품 상세정보 (한글)</TH>
									<TD class="smart_editer_text" id="detail_kr"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (영문)</TH>
									<TD class="smart_editer_text" id="detail_en"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (중문)</TH>
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
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (한글)</TH>
									<TD class="smart_editer_text" id="care_dsn_kr"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (영문)</TH>
									<TD class="smart_editer_text" id="care_dsn_en"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (중문)</TH>
									<TD class="smart_editer_text" id="care_dsn_cn"></TD>
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
									<TH style="width:10%;">디자인-소재 (한글)</TH>
									<TD class="smart_editer_text" id="material_dsn_kr"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">디자인-소재 (영문)</TH>
									<TD class="smart_editer_text" id="material_dsn_en"></TD>
								</TR>

								<TR>
									<TH style="width:10%;">디자인-소재 (중문)</TH>
									<TD class="smart_editer_text" id="material_dsn_cn"></TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('TD');">오더시트 - 생산</button>
					<div class="" id="insert_table_TD">
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>
										<p class="required_title">* 제품 취급 유의사항<br>생산 (한글)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="kr" onclick="initCareStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="care_td_kr" name="care_td_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TH>
										<p class="required_title">* 제품 취급 유의사항<br>생산 (영문)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="en" onclick="initCareStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="care_td_en" name="care_td_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TH>
										<p class="required_title">* 제품 취급 유의사항<br>생산 (중문)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="cn" onclick="initCareStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="care_td_cn" name="care_td_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								<TR>
									<TH>
										<p class="required_title">* 생산-소재 (한글)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="kr" onclick="initMaterialStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="material_td_kr" name="material_td_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH>
										<p class="required_title">* 생산-소재 (영문)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="en" onclick="initMaterialStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="material_td_en" name="material_td_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH>
										<p class="required_title">* 생산-소재 (중문)</p>
										<button type="button"
											style="width:40%;background-color: #ffffff;margin-left:30%;margin-top:50px"
											country="cn" onclick="initMaterialStr(this)">초기화</button>
									</TH>
									<TD>
										<textarea class="width-100p" id="material_td_cn" name="material_td_cn"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						<TABLE style="margin-top:50px">
							<colgroup>
								<col width="10%">
								<col width="40%">
								<col width="10%">
								<col width="40%">
							</colgroup>
							<TBODY>
								<TR>
									<TD>제조사</TD>
									<TD>
										<input type="text" id="manufacturer" name="manufacturer" value="">
									</TD>

									<TD>공급사</TD>
									<TD>
										<input type="text" id="supplier" name="supplier" value="">
									</TD>
								</TR>
								<TR>
									<TD>원산지</TD>
									<TD>
										<input type="text" id="origin_country" name="origin_country" value="">
									</TD>

									<TD>브랜드</TD>
									<TD id="brand"></TD>
								</TR>
								<tr>
									<TD>상품 적재박스 유형</TD>
									<TD colspan="3">
										<div class="content__row">
											<select id="load_box_idx" name="load_box_idx" class="fSelect eSearch"
												style="width:163px;" onChange="getBoxInfo();">
												<option value="0">박스를 선택해주세요</option>
												<?php
												$select_box_info_sql = "
																	SELECT
																		IDX				AS BOX_IDX,
																		BOX_NAME		AS BOX_NAME
																	FROM
																		BOX_INFO
																";

												$db->query($select_box_info_sql);

												foreach ($db->fetch() as $box_data) {
													?>
													<option value="<?= $box_data['BOX_IDX'] ?>"><?= $box_data['BOX_NAME'] ?>
													</option>
													<?php
												}
												?>
											</select>
										</div>

										<div id="div_box" style="margin-top:5px">
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
										<input id="load_qty" class="product_volume" type="number" name="load_qty"
											value="0">
									</TD>
								</tr>
								<tr>
									<td>부자재 검색</td>
									<td colspan="3">
										<input type="hidden" id="param_json">
										<div class="btn" onclick="openSubMaterialModal()">검색창 열기</div>
									</td>
								</tr>
								<tr>
									<TD>포장부자재</TD>
									<TD colspan="3">
										<div class="form-group td"></div>
									</TD>
								</tr>
								<tr>
									<TD>배송부자재</TD>
									<TD colspan="3">
										<div class="form-group delivery"></div>
									</TD>
								</tr>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</form>
		</div>
	</div>



</div>
<div class="flex justify-center">
	<button type="button"
		style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
		onClick="confirm('오더시트 생산정보를 등록하시겠습니까?.','ordersheetTdUpdate()');">개별상품[TD] 업데이트</button>
</div>
</div>
</div>
<script>
	var size_category_info = {};

	var care_td_kr = [];
	var care_td_en = [];
	var care_td_cn = [];

	var material_td_kr = [];
	var material_td_en = [];
	var material_td_cn = [];

	var care_dsn_kr_html = '';
	var care_dsn_en_html = '';
	var care_dsn_cn_html = '';

	function setSmartEditor() {
		//care_td
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: care_td_kr,
			elPlaceHolder: "care_td_kr",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: care_td_en,
			elPlaceHolder: "care_td_en",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: care_td_cn,
			elPlaceHolder: "care_td_cn",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
		//material
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: material_td_kr,
			elPlaceHolder: "material_td_kr",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: material_td_en,
			elPlaceHolder: "material_td_en",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
		nhn.husky.EZCreator.createInIFrame({
			oAppRef: material_td_cn,
			elPlaceHolder: "material_td_cn",
			sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
			htParams: { fOnBeforeUnload: function () { } }
		});
	}

	$(document).ready(function () {
		setSmartEditor();
		productVolumeCalc();

		$('#insert_table_MD').toggle();
		$('#insert_table_DSN').toggle();

		getOrdersheetInfo_TD();
	});

	function toggleTableClick(toggle_val) {
		$('#insert_table_' + toggle_val).toggle();
	}

	function getOrdersheetInfo_TD() {
		let ordersheet_idx = $('#ordersheet_idx').val();

		$.ajax({
			type: "post",
			data: {
				'sel_idx': ordersheet_idx
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet_copy/get",
			error: function () {
				alert("오더시트 생산정보 조회처리중 오류가 발생했습니다.");
			},
			success: function (d) {
				if (d.code == 200) {
					var data = d.data;
					$('input[name=update_date]').val(data.update_date);
					$('input[name=product_name]').val(data.product_name);
					$('input[name=product_code]').val(data.product_code);

					//기획 MD
					$('#year').text(data.year);
					$('#style_code').text(data.style_code);
					$('#color_code').text(data.color_code);
					$('#product_code').text(data.product_code);
					$('#material').text(data.material);
					$('#fit').text(data.fit);
					switch (data.preorder_flg) {
						case 0:
							$('#preorder_flg').text('고객상품');
							break;
						case 1:
							$('#preorder_flg').text('프리오더 상품');
							break;
					}

					switch (data.refund_flg) {
						case 0:
							$('#refund_flg').text('교환 불가');
							break;
						case 1:
							$('#refund_flg').text('교환 가능');
					}

					if (data.line_idx != null && data.line_idx > 0) {
						let strDiv = "";
						strDiv += '    <table style="width:100%">';
						strDiv += '        <thead>';
						strDiv += '            <tr>';
						strDiv += '                <th>라인명</th>';
						strDiv += '                <th>타입</th>';
						strDiv += '                <th>색깔</th>';
						strDiv += '            </tr>';
						strDiv += '        </thead>';
						strDiv += '        <tbody>';
						strDiv += '            <tr>';
						strDiv += '                <td>' + data.line_name + '</td>';
						strDiv += '                <td>' + data.line_type + '</td>';
						strDiv += '                <td>' + data.line_memo + '</td>';
						strDiv += '            </tr>';
						strDiv += '        </tbody>';
						strDiv += '    </table>';

						$('#line_info_table').append(strDiv);
					}

					if (data.wkla_idx != null && data.wkla_idx > 0) {
						let strDiv = "";
						strDiv += '    <table style="width:100%">';
						strDiv += '        <thead>';
						strDiv += '            <tr>';
						strDiv += '                <th>W/K/L/A</th>';
						strDiv += '                <th>비고</th>';
						strDiv += '            </tr>';
						strDiv += '        </thead>';
						strDiv += '        <tbody>';
						strDiv += '            <tr>';
						strDiv += '                <td>' + data.wkla_name + '</td>';
						strDiv += '                <td>' + data.wkla_memo + '</td>';
						strDiv += '            </tr>';
						strDiv += '        </tbody>';
						strDiv += '    </table>';

						$('#wkla_info_table').append(strDiv);
					}

					$('#category_lrg_title').text(data.category_lrg_title);
					$('#category_mdl_title').text(data.category_mdl_title);
					$('#category_sml_title').text(data.category_sml_title);
					$('#category_dtl_title').text(data.category_dtl_title);
					$('#graphic').text(data.graphic);
					$('#product_name').text(data.product_name);
					$('#product_size').text(data.product_size);
					$('#color').text(data.color);
					$('#md_category_guide').text(data.md_category_guide);
					$('#limit_id_flg').text(data.limit_id_flg == 1 ? '제한함' : '제한안함');
					$('#limit_product_qty_flg').text(data.limit_product_qty_flg == 1 ? '제한함' : '제한안함');
					$('#limit_product_qty').text(data.limit_product_qty);
					$('#limit_member').text(data.limit_member);
					$('#price_cost').text(data.price_cost_format);
					$('#price_kr').text(data.price_kr_format);
					$('#price_kr_gb').text(data.price_kr_gb_format);
					$('#price_en').text(data.price_en_format);
					$('#price_cn').text(data.price_cn_format);
					$('#product_qty').text(data.product_qty);
					$('#safe_qty').text(data.safe_qty);
					$('#launching_date').text(data.launching_date);
					$('#receive_request_date').text(data.receive_request_date);

					//dsn
					$('#tp_completion_date').text(data.tp_completion_date);

					$('#size_category').text(data.size_category);
					$('#detail_kr').html(data.detail_kr);
					$('#detail_en').html(data.detail_en);
					$('#detail_cn').html(data.detail_cn);
					$('#care_dsn_kr').html(data.care_dsn_kr);
					$('#care_dsn_en').html(data.care_dsn_en);
					$('#care_dsn_cn').html(data.care_dsn_cn);
					$('#material_dsn_kr').html(data.material_dsn_kr);
					$('#material_dsn_en').html(data.material_dsn_en);
					$('#material_dsn_cn').html(data.material_dsn_cn);
					care_dsn_kr_html = data.care_dsn_kr;
					care_dsn_en_html = data.care_dsn_en;
					care_dsn_cn_html = data.care_dsn_cn;

					material_dsn_kr_html = data.material_dsn_kr;
					material_dsn_en_html = data.material_dsn_en;
					material_dsn_cn_html = data.material_dsn_cn;

					let option_info = data.option_info;
					getSizeGuideList(option_info);

					//생산
					if (data.care_td_kr != null && data.care_td_kr.length > 0) {
						$('#care_td_kr').html(data.care_td_kr);
					}
					else {
						$('#care_td_kr').html(data.care_dsn_kr);
					}

					if (data.care_td_en != null && data.care_td_en.length > 0) {
						$('#care_td_en').html(data.care_td_en);
					}
					else {
						$('#care_td_en').html(data.care_dsn_en);
					}

					if (data.care_td_cn != null && data.care_td_cn.length > 0) {
						$('#care_td_cn').html(data.care_td_cn);
					}
					else {
						$('#care_td_cn').html(data.care_dsn_cn);
					}

					if (data.material_td_kr != null && data.material_td_kr.length > 0) {
						$('#material_td_kr').html(data.material_td_kr);
					}
					else {
						$('#material_td_kr').html(data.material_dsn_kr);
					}

					if (data.material_td_en != null && data.material_td_en.length > 0) {
						$('#material_td_en').html(data.material_td_en);
					}
					else {
						$('#material_td_en').html(data.material_dsn_en);
					}

					if (data.material_td_cn != null && data.material_td_cn.length > 0) {
						$('#material_td_cn').html(data.material_td_cn);
					}
					else {
						$('#material_td_cn').html(data.material_dsn_cn);
					}
					$('#manufacturer').val(data.manufacturer);
					$('#supplier').val(data.supplier);
					$('#origin_country').val(data.origin_country);
					$('#brand').text(data.brand);

					var sub_info = data.sub_material_info;

					sub_info.forEach(function (sub_data) {
						var strChekbox = '';
						var tableClass = '';
						var inputName = '';
						if (sub_data.sub_material_type == 'T') {
							tableClass = '.form-group.td';
							inputName = 'td_sub_material_idx';
						}
						else if (sub_data.sub_material_type == 'D') {
							tableClass = '.form-group.delivery';
							inputName = 'delivery_sub_material_idx';
						}

						let strDiv = "";
						strDiv += '<div class="content__row" style="margin-bottom:5px;">';
						strDiv += '    <label>';
						strDiv += '        <input type="checkbox" class="sub__idx" name="' + inputName + '[]" value="' + sub_data.sub_material_idx + '" checked>';
						strDiv += '        <span>' + sub_data.sub_material_name + '</span>';
						strDiv += '        <input type="hidden" class="sub__memo" value="' + sub_data.sub_material_memo + '">';
						strDiv += '    </label>';
						strDiv += '</div>';

						$(tableClass).append(strDiv);
					});

					let load_box_idx = data.load_box_idx;
					$('#load_box_idx').val(load_box_idx);
					getBoxInfo();

					//$('#load_box_idx option:contains("' + data.load_box_idx + '")').attr("selected","selected").change();
					//$('#deliver_box_idx option:contains("' + data.deliver_box_idx + '")').attr("selected","selected").change();
					$('#load_weight').val(data.load_weight);
					$('#load_qty').val(data.load_qty);
					$('#sub_material_code').val(data.sub_material_code);
				}
			}
		});
	}

	function getWklaInfo(wkla_idx) {
		let div_wkla = $('#div_wkla');
		div_wkla.html('');

		if (wkla_idx > 0) {
			$.ajax({
				type: "post",
				url: config.api + "pcs/ordersheet/dsn/wkla/get",
				data: {
					'sel_wkla_idx': wkla_idx
				},
				dataType: "json",
				error: function () {
					alert("W/K/L/A 정보 조회처리중 오류가 발생했습니다.");
				},
				success: function (d) {
					if (d.code == 200) {
						let data = d.data[0];
						if (data != null) {
							let strDiv = "";
							strDiv += '    <table style="width:100%">';
							strDiv += '        <thead>';
							strDiv += '            <tr>';
							strDiv += '                <th style="width:50%;">W/K/L/A</th>';
							strDiv += '                <th style="width:50%;">비고</th>';
							strDiv += '            </tr>';
							strDiv += '        </thead>';
							strDiv += '        <tbody>';
							strDiv += '            <tr>';
							strDiv += '                <td>' + data.wkla_name + '</td>';
							strDiv += '                <td>' + data.wkla_memo + '</td>';
							strDiv += '            </tr>';
							strDiv += '        </tbody>';
							strDiv += '    </table>';

							div_wkla.append(strDiv);
						}
					}
				}
			});
		} else {
			let strDiv = "";
			strDiv += '    <table style="width:40%">';
			strDiv += '        <thead>';
			strDiv += '            <tr>';
			strDiv += '                <th style="width:50%;">W/K/L/A</th>';
			strDiv += '                <th style="width:50%;">비고</th>';
			strDiv += '            </tr>';
			strDiv += '        </thead>';
			strDiv += '        <tbody>';
			strDiv += '            <tr>';
			strDiv += '                <td colspan="2">등록된 W/K/L/A 정보가 없습니다.</td>';
			strDiv += '            </tr>';
			strDiv += '        </tbody>';
			strDiv += '    </table>';

			div_wkla.append(strDiv);
		}
	}

	function getBoxInfo() {
		let box_idx = $('#load_box_idx').val();

		$('#div_box').html('');

		if (box_idx > 0) {
			$.ajax({
				type: "post",
				data: {
					'sel_box_idx': box_idx
				},
				dataType: "json",
				url: config.api + "pcs/ordersheet/td/box/get",
				error: function () {
					alert("박스정보 조회처리중 오류가 발생했습니다.");
				},
				success: function (d) {
					if (d.code == 200) {
						if (d.data != null) {
							var box_info = d.data[0];

							let strDiv = "";
							strDiv += '<table>';
							strDiv += '    <thead>';
							strDiv += '        <tr>';
							strDiv += '            <th>상자명</th>';
							strDiv += '            <th>너비</th>';
							strDiv += '            <th>길이</th>';
							strDiv += '            <th>높이</th>';
							strDiv += '            <th>부피</th>';
							strDiv += '        </tr>';
							strDiv += '    </thead>';
							strDiv += '    <tbody>';
							strDiv += '        <tr>';
							strDiv += '            <td>' + box_info.box_name + '</td>';
							strDiv += '            <td>' + box_info.box_width + ' cm</td>';
							strDiv += '            <td>' + box_info.box_length + ' cm</td>';
							strDiv += '            <td>' + box_info.box_height + ' cm</td>';
							strDiv += '            <td>' + box_info.box_volume + ' cm³</td>';
							strDiv += '        </tr>';
							strDiv += '    </tbody>';
							strDiv += '</table>';

							$('#div_box').append(strDiv);
						}
					}
				}
			});
		}
	}

	function getSizeGuideList(option_info) {
		let size_guide_category = $('#size_guide_category').val();
	
		$.ajax({
			type: "post",
			url: config.api + "product/size_guide/get",
			data: {
				'size_guide_category' : size_guide_category
			},
			dataType: "json",
			error: function () {
				alert("사이즈정보 조회처리중 오류가 발생했습니다.");
			},
			success: function (d) {
				if (d.code == 200) {
					let data = d.data;
					if (data != null) {
						let size_data = d.data[0];

						let str_div_option_th = "";
						let colspan_cnt = 0;

						let str_div_size_desc = "";
						str_div_size_desc += '    <div style="float:left;width: 33%;">';
						str_div_size_desc += '        <img id="size_img" src="/images/size/' + size_data.img_file_name + '.svg">';
						str_div_size_desc += '    </div>';
						str_div_size_desc += '    <div style="float:left;width: 50%;padding-top:50px;">';
						str_div_size_desc += '        <table>';

						if (size_data.size_title_1 != null && size_data.size_desc_1 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_1 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_1 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_1 + '</TH>';
							colspan_cnt++;
						}

						if (size_data.size_title_2 != null && size_data.size_desc_2 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_2 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_2 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_2 + '</TH>';
							colspan_cnt++;
						}

						if (size_data.size_title_3 != null && size_data.size_desc_3 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_3 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_3 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_3 + '</TH>';
							colspan_cnt++;
						}

						if (size_data.size_title_4 != null && size_data.size_desc_4 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_4 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_4 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_4 + '</TH>';
							colspan_cnt++;
						}

						if (size_data.size_title_5 != null && size_data.size_desc_5 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_5 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_5 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_5 + '</TH>';
							colspan_cnt++;
						}

						if (size_data.size_title_6 != null && size_data.size_desc_6 != null) {
							str_div_size_desc += '        <tr class="tr_size">';
							str_div_size_desc += '            <td class="size_title">' + size_data.size_title_6 + '</td>';
							str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_6 + '</td>';
							str_div_size_desc += '        </tr>';

							str_div_option_th += '            <TH>' + size_data.size_title_6 + '</TH>';
							colspan_cnt++;
						}

						str_div_size_desc += '        </table>';
						str_div_size_desc += '    </div>';

						$('#div_size_guide').html('');
						$('#div_size_guide').append(str_div_size_desc);

						let str_div_option_table = "";

						str_div_option_table += '<TD colspan="8">';
						str_div_option_table += '    <TABLE>';
						str_div_option_table += '        <THEAD>';
						str_div_option_table += '            <TR>';
						str_div_option_table += '                <TH>옵션이름</TH>';
						str_div_option_table += '                <TH>바코드</TH>';

						str_div_option_table += str_div_option_th;

						str_div_option_table += '                <TH>중량</TH>';
						str_div_option_table += '                <TH>구매수량제한</TH>';
						str_div_option_table += '            </TR>';
						str_div_option_table += '        </THEAD>';
						str_div_option_table += '        <TBODY id="option_info">';
						str_div_option_table += '            <TR>';
						str_div_option_table += '                <TD colspan="' + (colspan_cnt + 4) + '">등록된 옵션정보가 없습니다.</TD>';
						str_div_option_table += '            </TR>';
						str_div_option_table += '        </TBODY>';
						str_div_option_table += '    </TABLE>';
						str_div_option_table += '</TD>';

						$('#ordersheet_option_info').html('');
						$('#ordersheet_option_info').append(str_div_option_table);
						$('#ordersheet_option_info').show();

						if (option_info.length > 0) {
							setOptionInfo(option_info);
						}
					}
				} else {
					alert(d.msg);
				}
			}
		});
	}

	function setOptionInfo(option_info) {
		$('#option_info').html('');

		let strDiv = "";
		option_info.forEach(function (row) {
			strDiv += '<TR>';
			strDiv += '    <TD>' + row.option_name + '</TD>';
			strDiv += '    <TD>' + row.barcode + '</TD>';

			if (row.option_size_1 != "") {
				strDiv += '<TD>' + row.option_size_1 + '</TD>';
			}

			if (row.option_size_2 != "") {
				strDiv += '<TD>' + row.option_size_2 + '</TD>';
			}

			if (row.option_size_3 != "") {
				strDiv += '<TD>' + row.option_size_3 + '</TD>';
			}

			if (row.option_size_4 != "") {
				strDiv += '<TD>' + row.option_size_4 + '</TD>';
			}

			if (row.option_size_5 != "") {
				strDiv += '<TD>' + row.option_size_5 + '</TD>';
			}

			if (row.option_size_6 != "") {
				strDiv += '<TD>' + row.option_size_6 + '</TD>';
			}

			strDiv += '    <TD>' + row.option_weight + '</TD>';
			strDiv += '    <TD>' + row.limit_option_qty + '</TD>';
			strDiv += '</TR>';
		});

		$('#option_info').append(strDiv);
	}

	function productVolumeCalc() {
		$('.product_volume').change(function () {
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
		care_td_kr.getById["care_td_kr"].exec("UPDATE_CONTENTS_FIELD", []);
		care_td_en.getById["care_td_en"].exec("UPDATE_CONTENTS_FIELD", []);
		care_td_cn.getById["care_td_cn"].exec("UPDATE_CONTENTS_FIELD", []);

		material_td_kr.getById["material_td_kr"].exec("UPDATE_CONTENTS_FIELD", []);
		material_td_en.getById["material_td_en"].exec("UPDATE_CONTENTS_FIELD", []);
		material_td_cn.getById["material_td_cn"].exec("UPDATE_CONTENTS_FIELD", []);

		if (flg != undefined) {
			$('input[name=overwrite_flg]').val(flg);
		}

		var form = $("#frm-regist")[0];
		var formData = new FormData(form);

		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "pcs/ordersheet_copy/td/put",
			cache: false,
			contentType: false,
			processData: false,
			error: function () {
				alert("오더시트 생산정보 작성처리중 오류가 발생했습니다.");
			},
			success: function (d) {
				if (d.code == 200) {
					alert('상품정보가 정상적으로 작성되었습니다.', function pageLocation() {
						location.href = '/pcs/ordersheet/list/copy';
					});
				}
				else {
					switch (d.code) {
						case 300:
							confirm(d.msg, function () {
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

	function openBoxInfoModal(box_type) {
		var modal_addr = "";
		switch (box_type) {
			case 'load':
				modal_addr = '/load_box';
				break;
			case 'deliver':
				modal_addr = '/deliver_box';
				break;
		}
		modal(modal_addr, null);
	}

	function initCareStr(obj) {
		var country = $(obj).attr('country');
		if (country != null) {
			switch (country) {
				case 'kr':
					care_td_kr.getById["care_td_kr"].exec("SET_IR", [""]);
					care_td_kr.getById["care_td_kr"].exec("PASTE_HTML", [care_dsn_kr_html]);
					break;
				case 'en':
					care_td_en.getById["care_td_en"].exec("SET_IR", [""]);
					care_td_en.getById["care_td_en"].exec("PASTE_HTML", [care_dsn_en_html]);
					break;
				case 'cn':
					care_td_cn.getById["care_td_cn"].exec("SET_IR", [""]);
					care_td_cn.getById["care_td_cn"].exec("PASTE_HTML", [care_dsn_cn_html]);
					break;
			}
		}
	}
	function initMaterialStr(obj) {
		var country = $(obj).attr('country');
		if (country != null) {
			switch (country) {
				case 'kr':
					material_td_kr.getById["material_td_kr"].exec("SET_IR", [""]);
					material_td_kr.getById["material_td_kr"].exec("PASTE_HTML", [material_dsn_kr_html]);
					break;
				case 'en':
					material_td_en.getById["material_td_en"].exec("SET_IR", [""]);
					material_td_en.getById["material_td_en"].exec("PASTE_HTML", [material_dsn_en_html]);
					break;
				case 'cn':
					material_td_cn.getById["material_td_cn"].exec("SET_IR", [""]);
					material_td_cn.getById["material_td_cn"].exec("PASTE_HTML", [material_dsn_cn_html]);
					break;
			}
		}
	}

	function openSubMaterialModal() {
		var sub_json = {};
		var temp_arr = [];

		$('.td, .delivery').children().each(function () {
			sub_json = {};

			sub_json.sub_idx = $(this).find('.sub__idx').val();
			sub_json.sub_checked = $(this).find('.sub__idx').prop('checked');
			sub_json.sub_name = $(this).find('span').text();
			sub_json.sub_memo = $(this).find('.sub__memo').val();

			if ($(this).parent().hasClass('td') == true) {
				sub_json.sub_type = 'T';
			}
			else if ($(this).parent().hasClass('delivery') == true) {
				sub_json.sub_type = 'D';
			}
			temp_arr.push(sub_json);
		})

		var param_json = {};

		param_json[0] = $('#ordersheet_idx').val();
		param_json[1] = temp_arr;

		var json_str = JSON.stringify(param_json);
		modal('/sub_material', `json_str=${json_str}`);
	}
</script>