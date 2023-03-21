<style>
.content__card.order__detail, .content__card.order__detail .card__body{height:100%}
.content__card.order__detail{display:flex;flex-direction:column;}
.content__card.order__detail .card__body{flex: 1;overflow-y:scroll; margin-top:40px;}
.order__detail .table__wrap .overflow-x-auto{white-space: nowrap;}
.move__btn__container{margin-top:10px;display:grid;grid-template-columns: repeat(8, 1fr);}
.btn__item.btn{text-align:center;height:50px;line-height : 34px;}
.order__detail__container{display:block}
.order__detail__item{padding-left:40px;padding-right:40px;}
.content__item{margin-top:50px;}
.content__item table{margin-top:20px;}
.balance__margin__area{height:70px;}
.order__product{width:100%;}
#order_payment_table{width:100%;}
#order_pm_method_table{width:100%;}
#order_order_member_table{width:100%;}
#order_to_member_table{min-width:650px;}
#order_delivery_table{width:100%}
.left-side{display:none;}
</style>

<?php
function getUrlParamter($url, $sch_tag) {
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$order_code = getUrlParamter($page_url, 'order_code');
?>

<input type="hidden" id="param_order_code" value="<?=$order_code?>">

<div class="content__card order__detail">
	<div class="card__hearder">
		<h3>주문 상세 정보</h3>
		
		<div class="move__btn__container">
			<div class="btn__item btn" onclick="moveInfoScroll('common')">주문 정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('product')">주문 상품</div>
			<div class="btn__item btn" onclick="moveInfoScroll('payment')">결제정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('vbank')">가상계좌 정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('member')">주문자 정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('delivery')">배송정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('to_member')">수령자 정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('memo')">주문 메모</div>
		</div>
	</div>
	
	<div class="card__body" style="margin-top:0px;">
		<div class="order__detail__container">
			<div class="order__detail__item">
				<div class="content__item">
					<h3>주문 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_common_table">
								<colgroup>
									<col width="100px;">
									<col width="auto;">
									<col width="auto;">
									<col width="100px;">
									<col width="200px;">
									<col width="200px;">
									<col width="200px;">
									<col width="200px;">
								</colgroup>
								<thead>
									<tr>
										<th>쇼핑몰 국가</th>
										<th>주문타이틀</th>
										<th>주문코드</th>
										<th>주문상태</th>
										<th>주문일자</th>
										<th>주문취소일</th>
										<th>주문 교환일</th>
										<th>주문 환불일</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="order_country"></td>
										<td id="order_title"></td>
										<td id="order_code"></td>
										<td id="order_status"></td>
										<td id="order_date"></td>
										<td id="cancel_date"></td>
										<td id="exchange_date"></td>
										<td id="refund_date"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="content__item">
					<h3>가격 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_common_table">
								<colgroup>
									<col width="16%;">
									<col width="16%;">
									<col width="16%;">
									<col width="16%;">
									<col width="16%;">
									<col width="20%;">
								</colgroup>
								<thead>
									<tr>
										<th>제품합계</th>
										<th>적립포인트</th>
										<th>충전포인트</th>
										<th>바우처</th>
										<th>배송비</th>
										<th>합계</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="price_product" style="text-align:right;"></td>
										<td id="price_mileage_point" style="text-align:right;"></td>
										<td id="price_charge_point" style="text-align:right;"></td>
										<td id="price_discount" style="text-align:right;"></td>
										<td id="price_delivery" style="text-align:right;"></td>
										<td id="price_total" style="text-align:right;"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="order__detail__item">
				<div class="content__item">
					<h3>상품 정보</h3>

					<div class="flex"style="gap:50px;margin:20px 0;" id="order_product_table">
						<div class="category__tab" order_status="all" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">주문 내역</div>
						<div class="category__tab" order_status="oc" style="height:30px;color:#707070;text-align:center;cursor:pointer;">취소</div>
						<div class="category__tab" order_status="oe" style="height:30px;color:#707070;text-align:center;cursor:pointer;">교환</div>
						<div class="category__tab" order_status="or" style="height:30px;color:#707070;text-align:center;cursor:pointer;">환불</div>
					</div>
					
					<div class="table__wrap order__product status__all">
						<div class="overflow-x-auto">
							<table id="order_product_table">
								<colgroup>
									<col width="width:200px;">
									<col width="width:150px;">
									<col width="width:auto;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
								</colgroup>
								<thead>
									<tr>
										<th>주문상품번호</th>
										<th>공급사</th>
										<th>상품이름/옵션</th>
										<th>주문수량</th>
										<th>상품판매가</th>
										<th>상품구매가</th>
										<th>주문상품상태</th>
									</tr>
								</thead>
								<tbody id="option_product_ALL">
									<td class="default_td" colspan="10">주문상품이 존재하지 않습니다.</td>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="table__wrap order__product status__oc hidden">
						<div class="overflow-x-auto">
							<table>
								<colgroup>
									<col width="width:200px;">
									<col width="width:150px;">
									<col width="width:auto;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
								</colgroup>
								<thead>
									<tr>
										<th>주문상품번호</th>
										<th>공급사</th>
										<th>상품이름/옵션</th>
										<th>주문수량</th>
										<th>상품판매가</th>
										<th>상품구매가</th>
										<th>주문상품상태</th>
									</tr>
								</thead>
								<tbody id="option_product_OC">
									<td class="default_td" colspan="10">주문상품이 존재하지 않습니다.</td>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="table__wrap order__product status__oe hidden">
						<div class="overflow-x-auto">
							<table>
								<colgroup>
									<col width="width:200px;">
									<col width="width:150px;">
									<col width="width:auto;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
								</colgroup>
								<thead>
									<tr>
										<th>주문상품번호</th>
										<th>공급사</th>
										<th>상품이름/옵션</th>
										<th>주문수량</th>
										<th>상품판매가</th>
										<th>상품구매가</th>
										<th>주문상품상태</th>
									</tr>
								</thead>
								<tbody id="option_product_OE">
									<td class="default_td" colspan="10">주문상품이 존재하지 않습니다.</td>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="table__wrap order__product status__or hidden">
						<div class="overflow-x-auto">
							<table>
								<colgroup>
									<col width="width:200px;">
									<col width="width:150px;">
									<col width="width:auto;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
									<col width="width:150px;">
								</colgroup>
								<thead>
									<tr>
										<th>주문상품번호</th>
										<th>공급사</th>
										<th>상품이름/옵션</th>
										<th>주문수량</th>
										<th>상품판매가</th>
										<th>상품구매가</th>
										<th>주문상품상태</th>
									</tr>
								</thead>
								<tbody id="option_product_OR">
									<td class="default_td" colspan="10">주문상품이 존재하지 않습니다.</td>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="order__detail__item">
				<div class="content__item">
					<h3>결제정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_payment_table">
								<colgroup>
									<col width="200px;">
									<col width="150px;">
									<col width="150px;">
									<col width="150px;">
									<col width="200px;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
								</colgroup>
								<thead>
									<tr>
										<th>결제일자</th>
										<th>결제수단</th>
										<th>결제상태</th>
										<th>결제통화</th>
										<th>결제가격</th>
										<th>결제ID</th>
										<th>결제지불키</th>
										<th>결제영수증URL</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="pg_date"></td>
										<td id="pg_payment"></td>
										<td id="pg_status"></td>
										<td id="pg_currency"></td>
										<td id="pg_price" style="text-align:right;"></td>
										<td id="pg_mid"></td>
										<td id="pg_payment_key"></td>
										<td id="pg_receipt_url"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order__detail__item">
				<div class="content__item">
					<h3>결제 가상계좌 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_vbank_table">
								<thead>
									<tr>
										<th>가상계좌 은행</th>
										<th>가상계좌 코드</th>
										<th>가상계좌 번호</th>
										<th>가상계좌 만료일</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="vbank_name"></td>
										<td id="vbank_account"></td>
										<td id="vbank_number"></td>
										<td id="vbank_due_date"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order__detail__item">
				<div class="content__item">
					<h3>주문자정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_member_table">
								<colgroup>
									<col width="200px">
									<col width="150px">
									<col width="150px">
									<col width="100px">
									<col width="200px">
									<col width="200px">
									<col width="100px">
									<col width="auto;">
									<col width="auto;">
								</colgroup>
								<thead>
									<tr>
										<th>ID</th>
										<th>멤버 이름</th>
										<th>멤버 레벨</th>
										<th>성별</th>
										<th>연락처</th>
										<th>이메일</th>
										<th>우편번호</th>
										<th>주소</th>
										<th>상세주소</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="member_id" style="cursor:pointer;text-decoration:underline;"></td>
										<td id="member_name" style="cursor:pointer;text-decoration:underline;"></td>
										<td id="member_level"></td>
										<td id="member_gender"></td>
										<td id="member_mobile"></td>
										<td id="member_email"></td>
										<td id="member_zipcode"></td>
										<td id="member_addr"></td>
										<td id="member_detail_addr"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order__detail__item">
				<div class="content__item">
					<h3>배송 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_delivery_table">
								<colgroup>
									<col width="150px;">
									<col width="200px;">
									<col width="200px;">
									<col width="150px;">
									<col width="250px;">
									<col width="200px;">
									<col width="200px;">
									<col width="200px;">
									<col width="auto;">
								</colgroup>
								<thead>
									<tr>
										<th>국내/외 배송</th>
										<th>배송업체명</th>
										<th>배송일자</th>
										<th>배송상태</th>
										<th>배송번호</th>
										<th>배송시작일</th>
										<th>배송종료일</th>
										<th>배송업체 연락처</th>
										<th>배송업체 이메일</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="delivery_type"></td>
										<td id="company_name"></td>
										<td id="delivery_date"></td>
										<td id="delivery_status"></td>
										<td id="delivery_num"></td>
										<td id="delivery_start_date"></td>
										<td id="delivery_end_date"></td>
										<td id="company_tel"></td>
										<td id="company_email"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order__detail__item">
				<div class="content__item">
					<h3>수령자 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="order_to_member_table">
								<colgroup>
									<col width="150px">
									<col width="200px">
									<col width="100px">
									<col width="auto;">
									<col width="auto;">
								</colgroup>
								<thead>
									<tr>
										<th>수령자 명</th>
										<th>연락처</th>
										<th>우편번호</th>
										<th>주소</th>
										<th>상세주소</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="to_name"></td>
										<td id="to_mobile"></td>
										<td id="to_zipcode"></td>
										<td id="to_addr"></td>
										<td id="to_detail_addr"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order__detail__item">
				<div class="content__item">
					<h3>주문 메모</h3>
					<div class="overflow-x-auto" id="order_memo_table">
						<textarea id="order_memo" style="resize:none;width:100%;min-height:200px;border:1px solid #dcdcdc;margin-top:20px;" disabled></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card_footer"></div>
</div>

<script>
$(document).ready(function(){
	getOrderDetailInfo();
})
function moveInfoScroll(str){
	$('.content__card.order__detail .card__body').animate({scrollTop : 0}, 0);
	let clickOffset = $(`#order_${str}_table`).position();
	$('.content__card.order__detail .card__body').animate({scrollTop : clickOffset.top - 240}, 0);
}

$('.category__tab').click(function() {	
	$('.category__tab').not($(this)).css('color','#707070');
	$('.category__tab').not($(this)).css('border-bottom','none');
	
	$(this).css('color','#140f82');
	$(this).css('border-bottom','3px solid #140f82');

	$('.order__product').addClass('hidden');
	$('.order__product.status__' + $(this).attr('order_status')).removeClass('hidden');
});

function getOrderDetailInfo(){
	let order_code = $('#param_order_code').val();
	
	if(order_code != null) {
		$.ajax({
			type: "post",
			url: config.api + "order/get",
			data : {
				'order_code' : order_code
			},
			dataType: "json",
			error: function() {
				alert("주문상세 조회처리에 실패했습니다.");
			},
			success: function(d) {
				if (d.code == 200) {
					let data = d.data;
					if (data != null) {
						let detail_link = "";
						if (data.country != null && data.member_idx != null) {
							detail_link = " javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=" + data.country + "&member_idx=" + data.member_idx + "\', \'회원상세 페이지\',\'width=#, height=#\')) ";
						}
						
						$('#order_country').text(data.txt_country);
						$('#order_title').text(data.order_title);
						$('#order_code').text(data.order_code);
						
						let oi_status = getOrderStatus(data.order_status);
						$('#order_status').text(oi_status);
						
						$('#order_date').text(data.order_date);
						$('#cancel_date').text(data.cancel_date);
						$('#exchange_date').text(data.exchange_date);
						$('#refund_date').text(data.refund_date);
						
						$('#price_product').text(data.price_product);
						$('#price_mileage_point').text(data.price_mileage_point);
						$('#price_charge_point').text(data.price_charge_point);
						$('#price_discount').text(data.price_discount);
						$('#price_delivery').text(data.price_delivery);
						$('#price_total').text(data.price_total);
						
						$('#option_product_ALL').html('');
						
						let order_product_info = data.order_product_info;
						let product_cnt = order_product_info.length;
						
						let str_oc_div = "";
						let str_oe_div = "";
						let str_or_div = "";
						
						order_product_info.forEach(function(row, idx){
							let order_code_td = '';
							let price_discount_td = '';
							let price_delivery_td = '';
							
							if(idx == 0){
								order_code_td = '<td rowspan=' + product_cnt + '>' + data.order_code + '</td>';
								price_discount_td = '<td rowspan=' + product_cnt + '>' + row.price_discount + '</td>';
								price_delivery_td = '<td rowspan=' + product_cnt + '>' + row.price_delivery + '</td>';
							}
							
							let op_status = getOrderStatus(row.order_status);
							let status_title = '';
							let status_date = '';
							
							let strDiv = "";
							strDiv += '<tr>';
							strDiv += '    ' + order_code_td;
							strDiv += '    <td>' + row.supplier + '</td>';
							strDiv += '    <td>';
							strDiv += '        <div class="product__img__wrap">';
							strDiv += '            <div class="product__img" style="background-image:url(\'' + row.img_location + '\');">';
							strDiv += '            </div>';
							strDiv += '            <div>';
							strDiv += '                <p>' + row.product_name + '</p><br>';
							strDiv += '                <p>' + row.option_name + '</p>';
							strDiv += '                <p>' + row.barcode + '</p>';
							strDiv += '            </div>';
							strDiv += '        </div>';
							strDiv += '    </td>';
							strDiv += '    <td>' + row.product_qty + '</td>';
							strDiv += '    <td style="text-align:right;">' + row.sales_price + '</td>';
							strDiv += '    <td style="text-align:right;">' + row.product_price + '</td>';
							strDiv += '    <td>' + op_status + '</td>';
							strDiv += '</tr>';
							
							console.log(row.order_status);
							
							if (row.order_status == "OCC") {
								str_oc_div += strDiv;
							} else if (row.order_status == "OEX" || row.order_status == "OEP") {
								str_oe_div += strDiv;
							} else if (row.order_Status == "ORF" || row.order_status == "ORP") {
								str_or_div += strDiv;
							}
							
							$('#option_product_ALL').append(strDiv);
						});
						
						if (str_oc_div.length > 0) {
							$('#option_product_OC').html('');
							$('#option_product_OC').append(str_oc_div);
						}
						
						if (str_oe_div.length > 0) {
							$('#option_product_OE').html('');
							$('#option_product_OE').append(str_oe_div);
						}
						
						if (str_or_div.length > 0) {
							$('#option_product_OR').html('');
							$('#option_product_OR').append(str_or_div);
						}
						
						$('#pg_date').text(data.pg_date);
						$('#pg_payment').text(data.pg_payment);
						$('#pg_status').text(data.pg_status);
						$('#pg_currency').text(data.pg_currency);
						$('#pg_price').text(data.pg_price);
						$('#pg_mid').text(data.pg_mid);
						$('#pg_payment_key').text(data.pg_payment_key);
						$('#pg_receipt_url').text(data.pg_receipt_url);
						
						$('#vbank_name').text(data.vbank_name);
						$('#vbank_account').text(data.vbank_account);
						$('#vbank_number').text(data.vbank_number);
						$('#vbank_due_date').text(data.vbank_due_date);
						
						$('#member_id').text(data.member_id);
						$('#member_id').attr('onClick',detail_link);
						$('#member_name').text(data.member_name);
						$('#member_name').attr('onClick',detail_link);
						$('#member_level').text(data.member_level);
						$('#member_gender').text(data.member_gender);
						$('#member_mobile').text(data.member_mobile);
						$('#member_email').text(data.member_email);
						$('#member_zipcode').text(data.member_zipcode);
						
						let member_addr = '';
						if (data.member_road_addr.length > 0 && data.member_road_addr != null) {
							member_addr = data.member_road_addr;
						} else{
							member_addr = data.member_lot_addr;
						}
						$('#member_addr').text(member_addr);
						$('#member_detail_addr').text(data.member_detail_addr);
						
						let delivery_type = '-'
						if(data.delivery_type == 'KR'){
							delivery_type = '국내배송';
						} else if(data.delivery_type != '-' && data.delivery_type != 'KR'){
							delivery_type = '해외배송';
						}

						let delivery_status = getDeliveryStatus(data.delivery_status);
						
						$('#company_name').text(data.company_name);
						$('#delivery_type').text(delivery_type);
						$('#delivery_date').text(data.delivery_date);
						$('#delivery_status').text(delivery_status);
						$('#delivery_num').text(data.delivery_num);
						$('#delivery_start_date').text(data.delivery_start_date);
						$('#delivery_end_date').text(data.delivery_end_date);
						$('#company_tel').text(data.company_tel);
						$('#company_email').text(data.company_email);

						$('#to_name').text(data.to_name);
						$('#to_mobile').text(data.to_mobile);
						$('#to_zipcode').text(data.to_zipcode);
						$('#to_addr').text(data.to_road_addr);
						$('#to_detail_addr').text(data.to_detail_addr);
						$('#order_memo').val(data.order_memo);
					}
				}
			}
		});
	}
	else{
		alert('잘못된 경로로 접근했습니다.',function(){
			location.href="list";
		});
	}
}

function getOrderStatus(param) {
	let order_status = "";
	switch (param) {
		case "PCP" :
			order_status = "결제완료";
			break;
		
		case "PPR" :
			order_status = "상품준비";
			break;
		
		case "POP" :
			order_status = "프리오더 준비";
			break;
		
		case "POD" :
			order_status = "프리오더 상품 생산";
			break;
		
		case "DPR" :
			order_status = "배송준비";
			break;
		
		case "DPG" :
			order_status = "배송중";
			break;
			
		case "DCP" :
			order_status = "배송완료";
			break;

		case "OCC" :
			order_status = "주문취소";
			break;
		
		case "OEX" :
			order_status = "주문교환";
			break;
		
		case "OEP" :
			order_status = "교환완료";
			break;
		
		case "ORF" :
			order_status = "주문환불";
			break;
		
		case "ORP" :
			order_status = "환불완료";
			break;
	}
	
	return order_status;
}

function getDeliveryStatus(param) {
	let delivery_status = "";
	switch (param) {
		case "DPR" :
			delivery_status = "배송준비";
			break;
		
		case "DPG" :
			delivery_status = "배송중";
			break;
		
		case "MRD" :
			delivery_status = "멤버 재배송";
			break;
		
		case "ARD" :
			delivery_status = "아더 재배송";
			break;
		
		case "DCP" :
			delivery_status = "배송완료";
			break;
	}
	
	return delivery_status;
}
</script>