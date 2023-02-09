<style>
.orderlist__tab__wrap {grid-column: 1/17;width: 950px;margin: 0 auto;}
.orderlist__tab__btn__container {grid-column: 1/17;margin: 0 auto;display: grid;gap: 10px;place-items: center;grid-template-columns: 50px 50px 50px 50px;}
.info__title {margin-right: 10px;}
.info__value {margin-right: 30px;}
.orderlist__wrap table {width: 100%;}
.contents__table {padding-top: 10px;}
.orderlist__wrap table td {padding-top: 0 !important;}
.order_status_box {border: 1px solid #343434;width: 56px;height: 23px;margin-left: 10px;padding: 5px 0;}
.title_orderlist_info {font-size: 13px;line-height: 1.15;margin-bottom: 10px;margin: 0;}
.list_orderlist_info p {font-size: 11px;margin-top: 10px;white-space: nowrap;}
.list_orderlist_info .underline {margin-left: 7px;}
.orderlist__tab__contents .title {margin-bottom: 0;}
.oderlist_info_table .contents__table td {padding: 0;}
.oderlist_payment_info {display: flex;justify-content: space-between;}
.oderlist_payment_info p{font-size: 11px;margin-bottom: 10px;}
.oderlist_payment_info_border {border-top: 1px solid #dcdcdc;border-bottom: 1px solid #dcdcdc;margin:10px 0;padding-top: 10px;}

@media (max-width: 1024px) {
	.orderlist__tab__wrap {width: 100%;}
	.orderlist__tab__btn__container {grid-column: 1/17;}
	.orderlist__tab__contents {width: 100%;}
	.contents__info .info span {font-size: 10px;}
	.oderlist_info_table {margin-top: 30px;display: flex;flex-direction: column;align-items: center;}
	.orderlist__wrap {margin-top: 20px;width: 100%;display: grid;grid-template-columns: repeat(16, 1fr);}
	.orderlist__tab__contents {margin: 0 auto;grid-column: 1/17;padding-top: 30px;padding-bottom: 20px;}
}

@media (min-width: 600px) {
	.orderlist__tab__wrap {grid-column: 1/17;width: 580px;margin: 0 auto;}
}

@media (min-width: 1024px) {
	.orderlist__wrap {margin-top: 40px;width: 100%;display: grid;grid-template-columns: repeat(16, 1fr);}
	.orderlist__tab__wrap {width: 100%;}
	.oderlist_info_table {margin-top: 40px;display: grid;grid-template-columns: 600px 350px;}
	.orderlist__tab__contents {margin: 0 auto;grid-column: 1/17;padding-top: 50px;padding-bottom: 50px;}
}

.orderlist__wrap .detail__btn {cursor : pointer;}
.mypage--paging {gap: 10px;}
.mypage--paging .page {font-size: 11px;cursor: pointer;}
.product_name_mob {white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 68px;}
.product_info_mob {vertical-align: top;}
.product_info_mob p {margin-bottom: 6px;}
.orderlist__wrap .delivery_num {text-decoration: underline;font-size: 10px;width: 110px;cursor: pointer;}
</style>

<div class="orderlist__wrap">
	<div class="orderlist__tab__btn__container">
		<div class="tab__btn__item" action-type="ALL" onclick="viewOrderList(this)">
			<span>주문</span>
		</div>
		
		<div class="tab__btn__item" action-type="OC" onclick="viewOrderList(this)">
			<span>취소</span>
		</div>
		
		<div class="tab__btn__item" action-type="OE" onclick="viewOrderList(this)">
			<span>교환</span>
		</div>
		
		<div class="tab__btn__item" action-type="OR" onclick="viewOrderList(this)">
			<span>반품</span>
		</div>
	</div>
	
	<input id="param_status" type="hidden" value="ALL">
	
	<div class="orderlist__tab__wrap tab_ALL">
		<div class="order__list order_list_ALL">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">
				
			<div class="pc__view  w_view_ALL"></div>
			<div class="mobile__view m_view_ALL"></div>
			
			<div class="orderlist__paging"></div>
		</div>
		
		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_ALL"></div>
			<div class="mobile__view m_detail_view_ALL"></div>
		</div>
	</div>
	
	<div class="orderlist__tab__wrap tab_OC" style="display:none;">
		<div class="order__list order_list_OC">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">
				
			<div class="pc__view w_view_OC"></div>
			<div class="mobile__view m_view_OC"></div>
			
			<div class="orderlist__paging"></div>
		</div>
		
		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OC"></div>
			<div class="mobile__view m_detail_view_OC"></div>
		</div>
	</div>
	
	<div class="orderlist__tab__wrap tab_OE" style="display:none;">
		<div class="order__list order_list_OE">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">
			
			<div class="pc__view w_view_OE"></div>
			<div class="mobile__view m_view_OE"></div>
			
			<div class="orderlist__paging"></div>
		</div>
		
		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OE"></div>
			<div class="mobile__view m_detail_view_OE"></div>
		</div>
	</div>
	
	<div class="orderlist__tab__wrap tab_OR" style="display:none;">
		<div class="order__list order_list_OR">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">
			
			<div class="pc__view w_view_OR"></div>
			<div class="mobile__view m_view_OR"></div>
			
			<div class="orderlist__paging"></div>
		</div>
		
		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OR"></div>
			<div class="mobile__view m_detail_view_OR"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	getOrderInfoList('ALL');
	getOrderInfoList('OC');
	getOrderInfoList('OE');
	getOrderInfoList('OR');
});

