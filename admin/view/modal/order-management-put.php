<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
</style>

<div class="content__card modal__view" style="max-width:1000px;margin: 0;">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>교환상품 검색</h3>
			<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body" style="width:1000px;">
		<form id="frm-filter_OEX" action="order/pg/modal/product/list/get">
			<input id="param_order_code" type="hidden" name="order_code" value="<?=$order_code?>">
			
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			
			<input type="hidden" class="rows" name="rows" value="5">
			<input type="hidden" class="page" name="page" value="1">
			
			<input type="hidden" name="product_idx" value="<?=$product_idx?>">
			
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
					<div onclick="getExchangeProductlist();"  class="blue__color__btn"><span>검색</span></div>
					<div onclick="init_fileter('frm-filter_OEX','getProductListOEX')"  class="defult__color__btn"><span>초기화</span></div>
				</div>
			</div>
		</div>
		
		<div class="content__card" style="max-width:1000px;margin-top:15px;">
			<input type="hidden" class="action_type" name="action_type">
			<input type="hidden" class="action_name" name="action_name">
			
			<div class="card__header">
				<h3>상품 라이브러리 검색 결과</h3>
				<div class="drive--x"></div>
			</div>
			<div class="card__body">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 상품 수 <font class="cnt_M_OE_total info__count" >0</font>개 / 검색결과 <font class="cnt_M_OE_result info__count" >0</font>개
					</div>
						
					<div class="content__row">
						<select style="width:163px;float:right;margin-right:10px;" lib_type="PRD" onChange="orderChange(this);">
							<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
							<option value="CREATE_DATE|ASC">등록일 순</option>
							<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
							<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
							<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
							<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
							<option value="PRODUCT_CODE|DESC">상품 재고 역순</option>
							<option value="PRODUCT_CODE|ASC">상품 재고 순</option>
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
						<TABLE id="excel_table" style="min-width:100%;width:auto;">
							<colgroup>
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
									<TH>상품<br>구분</TH>
									<TH>교환접수 상품</TH>
									<TH>판매가<br>(한국몰)</TH>
									<TH>판매가<br>(영문몰)</TH>
									<TH>판매가<br>(중국몰)</TH>
									<TH>상품<br/>재고</TH>
									<TH>판매<br/>수량</TH>
									<TH>잔여<br/>재고</TH>
								</TR>
							</THEAD>
							<TBODY class="result_table_M_OEX">
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="result_table_M_PWT" style="min-width:100%;width:auto;">
							<colgroup>
								<col width="80px;">
								<col width="50px;">
								<col width="auto;">
								<col width="150px;">
								<col width="100px;">
								<col width="80px;">
								<col width="80px;">
								<col width="80px;">
							</colgroup>
							<THEAD>
								<TR>
									<TH>교환상품<br/>삭제</TH>
									<TH>상품<br>구분</TH>
									<TH>교환대상 상품</TH>
									<TH>상품수량</TH>
									<TH>상품가격</TH>
									<TH>상품<br/>재고</TH>
									<TH>판매<br/>수량</TH>
									<TH>잔여<br/>재고</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
								
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="div_exchange_price" style="width:100%;display:flex;margin-top:15px;line-height:2.5;">
					<div style="width:25%;">
						<font id="price_oex" style="font-size:12px;float:right;line-height:2.5;">0</font>
						<font style="font-size:12px;float:right;margin-right:10px;line-height:2.5;">교환접수상품 판매가격 : </font>
					</div>
					<div style="width:25%;">
						<font id="price_pwt" style="font-size:12px;float:right;line-height:2.5;">0</font>
						<font style="font-size:12px;float:right;margin-right:10px;line-height:2.5;">교환대상상품 판매가격 : </font>
					</div>
					<div style="width:25%;">
						<font id="price_calc" style="font-size:12px;float:right;line-height:2.5;">0</font>
						<font id="price_type" style="font-size:12px;float:right;line-height:2.5;margin-right:5px;"></font>
						<font style="font-size:12px;float:right;line-height:2.5;margin-right:10px;">교환계산금액 : </font>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="excel_table" style="min-width:100%;width:auto;">
							<colgroup>
								<col width="80px;">
								<col width="80px;">
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
									<TH>교환상품<br/>추가</TH>
									<TH>No.</TH>
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
							<TBODY class="result_table_M">
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setModalPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setModalPaging(this);">
					<div class="paging_M"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:flex">
				<div class="blue__color__btn" style="margin:0 auto" onClick="addTmpOrderInfo();"><span>신규주문 생성</span></div>
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {
	getProductListOEX();
	getProductListPWT();
});

