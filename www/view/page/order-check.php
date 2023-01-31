<form id="frm-add" action="/order/complete" method="POST" style="display:none;">
	<input id="basket_idx" type="hidden" name="basket_idx" value="<?=$basket_idx?>">
	
	<input id="to_place" type="hidden" name="to_place" value="<?=$to_place?>">
	<input id="to_name" type="hidden" name="to_name" value="<?=$to_name?>">
	<input id="to_mobile" type="hidden" name="to_mobile" value="<?=$to_mobile?>">
	<input id="to_zipcode" type="hidden" name="to_zipcode" value="<?=$to_zipcode?>">
	<input id="to_lot_addr" type="hidden" name="to_lot_addr" value="<?=$to_lot_addr?>">
	<input id="to_road_addr" type="hidden" name="to_road_addr" value="<?=$to_road_addr?>">
	<input id="to_detail_addr" type="hidden" name="to_detail_addr" value="<?=$to_detail_addr?>">
	<input id="order_memo" type="hidden" name="to_order_memo" value="<?=$to_order_memo?>">
	
	<input id="voucher_idx" type="hidden" name="voucher_idx" value="<?=$voucher_idx?>">
	
	<input id="price_mileage_point" type="hidden" name="price_mileage_point" value="<?=$price_mileage_point?>">
	<input id="price_charge_point" type="hidden" name="price_charge_point" value="<?=$price_charge_point?>">
</form>

<script>
$(document).ready(function() {
	checkOrderInfo();
});

function checkOrderInfo() {
	let frm = $("#frm-add")[0];
	let formData = new FormData(frm);
	
	$.ajax({
		type: "post",
		url: "http://116.124.128.246/_api/order/pg/check",
		data: formData,
		dataType: "json",
		async: true,
		enctype: "multipart/form-data",
		processData: false,
		contentType: false,
		error: function () {
			console.log("결제하기에 화면정보 조회처리에 실패했습니다.");
		},
		success: function (d) {
			let code = d.code;
			if (code == 200) {
				addOrderInfo();
			}
		}
	});
}

function addOrderInfo() {
	let frm = $("#frm-add")[0];
	let formData = new FormData(frm);
	
	$.ajax({
		type: "post",
		url: "http://116.124.128.246/_api/order/pg/add",
		data: formData,
		dataType: "json",
		async: true,
		enctype: "multipart/form-data",
		processData: false,
		contentType: false,
		error: function () {
			console.log("결제하기에 화면정보 조회처리에 실패했습니다.");
		},
		success: function (d) {
			let code = d.code;
			if (code == 200) {
				let order_idx = d.data;
				
				location.href="/order/complete?order_idx=" + order_idx;
			}
		}
	});
}
</script>