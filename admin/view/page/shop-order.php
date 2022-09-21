<h1>주문 상황</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>쇼핑몰</li>
		<li>주문</li>
	</ul>
</div>


<div class="row">
	<div class="row">
		<div class="col-4">
			<div class="dashboard-stat">
				<h1>결제대기</h1>
				<div class="details">
					<i class="xi-users bg-green"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-1">0</div>
				</div>
			</div>
		</div>

		<div class="col-4">
			<div class="dashboard-stat">
				<h1>결제완료</h1>
				<div class="details">
					<i class="xi-desktop bg-red"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-2">0</div>
				</div>
			</div>
		</div>

		<div class="col-4">
			<div class="dashboard-stat">
				<h1>배송준비중</h1>
				<div class="details">
					<i class="xi-eye bg-purple"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-3">0</div>
				</div>
			</div>
		</div>

		<div class="col-4">
			<div class="dashboard-stat">
				<h1>배송중</h1>
				<div class="details">
					<i class="xi-eye-o bg-blue"></i>
					<div class="unit">건</div>
					<div class="number count-number" data-speed="1000" id="count-number-4">0</div>
				</div>
			</div>
		</div>
	</div>

	<div class="portlet">
		<div class="title">
			<h1>
				주문 목록
				<div class="tools">
					<a href="javascript:;"  onclick="list_export('xls',$('#frm_list'));" class="btn has-tooltip">전체 내역<span class="tooltip top">주문 내역 전체 다운로드</span></a>
					<a href="javascript:;"  onclick="list_export('xls',$('#frm_list'));" class="btn has-tooltip">주문 완료 내역<span class="tooltip top">배송 준비 내역 다운로드</span></a>
					<a href="javascript:;"  onclick="excel_upload()" class="btn has-tooltip">국내배송 송장 입력<span class="tooltip top">CJ대한통운 송장 출력 내역 Upload</span></a>
					<a href="javascript:;"  onclick="excel_upload()" class="btn has-tooltip">해외배송 송장 입력<span class="tooltip top">DHL 송장 출력 내역 Upload</span></a>
				</div>
			</h1>
		</div>
		<div class="body">
			<div class="row">
				<form id="frm-list" action="shop/order/get">
					<table class="list">
						<thead>
							<tr>
								<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
								<th width="160px">주문 번호</th>
								<th width="80px">지역</th>
								<th>주문 상품</th>
								<th width="140px">주문 금액</th>
								<th width="180px" class="sort" data-query="name">주문자</th>
								<th width="180px" class="sort" data-query="order_date">주문 일자</th>
								<th width="140px" class="sort" data-query="tel">연락처</th>
								<th width="120px">결제 수단</th>
								<th width="90px">진행 상황</th>
								<th width="100px">작업</th>
							</tr>
							<tr>
								<th></th>
								<th><input type="text" name="ordernum" class="text-right"></th>
								<th>
									<select name="localize">
										<option value="">- 전체 -</option>
										<option value="국내">국내</option>
										<option value="해외">해외</option>
									</select>
								</th>
								<th><input type="text" name="goods"></th>
								<th><input type="text" placeholder="From" class="margin-bottom-6" name="price_s"><input type="text" placeholder="To" name="price_e"></th>
								<th><input type="text" name="name" class="margin-bottom-6" placeholder="이름"><input type="text" name="id" placeholder="아이디"></th>
								<th><input type="date" name="orderdate_from" class="margin-bottom-6" placeholder="From" readonly><input type="date" name="orderdate_to" placeholder="To" readonly></th>
								<th><input type="text" name="tel"></th>
								<th>
									<select name="paymethod">
										<option value="">- 전체 -</option>
										<option value="bank">무통장입금</option>
										<option value="vbank">가상계좌</option>
										<option value="card">신용카드</option>
										<option value="mobile">휴대폰결제</option>
										<option value="paypal">페이팔</option>
										<option value="payletter">페이레터</option>
									</select>
								</th>
								<th>
									<select name="status">
										<option value="">- 전체 -</option>
										<option value="주문완료">주문완료</option>
										<option value="결제대기">결제대기</option>
										<option value="결제확인">결제확인</option>
										<option value="배송준비">배송준비</option>
										<option value="배송중">배송중</option>
										<option value="배송완료">배송완료</option>
										<option value="거래완료">거래완료</option>
										<option value="환불요청">환불요청</option>
										<option value="환불처리중">환불처리중</option>
										<option value="환불완료">환불완료</option>
										<option value="거래취소">거래취소</option>
									</select>
								</th>
								<th>
									<a href="javascript:;" class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a><br>
									<a href="javascript:;" class="btn" onclick="list_search(false);"><i class="xi-close"></i> 취소</a>
								</th>
							</tr>
						</thead>
						<tbody id="list">
							<tr>
								<td colspan="11" class="nodata"><i class="xi-slash-circle"></i>검색된 주문이 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="text-right paging" id="paging"></div>
		</div>
	</div>
