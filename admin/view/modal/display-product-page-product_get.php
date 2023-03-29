<style>
.lib_btn {width:100px;height:30px;padding:5px;line-height:1.5;text-align:center;font-size:12px;border:1px solid #bfbfbf;border-radius:2px;cursor:pointer;}
</style>

<div class="content__card modal__view" style="max-width:1000px;margin: 0;">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>상품 라이브러리 검색</h3>
			<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body" style="width:1000px;">
		<form id="frm-filter_PRD" action="display/product/grid/lib/product/list/get">
			<input id="param_product_idx" type="hidden" name="product_idx" value="<?=$product_idx?>">
			
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			
			<input type="hidden" class="rows" name="rows" value="5">
			<input type="hidden" class="page" name="page" value="1">
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">상품 코드</div>
					<div class="content__row">
						<input type="text" class="product_code" name="product_code" style="width:90%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">상품 이름</div>
					<div class="content__row">
						<input type="text" class="product_code" name="product_name" style="width:90%;">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">바코드</div>
					<div class="content__row">
						<input type="text" class="barcode" name="barcode" style="width:90%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">옵션 이름</div>
					<div class="content__row">
						<input type="text" class="option_name" name="option_name" style="width:90%;">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type_all">전체</label>
						
						<input id="product_type_b" type="radio" name="product_type" value="B" >
						<label for="product_type_b">일반 상품</label>
						
						<input id="product_type_s" type="radio" name="product_type" value="S" >
						<label for="product_type_s">세트 상품</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">판매가격(한국몰)</div>
					<div class="content__row">
						<input type="text" name="min_price_kr" style="width:150px;" value=""> ~ <input type="text" name="max_price_kr" style="width:150px;" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">판매가격(영문몰)</div>
					<div class="content__row">
						<input type="text" name="min_price_en" style="width:150px;" value=""> ~ <input type="text" name="max_price_en" style="width:150px;" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">판매가격(중문몰)</div>
					<div class="content__row">
						<div class="content__row">
							<input type="text" name="min_price_cn" style="width:150px;" value=""> ~ <input type="text" name="max_price_cn" style="width:150px;" value="">
						</div>
					</div>
				</div>
			</div>
		</form>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="getProductInfoList();"  class="blue__color__btn"><span>검색</span></div>
					<div onclick="init_fileter('frm-filter_PRD','getProductInfoList')"  class="defult__color__btn"><span>초기화</span></div>
				</div>
			</div>
		</div>
		
		<div class="content__card" style="max-width:1000px;margin-top:15px;">
			<div class="card__header">
				<h3>상품 라이브러리 검색 결과</h3>
				<div class="drive--x"></div>
			</div>
			<div class="card__body">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
					</div>
						
					<div class="content__row">
						<select style="width:163px;float:right;margin-right:10px;" lib_type="PRD" onChange="orderChange(this);">
							<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
							<option value="CREATE_DATE|ASC">등록일 순</option>
							<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
							<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
							<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
							<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
							<option value="STOCK_QTY|DESC">상품재고 역순</option>
							<option value="STOCK_QTY|ASC">상품재고 순</option>
							<option value="ORDER_QTY|DESC">판매수량 역순</option>
							<option value="ORDER_QTY|ASC">판매수량 순</option>
						</select>
						<select name="rows" style="width:163px;margin-right:10px;float:right;" lib_type="PRD" onChange="rowsChange(this);">
							<option value="5" selected>5개씩보기</option>
							<option value="10">10개씩보기</option>
							<option value="20">20개씩보기</option>
							<option value="30">30개씩보기</option>
							<option value="50">50개씩보기</option>
							<option value="100">100개씩보기</option>
							<option value="200">200개씩보기</option>
							<option value="300">300개씩보기</option>
							<option value="500">500개씩보기</option>
						</select>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="result_table_TMP" style="min-width:100%;width:auto;">
							<colgroup>
								<col width="100px;">
								<col width="50px;">
								
								<col width="auto;">
								
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								
								<col width="80px;">
								<col width="80px;">
								<col width="80px;">
							</colgroup>
							<THEAD>
								<TR>
									<TH>라이브러리<br/>삭제</TH>
									<TH>상품<br>구분</TH>
									<TH>상품정보</TH>
									<TH>상품가격(한국몰)</TH>
									<TH>상품가격(영문몰)</TH>
									<TH>상품가격(중문몰)</TH>
									<TH>상품<br/>재고</TH>
									<TH>판매<br/>수량</TH>
									<TH>잔여<br/>재고</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
								<tr>
									<td class="default_td" colspan="8">
										라이브러리에 추가할 상품을 선택해주세요.
									</td>
								</tr>
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="excel_table" style="min-width:100%;width:auto;">
							<colgroup>
								<col width="100px;">
								<col width="50px;">
								
								<col width="auto;">
								
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								
								<col width="80px;">
								<col width="80px;">
								<col width="80px;">
							</colgroup>
							<THEAD>
								<TR>
									<TH>라이브러리<br/>추가</TH>
									<TH>상품<br>구분</TH>
									
									<TH>상품정보</TH>
									
									<TH>판매가<br>(한국몰)</TH>
									<TH>판매가<br>(영문몰)</TH>
									<TH>판매가<br>(중국몰)</TH>
									
									<TH>상품<br/>재고</TH>
									<TH>판매<br/>수량</TH>
									<TH>잔여<br/>재고</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body_tmp">
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging_PRD"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:flex">
				<div class="blue__color__btn" style="margin:0 auto" onClick="addProductLib();"><span>라이브러리 추가</span></div>
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {
	getProductInfoList();
});

