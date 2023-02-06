
<style>
.info__wrap{
	margin-bottom: 20px;
}
</style>
<div class="content__card">
	<div class="card__header">
		<h3>전체 적립금 내역 통계</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table table__wrap">
			<table>
				<THEAD>
					<TR>
						<TH rowspan="2">국가</TH>
						<TH colspan="3">가용 적립금</TH>
						<TH>미가용 적립금</TH>
					</TR>
					
					<TR>
						<TH>지급된 적립금</TH>
						<TH>사용된 적립금</TH>
						<TH>사용가능 적립금</TH>
						<TH>총합</TH>
					</TR>
				</THEAD>
				<TBODY>
<?php
	$sql = '
		SELECT
			COUNTRY						AS COUNTRY,
			SUM(MILEAGE_USABLE_INC)		AS SUM_USABLE_INC,
			SUM(MILEAGE_USABLE_DEC)		AS SUM_USABLE_DEC,
			SUM(MILEAGE_USABLE_INC)
			- SUM(MILEAGE_USABLE_DEC)	AS SUM_USABLE_TOTAL,
			SUM(MILEAGE_UNUSABLE)		AS SUM_UNUSABLE
		FROM 
			dev.MILEAGE_INFO
		GROUP BY 
			COUNTRY
	';
	$db->query($sql);
	foreach($db->fetch() as $data) {
		switch($data['COUNTRY']){
			case 'KR':
				$country_str = "한국몰";
				break;
			case 'EN':
				$country_str = "영문몰";
				break;
			case 'CN':
				$country_str = "중국몰";
				break;
		}
?>
					<TR>
						<TD class="text-right"><?=$country_str?></TD>
						<TD class="text-right"><?=number_format($data['SUM_USABLE_INC'])?></TD>
						<TD class="text-right">-<?=number_format($data['SUM_USABLE_DEC'])?></TD>
						<TD class="text-right"><?=number_format($data['SUM_USABLE_TOTAL'])?></TD>
						<TD class="text-right"><?=number_format($data['SUM_UNUSABLE'])?></TD>
					</TR>
<?php
	}
?>
					
				</TBODY>
			</table>
		</div>
	</div>
</div>
<div class="content__card">
	<form id="frm-list" action="member/mileage/get">
		<input type="hidden" id="tab_num" name="tab_num" value="01">
		<input type="hidden" name="mileage_type" value="">
		<input type="hidden" name="rows" value="10">
		<input type="hidden" name="page" value="1">
		
		<div class="card__header">
			<h3>회원 적립금 관리</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select name="country" class="fSelect" style="width:150px;">
						<option value="KR">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">등급</div>
				<div class="content__row">
					<select name="member_level" class="fSelect" style="width:150px;">
						<option value="">전체</option>	
						<option value="2">ADER family</option>
						<option value="1">일반회원</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">아이디</div>
				<div class="content__row">
					<input type="text" value="" name="id" style="width:150px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_reserve" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_reserve date__picker checked" date_type="reserve" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_reserve date__picker" date_type="reserve" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="reserve_from" class="date_param" type="date" name="reserve_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="reserve" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="reserve_to" class="date_param" type="date" name="reserve_to" placeholder="To" readonly style="width:150px;" date_type="reserve" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="searchMileageInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list', 'searchMileageInfo')"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<div class="card__header">
		<h3 id="statistic_result_title">검색결과 내 적립금 내역 통계</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table table__wrap">
			<table>
				<THEAD>
					<TR>
						<TH colspan="3">가용 적립금</TH>
						<TH>미가용 적립금</TH>
					</TR>
					
					<TR>
						<TH>증가</TH>
						<TH>사용된 적립금</TH>
						<TH>합계</TH>
						<TH>증가</TH>
					</TR>
				</THEAD>
				<TBODY id="result_statistics_table">
					<TR>
						<TD class="text-right">0</TD>
						<TD class="text-right">0</TD>
						<TD class="text-right">0</TD>
						<TD class="text-right">0</TD>
					</TR>
				</TBODY>
			</table>
		</div>
	</div>
