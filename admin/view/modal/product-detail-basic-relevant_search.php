<style>
.tmp_relevant_product {width:230px;height:20px;line-height:10px;background-color:#140f82;border-radius:5px;color:#ffffff;font-size:0.5rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding:5px;margin-right:5px;margin-top:5px;float:left;cursor:pointer;}
</style>

<div class="content__card modal__view" style="max-width:1000px;margin: 0;">
	
	<div class="card__header">
		<div class="flex justify-between">
			<h3>관련상품 검색</h3>
			<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body" style="width:1000px;">
		<form id="frm-filter_REL" action="product/relevant/list/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			
			<input type="hidden" class="rows" name="rows" value="5">
			<input type="hidden" class="page" name="page" value="1">
			
			<input type="hidden" name="relevant_idx" value="<?=$relevant_idx?>">
			
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
		</form>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="getRelevantProductList();"  class="blue__color__btn"><span>검색</span></div>
				</div>
			</div>
		</div>
		
		<div class="content__card" style="max-width:1000px;margin-top:20px;">
			<div class="card__header">
				<h3>관련상품 검색 결과</h3>
				<div class="drive--x"></div>
			</div>
			
			<div class="card__body">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
					</div>
						
					<div class="content__row">
						<select style="width:163px;float:right;margin-right:10px;" product_type="REL" onChange="orderChange(this);">
							<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
							<option value="CREATE_DATE|ASC">등록일 순</option>
							<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
							<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
							<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
							<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
						</select>
						
						<select name="rows" style="width:163px;margin-right:10px;float:right;" product_type="REL" onChange="rowsChange(this);">
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
				
				<div class="tmp_container_PRD"></div>
				
				<div class="table table__wrap">
					<div class="table__filter">
						<input id="relevant_product_list" type="hidden" value="">
						<div class="tmp_relevant_wrap">
							
						</div>
					</div>
						
					<div class="overflow-x-auto">
						<TABLE>
							<THEAD>
								<TR>
									<TH>선택</TH>
									<TH style="width:3%;">상품<br>구분</TH>
									<TH>스타일 코드</TH>
									<TH>컬러 코드</TH>
									<TH>상품 코드</TH>
									<TH>상품명</TH>
									<TH style="width:8%;">판매가<br>(한국몰)</TH>
									<TH style="width:8%;">판매가<br>(영문몰)</TH>
									<TH style="width:8%;">판매가<br>(중국몰)</TH>
									<TH>관련상품 재고수량</TH>
								</TR>
							</THEAD>
							<TBODY id="result_table_REL">
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" product_type="REL" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" product_type="REL" value="0" onChange="setPaging(this);">
					<div class="paging_REL"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:flex">
				<div onclick="getRelevantProduct();"  class="blue__color__btn"><span>상품 추가</span></div>
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {	
	getRelevantProductList();
});

