<div class="content__card">
	<form id="frm-list_01" action="member/visit/get">
		<input type="hidden" class="sort_value" name="sort_value" value="LOGIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="01">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3 id="tabTitle">회원 로그인 관리</h3>
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
					<input type="text" value=""  name="login_ip" style="width:150px;">
                </div>
            </div>
			<div class="content__wrap">
				<div class="content__title">회원 상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="state_all" type="radio" name="status" value="all" checked>
						<label for="state_all">전체</label>
						<input id="state_normal" type="radio" name="status" value="normal" >
						<label for="state_normal">정상</label>
						<input id="state_dormant" type="radio" name="status" value="dormant" >
						<label for="state_dormant">휴면</label>
						<input id="state_bad" type="radio" name="status" value="bad" >
						<label for="state_bad">불량</label>
						<input id="state_withdraw_wait" type="radio" name="status" value="withdraw_wait" >
						<label for="state_withdraw_wait">탈퇴신청</label>
						<input id="state_withdraw" type="radio" name="status" value="withdraw" >
						<label for="state_withdraw">탈퇴</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
                <div class="content__title">로그인 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_login" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_login date__picker" date_type="login" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_login date__picker" date_type="login" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_login date__picker" date_type="login" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_login date__picker" date_type="login" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_login date__picker" date_type="login" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_login date__picker" date_type="login" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_login date__picker" date_type="login" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="login_from" class="date_param" type="date" name="login_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="login" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="login_to" class="date_param" type="date" name="login_to" placeholder="To" readonly style="width:150px;" date_type="login" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getVisitTabInfo_01();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="initFilter_01();"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<div class="card__body">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 회원 수 <font class="cnt_01_total info__count" >0</font>명 
				<div class="drive--left"></div> 
				검색결과 <font class="cnt_01_result info__count" >0</font>명
			</div>
			
			<div class="content__row">
				<select style="width:163px;float:right;" onChange="orderChange(this);">
					<option value="LOGIN_DATE|DESC">로그인시각 역순</option>
					<option value="LOGIN_DATE|ASC">로그인시각 순</option>
					<option value="ID|DESC">아이디 역순</option>
					<option value="ID|ASC">아이디 순</option>
					<option value="LEVEL|DESC">회원등급 역순</option>
					<option value="LEVEL|ASC">회원등급 순</option>
					<option value="STATUS|DESC">회원상태 역순</option>
					<option value="STATUS|ASC">회원상태 순</option>
					<option value="IP|DESC">IP 역순</option>
					<option value="IP|ASC">IP 순</option>
					<option value="LOGIN_CNT|DESC">로그인횟수 역순</option>
					<option value="LOGIN_CNT|ASC">로그인횟수 순</option>
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
					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div> 	
				<div>
					<div class="table__setting__btn">설정</div>
				</div> 
			</div>
			<div class="overflow-x-auto">
				<TABLE id="excel_table_01">
					<THEAD>
						<TR>
							<TH style="width:8%;">No.</TH>
							<TH style="width:10%;">아이디</TH>
							<TH style="width:10%;">회원등급</TH>
							<TH style="width:10%;">회원상태</TH>
							<TH style="width:15%;">메일/SMS</TH>
							<TH style="width:10%;">IP</TH>
							<TH style="width:8%;">로그인 시각</TH>
							<TH style="width:6%;">로그인 횟수</TH>
							<TH style="width:6%;">오프라인 방문 횟수</TH>
							<TH style="width:10%;">IP 차단설정</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table_01">
						<TR>
							<TD class="default_td" colspan="9">
								조회 결과가 없습니다.
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" tab_num="01" value="0" onChange="setResultCount(this);">
			<input type="hidden" class="result_cnt" tab_num="01" value="0" onChange="setResultCount(this);">
			<div class="paging_01"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	getVisitTabInfo_01();
});
function initFilter_01(){
	$('#frm-list_01').find('input[name="member_id"]').val('');
	$('#frm-list_01').find('input[name="login_ip"]').val('');
	$('#frm-list_01').find("input:radio[name='status']:radio[value='all']").prop('checked', true); 

	$('.search_date_login').css('background-color','#ffffff');
	$('.search_date_login').css('color','#000000');
	$('#search_date_login').val('');

	$('#login_from').val('');
	$('#login_to').val('');

	getVisitTabInfo_01();
}
function getVisitTabInfo_01() {
	var tab_num = $('#tab_num').val();
	$("#result_table_01").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD colspan="10">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table_01").append(strDiv);
	
	var rows = $('#frm-list_01').find('.rows').val();
	var page = $('#frm-list_01').find('.page').val(1);
	
	get_contents($("#frm-list_01"),{
		pageObj : $(".paging_01"),
		html : function(d) {
			var length = Object.keys(d).length;
			if (length > 0) {
				$("#result_table_01").html('');
			}
			
			d.forEach(function(row) {
				var login_date = "";
				if (row.login_date != null) {
					temp_arr = row.login_date.split(' ');
					login_date = temp_arr[0] + "<br>" + temp_arr[1];
				} else {
					login_date = "미접속";
				}
				
				var strDiv = '';
				strDiv += '<TR>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>' + row.level + '</TD>';
				strDiv += '    <TD>' + row.status + '</TD>';
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
				strDiv += '    <TD>' + row.ip + '</TD>';
				strDiv += '    <TD>' + login_date + '</TD>';
				strDiv += '    <TD>' + row.login_cnt + '</TD>';
				strDiv += '    <TD>' + row.offline_cnt + '</TD>';
				strDiv += '    <TD>';
				if (row.ip_ban_flg == true) {
					strDiv += '    <button style="padding: 5px 10px;height:28px;color: #ffffff;background-color: #000000;cursor:pointer;" action_type="ip_unban" member_idx="' + row.no + '" onClick="memberIpBan(this);">IP차단 해제</button>';
				} else {
					strDiv += '    <button style="padding: 5px 10px;height:28px;border: solid 1px #000000;color: #000000;background-color: #fff;cursor:pointer;" action_type="ip_ban" member_idx="' + row.no + '" onClick="memberIpBan(this);">IP차단 설정</button>';
				}
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table_01").append(strDiv);
			});
		},
	},rows,1);
}
</script>
