<div class="content__card">
	<form id="frm-list_03" action="member/visit/get">
		<input type="hidden" class="sort_value" name="sort_value" value="STORE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" name="tab_num" value="03">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		<div class="card__header">
			<h3 id="tabTitle">OFF 방문기록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="content__wrap grid__half">
			<div class="rd__block__wrap">
				<div class="content__title">이름</div>
				<div class="content__row">
					<input type="text" value="" name="member_name" style="width:150px;">
				</div>
			</div>
			<div class="rd__block__wrap">
				<div class="content__title">매장</div>
				<div class="content__row">
					<select name="store" id="store" onchange="selectChange(this);" style="width: 150px;">
						<option value="" selected>전체</option>	
						<option value="성수" >성수</option>
						<option value="신사">신사</option>
						<option value="홍대">홍대</option>
						<option value="한남">한남</option>
						<option value="대전">대전</option>
					</select>
				</div>	
			</div>
		</div>
		
		<div class="content__wrap grid__half">
			<div class="rd__block__wrap">
				<div class="content__title">연락처</div>
				<div class="content__row">
					<input type="text" value="" name="tel_mobile" style="width:150px;">
				</div>
			</div>
			
			<div class="rd__block__wrap">
				<div class="content__title">이메일</div>
				<div class="content__row">
					<input type="text" value="" name="email" style="width:150px;">
				</div>
			</div>
		</div>
		
		<div class="content__wrap grid__half">
			<div class="rd__block__wrap">
				<div class="content__title">인스타그램 ID</div>
				<div class="content__row">
					<input type="text" value="" name="instagram_id" style="width:150px;">
				</div>
			</div>
		</div>
		<div class="content__wrap">
			<div class="content__title">방문 기간</div>
			<div class="content__row">
				<div class="content__date__wrap">
					<div class="content__date__btn">
						<input id="search_date_offline" type="hidden" name="search_date" value="" style="width:150px;">

						<div class="search_date_offline date__picker" date_type="offline" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
						<div class="search_date_offline date__picker" date_type="offline" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
						<div class="search_date_offline date__picker" date_type="offline" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
						<div class="search_date_offline date__picker" date_type="offline" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
						<div class="search_date_offline date__picker" date_type="offline" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
						<div class="search_date_offline date__picker" date_type="offline" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
						<div class="search_date_offline date__picker" date_type="offline" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
					</div>
					<div class="content__date__picker">
						<input id="offline_from" class="date_param" type="date" name="offline_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="offline" onChange="dateParamChange(this);">
							<font>~</font>
						<input id="offline_to" class="date_param" type="date" name="offline_to" placeholder="To" readonly style="width:150px;" date_type="offline" onChange="dateParamChange(this);">
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getVisitTabInfo_03();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="initFilter_03();"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-03-01" action="member/update/put">
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
					<div>
						<div class="table__setting__btn">설정</div>
					</div> 
				</div>
				<div class="overflow-x-auto">
					<TABLE id="excel_table_03">
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
						<TBODY id="result_table_03">
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
				<input type="hidden" class="total_cnt" tab_num="03" value="0" onChange="setResultCount(this);">
				<input type="hidden" class="result_cnt" tab_num="03" value="0" onChange="setResultCount(this);">
				<div class="paging_03"></div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getVisitTabInfo_03();
});
function initFilter_03(){
	$('#frm-list_03').find('input[name="member_name"]').val('');
	$('#frm-list_03').find('select[name="store"] option:eq(0)').prop("selected", true);
	$('#frm-list_03').find('input[name="tel_mobile"]').val('');
	$('#frm-list_03').find('input[name="email"]').val('');
	$('#frm-list_03').find('input[name="instagram_id"]').val('');

	$('.search_date_offline').css('background-color','#ffffff');
	$('.search_date_offline').css('color','#000000');
	$('#search_date_offline').val('');

	$('#offline_from').val('');
	$('#offline_to').val('');

	getVisitTabInfo_03();
}
function getVisitTabInfo_03() {
	var tab_num = $('#tab_num').val();
	$("#result_table_03").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="7">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table_03").append(strDiv);
	
	var rows = $('#frm-list_03').find('.rows').val();
	var page = $('#frm-list_03').find('.page').val(1);
	
	get_contents($("#frm-list_03"),{
		pageObj : $(".paging_03"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_03").html('');
			}
			
			d.forEach(function(row) {
				var strDiv = '';
				strDiv += '<TR>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.input_date + '</TD>';
				strDiv += '    <TD>' + row.store + '</TD>';
				strDiv += '    <TD>' + row.name + '</TD>';
				strDiv += '    <TD>' + row.tel + '</TD>';
				strDiv += '    <TD>' + row.email + '</TD>';
				strDiv += '    <TD>' + row.instagram_id + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table_03").append(strDiv);
			});
		},
	},rows,1);
}

function selectChange(e) {
	let selected = $(e).find('option:selected').val();
	 changVal = $("[name=store]").val(selected);
} 
</script>