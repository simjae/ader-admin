<style>
#seo {
	margin-top : 50px;
}
.sub {
	margin-top : 10px;
}
.tmp_set_product {
	width:230px;
	height:20px;
	line-height:10px;
	background-color:#140f82;
	border-radius:5px;
	color:#ffffff;
	font-size:0.5px;
	overflow:hidden;
	text-overflow:ellipsis;
	white-space:nowrap;
	padding:5px;
	margin-right:5px;
	margin-top:5px;
	float:left;
	cursor:pointer;
}
.btn-close{float:right;color:'#000';}
</style>
<div class="content__card modal__view" style="margin: 0;">	
	<div class="card__header">
		<h3>
		상품 목록
			<a onclick="modal_close();" class="btn-close">
				<i class="xi-close"></i>
			</a>
		</h3>
	</div>
	
	<div class="card__body" >
		<form id="frm-product_add" action="product/modal/list/get">
			<input class="page" type="hidden" name="page" value="1">
			<input class="rows" type="hidden" name="rows" value="5">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row search_type_div" style="display: block;">
					<div class="search_type">
						<select class="fSelect eSearch search_type_select" name="search_type[]" style="width:163px;" onChange="changeSearchType(this);">
							<option value="ALL" selected>검색분류 선택</option>
							<option value="name">상품명</option>
							<option value="code">상품코드</option>
						</select>
						
						<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
						
						<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">-</button>
						<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">+</button>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">재고수량</div>
					<div class="content__row">
						<select class="fSelect" name="stock_type" style="width:163px;">
							<option value="stock">재고수량</option>
							<option value="safe">안전재고</option>
						</select>
						
						<input type="number" name="stock_min" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
						~
						<input type="number" name="stock_max" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">품절 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<label class="rd__square">
								<input type="radio" name="sold_out_status" value="all" checked>
								<div><div></div></div>
								<span>전체</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="sold_out_status" value="false">
								<div><div></div></div>
								<span>품절</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="sold_out_status" value="true">
								<div><div></div></div>
								<span>품절 아님</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 가격</div>
				<div class="price_type_div">
					<div class="content__row price_type">
						<select class="fSelect price_type_select" name="price_type[]" style="width:163px;" onChange="changePriceType(this);">
							<option value="">상품가격 선택</option>	
							<option value="SALES_PRICE_KR">한국몰 가격</option>
							<option value="SALES_PRICE_EN">영문몰 가격</option>
							<option value="SALES_PRICE_CN">중국몰 가격</option>
						</select>
						
						<input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
						<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> 
						<font>~</font>
						<input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
						<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>
						
						<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">-</button>
						<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">+</button>
					</div>
				</div>
			</div>
			
			<div class="card__footer">
				<div class="footer__btn__wrap">
					<div class="tmp" toggle="tmp"></div>
					<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getModalProductList();"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-product_add','getModalProductList()');"><span>초기화</span></div>
					</div>
				</div>
			</div>
		</form>
		<div class="content__card">
			<form id="frm-list">
				<div class="card__header">
					<h3>상품 목록 검색 결과</h3>
					<div class="drive--x"></div>
				</div>
				
				<div class="card__body">
					<div class="info__wrap " style="justify-content:space-between; align-items: center;">
						<div class="body__info--count">
							<div class="drive--left"></div>
							총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
						</div>
							
						<div class="content__row">
							<select style="width:163px;float:right;margin-right:10px;" onChange="changeOrderProduct(this);">
								<option value="CREATE_DATE|DESC">등록일 역순</option>
								<option value="CREATE_DATE|ASC">등록일 순</option>
								<option value="PRODUCT_NAME|DESC">상품명 역순</option>
								<option value="PRODUCT_NAME|ASC">상품명 순</option>
								<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
								<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
								<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
								<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
								<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
								<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
							</select>
							<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="changeRowsProduct(this);">
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
						<div class="table__filter">
							<input id="set_product_list" type="hidden" value="">
							<div class="tmp_set_product_wrap">
								
							</div>
						</div>
						
						<div class="overflow-x-auto">
							<TABLE>
								<THEAD>
									<TR>
										<TH style="width:3%;">
											<div class="cb__color">
												<label>
													<input type="checkbox" checkbox_type="modal_product" onClick="clickSelectAll(this);">
													<span></span>
												</label>
											</div>
										</TH>
										<TH style="width:3%;">상품<br>구분</TH>
										<TH>스타일 코드</TH>
										<TH>컬러 코드</TH>
										<TH>상품 코드</TH>
										<TH>상품명</TH>
										<TH style="width:8%;">판매가<br>(한국몰)</TH>
										<TH style="width:8%;">판매가<br>(영문몰)</TH>
										<TH style="width:8%;">판매가<br>(중국몰)</TH>
										<TH style="width:50px;">총 재고량</TH>
										<TH style="width:50px;">재고수량</TH>
										<TH style="width:50px;">판매수량</TH>
										<TH style="width:50px;">안전재고</TH>
										<TH style="width:15%;">상품 옵션</TH>
									</TR>
								</THEAD>
								<TBODY id="result_table">
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
						<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
						<div class="modal_product_paging"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="hide"></div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="addSetProduct();"><span>세트 상품 추가</span></div>
				<div class="defult__color__btn" onClick="init_fileter('frm-filter','getProdTabInfo');"><span>초기화</span></div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
	getModalProductList();
});