function getRelevantProductList() {
	let frm = $('#frm-filter_REL');
	
	let result_table = $("#result_table_REL");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
	strDiv += '	조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	let rows = frm.find('.rows').val();
	let page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_REL"),
		html : function(d) {
			console.log(d);
			
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row){
				strDiv += '<TR id="selected_tr_' + row.product_idx + '">';
				strDiv += '    <td>';
				strDiv += '        <div class="btn" product_idx="' + row.product_idx + '" onClick="addTmpRelevantProduct(this)">선택</div>'
				strDiv += '    </td>';
				
				var product_type = "";
				if (row.product_type == "B") {
					product_type = "일반";
				} else if (row.product_type == "S") {
					product_type = "세트";
				}
				strDiv += '    <td>' + product_type + '</td>';
				strDiv += '    <td>' + row.style_code + '</td>';
				strDiv += '    <td>' + row.color_code + '</td>';

				let background_url = "background-image:url('" + row.img_location + "');";
				strDiv += '    <TD>';
				strDiv += '        <div class="product__img__wrap">';
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p class="product_name">' + row.product_name + '</p><br>';
				strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </TD>';

				strDiv += '    <td class="product_code">' + row.product_name + '</td>';

				let discount_kr = row.discount_kr;
				strDiv += '    <td style="text-align: right;">';
				if (discount_kr > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
					strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
				} else {
					if(row.price_kr != null){
						strDiv += '        ' + row.price_kr;
					}
				}
				strDiv += '    </td>';

				let discount_en = row.discount_en;
				strDiv += '    <td style="text-align: right;">';
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en + "</span></br>";
				} else {
					if(row.price_en != null){
						strDiv += '        ' + row.price_en;
					}
				}
				strDiv += '    </td>';

				let discount_cn = row.discount_cn;
				strDiv += '    <td style="text-align: right;">';
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn + "</span></br>";
				} else {
					if(row.price_cn != null){
						strDiv += '        ' + row.price_cn;
					}
				}
				strDiv += '    </td>';
				
				strDiv += '    <TD>';
				strDiv += '        <TABLE>';
				strDiv += '            <THEAD>';
				strDiv += '                <TR>';
				strDiv += '                    <TH>옵션이름</TH>';
				strDiv += '                    <TH>바코드</TH>';
				strDiv += '                    <TH>상품재고</TH>';
				strDiv += '                    <TH>안전재고</TH>';
				strDiv += '                    <TH>주문재고</TH>';
				strDiv += '                    <TH>총 재고량</TH>';
				strDiv += '                </TR>';
				strDiv += '            </THEAD>';
				
				strDiv += '            <TBODY>';
				
				let product_stock = row.relevant_product_stock;
				product_stock.forEach(function(stock_row) {
					strDiv += '            <TR>';
					strDiv += '                <TD>' + stock_row.option_name + '</TD>';
					strDiv += '                <TD>' + stock_row.barcode + '</TD>';
					strDiv += '                <TD>' + stock_row.stock_qty + '</TD>';
					strDiv += '                <TD>' + stock_row.order_qty + '</TD>';
					strDiv += '                <TD>' + stock_row.safe_qty + '</TD>';
					strDiv += '                <TD>' + stock_row.product_qty + '</TD>';
					strDiv += '            </TR>';
				});
				
				strDiv += '            </TBODY>';
				strDiv += '        </TABLE>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, page);
}

function addTmpRelevantProduct(obj) {
	let product_idx = $(obj).attr('product_idx');
	let selected_tr = $('#selected_tr_' + product_idx);
	
	let product_code = selected_tr.find('.product_code').text();
	let product_name = selected_tr.find('.product_name').text();
	
	let strDiv = '<div class="tmp_relevant_product" product_idx="' + product_idx + '" onClick="removeTmpRelevantProduct(this);">' + product_code + ' | ' + product_name + '</div>';
	$('.tmp_relevant_wrap').append(strDiv);
}

function removeTmpRelevantProduct(obj) {
	$(obj).remove();
}

function setPaging(obj) {
	let product_type = $(obj).attr('product_type');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + product_type + '_total').text(total_cnt.val());
	$('.cnt_' + product_type + '_result').text(result_cnt.val());
}

function rowsChange(obj) {
	let product_type = $(obj).attr('product_type');
	
	let frm = $('#frm-filter_' + product_type);
	
	var rows = $(obj).val();
	
	frm.find('.rows').val(rows);
	frm.find('.page').val(1);

	getProdTabInfo();
}

function orderChange(obj) {
	let product_type = $(obj).attr('product_type');
	
	let frm = $('#frm-filter_' + product_type);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);

	getProdTabInfo();
}