function getProductListOEX() {
	let order_code = $('#param_order_code').val();
	
	let result_table = $('.result_table_M_OEX');
	
	$.ajax({
		type: "post",
		url: config.api + "order/pg/modal/exchange/get",
		data: {
			'order_code' : order_code
		},
		dataType: "json",
		error: function() {
			alert('환불완료 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					result_table.html('');
					
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<tr>';
						
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
						strDiv += '                <p>' + row.option_name + '</p><br>';
						strDiv += '                <p>' + row.barcode + '</p><br>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_kr = row.discount_kr;
						if (discount_kr > 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr + "</span></br>";
							strDiv += '        <span>' + row.sales_price_kr + "</span></br>";
						} else {
							strDiv += '        ' + row.price_kr;
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_en = row.discount_en;
						if (discount_en > 0) {
							strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
							strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en + "</span></br>";
							strDiv += '        <span>' + row.sales_price_en + "</span></br>";
						} else {
							strDiv += '        ' + row.price_en;
						}
						
						strDiv += '    </td>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_cn = row.discount_cn;
						if (discount_cn > 0) {
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
					
					result_table.append(strDiv);
					
					getExchangeProductlist();
				}
			} else {
				alert(d.msg);
			}
		}
	});
}

function getExchangeProductlist() {
	let frm = $("#frm-filter_OEX");
	
	let result_table = $(".result_table_M");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:center;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging_M"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '        <div class="btn" onClick="addProductPWT(' + row.product_idx + ',' + row.option_idx + ');">추가</div>'
				strDiv += '    </td>';
				strDiv += '    <td>' + row.num + '</td>';
				
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
				strDiv += '                <p>' + row.option_name + '</p><br>';
				strDiv += '                <p>' + row.barcode + '</p><br>';
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
				
				result_table.append(strDiv);
			});
		},
	},rows,1);
}

function getProductListPWT() {
	let order_code = $('#param_order_code').val();
	
	let result_table = $('#result_table_M_PWT');
	let result_body = result_table.find('.result_body');
	
	$.ajax({
		type: "post",
		url: config.api + "order/pg/modal/exchange/list/get",
		data: {
			'order_code' : order_code
		},
		dataType: "json",
		error: function() {
			alert('환불완료 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				
				result_body.html('');
				if (data.length > 0 && data != []) {
					data.forEach(function(row) {
						var strDiv = "";
						strDiv += '<tr>';
						strDiv += '    <td>';
						strDiv += '        <div class="btn" onClick="deleteProductPWT(' + row.order_product_idx + ');">삭제</div>'
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
						strDiv += '                <p>' + row.option_name + '</p><br>';
						strDiv += '                <p>' + row.barcode + '</p><br>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						strDiv += '    <td>';
						strDiv += '        <div style="display:flex;">';
						strDiv += '            <font style="width:30%;line-height:2.5;">' + row.order_product_qty + '</font>';
						strDiv += '            <div style="width:70%;display:flex;">';
						strDiv += '                <div class="btn" style="margin-right:10px;" onClick="putProductPWT(' + row.order_product_idx + ',' + row.order_product_qty + ',\'UP\');">+</div>';
						strDiv += '                <div class="btn" style="margin-right:10px;" onClick="putProductPWT(' + row.order_product_idx + ',' + row.order_product_qty + ',\'DOWN\');">-</div>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </td>';
						strDiv += '    </td>';
						strDiv += '    <td style="text-align: right;">' + row.product_price + '</td>';
						strDiv += '    </td>';
						strDiv += '    <td>' + row.stock_qty + '</td>';
						strDiv += '    <td>' + row.order_qty + '</td>';
						strDiv += '    <td>' + row.product_qty + '</td>';
						strDiv += '</tr>';
						
						result_body.append(strDiv);
					});
					
					calcProductPrice(order_code);
				} else {
					let strDiv = "";
					strDiv += '<TD class="default_td" colspan="10" style="text-align:center;">';
					strDiv += '    조회 결과가 없습니다';
					strDiv += '</TD>';
					
					result_body.append(strDiv);
				}
			} else {
				alert(d.msg);
			}
		}
	});
}

