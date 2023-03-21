<div id="member_detail_VOU">
	<div class="content__card">
		<div class="card__body">
			<div class="table__wrap">
				<?php
					$usable_voucher_cnt = $db->count(
						"dev.VOUCHER_ISSUE",
						"
							COUNTRY = '".$country."' AND
							MEMBER_IDX = ".$member_idx." AND
							(NOW() BETWEEN USABLE_START_DATE AND USABLE_END_DATE) AND
							USED_FLG = FALSE
						"
					);
					$used_voucher_cnt = $db->count("dev.VOUCHER_ISSUE","COUNTRY = '".$country."' AND MEMBER_IDX = ".$member_idx." AND USED_FLG = TRUE");
				?>
				<table>
					<colgroup>
						<col width="10%;">
						<col width="40%;">
						<col width="10%;">
						<col width="40%;">
					</colgroup>
					<tbody>
						<tr>
							<TH>사용가능 바우처</TH>
							<td style="text-align:right;"><?=$used_voucher_cnt?>건</td>
							<TH>사용 바우처</TH>
							<td style="text-align:right;"><?=$used_voucher_cnt?>건</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="content__card">
		<div class="card__header">
			<h3>바우처현황</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 바우처 수 <font class="cnt_VOU_total info__count" >0</font>개
				</div>
				
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange_VOU(this);">
						<option value="VI.IDX|ASC" checked>바우처 발급 순</option>
						<option value="VI.IDX|DESC">바우처 발급 역순</option>
						<option value="VM.VOUCHER_NAME|ASC">바우처 이름 순</option>
						<option value="VM.VOUCHER_NAME|DESC">바우처 이름 역순</option>
						<option value="VI.VOUCHER_ADD_DATE|ASC">바우처 등록일 순</option>
						<option value="VI.VOUCHER_ADD_DATE|DESC">바우처 등록일 역순</option>
						<option value="VM.SALE_TYPE|ASC">할인유형 순</option>
						<option value="VM.SALE_TYPE|DESC">할인유형 역순</option>
						<option value="VM.SALE_PRICE|ASC">할인금액 순</option>
						<option value="VM.SALE_PRICE|DESC">할인금액 역순</option>
						<option value="VI.UPDATE_DATE|ASC">바우처 사용일 순</option>
						<option value="VI.UPDATE_DATE|DESC">바우처 사용일 역순</option>
					</select>
					
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange_VOU(this);">
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
			
			<div class="table__wrap" style="margin-top:15px;">
				<table>
					<colgroup>
						<col width="80px;">
						<col width="auto;">
						<col width="50px;">
						<col width="80px;">
						
						<col width="130px;">
						
						<col width="80px;">
						<col width="150px;">
						<col width="130px;">
					</colgroup>
					<thead>
						<tr>
							<th>온라인<br/>오프라인</th>
							<th>바우처이름</th>
							<th>할인유형</th>
							<th>할인금액</th>
							
							<th>바우처<br/>등록일</th>
							
							<th>사용여부</th>
							<th>주문번호</th>
							<th>사용일자</th>
						</tr>
					</thead>
					<tbody class="result_body">
						
					</tbody>
				</table>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging_VOU(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging_VOU(this);">
            	<div class="paging_VOU"></div>
        	</div>
		</div>
	</div>
</div>

<form id="frm-VOU" action="modal/voucher/get">
	<input type="hidden" class="page" name="country" value="<?=$country?>">
	<input type="hidden" class="rows" name="member_idx" value="<?=$member_idx?>">
	
	<input type="hidden" class="sort_type" name="sort_type" value="ASC">
	<input type="hidden" class="sort_value" name="sort_value" value="VI.IDX">
	
	<input type="hidden" class="rows" name="rows" value="10">
	<input type="hidden" class="page" name="page" value="1">
</form>

<script>
$(document).ready(function() {
	getModalVoucherInfo();
});

function getModalVoucherInfo() {
	let frm = $('#frm-VOU');
	let result_body = $('#member_detail_VOU').find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_VOU"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					let voucher_link = "";
					if (row.voucher_idx > 0) {
						voucher_link = '  style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/voucher/mst?voucher_idx=' + row.voucher_idx + '\', \'바우처 정보 페이지\',\'width=#, height=#\'))" ';
					}
					
					let order_link = "";
					if (row.order_code != "-") {
						order_link = '  style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					strDiv += '<tr>';
					strDiv += '    <TD>' + row.on_off_type + '</TD>';
					strDiv += '    <TD ' + voucher_link + '>' + row.voucher_name + '</TD>';
					strDiv += '    <TD>' + row.sale_type + '</TD>';
					strDiv += '    <TD style="text-align:right;">' + row.sale_price + '</TD>';

					strDiv += '    <TD>' + row.voucher_add_date + '</TD>';

					strDiv += '    <TD>' + row.used_flg + '</TD>';
					strDiv += '    <TD ' + order_link + '>' + row.order_code + '</TD>';
					strDiv += '    <TD>' + row.update_date + '</TD>';
					strDiv += '</tr>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				
				strDiv += '<TR>';
				strDiv += '    <TD colspan="10" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}

function orderChange_VOU(obj) {	
	let frm = $('#frm-VOU');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getModalVoucherInfo();
}

function rowsChange_VOU(obj) {
	let frm = $('#frm-VOU');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getModalVoucherInfo();
}

function setPaging_VOU(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_VOU_total').text(total_cnt.val());
}
</script>