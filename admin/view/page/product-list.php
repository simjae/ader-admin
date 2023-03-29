<?php include_once("check.php"); ?>
<style>
.double__table__container{display:flex;}
table.checkbox__table{width:30px;margin-bottom:14px;}
</style>
<div class="content__card">
	<form id="frm-filter" action="product/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="PR.CREATE_DATE">
		
		<input type="hidden" class="tab_num" name="tab_num" value="01">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<input id="idx_flg" type="hidden" name="idx_flg" value="false">
		
		<input id="select_column" type="hidden" name="select_column" value="">
		
		<div class="card__header">
			<h3>상품 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
						<div>
							전체<font id="product_qty" class="info__count"></font>건
						</div>
						<div>
							판매함<font id="sales_qty" class="info__count"></font>건
						</div>
						<div>
							판매 안함<font id="non_sales_qty" class="info__count"></font>건
						</div>
						<div>
							진열함<font id="display_qty" class="info__count"></font>건
						</div>
						<div>
							진열안함<font id="non_display_qty" class="info__count"></font>건
						</div>
					</div>
					<div>
						<button type="button" style="width:120px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;">검색조회 항목 저장</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row search_type_td" style="display: block;">
					<div class="">
						<select class="fSelect eSearch search_type" name="search_type[]" style="width:163px;" onChange="searchTypeChange(this);">
							<option value="name" selected>상품명</option>
							<option value="code">상품코드</option>
							<option value="category">상품분류</option>
							<option value="material">주원료</option>
							<option value="care">주의사항</option>
							<option value="tag">상품태그</option>
							<option value="creater">등록아이디</option>
						</select>
						
						<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
						
						<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">-</button>
						<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">+</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type_all">전체</label>
						
						<input id="product_type_b" type="radio" name="product_type" value="B">
						<label for="product_type_b">기본상품</label>
						
						<input id="product_type_s" type="radio" name="product_type" value="S">
						<label for="product_type_s">세트상품</label>
						
						<input id="product_type_d" type="radio" name="product_type" value="D">
						<label for="product_type_d">세트구성상품</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 분류</div>
				<div class="content__row">
					<div class="cb__color">
						<label>
							<input type="checkbox" name="product_type_all" value="">
							<span>전체 상품분류 보기</span>
						</label>
					</div>
					<select class="fSelect category eCategory eCategory1" depth="1" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
					</select>

					<select class="fSelect category eCategory eCategory2" depth="2" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
						<option value="">상품분류 02</option>
					</select>
					
					<select class="fSelect category eCategory eCategory3" depth="3" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
						<option value="">상품분류 03</option>
					</select>
					
					<select class="fSelect category eCategory eCategory4" depth="4" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
						<option value="">상품분류 04</option>
					</select>
					
					<select class="fSelect category eCategory eCategory5" depth="5" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
						<option value="">상품분류 05</option>
					</select>
					
					<select class="fSelect category eCategory eCategory6" depth="6" name="inner_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
						<option value="">상품분류 06</option>
					</select>
					
					<div class="cb__color">
						<label>
							<input type="checkbox" name="child_search_flg" value="true">
							<span>하위분류 포함검색</span>
						</label>
						
						<label>
							<input type="checkbox" name="none_category_flg" value="true">
							<span>분류 미등록 상품 검색</span>
						</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 등록일</div>
				<div class="content__row">
					<select class="fSelect category" name="date_type" style="width:163px;">
						<option value="CREATE_DATE">상품등록일</option>
						<option value="UPDATE_DATE">상품최종수정일</option>
					</select>
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_prod_date" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_prod_date date__picker" date_type="prod_date" date="all" type="button" onclick="searchDateClick(this);">전체</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01w" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01y" type="button" onclick="searchDateClick(this);">1년</div>
						</div>
						<div class="content__date__picker">
							<input id="prod_date_from" class="date_param" type="date" name="prod_date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="prod_date" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="prod_date_to" class="date_param" type="date" name="prod_date_to" placeholder="To" readonly style="width:150px;" date_type="prod_date" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			
			<div class="card__body--hide detail_hidden" style="display: none;">
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
								
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">진열 상태</div>
						<div class="content__row">
							<div class="rd__block">
								<input id="display_status_all" type="radio" name="display_status" value="all" checked>
								<label for="display_status_all">전체</label>
								<input id="display_status_true" type="radio" name="display_status" value="true">
								<label for="display_status_true">진열 함</label>
								<input id="display_status_false" type="radio" name="display_status" value="false">
								<label for="display_status_false">진열 안함</label>
							</div>
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">판매 여부</div>
						<div class="content__row">
							<div class="rd__block">
								<input id="sale_flg_all" type="radio" name="sale_flg" value="all" checked>
								<label for="sale_flg_all">전체</label>
								
								<input id="sale_flg_true" type="radio" name="sale_flg" value="true">
								<label for="sale_flg_true">판매 함</label>
								
								<input id="sale_flg_false" type="radio" name="sale_flg" value="false">
								<label for="sale_flg_false">판매 안함</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">상품 가격</div>
					<div class="price_type_td">
						<div class="content__row country_price">
							<input type="hidden" class="price_type_list" value="">
							
							<select id="price_type" class="fSelect price_type" name="price_type[]" style="width:163px;" onChange="priceTypeChange(this);">
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
							
							<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">-</button>
							<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">+</button>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">상품 구분(해외통관)</div>
					<div class="content__row">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="unclassified" value="TRUE">
								<span>분류 미등록 상품 검색</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div class="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getProductInfoList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getProductInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="content__card">
	<form id="frm-list">
		<input type="hidden" class="action_type" name="action_type">
		<input type="hidden" class="action_name" name="action_name">
		
		<div class="card__header">
			<h3>상품 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="PR.CREATE_DATE|DESC">등록일 역순</option>
						<option value="PR.CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="PR.PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PR.PRODUCT_NAME|ASC">상품명 순</option>
						<option value="PR.SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="PR.SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="PR.SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="PR.SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="PR.SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="PR.SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
						<option value="10" selected>10개씩보기</option>
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
					<div class="filrer__wrap" style="width:280px;">
						<div style="width: 140px;" class="filter__btn" action_type="prod_delete" onclick="prodActionCheck(this);">삭제</div>
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
					</div>
					<div style="width:50%;">
						<div class="btn" style="width:100px;text-align:center;float:right;" onClick="openSelectColumnModal();">설정</div>
					</div>
				</div>
				<div class="double__table__container">
					<table class="checkbox__table">
						<colgroup>
							<col width="3%">
						</colgroup>
						<thead>
							<tr class="checkbox_tr">
								<th class="check__box__area">
									<div class="td__wrap">
										<div class="cb__color">
											<label>
												<input type="checkbox" onclick="selectAllClick(this);">
												<span></span>
											</label>
										</div>
									</div>
								</th>
							</tr>
						</thead>
						<tbody id="result_checkbox_table">
						</tbody>
					</table>
					<div class="overflow-x-auto">
						<TABLE id="result_table" style="width:auto;min-width:100%;">
						
						</TABLE>
					</div>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
	<div class="hidden">
		<div class="excel__table__warp">
			<table id="excel_table_OMD">
				<thead>
					<th>년도</th>
					<th>스타일코드</th>
					<th>컬러코드</th>
					<th>상품코드</th>
					<th>프리오더 사용여부</th>
					<th>교환 환불 가능유무</th>
					<th>라인 유형</th>
					<th>MD 카테고리(대분류)</th>
					<th>MD 카테고리(중분류)</th>
					<th>MD 카테고리(소분류)</th>
					<th>MD 카테고리(세분류)</th>
					<th>상품 이름</th>
					<th>상품 그래픽</th>
					<th>상품 사이즈</th>
					<th>상품 색상</th>
					<th>구매수량 제한 유무</th>
					<th>구매제한 수량</th>
					<th>ID당 구매제한</th>
					<th>구매 멤버 제한</th>
					<th>기획원가</th>
					<th>한국몰 판매가격 (원)</th>
					<th>영문몰 변환가격 (원)</th>
					<th>영문몰 판매가격 (달러)</th>
					<th>중문몰 판매가격 (달러)</th>
					<th>기획재고 수량</th>
					<th>안전재고 수량</th>
					<th>입고 요청일</th>
					<th>런칭일</th>
				</thead>
				<tbody id="excel_result_table_OMD">
				</tbody>
			</table>
			<table id="excel_table_ODD">
				<thead>
					<th>소재</th>
					<th>상품 핏</th>
					<th>rgb코드</th>
					<th>팬톤 코드</th>
					<th>모델</th>
					<th>모델착용 사이즈</th>
					<th>제품 상세정보(한글)</th>
					<th>제품 상세정보(영문)</th>
					<th>제품 상세정보(중문)</th>
					<th>제품 취급 유의사항
						<br>디자인 (한글)</th>
					<th>제품 취급 유의사항
						<br>디자인 (영문)</th>
					<th>제품 취급 유의사항
						<br>디자인 (중문)</th>
				</thead>
				<tbody id="excel_result_table_ODD">
				</tbody>
			</table>
			<table id="excel_table_OTD">
				<thead>
					<th>제품 취급 유의사항
						<br>생산(한글)</th>
					<th>제품 취급 유의사항
						<br>생산(영문)</th>
					<th>제품 취급 유의사항
						<br>생산(중문)</th>
					<th>소재(한글)</th>
					<th>소재(영문)</th>
					<th>소재(중문)</th>
					<th>제조사</th>
					<th>공급사</th>
					<th>원산지</th>
					<th>브랜드</th>
				</thead>
				<tbody id="excel_result_table_OTD">
				</tbody>
			</table>
			<table id="excel_table_PRD">
				<thead>
					<th>스타일코드</th>
					<th>컬러코드</th>
					<th>상품코드</th>
					<th>상품이름</th>
					<th>옵션명</th>
					<th>바코드</th>
					<th>옵션별 재고수량</th>
					<th>옵션별 안전재고수량</th>
					<th>MD 카테고리-1</th>
					<th>MD 카테고리-2</th>
					<th>MD 카테고리-3</th>
					<th>MD 카테고리-4</th>
					<th>MD 카테고리-5</th>
					<th>MD 카테고리-6</th>
					<th>해외통관-HS 코드</th>
					<th>판매 여부</th>
					<th>품절 여부</th>
					<th>마일리지 사용여부</th>
					<th>단독구매 제한유무</th>
					<th>한국몰 가격</th>
					<th>한국몰 세일가격</th>
					<th>한국몰 할인율</th>
					<th>영문몰 가격</th>
					<th>영문몰 세일가격</th>
					<th>영문몰 할인율</th>
					<th>중국몰 가격</th>
					<th>중국몰 세일가격</th>
					<th>중국몰 할인율</th>
					<th>구매 멤버 제한</th>
					<th>ID당 구매제한</th>
					<th>리오더 차수</th>
					<th>구매수량 제한</th>
					<th>상품별 구매제한수량</th>
					<th>옵션별 구매제한수량</th>
					<th>관련상품 정보</th>
					<th>상품 재고 품절 임박 수량</th>
					<th>제품 취급 유의사항(한글)</th>
					<th>제품 취급 유의사항(영문)</th>
					<th>제품 취급 유의사항(중문)</th>
					<th>제품 상세정보(한글)</th>
					<th>제품 상세정보(영문)</th>
					<th>제품 상세정보(중문)</th>
					<th>소재(한글)</th>
					<th>소재(영문)</th>
					<th>소재(중문)</th>
					<th>구매 전
						<br>환불정보 표시 플래그</th>
					<th>구매 전
						<br>환불정보 표시 메세지(한국몰)</th>
					<th>구매 전
						<br>환불정보 표시 메세지(영문몰)</th>
					<th>구매 전
						<br>환불정보 표시 메세지(중국몰)</th>
					<th>추가 교환/환불
						<br>상세정보
						<br>(한국몰)</th>
					<th>추가 교환/환불
						<br>상세정보
						<br>(영문몰)</th>
					<th>추가 교환/환불
						<br>상세정보
						<br>(중국몰)</th>
					<th>핏 필터 적용</th>
					<th>그래픽 필터 적용</th>
					<th>라인 필터 적용</th>
					<th>색상 필터 적용</th>
					<th>사이즈 필터 적용</th>
					<th>이미지 타입 순서</th>
				</thead>
				<tbody id="excel_result_table_PRD">
				</tbody>
			</table>
		</div>
	</div> 
