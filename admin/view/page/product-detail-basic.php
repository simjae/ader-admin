<style>
.toggle_table_btn {background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;}
.content__card.product__detail, .content__card.product__detail .card__body{height:100%}
.content__card.product__detail{display:flex;flex-direction:column;}
.content__card.product__detail .card__body{flex: 1;overflow-y:scroll}
.move__btn__container{margin-top:10px;display:grid;grid-template-columns: repeat(12, 1fr);}
.btn__item.btn{text-align:center;height:50px;line-height : 34px;}
.btn__item.btn:hover{background-color:#dcdcdc}
.price__text{text-align:right;}
.update__flg__area{justify-content:flex-start!important}
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
.btn-close{float:right;color:'#000';}
.size_info_text {height:150px;}
.smart_editer_text {height:180px;}
.gray_btn{border:1px solid #000000;background-color:#ffffff;color:#000000;width:80px;height:30px;font-size:0.5rem;cursor:pointer;}
#seo {margin-top : 50px;}
.sub {margin-top : 10px;}
.tmp_set_product {width:230px;height:20px;line-height:10px;background-color:#140f82;border-radius:5px;color:#ffffff;font-size:0.5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding:5px;margin-right:5px;margin-top:5px;float:left;cursor:pointer;}
#loading_img {position:absolute;top:${top}px;left:${left}px;width:75px;height:75px;z-index:9999;background:#f0f0f0;filter:alpha(opacity=50);opacity:alpha*0.5;margin:auto;padding:0;}
.mileage__per{width:50px!important;}
.detail_category_title{margin:10px 0 10px 0}
</style>

<?php include_once("check.php"); ?>

<?php
function getUrlParamter($url, $sch_tag) {
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$product_idx = getUrlParamter($page_url, 'product_idx');
?>

<div class="content__card product__detail" style="margin: 0">
	<div class="card__header">
		<h3>
			상품정보 수정 페이지
		</h3>
		
		<div class="move__btn__container">
			<div class="btn__item btn common" onclick="moveInfoScroll('common')">기본정보</div>
			<div class="btn__item btn sale" onclick="moveInfoScroll('sale')">판매정보</div>
			<div class="btn__item btn limit" onclick="moveInfoScroll('limit')">구매정보</div>
			<div class="btn__item btn option" onclick="moveInfoScroll('option')">옵션정보</div>
			<div class="btn__item btn relevant" onclick="moveInfoScroll('relevant')">관련상품</div>
			<div class="btn__item btn care" onclick="moveInfoScroll('care')">유의사항</div>
			<div class="btn__item btn detail" onclick="moveInfoScroll('detail')">상세정보</div>
			<div class="btn__item btn material" onclick="moveInfoScroll('material')">소재</div>
			<div class="btn__item btn refund" onclick="moveInfoScroll('refund')">환불정보</div>
			<div class="btn__item btn search" onclick="moveInfoScroll('search')">검색정보</div>
			<div class="btn__item btn image" onclick="moveInfoScroll('image')">이미지</div>
			<div class="btn__item btn filter" onclick="moveInfoScroll('filter')">필터</div>
		</div>
	</div>
	
	<div class="card__body">
		<form id="frm-update" action="">	
			<input id="product_idx" name="product_idx" type="hidden"  value='<?=$product_idx?>'>
			<input id="product_type" type="hidden" name="product_type" value="B">
			
			<input id="ordersheet_idx" name="ordersheet_idx" type="hidden"  value="">

			<div class="table table__wrap basic">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('MD');">오더시트 - 기획MD</button>
				<div class="overflow-x-auto" id="insert_table_MD">
					<TABLE>
						<colgroup>
							<col width="10%">
							<col width="auto">
							<col width="10%">
							<col width="auto">
							<col width="10%">
							<col width="auto">
						</colgroup>
						<TBODY>
							<TR>
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
							</tr>
							
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
								
								<TH>구매제한 수량</TH>
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
							<col width="40%">
							<col width="10%">
							<col width="40%">
						</colgroup>
						<TBODY>
							<tr>
								<TH>기획재고 수량</TH>
								<TD id="product_qty"></TD>
								
								<TH>안전재고 수량</TH>
								<TD id="safe_qty"></TD>
							</tr>
							
							<tr>
								<TH>입고 요청일</TH>
								<TD id="receive_request_date"></TD>
								
								<TH>런칭일</TH>
								<TD id="launching_date"></TD>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="table table__wrap basic">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('DSN');">오더시트 - 디자인</button>
				<div class="overflow-x-auto" id="insert_table_DSN">
					<TABLE class="size_info_table">
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
								<th>소재</th>
								<td id="material"></td>
								
								<th>상품 핏</th>
								<td id="fit"></td>
								
								<th>rgb코드</th>
								<td id="color_rgb"></td>
								
								<th>팬톤 코드</td>
								<td id="pantone_code"></td>
							</tr>
							<tr>
								<TH>W/K/L/A</TH>
								<TD colspan="3">
									<div id="div_wkla" style="margin-top:5px">
									</div>
								</TD>
								
								<th>모델</th>
								<TD id="model"></TD>
								
								<th>모델착용 사이즈</th>
								<TD id="model_wear"></TD>
							</TR>
							
							<TR>
								<TD colspan="8">
									<div class="content__row">
										<select id="size_guide_idx" name="size_guide_idx" class="fSelect eSearch" style="width:163px;" onChange="getSizeGuideList();">
											<?php
												$select_size_guide_sql = "
													SELECT
														SG.IDX				AS SIZE_IDX,
														SG.CATEGORY_TYPE	AS CATEGORY_TYPE
													FROM
														dev.SHOP_PRODUCT PR
														LEFT JOIN dev.ORDERSHEET_MST OM ON
														PR.ORDERSHEET_IDX = OM.IDX
														LEFT JOIN dev.SIZE_GUIDE SG ON
														OM.SIZE_GUIDE_IDX = SG.IDX
													WHERE
														PR.IDX = ".$product_idx."
												";
												
												$db->query($select_size_guide_sql);

												foreach ($db->fetch() as $size_data) {
													$size_idx = $size_data['SIZE_IDX'];
													if (!empty($size_idx)) {
											?>
												<option value="<?=$size_data['SIZE_IDX']?>" readonly><?=$size_data['CATEGORY_TYPE']?></option>
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
							
							<TR>
								<TH>최초 TP 작성일</TD>
								<TD id="tp_completion_date" colspan="7"></TD>
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
								<TH style="width:10%;">제품 상세정보 (한글)</TH>
								<TD class="smart_editer_text" id="detail_dsn_kr"></TD>
							</TR>

							<TR>
								<TH style="width:10%;">제품 상세정보 (영문)</TH>
								<TD class="smart_editer_text" id="detail_dsn_en"></TD>
							</TR>

							<TR>
								<TH style="width:10%;">제품 상세정보 (중문)</TH>
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
				</div>
			</div>
			
			<div class="table table__wrap basic">
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
								<TD class="smart_editer_text" id="material_text_kr"></TD>
							</TR>

							<TR>
								<TH>소재(영문)</TH>
								<TD class="smart_editer_text" id="material_text_en"></TD>
							</TR>

							<TR>
								<TH>소재(중문)</TH>
								<TD class="smart_editer_text" id="material_text_cn"></TD>
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
							
							<tr>
								<TH>상품 적재중량 (kg)</TH>
								<TD id="load_weight" colspan="3"></TD>
								
								<TH>상품 적재수량</TH>
								<TD id="load_qty" colspan="3"></TD>
							</tr>
							
							<tr>
								<TH>포장부자재</TH>
								<TD colspan="3">
									<table>
										<tbody id="package_sub_material">
										</tbody>
									</table>
								</TD>
								
								<TH>배송부자재</TH>
								<TD colspan="3">
									<table>
										<tbody id="delivery_sub_material">
										</tbody>
									</table>
								</TD>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="table table__wrap">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('PR');">독립몰 상품 정보</button>
				
				<div class="overflow-x-auto">
					<TABLE style="width:100%">
						<colgroup>
							<col width="10%">
							<col width="auto">
							<col width="10%">
							<col width="auto">
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
							<tr>
								<td colspan="12" id="common_info_marker">
									<h3 class="detail_category_title">기본정보</h3>
								</td>
							</tr>
							<TR>
								<TH>스타일코드</TH>
								<TD colspan="5">
									<input type="text" id="shop_style_code" name="shop_style_code" value=""> 
								</TD>
								
								<TH>컬러코드</TH>
								<TD colspan="5">
									<input type="text" id="shop_color_code" name="shop_color_code" value="">
								</TD>
							</TR>
							
							<TR>
								<TH>상품코드</TH>
								<TD colspan="5">
									<input type="text" id="shop_product_code" name="shop_product_code" value="">
								</TD>
								
								<TH>
									상품 이름
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
								</TH>
								<TD colspan="5">
									<input type="text" id="shop_product_name" name="shop_product_name" value="">
								</TD>
							</TR>
							
							<tr>
								<TH>재고 현황</TH>
								<td colspan="11">
									<table>
										<thead>
											<th>옵션이름</th>
											<th>바코드</th>
											<TH>상품재고</TH>
											<TH>안전재고</TH>
											<TH>주문재고</TH>
											<TH>총 재고량</TH>
										</thead>
										<tbody id="product_stock">
											<td>-</td>
											<td>-</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
										</tbody>
									</table>
								</td>
							</tr>
							
							<TR>
								<TH>
									MD 제품 카테고리
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
								</TH>
								
								<TD colspan="11">
									<div class="content__row">
										<input type="hidden" class="md_category" id="md_category_1" name="md_category_1" value="0">
										<input type="hidden" class="md_category" id="md_category_2" name="md_category_2" value="0">
										<input type="hidden" class="md_category" id="md_category_3" name="md_category_3" value="0">
										<input type="hidden" class="md_category" id="md_category_4" name="md_category_4" value="0">
										<input type="hidden" class="md_category" id="md_category_5" name="md_category_5" value="0">
										<input type="hidden" class="md_category" id="md_category_6" name="md_category_6" value="0">
										<select class="fSelect category eCategory eCategory1 basicProduct" depth="1" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 01</option>	
										</select>
										<select class="fSelect category eCategory eCategory2 basicProduct" depth="2" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 02</option>
										</select>
										<select class="fSelect category eCategory eCategory3 basicProduct" depth="3" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 03</option>
										</select>
										<select class="fSelect category eCategory eCategory4 basicProduct" depth="4" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 04</option>
										</select>
										<select class="fSelect category eCategory eCategory5 basicProduct" depth="5" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 05</option>
										</select>
										<select class="fSelect category eCategory eCategory6 basicProduct" depth="6" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
											<option value="0">상품분류 06</option>
										</select>
									</div>
								</TD>
							</TR>
							<TR>
								<TH>해외 통관 정보
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
								</TH>
								
								<TD colspan="11">
									<div class="content__row">
										<select id="custom_clearance" name="custom_clearance" class="fSelect eSearch" style="width:163px;">
											<option value="" selected>--해외 통관 분류--</option>	
<?php

			$get_sql = "
				SELECT
					IDX,
					CATEGORY_CODE,
					CATEGORY_NAME,
					CATEGORY_IDX,
					HS_CODE
				FROM
					dev.CUSTOM_CLEARANCE
			";
			$db->query($get_sql);
			foreach($db->fetch() as $data){
?>
											<option value="<?=$data['HS_CODE']?>"><?=$data['CATEGORY_NAME']?></option>

<?php
			}
			
?>
										</select>
										<span id="select_clearance_msg">통관번호 : <span>
									</div>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="sale_info_marker">
									<h3 class="detail_category_title">판매정보</h3>
								</td>
							</tr>
							<tr>
								<TH>판매 여부</TH>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="sale_update_flg" value="true" checked>
											<div><div></div></div>
											<span>판매</span>
										</label>
										
										<label class="rd__square">
											<input type="radio" name="sale_update_flg" value="false">
											<div><div></div></div>
											<span>판매안함</span>
										</label>
									</div>
								</TD>
								
								<TH>품절 여부</TH>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="sold_out_flg" value="false" checked>
											<div><div></div></div>
											<span>구매가능</span>
										</label>
										
										<label class="rd__square">
											<input type="radio" name="sold_out_flg" value="true">
											<div><div></div></div>
											<span>품절</span>
										</label>
									</div>
								</TD>
							</TR>
							
							<TR>
								<TH>마일리지 사용여부</TH>
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
								
								<TH>단독구매 제한유무</TH>
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
								<TH>
									한국몰 가격
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
								</TH>
								<TD colspan="3">
									<input id="shop_price_kr" class="price" type="number" step="0.01" name="price_kr" value="0">
								</TD>

								<TH>
									영문몰 가격
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
								</TH>
								<TD colspan="3">
									<input id="shop_price_en" class="price" type="number" step="0.01" name="price_en" value="0">
								</TD>

								<TH>중국몰 가격
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
								</TH>
								<TD colspan="3">
									<input id="shop_price_cn" class="price" type="number" step="0.01" name="price_cn" value="0">
								</TD>
							</TR>
							
							<TR class="cal_discount">
								<TH>한국몰 세일가격
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
								<TD colspan="3">
									<input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0">
								</TD>
								
								<TH>영문몰 세일가격
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
								<TD colspan="3">
									<input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0">
								</TD>

								<TH>중국몰 세일가격
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
								<TD colspan="3">
									<input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0">
								</TD>
							</TR>
							
							<TR class="cal_discount" > 
								<TH>한국몰 할인율
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

								<TH>영문몰 할인율
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

								<TH>중국몰 할인율
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

							<TR> 
								<TH>멤버별 마일리지</TD>
								<TD colspan="11">
									<table>
										<tbody>
<?php
	$get_product_mileage_sql = "
		SELECT
			ML.IDX    					AS LEVEL_IDX,
			ML.TITLE 					AS LEVEL_TITLE,
			IFNULL(PM.MILEAGE_PER,0)	AS MILEAGE_PER
		FROM
			dev.MEMBER_LEVEL   ML
		LEFT JOIN
			(SELECT
				IDX,
				LEVEL_IDX,
				PRODUCT_IDX,
				MILEAGE_PER
			FROM
				dev.PRODUCT_MILEAGE
			WHERE
				PRODUCT_IDX = ".$product_idx."
			) 					PM
		ON
			ML.IDX = PM.LEVEL_IDX
	";

	$db->query($get_product_mileage_sql);
	foreach($db->fetch() as $key => $mileage_info){
		if($key % 4 == 0){
			//open td
?>
										<tr>
<?php
		}
?>
											<td>	
												<input type="hidden" name="level_idx[]" value="<?=$mileage_info['LEVEL_IDX']?>">
												<div style="display:flex;justify-content: space-between;align-items:center;">
													<span><?=$mileage_info['LEVEL_TITLE']?></span>
													<div>
														<input type="number" class="mileage__per" name="mileage_per[]" value="<?=$mileage_info['MILEAGE_PER']?>">
														<span>%</span>
													</div>
												</div>
											</td>
<?php
		if($key % 4 == 3){
			//close td
?>
										</tr>
<?php
		}
	}
?>
										</tbody>
									</table>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="limit_info_marker">
									<h3 class="detail_category_title">구매정보</h3>
								</td>
							</tr>
							<tr>
								<TH>구매 멤버 제한
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
								</TH>
								<TD colspan="11">
									<div class="content__row form-group">
										<?php
											$get_member_level_sql = "
												SELECT
													IDX,
													TITLE
												FROM
													dev.MEMBER_LEVEL
												WHERE
													DEL_FLG = FALSE
											";
											$db->query($get_member_level_sql);

											foreach($db->fetch() as $level_info){
										?>
										<label>
											<input type="checkbox" name="limit_member[]" value="<?=$level_info['IDX']?>">
											<span><?=$level_info['TITLE']?></span>
										</label>
										<?php
											}
										?>
									</div>
								</TD>
							</tr>
							
							<TR>
								<TH>ID당 구매제한</TH>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="limit_id_flg" value="false" checked>
											<div><div></div></div>
											<span>제한안함</span>
										</label>
										<label class="rd__square">
											<input  type="radio" name="limit_id_flg" value="true">
											<div><div></div></div>
											<span>제한</span>
										</label>
									</div>
								</TD>
								
								<TH>
									리오더 차수
									<label class="rd__square update__flg__area">
										<input type="radio" name="reorder_cnt_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="reorder_cnt_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TH>
								<TD colspan="5">
									<input id="reorder_cnt" type="number" step="1" name="reorder_cnt" value="0">
								</TD>
							</TR>
							
							<TR>
								<TH>구매수량 제한</TH>
								<TD colspan="5">
									<div class="content__row">
										<label class="rd__square">
											<input type="radio" name="limit_purchase_qty_flg" value="false" checked>
											<div><div></div></div>
											<span>제한안함</span>
										</label>
										<label class="rd__square">
											<input  type="radio" name="limit_purchase_qty_flg" value="true">
											<div><div></div></div>
											<span>제한</span>
										</label>
									</div>
								</TD>
								
								<TH>상품별 구매제한 수량
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_product_qty_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="limit_product_qty_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TH>
								<TD colspan="5">
									<input id="limit_shop_product_qty" type="number" step="1" name="limit_product_qty" value="0">
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="option_info_marker">
									<h3 class="detail_category_title">옵션정보</h3>
								</td>
							</tr>
							<TR>
								<TH>옵션별 구매수량 제한</TH>
								<TD colspan="11">
									<table style="width:50%">
										<colgroup>
											<col width="25%;">
											<col width="25%;">
											<col width="25%;">
											<col width="25%;">
										</colgroup>
										<thead>
											<tr>
												<TR>
													<TH>옵션이름</TH>
													<TH>바코드</TH>
													<TH>판매 제한 수량</TH>
													<TH>판매여부</TH>
												</TR>
											</tr>
										</thead>
										<tbody id="product_option_table">

										</tbody>
									</table>
								</TD>
							</TR>
							
							<TR>
								<TH>상품 검색어
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
								</TH>
								<TD colspan="11"><input type="text" id="product_keyword" name="product_keyword" value="" style="width:90%"></TD>
							</TR>
							
							<TR>
								<TH>상품 태그
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
								</TH>
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
							<tr>
								<td colspan="12" id="relevant_info_marker">
									<h3 class="detail_category_title">관련상품</h3>
								</td>
							</tr>
							<TR>
								<TH>
                                    관련상품 정보
									
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
									
                                    <button class="btn black" onClick="openRelevantProductModal();">관련상품 검색</button>
								</TH>
								
								<TD colspan="11">
									<div id="relevant_list" class="row">
                                        <div class="table table__wrap">
                                            <div class="overflow-x-auto">
                                                <div id="relevant_list_area">
                                                    <h3 style="margin-top:15px;margin-bottom:10px;">관련상품 리스트</h3>
                                                    <TABLE style="width:99%">
                                                        <thead>
                                                            <tr>
                                                                <TH style="width:3%;">삭제</TH>
                                                                <TH style="width:3%;">상품<br>구분</TH>
                                                                <TH>상품 코드</TH>
                                                                <TH>상품명</TH>
                                                                <TH style="width:8%;">판매가<br>(한국몰)</TH>
                                                                <TH style="width:8%;">판매가<br>(영문몰)</TH>
                                                                <TH style="width:8%;">판매가<br>(중국몰)</TH>
                                                                <TH>관련상품 재고수량</TH>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="relevant_product_table">
                                                        </tbody>
                                                    </TABLE>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</TD>
							</TR>
							
							<TR>
								<TH>
									상품 재고<br>품절 임박 수량
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
								</TH>
								<TD colspan="11">
									<input id="sold_out_qty" type="number" step="1" style="width:30%" name="sold_out_qty" value="0">
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="care_info_marker">
									<h3 class="detail_category_title">유의사항</h3>
								</td>
							</tr>
							<TR>
								<TH>
									제품 취급 유의사항<br>(한글)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="care_kr" name="care_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									제품 취급 유의사항<br>(영문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="care_en" name="care_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									제품 취급 유의사항<br>(중문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="care_cn" name="care_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="detail_info_marker">
									<h3 class="detail_category_title">상세정보</h3>
								</td>
							</tr>
							<TR>
								<TH>
									제품 상세정보 (한글)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_kr" name="detail_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									제품 상세정보 (영문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_en" name="detail_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									제품 상세정보 (중문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="detail_cn" name="detail_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="material_info_marker">
									<h3 class="detail_category_title">소재</h3>
								</td>
							</tr>
							<TR>
								<TH>
									소재 (한글)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="material_kr" name="material_kr" style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									소재 (영문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="material_en" name="material_en" style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									소재 (중문)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="material_cn" name="material_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="refund_info_marker">
									<h3 class="detail_category_title">환불정보</h3>
								</td>
							</tr>
							<TR>	
								<TH>구매 전<br>환불정보 표시 플래그</TH>
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
								<TH>
									구매 전<br>환불정보 표시 메세지(한국몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_kr_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_kr_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TH>
								<TD colspan="11">
									<input type="text" id="refund_msg_kr" name="refund_msg_kr">
								</TD>
							</TR>
							
							<TR>
								<TH>
									구매 전<br>환불정보 표시 메세지(영문몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_en_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_en_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TH>
								<TD colspan="11">
									<input type="text" id="refund_msg_en" name="refund_msg_en">
								</TD>
							</TR>
							
							<TR>	
								<TH>
									구매 전<br>환불정보 표시 메세지(중문몰)
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_cn_update_flg" value="false">
										<div><div></div></div>
										<span>수정안함</span>
									</label>
									<label class="rd__square update__flg__area">
										<input type="radio" name="refund_msg_cn_update_flg" value="true" checked>
										<div><div></div></div>
										<span>수정함</span>
									</label>
								</TH>
								<TD colspan="11">
									<input type="text" id="refund_msg_cn" name="refund_msg_cn">
								</TD>
							</TR>
							
							<TR>
								<TH>
									추가 교환/환불<br>상세정보<br>(한국몰)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_kr" name="refund_kr"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TH>
									추가 교환/환불<br>상세정보<br>(영문몰)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_en" name="refund_en"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TH>
									추가 교환/환불<br>상세정보<br>(중국몰)
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="refund_cn" name="refund_cn"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>

							<TR>
								<TH>
									메모
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="memo" name="memo"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="search_info_marker">
									<h3 class="detail_category_title">검색정보</h3>
								</td>
							</tr>
							<TR>
								<TH>검색엔진<br>노출설정</TH>
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
								<TH>
									검색엔진<br>브라우저 타이틀
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
								</TH>
								<TD colspan="11">
									<input type="text" id="seo_title" name="seo_title" value="">
								</TD>
							</TR>
							
							<TR>
								<TH>메타태그<br>Author
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
								</TH>
								<TD colspan="11">
									<input type="text" id="seo_author" name="seo_author" value="">
								</TD>
							</TR>
							
							<TR>
								<TH>메타태그<br>Description
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="seo_description" name="seo_description"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							
							<TR>
								<TH>
									메타태그<br>Keyword
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
								</TH>
								<TD colspan="11">
									<input type="text" id="seo_keywords" name="seo_keywords" value="">
								</TD>
							</TR>
							
							<TR>
								<TH>
									검색엔진<br>상품이미지<br>ALT 텍스트
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
								</TH>
								<TD colspan="11">
									<textarea class="width-100p" id="seo_alt_text" name="seo_alt_text"
										style="width:90%; height:150px;"></textarea>
								</TD>
							</TR>
							<tr>
								<td colspan="12" id="image_info_marker">
									<h3 class="detail_category_title">이미지</h3>
								</td>
							</tr>
							<TR>
								<TH>상품 이미지 불러오기
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
								</TH>
								<TD colspan="11">
									<div style="margin-bottom:15px">
										<span>FTP 폴더경로 :</span>
										<input type="text" id="img_url" name="img_url" style="width:40%;margin-left:5px;margin-right:20px">
										<input type="button" class="gray_btn" value="체크" style="margin-right:10px" onclick="imgExistChk()">
										<input type="button" class="gray_btn" active_flg="false" value="미리보기" onclick="previewImg(this)">
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
								<TH>미리보기</TH>
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
								<td colspan="12" id="filter_info_marker">
									<h3 class="detail_category_title">필터</h3>
								</td>
							</tr>
							<tr>
								<th>색상 필터 적용</th>
								<td colspan="11">
									<div class="content__row form-group filter_cl">
										
									</div>
								</td>
							</tr>
							<tr>
								<th>핏 필터 적용</th>
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
								<th>그래픽 필터 적용</th>
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
								<th>라인 필터 적용</th>
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
								<th>사이즈 필터 적용</th>
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
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
				<div class="defult__color__btn" onclick="location.href='http://116.124.128.246:81/product/list'"><span>상품 목록페이지로 돌아가기</span></div>
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
	$('.content__card.product__detail .card__body').offset();
	setSmartEditor();
	getProductCategory(0,0);
	
	$('#insert_table_MD').toggle();
	$('#insert_table_DSN').toggle();
	$('#insert_table_TD').toggle();

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
		let hs_code = $('#custom_clearance').val()
		var msg = "통관번호 : " + hs_code;
		$('#select_clearance_msg').text(msg);
	});

	$('.card__body').scroll(function(){
		let markerTopArr = new Array(12);

		markerTopArr.push([$('#common_info_marker').offset().top, 'common']);
		markerTopArr.push([$('#sale_info_marker').offset().top, 'sale']);
		markerTopArr.push([$('#limit_info_marker').offset().top, 'limit']);
		markerTopArr.push([$('#option_info_marker').offset().top, 'option']);
		markerTopArr.push([$('#relevant_info_marker').offset().top, 'relevant']);
		markerTopArr.push([$('#care_info_marker').offset().top, 'care']);
		markerTopArr.push([$('#detail_info_marker').offset().top, 'detail']);
		markerTopArr.push([$('#material_info_marker').offset().top, 'material']);
		markerTopArr.push([$('#refund_info_marker').offset().top, 'refund']);
		markerTopArr.push([$('#search_info_marker').offset().top, 'search']);
		markerTopArr.push([$('#image_info_marker').offset().top, 'image']);
		markerTopArr.push([$('#filter_info_marker').offset().top, 'filter']);

		markerTopArr.forEach(function(row){
			if(row[0] < 151){
				$('.btn__item.btn').css('background-color','#ffffff');
				$(`.btn__item.btn.${row[1]}`).css('background-color','#dcdcdc');
			}
		})
	});
	getFilterInfo();
	getProductInfo();
});

function toggleTableClick(toggle_val) {
	$('#insert_table_' + toggle_val).toggle();
}

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	getProductCategory(depth,no);

	$.ajax({
		type: "post",
		data: {
			'no':no
		},
		dataType: "json",
		url: config.api + "product/custom_clearance/get",
		error: function() {
		},
		success: function(d) {
			if(d != null){
				if(d.code == 200) {
					if(d.data != null && d.data.length > 0){
						$('#custom_clearance').html('');
						$('#custom_clearance').append(`<option value="" selected>--해외 통관 분류--</option>`);
						d.data.forEach(function(row){
							let strOption = '';
							strOption = `<option value="${row.hs_code}">${row.category_name}</option>`;
							$('#custom_clearance').append(strOption);
						})
						$('#select_clearance_msg').text('');
					}
				}
			}
		}
	});
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
	eCategory.append($('<option value="0" selected>상품분류 0' + depth + '</option>'));
	if (data != null) {
		data.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	for(var i = depth + 1; i <= 6; i++){
		$('.eCategory' + i + '.basicProduct').val(0).prop("selected",true);
	}

	if($(category_dir).val() != '0' && $(category_dir).val() > 0){
		eCategory.val($(category_dir).val()).prop('selected', true);
		getProductCategory(depth,$(category_dir).val());
		$(category_dir).val(0);
	}
}

function getProductInfo() {
	let product_idx = $('#product_idx').val();
	
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
				
				let ordersheet_idx = data.ordersheet_idx;
				getOrdersheetInfo(ordersheet_idx);
				
				$('#shop_style_code').val(data.style_code);
				$('#shop_color_code').val(data.color_code);
				$('#shop_product_code').val(data.product_code);
				$('#shop_product_name').val(data.product_name);
				
				let product_stock = data.product_stock;
				if (product_stock != null) {
					let strDiv = "";
					product_stock.forEach(function(stock_row) {
						strDiv += '<tr>';
						strDiv += '    <td>' + stock_row.option_name + '</td>';
						strDiv += '    <td>' + stock_row.barcode + '</td>';
						strDiv += '    <td>' + stock_row.stock_qty + '</td>';
						strDiv += '    <td>' + stock_row.safe_qty + '</td>';
						strDiv += '    <td>' + stock_row.order_qty + '</td>';
						strDiv += '    <td>' + stock_row.product_qty + '</td>';
						strDiv += '</tr>';
					});
					
					$('#product_stock').html(strDiv);
				}
				
				$('.eCategory1.basicProduct').val(data.md_category_1).attr("selected","selected").change();
				$('#md_category_2').val(data.md_category_2);
				$('#md_category_3').val(data.md_category_3);
				$('#md_category_4').val(data.md_category_4);
				$('#md_category_5').val(data.md_category_5);
				$('#md_category_6').val(data.md_category_6);
				
				if(data.sale_flg == false){
					$('input:radio[name=sale_update_flg]:input[value="false"]').attr("checked",true);
				} else if (data.sale_flg == true) {
					$('input:radio[name=sale_update_flg]:input[value="true"]').attr("checked",true);
				}
				
				if(data.sold_out_flg == false){
					$('input:radio[name=sold_out_flg]:input[value="false"]').attr("checked",true);
				} else if (data.sale_flg == true) {
					$('input:radio[name=sold_out_flg]:input[value="true"]').attr("checked",true);
				}
				
				if(data.mileage_flg == false){
					$('input:radio[name=mileage_flg]:input[value="false"]').attr("checked",true);
				} else if(data.mileage_flg == true) {
					$('input:radio[name=mileage_flg]:input[value="true"]').attr("checked",true);
				}
				
				if(data.exclusive_flg == false){
					$('input:radio[name=exclusive_flg]:input[value="false"]').attr("checked",true);
				} else if(data.exclusive_flg == true) {
					$('input:radio[name=exclusive_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#shop_price_kr').val(data.price_kr);
				$('#sales_price_kr').val(data.sales_price_kr);
				$('#discount_kr').val(data.discount_kr);
				
				$('#shop_price_en').val(data.price_en);
				$('#sales_price_en').val(data.sales_price_en);
				$('#discount_en').val(data.discount_en);
				
				$('#shop_price_cn').val(data.price_cn);
				$('#sales_price_cn').val(data.sales_price_cn);
				$('#discount_cn').val(data.discount_cn);
				
				if(data.limit_member != null && data.limit_member.length > 0){
					var limit_member_arr = [];
					limit_member_arr = data.limit_member.split(',');
					limit_member_arr.forEach(function(mem_num){
						$('input:checkbox[name="limit_member[]"]:input[value="' + mem_num + '"]').attr("checked",true);
					})
				}
				
				$('#limit_shop_product_qty').val(data.limit_product_qty);
				$('#reorder_cnt').val(data.reorder_cnt);
				
				if(data.limit_purchase_qty_flg == false){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="false"]').attr("checked",true);
				} else if(data.limit_purchase_qty_flg == true){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="true"]').attr("checked",true);
				}
				
				let product_option = data.product_option;
				if (product_option != "" && product_option != null) {
					let strDiv = "";
					product_option.forEach(function(option_row) {
						strDiv += '<TR id="product_option_' + option_row.product_option_idx + '">';
						strDiv += '    <TD>' + option_row.option_name + '</TD>';
						strDiv += '        <input type="hidden" name="product_option_idx[]" value="' + option_row.product_option_idx + '"';
						strDiv += '    <TD>' + option_row.option_name + '</TD>';
						strDiv += '    <TD>' + option_row.barcode + '</TD>';
						strDiv += '    <TD>';
						strDiv += '        <input type="text" name="option_qty[]" value="' + option_row.qty + '">';
						strDiv += '    </TD>'
						strDiv += '    <TD>';
						
						let txt_sale_flg = "";
						if (option_row.sale_flg == true) {
							txt_sale_flg = "true";
						} else {
							txt_sale_flg = "false";
						}
						
						strDiv += '        <input class="option_sale_flg" type="hidden" name="option_sale_flg[]" value="' + txt_sale_flg + '">';
						strDiv += '        <div style="display:flex;">'
						strDiv += '            <label class="rd__square update__flg__area">';
						strDiv += '                <input type="radio" name="option_sale_flg_' + option_row.product_option_idx + '" product_option_idx="' + option_row.product_option_idx + '" value="true" checked onClick="clickOptionSaleFlg(this);">';
						strDiv += '                <div><div></div></div>';
						strDiv += '                <span>판매</span>';
						strDiv += '            </label>';

						strDiv += '            <label class="rd__square update__flg__area" style="margin-left:15px;">';
						strDiv += '                <input type="radio" name="option_sale_flg_' + option_row.product_option_idx + '" product_option_idx="' + option_row.product_option_idx + '" value="false" onClick="clickOptionSaleFlg(this);">';
						strDiv += '                <div><div></div></div>';
						strDiv += '                <span>판매안함</span>';
						strDiv += '            </label>';
						strDiv += '        </div>'
						strDiv += '    </TD>';
						
						strDiv += '</TR>';
					});
					
					$('#product_option_table').append(strDiv);
				}
				
				$('#product_keyword').val(data.product_keyword);
				
				if(data.product_tag != null && data.product_tag.length > 0){
					var tag_arr = data.product_tag.split(',');
					tag_arr.forEach(function(item){
						$('#product_tag').val(item);
						addProductTagBtnClick();
					})
				}
				
				$.ajax({
					type: "post",
					data: {
						'clearance_idx':data.clearance_idx
					},
					dataType: "json",
					url: config.api + "product/custom_clearance/get",
					error: function() {
					},
					success: function(d) {
						if(d != null){
							if(d.code == 200) {
								if(d.data != null){
									$('#custom_clearance').val(d.data).change();
								}
							}
						}
					}
				});
				
				if(data.relevant_product != null && data.relevant_product != []){
                    data.relevant_product.forEach(function(row){

                        let strDiv = "";

                        strDiv += '<TR>';
                        strDiv += '		<td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
						strDiv += '    <input type="hidden" name="relevant_idx[]" value="' + row.product_idx + '">';
						strDiv += '</td>';
						
                        var product_type = "";
                        if (row.product_type == "B") {
                            product_type = "일반";
                        } else if (row.product_type == "S") {
                            product_type = "세트";
                        }
                        strDiv += '    <td>' + product_type + '</td>';
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
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
                        } else {
                            if(row.price_kr != null){
                                strDiv += '        ' + row.price_kr;
                            }
                        }
                        strDiv += '    </td>';

                        let discount_en = row.discount_en;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_en > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_en + "</span></br>";
                        } else {
                            if(row.price_en != null){
                                strDiv += '        ' + row.price_en;
                            }
                        }
                        strDiv += '    </td>';

                        let discount_cn = row.discount_cn;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_cn > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_cn + "</span></br>";
                        } else {
                            if(row.price_cn != null){
                                strDiv += '        ' + row.price_cn
                            }
                        }
                        strDiv += '    </td>';
						
                        strDiv += '    <TD>';
						strDiv += '        <TABLE>';
						strDiv += '            <THEAD>';
						strDiv += '                <TR>';
						strDiv += '                    <TH>옵션이름</TH>';
						strDiv += '                    <TH>바코드</TH>';
						strDiv += '                    <TH>상품재고</TH>';
						strDiv += '                    <TH>안전재고</TH>';
						strDiv += '                    <TH>주문재고</TH>';
						strDiv += '                    <TH>총 재고량</TH>';
						strDiv += '                </TR>';
						strDiv += '            </THEAD>';
						
						strDiv += '            <TBODY>';
						
						let product_stock = row.relevant_product_stock;
						product_stock.forEach(function(stock_row) {
							strDiv += '            <TR>';
							strDiv += '                <TD>' + stock_row.option_name + '</TD>';
							strDiv += '                <TD>' + stock_row.barcode + '</TD>';
							strDiv += '                <TD>' + stock_row.stock_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.order_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.safe_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.product_qty + '</TD>';
							strDiv += '            </TR>';
						});
						
						strDiv += '            </TBODY>';
						strDiv += '        </TABLE>';
						strDiv += '    </TD>';
                        strDiv += '</TR>';

                        $('#relevant_product_table').append(strDiv);
                        $('#relevant_list_area').css('visibility','visible');
                    });
                }
				
				$('#sold_out_qty').val(data.sold_out_qty);
				
				$('#care_kr').html(data.care_kr);
				$('#care_en').html(data.care_kr);
				$('#care_cn').html(data.care_kr);
				
				$('#detail_kr').html(data.detail_kr);
				$('#detail_en').html(data.detail_en);
				$('#detail_cn').html(data.detail_cn);
				
				$('#material_kr').html(data.material_kr);
				$('#material_en').html(data.material_en);
				$('#material_cn').html(data.material_cn);
				
				if(data.refund_msg_flg == 0){
					$('input:radio[name=refund_msg_flg]:input[value="false"]').attr("checked",true);
				} else if (data.refund_msg_flg == 1){
					$('input:radio[name=refund_msg_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#refund_msg_kr').val(data.refund_msg_kr);
				$('#refund_msg_en').val(data.refund_msg_en);
				$('#refund_msg_cn').val(data.refund_msg_cn);
				
				$('#refund_kr').html(data.refund_kr);
				$('#refund_en').html(data.refund_en);
				$('#refund_cn').html(data.refund_cn);
				
				$('#memo').html(data.memo);
				
				if(data.seo_exposure_flg == 0){
					$('input:radio[name=seo_exposure_flg]:input[value="false"]').attr("checked",true);
				} else if(data.seo_exposure_flg == 1){
					$('input:radio[name=seo_exposure_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#seo_alt_text').html(data.seo_alt_text);
				$('#seo_description').html(data.seo_description);
				$('#seo_title').val(data.seo_title);
				$('#seo_author').val(data.seo_author);
				$('#seo_keywords').val(data.seo_keywords);
				
				$('#img_url').val('/ader_prod_img/' + data.product_code);
				
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
	});
}

function getOrdersheetInfo(ordersheet_idx) {
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
				
				//ORDERSHEET - MD
				$('#style_code').text(data.style_code);
				$('#color_code').text(data.color_code);
				$('#product_code').text(data.product_code);
				
				if (data.preorder_flg == true) {
					$('#preorder_flg').text('일반상품');
				} else if (data.preorder_flg == false) {
					$('#preorder_flg').text('프리오더 상품');
				}
				
				if (data.refund_flg == true) {
					$('#refund_flg').text('교환 불가');
				} else if (data.refund_flg == false) {
					$('#refund_flg').text('교환 가능');
				}

				if (data.line_idx != null && data.line_idx > 0) {
					let strDiv = "";
					strDiv += '<table style="width:100%">';
					strDiv += '    <thead>';
					strDiv += '        <tr>';
					strDiv += '            <th>라인명</th>';
					strDiv += '            <th>타입</th>';
					strDiv += '            <th>라인 컬러</th>';
					strDiv += '        </tr>';
					strDiv += '    </thead>';
					strDiv += '    <tbody>';
					strDiv += '        <tr>';
					strDiv += '            <td>' + data.line_name + '</td>';
					strDiv += '            <td>' + data.line_type + '</td>';
					strDiv += '            <td>' + data.line_memo + '</td>';
					strDiv += '        </tr>';
					strDiv += '    </tbody>';
					strDiv += '</table>';
					
					$('#line_info_table').append(strDiv);
				}

				$('#category_lrg_title').text(data.category_lrg_title);
				$('#category_mdl_title').text(data.category_mdl_title);
				$('#category_sml_title').text(data.category_sml_title);
				$('#category_dtl_title').text(data.category_dtl_title);
				$('#product_name').text(data.product_name);
				$('#graphic').text(data.graphic);
				$('#product_size').text(data.product_size);
				$('#color').text(data.color);
				$('#md_category_guide').text(data.md_category_guide);
				
				if(data.limit_id_flg == false){
					$('input:radio[name=limit_id_flg]:input[value="false"]').attr("checked",true);
				} else if(data.limit_id_flg == true){
					$('input:radio[name=limit_id_flg]:input[value="true"]').attr("checked",true);
				}
				
				if (data.limit_product_qty_flg == true) {
					$('#limit_product_qty_flg').text('구매수량 제한');
				} else if (data.limit_product_qty_flg == false) {
					$('#limit_product_qty_flg').text('제한 없음');
				}
				
				if (data.limit_product_qty_flg == true) {
					$('#limit_id_flg').text('ID당 구매 제한');
				} else if (data.limit_product_qty_flg == false) {
					$('#limit_id_flg').text('ID당 구매 제한 없음');
				}
				
				$('#limit_product_qty').text(data.limit_product_qty);
				
				$('#price_cost').text(data.price_cost_format);
				$('#price_kr_gb').text(data.price_kr_gb_format);
				$('#price_kr').text(data.price_kr_format);
				$('#price_en').text(data.price_en_format);
				$('#price_cn').text(data.price_cn_format);
				$('#limit_member').text(data.limit_member);
				$('#product_qty').text(data.product_qty);
				$('#safe_qty').text(data.safe_qty);
				$('#receive_request_date').text(data.receive_request_date);
				$('#launching_date').text(data.launching_date);
				
				//ORDERSHEET - DSN
				$('#material').text(data.material);
				$('#fit').text(data.fit);
				$('#color_rgb').text(data.color_rgb);
				$('#pantone_code').text(data.pantone_code);

				let wkla_idx = data.wkla_idx;
				getWklaInfo(wkla_idx);
				$('#model').text(data.model);
				$('#model_wear').text(data.model_wear);
				
				let option_info = data.option_info;
				getSizeGuideList(option_info);
				
				$('#tp_completion_date').text(data.tp_completion_date);
				$('#detail_dsn_kr').html(data.detail_kr);
				$('#detail_dsn_en').html(data.detail_en);
				$('#detail_dsn_cn').html(data.detail_cn);
				$('#care_dsn_kr').html(data.care_dsn_kr);
				$('#care_dsn_en').html(data.care_dsn_en);
				$('#care_dsn_cn').html(data.care_dsn_cn);
				
				//ORDERSHEET - TD
				$('#care_td_kr').html(data.care_td_kr);
				$('#care_td_en').html(data.care_td_en);
				$('#care_td_cn').html(data.care_td_cn);
				$('#material_text_kr').html(data.material_kr);
				$('#material_text_en').html(data.material_en);
				$('#material_text_cn').html(data.material_cn);
				$('#manufacturer').text(data.manufacturer);
				$('#supplier').text(data.supplier);
				$('#origin_country').text(data.origin_country);
				$('#brand').text(data.brand);

				if(data.load_box_idx != null && data.load_box_idx > 0){
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
				console.log(sub_info);
				
				var sub_info = data.sub_material_info;
				sub_info.forEach(function(sub_data){
					if(sub_data.sub_material_type == 'T'){
						$('#package_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');

					} else if(sub_data.sub_material_type == 'D'){
						$('#delivery_sub_material').append('<tr><td>' + sub_data.sub_material_name + '</td></tr>');
					}
				});
				
				$('#load_box_idx option:contains("' + data.load_box_idx + '")').attr("selected","selected").change();
				$('#deliver_box_idx option:contains("' + data.deliver_box_idx + '")').attr("selected","selected").change();
				$('#load_weight').val(data.load_weight);
				$('#load_qty').val(data.load_qty);
				$('#sub_material_code').val(data.sub_material_code);
			}
		}
	});
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

function openRelevantProductModal() {
	let cnt = $('.relevant_idx').length;
	
	let relevant_idx = [];
	for (let i=0; i<cnt; i++) {
		relevant_idx.push($('.relevant_idx').eq(i).val());
	}
	
	modal('relevant_search','relevant_idx=' + relevant_idx);
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
						let file_list = val.file_list;
						
						let cnt = 0;
						if (file_list != null) {
							cnt = val.file_list.length;
						}
						
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

function previewImg(obj) {
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
				if (val.file_list.length > 0) {
					let strDiv = "";
					
					strDiv += '<div class="content__title" style="margin-bottom:5px;"><h3>' + typeStr + '</h3></div>';
					
					val.file_list.forEach(function(img_val, idx, arr){
						strDiv += '<div>';
						strDiv += '    <a href="' + img_val + '">';
						strDiv += '        <img src="' + img_val + '">';
						strDiv += '    </a>';
						strDiv += '</div>';
					});
					
					strDiv += '</div>';
					
					typeDiv.append(strDiv);
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
function relevantProductDelete(obj){
	$(obj).parent().remove();
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

		let total_limit_option_qty = 0;
		let limit_option_length = 0;
		limit_option_length = $('input[name="limit_option_qty[]"]').length;
		for(let i = 0; i < limit_option_length; i++){
			total_limit_option_qty += parseInt($('input[name="limit_option_qty[]"]').eq(i).val());
		}
		if(parseInt($('#limit_product_qty').val()) > total_limit_option_qty){
			alert('상품별 옵션제한 수량은 옵션별 제한수량의 총합보다 작거나 같아야합니다.');
			return false;
		}
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
                        location.href = 'http://116.124.128.246:81/product/list';
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
	
	var str_loading_img = "";
	str_loading_img += '<div id="loading_img">';
	str_loading_img += '    <img src="' + gif + '" style="width:75px; height:75px;"/>';
	str_loading_img += '</div>';

	$('body').append(mask);
	$('body').append(str_loading_img);

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

function moveInfoScroll(str){
	$('.content__card.product__detail .card__body').animate({scrollTop : 0}, 0);
	let clickOffset = $('#' + str + '_info_marker').position();
	console.log(clickOffset);
	$('.content__card.product__detail .card__body').animate({scrollTop : clickOffset.top - 150}, 0);
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
	option_info.forEach(function(row) {
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

function clickOptionSaleFlg(obj) {
	let product_option_idx = $(obj).attr('product_option_idx');
	let selected_tr = $('#product_option_' + product_option_idx);
	
	let radio_value = $(obj).val();
	selected_tr.find('.option_sale_flg').val(radio_value);
}
</script>
