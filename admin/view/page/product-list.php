<div class="content__card">
	<form id="frm-filter" action="product/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="tab_num" name="tab_num" value="01">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

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
							전체<font class="info__count">21,883</font>건
						</div>
						<div>
							판매함<font class="info__count">51,883</font>건
						</div>
						<div>
							판매 안함<font class="info__count">1,983</font>건
						</div>
						<div>
							진열함<font class="info__count">2,883</font>건
						</div>
						<div>
							진열안함<font class="info__count">1,883</font>건
						</div>
					</div>
					<div>
						<button type="button" style="width:120px;height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;">상품 등록</button>
						<button type="button" style="width:120px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;">검색조회 항목 저장</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row search_type_td" style="display: block;">
					<select class="fSelect eSearch search_type" name="search_type[]" style="width:163px;" onChange="searchTypeChange(this);">
						<option value="" selected>검색분류 선택</option>
						<option value="name">상품명</option>
						<option value="code">상품코드</option>
						<option value="category">상품분류</option>
						<option value="size">사이즈</option>
						<option value="material">주원료</option>
						<option value="care">주의사항</option>
						<option value="detail">상품 상세정보</option>
						<option value="tag">상품태그</option>
						<option value="creater">등록아이디</option>
					</select>
					
					<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
					
					<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">-</button>
					<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">+</button>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="product_type1" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type1">전체</label>
						<input id="product_type2" type="radio" name="product_type" value="BASIC" >
						<label for="product_type2">기본상품</label>
						<input id="product_type3" type="radio" name="product_type" value="SET" >
						<label for="product_type3">세트상품</label>
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

							<div class="search_date_prod_date date__picker" date_type="prod_date" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_prod_date date__picker" date_type="prod_date" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
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
				<div class="content__wrap">
					<div class="content__title">재고관리 사용</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="stock_management_all" type="radio" name="stock_management" value="all" checked>
							<label for="stock_management_all">전체</label>
							
							<input id="stock_management_true" type="radio" name="stock_management" value="true">
							<label for="stock_management_true">사용 함</label>
							
							<input id="stock_management_false" type="radio" name="stock_management" value="false">
							<label for="stock_management_false">사용 안함</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
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
				
				<div class="content__wrap">
					<div class="content__title">재고관리 등급</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="stock_grade_all" type="radio" name="stock_grade" value="all" checked>
							<label for="stock_grade_all">전체</label>
							<input id="stock_grade_A" type="radio" name="stock_grade" value="A" >
							<label for="stock_grade_A">일반 재고</label>
							<input id="stock_grade_B" type="radio" name="stock_grade" value="B" >
							<label for="stock_grade_B">중요 재고</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">품절 사용</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="sold_out_flg_all" type="radio" name="sold_out_flg" value="all" checked>
							<label for="sold_out_flg_all">전체</label>
							
							<input id="sold_out_flg_true" type="radio" name="sold_out_flg" value="true">
							<label for="sold_out_flg_true">사용 함</label>
							
							<input id="sold_out_flg_false" type="radio" name="sold_out_flg" value="false">
							<label for="sold_out_flg_false">사용 안함</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
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
								<input type="checkbox" name="unclassified" value="">
								<span>분류 미등록 상품 검색</span>
							</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">번역 상태</div>
					<div class="content__row">
						<select class="fSelect" name="translate_flg" style="width:163px;">
							<option value="">번역상태 선택</option>
							<option value="false">미번역</option>
							<option value="true">번역완료</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div class="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getProdTabInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getProdTabInfo');"><span>초기화</span></div>
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
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">삭제일 역순</option>
						<option value="UPDATE_DATE|ASC">삭제일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
						<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
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
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" action_type="prod_copy" onclick="prodActionCheck(this);">복사</div>
						<div style="width: 140px;" class="filter__btn" action_type="prod_delete" onclick="prodActionCheck(this);">삭제</div>
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
						<div style="width: 140px;" class="filter__btn" action_type="" onclick="">설정</div>
					</div>                                
				</div>
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH style="width:8%;">상품구분</TH>
							<TH>상품코드</TH>
							<TH>상품명</TH>
							<TH style="width:8%;">판매가<br>(한국몰)</TH>
							<TH style="width:8%;">판매가<br>(영문몰)</TH>
							<TH style="width:8%;">판매가<br>(중국몰)</TH>
							<TH style="width:15%;">바로구매 URL</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table">
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
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
	
	//size_detail_kr
	/*
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_kr,
		elPlaceHolder: "size_detail_a1_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_kr,
		elPlaceHolder: "size_detail_a2_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_kr,
		elPlaceHolder: "size_detail_a3_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_kr,
		elPlaceHolder: "size_detail_a4_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_kr,
		elPlaceHolder: "size_detail_a5_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_kr,
		elPlaceHolder: "size_detail_onesize_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//size_detail_en
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_en,
		elPlaceHolder: "size_detail_a1_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_en,
		elPlaceHolder: "size_detail_a2_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_en,
		elPlaceHolder: "size_detail_a3_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_en,
		elPlaceHolder: "size_detail_a4_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_en,
		elPlaceHolder: "size_detail_a5_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_en,
		elPlaceHolder: "size_detail_onesize_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	//size_detail_cn
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a1_cn,
		elPlaceHolder: "size_detail_a1_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a2_cn,
		elPlaceHolder: "size_detail_a2_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a3_cn,
		elPlaceHolder: "size_detail_a3_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a4_cn,
		elPlaceHolder: "size_detail_a4_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_a5_cn,
		elPlaceHolder: "size_detail_a5_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: size_detail_onesize_cn,
		elPlaceHolder: "size_detail_onesize_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	*/
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
	getProdTabInfo();
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

function getProdTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="no[]" value="' + row.no + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				strDiv += '    <td>' + row.num + '</td>';
				strDiv += '    <td>' + row.product_type + '</td>';
				strDiv += '    <td><font product_idx="' + row.no + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.product_code + '</font></td>';
				strDiv += '    <TD>';
				strDiv += '        <div class="product__img__wrap">';
				
				var background_url = "background-image:url('" + row.img_location + "');";
				
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <td style="text-align: right;">' + row.price_kr.toLocaleString('ko-KR') + '</td>';
				strDiv += '    <td style="text-align: right;">' + row.price_en.toLocaleString('ko-KR') + '</td>';
				strDiv += '    <td style="text-align: right;">' + row.price_cn.toLocaleString('ko-KR') + '</td>';
				strDiv += '    <td>';
				strDiv += '        <input disabled type="text" value="" placeholder="지원하지 않는 상품입니다">';
				strDiv += '        ';
				strDiv += '        <div class="product__btn__wrap">';
				strDiv += '            <button class="product__btn" type="button">SMS 발송</button>';
				strDiv += '            <button class="product__btn" type="button">SMS 공유</button>';
				strDiv += '        	   <button class="product__btn" type="button">주소 복사</button>';
				strDiv += '        </div>';
				strDiv += '        ';
				strDiv += '    </td>';
				strDiv += '</tr>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
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
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.select').prop('checked',false);
	}
}
function excelDownload() {
	if ($('#result_table').find('.default_td').length > 0) {
		alert('다운로드 할 상품을 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "상품목록";
		file_name = "상품목록_" + file_date;
		insertLog("상점관리 > 상품 목록", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
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

	getProdTabInfo();
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getProdTabInfo();
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
				getProdTabInfo();
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

function openProductUpdateModal(obj) {
	var product_idx = $(obj).attr('product_idx');
	var data = {'product_idx':product_idx};
	
	modal('/put','product_idx=' + product_idx);
}
</script>
