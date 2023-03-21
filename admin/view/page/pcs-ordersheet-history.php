<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/history/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>오더시트 히스토리 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
					</div>
				</div>
			</div>
            <div class="content__wrap">
                <div class="content__title">상품명</div>
                <div class="content__row">
                    <input type="text" name="product_name" value="">
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">상품코드</div>
                <div class="content__row">
                    <input type="text" name="product_code" value="">
                </div>
            </div>
			<div class="content__wrap">
                <div class="content__title">작성자</div>
                <div class="content__row">
                    <input type="text" name="creater" value="">
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">권한</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="ordersheet_auth" value="ALL" checked>
						<div><div></div></div>
						<span>전체</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="ordersheet_auth" value="MD" >
						<div><div></div></div>
						<span>기획</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="ordersheet_auth" value="DSN">
						<div><div></div></div>
						<span>디자인</span>
					</label>
                    <label class="rd__square">
						<input type="radio" name="ordersheet_auth" value="TD">
						<div><div></div></div>
						<span>생산</span>
					</label>
				</div>
            </div>
            <div class="content__wrap">
                <div class="content__title">엑션타입</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="action_type" value="ALL" checked>
						<div><div></div></div>
						<span>전체</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="action_type" value="W" >
						<div><div></div></div>
						<span>등록</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="action_type" value="U">
						<div><div></div></div>
						<span>수정</span>
					</label>
                    <label class="rd__square">
						<input type="radio" name="action_type" value="D">
						<div><div></div></div>
						<span>삭제</span>
					</label>
				</div>
			</div>
            <div class="content__wrap">
                <div class="content__title">등록일</div>
                <div class="content__row">
                    <div class="content__date__wrap">
                        <div class="content__date__picker">
                            <input id="min_create_date" class="date_param" type="date" name="min_create_date" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="create_date" onChange="dateParamChange(this);">
                            <font>~</font>
                            <input id="max_create_date" class="date_param" type="date" name="max_create_date" placeholder="To" readonly style="width:150px;" date_type="create_date" onChange="dateParamChange(this);">
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getOrdersheetHistoryTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getOrdersheetHistoryTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="content__card">
	<form id="frm-list">
		<div class="card__header">
			<h3>오더시트 히스토리 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 히스토리 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
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
						<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
					</div>                                
				</div>
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:3%;">No.</TH>
                            <TH style="width:6%;">권한</TH>
							<TH style="width:6%;">엑션타입</TH>
							<TH style="width:6%;">상품코드</TH>
							<TH style="width:15%;">상품명</TH>
							<TH>메세지</TH>
                            <TH style="width:7%;">작성자</TH>
							<TH style="width:10%;">작성일자</TH>
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

<script>

var category = null;
$(document).ready(function() {
	getOrdersheetHistoryTabInfo();
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
function getOrdersheetHistoryTabInfo(){
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
                var auth_str = '';
				switch(row.ordersheet_auth){
                    case 'MD':
                        auth_str = '기획'
                        break;
                    case 'DSN':
                        auth_str = '디자인'
                        break;
                    case 'TD':
                        auth_str = '생산'
                        break;
                }
                var type_str = '';
                switch(row.action_type){
                    case 'W':
                        type_str = '등록';
                        break;
                    case 'U':
                        type_str = '수정';
                        break;
                    case 'D':
                        type_str = '삭제';
                        break;
                }
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
				            <td>${auth_str}</td>
                            <td>${type_str}</td>
							<td>${row.product_code}</td>
				            <td>${row.product_name}</TD>
                            <td>${row.history_msg}</TD>
							<td>${row.creater}</td>
                            <td>${row.create_date}</td>
				        </tr>
				`;
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "create_date") {
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
function excelDownload() {
	if ($('#result_table').find('.default_td').length > 0) {
		alert('다운로드 할 오더시트 히스토리를 검색해주세요.');
	} else {
		
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "오더시트 히스토리 목록";
		file_name = "오더시트 히스토리 목록_" + file_date;
		insertLog("상품관리 > 오더시트 히스토리 목록", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getOrdersheetHistoryTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getOrdersheetHistoryTabInfo();
}

</script>
