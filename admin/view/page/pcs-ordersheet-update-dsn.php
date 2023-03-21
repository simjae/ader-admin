<style>
.toggle_table_btn {background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;}
.price__text{text-align:right;}
.checked {background-color: #707070 !important;color: #ffffff !important;}
.unchecked {background-color: #ffffff !important;color: #000000 !important;}
.btn__gray {height: 20px;color: #fff;padding: 3.5px 20px;border-radius: 2px;background-color: #bfbfbf;cursor: pointer;}
.size_textarea {width: 90%;height: 150px;resize: none;border: solid 1px #bfbfbf;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
.size__option__row {display: grid;grid-template-columns: 30px 450px 30px;gap: 10px;align-items: center;}
.option__info input[type='text'] {width: 100px;}
.option__info textarea {width: 200px;height: 150px;resize: none;border: solid 1px #bfbfbf}
#reset_option_btn {width:50px;height:30px;border:1px solid #000000;cursor:pointer;background-color:#ffffff;color:#000000;cursor:pointer;}
.reset_tmp_option {height:28px;margin-left:15px;}
.add_tmp_option {height:28px;margin-left:15px;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$ordersheet_idx = getUrlParamter($page_url, 'ordersheet_idx');
	?>
	<div class="card__header">
		<div class="flex justify-between">
			<h3>개별상품수정 [DSN]</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div id="regist_dsn_tab" class="row regist_tab" style="margin-top:0px;">
			<form id="frm-regist" action="" enctype="multipart/form-data">
				<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="<?=$ordersheet_idx?>">
				
				<input type="hidden" name="update_date" value="">
				<input type="hidden" name="product_code" value="">
				<input type="hidden" name="product_name" value="">
				
				<input type="hidden" name="overwrite_flg" value="false">
				
				<div class="table table__wrap">
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('MD');">오더시트 - 기획MD</button>
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
									<TH>프리오더 사용여부</TH>
									<TD colspan="3" id="preorder_flg">
									
									<TH>교환 환불 가능유무</TH>
									<TD colspan="3" id="refund_flg">
								</TR>
								<tr>
									<TH>라인 유형</TH>
									<TD colspan="3" id="line_info_table">
									
									<TH>MD 카테고리</TH>
									<TD colspan="3">
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
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('TD');">오더시트 - 생산</button>
					<div class="overflow-x-auto" id="insert_table_TD">
						<TABLE>
							<colgroup>
								<col width="10%">
								<col width="90%">
							</colgroup>
							<TBODY>
								<TR>
									<TH>제품 취급 유의사항<br>생산(한글)</TH>
									<TD class="smart_editer_text" id="care_td_kr"></TD>
								</TR>
								<TR>
									<TH>제품 취급 유의사항<br>생산(영문)</TH>
									<TD class="smart_editer_text" id="care_td_en"></TD>
								</TR>
								<TR>
									<TH>제품 취급 유의사항<br>생산(중문)</TH>
									<TD class="smart_editer_text" id="care_td_cn"></TD>
								</TR>
								<TR>
									<TH>소재(한글)</TH>
									<TD class="smart_editer_text" id="material_kr"></TD>
								</TR>

								<TR>
									<TH>소재(영문)</TH>
									<TD class="smart_editer_text" id="material_en"></TD>
								</TR>

								<TR>
									<TH>소재(중문)</TH>
									<TD class="smart_editer_text" id="material_cn"></TD>
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
									<TH>제조사</TD>
									<TD id="manufacturer"></TD>
									
									<TH>공급사</TD>
									<TD id="supplier"></TD>
								</TR>
								<TR>
									<TH>원산지</TH>
									<TD id="origin_country"></TD>
									
									<TH>브랜드</TH>
									<TD id="brand"></TD>
								</TR>
								<tr>
									<TH>상품 적재박스 유형</TH>
									<TD colspan="3" id="load_box_info_table">
								</tr>
								<tr>
									<TH>상품 적재중량 (kg)</TH>
									<TD id="load_weight"></TD>
									
									<TH>상품 적재수량</TH>
									<TD id="load_qty"></TD>
								</tr>
								<tr>
									<TH>포장부자재</TH>
									<TD>
										<table style="width:50%">
											<tbody id="td_sub_material"></tbody>
										</table>
									</TD>
									
									<TH>배송부자재</TH>
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
					<button class="toggle_table_btn" type="button" onClick="toggleTableClick('DSN');">오더시트 - 디자인</button>
					<div class="overflow-x-auto" id="insert_table_DSN">
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
									<TD>
										<input type="text" id="material" name="material" value="">
									</TD>
									
									<TH>fit</TH>
									<TD>
										<input type="text" id="fit" name="fit" value="">
									</TD>
									
									<TH>RGB 코드</TH>
									<TD>
										<input type="text" id="color_rgb" name="color_rgb" value="">
									</TD>
									
									<TH>팬톤코드</TH>
									<TD>
										<input type="text" id="pantone_code" name="pantone_code" value="">
									</TD>
								</TR>
								
								<tr>
									<TH>W/K/L/A</TH>
									<TD colspan="3">
										<div class="content__row">
											<select id="wkla_idx" name="wkla_idx" class="fSelect eSearch" style="width:163px;" onChange="getWklaInfo();">
												<option value="0">WKLA을 선택해주세요</option>
												<?php
													$select_wkla_sql = "
														SELECT
															WK.IDX			AS WKLA_IDX,
															WK.WKLA_NAME	AS WKLA_NAME
														FROM
															dev.WKLA_INFO WK
													";
													
													$db->query($select_wkla_sql);
													
													foreach($db->fetch() as $wkla_data) {
												?>
												<option value="<?=$wkla_data['WKLA_IDX']?>"><?=$wkla_data['WKLA_NAME']?></option>
												<?php												
													}
												?>
											</select>
										</div>
										
										<div id="div_wkla" style="margin-top:5px">
										</div>
									</TD>
									
									<TH>모델</TH>
									<TD>
										<input type="text" id="model" name="model" value="">
									</TD>
									
									<TH>모델착용 사이즈</TH>
									<TD>
										<input type="text" id="model_wear" name="model_wear" value="">
									</TD>
								</TR>
								
								<TR>
									<TH>최초 TP 작성일</TH>
									<TD colspan="7">
										<input id="tp_completion_date" type="date" name="tp_completion_date" value="" date_type="tp_completion">
									</TD>
								</TR>
								
								<TR>
									<TD colspan="12">
										<div class="content__row">
											<select id="size_guide_idx" name="size_guide_idx" class="fSelect eSearch" style="width:163px;" onChange="getSizeGuideList();">
												<option value="0">사이즈가이드</option>
												<?php
													$select_size_guide_sql = "
														SELECT
															SG.IDX				AS SIZE_IDX,
															SG.CATEGORY_TYPE	AS CATEGORY_TYPE
														FROM
															dev.SIZE_GUIDE	SG
														WHERE
															SG.COUNTRY = 'KR'
														ORDER BY
															IDX ASC
													";
													
													$db->query($select_size_guide_sql);

													foreach ($db->fetch() as $size_data) {
												?>
													<option value="<?=$size_data['SIZE_IDX']?>"><?=$size_data['CATEGORY_TYPE']?></option>
												<?php
													}
												?>
											</select>
											
											<button id="reset_option_btn" onClick="resetOrdersheetOption();">초기화</button>
										</div>
										
										<div id="div_size_guide">
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD>일반</TD>
									<TD colspan="7">
										<div class="rd__block">
											<input id="size_name_Onesize" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_Onesize">Onesize</label>
											
											<input id="size_name_A1" class="size_name" type="radio" name="size_name" value="1">
											<label for="size_name_A1">A1</label>
											
											<input id="size_name_A2" class="size_name" type="radio" name="size_name" value="2">
											<label for="size_name_A2">A2</label>
											
											<input id="size_name_A3" class="size_name" type="radio" name="size_name" value="3">
											<label for="size_name_A3">A3</label>
											
											<input id="size_name_A4" class="size_name" type="radio" name="size_name" value="4">
											<label for="size_name_A4">A4</label>
											
											<input id="size_name_A5" class="size_name" type="radio" name="size_name" value="5">
											<label for="size_name_A5">A5</label>
											
											<input id="size_name_XS" class="size_name" type="radio" name="size_name" value="XS">
											<label for="size_name_XS">XS</label>
											
											<input id="size_name_S" class="size_name" type="radio" name="size_name" value="S">
											<label for="size_name_S">S</label>
											
											<input id="size_name_M" class="size_name" type="radio" name="size_name" value="M">
											<label for="size_name_M">M</label>
											
											<input id="size_name_L" class="size_name" type="radio" name="size_name" value="L">
											<label for="size_name_L">L</label>
											
											<input id="size_name_XL" class="size_name" type="radio" name="size_name" value="XL">
											<label for="size_name_XL">XL</label>
											
											<input id="size_name_2XL" class="size_name" type="radio" name="size_name" value="2XL">
											<label for="size_name_2XL">2XL</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD>신발 23FW</TD>
									<TD colspan="7">
										<div class="rd__block">
											<input id="size_name_23_2H" class="size_name" type="radio" name="size_name" value="2H">
											<label for="size_name_23_2H">225</label>
											
											<input id="size_name_23_36" class="size_name" type="radio" name="size_name" value="36">
											<label for="size_name_23_36">230</label>
											
											<input id="size_name_23_3H" class="size_name" type="radio" name="size_name" value="3H">
											<label for="size_name_23_3H">235</label>
											
											<input id="size_name_23_37" class="size_name" type="radio" name="size_name" value="37">
											<label for="size_name_23_37">240</label>
											
											<input id="size_name_23_4H" class="size_name" type="radio" name="size_name" value="4H">
											<label for="size_name_23_4H">245</label>
											
											<input id="size_name_23_40" class="size_name" type="radio" name="size_name" value="40">
											<label for="size_name_23_40">250</label>
											
											<input id="size_name_23_5H" class="size_name" type="radio" name="size_name" value="5H">
											<label for="size_name_23_5H">255</label>
											
											<input id="size_name_23_41" class="size_name" type="radio" name="size_name" value="41">
											<label for="size_name_23_41">260</label>
											
											<input id="size_name_23_6H" class="size_name" type="radio" name="size_name" value="6H">
											<label for="size_name_23_6H">265</label>
											
											<input id="size_name_23_42" class="size_name" type="radio" name="size_name" value="42">
											<label for="size_name_23_42">270</label>
											
											<input id="size_name_23_7H" class="size_name" type="radio" name="size_name" value="7H">
											<label for="size_name_23_7H">275</label>
											
											<input id="size_name_23_43" class="size_name" type="radio" name="size_name" value="43">
											<label for="size_name_23_43">280</label>
											
											<input id="size_name_23_8H" class="size_name" type="radio" name="size_name" value="8H">
											<label for="size_name_23_8H">285</label>
											
											<input id="size_name_23_44" class="size_name" type="radio" name="size_name" value="44">
											<label for="size_name_23_44">290</label>
											
											<input id="size_name_23_9H" class="size_name" type="radio" name="size_name" value="9H">
											<label for="size_name_23_9H">295</label>
											
											<input id="size_name_23_45" class="size_name" type="radio" name="size_name" value="45">
											<label for="size_name_23_45">300</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD>신발 24FW</TD>
									<TD colspan="7">
										<div class="rd__block">
											<input id="size_name_24_220" class="size_name" type="radio" name="size_name" value="220">
											<label for="size_name_24_220">220</label>

											<input id="size_name_24_225" class="size_name" type="radio" name="size_name" value="225">
											<label for="size_name_24_225">225</label>

											<input id="size_name_24_230" class="size_name" type="radio" name="size_name" value="230">
											<label for="size_name_24_230">230</label>

											<input id="size_name_24_235" class="size_name" type="radio" name="size_name" value="235">
											<label for="size_name_24_235">235</label>

											<input id="size_name_24_240" class="size_name" type="radio" name="size_name" value="240">
											<label for="size_name_24_240">240</label>

											<input id="size_name_24_245" class="size_name" type="radio" name="size_name" value="245">
											<label for="size_name_24_245">245</label>

											<input id="size_name_24_250" class="size_name" type="radio" name="size_name" value="250">
											<label for="size_name_24_250">250</label>

											<input id="size_name_24_255" class="size_name" type="radio" name="size_name" value="255">
											<label for="size_name_24_255">255</label>

											<input id="size_name_24_260" class="size_name" type="radio" name="size_name" value="260">
											<label for="size_name_24_260">260</label>

											<input id="size_name_24_265" class="size_name" type="radio" name="size_name" value="265">
											<label for="size_name_24_265">265</label>

											<input id="size_name_24_270" class="size_name" type="radio" name="size_name" value="270">
											<label for="size_name_24_270">270</label>

											<input id="size_name_24_275" class="size_name" type="radio" name="size_name" value="275">
											<label for="size_name_24_275">275</label>

											<input id="size_name_24_280" class="size_name" type="radio" name="size_name" value="280">
											<label for="size_name_24_280">280</label>

											<input id="size_name_24_285" class="size_name" type="radio" name="size_name" value="285">
											<label for="size_name_24_285">285</label>

											<input id="size_name_24_290" class="size_name" type="radio" name="size_name" value="290">
											<label for="size_name_24_290">290</label>

											<input id="size_name_24_295" class="size_name" type="radio" name="size_name" value="295">
											<label for="size_name_24_295">295</label>

											<input id="size_name_24_300" class="size_name" type="radio" name="size_name" value="300">
											<label for="size_name_24_300">300</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD>악세서리</TD>
									<TD colspan="7">
										<div class="rd__block">
											<input id="size_name_acc_Onesize" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_acc_Onesize">Onesize</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD rowspan="5">모바일 악세서리<br/>22FW TECH</TD>
									<td>Cellphone<br/>iPhone</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_22fw_i_mini" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_i_mini">iPhone Mini</label>
											
											<input id="size_name_m_acc_22fw_i" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_i">iPhone</label>
											
											<input id="size_name_m_acc_22fw_i_plus" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_i_plus">iPhone Plus</label>
											
											<input id="size_name_m_acc_22fw_i_pro" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_i_pro">iPhone Pro</label>
											
											<input id="size_name_m_acc_22fw_i_pro_max" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_i_pro_max">iPhone Pro Max</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Cellphone<br/>Galaxy</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_22fw_g_s_23" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_g_s_23">Galaxy S23</label>
											
											<input id="size_name_m_acc_22fw_g_s_23_plus" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_g_s_23_plus">Galaxy S23+</label>
											
											<input id="size_name_m_acc_22fw_g_ultra" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_g_ultra">Galaxy Ultra</label>
											
											<input id="size_name_m_acc_22fw_g_z_flip" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_g_z_flip">Galaxy Z FLIP</label>
											
											<input id="size_name_m_acc_22fw_g_z_fold" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_g_z_fold">Galaxy Z FOLD</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Airpods</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_22fw_airpods_2" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_airpods_2">AirPods 2세대</label>
											
											<input id="size_name_m_acc_22fw_airpods_3" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_airpods_3">AirPods 3세대</label>
											
											<input id="size_name_m_acc_22fw_airpods_pro" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_airpods_pro">AirPods Pro</label>
											
											<input id="size_name_m_acc_22fw_airpods_pro_2" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_airpods_pro_2">AirPods Pro 2세대</label>
											
											<input id="size_name_m_acc_22fw_airpods_pro_max" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_airpods_pro_max">AirPods Pro Max</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Laptop</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_22fw_macbook_air_m1" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_macbook_air_m1">Macbook AIR M1</label>
											
											<input id="size_name_m_acc_22fw_macbook_air_m2" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_macbook_air_m2">Macbook AIR M2</label>
											
											<input id="size_name_m_acc_22fw_macbook_pro_13" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_macbook_pro_13">Macbook Pro 13</label>
											
											<input id="size_name_m_acc_22fw_macbook_pro_14" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_macbook_pro_14">Macbook Pro 14</label>
											
											<input id="size_name_m_acc_22fw_macbook_pro_16" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_macbook_pro_16">Macbook Pro 16</label>
										</div>
									</TD>
									
								</TR>

								<TR>
									<td>Watch</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_22fw_watch_38" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_watch_38">Apple Watch 38/40/41</label>
											
											<input id="size_name_m_acc_22fw_watch_41" class="size_name" type="radio" name="size_name" value="F">
											<label for="size_name_m_acc_22fw_watch_41">Apple Watch 42/44/45</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<TD rowspan="5">모바일 악세서리</TD>
									<td>Cellphone<br/>iPhone</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_i_mini" class="size_name" type="radio" name="size_name" value="IMI">
											<label for="size_name_m_acc_i_mini">iPhone Mini</label>
											
											<input id="size_name_m_acc_i" class="size_name" type="radio" name="size_name" value="IBA">
											<label for="size_name_m_acc_i">iPhone</label>
											
											<input id="size_name_m_acc_i_plus" class="size_name" type="radio" name="size_name" value="IPL">
											<label for="size_name_m_acc_i_plus">iPhone Plus</label>
											
											<input id="size_name_m_acc_i_pro" class="size_name" type="radio" name="size_name" value="iPR">
											<label for="size_name_m_acc_i_pro">iPhone Pro</label>
											
											<input id="size_name_m_acc_i_pro_max" class="size_name" type="radio" name="size_name" value="IPM">
											<label for="size_name_m_acc_i_pro_max">iPhone Pro Max</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Cellphone<br/>Galaxy</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_g_s_23" class="size_name" type="radio" name="size_name" value="GSB">
											<label for="size_name_m_acc_g_s_23">Galaxy S23</label>
											
											<input id="size_name_m_acc_g_s_23_plus" class="size_name" type="radio" name="size_name" value="GSP">
											<label for="size_name_m_acc_g_s_23_plus">Galaxy S23+</label>
											
											<input id="size_name_m_acc_g_ultra" class="size_name" type="radio" name="size_name" value="GUR">
											<label for="size_name_m_acc_g_ultra">Galaxy Ultra</label>
											
											<input id="size_name_m_acc_g_z_flip" class="size_name" type="radio" name="size_name" value="GZF">
											<label for="size_name_m_acc_g_z_flip">Galaxy Z FLIP</label>
											
											<input id="size_name_m_acc_g_z_fold" class="size_name" type="radio" name="size_name" value="GZO">
											<label for="size_name_m_acc_g_z_fold">Galaxy Z FOLD</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Airpods</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_airpods_2" class="size_name" type="radio" name="size_name" value="AD2">
											<label for="size_name_m_acc_airpods_2">AirPods 2세대</label>
											
											<input id="size_name_m_acc_airpods_3" class="size_name" type="radio" name="size_name" value="AD3">
											<label for="size_name_m_acc_airpods_3">AirPods 3세대</label>
											
											<input id="size_name_m_acc_airpods_pro" class="size_name" type="radio" name="size_name" value="APP">
											<label for="size_name_m_acc_airpods_pro">AirPods Pro</label>
											
											<input id="size_name_m_acc_airpods_pro_2" class="size_name" type="radio" name="size_name" value="AP2">
											<label for="size_name_m_acc_airpods_pro_2">AirPods Pro 2세대</label>
											
											<input id="size_name_m_acc_airpods_pro_max" class="size_name" type="radio" name="size_name" value="APM">
											<label for="size_name_m_acc_airpods_pro_max">AirPods Pro Max</label>
										</div>
									</TD>
								</TR>

								<TR>
									<td>Laptop</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_macbook_air_m1" class="size_name" type="radio" name="size_name" value="AM1">
											<label for="size_name_m_acc_macbook_air_m1">Macbook AIR M1</label>
											
											<input id="size_name_m_acc_macbook_air_m2" class="size_name" type="radio" name="size_name" value="AM2">
											<label for="size_name_m_acc_macbook_air_m2">Macbook AIR M2</label>
											
											<input id="size_name_m_acc_macbook_pro_13" class="size_name" type="radio" name="size_name" value="P13">
											<label for="size_name_m_acc_macbook_pro_13">Macbook Pro 13</label>
											
											<input id="size_name_m_acc_macbook_pro_14" class="size_name" type="radio" name="size_name" value="P14">
											<label for="size_name_m_acc_macbook_pro_14">Macbook Pro 14</label>
											
											<input id="size_name_m_acc_macbook_pro_16" class="size_name" type="radio" name="size_name" value="P16">
											<label for="size_name_m_acc_macbook_pro_16">Macbook Pro 16</label>
										</div>
									</TD>
									
								</TR>

								<TR>
									<td>Watch</td>
									<TD colspan="6">
										<div class="rd__block">
											<input id="size_name_m_acc_watch_38" class="size_name" type="radio" name="size_name" value="AWS">
											<label for="size_name_m_acc_watch_38">Apple Watch 38/40/41</label>
											
											<input id="size_name_m_acc_watch_41" class="size_name" type="radio" name="size_name" value="AWM">
											<label for="size_name_m_acc_watch_41">Apple Watch 42/44/45</label>
										</div>
									</TD>
								</TR>
								
								<TR id="tmp_option_info" style="display:none;">
									<TD colspan="12">
										<div style="display:flex;">
											<input type="text" id="tmp_option_name" value="" style="width:30%;">
											
											<div class="btn reset_tmp_option">초기화</div>
											
											<div class="btn add_tmp_option" onClick="addOptionInfo();">추가</div>
										</div>
									</TD>
								</TR>
								
								<TR id="ordersheet_option_info">
									
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
									<TH style="width:10%;">제품 상세정보 (한글)</TH>
									<TD>
										<textarea class="width-100p" id="detail_kr" name="detail_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (영문)</TH>
									<TD>
										<textarea class="width-100p" id="detail_en" name="detail_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 상세정보 (중문)</TH>
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
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (한글)</TH>
									<TD>
										<textarea class="width-100p" id="care_dsn_kr" name="care_dsn_kr"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (영문)</TH>
									<TD>
										<textarea class="width-100p" id="care_dsn_en" name="care_dsn_en"
											style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH style="width:10%;">제품 취급 유의사항<br>디자인 (중문)</TH>
									<TD>
										<textarea class="width-100p" id="care_dsn_cn" name="care_dsn_cn"
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
				onClick="confirm('상품을 등록하시겠습니까?.','putOrdersheetInfo_DSN()');">개별상품 업데이트</button>
		</div>
	</div>
</div>
<script>
var care_dsn_kr = [];
var care_dsn_en = [];
var care_dsn_cn = [];

var detail_kr = [];
var detail_en = [];
var detail_cn = [];

var size_category_info = {};
var chk_list_arr = [];

function setSmartEditor() {
	//care
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_dsn_kr,
		elPlaceHolder: "care_dsn_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_dsn_en,
		elPlaceHolder: "care_dsn_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: care_dsn_cn,
		elPlaceHolder: "care_dsn_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});

	//detail
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_kr,
		elPlaceHolder: "detail_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_en,
		elPlaceHolder: "detail_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_cn,
		elPlaceHolder: "detail_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
}

$(document).ready(function () {
	setSmartEditor();
	
	$('#insert_table_MD').toggle();
	$('#insert_table_TD').toggle();
	
	getOrdersheetInfo_DSN();
	
	$('.size_name').click(function() {
		let radio_id = $(this).attr('id');
		let tmp_option_name = $("label[for='" + radio_id + "']").text(); 
		
		$('#tmp_option_info').show();
		$('#tmp_option_name').val(tmp_option_name);
	});
	
	$('.reset_tmp_option').click(function() {
		$('.size_name').prop('checked',false);
		$('#tmp_option_info').hide();
		$('#tmp_option_name').val('');
	})
	
	$('.add_tmp_option').click(function() {
		let cnt = $('.tr_size').length;
		
		let strDiv = "";
		strDiv += "    <TR>";
		strDiv += '        <TD>';
		strDiv += '            <div class="btn remove_option_btn" onClick="removeOptionInfo(this);">옵션삭제</div>';
		strDiv += '        </TD>';
		
		for (let i=0; i<cnt; i++) {
			strDiv += '    <TD>';
			strDiv += '        <input type="text" name="option_size_' + i + '" value="">';
			strDiv += '    </TD>';
		}
		
		strDiv += "</TR>";
	});
});

function toggleTableClick(toggle_val) {
	$('#insert_table_' + toggle_val).toggle();
}

function getOrdersheetInfo_DSN() {
	let ordersheet_idx = $('#ordersheet_idx').val();
	
	$.ajax({
		type: "post",
		url: config.api + "pcs/ordersheet/get",
		data: {
			'sel_idx': ordersheet_idx
		},
		dataType: "json",
		error: function () {
			alert("오더시트 조회처리중 오류가 발생했습니다.");
		},
		success: function (d) {
			if (d.code == 200) {
				let data = d.data;
				
				$('input[name=update_date]').val(data.update_date);
				$('input[name=product_name]').val(data.product_name);
				$('input[name=product_code]').val(data.product_code);
				
				//기획 MD
				$('#year').text(data.year);
				$('#style_code').text(data.style_code);
				$('#color_code').text(data.color_code);
				$('#product_code').text(data.product_code);
				
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
					var type_str = '';
					switch (data.line_type) {
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
					strDiv += '                <td>' + type_str + '</td>';
					strDiv += '                <td>' + data.line_memo + '</td>';
					strDiv += '            </tr>';
					strDiv += '        </tbody>';
					strDiv += '    </table>';
					
					$('#line_info_table').append(strDiv);
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
				$('#limit_id_flg').text(data.limit_id_flg == 1 ? '제한함':'제한안함');
				$('#limit_product_qty_flg').text(data.limit_product_qty_flg == 1 ? '제한함':'제한안함');
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

				//생산
				$('#care_td_kr').html(data.care_td_kr);
				$('#care_td_en').html(data.care_td_en);
				$('#care_td_cn').html(data.care_td_cn);
				$('#material_kr').html(data.material_kr);
				$('#material_en').html(data.material_en);
				$('#material_cn').html(data.material_cn);
				$('#manufacturer').text(data.manufacturer);
				$('#supplier').text(data.supplier);
				$('#origin_country').text(data.origin_country);
				$('#brand').text(data.brand);

				if (data.load_box_idx != null && data.load_box_idx > 0) {
					let strDiv = "";
					strDiv = "";
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
					strDiv += '            <td>' + data.load_box_name + '</td>';
					strDiv += '            <td>' + data.load_box_width + ' cm</td>';
					strDiv += '            <td>' + data.load_box_length + ' cm</td>';
					strDiv += '            <td>' + data.load_box_height + ' cm</td>';
					strDiv += '            <td>' + data.load_box_volume + ' cm³</td>';
					strDiv += '        </tr>';
					strDiv += '    </tbody>';
					strDiv += '</table>';
					$('#load_box_info_table').append(strDiv);
				}
				
				$('#load_weight').text(data.load_weight);
				$('#load_qty').text(data.load_qty);
				
				var sub_info = data.sub_material_info;
				sub_info.forEach(function (sub_data) {
					if (sub_data.sub_material_type == 'T') {
						$('#td_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');

					} else if (sub_data.sub_material_type == 'D') {
						$('#delivery_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');
					}
				})

				//디자인
				let wkla_idx = data.wkla_idx
				if (wkla_idx > 0) {
					$('#wkla_idx').val(wkla_idx);
				}
				
				$('#material').val(data.material);
				$('#fit').val(data.fit);
				$('#color_rgb').val(data.color_rgb);
				$('#pantone_code').val(data.pantone_code);
				$('#tp_completion_date').val(data.tp_completion_date);

				$('#wkla_idx').val(data.wkla_idx).attr("selected", "selected").change();
				$('#model').val(data.model);
				$('#model_wear').val(data.model_wear);
				
				let option_info = data.option_info;
				$('#size_guide_idx').val(data.size_guide_idx);
				if (data.size_guide_idx > 0) {
					getSizeGuideList(option_info);
				}
				
				$('#detail_kr').html(data.detail_kr);
				$('#detail_en').html(data.detail_en);
				$('#detail_cn').html(data.detail_cn);
				$('#care_dsn_kr').html(data.care_dsn_kr);
				$('#care_dsn_en').html(data.care_dsn_en);
				$('#care_dsn_cn').html(data.care_dsn_cn);

				if (data.size_category != null && data.size_category.length != 0) {
					$('#size_category').val(data.size_category).prop("selected", true).change();
				}
			}
		}
	});
}

function getWklaInfo() {
	let wkla_idx = $('#wkla_idx').val();
	
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
						strDiv += '    <table style="width:40%">';
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
	}
}

function putOrdersheetInfo_DSN(flg) {
	care_dsn_kr.getById["care_dsn_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	care_dsn_en.getById["care_dsn_en"].exec("UPDATE_CONTENTS_FIELD", []);
	care_dsn_cn.getById["care_dsn_cn"].exec("UPDATE_CONTENTS_FIELD", []);

	detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []);

	if (flg != undefined) {
		$('input[name=overwrite_flg]').val(flg);
	}
	
	let name_err_cnt = 0;
	let size_err_cnt = 0;
	let weight_err_cnt = 0;
	let limit_err_cnt = 0;
	
	let option_name = $('.option_name');
	if (option_name.length > 0) {
		let option_cnt = option_name.length;
		if (option_cnt > 0) {
			for (let i=0; i<option_cnt; i++) {
				let name_value = option_name.val();
				if (name_value.length == 0) {
					name_err_cnt++;
				}
			}
		}
		
		for (let i=1; i<=6; i++) {
			let option_size = $('.option_size_' + i);
			let cnt = option_size.length;
			
			if (cnt > 0) {
				for (let j=0; j<cnt; j++) {
					let size_value = option_size.eq(j).val()
					if (size_value.length == 0) {
						size_err_cnt++;
					}
				}
			}
		}
		
		let option_weight = $('.option_weight');
		if (option_weight.length > 0) {
			let cnt = option_weight.length;
			for (let i=0; i<cnt; i++) {
				let weight_value = option_weight.eq(i).val();
				if (weight_value.length == 0) {
					weight_err_cnt++;
				}
			}
		}
		
		let limit_option_qty = $('.limit_option_qty');
		if (limit_option_qty.length > 0) {
			let cnt = limit_option_qty.length;
			for (let i=0; i<cnt; i++) {
				let limit_value = limit_option_qty.eq(i).val();
				if (limit_value.length == 0) {
					limit_err_cnt++;
				}
			}
		}
	}
	
	if (name_err_cnt > 0) {
		alert('이름이 미입력된 옵션이 존재합니다. 옵션이름 입력 후 다시 시도해주세요.');
		return false;
	}
	
	if (size_err_cnt > 0) {
		alert('사이즈 정보가 미입력된 옵션이 존재합니다. 사이즈 정보 입력 후 다시 시도해주세요.');
		return false;
	}
	
	if (weight_err_cnt > 0) {
		alert('중량 정보가 미입력된 옵션이 존재합니다. 중량 정보 입력 후 다시 시도해주세요.');
		return false;
	}
	
	if (limit_err_cnt > 0) {
		alert('구매수량제한 정보가 미입력된 옵션이 존재합니다. 구매수량제한 정보 입력 후 다시 시도해주세요.');
		return false;
	}
	
	var form = $("#frm-regist")[0];
	var formData = new FormData(form);

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet/dsn/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function () {
			alert("개별상품[DSN] 작성 처리에 실패했습니다.");
		},
		success: function (d) {
			if (d.code == 200) {
				alert(
					'오더시트 디자인 정보가 수정되었습니다.',
					function pageLocation() {
						location.href = '/pcs/ordersheet/list';
					}
				);
			} else {
				switch (d.code) {
					case 300:
						confirm(d.msg, function () {
							putOrdersheetInfo_DSN('true');
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

function getSizeGuideList(option_info) {
	let size_guide_idx = $('#size_guide_idx').val();
	
	$.ajax({
		type: "post",
		url: config.api + "product/size_guide/get",
		data: {
			'size_guide_idx' : size_guide_idx
		},
		dataType: "json",
		error: function () {
			alert("사이즈정보 조회처리중 오류가 발생했습니다.");
		},
		success: function (d) {
			if (d.code == 200) {
				let size_data = d.data[0];
				if (size_data != null) {
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
					
					str_div_option_table += '<TD colspan="12">';
					str_div_option_table += '    <TABLE>';
					str_div_option_table += '        <THEAD>';
					str_div_option_table += '            <TR>';
					str_div_option_table += '                <TH>옵션삭제</TH>';
					str_div_option_table += '                <TH>옵션이름</TH>';
					str_div_option_table += '                <TH>바코드</TH>';
					
					str_div_option_table += str_div_option_th;
					
					str_div_option_table += '                <TH>중량</TH>';
					str_div_option_table += '                <TH>구매수량제한</TH>';
					str_div_option_table += '            </TR>';
					str_div_option_table += '        </THEAD>';
					str_div_option_table += '        <TBODY id="option_info">';
					str_div_option_table += '            <TR class="default_tr">';
					str_div_option_table += '                <TD colspan="' + (colspan_cnt + 5) + '">등록된 옵션이 없습니다.</TD>';
					str_div_option_table += '            </TR>';
					str_div_option_table += '        </TBODY>';
					str_div_option_table += '    </TABLE>';
					str_div_option_table += '</TD>';
					
					$('#ordersheet_option_info').html('');
					$('#ordersheet_option_info').append(str_div_option_table);
					$('#ordersheet_option_info').show();
					
					if (option_info != "" && option_info != null) {
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
	let product_code = $('#product_code').text();
	
	$('#option_info').html('');
	
	let strDiv = "";
	option_info.forEach(function(row) {
		strDiv += '<TR>';
		strDiv += '    <TD>';
		strDiv += '        <div class="btn remove_option_btn" onClick="removeOptionInfo(this);">옵션삭제</div>';
		strDiv += '    </TD>';
		strDiv += '    <TD>';
		strDiv += '        <input class="option_name" type="text" name="option_name[]" value="' + row.option_name + '">';
		strDiv += '        <input class="option_type" type="hidden" name="option_type[]" value="' + row.option_type + '">';
		strDiv += '    </TD>';
		strDiv += '    <TD>' + row.barcode + '</TD>';
			
		if (row.option_size_1 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_1" type="text" name="option_size_1[]" value="' + row.option_size_1 + '">';
			strDiv += '</TD>';
		}

		if (row.option_size_2 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_2" type="text" name="option_size_2[]" value="' + row.option_size_2 + '">';
			strDiv += '</TD>';
		}

		if (row.option_size_3 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_3" type="text" name="option_size_3[]" value="' + row.option_size_3 + '">';
			strDiv += '</TD>';
		}

		if (row.option_size_4 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_4" type="text" name="option_size_4[]" value="' + row.option_size_4 + '">';
			strDiv += '</TD>';
		}

		if (row.option_size_5 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_5" type="text" name="option_size_5[]" value="' + row.option_size_5 + '">';
			strDiv += '</TD>';
		}

		if (row.option_size_6 != "") {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_6" type="text" name="option_size_6[]" value="' + row.option_size_6 + '">';
			strDiv += '</TD>';
		}
			
		strDiv += '    <TD>';
		strDiv += '        <input class="option_weight" type="text" name="option_weight[]" value="' + row.option_weight + '">';
		strDiv += '    </TD>';
		strDiv += '    <TD>';
		strDiv += '        <input class="limit_option_qty" type="text" name="limit_option_qty[]" value="' + row.limit_option_qty + '">';
		strDiv += '    </TD>';
		strDiv += '</TR>';
	});
	
	$('#option_info').append(strDiv);
}

function addOptionInfo() {
	let size_guide_idx = $('#size_guide_idx').val();
	if (size_guide_idx == 0) {
		alert('사이즈 가이드를 선택해주세요.');
		return false;
	}
	
	$('.default_tr').remove();
	let option_name = $('#tmp_option_name').val();
	let option_type = $('input[name="size_name"]:checked').val();
	
	if (option_name != null && option_type != null) {
		let cnt_th = $('#ordersheet_option_info').find('th').length;
		
		let product_code = $('#product_code').text();
		
		let strDiv = "";
		strDiv += '<TR>';
		strDiv += '    <TD>';
		strDiv += '        <div class="btn remove_option_btn" onClick="removeOptionInfo(this);">옵션삭제</div>';
		strDiv += '    </TD>';
		strDiv += '    <TD>';
		strDiv += '        <input class="option_name" type="text" name="option_name[]" value="' + option_name + '">';
		strDiv += '        <input class="option_type" type="hidden" name="option_type[]" value="' + option_type + '">';
		strDiv += '    </TD>';
		strDiv += '    <TD>' + product_code + option_type + '</TD>';
			
		for (let i=1; i<(cnt_th - 4); i++) {
			strDiv += '<TD>';
			strDiv += '    <input class="option_size_' + i + '" type="text" name="option_size_' + i + '[]" value="">';
			strDiv += '</TD>';
		}

		strDiv += '    <TD>';
		strDiv += '        <input class="option_weight" type="text" name="option_weight[]" value="">';
		strDiv += '    </TD>';
		strDiv += '    <TD>';
		strDiv += '        <input class="limit_option_qty" type="text" name="limit_option_qty[]" value="">';
		strDiv += '    </TD>';
		strDiv += '</TR>';
		
		$('#option_info').append(strDiv);
	} else {
		alert('옵션의 이름과 유형을 선택해주세요.');
		return false;
	}
}

function removeOptionInfo(obj) {
	let cnt = $('.option_name').length;
	$(obj).parent().parent().remove();
}

function xssDecode(data) {
	var decode_str = null;
	if (data != null) {
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