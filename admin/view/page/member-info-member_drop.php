<div class="content__card">
	<form id="frm-filter_DRP" action="member/info/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="DROP_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		
		<input type="hidden" name="tab_status" value="DRP">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<h3>탈퇴회원</h3>
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
									dev.MEMBER_LEVEL ML
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
							<input type="radio" id="member_gender_DRP_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_DRP_ALL">전체</label>

							<input type="radio" id="member_gender_DRP_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_DRP_M">남</label>
							
							<input type="radio" id="member_gender_DRP_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_DRP_F">여</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">탈퇴기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input class="search_date_type" type="hidden" name="search_date_type" value="">
							<input class="search_date" type="hidden" name="search_date" value="">
							
							<div class="date__picker" date_type="drop" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="date__picker" date_type="drop" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="date__picker" date_type="drop" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="date__picker" date_type="drop" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="date__picker" date_type="drop" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="date__picker" date_type="drop" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="date__picker" date_type="drop" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						
						<div class="content__date__picker">
							<input id="drop_from" class="date_param" type="date" name="drop_from"  placeholder="From" readonly="" style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
							<font style="display:none;">~</font>
							<input id="drop_to" class="date_param" type="date" name="drop_to" placeholder="To" readonly="" style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('DRP');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_DRP','getMemberInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<form id="frm-03-01" action="member/update/drop/put">
		<input type="hidden" name="drop_country" value="KR">
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 회원 수 <font class="cnt_DRP_total info__count" >0</font>명 
					<div class="drive--left"></div>
					검색결과 <font class="cnt_DRP_result info__count" >0</font>명
				</div>
				<div class="content__row">
					<select style="width:163px;float:right;" tab_status="DRP" onChange="orderChange(this);">
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
					
					<select name="rows" tab_status="DRP" onChange="rowsChange(this);" style="width: 163px;">
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
			
			<div id="table_div_DRP" class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onClick="memberDropCheck();">탈퇴</div>
						<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
					</div> 	
					<div>
						<div class="table__setting__btn">설정</div>
					</div>  
				</div>
				<div class="overflow-x-auto">
					<TABLE id="excel_table_DRP">
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
								<TH>탈퇴일</TH>
								<TH>이름</TH>
								<TH>ID</TH>
								<TH>회원등급</TH>
								<TH>상태</TH>
								<TH>휴대전화</TH>
								<TH>성별</TH>
								<TH>나이</TH>
								<TH>지역</TH>
								<TH>탈퇴사유</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_DRP">
							<TR>
								<TD class="default_td" colspan="12">
									조회 결과가 없습니다
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>		
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_status="DRP" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_status="DRP" value="0" onChange="setPaging(this);">
				<div class="paging_DRP"></div>
        	</div>
		</div>	
	</form>
</div>

<script>
$(document).ready(function() {
	getMemberInfoList('DRP');
})

function memberDropCheck() {
	var select_idx = [];
	var length = $('#frm-03-01').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-03-01').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-03-01').find('.select').eq(i).val());
		}
	}
	
	if (select_idx.length == 0) {
		alert('탈퇴 처리 할 멤버를 선택해주세요.');
	} else {
		var cnt = 0;
		for (var i=0; i<select_idx.length; i++) {
			var drop_status = $('#drop_status_' + select_idx[i]).val();
			
			if (drop_status != "AFD") {
				cnt++;
			}
		}
		
		if (cnt == 0) {
			confirm('선택한 멤버를 탈퇴 처리하시겠습니까.','memberDrop()');
		} else {
			alert('탈퇴 신청 상태의 멤버만 탈퇴 처리할 수 있습니다.');
		}
	}
}

function memberDrop() {
	var formData = new FormData();
	formData = $("#frm-03-01").serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/update/drop/put",
		error: function() {
			alert("멤버의 탈퇴처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert("정상적으로 탈퇴처리되었습니다.");
				getMemberTabInfo_03();
			}
		}
	});
}

function setMemberInfoList_DRP(member_data) {
	let result_table = $('#result_table_DRP');
	
	let strDiv = "";
	if (member_data != null) {
		let strDiv = '';
		member_data.forEach(function(row) {
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
			strDiv += '    <TD>' + row.drop_date + '</TD>';
			strDiv += '    <TD>' + row.member_name + '</TD>';
			strDiv += '    <TD>' + row.member_id + '</TD>';
			strDiv += '    <TD>' + row.member_level + '</TD>';
			strDiv += '    <TD>' + row.drop_type + '</TD>';
			strDiv += '    <TD>' + row.tel_mobile + '</TD>';
			strDiv += '    <TD>' + row.member_gender + '</TD>';
			strDiv += '    <TD>' + row.age + '</TD>';
			strDiv += '    <TD>' + row.region + '</TD>';
			strDiv += '    <TD>-</TD>';
			strDiv += '</TR>';
		});
		
		result_table.append(strDiv);
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="12">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}
</script>