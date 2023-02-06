<div class="content__card">
	<form id="frm-filter_PRC" action="member/info/list/price/get">
		<input type="hidden" class="sort_value" name="sort_value" value="DROP_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="tab_status" value="PRC">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>구매액순 조회</h3>
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
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__wrap">
						<div class="content__title">주문수량</div>
						<div class="content__row">
							<input type="text" name="min_order_cnt" value="" style="width:80px;margin-right:5px;">
							~
							<input type="text" name="max_order_cnt" value="" style="width:80px;margin-right:5px;">
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__wrap">
						<div class="content__title">주문금액</div>
						<div class="content__row">
							<select class="fSelect" name="price_type" style="width:163px;">
								<option value="max_price_product">주문금액 최고가</option>
								<option value="sum_price_product">총 주문금액</option>
								<option value="max_price_total">결제금액 최고가</option>
								<option value="sum_price_total">총 결제금액</option>
							</select>
							<input type="text" name="min_price" value="" style="width:80px;margin-right:5px;">
							~
							<input type="text" name="max_price" value="" style="width:80px;margin-right:5px;">
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap" >
				<div class="content__title">주문기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input class="search_date_type" type="hidden" name="search_date_type" value="">
							<input class="search_date" type="hidden" name="search_date" value="">
							
							<div class="date__picker" date_type="order" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="date__picker" date_type="order" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="date__picker" date_type="order" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="date__picker" date_type="order" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="date__picker" date_type="order" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="date__picker" date_type="order" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="date__picker" date_type="order" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						
						<div class="content__date__picker">
							<input id="order_from" class="date_param" type="date" name="sleep_from"  placeholder="From" readonly="" style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
							<font style="display:none;">~</font>
							<input id="order_to" class="date_param" type="date" name="sleep_to" placeholder="To" readonly="" style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('PRC');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_PRC','getMemberInfoList');"><span>초기화</span></div>
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
				총 회원 수 <font class="cnt_PRC_total info__count" >0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_PRC_result info__count" >0</font>명
			</div>
			<div class="content__row">
				<select style="width:163px;float:right;" tab_status="PRC" onChange="orderChange(this);">
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
				
				<select name="rows" tab_status="PRC" onChange="rowsChange(this);" style="width: 163px;">
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
	<div id="table_div_PRC" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
			</div> 	
			<div>
				<div class="table__setting__btn">설정</div>
			</div>  
		</div>
		<div class="overflow-x-auto">
			<TABLE id="excel_table_PRC">
				<colgroup>
					<col width="3%">
					<col width="3%">
					<col width="5%">
					<col width="10%">
					<col width="15%">
					<col width="5%">
					<col width="5%">
					<col width="8%">
					<col width="5%">
					<col width="5%">
					<col width="5%">
					<col width="auto">
					<col width="auto">
					<col width="auto">
					<col width="auto">
					<col width="auto">
				</colgroup>
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
						<TH>No.</TH>
						<TH>최근 주문일</TH>
						<TH>이름</TH>
						<TH>ID</TH>
						<TH>회원등급</TH>
						<TH>상태</TH>
						<TH>휴대전화</TH>
						<TH>성별</TH>
						<TH>나이</TH>
						<TH>지역</TH>
						<TH>총 주문수량</TH>
						<TH>기간 내 주문금액 최고가</TH>
						<TH>기간 내 총 주문금액</TH>
						<TH>기간 내 결제금액 최고가</TH>
						<TH>기간 내 총 결제금액</TH>
					</TR>
				</THEAD>
				<TBODY id="result_table_PRC">
					<TR>
						<TD class="default_td" colspan="16" style="text-align:left;">
							조회 결과가 없습니다
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
	</div>
	<div class="padding__wrap">
		<input type="hidden" class="total_cnt" tab_status="PRC" value="0" onChange="setPaging(this);">
		<input type="hidden" class="result_cnt" tab_status="PRC" value="0" onChange="setPaging(this);">
		<div class="paging_PRC"></div>
	</div>
</div>


<script>
$(document).ready(function() {
	getMemberInfoList('PRC');
})

function setMemberInfoList_PRC(member_data) {
	let result_table = $('#result_table_PRC');
	
	let strDiv = "";
	if (member_data != null) {
		let strDiv = "";
		member_data.forEach(function(row) {
			strDiv += '<TR>';
			strDiv += '    <TD>';
			strDiv += '        <div class="cb__color">';
			strDiv += '            <label>';
			strDiv += '                <input class="select" type="checkbox" name="member_idx[]" value="' + row.member_idx + '">';
			strDiv += '                <span></span>';
			strDiv += '            </label>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + row.num + '</TD>';
			strDiv += '    <TD>' + row.order_date + '</TD>';
			strDiv += '    <TD>' + row.member_name + '</TD>';
			strDiv += '    <TD>' + row.member_id + '</TD>';
			strDiv += '    <TD>' + row.member_level + '</TD>';
			strDiv += '    <TD>' + row.member_status + '</TD>';
			strDiv += '    <TD>' + row.tel_mobile + '</TD>';
			strDiv += '    <TD>' + row.member_gender + '</TD>';
			strDiv += '    <TD>' + row.age + '</TD>';
			strDiv += '    <TD>' + row.region + '</TD>';
			strDiv += '    <TD>' + row.order_cnt + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.max_price_product + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.sum_price_product + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.max_price_total + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.sum_price_total + '</TD>';
			strDiv += '</TR>';
		});
		
		result_table.append(strDiv);
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="16">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}
</script>