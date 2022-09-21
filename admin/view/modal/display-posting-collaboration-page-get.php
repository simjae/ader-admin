<style>
	.content__card .table__wrap .cb__color{
		justify-content: center;
	}
</style>
<div class="content__card" style="width:950px;margin: 0;">
	<form id="frm-filter" action="display/posting/lib/get">
		<input type="hidden" class="rows" name="rows" value="4">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<div class="flex justify-between">
				<h3>콜라보레이션 상품 검색</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row">
					<select class="fSelect eSearch search_type" name="search_type" style="width:163px;" onChange="searchTypeChange(this);">
						<option value="" selected>검색분류 선택</option>
						<option value="product_name">상품명</option>
						<option value="product_code">상품코드</option>
					</select>
					
					<input type="text" name="search_keyword" value="" style="width:80%;">
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid-template-columns: auto;">
				<div class="btn__wrap--lg">
					<div></div>
					<div  class="blue__color__btn" onClick="getProductInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="confirm('콜라보레이션 상품 추가시 기존의 상품은 초기화됩니다.','addCollaborationProduct()');"><span>추가</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list">
		<div class="card__body">
			<div class="table table__wrap">
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH style="width:8%;">상품구분</TH>
							<TH>상품코드</TH>
							<TH>상품명</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table">
					</TBODY>
				</TABLE>
			</div>
			
			<div class="padding__wrap">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getProductInfo();
});

function getProductInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $('.rows').val();
	var page = $('.page').val();
	
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td style="width: 3%;">';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="product_idx" value="' + row.idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				strDiv += '    <td style="width: 5%;">' + row.no + '</td>';
				strDiv += '    <td style="width: 5%;">' + row.product_type + '</td>';
				strDiv += '    <td style="width: 20%;"><font style="cursor:pointer;">' + row.product_code + '</font></td>';
				strDiv += '    <TD style="width: 20%;">';
				strDiv += '        <div class="product__img__wrap">';
				strDiv += '            <input type="hidden" class="product_img_' + row.idx + '" value="' + row.img_location + '">';
				
				var background_url = "background-image:url('" + row.img_location + "');";
				
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '</tr>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.select').prop('checked',false);
	}
}

function addCollaborationProduct() {
	var length = $('.select').length;
	
	var product_idx_arr = [];
	if (length > 0) {
		for (var i=0; i<length; i++) {
			if ($('.select').eq(i).prop('checked') == true) {
				product_idx_arr.push($('.select').eq(i).val());
			}
		}
	}
	
	if (product_idx_arr.length > 0){
		$('#product_info_div').empty();
		
		for (var i=0; i<length; i++) {
			var select = $('.select').eq(i);
			var product_idx = select.val();
			var product_img = $('.product_img_' + product_idx).val();
			
			if (product_idx != null && product_img != null) {
				var strDiv = "";
				strDiv += '<div class="product__box">';
				strDiv += '    <input type="hidden" name="collaboration_product[]" value="' + product_idx + '">';
				strDiv += '    <div style="width: 100%;">';
				strDiv += '        <div class="product__img">';
				strDiv += '            <div class="remove__btn">';
				strDiv += '                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
				strDiv += '                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />';
				strDiv += '                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />';
				strDiv += '                </svg>';
				strDiv += '            </div>';
				strDiv += '            <img class="product_img" src="' + product_img + '">';
				strDiv += '        </div>';
				strDiv += '        <div class="product__title"></div>';
				strDiv += '        <div class="product__content">';
				strDiv += '            <div></div>';
				strDiv += '            <div></div>';
				strDiv += '        </div>';
				strDiv += '    </div>';
				strDiv += '</div>';
				
				$('#product_info_div').append(strDiv);
			}
		}
		
		modal_close();
	} else {
		alert('콜라보레이션에 추가할 상품을 선택해주세요.');
		return false;
	}
}
</script>