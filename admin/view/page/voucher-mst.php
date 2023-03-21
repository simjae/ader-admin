<style>
.content__card.order__detail, .content__card.order__detail .card__body{height:100%}
.content__card.order__detail{display:flex;flex-direction:column;}
.content__card.order__detail .card__body{flex: 1;overflow-y:scroll; margin-top:40px;}
.order__detail .table__wrap .overflow-x-auto{white-space: nowrap;}
.move__btn__container{margin-top:10px;display:grid;grid-template-columns: repeat(4, 1fr);}
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

<input type="hidden" id="param_voucher_idx" value="<?=$voucher_idx?>">

<div class="content__card order__detail">
	<div class="card__hearder">
		<h3>바우처 상세 정보</h3>
		
		<div class="move__btn__container">
			<div class="btn__item btn" onclick="moveInfoScroll('common')">바우처정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('issue')">발급정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('price')">금액정보</div>
			<div class="btn__item btn" onclick="moveInfoScroll('detail')">상세정보</div>
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
			</div>
			
			<div class="order__detail__item">
				<div class="content__item">
					<h3>가격 정보</h3>
					
					<div class="table__wrap order__product status__all">
						<div class="overflow-x-auto">
							<table id="voucher_price_table">
								<colgroup>
									<col width="25%;">
									<col width="25%;">
									<col width="50%;">
								</colgroup>
								<thead>
									<tr>
										<th>최소사용금액</th>
										<th>할인유형</th>
										<th>할인금액</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="min_price" style="text-align:right;"></td>
										<td id="sale_type"></td>
										<td id="sale_price" style="text-align:right;"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="order__detail__item">
				<div class="content__item">
					<h3>상세정보</h3>
					<div class="table__wrap">
						<div class="overflow-x-auto">
							<table id="voucher_detail_table">
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
										<th>상세정보</th>
										<td colspan="7" id=""></td>
									</tr>
									<tr>
										<th>발급회원등급</th>
										<td colspan="7" id=""></td>
									</tr>
									<tr>
										<th>적립포인트<br/>사용여부</th>
										<td id="mileage_flg"></td>
										<th>예외상품<br/>적용여부</th>
										<td id="except_product_flg"></td>
										<th>총 발급수량</th>
										<td id="tot_issue_num"></td>
										<th>발급수량</th>
										<td id="issue_cnt"></td>
									</tr>
									<tr>
										<th>작성일</th>
										<td id="create_date"></td>
										<th>작성자</th>
										<td id="creater"></td>
										<th>수정일</th>
										<td id="update_date"></td>
										<th>수정자</th>
										<td id="updater"></td>
									</tr>
								<tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card_footer"></div>
</div>

<script>
$(document).ready(function(){
	getVoucherMstInfo();
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
					$('#country').text(data.country);
					$('#on_off_type').text(data.on_off_type);
					$('#voucher_type').text(data.voucher_type);
					$('#voucher_code').text(data.voucher_code);
					$('#voucher_name').text(data.voucher_name);

					$('#issue_start_date').text(data.issue_start_date);
					$('#issue_end_date').text(data.issue_end_date);
					$('#voucher_date_type').text(data.voucher_date_type);
					$('#voucher_date_param').text(data.voucher_date_param);
					$('#voucher_start_date').text(data.voucher_start_date);
					$('#voucher_end_date').text(data.voucher_end_date);

					$('#min_price').text(data.min_price);
					$('#sale_type').text(data.sale_type);
					$('#sale_price').text(data.sale_price);

					$('#mileage_flg').text(data.mileage_flg);
					$('#except_product_flg').text(data.except_product_flg);
					$('#tot_issue_num').text(data.tot_issue_num);
					
					let issue_link = "";
					if (data.issue_cnt > 0) {
						issue_link = ' javascript:void(window.open(\'http://116.124.128.246:81/voucher/issue?voucher_idx=' + data.voucher_idx + '\', \'바우처 발급정보 페이지\',\'width=#, height=#\')) ';
						$('#issue_cnt').css('cursor','popinter');
						$('#issue_cnt').css('text-decoration','underline;');
						$('#issue_cnt').attr('onClick',issue_link);
					}
					
					$('#issue_cnt').text(data.issue_cnt);
					

					$('#create_date').text(data.create_date);
					$('#creater').text(data.creater);
					$('#update_date').text(data.update_date);
					$('#updater').text(data.updater);
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

</script>