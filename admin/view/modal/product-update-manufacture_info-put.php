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
				<TABLE id="insert_table_manufacture" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD style="width:10%;">제조사</TD>
							<TD colspan="3">
								<input type="text" name="manufacturer" value="">
							</TD>
							
							<TD style="width:10%;">공급사</TD>
							<TD colspan="3">
								<input type="text" name="supplier" value="">
							</TD>
							
							<TD style="width:10%;">원산지</TD>
							<TD colspan="3">
								<input type="text" name="origin_country" value="">
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">브랜드</TD>
							<TD colspan="3">
								<input type="text" name="brand" value="">
							</TD>
							
							<TD style="width:10%;">트랜드</TD>
							<TD colspan="3">
								<input type="text" name="trend" value="">
							</TD>
							
							<TD style="width:10%;">자체분류</TD>
							<TD colspan="3">
								<input type="text" name="self_classification" value="">
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">제조일자</TD>
							<TD colspan="3">
								<input id="manufacturing_date" class="dateParam" type="date" name="manufacturing_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							</TD>
							
							<TD style="width:10%;">출시일자</TD>
							<TD colspan="3">
								<input id="release_date" class="dateParam" type="date" name="release_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							</TD>
							
							<TD style="width:10%;">유효기간</TD>
							<TD colspan="3">
								<div class="row">
									<input id="validate_start_date" class="dateParam" type="date" name="validate_start_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									<input id="validate_end_date" class="dateParam" type="date" name="validate_end_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>상품 가로길이</TD>
							<TD colspan="2">
								<input id="product_width" class="product_volume" type="number" step="0.01" name="product_width" value="">
							</TD>
							
							<TD>상품 세로길이</TD>
							<TD colspan="2">
								<input id="product_depth" class="product_volume" type="number" step="0.01" name="product_depth" value="">
							</TD>
							
							<TD>상품 높이</TD>
							<TD colspan="2">
								<input id="product_height" class="product_volume" type="number" step="0.01" name="product_height" value="">
							</TD>
							
							<TD>상품 부피</TD>
							<TD colspan="2">
								<input id="product_volume" type="text" name="product_volume" value="0" readonly>
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
	productVolumeCalc();
});

function productVolumeCalc() {
	$('.product_volume').change(function() {
		var product_width = $('#product_width').val();
		var product_depth = $('#product_depth').val();
		var product_height = $('#product_height').val();
		
		if (product_width == "" || product_height == "" || product_depth == "") {
			$('#product_volume').val(0);
		} else if (product_width > 0 && product_depth > 0 && product_height > 0) {
			$('#product_volume').val(parseInt(product_width) * parseInt(product_depth) * parseInt(product_height));
		}
	})
}

function productUpdateCheck() {
	insertLog("상품관리 > 상품 정보 일괄 변경", "제작정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>