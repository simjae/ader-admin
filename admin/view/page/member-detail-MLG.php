<div id="member_detail_MLG">
	<div class="content__card">
		<div class="card__header">
			<h3 id="mileage_info_title">적립금 정보</h3>
			<div class="drive--x"></div>
		</div>

		<div class="card__body">
			<div class="table__wrap">
				<?php
					$select_mileage_info_sql = "
						SELECT
							(
								SELECT
									S_MI.MILEAGE_BALANCE
								FROM
									MILEAGE_INFO S_MI
								WHERE
									S_MI.MEMBER_IDX = ".$member_idx."
								ORDER BY
									S_MI.IDX DESC
								LIMIT
									0,1
							)		AS MILEAGE_BALANCE,
							(
								SELECT
									SUM(S_MI.MILEAGE_UNUSABLE)
								FROM
									MILEAGE_INFO S_MI
								WHERE
									S_MI.MEMBER_IDX = ".$member_idx." AND
									S_MI.MILEAGE_USABLE_DATE <= NOW()
							)		AS MILEAGE_UNUSABLE,
							(
								SELECT
									SUM(S_MI.MILEAGE_USABLE_INC)
								FROM
									MILEAGE_INFO S_MI
								WHERE
									S_MI.MEMBER_IDX = ".$member_idx."
							)		AS MILEAGE_USABLE_INC,
							(
								SELECT
									SUM(S_MI.MILEAGE_USABLE_DEC)
								FROM
									MILEAGE_INFO S_MI
								WHERE
									S_MI.MEMBER_IDX = ".$member_idx."
							)		AS MILEAGE_USABLE_DEC
						FROM
							DUAL
					";
					
					$db->query($select_mileage_info_sql);
					
					$mileage_info = array();
					foreach($db->fetch() as $mileage_data) {
						$mileage_info = array(
							'mileage_balance'		=>number_format($mileage_data['MILEAGE_BALANCE']),
							'mileage_unusable'		=>number_format($mileage_data['MILEAGE_UNUSABLE']),
							'mileage_usable_inc'	=>number_format($mileage_data['MILEAGE_USABLE_INC']),
							'mileage_usable_dec'	=>number_format($mileage_data['MILEAGE_USABLE_DEC'])
						);
					}
				?>
				<table>
					<colgroup>
						<col width="10%;">
						<col width="15%;">
						<col width="10%;">
						<col width="15%;">
						<col width="10%;">
						<col width="15%;">
						<col width="10%;">
						<col width="15%;">
					</colgroup>
					<tbody>
						<tr>
							<TH>보유 적립금</TH>
							<td style="text-align:right;"><?=$mileage_info['mileage_balance']?></td>
							<TH>미가용 적립금</TH>
							<td style="text-align:right;"><?=$mileage_info['mileage_unusable']?></td>
							<TH>누적 사용금액</TH>
							<td style="text-align:right;"><?=$mileage_info['mileage_usable_inc']?></td>
							<TH>누적 적립금액</TH>
							<td style="text-align:right;"><?=$mileage_info['mileage_usable_dec']?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="content__card">
		<div class="card__header">
			<h3>적립내역</h3>
			<div class="drive--x"></div>
		</div>

		<div class="card__body">
			<form id="frm-MLG" action="modal/mileage/get">
				<input type="hidden" name="country" value="<?=$country?>">
				<input type="hidden" name="member_idx" value="<?=$member_idx?>">
				
				<input type="hidden" class="sort_type" name="sort_type" value="ASC">
				<input type="hidden" class="sort_value" name="sort_value" value="IDX">
				
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">

				<div class="card__body">
					<div class="content__wrap">
						<div class="content__title">적립금 타입</div>
						<div class="content__row">
							<select class="fSelect" name="mileage_type" style="width:163px">
								<option value="ALL" selected>전체</option>
								<option value="UNU">미가용</option>
								<option value="INC">증가</option>
								<option value="DEC">감소</option>
							</select>
						</div>
					</div>
					
					<div class="content__wrap ">
						<div class="content__title">주문검색</div>
						<div class="content__row search_keyword_td" style="display:block;">
							<div class="row">
								<select class="fSelect search_keyword" name="search_keyword" style="width:163px;">
									<option value="ALL">검색 키워드 선택</option>
									<option value="ORDER_CODE">주문번호</option>
									<option value="ORDER_PRODUCT_CODE">주문 상품 번호</option>
								</select>
								
								<input type="text" name="keyword_param" value="" style="width:40%;">
							</div>
						</div>
					</div>

					<div class="content__wrap">
						<div class="content__title">사용기간</div>
						<div class="content__row">
							<div class="content__date__wrap">
								<div class="content__date__picker">
									<input id="date_from_MLG" class="date_param_MLG" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									<font>~</font>
									<input id="date_to_MLG" class="date_param_MLG" type="date" name="date_to" placeholder="To" readonly style="width:150px;">
								</div>
							</div>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">적립금액</div>
						<div class="content__row">
							<input type="number" name="min_mileage" value="0" style="width:100px;">
							~
							<input type="number" name="max_mileage" value="0" style="width:100px;">
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div></div>
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onClick="getModalMileageInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter-MLG', 'getModalMileageInfo')">
						<span>초기화</span></div>
				</div>
			</div>
		</div>
		
		<div class="card__header">
			<h3>적립금 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<form id="frm-list-MLG">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 <font class="cnt_MLG_total info__count">0</font>건/검색결과 <font class="cnt_MLG_result info__count">0</font>건
					</div>
						
					<div class="content__row">
						<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange_MLG(this);">
							<option value="IDX|ASC" selected>적립일 순</option>
							<option value="IDX|DESC">적립일 역순</option>
						</select>
						
						<select name="rows" style="width:163px;float:right;" onChange="rowsChange_MLG(this);">
							<option value="10" selected>10개씩보기</option>
							<option value="20">20개씩보기</option>
							<option value="30">30개씩보기</option>
							<option value="50">50개씩보기</option>
							<option value="100">100개씩보기</option>
						</select>
					</div>
				</div>
				
				<div class="table__wrap" style="margin-top:30px;">
					<div class="overflow-x-auto">
						<table style="min-width:100%;">
							<colgroup>
								<col width="120px;">
								<col width="100px;">
								
								<col width="100px;">
								<col width="100px;">
								<col width="100px;">
								<col width="120px;">
								
								<col width="150px;">
								<col width="150px;">
								
								<col width="150px;">
							</colgroup>
							<thead>
								<tr>
									<TH rowspan="2">적립/사용 일</TH>
									<TH rowspan="2">미가용적립금</TH>
									
									<TH colspan="3">가용적립금</TH>
									<TH rowspan="2">적립예정일</TH>
									
									<TH rowspan="2">주문번호</TH>
									<TH rowspan="2">주문상품번호</TH>
									<TH rowspan="2">적립유형</TH>
								</tr>
								<tr>
									<TH>증가</TH>
									<TH>차감</TH>
									<TH>잔액</TH>
								</tr>
							</thead>
							<tbody class="result_body">
								
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging_MLG(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging_MLG(this);">
					<div class="paging_MLG"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function () {
	getModalMileageInfo();
});