</div>

<script>
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
	
	//search_engine_seo
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_description,
		elPlaceHolder: "seo_description",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//img_product_detail
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: img_product_detail,
		elPlaceHolder: "img_product_detail",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//img_wear_detail
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: img_wear_detail,
		elPlaceHolder: "img_wear_detail",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
}

var category = null;
$(document).ready(function() {
	getProductCategory(0,0);
	$("#price_search").on('change','.fSelect.price',function(){
		var price_search_div = $(this).parent();
		switch($(this).val()){
			case 'PRICE_SELL_KR_KRW':
				price_search_div.find('#unit_from').text(" KRW ~");
				price_search_div.find('#unit_to').text(" KRW ");
				price_search_div.find(".search_prod_price").val('');
				break;
			case 'PRICE_SELL_EN_USD':
				price_search_div.find('#unit_from').text(" USD ~");
				price_search_div.find('#unit_to').text(" USD ");
				price_search_div.find(".search_prod_price").val('');
				break;
			case 'PRICE_SELL_CN_USD':
				price_search_div.find('#unit_from').text(" USD ~");
				price_search_div.find('#unit_to').text(" USD ");
				price_search_div.find(".search_prod_price").val('');
				break;
		}
	});
	$('input[name=category_all_flg]').change(function(){
		if($('input[name=category_all_flg]').is(":checked")){
			$('.fSelect.category').find("option:eq(0)").prop("selected", true);
			$('input[name=child_search_flg]').removeAttr("checked");
		}
	});
	
	getProductInfoList();
});

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
function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('.detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('.detail_toggle').text('상세검색 열기 +');
	}
	$('.detail_hidden').toggle();
}

