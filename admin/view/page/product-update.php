<div class="content__card">
	<form id="frm-list" action="product/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" id="rows" name="rows" value="10">
		<input type="hidden" id="page" name="page" value="1">
		<input id="idx_flg" type="hidden" name="idx_flg" value="false">
		
		<div class="card__header">
			<h3>상품 정보 일괄 변경</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row">
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
				<select class="fSelect category eCategory eCategory1" depth="1" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
				</select>

				<select class="fSelect category eCategory eCategory2" depth="2" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
					<option value="">상품분류 02</option>
				</select>
				<select class="fSelect category eCategory eCategory3" depth="3" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
					<option value="">상품분류 03</option>
				</select>
				<select class="fSelect category eCategory eCategory4" depth="4" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
					<option value="">상품분류 04</option>
				</select>
				<select class="fSelect category eCategory eCategory5" depth="5" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
					<option value="">상품분류 05</option>
				</select>
				<select class="fSelect category eCategory eCategory6" depth="6" name="categorys[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
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
							<input id="personal_stock_management_all" type="radio" name="stock_management" value="all" checked>
							<label for="personal_stock_management_all">전체</label>
							
							<input id="personal_stock_management_true" type="radio" name="stock_management" value="true">
							<label for="personal_stock_management_true">사용 함</label>
							
							<input id="personal_stock_management_false" type="radio" name="stock_management" value="false">
							<label for="personal_stock_management_false">사용 안함</label>
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
							<input id="personal_stock_grade_all" type="radio" name="stock_grade" value="all" checked>
							<label for="personal_stock_grade_all">전체</label>
							<input id="personal_stock_grade_A" type="radio" name="stock_grade" value="A" >
							<label for="personal_stock_grade_A">일반 재고</label>
							<input id="personal_stock_grade_B" type="radio" name="stock_grade" value="B" >
							<label for="personal_stock_grade_B">중요 재고</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">품절 사용</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="personal_sold_out_flg_all" type="radio" name="sold_out_flg" value="all" checked>
							<label for="personal_sold_out_flg_all">전체</label>
							
							<input id="personal_sold_out_flg_true" type="radio" name="sold_out_flg" value="true">
							<label for="personal_sold_out_flg_true">사용 함</label>
							
							<input id="personal_sold_out_flg_false" type="radio" name="sold_out_flg" value="false">
							<label for="personal_sold_out_flg_false">사용 안함</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">품절 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="personal_sold_out_status_all" type="radio" name="sold_out_status" value="all" checked>
							<label for="personal_sold_out_status_all">전체</label>
							

							<input id="personal_sold_out_status_false" type="radio" name="sold_out_status" value="false">
							<label for="personal_sold_out_status_false">품절</label>
							
							<input id="personal_sold_out_status_true" type="radio" name="sold_out_status" value="true">
							<label for="personal_sold_out_status_true">품절 아님</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">진열 상태</div>
						<div class="content__row">
							<div class="rd__block">
								<input id="personal_display_status_all" type="radio" name="display_status" value="all" checked>
								<label for="personal_display_status_all">전체</label>
								<input id="personal_display_status_true" type="radio" name="display_status" value="true">
								<label for="personal_display_status_true">진열 함</label>
								<input id="personal_display_status_false" type="radio" name="display_status" value="false">
								<label for="personal_display_status_false">진열 안함</label>
							</div>
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">판매 여부</div>
						<div class="content__row">
							<div class="rd__block">
								<input id="personal_sale_flg_all" type="radio" name="sale_flg" value="all" checked>
								<label for="personal_sale_flg_all">전체</label>
								
								<input id="personal_sale_flg_true" type="radio" name="sale_flg" value="true">
								<label for="personal_sale_flg_true">판매 함</label>
								
								<input id="personal_sale_flg_false" type="radio" name="sale_flg" value="false">
								<label for="personal_sale_flg_false">판매 안함</label>
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
					<div  class="blue__color__btn" onClick="getUpdateProductInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list','getUpdateProductInfo');"><span>초기화</span></div>
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
			
			
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
					</div>           
					<div class="content__row">
						
						<select id="update_type" class="fSelect" name="search_limit" style="width:163px;">
							<option value="" selected>변경대상 선택</option>
							<option value="select_idx">선택한 상품의</option>
							<option value="select_all">검색결과 전체상품의</option>
						</select>
						
						<select id="update_info" class="fSelect" name="product_limit" style="width:163px;">
							<option value="" selected>변경정보 선택</option>
							<option value="ordersheet">오더시트 입력정보</option>
							<option value="material">W/K/L/A & Material</option>
							<option value="size_detail">Size Detail</option>
							<option value="detail">Detail</option>
							<option value="care">Care</option>
							<option value="price">Price</option>
							<option value="sales_info">판매정보</option>
							<option value="deliver_info">배송정보</option>
							<option value="manufacture_info">제작정보</option>
						</select>
						
						<div id="batch__modal"class="table__change__btn" onClick="openProductUpdateModal();">일괄변경</div>
						
						<div class="table__setting__btn">설정</div>
					</div>
				</div>
				<div class="overflow-x-auto">
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
								<TH style="width:3%;">상품<br>구분</TH>
								<TH>스타일 코드</TH>
								<TH>컬러 코드</TH>
								<TH>상품 코드</TH>
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
$(document).ready(function() {
	getProductCategory(0,0);
	getUpdateProductInfo();
	/*$('#batch__modal').on('click',function(){
		$('.batch__modal__wrap').show();
	});
	
	$('.batch__modal__close').on('click',function(){
		$('.batch__modal__wrap').hide();
	});
	
	productNoticeClose();
	productSelectLi();
	productRowToggleBtn();
	productSelectApplyBtn();*/
});