function viewOrderList(obj) {
	// let param_status = $('#param_status').val();
	let action = $(obj).attr('action-type');
	$('#param_status').val(action);
	$('.orderlist__tab__wrap').hide();
	//$('.orderlist__tab').hide();
	$('.tab_' + action).show();
	$('.order_list_' + action).show();
}

function viewDetailOrder(order_idx) {
	let now = $('#param_status').val();
	$('.order_list_' + now).hide();
	$('.order__detail').show();
	
	getOrderInfo(order_idx);
}

function getOrderInfoList(order_status) {
	$('#param_status').val(order_status);
	
	$.ajax({
		type: "post",
		url: "http://116.124.128.246:80/_api/mypage/order/list/get",
		data:{
			'order_status' : order_status
		},
		dataType: "json",
		error: function(d) {
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					setOrderInfoList(order_status,data);
					setOrderInfoListM(order_status,data);
				}
			}
		}
	});
}

function setOrderInfoList(param_status,data) {
	let order_list = $('.order_list_' + param_status);
	
	let div_list_pc = $('.w_view_' + param_status);
	div_list_pc.html('');
	
	let rows = order_list.find('input[name="rows"]').val();
	let page = order_list.find('input[name="page"]').val();
	
	let str_div = "";
	let slicedData = data.slice(parseInt(page - 1) * rows, rows * page);
	slicedData.forEach(function(row) {
		str_div += '<div class="orderlist__tab__contents">';
		str_div += '    <div class="contents__info">';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문번호</span>';
		str_div += '            <span class="info__value order__code">' + row.order_code + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문일</span>';
		str_div += '            <span class="info__value">' + row.order_date + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="detail__btn" onclick="viewDetailOrder(' + row.order_idx + ')"><span>자세히보기</span></div>';
		str_div += '    </div>';
		str_div += '    <div class="contents__table">';
		str_div += '        <table>';
		str_div += '            <colsgroup>';
		str_div += '                <col style="width:120px;">';
		str_div += '                <col style="width:240px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:120px;">';
		str_div += '            </colsgroup>';
		str_div += '            <tbody>';
		
		let order_product = row.order_product;
		order_product.forEach(function(product) {
			let order_status = product.order_status;
			let txt_order_status = getOrderStatus(order_status);
			
			let order_btn = "";
			let order_cancel_msg = "";
			
			let display = "";
			if (order_status == "PCP" || order_status == "POP" || order_status == "PPR") {
				display = "flex";
				order_btn = '<button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'' + order_status + '\')">주문취소</button>';
				order_cancel_msg = '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>';
			} else if (order_status == "DPR" || order_status == "DPG") {
				display = "block";
				order_btn = '<div class="delivery_num" style="margin-top:10px;"><p style="margin-bottom:3px;">' + row.company_name + '</p><p>652013628816</p></div>';
			} else if (order_status == "DCP" && row.update_flg == 'FALSE') {
				order_btn = '<button class="order_status_box" onclick="">반품접수</button>';
			}
			
			str_div += '        <tr id="order_product_' + product.order_product_idx + '">';
			str_div += '            <td>';
			str_div += '                <img src=' + img_root + product.img_location + ' style="cursor: default;">';
			str_div += '            </td>';
			str_div += '            <td><p>' + product.product_name + '</p></td>';
			str_div += '            <td>';
			str_div += '                <div class="color_wrap">';
			str_div += '                    <p>' + product.color + '</p>';
			str_div += '                    <div class="color_chip" style="background-color: ' + product.color_rgb + '"></div>';
			str_div += '                </div>';
			str_div += '            </td>';
			str_div += '            <td><p>' + product.option_name + '</p></td>';
			str_div += '            <td><p>Qty: ' + product.product_qty + '</p></td>';
			str_div += '            <td><p>' + product.product_price.toLocaleString('ko-KR') + '</p></td>';
			str_div += '            <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
			str_div += '                <div style="padding-bottom:13px;">';
			str_div += '                    <div style="display:' + display + ';align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
			str_div += '                    ' + order_cancel_msg;
			str_div += '                </div>';
			str_div += '            </td>'
			str_div += '        <tr>';
		});
		
		str_div += '            </tbody>';
		str_div += '        </table>';
		str_div += '    </div>';
		str_div += '</div>';
	});
	
	div_list_pc.append(str_div);
	
	// $('.orderlist__tab__wrap').hide();
	// $('.tab_' + param_status).show();
	
	let totalCnt = data.length;
	let showing_page = Math.ceil(totalCnt/rows);
	
	orderListPaging({
		total: totalCnt,
		el: order_list.find('.orderlist__paging'),
		page: page,
		row: rows,
		show_paging: showing_page,
		use_form: order_list
	});
}

