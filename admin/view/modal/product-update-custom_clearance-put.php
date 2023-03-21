<div class="content__card update__modal">
	<h3>
		상품정보 일괄변경 - 해외통관 정보
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			<input type="hidden" name="custom_clearance_update_flg" value="true">
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
	$('#custom_clearance').on('change', function(){
		var msg = "통관번호 : " + $(this).val();
		$('#select_clearance_msg').text(msg);
	})	
});

function productUpdateCheck() {	
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "배송정보 일괄변경", null);
		modal_submit($('#frm-update'),'getUpdateProductInfo');
	}
	else if($('input[name=product_idx_arr]').val() == 'select_all'){
		productAllUpdateCheck();
	}
	
}
function productAllUpdateCheck() {	
	var formSearchData = new FormData();
	var formData = new FormData();
	formSearchData = $("#frm-list").serializeObject();
	formData = $("#frm-update").serializeObject();

	formSearchData.custom_clearance_update_flg 	= formData['custom_clearance_update_flg'];
	formSearchData.custom_clearance 		= formData['custom_clearance'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 배송정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "배송정보 일괄변경", null);
}
</script>