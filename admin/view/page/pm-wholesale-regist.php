<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.btn__gray{
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor:pointer;
	}
</style>
<div class="content__card">
	<form id="frm-list" action="pm/wholesale/list/get">
		<!--<input type="hidden" name="ordersheet_idx" value="">-->
		<input type="hidden" name="product_code" value="">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="5">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3>홀세일 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 홀세일 목록 수 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="DUE_DATE|DESC">납기예정일 역순</option>
						<option value="DUE_DATE|ASC">납기예정일 순</option>
						<option value="PRODUCT_QTY|DESC">납기 수량 역순</option>
						<option value="PRODUCT_QTY|ASC">납기 수량 순</option>
						<option value="COUNTRY|DESC">국가 역순</option>
						<option value="COUNTRY|ASC">국가 순</option>
						<option value="BUYER|DESC">바이어 역순</option>
						<option value="BUYER|ASC">바이어 순</option>
						<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">갱신일 역순</option>
						<option value="UPDATE_DATE|ASC">갱신일 순</option>
					</select>
					<select style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:5%;">No.</TH>
							<TH style="width:12%;">상품코드</TH>
							<TH style="width:12%;">상품명</TH>
							<TH style="width:12%;">국가</TH>
							<TH style="width:12%;">바이어</TH>
							<TH style="width:10%;">홀세일 납기 예정일</TH>
							<TH style="width:10%;">홀세일 납기 수량</TH>
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
		</div>
	</form>
</div>
<div class="content__card">
	<div class="card__header">
		<h3>선택 홀세일 총 갯수</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap table">
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:15%;">상품코드</TH>
						<TH style="width:15%;">상품명</TH>
						<TH style="width:15%;">국가</TH>
						<TH style="width:15%;">바이어</TH>
						<TH style="width:20%;">홀세일 납기일</TH>
						<TH style="width:20;">홀세일 납기 총수량</TH>
					</TR>
				</THEAD>
				
				<TBODY id="result_table_total">
					<TD class="default_td" colspan="6">
						홀세일을 선택해주세요.
					</TD>
				</TBODY>
			</TABLE>
		</div>
	</div>
</div>
<div class="content__card">
    <div class="card__header">
        <h3>홀세일 등록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
				<input type="hidden" name="ordersheet_idx" value="">
                <div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="insert_table_wholesale_info">
							<THEAD>
								<TR>
									<TH style="width:12%">상품 코드</TH>
									<TH style="width:12%">국가</TH>
									<TH style="width:12%">바이어</TH>
									<TH style="width:12%">제조사 납기 예정일</TH>
									<TH style="width:12%">제조사 납기 수량</TH>
									<TH style="width:40%">메모</TH>
								</TR>
							</THEAD>
							<TBODY>
								<TR>
									<TD>
										<span id="product_code_td"><span>
                                    </TD>
									<TD><input type="text" name="country" value="" ></TD>
									<TD><input type="text" name="buyer" value="" ></TD>
									<TD>
										<input id="due_date" class="margin-bottom-6 dateParam" type="date" name="due_date" onchange="dateParamChange(this)">
									</TD>
									<TD><input type="number" name="product_qty" value=""></TD>
									<TD><input type="text" name="memo" value=""></TD>
								</TR>
							</TBODY>
						</TABLE>
                	</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;"
				onClick="confirm('홀세일을 등록하시겠습니까?.','wholesaleInsert()');">홀세일등록</button>
		</div>
    </div>
</div>
<script>

$(document).ready(function() {
	urlParsing();
});
function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("&");

		for(var i = 0; i < data_arr.length; i++){
			var param_obj = data_arr[i].split('=');
			switch(param_obj[0]){
				case 'ordersheet_idx':
					$('#frm-list').find('input[name=ordersheet_idx]').val(param_obj[1]);
					$('#frm-regist').find('input[name=ordersheet_idx]').val(param_obj[1]);
					break;
				case 'product_code':
					$('#frm-list').find('input[name=product_code]').val(param_obj[1]);
					$('#product_code_td').text(param_obj[1]);
					break;
			}
		}
		getWholesaleInfo();
		getWholesaleTotal();
	}
}

function dateParamChange(obj) {
	var param = $(obj).val();
	var param_date = new Date(param);

	var param_year = param_date.getFullYear();
	var param_month = ("0" + (1 + param_date.getMonth())).slice(-2);
	var param_day = ("0" + param_date.getDate()).slice(-2);

	var param_result = param_year + '-' + param_month + '-' + param_day;

	if(param_result < getToday()){
		alert('이전 날짜로 납기 예정일을 입력할 수 없습니다.');
		return false;
	}
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-list').find('.page').val(1);

	getWholesaleInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);

	getWholesaleInfo();
}

function getWholesaleInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="7">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-list").find('.rows').val();
	var page = $("#frm-list").find('.page').val();
	
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
                var strDiv = "";
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
							<td>${row.product_code}</td>
							<td>${row.product_name}</td>
							<td>${row.country}</td>
							<td>${row.buyer}</td>
							<td>${row.due_date}</td>
							<td>${row.product_qty}</td>
				        </tr>
				`;
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function getWholesaleTotal() {
	$('#result_table_total').html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="6">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_total").append(strDiv);

	var product_code = $('#product_code_td').text();
	$.ajax({
		type: "post",
		data: {
			'product_code' : product_code
		},
		dataType: "json",
		url: config.api + "pm/wholesale/get",
		error: function() {
			alert("홀세일 작성 처리에 실패했습니다.");
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
								<td>${row.country}</td>
								<td>${row.buyer}</td>
								<td>${row.due_date_text}</td>
								<td>${row.product_sum_qty}</td>
							</tr>
					`;
					totalQty += row.product_sum_qty * 1;
					
				});
				strDiv += `
					<TR>
						<td colspan="5" style="text-align:right;">총 합계</td>
						<td>${totalQty}</td>
					</TR>
				`;
				$("#result_table_total").append(strDiv);
			}
		}
	});
}

function wholesaleInsert() {
	var country = $('#insert_table_wholesale_info').find('input[name=country]').val();
	if(country.length == 0){
		alert('등록하려는 홀세일의 국가를 입력해주세요');
		return false;
	}

	var buyer = $('#insert_table_wholesale_info').find('input[name=buyer]').val();
	if(buyer.length == 0){
		alert('등록하려는 홀세일의 바이어를 입력해주세요');
		return false;
	}

	var due_date = $('#insert_table_wholesale_info').find('input[name=due_date]').val();
	if(due_date.length == 0){
		alert('등록하려는 홀세일의 납기 예정일을 입력해주세요');
		return false;
	}
	else{
		if(due_date < getToday()){
			alert('이전 날짜로 납기 예정일을 입력할 수 없습니다.');
			return false;
		}
	}

	var product_qty = $('#insert_table_wholesale_info').find('input[name=product_qty]').val();
	if(product_qty.length == 0){
		alert('등록하려는 홀세일의 납기 수량 입력해주세요');
		return false;
	}
	else{
		if(product_qty < 0){
			alert('홀세일 납기 수량은 0보다 작을 수 없습니다.');
			return false;		
		}
	}

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/wholesale/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("홀세일 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('홀세일이 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/pm/wholesale/list';
				});
			}
		}
	});
}

function getToday(){
	var date = new Date();
	var year = date.getFullYear();
	var month = ("0" + (1 + date.getMonth())).slice(-2);
	var day = ("0" + date.getDate()).slice(-2);

	return year + '-' + month + '-' + day;
}
</script>