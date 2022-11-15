<div class="content__card">
	<form id="frm-list_01" action="product/stock/regist/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>상품 재고 등록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap ">
				<div class="content__title">검색 분류</div>
				<div class="content__row search_type_td" style="display:block">
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
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="regist_product_type_all" type="radio" name="product_type" value="ALL" checked>
						<label for="regist_product_type_">전체</label>
						
						<input id="regist_product_type_basic" type="radio" name="product_type" value="B" >
						<label for="regist_product_type_">기본상품</label>
						
						<input id="regist_product_type_set" type="radio" name="product_type" value="S" >
						<label for="regist_product_type_set">세트상품</label>
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
							<input id="search_date_stock_regist" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_stock_regist date__picker" date_type="stock_regist" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						
						<div class="content__date__picker">
							<input id="stock_regist_from" class="date_param" type="date" name="stock_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="stock_regist" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="stock_regist_to" class="date_param" type="date" name="stock_to" placeholder="To" readonly style="width:150px;" date_type="stock_regist" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">진열 상태</div>
					
					<div class="content__row">
						<div class="rd__block">
							<input id="regist_display_status_all" type="radio" name="display_status" value="all" checked>
							<label for="regist_display_status_all">전체</label>
							
							<input id="regist_display_status_true" type="radio" name="display_status" value="true" >
							<label for="regist_display_status_true">진열 함</label>
							
							<input id="regist_display_status_false" type="radio" name="display_status" value="false" >
							<label for="regist_display_status_false">진열 안함</label>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">판매 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="regist_sale_status_all" type="radio" name="sale_status" value="all" checked>
							<label for="regist_sale_status_all">전체</label>
							
							<input id="regist_sale_status_true" type="radio" name="sale_status" value="true">
							<label for="regist_sale_status_true" >판매 함</label>
						
							<input id="regist_sale_status_false" type="radio" name="sale_status" value="false">
							<label for="regist_sale_status_false" >판매 안함</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card__body--hide detail_hidden" style="display: none;">
				<div class="content__wrap">
					<div class="content__title">재고 수량</div>
					<div class="content__row">
						<select class="fSelect" name="qty_type[]" style="width:163px;">
							<option value="stock">상품 재고</option>
							<option value="safe">안전 재고</option>
						</select>
						
						<input type="number" value="" style="width:50px;margin-right:5px;">개
						~
						<input type="number" value="" style="width:50px;margin-right:5px;">개
						
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">-</button>
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">+</button>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">재고관리 등급</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="regist_stock_grade_all" type="radio" name="stock_grade" value="all" checked>
							<label for="regist_stock_grade_all">전체</label>
							
							<input id="regist_stock_grade_nml" type="radio" name="stock_grade" value="NML">
							<label for="regist_stock_grade_nml">일반 재고</label>
							
							<input id="regist_stock_grade_imp" type="radio" name="stock_grade" value="IMP">
							<label for="regist_stock_grade_imp">중요 재고</label>
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">품절 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="regist_sold_out_status_all" type="radio" name="sold_out_status" value="all" checked>
							<label for="regist_sold_out_status_all">전체</label>
							
							<input id="regist_sold_out_status_true" type="radio" name="sold_out_status" value="true">
							<label for="regist_sold_out_status_true">품절</label>
							
							<input id="regist_sold_out_status_false" type="radio" name="sold_out_status" value="false">
							<label for="regist_sold_out_status_false">품절 아님</label>
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
					<div  class="blue__color__btn" onClick="getProductStockList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list_01', 'getProductStockInfo_01')"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>선택상품 총 재고</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap table">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div style="width: 50px;" class="filter__btn" action_type="prod_copy" onclick="resetProductStockTotal();">초기화</div>
				</div>                                
			</div>
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:15%;">상품코드</TH>
						<TH style="width:15%;">상품명</TH>
						<TH style="width:10%;">옵션코드</TH>
						<TH style="width:10%;">옵션명</TH>
						<TH style="width:5%;">재고수량</TH>
						<TH style="width:5%;">안전재고</TH>
						<TH style="width:5%;">누적판매량</TH>
					</TR>
				</THEAD>
				
				<TBODY id="result_table_total">
					<TR>
						<TD class="default_td" colspan="13">
							상품을 선택해주세요.
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
	</div>
</div>

