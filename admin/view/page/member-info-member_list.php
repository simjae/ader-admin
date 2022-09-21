<div class="content__card">
	<form id="frm-list_01" action="member/info/get">
		<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="01">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3>회원조회</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">개인정보</div>
				<div class="content__row">
					<select name="search_type" class="fSelect" style="width:163px;">
						<option value="member_id" selected="">아이디</option>
						<option value="name">이름</option>
						<option value="email">이메일</option>
						<option value="tel">전화번호</option>
						<option value="mobile">휴대폰번호</option>
						<option value="addr">주소</option>
					</select>

					<input class="content__input" type="text" name="search_keyword" value="" style="width:70%;">
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="rd__block__wrap">
					<div class="content__title">회원등급</div>
					<div class="content__row">
						<select name="member_level" class="fSelect" style="width:163px;">
							<option value="all" selected="selected">전체</option>
							<option value="일반회원">일반회원</option>
							<option value="ADER family">ADER family</option>
						</select>
					</div>
				</div>
				<div class="rd__block__wrap">
					<div class="content__title">유입경로</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="memberRoute1" class="radio__input" value="all" name="memberRoute" checked/>
							<label for="memberRoute1">전체</label>
							<input type="radio" id="memberRoute2" class="radio__input" value="pc" name="memberRoute"/>
							<label for="memberRoute2">PC</label>
							<input type="radio" id="memberRoute3" class="radio__input" value="mobile" name="memberRoute"/>
							<label for="memberRoute3">모바일</label>
						</div>
					</div>
				</div>
			</div>

			<div class="content__wrap">
				<div class="content__title">가입일/생일</div>
				<div class="content__row">
					<select name="day_type" class="fSelect" style="width:163px;">
						<option value="" selected="selected">- 선택 -</option>
						<option value="1">가입일</option>
						<option value="2">생일</option>
					</select>
					<div class="content__date__picker" style="margin-left:10px;">
						<input type="date" name="day_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							~
						<input type="date" name="day_to" placeholder="To" readonly style="width:150px;">
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="rd__block__wrap">
					<div class="content__title">나이</div>
					<div class="content__row">
						<input type="text" name="min_age" value="" style="width:80px;margin-right:5px;">세
							~
						<input type="text" name="max_age" value="" style="width:80px;margin-right:5px;">세
					</div>
				</div>
				<div class="rd__block__wrap">
					<div class="content__title">성별</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="gender1" class="radio__input" value="all" name="gender" checked/>
							<label for="gender1">전체</label>

							<input type="radio" id="gender2" class="radio__input" value="남자" name="gender"/>
							<label for="gender2">남</label>
							
							<input type="radio" id="gender3" class="radio__input" value="여자" name="gender"/>
							<label for="gender3">여</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">구매금액/건수</div>
				<div class="content__row">
					<select name="sales_type" class="fSelect" style="width:163px;">
						<option value="" selected="selected">전체</option>
						<option value="1">총 주문금액</option>
						<option value="2">총 실결제금액</option>
						<option value="3">총 주문건수</option>
						<option value="4">총 실주문건수</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">주문일/결제 완료일</div>
				<div class="content__row">
					<select id="order_date_kind" name="ord_date_kind" class="fSelect" style="width:163px;">
						<option value="order_date" selected="selected">주문일</option>
						<option value="pay_date">결제완료일</option>
					</select>
					<div class="content__date__picker" style="margin-left:10px;">
						<input type="date" name="order_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
						~
						<input type="date" name="order_to" placeholder="To" readonly style="width:150px;">
					</div>
					<!-- <div class="cb__color">
						<label for="firstOrder">
							<input id="firstOrder" type="checkbox" name=" firstOrder"  value="firstOrder"><span>모바일 앱 이용 회원</span> 
						</label>
					</div> -->
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">주문상품</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;">
					<button style="width:120px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;">상품 검색</button>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="rd__block__wrap">
					<div class="content__title">접속일</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input type="date" name="login_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							~
							<input type="date" name="login_to" placeholder="To" readonly style="width:150px;margin-right:10px;">
						</div>
					</div>
				</div>
				<div class="rd__block__wrap">
					<div class="content__title">접속 IP</div>
					<div class="content__row">
						<input type="text" name="login_ip" value="" style="width:70%;margin-right:10px;" placeholder="ex)123.123.123.123">
					</div>
				</div>
			</div>

			<div class="card__body--hide detail_hidden" style="display: none;">
				<div class="content__wrap grid__half">
					<div class="rd__block__wrap">
						<div class="content__title">접속횟수</div>
						<div class="content__row">
							<div class="content__date__picker">
								<input type="text" name="min_login_cnt" value="" style="width:80px;margin-right:5px;">
								~
								<input type="text" name="max_login_cnt" value="" style="width:80px;margin-right:5px;">
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap grid__half">
					<div class="rd__block__wrap">
						<div class="content__title">SMS 수신</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="receive_sms1" class="radio__input" value="all" name="receive_sms" checked/>
								<label for="receive_sms1">전체</label>

								<input type="radio" id="receive_sms2" class="radio__input" value="Y" name="receive_sms"/>
								<label for="receive_sms2">수신허용</label>
								
								<input type="radio" id="receive_sms3" class="radio__input" value="N" name="receive_sms"/>
								<label for="receive_sms3">수신안함</label>
							</div>
						</div>
					</div>
					<div class="rd__block__wrap">
						<div class="content__title">이메일 수신</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="receive_email1" class="radio__input" value="all" name="receive_email" checked/>
								<label for="receive_email1">전체</label>

								<input type="radio" id="receive_email2" class="radio__input" value="Y" name="receive_email"/>
								<label for="receive_email2">수신 허용</label>
								
								<input type="radio" id="receive_email3" class="radio__input" value="N" name="receive_email"/>
								<label for="receive_email3">수신 안함</label>
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap grid__half">
					<div class="rd__block__wrap">
						<div class="content__title">거주지역</div>
						<div class="content__row">
							<select name="region" class="fSelect" style="width:163px;">
								<option value="all">전체</option>
								<option value="경기">경기</option>
								<option value="서울">서울</option>
								<option value="인천">인천</option>
								<option value="강원">강원</option>
								<option value="충남">충남</option>
								<option value="충북">충북</option>
								<option value="대전">대전</option>
								<option value="경북">경북</option>
								<option value="경남">경남</option>
								<option value="대구">대구</option>
								<option value="부산">부산</option>
								<option value="울산">울산</option>
								<option value="전북">전북</option>
								<option value="전남">전남</option>
								<option value="광주">광주</option>
								<option value="제주">제주</option>
								<option value="해외">해외</option>
							</select>
						</div>
					</div>						
					<div class="rd__block__wrap">
						<div class="content__title">가용적립금</div>	
						<div class="content__row">
							<select name="mileage_type" class="fSelect" style="width:163px;">
								<option value="avail_mileage">가용적립금</option>
							</select>
							
							<input type="text" name="min_mileage" value="" style="width:80px;margin-right:5px;">
							~
							<input type="text" name="max_mileage" value="" style="width:80px;margin-right:5px;">
						</div>
					</div>						
				</div>	
				<div class="content__wrap">
					<div class="content__title">휴먼회원 해제일</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input type="date" name="sleep_off_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
							~
							<input type="date" name="sleep_off_to" placeholder="To" readonly style="width:150px;margin-right:10px;">
							최근 1년까지 검색 가능
						</div>
					</div>
				</div>					
			</div>
			<div class="drive--x"></div>
		</div>

		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div id="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_01();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_01','getMemberTabInfo_01');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-01-01" action="member/update/status/put">
		<input type="hidden" class="action_type" name="action_type">
		<input type="hidden" class="action_name" name="action_name">
				
		<div class="card__header">
			<h3>회원 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 회원 수 <font class="cnt_01_total info__count" >0</font>명  
					<div class="drive--left"></div>
					검색결과 <font class="cnt_01_result info__count" >0</font>명
				</div>
					
				<div class="content__row">
					<div class="cb__color">
						<label for="memberDetail">
							<input id="memberDetail" type="checkbox" name="memberDetail" value="">
							자세히보기
						</label>
					</div>
					
					<select style="width:163px;float:right;" onChange="orderChange(this);">
						<option value="JOIN_DATE|DESC" selected>가입일 역순</option>
						<option value="JOIN_DATE|ASC">가입일 순</option>
						<option value="NAME|DESC">이름 역순</option>
						<option value="NAME|ASC">이름 순</option>
						<option value="ID|DESC">아이디 역순</option>
						<option value="ID|ASC">아이디 순</option>
						<option value="LEVEL|DESC">등급 역순</option>
						<option value="LEVEL|ASC">등급 순</option>
						<option value="STATUS|DESC">상태 역순</option>
						<option value="STATUS|ASC">상태 순</option>
						<option value="TEL|DESC">일반전화 역순</option>
						<option value="TEL|ASC">일반전화 순</option>
						<option value="TEL_MOBILE|DESC">휴대전화 역순</option>
						<option value="TEL_MOBILE|ASC">휴대전화 순</option>
						<option value="GENDER|DESC">성별 역순</option>
						<option value="GENDER|ASC">성별 순</option>
						<option value="AGE|DESC">나이 역순</option>
						<option value="AGE|ASC">나이 순</option>
						<option value="REGION|DESC">지역 역순</option>
						<option value="REGION|ASC">지역 순</option>
					</select>
					
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
				</div>

			</div>
			
			<div id="table_div_01" class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" action_type="member_faulty" onclick="memberActionCheck(this);">불량회원 설정</div>
						<div class="filter__btn" action_type="member_default" onclick="memberActionCheck(this);">불량회원 해제</div>
						<div class="filter__btn" action_type="member_drop" onclick="memberActionCheck(this);">강제 탈퇴</div>
						<div class="filter__btn" action_type="member_sms" onclick="memberActionCheck(this);">SMS 보내기</div>
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
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:8%;">가입일</TH>
								<TH style="width:8%;">이름</TH>
								<TH style="width:10%;">아이디</TH>
								<TH style="width:8%;">등급</TH>
								<TH style="width:8%;">상태</TH>
								<TH>일반 전화</TH>
								<TH>휴대 전화</TH>
								<TH style="width:5%;">성별</TH>
								<TH style="width:5%;">나이</TH>
								<TH style="width:5%;">지역</TH>
								<TH>메일/SMS/메모</TH>
								<TH>관련내역 보기</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_01">
							<TR>
								<TD class="default_td" colspan="13">
									조회 결과가 없습니다
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
	</form>
