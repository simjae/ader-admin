<div class="content__card">
	<form id="frm-list_02" action="member/visit/get">
		<input type="hidden" class="sort_value" name="sort_value" value="IP">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="02">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3 id="tabTitle">부정의심 로그인 관리</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">아이디</div>
				<div class="content__row">
					<input type="text" value="" name="member_id" style="width:150px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">IP</div>
				<div class="content__row">
					<input type="text" value="" name="login_ip" style="width:150px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">회원 상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="doubt_state_all" type="radio" name="status" value="all" checked>
						<label for="doubt_state_all">전체</label>
						<input id="doubt_state_normal" type="radio" name="status" value="normal" >
						<label for="doubt_state_normal">정상</label>
						<input id="doubt_state_bad" type="radio" name="status" value="bad" >
						<label for="doubt_state_bad">불량</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">로그인 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_suspicion" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_suspicion date__picker" date_type="suspicion" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_suspicion date__picker" date_type="suspicion" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="suspicion_from" class="date_param" type="date" name="login_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="suspicion" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="suspicion_to" class="date_param" type="date" name="login_to" placeholder="To" readonly style="width:150px;" date_type="suspicion" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getVisitTabInfo_02();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="initFilter_02();"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-02-01" action="member/update/put">
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 회원 수 <font class="cnt_02_total info__count" >0</font>명 
					<div class="drive--left"></div>
					검색결과 <font class="cnt_02_result info__count" >0</font>명
				</div>
				<div class="content__row">
					<select style="width:163px;float:right;" onChange="orderChange(this);">
						<option value="IP|DESC">IP 역순</option>
						<option value="IP|ASC">IP 순</option>
						<option value="ID|DESC">아이디 역순</option>
						<option value="ID|ASC">아이디 순</option>
						<option value="ID|DESC">이름 역순</option>
						<option value="ID|ASC">이름 순</option>
						<option value="LEVEL|DESC">회원등급 역순</option>
						<option value="LEVEL|ASC">회원등급 순</option>
						<option value="STATUS|DESC">회원상태 역순</option>
						<option value="STATUS|ASC">회원상태 순</option>
						<option value="JOIN_DATE|DESC">회원가입일 역순</option>
						<option value="JOIN_DATE|ASC">회원가입일 순</option>
						<option value="LOGIN_DATE|DESC">로그인시각 역순</option>
						<option value="LOGIN_DATE|ASC">로그인시각 순</option>
					</select>
					
					<select name="rows" onChange="rowsChange(this);" style="width: 130px;">
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
						<input type="hidden" class="action_type" name="action_type">
						<input type="hidden" class="action_name" name="action_name">
							
						<div class="filter__btn" action_type="member_trust" onclick="memberActionCheck(this);">부정의심 해제</div>
						<div class="filter__btn" action_type="member_faulty" onclick="memberActionCheck(this);">불량회원 설정</div>
						<div class="filter__btn" action_type="member_default" onclick="memberActionCheck(this);">불량회원 해제</div>
						<div class="filter__btn" action_type="member_sms" onclick="memberActionCheck(this);">SMS 보내기</div>
						<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
					</div>   
					<div>
						<div class="table__setting__btn">설정</div>
					</div>  
				</div>    
				<div class="overflow-x-auto">
					<TABLE id="excel_table_02">
						<THEAD>
							<TR>
								<TH>IP</TH>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>아이디</TH>
								<TH>이름</TH>
								<TH>회원등급</TH>
								<TH>회원상태</TH>
								<TH>휴대전화</TH>
								<TH>회원가입일</TH>
								<TH>로그인 시각</TH>
								<TH  style="width:6%;">로그인 횟수</TH>
								<TH  style="width:6%;">오프라인 방문 횟수</TH>
								<TH>관련내역 보기</TH>
								<TH style="width:10%;">IP 차단설정</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_02">
							<TR>
								<TD class="default_td" colspan="10">
									조회 결과가 없습니다.
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_num="02" value="0" onChange="setResultCount(this);">
				<input type="hidden" class="result_cnt" tab_num="02" value="0" onChange="setResultCount(this);">
				<div class="paging_02"></div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getVisitTabInfo_02();
})
function initFilter_02(){
	$('#frm-list_02').find('input[name="member_id"]').val('');
	$('#frm-list_02').find('input[name="login_ip"]').val('');
	$('#frm-list_02').find("input:radio[name='status']:radio[value='all']").prop('checked', true); 

	$('.search_date_suspicion').css('background-color','#ffffff');
	$('.search_date_suspicion').css('color','#000000');
	$('#search_date_suspicion').val('');

	$('#suspicion_from').val('');
	$('#suspicion_to').val('');

	getVisitTabInfo_02();
}
function getVisitTabInfo_02() {
	var tab_num = $('#tab_num').val();
	$("#result_table_02").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD colspan="13">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table_02").append(strDiv);
	
	var rows = $('#frm-list_02').find('.rows').val();
	var page = $('#frm-list_02').find('.page').val();
	
	get_contents($("#frm-list_02"),{
		pageObj : $(".paging_02"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_02").html('');
			}
			
			var prev_ip = "";
			var row_num = 1;
			var row_id = "";
			
			d.forEach(function(row) {
				var join_date = [];
				if (row.join_date != null) {
					join_date = row.join_date.split(' ');
				}
				
				var login_date = "";
				if (row.login_date != null) {
					temp_arr = row.login_date.split(' ');
					login_date = temp_arr[0] + "<br>" + temp_arr[1];
				} else {
					login_date = "미접속";
				}
				
				var recent_ip = row.ip;
				
				if (prev_ip != recent_ip) {
					prev_ip = recent_ip;
					row_num = 1;
					row_id = 'ip_row_' + row.no;
				} else {
					row_num++;
					$('#' + row_id).attr('rowspan',row_num);
				}
				
				var strDiv = '';
				strDiv += '<TR>';
				if (row_num == 1) {
					strDiv += '<TD id="ip_row_' + row.no + '">' + row.ip + '</TD>';
				}
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.no + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>' + row.name + '</TD>';
				strDiv += '    <TD>' + row.level + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        ' + row.status;
				strDiv += '        <input type="hidden" id="member_status_' + row.no + '" value="' + row.status + '">';
				strDiv += '        <input type="hidden" id="member_suspicion_' + row.no + '" value="' + row.suspicion_flg + '">';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.tel_mobile + '</TD>';
				strDiv += '    <TD>' + join_date[0] + "<br>" + join_date[1] + '</TD>';
				strDiv += '    <TD>' + login_date + '</TD>';
				strDiv += '    <TD>' + row.login_cnt + '</TD>';
				strDiv += '    <TD>' + row.offline_cnt + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="row">';
				if (row.receive.email == true) {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">MAIL</button>';
				} else {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">MAIL</button>';
				}
				if (row.receive.sms == true) {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">SMS</button>';
				} else {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">SMS</button>';
				}
				strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">MEMO</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>';
				if (row.ip_ban_flg == true) {
					strDiv += '    <button style="padding: 5px 10px;height:28px;color: #ffffff;background-color: #000000;cursor:pointer;" action_type="ip_unban" member_idx="' + row.no + '" onClick="memberIpBan(this);">IP차단 해제</button>';
				} else {
					strDiv += '    <button style="padding: 5px 10px;height:28px;border: solid 1px #000000;color: #000000;background-color: #fff;cursor:pointer;" action_type="ip_ban" member_idx="' + row.no + '" onClick="memberIpBan(this);">IP차단 설정</button>';
				}
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table_02").append(strDiv);
			});
		},
	},rows,page);
}

