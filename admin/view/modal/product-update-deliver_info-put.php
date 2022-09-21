<div class="body">
	<h1>
		상품정보 일괄변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_delivery" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">HS코드</TD>
							<TD>
								<input type="text" name="hs_code" value="">
							</TD>
							<TD style="width:10%;">상품 전체 중량</TD>
							<TD>
								<input  type="number" step="0.01" name="product_total_weight" value="0">
							</TD>
							<TD style="width:10%;">상품 구분(해외통관)</TD>
							<TD>
								<input type="text" name="product_division" value="">
							</TD>
						</TR>
						<TR>
							<TD style="width:10%;">상품소재</TD>
							<TD>
								<input type="text" name="product_material_kr" value="">
							</TD>
							<TD style="width:10%;">영문 상품소재</TD>
							<TD>
								<input type="text" name="product_material_en" value="">
							</TD>
							<TD style="width:10%;">옷감</TD>
							<TD>
								<input type="text" name="fabric" value="">
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit($('#frm-update'));" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	
});

function productUpdateCheck() {
	insertLog("상품관리 > 상품 정보 일괄 변경", "배송정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>