function clickSelectAll(obj) {
	let checkbox_type = $(obj).attr('checkbox_type');
	
	let checkbox = null;
	checkbox = $('.modal_product_checkbox');
	
	if ($(obj).prop('checked') == true) {
		checkbox.prop('checked',true);
		
		if (checkbox_type == "modal_product") {
			let cnt = checkbox.length;
			for (let i=0; i<cnt; i++) {
				let product_idx = checkbox.eq(i).val();
				
				let result = checkSetProduct(product_idx);
				if (result == false) {
					break;
				}
			}
		}
	} else {
		checkbox.prop('checked',false);
		
		if (checkbox_type == "modal_product") {
			let cnt = checkbox.length;
			for (let i=0; i<cnt; i++) {
				let product_idx = checkbox.eq(i).val();
				
				removeSetProduct(product_idx);
			}
		}
	}
}

function checkSearchType(obj) {
	let action_type = $(obj).attr('action_type');
	let cnt = $('.search_type').length;
	
	if (action_type == "append") {
		if (cnt < 2) {
			let strDiv = "";
			strDiv += '<div class="search_type">';
			strDiv += '    <select class="fSelect eSearch search_type_select" name="search_type[]" style="width:163px;" onChange="changeSearchType(this);">';
			strDiv += '        <option value="" selected>검색분류 선택</option>';
			strDiv += '        <option value="name">상품명</option>';
			strDiv += '        <option value="code">상품코드</option>';
			strDiv += '    </select>';
			strDiv += '    <input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">';
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkSearchType(this);">+</button>';
			strDiv += '</div>';
			
			$('.search_type_div').append(strDiv);
		} else {
			alert('검색분류를 더이상 추가할 수 없습니다.');
			return false;
		}
	} else if (action_type == "remove") {
		if (cnt > 1) {
			let search_type = $(obj).parent();
			search_type.remove();
		} else if (cnt == 1) {
			alert('1개 이상의 검색분류를 지정해주세요.');
			return false;
		}
	}
}

function changeSearchType(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-product_add').find('.search_type_select').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-product_add').find('.search_type_select').eq(i).val();
		}
		
		const result = search_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 검색분류를 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
		}
	}
}

function checkPriceType(obj) {
	let action_type = $(obj).attr('action_type');
	let cnt = $('.price_type_select').length;
	
	if (action_type == "append") {
		if (cnt < 3) {
			let strDiv = "";
			strDiv += '<div class="content__row price_type">';
			strDiv += '    <select class="fSelect price_type_select" name="price_type[]" style="width:163px;" onChange="changePriceType(this);">';
			strDiv += '        <option value="">상품가격 선택</option>';
			strDiv += '        <option value="SALES_PRICE_KR">한국몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_EN">영문몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_CN">중국몰 가격</option>';
			strDiv += '    </select>';
			
			strDiv += '    <input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> ';
			
			strDiv += '    <font>~</font>';
			
			strDiv += '    <input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>';
			
			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="checkPriceType(this);">+</button>';
			strDiv += '</div>';
			
			$('.price_type_div').append(strDiv);
		} else {
			alert('검색분류를 더이상 추가할 수 없습니다.');
			return false;
		}
	} else if (action_type == "remove") {
		if (cnt > 1) {
			let search_type = $(obj).parent();
			search_type.remove();
		} else if (cnt == 1) {
			alert('1개 이상의 검색분류를 지정해주세요.');
			return false;
		}
	}
}

