<div class="content__card">
	<div class="card__header">
		<h3>이벤트 목록 검색</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter-event-info" action="event/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			<input type="hidden" class="rows" name="rows" value="50">
			<input type="hidden" class="page" name="page" value="1">
			<div class="content__wrap">
				<div class="content__title">이벤트 찾기</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" >
						<option value="event_title">이벤트명</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:250px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="eventStatus1" class="radio__input" value="true" name="eventStatus" />
						<label for="eventStatus1">진행중</label>
						<input type="radio" id="eventStatus2" class="radio__input" value="false" name="eventStatus" />
						<label for="eventStatus2">종료</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_event_create" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_event_create date__picker" date_type="event_create" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="event_create_from" class="date_param" type="date" name="event_create_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="event_create" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="event_create_to" class="date_param" type="date" name="event_create_to" placeholder="To" readonly style="width:150px;" date_type="event_create" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getEventInfoList();"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-event-info','getEventInfoList');"><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>
<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>이벤트 목록 결과</h3>
			<div class="register__btn" style="cursor:pointer;" onClick="openEventRegistModal();"><span>이벤트 등록</span></div>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-list-event-info">
			<input type="hidden" name="action_type">
			<div class="content__row" style="justify-content: flex-end;">
				<select style="width:163px;float:right;margin-right:10px;" list-type="event-info" onChange="orderChange(this);">
					<option value="FINPUT_DATE|DESC">등록일 역순</option>
					<option value="FINPUT_DATE|ASC">등록일 순</option>
					<option value="EVENT_TITLE|DESC">이벤트명 역순</option>
					<option value="EVENT_TITLE|ASC">이벤트명 순</option>
					<option value="CNT|DESC">참여자 수 역순</option>
					<option value="CNT|ASC">참여자 수 순</option>
				</select>
				<select name="rows" style="width:163px;float:right;" list-type="event-info" onChange="rowsChange(this);">
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
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" list-type="event_info" onClick="excelDownload(this);">엑셀 다운로드</div>
						<div class="filter__btn" action_type="event_info_delete" onClick="eventInfoActionClick(this)">삭제</div>
					</div>       
					<div>
						<div class="table__setting__btn">설정</div>
					</div>                           
				</div>
				
				<div class="overflow-x-auto">
					<table id="excel_table_event_info">
						<thead>
							<tr>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" data-type="event_info" onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</TH>
								<th width="60px">번호</th>
								<th>이벤트명</th>
								<th width="100px">참여자수</th>
								<th width="300px">이벤트 기간</th>
								<th width="160px">생성일</th>
								<th width="80px">상태</th>
								<th width="80px">수정하기</th>
								<th width="95px"></th>
							</tr>
						</thead>
						<tbody id="result_event_info_table">
							<tr>
								<td colspan="6" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" >
					<input type="hidden" class="result_cnt" value="0">
					<div class="paging event_info"></div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>이벤트 참여자(당첨자) 목록 검색</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter-event" action="event/submit/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			<input type="hidden" class="rows" name="rows" value="50">
			<input type="hidden" class="page" name="page" value="1">
			<input type="hidden" name="event_no">
			<input type="hidden" name="excel_print_flg">
			<div class="content__wrap">
				<div class="content__title">참가자 찾기</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" >
						<option value="id">참여자 ID</option>	
						<option value="name">참여자 명</option>
						<option value="tel">연락처</option>
						<option value="email">이메일</option>
						<option value="instagram_id">인스타그램ID</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:250px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="eventStatus2_1" class="radio__input" value="all" name="eventStatus" />
						<label for="eventStatus2_1">전체</label>
						<input type="radio" id="eventStatus2_1" class="radio__input" value="false" name="eventStatus" />
						<label for="eventStatus2_1">참여</label>
						<input type="radio" id="eventStatus2_2" class="radio__input" value="true" name="eventStatus" />
						<label for="eventStatus2_2">당첨</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">참여 일자</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_event_apply" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_event_apply date__picker" date_type="event_apply" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="event_apply_from" class="date_param" type="date" name="event_apply_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="event_apply" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="event_apply_to" class="date_param" type="date" name="event_apply_to" placeholder="To" readonly style="width:150px;" date_type="event_apply" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getEventList()"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-event','getEventList')"><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>
