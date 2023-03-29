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
<?php
	$db->query('SELECT SUB_MATERIAL_NAME FROM SUB_MATERIAL_INFO WHERE IDX = '.$sub_material_idx.' ');

	foreach($db->fetch() as $sub_material_data){
?>
		<h3>
		[<?=$sub_material_data['SUB_MATERIAL_NAME']?>]부자재를 사용중인 상품 목록
			<a onclick="modal_close();" class="btn-close">
				<i class="xi-close"></i>
			</a>
		</h3>
<?php
	}
?>
	</div>
	
	<div class="card__body" style="margin-top:50px">
		<form id="frm-sub_material_product" action="pcs/ordersheet/modal/get">
			<input type="hidden" name="sub_material_idx" value="<?=$sub_material_idx?>">
			<input class="page" type="hidden" name="page" value="1">
			<input class="rows" type="hidden" name="rows" value="10">
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
			
			<div class="card__footer">
				<div class="footer__btn__wrap">
					<div class="tmp" toggle="tmp"></div>
					<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getModalProductList();"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-sub_material_product','getModalProductList()');"><span>초기화</span></div>
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
							</select>
							<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="changeRowsProduct(this);">
								<option value="10" selected>10개씩보기</option>
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
										<TH>스타일 코드</TH>
										<TH>컬러 코드</TH>
										<TH>상품 코드</TH>
										<TH>상품명</TH>
										<TH style="width:15%;">상품 상세페이지 이동</TH>
									</TR>
								</THEAD>
								<TBODY id="result_modal_table">
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
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:block">
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
	getModalProductList();
});

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
	var length = $('#frm-sub_material_product').find('.search_type_select').length;
	
	if (length > 1) {
		var search_type_arr = [];
		for (var i=0; i<length; i++) {
			search_type_arr[i] = $('#frm-sub_material_product').find('.search_type_select').eq(i).val();
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

function changeOrderProduct(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-sub_material_product').find('.sort_value').val(order_value[0]);
	$('#frm-sub_material_product').find('.sort_type').val(order_value[1]);

	getModalProductList();
}

function changeRowsProduct(obj) {
	var rows = $(obj).val();
	
	$('#frm-sub_material_product').find('.rows').val(rows);
	$('#frm-sub_material_product').find('.page').val(1);

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
	$("#result_modal_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="14">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_modal_table").append(strDiv);
	
	let rows = $("#frm-sub_material_product").find('.rows').val();
	let page = $("#frm-sub_material_product").find('.page').val();
	
	get_contents($("#frm-sub_material_product"),{
		pageObj : $(".modal_product_paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					$("#result_modal_table").html('');
				}
				d.forEach(function(row) {
					let strDiv = "";
					strDiv += '<TR>';
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

					strDiv += '    <TD style="width:15%;">';
					strDiv += '        <a href="http://116.124.128.246:81/pcs/ordersheet?ordersheet_idx=' + row.ordersheet_idx + '" onClick="window.open(this.href); return false;">오더시트 상세 페이지 이동</a>';
					strDiv += '    </TD>';
					strDiv += '</TR>';
					
					$("#result_modal_table").append(strDiv);
				});
			}
			
		},
	},rows, page);
}
</script>