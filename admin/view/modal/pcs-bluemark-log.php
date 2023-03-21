<input id="bluemark_idx" type="hidden" name="bluemark_idx" value="<?=$idx?>">
<div class="content__card" style="width:950px;margin: 0;">
    <div class="card__header">
        <div class="flex justify-between">
            <h3 id='bluemark_title'>블루마크 등록 내역</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap" style="display:flex;">
            <div class="table table__wrap" >
				<TABLE id="excel_table" style="width:100%;">
					<TBODY>
						<TR>
							<TD style="width:400px;">
								<TABLE id="excel_table">
									<THEAD>
										<TR>
											<TH>상품 이름</TH>
											<TD id="product_name" style="background-color:#ffffff;"></TD>
										</TR>
										<TR>
											<TH>상품 코드</TH>
											<TD id="product_code" style="background-color:#ffffff;"></TD>
										</TR>
										<TR>
											<TH>블루마크 시리얼 코드</TH>
											<TD id="serial_code" style="background-color:#ffffff;"></TD>
										</TR>
										<TR>
											<TD id="product_img" colspan="2" style="background-color:#ffffff;"></TD>
										</TR>
									</THEAD>
									<TBODY id="product_info">
									</TBODY>
								</TABLE>
							</TD>
							
							<TD style="width:50%;vertical-align:top;">
								<TABLE id="excel_table">
									<THEAD>
										<TR>
											<TH style="width:40px;">번호</TH>
											<TH style="width:200px;">등록회원</TH>
											<TH style="width:120px;">IP</TH>
											<TH style="width:170px;">등록일자</TH>
										</TR>
									</THEAD>
									<TBODY id="log_info">
									</TBODY>
								</TABLE>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
            </div>
                
            <div class="padding__wrap" style="display:none">
				<input type="hidden" class="total_cnt" value="0" onChange="">
				<input type="hidden" class="result_cnt" value="0" onChange="">
				<div class="paging"></div>
			</div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    getBluemarkLogList();
});
function getBluemarkLogList(){
    var bluemark_idx = $('#bluemark_idx').val();
    $.ajax({
		type: "post",
		data: {
			'bluemark_idx' : bluemark_idx
		},
		dataType: "json",
		url: config.api + "product/bluemark/log/get",
		error: function() {
			alert('블루마크 정보 불러오기에 실패했습니다.');
		},
		success: function(d) {
			var data = d.data;
			if(data != null) {
				var strDiv = "";
				
				var background_url = "background-image:url('" + data[0].img_location + "');";
				
				var imgDiv = '<div class="product__img" style="width:100%;height:500px;' + background_url + '">';
				$('#product_name').text(data[0].product_name);
				$('#product_code').text(data[0].product_code);
				$('#serial_code').text(data[0].serial_code);
				$("#product_img").append(imgDiv); 
				
				var log_info = data[0].log_info;
				if (log_info.length > 0) {
					log_info.forEach(function(log) {
						strDiv += '<tr>';
						strDiv += '    <td>';
						strDiv += '        <span class="result__span">' + log.num + '</span> ';
						strDiv += '    </td>';
						strDiv += '    <td>';
						strDiv += '        <span class="result__span">' + log.member_id + ' (' + log.member_level + ')</span>';
						strDiv += '    </td>';
						strDiv += '    <td>';
						strDiv += '        <span class="result__span">' + log.ip + '</span> ';
						strDiv += '    </td>';
						strDiv += '    <td>';
						strDiv += '        <span class="result__span">' + log.reg_date + '</span> ';
						strDiv += '    </td>';
						strDiv += '</tr>';
					});
					
					$("#log_info").append(strDiv);
				} else {
					$("#log_info").html('<TR><TD colspan="4"><span>인증내용이 없습니다.</span></TD></TR>');
				}
			}
		}
	});
}
</script>