</div>

<script>
function excel_upload() {
	$("body").append('<form id="--file-upload"><input type="hidden" name="m" value="delivery-xls"><input type="file" name="file"></form>');
	$("#--file-upload > input").on("change",function() {
		$.ajax({
			type: "post",
			url: config.api + "shop/order/",
			data: new FormData($(this).parent().get(0)),
			type: "post",  
			processData:false,
			contentType:false,
			dataType: "json",
			error: function() {
				alert("엑셀로 송장 정보를 추가하는데 실패하였습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("송장 정보가 업로드 되었습니다.");
					list();
				}
				else {
					alert(d.msg);
				}
			},
			complete: function() {
				$("body > #--file-upload").remove();
			}
		});
	});
	$("#--file-upload > input").click();
}

$(document).ready(function() {
	$.ajax({
		url: config.api + "shop/order/dashboard",
		success: function(d) {
			if(d.code==200) {
				$("#count-number-1").data("to",d.pay.ready.count);
				$("#count-number-2").data("to",d.pay.paid.count);
				$("#count-number-3").data("to",d.delivery.ready.count);
				$("#count-number-4").data("to",d.delivery.ing.count);

				apply_counter();
			}
		}
	});


	get_contents($("#frm-list"),{
		empty : `<tr><td colspan="11" class="nodata"><i class="xi-slash-circle"></i>검색된 상품이 없습니다.</td></tr>`,
		html : function(d) {
			let payment_method_btn = {
				"bank" : "red",
				"card" : "green",
				"vbank" : "purple",
				"mobile" : "blue",
				"paypal" : "yellow",
				"payletter" : "green"
			},
			status_btn = {
				"주문완료" : "green",
				"결제대기" : "blue",
				"결제확인" : "blue",
				"배송준비" : "purple",
				"배송중" : "purple",
				"배송완료" : "green",
				"거래완료" : "green",
				"환불요청" : "green",
				"환불처리중" : "green",
				"환불완료" : "green",
				"거래취소" : "green"
			},
			status_class = {
				"주문완료" : "ready",
				"결제대기" : "ready",
				"결제확인" : "paid",
				"배송준비" : "delivery",
				"배송중" : "delivering",
				"배송완료" : "delivered",
				"거래완료" : "complete",
				"환불요청" : "refund",
				"환불처리중" : "refunding",
				"환불완료" : "refunded",
				"거래취소" : "cancel"
			},
			deliveryarea_btn = {
				"국내" : "blue",
				"해외" : "red"
			};

			
			$("#frm-list tbody").empty();
			d.forEach(function(row) {
				$("#frm-list tbody").append(`
					<tr data-no="${row.no}" class="${status_class[row.status]}">
						<td><input type="checkbox" name="no" value="${row.no}"><i></i></td>
						<td>${row.order_number}</td>
						<td><a class="btn ${deliveryarea_btn[row.delivery.area]}">${row.delivery.area}</a></td>
						<td class="click">${row.title}</td>
						<td>${row.currency}<br>${number_format(row.payment)}</td>
						<td>${row.name}<br>${row.id}</td>
						<td>${row.order_date}</td>
						<td>${row.to.tel}</td>
						<td><a class="btn ${payment_method_btn[row.payment_method]}">${row.payment_method_str}</td>
						<td><a class="btn status">${row.status}</a></td>
						<td>
							<a class="btn blue margin-bottom-6"><i class="xi-eye-o"></i> 상세</a>
							<a class="btn red"><i class="xi-trash-o"></i> 삭제</a>
						</td>
					</tr>
				`);
			});
			$("#frm-list tbody > tr > td:not(.no-click)").click(function() {
				modal('put',{ id : $(this).parent().data("id") });
			});
			$("#frm-list a.btn.red").click(function() {
				confirm("해당 주문을 삭제할까요?",function() {
				});
			});
		},
	});
});
</script>
