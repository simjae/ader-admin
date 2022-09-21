<input id="bluemark_idx" type="hidden" name="bluemark_idx" value="<?=$idx?>">
<div class="content__card" style="width:950px;margin: 0;">
    <div class="card__header">
        <div class="flex justify-between">
            <h3 id='bluemark_title'>블루마크 등록 내역</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="content__wrap">
        <div class="content__title">상품 이름</div>
        <div class="content__row">
            <span id="product_name"></span>
        </div>
    </div>
    <div class="content__wrap">
        <div class="content__title">상품 코드</div>
        <div class="content__row">
            <span id="product_code"></span>
        </div>
    </div>
    <div class="content__wrap">
        <div class="content__title">정품 코드</div>
        <div class="content__row">
            <span id="serial_code"></span>
        </div>
    </div>
    <div class="content__wrap">
        <div class="content__title">상품 이미지</div>
        <div class="content__row">
            <div id="product_img" style="border: 1px solid #000;"></div>
        </div>
    </div>
    <div class="card__body">
        <div class="content__wrap">
            <div class="content__title">로그</div>
            <div id="cerify_div" class="content__row" >
                <div class="table table__wrap" >
                    <TABLE>
                        <THEAD id="bluemark_log_table_head">
                        </THEAD>
                        <TBODY id="bluemark_log_table">
                        </TBODY>
                    </TABLE>
                </table>
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
    //$("#product_img").css("background-image","url(/images/nav" + num + ".jpeg)"); 
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
                var prod_info = data.product[0];
                var imgDiv = `
                <img class="library" draggable="false" id="${prod_info.product_code}" data-name="ader1" data-url="${prod_info.img_location}" data-productcode="${prod_info.product_code}" data-idx="${prod_info.idx}" src="${prod_info.img_location}" alt="">
                `;
                $('#product_name').text(prod_info.product_name);
                $('#product_code').text(prod_info.product_code);
                $('#serial_code').text(prod_info.serial_code);
                $("#product_img").append(imgDiv); 
                if(data.log != null){
                    headDiv = `
                        <TR>
                            <TH style="width:40px;">번호</TH>
                            <TH style="width:200px;">등록회원</TH>
                            <TH style="width:120px;">IP</TH>
                            <TH style="width:170px;">등록일자</TH>
                        </TR>
                    `;
                    $("#bluemark_log_table_head").append(headDiv);
                    $("#bluemark_log_table").html('');
                    data.log.forEach(function(row){
                    strDiv = `
                            <tr>
                                <td>
                                    <span class="result__span">${row.num}</span> 
                                </td>
                                <td>
                                    <span class="result__span">${row.member_id}(${row.member_level})</span> 
                                </td>
                                <td>
                                    <span class="result__span">${row.ip}</span> 
                                </td>
                                <td>
                                    <span class="result__span">${row.reg_date}</span> 
                                </td>
                            </tr>
                        `;
                        $("#bluemark_log_table").append(strDiv);
                    })
                }
                else{
                    $("#bluemark_log_table").html('<span>인증내용이 없습니다.</span>');
                }
			}
		}
	});
}
</script>
