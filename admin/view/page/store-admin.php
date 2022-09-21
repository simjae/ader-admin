<style>
.content__card .btn__wrap--sm{
	margin-right: 0;
}
.store__info__btn{
    padding: 5px 10px;
    background-color: #fff;
    border: solid 1px #bfbfbf;
    border-radius: 2px;
    cursor: pointer;
	width: 100%;
}
.store__delete__btn{
	padding: 5px 10px;
    background-color: #bfbfbf;
	color: #fff;
    border-radius: 2px;
    cursor: pointer;
	width: 100%;
}


</style>


<div class="content__card">
	<div class="card__header">
		<h3>운영자 관리</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap table">
			<div class="info__wrap" type="admin" style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					검색결과 <font id="admin_font" class="cnt_02_result info__count">0</font>건
				</div>
				<div class="content__row">
					<select name="rows" onChange="rowsChange(this);" style="width: 163px;">
						<option value="10" selected>10개씩보기</option>
						<option value="20">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="JOIN_DATE|DESC">등록일 역순</option>
						<option value="JOIN_DATE|ASC">등록일 순</option>
					</select>
				</div>
			</div>
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" action_type="status_set" action_name="활성" onClick="adminActionBtn(this)">활성 상태로 변경</div>
					<div class="filter__btn" action_type="status_set" action_name="비활성" onClick="adminActionBtn(this)">비활성 상태로 변경</div>
				</div> 	
			</div>
			<form id="frm-admin" action="store/admin/get">
				<input type="hidden" class="sort_type" name="sort_type" value="DESC">
				<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">
				<input type="hidden" class="action_type" name="action_type">
				<input type="hidden" class="action_name" name="action_name">
				<TABLE id="admin_table">
					<THEAD>
						<tr>
							<th>
								<div class="cb__color">
									<label for="">
										<input class="productListCheckbox" type="checkbox" name="adminMemberListIdx" onclick="selectAllClick(this);"><span></span> 
									</label>
								</div>
							</th>
							<th>번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th>닉네임</th>
							<th>관리권한</th>
							<th>상태</th>
							<th>생성일</th>
							<th></th>
						</tr>
					</THEAD>
					<TBODY id="result_admin_table">
					</TBODY>
				</TABLE>
				<div class="padding__wrap" type="admin">
					<input type="hidden" class="total_cnt" value="0" onChange="setResultCount(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setResultCount(this);">
					<div class="paging admin"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="content__card">
	<form id="frm-log" action="store/log/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>업무처리 관리</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">처리자</div>
				<div class="content__row">
					<select name="admin_permition" class="fSelect" style="width:163px;">
						<option value="">- 전체 -</option>
						<option value="1">메인 관리자</option>
						<option value="2">온라인 MD 관리자</option>
						<option value="3">기획 MD 관리자</option>
						<option value="4">아트 관리자</option>
						<option value="5">브랜드 관리자</option>
					</select>
					<input type='text' name='permition_keyword'>
				</div>
			</div>

			<div class="content__wrap">
				<div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_admin" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_admin date__picker " date_type="admin" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_admin date__picker " date_type="admin" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_admin date__picker " date_type="admin" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_admin date__picker " date_type="admin" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_admin date__picker " date_type="admin" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_admin date__picker " date_type="admin" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_admin date__picker " date_type="admin" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="admin_from" class="date_param  " type="date" name="admin_from"  placeholder="From" readonly="" style="width:150px;" date_type="admin" onChange="dateParamChange(this);">
							<font class="" >~</font>
							<input id="admin_to" class="date_param  " type="date" name="admin_to" placeholder="To" readonly="" style="width:150px;" date_type="admin" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>

			<div class="card__footer">
				<div class="footer__btn__wrap" style="grid: none;">
					<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getLogInfo()"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_filter('frm-log','getLogInfo')"><span>초기화</span></div>
					</div>
				</div>
			</div> 
		</div>
	</form>
