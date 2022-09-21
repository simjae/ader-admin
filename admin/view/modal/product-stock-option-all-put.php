<div class="body">
	<h1>
		옵션정보 변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/stock/list/put">
			<input type="hidden" name="option_idx" value="<?=$option_idx?>">
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_size_detail" class="list" style="font-size:0.7rem;">
					<THEAD>
						<TR>
							<TH>재고관리 사용유무</TH>
							<TH>재고관리 등급</TH>
							<TH>수량체크 기준</TH>
							<TH>품절표시</TH>
						</TR>
					</THEAD>
					<TBODY>
						<TR>
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="stock_management" value="true" checked>
										<span>사용</span>
									</label>
									<label>
										<input type="radio" name="stock_management" value="false">
										<span>미사용</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<select name="stock_grade" style="font-size:0.5rem;">
									<option value="A">일반</option>
									<option value="B">중요</option>
								</select>
							</TD>
							
							<TD>
								<select name="qty_check_type" style="font-size:0.5rem;">
									<option value="A">주문</option>
									<option value="B">결제</option>
								</select>';
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="sold_out_flg" value="true" checked>
										<span>사용</span>
									</label>
									<label>
										<input type="radio" name="sold_out_flg" value="false">
										<span>미사용</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productOptionAllUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	
});

function productOptionAllUpdateCheck() {
	var tab_num = $('#tab_num').val();
	modal_submit($('#frm-update'),'getProductStockInfo_' + tab_num);
}
</script>