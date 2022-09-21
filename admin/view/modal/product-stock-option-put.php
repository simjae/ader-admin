<div class="body">
	<h1>
		옵션정보 변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-update" action="product/option/put">
			<input type="hidden" name="option_code" value="<?=$option_code?>">
			<input type="hidden" name="action_type" value="update">
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_size_detail" class="list" style="font-size:0.7rem;">
					<THEAD>
						<TR>
							<TH>상품코드</TH>
							<TH>상품이름</TH>
							<TH>옵션코드</TH>
							<TH>옵션이름</TH>
							<TH>재고관리 사용유무</TH>
							<TH>재고관리 등급</TH>
							<TH>수량체크 기준</TH>
							<TH>품절표시</TH>
						</TR>
					</THEAD>
					<TBODY>
						<TR>
							<TD id="product_code">
							</TD>
							
							<TD id="product_name">
							</TD>
							
							<TD id="option_code">
							</TD>
							
							<TD id="option_name">
							</TD>
							
							<TD>
								<input type="hidden" id="stock_management" name="stock_management" value="">
								<div class="row form-group">
									<label>
										<input type="radio" target="stock_management" name="stock_management_input" class="stock_management_input" value="true" onClick="radioClickEvent(this);">
										<span>사용</span>
									</label>
									<label>
										<input type="radio" target="stock_management" name="stock_management_input" class="stock_management_input" value="false" onClick="radioClickEvent(this);">
										<span>미사용</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<input type="hidden" id="stock_grade" name="stock_grade" value="">
								<select class="stock_grade_input" target="stock_grade" style="font-size:0.5rem;" onChange="selectChangeEvent(this);">
									<option value="A">일반</option>
									<option value="B">중요</option>
								</select>
							</TD>
							
							<TD>
								<input type="hidden" id="qty_check_type" name="qty_check_type" value="">
								<select class="qty_check_type_input" target="qty_check_type" style="font-size:0.5rem;" onChange="selectChangeEvent(this);">
									<option value="A">주문</option>
									<option value="B">결제</option>
								</select>';
							</TD>
							
							<TD>
								<input type="hidden" id="sold_out_flg" name="sold_out_flg" value="">
								<div class="row form-group">
									<label>
										<input type="radio" target="sold_out_flg" name="sold_out_flg_input" class="sold_out_flg_input" value="true" onClick="radioClickEvent(this);">
										<span>사용</span>
									</label>
									<label>
										<input type="radio" target="sold_out_flg" name="sold_out_flg_input" class="sold_out_flg_input" value="false" onClick="radioClickEvent(this);">
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
		<a onclick="productOptionUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	$.ajax({
		type: "post",
		data: { 'option_code' : "<?=$option_code?>" },
		dataType: "json",
		url: config.api + "product/option/get",
		error: function() {
			alert("갱신할 옵션정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
				$("#product_code").text(data['data'][0].product_code);
				$("#product_name").text(data['data'][0].product_name);
				$("#option_code").text(data['data'][0].option_code);
				$("#option_name").text(data['data'][0].option_name);
				
				var stock_management = data['data'][0].stock_management;
				if (stock_management == "0") {
					$("input[name='stock_management']").val(false);
					$('.stock_management_input').eq(1).prop('checked',true);
				} else if (stock_management == "1") {
					$("input[name='stock_management']").val(true);
					$('.stock_management_input').eq(0).prop('checked',true);
				}
				
				$("input[name='stock_grade']").val(data['data'][0].stock_grade);
				var stock_grade = data['data'][0].stock_grade;
				if (stock_grade == "A") {
					$('.stock_grade_input').eq(0).prop('selected',true);
				} else if (stock_grade == "B") {
					$('.stock_grade_input').eq(1).prop('selected',true);
				}
				
				$("input[name='qty_check_type']").val(data['data'][0].qty_check_type);
				var qty_check_type = data['data'][0].qty_check_type;
				if (qty_check_type == "A") {
					$('.qty_check_type').eq(0).prop('selected',true);
				} else if (qty_check_type == "B") {
					$('.qty_check_type').eq(1).prop('selected',true);
				}
				
				var sold_out_flg = data['data'][0].sold_out_flg;
				if (sold_out_flg == "0") {
					$("input[name='sold_out_flg']").val(false);
					$('.sold_out_flg_input').eq(1).prop('checked',true);
				} else if (sold_out_flg == "1") {
					$("input[name='sold_out_flg']").val(true);
					$('.sold_out_flg_input').eq(0).prop('checked',true);
				}
			}
		}
	});
});

function radioClickEvent(obj) {
	var click_val = $(obj).val();
	var target = $(obj).attr('target');
	$('#' + target).val(click_val);
}

function selectChangeEvent(obj) {
	var change_val = $(obj).val();
	var target = $(obj).attr('target');
	$('#' + target).val(change_val);
}

function productOptionUpdateCheck() {
	modal_submit($('#frm-update'));
}
</script>