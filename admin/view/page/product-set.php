<style>
.gray_btn{
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	width:80px;
	height:30px;
	font-size:0.5rem;
	cursor:pointer;
}
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
		<h3>세트 상품 등록</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-regist" action="product/set/add" enctype="multipart/form-data">
			<div class="table table__wrap">
				<button type="button" toggle_table="ordersheet"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
					onClick="toggleTableClick(this);">세트상품 등록 - 오더시트 항목</button>
				<div class="overflow-x-auto" id="insert_table_ordersheet">
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
<?php 
				$get_line_info_sql = "
					SELECT 
						IDX,
						LINE_NAME
					FROM
						dev.LINE_INFO
				";
				$db->query($get_line_info_sql);
				foreach($db->fetch() as $line_info){
?>
											<option value="<?=$line_info['IDX']?>"><?=$line_info['LINE_NAME']?></option>
<?php 
				}
?>
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
								<TD>
									<div class="content__row" >
										<select id="wkla_idx" name="wkla_idx" class="fSelect eSearch" style="width:163px;">
											<option value="0">WKLA을 선택해주세요</option>
<?php 
					$get_wkla_info_sql = "
						SELECT 
							IDX,
							WKLA_NAME
						FROM
							dev.WKLA_INFO
					";
					$db->query($get_wkla_info_sql);
					foreach($db->fetch() as $wkla_info){
?>
											<option value="<?=$wkla_info['IDX']?>"><?=$wkla_info['WKLA_NAME']?></option>
<?php 
					}
?>
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
										<select id="load_box_idx" name="load_box_idx"class="fSelect eSearch" style="width:163px;">
											<option value="0">박스를 선택해주세요</option>
<?php 
				$get_box_info_sql = "
					SELECT 
						IDX,
						BOX_NAME
					FROM
						dev.BOX_INFO
				";
				$db->query($get_box_info_sql);
				foreach($db->fetch() as $box_info){
?>
											<option value="<?=$box_info['IDX']?>"><?=$box_info['BOX_NAME']?></option>
<?php 
				}
