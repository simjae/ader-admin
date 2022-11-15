<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
</style>
<div class="content__card">
	<form id="frm-filter" action="pm/sample/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>샘플 관리 목록</h3>
		</div>
		<div class="drive--x"></div>
		<div class="card__body">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">스타일 코드</div>
					<div class="content__row">
						<input type="text" name="style_code" value="">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">컬러 코드</div>
					<div class="content__row">
						<input type="text" name="color_code" value="">
					</div>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">제품 코드</div>
					<div class="content__row">
						<input type="text" name="product_code" value="">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">제품 명</div>
					<div class="content__row">
						<input type="text" name="product_name" value="">
					</div>
				</div>
			</div>

			<div class="content__wrap">
                <div class="content__title">제조사</div>
                <div class="content__row">
					<input type="text" name="manufacturer" value="">
                </div>
            </div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">샘플 납기 예정일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input id="min_due_date" class="date_param" type="date" name="min_due_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="due_date" onChange="dateParamChange(this);">
								<font>~</font>
								<input id="max_due_date" class="date_param" type="date" name="max_due_date" placeholder="To" readonly style="width:150px;" date_type="due_date" onChange="dateParamChange(this);">
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">샘플 납기 수량</div>
					<div class="content__row">
						<input type="number" name="min_qty" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
						~
						<input type="number" name="max_qty" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
                <div  class="blue__color__btn" onClick="getSampleTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getSampleTabInfo()');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<div class="card__header">
		<h3>선택샘플 총 갯수</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap table">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div style="width: 50px;" class="filter__btn" action_type="prod_copy" onclick="resetSampleTotal();">초기화</div>
				</div>                                
			</div>
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:15%;">상품코드</TH>
						<TH style="width:15%;">상품명</TH>
						<TH style="width:25%;">샘플 생산공장</TH>
						<TH style="width:20%;">샘플 납기일</TH>
						<TH style="width:20;">샘플 납기 총수량</TH>
					</TR>
				</THEAD>
				
				<TBODY id="result_table_total">
					<TD class="default_td" colspan="5">
						샘플을 선택해주세요.
					</TD>
				</TBODY>
			</TABLE>
		</div>
	</div>
</div>

