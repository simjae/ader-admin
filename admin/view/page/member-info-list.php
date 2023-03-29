<div class="content__card">
	<form id="frm-filter_INF" action="member/info/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="tab_status" value="INF">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>회원조회</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">쇼핑몰</div>
				<div class="content__row">
					<select class="fSelect country" name="country" style="width:163px;">
						<option value="KR" selected="selected">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">회원정보</div>
				<div class="content__row">
					<select name="search_type" class="fSelect" style="width:163px;">
						<option value="member_id" selected="">아이디</option>
						<option value="member_name">이름</option>
						<option value="tel_mobile">휴대폰번호</option>
						<option value="member_addr">주소</option>
					</select>

					<input class="content__input" type="text" name="search_keyword" value="" style="width:70%;">
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원레벨</div>
					<div class="content__row">
						<select name="member_level" class="fSelect" style="width:163px;">
							<option value="ALL" selected="selected">전체</option>
						<?php
							$select_level_sql = "
								SELECT
									ML.IDX		AS LEVEL_IDX,
									ML.TITLE	AS LEVEL_TITLE
								FROM
									MEMBER_LEVEL ML
								WHERE
									DEL_FLG = FALSE
							";
							
							$db->query($select_level_sql);
							
							foreach($db->fetch() as $level_data) {
						?>
							<option value="<?=$level_data['LEVEL_IDX']?>"><?=$level_data['LEVEL_TITLE']?></option>
						<?php
							}
						?>
						</select>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">성별</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="member_gender_INF_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_INF_ALL">전체</label>

							<input type="radio" id="member_gender_INF_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_INF_M">남</label>
							
							<input type="radio" id="member_gender_INF_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_INF_F">여</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">가입일/생일</div>
					<div class="content__row">
						<select class="fSelect" name="day_type" style="width:163px;">
							<option value="JOIN_DATE" checked>가입일</option>
							<option value="MEMBER_BIRTH">생일</option>
						</select>
						
						<div class="content__date__picker" style="margin-left:10px;">
							<input type="date" name="day_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								~
							<input type="date" name="day_to" placeholder="To" readonly style="width:150px;">
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">나이</div>
					<div class="content__row">
						<input type="text" name="min_age" value="" style="width:80px;margin-right:5px;">세
							~
						<input type="text" name="max_age" value="" style="width:80px;margin-right:5px;">세
					</div>
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
					<div class="half__box__wrap">
						<div class="content__title">SMS 수신</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="receive_sms_flg_ALL" class="radio__input" value="ALL" name="receive_sms_flg" checked>
								<label for="receive_sms_flg_ALL">전체</label>

								<input type="radio" id="receive_sms_flg_TRUE" class="radio__input" value="TRUE" name="receive_sms_flg"/>
								<label for="receive_sms_flg_TRUE">수신허용</label>
								
								<input type="radio" id="receive_sms_flg_FALSE" class="radio__input" value="FALSE" name="receive_sms_flg"/>
								<label for="receive_sms_flg_FALSE">수신안함</label>
							</div>
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">푸쉬 수신</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="receive_push_flg_ALL" class="radio__input" value="ALL" name="receive_push_flg" checked>
								<label for="receive_push_flg_ALL">전체</label>

								<input type="radio" id="receive_push_flg_TRUE" class="radio__input" value="TRUE" name="receive_push_flg"/>
								<label for="receive_push_flg_TRUE">수신 허용</label>
								
								<input type="radio" id="receive_push_flg_FALSE" class="radio__input" value="FALSE" name="receive_push_flg"/>
								<label for="receive_push_flg_FALSE">수신 안함</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">이메일 수신</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="receive_email_flg_ALL" class="radio__input" value="ALL" name="receive_email_flg" checked>
								<label for="receive_email_flg_ALL">전체</label>

								<input type="radio" id="receive_email_flg_TRUE" class="radio__input" value="TRUE" name="receive_email_flg"/>
								<label for="receive_email_flg_TRUE">수신 허용</label>
								
								<input type="radio" id="receive_email_flg_FALSE" class="radio__input" value="FALSE" name="receive_email_flg"/>
								<label for="receive_email_flg_FALSE">수신 안함</label>
							</div>
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">지역</div>
						<div class="content__row">
							<select name="region" class="fSelect" style="width:163px;">
								<option value="ALL">전체</option>
								<option value="경기">경기</option>
								<option value="서울">서울</option>
								<option value="인천">인천</option>
								<option value="강원">강원</option>
								<option value="충청남도">충남</option>
								<option value="충청북도">충북</option>
								<option value="대전">대전</option>
								<option value="경상북도">경북</option>
								<option value="경상남도">경남</option>
								<option value="대구">대구</option>
								<option value="부산">부산</option>
								<option value="울산">울산</option>
								<option value="전라북도">전북</option>
								<option value="전라남도">전남</option>
								<option value="광주">광주</option>
								<option value="제주">제주</option>
								<option value="해외">해외</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">가용적립금</div>	
						<div class="content__row">
							<input type="text" name="min_mileage" value="" style="width:80px;margin-right:5px;">
							~
							<input type="text" name="max_mileage" value="" style="width:80px;margin-right:5px;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">휴먼회원 해제일</div>
						<div class="content__row">
							<div class="content__date__picker">
								<input type="date" name="sleep_off_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								~
								<input type="date" name="sleep_off_to" placeholder="To" readonly style="width:150px;margin-right:10px;">
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>

		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div id="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('INF');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_INF','getMemberInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<form id="frm-list-INF" action="member/update/status/put">
		<div class="card__header">
			<h3>회원 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 회원 수 <font class="cnt_INF_total info__count" >0</font>명  
					
					<div class="drive--left"></div>
					검색결과 <font class="cnt_INF_result info__count" >0</font>명
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;" tab_status="INF" onChange="orderChange(this);">
						<option value="JOIN_DATE|DESC" selected>가입일 역순</option>
						<option value="JOIN_DATE|ASC">가입일 순</option>
						<option value="LOGIN_DATE|DESC">최근로그인 역순</option>
						<option value="LOGIN_DATE|ASC">최근로그인 순</option>
						<option value="MEMBER_NAME|DESC">회원이름 역순</option>
						<option value="MEMBER_NAME|ASC">회원이름 순</option>
						<option value="MEMBER_ID|DESC">회원ID 역순</option>
						<option value="MEMBER_ID|ASC">회원ID 순</option>
						<option value="MEMBER_STATUS|DESC">회원상태 역순</option>
						<option value="MEMBER_STATUS|ASC">회원상태 순</option>
						<option value="TEL_MOBILE|DESC">휴대전화 역순</option>
						<option value="TEL_MOBILE|ASC">휴대전화 순</option>
					</select>
					
					<select name="rows" tab_status="INF" onChange="rowsChange(this);" style="width: 163px;">
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
						<div class="filter__btn" style="width:130px;" onclick="setSuspicionMember('TRUE');">의심회원 설정</div>
						<div class="filter__btn" style="width:130px;" onclick="setSuspicionMember('FALSE');">의심회원 해제</div>
						<div class="filter__btn" style="width:130px;" onclick="setDropMember();">강제 탈퇴</div>
						<div class="filter__btn" style="width:130px;">SMS 보내기</div>
						<div class="filter__btn" style="width:130px;">MAIL 보내기</div>
						<div class="filter__btn" style="width:130px;" onClick="excelDownload();">엑셀 다운로드</div>
					</div>               
				</div>
				<div class="overflow-x-auto">
					<TABLE id="excel_table_INF">
						<colgroup>
							<col width="50px;">
							<col width="80px">
							<col width="80px">
							<col width="150px">
							<col width="150px">
							<col width="250px">
							<col width="50px">
							<col width="100px">
							<col width="50px">
							<col width="120px">
							<col width="50px">
							<col width="100px">
							<col width="100px">
							<col width="450px">
							<col width="auto;">
						</colgroup>
						<THEAD>
							<TR>
								<TH>
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>No.</TH>
								<TH>쇼핑몰</TH>
								<TH>가입일</TH>
								<TH>최근로그인</TH>
								<TH>회원정보</TH>
								<TH>회원상태</TH>
								<TH>휴대전화</TH>
								<TH>회원성별</TH>
								<TH>회원생일</TH>
								<TH>회원나이</TH>
								<TH>거주지역</TH>
								<TH>지역번호</TH>
								<TH>주소</TH>
								<TH>메일/SMS/메모</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_INF">
							
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_status="INF" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_status="INF" value="0" onChange="setPaging(this);">
				<div class="paging_INF"></div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getMemberInfoList('INF');
});

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