function changePriceType(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-product_add').find('.price_type_select').length;
	
	var unit_text = "";
	switch (this_val) {
		case "SALES_PRICE_KR" :
			unit_text = "KRW";
			break;
		
		case "SALES_PRICE_EN" :
			unit_text = "USD";
			break;
		
		case "SALES_PRICE_CN" :
			unit_text = "USD";
			break;
	}
	
	$(obj).parent().find('.price_type_unit').text(unit_text);
	
	if (length > 1) {
		var price_type_arr = [];
		for (var i=0; i<length; i++) {
			price_type_arr[i] = $('#frm-product_add').find('.price_type_select').eq(i).val();
		}
		
		const result = price_type_arr.reduce((accu, curr) => { 
			accu[curr] = (accu[curr] || 0)+1; 
			return accu;
		}, {});
		
		if (result[this_val] > 1) {
			alert('중복된 상품가격 유형을 선택할 수 없습니다.');
			$(obj).children().eq(0).prop("selected", true);
			$('.price_type_unit').text('단위');
		}
	}
}

function changeOrderProduct(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-product_add').find('.sort_value').val(order_value[0]);
	$('#frm-produc_add').find('.sort_type').val(order_value[1]);

	getModalProductList();
}

function changeRowsProduct(obj) {
	var rows = $(obj).val();
	
	$('#frm-product_add').find('.rows').val(rows);
	$('#frm-product_add').find('.page').val(1);

	getModalProductList();
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}