<div class="content__card">
	<input type="hidden" class="action_type" name="action_type">
	<input type="hidden" class="action_name" name="action_name">
	
	<div class="card__header">
		<h3>상품 재고 검색 결과</h3>
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
		<div class="hidden">
			<input type="file" id="excel_upload">
		</div>
		<div class="table__wrap table">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div style="width: 140px;" class="filter__btn" action_type="prod_copy" onclick="stockUpload()">재고정보 업로드</div>
					<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
				</div>                                
			</div>
			<TABLE  id="excel_table_01">
				<THEAD>
					<TR>
						<TH style="width:5%;">No.</TH>
						<TH style="width:15%;">상품코드</TH>
						<TH style="width:15%;">상품명</TH>
						<TH style="width:10%;">옵션코드</TH>
						<TH style="width:10%;">옵션명</TH>
						<TH style="width:5%;">재고수량</TH>
						<TH style="width:5%;">안전재고</TH>
						<TH style="width:5%;">재고상태</TH>
						<TH style="width:10%;">재고적용일</TH>
						<TH style="width:10%;">재고등록일</TH>
						<TH style="width:10%;">등록담당자</TH>
						<TH style="width:10%;">편집</TH>
					</TR>
				</THEAD>
				
				<TBODY id="result_table_01">
					<TR>
						<TD class="default_td" colspan="13">
							조회 결과가 없습니다
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" tab_num="01" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" tab_num="01" value="0" onChange="setPaging(this);">
			<div class="paging_01"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('#excel_upload').on('change', function(e){
		var files = e.target.files;
		
		if(files != null){
			uploadSheet(files);
		};
		e.target.value = '';
	});
	getProductStockList();
});

function stockUpload(){
	$("#excel_upload").click();
}
function uploadSheet(obj){
    var files = obj;
    var reader = new FileReader();
	reader.readAsBinaryString(files[0]);
    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '상품재고'){
                stock_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 1, header:1});
				json_str = JSON.stringify(stock_sheet);
				putStockExcel(json_str);
            }
        })
    };
}

function putStockExcel(str){
	if(str != null && str.length > 0){
		$.ajax({
			type: "post",
			data: {
				'stock_sheet':str
			},
			dataType: "json",
			url: config.api + "product/stock/add",
			error: function() {
				alert('상품재고 등록처리에 실패했습니다.');
			},
			success: function(d) {
				if(d.code == 200){
					alert(d.success_cnt + "건의 상품재고가 추가되었습니다.");
				} else{
					alert('다음행의 재고 데이터를 확인해주세요.<br>' + d.stock_fail);
					alert(d.msg);
				}
				
				getProductStockList();
			}
		});
	}
}

function getProductStockList() {
	$("#result_table_01").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_01").append(strDiv);
	
	var rows = $("#frm-list_01").find('.rows').val();
	var page = $("#frm-list_01").find('.page').val(1);
	
	get_contents($("#frm-list_01"),{
		pageObj : $(".paging_01"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_01").html('');
			}
			
			var update_color = "";
			var delete_color = "";
			var btn_disabled = "";
			var number_readonly = "";
			
			d.forEach(function(row) {
				var stock_date = new Date(row.stock_date);
				var today = new Date();
				var stock_appl = "";
				if (stock_date <= today) {
					stock_appl = "적용대기중";
					
					update_color = "#bfbfbf";
					delete_color = "#bfbfbf";
					btn_disabled = "disabled";
					number_readonly = "readonly";
				} else {
					stock_appl = "적용완료";
					
					update_color = "#140f82";
					delete_color = "#e7505a";
					btn_disabled = "";
					number_readonly = "";
				}
				
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD action_type="product_idx" code_val="' + row.product_idx + '" style="cursor:pointer;" onClick="getProductStockTotal(this);">' + row.product_code + '</TD>';
				strDiv += '    <TD>' + row.product_name + '</TD>';
				strDiv += '    <TD action_type="option_idx" code_val="' + row.option_idx + '" style="cursor:pointer;" onClick="getProductStockTotal(this);">' + row.barcode + '</TD>';
				strDiv += '    <TD>' + row.option_name + '</TD>';
				
				strDiv += '    <TD>';
				strDiv += '        <input id="stock_qty_' + row.stock_idx + '" ' + number_readonly + ' type="number" style="width:100%;height:28px;border:1px solid #bfbfbf;" value="' + row.stock_qty + '">';
				strDiv += '    </TD>';
				strDiv += '    <TD>';
				strDiv += '        <input id="safe_qty_' + row.stock_idx + '" ' + number_readonly + ' type="number" style="width:100%;height:28px;border:1px solid #bfbfbf;" value="' + row.stock_safe_qty + '">';
				strDiv += '    </TD>';
				
				strDiv += '    <TD>' + stock_appl + '</TD>';
				strDiv += '    <TD>' + row.stock_date + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.creater + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="row">';
				strDiv += '            <button stock_idx="' + row.stock_idx + '" btn_disabled="' + btn_disabled + '" action_type="update" style="width:50px;height:30px;background-color:' + update_color + ';color:#ffffff;font-size:0.5rem;" onClick="productStockCheck(this);">재고수정</button>';
				strDiv += '            <button stock_idx="' + row.stock_idx + '" btn_disabled="' + btn_disabled + '" action_type="delete" style="width:50px;height:30px;background-color:' + delete_color + ';color:#ffffff;font-size:0.5rem;" onClick="productStockCheck(this);">재고삭제</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table_01").append(strDiv);
			});
		},
	},rows,1);
}

