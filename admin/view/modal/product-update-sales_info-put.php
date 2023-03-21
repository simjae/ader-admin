<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.table__wrap label{
		display: inline-flex!important;
	}
</style>

<div class="content__card">
	<h3>
		상품정보 일괄변경 - 판매정보
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_sales_info">
					<TBODY>
						<TR>
							<TD>MD 제품 카테고리</TD>
							<TD colspan="5">
								<div class="content__row">
									<input type="hidden" id="md_category_1" name="md_category_1" value="">
									<input type="hidden" id="md_category_2" name="md_category_2" value="">
									<input type="hidden" id="md_category_3" name="md_category_3" value="">
									<input type="hidden" id="md_category_4" name="md_category_4" value="">
									<input type="hidden" id="md_category_5" name="md_category_5" value="">
									<input type="hidden" id="md_category_6" name="md_category_6" value="">
									<select class="fSelect category eCategory eCategory1" depth="1" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 01</option>	
									</select>
									<select class="fSelect category eCategory eCategory2" depth="2" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 02</option>
									</select>
									<select class="fSelect category eCategory eCategory3" depth="3" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 03</option>
									</select>
									<select class="fSelect category eCategory eCategory4" depth="4" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 04</option>
									</select>
									<select class="fSelect category eCategory eCategory5" depth="5" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 05</option>
									</select>
									<select class="fSelect category eCategory eCategory6" depth="6" name="md_category_idx[]" style="font-size:0.5rem;width:120px;" onChange="productCategoryChange(this);">
										<option value="">상품분류 06</option>
									</select>
								</div>
							</TD>
						</TR>
						<TR>
							<TD>마일리지 사용유무</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="mileage_flg" value="true" checked>
										<div><div></div></div>
										<span>제한</span>
									</label>
									<label class="rd__square">
										<input type="radio" name="mileage_flg" value="false">
										<div><div></div></div>
										<span>제한안함</span>
									</label>
								</div>
							</TD>
							<TD>단독구매 제한유무</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="exclusive_flg" value="true" checked>
										<div><div></div></div>
										<span>제한</span>
									</label>
									<label class="rd__square">
										<input type="radio" name="exclusive_flg" value="false">
										<div><div></div></div>
										<span>제한안함</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<tr>
							<TD>구매 멤버 제한</TD>
							<TD colspan="5">
								<div class="content__row form-group">
									<label>
										<input type="checkbox" name="limit_member[]" value="1">
										<span>비회원</span>
									</label>
									<label>
										<input type="checkbox" name="limit_member[]" value="2">
										<span>일반회원</span>
									</label>
									<label>
										<input type="checkbox" name="limit_member[]" value="3">
										<span>Ader Family</span>
									</label>
								</div>
							</TD>
						</tr>
						<TR>
							<TD>구매 수량 제한</TD>
							<TD>
								<div class="content__row">
									<label class="rd__square">
										<input  type="radio" name="limit_purchase_qty_flg" value="true" checked>
										<div><div></div></div>
										<span>제한</span>
									</label>
									<label class="rd__square">
										<input type="radio" name="limit_purchase_qty_flg" value="false">
										<div><div></div></div>
										<span>제한안함</span>
									</label>
								</div>
							</TD>
							<TD>구매 수량 제한 최소값</TD>
							<TD>
								<input id="limit_purchase_qty_min" type="number" step="1" name="limit_purchase_qty_min" value="1">
							</TD>
							<TD >구매 수량 제한 최대값</TD>
							<TD>
								<input id="limit_purchase_qty_max" type="number" step="1" name="limit_purchase_qty_max" value="0">
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="card__footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	getProductCategory(0,0, 'frm-update');
});
function limitPurchaseSingleFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#limit_purchase_single').val(flg_val);
}

function limitPurchaseQtyFlgClick(obj) {
	var flg_val = $(obj).val();
	
	if (flg_val == 'true') {
		$('#limit_purchase_qty_input').show();
	} else {
		$('#limit_purchase_qty_input').hide();
		$("input[name='limit_purchase_qty_min_num']").val(0);
		$("input[name='limit_purchase_qty_max_num']").val(0);
	}
}

function setMdCategory(depth,d){
	var eCategory = $('#md_category_' + depth);
	eCategory.empty();
	
	for (var i=(depth+1); i<=6; i++) {
		$('#md_category_' + i).empty();
	}
	
	var category_idx = $("input[name='md_category_" + depth + "']").val();
	
	if (d != null) {
		d.forEach(function(row) {
			var checked = "";
			if (category_idx == row.no) {
				checked = "checked";
			} else {
				checked = "unchecked";
			}
			
			eCategory.append($('<div id="md_category_idx_' + row.no + '" class="md_category ' + checked + '" category_idx="' + row.no + '" style="width:100%;height:50px;border:1px solid #000000;cursor:pointer;" onClick="productCategoryClick(this);">' + row.text + '</div>'));
		});
	}	
}

function productUpdateCheck() {	
	detail_refund_kr.getById["detail_refund_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_en.getById["detail_refund_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_cn.getById["detail_refund_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "판매정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>