function getRelevantProduct() {
	let cnt = $('.tmp_relevant_product').length;
	
	let product_idx = [];
	for (let i=0; i<cnt; i++) {
		product_idx.push($('.tmp_relevant_product').eq(i).attr('product_idx'));
	}
	
	if (product_idx.length > 0) {
		confirm(
			'선택한 상품을 관련상품으로 등록하시겠습니까?',
			function() {
				$.ajax({
					url: config.api + "product/relevant/get",
					type: "post",
					data: {
						'product_idx': product_idx
					},
					dataType: "json",
					error: function() {
						alert('상품 읽기 처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						if (d.code == 200) {
							let data = d.data;
							if (data != null) {
								let strDiv = "";
								
								data.forEach(function(row){
									strDiv += '<TR>';
									strDiv += '		<td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
									strDiv += '    <input class="relevant_idx" type="hidden" name="relevant_idx[]" value="' + row.product_idx + '">';
									strDiv += '</td>';
									
									var product_type = "";
									if (row.product_type == "B") {
										product_type = "일반";
									} else if (row.product_type == "S") {
										product_type = "세트";
									}
									strDiv += '    <td>' + product_type + '</td>';
									strDiv += '    <td>' + row.product_code + '</td>';

									let background_url = "background-image:url('" + row.img_location + "');";
									strDiv += '    <TD>';
									strDiv += '        <div class="product__img__wrap">';
									strDiv += '            <div class="product__img" style="' + background_url + '">';
									strDiv += '            </div>';
									strDiv += '            <div>';
									strDiv += '                <p>' + row.product_name + '</p><br>';
									strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
									strDiv += '            </div>';
									strDiv += '        </div>';
									strDiv += '    </TD>';

									let discount_kr = row.discount_kr;
									strDiv += '    <td style="text-align: right;">';
									if (discount_kr > 0) {
										strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
										strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
										strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
									} else {
										if(row.price_kr != null){
											strDiv += '        ' + row.price_kr;
										}
									}
									strDiv += '    </td>';

									let discount_en = row.discount_en;
									strDiv += '    <td style="text-align: right;">';
									if (discount_en > 0) {
										strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
										strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
										strDiv += '        <span>' + row.sales_price_en + "</span></br>";
									} else {
										if(row.price_en != null){
											strDiv += '        ' + row.price_en;
										}
									}
									strDiv += '    </td>';

									let discount_cn = row.discount_cn;
									strDiv += '    <td style="text-align: right;">';
									if (discount_cn > 0) {
										strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
										strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn + "</span></br>";
										strDiv += '        <span>' + row.sales_price_cn + "</span></br>";
									} else {
										if(row.price_cn != null){
											strDiv += '        ' + row.price_cn;
										}
									}
									strDiv += '    </td>';
									
									strDiv += '    <TD>';
									strDiv += '        <TABLE>';
									strDiv += '            <THEAD>';
									strDiv += '                <TR>';
									strDiv += '                    <TH>옵션이름</TH>';
									strDiv += '                    <TH>바코드</TH>';
									strDiv += '                    <TH>상품재고</TH>';
									strDiv += '                    <TH>안전재고</TH>';
									strDiv += '                    <TH>주문재고</TH>';
									strDiv += '                    <TH>총 재고량</TH>';
									strDiv += '                </TR>';
									strDiv += '            </THEAD>';
									
									strDiv += '            <TBODY>';
									
									let product_stock = row.relevant_product_stock;
									product_stock.forEach(function(stock_row) {
										strDiv += '            <TR>';
										strDiv += '                <TD>' + stock_row.option_name + '</TD>';
										strDiv += '                <TD>' + stock_row.barcode + '</TD>';
										strDiv += '                <TD>' + stock_row.stock_qty + '</TD>';
										strDiv += '                <TD>' + stock_row.order_qty + '</TD>';
										strDiv += '                <TD>' + stock_row.safe_qty + '</TD>';
										strDiv += '                <TD>' + stock_row.product_qty + '</TD>';
										strDiv += '            </TR>';
									});
									
									strDiv += '            </TBODY>';
									strDiv += '        </TABLE>';
									strDiv += '    </TD>';
									strDiv += '</TR>';
								});
								
								$('#relevant_product_table').append(strDiv);
							}
							
							confirm(
								'선택한 상품이 관련상품으로 추가되었습니다.',
								function() {
									modal_close();
								}
							);
						}
					}
				});
			}
		);
	} else {
		
	}
}
</script>