function setOrderInfoListM(param_status,data) {
	let order_list = $('.order_list_' + param_status);
	
	let div_list_mobile = $('.m_view_' + param_status);
	div_list_mobile.html('');
	
	let rows = order_list.find('input[name="rows"]').val();
	let page = order_list.find('input[name="page"]').val();
	
	let str_div = "";
	
	let slicedData = data.slice(parseInt(page - 1) * rows, rows * page);
	slicedData.forEach(function(row) {
		str_div += '<div class="orderlist__tab__contents">';
		str_div += '    <div class="contents__info">';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문번호</span>';
		str_div += '            <span class="info__value order__code">' + row.order_code + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문일</span>';
		str_div += '            <span class="info__value">' + row.order_date + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="detail__btn" onclick="viewDetailOrder(' + row.order_idx + ')"><span>자세히보기</span></div>';
		str_div += '    </div>';
		str_div += '    <div class="contents__table">';
		str_div += '        <table>';
		str_div += '            <colsgroup>';
		str_div += '                <col style="width:27%;">';
		str_div += '                <col style="width:27%;">';
		str_div += '                <col style="width:16%;">';
		str_div += '                <col style="width:30%;">';
		str_div += '            </colsgroup>';
		str_div += '            <tbody>';
		
		let order_product = row.order_product;
		order_product.forEach(function(product) {
			let order_status = product.order_status;
			let txt_order_status = getOrderStatus(order_status);
			
			let order_btn = "";
			let order_cancel_msg = "";
			
			if (order_status == "PCP" || order_status == "POP" || order_status == "POP") {
				order_btn = '<button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'' + order_status + '\')">주문취소</button>';
				order_cancel_msg = '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>';
			} else if (order_status == "DPR" || order_status == "DCP") {
				order_btn = '<p class="delivery_num">' + row.company_name + '<br>' + row.row.delivery_num + '</p>';
			}
			
			str_div += '        <tr id="order_product_' + product.order_product_idx + '_m">';
			str_div += '            <td>';
			str_div += '                <img src=' + img_root + product.img_location + ' style="cursor: default;">';
			str_div += '            </td>';
			str_div += '            <td class="product_info_mob">';
			str_div += '                <p class="product_name_mob">' + product.product_name + '</p>';
			str_div += '                <p>' + product.product_price + '</p>';
			str_div += '                <div class="color_wrap">';
			str_div += '                    <p>' + product.color + '</p>';
			str_div += '                    <div class="color_chip" style="background-color: ' + product.color_rgb + '"></div>';
			str_div += '                </div>';
			str_div += '                <p>' + product.option_name + '</p>';
			str_div += '            </td>';
			str_div += '            <td>';
			str_div += '                <p>Qty: ' + product.product_qty + '</p>';
			str_div += '            </td>';
			str_div += '            <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">';
			str_div += '                <div style="padding-bottom:13px;">';
			str_div += '                    <div style="display:flex;align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
			str_div += '                ' + order_cancel_msg;
			str_div += '                </div>';
			str_div += '            </td>';
			str_div += '        </tr>';
		});
		
		str_div += '            </tbody>';
		str_div += '        </table>';
		str_div += '    </div>';
		str_div += '</div>';
	});
	
	div_list_mobile.append(str_div);
	
	// $('.orderlist__tab__wrap').hide();
	// $('.tab_' + param_status).show();
	
	let totalCnt = data.length;
	let showing_page = Math.ceil(totalCnt/rows);
	
	orderListPaging({
		total: totalCnt,
		el: order_list.find('.orderlist__paging'),
		page: page,
		row: rows,
		show_paging: showing_page,
		use_form: order_list
	});
}

