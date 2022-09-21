<div class="content__card">
	<form id="frm-list_03" action="member/info/get">
		<input type="hidden" class="sort_value" name="sort_value" value="JOIN_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="03">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3>탈퇴회원</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">아이디</div>
				<div class="content__row">
					<input type="text" name="member_id" value="" style="width:20%;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">탈퇴 유형</div>
				<div class="content__row">
					<select name="drop_type" id="drop_type" class="fSelect" style="width:20%;">
						<option value="all" selected="">전체</option>
						<option value="탈퇴신청중">탈퇴신청중</option>
						<option value="일반탈퇴">일반탈퇴</option>
						<option value="강제탈퇴">강제탈퇴</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_drop" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_drop date__picker" date_type="drop" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_drop date__picker" date_type="drop" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_drop date__picker" date_type="drop" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_drop date__picker" date_type="drop" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_drop date__picker" date_type="drop" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_drop date__picker" date_type="drop" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_drop date__picker" date_type="drop" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="drop_from" class="date_param" type="date" name="drop_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="drop_to" class="date_param" type="date" name="drop_to" placeholder="To" readonly style="width:150px;" date_type="drop" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">탈퇴 사유</div>
				<div class="content__row">
					<select class="fSelect" name="drop_reason" style="width:20%;">
						<option value="all">전체</option>
						<option value="01">상품종류가 부족하다</option>
						<option value="02">상품가격이 비싸다</option>
						<option value="03">상품가격에 비해 품질이 떨어진다</option>
						<option value="04">배송이 느리다</option>
						<option value="05">반품/교환이 불만이다</option>
						<option value="06">상담원 고객응대 서비스가 불만이다</option>
						<option value="07">쇼핑몰 혜택이 부족하다 (쿠폰, 적립금,할인 등)</option>
						<option value="08">이용빈도가 낮다</option>
						<option value="09">개인정보 유출이 염려된다</option>
						<option value="10">기타</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_03();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_03', 'getMemberTabInfo_03');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<form id="frm-03-01" action="member/update/drop/put">
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 회원 수 <font class="cnt_03_total info__count" >0</font>명 
					<div class="drive--left"></div>
					검색결과 <font class="cnt_03_result info__count" >0</font>명
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
			
			<div id="table_div_03" class="table table__wrap">
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
					<TABLE id="excel_table_03">
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
								<TH style="width:8%;">아이디</TH>
								<TH style="width:8%;">상태</TH>
								<TH style="width:8%;">회원 탈퇴일</TH>
								<TH style="width:8%;">탈퇴 유형</TH>
								<TH>탈퇴 사유</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_03">
							<TR>
								<TD class="default_td" colspan="6">
									조회 결과가 없습니다
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>		
			</div>	
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" tab_num="03" onChange="setResultCount(this);">
				<input type="hidden" class="result_cnt" value="0" tab_num="03" onChange="setResultCount(this);">
            	<div class="paging_03"></div>
        	</div>
		</div>	
	</form>
</div>

<script>
$(document).ready(function() {
	getMemberTabInfo_03();
})
function getMemberTabInfo_03() {
	var tab_num = $('#tab_num').val();
	
	$("#result_table_" + tab_num).html('');
	
	var strDiv = '';
	strDiv += '<TD colspan="6">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_03").append(strDiv);
	
	var rows = $('#frm-list_03').find('.rows').val();
	$('#frm-list_03').find('.page').val(1);
	
	get_contents($("#frm-list_03"),{
		pageObj : $(".paging_03"),
		html : function(d) {
			
			if (d.length > 0) {
				$("#result_table_03").html('');
			}
			
			d.forEach(function(row) {
				var drop_date = [];
				var str_drop_date = "";
				if (row.drop_date != null) {
					drop_date = row.drop_date.split(' ');
					str_drop_date = drop_date[0] + '<br>' + drop_date[1];
				} else {
					str_drop_date = "탈퇴신청중"
				}
				
				var strDiv = '';
				
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="form-group">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.no + '">';
				strDiv += '                    <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.id + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        ' + row.status;
				strDiv += '        <input type="hidden" id="drop_status_' + row.no + '" value="' + row.status + '">';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + str_drop_date + '</TD>';
				strDiv += '    <TD>' + row.drop_type + '</TD>';
				strDiv += '    <TD>' + row.remark + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table_03").append(strDiv);
			});
		},
	},rows,1);
}

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
			
			if (drop_status != "탈퇴신청") {
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
</script>