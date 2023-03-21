<?php include_once("check.php"); ?>

<div class="filter-wrap" style="width:100%;margin-bottom:20px;display:flex;">
	<div style="width:50%;">
		<button class="event_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="eventTabBtnClick(this);">한국몰</button>
		<button class="event_tab_btn tap__button" country="EN" style="width:150px;" onClick="eventTabBtnClick(this);">영문몰</button>
		<button class="event_tab_btn tap__button" country="CN" style="width:150px;" onClick="eventTabBtnClick(this);">중국몰</button>
	</div>
</div>

<input id="country" type="hidden" value="KR">

<div id="event_tab_KR" class="row event_tab" style="margin-top:0px;">
	<?php include_once("display-event-kr.php"); ?>
</div>

<div id="event_tab_EN" class="row event_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-event-en.php"); ?>
</div>

<div id="event_tab_CN" class="row event_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-event-cn.php"); ?>
</div>

<script>
$(document).ready(function() {
	
});
function eventTabBtnClick(obj) {
	var country = $(obj).attr('country');
	$('#country').val(country);
	$('.event_tab').hide();
	$('#event_tab_' + country).show();

	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.event_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.event_tab_btn').not($(obj)).css('color','#000000');
}
function getEventInfoList(country){
	$("#result_event_info_table_"+country).html('');
	var strDiv = `
				<tr>
					<td colspan="9" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.
					</td>
				</tr>
	`;
	$("#result_event_info_table_"+country).append(strDiv);
	
	var rows = $('#frm-filter-event-info-' + country).find('.rows').val();
	$('#frm-filter-event-info-' + country).find('.page').val(1);

	get_contents($("#frm-filter-event-info-" + country),{
		pageObj : $('#event_tab_' + country).find(".paging.event_info"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			
			if (d.length > 0) {
				$("#result_event_info_table_"+country).html('');
			}
			d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
				strDiv = 	`
						<tr data-no="${row.idx}" >
							<input type="hidden" id="excel_flg" value="${row.excel_print_flg}">
							<TD>
								<div class="cb__color">
									<label>
										<input class="select" type="checkbox" name="event_info_idx[]" value="${row.idx}" >
									</label>
								</div>
							</TD>
							<td>${row.num}</td>
							<td><span style="cursor:pointer" onclick="viewEventList(this,'${row.event_title}')">${row.event_title}<span></td>
							<td class="text-right">${number_format(row.count)} 명</td>
							<td>${(row.date)?row.date.start + " ~ " + row.date.end:''}</td>
							<td>${row.reg_date}</td>
							<td>${(row.status)?'<a class="btn blue">진행중</a>':'<a class="btn">종료</a>'}</td>
							<td><a class="btn blue" onclick="modal('put','idx=${row.idx}');">수정하기</a></td>
							<td class="no-click">
								<a class="btn blue" onclick="modal('preview','idx=${row.idx}');"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a>
								<a class="btn red" onclick="removeEventInfo(${row.idx})"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
							</td>
						</tr>
				`;
				$("#result_event_info_table_"+country).append(strDiv);
			});
		},
		nodata : function() { // 데이터가 없을 경우 처리
			$("#result_event_info_table_"+country).html('<tr><td colspan="9" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td></tr>');
		},
	},rows, 1);
}
function viewEventList(obj, event_title){
	let country = $('#country').val();
	$('#event_filter_title_' + country).text('[' + event_title + '] 이벤트 참여자(당첨자) 목록 검색');
	$('#event_result_title_' + country).text('[' + event_title + '] 이벤트 참여자(당첨자) 결과');

	$("#frm-filter-event-" + country + " input[name='event_no']").val($(obj).parents('tr').data("no"));
	$("#frm-filter-event-" + country + " input[name='excel_print_flg']").val($(obj).parents('tr').find('#excel_flg').val());
	getEventList(country);
	alert('페이지 하단에 참여자리스트가 생성되었습니다.');
}
function removeEventInfo(idx){
	let country = $('#country').val();
	let no = idx;
	confirm("해당 이벤트 정보를 삭제할까요?",function() {
		$.ajax({
			url: config.api + "event/put",
			data : { sel_event_info_idx : no,
						action_type : "event_info_delete" },
			error: function() {
				toast("삭제에 실패하였습니다");
			},
			success: function(d) {
				toast('이벤트 삭제 처리에 성공했습니다.');
				getEventInfoList(country);
			}
		});
	});
	
}
function getEventList(country){
	var event_no = $("#frm-filter-event-" + country + " input[name='event_no']");
	if(event_no.length > 0){
		$("#result_event_table_" + country).html('');
		var strDiv = `
				<tr>
					<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.
					</td>
				</tr>
		`;
		$("#result_event_table_" + country).append(strDiv);
		
		var rows = $('#frm-filter-event-' + country).find('.rows').val();
		$('#frm-filter-event-' + country).find('.page').val(1);

		get_contents($('#frm-filter-event-' + country),{
			pageObj : $('#event_tab_' + country).find(".paging.event"), // 페이징 표시할 element
			html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
				if (d.length > 0) {
					$("#result_event_table_" + country).html('');
				}
				d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
					var ectThDiv = '';
					if(row.raw_data != null){
						var jsonText 	= row.raw_data;
						var dataArray 	= JSON.parse(jsonText);
						var jsonData 	= dataArray;
						console.log(dataArray);
						var jsonKey 	= Object.keys(jsonData);

						ectThDiv += `
							<table>
								<tbody>`;
						jsonKey.forEach(function(key){
							ectThDiv += '<tr>';
							ectThDiv += '    <td>' + key + '</td> ';

							if (Array.isArray(jsonData[key])) {
								var subJsonData = jsonData[key][0];
								var subJsonKey = Object.keys(subJsonData);
								var subEctThDiv = `<table>
														<tbody>`;
								subJsonKey.forEach(function(subKey){
									subEctThDiv += '<tr>';
									subEctThDiv += '    <td>' + subKey + '</td> ';
									subEctThDiv += '	<td>' + subJsonData[subKey] + '</td>';
									subEctThDiv += '</tr>';
								})
								subEctThDiv += `
										</tbody>
									</table>
								`;
								ectThDiv += '<td>' + subEctThDiv + '</td>';
							} else {
								ectThDiv += '<td>' + jsonData[key] + '</td>';
							}
							ectThDiv += '</tr>';
						})
						ectThDiv += `
								</tbody>
							</table>
						`;
					}
					else{
						ectThDiv = '';
					}
					
					strDiv = 	`
						<tr data-no="${row.idx}">
							<td>${row.num}</td>
							<td>${row.event_title}</td>
							<td>${row.id}</td>
							<td>${row.name}</td>
							<td>
								${ectThDiv}
							</td>
							<td><a class="btn blue" onclick="modal('raw_data','idx=${row.idx}');"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a></td>
							<td>${row.tel}</td>
							<td>${row.email}</td>
							<td><a href="https://www.instagram.com/${row.instagram_id}" target="_blank">${row.instagram_id}</a></td>
							<td>${row.join_date}</td>
							<td>${(row.status)?'<a class="btn blue">당첨</a>':'<a class="btn">참여</a>'}</td>
							<td class="no-click">
								<a class="btn red" onclick="removeEvent(${row.idx})"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
							</td>
						</tr>
					`;
					$("#result_event_table_" + country).append(strDiv);
				});
			},
			nodata : function() { // 데이터가 없을 경우 처리
				$("#result_event_table_" + country).html('<tr><td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td></tr>');
			},
		},rows, 1);
	}
	else{
		alert("이벤트를 선택해주세요");
	}
}
function removeEvent(no){
	confirm("해당 참여자 정보를 삭제할까요?",function() {
		let country = $('#country').val()
		$.ajax({
			url: config.api + "event/submit/delete",
			data : { sel_event_idx : no },
			error: function() {
				toast("삭제에 실패하였습니다");
			},
			success: function(d) {
				toast('이벤트 참여자정보 삭제 처리에 성공했습니다.');
				getEventList(country);
			}
		});
	});
}
function searchDateClick(obj) {
	var country = $('#country').val();
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$(obj).parent().find('.date__picker').not($(obj)).css('color','#000');
	$(obj).parents('.content__date__wrap').find('.date_param').css('color','#000');

	var date_type = $(obj).attr('date_type');

	$(obj).parent().find('.search_date_' + date_type).not($(obj)).css('background-color','#ffffff');
	$('#search_date_' + date_type + '_' + country).val(date);
	
	$('#event_tab_' + country).find('input[name=' + date_type + '_from]').val('');
	$('#event_tab_' + country).find('input[name=' + date_type + '_to]').val('');
}
function dateParamChange(obj) {
	var country = $('#country').val();
	var date_type = $(obj).attr('date_type');
	var search_start_date	= '';
	var search_end_date		= '';

	$(obj).parents('.content__date__wrap').find('.search_date_' + date_type).css('background-color','#ffffff');
	$(obj).parents('.content__date__wrap').find('.search_date_' + date_type).css('color','#000000');
	
	search_start_date = $('#event_tab_' + country).find('input[name=' + date_type + '_from]').val();
	search_end_date = $('#event_tab_' + country).find('input[name=' + date_type + '_to]').val();

	$('#search_date_' + date_type + '_' + country).val('');
	
	var start_date = new Date(search_start_date);
	var end_date = new Date(search_end_date);

	if(start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function selectAllClick(obj) {
	var country = $('#country').val();
	var type = $(obj).attr('data-type');

	if ($(obj).prop('checked') == true) {
		$("#result_" + type + "_table_" + country).find('.select').prop('checked',true);
	} else {
		$("#result_" + type + "_table_" + country).find('.select').prop('checked',false);
	}
}
function rowsChange(obj) {
	var country = $('#country').val();
	var list_type = $(obj).attr('list-type');
	var rows = $(obj).val();

	if(list_type == 'event_info'){
		list_type = 'event-info';
	}

	$('#frm-filter-' + list_type + '-' +country).find('.rows').val(rows);
	$('#frm-filter-' + list_type + '-' +country).find('.page').val(1);

	if(list_type == 'event-info'){
		getEventInfoList(country);
	}
	else if(list_type == 'event'){
		getEventList(country);
	}
}
function orderChange(obj) { 
	var country = $('#country').val();
	var list_type = $(obj).attr('list-type');
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter-' + list_type + '-' +country).find('.sort_value').val(order_value[0]);
	$('#frm-filter-' + list_type + '-' +country).find('.sort_type').val(order_value[1]);

	if(list_type == 'event-info'){
		getEventInfoList(country);
	}
	else if(list_type == 'event'){
		getEventList(country);
	}
}
function eventInfoActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var country = $('#country').val();
		var action_type = $(obj).attr('action_type');
		var action_name = "";

		switch(action_type){
			case 'event_info_delete':
				action_name = "이벤트 일괄 삭제";
				break;
		}
		var form 		= $('#frm-list-event-info-' + country);
		var sel_length 	= form.find('.select:checked').length;
		form.find('input[name="action_type"]').val(action_type);
		
		var formData = new FormData();
		formData = form.serializeObject();

		if (sel_length > 0) {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "event/put",
				error: function() {
					alert(action_name + " 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						insertLog("전시관리 > 이벤트 관리 ", action_name, sel_length);
						alert(action_name + ' 처리에 성공했습니다.');
						form.find('input[name="selectAll"]').prop('checked', false);
						getEventInfoList(country);
					}
				}
			});
		} else {
			alert(action_name + ' 처리 할 이벤트을 선택해주세요.');
			return false;
		}
	});
}
function excelDownload(obj) {
	var country = $('#country').val();
	var excel_flg = $('#frm-filter-event-' + country).find('input[name="excel_print_flg"]').val();
	var list_type = $(obj).attr('list-type');
	var sheet_name = "";
	var file_name = "";
	var today = new Date();
	var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
	
	if(excel_flg.length == 0){
		alert("이벤트를 선택해주세요");
	}
	else{
		if(excel_flg == true){
			switch (list_type) {
				case "event_info" :
					sheet_name = "이벤트 정보";
					file_name = "이벤트 정보_" + file_date;
					break;
				case "event" :
					sheet_name = "이벤트 참여자(당첨자) 정보";
					file_name = "이벤트 참여자(당첨자) 정보_" + file_date;
					break;
			}

			if ($('#result_'+list_type+'_table_' + country).find('.nodata').length > 0) {
				alert('다운로드 할 '+sheet_name+'를 검색해주세요.');
			} else {
				insertLog("전시관리 > 이벤트 관리 > " + sheet_name, "엑셀다운로드 : " + file_name, 1);
				var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + list_type + '_' + country), {sheet:sheet_name,raw:true});
				XLSX.writeFile(wb, (file_name + '.xlsx'));
			}
		}
		else{
			alert("참여자 리스트 다운받기 권한이 없는 이벤트입니다.");
		}
	}
}
function init_filter(frm_id, func_name, country){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value=""]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name](country);
}
function openEventRegistModal(){
	let country = $('#country').val();
	modal('add','country=' + country);
}
</script>