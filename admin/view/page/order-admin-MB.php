<div class="content__card">
	<form id="frm-filter_MB" action="memo/member/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="ML.CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3 id="tabTitle">관리자 메모 조회</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
            <div class="content__wrap">
                <div class="content__title">쇼핑몰</div>
                <div class="content__row">
					<select name="country" class="fSelect" style="width:163px;">
						<option value="KR" selected="selected">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중문몰</option>
					</select>
                </div>
            </div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원이름</div>
					<div class="content__row">
						<input type="text" name="member_name" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">회원ID</div>
					<div class="content__row">
						<input type="text" name="member_id" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원전화번호</div>
					<div class="content__row">
						<input type="text" name="tel_mobile" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">접속IP</div>
					<div class="content__row">
						<input type="text" name="member_ip" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">메모작성자</div>
					<div class="content__row">
						<input type="text" name="creater" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">메모내용</div>
					<div class="content__row">
						<input type="text" name="memo" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
                <div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="date_param_MB" type="hidden" name="date_param" value="" style="width:150px;">

							<div class="date__picker" date_type="MB" date="today"	type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="date__picker" date_type="MB" date="01d"		type="button" onclick="searchDateClick(this);">어제</div>
							<div class="date__picker" date_type="MB" date="03d"		type="button" onclick="searchDateClick(this);">3일</div>
							<div class="date__picker" date_type="MB" date="07d"		type="button" onclick="searchDateClick(this);">7일</div>
							<div class="date__picker" date_type="MB" date="15d"		type="button" onclick="searchDateClick(this);">15일</div>
							<div class="date__picker" date_type="MB" date="01m"		type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="date__picker" date_type="MB" date="03m"		type="button" onclick="searchDateClick(this);">3개월</div>
							<div class="date__picker" date_type="MB" date="01y"		type="button" onclick="searchDateClick(this);">1년</div>
						</div>
						
						<div class="content__date__picker">
							<input id="date_from_MB" class="date_param" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="MB" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="date_to_MB" class="date_param" type="date" name="date_to" placeholder="To" readonly style="width:150px;" date_type="MB" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemoInfoList('MB');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter_MB', 'getMemoInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3 id="tabTitle">검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				검색결과 <font class="cnt_01_result info__count" >21,999</font>명
			</div>
			
			<div class="content__row">
				<select name="searchSorting" class="fSelect" style="float:right;width:163px;margin-right:10px;" tab_status="MB" onChange="orderChange(this);">
					<option value="ML.CREATE_DATE|DESC">메모작성일 역순</option>
					<option value="ML.CREATE_DATE|ASC">메모작성일 순</option>
					<option value="ML.CREATER|DESC">메모작성자 역순</option>
					<option value="ML.CREATER|ASC">메모작성자 순</option>
					
					<option value="MB.MEMBER_NAME|DESC">회원이름 역순</option>
					<option value="MB.MEMBER_NAME|ASC">회원이름 순</option>
					<option value="MB.MEMBER_ID|DESC">회원ID 역순</option>
					<option value="MB.MEMBER_ID|ASC">회원ID 순</option>
				</select>
				
				<select name="rows" style="width:163px;margin-right:10px;float:right;" tab_status="MB" onChange="rowsChange(this);">
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
		<div class="table__wrap table">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div> 	
			</div>
			<TABLE class="result_table_MB">
				<colgroup>
					<col width="80px;">
					<col width="200px;">
					
					<col width="auto;">
					
					<col width="100px;">
					<col width="150px;">
					<col width="150px;">
				</colgroup>
				<THEAD>
					<TR>
						<TH>쇼핑몰</TH>
						<TH>회원정보</TH>
						
						<TH>메모</TH>
						
						<TH>전체메모</TH>
						<TH>작성일</TH>
						<TH>작성자</TH>
					</TR>
				</THEAD>
				<TBODY class="result_body">
					
				</TBODY>
			</TABLE>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" tab_status="MB" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" value="0" tab_status="MB" onChange="setPaging(this);">
			<div class="paging_MB"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getMemoInfoList('MB');
});

function setMemberMemoList(memo_data) {
	let result_table = $('.result_table_MB');
	let result_body = result_table.find('.result_body');
	
	result_body.html('');
	
	let strDiv = "";
	if (memo_data != null) {
		memo_data.forEach(function(row) {
			strDiv += '<TR>';
			strDiv += '    <TD>' + row.txt_country + '</TD>';
			strDiv += '    <TD>';
			strDiv += '        ' + row.member_name + '<br/>' + row.member_id;
			strDiv += '    </TD>';
			
			strDiv += '    <TD>' + row.memo + '</TD>';
			
			strDiv += '    <TD>' + row.memo_cnt + '</TD>';
			strDiv += '    <TD>' + row.create_date + '</TD>';
			strDiv += '    <TD>' + row.creater + '</TD>';
			strDiv += '</TR>';
		});
	} else {
		strDiv += '<TR>';
		strDiv += '    <TD colspan="6" style="text-align:left;">조회 결과가 없습니다.</TD>';
		strDiv += '</TR>';
	}
	
	result_body.append(strDiv);
}

</script>
