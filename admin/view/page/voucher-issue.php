<style>
.content__card.order__detail, .content__card.order__detail .card__body{height:100%}
.content__card.order__detail{display:flex;flex-direction:column;}
.content__card.order__detail .card__body{flex: 1;overflow-y:scroll; margin-top:40px;}
.order__detail .table__wrap .overflow-x-auto{white-space: nowrap;}
.move__btn__container{margin-top:10px;display:grid;grid-template-columns: repeat(3, 1fr);}
.btn__item.btn{text-align:center;height:50px;line-height : 34px;}
.order__detail__container{display:block}
.order__detail__item{padding-left:40px;padding-right:40px;}
.content__item{margin-top:50px;}
.content__item table{margin-top:20px;}
.balance__margin__area{height:70px;}
.order__product{width:100%;}
#order_payment_table{width:100%;}
#order_pm_method_table{width:100%;}
#order_order_member_table{width:100%;}
#order_to_member_table{min-width:650px;}
#order_delivery_table{width:100%}
.left-side{display:none;}
</style>

<?php
function getUrlParamter($url, $sch_tag) {
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$voucher_idx = getUrlParamter($page_url, 'voucher_idx');
?>

<div class="content__card order__detail">
	<div class="card__hearder">
		<h3>바우처 발급 정보</h3>
		
		<div class="move__btn__container">
			<div class="btn__item btn" onclick="moveInfoScroll('common')">바우처정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('issue')">발급정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('log')">발급기록</div>
		</div>
	</div>
	
	<div class="card__body" style="margin-top:0px;">
		<div class="order__detail__container">
			<div class="order__detail__item">
				<div class="content__item">
					<h3>바우처 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="voucher_common_table">
								<colgroup>
									<col width="150px;">
									<col width="150px;">
									<col width="200px;">
									<col width="200px;">
									<col width="auto;">
								</colgroup>
								<thead>
									<tr>
										<th>쇼핑몰 국가</th>
										<th>온라인/오프라인</th>
										<th>바우처타입</th>
										<th>바우처코드</th>
										<th>바우처이름</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="country"></td>
										<td id="on_off_type"></td>
										<td id="voucher_type"></td>
										<td id="voucher_code"></td>
										<td id="voucher_name"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="content__item">
					<h3>발급 정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="voucher_issue_table">
								<colgroup>
									<col width="20%;">
									<col width="20%;">
									<col width="10%;">
									<col width="10%;">
									<col width="20%;">
									<col width="20%;">
								</colgroup>
								<thead>
									<tr>
										<th>발급시작일</th>
										<th>발급종료일</th>
										<th>바우처 기간기준</th>
										<th>바우처 기간</th>
										<th>바우처 사용시작일</th>
										<th>바우처 사용종료일</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="issue_start_date" style="text-align:right;"></td>
										<td id="issue_end_date" style="text-align:right;"></td>
										<td id="voucher_date_type" style="text-align:right;"></td>
										<td id="voucher_date_param" style="text-align:right;"></td>
										<td id="voucher_start_date" style="text-align:right;"></td>
										<td id="voucher_end_date" style="text-align:right;"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="content__item">
					<h3>발급 이력</h3>
					<div class="info__wrap " style="justify-content:space-between; align-items: center;margin-top:15px;">
						<div class="body__info--count">
							<div class="drive--left"></div>
							총 발급 수 <font class="cnt_VOU_total info__count" >0</font>개
						</div>
						
						<div class="content__row">
							<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange_VOU(this);">
								<option value="VI.CREATE_DATE|DESC" checked>바우처발급일 역순</option>
								<option value="VI.CREATE_DATE|ASC">바우처발급일 순</option>
								<option value="VI.VOUCHER_ISSUE_CODE|DESC">바우처발급코드 역순</option>
								<option value="VI.VOUCHER_ISSUE_CODE|ASC">바우처발급코드 순</option>
								<option value="VI.VOUCHER_ADD_DATE|DESC">바우처등록일 역순</option>
								<option value="VI.VOUCHER_ADD_DATE|ASC">바우처등록일 순</option>
								<option value="VI.USABLE_START_DATE|DESC">발급기준 사용시작일 역순</option>
								<option value="VI.USABLE_START_DATE|ASC">발급기준 사용시작일 순</option>
								<option value="VI.USABLE_END_DATE|DESC">발급기준 사용종료일 역순</option>
								<option value="VI.USABLE_END_DATE|ASC">발급기준 사용종료일 순</option>
								<option value="VI.MEMBER_ID|DESC">발급회원 역순</option>
								<option value="VI.MEMBER_ID|ASC">발급회원 순</option>
							</select>
							
							<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange_VOU(this);">
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
					
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="voucher_log_table">
								<colgroup>
									<col width="20%;">
									<col width="20%;">
									<col width="20%;">
									<col width="20%;">
									<col width="10%;">
									<col width="10%;">
								</colgroup>
								<thead>
									<tr>
										<th>바우처발급코드</th>
										<th>바우처등록일</th>
										<th>발급기준 사용시작일</th>
										<th>발급기준 사용종료일</th>
										<th>발급회원</th>
										<th>사용여부</th>
									</tr>
								</thead>
								<tbody class="result_body">
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" value="0" onChange="setPaging_VOU(this);">
						<input type="hidden" class="result_cnt" value="0" onChange="setPaging_VOU(this);">
						<div class="paging_VOU"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card_footer"></div>
	
	<form id="frm-VOU" action="modal/voucher/issue/get">
		<input type="hidden" id="param_voucher_idx" name="voucher_idx" value="<?=$voucher_idx?>">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="VI.CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
	</form>
</div>

<script>
$(document).ready(function(){
	getVoucherMstInfo();
	getVoucherIssueInfoList();
})

function moveInfoScroll(str){
	$('.content__card.order__detail .card__body').animate({scrollTop : 0}, 0);
	let clickOffset = $(`#order_${str}_table`).position();
	$('.content__card.order__detail .card__body').animate({scrollTop : clickOffset.top - 240}, 0);
}

$('.category__tab').click(function() {	
	$('.category__tab').not($(this)).css('color','#707070');
	$('.category__tab').not($(this)).css('border-bottom','none');
	
	$(this).css('color','#140f82');
	$(this).css('border-bottom','3px solid #140f82');

	$('.order__product').addClass('hidden');
	$('.order__product.status__' + $(this).attr('order_status')).removeClass('hidden');
});

function getVoucherMstInfo(){
	let voucher_idx = $('#param_voucher_idx').val();
	
	if(voucher_idx != null) {
		$.ajax({
			type: "post",
			url: config.api + "modal/voucher/mst/get",
			data : {
				'voucher_idx' : voucher_idx
			},
			dataType: "json",
			error: function() {
				alert("바우처정보 조회처리에 실패했습니다.");
			},
			success: function(d) {
				if (d.code == 200) {
					let data = d.data;
					
					let voucher_link = "";
					if (data.voucher_idx != null) {
						voucher_link = "javascript:void(window.open('http://116.124.128.246:81/voucher/mst?voucher_idx=" + data.voucher_idx + "','바우처 정보 페이지','width=#,height=#'))";;
					}
					
					$('#country').text(data.country);
					$('#on_off_type').text(data.on_off_type);
					$('#voucher_type').text(data.voucher_type);
					$('#voucher_code').text(data.voucher_code);
					$('#voucher_name').text(data.voucher_name);
					
					$('#voucher_name').css('cursor','pointer');
					$('#voucher_name').css('text-decoration','underline');
					$('#voucher_name').attr('onClick',voucher_link);

					$('#issue_start_date').text(data.issue_start_date);
					$('#issue_end_date').text(data.issue_end_date);
					$('#voucher_date_type').text(data.voucher_date_type);
					$('#voucher_date_param').text(data.voucher_date_param);
					$('#voucher_start_date').text(data.voucher_start_date);
					$('#voucher_end_date').text(data.voucher_end_date);
				}
			}
		});
	}
	else{
		alert('잘못된 경로로 접근했습니다.',function(){
			location.href="list";
		});
	}
}

function getVoucherIssueInfoList(){
	let frm = $('#frm-VOU');
	let result_body = $('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_VOU"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					let member_link = "";
					if (row.country != null && row.member_idx != null) {
						member_link = ' style="text-decoration:underline;cursor:pointer;" onClick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'바우처 발급정보 페이지\',\'width=#, height=#\'))" ';
					}
					
					strDiv += '<TR>';
					strDiv += '    <TD>' + row.voucher_issue_code + '</TD>';
					strDiv += '    <TD>' + row.voucher_add_date + '</TD>';
					strDiv += '    <TD>' + row.usable_start_date + '</TD>';
					strDiv += '    <TD>' + row.usable_end_date + '</TD>';
					strDiv += '    <TD ' + member_link + '>' + row.member_id + '</TD>';
					strDiv += '    <TD>' + row.used_flg + '</TD>';
					strDiv += '</TR>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD colspan="6" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}


function orderChange_VOU(obj) {	
	let frm = $('#frm-VOU');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getVoucherIssueInfoList();
}

function rowsChange_VOU(obj) {
	let frm = $('#frm-VOU');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getVoucherIssueInfoList();
}

function setPaging_VOU(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_VOU_total').text(total_cnt.val());
}
</script>