function putOrderInfo(order_idx,order_product_idx,order_status) {
	let confirm_msg = "";
	if (order_status == "PCP") {
		confirm_msg = "선택한 주문을 취소하시겠습니까?";
	}
	
	if (confirm(confirm_msg) == true) {
		$.ajax({
			type: "post",
			url: "http://116.124.128.246:80/_api/mypage/order/put",
			data: {
				'order_idx' : order_idx,
				'order_product_idx' : order_product_idx,
				'order_status' : order_status,
			},
			dataType: "json",
			error: function(d) {
				alert('주문 상태변경 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					getOrderInfoByIdx(order_idx,order_product_idx);
				} else {
					exceptionHandling("디자인 필요",d.msg);
				}
			}
		});
	}
}

function getOrderInfoByIdx(order_idx,order_product_idx) {
	let div_order_product = $('#order_product_' + order_product_idx);
	let div_order_product_m = $('#order_product_' + order_product_idx + '_m');
	let div_order_product_d = $('#order_product_' + order_product_idx + '_detail');
	let div_order_product_m_d = $('#order_product_' + order_product_idx + '_m_detail');

	div_order_product.html('');
	div_order_product_m.html('');
	div_order_product_d.html('');
	div_order_product_m_d.html('');
	
	$.ajax({
		type: "post",
		url: "http://116.124.128.246:80/_api/mypage/order/product/get",
		data:{
			'order_idx' : order_idx,
			'order_product_idx' : order_product_idx
		},
		dataType: "json",
		error: function(d) {
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					let str_div = "";
					let str_div_m = "";
					data.forEach(function(row) {
						let order_status = row.order_status;
						let txt_order_status = getOrderStatus(order_status);

						let order_btn = "";
						
						// let display = "";
						// if (order_status == "PCP" || order_status == "POP" || order_status == "PPR") {
						// 	display = "flex";
						// 	order_btn = '<button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + row.order_product_idx + ',\'' + order_status + '\');">주문취소</button>';
						// 	order_cancel_msg = '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>';
						// } else if (order_status == "DPR" || order_status == "DPG") {
						// 	display = "block";
						// 	order_btn = '<div class="delivery_num" style="margin-top:10px;"><p style="margin-bottom:3px;">' + row.company_name + '</p><p>652013628816</p></div>';
						// } else if (order_status == "DCP" && row.update_flg == 'FALSE') {
						// 	order_btn = '<button class="order_status_box" onclick="">반품접수</button>';
						// }

						str_div_m += '    <td>';
						str_div_m += '        <img src=' + img_root + row.img_location + ' style="cursor: default;">';
						str_div_m += '    </td>';
						str_div_m += '    <td class="product_info_mob">';
						str_div_m += '        <p class="product_name_mob">' + row.product_name + '</p>';
						str_div_m += '        <p>' + row.product_price + '</p>';
						str_div_m += '        <div class="color_wrap">';
						str_div_m += '            <p>' + row.color + '</p>';
						str_div_m += '            <div class="color_chip" style="background-color: ' + row.color_rgb + '"></div>';
						str_div_m += '        </div>';
						str_div_m += '        <p>' + row.option_name + '</p>';
						str_div_m += '    </td>';
						str_div_m += '    <td>';
						str_div_m += '        <p>Qty: ' + row.product_qty + '</p>';
						str_div_m += '    </td>';
						str_div_m += '    <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">';
						str_div_m += '        <div style="padding-bottom:13px;">';
						str_div_m += '            <div style="display:flex;align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
						str_div_m += '        </div>';
						str_div_m += '    </td>';

						str_div += '            <td>';
						str_div += '                <img src=' + img_root + row.img_location + ' style="cursor: default;">';
						str_div += '            </td>';
						str_div += '            <td><p>' + row.product_name + '</p></td>';
						str_div += '            <td>';
						str_div += '                <div class="color_wrap">';
						str_div += '                    <p>' + row.color + '</p>';
						str_div += '                    <div class="color_chip" style="background-color: ' + row.color_rgb + '"></div>';
						str_div += '                </div>';
						str_div += '            </td>';
						str_div += '            <td><p>' + row.option_name + '</p></td>';
						str_div += '            <td><p>Qty: ' + row.product_qty + '</p></td>';
						str_div += '            <td><p>' + row.product_price.toLocaleString('ko-KR') + '</p></td>';
						str_div += '            <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
						str_div += '                <div style="padding-bottom:13px;">';
						str_div += '                    <div style="display:flex;align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>';
						str_div += '                </div>';
						str_div += '            </td>'
					});
					div_order_product.append(str_div);
					div_order_product_m.append(str_div_m);
					div_order_product_d.append(str_div);
					div_order_product_m_d.append(str_div);
				}
			}
		}
	});
}