</div>
<div class="content__card">
	<div class="card__header">
		<h3 id="mileage_result_title">회원 적립금 내역</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="justify-between info__wrap">
			<div class="flex"style="gap:50px;">
				<div class="category__tab" tabNum="01" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">가용 적립금</div>
				<div class="category__tab" tabNum="02" style="height:30px;color:#707070;text-align:center;cursor:pointer;">미가용 적립금</div>
				<div class="category__tab" tabNum="03" style="height:30px;color:#707070;text-align:center;cursor:pointer;">사용된 적립금</div>
			</div>
		</div>

		<div class="table table__wrap tabNum tabNum_01">
			<?php include_once("member-reserve-usable.php"); ?>
		</div>
		<div class="table table__wrap tabNum tabNum_02" style="display:none;">
			<?php include_once("member-reserve-unusable.php"); ?>
		</div>
		<div class="table table__wrap tabNum tabNum_03" style="display:none;">	
			<?php include_once("member-reserve-used.php"); ?>	
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('.category__tab').click(function() {		
		var tabNum = $(this).attr('tabNum');
		$('#tab_num').val(tabNum);
		if (tabNum != null) {
			$('.tabNum').hide();
			$('.tabNum_' + tabNum).show();
			$('.tabNum_' + tabNum).find(".mileage_type option:eq(0)").prop("selected",true);
			$('.tabNum_' + tabNum).find(".rows option:eq(0)").prop("selected",true);
		}
		$('.category__tab').not($(this)).css('color','#707070');
		$('.category__tab').not($(this)).css('border-bottom','none');
		
		$(this).css('color','#140f82');
		$(this).css('border-bottom','3px solid #140f82');
		
		$('#frm-list').find("input[name='rows']").val(10);
		$('#frm-list').find("input[name='page']").val(1);
		$('#frm-list').find("input[name='mileage_type']").val('');

		getMileageTabInfo();
	});
	getMileageTabStatistics();
	getMileageTabInfo();
});
function init_form(){
	$('.search_date_reserve').css('background-color','#ffffff');
	$('.search_date_reserve').css('color','#000000');
	$('#search_date_reserve').val('');

	$('#reserve_from').val('');
	$('#reserve_to').val('');

	$("select[name=member_level] option:first").prop("selected", true);
	$("input[name=id]").val('');
}
function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');
	var date_type = $(obj).attr('date_type');

	if (date_type == "reserve") {
		$('.search_date_reserve').not($(obj)).css('background-color','#ffffff');
		$('#search_date_reserve').val(date);
		$('#reserve_from').val('');
		$('#reserve_to').val('');
	} 
}
function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	var sel_std_date = new Date($('input[name="reserve_from"]').val()).getTime();
	var sel_end_date = new Date($('input[name="reserve_to"]').val()).getTime();

	if(Date.now() < sel_std_date){
		alert('검색 시작기간을 제대로 입력해주세요');
		$('#reserve_from').val('');
		$('#reserve_to').val('');
	}
	if(sel_std_date != NaN && sel_end_date != NaN){
		if(sel_std_date > sel_end_date ){
			alert('정확한 검색기간를 선택해주세요');
			$('#reserve_from').val('');
			$('#reserve_to').val('');
		}
	}

	if (date_type == "reserve") {
		$('.search_date_reserve').css('background-color','#ffffff');
		$('.search_date_reserve').css('color','#000000');
		$('#search_date_reserve').val('');
	} 
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-list').find("input[name='rows']").val(rows);
	$('#frm-list').find("input[name='page']").val(1);

	getMileageTabInfo();
}
function mileageChange(obj) {
	var mileage_type = $(obj).val();
	
	$('#frm-list').find("input[name='mileage_type']").val(mileage_type);
	$('#frm-list').find("input[name='page']").val(1);
	
	getMileageTabInfo();
}
function setPaging(obj) {
	var tab_num = $('#tab_num').val();
	
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();
	
	$('.tabNum_' + tab_num).find('.cnt_total').text(total_cnt);
	$('.tabNum_' + tab_num).find('.cnt_result').text(result_cnt);
}
function searchMileageInfo() {
	if($('select[name="country"]').val().length == 0){
		alert('국가항목을 반드시 선택해주세요');
	}
	$('#frm-list').find("input[name='page']").val(1);
	getMileageTabStatistics();
	getMileageTabInfo();
}
function getMileageTabInfo() {
	
	var tab_num = $('#tab_num').val();
	$("#result_table_"+tab_num).html('');
	
	var strDiv = '';
	strDiv += '<td class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</td>';
	
	$("#result_table_"+tab_num).append(strDiv);

	var rows = $('#frm-list').find("input[name='rows']").val();
	var page = $('#frm-list').find("input[name='page']").val();

	var country = $('select[name="country"]').val();
	title_country_str = '';
	statistic_country_str = '';
	switch(country){
		case 'KR':
			title_country_str = '[한국몰] 회원 적립금 내역';
			statistic_country_str = '검색결과 내 [한국몰] 적립금 내역 통계';
			break;
		case 'EN':
			title_country_str = '[영문몰] 회원 적립금 내역';
			statistic_country_str = '검색결과 내 [영문몰] 적립금 내역 통계';
			break;
		case 'CN':
			title_country_str = '[중국몰] 회원 적립금 내역';
			statistic_country_str = '검색결과 내 [중국몰] 적립금 내역 통계';
			break;
		default:
			title_country_str = '회원 적립금 내역';
			statistic_country_str = '검색결과 내 적립금 내역 통계';
			break;
	}
	$('#mileage_result_title').text(title_country_str);
	$('#statistic_result_title').text(statistic_country_str);
	get_contents($('#frm-list'),{
		pageObj : $(".paging_"+tab_num),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_"+tab_num).html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
				var usable_date_str = '';

				var mileage_usable_inc = row.mileage_usable_inc.toLocaleString('ko-KR');
				var mileage_usable_dec = row.mileage_usable_dec.toLocaleString('ko-KR');
				var mileage_unusable = row.mileage_unusable.toLocaleString('ko-KR');
				var mileage_balance = row.mileage_balance.toLocaleString('ko-KR');
				switch(row.mileage_usable_date_info){
					case '7d':
						usable_date_str = '7일';
						break;
					case '1m':
						usable_date_str = '1달';
						break;
				}
				
                switch(tab_num){
					case '01':
						strDiv += `
							<tr>
								<td>${row.create_date}</td>
								<td style="text-decoration:underline;">${row.id}</td>
								<td class="text-right">${mileage_usable_inc}</td>
								<td class="text-right">${mileage_balance}</td>
								<td>-</td>
								<td>-</td>
								<td>${row.mileage_type}</td>
								<td>${row.mileage_content}</td>
							</tr>
						`;
						break;
					case '02':
						strDiv += `
							<tr>
								<td>${row.create_date}</td>
								<td style="text-decoration:underline;">${row.id}</td>
								<td class="text-right">${mileage_unusable}</td>
								<td>${row.ordernum}</td>
								<td>배송완료후 ${usable_date_str} 후 사용가능</td>
								<td>${row.mileage_usable_date}</td>
								<td>${row.mileage_content}</td>
							</tr>
						`;
						break;
					case '03':
						strDiv += `
							<tr>
								<td>${row.create_date}</td>
								<td style="text-decoration:underline;">${row.id}</td>
								<td >${row.ordernum}</td>
								<td class="text-right">${mileage_usable_dec}</td>
								<td class="text-right">${mileage_balance}</td>
								<td>${row.mileage_content}</td>
							</tr>
						`;
						break;
				}
                $("#result_table_"+tab_num).append(strDiv);
        });
		},
	},rows,page);
}
function getMileageTabStatistics() {
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/mileage/statistics/get",
		error: function() {
			alert("마일리지 적립금 내역 처리가 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data[0];
				$("#result_statistics_table").html('');

				var sum_inc 	= Number(data.sum_inc).toLocaleString('ko-KR');
				var sum_dec 	= (Number(data.sum_dec)*(-1)).toLocaleString('ko-KR');
				var sum_balance = Number(data.sum_balance).toLocaleString('ko-KR');
				var unusable 	= Number(data.unusable).toLocaleString('ko-KR');
				strDiv = `					
					<TR>
						<TD class="text-right">${sum_inc}</TD>
						<TD class="text-right">${sum_dec}</TD>
						<TD class="text-right">${sum_balance}</TD>
						<TD class="text-right">${unusable}</TD>
					</TR>
				`;
				$("#result_statistics_table").append(strDiv);
			}
		}
	});
}
function excelDownload() {
	var tab_num = $('#tab_num').val();
	
	if ($('#result_table_' + tab_num).find('.default_td').length > 0) {
		alert('다운로드 할 적립금 내역을 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_num) {
			case "01" :
				sheet_name = "가용 적립금";
				file_name = "가용 적립금_" + file_date;
				break;
			
			case "02" :
				sheet_name = "미가용 적립금";
				file_name = "미가용 적립금_" + file_date;
				break;
			
			case "03" :
				sheet_name = "사용된 적립금";
				file_name = "사용된 적립금_" + file_date;
				break;
		}
		insertLog("고객관리 > 적립금 관리 > " + sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_num), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}
function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
</script>
