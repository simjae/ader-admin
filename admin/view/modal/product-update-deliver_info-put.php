<div class="body">
	<h1>
		상품정보 일괄변경 - 배송정보
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_delivery">
					<colgroup>
						<col width="30%">
						<col width="70%">
					</colgroup>
					<TBODY>
						<TR>
							<td>
								해외 통관 정보
							</TD>
							<TD>
								<div class="content__row">
									<select id="custom_clearance" name="custom_clearance" class="fSelect eSearch" style="width:163px;height:30px;border: solid 1px #bfbfbf;">
										<option value="" selected>--해외 통관 분류--</option>	
										<option value="ADAP0000">남성 신발</option>
										<option value="AFAA0000">남성 지갑</option>
										<option value="AFAC0000">남성 스카프/머플러</option>
										<option value="AEAJ0000">양말</option>
										<option value="AEAP0000">기타악세</option>
										<option value="ADAG0000">남성 자켓</option>
										<option value="ADAJ0000">남성 티셔츠</option>
									</select>
									<span id="select_clearance_msg">통관번호 : <span>
								</div>
							</TD>
						</tr>
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
	$('#custom_clearance').on('change', function(){
		var msg = "통관번호 : " + $(this).val();
		$('#select_clearance_msg').text(msg);
	})	
});

function productUpdateCheck() {
	insertLog("상품관리 > 상품 정보 일괄 변경", "배송정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>