</div>

<script>
$(document).ready(function() {
	getMemberTabInfo_01();
});
function getMemberTabInfo_01() {
	$("#result_table_01").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_01").append(strDiv);
	
	var rows = $('#frm-list_01').find('.rows').val();
	$('#frm-list_01').find('.page').val(1);
	
	get_contents($("#frm-list_01"),{
		pageObj : $(".paging_01"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_01").html('');
			}
			
			d.forEach(function(row) {
				var join_date = [];
				if (row.join_date != null) {
					join_date = row.join_date.split(' ');
				}
				var strDiv = '';
				
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.no + '">';
				strDiv += '                    <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + join_date[0] + '<br>' + join_date[1] + '</TD>';
				strDiv += '    <TD>' + row.name + '</TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>' + row.level + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        ' + row.status;
				strDiv += '        <input type="hidden" id="member_status_' + row.no + '" value="' + row.status + '">';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.tel + '</TD>';
				strDiv += '    <TD>' + row.tel_mobile + '</TD>';
				strDiv += '    <TD>' + row.gender + '</TD>';
				strDiv += '    <TD>' + row.age + '</TD>';
				strDiv += '    <TD>' + row.region + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="row">';
				if (row.receive.email == true) {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">MAIL</button>';
				} else {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;">MAIL</button>';
				}
				if (row.receive.sms == true) {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">SMS</button>';
				} else {
					strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;">SMS</button>';
				}
				strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;">MEMO</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="">';
				strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">주문</button>';
				strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">적립금</button>';
				strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">쿠폰</button>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table_01").append(strDiv);
			});
		},
	},rows,1);
}

