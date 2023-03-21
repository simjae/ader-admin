<style>
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.table__wrap label{display: inline-flex!important;}
</style>

<div class="content__card update__modal">
	<h3>
		상품정보 일괄변경 - 일반정보
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<input type="hidden" name="md_category_flg" value="true">
			<input type="hidden" name="limit_member_update_flg" value="true">
			<input type="hidden" name="reorder_cnt_update_flg" value="true">
			<input type="hidden" name="limit_product_qty_update_flg" value="true">

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
						
						<tr>
							<TD>판매 여부</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="sale_update_flg" value="true" checked>
										<div><div></div></div>
										<span>판매</span>
									</label>
									<label class="rd__square">
										<input type="radio" name="sale_update_flg" value="false">
										<div><div></div></div>
										<span>판매안함</span>
									</label>
								</div>
							</TD>
							
							<TD>품절 여부</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="sold_out_flg" value="false" checked>
										<div><div></div></div>
										<span>구매가능</span>
									</label>
									
									<label class="rd__square">
										<input type="radio" name="sold_out_flg" value="true">
										<div><div></div></div>
										<span>품절</span>
									</label>
								</div>
							</TD>
						</tr>
						
						<tr>
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
						</tr>
						
						<tr>
							<TD >구매 멤버 제한</TD>
							<TD colspan="11">
								<div class="content__row form-group">
								<?php
									$get_member_level_sql = "
										SELECT
											IDX,
											TITLE
										FROM
											dev.MEMBER_LEVEL
										WHERE
											DEL_FLG = FALSE
									";
									$db->query($get_member_level_sql);

									foreach($db->fetch() as $level_info){
								?>
									<label>
										<input type="checkbox" name="limit_member[]" value="<?=$level_info['IDX']?>">
										<span><?=$level_info['TITLE']?></span>
									</label>
								<?php
									}
								?>
								</div>
							</TD>
						</tr>
						<TR>
							<TD>ID당 구매제한</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="limit_id_flg" value="false" checked>
										<div><div></div></div>
										<span>제한안함</span>
									</label>
									<label class="rd__square">
										<input  type="radio" name="limit_id_flg" value="true">
										<div><div></div></div>
										<span>제한</span>
									</label>
								</div>
							</TD>
							<TD>리오더 차수</TD>
							<TD colspan="2"><input id="reorder_cnt" type="number" step="1" name="reorder_cnt" value="0"></TD>
						</TR>
						<TR>
							<TD>구매수량 제한</TD>
							<TD colspan="2">
								<div class="content__row">
									<label class="rd__square">
										<input type="radio" name="limit_purchase_qty_flg" value="false" checked>
										<div><div></div></div>
										<span>제한안함</span>
									</label>
									<label class="rd__square">
										<input  type="radio" name="limit_purchase_qty_flg" value="true">
										<div><div></div></div>
										<span>제한</span>
									</label>
								</div>
							</TD>
							<TD>상품별 구매제한 수량</TD>
							<TD colspan="2"><input id="limit_product_qty" type="number" step="1" name="limit_product_qty" value="0"></TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
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
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "판매정보 일괄변경", null);
		modal_submit($('#frm-update'),'getUpdateProductInfo');
	}
	else if($('input[name=product_idx_arr]').val() == 'select_all'){
		productAllUpdateCheck();
	}
	
}
function productAllUpdateCheck() {	
	var formSearchData = new FormData();
	formSearchData = $("#frm-list").serializeObject();

	var formData = new FormData();
	formData = $("#frm-update").serializeObject();

	formSearchData.md_category_flg 				= formData['md_category_flg'];
	formSearchData.limit_member_update_flg 		= formData['limit_member_update_flg'];
	formSearchData.reorder_cnt_update_flg 		= formData['reorder_cnt_update_flg'];
	formSearchData.limit_product_qty_update_flg = formData['limit_product_qty_update_flg'];
	formSearchData.md_category_idx 				= formData['md_category_idx[]'];
	formSearchData.sale_update_flg 				= formData['sale_update_flg'];
	formSearchData.sold_out_flg 				= formData['sold_out_flg'];
	formSearchData.mileage_flg 					= formData['mileage_flg'];
	formSearchData.exclusive_flg 				= formData['exclusive_flg'];
	formSearchData.limit_member 				= formData['limit_member[]'];
	formSearchData.limit_id_flg 				= formData['limit_id_flg'];
	formSearchData.reorder_cnt 					= formData['reorder_cnt'];
	formSearchData.limit_purchase_qty_flg 		= formData['limit_purchase_qty_flg'];
	formSearchData.limit_product_qty 			= formData['limit_product_qty'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 상품 판매정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "판매정보 일괄변경", null);
}
</script>