function getProductInfoList() {
	let frm = $("#frm-filter_PRD");
	
	let result_body = $(".result_body_tmp");
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging_PRD"),
		html : function(d) {
			result_body.html('');
			
			let strDiv = "";
			if (d != null) {
				d.forEach(function(row) {
					strDiv += '<tr>';
					strDiv += '    <td>';
					strDiv += '        <div class="lib_btn" onClick="getProductLib(' + row.product_idx + ');">라이브러리 추가</div>'
					strDiv += '    </td>';
					
					var product_type = "";
					if (row.product_type == "B") {
						product_type = "일반";
					} else if (row.product_type == "S") {
						product_type = "세트";
					}
					
					strDiv += '    <td>' + product_type + '</td>';
					strDiv += '    <TD>';
					strDiv += '        <div class="product__img__wrap">';
					
					var background_url = "background-image:url('" + row.img_location + "');";
					
					strDiv += '            <div class="product__img" style="' + background_url + '">';
					strDiv += '            </div>';
					strDiv += '            <div>';
					strDiv += '                <p>' + row.product_code + '</p><br>';
					strDiv += '                <p>' + row.product_name + '</p><br>';
					strDiv += '            </div>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					
					strDiv += '    <td style="text-align: right;">';
					var discount_kr = row.discount_kr;
					if (discount_kr != 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
						strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
					} else {
						strDiv += '        ' + row.price_kr;
					}
					
					strDiv += '    </td>';
					
					strDiv += '    <td style="text-align: right;">';
					var discount_en = row.discount_en;
					if (discount_en != 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
						strDiv += '        <span>' + row.sales_price_en + "</span></br>";
					} else {
						strDiv += '        ' + row.price_en;
					}
					
					strDiv += '    </td>';
					
					strDiv += '    <td style="text-align: right;">';
					var discount_cn = row.discount_cn;
					if (discount_cn != 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn + "</span></br>";
						strDiv += '        <span>' + row.sales_price_cn + "</span></br>";
					} else {
						strDiv += '        ' + row.price_cn;
					}
					
					strDiv += '    </td>';
					strDiv += '    <td>' + row.stock_qty + '</td>';
					strDiv += '    <td>' + row.order_qty + '</td>';
					strDiv += '    <td>' + row.product_qty + '</td>';
					strDiv += '</tr>';
				});
			} else {
				strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
				strDiv += '    조회 결과가 없습니다';
				strDiv += '</TD>';
			}
			
			result_body.append(strDiv);
		},
	},rows,1);
}