function productStockCheck(obj) {
	var disabled_val = $(obj).attr('btn_disabled');
	var action_type = $(obj).attr('action_type');
	var stock_idx = $(obj).attr('stock_idx');

	if (disabled_val == "disabled") {
		alert('적용완료 상태의 재고는 수정/삭제할 수 없습니다.');
		return false;
	} else {
		if (action_type == 'update') {
			var stock_qty = $('#stock_qty_' + stock_idx).val();
			var safe_qty = $('#safe_qty_' + stock_idx).val();
			var total_sales_cnt = $('#total_sales_cnt_' + stock_idx).val();
			
			confirm('상품의 재고를 수정하시겠습니까?','productStockUpdate(' + stock_idx + ',' + stock_qty + ',' + safe_qty + ',' + total_sales_cnt + ')');
		} else if (action_type == 'delete') {
			confirm('삭제한 상품의 재고는 복구할 수 없습니다. 정말 삭제하시겠습니까?','productStockDelete(' + stock_idx + ')');
		}
	}
}

function productStockUpdate(stock_idx,stock_qty,safe_qty,total_sales_cnt) {
	$.ajax({
		type: "post",
		data: {
			'action_type':"update",
			'stock_idx':stock_idx,
			'stock_qty':stock_qty,
			'stock_safe_qty':safe_qty,
			'total_sales_cnt':total_sales_cnt
		},
		dataType: "json",
		url: config.api + "product/stock/regist/put",
		error: function() {
			alert("상품 재고 수정처리에 실패했습니다.");
		},
		success: function(d) {
			alert("해당 상품의 재고가 수정되었습니다.");
			getProductStockList();
		}
	});
}

function productStockDelete(stock_idx) {
	$.ajax({
		type: "post",
		data: {
			'action_type':"delete",
			'stock_idx':stock_idx
		},
		dataType: "json",
		url: config.api + "product/stock/regist/put",
		error: function() {
			alert("상품 재고 삭제처리에 실패했습니다.");
		},
		success: function(d) {
			alert("해당 상품의 재고가 삭제되었습니다.");
			getProductStockList();
		}
	});
}

function getProductStockTotal(obj) {
	var action_type = $(obj).attr('action_type');
	var code_val = $(obj).attr('code_val');
	
	var product_idx = null;
	var option_idx = null;
	
	if (action_type == "product_idx") {
		product_idx = code_val;
	} else if (action_type == "option_idx") {
		option_idx = code_val;
	}
	
	$.ajax({
		type: "post",
		data: {
			'total_flg':true,
			'action_type':"delete",
			'product_idx':product_idx,
			'option_idx':option_idx
		},
		dataType: "json",
		url: config.api + "product/stock/get",
		error: function() {
			alert("선택상품 총 재고 조회에 실패했습니다.");
		},
		success: function(d) {
			var data = d.data;
			if (data != null) {
				$('#result_table_total').empty();
				
				var length = (data.length + 1);
				
				var strDiv = "";
				strDiv += '    <TR>';
				strDiv += '        <TD rowspan="' + length + '">' + data[0].product_code + '</TD>';
				strDiv += '        <TD rowspan="' + length + '">' + data[0].product_name + '</TD>';
				strDiv += '    </TR>';
				
				var total_stock_qty = 0;
				var total_safe_qty = 0;
				var total_sales_cnt = 0;
				data.forEach(function(row) {
					strDiv += '<TR>';
					strDiv += '    <TD>';
					strDiv += '        <font barcode="' + row.barcode + '" style="cursor:pointer;" onClick="showOptionInfoModal(this);">' + row.barcode + '</font>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.option_name + '</TD>';
					strDiv += '    <TD>' + row.stock_qty + '</TD>';
					strDiv += '    <TD>' + row.stock_safe_qty + '</TD>';
					strDiv += '    <TD>' + row.order_qty + '</TD>';
					strDiv += '</TR>';
					
					total_stock_qty += row.stock_qty;
					total_safe_qty += row.stock_safe_qty;
					total_sales_cnt += row.order_qty;
				});
				
				strDiv += '    <TR>';
				strDiv += '        <TD colspan="4" style="text-align:right;">총 합계</TD>';
				strDiv += '        <TD>' + total_stock_qty + '</TD>';
				strDiv += '        <TD>' + total_safe_qty + '</TD>';
				strDiv += '        <TD>' + total_sales_cnt + '</TD>';
				strDiv += '    </TR>';
				
				$('#result_table_total').append(strDiv);
			}
		}
	});
}

function resetProductStockTotal() {
	$('#result_table_total').empty();
	
	var strDiv = "";
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13">';
	strDiv += '        상품을 선택해주세요.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$('#result_table_total').append(strDiv);
}

function showOptionInfoModal(obj) {
	var barcode = $(obj).attr('barcode');
	modal("option/put", 'barcode=' + barcode);
}
</script>