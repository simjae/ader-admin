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
	.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
</style>
<input id="param" type="hidden" value='<?=$param?>'>
<div class="content__card">
<div class="content__card">
	<form id="frm-modal-list" action="pm/factory/list/get">
		<input type="hidden" name="product_code" value="">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
            <div class="flex justify-between">
                <h3 id='bluemark_title'>공장수주 목록 검색 결과</h3>
                <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
            </div>
            <div class="drive--x"></div>
        </div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 공장수주 목록 수 <font class="modal_cnt cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">갱신일 역순</option>
						<option value="UPDATE_DATE|ASC">갱신일 순</option>
                        <option value="MANUFACTURER|DESC">제조사명 역순</option>
						<option value="MANUFACTURER|ASC">제조사명 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
						<option value="10" >10개씩보기</option>
						<option value="20" selected>20개씩보기</option>
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
                            <TH style="width:12%;">제조사</TH>
							<TH style="width:10%;">제조사 납기 예정일</TH>
							<TH style="width:10%;">제조사 납기 수량</TH>
						</TR>
					</THEAD>
					<TBODY id="result_modal_table">
                        
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="modal_page paging"></div>
        	</div>
		</div>
	</form>
</div>
<div class="content__card">
	<div class="card__header">
		<h3>선택 공장수주 총 갯수</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap table">
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:20%;">상품코드</TH>
						<TH style="width:20%;">상품명</TH>
						<TH style="width:20%;">제조사</TH>
						<TH style="width:20%;">제조사 납기일</TH>
						<TH style="width:20%;">제조사 납기 총수량</TH>
					</TR>
				</THEAD>
				
				<TBODY id="result_modal_table_total">
					<TD class="default_td" colspan="5">
						공장수주를 선택해주세요.
					</TD>
				</TBODY>
			</TABLE>
		</div>
	</div>
</div>
<div class="content__card">
    <div class="card__header">
        <h3>공장수주 수정</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
                <div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE id="insert_table_factory_info">
							<THEAD>
								<TR>
									<TH style="width:30%">상품 코드</TH>
									<TH style="width:30%">제조사</TH>
									<TH style="width:15%">제조사 납기 예정일</TH>
									<TH style="width:25%">제조사 납기 수량</TH>
								</TR>
							</THEAD>
							<TBODY id="result_modal_update_table">
								<TR>
								<TD id="product_code_td">
										<span id="product_code_td"><span>
                                    </TD>
									<TD>
										<input type="hidden" name="factory_idx" value="">
										<input type="text" name="manufacturer" value="" >
									</TD>
									<TD>
										<input id="due_date" class="margin-bottom-6 dateParam" type="date" name="due_date" onchange="dateParamChange(this)">
									</TD>
									<TD><input type="number" name="product_qty" value=""></TD>
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
				onClick="confirm('공장수주를 수정하시겠습니까?.','factoryUpdate()');">공장수주수정</button>
		</div>
    </div>
</div>
</div>
<script>

$(document).ready(function() {
    var param = $('#param').val();
    var param_data = eval("(" + param + ")");
	paramParsing(param_data);
});

function paramParsing(param_data){
    $('#frm-modal-list').find('input[name=product_code]').val(param_data.product_code);
    $('#product_code_td').text(param_data.product_code);
	$('input[name=factory_idx]').val(param_data.factory_idx);

    getFactoryInfo();
    getFactoryModalTotal();
}

function getFactoryInfo(){
	$("#result_modal_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_modal_table").append(strDiv);
	
	var rows = $("#frm-modal-list").find('.rows').val();
	var page = $("#frm-modal-list").find('.page').val();
	
	get_contents($("#frm-modal-list"),{
		pageObj : $(".modal_page.paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_modal_table").html('');
			}
			d.forEach(function(row) {
                var strDiv = "";
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
							<td>${row.product_code}</td>
							<td>${row.product_name}</td>
							<td>${row.manufacturer}</td>
							<td>${row.due_date}</td>
							<td>${row.product_qty}</td>
				        </tr>
				`;
				$("#result_modal_table").append(strDiv);
                
			})
			setfactoryInput();
		},
	},rows, page)
}

function setfactoryInput(){
    var factory_idx = $('input[name=factory_idx]').val();
	$.ajax({
		type: "post",
		data: {
			'factory_idx' : factory_idx
		},
		dataType: "json",
		url: config.api + "pm/factory/list/get",
		error: function() {
			alert("공장수주 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data.length > 0) {
					$('input[name=manufacturer]').val(data[0].manufacturer);
					$('input[name=due_date]').val(data[0].due_date);
					$('input[name=product_qty]').val(data[0].product_qty);
				}
			}
		}
	});
}

function getFactoryModalTotal() {
	$('#result_modal_table_total').html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_modal_table_total").append(strDiv);

	var product_code = $('#frm-modal-list').find('input[name=product_code]').val();

	$.ajax({
		type: "post",
		data: {
			'product_code' : product_code
		},
		dataType: "json",
		url: config.api + "pm/factory/get",
		error: function() {
			alert("공장수주 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data.length > 0) {
					$("#result_modal_table_total").html('');
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
				$("#result_modal_table_total").append(strDiv);
			}
		}
	});
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
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.modal_cnt.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-modal-list').find('.page').val(1);

	getFactoryInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-modal-list').find('.sort_value').val(order_value[0]);
	$('#frm-modal-list').find('.sort_type').val(order_value[1]);

	getFactoryInfo();
}

function factoryUpdate() {
	var manufacturer = $('#result_modal_update_table').find('input[name=manufacturer]').val();
	if(manufacturer.length == 0){
		alert('등록하려는 공장수주의 제조사를 입력해주세요');
		return false;
	}

	var due_date = $('#result_modal_update_table').find('input[name=due_date]').val();
	if(due_date.length == 0){
		alert('등록하려는 공장수주의 납기 예정일을 입력해주세요');
		return false;
	}
	else{
		if(due_date < getToday()){
			alert('이전 날짜로 납기 예정일을 입력할 수 없습니다.');
			return false;
		}
	}

	var product_qty = $('#result_modal_update_table').find('input[name=product_qty]').val();
	if(product_qty.length == 0){
		alert('등록하려는 공장수주의 납기 수량 입력해주세요');
		return false;
	}
	else{
		if(product_qty < 0){
			alert('공장수주 납기 수량은 0보다 작을 수 없습니다.');
			return false;		
		}
	}

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/factory/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("공장수주 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('공장수주가 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/product/factory';
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