function getProductLib(product_idx) {
	if ($('.product_idx_' + product_idx).length > 0) {
		alert('중복된 상품을 라이브러리에 추가할 수 없습니다.');
		return false;
	} else {
		let result_body = $('.result_body');
		
		$.ajax({
			type: "post",
			url: config.api + "display/product/grid/lib/product/get",
			data: {
				'product_idx' : product_idx
			},
			dataType: "json",
			error: function() {
				alert('상품 라이브러리 개별 조회처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					let data = d.data;
					
					if (result_body.find('.default_td').length > 0) {
						result_body.html('');
					}
					
					if (data != null) {
						var strDiv = "";
						
						strDiv += '<tr class="product_lib product_idx_' + data.product_idx + '" product_idx="' + data.product_idx + '">';
						strDiv += '    <td>';
						strDiv += '        <div class="lib_btn" onClick="deleteProductLib(this);">라이브러리 삭제</div>'
						strDiv += '    </td>';
						
						var product_type = "";
						if (data.product_type == "B") {
							product_type = "일반";
						} else if (data.product_type == "S") {
							product_type = "세트";
						}
						
						strDiv += '    <td>' + product_type + '</td>';
						strDiv += '    <TD>';
						strDiv += '        <div class="product__img__wrap">';
						
						var background_url = "background-image:url('" + data.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p>' + data.product_code + '</p><br>';
						strDiv += '                <p>' + data.product_name + '</p><br>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_kr = data.discount_kr;
						if (discount_kr != 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + data.price_kr + "</span></br>";
							strDiv += '        <span>' + data.sales_price_kr + "</span></br>";
						} else {
							strDiv += '        ' + data.price_kr;
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_en = data.discount_en;
						if (discount_en != 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + data.price_en + "</span></br>";
							strDiv += '        <span>' + data.sales_price_en + "</span></br>";
						} else {
							strDiv += '        ' + data.price_en;
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_cn = data.discount_cn;
						if (discount_cn != 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + data.price_cn + "</span></br>";
							strDiv += '        <span>' + data.sales_price_cn + "</span></br>";
						} else {
							strDiv += '        ' + data.price_cn;
						}
						
						strDiv += '    </td>';
						strDiv += '    <td>' + data.stock_qty + '</td>';
						strDiv += '    <td>' + data.order_qty + '</td>';
						strDiv += '    <td>' + data.product_qty + '</td>';
						strDiv += '</tr>';
						
						result_body.append(strDiv);

					}
				} else {
					alert(d.msg);
				}
			}
		});
	}
}

function addProductLib() {
	let cnt = $('.product_lib').length;
	
	let product_idx = [];
	for (let i=0; i<cnt; i++) {
		let tmp_product_idx = $('.product_lib').eq(i).attr('product_idx');
		product_idx.push(tmp_product_idx);
	}
	
	if (product_idx.length > 0) {
		$.ajax({
			type: "post",
			url: config.api + "display/product/grid/lib/product/add",
			data: {
				"product_idx" : product_idx
			},
			dataType: "json",
			error: function() {
				alert("라이브러리 상품 추가 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					let data = d.data;
					if (data != null) {
						$('.product-grid').html('');
						let productImgWrap = document.querySelector('.product-grid');
						
						let strDiv = "";
						data.forEach(function(row) {
							strDiv += '<img id="' + row.product_code + '" class="library" draggable="true" '
							strDiv += '    data-lib_type="PRD" ';
							strDiv += '    data-content_location="' + row.img_location + '" ';
							strDiv += '    data-banner_type="-" ';
							strDiv += '    data-banner_idx="0" ';
							strDiv += '    data-product_idx="' + row.product_idx + '" ';
							strDiv += '    data-product_code="' + row.product_code + '" ';
							strDiv += '    data-product_name="' + row.product_name + '" ';
							strDiv += '    data-sales_price_kr="' + row.sales_price_kr + '" ';
							strDiv += '    data-sales_price_en="' + row.sales_price_en + '" ';
							strDiv += '    data-sales_price_cn="' + row.sales_price_cn + '" ';
							strDiv += '    data-order_cnt="' + row.order_cnt + '" ';
							strDiv += '    data-whish_cnt="' + row.whish_cnt + '" ';
							strDiv += '    data-create_date="' + row.create_date + '" ';
							strDiv += '    data-update_date="' + row.update_date + '" ';
							strDiv += '    data-product_qty="' + row.product_qty + '" ';
							
							strDiv += '    src="' + row.img_location + '" ';
							strDiv += '    alt="" ';
							strDiv += '>';
						});
						
						productImgWrap.innerHTML = strDiv;
						
						libraryDragStart();
						modal_close();
					}
				}
			}
		});
	} else {
		alert('최소 1개 이상의 상품을 선택해야 합니다');
		return false;
	}
}

function deleteProductLib(obj) {
	$(obj).parent().parent().remove();
	
	let result_body = $('.result_body');
	if (result_body.children().length == 0) {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_body.append(strDiv);
	}
}

function init_fileter(frm_id, func_name){
	var formObj = $('#' + frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=number]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
</script>