$(document).mouseup(function (e){
	let LayerPopup = $(".batch__modal");
	if(LayerPopup.has(e.target).length === 0){
		$(".batch__modal__wrap").hide();
	}
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
function searchTypeBtnClick(obj) {
	var search_type = $('#frm-list').find('.search_type');
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
			$('#frm-list').find('.search_type_td').append(strDiv);
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
	var length = $('#frm-list').find('.search_type').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-list').find('.search_type').eq(i).val();
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

function priceTypeBtnClick(obj) {
	var price_type = $('#frm-filter').find('.price_type');
	var length = price_type.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 3) {
			var strDiv = "";
			strDiv += '<div class="row form-group country_price">';
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

function productCategoryChange(obj) {
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
	var eCategory = $('#frm-list').find('.eCategory' + depth);
	eCategory.empty();
	eCategory.append($('<option value="">상품분류 0' + depth + '</option>'));
	
	if (d != null) {
		d.forEach(function(row) {
			eCategory.append($("<option value='" + row.no + "'>" + row.text + "</option>"));
		});
	}	
	
	eCategory.prop("selected", true);
}

// function searchDateClick(obj) {
// 	var date = $(obj).attr('date');
	
// 	$(obj).css('background-color','#000000');
// 	$(obj).css('color','#ffffff');
// 	$(obj).css('font-weight','800');
	
// 	var date_type = $(obj).attr('date_type');

// 	if (date_type == "product") {
// 		$('.search_date').not($(obj)).css('background-color','#ffffff');
// 		$('.search_date').not($(obj)).css('color','#000000');
// 		$('.search_date').not($(obj)).css('font-weight','500');
		
// 		$('#sel_date').val(date);
		
// 		$('#searchDate_from').val('');
// 		$('#searchDate_to').val('');
// 	}
// }

// function dateParamChange(obj) {
// 	$('.search_date').css('background-color','#ffffff');
// 	$('.search_date').css('color','#000000');
// 	$('.search_date').css('font-weight','500');
	
// 	$('#sel_date').val('');	
// }

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

function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기');
	}
	$('.detail_hidden').toggle();
}

function resultTableReset(colspan) {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="' + colspan + '">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	$('.paging').html('');
}

function openProductUpdateModal() {
	var update_info = $('#update_info').val();
			
	if (update_info.length == 0) {
		alert('변경할 정보를 선택해주세요');
		return false;	
	}
	
	var update_type = $('#update_type').val();
	if (update_type == "select_idx") {
		$('#idx_flg').val(false);
		var length = $('.select').length;
		
		if (length > 0) {
			var product_idx_arr = [];
			for (var i=0; i<length; i++) {
				var select = $('.select').eq(i);
				if (select.prop('checked') == true) {
					product_idx_arr.push(select.val());
				}
			}
			if (product_idx_arr.length > 0) {
				modal(update_info + '/put','product_idx_arr=' + product_idx_arr);
			} else {
				alert('변경할 대상을 선택해주세요');
				return false;
			}
		}
	} else if (update_type == "select_all") {
		$('#idx_flg').val(true);
		get_contents($("#frm-list"),{
			html : function(d) {				
				d.forEach(function(row) {
					if (row.product_idx_arr != null) {
						modal(update_info + '/put','product_idx_arr=' + row.product_idx_arr);
					} else {
						alert('변경할 대상을 선택해주세요');
						return false;
					}
				});
			},
		},rows,page);
	} else {
		alert('변경할 대상을 선택해주세요');
		return false;
	}
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

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);
	
	getUpdateProductInfo();
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#rows').val(rows);
	$('#page').val(1);
	
	getUpdateProductInfo();
}

function getUpdateProductInfo() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="8">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	// var rows = $("#frm-list").find('.rows').val();
	// var page = $("#frm-list").find('.page').val();
	var rows = $('#rows').val();
	var page = $('#page').val();
	
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
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
				var product_type = "";
				if (row.product_type == "B") {
					product_type = "일반";
				} else if (row.product_type == "S") {
					product_type = "세트";
				}
				
				strDiv += '    <td>' + product_type + '</td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.style_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.color_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.product_code + '</font></td>';
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
				
				strDiv += '    <td style="text-align: right;">';
				var discount_kr = row.discount_kr;
				if (discount_kr > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_kr != null){
						strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
					}
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_en = row.discount_en;
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_en != null){
						strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
					}
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_cn = row.discount_cn;
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_cn != null){
						strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
					}
				}
				
				strDiv += '    </td>';
				
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
	},rows,page);
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
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
	
		insertLog("상품관리 > 상품 정보 일괄 변경 ", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}
