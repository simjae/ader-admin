<div class="content__card">
	<form id="frm-list_02" action="member/info/get">
		<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="02">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3>휴면회원</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">회원정보</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" onChange="searchSelectChange(this);">
						<option value="member_id" selected="selected">아이디</option>
						<option value="name">이름</option>
						<option value="tel">전화번호</option>
						<option value="mobile">휴대폰 번호</option>
						<option value="email">이메일</option>
						<option value="sleep_date">휴면 처리일</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:150px;">
				</div>
			</div>
			<div class="content__wrap search_hidden" style="display: none;">
				<div class="content__title">휴면처리일</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_sleep" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_sleep date__picker search_hidden" style="display: none;" date_type="sleep" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="sleep_from" class="date_param search_hidden" type="date" name="sleep_from"  placeholder="From" readonly="" style="width:150px;display: none;" date_type="sleep" onChange="dateParamChange(this);">
							<font class="search_hidden" style="display:none;">~</font>
							<input id="sleep_to" class="date_param search_hidden" type="date" name="sleep_to" placeholder="To" readonly="" style="width:150px; display: none;" date_type="sleep" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_02();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_02', 'getMemberTabInfo_02');"><span>초기화</span></div>
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
				총 회원 수 <font class="cnt_02_total info__count" >0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_02_result info__count" >0</font>명
			</div>
			<div class="content__row">
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
	</div>
	<div id="table_div_02" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
			</div> 	
			<div>
				<div class="table__setting__btn">설정</div>
			</div>   
		</div>
		<div class="overflow-x-auto">
			<TABLE id="excel_table_02">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
					<col width="5%">
					<col width="5%">
					<col width="5%">
				</colgroup>
				<THEAD>
					<TR>
						<TH>휴면 처리일</TH>
						<TH>아이디</TH>
						<TH>이름</TH>
						<TH>이메일</TH>
						<TH>전화번호</TH>
						<TH>휴대폰 번호</TH>
						<TH>성별</TH>
						<TH>나이</TH>
						<TH>지역</TH>
					</TR>
				</THEAD>
				<TBODY id="result_table_02">
					<TR>
						<TD class="default_td" colspan="9">
							조회 결과가 없습니다
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

<script>
$(document).ready(function() {
	getMemberTabInfo_02();
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

function getMemberTabInfo_02() {
	var tab_num = $('#tab_num').val();
	
	$("#result_table_02").html('');
	
	var strDiv = '';
	strDiv += '<TD colspan="11">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_02").append(strDiv);
	
	var rows = $('#frm-list_02').find('.rows').val();
	$('#frm-list_02').find('.page').val(1);
	
	get_contents($("#frm-list_02"),{
		pageObj : $(".paging_02"),
		html : function(d) {
			
			if (d.length > 0) {
				$("#result_table_02").html('');
			}
			
			d.forEach(function(row) {
				var sleep_date = [];
				if (row.sleep_date != null) {
					sleep_date = row.sleep_date.split(' ');
				}
				
				var strDiv = '';
				strDiv += '<TR>';
				strDiv += '    <TD>' + sleep_date[0] + '</TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>' + row.name + '</TD>';
				strDiv += '    <TD>' + row.email + '</TD>';
				strDiv += '    <TD>' + row.tel + '</TD>';
				strDiv += '    <TD>' + row.tel_mobile + '</TD>';
				strDiv += '    <TD>' + row.gender + '</TD>';
				strDiv += '    <TD>' + row.age + '</TD>';
				strDiv += '    <TD>' + row.region + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table_02").append(strDiv);
			});
		},
	},rows,1);
}
</script>