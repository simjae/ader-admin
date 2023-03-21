<?php include_once("check.php"); ?>

<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>팝업 관리</h3>
			<div class="register__btn" onClick="location.href='/display/popup/regist'"><span>팝업등록</span></div>
		</div>
		<div class="drive--x"></div>
	</div>
	<form id="frm-filter" action="display/popup/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">쇼핑몰 선택</div>
				<div class="content__row" style="display: block;">
					<select name="country" id="country" class="fSelect" style="width:163px;">
						<option value="">전체</option>
						<option value="KR">아더에러 한국몰</option>
						<option value="EN">아더에러 영문몰</option>
						<option value="CN">아더에러 중문몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
					<div class="content__title">검색 분류</div>
					<div class="content__row">
						<select id="search_type" name="search_type" class="fSelect" style="width:130px;">
							<option value="title">제목</option>
							<option value="url">URL</option>
						</select>
						<input type="text" name="search_keyword" value="" style="width:40%;">
					</div>
				</div>
			<div class="content__wrap">
				<div class="content__title">팝업 종류</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="popup_type_all" class="radio__input" value="ALL" name="popup_type" checked/>
						<label for="popup_type_all">전체</label>
						<input type="radio" id="popup_window_type" class="radio__input" value="LAYER" name="popup_type"/>
						<label for="popup_window_type">레이어 팝업</label>
						<input type="radio" id="popup_layer_type" class="radio__input" value="WINDOW" name="popup_type"/>
						<label for="popup_layer_type">윈도우 팝업</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">디바이스</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="device_total" class="radio__input" value="TOTAL" name="device" checked/>
						<label for="device_total">전체</label>
						<input type="radio" id="device_web" class="radio__input" value="WEB" name="device"/>
						<label for="device_web">웹</label>
						<input type="radio" id="device_mobile" class="radio__input" value="MOBILE" name="device"/>
						<label for="device_mobile">모바일</label>
						<input type="radio" id="device_all" class="radio__input" value="ALL" name="device"/>
						<label for="device_all">반응형</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="display_status_all" class="radio__input" value="all" name="display_status" checked/>
						<label for="display_status_all">전체</label>
						<input type="radio" id="display_status_true" class="radio__input" value="true" name="display_status"/>
						<label for="display_status_true">진행 중</label>
						<input type="radio" id="display_status_false" class="radio__input" value="false" name="display_status"/>
						<label for="display_status_false">진행 안함</label>
						<input type="radio" id="display_status_wait" class="radio__input" value="wait" name="display_status"/>
						<label for="display_status_wait">진행 예약</label>
						<input type="radio" id="display_status_end" class="radio__input" value="end" name="display_status"/>
						<label for="display_status_end">진행 종료</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">진행 기간 검색</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="display_flg" type="hidden" value="false">
						
						<input type="radio" id="display_flg_all" class="radio__input display_flg" radio_type="display" value="all" name="display_date" checked>
						<label for="display_flg_all">전체</label>

						<input type="radio" id="display_flg_always" class="radio__input display_flg" radio_type="display" value="true" name="display_date">
						<label for="display_flg_always">상시 오픈</label>
						
						<input type="radio" id="display_flg_date" class="radio__input display_flg" radio_type="display" value="false" name="display_date">
						<label for="display_flg_date" style="gap:5px;">진행 기간</label>
						
						<div class="content__date__picker">
							<input id="display_from" class="display_date" type="date" name="display_from" placeholder="From" readonly="" style="width:150px" onChange="displayDateChange(this)" disabled>
							<font class="" >~</font>
							<input id="display_to" class="display_date" type="date" name="display_to" placeholder="To" readonly="" style="width:150px; " onChange="displayDateChange(this)" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">작성일</div>
				<div class="content__row">
					<select id="search_date_type" name="search_date_type" style="width:163px;">
						<option value="CREATE_DATE">생성일자</option>
						<option value="UPDATE_DATE">수정일자</option>
					</select>
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_btn date__picker" date="all" type="button"  onclick="searchDateClick(this)">전체</div>
							<div class="search_date_btn date__picker" date="today" type="button"  onclick="searchDateClick(this)">오늘</div>
							<div class="search_date_btn date__picker" date="01d" type="button"  onclick="searchDateClick(this)">어제</div>
							<div class="search_date_btn date__picker" date="03d" type="button"  onclick="searchDateClick(this)">3일</div>
							<div class="search_date_btn date__picker" date="07d" type="button"  onclick="searchDateClick(this)">7일</div>
							<div class="search_date_btn date__picker" date="15d" type="button"  onclick="searchDateClick(this)">15일</div>
							<div class="search_date_btn date__picker" date="01m" type="button"  onclick="searchDateClick(this)">1개월</div>
							<div class="search_date_btn date__picker" date="03m" type="button"  onclick="searchDateClick(this)">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="search_from" class="search_date" type="date" name="search_from"  placeholder="From" readonly="" style="width:150px" onChange="dateParamChange(this)">
							<font class="" >~</font>
							<input id="search_to" class="search_date" type="date" name="search_to" placeholder="To" readonly="" style="width:150px; " onChange="dateParamChange(this)">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getPopupInfo()"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter','getPopupInfo')"><span>초기화</span></div>
			</div>
		</div>
	</div>