<div class="content__card">
	<form id="frm-list">
		<input type="hidden" class="action_type" name="action_type">
		<input type="hidden" class="action_name" name="action_name">
		
		<div class="card__header">
			<h3>샘플 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 샘플 목록 수 <font class="list_cnt cnt_total info__count" >0</font>개 / 검색결과 <font class="list_cnt cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">갱신일 역순</option>
						<option value="UPDATE_DATE|ASC">갱신일 순</option>
						<option value="PRODUCT_CODE|DESC">상품코드 역순</option>
						<option value="PRODUCT_CODE|ASC">상품코드 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
                        <option value="MANUFACTURER|DESC">생산공장명 역순</option>
						<option value="MANUFACTURER|ASC">생산공장명 순</option>
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
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" action_type="sample_delete" onclick="sampleActionCheck(this)">삭제</div>
						<div style="width: 140px;" class="filter__btn" onclick="">엑셀 다운로드</div>
					</div>                                
				</div>
				<div class="overflow-x-auto">
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
								<TH style="width:5%;">수정</TH>
								<TH style="width:8%;">제조사</TH>
								<TH style="width:8%;">상품코드</TH>
								<TH>상품명</TH>
								<TH style="width:10%;">납기 예정일</TH>
								<TH style="width:10%;">납기 수량</TH>
								<TH>등록자</TH>
								<TH>등록일자</TH>
								<TH>수정자</TH>
								<TH>수정일자</TH>
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
            	<div class="list_page paging"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getSampleTabInfo();
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
function getSampleTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="12">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".list_page.paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
				var ordersheet_img = row.ordersheet_img;
				var background_url = "background-image:url('" + ordersheet_img + "');";
				var strDiv = '';
				strDiv = `
					<tr > 
						<td>
							<div class="cb__color">
								<label>
									<input type="checkbox" class="select" name="sample_idx" value="${row.sample_idx}">
									<span></span>
								</label>
							</div>
						</td>
						<td>${row.num}</td>
						<td><button type="button" class="white_btn" onclick="location.href='/pm/sample/update?sample_idx=${row.sample_idx}&product_code=${row.product_code}'">편집</button></td>
						<td search-keyword="manufacturer" search-value="${row.manufacturer}" onclick="getSampleTotal(this)" style="cursor:pointer">${row.manufacturer}</td>
						<td search-keyword="product_code" search-value="${row.product_code}" onclick="getSampleTotal(this)" style="cursor:pointer">${row.product_code}</td>
						<td search-keyword="product_code" search-value="${row.product_code}" onclick="getSampleTotal(this)" style="cursor:pointer">
							<div class="product__img__wrap">
								<div class="product__img" style="${background_url}"></div>
								<div>
									<p>${row.product_name}</p><br>
								</div>
							</div>
						</TD>
						<td>${row.due_date}</td>
						<td>${row.product_qty}</td>
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

function sampleActionCheck(obj) {
	action_type = $(obj).attr('action_type');
	var select_idx = [];
	var length = $('#frm-list').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-list').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-list').find('.select').eq(i).val());
		}
	}
	if (select_idx.length == 0) {
		alert(action_name + ' 처리 할 샘플을 선택해주세요.');
	} else {
		var cnt = 0;
		
		var action_name = "";
		var action_target = "";
		
		switch (action_type) {
			case "sample_copy" :
				action_name = "샘플 복제";
				action_target = "정상";
				break;
			
			case "sample_delete" :
				action_name = "샘플 삭제";
				action_target = "정상";
				break;
		}
		$('.action_type').val(action_type);
		$('.action_name').val(action_name);
		
		confirm('선택한 샘플을 ' + action_name + ' 하시겠습니까?','sampleAction(' + select_idx.length + ')');
	}
    
}

function sampleAction(len){
	var api_str = '';
	var action_type = $('.action_type').val();
	var action_name = $('.action_name').val();
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();
		
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/sample/delete",
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				insertLog("상품관리 > 샘플 등록 ", action_name, len);
				getSampleTabInfo();
			}
		}
	});
}

function getSampleTotal(obj) {
	$('#result_table_total').html('');
	var keyword = $(obj).attr('search-keyword');
	var val = $(obj).attr('search-value');
	var apiParam = {};

	switch(keyword){
		case 'product_code':
			apiParam = {product_code : val};
			break;
		case 'manufacturer':
			apiParam = {manufacturer : val};
			break;
	}

	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_total").append(strDiv);

	$.ajax({
		type: "post",
		url: config.api + "pm/sample/get",
		data: apiParam,
		dataType: "json",
		error: function() {
			alert("샘플 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			console.log(d);
			if(d.code == 200) {
				var data = d.data;
				if (data.length > 0) {
					$("#result_table_total").html('');
				}
				var strDiv 				= "";
				var totalQty = 0;
				data.forEach(function(row) {
					strDiv += `
							<tr> 
								<td>${row.product_code}</td>
								<td>${row.product_name}</td>
								<td>${row.manufacturer}</td>
								<td>${row.due_date_text}</td>
								<td>${row.product_sum_qty}</td>
							</tr>
					`;
					totalQty += row.product_sum_qty * 1;
					
				});
				strDiv += `
					<TR>
						<td colspan="4" style="text-align:right;">총 합계</td>
						<td>${totalQty}</td>
					</TR>
				`;
				$("#result_table_total").append(strDiv);
			}
		}
	});
}

function resetSampleTotal(){
	$('#result_table_total').html('');

	var strDiv = `
		<TD class="default_td" colspan="5">
			샘플을 선택해주세요.
		</TD>
	`;
	$('#result_table_total').append(strDiv);
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "due_date") {

		var min_due_date = $("#min_due_date").val();
		var max_due_date = $("#max_due_date").val();

		var start_date = new Date(min_due_date);
		var end_date = new Date(max_due_date);
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
	$('.list_cnt.cnt_total').text(total_cnt.val());
	$('.list_cnt.cnt_result').text(result_cnt.val());
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
function excelDownload() {
	if ($('#result_table').find('.default_td').length > 0) {
		alert('다운로드 할 샘플목록을 검색해주세요.');
	} else {
        
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "샘플목록";
		file_name = "샘플목록_" + file_date;
		insertLog("상품관리 > 샘플목록", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
        
	}
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getSampleTabInfo();
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getSampleTabInfo();
}

</script>
