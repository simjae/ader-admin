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
.required_title{color:red;font-weight:800;}
.smart_editer_text {height:180px;}
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
								<TR>
									<TH>소재</TH>
									<TD id="material"></TD>
									
									<TH>fit</TH>
									<TD id="fit"></TD>
									
									<TH>프리오더 사용여부</TH>
									<TD id="preorder_flg">
									
									<TH>교환 환불 가능유무</TH>
									<TD id="refund_flg">
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
									<TH>[생산] 소재</TH>
									<TD class="smart_editer_text" id="material_td_kr"></TD>
								</TR>
								
								<TR>
									<TH>[생산] 취급 유의사항</TH>
									<TD class="smart_editer_text" id="care_td_kr"></TD>
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
									<TH>제조사</TD>
									<TD id="manufacturer"></TD>
									
									<TH>공급사</TD>
									<TD id="supplier"></TD>
									
									<TH>원산지</TH>
									<TD id="origin_country"></TD>
									
									<TH>브랜드</TH>
									<TD id="brand"></TD>
								</TR>
								<tr>
									<TH>상품 적재박스 유형</TH>
									<TD colspan="7" id="load_box_info_table">
								</tr>
									<TH>상품 적재중량 (kg)</TH>
									<TD id="load_weight" colspan="3"></TD>
									
									<TH>상품 적재수량</TH>
									<TD id="load_qty" colspan="3"></TD>
								</tr>
								<tr>
									<TH>포장부자재</TH>
									<TD colspan="3">
										<table style="width:50%">
											<tbody id="td_sub_material"></tbody>
										</table>
									</TD>
									
									<TH>배송부자재</TH>
									<TD colspan="3">
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
								<tr>
									<TH>W/K/L/A</TH>
									<TD>
										<div class="content__row">
											<select id="wkla_idx" name="wkla_idx" class="fSelect eSearch" style="width:100%;" onChange="getWklaInfo();">
												<option value="0">WKLA을 선택해주세요</option>
												<?php
													$select_wkla_sql = "
														SELECT
															WK.IDX			AS WKLA_IDX,
															WK.WKLA_NAME	AS WKLA_NAME
														FROM
															WKLA_INFO WK
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
									
									<TH>최초 TP 작성일</TH>
									<TD>
										<input id="tp_completion_date" type="date" name="tp_completion_date" style="width:100%;" value="" date_type="tp_completion">
									</TD>
								</TR>
								
								<TR>
									<TD colspan="12">
										<div class="content__row">
											<select id="size_guide_category" name="size_guide_category" class="fSelect eSearch" style="width:163px;" onChange="getSizeGuideList();">
												<?php
													$select_size_guide_sql = "
														SELECT
															SG.CATEGORY_TYPE	AS CATEGORY_TYPE
														FROM
															SIZE_GUIDE SG
														WHERE
															SG.COUNTRY = 'KR'
													";
													
													$db->query($select_size_guide_sql);

													foreach ($db->fetch() as $size_data) {
														$size_idx = $size_data['CATEGORY_TYPE'];
														if (!empty($size_idx)) {
												?>
													<option value="<?=$size_data['CATEGORY_TYPE']?>" readonly><?=$size_data['CATEGORY_TYPE']?></option>
												<?php
														} else {
												?>
													<option value="" readonly>사이즈 가이드 미선택</option>
												<?php
														}
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
									<th>일반</th>
									<TD colspan="7">
										<div class="cb__color">
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="F">
												<span>Onesize</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="1">
												<span>A1</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="2">
												<span>A2</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="3">
												<span>A3</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="4">
												<span>A4</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="5">
												<span>A5</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="XS">
												<span>XS</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="S">
												<span>S</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="M">
												<span>M</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="L">
												<span>L</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="XL">
												<span>XL</span>
											</label>
											<label>
												<input class="size_name common" type="checkbox" name="size_name" value="2XL">
												<span>2XL</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<th>신발 23FW</th>
									<TD colspan="7">
										<div class="cb__color">
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="2H">
												<span>225</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="36">
												<span>230</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="3H">
												<span>235</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="37">
												<span>240</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="4H">
												<span>245</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="40">
												<span>250</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="5H">
												<span>255</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="41">
												<span>260</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="6H">
												<span>265</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="42">
												<span>270</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="7H">
												<span>275</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="43">
												<span>280</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="8H">
												<span>285</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="44">
												<span>290</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="9H">
												<span>295</span>
											</label>
											<label>
												<input class="size_name shoes_23fw" type="checkbox" name="size_name" value="45">
												<span>300</span>
											</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<th>신발 24FW</th>
									<TD colspan="7">
										<div class="cb__color">
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="220">
												<span>220</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="225">
												<span>225</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="230">
												<span>230</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="235">
												<span>235</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="240">
												<span>240</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="245">
												<span>245</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="250">
												<span>250</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="255">
												<span>255</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="260">
												<span>260</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="265">
												<span>265</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="270">
												<span>270</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="275">
												<span>275</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="280">
												<span>280</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="285">
												<span>285</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="290">
												<span>290</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="295">
												<span>295</span>
											</label>
											<label>
												<input class="size_name shoes_24fw" type="checkbox" name="size_name" value="300">
												<span>300</span>
											</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<th>악세서리</th>
									<TD colspan="7">
										<div class="cb__color">
											<label>
												<input class="size_name accessory" type="checkbox" name="size_name" value="F">
												<span>Onesize</span>
											</label>
										</div>
									</TD>
								</TR>
								
								<TR>
									<th rowspan="5">모바일 악세서리<br/>22FW TECH</th>
									<th>Cellphone<br/>iPhone</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name mobile_iphone_22fw" type="checkbox" name="size_name" value="F">
												<span>iPhone Mini</span>
											</label>
											<label>
												<input class="size_name mobile_iphone_22fw" type="checkbox" name="size_name" value="F">
												<span>iPhone</span>
											</label>
											<label>
												<input class="size_name mobile_iphone_22fw" type="checkbox" name="size_name" value="F">
												<span>iPhone Plus</span>
											</label>
											<label>
												<input class="size_name mobile_iphone_22fw" type="checkbox" name="size_name" value="F">
												<span>iPhone Pro</span>
											</label>
											<label>
												<input class="size_name mobile_iphone_22fw" type="checkbox" name="size_name" value="F">
												<span>iPhone Pro Max</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Cellphone<br/>Galaxy</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name mobile_galaxy_22fw" type="checkbox" name="size_name" value="F">
												<span>Galaxy S23</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy_22fw" type="checkbox" name="size_name" value="F">
												<span>Galaxy S23+</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy_22fw" type="checkbox" name="size_name" value="F">
												<span>Galaxy Ultra</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy_22fw" type="checkbox" name="size_name" value="F">
												<span>Galaxy Z FLIP</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy_22fw" type="checkbox" name="size_name" value="F">
												<span>Galaxy Z FOLD</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Airpods</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name airpods_22fw" type="checkbox" name="size_name" value="F">
												<span>AirPods 2세대</span>
											</label>
											<label>
												<input class="size_name airpods_22fw" type="checkbox" name="size_name" value="F">
												<span>AirPods 3세대</span>
											</label>
											<label>
												<input class="size_name airpods_22fw" type="checkbox" name="size_name" value="F">
												<span>AirPods Pro</span>
											</label>
											<label>
												<input class="size_name airpods_22fw" type="checkbox" name="size_name" value="F">
												<span>AirPods Pro 2세대</span>
											</label>
											<label>
												<input class="size_name airpods_22fw" type="checkbox" name="size_name" value="F">
												<span>AirPods Pro Max</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Laptop</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name laptop_22fw" type="checkbox" name="size_name" value="F">
											<span>Macbook AIR M1</span>
											</label>
											<label>
												<input class="size_name laptop_22fw" type="checkbox" name="size_name" value="F">
												<span>Macbook AIR M2</span>
											</label>
											<label>
												<input class="size_name laptop_22fw" type="checkbox" name="size_name" value="F">
												<span>Macbook Pro 13</span>
											</label>
											<label>
												<input class="size_name laptop_22fw" type="checkbox" name="size_name" value="F">
												<span>Macbook Pro 14</span>
											</label>
											<label>
												<input class="size_name laptop_22fw" type="checkbox" name="size_name" value="F">
												<span>Macbook Pro 16</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<th>Watch</td>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name watch_22fw" type="checkbox" name="size_name" value="F">
												<span>Apple Watch 38/40/41</span>
											</label>
											<label>
												<input class="size_name watch_22fw" type="checkbox" name="size_name" value="F">
												<span>Apple Watch 42/44/45</span>
											</label>
										</div>
									</TD>
								</TR>
								

								<TR>
									<th rowspan="5">모바일 악세서리</th>
									<th>Cellphone<br/>iPhone</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name mobile_iphone" type="checkbox" name="size_name" value="IMI">
												<span>iPhone Mini</span>
											</label>
											<label>
												<input class="size_name mobile_iphone" type="checkbox" name="size_name" value="IBA">
												<span>iPhone</span>
											</label>
											<label>
												<input class="size_name mobile_iphone" type="checkbox" name="size_name" value="IPL">
												<span>iPhone Plus</span>
											</label>
											<label>
												<input class="size_name mobile_iphone" type="checkbox" name="size_name" value="IPR">
												<span>iPhone Pro</span>
											</label>
											<label>
												<input class="size_name mobile_iphone" type="checkbox" name="size_name" value="IPM">
												<span>iPhone Pro Max</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Cellphone<br/>Galaxy</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name mobile_galaxy" type="checkbox" name="size_name" value="GSB">
												<span>Galaxy S23</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy" type="checkbox" name="size_name" value="GSP">
												<span>Galaxy S23+</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy" type="checkbox" name="size_name" value="GUR">
												<span>Galaxy Ultra</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy" type="checkbox" name="size_name" value="GZF">
												<span>Galaxy Z FLIP</span>
											</label>
											<label>
												<input class="size_name mobile_galaxy" type="checkbox" name="size_name" value="GZO">
												<span>Galaxy Z FOLD</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Airpods</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name airpods" type="checkbox" name="size_name" value="AD2">
												<span>AirPods 2세대</span>
											</label>
											<label>
												<input class="size_name airpods" type="checkbox" name="size_name" value="AD3">
												<span>AirPods 3세대</span>
											</label>
											<label>
												<input class="size_name airpods" type="checkbox" name="size_name" value="APP">
												<span>AirPods Pro</span>
											</label>
											<label>
												<input class="size_name airpods" type="checkbox" name="size_name" value="AP2">
												<span>AirPods Pro 2세대</span>
											</label>
											<label>
												<input class="size_name airpods" type="checkbox" name="size_name" value="APM">
												<span>AirPods Pro Max</span>
											</label>
										</div>
									</TD>
								</TR>

								<TR>
									<th>Laptop</th>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name laptop" type="checkbox" name="size_name" value="AM1">
											<span>Macbook AIR M1</span>
											</label>
											<label>
												<input class="size_name laptop" type="checkbox" name="size_name" value="AM2">
												<span>Macbook AIR M2</span>
											</label>
											<label>
												<input class="size_name laptop" type="checkbox" name="size_name" value="P13">
												<span>Macbook Pro 13</span>
											</label>
											<label>
												<input class="size_name laptop" type="checkbox" name="size_name" value="P14">
												<span>Macbook Pro 14</span>
											</label>
											<label>
												<input class="size_name laptop" type="checkbox" name="size_name" value="P16">
												<span>Macbook Pro 16</span>
											</label>
										</div>
									</TD>
								</TR>
								<TR>
									<th>Watch</td>
									<TD colspan="6">
										<div class="cb__color">
											<label>
												<input class="size_name watch" type="checkbox" name="size_name" value="AWS">
												<span>Apple Watch 38/40/41</span>
											</label>
											<label>
												<input class="size_name watch" type="checkbox" name="size_name" value="AWM">
												<span>Apple Watch 42/44/45</span>
											</label>
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
									<TH class="required_title" style="width:10%;">[디자인] 소재</TH>
									<TD>
										<textarea class="width-100p" id="material_dsn_kr" name="material_dsn_kr" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								
								<TR>
									<TH class="required_title" style="width:10%;">[디자인] 상세정보</TH>
									<TD>
										<textarea class="width-100p" id="detail_kr" name="detail_kr" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								
								<TR>
									<TH style="width:10%;">[디자인] 취급 유의사항</TH>
									<TD>
										<textarea class="width-100p" id="care_dsn_kr" name="care_dsn_kr" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="table table__wrap">
                    <button class="toggle_table_btn" type="button" onClick="toggleTableClick('COM');">오더시트 - 번역정보</button>
                    <div class="overflow-x-auto" id="insert_table_COM">
                        <TABLE style="margin-top:5px">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <TBODY class="editor_body">
								<TR>
									<TH>[디자인] 소재 (영문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="material_dsn_en" name="material_dsn_en" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH>[디자인] 소재 (중문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="material_dsn_cn" name="material_dsn_cn" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								
                                <TR>
                                    <TH>[디자인] 상세정보 (영문)</TH>
                                    <TD class="smart_editer_text">
										<textarea class="width-100p" id="detail_en" name="detail_en" style="width:90%; height:150px;"></textarea>
									</TD>
                                </TR>

                                <TR>
                                    <TH>[디자인] 상세정보 (중문)</TH>
                                    <TD class="smart_editer_text">
										<textarea class="width-100p" id="detail_cn" name="detail_cn" style="width:90%; height:150px;"></textarea>
									</TD>
                                </TR>
								
								<TR>
                                    <TH>[디자인] 취급 유의사항 (영문)</TH>
                                    <TD class="smart_editer_text">
										<textarea class="width-100p" id="care_dsn_en" name="care_dsn_en" style="width:90%; height:150px;"></textarea>
									</TD>
                                </TR>

                                <TR>
                                    <TH>[디자인] 취급 유의사항 (중문)</TH>
                                    <TD class="smart_editer_text">
										<textarea class="width-100p" id="care_dsn_cn" name="care_dsn_cn" style="width:90%; height:150px;"></textarea>
									</TD>
                                </TR>
								
								<TR>
									<TH>[생산] 소재 (영문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="material_td_en" name="material_td_en" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>

								<TR>
									<TH>[생산] 소재 (중문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="material_td_cn" name="material_td_cn" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
								
								<TR>
									<TH>[생산] 취급 유의사항 (영문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="care_td_en" name="care_td_en" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
                                <TR>
									<TH>[생산] 취급 유의사항 (중문)</TH>
									<TD class="smart_editer_text">
										<textarea class="width-100p" id="care_td_cn" name="care_td_cn" style="width:90%; height:150px;"></textarea>
									</TD>
								</TR>
                            </TBODY>
                        </TABLE>
                    </div>
                </div>
			</form>
		</div>
		<div class="flex justify-center">
			<button type="button" style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px" onClick="confirm('상품을 등록하시겠습니까?.','putOrdersheetInfo_DSN()');">개별상품 업데이트</button>
		</div>
	</div>
</div>
<script>
var material_dsn_kr = [];
var material_dsn_en = [];
var material_dsn_cn = [];
var detail_kr = [];
var detail_en = [];
var detail_cn = [];
var care_dsn_kr = [];
var care_dsn_en = [];
var care_dsn_cn = [];

var material_td_en = [];
var material_td_cn = [];
var care_td_en = [];
var care_td_cn = [];

function setSmartEditor() {
	//material_dsn
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_dsn_kr,
		elPlaceHolder: "material_dsn_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_dsn_en,
		elPlaceHolder: "material_dsn_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload: function () { } }
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: material_dsn_cn,
		elPlaceHolder: "material_dsn_cn",
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
	
	//care_dsn
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
	
	//material_td
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
	
	//care_td
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
}

$(document).ready(function () {
	setSmartEditor();
	
	$('#insert_table_MD').toggle();
	$('#insert_table_TD').toggle();
	$('#insert_table_COM').toggle();
	
	getOrdersheetInfo_DSN();
	
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
	
	$('input[type=checkbox]').on('click',function(){
		let val = $(this).val();
		if(val == 'F'){
			$('.size_name').not($(this)).prop('checked',false);
		}
		else{
			let sel_class = $(this).attr('class');
			sel_class = '.' + sel_class.replace(' ','.');
			$('.size_name').not($(sel_class)).prop('checked',false);
			if($(sel_class).eq(0).val() == 'F'){
				$(sel_class).eq(0).prop('checked',false);
			}
		}
	})

	$('.size_name').click(function() {
		let size_name_obj = $('input[name="size_name"]:checked');
		let tmp_name_arr = new Array();
		if(size_name_obj.length > 0){
			size_name_obj.each(function(){
				tmp_name_arr.push($(this).next().text());
			})
		}
		$('#tmp_option_info').show();
		$('#tmp_option_name').val(tmp_name_arr.join(','));
	});
});

function toggleTableClick(toggle_val) {
	$('#insert_table_' + toggle_val).toggle();
	
	if (toggle_val == "COM") {
		let editor_body = $('.editor_body');
		let iframe = editor_body.find('iframe');
		
		if (iframe.length > 0) {
			for (let i=0; i<iframe.length; i++) {
				let iframe_id = iframe.eq(i).attr('id');
				$('#' + iframe_id).attr('src',$('#' + iframe_id).attr('src'));
			}
		}
	}
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
				
				$('#material').text(data.product_code);
				$('#fit').text(data.product_code);
				
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
				
				let category_lrg_title = "카테고리 미선택";
				if (data.category_lrg_title.length > 0) {
					category_lrg_title = data.category_lrg_title;
				}
				
				let category_mdl_title = "카테고리 미선택";
				if (data.category_mdl_title.length > 0) {
					category_mdl_title = data.category_mdl_title;
				}
				
				let category_sml_title = "카테고리 미선택";
				if (data.category_sml_title.length > 0) {
					category_sml_title = data.category_sml_title;
				}
				
				let category_dtl_title = "카테고리 미선택";
				if (data.category_dtl_title.length > 0) {
					category_dtl_title = data.category_dtl_title;
				}
					
				$('#category_lrg_title').text(category_lrg_title);
				$('#category_mdl_title').text(category_mdl_title);
				$('#category_sml_title').text(category_sml_title);
				$('#category_dtl_title').text(category_dtl_title);
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
				$('#tp_completion_date').val(data.tp_completion_date);

				$('#wkla_idx').val(data.wkla_idx).attr("selected", "selected").change();
				$('#model').val(data.model);
				$('#model_wear').val(data.model_wear);
				
				let option_info = data.option_info;
				
				$('#size_guide_category').val(data.size_guide_category);
				if (data.size_guide_category != null) {
					getSizeGuideList(option_info);
				}
				
				$('#material_dsn_kr').html(xssDecode(data.material_dsn_kr));
				$('#material_dsn_en').html(xssDecode(data.material_dsn_en));
				$('#material_dsn_cn').html(xssDecode(data.material_dsn_cn));
				
				$('#care_dsn_kr').html(xssDecode(data.care_dsn_kr));
				$('#care_dsn_en').html(xssDecode(data.care_dsn_en));
				$('#care_dsn_cn').html(xssDecode(data.care_dsn_cn));
				
				$('#detail_kr').html(xssDecode(data.detail_kr));
				$('#detail_en').html(xssDecode(data.detail_en));
				$('#detail_cn').html(xssDecode(data.detail_cn));
				
				$('#material_td_kr').html(xssDecode(data.material_td_kr));
				$('#material_td_en').html(xssDecode(data.material_td_en));
				$('#material_td_cn').html(xssDecode(data.material_td_cn));
				
				$('#care_td_kr').html(xssDecode(data.care_td_kr));
				$('#care_td_en').html(xssDecode(data.care_td_en));
				$('#care_td_cn').html(xssDecode(data.care_td_cn));

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
	}
}

function putOrdersheetInfo_DSN(flg) {
	material_dsn_kr.getById["material_dsn_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	material_dsn_en.getById["material_dsn_en"].exec("UPDATE_CONTENTS_FIELD", []);
	material_dsn_cn.getById["material_dsn_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	care_dsn_kr.getById["care_dsn_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	care_dsn_en.getById["care_dsn_en"].exec("UPDATE_CONTENTS_FIELD", []);
	care_dsn_cn.getById["care_dsn_cn"].exec("UPDATE_CONTENTS_FIELD", []);

	detail_kr.getById["detail_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_en.getById["detail_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_cn.getById["detail_cn"].exec("UPDATE_CONTENTS_FIELD", []);

	material_td_en.getById["material_td_en"].exec("UPDATE_CONTENTS_FIELD", []);
	material_td_cn.getById["material_td_cn"].exec("UPDATE_CONTENTS_FIELD", []);

	care_td_en.getById["care_td_en"].exec("UPDATE_CONTENTS_FIELD", []);
	care_td_cn.getById["care_td_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
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
	}
	
	if (name_err_cnt > 0) {
		alert('이름이 미입력된 옵션이 존재합니다. 옵션이름 입력 후 다시 시도해주세요.');
		return false;
	}
	
	if (size_err_cnt > 0) {
		alert('사이즈 정보가 미입력된 옵션이 존재합니다. 사이즈 정보 입력 후 다시 시도해주세요.');
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
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_1 + '</p></TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_2 != null && size_data.size_desc_2 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_2 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_2 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_2 + '</p></TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_3 != null && size_data.size_desc_3 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_3 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_3 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_3 + '</p></TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_4 != null && size_data.size_desc_4 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_4 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_4 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_4 + '</p></TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_5 != null && size_data.size_desc_5 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_5 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_5 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_5 + '</p></TH>';
						colspan_cnt++;
					}
					
					if (size_data.size_title_6 != null && size_data.size_desc_6 != null) {
						str_div_size_desc += '        <tr class="tr_size">';
						str_div_size_desc += '            <td class="size_title">' + size_data.size_title_6 + '</td>';
						str_div_size_desc += '            <td class="size_desc">' + size_data.size_desc_6 + '</td>';
						str_div_size_desc += '        </tr>';
						
						str_div_option_th += '            <TH><p class="required_title">' + size_data.size_title_6 + '</p></TH>';
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
					str_div_option_table += '                <TH><p class="required_title">옵션이름</p></TH>';
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
		strDiv += '        ' + row.option_weight;
		strDiv += '        <input type="hidden" name="option_weight[]" value="' + row.option_weight + '">';
		strDiv += '    </TD>';
		strDiv += '    <TD>';
		strDiv += '        ' + row.limit_option_qty;
		strDiv += '        <input type="hidden" name="limit_option_qty[]" value="' + row.limit_option_qty + '">';
		strDiv += '    </TD>';
		strDiv += '</TR>';
	});
	
	$('#option_info').append(strDiv);
}

function addOptionInfo() {
	let size_guide_category = $('#size_guide_category').val();
	if (size_guide_category == "" || size_guide_category == null) {
		alert('사이즈 가이드를 선택해주세요.');
		return false;
	}
	
	$('.default_tr').remove();
	let size_name_obj = $('input[name="size_name"]:checked');
	if(size_name_obj.length > 0){
		let cnt_th = $('#ordersheet_option_info').find('th').length;
		let product_code = $('#product_code').text();
		let strDiv = "";
		size_name_obj.each(function(){
			strDiv += '<TR>';
			strDiv += '    <TD>';
			strDiv += '        <div class="btn remove_option_btn" onClick="removeOptionInfo(this);">옵션삭제</div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>';
			strDiv += '        <input class="option_name" type="text" name="option_name[]" value="' + $(this).next().text() + '">';
			strDiv += '        <input class="option_type" type="hidden" name="option_type[]" value="' + $(this).val() + '">';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + product_code + $(this).val() + '</TD>';
				
			for (let i=1; i<(cnt_th - 4); i++) {
				strDiv += '<TD>';
				strDiv += '    <input class="option_size_' + i + '" type="text" name="option_size_' + i + '[]" value="">';
				strDiv += '</TD>';
			}

			strDiv += '    <TD>';
			strDiv += '        0';
			strDiv += '        <input type="hidden" name="option_weight[]" value="0">';
			strDiv += '    </TD>';
			strDiv += '    <TD>';
			strDiv += '        0';
			strDiv += '        <input type="hidden" name="limit_option_qty[]" value="0">';
			strDiv += '    </TD>';
			strDiv += '</TR>';
		});
		$('#option_info').append(strDiv);
	}
	else {
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