</div>
<!-- END REQUEST CARD -->
<div class="content__card">
	<form id="frm-list">
		<div class="card__header">
			<h3>팝업 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<input type="hidden" class="action_type" name="action_type">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count" >0</font>개 
					<div class="drive--left"></div>
					검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
				<div class="content__row">
					<select name="searchSorting" class="fSelect" style="width:163px;float:right;margin-right:10px;">
						<option value="">필터기능 추가 예정</option>
					</select>
					<select name="rows" style="width:163px;" onChange="rowsChange(this);">
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
						<div class="filter__btn" action_type="popup_delete" onClick="popupActionClick(this)">삭제</div>
						<div class="filter__btn" action_type="display_set" onClick="popupActionClick(this)">진행</div>
						<div class="filter__btn" action_type="non_display_set" onClick="popupActionClick(this)">진행 안함</div>
					</div>
				</div> 
				<div class="overflow-x-auto">
					<TABLE>
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:3%;">번호</TH>
								<TH style="width:5%;">쇼핑몰</TH>
								<TH style="width:5%;">디바이스</TH>
								<TH style="width:4%;">미리보기</TH>
								<TH style="width:4%;">수정하기</TH>
								<TH>제목</TH>
								<TH style="width:5%;">상태</TH>
								<TH>기간</TH>
								<TH style="width:10%;">등록일</TH>
								<TH style="width:10%;">최근 수정일</TH>
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
				<div class="paging"></div>
			</div>
		</div>
		<div class="card__footer"></div>
	</form>
</div>

