<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
</style>
<div class="content__card">
	<form id="frm-filter" action="pm/ordersheet/list/get">
		<input type="hidden" name="regist_flg" value="true">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="tab_num" name="tab_num" value="01">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>독립몰 상품 등록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
					</div>
					<div>
						<button type="button" style="height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;cursor:pointer;" onclick="ordersheetActionCheck('true')">개인결제/스팟성 상품등록</button>
					</div>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">스타일코드</div>
					<div class="content__row">
						<input type="text" name="style_code" value="">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">색상코드</div>
					<div class="content__row">
						<input type="text" name="color_code" value="">
					</div>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">상품코드</div>
					<div class="content__row">
						<input type="text" name="product_code" value="">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">상품명</div>
					<div class="content__row">
						<input type="text" name="product_name" value="">
					</div>
				</div>
			</div>

			<div class="content__wrap">
				<div class="content__title">프리오더</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="preorder_flg" value="all" checked>
						<div><div></div></div>
						<span>전체</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="preorder_flg" value="false" >
						<div><div></div></div>
						<span>고객상품</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="preorder_flg" value="true">
						<div><div></div></div>
						<span>프리오더상품</span>
					</label>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상품 분류</div>
				<div class="content__row">
					<input type="text" class="search_keyword" name="category_lrg" placeholder="대분류" value="" style="width:10%;">
					<input type="text" class="search_keyword" name="category_mdl" placeholder="중분류" value="" style="width:10%;">
					<input type="text" class="search_keyword" name="category_sml" placeholder="소분류" value="" style="width:10%;">
					<input type="text" class="search_keyword" name="category_dtl" placeholder="세분류" value="" style="width:10%;">
				</div>
			</div>

			<div class="card__body--hide detail_hidden" style="display: none;">
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">소재</div>
						<div class="content__row">
							<input type="text" name="material" value="">
						</div>
					</div>
					<div class="half__box__wrap">
						<div class="content__title">그래픽</div>
						<div class="content__row">
							<input type="text" name="graphic" value="">
						</div>
					</div>
				</div>	

				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">핏</div>
						<div class="content__row">
							<input type="text" name="fit" value="">
						</div>
					</div>
					<div class="half__box__wrap">
						<div class="content__title">사이즈</div>
						<div class="content__row">
							<input type="text" name="product_size" value="">
						</div>
					</div>
				</div>

				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">색상</div>
						<div class="content__row">
							<input type="text" name="color" value="">
						</div>
					</div>
					<div class="half__box__wrap">
						<div class="content__title">색상코드</div>
						<div class="content__row">
							<input type="text" name="color_rgb" value="">
						</div>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">네비게이션</div>
					<div class="content__row">
						<input type="text" name="navigation" value="">
					</div>
				</div>

				<div class="content__wrap">
					<div class="content__title">상품 가격</div>
					<div class="price_type_td">
						<div class="content__row country_price">
							<input type="hidden" class="price_type_list" value="">
							
							<select id="price_type" class="fSelect price_type" name="price_type[]" style="width:163px;" onChange="priceTypeChange(this);">
								<option value="">상품가격 선택</option>	
								<option value="PRICE_KR">한국몰 가격</option>
								<option value="PRICE_EN">영문몰 가격</option>
								<option value="PRICE_CN">중국몰 가격</option>
							</select>
							
							<input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
							<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> 
							<font>~</font>
							<input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">
							<span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>
							
							<button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">-</button>
							<button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">+</button>
						</div>
					</div>
				</div>

				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">재고등급</div>
						<div class="content__row">
							<label class="rd__square">
								<input type="radio" name="product_stock_grade" value="all" checked>
								<div><div></div></div>
								<span>전체</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="product_stock_grade" value="NML" >
								<div><div></div></div>
								<span>일반재고</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="product_stock_grade" value="IMP">
								<div><div></div></div>
								<span>중요재고</span>
							</label>
						</div>
					</div>
					<div class="half__box__wrap">
						<div class="content__title">마일리지 사용유무</div>
						<div class="content__row">
							<label class="rd__square">
								<input type="radio" name="mileage_flg" value="all" checked>
								<div><div></div></div>
								<span>전체</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="mileage_flg" value="true">
								<div><div></div></div>
								<span>사용함</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="mileage_flg" value="false">
								<div><div></div></div>
								<span>사용안함</span>
							</label>
						</div>
					</div>
				</div>

				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">단독구매 제한</div>
						<div class="content__row">
							<label class="rd__square">
								<input type="radio" name="exclusive_flg" value="all" checked>
								<div><div></div></div>
								<span>전체</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="exclusive_flg" value="true" >
								<div><div></div></div>
								<span>제한함</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="exclusive_flg" value="false">
								<div><div></div></div>
								<span>제한안함</span>
							</label>
						</div>
					</div>
					<div class="half__box__wrap">
						<div class="content__title">런칭일</div>
						<div class="content__row">
							<div class="content__date__wrap">
								<div class="content__date__picker">
									<input id="min_launching_date" class="date_param" type="date" name="min_launching_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="launching_date" onChange="dateParamChange(this);">
									<font>~</font>
									<input id="max_launching_date" class="date_param" type="date" name="max_launching_date" placeholder="To" readonly style="width:150px;" date_type="launching_date" onChange="dateParamChange(this);">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div class="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getOrdersheetTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getOrdersheetTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>
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
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">삭제일 역순</option>
						<option value="UPDATE_DATE|ASC">삭제일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
						<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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
				</div>
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
							<TH style="width:3%;">No.</TH>
							<TH style="width:6%;">상품코드</TH>
							<TH>상품명</TH>
							<TH >등록자</TH>
							<TH >등록일자</TH>
							<TH >수정자</TH>
							<TH >수정일자</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table">
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
            <div class="card__footer">
                <div class="footer__btn__wrap" style="grid: none;">
                    <div class="btn__wrap--lg">
                        <div  class="blue__color__btn" onClick="ordersheetActionCheck('false')"><span>선택한 상품 등록</span></div>
                    </div>
                </div>
            </div> 
		</div>
	</form>