</div>
<div class="content__card">
	<div class="card__header">
		<h3>업무 처리 목록</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap" type="log" style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				검색결과 <font id="log_font" class="cnt_02_result info__count">0</font>건
			</div>
			<div class="content__row">
				<select name="rows" onChange="rowsChange(this);" style="width: 163px;">
					<option value="10" selected>10개씩보기</option>
					<option value="20">20개씩보기</option>
					<option value="30">30개씩보기</option>
					<option value="50">50개씩보기</option>
					<option value="100">100개씩보기</option>
					<option value="200">200개씩보기</option>
					<option value="300">300개씩보기</option>
					<option value="500">500개씩보기</option>
				</select>
				<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
					<option value="CREATE_DATE|DESC">등록일 역순</option>
					<option value="CREATE_DATE|ASC">등록일 순</option>
				</select>
			</div>
		</div>
		<div class="table__wrap table" style="margin-top: 20px;">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div>               
				<div>
					<div class="table__setting__btn">설정</div>
				</div>                 
			</div>
			
			<TABLE id="excel_table">
				<THEAD>
					<tr>
						<th>NO</th>
						<th>구분</th>
						<th>업무내용</th>
						<th>처리일시</th>
						<th>처리자</th>
						<th>처리자구문</th>
					</tr>
				</THEAD>
				<TBODY id="result_log_table">
				</TBODY>
			</TABLE>
		</div>
	</div>
	<div class="padding__wrap" type="log">
		<input type="hidden" class="total_cnt" value="0" onChange="setResultCount(this);">
		<input type="hidden" class="result_cnt" value="0" onChange="setResultCount(this);">
		<div class="paging log"></div>
	</div>
</div>
<style>
	.eye-btn {
		background-color: blue;
		padding: 5px 10px;
		margin: 5px;
		color: #fff;
		border: solid 1px #191919;
	}

	.trash-btn {
		background-color: red;
		padding: 5px 10px;
		margin: 5px;
		color: #fff;
		border: solid 1px #191919;
	}

	.search-btn {
		background-color: #191919;
		padding: 5px 20px;
		color: #fff;
		margin-top: 20px;
		border-radius: 5px;
	}

	.date-btn {
		width: 50px;
		height: 30px;
		border: 1px solid;
		background-color: #ffffff;
		border-radius: 5px;
	}

	.exel-btn {
		border: #191919 solid 1px;
		padding: 5px;
	}
</style>
<script>
	var temp = 1;
