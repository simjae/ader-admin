<div class="content__card">
	<form id="frm-filter_OFF" action="member/visit/offline/get">
		<input type="hidden" class="sort_value" name="sort_value" value="STORE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">

		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3 id="tabTitle">OFF 방문기록</h3>
			<div class="drive--x"></div>
		</div>
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
			<div class="content__title">구매자 정보</div>
			<div class="content__row">
				<select name="search_type" class="fSelect" style="width:163px;">
					<option value="customer_id" selected="">아이디</option>
					<option value="customer_name">이름</option>
					<option value="customer_tel">휴대폰번호</option>
					<option value="customer_email">이메일</option>
				</select>

				<input class="content__input" type="text" name="search_keyword" value="" style="width:70%;">
			</div>
		</div>

		<div class="content__wrap grid__half">
			<div class="rd__block__wrap">
				<div class="content__title">인스타그램 ID</div>
				<div class="content__row">
					<input type="text" value="" name="off_instagram" style="width:150px;">
				</div>
			</div>
			<div class="rd__block__wrap">
				<div class="content__title">매장</div>
				<div class="content__row">
					<select name="off_store" id="off_store" style="width: 150px;">
						<option value="" selected>전체</option>
<?php
		$get_store_sql = "
				SELECT 
					DISTINCT STORE AS STORE 
				FROM 
					OFFLINE_ENTERANCE
				WHERE
					STORE IS NOT NULL
				group by 
					STORE
		";
		$db->query($get_store_sql);

		foreach($db->fetch() as $data){
			$store_name = '';
			if($data['STORE'] == ''){
				$data['STORE'] = 'empty';
				$store_name = '매장명 미입력';
			}
			else if($data['STORE'] == 'undefined'){
				$store_name = '매장확인 불가';
			}
			else{
				$store_name = $data['STORE'];
			}
		
?>
						<option value="<?=$data['STORE']?>" ><?=$store_name?></option>
<?php
		}
?>
					</select>
				</div>	
			</div>
		</div>
		
		<div class="content__wrap">
			<div class="content__title">방문 기간</div>
			<div class="content__row">
				<div class="content__date__wrap">
					<div class="content__date__btn">
						<input class="search_date" type="hidden" name="search_date" value="">
						<div class="date__picker" date_type="offline" date="all" type="button"  onclick="searchDateClick(this);">전체</div>
						<div class="date__picker" date_type="offline" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
						<div class="date__picker" date_type="offline" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
						<div class="date__picker" date_type="offline" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
						<div class="date__picker" date_type="offline" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
						<div class="date__picker" date_type="offline" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
						<div class="date__picker" date_type="offline" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
						<div class="date__picker" date_type="offline" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						<div class="date__picker" date_type="offline" date="01y" type="button"  onclick="searchDateClick(this);">1년</div>
					</div>
					
					<div class="content__date__picker">
						<input id="offline_from" class="date_param" type="date" name="offline_from"  placeholder="From" readonly="" style="width:150px;" date_type="login" onChange="dateParamChange(this);">
						<font style="display:none;">~</font>
						<input id="offline_to" class="date_param" type="date" name="offline_to" placeholder="To" readonly="" style="width:150px;" date_type="login" onChange="dateParamChange(this);">
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberVisitInfoList('OFF');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter(frm-filter_OFF, getMemberVisitInfoList());"><span>초기화</span></div>
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
				총 회원 수 <font class="cnt_OFF_total info__count" >0</font>명 
				<div class="drive--left"></div> 
				검색결과 <font class="cnt_OFF_result info__count" >0</font>명
			</div>
			<div class="content__row">
				<select style="width:163px;float:right;" onChange="orderChange(this);">
					<option value="STORE|DESC">매장명 역순</option>
					<option value="STORE|ASC">매장명 순</option>
					<option value="NAME|DESC">이름 역순</option>
					<option value="NAME|ASC">이름 순</option>
					<option value="TEL|DESC">연락처 역순</option>
					<option value="TEL|ASC">연락처 순</option>
					<option value="EMAIL|DESC">이메일 역순</option>
					<option value="EMAIL|ASC">이메일 순</option>
					<option value="INSTAGRAM_ID|DESC">인스타그램ID 역순</option>
					<option value="INSTAGRAM_ID|ASC">인스타그램ID 순</option>
					<option value="INPUT_DATE|DESC">방문시각 역순</option>
					<option value="INPUT_DATE|ASC">방문시각 순</option>
				</select>
				
				<select name="rows" onChange="rowsChange(this);" style="width: 130px;">
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
					<input type="hidden" class="action_type" name="action_type">
					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div>
			</div>
			<div class="overflow-x-auto">
				<TABLE id="excel_table_OFF">
					<THEAD>
						<TR>
							<TH style="width:4%;">No.</TH>
							<TH style="width:5%;">방문시각</TH>
							<TH style="width:5%;">매장</TH>
							<TH style="width:5%;">이름</TH>
							<TH style="width:10%;">연락처</TH>
							<TH style="width:10%;">이메일</TH>
							<TH style="width:10%;">인스타그램</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table_OFF">
						<TR>
							<TD class="default_td" colspan="7">
								조회 결과가 없습니다.
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" tab_status="OFF" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" tab_status="OFF" value="0" onChange="setPaging(this);">
			<div class="paging_OFF"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getMemberVisitInfoList('OFF');
});

function setMemberVisitInfoList_OFF(offline_data){
	let result_table = $('#result_table_OFF');
	result_table.html('');
	
	if(offline_data != null){
		offline_data.forEach(function(row){
			if(row.store == 'undefined'){
				row.store = '매장확인 불가';
			}

			let strDiv = '';
			strDiv += '<TR>';
			strDiv += '    <TD>' + row.num + '</TD>';
			strDiv += '    <TD>' + row.input_date + '</TD>';
			strDiv += '    <TD>' + row.store + '</TD>';
			strDiv += '    <TD>' + row.name + '</TD>';
			strDiv += '    <TD>' + row.tel + '</TD>';
			strDiv += '    <TD>' + row.email + '</TD>';
			strDiv += '    <TD>' + row.instagram_id + '</TD>';
			strDiv += '</TR>';
			
			result_table.append(strDiv);
		});
	}
	else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="7" style="text-align:left;">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}

</script>