function addProductPWT(product_idx,option_idx) {
	let order_code = $('#param_order_code').val();
	$.ajax({
		type: "post",
		url: config.api + "order/pg/modal/exchange/add",
		data: {
			'order_code' : order_code,
			'product_idx' : product_idx,
			'option_idx' : option_idx,
			'product_qty' : 1,
		},
		dataType: "json",
		error: function() {
			alert('환불완료 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				getProductListPWT(order_code);
			} else {
				alert(d.msg);
			}
		}
	});
}

function putProductPWT(order_product_idx,order_product_qty,action_type) {
	let order_code = $('#param_order_code').val();
	
	if (order_product_qty == 1 && action_type == "DOWN") {
		alert('상품의 수량을 0 미만으로 변경할 수 없습니다');
		return false;
	}
	
	$.ajax({
		type: "post",
		url: config.api + "order/pg/modal/exchange/put",
		data: {
			'order_product_idx' : order_product_idx,
			'order_product_qty' : order_product_qty,
			'action_type' : action_type,
		},
		dataType: "json",
		error: function() {
			alert('환불완료 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				getProductListPWT(order_code);
			} else {
				alert(d.msg);
			}
		}
	});
}

function deleteProductPWT(order_product_idx) {
	let order_code = $('#param_order_code').val();
	
	confirm(
		'교환대상 상품을 삭제하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "order/pg/modal/exchange/delete",
				data: {
					'order_product_idx' : order_product_idx
				},
				dataType: "json",
				error: function() {
					alert('환불완료 처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						getProductListPWT(order_code);
					} else {
						alert(d.msg);
					}
				}
			});
		}
	);
}

function calcProductPrice(order_code) {
	$.ajax({
		type: "post",
		url: config.api + "order/pg/modal/exchange/check",
		data: {
			'order_code' : order_code
		},
		dataType: "json",
		error: function() {
			alert('교환금액 계산 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					let price_type = data.price_type;
					if (price_type == "+") {
						$('#price_type').css('font-weight','500');
						$('#price_type').css('color','#140f82');
						
						$('#price_calc').css('font-weight','500');
						$('#price_calc').css('color','#140f82');
					} else if (price_type == "-") {
						$('#price_type').css('font-weight','500');
						$('#price_type').css('color','#e7505a');
						
						$('#price_calc').css('font-weight','500');
						$('#price_calc').css('color','#e7505a');
					}
					
					$('#price_type').text(data.price_type);
					$('#price_oex').text(data.price_oex);
					$('#price_pwt').text(data.price_pwt);
					$('#price_calc').text(data.price_calc);
				}
			}
		}
	});
}

function addTmpOrderInfo() {
	let order_code = $('#param_order_code').val();
	
	confirm(
		'선택한 교환대상 상품으로 새로운 주문정보를 생성하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "order/pg/tmp",
				data: {
					'order_code' : order_code
				},
				dataType: "json",
				error: function() {
					alert('신규주문 생성처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						getOrderInfoList();
						alert(
							'신규 주문이 생성되었습니다.',
							function() {
								modal_close()
							}
						);
					} else {
						alert(d.msg);
					}
				}
			});
		}
	)
	
}

function setModalPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_M_OE_total').text(total_cnt.val());
	$('.cnt_M_OE_result').text(result_cnt.val());
}

</script>