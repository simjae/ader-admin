<div id="member_detail_ORD">
	<div class="content__card">
		<div class="card__body">
			<form id="frm-ORD" action="modal/order/get">
				<input type="hidden" name="country" value="<?=$country?>">
				<input type="hidden" name="member_idx" value="<?=$member_idx?>">
				
				<input type="hidden" class="sort_type" name="sort_type" value="DESC">
				<input type="hidden" class="sort_value" name="sort_value" value="OI.IDX">
				
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">
				
				<div class="card__header">
					<div class="card__header">
						<h3>전체 주문 검색</h3>
						<div class="drive--x"></div>
					</div>
				</div>
				<div class="card__body">
					<div class="content__wrap" style="align-items: start;">
						<div class="content__title">주문상태</div>
						<div class="content__row" style="display:block;">
							<div class="rd__block">
								<input type="radio" id="order_status_ORD_ALL_ALL" class="radio__input" value="ALL" name="order_status" checked>
								<label for="order_status_ORD_ALL_ALL">전체</label>
								
								<input type="radio" id="order_status_ORD_ALL_PCP" class="radio__input" value="PCP" name="order_status">
								<label for="order_status_ORD_ALL_PCP">결제완료</label>
								
								<input type="radio" id="order_status_ORD_ALL_PPR" class="radio__input" value="PPR" name="order_status">
								<label for="order_status_ORD_ALL_PPR">상품준비</label>

								<input type="radio" id="order_status_ORD_ALL_POP" class="radio__input" value="POP" name="order_status">
								<label for="order_status_ORD_ALL_POP">프리오더 준비</label>
								
								<input type="radio" id="order_status_ORD_ALL_POD" class="radio__input" value="POD" name="order_status">
								<label for="order_status_ORD_ALL_POD">프리오더 상품 생산</label>
								
								<input type="radio" id="order_status_ORD_ALL_DPR" class="radio__input" value="DPR" name="order_status">
								<label for="order_status_ORD_ALL_DPR">배송준비</label>

								<input type="radio" id="order_status_ORD_ALL_DPG" class="radio__input" value="DPG" name="order_status">
								<label for="order_status_ORD_ALL_DPG">배송중</label>
								
								<input type="radio" id="order_status_ORD_ALL_DCP" class="radio__input" value="DCP" name="order_status">
								<label for="order_status_ORD_ALL_DCP">배송완료</label>
							</div>
							
							<div class="rd__block" style="margin-top:15px;">
								<input type="radio" id="order_status_ORD_ALL_OC" class="radio__input" value="OC" name="order_status">
								<label for="order_status_ORD_ALL_OC">주문취소</label>
								
								<input type="radio" id="order_status_ORD_ALL_OE" class="radio__input" value="OE" name="order_status">
								<label for="order_status_ORD_ALL_OE">주문교환</label>
								
								<input type="radio" id="order_status_ORD_ALL_OR" class="radio__input" value="OR" name="order_status">
								<label for="order_status_ORD_ALL_OR">주문환불</label>
							</div>
						</div>
					</div>
					
					<div class="content__wrap ">
						<div class="content__title">검색어</div>
						<div class="content__row search_keyword_td" style="display:block;">
							<div class="row">
								<select class="fSelect search_keyword" name="search_keyword" style="width:163px;">
									<option value="ALL" selected>선택해주세요.</option>
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
								
								<input type="text" name="keyword_param" value="" style="width:40%;">
							</div>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">기간</div>
						<div class="content__row">
							<select class="fSelect" name="date_type" style="width:163px;" class="fSelect disabled">
								<option value="ALL" selected>선택해주세요.</option>
								<option value="order_date">주문일</option>
								<option value="delivery_start_date">배송 시작일</option>
								<option value="delivery_end_date">배송 종료일</option>
							</select>
							
							<div class="content__date__wrap">
								<div class="content__date__picker">
									<input id="date_from_ORD_ALL" class="date_param_ORD_ALL" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
										<font>~</font>
									<input id="date_to_ORD_ALL" class="date_param_ORD_ALL" type="date" name="date_to" placeholder="To" readonly style="width:150px;">
								</div>
							</div>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">상품정보</div>
						<div class="content__row search_product_td" style="display:block;">
							<div class="row">
								<select class="fSelect eSearch search_product" name="search_product" style="width:163px;">
									<option value="ALL" selected>상품정보 선택</option>
									<option value="code">상품 코드</option>
									<option value="name">상품 이름</option>
								</select>
								
								<input type="text" name="product_param" value="" style="width:40%;">
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
													dev.DELIVERY_COMPANY";
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
									<input type="radio" id="delivery_type_ORD_ALL_ALL" class="radio__input" value="ALL" name="delivery_type" checked>
									<label for="delivery_type_ORD_ALL_ALL">전체</label>
									
									<input type="radio" id="delivery_type_ORD_ALL_KR" class="radio__input" value="KR" name="delivery_type">
									<label for="delivery_type_ORD_ALL_KR">국내 배송</label>
									
									<input type="radio" id="delivery_type_ORD_ALL_FR" class="radio__input" value="FR" name="delivery_type">
									<label for="delivery_type_ORD_ALL_FR">해외 배송</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card__footer">
					<div class="footer__btn__wrap">
						<div id="detail_toggle" toggle="hide"></div>
						<div class="btn__wrap--lg">
							<div  class="blue__color__btn" onClick="getModalOrderInfo();"><span>검색</span></div>
							<div class="defult__color__btn" onClick="init_fileter('frm-ORD', 'getModalOrderInfo')"><span>초기화</span></div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="card__header">
			<h3>주문 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<form id="frm-list-ORD_ALL">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 <font class="cnt_ORD_total info__count">0</font>건/검색결과 <font class="cnt_ORD_result info__count">0</font>건
					</div>
						
					<div class="content__row">
						<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange_ORD(this);">
							<option value="OI.ORDER_DATE|DESC">주문일 역순</option>
							<option value="OI.ORDER_DATE|ASC">주문일 순</option>
							<option value="OI.PG_PRICE|DESC">결제금액 역순</option>
							<option value="OI.PG_PRICE|ASC">결제금액 순</option>
							<option value="OI.PRICE_PRODUCT|DESC">상품 총 가격 역순</option>
							<option value="OI.PRICE_PRODUCT|ASC">상품 총 가격 순</option>
							<option value="OI.PRICE_MILEAGE_POINT|DESC">사용 적립 포인트 역순</option>
							<option value="OI.PRICE_MILEAGE_POINT|ASC">사용 적립 포인트 순</option>
							<option value="OI.PRICE_CHARGE_POINT|DESC">사용 충전 포인트 역순</option>
							<option value="OI.PRICE_CHARGE_POINT|ASC">사용 충전 포인트 순</option>
							<option value="OI.PRICE_DISCOUNT|DESC">할인금액 역순</option>
							<option value="OI.PRICE_DISCOUNT|ASC">할인금액 순</option>
							<option value="OI.PRICE_DELIVERY|DESC">배송비 역순</option>
							<option value="OI.PRICE_DELIVERY|ASC">배송비 순</option>
							<option value="OI.PRICE_TOTAL|DESC">총 결제금액 역순</option>
							<option value="OI.PRICE_TOTAL|ASC">총 결제금액 순</option>
						</select>
						
						<select name="rows" style="width:163px;float:right;" onChange="rowsChange_ORD(this);">
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
					<div class="overflow-x-auto">
						<TABLE style="min-width:100%;width:auto;">
							<colgroup>
								<col width="50px;">
								<col width="150px;">
								<col width="100px;">
								<col width="150px;">
								<col width="100px;">
								<col width="150px;">
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
							</colgroup>
							<THEAD>
								<TR>
									<TH>쇼핑몰</TH>
									<TH>주문코드</TH>
									<TH>주문 상태</TH>
									<TH>주문일</TH>
									
									<TH>결제금액</TH>
									<TH>결제수단</TH>
									
									<TH>상품<br/>총가격</TH>
									<TH>사용<br/>적립포인트</TH>
									<TH>사용<br/>충전포인트</TH>
									<TH>할인금액</TH>
									<TH>배송비</TH>
									<TH>총 결제금액</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging_ORD(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging_ORD(this);">
					<div class="paging_ORD"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	getModalOrderInfo();
});


function getModalOrderInfo() {
	let frm = $('#frm-ORD');
	let result_body = $('#member_detail_ORD').find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_ORD"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					strDiv += '<tr>';
					strDiv += '    <TD>' + row.country + '</TD>';
					strDiv += '    <TD style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))">' + row.order_code + '</TD>';
					strDiv += '    <TD>' + row.order_status + '</TD>';
					strDiv += '    <TD>' + row.order_date + '</TD>';

					strDiv += '    <TD style="text-align:right;">' + row.pg_price + '</TD>';
					strDiv += '    <TD>' + row.pg_payment + '</TD>';

					strDiv += '    <TD style="text-align:right;">' + row.price_total + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.price_mileage_point + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.price_charge_point + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.price_discount + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.price_delivery + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.price_total + '</TD>';
					strDiv += '</tr>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD colspan="12" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}

function orderChange_ORD(obj) {	
	let frm = $('#frm-ORD');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getModalOrderInfo();
}

function rowsChange_ORD(obj) {
	let frm = $('#frm-ORD');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getModalOrderInfo();
}

function setPaging_ORD(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_ORD_total').text(total_cnt.val());
	$('.cnt_ORD_result').text(result_cnt.val());
}

</script>