?>								
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
									<input type="hidden" id="param_json"></button>
									<button type="button" style="width:10%;background-color: #ffffff;" onclick="openSubMaterialModal()">검색창 열기</button>
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
			<div class="table table__wrap">
				<button type="button" toggle_table="td"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
				>세트상품 등록 - 독립몰 상품 항목</button>
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
						<TABLE>
							<TR>
								<TD>스타일코드</TD>
								<TD colspan="3">
									<input type="text" class="product_code_unit" id="style_code" name="style_code" value=""> 
								</TD>
								<TD>컬러코드</TD>
								<TD colspan="3">
									<input type="text" class="product_code_unit" id="color_code" name="color_code" value="">
								</TD>
								<TD>상품코드</TD>
								<TD colspan="3">
									<div>
										<input id="duplicate_check" type="hidden" value="false">
										<input id="product_code" type="text" readonly name="product_code" style="width:55%;" value="">
										<button id="duplicate_btn" class="btn__gray" type="button"onClick="productDuplicateCheck();">상품코드 중복체크</button>
									</div>
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
										<input type="hidden" id="md_category_1" name="md_category_1" value="">
										<input type="hidden" id="md_category_2" name="md_category_2" value="">
										<input type="hidden" id="md_category_3" name="md_category_3" value="">
										<input type="hidden" id="md_category_4" name="md_category_4" value="">
										<input type="hidden" id="md_category_5" name="md_category_5" value="">
										<input type="hidden" id="md_category_6" name="md_category_6" value="">
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
								<TD>판매 유무</TD>
								<TD colspan="3">
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
								<TD>마일리지 사용유무</TD>
								<TD colspan="3">
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
								<TD colspan="3">
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
								<TD colspan="3"><input id="price_kr" class="price" type="number" step="0.01" name="price_kr" value="0"></TD>
								<TD>한국몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_kr" class="sales_price" type="number" step="0.01" name="sales_price_kr" value="0"></TD>
								<TD>한국몰 할인율</TD>
								<TD colspan="3"><input id="discount_kr" class="result" type="number" step="0.01" name="discount_kr" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount">
								<TD>영문몰 가격</TD>
								<TD colspan="3"><input id="price_en" class="price" type="number" step="0.01" name="price_en" value="0"></TD>
								<TD>영문몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_en" class="sales_price" type="number" step="0.01" name="sales_price_en" value="0"></TD>
								<TD>영문몰 할인율</TD>
								<TD colspan="3"><input id="discount_en" class="result" type="number" step="0.01" name="discount_en" value="0" readonly></TD>

							</TR>
							<TR class="cal_discount"> 
								<TD>중국몰 가격</TD>
								<TD colspan="3"><input id="price_cn" class="price" type="number" step="0.01" name="price_cn" value="0"></TD>
								<TD>중국몰 세일가격</TD>
								<TD colspan="3"><input id="sales_price_cn" class="sales_price" type="number" step="0.01" name="sales_price_cn" value="0"></TD>
								<TD>중국몰 할인율</TD>
								<TD colspan="3"><input id="discount_cn" class="result" type="number" step="0.01" name="discount_cn" value="0" readonly></TD>

							</TR>
							<tr>
								<TD >구매 멤버 제한</TD>
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
								<TD>ID당 구매제한</TD>
								<TD colspan="3">
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
								<TD>리오더 차수</TD>
								<TD colspan="3"><input id="reorder_cnt" type="number" step="1" name="reorder_cnt" value="0"></TD>
								<TD></TD>
								<TD colspan="3"></TD>
							</TR>
							<TR>
								<TD>구매수량 제한</TD>
								<TD colspan="3">
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
								<TD>상품별 구매제한 수량</TD>
								<TD colspan="3"><input id="limit_product_qty" type="number" step="1" name="limit_product_qty" value="0"></TD>
								<TD></TD>
								<TD colspan="3"></TD>
							</TR>
							<TR>
								<TD>상품 검색어</TD>
								<TD colspan="11"><input type="text" name="product_keyword" value="" style="width:90%"></TD>
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
									</div>
								</TD>
							</TR>
							<TR>
								<TD>구매 전<br>환불정보 표시 메세지</TD>
								<TD colspan="11">
									<input type="text" id="refund_msg" name="refund_msg">
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
									<input type="text" name="seo_title" value="">
								</TD>
							</TR>
							<TR>
								<TD>메타태그<br>Author</TD>
								<TD colspan="11">
									<input type="text" name="seo_author" value="">
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
									<input type="text" name="seo_keywords" value="">
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
												<div class="imgCnt product" style="width:15%"></div>
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
			<div class="table table__wrap">
				<button type="button" toggle_table="td"
					style="background-color: #fafafa; width:100%;border:1px solid #000000;height:30px;cursor:pointer;"
				>세트상품 등록 - 개별상품 선택</button>
				<div class="overflow-x-auto">
					<input type="button" style="background-color:#000000;color:#ffffff;width:150px;height:30px;font-size:0.5rem;margin-top:10px;margin-bottom:10px;cursor:pointer;" value="단일상품 검색" onClick="modal('search');">
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
			<div class="card__footer">
				<div class="footer__btn__wrap">
					<div class="tmp" toggle="tmp"></div>
					<div class="btn__wrap--lg" style="display: block;margin: 0 auto;">
						<div  class="blue__color__btn" onclick="setRegistAction();"><span>세트 상품 등록</span></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
var img_chk_flg = false;
var img_dir_error_flg = false;

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
	setSmartEditor();
	getProductCategory(0,0);
	getFilterInfo()
	$('.product_code_unit').keyup(function(){
		setProductCode();
	});
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
	//lineInfoGet();
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
				url: config.api + "pcs/ordersheet/md/line/get",
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
	//wklaInfoGet();
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
				url: config.api + "pcs/ordersheet/dsn/wkla/get",
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

	//boxInfoGet();
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
				url: config.api + "pcs/ordersheet/td/box/get",
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