function productCategoryChange(obj) {
	$('input[name=category_all_flg]').removeAttr("checked");
	var depth = parseInt($(obj).attr('depth'));
	var no = $(obj).val();
	
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
	var tab_num = $('#tab_num').val();
	
	var eCategory = $('#frm-filter').find('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="">상품분류 0' + depth + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	eCategory.prop("selected", true);
}
function priceTypeBtnClick(obj) {
	var price_type = $('#frm-filter').find('.price_type');
	var length = price_type.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 3) {
			var strDiv = '<div class="content__row country_price">';
			strDiv += '    <input type="hidden" class="price_type_list" value="">';

			strDiv += '    <select id="price_type" class="fSelect price_type" name="price_type[]" style="width:163px;" onChange="priceTypeChange(this);">';
			strDiv += '        <option value="">상품가격 선택</option>    ';
			strDiv += '        <option value="SALES_PRICE_KR">한국몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_EN">영문몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_CN">중국몰 가격</option>';
			strDiv += '    </select>';

			strDiv += '    <input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> ';
			strDiv += '    <font>~</font>';
			strDiv += '    <input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>';

			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">+</button>';
			strDiv += '</div>';
			
			$(obj).unbind();
			$('#frm-filter').find('.price_type_td').append(strDiv);
		} else {
			alert('상품가격 유형은 3개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 상품가격 유형을 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function priceTypeChange(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-filter').find('.price_type').length;
	
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
			price_type_arr[i] = $('#frm-filter').find('.price_type').eq(i).val();
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

function init_cate_sel(param){
	var option_list = [];
	$.each(param, function (idx, item){
		option_list.push(item);
	});
	$('#eCategory1').empty();
	$('#eCategory1').append($("<option value=''>상품분류 01</option>"));
	$.each(option_list, function (idx, item){
		$('#eCategory1').append($("<option value='"+item.no+"'>"+item.text+"</option>"));
	});
	$('#eCategory1 option:eq(0)').prop("selected", true);
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');

	
	var date_type = $(obj).attr('date_type');

	if (date_type == "prod_date") {
		$('.search_date_prod_date').not($(obj)).css('background-color','#ffffff');
		$('#search_date_prod_date').val(date);
		$('#prod_date_from').val('');
		$('#prod_date_to').val('');
	} 
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "prod_date") {
		$('.search_date_prod_date').css('background-color','#ffffff');
		$('.search_date_prod_date').css('color','#000000');
		
		$('#search_date_prod_date').val('');

		var prod_date_from = $("#prod_date_from").val();
		var prod_date_to = $("#prod_date_to").val();

		var start_date = new Date(prod_date_from);
		var end_date = new Date(prod_date_to);
		var now_date = new Date();

		if(start_date > now_date) {
			alert('검색 시작일에 올바른 날짜를 입력해주세요.');
			$(obj).val('');
			return false;
		}
		if(start_date > end_date) {
			alert('검색 시작일/종료일에 올바른 날짜를 입력해주세요.');
			$(obj).val('');
			return false;
		}
	}
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_checkbox_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_checkbox_table").find('.select').prop('checked',false);
	}
}
function excelDownload() {
	$('#excel_result_table_OMD').html('');
	$('#excel_result_table_ODD').html('');
	$('#excel_result_table_OTD').html('');
	$('#excel_result_table_PRD').html('');
	var formData = new FormData();
	formData = $('#frm-filter').serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/list/excel/get",
		error: function() {
			alert('주문정보 엑셀 내려받기 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d != null){
				if(d.data != null){
					console.log(d.data);
					if(d.data.product != null){
						let strDiv = '';
						d.data.product.forEach(function(product_row){
							strDiv += `
								<tr>
									<td>${product_row.style_code}</td>
									<td>${product_row.color_code}</td>
									<td>${product_row.product_code}</td>
									<td>${product_row.product_name}</td>
									<td>${product_row.option_name}</td>
									<td>${product_row.barcode}</td>
									<td>${product_row.stock_qty}</td>
									<td>${product_row.safe_qty}</td>
									<td>${product_row.md_category_1}</td>
									<td>${product_row.md_category_2}</td>
									<td>${product_row.md_category_3}</td>
									<td>${product_row.md_category_4}</td>
									<td>${product_row.md_category_5}</td>
									<td>${product_row.md_category_6}</td>
									<td>${product_row.clearance_idx}</td>
									<td>${product_row.sale_flg}</td>
									<td>${product_row.sold_out_flg}</td>
									<td>${product_row.mileage_flg}</td>
									<td>${product_row.exclusive_flg}</td>
									<td>${product_row.price_kr}</td>
									<td>${product_row.sales_price_kr}</td>
									<td>${product_row.discount_kr}</td>
									<td>${product_row.price_en}</td>
									<td>${product_row.sales_price_en}</td>
									<td>${product_row.discount_en}</td>
									<td>${product_row.price_cn}</td>
									<td>${product_row.sales_price_cn}</td>
									<td>${product_row.discount_cn}</td>
									<td>${product_row.limit_member} 제한</td>
									<td>${product_row.limit_id_flg}</td>
									<td>${product_row.reorder_cnt}</td>
									<td>${product_row.limit_purchase_qty_flg}</td>
									<td>${product_row.limit_product_qty}</td>
									<td>${product_row.qty}</td>
									<td>${product_row.relevant_idx}</td>
									<td>${product_row.sold_out_qty}</td>
									<td>${product_row.detail_kr}</td>
									<td>${product_row.detail_en}</td>
									<td>${product_row.detail_cn}</td>
									<td>${product_row.care_kr}</td>
									<td>${product_row.care_en}</td>
									<td>${product_row.care_cn}</td>
									<td>${product_row.material_kr}</td>
									<td>${product_row.material_en}</td>
									<td>${product_row.material_cn}</td>
									<td>${product_row.refund_msg_flg}</td>
									<td>${product_row.refund_msg_kr}</td>
									<td>${product_row.refund_msg_en}</td>
									<td>${product_row.refund_msg_cn}</td>
									<td>${product_row.refund_kr}</td>
									<td>${product_row.refund_en}</td>
									<td>${product_row.refund_cn}</td>
									<td>${product_row.filter_ft}</td>
									<td>${product_row.filter_gp}</td>
									<td>${product_row.filter_ln}</td>
									<td>${product_row.filter_cl}</td>
									<td>${product_row.filter_sz}</td>
									<td>${product_row.img_seq}</td>
								</tr>
							`;
						});
						$('#excel_result_table_PRD').append(strDiv);
					}
					if(d.data.ordersheet != null){
						let strMdDiv = '';
						let strDsnDiv = '';
						let strTdDiv = '';
						d.data.ordersheet.forEach(function(ordersheet_row){
							strMdDiv += `
								<tr>
									<td>${ordersheet_row.md.year}</td>
									<td>${ordersheet_row.md.style_code}</td>
									<td>${ordersheet_row.md.color_code}</td>
									<td>${ordersheet_row.md.product_code}</td>
									<td>${ordersheet_row.md.preorder_flg}</td>
									<td>${ordersheet_row.md.refund_flg}</td>
									<td>${ordersheet_row.md.line_idx}</td>
									<td>${ordersheet_row.md.category_lrg}</td>
									<td>${ordersheet_row.md.category_mdl}</td>
									<td>${ordersheet_row.md.category_sml}</td>
									<td>${ordersheet_row.md.category_dtl}</td>
									<td>${ordersheet_row.md.product_name}</td>
									<td>${ordersheet_row.md.graphic}</td>
									<td>${ordersheet_row.md.product_size}</td>
									<td>${ordersheet_row.md.color}</td>
									<td>${ordersheet_row.md.limit_product_qty_flg}</td>
									<td>${ordersheet_row.md.limit_product_qty}</td>
									<td>${ordersheet_row.md.limit_id_flg}</td>
									<td>${ordersheet_row.md.limit_member}</td>
									<td>${ordersheet_row.md.price_cost}</td>
									<td>${ordersheet_row.md.price_kr}</td>
									<td>${ordersheet_row.md.price_kr_gb}</td>
									<td>${ordersheet_row.md.price_en}</td>
									<td>${ordersheet_row.md.price_cn}</td>
									<td>${ordersheet_row.md.product_qty}</td>
									<td>${ordersheet_row.md.safe_qty}</td>
									<td>${ordersheet_row.md.receive_request_date}</td>
									<td>${ordersheet_row.md.launching_date}</td>
								</tr>
							`;

							strDsnDiv += `
								<tr>
									<td>${ordersheet_row.dsn.wkla_idx}</td>
									<td>${ordersheet_row.dsn.material}</td>
									<td>${ordersheet_row.dsn.fit}</td>
									<td>${ordersheet_row.dsn.color_rgb}</td>
									<td>${ordersheet_row.dsn.pantone_code}</td>
									<td>${ordersheet_row.dsn.model}</td>
									<td>${ordersheet_row.dsn.model_wear}<dth>
									<td>${ordersheet_row.dsn.detail_kr}</td>
									<td>${ordersheet_row.dsn.detail_en}</td>
									<td>${ordersheet_row.dsn.detail_cn}</td>
									<td>${ordersheet_row.dsn.care_dsn_kr}</td>
									<td>${ordersheet_row.dsn.care_dsn_en}</td>
									<td>${ordersheet_row.dsn.care_dsn_cn}</td>
								</tr>
							`;

							strTdDiv += `
								<tr>
									<td>${ordersheet_row.td.care_td_kr}</td>
									<td>${ordersheet_row.td.care_td_en}</td>
									<td>${ordersheet_row.td.care_td_cn}</td>
									<td>${ordersheet_row.td.material_kr}</td>
									<td>${ordersheet_row.td.material_en}</td>
									<td>${ordersheet_row.td.material_cn}</td>
									<td>${ordersheet_row.td.manufacturer}</td>
									<td>${ordersheet_row.td.supplier}</td>
									<td>${ordersheet_row.td.origin_country}</td>
									<td>${ordersheet_row.td.brand}</td>
								</tr>
							`;
						});
						$('#excel_result_table_OMD').append(strMdDiv);
						$('#excel_result_table_ODD').append(strDsnDiv);
						$('#excel_result_table_OTD').append(strTdDiv);
					}
				} else {
					alert(d.msg);
				}
			}
		}
	}).then(function(){
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		file_name = "상품목록_" + file_date;
		
		var wb = XLSX.utils.book_new();
		var md_ws = XLSX.utils.table_to_sheet(document.getElementById('excel_table_OMD'));
		var dsn_ws = XLSX.utils.table_to_sheet(document.getElementById('excel_table_ODD'));
		var td_ws = XLSX.utils.table_to_sheet(document.getElementById('excel_table_OTD'));
		var product_ws = XLSX.utils.table_to_sheet(document.getElementById('excel_table_PRD'));

		console.log(document.getElementById('excel_table_OMD'));
		console.log(document.getElementById('excel_table_OTD'));

		XLSX.utils.book_append_sheet(wb,md_ws,"오더시트_MD_정보");
		XLSX.utils.book_append_sheet(wb,dsn_ws,"오더시트_DSN_정보");
		XLSX.utils.book_append_sheet(wb,td_ws,"오더시트_TD_정보");
		XLSX.utils.book_append_sheet(wb,product_ws,"독립몰_상품_정보");

		XLSX.writeFile(wb,(file_name + '.xlsx'))
		insertLog("상점관리 > 상품 목록", "엑셀다운로드 : "+file_name + ".xlsx", 1);
		alert('주문정보 엑셀 내려받기 처리에 성공했습니다.');
	});
}

