<div class="content__card">
	<form id="frm-list_04" action="member/get">
		<input type="hidden" name="sort_type" value="ID">
		<input type="hidden" name="sort_value" value="ASC">
		<input type="hidden" name="tab_num" value="04">
		<div class="card__header">
			<h3>주문회원</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">회원 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="orderMemberType1" class="radio__input" value="" name="orderMemberType" checked>
						<label for="orderMemberType1">주문 회원</label>

						<input type="radio" id="orderMemberType2" class="radio__input" value="주문회원" name="orderMemberType">
						<label for="orderMemberType2">주문 회원</label>
						
						<input type="radio" id="orderMemberType3" class="radio__input" value="주문안한회원" name="orderMemberType">
						<label for="orderMemberType3">주문 안한 회원</label>

						<input type="radio" id="orderMemberType4" class="radio__input" value="특별관리회원" name="orderMemberType">
						<label for="orderMemberType4">특별 괸리 회원</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">회원 등급</div>
				<div class="content__row">
					<select class="fSelect" id="groupNo" name="group_no" style="width:163px;">
						<option value="" selected="selected">전체</option>
						<option value="1">일반회원</option>
						<option value="5">ADER family</option>
					</select>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">결제 수단</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="paymentType1" class="radio__input" value="" name="paymentType" checked="">
							<label for="paymentType1">전체</label>
							
							<input type="radio" id="paymentType2" class="radio__input" value="수단선택" name="paymentType">
							<label for="paymentType2">수단 선택</label>

							<button style="width:50px;height:30px;border:1px solid;background-color:#ffff;border-radius: 5px;">설정</button>
						</div>
					</div>
				</div>
				<!-- <div class="half__box__wrap">
					<div class="content__title">결제 업체</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="paymentCompany1" class="radio__input" value="전체" name="paymentCompany" checked="">
							<label for="paymentCompany1">전체</label>
							
							<input type="radio" id="paymentCompany2" class="radio__input" value="업체선택" name="paymentCompany">
							<label for="paymentCompany2">업체 선택</label>

							<button style="width:50px;height:30px;border:1px solid;background-color:#ffff;border-radius: 5px;">설정</button>
						</div>
					</div>
				</div> -->
			</div>
			<div class="content__wrap" style="display: none;">
				<div class="content__title">주문 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_orderdate" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_orderdate date__picker search_hidden checked" style="display: none;" date_type="orderdate" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_orderdate date__picker search_hidden" style="display: none;" date_type="orderdate" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="orderdate_from" class="date_param search_hidden" type="date" name="orderdate_from"  placeholder="From" readonly="" style="width:150px;display: none;" date_type="orderdate" onChange="dateParamChange(this);">
							<font class="search_hidden" style="display:none;">~</font>
							<input id="orderdate_to" class="date_param search_hidden" type="date" name="orderdate_to" placeholder="To" readonly="" style="width:150px; display: none;" date_type="orderdate" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이름</div>
				<div class="content__row">
					<input type="text" value="" style="width:163px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">아이디</div>
				<div class="content__row">
					<input type="text" value="" style="width:163px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">주문번호</div>
				<div class="content__row">
					<input type="text" value="" style="width:163px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">구매 금액</div>
				<div class="content__row">
					<select class="fSelect" name="amount_type" style="width:163px;">
						<option value="">- 구매금액기준 -</option>
						<option value="order_amount">총 주문금액</option>
						<option value="payment_amount">총 실결제금액</option>
					</select>
					
					<input type="text" value="" style="width:163px;">
					~
					<input type="text" value="" style="width:163px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">구매 건수</div>
				<div class="content__row">
					<select class="fSelect" name="count_type" style="width:163px;">
						<option value="">- 구매건수기준 -</option>
						<option value="order_count">총 주문건수</option>
						<option value="payment_count">총 실주문건수</option>
					</select>
					
					<input type="text" value="" style="width:163px;">
					~
					<input type="text" value="" style="width:163px;">
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_02();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_04', 'getMemberTabInfo_04');"><span>초기화</span></div>
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
	<div id="table_div_02" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" action_type="member_sms" onclick="memberActionCheck(this);">SMS 보내기</div>
				<div class="filter__btn" action_type="member_mail" onclick="memberActionCheck(this);">MAIL 보내기</div>
			</div> 	
			<div>
				<div class="table__setting__btn">설정</div>
			</div>  
		</div>
		<div class="overflow-x-auto">
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:3%;">
							<div class="cb__color">
								<label>
									<input type="checkbox"  onClick="selectAllClick(this);">
									<span></span>
								</label>
							</div>
						</TH>
						<TH style="width:4%;">No.</TH>
						<TH style="width:8%;">최근 주문일</TH>
						<TH style="width:8%;">이름</TH>
						<TH style="width:10%;">아이디</TH>
						<TH style="width:8%;">회원 등급</TH>
						<TH>최근 주문번호</TH>
						<TH style="width:8%;">총 주문 금액</TH>
						<TH style="width:8%;">총 주문 건수</TH>
						<TH style="width:5%;">결제수단</TH>
						<TH>메일/SMS/메모</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox">
									<span></span>
								</label>
							</div>
						</TD>
						<TD>105</TD>
						<TD>2022-06-20</TD>
						<TD>송기태</TD>
						<TD style="text-decorate:underline;">2055108878@k</TD>
						<TD>일반회원</TD>
						<TD style="text-decorate:underline;">20220620-0000400</TD>
						<TD class="text-right">379,000원</TD>
						<TD>1건</TD>
						<TD>신용카드</TD>
						<TD>-</TD>
					</TR>
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox">
									<span></span>
								</label>
							</div>
						</TD>
						<TD>105</TD>
						<TD>2022-06-20</TD>
						<TD>송기태</TD>
						<TD style="text-decorate:underline;">2055108878@k</TD>
						<TD>일반회원</TD>
						<TD style="text-decorate:underline;">20220620-0000400</TD>
						<TD class="text-right">379,000원</TD>
						<TD>1건</TD>
						<TD>신용카드</TD>
						<TD>-</TD>
					</TR>
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox">
									<span></span>
								</label>
							</div>
						</TD>
						<TD>105</TD>
						<TD>2022-06-20</TD>
						<TD>송기태</TD>
						<TD style="text-decorate:underline;">2055108878@k</TD>
						<TD>일반회원</TD>
						<TD style="text-decorate:underline;">20220620-0000400</TD>
						<TD class="text-right">379,000원</TD>
						<TD>1건</TD>
						<TD>신용카드</TD>
						<TD>-</TD>
					</TR>
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox">
									<span></span>
								</label>
							</div>
						</TD>
						<TD>105</TD>
						<TD>2022-06-20</TD>
						<TD>송기태</TD>
						<TD style="text-decorate:underline;">2055108878@k</TD>
						<TD>일반회원</TD>
						<TD style="text-decorate:underline;">20220620-0000400</TD>
						<TD class="text-right">379,000원</TD>
						<TD>1건</TD>
						<TD>신용카드</TD>
						<TD>-</TD>
					</TR>
					
					
					
				</TBODY>
			</TABLE>
		</div>
	</div>
	
	<div class="padding__wrap">
		<div class="paging_04"></div>
	</div>
</div>

<script>
</script>