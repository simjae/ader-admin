<div class="content__card">
	<form id="frm-filter" action="order/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<div class="card__header">
				<h3>현금영수증 관리</h3>
				<div class="drive--x"></div>
			</div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">쇼핑몰</div>
				<div class="content__row" >
					<select class="fSelect" name="country" style="width:163px">
						<option value="KR" selected>한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중문몰</option>
					</select>
				</div>
			</div>
			
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">주문상태</div>
				<div class="content__row" style="display:block;">
					<div class="rd__block">
						<input type="radio" id="order_status_ALL" class="radio__input" value="ALL" name="order_status" checked>
						<label for="order_status_ALL">전체</label>
						
						<input type="radio" id="order_status_PCP" class="radio__input" value="PCP" name="order_status">
						<label for="order_status_PCP">결제완료</label>
						
						<input type="radio" id="order_status_PPR" class="radio__input" value="PPR" name="order_status">
						<label for="order_status_PPR">상품준비</label>

						<input type="radio" id="order_status_POP" class="radio__input" value="POP" name="order_status">
						<label for="order_status_POP">프리오더 준비</label>
						
						<input type="radio" id="order_status_POD" class="radio__input" value="POD" name="order_status">
						<label for="order_status_POD">프리오더 상품 생산</label>
						
						<input type="radio" id="order_status_DPR" class="radio__input" value="DPR" name="order_status">
						<label for="order_status_DPR">배송준비</label>

						<input type="radio" id="order_status_DPG" class="radio__input" value="DPG" name="order_status">
						<label for="order_status_DPG">배송중</label>
						
						<input type="radio" id="order_status_DCP" class="radio__input" value="DCP" name="order_status">
						<label for="order_status_DCP">배송완료</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap ">
				<div class="content__title">검색어</div>
				<div class="content__row search_keyword_td" style="display:block;">
					<div class="row">
						<select class="fSelect search_keyword" name="search_keyword[]" style="width:163px;" onchange="searchKeywordChange(this)">
							<option value="ALL" selected>검색 키워드 선택</option>
							<option value="order_code">주문번호</option>
							<option value="delivery_num">운송장번호</option>
							<option value="member_name">멤버 이름</option>
							<option value="member_id">멤버 아이디</option>
							<option value="member_tel">멤버 핸드폰</option>
							<option value="member_email">멤버 이메일</option>
							<option value="to_place">배송지</option>
							<option value="to_name">수령자 이름</option>
							<option value="to_mobile">수령자 핸드폰</option>
							<option value="order_memo">주문 메모</option>
						</select>
						
						<input type="text" name="keyword_param[]" value="" style="width:60%;">
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="append" onclick="searchKeywordBtnClick(this)">+</button>
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="remove" onclick="searchKeywordBtnClick(this)">-</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">기간</div>
				<div class="content__row">
					<select class="fSelect" name="date_type" style="width:163px;" class="fSelect disabled">
						<option value="ALL" selected>기간정보 선택</option>
						<option value="order_date">주문일</option>
						<option value="delivery_start_date">배송 시작일</option>
						<option value="delivery_end_date">배송 종료일</option>
					</select>
					
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="date_param_ALL" type="hidden" name="date_param" value="" style="width:150px;">

							<div class="search_date_ALL date__picker" date_type="ALL" date="today"	type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="01d"	type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="03d"	type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="07d"	type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="15d"	type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="01m"	type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="03m"	type="button" onclick="searchDateClick(this);">3개월</div>
							<div class="search_date_ALL date__picker" date_type="ALL" date="01y"	type="button" onclick="searchDateClick(this);">1년</div>
						</div>
						
						<div class="content__date__picker">
							<input id="date_from_ALL" class="date_param_ALL" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="ALL" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="date_to_ALL" class="date_param_ALL" type="date" name="date_to" placeholder="To" readonly style="width:150px;" date_type="ALL" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품정보</div>
				<div class="content__row search_product_td" style="display:block;">
					<div class="row">
						<select class="fSelect eSearch search_product" name="search_product[]" style="width:163px;" onChange="searchTypeChange(this);">
							<option value="ALL" selected>상품정보 선택</option>
							<option value="code">상품 코드</option>
							<option value="name">상품 이름</option>
						</select>
						
						<input type="text" name="product_param[]" value="" style="width:60%;">
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="append" onclick="searchProductTypeBtnClick(this)">+</button>
						<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;cursor:pointer;" action_type="remove" onclick="searchProductTypeBtnClick(this)">-</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">배송업체</div>
					<div class="content__row">
						<select name="delivery_company" class="fSelect" style="width:163px;">
							<option value="ALL">배송업체 선택</option>
							<?php
								$sql = "SELECT
											IDX				AS DELIVERY_IDX,
											COMPANY_NAME	AS COMPANY_NAME
										FROM
											DELIVERY_COMPANY";
								$db->query($sql);
								foreach($db->fetch() as $data) {
							?>
							<option value="<?=$data['DELIVERY_IDX']?>"><?=$data['COMPANY_NAME']?></option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">배송 구분</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="delivery_type_ALL_ALL" class="radio__input" value="ALL" name="delivery_type" checked>
							<label for="delivery_type_ALL_ALL">전체</label>
							
							<input type="radio" id="delivery_type_KR_ALL" class="radio__input" value="KR" name="delivery_type">
							<label for="delivery_type_KR_ALL">국내 배송</label>
							
							<input type="radio" id="delivery_type_FR_ALL" class="radio__input" value="FR" name="delivery_type">
							<label for="delivery_type_FR_ALL">해외 배송</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card__body--hide detail_hidden" style="display: none;">
				<div class="content__wrap">
					<div class="content__title">멤버 레벨</div>
					<div class="content__row">
						<div class="rd__block">
							<select class="fSelect" name="member_level" style="width:163px;">
								<option value="ALL">전체등급</option>
								<?php
									$sql = "SELECT
												IDX		AS LEVEL_IDX,
												TITLE	AS TITLE
											FROM
												MEMBER_LEVEL";
									
									$db->query($sql);
									foreach($db->fetch() as $data) {
								?>
								<option value="<?=$data['LEVEL_IDX']?>"><?=$data['TITLE']?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">금액 조건</div>
						<div class="content__row">
							<select class="fSelect" name="price_type" style="width:163px;">
								<option value="ALL" selected>금액조건 선택</option>
								<option value="PRICE_PRODUCT">상품 총 가격</option>
								<option value="PRICE_MILEAGE_POINT">사용 적립 포인트</option>
								<option value="PRICE_CHARGE_POINT">사용 충전 포인트</option>
								<option value="PRICE_DISCOUNT">자체 할인가</option>
								<option value="PRICE_DELIVERY">배송비</option>
								<option value="PRICE_TOTAL">총 가격</option>
							</select>
							
							<input type="number" step="0.01" name="price_min" value="0" style="width:100px;">
							~
							<input type="number" step="0.01" name="price_max" value="0" style="width:100px;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">주문 상품 수량</div>
						<div class="content__row">
							<input type="number" name="qty_min" value="0" style="width:100px;">
							~
							<input type="number" name="qty_max" value="0" style="width:100px;">
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">결제수단</div>
						<div class="content__row">
							<select class="fSelect" name="pg_payment" style="width:163px;">
								<option value="ALL" selected>결제수단 선택</option>
								<option value="PRICE_PRODUCT">상품 총 가격</option>
								<option value="PRICE_MILEAGE">사용 적립금</option>
								<option value="PRICE_DISCOUNT">자체 할인가</option>
								<option value="PRICE_DELIVERY">배송비</option>
								<option value="PRICE_TOTAL">총 가격</option>
							</select>
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">할인 수단</div>
						<div class="content__row">
							<div class="cb__color">
								<label>
									<input type="checkbox" name="discount_type" value="mileage">
									<span>적립금</span>
								</label>
								
								<label>
									<input type="checkbox" name="discount_type" value="coupon">
									<span>쿠폰</span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div id="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getOrderInfoList('ORD_ALL');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list_ORD_ALL', 'getOrderInfoList')"><span>초기화</span></div>
				</div>
			</div>
		</div>
		<div class="hidden">
			<div class="excel__table__warp">
				<table id="excel_table_ORD_ALL">
					<thead id="excel_table_head_ORD_ALL">
					</thead>
					<tbody id="excel_result_table_ORD_ALL">
					</tbody>
				</table>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>전체 주문 검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-action-ORD_ALL">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count">0</font>건/검색결과 <font class="cnt_result info__count">0</font>건
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
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

			<div class="table table__wrap tabNum tabNum_01">
				<div class="table__filter">
					<div class="filrer__wrap" style="width:280px;">
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload('ORD_ALL', 'DF');">엑셀 다운로드(일반양식)</div>
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload('ORD_ALL', 'SL');">엑셀 다운로드(매출정보)</div>
					</div>
				</div>
				
				<div class="double__table__container">
					<div class="overflow-x-auto top__scroll">
						<TABLE id="result_table_ORD_ALL" style="min-width:100%;width:auto;">
							<colgroup>
								<col width="50px">
								<col width="50px">
								<col width="150px">
								<col width="100px">
								<col width="150px">
								<col width="150px">
								<col width="100px">
								<col width="100px">
								<col width="100px">
								<col width="100px">
								<col width="100px">
								<col width="100px">
								<col width="200px;">
							</colgroup>

							<THEAD>
								<TR>
									<TH>
										<div class="cb__color">
											<label>
												<input type="checkbox" value="">
												<span></span>
											</label>
										</div>
									</TH>
									<TH>쇼핑몰</TH>
									<TH>주문코드</TH>
									<TH>주문 상태</TH>
									<TH>주문일</TH>
									<TH>주문자</TH>
									<TH>상품<br/>총가격</TH>
									<TH>사용<br/>적립포인트</TH>
									<TH>사용<br/>충전포인트</TH>
									<TH>할인금액</TH>
									<TH>배송비</TH>
									<TH>총 결제금액</TH>
									<TH>현금영수증<br/>발행/취소</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
							</TBODY>
						</TABLE>
					</div>
				</div>	
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function() {
	//getOrderInfoList();
});
/*
function getOrderInfoList(order_status) {
	let frm = $('#frm-filter');
	
	let result_checkbox_table = $("#result_checkbox");
	let result_body = $(".result_table");

	result_checkbox_table.html('');
	result_body.html('');
	
	var strCheckboxDiv = '';
	strCheckboxDiv += '<TD class="checkbox_tr"></TD>';

	var strDiv = '';
	strDiv += '    <TD class="default_td marker_td" colspan="' + (14 + column_arr.length) + '" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	
	result_checkbox_table.append(strCheckboxDiv);
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging"),
		html : function(d) {			
			if (d != null) {
				
			}
			
			document.querySelectorAll('#frm-filter .marker_td').forEach(
			(el,idx)=>
				{	
					$('.checkbox_tr').eq(idx).css('height',el.offsetHeight);
				}
			);
		},
	},rows,1);
}
*/
</script>