function getModalMileageInfo() {
	let frm = $('#frm-MLG');
	let result_body = $('#member_detail_MLG').find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_MLG"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					let order_link = "";
					if (row.order_code != "-") {
						order_link = '  style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/order/detail?order_code=' + row.order_code + '\', \'주문상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					strDiv += '<tr>';
					strDiv += '    <td>' + row.create_date + '</td>';
					strDiv += '    <td style="text-align:right;">' + row.mileage_unusable + '</td>';
					
					strDiv += '    <td style="text-align:right;">' + row.mileage_usable_inc + '</td>';
					strDiv += '    <td style="text-align:right;">' + row.mileage_usable_dec + '</td>';
					strDiv += '    <td style="text-align:right;">' + row.mileage_balance + '</td>';
					strDiv += '    <td style="text-align:right;">' + row.mileage_usable_date + '</td>';
					
					strDiv += '    <TD ' + order_link + '>' + row.order_code + '</TD>';
					strDiv += '    <td>' + row.order_product_code + '</td>';
					strDiv += '    <td>' + row.mileage_type + '</td>';
					strDiv += '</tr>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD colspan="9" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}

function orderChange_MLG(obj) {	
	let frm = $('#frm-MLG');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getModalMileageInfo();
}

function rowsChange_MLG(obj) {
	let frm = $('#frm-MLG');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getModalMileageInfo();
}

function setPaging_MLG(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_MLG_total').text(total_cnt.val());
	$('.cnt_MLG_result').text(result_cnt.val());
}
</script>