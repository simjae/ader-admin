<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter_DEL" action="product/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="delete_flg" value="true">
		<input type="hidden" name="tab_status" value="DEL">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<input id="select_column_DEL" type="hidden" name="select_column" value="">
		
		<div class="card__header">
			<div class="card__header">
				<h3>삭제 상품 목록</h3>
				<div class="drive--x"></div>
			</div>
		</div>
		<div class="card__body">
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
						<input id="product_type_all_DEL" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type_all_DEL">전체</label>
						
						<input id="product_type_b_DEL" type="radio" name="product_type" value="B" >
						<label for="product_type_b_DEL">기본상품</label>
						
						<input id="product_type_s_DEL" type="radio" name="product_type" value="S" >
						<label for="product_type_s_DEL">세트상품</label>
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
							<input id="search_date_product" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_product date__picker" date="today" type="button" date_type="product" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_product date__picker" date="01d" type="button" date_type="product" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_product date__picker" date="03d" type="button" date_type="product" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_product date__picker" date="07d" type="button" date_type="product" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_product date__picker" date="15d" type="button" date_type="product" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_product date__picker" date="01m" type="button" date_type="product" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_product date__picker" date="03m" type="button" date_type="product" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="product_from" class="date_param" type="date" name="prod_date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="product" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="product_to" class="date_param" type="date" name="prod_date_to" placeholder="To" readonly style="width:150px;" date_type="product" onChange="dateParamChange(this);">
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
				<div class="detail_toggle" toggle="hide" tab_status="DEL" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getDelProductInfoList('DEL');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter_DEL', 'getDelProductInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-list_DEL" action="product/delete/put">
		<input type="hidden" class="action_type" name="action_type">
				
		<div class="card__header">
			<h3>상품 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_DEL_total info__count" >0</font>개 / 검색결과 <font class="cnt_DEL_result info__count" >0</font>개
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
					<select name="rows" style="width:163px;float:right;" onChange="rowsChange(this);">
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
			
			<div id="table_div_DEL" class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" action_type="product_restore" onclick="productActionClick(this);">상품복구</div>
						<div style="width: 140px;" class="filter__btn" action_type="product_delete" onclick="productActionClick(this);">완전삭제</div>
						<div style="width: 140px;" class="filter__btn" action_type="order_status_set" onclick="productActionClick(this);">개인 결제 목록으로 이동</div>
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
					</div> 
					<div>
						<div class="btn" style="width:100px;text-align:center;float:right;" onClick="openSelectColumnModal('DEL')">설정</div>
					</div>                                 
				</div>
				<div class="double__table__container">
					<div class="overflow-x-auto top__scroll">
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
													<input type="checkbox" onClick="selectAllClick(this);">
													<span></span>
												</label>
											</div>
										</div>
									</th>
								</tr>
							</thead>
							<tbody id="result_checkbox_table_DEL">
							</tbody>
						</table>
					</div>
					<div class="overflow-x-auto top__scroll">
						<TABLE id="result_table_DEL"></TABLE>
					</div>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_status="DEL" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_status="DEL" value="0" onChange="setPaging(this);">
            	<div class="paging_DEL"></div>
        	</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function() {
	getDelProductInfoList('DEL');
});

</script>