<style>
.toggle_table_btn {background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;}
.content__card.product__detail, .content__card.product__detail .card__body{height:100%}
.content__card.product__detail{display:flex;flex-direction:column;}
.content__card.product__detail .card__body{flex: 1;overflow-y:scroll}
.move__btn__container{margin-top:10px;display:grid;grid-template-columns: repeat(12, 1fr);}
.btn__item.btn{text-align:center;height:50px;line-height : 34px;}
.btn__item.btn:hover{background-color:#dcdcdc}
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
#loading_img {{position:absolute;top:${top}px;left:${left}px;width:75px;height:75px;z-index:9999;background:#f0f0f0;filter:alpha(opacity=50);opacity:alpha*0.5;margin:auto;padding:0;}}
.mileage__per{width:50px!important;}
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

<form id="frm-sub-material-filter" action="product/set/sub_material/get">
	<input type="hidden" class="sort_type" name="sort_type" value="DESC">
	<input type="hidden" class="sort_value" name="sort_value" value="SUB_MATERIAL_CODE">
	
	<input type="hidden" class="rows" name="rows" value="5">
	<input type="hidden" class="page" name="page" value="1">

	<input type="hidden" id="sub_material_type" name="sub_material_type" value="ALL">
	<input type="hidden" id="sub_material_name" name="sub_material_name" value="">
	<input type="hidden" id="sub_material_code" name="sub_material_code" value="">
</form>

<div class="content__card product__detail" style="margin: 0;">
	<div class="card__header">
		<h3>
			상품정보 수정 페이지
		</h3>
		<div class="move__btn__container">
			<div class="btn__item btn common" onclick="moveInfoScroll('common')">기본정보</div>
			<div class="btn__item btn sale" onclick="moveInfoScroll('sale')">판매정보</div>
			<div class="btn__item btn limit" onclick="moveInfoScroll('limit')">구매정보</div>
			<div class="btn__item btn relevant" onclick="moveInfoScroll('relevant')">관련상품</div>
			<div class="btn__item btn care" onclick="moveInfoScroll('care')">유의사항</div>
			<div class="btn__item btn detail" onclick="moveInfoScroll('detail')">상세정보</div>
			<div class="btn__item btn material" onclick="moveInfoScroll('material')">소재</div>
			<div class="btn__item btn refund" onclick="moveInfoScroll('refund')">환불정보</div>
			<div class="btn__item btn search" onclick="moveInfoScroll('search')">검색정보</div>
			<div class="btn__item btn image" onclick="moveInfoScroll('image')">이미지</div>
			<div class="btn__item btn filter" onclick="moveInfoScroll('filter')">필터</div>
			<div class="btn__item btn set" onclick="moveInfoScroll('set')">구성품</div>
		</div>
	</div>
	
	<div class="card__body">
		<form id="frm-update" action="">	
			<input id="product_idx" type="hidden" name="product_idx" value="<?=$product_idx?>">
			<input id="ordersheet_idx" type="hidden" name="ordersheet_idx" value="">
			<input id="product_type" type="hidden" name="product_type" value="S">
			
			<div class="table table__wrap set_product">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('ORD');">세트상품 등록 - 오더시트 항목</button>
				<div id="insert_table_ORD" class="overflow-x-auto">
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
								
								<TH>교환 환불 가능유무</TH>
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
								<TH>라인 유형</TH>
								<TD colspan="7">
									<div class="content__row" >
										<select id="line_idx" name="line_idx" class="fSelect eSearch" style="width:250px;" onChange="getLineInfo();">
											<option value="0">라인을 선택해주세요</option>
											<?php
												$select_line_sql = "
													SELECT
														IDX				AS LINE_IDX,
														LINE_NAME		AS LINE_NAME
													FROM
														dev.LINE_INFO
												";
												
												$db->query($select_line_sql);
												
												foreach ($db->fetch() as $line_data) {
											?>
											<option value="<?=$line_data['LINE_IDX']?>"><?=$line_data['LINE_NAME']?></option>
											<?php
												}
											?>
										</select>
									</div>
									
									<div id="div_line" style="margin-top:5px">
									</div>
								</TD>
							</tr>
							
							<TR>
								<TH>소재</TH>
								<TD>
									<input id="material" type="text" name="material" value="">
								</TD>
								
								<TH>상품 그래픽</TH>
								<TD>
									<input id="graphic" type="text" name="graphic" value="">
								</TD>
							
								<TH>상품 핏</TH>
								<TD>
									<input id="fit" type="text" name="fit" value="">
								</TD>
								
								<TH>상품 이름</TH>
								<TD colspan="3">
									<input type="text" id="product_name" name="product_name" value="">
								</TD>
							</TR>
							
							<TR>
								<TH>상품 사이즈</TH>
								<TD>
									<input type="text" id="product_size" name="product_size" value="">
								</TD>
								
								<TH>상품 색상</TH>
								<TD>
									<input id="color" type="text" name="color" value="">
								</TD>
								
								<TH>RGB 코드</TH>
								<TD>
									<input id="color_rgb" type="text" name="color_rgb" value="">
								</TD>
								
								<TH>팬톤 코드</TH>
								<TD>
									<input id="pantone_code" type="text" name="pantone_code" value="">
								</TD>
							</TR>
							<tr>
								<TH>W/K/L/A</TH>
								<TD colspan="7">
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
							</tr>
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
							<tr>
								<TH>상품 적재박스 유형</TH>
								<TD colspan="7">
									<div class="content__row" >
										<select id="load_box_idx" name="load_box_idx" class="fSelect eSearch" style="width:163px;" onChange="getBoxInfo();">
											<option value="0">박스를 선택해주세요</option>
											<?php
												$select_box_info_sql = "
													SELECT
														IDX				AS BOX_IDX,
														BOX_NAME		AS BOX_NAME
													FROM
														dev.BOX_INFO
												";
												
												$db->query($select_box_info_sql);
												
												foreach($db->fetch() as $box_data) {
											?>
											<option value="<?=$box_data['BOX_IDX']?>"><?=$box_data['BOX_NAME']?></option>
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
								<TH>상품 적재중량 (kg)</TH>
								<TD colspan="3">
									<input id="load_weight" class="product_volume" type="number" step="0.01" name="load_weight" value="0">
								</TD>
								
								<TH>상품 적재수량</TH>
								<TD colspan="3">
									<input id="load_qty" class="product_volume" type="number"
										name="load_qty" value="0">
								</TD>
							</tr>
							
							<tr>
								<TH>부자재 검색</TH>
								<td colspan="7">
									<input type="hidden" id="param_json">
									<div class="btn" onclick="openSubMaterialModal()">검색창 열기</div>
								</td>
							</tr>
							
							<tr>
								<TH>포장부자재</TH>
								<td colspan="7">
									<div class="form-group td"></div>
								</TD>
							</tr>
							
							<tr>
								<TH>배송부자재</TH>
								<td colspan="7">
									<div class="form-group delivery"></div>
								</TD>
							</tr>
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="table table__wrap set_product" id="set_info_marker">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('SET');">세트상품 등록 - 개별상품 선택</button>
				<div id="insert_table_SET" class="overflow-x-auto">
					<div id="set_product_list_area">
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
									<TH>세트상품 재고수량</TH>
								</tr>
							</thead>
							<tbody id="set_product_table">
							</tbody>
						</TABLE>
					</div>
				</div>
			</div>
			
			<div class="table table__wrap">
				<button class="toggle_table_btn" type="button" onClick="toggleTableClick('PR');">독립몰 상품정보</button>
				<div id="insert_table_PR" class="overflow-x-auto">
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
								<td colspan="12" id="filter_info_marker">
									<h3 class="detail_category_title">필터</h3>
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
		
		<div class="set_product" style="margin-top:30px;">
			<div class="overflow-x-auto">
				<form id="frm-product_add" action="product/modal/list/get">
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
								<div class="set_search_type">
									<select class="fSelect eSearch search_type_select" name="search_type[]" style="width:163px;" onChange="changeSearchType(this);">
										<option value="" selected>검색분류 선택</option>
										<option value="name">상품명</option>
										<option value="code">상품코드</option>
									</select>
									
									<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
									
									<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">-</button>
									<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">+</button>
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
										<label class="rd__square">
											<input type="radio" name="sold_out_status" value="all" checked>
											<div><div></div></div>
											<span>전체</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="sold_out_status" value="false">
											<div><div></div></div>
											<span>품절</span>
										</label>
										<label class="rd__square">
											<input type="radio" name="sold_out_status" value="true">
											<div><div></div></div>
											<span>품절 아님</span>
										</label>
										<!--
										<input id="sold_out_status_all" type="radio" name="sold_out_status" value="all" checked>
										<label for="sold_out_status_all">전체</label>
										<input id="sold_out_status_false" type="radio" name="sold_out_status" value="false">
										<label for="sold_out_status_false">품절</label>
										<input id="sold_out_status_true" type="radio" name="sold_out_status" value="true">
										<label for="sold_out_status_true">품절 아님</label>
-->
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
									<div  class="blue__color__btn" onClick="getBasicProductList();"><span>검색</span></div>
									<div class="defult__color__btn" onClick="init_fileter('frm-product_add','getBasicProductList()');"><span>초기화</span></div>
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
											<TH style="width:3%;">추가</TH>
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
				</form>
			</div>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg">
				<div class="blue__color__btn" onclick="productUpdateCheck();"><span>세트상품 수정</span></div>
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
	setSmartEditor();
	getProductCategory(0,0);
	$('#insert_table_ORD').toggle();

	$('#insert_table_set_search').toggle();
	
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
	});
	
	$('#custom_clearance').on('change', function(){
		let hs_code = $('#custom_clearance').val()
		var msg = "통관번호 : " + hs_code;
		$('#select_clearance_msg').text(msg);
	});
	
	$('.card__body').scroll(function(){
		let markerTopArr = new Array(12);

		markerTopArr.push([$('#set_info_marker').offset().top, 'set']);
		markerTopArr.push([$('#common_info_marker').offset().top, 'common']);
		markerTopArr.push([$('#sale_info_marker').offset().top, 'sale']);
		markerTopArr.push([$('#limit_info_marker').offset().top, 'limit']);
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
		});
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
			alert("세트상품 조회처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200){
				var data = d.data[0];
				
				let ordersheet_idx = data.ordersheet_idx;
				$('#ordersheet_idx').val(ordersheet_idx);
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
				
				if(data.sale_flg == false){
					$('input:radio[name=sale_update_flg]:input[value="false"]').attr("checked",true);
				} else if(data.sale_flg == true){
					$('input:radio[name=sale_update_flg]:input[value="true"]').attr("checked",true);
				}
				
				if(data.sold_out_flg == false){
					$('input:radio[name=sold_out_flg]:input[value="false"]').attr("checked",true);
				} else if(data.sale_flg == true){
					$('input:radio[name=sold_out_flg]:input[value="true"]').attr("checked",true);
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
				
				if (data.limit_member != null && data.limit_member.length > 0) {
					var limit_member_arr = [];
					limit_member_arr = data.limit_member.split(',');
					limit_member_arr.forEach(function(mem_num){
						$('input:checkbox[name="limit_member[]"]:input[value="' + mem_num + '"]').attr("checked",true);
					})
				}
				
				if(data.limit_id_flg == false){
					$('input:radio[name=limit_id_flg]:input[value="false"]').attr("checked",true);
				} else if(data.limit_id_flg == true){
					$('input:radio[name=limit_id_flg]:input[value="true"]').attr("checked",true);
				}

				$('#limit_shop_product_qty').val(data.limit_product_qty);
				$('#reorder_cnt').val(data.reorder_cnt);
				
				if(data.limit_purchase_qty_flg == false){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="false"]').attr("checked",true);
				} else if(data.limit_purchase_qty_flg == true){
					$('input:radio[name=limit_purchase_qty_flg]:input[value="true"]').attr("checked",true);
				}

				$('#limit_product_qty').val(data.limit_product_qty);
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
				
				let relevant_product = data.relevant_product;
				if(relevant_product != [] && relevant_product != null){
                    relevant_product.forEach(function(row){
                        let strDiv = "";

                        strDiv += '<TR>';
                        strDiv += '		<td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
						strDiv += '    <input class="relevant_idx" type="hidden" name="relevant_idx[]" value="' + row.product_idx + '">';
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
                                strDiv += '        ' + row.price_cn;
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
				
				if(data.refund_msg_flg == false){
					$('input:radio[name=refund_msg_flg]:input[value="false"]').attr("checked",true);
				} else if(data.refund_msg_flg == true){
					$('input:radio[name=refund_msg_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#refund_msg_kr').val(data.refund_msg_kr);
				$('#refund_msg_en').val(data.refund_msg_en);
				$('#refund_msg_cn').val(data.refund_msg_cn);
				$('#refund_kr').html(data.refund_kr);
				$('#refund_en').html(data.refund_en);
				$('#refund_cn').html(data.refund_cn);
				
				$('#memo').html(data.memo);
				
				if(data.seo_exposure_flg == false){
					$('input:radio[name=seo_exposure_flg]:input[value="false"]').attr("checked",true);
				} else if(data.seo_exposure_flg == true){
					$('input:radio[name=seo_exposure_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#seo_alt_text').html(data.seo_alt_text);
				$('#seo_description').html(data.seo_description);
				$('#seo_title').val(data.seo_title);
				$('#seo_author').val(data.seo_author);
				$('#seo_keywords').val(data.seo_keywords);
				
				$('#img_url').val('/ader_prod_img/' + data.product_code);
				
				let set_product_info = data.set_product_info;
				if(set_product_info != null){
					set_product_info.forEach(function(row){
						let strDiv = "";

						strDiv += '<TR>';
						strDiv += '    <td onclick="setProductDelete(this)">';
						strDiv += '        <a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
						strDiv += '        <input type="hidden" name="product_idx_list[]" value="' + row.product_idx + '">';
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
								strDiv += '        ' + row.price_cn;
							}
						}
						strDiv += '    </td>';
						
						strDiv += '    <TD>';
						
						let option_idx = row.option_idx;
						
						strDiv += '	       <input class="option_list" type="hidden" name="option_list[]" value="' + option_idx + '">';
						strDiv += '        <TABLE class="set_option_table">';
						strDiv += '            <THEAD>';
						strDiv += '                <TR>';
						strDiv += '                    <TH>옵션이름</TH>';
						strDiv += '                    <TH>바코드</TH>';
						strDiv += '                    <TH>상품재고</TH>';
						strDiv += '                    <TH>안전재고</TH>';
						strDiv += '                    <TH>주문재고</TH>';
						strDiv += '                    <TH>총 재고량</TH>';
						strDiv += '                    <TH>적용옵션</TH>';
						strDiv += '                </TR>';
						strDiv += '            </THEAD>';
						
						strDiv += '            <TBODY>';
						
						let tmp_option_idx = option_idx.split(',');
						
						let product_stock = row.set_product_stock;
						product_stock.forEach(function(stock_row) {
							let str_checked = "";
							for (let i=0; i<tmp_option_idx.length; i++) {
								if (tmp_option_idx[i] == stock_row.option_idx) {
									str_checked = "checked";
								}
							}
							
							strDiv += '            <TR>';
							strDiv += '                <TD>' + stock_row.option_name + '</TD>';
							strDiv += '                <TD>' + stock_row.barcode + '</TD>';
							strDiv += '                <TD>' + stock_row.stock_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.order_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.safe_qty + '</TD>';
							strDiv += '                <TD>' + stock_row.product_qty + '</TD>';
							strDiv += '                <td>';
							strDiv += '                    <input class="set_option" type="checkbox" value="' + stock_row.option_idx + '" ' + str_checked + '>';
							strDiv += '                </td>';
							strDiv += '            </TR>';
						});
						
						strDiv += '    </TD>';
						strDiv += '</TR>';
						$('#set_product_list_area').css('visibility','visible');
						$('#set_product_table').append(strDiv);
					});
					
					$('.set_option').on('click', function(){
						var selected_body = $(this).parent().parent().parent();
						let checkbox = selected_body.find('.set_option');
						
						let cnt = checkbox.length;
						
						var option_idx = [];
						for (let i=0; i<cnt; i++) {
							if (checkbox.eq(i).prop('checked') == true) {
								option_idx.push(checkbox.eq(i).val());
							}
						}
						
						selected_body.parent().parent().find('.option_list').val(option_idx);
					});
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
				let data = d.data;
				
				$('#style_code').text(data.style_code);
				$('#color_code').text(data.color_code);
				$('#product_code').text(data.product_code);
				
				if (data.preorder_flg == false) {
					$('input:radio[name=preorder_flg]:input[value="false"]').attr("checked",true);
				} else if (data.preorder_flg == true) {
					$('input:radio[name=preorder_flg]:input[value="true"]').attr("checked",true);
				}

				if (data.refund_flg == false){
					$('input:radio[name=refund_flg]:input[value="false"]').attr("checked",true);
				} else if (data.refund_flg == true){
					$('input:radio[name=refund_flg]:input[value="true"]').attr("checked",true);
				}
				
				$('#line_idx').val(data.line_idx);
				getLineInfo();
				
				$('#material').val(data.material);
				$('#graphic').val(data.graphic);
				$('#fit').val(data.fit);
				$('#product_name').val(data.product_name);
				$('#product_size').val(data.product_size);
				$('#color').val(data.color);
				$('#color_rgb').val(data.color_rgb);
				$('#pantone_code').val(data.pantone_code);
				
				let wkla_idx = data.wkla_idx;
				getWklaInfo(wkla_idx);
				
				$('#limit_qty').val(data.limit_qty);
				
				var sub_info = data.sub_material_info;
				sub_info.forEach(function(sub_data){
					var table_id = '';
					var inputName = '';
					
					let div_sub_material = null;
					if(sub_data.sub_material_type == 'T'){
						div_sub_material = $('#package_sub_material');
						
						inputName = 'package_material_idx';
					} else if(sub_data.sub_material_type == 'D'){
						div_sub_material = $('#delivery_sub_material');
						
						inputName = 'delivery_sub_material_idx';
					}
					
					let strDiv = "";
					strDiv += '<div class="content__row" style="margin-bottom:5px;">';
					strDiv += '    <label>';
					strDiv += '        <input type="checkbox" class="sub__idx" name="' + inputName + '[]" value="' + sub_data.sub_material_idx + '" checked disabled>';
					strDiv += '        <span>' + sub_data.sub_material_name + '</span>';
					strDiv += '        <input type="hidden" class="sub__memo" value="' + sub_data.sub_material_memo + '">';
					strDiv += '    </label>';
					strDiv += '</div>';
					
					div_sub_material.append(strDiv);
				})
				
				let load_box_idx = data.load_box_idx;
				$('#load_box_idx').val(load_box_idx);
				getBoxInfo();
				
				$('#deliver_box_idx option:contains("' + data.deliver_box_idx + '")').attr("selected","selected").change();
				$('#load_weight').val(data.load_weight);
				$('#load_qty').val(data.load_qty);
				$('#sub_material_code').val(data.sub_material_code);
			}
		}
	});
}