//==========모달처리==========//
/*
function productSelectLi (){
	let depth = $('#product__category__tbody .product__depth__wrap .category__exposure > li');
	depth.on('click', function(){
		$(this).addClass('selected');
		let thisDepth = $(this).parent().attr('depth');
		let nextDepth =  Number(thisDepth) + 1;
		
		for(let i = 0; i < 6; i++ ){
			let ul = $('.category__exposure').eq(i);
			let depth = ul.attr('depth');
			
			if(depth > nextDepth){   //초과 
				$('.product__category__td').eq(i).addClass('display__none');
				ul.find('li').removeClass('selected');
			} else if (depth == nextDepth) {
				$('.product__category__td').eq(i).removeClass('display__none');
				ul.find('li').removeClass('selected');
			} else if (depth < nextDepth) {
				$('.product__category__td').eq(i).removeClass('display__none');
			}
		}
		$(this).parent().find('li').removeClass('selected');
		$(this).addClass('selected');
	});
}

function productNoticeClose(){
	$('#eNudgeClose').on('click', function(){
		$('#categoryAddNudge').css('display','none');
	});
}
function productRowToggleBtn(){
	$('.product__row--btn').on('click',function(){
		let checkShowClass = $(this).parent().parent().find('.product__row__table');
		
		if(checkShowClass.hasClass('show')){
			$(this).removeClass('xi-angle-up');
			$(this).addClass('xi-angle-down');
			$(this).parent().parent().find('.product__row__table').css('display','none');
		}else{
			$(this).addClass('xi-angle-up');
			$(this).removeClass('xi-angle-down');
			$(this).parent().parent().find('.product__row__table').css('display','block');
		}
		$(this).parent().parent().find('.product__row__table').toggleClass('show');
	});
}

function productSelectApplyBtn(){
	$('.category__apply__btn').on('click',function(){
		let categorySelected  = [];
		let depthSelected = $('.category__exposure ').find('.selected');
		$(depthSelected).each(function(index,item){
			categorySelected.push($(item).text().replace(/>/, '').replace(/^\s+|\s+$/g,''));
		});	
		let replace = categorySelected.toString().replace(/,/gi, " > ");
		$('#category__select__append').text(replace);
	});
}*/
</script>