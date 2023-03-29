<div class="body">
	<h1>
		주문 검색항목 설정
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<input id="order_status" type="hidden" value="<?=$order_status?>">
		
		<div class="table__wrap" style="margin-top:10px;">
			<TABLE id="select_table">
				<THEAD>
					<TR>
						<TH>검색항목</TH>
						<TH>검색항목 체크</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>주문상품정보</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="order_product order_product" type="checkbox" value="order_product">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>주문취소일</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column cancel_date" type="checkbox" value="cancel_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>주문교환일</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column exchange_date" type="checkbox" value="exchange_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>주문환불일</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column refund_date" type="checkbox" value="refund_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>결제일자</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_date" type="checkbox" value="pg_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제수단</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_payment" type="checkbox" value="pg_payment">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제상태</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_status" type="checkbox" value="pg_status">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제통화</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_currency" type="checkbox" value="pg_currency">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제가격</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_price" type="checkbox" value="pg_price">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제ID</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_mid" type="checkbox" value="pg_mid">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제지불키</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_payment_key" type="checkbox" value="pg_payment_key">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>결제영수증URL</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column pg_receipt_url" type="checkbox" value="pg_receipt_url">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>송장번호</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_num" type="checkbox" value="delivery_num">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송유형</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_type" type="checkbox" value="delivery_type">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송예정일</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_date" type="checkbox" value="delivery_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송상태</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_status" type="checkbox" value="delivery_status">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송시작일</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_start_date" type="checkbox" value="delivery_start_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송종료일</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column delivery_end_date" type="checkbox" value="delivery_end_date">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송회사이름</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column company_name" type="checkbox" value="company_name">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>주문메모</TD>
						<TD>
							<div class="cb__color form-group">
								<label>
									<input class="select_column order_memo" type="checkbox" value="order_memo">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="setSelectColumn();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
let order_status = $('#order_status').val();
let frm = $('#frm-list_' + order_status);

$(document).ready(function() {
	let select_table = $('#select_table');
	
	let select_product_flg = frm.find('.select_product_flg').val();
	if (select_product_flg == "true") {
		select_table.find('.order_product').prop('checked',true);
	}
	
	let select_column = frm.find('.select_column').val();
	
	let column_arr = [];
	if (select_column.length > 0 && select_column != null) {
		column_arr = select_column.split(",");
	}
	
	if (column_arr.length > 0) {
		for (let i=0; i<column_arr.length; i++) {
			let tmp_class = column_arr[i];
			select_table.find('.' + tmp_class).prop('checked',true);
		}
	}
	
});

function setSelectColumn() {
	let order_status = $('#order_status').val();
	
	let frm = $('#frm-list_' + order_status);
	
	let select_table = $('#select_table');
	let order_product = select_table.find('.order_product');
	if (order_product.prop('checked') == true) {
		frm.find('.select_product_flg_' + order_status).val(true);
	} else {
		frm.find('.select_product_flg_' + order_status).val(false);
	}
	
	let checkbox = select_table.find('.select_column');
	let cnt = checkbox.length;
	
	let select_column = [];
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			select_column.push(checkbox.eq(i).val());
		}
	}
	
	frm.find('.select_column').val(select_column);
	getOrderInfoList(order_status);
	modal_close();
}
</script>