function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기 +');
	}
	$('.detail_hidden').toggle();
}

function memberActionCheck(obj) {
	var action_type = $(obj).attr('action_type');
	var action_name = "";
	var action_target = "";
	
	var select_idx = [];
	var length = $('#frm-01-01').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-01-01').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-01-01').find('.select').eq(i).val());
		}
	}
	
	switch (action_type) {
		case "member_faulty" :
			action_name = "불량회원 설정";
			action_target = "정상";
			break;
		
		case "member_default" :
			action_name = "불량회원 해제";
			action_target = "불량";
			break;
		
		case "member_drop" :
			action_name = "강제 탈퇴";
			action_target = "";
			break;
	}
	
	if (select_idx.length == 0) {
		alert(action_name + ' 처리 할 멤버를 선택해주세요.');
	} else {
		var cnt = 0;
		
		$('#frm-01-01').find('.action_type').val(action_type);
		$('#frm-01-01').find('.action_name').val(action_name);
		
		for (var i=0; i<select_idx.length; i++) {
			var member_status = $('#member_status_' + select_idx[i]).val();
			if (action_target.length > 0 && member_status != action_target) {
				cnt++;
			}
		}
		
		if (cnt == 0) {
			console.log("chk");
			confirm('선택한 멤버를 ' + action_name + ' 하시겠습니까?','memberAction(' + select_idx.length + ')');
		} else {
			alert(action_target + ' 상태의 멤버만 ' + action_name + ' 처리할 수 있습니다.');
		}
	}
}

function memberAction(len) {
	var action_type = $('#frm-01-01').find('.action_type').val();
	var action_name = $('#frm-01-01').find('.action_name').val();
	
	var formData = new FormData();
	formData = $("#frm-01-01").serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/update/status/put",
		error: function() {
			alert(action_name + " 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				insertLog("고객관리 > 회원 조회 > 회원조회", action_name, len);
				getMemberTabInfo_01();
			}
		}
	});
}
</script>