function setProductCode(){
	var style_code = $('#style_code').val();
	var color_code = $('#color_code').val();

	$('#product_code').val(style_code + color_code);
	$('#img_url').val('/ader_prod_img/' + style_code + color_code);
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
			url: config.api + "pcs/ordersheet/md/check",
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
/*
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
*/
/*
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
*/
/*
function boxInfoGet(){
	$.ajax({
        type: "post",
                data: {
                    'box_type' : 'all'
                },
                dataType: "json",
        url: config.api + "pcs/ordersheet/td/box/list/get",
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
*/
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
function openSubMaterialModal() {
    var sub_json = {};
    var temp_arr = [];
    var idx = 0;
    
    $('.td, .delivery').children().each(function () {
        sub_json = {};

        sub_json.sub_idx = $(this).find('.sub__idx').val();
        sub_json.sub_checked = $(this).find('.sub__idx').prop('checked');
        sub_json.sub_name = $(this).find('span').text();
        sub_json.sub_memo = $(this).find('.sub__memo').val();

        if($(this).parent().hasClass('td') == true){
            sub_json.sub_type = 'T';
        }
        else if($(this).parent().hasClass('delivery') == true){
            sub_json.sub_type = 'D';
        }
        temp_arr.push(sub_json);
    })

    var param_json = {};

    param_json[0] = $('input[name=ordersheet_idx]').val();
    param_json[1] = temp_arr;

    var json_str = JSON.stringify(param_json);
    modal('/sub_material', `json_str=${json_str}`);
}

function productCategoryChange(obj) {
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
	$('#md_category_' + depth).val($('.eCategory'+depth+' option:selected').val());
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
	
	var wkla = $('#wkla_info_table').find('td').eq(0).text();
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

function previewImg(obj){
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

function setProductDelete(obj){
	$(obj).parent().remove();
}

function setRegistAction(){
	confirm('세트상품을 등록하시겠습니까?', function(){
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

		if($('#product_code').val() != null && $('#product_code').val().length <= 0){
			alert('상품코드를 입력해주세요');
			return false;
		}

		if($('#duplicate_check').val() == "false"){
			alert('상품코드 중복체크를 하지 않았습니다.');
			return false;
		}

		if($('#shop_product_name').val().length == 0){
			alert('세트상품명을 입력해주세요');
			return false;
		}

		var set_product_cnt = $('#set_product_table').children().length
		if(set_product_cnt < 2){
			alert('2개 이상의 세트상품을 선택해주세요');
			return false;
		}

		var product_row = $("#set_product_table").find('tr');
		for(var i = 0; i < product_row.length; i++){
			var checked_option_cnt = product_row.eq(i).find('input:checkbox:checked').length;
			if(checked_option_cnt == 0){
				alert('세트 구성상품은 반드시 하나 이상의 옵션을 선택해야 합니다.');
				return false;
			}
		}

		if(!img_chk_flg){
			alert('FTP 이미지 체크를 먼저 진행해주세요');
			return false;
		}
		if(!img_dir_error_flg){
			alert('입력하신 FTP 경로에 파일이 없습니다.');
			return false;
		}
		
		var formData = new FormData();
		formData = $("#frm-regist").serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "product/set/add",
			error: function() {
				alert('세트상품 등록처리에 실패했습니다.');
			},
			success: function(d) {
				if(d.code == 200) {
					alert('세트상품 등록처리에 성공했습니다.', function pageLocation() {
						insertLog("상품관리 > 세트상품 등록", '세트상품 등록', select_idx.length);
						location.href = '/product/list';
					});
				}
				else{
					alert(d.msg);
				}
			}
		});
	});
}
</script>