</div>

<script>

var category = null;
$(document).ready(function() {
	$("#price_search").on('change','.fSelect.price',function(){
		var price_search_div = $(this).parent();
		switch($(this).val()){
			case 'PRICE_SELL_KR_KRW':
				price_search_div.find('#unit_from').text(" KRW ~");
				price_search_div.find('#unit_to').text(" KRW ");
				price_search_div.find(".search_prod_price").val('');
				break;
			case 'PRICE_SELL_EN_USD':
				price_search_div.find('#unit_from').text(" USD ~");
				price_search_div.find('#unit_to').text(" USD ");
				price_search_div.find(".search_prod_price").val('');
				break;
			case 'PRICE_SELL_CN_USD':
				price_search_div.find('#unit_from').text(" USD ~");
				price_search_div.find('#unit_to').text(" USD ");
				price_search_div.find(".search_prod_price").val('');
				break;
		}
	});
	$('input[name=category_all_flg]').change(function(){
		if($('input[name=category_all_flg]').is(":checked")){
			$('.fSelect.category').find("option:eq(0)").prop("selected", true);
			$('input[name=child_search_flg]').removeAttr("checked");
		}
	});
	getOrdersheetTabInfo();
});

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
function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('.detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('.detail_toggle').text('상세검색 열기 +');
	}
	$('.detail_hidden').toggle();
}

function priceTypeBtnClick(obj) {
	var price_type = $('#frm-filter').find('.price_type');
	var length = price_type.length;
	
	var action_type = $(obj).attr('action_type');
	
	if (action_type == "append") {
		if (length < 3) {
			var strDiv = '<div class="content__row country_price">';
			strDiv += '    <input type="hidden" class="price_type_list" value="">';

			strDiv += '    <select id="price_type" class="fSelect price_type" name="price_type[]" style="width:163px;" onChange="priceTypeChange(this);">';
			strDiv += '        <option value="">상품가격 선택</option>    ';
			strDiv += '        <option value="SALES_PRICE_KR">한국몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_EN">영문몰 가격</option>';
			strDiv += '        <option value="SALES_PRICE_CN">중국몰 가격</option>';
			strDiv += '    </select>';

			strDiv += '    <input type="text" name="price_min[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span> ';
			strDiv += '    <font>~</font>';
			strDiv += '    <input type="text" name="price_max[]" class="search_prod_price" value="" style="width:100px;margin-right:5px;">';
			strDiv += '    <span class="price_type_unit" style="width:30px;margin-left:10px;margin-right:10px;">단위</span>';

			strDiv += '    <button type="button" action_type="remove" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">-</button>';
			strDiv += '    <button type="button" action_type="append" style="width:30px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;" onClick="priceTypeBtnClick(this);">+</button>';
			strDiv += '</div>';
			
			$(obj).unbind();
			$('#frm-filter').find('.price_type_td').append(strDiv);
		} else {
			alert('상품가격 유형은 3개까지 선택 가능합니다.');
		}
	} else if (action_type == "remove") {
		if (length == 1) {
			alert('최소 1개 이상의 상품가격 유형을 지정해야 합니다.');
		} else {
			$(obj).parent().remove();
		}
	}
}