function getLineInfo() {
	let line_idx = $('#line_idx').val();
	
	if (line_idx > 0) {
		$.ajax({
			type: "post",
			url: config.api + "pcs/ordersheet/md/line/get",
			data: {
				'sel_line_idx' : line_idx
			},
			dataType: "json",
			error: function() {
				alert("라인정보 조회처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					if(d.data != null){
						var line_info = d.data[0];
						
						let strDiv = "";
						strDiv += '<table style="width:40%">';
						strDiv += '	<thead>';
						strDiv += '		<tr>';
						strDiv += '			<th>라인명</th>';
						strDiv += '			<th>타입</th>';
						strDiv += '			<th>비고</th>';
						strDiv += '		</tr>';
						strDiv += '	</thead>';
						strDiv += '	<tbody>';
						strDiv += '		<tr>';
						strDiv += '			<td>' + line_info.line_name + '</td>';
						strDiv += '			<td>' + line_info.line_type + ' 라인</td>';
						strDiv += '			<td>' + line_info.line_memo + '</td>';
						strDiv += '		</tr>';
						strDiv += '	</tbody>';
						strDiv += '</table>';
						
						$('#div_line').append(strDiv);
					}
				}
			}
		});
	}
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

function getBoxInfo() {
	let box_idx = $('#load_box_idx').val();
	
	$('#div_box').html('');
	
	if (box_idx > 0) {
		$.ajax({
			type: "post",
			data: {
				'sel_box_idx' : box_idx
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet/td/box/get",
			error: function() {
				alert("박스정보 조회처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					if(d.data != null){
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

function checkSearchType(obj) {
	let action_type = $(obj).attr('action_type');
	let cnt = $('.set_search_type').length;
	if (action_type == "append") {
		if (cnt < 2) {
			let strDiv = "";
			strDiv += '<div class="set_search_type">';
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

	getBasicProductList();
}

function changeRowsProduct(obj) {
	var rows = $(obj).val();
	
	$('#frm-product_add').find('.rows').val(rows);
	$('#frm-product_add').find('.page').val(1);

	getBasicProductList();
}

function setPaging(obj) {
	var list_type = $(obj).attr('list_type');
	
	var total_cnt = $(obj).parent().find('.total_cnt.' + list_type);
	var result_cnt = $(obj).parent().find('.result_cnt.' + list_type);

	$('.cnt_total.' + list_type).text(total_cnt.val());
	$('.cnt_result.' + list_type).text(result_cnt.val());
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

function getBasicProductList() {
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
			if (d != null) {
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
				strDiv += '        <a onClick="addSetProduct(this);" class="btn blue"><i class="xi-check"></i>추가</a>';
				strDiv += '        <input type="hidden" value="' + row.product_idx + '">';
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
						strDiv += '        ' + row.price_cn;
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

function addSetProduct(obj) {
	var sel_tr = $(obj).parent().parent();
	var product_idx = sel_tr.find('input').eq(0).val();

	var cnt = $("#set_product_table").find('input[name="product_idx_list[]"][value="' + product_idx + '"]').length;
    
	if(cnt == 0){
		confirm('선택한 상품을 세트상품으로 등록하시겠습니까?',function(){
			$.ajax({
				url: config.api + "product/modal/get",
				type: "post",
				data: {
					'product_idx': product_idx
				},
				dataType: "json",
				error: function() {
					//data.instance.refresh();
					alert('세트상품 구성품 추가처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					let data = d.data;
					if (data != null) {
						data.forEach(function(row){
							let strDiv = "";

							strDiv += '<TR>';
							strDiv += '    <td onclick="setProductDelete(this)">';
							strDiv += '        <a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
							strDiv += '        <input type="hidden" name="product_idx_list[]" value="' + row.product_idx + '">';
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
									strDiv += '        ' + row.price_cn;
								}
							}
							strDiv += '    </td>';
							
							strDiv += '    <TD>';
							
							let option_idx = row.option_idx;
							
							strDiv += '	       <input class="option_list" type="hidden" name="option_list[]" value="' + option_idx + '">';
							strDiv += '        <TABLE class="set_option_table">';
							strDiv += '            <THEAD>';
							strDiv += '                <TR>';
							strDiv += '                    <TH>옵션이름</TH>';
							strDiv += '                    <TH>바코드</TH>';
							strDiv += '                    <TH>상품재고</TH>';
							strDiv += '                    <TH>안전재고</TH>';
							strDiv += '                    <TH>주문재고</TH>';
							strDiv += '                    <TH>총 재고량</TH>';
							strDiv += '                    <TH>적용옵션</TH>';
							strDiv += '                </TR>';
							strDiv += '            </THEAD>';
							
							strDiv += '            <TBODY>';
							
							let product_stock = row.product_stock;
							product_stock.forEach(function(stock_row) {
								strDiv += '            <TR>';
								strDiv += '                <TD>' + stock_row.option_name + '</TD>';
								strDiv += '                <TD>' + stock_row.barcode + '</TD>';
								strDiv += '                <TD>' + stock_row.stock_qty + '</TD>';
								strDiv += '                <TD>' + stock_row.order_qty + '</TD>';
								strDiv += '                <TD>' + stock_row.safe_qty + '</TD>';
								strDiv += '                <TD>' + stock_row.product_qty + '</TD>';
								strDiv += '                <td>';
								strDiv += '                    <input class="set_option" type="checkbox" class="set_option" value="' + stock_row.option_idx + '" checked>';
								strDiv += '                </td>';
								strDiv += '            </TR>';
							});
							
							strDiv += '    </TD>';
							strDiv += '</TR>';
							$('#set_product_list_area').css('visibility','visible');
							$('#set_product_table').append(strDiv);
						});
						
						$('.set_option').on('click', function(){
							var selected_body = $(this).parent().parent().parent();
							let checkbox = selected_body.find('.set_option');
							
							let cnt = checkbox.length;
							
							var option_idx = [];
							for (let i=0; i<cnt; i++) {
								if (checkbox.eq(i).prop('checked') == true) {
									option_idx.push(checkbox.eq(i).val());
								}
							}
							
							selected_body.parent().parent().find('.option_list').val(option_idx);
						});
					}
					
					alert('세트 구성품 리스트에 추가했습니다.');
				}
			})
		})
	}
	else{
		alert('중복된 상품을 선택할 수 없습니다.');
		return false;
	}
	
}

function relevantProductDelete(obj){
	$(obj).parent().remove();
}

function setProductDelete(obj){
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
		
		var set_product_cnt = $('#set_product_table').children().length
		if(set_product_cnt < 2){
			alert('2개 이상의 세트상품을 선택해주세요');
			return false;
		}

		var product_row = $(".set_option_table");
		for(var i = 0; i < product_row.length; i++){
			let checkbox = product_row.eq(i).find('.set_option');
			
			let cnt = checkbox.length;
			
			let checked_cnt = 0;
			for (let j=0; j<cnt; j++) {
				if (checkbox.eq(j).prop('checked') == true) {
					checked_cnt++;
				}
			}
			
			if(checked_cnt == 0){
				alert('세트 구성상품은 반드시 하나 이상의 옵션을 선택해야 합니다.');
				return false;
			}
		}

		var ftp_img_flg = $('input[name="ftp_img_flg"]:checked').val();

		if(ftp_img_flg == 'true'){
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
		
		var api_addr = '';
		var action_str = '';
		if(product_type == 'B'){
			action_str = '독립몰 상품 수정';
		}
		else if(product_type == 'S'){
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
			url: config.api + "product/put",
			error: function() {
				alert(action_str + " 처리에 실패했습니다.");
			},
			beforeSend: function(){
				LoadingWithMask('/images/default/loading_img.gif')
			},
			success: function(d) {
				if(d.code == 200) {
					closeLoadingWithMask();
					alert(action_str + '이 정상적으로 실행되었습니다.',function(){
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
    var loadingImg = '';
      
	loadingImg = `
		<div id='loading_img' >
			<img src='${gif}' style="width:75px; height:75px;"/>
		</div>
	`;
 
    $('body').append(mask);
	$('body').append(loadingImg);
 
    $('#mask_loading').css({
            'width' : maskWidth,
            'height': maskHeight,
            'opacity' : '0.5'
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
	$('.content__card.product__detail .card__body').animate({scrollTop : clickOffset.top - 150}, 0);
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
</script>