function memberActionCheck(obj) {
	action_type = $(obj).attr('action_type');

	var action_name = "";
	var action_target = "";
	var action_suspicion = null;
	
	switch (action_type) {
		case "member_trust" :
			action_name = "부정의심 해제 설정";
			action_target = "정상";
			action_suspicion = true;
			break;
		
		case "member_faulty" :
			action_name = "불량회원 설정";
			action_target = "정상";
			break;
		
		case "member_default" :
			action_name = "불량회원 해제";
			action_target = "불량";
			break;
	}

	var select_idx = [];
	var length = $('#frm-02-01').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-02-01').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-02-01').find('.select').eq(i).val());
		}
	}
	
	if (select_idx.length == 0) {
		alert(action_name + ' 처리 할 멤버를 선택해주세요.');
	} else {
		var cnt = 0;
		
		
		$('.action_type').val(action_type);
		$('.action_name').val(action_name);
		
		for (var i=0; i<select_idx.length; i++) {
			var member_status = $('#member_status_' + select_idx[i]).val();
			var member_suspicion = $('#member_suspicion_' + select_idx[i]).val();
			
			if (member_status != action_target) {
				cnt++;
			}
			
			if (action_suspicion == true) {
				if (member_suspicion != action_suspicion) {
					cnt++;
				}
			}
		}
		
		if (cnt == 0) {
			confirm('선택한 멤버를 ' + action_name + ' 하시겠습니까?','memberAction(' + select_idx.length + ')');
		} else {
			alert(action_target + ' 상태의 멤버만 ' + action_name + ' 처리할 수 있습니다.');
		}
	}
}

function memberAction(len) {
	var action_type = $('.action_type').val();
	var action_name = $('.action_name').val();
	
	var formData = new FormData();
	formData = $("#frm-02-01").serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/update/status/put",
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				insertLog("고객관리 > 회원 조회 > 부정의심 로그인 관리", action_name, len);
				getVisitTabInfo_02();
			}
		}
	});
}
</script>