function getOrderInfo(order_idx) {
	$.ajax({
		type: "post",
		data:{
			"order_idx": order_idx
		},
		dataType: "json",
		url: "http://116.124.128.246:80/_api/mypage/order/get",
		error: function(d) {
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					setOrderInfo(data);
					setOrderInfoM(data);
				}
			}
		}
	});
}

function setOrderInfo(data) {
	let param_status = $('#param_status').val();
	
	let div_list_pc = $('.w_detail_view_' + param_status);
	div_list_pc.html('');
	
	let str_div = "";
	data.forEach(function(row) {
		str_div += '<div class="orderlist__tab__contents">';
		str_div += '    <div class="title" style="margin-bottom: 30px;">';
		str_div += '        <p>주문 상세</p>';
		str_div += '    </div>';
		str_div += '    <div class="contents__info">';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문번호</span>';
		str_div += '            <span class="info__value">' + row.order_code + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문일</span>';
		str_div += '            <span class="info__value">' + row.order_date + '</span>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '    <div class="contents__table" style="margin-top: 9.5px !important;">';
		str_div += '        <table>';
		str_div += '            <colsgroup>';
		str_div += '                <col style="width:120px;">';
		str_div += '                <col style="width:240px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:130px;">';
		str_div += '                <col style="width:120px;">';
		str_div += '            </colsgroup>';
		str_div += '            <tbody>';
		
		let order_product = row.order_product;
		order_product.forEach(function(product) {
			let order_status = product.order_status;
			let txt_order_status = getOrderStatus(order_status);
			
			let order_btn = "";
			let order_cancel_msg = "";
			
			if (order_status == "PCP" || order_status == "POP" || order_status == "POP") {
				order_btn = '<button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'' + order_status + '\')">주문취소</button>';
				order_cancel_msg = '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>';
			} else if (order_status == "DPR" || order_status == "DCP") {
				order_btn = '<p class="delivery_num">' + row.company_name + '<br>652013628816</p>';
			}
			
			str_div += '             <tr id="order_product_' + product.order_product_idx + '_detail">';
			str_div += '                 <td>';
			str_div += '                     <img src=' + img_root + product.img_location + ' style="cursor: default;">';
			str_div += '                 </td>';
			str_div += '                 <td>';
			str_div += '                     <p>' + product.product_name + '</p>';
			str_div += '                 </td>';
			str_div += '                 <td>';
			str_div += '                     <div class="color_wrap">';
			str_div += '                         <p>' + product.color + '</p>';
			str_div += '                         <div class="color_chip" style="background-color: ' + product.color_rgb + '"></div>';
			str_div += '                     </div>';
			str_div += '                 </td>';
			str_div += '                 <td>';
			str_div += '                     <p>' + product.option_name + '</p>';
			str_div += '                 </td>';
			str_div += '                 <td>';
			str_div += '                     <p>Qty: ' + product.product_qty + '</p>';
			str_div += '                 </td>';
			str_div += '                 <td>';
			str_div += '                     <p>' + product.product_price + '</p>';
			str_div += '                 </td>';
			str_div += '                 <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">';
			str_div += '                     <div style="padding-bottom:13px;">';
			str_div += '                         <div style="display:flex;align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
			str_div += '                     ' + order_cancel_msg;
			str_div += '                     </div>';
			str_div += '                 </td>';
			str_div += '             </tr>';
		});
		
		str_div += '             </tbody>';
		str_div += '        </table>';
		str_div += '    </div>';
		str_div += '    <div class="oderlist_info_table">';
		str_div += '        <div style="width:350px;">';
		str_div += '            <div class="title">';
		str_div += '                <p>배송정보</p>';
		str_div += '            </div>';
		str_div += '            <div class="contents__table">';
		str_div += '                <p>' + row.member_name + '</p>';
		str_div += '                <p>' + row.member_mobile + '</p>';
		str_div += '                <p>(' + row.to_zipcode + ')' + row.to_addr + ' ' + row.to_detail_addr + '</p>';
		str_div += '                <p>' + row.order_memo + '</p>';
		str_div += '            </div>';
		str_div += '        </div>';
		str_div += '        <div style="width:350px;">';
		str_div += '            <div class="title">';
		str_div += '                <p>결제정보</p>';
		str_div += '            </div>';
		str_div += '            <div class="oderlist_payment_info_border">';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>제품합계</p>';
		str_div += '                    <p>' + row.price_product.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>배송비</p>';
		str_div += '                    <p>' + row.price_delivery.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>바우처</p>';
		str_div += '                    <p>' + row.price_discount.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>적립포인트</p>';
		str_div += '                    <p>' + row.price_charge_point.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '            </div>';
		str_div += '            <div class="oderlist_payment_info" style="margin-top: 9.5px;">';
		str_div += '                <p>합계</p>';
		str_div += '                <p>' + row.price_total.toLocaleString('ko-KR') + '</p>';
		str_div += '            </div>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '    <div style="width:600px; margin-top: 90px;">';
		str_div += '        <div class="title_orderlist_info">';
		str_div += '            <p>주문 취소 안내</p>';
		str_div += '        </div>';
		str_div += '        <div class="list_orderlist_info">';
		str_div += '            <p>·&nbsp;주문 접수 및 결제 완료 단계: 주문내역에서 취소 가능합니다.</p>';
		str_div += '            <p>·&nbsp;배송 준비중 이후 단계: 주문취소 불가하며, 제품 수령 후 반품 진행 부탁드립니다.</p>';
		str_div += '        </div>';
		str_div += '        <div class="title_orderlist_info" style="margin-top: 50px !important;">';
		str_div += '            <p>반품 안내</p>';
		str_div += '        </div>';
		str_div += '        <div class="list_orderlist_info">';
		str_div += '            <p>·&nbsp;반품 접수는 제품 수령 후 7일 이내 가능합니다.</p>';
		str_div += '            <p>·&nbsp;주문 상태가 배송 완료일 경우 주문내역에서 반품 접수가능하며, 배송중으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍니다.</p>';
		str_div += '            <p class="underline">교환 및 반품 안내 바로 가기</p>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '</div>';
	});
	
	div_list_pc.append(str_div);
}

