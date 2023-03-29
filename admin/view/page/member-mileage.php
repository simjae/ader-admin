<style>
.info__wrap{margin-bottom: 20px;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<div class="card__header">
		<h3>전체 적립금 내역 통계</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table table__wrap">
			<table>
				<colgroup>
					<col width="10%;">
					<col width="22.5%;">
					<col width="22.5%;">
					<col width="22.5%;">
					<col width="22.5%;">
				</colgroup>
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
					$select_sum_mileage_sql = "
						SELECT
							TMP.COUNTRY		AS COUNTRY,
							IFNULL(
								SUM(MI.MILEAGE_USABLE_INC),0
							)				AS SUM_USABLE_INC,
							IFNULL(
								SUM(MI.MILEAGE_USABLE_DEC),0
							)				AS SUM_USABLE_DEC,
							IFNULL(
								SUM(MI.MILEAGE_USABLE_INC)
								-
								SUM(MI.MILEAGE_USABLE_DEC)
								,0
							)				AS SUM_USABLE_TOTAL,
							IFNULL(
								SUM(MI.MILEAGE_UNUSABLE),0
							)				AS SUM_UNUSABLE
						FROM 
							(
								SELECT
									'KR'	AS COUNTRY
								UNION
								SELECT
									'EN'	AS COUNTRY
								UNION
								SELECT
									'CN'	AS COUNTRY
							) TMP
							LEFT JOIN MILEAGE_INFO MI ON
							TMP.COUNTRY = MI.COUNTRY
						GROUP BY 
							TMP.COUNTRY
						ORDER BY
							TMP.COUNTRY DESC
					";
					
					$db->query($select_sum_mileage_sql);
					
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
						<TD style="text-align:center;"><?=$country_str?></TD>
						<TD class="text-right"><?=number_format($data['SUM_USABLE_INC'])?></TD>
						<TD class="text-right"><?=number_format($data['SUM_USABLE_DEC'])==0?'0':'-'.number_format($data['SUM_USABLE_DEC'])?></TD>
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
		<input type="hidden" id="tab_status" name="tab_status" value="USB">
		
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
					<select name="country" class="fSelect" style="width:180px;">
						<option value="KR">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">등급</div>
				<div class="content__row">
					<select name="member_level" class="fSelect" style="width:180px;">
						<option value="">전체</option>
<?php
		$sql = "
					SELECT
						IDX,
						TITLE
					FROM
						MEMBER_LEVEL
		";
		$db->query($sql);
		foreach($db->fetch() as $data){

		
?>	
						<option value="<?=$data['IDX']?>"><?=$data['TITLE']?></option>
<?php
		}
?>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">아이디</div>
				<div class="content__row">
					<input type="text" value="" name="id" style="width:180px;">
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
							<div class="search_date_reserve date__picker" date_type="reserve" date="ALL" type="button"  onclick="searchDateClick(this);">전체</div>
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
				<div class="category__tab" tab_status="USB" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">가용 적립금</div>
				<div class="category__tab" tab_status="UNU" style="height:30px;color:#707070;text-align:center;cursor:pointer;">미가용 적립금</div>
				<div class="category__tab" tab_status="USD" style="height:30px;color:#707070;text-align:center;cursor:pointer;">사용 적립금</div>
			</div>
			<div class="btn" onclick="open_excel_modal();">적립금 일괄적용</div>
		</div>
		
		<div class="table table__wrap mileage_tab tab_status_USB">
			<?php include_once("member-mileage-usable.php"); ?>
		</div>
		
		<div class="table table__wrap mileage_tab tab_status_UNU" style="display:none;">
			<?php include_once("member-mileage-unusable.php"); ?>
		</div>
		
		<div class="table table__wrap mileage_tab tab_status_USD" style="display:none;">	
			<?php include_once("member-mileage-used.php"); ?>	
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('.category__tab').click(function() {		
		var tab_status = $(this).attr('tab_status');
		
		if (tab_status != null) {
			$('#tab_status').val(tab_status);
			
			$('.mileage_tab').hide();
			$('.tab_status_' + tab_status).show();
			$('.tab_status_' + tab_status).find(".mileage_type option:eq(0)").prop("selected",true);
			$('.tab_status_' + tab_status).find(".rows option:eq(0)").prop("selected",true);
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
	var tab_status = $('#tab_status').val();
	
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();
	
	console.log(total_cnt);
	console.log(result_cnt);
	$('.tab_status_' + tab_status).find('.cnt_total').text(total_cnt);
	$('.tab_status_' + tab_status).find('.cnt_result').text(result_cnt);
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
	var tab_status = $('#tab_status').val();
	let result_table = $("#result_table_" + tab_status);
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<td class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</td>';
	
	$("#result_table_" + tab_status).append(strDiv);

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
		pageObj : $(".paging_" + tab_status),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					$("#result_table_" + tab_status).html('');
				}
				d.forEach(function(row) {
					let detail_link = "";
					if (row.country != null && row.member_idx != null) {
						detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					let detail_mileage_link = "";
					if (row.country != null && row.member_idx != null) {
						detail_mileage_link = ' style="text-align:right;text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '&detail_status=MLG\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					let order_link = "";
					if (row.country != null && row.member_idx != null) {
						order_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))" ';
					}
					
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
					
					switch(tab_status){
						case 'USB':
							strDiv += `
								<tr>
									<td>${row.create_date}</td>
									<td ${detail_link}>${row.id}</td>
									<td ${detail_mileage_link}>${mileage_usable_inc}</td>
									<td ${detail_mileage_link}>${mileage_balance}</td>
									<td>${row.manager!=null?row.manager:'-'}</td>
									<td>${row.order_code}</td>
									<td>${row.order_product_code}</td>
									<td>${row.mileage_type}</td>
									<td>${row.mileage_content}</td>
								</tr>
							`;
							break;
						
						case 'UNU':
							strDiv += `
								<tr>
									<td>${row.create_date}</td>
									<td ${detail_link}>${row.id}</td>
									<td class="text-right;" ${detail_mileage_link}>${mileage_unusable}</td>
									<td>배송완료후 ${usable_date_str} 후 사용가능</td>
									<td>${row.mileage_usable_date}</td>
									<td ${order_link}>${row.order_code}</td>
									<td ${order_link}>${row.order_product_code}</td>
									<td>${row.mileage_type}</td>
									<td>${row.mileage_content}</td>
								</tr>
							`;
							break;
						
						case 'USD':
							strDiv += `
								<tr>
									<td>${row.create_date}</td>
									<td ${detail_link}>${row.id}</td>
									<td class="text-right" ${detail_mileage_link}>${mileage_usable_dec}</td>
									<td class="text-right" ${detail_mileage_link}>${mileage_balance}</td>
									<td>${row.manager!=null?row.manager:'-'}</td>
									<td ${order_link}>${row.order_code}</td>
									<td ${order_link}>${row.order_product_code}</td>
									<td>${row.mileage_type}</td>
									<td>${row.mileage_content}</td>
								</tr>
							`;
							break;
					}
					
					result_table.append(strDiv);
				});
			}
			
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
			alert("적립금 내역 처리가 실패했습니다.");
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
	var tab_status = $('#tab_status').val();
	let result_table = $('#result_table_' + tab_status);
	
	if (result_table.find('.default_td').length > 0) {
		alert('다운로드 할 적립금 내역을 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		switch (tab_status) {
			case "USB" :
				sheet_name = "가용 적립금";
				file_name = "가용 적립금_" + file_date;
				break;
			
			case "UNU" :
				sheet_name = "미가용 적립금";
				file_name = "미가용 적립금_" + file_date;
				break;
			
			case "USD" :
				sheet_name = "사용된 적립금";
				file_name = "사용된 적립금_" + file_date;
				break;
		}
		
		insertLog("고객관리 > 적립금 관리 > " + sheet_name, "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table_' + tab_status), {sheet:sheet_name,raw:true});
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
function open_excel_modal(){
	let country = $('select[name=country]').val();
	modal('regist',`country=${country}`);
}
</script>
