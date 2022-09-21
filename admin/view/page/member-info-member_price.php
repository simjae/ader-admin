<div class="content__card">
	<form id="frm-list_05" action="member/get">
		<input type="hidden" name="sort_type" value="ID">
		<input type="hidden" name="sort_value" value="ASC">
		<input type="hidden" name="tab_num" value="04">
		<div class="card__header">
			<h3>구매액순 조회</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap" >
				<div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_pricedate" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_pricedate date__picker search_hidden checked"  date_type="pricedate" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_pricedate date__picker search_hidden" date_type="pricedate" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="pricedate_from" class="date_param search_hidden" type="date" name="pricedate_from"  placeholder="From" readonly="" style="width:150px;" date_type="pricedate" onChange="dateParamChange(this);">
							<font class="search_hidden">~</font>
							<input id="pricedate_to" class="date_param search_hidden" type="date" name="pricedate_to" placeholder="To" readonly="" style="width:150px; " date_type="pricedate" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">구매조건</div>
				<div class="content__row">
					<select class="fSelect" name="amount_type" style="width:163px;">
						<option value="">- 총 구매금액기준 -</option>
						<option value="order_amount">총 주문금액 기준</option>
						<option value="payment_amount">총 실결제금액 기준</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_02();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_05', 'getMemberTabInfo_05');"><span>초기화</span></div>
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
				총 회원수 <font style="color:#3971FF;font-weight:800;">21,883</font>명 
				<div class="drive--left"></div>
				검색결과 <font style="color:#3971FF;font-weight:800;">5</font>명
			</div>
			<div class="content__row">
				<select name="rows" style="width:163px;float:right;" onChange="rowsChange(this);">
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
	<div id="table_div_05" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
			</div> 	
			<div>
				<div class="table__setting__btn">설정</div>
			</div>  
		</div>
		<div class="overflow-x-auto">
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:3%;">순위</TH>
						<TH style="width:8%;">아이디</TH>
						<TH style="width:8%;">이름</TH>
						<TH style="width:10%;">전화 번호</TH>
						<TH style="width:10%;">휴대폰 번호</TH>
						<TH>주소</TH>
						<TH style="width:15%;">기간 내 총 주문 금액</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>1</TD>
						<TD>2292454647@k</TD>
						<TD>QUAN MEIHUA</TD>
						<TD>-</TD>
						<TD>010-6823-8688</TD>
						<TD>서울 은평구 대조동 4-6 1302호</TD>
						<TD class="text-right">11,915,000원</TD>
					</TR>
					<TR>
						<TD>1</TD>
						<TD>2292454647@k</TD>
						<TD>QUAN MEIHUA</TD>
						<TD>-</TD>
						<TD>010-6823-8688</TD>
						<TD>서울 은평구 대조동 4-6 1302호</TD>
						<TD class="text-right">11,915,000원</TD>
					</TR>
					<TR>
						<TD>1</TD>
						<TD>2292454647@k</TD>
						<TD>QUAN MEIHUA</TD>
						<TD>-</TD>
						<TD>010-6823-8688</TD>
						<TD>서울 은평구 대조동 4-6 1302호</TD>
						<TD class="text-right">11,915,000원</TD>
					</TR>
					<TR>
						<TD>1</TD>
						<TD>2292454647@k</TD>
						<TD>QUAN MEIHUA</TD>
						<TD>-</TD>
						<TD>010-6823-8688</TD>
						<TD>서울 은평구 대조동 4-6 1302호</TD>
						<TD class="text-right">11,915,000원</TD>
					</TR>
					
				</TBODY>
			</TABLE>
		</div>
	</div>
	<div class="padding__wrap">
		<div class="paging_05"></div>
	</div>
</div>


<script>
function initFilter_05(){
	$('#frm-list_05').find('select[name="amount_type"] option:eq(0)').prop("selected", true);

	$('.search_date_pricedate').css('background-color','#ffffff');
	$('.search_date_pricedate').css('color','#000000');
	$('#search_date_pricedate').val('');

	$('#pricedate_from').val('');
	$('#pricedate_to').val('');

	getMemberTabInfo_03();
}
</script>