function setMemberInfoList_INF(member_data) {
	let result_table = $('#result_table_INF');
	
	result_table.html('');
	let strDiv = "";
	if (member_data != null) {
		member_data.forEach(function(row) {
			let detail_link = "";
			if (row.country != null && row.member_idx != null) {
				detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
			}
			
			strDiv += '<TR>';
			strDiv += '    <TD>';
			strDiv += '        <div class="cb__color">';
			strDiv += '            <label>';
			strDiv += '                <input class="select" type="checkbox" name="member_idx[]" value="' + row.member_idx + '">';
			strDiv += '                    <span></span>';
			strDiv += '            </label>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + row.num + '</TD>';
			strDiv += '    <TD>' + row.txt_country + '</TD>';
			strDiv += '    <TD>' + row.join_date + '</TD>';
			strDiv += '    <TD>' + row.login_date + '</TD>';
			strDiv += '    <TD ' + detail_link + '>';
			strDiv += '        ' + row.member_name + '<br/>';
			strDiv += '        ' + row.member_id + '<br/>';
			strDiv += '        ' + row.member_level + '<br/>';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + row.member_status + '</TD>';
			strDiv += '    <TD>' + row.tel_mobile + '</TD>';
			strDiv += '    <TD>' + row.member_gender + '</TD>';
			strDiv += '    <TD>' + row.member_birth + '</TD>';
			strDiv += '    <TD>' + row.age + '</TD>';
			strDiv += '    <TD>' + row.region + '</TD>';
			strDiv += '    <TD>' + row.zipcode + '</TD>';
			strDiv += '    <TD>';
			strDiv += '        '+ row.road_addr + '<br/>';
			strDiv += '        '+ row.lot_addr + '<br/>';
			strDiv += '        '+ row.detail_addr + '<br/>';
			strDiv += '    </TD>';
			strDiv += '    <TD>';
			strDiv += '        <div class="row">';
			
			if (row.receive_sms_flg == true) {
				strDiv += '        <button class="receive_true_btn" style="">SMS</button>';
			} else {
				strDiv += '        <button class="receive_false_btn">SMS</button>';
			}
			
			if (row.receive_push_flg == true) {
				strDiv += '        <button class="receive_true_btn">알림</button>';
			} else {
				strDiv += '        <button class="receive_false_btn">알림</button>';
			}
			
			if (row.receive_email_flg == true) {
				strDiv += '        <button class="receive_true_btn">메일</button>';
			} else {
				strDiv += '        <button class="receive_false_btn">메일</button>';
			}
				
			strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;">메모</button>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '</TR>';
		});
		
		result_table.append(strDiv);
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="15" style="text-align:left;">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}
</script>