function getModalProductList() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="14">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	let rows = $("#frm-product_add").find('.rows').val();
	let page = $("#frm-product_add").find('.page').val();
	
	let set_product_list = $('#set_product_list');
	let tmp_product_idx = [];
	if (set_product_list.val().length > 0) {
		tmp_product_idx = set_product_list.val().split(',');
	}
	
	get_contents($("#frm-product_add"),{
		pageObj : $(".modal_product_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
				let strDiv = "";
				
				let checked_str = "";
				
				let result = -1;
				result = tmp_product_idx.indexOf(row.product_idx.toString());
				if (result > -1) {
					checked_str = "checked";
				}
				
				strDiv += '<TR>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input id="modal_product_checkbox_' + row.product_idx + '" class="modal_product_checkbox" type="checkbox" name="product_idx[]" value="' + row.product_idx + '" onChange="clickSetProduct(this);" ' + checked_str + '>';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
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
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_kr != null){
						strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let discount_en = row.discount_en;
				strDiv += '    <td style="text-align: right;">';
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_en != null){
						strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let discount_cn = row.discount_cn;
				strDiv += '    <td style="text-align: right;">';
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
				} else {
					if(row.price_cn != null){
						strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
					}
				}
				strDiv += '    </td>';

				let stock_qty = row.stock_qty;
				let order_qty = row.order_qty;
				let safe_qty = row.safe_qty;

				let product_qty = stock_qty - order_qty;

				strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
				strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
				strDiv += '    <TD style="width:15%;">';
				strDiv += '        <a href="http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '" onClick="window.open(this.href); return false;">상품 상세 페이지 이동</a>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function clickSetProduct(obj) {
	let checked = $(obj).prop('checked');
	let product_idx = $(obj).val();
	
	if (checked == true) {
		checkSetProduct(product_idx);
	} else {
		removeSetProduct(product_idx);
	}
}

function checkSetProduct(product_idx) {
	let set_product_list = $('#set_product_list');
	let tmp_idx_arr = [];
	
	if (set_product_list.val().length > 0) {
		tmp_idx_arr = set_product_list.val().split(',');
	}
	
	let result = -1;
	result = tmp_idx_arr.indexOf(product_idx);
	
	if (result < 0) {
		tmp_idx_arr.push(product_idx);
		set_product_list.val(tmp_idx_arr);
		
		addTmpSetProduct(product_idx);
	} else {
		alert('중복된 상품을 세트 상품으로 등록할 수 없습니다.');
		return false;
	}
}

function removeSetProduct(product_idx) {
	let product_idx_arr = [];
	$('.set_product_' + product_idx).remove();
	$('#modal_product_checkbox_' + product_idx).prop('checked',false);
	
	let cnt = $('.tmp_set_product').length;
	for (let i=0; i<cnt; i++) {
		let tmp_product_idx = $('.tmp_set_product').eq(i).attr('product_idx');
		product_idx_arr.push(tmp_product_idx);
	}
	
	$('#set_product_list').val(product_idx_arr);
}

function addTmpSetProduct(product_idx) {
	$.ajax({
		url: config.api + "product/get_new",
		type: "post",
		data: {
			'sel_idx': product_idx
		},
		dataType: "json",
		error: function() {
			alert('상품정보를 불러오지 못했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				
				let strDiv = '<div class="tmp_set_product set_product_' + data[0].product_idx + '" product_idx="' + data[0].product_idx + '" onClick="removeSetProduct(' + data[0].product_idx + ')">' + data[0].product_code + ' | ' + data[0].product_name + '</div>';
				$('.tmp_set_product_wrap').append(strDiv);
			} else {
				alert('세트 상품 추가 처리에 실패했습니다. 추가하려는 세트 상품을 확인해주세요.');
				return false;
			}
		}
	});
}

function addSetProduct() {
    confirm('선택한 상품을 세트상품으로 등록하시겠습니까?',function(){
        //let set_product_list = $('#set_product_list').val();
        var list_cnt = $('.tmp_set_product_wrap').children().length;
        $('#set_product_list_area').css('visibility','visible');
        $('#set_product_table').html('');
        for(var i = 0; i < list_cnt; i++){
            var sel_prod = $('.tmp_set_product_wrap').children().eq(i);
            var sel_idx = sel_prod.attr('product_idx')
            $.ajax({
                url: config.api + "product/modal/get",
                type: "post",
                data: {
                    'product_idx': sel_idx
                },
                dataType: "json",
                error: function() {
                    alert('상품 읽기 처리중 오류가 발생했습니다.');
                },
                success: function(d) {
                    let code = d.code;
                    if (code == 200) {
                        var row = d.data[0];
                        let strDiv = "";

                        strDiv += '<TR>';
						strDiv += `		<td onclick="setProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
											<input type="hidden" name="product_idx_list[]" value="${row.product_idx}">
										</td>`;
                        var product_type = "";
                        if (row.product_type == "B") {
                            product_type = "일반";
                        } else if (row.product_type == "S") {
                            product_type = "세트";
                        }
                        strDiv += '    <td>' + product_type + '</td>';
                        
                        strDiv += '    <td>' + row.style_code + '</td>';
                        strDiv += '    <td>' + row.color_code + '</td>';
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
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(row.price_kr != null){
                                strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

                        let discount_en = row.discount_en;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_en > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(row.price_en != null){
                                strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

                        let discount_cn = row.discount_cn;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_cn > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(row.price_cn != null){
                                strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

						let stock_qty = row.stock_qty;
						let order_qty = row.order_qty;
						let safe_qty = row.safe_qty;

						let product_qty = stock_qty - order_qty;

						strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
						strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
						strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
						strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
						strDiv += '    <TD style="width:15%;">';

						var init_option_arr = [];
						if(row.option_info != null){
							var tmp_strDiv = '';
							row.option_info.forEach(function (option_row){
								
								tmp_strDiv += `
											<label style="margin-bottom:5px;margin-left:5px;justify-content:flex-start!important">
												<input type="checkbox" class="product__option" value="${option_row.option_idx}" style="margin-right:7px;" checked>
												<span>${option_row.option_name}</span>
											</label>
										`;
								init_option_arr.push(option_row.option_idx);
							});
							strDiv +=  `	<input type="hidden" name="option_list_str[]" value="${init_option_arr.join(',')}">`;
							strDiv += tmp_strDiv;
						}
						strDiv += '    </TD>';
						strDiv += '</TR>';

                        $('#set_product_table').append(strDiv);

						$('.product__option').on('click', function(){
							var sel_td = $(this).parent().parent();
							var checked_option = sel_td.find("input:checkbox:checked");
							var option_arr = [];
							if(checked_option != null){
								for(var i = 0; i < checked_option.length; i++){
									option_arr.push(checked_option.eq(i).val());
									
								}
							}
							sel_td.find('input[name="option_list_str[]"]').eq(0).val(option_arr.join(','));
						})

                        modal_close();
                    } else {
                        alert('상품 읽기에 실패했습니다.');
                        return false;
                    }
                }
            });
        }
    })
}
</script>