<style>
.add_admin_btn {width:150px;text-align:center;float:right;}
.auth_admin_btn {width:150px;text-align:center;float:right;}
.content__card .btn__wrap--sm{margin-right: 0;}
.store__info__btn{padding: 5px 10px;background-color: #fff;border: solid 1px #bfbfbf;border-radius: 2px;width: 100%;cursor: pointer;}
.store__delete__btn{padding: 5px 10px;background-color: #e7505a;color: #fff;border-radius: 2px;width: 100%;cursor: pointer;}
.eye-btn {background-color: blue;padding: 5px 10px;margin: 5px;color: #fff;border: solid 1px #191919;cursor:pointer;}
.trash-btn {background-color: red;padding: 5px 10px;margin: 5px;color: #fff;border: solid 1px #191919;cursor:pointer;}
.search-btn {background-color: #191919;padding: 5px 20px;color: #fff;margin-top: 20px;border-radius: 5px;cursor:pointer;}
.date-btn {width:50px;height: 30px;border: 1px solid;background-color: #ffffff;border-radius: 5px;cursor:pointer;}
.exel-btn {border: #191919 solid 1px;padding: 5px;cursor:pointer;}
</style>

<?php include_once("check.php"); ?>

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
					<select name="rows" style="width: 163px;" row_type="admin" onChange="rowsChange(this);">
						<option value="10" selected>10개씩보기</option>
						<option value="20">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
					
					<select style="width:163px;float:right;margin-right:10px;" order_type="admin" onChange="orderChange(this);">
						<option value="JOIN_DATE|DESC" selected>등록일 역순</option>
						<option value="JOIN_DATE|ASC">등록일 순</option>
						<option value="ADMIN_ID|ASC">운영자 ID 순</option>
						<option value="ADMIN_ID|DESC">운영자 ID 역순</option>
					</select>
				</div>
			</div>
			<div class="table__filter">
				<div style="width:100%;margin-top:15px;margin-bottom:5px;display:flex;">
					<div style="width:50%;">
						<div class="btn" onClick="putAdminStatus('ACT')">활성</div>
						<div class="btn" onClick="putAdminStatus('DAC')">비활성</div>
					</div>
					<div style="width:50%;">
						<div class="btn add_admin_btn" style="margin-left:10px;" onClick="openAdminModal('ADD',0)">운영자 등록</div>
						<div class="btn auth_admin_btn" onClick="openAdminModal('AUTH',0)">운영자 권한 일괄 설정</div>
					</div>
				</div>
			</div>
			<form id="frm-admin" action="store/admin/list/get">
				<input type="hidden" class="sort_type" name="sort_type" value="DESC">
				<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
				
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">
				
				<TABLE id="admin_table">
					<THEAD>
						<tr>
							<th>
								<div class="cb__color">
									<label for="">
										<input class="select" type="checkbox" name="adminMemberListIdx" onclick="selectAllClick(this);"><span></span> 
									</label>
								</div>
							</th>
							<th>번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th>닉네임</th>
							<th>상태</th>
							<th>생성일</th>
							<th></th>
						</tr>
					</THEAD>
					<TBODY class="result_table">
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
	<form id="frm-log" action="store/log/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>업무 처리 목록 검색</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">처리자</div>
				<div class="content__row">
					<input class="creater" type="text" name="creater" value="">
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
							<div class="search_date_admin date__picker " date_type="admin" date="01y" type="button"  onclick="searchDateClick(this);">1년</div>
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
						<div  class="blue__color__btn" onClick="getLogInfoList()"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_filter('frm-log','getLogInfoList')"><span>초기화</span></div>
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
				<select name="rows" style="width: 163px;" row_type="log" onChange="rowsChange(this);">
					<option value="10" selected>10개씩보기</option>
					<option value="20">20개씩보기</option>
					<option value="30">30개씩보기</option>
					<option value="50">50개씩보기</option>
					<option value="100">100개씩보기</option>
					<option value="200">200개씩보기</option>
					<option value="300">300개씩보기</option>
					<option value="500">500개씩보기</option>
				</select>
				<select style="width:163px;float:right;margin-right:10px;" order_type="log" onChange="orderChange(this);">
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
			</div>
			
			<TABLE id="excel_table">
				<THEAD>
					<tr>
						<th>No.</th>
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

<script>
var temp = 1;
$(document).ready(function(){
	let selectType01 = new CustomSelectBox('.select_box.type01');
	let selectType02 = new CustomSelectBox('.select_box.type02');
	let selectType03 = new CustomSelectBox('.select_box.type03');
	
	getAdminInfoList();
	getLogInfoList();
});

function getAdminInfo() {
	
}

function getAdminInfoList(){
	let frm = $("#frm-admin");
	let result_table = frm.find(".result_table");
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();

	get_contents(frm,{
		pageObj : $(".paging.admin"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR valign="middle">';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label for="">';
				strDiv += '                <input type="checkbox" class="select" name="adminMemberListIdx[]" value="' + row.admin_idx + '"><span></span> ';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.admin_id + '</TD>';
				strDiv += '    <TD>' + row.admin_name + '</TD>';
				strDiv += '    <TD>' + row.admin_nick + '</TD>';
				strDiv += '    <TD>' + row.admin_status + '</TD>';
				strDiv += '    <TD>' + row.join_date + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="btn__wrap--sm" style="justify-content: center;">';
				strDiv += '            <button class="store__info__btn" type="button" onClick="openAdminModal(\'PUT\',' + row.admin_idx + ');">정보</button>';
				strDiv += '            <button class="store__delete__btn" type="button" onClick="deleteAdminInfo(' + row.admin_idx + ');">삭제</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows,page);
}

function openAdminModal(action_type,admin_idx) {
	if (action_type == "AUTH" && admin_idx == 0) {
		let frm = $('#frm-admin');
		let result_table = frm.find('.result_table');
		
		let checkbox = result_table.find('.select');
		let cnt = checkbox.length;
		
		admin_idx_arr = [];
		for (let i=0; i<cnt; i++) {
			if (checkbox.eq(i).prop('checked') == true) {
				admin_idx_arr.push(checkbox.eq(i).val());
			}
		}
		
		if (admin_idx_arr.length > 0) {
			modal('auth','admin_idx=' + admin_idx_arr);
		} else {
			alert('권한을 설정하려는 운영자를 선택해주세요.');
			return false;
		}
	} else if (action_type == "ADD" && admin_idx == 0) {
		modal('/add');
	} else if (action_type == "PUT" && admin_idx > 0) {
		modal('put','admin_idx=' + admin_idx);
	}
}

function putAdminStatus(action_type) {
	let action_name = getActionName(action_type);
	
	let formData = new FormData();
	formData = $('#frm-admin').serialize();

	formData.admin_status_flg = true;
	formData.action_type = action_type;

	console.log(formData);
	if(formData['adminMemberListIdx[]'] == null || formData['adminMemberListIdx[]'].length == 0){
		alert('운영자를 선택해주세요');
		return false;
	}
	confirm(
		'선택한 운영자의 상태를 ' + action_name + '로 변경 하시겠습니까?',
		function () {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "store/admin/put",
				error: function() {
					alert(action_name + ' 처리에 실패했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						insertLog("상점관리 > 운영자 관리 > 운영자 리스트",action_name + "상태로 일괄번경",1);
						getAdminInfoList();
						alert(action_name + ' 처리에 성공했습니다.');
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	);
}

function getActionName(action_type) {
	let action_name = "";
	if (action_type == "ACT") {
		action_name = "활성";
	} else if (action_type == "DAC") {
		action_name = "비활성";
	}
	
	return action_name;
}

function deleteAdminInfo(admin_idx){
	confirm(
		'선택한 운영자를 삭제 하시겠습니까?',
		function () {
			$.ajax({
				type: "post",
				data: {
					'admin_idx' : admin_idx
				},
				dataType: "json",
				url: config.api + "store/admin/delete",
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
	)
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

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#admin_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#admin_table").find('.select').prop('checked',false);
	}
}

function rowsChange(obj) {
	let row_type = $(obj).attr('row_type');
	var rows = $(obj).val();
	
	switch(row_type){
		case 'admin':
			$('#frm-admin').find('.rows').val(rows);
			getAdminInfoList();
			break;
		
		case 'log':
			$('#frm-log').find('.rows').val(rows);
			getLogInfoList();
			break;
	}
}

function orderChange(obj) {
	let order_type = $(obj).attr('order_type');
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	switch(order_type){
		case 'admin':
			$('#frm-admin').find('.sort_value').val(order_value[0]);
			$('#frm-admin').find('.sort_type').val(order_value[1]);
			getAdminInfoList();
			break;
		
		case 'log':
			$('#frm-log').find('.sort_value').val(order_value[0]);
			$('#frm-log').find('.sort_type').val(order_value[1]);
			getLogInfoList();
			break;
	}
}

function getLogInfoList(){
	let frm = $("#frm-log");
	let result_table = $("#result_log_table")
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	frm.find('.page').val(1);

	get_contents(frm,{
		pageObj : $(".paging.log"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR>';
				strDiv += '    <td>';
				strDiv += '        <p>' + row.num + '</p>';
				strDiv += '    </td>';
				strDiv += '    <td>' + row.log_type + '</td>';
				strDiv += '    <td align="left">' + row.log_contents + '</td>';
				strDiv += '    <td>' + row.create_date + '</td>';
				strDiv += '    <td>';
				strDiv += '        <p>' + row.creater + '</p>';
				strDiv += '        <p style="margin-top:5px;">' + row.creater_ip + '</p>';
				strDiv += '    </td>';
				strDiv += '    <td>' + row.creater_level + '</td>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, 1);
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
</script>