function setOrderInfoM(data) {
	let param_status = $('#param_status').val();
	
	let div_list_mobile = $('.m_detail_view_' + param_status);
	div_list_mobile.html('');
	
	let str_div;
	data.forEach(function(row) {
		str_div += '<div class="orderlist__tab__contents">';
		str_div += '    <div class="title" style="margin-bottom: 30px;">';
		str_div += '        <p>주문 상세</p>';
		str_div += '    </div>';
		str_div += '    <div class="contents__info">';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문번호</span>';
		str_div += '            <span class="info__value">' + row.order_code + '</span>';
		str_div += '        </div>';
		str_div += '        <div class="info">';
		str_div += '            <span class="info__title">주문일</span>';
		str_div += '            <span class="info__value">' + row.order_date + '</span>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '    <div class="contents__table" style="margin-top: 9.5px !important;">';
		str_div += '        <table>';
		str_div += '            <colsgroup>';
		str_div += '                <col style="width:27%;">';
		str_div += '                <col style="width:27%;">';
		str_div += '                <col style="width:16%;">';
		str_div += '                <col style="width:30%;">';
		str_div += '            </colsgroup>';
		str_div += '            <tbody>';
		
		let order_product = row.order_product;
		order_product.forEach(function(product) {
			let order_status = product.order_status;
			let txt_order_status = getOrderStatus(order_status);
			
			let order_btn = "";
			let order_cancel_msg = "";
			
			if (order_status == "PCP" || order_status == "POP" || order_status == "POP") {
				order_btn = '<button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'' + order_status + '\')">주문취소</button>';
				order_cancel_msg = '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>';
			} else if (order_status == "DPR" || order_status == "DCP") {
				order_btn = '<p class="delivery_num">' + row.company_name + '<br>652013628816</p>';
			}
			
			str_div += '            <tr id="order_product_' + product.order_product_idx + '_m_detail">';
			str_div += '                <td>';
			str_div += '                    <img src=' + img_root + product.img_location + ' style="cursor: default;">';
			str_div += '                </td>';
			str_div += '                <td class="product_info_mob">';
			str_div += '                    <p class="product_name_mob">' + product.product_name + '</p>';
			str_div += '                    <p>' + product.product_price.toLocaleString('ko-KR') + '</p>';
			str_div += '                    <div class="color_wrap">';
			str_div += '                        <p>' + product.color + '</p>';
			str_div += '                        <div class="color_chip" style="background-color: ' + product.color_rgb + '"></div>';
			str_div += '                    </div>';
			str_div += '                    <p>' + product.option_name + '</p>';
			str_div += '                </td>';
			str_div += '                <td>';
			str_div += '                    <p>Qty: ' + product.product_qty + '</p>';
			str_div += '                </td>';
			str_div += '                <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">';
			str_div += '                    <div style="padding-bottom:13px;">';
			str_div += '                        <div style="display:flex;align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
			str_div += '                    ' + order_cancel_msg;
			str_div += '                    </div>';
			str_div += '                </td>';
			str_div += '            </tr>';
		});
		
		str_div += '            </tbody>';
		str_div += '        </table>';
		str_div += '    </div>';
		
		str_div += '    <div class="oderlist_info_table">';
		str_div += '        <div style="width:100%;">';
		str_div += '            <div class="title">';
		str_div += '                <p>배송정보</p>';
		str_div += '            </div>';
		str_div += '            <div class="contents__table">';
		str_div += '                <p>' + row.member_name + '</p>';
		str_div += '                <p>' + row.member_mobile + '</p>';
		str_div += '                <p>(' + row.to_zipcode + ')' + row.to_addr + ' ' + row.to_detail_addr + '</p>';
		str_div += '                <p>' + row.order_memo + '</p>';
		str_div += '            </div>';
		str_div += '        </div>';
		str_div += '        <div style="width:100%; margin-top:20px;">';
		str_div += '            <div class="title">';
		str_div += '                <p>결제정보</p>';
		str_div += '            </div>';
		str_div += '            <div class="oderlist_payment_info_border">';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>제품합계</p>';
		str_div += '                    <p>' + row.price_product.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>배송비</p>';
		str_div += '                    <p>' + row.price_delivery.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>바우처</p>';
		str_div += '                    <p>' + row.price_discount.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '                <div class="oderlist_payment_info">';
		str_div += '                    <p>적립포인트</p>';
		str_div += '                    <p>' + row.price_charge_point.toLocaleString('ko-KR') + '</p>';
		str_div += '                </div>';
		str_div += '            </div>';
		str_div += '            <div class="oderlist_payment_info" style="margin-top: 9.5px;">';
		str_div += '                <p>합계</p>';
		str_div += '                <p>' + row.price_total.toLocaleString('ko-KR') + '</p>';
		str_div += '            </div>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '    <div style="width:100%; margin-top: 40px;">';
		str_div += '        <div class="title_orderlist_info">';
		str_div += '            <p>주문 취소 안내</p>';
		str_div += '        </div>';
		str_div += '        <div class="list_orderlist_info">';
		str_div += '            <p>·&nbsp;주문 접수 및 결제 완료 단계: 주문내역에서 취소 가능합니다.</p>';
		str_div += '            <p>·&nbsp;배송 준비중 이후 단계: 주문취소 불가하며,<br>&nbsp;&nbsp;제품 수령 후 반품 진행 부탁드립니다.</p>';
		str_div += '        </div>';
		str_div += '        <div class="title_orderlist_info" style="margin-top: 30px !important;">';
		str_div += '            <p>반품 안내</p>';
		str_div += '        </div>';
		str_div += '        <div class="list_orderlist_info">';
		str_div += '            <p>·&nbsp;반품 접수는 제품 수령 후 7일 이내 가능합니다.</p>';
		str_div += '            <p>·&nbsp;주문 상태가 배송 완료일 경우 주문내역에서 반품 접수가능하며,<br>&nbsp;&nbsp;배송중으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍니다.</p>';
		str_div += '            <p class="underline">교환 및 반품 안내 바로 가기</p>';
		str_div += '        </div>';
		str_div += '    </div>';
		str_div += '</div>';
	});
	
	div_list_mobile.append(str_div);
}