function priceTypeChange(obj) {
	var this_val = $(obj).val();
	var length = $('#frm-filter').find('.price_type').length;
	
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
			price_type_arr[i] = $('#frm-filter').find('.price_type').eq(i).val();
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

function getOrdersheetTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}

			d.forEach(function(row) {
				var background_url = "background-image:url('" + row.ordersheet_img + "');";
				var strDiv 				= "";
				var update_flg_str 		= "";
				var btn_class 			= "";
				var btn_onclick_func 	= "";
				strDiv = `
						<tr> 
							<td>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="ordersheet_idx_list[]" value="${row.ordersheet_idx}">
										<span></span>
									</label>
								</div>
							</td>
							<td>${row.num}</td>
							<td>
								<font ordersheet_idx="${row.ordersheet_idx}" >${row.product_code}</font>
							</td>
							<td style="cursor:pointer" onclick="location.href='/product/ordersheet/get?ordersheet_idx=${row.ordersheet_idx}'">
								<div class="product__img__wrap">
									<div class="product__img" style="${background_url}"></div>
									<div>
										<p>${row.product_name}</p><br>
									</div>
								</div>
							</TD>
							<td>${row.creater}</td>
							<td>${row.create_date}</td>
							<td>${row.updater}</td>
							<td>${row.update_date}</td>
						</tr>
				`;
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "launching_date") {
		var min_create_date = $("#min_create_date").val();
		var max_create_date = $("#max_create_date").val();

		var start_date = new Date(min_create_date);
		var end_date = new Date(max_create_date);
		var now_date = new Date();

		if(start_date > now_date) {
			alert('검색 시작일에 올바른 날짜를 입력해주세요.');
			$(obj).val('');
			return false;
		}
		if(start_date > end_date) {
			alert('검색 시작일/종료일에 올바른 날짜를 입력해주세요.');
			$(obj).val('');
			return false;
		}
	}
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
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

function ordersheetActionCheck(flg) {
	if(flg == 'true'){
		location.href = '/product/independence/register';
	}
	else if(flg == 'false'){
		confirm('독립몰 상품등록작업을 진행하시겠습니까?', function(){
			var select_idx = [];
			var length = $('#frm-list').find('.select').length;
			
			for (var i=0; i<length; i++) {
				if ($('#frm-list').find('.select').eq(i).prop('checked') == true) {
					select_idx.push($('#frm-list').find('.select').eq(i).val());
				}
			}
			if (select_idx.length == 0) {
				alert('독립몰 상품등록 할 상품를 선택해주세요.');
			} else {
				var cnt = 0;
				var action_name = "독립몰 상품등록";
				
				var formData = new FormData();
				formData = $("#frm-list").serializeObject();
				
				$.ajax({
					type: "post",
					data: formData,
					dataType: "json",
					url: config.api + "product/add_new",
					error: function() {
						alert('독립몰 상품등록 처리에 실패했습니다.');
					},
					success: function(d) {
						if(d.code == 200) {
							alert('독립몰 상품등록작업 처리에 성공했습니다.');
							insertLog("상품관리 > 독립몰 상품등록", '독립몰 상품등록', select_idx.length);
							getOrdersheetTabInfo();
						}
						else{
							alert(d.msg);
						}
					}
				});
			}
		});
	}

	
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getOrdersheetTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getOrdersheetTabInfo();
}

</script>