<script>
$(document).ready(function() {
	getPopupInfo();
});
$('.display_flg').change(function(){
	var val = $(this).val();
	if (val != "false") {
		$('.display_date').val('');
		$('.display_date').attr("disabled", true);
	} else {
		$('.display_date').removeAttr("disabled");
	}
});
function displayDateChange(obj){
	var display_start_date = $("input[name='display_from']").val();
	var display_end_date = $("input[name='display_to']").val();

	var start_date = new Date(display_start_date);
	var end_date = new Date(display_end_date);
	
	if (start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function searchDateClick(obj) {
	var date = $(obj).attr('date');
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.search_date_btn').not($(obj)).css('color','#000');
	$('.search_date_btn').not($(obj)).css('background-color','#ffffff');

	$('.search_date').css('color','#000');
	
	$('input[name="search_date"]').val(date);
	$('#search_from').val('');
	$('#search_to').val('');
}
function dateParamChange(obj) {
	$('.search_date_btn').css('background-color','#ffffff');
	$('.search_date_btn').css('color','#000');
	
	$('input[name="search_date"]').val('');

	var search_start_date = $("input[name='search_from']").val();
	var search_end_date = $("input[name='search_to']").val();

	var start_date = new Date(search_start_date);
	var end_date = new Date(search_end_date);
	var now_date = new Date();
	
	if(start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$("#result_table").find('.select').prop('checked',false);
	}
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);
	
	getPopupInfo();
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);
	
	getPopupInfo();
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();

	$('.cnt_total').text(total_cnt);
	$('.cnt_result').text(result_cnt);
}
function popupActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var action_type = $(obj).attr('action_type');
		var action_name = "";

		switch(action_type){
			case 'popup_delete':
				action_name = "[팝업 삭제]";
				break;
			case 'display_set':
				action_name = "[진행 상태로 변경]";
				break;
			case 'non_display_set':
				action_name = "[진행안함 상태로 변경]";
				break;
		}
		var form = $('#frm-list');
		form.find('.action_type').val(action_type);
		
		var formData = new FormData();
		formData = form.serializeObject();
		
		var select_idx = [];
		var length = form.find('.select').length;

		for (var i=0; i<length; i++) {
			var select = form.find('.select').eq(i);
		}
		var true_cnt = 0;
		var false_cnt = 0;
		
		for (var i=0; i<length; i++) {
			var select = form.find('.select').eq(i);
			if (select.prop('checked') == true) {
				if (form.find('#display_flg_' + select.val()).val() == "true") {
					true_cnt++;
				} else if (form.find('#display_flg_' + select.val()).val() == "false") {
					false_cnt++;
				}
				
				select_idx.push(select.val());
			}		
		}
		if (select_idx.length > 0) {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "display/popup/list/put",
				error: function() {
					alert(action_name + " 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						insertLog("전시관리 > 팝업 관리", action_name, select_idx.length);
						alert(action_name + ' 처리에 성공했습니다.');
						form.find('input[name="selectAll"]').prop('checked', false);
						
						getPopupInfo();
					}
				}
			});
		} else {
			alert(action_name + ' 처리 할 팝업을 선택해주세요.');
			return false;
		}
	});
}
function getPopupInfo(){
	$("#result_table").html('');
	
	var strDiv = `
				<TR>
					<TD class="default_td" colspan="11">
						조회 결과가 없습니다
					</TD>
				</TR>
	`;
	$("#result_table").append(strDiv);
	
	var rows = $('#frm-filter').find('.rows').val();
	$('#frm-filter').find('.page').val(1);
	
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					$("#result_table").html('');
				}
				d.forEach(function(row) {
					var display_flg = '';
					var display_date = '';
					var display_str = '';

					var today = new Date();
					var start_date = new Date(row.display_start_date);
					var end_date = new Date(row.display_end_date);	

					var country_str = '-';
					var device_str = '-';
					switch(row.country){
						case 'KR':
							country_str = '한국몰';
							break;
						case 'EN':
							country_str = '영문몰';
							break;
						case 'CN':
							country_str = '중국몰';
							break;
					}
					switch(row.device){
						case 'ALL':
							device_str = '반응형';
							break;
						case 'WEB':
							device_str = '웹';
							break;
						case 'MOBILE':
							device_str = '모바일';
							break;
					}
					if (row.display_end_date == '9999-12-31 23:59') {
						display_date = "상시 진행";
					}
					if (row.display_flg == true) {
						display_flg = true;
						
						if ((today <= start_date)) {
							display_str = "진행 예약";
							if (display_date.length == 0) {
								display_date = "진행시작 : " + row.display_start_date + "<br>진행종료 : " + row.display_end_date;
							}
							
						} else if ((today >= start_date) && (today <= end_date)) {
							display_str = "진행 중";
							if (display_date.length == 0) {
								display_date = "진행시작 : " + row.display_start_date + "<br>진행종료 : " + row.display_end_date;
							}
							
						} else if ((today >= start_date) && (today > end_date)) {
							display_str = "진행 종료";
							if (display_date.length == 0) {
								display_date = "진행시작 : " + row.display_start_date + "<br>진행종료 : " + row.display_end_date;
							}
						}
					} else {
						display_flg = false;
						
						display_str = "진행 안함";
						if (display_date.length == 0) {
							if (display_date.length == 0) {
								display_date = "진행시작 : " + row.display_start_date + "<br>진행종료 : " + row.display_end_date;
							}
						}
					}
					strDiv = `
						<TR>
							<TD>
								<div class="cb__color">
									<label>
										<input class="select" type="checkbox" name="popup_idx[]" value="${row.idx}" >
									</label>
								</div>
							</TD>
							<TD>${row.num}</TD>
							<TD>${country_str}</TD>
							<TD>${device_str}</TD>
							<TD><button type="button" onClick="openPopupPreviewModal(${row.idx});" style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">미리보기</button></TD>
							<TD><button type="button" onClick="openPopupUpdateModal(${row.idx});" style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">수정하기</button></TD>
							<TD>${row.title}</TD>
							<TD>${display_str}</TD>
							<TD style="line-height: 1.4;">${display_date}</TD>
							<TD>${row.create_date}</TD>
							<TD>${row.update_date}</TD>
						</TR>
					`;
					$("#result_table").append(strDiv);
				});
			}
		},
	},rows,1);
}
function openPopupUpdateModal(idx){
	modal('put', 'idx='+idx);
}
function openPopupPreviewModal(idx){
	modal('preview', 'idx='+idx);
}
function init_filter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="TOTAL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}

	/*
	if (action_type == "display_true" && true_cnt > 0) {
		alert('현재 미진열중인 페이지만 진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	} else if (action_type == "display_false" && false_cnt > 0) {
		alert('현재 진열중인 페이지만 미진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	}
	*/
</script>