function getOrderStatus(param_status) {
	let order_status = "";
	switch (param_status) {
		case "PCP" :
			order_status = "결제완료";
			break;
		
		case "PPR" || "POP" || "POD" :
			order_status = "상품준비";
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

function orderListPaging(obj) {
	if(typeof obj != 'object' || 'total' in obj == false || 'el' in obj == false) {
		return;
	}
	
	if ('page' in obj == false) {
		obj.page = 1;
	}
	
	if ('row' in obj == false) {
		obj.row = 5;
	}
	
	if ('show_paging' in obj == false) {
		obj.show_paging = 4;
	}

	let total_page = Math.ceil(obj.total / obj.row);

	// 이전 페이징
	let prev = obj.page - obj.show_paging;
	if(prev < 1) {
		prev = 1;
	}
	
	// 다음 페이징
	let next = obj.page + obj.show_paging;
	if (next > total_page) {
		next = total_page;
	}
	
	// 페이지 시작 번호
	let start = obj.page - Math.ceil(obj.show_paging / 2) + 1;
	if (start < 1) {
		start = 1;
	}
	
	// 페이지 끝 번호
	let end = start + obj.show_paging - 1;
	if (end > total_page) {
		end = total_page;
		start = end - obj.show_paging + 1;
		
		if (start < 1) {
			start = 1;
		}
	}
	
	if (end < 1) {
		total_page = 1;
		end = 1;
		next = 1;
		prev = 1;
		start = 1;
	}
	
	let paging = [];
	for(let i = start; i <= end; i++) {
		paging.push(`<div class="page ${((i == obj.page) ? 'now' : '')}" data-page="${i}" style="${((i == obj.page) ? 'color: black' : 'color: #dcdcdc')}">${i}</div>`);
	}
	
	$(obj.el).html(`
		<div class="mypage--paging">
			<div class="page prev" data-page="${prev}"><</div>
			${paging.join("")}
			<div class="page next" data-page="${next}">></div>
		</div>
	`);
	
	$(obj.el).find(".mypage--paging .page").click(function() {
		var new_page = $(this).data("page");
		let order_status = $('#param_status').val();
		$(obj.use_form).find('input[name="page"]').val(new_page);
		getOrderInfoList(order_status);
		$('html, body').scrollTop(0);
	});
}
</script>