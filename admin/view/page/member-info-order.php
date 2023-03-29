<div class="content__card">
	<form id="frm-filter_ORD" action="member/info/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="ORDER_CNT">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="tab_status" value="ORD">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>주문회원</h3>
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
							<input type="radio" id="member_gender_ORD_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_ORD_ALL">전체</label>

							<input type="radio" id="member_gender_ORD_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_ORD_M">남</label>
							
							<input type="radio" id="member_gender_ORD_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_ORD_F">여</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">주문일</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input class="search_date_type" type="hidden" name="search_date_type" value="">
							<input class="search_date" type="hidden" name="search_date" value="">
							
							<div class="date__picker" date_type="order" date="all" type="button"  onclick="searchDateClick(this);">전체</div>
							<div class="date__picker" date_type="order" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="date__picker" date_type="order" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="date__picker" date_type="order" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="date__picker" date_type="order" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="date__picker" date_type="order" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="date__picker" date_type="order" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="date__picker" date_type="order" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							<div class="date__picker" date_type="order" date="01y" type="button"  onclick="searchDateClick(this);">1년</div>
						</div>
						
						<div class="content__date__picker">
							<input id="order_from" class="date_param" type="date" name="order_from"  placeholder="From" readonly="" style="width:150px;" date_type="order" onChange="dateParamChange(this);">
							<input id="order_to" class="date_param" type="date" name="order_to" placeholder="To" readonly="" style="width:150px;" date_type="order" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('ORD');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_ORD','getMemberInfoList');"><span>초기화</span></div>
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
				총 회원 수 <font class="cnt_ORD_total info__count" >0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_ORD_result info__count" >0</font>명
			</div>
			<div class="content__row">
				<select style="width:163px;float:right;" tab_status="ORD" onChange="orderChange(this);">
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
					
					<option value="ORDER_CNT|DESC">주문수량 역순</option>
					<option value="ORDER_CNT|ASC">주문수량 순</option>
				</select>
						
				<select name="rows" tab_status="ORD" onChange="rowsChange(this);" style="width: 163px;">
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
	<div id="table_div_ORD" class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" style="width:130px;" onclick="memberActionCheck(this);">SMS 보내기</div>
				<div class="filter__btn" style="width:130px;" onclick="memberActionCheck(this);">MAIL 보내기</div>
				<div class="filter__btn" style="width:130px;" onClick="excelDownload();">엑셀 다운로드</div>
			</div> 
		</div>
		<div class="overflow-x-auto">
			<TABLE id="excel_table_ORD">
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
					<col width="50px">
					<col width="150px">
					<col width="150px">
					<col width="150px">
					<col width="150px">
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
						<TH>주문횟수</TH>
						<TH>최근 주문번호</TH>
						<TH>최근 결제수단</TH>
						<TH>최근 주문금액</TH>
						<TH>최근 결제금액</TH>
					</TR>
				</THEAD>
				<TBODY id="result_table_ORD">
					
				</TBODY>
			</TABLE>
		</div>
	</div>
	
	<div class="padding__wrap">
		<input type="hidden" class="total_cnt" tab_status="ORD" value="0" onChange="setPaging(this);">
		<input type="hidden" class="result_cnt" tab_status="ORD" value="0" onChange="setPaging(this);">
		<div class="paging_ORD"></div>
	</div>
</div>

<script>
$(document).ready(function() {
	getMemberInfoList('ORD');
});
function setMemberInfoList_ORD(member_data) {
	let result_table = $('#result_table_ORD');
	
	let strDiv = "";
	if (member_data != null) {
		let strDiv = "";
		member_data.forEach(function(row) {
			let detail_link = "";
			if (row.country != null && row.member_idx != null) {
				detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
			}
			
			let detail_order_link = "";
			if (row.country != null && row.member_idx != null) {
				detail_order_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '&detail_status=ORD\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
			}
			
			let order_link = "";
			if (row.order_code != null) {
				order_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))" ';
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
			
			strDiv += '    <TD ' + detail_order_link + '>' + row.order_cnt + '</TD>';
			strDiv += '    <TD' + order_link + '>' + row.order_code + '</TD>';
			strDiv += '    <TD>' + row.pg_payment + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.price_product + '</TD>';
			strDiv += '    <TD style="text-align:right;">' + row.price_total + '</TD>';
			strDiv += '</TR>';
		});
		
		result_table.append(strDiv);
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="16" style="text-align:left;">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}
</script>