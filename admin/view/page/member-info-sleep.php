<div class="content__card">
	<form id="frm-filter_SLP" action="member/info/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="tab_status" value="SLP">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>휴면회원</h3>
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
							<input type="radio" id="member_gender_SLP_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_SLP_ALL">전체</label>

							<input type="radio" id="member_gender_SLP_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_SLP_M">남</label>
							
							<input type="radio" id="member_gender_SLP_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_SLP_F">여</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">휴면처리일</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input class="search_date_type" type="hidden" name="search_date_type" value="">
							<input class="search_date" type="hidden" name="search_date" value="">
							
							<div class="date__picker" date_type="sleep" date="all" type="button"  onclick="searchDateClick(this);">전체</div>
							<div class="date__picker" date_type="sleep" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="date__picker" date_type="sleep" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="date__picker" date_type="sleep" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="date__picker" date_type="sleep" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="date__picker" date_type="sleep" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="date__picker" date_type="sleep" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="date__picker" date_type="sleep" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							<div class="date__picker" date_type="sleep" date="01y" type="button"  onclick="searchDateClick(this);">1년</div>
						</div>
						
						<div class="content__date__picker">
							<input id="sleep_from" class="date_param" type="date" name="sleep_from"  placeholder="From" readonly="" style="width:150px;" date_type="sleep" onChange="dateParamChange(this);">
							<font style="display:none;">~</font>
							<input id="sleep_to" class="date_param" type="date" name="sleep_to" placeholder="To" readonly="" style="width:150px;" date_type="sleep" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('SLP');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_SLP','getMemberInfoList');"><span>초기화</span></div>
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
				총 회원 수 <font class="cnt_SLP_total info__count" >0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_SLP_result info__count" >0</font>명
			</div>
			<div class="content__row">
				<select style="width:163px;float:right;" tab_status="SLP" onChange="orderChange(this);">
					<option value="SLEEP_DATE|DESC" selected>휴면일 역순</option>
					<option value="SLEEP_DATE|ASC">휴면일 순</option>
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
				
				<select name="rows" tab_status="SLP" onChange="rowsChange(this);" style="width: 163px;">
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
	</div>
	<div id="table_div_SLP" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" style="width:130px;" onClick="excelDownload();">엑셀 다운로드</div>
			</div> 
		</div>
		<div class="overflow-x-auto">
			<TABLE id="excel_table_SLP">
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
						<TH>휴면일</TH>
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
				<TBODY id="result_table_SLP">
					
				</TBODY>
			</TABLE>
		</div>
	</div>
	
	<div class="padding__wrap">
		<input type="hidden" class="total_cnt" tab_status="SLP" value="0" onChange="setPaging(this);">
		<input type="hidden" class="result_cnt" tab_status="SLP" value="0" onChange="setPaging(this);">
		<div class="paging_SLP"></div>
	</div>
</div>

<script>
$(document).ready(function() {
	getMemberInfoList('SLP');
});

function searchSelectChange(obj) {
	var selectVal = $(obj).val();
	
	if (selectVal == "sleep_date") {
		$('#search_keyword').val(null);
		$('#search_keyword').hide();
		$('.search_hidden').show();
	} else {
		$('#search_keyword').show();
		$('.search_hidden').hide();
	}
}

function setMemberInfoList_SLP(member_data) {
	let result_table = $('#result_table_SLP');
	
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
			strDiv += '    <TD>' + row.sleep_date + '</TD>';
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