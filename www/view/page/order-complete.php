<style>
    	:root {
		--order-header--height: 150px;
		--header--content--gap: 50px;

		--solid-bk: #808080;
	}

	input {
		padding: 0;
		box-sizing: border-box;
	}

	ul,
	li {
		padding: 0;
		margin: 0;
	}

	input:focus {
		border: 0;
	}
	.content input:focus{
		caret-color: #343434;
		outline: 0;
	}
	body {
		font-family: var(--ft-no-fu);
		/* background-color: #222; */
		/* color: #ffffff; */
		color: var(--bk);
	}

	.hidden {
		display: none !important;
	}

	.tui-select-box-highlight {
		background: #f8f8f8 !important;
	}

	.tui-select-box-placeholder {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		letter-spacing: normal;
		color: #dcdcdc;
	}
	.tui-select-box-input:focus{
		outline: 0px;
	}
	.tui-select-box-input {
		border: 1px solid #808080;
	}
	#addrDirectBox {
		border-top: 0px;
		padding: 10px;
		height: 90px;
		outline: none;
		resize: none;
		border-bottom: 1px solid #808080;
		border-left: 1px solid #808080;
		border-right: 1px solid #808080;
	}
	.tui-select-box-item {
		color: var(--bk);
		font-family: var(--ft-no-fu);
		font-size: 11px;
		padding: 0 10px;
		border-bottom: 1px solid #eeeeee;
	}

	.order-section {
		display: grid;
		grid-template-columns: repeat(16, 1fr);
		margin-bottom: 200px;
	}

	.cn-box p {
		margin: 0;
	}
	.body-wrap {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
        
	}
	.content {
		display: block;
		position: sticky;
		align-self: start;
		grid-column: 7/11;
		top: 50px;
	}

	/* 주문상품내역 */
	.order-product .hd-title{
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.order-product .header-wrap {
		position: sticky;
	}

	.order-product .header-list {
		position: sticky;
		display: grid;
		grid-template-columns: 3fr 1fr 1fr 1fr;
		padding-bottom: 20px;
	}

	.order-product .header-col {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.product .product-info .info-row .name {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.product .color-title{
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: 500;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.product .list-row {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.product .size__box li {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: 500;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.order-product .product-wrap {
		max-height: 410px;
		overflow-y: auto;
	}

	.order-product .body-list {
		display: grid;
		grid-template-columns: 3fr 1fr 1fr 1fr;
		width: 100%;
		max-height: 96px;
		border-bottom: 1px solid #dcdcdc;
		padding-bottom: 10px;
		margin-bottom: 10px;
	}

	.order-product .product-info {
		display: flex;
		padding: 0px;
		gap: 10px;
	}
	.order-product .product-info .info-row[data-refund="true"]::after{
		content: "교환 반품 불가";
		font-family: var(--ft-no-fu);
		font-size: 10px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.7;
		letter-spacing: normal;
		text-decoration: underline;
		text-align: left;
		color: #808080;
	}

	.order-product .product-info .info-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
		justify-content: flex-start;
	}

	.order-product .product-info .info-row {
		gap: 3px;
		justify-content: flex-start;
	}
	.order-product .product-info .info-row.mobile-saleprice {
		display: none;
	}
	.order-product .web-saleprice {
			display: block;
	}
	.order-product .prd-img {
		/* max-width: 3.65vw; */
		max-width: 70px;
    	max-height: 86px;
	}
	.order-product .product-toggle-btn {
		display: none;
	}
	.calculation-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
		padding: 30px 0;
		border-bottom: 1px solid #dcdcdc;
	}

	.calculation-box .point-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.calculation-row {
		display: flex;
		justify-content: space-between;
	}
	.total-price {
		text-decoration: underline;
	}
	.total-price-wrap {
		display: flex;
		justify-content: space-between;
		padding-top: 30px;
	}
	.content input {
		border: 1px solid #808080;
	}


	.wrapper {
		width: 100%;
	}

	.wrapper[data-group="1"] {
		border-bottom: 1px solid #dcdcdc;
		padding-bottom: 10px;
		margin-bottom: 40px;
		display: none;
	}

	.wrapper[data-group="1"].next {
		display: block;
	}

	.wrapper[data-group="1"] .header-wrap {
		border: 0px;
	}

	.wrapper[data-group="1"] .point-row {
		padding-bottom: 10px;
	}

	.wrapper[data-group="1"] .get-point {
		padding-bottom: 10px;
	}

	.header-wrap {
		display: flex;
		justify-content: space-between;
		margin-bottom: 10px;
		align-items: center;
	}

	.header-box-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 10px;
	}

	.header-box {
		padding-bottom: 10px;
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.header-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 24px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;

	}

	.banner-wrap {
		display: grid;
		grid-template-columns: repeat(16, 1fr);
		width: 100%;
		height:200px;
		background-color: #ffffff;
	}

	.banner-wrap .banner-box {
		display: flex;
        justify-content: center;
		align-items: center;
		grid-column: 7/11;
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;

	}

	.cn-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.check-row {
		display: flex;
		gap: 10px;
		margin-bottom: 10px;
		justify-content: space-between;
	}

	.check-row input[type="checkbox"] {
		width: 10px;
		height: 10px;
		cursor: pointer;
	}
	.calculation-wrap {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	/* 바우처 */
	.voucher-info {
		margin-bottom: 40px;
	}

	.voucher-info-list {
		display: flex;
		gap: 10px;
		flex-direction: column;
		padding: 10px 14px;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.64;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	/* 포인트 */
	.point-row {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
	}

	.point-row input {
		grid-column: 1/4;
	}

	.point-row .point-btn {
		cursor: pointer;
		grid-column: 4/5;
	}

	.point-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 40px;
		border-radius: 1px;
		background-color: #dcdcdc;
	}

	.reserves-info-list {
		display: flex;
		gap: 10px;
		flex-direction: column;
		padding: 10px 14px;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.36;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	.charge-info .body-wrap{
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.charge-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		width: 99%;
		max-width: 100%;
		height: 40px;
		margin-bottom: 10px;
		border-radius: 1px;
		border: solid 1px #dcdcdc;
		font-family: var(--ft-no-fu);
		font-size: 12px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	/* 주문자정보 */
	.wrapper.order-info {
		margin-bottom: 70px;
	}

	/* 배송지정보 */
	.address-info {
		padding-bottom: 10px;
        margin-bottom: 20px;
        border-bottom: solid 1px #dcdcdc;
	}
	

	

	.address-info .header-box-btn {
		padding-bottom: 10px;
	}

	.address-info .message-box {
		display: flex;
		flex-direction: row;
		gap: 5px;
	}

	.address-info .cn-box {
		padding-bottom: 20px;
	}
	.address-info .confirm-text.check::after {
		content: attr(data-content);
		font-family: var(--ft-no-fu);
		font-size: 11px;

		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: right;
		position: absolute;
		right: 0;
		bottom: 40px;
		color: #ff0000;
		text-decoration: underline;
	}

	.edit-box .input-row {
		display: flex;
		flex-direction: column;
		gap: 10px;
		margin-bottom: 10px;
		position: relative;
	}

	.edit-box .input-row.addr-search {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
		align-items: end;
	}

	.edit-box .input-row.addr-search .input-text {
		grid-column: 1/4;
		display: flex;
		flex-direction: column;
		gap: 10px;
		margin-bottom: 0px;
	}

	.edit-box .input-row.addr-search .input-text input {
		height: 40px;
	}

	.addr-search-btn {
		cursor: pointer;
		grid-column: 4/5;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 40px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.keyword_label {
		display: none;
	}

	.search_button {
		grid-column: 4/5;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 40px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.edit-box .input-row input {
		height: 40px;
		padding-left: 10px;
		border-radius: 1px;
		border: solid 1px #808080;
		vertical-align: middle;
	}

	.edit-box .check-row {
		display: flex;
		gap: 10px;
		margin-bottom: 10px;
		justify-content: space-between;
	}

	.save-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 24px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.to-place {
		margin-bottom: 20px;
	}

	.check-text {
		display: flex;
		gap: 10px;
		align-items: center;
	}

	.directBox {
		display: none;
		width: 100%;
	}


	/* 약관동의 */

	.terms-info-list {
		display: flex;
		gap: 10px;
		flex-direction: column;
		padding: 10px 14px;
	}
	.terms-service {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.64;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}
	/* 스탭 버튼 */


	.step-btn-wrap {
		display: flex;
		justify-content: space-between;
		gap: 10px;
	}

	.step-btn {
		cursor: pointer;
		height: 40px;
		width: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		font-family: var(--ft-no-fu);
		font-size: 12px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;

	}

	.step-btn.pre {
		background-color: var(--wh);
		color: var(--bk);
		border: solid 1px var(--solid-bk);
	}

	.step-btn.next {
		background-color: var(--bk-dark);
		color: var(--wh);
		border: solid 1px var(--bk-dark);
	}


	#postcodify {
		margin: 0;
		max-height: 400px;
    	overflow: auto;
	}
	#postcodify .keyword{
		grid-column: 1/4;
	}
	#postcodify .search_button{
		grid-column: 4/5;
	}
	.post-change-result{
		width: 74.5%;
		margin: 0!important;
		background-color: #fff;
		overflow: auto;
		max-height: 300px;
		border: 1px solid #808080;
		border-top: 0px;
		top: -32px;
	}
	.postcodify_search_controls {
		display: grid;
		gap: 10px;
		grid-template-columns: repeat(4, 1fr);	
	}
	.postcodify_search_result .code5 {
		color: var(--bk);
	}
	.postcodify_search_result .addr-row{
		color: #dcdcdc;
	}
	.postcodify_search_result .old_addr-row{
		color: #dcdcdc;
	}
	
</style>
<main data-basketStr="<?=$basket_idx?>" data-country="<?=$country?>">
	<div class="banner-wrap">
		<div class="banner-box">
			<span>주문이 완료되었습니다.</span>
		</div>
	</div>
	<section class="order-section">
		<div class="content">
			<div class="wrapper number-info">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문번호</span>
						<span>123134234</span>
					</div>
				</div>
			</div>
			<div class="wrapper address-info" data-group="3">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">배송지정보</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="save-box">
						<div class="to-place">회사</div>
						<div class="cn-box">
							<p class="to-name">심재형</p>
							<p class="to-phone">010-7791-6041</p>
							<p class="to-zipcode">04478</p>
							<p class="to-addr">서울특별시 송파구 문정동 10-5</p>
							<p class="to-detail">로뎀하우스 , 1층</p>
						</div>
						<div class="message-box">
							<span class="hd-title">배송메시지</span>
							<span class="message-content">문앞에두고가세요</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper option-info" data-group="3">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">결제수단</span>
					</div>
					<div class="header-under">
						<span style="text-decoration: underline;">영수증보기</span>
					</div>
				</div>
				<div class="body-wrap">
					<div>신용카드</div>
				</div>
			</div>
			<div class="wrapper order-product">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문내역</span>
						<div class="product-toggle-btn"><span>자세히보기</span></div>
					</div>
				</div>
				<div class="header-list">
					<div class="header-col prd-col"><span>제품</span></div>
					<div class="header-col price-col"><span>가격</span></div>
					<div class="header-col qty-col"><span>수량</span></div>
					<div class="header-col sum-col"><span>합계</span></div>
				</div>
				<div class="body-wrap">
				
					<div class="calculation-wrap">
						<div class="calculation-box">
							<div class="product-sum calculation-row">
								<span>제품 합계</span>
								<span class="cal-price">0</span>
							</div>
							<div class="point-box">
								<div class="calculation-row">
									<span>바우처 사용</span>
									<span class="voucher-point-use" data-voucher="0">0</span>
								</div>
								<div class="calculation-row">
									<span>적립 포인트 사용</span>
									<span class="accumulate-point-use" data-accumulate="0">0</span>
								</div>
								<div class="calculation-row">
									<span>충전 포인트 사용</span>
									<span class="charge-point-use" data-charge="0">0</span></div>
							</div>
							<div class="calculation-row">
								<span>배송비</span>
								<span data-delprice="5000" class="del-price">5,000</span>
							</div>
						</div>
						<div class="total-price-wrap">
							<div class="total-box">
								<span>최종 결제금액</span>
								<span class="product-qty hidden"></span>
							</div>
							<span class="total-price">0</span>
						</div>
					</div>
				</div>
			</div>
			
		

			<div class="terms-service " data-group="4">
				<div>주문 취소 안내</div>
				<ul class="terms-info-list">
					<li>'주문 접수' 및 '결제 완료' 단계 : [회원정보>주문>주문상세] 에서 취소 가능
						합니다.</li>
					<li>'배송 준비중' 이후 단계 : 주문취소 불가하며, 제품 수령 후 '반품'으로 진행 
						부탁드립니다.</li>
				</ul>
				<div>반품 안내</div>
				<ul class="terms-info-list">
					
					<li>반품 접수는 제품 수령 후 7일 이내 가능합니다.</li>
					<li>주문 상태가 '배송 완료' 일 경우 [회원정보>주문>주문상세] 에서 반품 접수 
						가능하며, '배송중' 으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍
						니다.</li>
					<li>반품 절차는 아래 링크를 참고하시기 바랍니다.</li>
				</ul>
			</div>
			<div class="step-btn-wrap">
				<div class="step-btn pre"><span>계속 쇼핑하기</span></div>
				<div class="step-btn next" data-step="1"><span>주문/배송조회</span></div>
			</div>
		</div>
	</section>




</main>
<script>


	document.addEventListener("DOMContentLoaded", function() {
		// const urlParams = new URL(location.href).searchParams;
		// const basketIdx = urlParams.get('basket_idx');
		// let basketArr = basketIdx.split(",");
        let basketArr = [11,9,8,7,6,5,4,3,2,1]
		$.ajax({
			type: "post",
			data: {
				"basket_idx": basketArr,
				"country": "KR"
			},
			dataType: "json",
			url: "http://116.124.128.246/_api/order/pg/get",
			error: function() {
				console.log("결제하기에 실패했습니다.");
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					let data = d.data;
					productInfoWrite(data[0].product_info)
					memberInfoWrite(data[0].member_info)
					addrInfoWrite(data[0].to_info)
				}
				if (code == 403) {
					console.log(d.msg)
				}
			}
		});
	});
	function productInfoWrite(product){
		let domFrag = document.createDocumentFragment();
		const orderWrapBody = document.querySelector(".order-product .body-wrap");
		let wrap = document.createElement("div");
		const url ="http://116.124.128.246:81"
		wrap.classList.add("product-wrap");
		let listHtml  = ""
		product.forEach(el => {
			listHtml += `
			<div class="body-list product">
				<div class="product-info">
					<a href="" class="docs-creator"><img class="prd-img" cnt="1" src="${url}${el.product_img}" alt=""></a>
					<div class="info-box">
						<div class="info-row" data-refund="${el.refund_flg?"true":"false"}">
							<div class="name" data-soldout=""><span>${el.product_name}</span></div>
						</div>
						<div class="info-row mobile-saleprice">
							<div class="product-price">${el.sales_price}</div>
						</div>
						<div class="info-row">
							<div class="color-title"><span>${el.color}</span></div>
							<div class="color__box" data-maxcount="" data-colorcount="1">
								<div class="color" data-color="${el.color_rgb}" data-productidx="1" data-soldout="STIN" style="background-color:${el.color_rgb}"></div>
							</div>
						</div>
						<div class="info-row">
							<div class="size__box">
								<li class="size" data-sizetype="" data-productidx="1" data-optionidx="1" data-soldout="STIN">${el.option_name}</li>
							</div>
						</div>
					</div>
				</div>

				<div class="list-row web-saleprice"><span class="product-price">${el.sales_price}</span></div>
				<div class="list-row"><span class="product-count">${el.product_qty}</span></div>
				<div class="list-row"><span class="total-price">${el.total_price}</span></div>
			</div>
			` 
		});
		wrap.innerHTML = listHtml;
		domFrag.appendChild(wrap);
		orderWrapBody.prepend(domFrag);
		productSumPrice();

	}
	function memberInfoWrite(member) {
		let orderName = document.querySelector(".order-info .order-name");
		let orderPhone = document.querySelector(".order-info .order-phone");
		let orderMail = document.querySelector(".order-info .order-mail");
		orderName.innerHTML = member[0].member_name;
		orderPhone.innerHTML = member[0].member_mobile;
		orderMail.innerHTML = member[0].member_email;
	}
	function addrInfoWrite(addr){
		let addressPlace = document.querySelector(".address-info .save-box .to-place");
		let addressName = document.querySelector(".address-info .save-box .to-name");
		let addressPhone = document.querySelector(".address-info .save-box .to-phone");
		let addressZipcode = document.querySelector(".address-info .save-box .to-zipcode");
		let addressMain= document.querySelector(".address-info .save-box .to-addr");
		let addressDetail = document.querySelector(".address-info .save-box .to-detail");

		addressPlace.innerHTML = addr[0].to_place;
		addressName.innerHTML = addr[0].to_name;
		addressPhone.innerHTML = addr[0].to_mobile;
		addressZipcode.innerHTML = addr[0].to_zipcode;
		addressMain.innerHTML = addr[0].to_addr;
		addressDetail.innerHTML = addr[0].to_detail_addr;
	}
	
	function productSumPrice() {
		let productTotalPrices = document.querySelectorAll(".product .total-price");
		let calProductSumPrice = document.querySelector(".calculation-wrap .product-sum .cal-price");
		let	delPrice = document.querySelector(".calculation-wrap .del-price");
		let	productQty = document.querySelector(".calculation-wrap .product-qty");
		let productLen = productTotalPrices.length;
		let productSum = [...productTotalPrices].map((el) => {
			let sum =+ el.innerHTML.replace(/,/g, '');
			return sum;
		});
		//합산
		const sum = productSum.reduce(function add(sum, currenValue) {
			return sum + currenValue;
		})

		calProductSumPrice.dataset.sum = sum;
		calProductSumPrice.innerHTML = sum.toLocaleString("ko-KR");
		productQty.innerHTML = productLen;


		//배송비 처리
		if(productSum < 50000 ) {
			let set = 5000;
			delPrice.dataset.delprice = set;
			delPrice.innerHTML = set.toLocaleString("ko-KR");;
		} else {
			delPrice.dataset.delprice = 0;	
			delPrice.innerHTML = 0;
		}
		totalPrice();
	}
	function totalPrice() {
		const calculationWrap = document.querySelector(".calculation-wrap");
		let step = calculationWrap.dataset.step;
		let	totalPrice = document.querySelector(".calculation-wrap .total-price");
		let	productPrice = document.querySelector(".calculation-wrap .cal-price");
		let	delPrice = document.querySelector(".calculation-wrap .del-price");
		let	voUse = document.querySelector(".calculation-wrap .voucher-point-use");
		let	acUse = document.querySelector(".calculation-wrap .accumulate-point-use");
		let	chUse = document.querySelector(".calculation-wrap .charge-point-use");
		let result = 0;

		//상품, 배송, 바우처, 적립, 충전 객체
		let calWrap = [
			{"title":"product","price":productPrice.dataset.sum},
			{"title":"del","price":delPrice.dataset.delprice},
			{"title":"voucher","price":voUse.dataset.voucher},
			{"title":"accumulate","price":acUse.dataset.accumulate},
			{"title":"charge","price":chUse.dataset.charge}]
		if(step === "1") {
		} else if(step === "2"){
		}
		result = calWrap.map(item => item.price).reduce((prev, curr) => parseInt(prev) + parseInt(curr));
		totalPrice.innerHTML =result.toLocaleString("ko-KR");
	}

	
</script>