<div class="content__card">
	<div class="card__header">
		<h3>이벤트 참여자(당첨자) 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:end; align-items: center;">
			<div class="content__row">
				<select style="width:163px;float:right;margin-right:10px;" list-type="event" onChange="orderChange(this);">
					<option value="FINPUT_DATE|DESC">등록일 역순</option>
					<option value="FINPUT_DATE|ASC">등록일 순</option>
					<option value="FINPUT_DATE|DESC">삭제일 역순</option>
					<option value="FINPUT_DATE|ASC">삭제일 순</option>
					<option value="NAME|DESC">신청자명 역순</option>
					<option value="NAME|ASC">신청자명 순</option>
					<option value="ID|DESC">신청자 ID 역순</option>
					<option value="ID|ASC">신청자 ID 순</option>
					<option value="EMAIL|DESC">EMAIL 역순</option>
					<option value="EMAIL|ASC">EMAIL 순</option>
				</select>
				<select name="rows" style="width:163px;float:right;" list-type="event" onChange="rowsChange(this);">
					<option value="10">10개씩보기</option>
					<option value="20">20개씩보기</option>
					<option value="30">30개씩보기</option>
					<option value="50"selected>50개씩보기</option>
					<option value="100">100개씩보기</option>
					<option value="200">200개씩보기</option>
					<option value="300">300개씩보기</option>
					<option value="500">500개씩보기</option>
				</select>
			</div>
		</div>
		<div class="table table__wrap" >
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" list-type="event" onClick="excelDownload(this);">엑셀 다운로드</div>
				</div>         
				<div>
					<div class="table__setting__btn">설정</div>
				</div>                       
			</div>
			<div class="overflow-x-auto">
				<table id="excel_table_event">
					<thead>
						<tr>
							<th style="width:70px;" >번호</th>
							<th style="width:15%;" >이벤트</th>
							<th style="width:120px;" >참여자 명</th>
							<th style="width:120px;" >참여자 ID</th>
							<th ></th>
							<th style="width:150px;" >생일</th>
							<th style="width:150px;" >연락처</th>
							<th style="width:150px;" >이메일</th>
							<th style="width:150px;" >인스타그램ID</th>
							<th style="width:150px;" >참여일자</th>
							<th style="width:80px;" >상태</th>
							<th style="width:80px;" ></th>
						</tr>
					</thead>
					<tbody id="result_event_table">
						<tr>
							<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" >
			<input type="hidden" class="result_cnt" value="0">
			<div class="paging event"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getEventInfoList();
});
function getEventInfoList(){
	$("#result_event_info_table").html('');
	var strDiv = `
				<tr>
					<td colspan="9" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.
					</td>
				</tr>
	`;
	$("#result_event_info_table").append(strDiv);
	
	var rows = $('#frm-filter-event-info').find('.rows').val();
	$('#frm-filter-event-info').find('.page').val(1);

	get_contents($("#frm-filter-event-info"),{
		pageObj : $(".paging.event_info"), // 페이징 표시할 element
		html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
			
			if (d.length > 0) {
				$("#result_event_info_table").html('');
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
							<td><span style="cursor:pointer">${row.event_title}<span></td>
							<td class="text-right">${number_format(row.count)} 명</td>
							<td>${(row.date)?row.date.start + " ~ " + row.date.end:''}</td>
							<td>${row.reg_date}</td>
							<td>${(row.status)?'<a class="btn blue">진행중</a>':'<a class="btn">종료</a>'}</td>
							<td><a class="btn blue" onclick="modal('put','idx=${row.idx}');">수정하기</a></td>
							<td class="no-click">
								<a class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a>
								<a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
							</td>
						</tr>
				`;
				$("#result_event_info_table").append(strDiv);
			});
			
			$("#result_event_info_table tr > td:not(.no-click)").click(function() {
				$("#frm-filter-event input[name='event_no']").val($(this).parent().data("no"));
				$("#frm-filter-event input[name='excel_print_flg']").val($(this).parent().find('#excel_flg').val());
				getEventList();
			});
			$("#result_event_info_table a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
				let no = $(this).parent().parent().data("no");
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
							getEventInfoList();
						}
					});
				});
			});
		},
		nodata : function() { // 데이터가 없을 경우 처리
			$("#result_event_info_table").html('<tr><td colspan="9" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td></tr>');
		},
	},rows, 1);
}
function getEventList(){
	var event_no = $('input[name="event_no"]').val();
	if(event_no.length > 0){
		$("#result_event_table").html('');
		var strDiv = `
				<tr>
					<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.
					</td>
				</tr>
		`;
		$("#result_event_table").append(strDiv);
		
		var rows = $('#frm-filter-event').find('.rows').val();
		$('#frm-filter-event').find('.page').val(1);

		get_contents($("#frm-filter-event"),{
			pageObj : $(".paging.event"), // 페이징 표시할 element
			html : function(d) { // json 결과의 data row를 넘겨서 목록 처리함.
				if (d.length > 0) {
					$("#result_event_table").html('');
				}
				d.forEach(function(row) { // json_result.data 만 d 변수로 넘김
					//var jsonText = row.etc_data;
					var jsonText = "";
					jsonText += '{';
					jsonText += '	"product_data": [';
					jsonText += '		{';
					jsonText += '			"name" : "test_product" ,';
					jsonText += '			"size" : "One size",';
					jsonText += '			"quantity" : "12",';
					jsonText += '			"etc_info" : [';
					jsonText += '				{';
					jsonText += '					"offline" : "압구정역점",';
					jsonText += '					"online" : "한국몰",';
					jsonText += '					"offline" : "압구정역점"';
					jsonText += '				},';
					jsonText += '				{';
					jsonText += '					"offline" : "압구정역점",';
					jsonText += '					"online" : "한국몰",';
					jsonText += '					"offline" : "압구정역점"';
					jsonText += '				}';
					jsonText += '			]';
					jsonText += '		}';
					jsonText += '	]';
					jsonText += '}';


					var dataArray 	= JSON.parse(jsonText);
					var jsonData 	= dataArray.product_data[0];
					var jsonKey 	= Object.keys(jsonData);

					var ectThDiv = `
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
					strDiv = 	`
						<tr data-no="${row.idx}">
							<td>${row.num}</td>
							<td>${row.event}</td>
							<td>${row.id}</td>
							<td>${row.name}</td>
							<td>
								${ectThDiv}
							</td>
							<td>${row.birthday}</td>
							<td>${row.tel}</td>
							<td>${row.email}</td>
							<td><a href="https://www.instagram.com/${row.instagram_id}" target="_blank">${row.instagram_id}</a></td>
							<td>${row.join_date}</td>
							<td>${(row.status)?'<a class="btn blue">당첨</a>':'<a class="btn">참여</a>'}</td>
							<td class="no-click">
								<a class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">상세</span></a>
								<a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
							</td>
						</tr>
					`;
					$("#result_event_table").append(strDiv);
				});
				$("#result_event_table tr > td:not(.no-click)").click(function() { // 셀 클릭시 상세 내용 표시
					
				});
				$("#result_event_table a.btn.red").click(function() { // 삭제 버튼 클릭시 확인 창 표시, 확인 시 ajax 통신 하여 처리
					let no = $(this).parent().parent().data("no");
					confirm("해당 참여자 정보를 삭제할까요?",function() {
						$.ajax({
							url: config.api + "event/submit/put",
							data : { sel_event_idx : no },
							error: function() {
								toast("삭제에 실패하였습니다");
							},
							success: function(d) {
								toast('이벤트 삭제 처리에 성공했습니다.');
								getEventList();
							}
						});
					});
				});
			},
			nodata : function() { // 데이터가 없을 경우 처리
				$("#result_event_table").html('<tr><td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td></tr>');
			},
		},rows, 1);
	}
	else{
		alert("이벤트를 선택해주세요");
	}
}
function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');

	var date_type = $(obj).attr('date_type');

	$('.search_date_'+date_type).not($(obj)).css('background-color','#ffffff');
	$('#search_date_'+date_type).val(date);
	
	$('#'+date_type+'_from').val('');
	$('#'+date_type+'_to').val('');
}
function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	var search_start_date	= '';
	var search_end_date		= '';

	$('.search_date_'+date_type).css('background-color','#ffffff');
	$('.search_date_'+date_type).css('color','#000000');
	
	search_start_date = $('#'+date_type+'_from').val();
	search_end_date = $('#'+date_type+'_to').val();

	$('#search_date_'+date_type).val('');
	
	var start_date = new Date(search_start_date);
	var end_date = new Date(search_end_date);

	if(start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function selectAllClick(obj) {
	var type = $(obj).attr('data-type');
	if ($(obj).prop('checked') == true) {
		$("#result_"+type+"_table").find('.select').prop('checked',true);
	} else {
		$("#result_"+type+"_table").find('.select').prop('checked',false);
	}
}
function eventInfoActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var action_type = $(obj).attr('action_type');
		var action_name = "";

		switch(action_type){
			case 'event_info_delete':
				action_name = "이벤트 일괄 삭제";
				break;
		}
		var form 		= $('#frm-list-event-info');
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
						getEventInfoList();
					}
				}
			});
		} else {
			alert(action_name + ' 처리 할 이벤트을 선택해주세요.');
			return false;
		}
	});
}
function rowsChange(obj) {
	var list_type = $(obj).attr('list-type');
	var rows = $(obj).val();
	$('#frm-filter-'+list_type).find('.rows').val(rows);
	$('#frm-filter-'+list_type).find('.page').val(1);

	if(list_type == 'event-info'){
		getEventInfoList();
	}
	else if(list_type == 'event'){
		getEventList();
	}
}
function orderChange(obj) { 
	var list_type = $(obj).attr('list-type');
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter-'+list_type).find('.sort_value').val(order_value[0]);
	$('#frm-filter-'+list_type).find('.sort_type').val(order_value[1]);

	if(list_type == 'event-info'){
		getEventInfoList();
	}
	else if(list_type == 'event'){
		getEventList();
	}
}
function excelDownload(obj) {
	var excel_flg = $('input[name="excel_print_flg"]').val();
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

			if ($('#result_'+list_type+'_table').find('.nodata').length > 0) {
				alert('다운로드 할 '+sheet_name+'를 검색해주세요.');
			} else {
				insertLog("전시관리 > 이벤트 관리 > " + sheet_name, "엑셀다운로드 : " + file_name, 1);
				var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + list_type), {sheet:sheet_name,raw:true});
				XLSX.writeFile(wb, (file_name + '.xlsx'));
			}
		}
		else{
			alert("참여자 리스트 다운받기 권한이 없는 이벤트입니다.");
		}
	}
}
function init_filter(frm_id, func_name){
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
	
	window[func_name]();
}
function openEventRegistModal(){
	modal('add');
}
</script>