$(document).ready(function(){
	let selectType01 = new CustomSelectBox('.select_box.type01');
	let selectType02 = new CustomSelectBox('.select_box.type02');
	let selectType03 = new CustomSelectBox('.select_box.type03');
	getAdminInfo();
	getLogInfo();
});
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#admin_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#admin_table").find('.select').prop('checked',false);
	}
}
function adminActionBtn(obj) {
	var action_type = $(obj).attr('action_type');
	var action_name = $(obj).attr('action_name');
	var select_idx = [];
	var length = $('#frm-admin').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-admin').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-admin').find('.select').eq(i).val());
		}
	}
	if (select_idx.length == 0) {
		alert(action_name + '상태로 변경할 운영자를 선택해주세요.');
	} 
	else {
		/*
		var cnt = 0;
		
		var action_name = "";
		var action_target = "";
		
		switch (action_type) {
			case "status_set" :
				action_name = "운영자 상태 변경";
				action_target = action_name;
				break;
		}
		*/
		$('.action_type').val(action_type);
		$('.action_name').val(action_name);
		
		confirm('선택한 운영자의 상태를 ' + action_name + '로 변경 하시겠습니까?','adminAction()');
	}
}
function adminAction(){
	var api_str = '';
	var action_type = $('.action_type').val();
	var action_name = $('.action_name').val();
	var formData = new FormData();
	formData = $("#frm-admin").serializeObject();
		
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "store/admin/set",
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				insertLog("상점관리 > 운영자 관리 > 운영자 리스트", action_name+"상태로 일괄번경", 1);
				getAdminInfo();
			}
		}
	});
}
function getAdminInfo(){
	var rows = $("#frm-admin").find('.rows').val();
	var page = $("#frm-admin").find('.page').val();

	get_contents($("#frm-admin"),{
		pageObj : $(".paging.admin"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_admin_table").html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<TR valign="middle">';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label for="">';
				strDiv += '                <input type="checkbox" class="select" name="adminMemberListIdx[]" value="' + row.idx + '"><span></span> ';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.no + '</TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>' + row.name + '</TD>';
				strDiv += '    <TD>' + row.nick + '</TD>';
				strDiv += '    <TD>' + row.permition + '</TD>';
				strDiv += '    <TD >' + row.status + '</TD>';
				strDiv += '    <TD>' + row.join_date + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="btn__wrap--sm" style="justify-content: center;">';
				strDiv += '            <input type="hidden" id="no" value="' + row.idx + '">';
				strDiv += '            <button class="store__info__btn" type="button" member_idx="' + row.idx + '"  onClick="modal(\'put\', \'idx=' + row.idx + '\');">정보</button>';
				strDiv += '            <button class="store__delete__btn" type="button" onClick="adminDelBtn(this);">삭제</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_admin_table").append(strDiv);
			});
		},
	},rows, page);
}
function adminDelBtn(obj){
	var sel_admin_no = $(obj).parent().find('input').eq(0).val();
	if(sel_admin_no != null && sel_admin_no > 0){
		confirm('선택한 운영자를 삭제 하시겠습니까?',`adminDel(${sel_admin_no})`);
	}
}
function adminDel(obj){
	if(obj != null && obj > 0){
		$.ajax({
			type: "post",
			data: { 'no' : obj },
			dataType: "json",
			url: config.api + "store/admin/del",
			error: function() {
				alert("운영자 삭제 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert('운영자 삭제 처리에 성공했습니다.');
					insertLog("상점관리 > 운영자 관리 > 운영자 목록", "운영자 개별삭제", 1);
					getAdminInfo();
				}
			}
		});
	}
}
function setResultCount(obj) {
	var parent_obj  = $(obj).parent();
	var parent_type = parent_obj.attr('type')
	var total_cnt  = parent_obj.find('.total_cnt');
	var result_cnt = parent_obj.find('.result_cnt');

	$('#'+parent_type+'_font').text(result_cnt.val());
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');
	
	var date_type = $(obj).attr('date_type');
	
	if (date_type == "admin") {
		$('.search_date_admin').not($(obj)).css('background-color','#ffffff');
		$('#search_date_admin').val(date);

		$('#admin_from').val('');
		$('#admin_to').val('');
	}
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	
	if (date_type == "admin") {
		$('.search_date_admin').css('background-color','#ffffff');
		$('.search_date_admin').css('color','#000000');
		
		$('#search_date_admin').val('');

		var date_from = $("#" + date_type + "_from").val();
		var date_to = $("#" + date_type + "_to").val();

		var start_date = new Date(date_from);
		var end_date = new Date(date_to);
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
function init_filter(frm_id, func_name){
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
function excelDownload() {
	if ($('#result_log_table').find('.default_td').length > 0) {
		alert('다운로드 할 상품을 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "업무처리 목록";
		file_name = "업무처리 목록" + file_date;
	
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));

		insertLog("상점관리 > 운영자 관리 > 업무 처리 목록", "엑셀다운로드 : "+file_name+"xlsx", 1);
	}
}
function rowsChange(obj) {
	var form_type = $(obj).parent().parent().attr("type");
	var rows = $(obj).val();
	
	switch(form_type){
		case 'admin':
			$('#frm-admin').find('.rows').val(rows);
			getAdminInfo();
			break;
		case 'log':
			$('#frm-log').find('.rows').val(rows);
			getLogInfo();
			break;
	}

}
function orderChange(obj) {
	var form_type = $(obj).parent().parent().attr("type");
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	switch(form_type){
		case 'admin':
			$('#frm-admin').find('.sort_value').val(order_value[0]);
			$('#frm-admin').find('.sort_type').val(order_value[1]);
			getAdminInfo();
			break;
		case 'log':
			$('#frm-log').find('.sort_value').val(order_value[0]);
			$('#frm-log').find('.sort_type').val(order_value[1]);
			getLogInfo();
			break;
	}
}
function getLogInfo(){
	$("#result_log_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_log_table").append(strDiv);
	
	var rows = $("#frm-log").find('.rows').val();
	$("#frm-log").find('.page').val(1);

	get_contents($("#frm-log"),{
		pageObj : $(".paging.log"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_log_table").html('');
			}
			d.forEach(function(row) {
				$("#result_log_table").append(`
					<TR>
						<td>
							<p>${row.no}</p>
						</td>
						<td>${row.log_type}</td>
						<td align="left">${row.log_contents}</td>
						<td>${row.create_date}</td>
						<td>
							<p>${row.creater}</p>
							<p>${row.creater_ip}</p>
						</td>
						<td>${row.creater_level}</td>
					</TR>
				`);
			});
		},
	},rows, 1);
}

function adminModal(obj) {
	var member_idx  = $(obj).attr('member_idx');
	var data = {'member_idx':member_idx};
	
	modal('put',data);
}
</script>

