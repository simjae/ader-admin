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
				<TABLE id="insert_table_md" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">상품분류</TD>
							<TD colspan="5">
								<div class="row">
									<input type="text" name="pl_lrg_category" placeholder="" style="width:20%;" value="">
									<input type="text" name="pl_mdl_category" placeholder="" style="width:20%;" value="">
									<input type="text" name="pl_sml_category" placeholder="" style="width:20%;" value="">
									<input type="text" name="pl_dtl_category" placeholder="" style="width:20%;" value="">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">소재</TD>
							<TD>
								<input type="text" name="material" value="">
							</TD>
							
							<TD style="width:10%;">상품 그래픽</TD>
							<TD>
								<input type="text" name="graphic" value="">
							</TD>
							
							<TD style="width:10%;">상품 핏</TD>
							<TD>
								<input type="text" name="fit" value="">
							</TD>
						</TR>
						
						<TR>
							<TD>상품 이름</TD>
							<TD colspan="2">
								<input type="text" name="product_name" value="">
							</TD>
							<TD>상품 사이즈</TD>
							<TD colspan="2">
								<input type="text" id="size" name="size" value="One Size">
							</TD>
						</TR>
						
						<TR>
							<TD>상품 컬러</TD>
							<TD colspan="2">
								<input type="text" name="color" value="">
							</TD>
							<TD>컬러코드</TD>
							<TD colspan="2">
								<input type="text" name="color_code" value="">
							</TD>
						</TR>
						
						<TR>
							<TD>네비게이션</TD>
							<TD colspan="2">
								<input type="text" name="navigation" value="">
							</TD>
							<TD>구매제한</TD>
							<TD colspan="2">
								<input type="text" name="limit_purchase_member_ext" value="">
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	
});

function productUpdateCheck() {
	insertLog("상품관리 > 상품 정보 일괄 변경", "오더시트 입력정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>