function prodActionCheck(obj) {
	action_type = $(obj).attr('action_type');
	var select_idx = [];
	var length = $('#frm-list').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-list').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-list').find('.select').eq(i).val());
		}
	}
	if (select_idx.length == 0) {
		alert(action_name + ' 처리 할 상품를 선택해주세요.');
	} else {
		var cnt = 0;
		
		var action_name = "";
		var action_target = "";
		
		switch (action_type) {
			case "prod_copy" :
				action_name = "상품 복제";
				action_target = "정상";
				break;
			
			case "prod_delete" :
				action_name = "상품 삭제";
				action_target = "정상";
				break;
		}
		$('.action_type').val(action_type);
		$('.action_name').val(action_name);
		
		confirm('선택한 상품을 ' + action_name + ' 하시겠습니까?','prodAction(' + select_idx.length + ')');
	}
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getProductInfoList();
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getProductInfoList();
}
function prodAction(len){
	var api_str = '';
	var action_type = $('.action_type').val();
	var action_name = $('.action_name').val();
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();
		
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				insertLog("상품관리 > 개별 상품 등록 ", action_name, len);
				getProductInfoList();
			}
		}
	});
}

function searchTypeBtnClick(obj) {
	var search_type = $('#frm-filter').find('.search_type');
	var length = search_type.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 9) {
			var strDiv = "";
			strDiv += '<div class="row">';
			strDiv += '    <select class="fSelect eSearch search_type" name="search_type[]" style="width:163px;" onChange="searchTypeChange(this);">';
			strDiv += '        <option value="" selected>검색분류 선택</option>';
			strDiv += '        <option value="name">상품명</option>';
			strDiv += '        <option value="code">상품코드</option>';
			strDiv += '        <option value="category">상품분류</option>';
			strDiv += '        <option value="size">사이즈</option>';
			strDiv += '        <option value="material">주원료</option>';
			strDiv += '        <option value="care">주의사항</option>';
			strDiv += '        <option value="detail">상품 상세정보</option>';
			strDiv += '        <option value="tag">상품태그</option>';
			strDiv += '        <option value="creater">등록아이디</option>';
			strDiv += '    </select>';
			
			strDiv += '    <input type="text" name="search_keyword[]" value="" style="width:70%;">';
			
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">+</button>';
			strDiv += '</div>';
			
			$(obj).unbind();
			$('#frm-filter').find('.search_type_td').append(strDiv);
		} else {
			alert('검색분류는 9개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 검색분류를 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function searchTypeChange(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-filter').find('.search_type').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-filter').find('.search_type').eq(i).val();
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

function openProductUpdateWindow(obj) {
	var product_type = $(obj).attr('product_type');
	var product_idx = $(obj).attr('product_idx');

	console.log(product_type);
	console.log(product_idx);
	switch(product_type){
		case '일반':
			window.open('http://116.124.128.246:81/product/detail/basic?product_idx=' + product_idx);
			break;
		case '세트':
			window.open('http://116.124.128.246:81/product/detail/set?product_idx=' + product_idx);
			break;
	}
}

function setProductHead(column_arr) {
	let column_div = "";
	let head_div = "";
	
	if (column_arr.length > 0) {
		for (let i=0; i<column_arr.length; i++) {
			switch (column_arr[i]) {
				case "md_category" :
					column_div += '<col width="200px;">';
					head_div += '<TH>상품<br/>카테고리</TH>';
					break;
				
				case "display_status" :
					column_div += '<col width="50px;">';
					head_div += '<TH>진열상태</TH>';
					break;
				
				case "sale_flg" :
					column_div += '<col width="50px;">';
					head_div += '<TH>판매상태</TH>';
					break;
				
				case "sold_out_flg" :
					column_div += '<col width="50px;">';
					head_div += '<TH>품절상태</TH>';
					break;
				
				case "manufacturer" :
					column_div += '<col width="150px;">';
					head_div += '<TH>제조사</TH>';
					break;
				
				case "supplier" :
					column_div += '<col width="150px;">';
					head_div += '<TH>공급사</TH>';
					break;
				
				case "brand" :
					column_div += '<col width="150px;">';
					head_div += '<TH>브랜드</TH>';
					break;
				
				case "origin_country" :
					column_div += '<col width="150px;">';
					head_div += '<TH>원산지</TH>';
					break;
				
				case "price" :
					column_div += '<col width="150px;">';
					column_div += '<col width="150px;">';
					column_div += '<col width="150px;">';
					head_div += '<TH>기획가격<br/>(한국몰)</TH>';
					head_div += '<TH>기획가격<br/>(영문몰)</TH>';
					head_div += '<TH>기획가격<br/>(중문몰)</TH>';
					break;
				
				case "model" :
					column_div += '<col width="100px;">';
					head_div += '<TH>모델</TH>';
					break;
				
				case "model_wear" :
					column_div += '<col width="100px;">';
					head_div += '<TH>모델<br/>사이즈</TH>';
					break;
				
				case "product_keyword" :
					column_div += '<col width="250px;">';
					head_div += '<TH>상픔<br/>키워드</TH>';
					break;
				
				case "product_tag" :
					column_div += '<col width="250px;">';
					head_div += '<TH>상품<br/>태그</TH>';
					break;
				
				case "whish_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>위시리스트<br/>카운트</TH>';
					break;
				
				case "basket_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>쇼핑백<br/>카운트</TH>';
					break;
				
				case "order_pcp_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>결제완료<br/>수량</TH>';
					break;
				
				case "order_dpg_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>배송중<br/>수량</TH>';
					break;
				
				case "order_dcp_cnt" :
					column_div += '<col width="50px;">';
					head_div += '<TH>배송완료<br/>수량</TH>';
					break;
				
				case "memo" :
					column_div += '<col width="500px;">';
					head_div += '<TH>상품메모</TH>';
					break;
			}
		}
	}
	
	let strDiv = "";
	strDiv += '<colgroup>';
	strDiv += '    <col width="50px;">';
	strDiv += '    <col width="80px;">';
	strDiv += '    <col width="30px;">';
	strDiv += '    <col width="100px;">';
	strDiv += '    <col width="30px;">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="auto;">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="50px">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="150px;">';
	strDiv += '    <col width="150px;">';
	
	strDiv += column_div;
	
	strDiv += '    <col width="200px;">';
	strDiv += '</colgroup>';
	
	strDiv += '<THEAD>';
	strDiv += '    <TR>';
	strDiv += '        <TH class="marker_td">No.</TH>';
	strDiv += '        <TH>링크</TH>';
	strDiv += '        <TH>상품<br>구분</TH>';
	strDiv += '        <TH>스타일<br/>코드</TH>';
	strDiv += '        <TH>컬러<br/>코드</TH>';
	strDiv += '        <TH>상품 코드</TH>';
	strDiv += '        <TH>상품명</TH>';
	strDiv += '        <TH>상품<br/>재고</TH>';
	strDiv += '        <th>판매<br/>수량</th>';
	strDiv += '        <th>잔여<br/>재고</th>';
	strDiv += '        <TH>판매가<br>(한국몰)</TH>';
	strDiv += '        <TH>판매가<br>(영문몰)</TH>';
	strDiv += '        <TH>판매가<br>(중국몰)</TH>';
	
	strDiv += head_div;
	
	strDiv += '        <TH>바로구매 URL</TH>';
	strDiv += '    </TR>';
	strDiv += '</THEAD>';
	
	return strDiv;
}

function setProductBody(column_arr,d) {
	let strDiv = "";
	d.forEach(function(row) {
		if (row.product_idx != null) {
			let result_checkbox_table = $("#result_checkbox_table");
			strCheckboxDiv = "";
			strCheckboxDiv += '<tr style="width:30px;"class="checkbox_tr" >';
			strCheckboxDiv += '    <td class="check__box__area">';
			strCheckboxDiv += '        <div class="cb__color">';
			strCheckboxDiv += '            <label>';
			strCheckboxDiv += '                <input type="checkbox" class="select" name="no[]" value="' + row.product_idx + '">';
			strCheckboxDiv += '                <span></span>';
			strCheckboxDiv += '            </label>';
			strCheckboxDiv += '        </div>';
			strCheckboxDiv += '    </td>';
			strCheckboxDiv += '</tr>';
			result_checkbox_table.append(strCheckboxDiv);

			strDiv += '<tr>';
			strDiv += '    <td class="marker_td">' + (row.num + 1) + '</td>';
			strDiv += '    <td>';
			strDiv += '        <div style="display:grid;grid-template-columns: 1fr">';
			strDiv += '            <button class="btn" onclick="openProductUpdateWindow(this)" ordersheet_idx="' + row.ordersheet_idx + '" product_type="' + row.product_type + '" product_idx="' + row.product_idx + '" style="cursor:pointer">상세보기</button>';
			strDiv += '            <button class="btn" onclick="window.open(\'http://116.124.128.246/product/detail-preview?product_idx=' + row.product_idx + '\')" style="margin-top:4px;cursor:pointer;">상세페이지</button>';
			strDiv += '        </div>';
			strDiv += '    </td>';
			strDiv += '    <td>' + row.product_type + '</td>';
			strDiv += '    <td>' + row.style_code + '</td>';
			strDiv += '    <td>' + row.color_code + '</td>';
			strDiv += '    <td>' + row.product_code + '</td>';
			
			strDiv += '    <td>';
			
			let set_product_info = row.set_product_info;
			if (row.product_type == "세트" && set_product_info != null) {
				set_product_info.forEach(function(set_row) {
					var background_url = "background-image:url('" + set_row.img_location + "');";
					
					strDiv += '    <div style="padding:5px; margin-bottom:10px;">';
					strDiv += '        <p style="margin-bottom:5px;">' + set_row.product_name + '</p>';
					strDiv += '        <div class="product__img__wrap">';
					strDiv += '            <div class="product__img" style="' + background_url + '">';
					strDiv += '            </div>';
					strDiv += '            <div>';
					strDiv += '                <p>' + set_row.product_name + '</p><br>';
					strDiv += '            	   <p style="color:#EF5012">' + set_row.update_date + '</p>';
					strDiv += '            </div>';
					strDiv += '        </div>';
					strDiv += '    </div>';
				})
			} else if (row.product_type == "일반") {
				var background_url = "background-image:url('" + row.img_location + "');";
				
				strDiv += '    <div style="padding:5px; margin-bottom:10px;">';
				strDiv += '        <p style="margin-bottom:5px;">' + row.product_name + '</p>';
				strDiv += '        <div class="product__img__wrap">';
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </div>';
			}
			
			strDiv += '</td>';
			
			strDiv  += '    <td>' + row.stock_qty + '</td>';
			strDiv  += '    <td>' + row.order_qty + '</td>';
			strDiv  += '    <td>' + row.product_qty + '</td>';
			
			var discount_kr = row.discount_kr;
			var discount_en = row.discount_en;
			var discount_cn = row.discount_cn;
			
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
			
			for (let i=0; i<column_arr.length; i++) {
				switch (column_arr[i]) {
					case "md_category" :
						strDiv += '<TD>' + row.category_title + '</TD>';
						break;
					
					case "display_status" :
						strDiv += '<TD style="text-align:center;">' + row.display_status + '</TD>';
						break;
					
					case "sale_flg" :
						strDiv += '<TD style="text-align:center;">' + row.sale_flg + '</TD>';
						break;
					
					case "sold_out_flg" :
						strDiv += '<TD style="text-align:center;">' + row.sold_out_flg + '</TD>';
						break;
					
					case "manufacturer" :
						strDiv += '<TD>' + row.manufacturer + '</TD>';
						break;
					
					case "supplier" :
						strDiv += '<TD>' + row.supplier + '</TD>';
						break;
					
					case "brand" :
						strDiv += '<TD>' + row.brand + '</TD>';
						break;
					
					case "origin_country" :
						strDiv += '<TD>' + row.origin_country + '</TD>';
						break;
					
					case "price" :
						strDiv += '<TD style="text-align:right;">' + row.om_price_kr + '</TD>';
						strDiv += '<TD style="text-align:right;">' + row.om_price_en + '</TD>';
						strDiv += '<TD style="text-align:right;">' + row.om_price_cn + '</TD>';
						break;
					
					case "model" :
						strDiv += '<TD>' + row.model + '</TD>';
						break;
					
					case "model_wear" :
						strDiv += '<TD>' + row.model_wear + '</TD>';
						break;
					
					case "product_keyword" :
						strDiv += '<TD>' + row.product_keyword + '</TD>';
						break;
					
					case "product_tag" :
						strDiv += '<TD>' + row.product_tag + '</TD>';
						break;
					
					case "whish_cnt" :
						strDiv += '<TD>' + row.whish_cnt + '</TD>';
						break;
					
					case "basket_cnt" :
						strDiv += '<TD>' + row.basket_cnt + '</TD>';
						break;
					
					case "order_pcp_cnt" :
						strDiv += '<TD>' + row.order_pcp_cnt + '</TD>';
						break;
					
					case "order_dpg_cnt" :
						strDiv += '<TD>' + row.order_dpg_cnt + '</TD>';
						break;
					
					case "order_dcp_cnt" :
						strDiv += '<TD>' + row.order_dcp_cnt + '</TD>';
						break;
					
					case "memo" :
						strDiv += '<TD>' + row.memo + '</TD>';
						break;
				}
			}
			
			strDiv += '    <td>';
			strDiv += '        <input disabled type="text" value="" placeholder="지원하지 않는 상품입니다">';
			strDiv += '        <div class="product__btn__wrap">';
			strDiv += '            <button class="product__btn" type="button">SMS 발송</button>';
			strDiv += '            <button class="product__btn" type="button">SMS 공유</button>';
			strDiv += '        	   <button class="product__btn" type="button">주소 복사</button>';
			strDiv += '        </div>';
			strDiv += '    </td>';
			strDiv += '</tr>';
		}
	});
	
	return strDiv;
}

function getProductInfoList(){

	let result_checkbox_table = $("#result_checkbox_table");
	let result_table = $("#result_table");

	result_checkbox_table.html('');
	result_table.html('');
	
	let select_column = $('#select_column').val()
	
	let column_arr = [];
	if (select_column.length > 0) {
		column_arr = select_column.split(",");
	}
	
	let div_head = setProductHead(column_arr);
	result_table.append(div_head);
	
	var strCheckboxDiv = '';
	strCheckboxDiv += '<TD class="checkbox_tr"></TD>';

	var strDiv = '';
	strDiv += '<TBODY id="result_body">';
	strDiv += '    <TD class="default_td marker_td" colspan="' + (15 + column_arr.length - 1) + '">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TBODY>';
	
	result_checkbox_table.append(strCheckboxDiv);
	result_table.append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d != null) {
				result_checkbox_table.html('');
				let product_cnt = d[0];
				
				let result_body = $('#result_body');
				result_body.remove();
				
				$('#product_qty').text(product_cnt.product_qty);
				$('#sales_qty').text(product_cnt.sales_qty);
				$('#non_sales_qty').text(product_cnt.non_sales_qty);
				$('#display_qty').text(product_cnt.display_qty);
				$('#non_display_qty').text(product_cnt.non_display_qty);
				
				result_table.append('<TBODY id="result_body"></TBODY>');
				
				let div_body = setProductBody(column_arr,d);
				
				$('#result_body').append(div_body);
			}
			document.querySelectorAll('.marker_td').forEach(
			(el,idx)=>
				{
					$('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
				}
			);
		},
	},rows, page);
}

function openSelectColumnModal() {
	modal('/get');
}

</script>