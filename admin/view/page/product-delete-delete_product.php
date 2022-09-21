<div class="content__card">
	<form id="frm-list_01" action="product/delete/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="01">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
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
					
					<input type="text" name="search_keyword[]" value="" style="width:70%;">
					
					<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">-</button>
					<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="searchTypeBtnClick(this);">+</button>
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
				<div class="content__title">기간</div>
				<div class="content__row">
					<select class="fSelect category" name="date_type" style="width:163px;">
						<option value="CREATE_DATE">상품등록일</option>
						<option value="UPDATE_DATE">상품최종수정일</option>
					</select>
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_product" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_product date__picker" date_type="product" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_product date__picker" date_type="product" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_product date__picker" date_type="product" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_product date__picker" date_type="product" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_product date__picker" date_type="product" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_product date__picker" date_type="product" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_product date__picker" date_type="product" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="product_from" class="date_param" type="date" name="product_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="product" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="product_to" class="date_param" type="date" name="product_to" placeholder="To" readonly style="width:150px;" date_type="product" onChange="dateParamChange(this);">
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
					<div  class="blue__color__btn" onClick="getDeleteTabInfo_01();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list_01', 'getDeleteTabInfo_01');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-01-01" action="product/delete/put">
		<input type="hidden" class="action_type" name="action_type">
				
		<div class="card__header">
			<h3>상품 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_01_total info__count" >0</font>개 / 검색결과 <font class="cnt_01_result info__count" >0</font>개
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
			
			<div id="table_div_01" class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" action_type="product_restore" onclick="productActionClick(this);">상품복구</div>
						<div style="width: 140px;" class="filter__btn" action_type="product_delete" onclick="productActionClick(this);">완전삭제</div>
						<div style="width: 140px;" class="filter__btn" action_type="order_status_set" onclick="productActionClick(this);">개인 결제 목록으로 이동</div>
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
					</div> 
					<div>
						<div class="table__setting__btn">설정</div>
					</div>                                 
				</div>
				<div class="overflow-x-auto">
					<TABLE id="excel_table_01">
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="row form-group">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:5%;">No.</TH>
								<TH style="width:10%;">상품구분</TH>
								<TH style="width:10%;">상품코드</TH>
								<TH>상품명</TH>
								<TH style="width:10%;">판매가<br>(한국몰)</TH>
								<TH style="width:10%;">판매가<br>(영문몰)</TH>
								<TH style="width:10%;">판매가<br>(중문몰)</TH>
							</TR>
						</THEAD>
						
						<TBODY id="result_table_01">
							<TR>
								<TD class="default_td" colspan="8">
									조회 결과가 없습니다
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_num="01" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_num="01" value="0" onChange="setPaging(this);">
            	<div class="paging_01"></div>
        	</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function() {
	getDeleteTabInfo_01();
});

function getDeleteTabInfo_01() {	
	$("#result_table_01").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="8">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_01").append(strDiv);
	
	var rows = $('#frm-list_01').find('.rows').val();
	var page = $('#frm-list_01').find('.page').val();
	
	get_contents($("#frm-list_01"),{
		pageObj : $(".paging_01"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_01").html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="form-group">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.no + '">';
				strDiv += '                    <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.product_type + '</TD>';
				strDiv += '    <TD>' + row.product_code + '</TD>';
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
				strDiv += '    <TD>' + row.sales_price_kr + '</TD>';
				strDiv += '    <TD>' + row.sales_price_en + '</TD>';
				strDiv += '    <TD>' + row.sales_price_cn + '</TD>';
				strDiv += '</TR>'
				
				$("#result_table_01").append(strDiv);
			});
		},
	},rows,page);
}
</script>