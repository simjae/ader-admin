
<div class="content__card update__modal">
	<h3>
		상품정보 일괄변경 - 필터
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
    <div class="card__body">
		<form id="frm-update" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row table__wrap" style="margin-top:10px;">
				<TABLE id="insert_table_wkla_material">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<TBODY>
                        <tr>
                            <td>색상 필터 적용</td>
                            <td colspan="11">
                                <div class="content__row form-group filter_cl">
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>핏 필터 적용</td>
                            <td colspan="11">
                                <div class="rd__block">
                                    <input class="filter_ft_FALSE" id="filter_ft_FALSE" type="radio" name="filter_ft" value="true" checked>
                                    <label for="filter_ft_FALSE">미적용</label>
                                    
                                    <input class="filter_ft_TRUE" id="filter_ft_TRUE" type="radio" name="filter_ft" value="false">
                                    <label for="filter_ft_TRUE">적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>그래픽 필터 적용</td>
                            <td colspan="11">
                                <div class="rd__block">
                                    <input class="filter_gp_FALSE" id="filter_gp_FALSE" type="radio" name="filter_gp" value="true" checked>
                                    <label for="filter_gp_FALSE">미적용</label>
                                    
                                    <input class="filter_gp_TRUE" id="filter_gp_TRUE" type="radio" name="filter_gp" value="false">
                                    <label for="filter_gp_TRUE">적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>라인 필터 적용</td>
                            <td colspan="11">
                                <div class="rd__block">
                                    <input class="filter_ln_FALSE" id="filter_ln_FALSE" type="radio" name="filter_ln" value="true" checked>
                                    <label for="filter_ln_FALSE">미적용</label>
                                    
                                    <input class="filter_ln_TRUE" id="filter_ln_TRUE" type="radio" name="filter_ln" value="false">
                                    <label for="filter_ln_TRUE">적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>사이즈 필터 적용</td>
                            <td class="filter_sz" colspan="11">
                                <table>
                                    <tr>
                                        <td style="width:8%;">상의</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_UP">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>하의</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_LW">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>모자</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_HT">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>신발</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_SH">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>주얼리</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_JW">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>악세서리</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_AC">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>테크 악세서리</td>
                                        <td style="text-align:left;">
                                            <div class="content__row form-group filter_sz_TA">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
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
$(document).ready(function(){
    getFilterInfo();
})

function getFilterInfo() {
    $.ajax({
        type: "post",
        dataType: "json",
        url: config.api + "product/filter/put/get",
        error: function() {
            alert("필터 조회처리에 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
                let data = d.data;
                if (data != null) {
                    let filter_cl = data[0].filter_cl;
                    filter_cl.forEach(function(cl) {
                        let strDiv = "";
                        strDiv += '<label>';
                        strDiv += '    <input id="filter_cl_' + cl.filter_idx + '" type="checkbox" name="filter_cl[]" value="' + cl.filter_idx + '">';
                        strDiv += '    <span>' + cl.filter_name + '</span>';
                        strDiv += '</label>';
                        $('.filter_cl').append(strDiv);
                    });
                    
                    let filter_sz = data[0].filter_sz;
                    filter_sz.forEach(function(sz) {
                        let size_type = sz.size_type;
                        let div_td = $('.filter_sz_' + size_type);

                        let strDiv = "";
                        strDiv += '<label>';
                        strDiv += '    <input id="filter_sz_' + sz.filter_idx + '" type="checkbox" name="filter_sz[]" value="' + sz.filter_idx + '">';
                        strDiv += '    <span>' + sz.filter_name + '</span>';
                        strDiv += '</label>';
                        
                        div_td.append(strDiv);
                    });
                }
            }
        }
    });
}

function productUpdateCheck() {	
	if($('input[name=product_idx_arr]').val() != 'select_all'){
		insertLog("상품관리 > 상품 정보 일괄 변경", "필터정보 일괄변경", null);
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

    formSearchData.filter_ft = formData['filter_ft'];
    formSearchData.filter_gp = formData['filter_gp'];
    formSearchData.filter_ln = formData['filter_ln'];
    formSearchData.filter_cl = formData['filter_cl[]'];
    formSearchData.filter_sz = formData['filter_sz[]'];

	$.ajax({
		type: "post",
		data: formSearchData,
		dataType: "json",
		url: config.api + "product/list/put",
		error: function() {
			alert("갱신할 상품정보를 불러오는데 실패했습니다.");
		},
		success: function(data) {
			alert('검색상품 필터정보를 일괄 수정했습니다.', function(){
				modal_close();
			})
		}
	});
	insertLog("상품관리 > 상품 정보 일괄 변경", "필터정보 일괄변경", null);
}
</script>
