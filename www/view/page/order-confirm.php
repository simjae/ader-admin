
<!-- <script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script> -->
<style>
	:root {
		--order-header--height: 150px;
		--header--content--gap: 20px;

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
		color: var(--bk);
		font-family: var(--ft-no-fu);
		font-size: 10px;
		font-weight: 300;
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

	.content.left {
		position: sticky;
		top: var(--order-header--height);
		padding-top: var(--header--content--gap);
		align-self: start;
		grid-column: 4/9;
	}

	/* 주문상품내역 */
	.order-product {}

	.order-product .header-wrap {
		position: sticky;
	}

	.order-product .header-list {
		position: sticky;
		display: grid;
		grid-template-columns: 3fr 1fr 1fr 1fr;
		padding-bottom: 20px;
	}

	.order-product .body-wrap {}

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

	.order-product .prd-img {
		/* max-width: 3.65vw; */
		width: 70px;
		height: 86px;
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

	.total-price-wrap {
		display: flex;
		justify-content: space-between;
		padding-top: 30px;
	}


	.content.rigth {
		/* background-color: brown; */
		background-color: #ffffff;
		padding-top: var(--order-header--height);
		/* margin-top: var(--header--content--gap); */
		grid-column: 10/14;
		display: grid;
	}
	.content.rigth li,ul {
		list-style: disc;
	}
	.content.rigth input {
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
		border-bottom: 1px solid #dcdcdc;
		margin-bottom: 10px;
		align-items: center;
	}

	.header-box-btn {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 10px;
	}

	.header-box {
		padding-bottom: 10px;
	}

	.header-btn {
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 24px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;

	}

	.banner-wrap {
		display: grid;
		grid-template-columns: repeat(16, 1fr);
		position: fixed;
		width: 100%;
		height: var(--order-header--height);
		background-color: #ffffff;
		z-index: 10;
	}

	.banner-wrap .banner-box {
		display: flex;
		align-items: center;
		grid-column: 4/17;
		font-size: 13px;

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
		grid-column: 4/5;
	}

	.point-btn {
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
	}


	.charge-btn {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 99%;
		max-width: 100%;
		height: 40px;
		margin-bottom: 10px;
		border-radius: 1px;
		border: solid 1px #dcdcdc;
	}

	/* 주문자정보 */
	.wrapper.order-info {
		margin-bottom: 70px;
	}

	/* 배송지정보 */
	.address-info {
		padding-bottom: 40px;
	}

	.address-info .header-box {
		padding-bottom: 0;
	}

	.address-info .header-box-btn {
		padding-bottom: 10px;
	}

	.address-info .message-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.address-info .cn-box {
		padding-bottom: 20px;
	}

	.edit-box .input-row {
		display: flex;
		flex-direction: column;
		gap: 10px;
		margin-bottom: 10px;
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

	/* 스탭 버튼 */


	.step-btn-wrap {
		display: flex;
		justify-content: space-between;
		gap: 10px;
	}

	.step-btn {
		height: 40px;
		width: 50%;
		display: flex;
		justify-content: center;
		align-items: center;

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

	@media (max-width: 1025px) {
		.banner-wrap {
			display: flex;
			height: 37px;
		}

		.order-section {
			display: flex;
			flex-direction: column;
			padding: 0 10px;
		}

		.content.left {
			position: static;
			width: 100%;
		}
	}
</style>
<main data-basketStr="<?=$basket_idx?>" data-country="<?=$country?>">
	<div class="banner-wrap">
		<div class="banner-box">
			<span>결제하기</span>
		</div>
	</div>
	<section class="order-section">
		<div class="content left web">
			<div class="wrapper order-product">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문내역</span>
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
							<div class="point-box hidden">
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
								<span>총 합계(Qty:</span>
								<span class="product-qty"></span>)
							</div>
							<span class="total-price">0</span>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="content rigth">
			<div class="wrapper voucher-info" data-group="1">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">바우처</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="voucher-select-box"></div>
					<ul class="voucher-info-list">
						<li>바우처는 적립포인트와 중복 사용이 불가능합니다.</li>
						<li>바우처보다 제품 금액이 높을 시, 충전포인트와 중복 사용 또는 선택적 사용이 가능합니다.</li>
						<li>바우처보다 제품 금액이 낮을 시에는 반환금액이 없습니다.</li>
					</ul>
				</div>
			</div>
			<div class="wrapper reserves-info" data-group="1">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">적립 포인트</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="point-row">
						<input type="text">
						<div class="point-btn"><span>모두적용</span></div>
					</div>
					<div class="get-point reserves"><span>보유 적립 포인트</span><span>0</span></div>
					<ul class="reserves-info-list">
						<li>주문으로 발생한 적립 포인트는 배송완료 후 7일 부터 실제 사용 가능한 적립 포인트로 전환됩니다. 배송
							완료 시점으로부터 7일 동안은 미가용 적립 포인트로 분류됩니다.</li>
						<li>미가용 적립 포인트는 반품, 구매취소 등을 대비한 임시 적립 포인트로 사용가능 포인트로 전환되기까지
							상품구매에 사용하실 수 없습니다.</li>
						<li>사용가능 적립 포인트(총 적립 포인트, 사용된 적립 포인트, 미가용 적립 포인트)는 상품구매 시 바로 사용
							가능합니다.</li>
						<li>2019.07.01부터 개정 시행되는 특정 금융거래정보법에 따라 계좌 미연결한 고객은 적립 포인트 최대 50
							만원 및 충전 포인트 최대 50만원까지 보유가능합니다.</li>
						<li>적립 포인트는 예치금과 이니시스 결제 시에만 적립됩니다.</li>
					</ul>
				</div>
			</div>
			<div class="wrapper charge-info" data-group="1">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">충전 포인트</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="point-row">
						<input type="text">
						<div class="point-btn"><span>모두적용</span></div>
					</div>
					<div class="get-point charge"><span>보유 충전 포인트</span><span>0</span></div>
					<div class="charge-btn"><span>충전하기</span></div>
				</div>
			</div>

			<div class="wrapper order-info" data-group="2">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문자 정보</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="cn-box">
						<p class="order-name">심재형</p>
						<p class="order-phone">010-7791-6041</p>
						<p class="order-mail">simjae0731@gmail.com</p>
					</div>
				</div>
			</div>

			<div class="wrapper address-info" data-group="3">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">배송지정보</span>
					</div>

					<div class="header-box-btn">
						<div class="header-btn edit-btn"><span>수정</span></div>
						<div class="header-btn"><span>배송지목록</span></div>
					</div>
				</div>
				<div class="body-wrap">
					<div class="edit-box hidden">
						<div class="input-row">
							<span>배송지명</span>
							<input type="text" class="addr-name">
						</div>
						<div class="input-row">
							<span>수령자</span>
							<input type="text" class="addr-recipient">
						</div>
						<div class="input-row">
							<span>휴대전화</span>
							<input type="text" class="addr-phone">
						</div>
						<div class="input-row addr-search">
							<div class="input-text">
								<span>배송지 검색</span>
								<input type="text">
							</div>
							<div class="addr-search-btn">검색</div>
						</div>
						<div id="postcodify" class="input-row"></div>
						<div class="input-row">
							<div id="postcodify"></div>

							<span>상세주소</span>
							<input type="text">
						</div>
						<input type="text" name="" id="postcode" value="" /><br />
						<input type="text" name="" id="address" value="" /><br />
						<input type="text" name="" id="details" value="" /><br />
						<input type="text" name="" id="extra_info" value="" /><br />
						<div class="check-row">
							<div class="check-text">
								<input type="checkbox">
								<span>배송지 목록에 추가</span>
							</div>
							<div class="save-btn"><span>저장</span></div>
						</div>


					</div>
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
							<div class="edit-message-box">
								<div class="addr-message-select-box"></div>
								<textarea placeholder="내용을 입력해주세요.(최대 50자)" id="addrDirectBox" class="directBox" type="text"></textarea>
							</div>
							<div class="save-message-box hidden">
								<p class="message-content"></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="terms-service" data-group="4">
				<ul class="terms-info-list">
					<li>최소 결제 가능 금액은 결제금액에서 배송비를 제외한 금액입니다.</li>
					<li>소액 결제의 경우 PG사 정책에 따라 결제 금액 제한이 있을 수 있습니다.</li>
				</ul>
				<div class="check-row">
					<div class="check-text">
						<input onclick="checkboxAll(this)" type="checkbox" class="check-all">
						<span>전체 선택</span>
					</div>
				</div>
				<div class="check-row">
					<div class="check-text">
						<input type="checkbox" class="check-self">
						<span>이용약관, 개인정보처리방침에 동의합니다. (필수)</span>
					</div>
				</div>
				<div class="check-row">
					<div class="check-text">
						<input type="checkbox" class="check-self">
						<span>뉴스레터 발송, 맞춤 서비스 및 이벤트 제공, 신규 서비스 개발 등 서비스 품질
							향상을 위한 마케팅 정보 수신 및 활용에 동의합니다. (선택)</span>
					</div>
				</div>
			</div>

			<div class="select-box"></div>
			<div class="step-btn-wrap">
				<div class="step-btn pre"><span>이전단계</span></div>
				<div class="step-btn next"><span>다음단계</span></div>
			</div>
		</div>
	</section>




</main>


<script>
	document.addEventListener("DOMContentLoaded", function() {
		const urlParams = new URL(location.href).searchParams;
		const basketIdx = urlParams.get('basket_idx');
		console.log(basketIdx);
		let basketArr = basketIdx.split(",");
		console.log(basketArr); 
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


		addrMsessageSelectBox.on('change', ev => {

			let directTxt = document.querySelector("#addrDirectBox");
			console.log(`${ev.curr.getLabel()}`);
			console.log(`${ev.curr.getValue()}`);
			document.querySelector(".save-message-box .message-content").innerHTML = ev.curr.getLabel();
			if(ev.curr.getValue() === "direct"){
				directTxt.style.display="block";
			}else {
				directTxt.style.display="none";
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
						<div class="info-row">
							<div class="name" data-soldout=""><span>${el.product_name}</span></div>
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

				<div class="product-price">${el.sales_price}</div>
				<div class="product-count">${el.product_qty}</div>
				<div class="total-price">${el.total_price}</div>
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
	
	// 설렉트 박스 생성자
	let addrMsessageSelectBox = new tui.SelectBox('.addr-message-select-box', {
		placeholder: '배송시 요청사항을 선택해주세요',
		data: [{
				label: '부재시 문앞에 놓아주세요.',
				value: '1'
			},
			{
				label: '택배함에 넣어 주세요.',
				value: '2'
			},
			{
				label: '파손위험상품입니다. 배송시 주의해주세요.',
				value: '3'
			},
			{
				label: '배송전 연락주세요.',
				value: '4'
			},
			{
				label: '(최근)문 앞에 두고가주에요~',
				value: '5'
			},
			{
				label: '직접입력',
				value: 'direct'
			},

		],
		autofocus:false
	});
	let voucherSelectBox = new tui.SelectBox('.voucher-select-box', {
		placeholder: '사용가능 쿠폰 1장 / 보유 3장',
		data: [{
				label: '신규 회원 105 할인',
				value: '1'
			},
			{
				label: '뉴 시즌 할인-2022.12.12 15:00까지',
				value: '2'
			},
			{
				label: '슈즈 뉴라인 할인 -2022.11.20 15:00까지',
				value: '3'
			},
			{
				label: '선택안함',
				value: 'false'
			},
		]
	});


	/* 다음단계, 이전단계 */
	//버튼
	const calculationWrap = document.querySelector(".calculation-wrap");

	const nextStepBtn = document.querySelector(".step-btn.next");
	const preStepBtn = document.querySelector(".step-btn.pre");
	const editAddrBtn = document.querySelector(".address-info .edit-btn");
	const saveAddrBtn = document.querySelector(".address-info .save-btn");

	const editBox = document.querySelector(".edit-box");
	const saveBox = document.querySelector(".save-box");

	const $$wrapper = document.querySelectorAll(".wrapper");
	const $$group1 = document.querySelectorAll(".wrapper[data-group='1']");
	const $group2 = document.querySelector(".wrapper[data-group='2']");
	const $group3 = document.querySelector(".wrapper[data-group='3']");
	const calPointBox = document.querySelector(".calculation-box .point-box");
	preStepBtn.addEventListener("click", function() {
		nextStepBtn.dataset.step = "1";
		calculationWrap.dataset.step = "1";

		if (nextStepBtn.dataset.step === "1") {
			nextStepBtn.querySelector("span").innerHTML = "다음 단계";
		}
		$$group1.forEach(el => {
			el.classList.remove("next");
		});

		document.querySelector(".address-info.next .header-box-btn").classList.remove("hidden");
		//배송메시지 박스 
		document.querySelector(".edit-message-box").classList.remove("hidden");
		document.querySelector(".save-message-box").classList.add("hidden");

		calPointBox.classList.add("hidden");
		totalPrice();

	});

	nextStepBtn.addEventListener("click", function() {
		let directTxt = document.querySelector("#addrDirectBox");
		nextStepBtn.dataset.step = "2";
		calculationWrap.dataset.step = "2";
		if (nextStepBtn.dataset.step === "2") {
			nextStepBtn.querySelector("span").innerHTML = "결제";
		}
		$$group1.forEach(el => {
			el.classList.add("next");
		});
		$group2.classList.add("next");
		$group3.classList.add("next");
		if ($group3.classList.contains("next")) {
			document.querySelector(".address-info.next .header-box-btn").classList.add("hidden");
		}
		//배송메시지 박스 
		document.querySelector(".edit-message-box").classList.add("hidden");
		document.querySelector(".save-message-box").classList.remove("hidden");
		calPointBox.classList.remove("hidden");


		// 직접입력 배송메시지
		if(directTxt.value.length > 0){
			document.querySelector(".save-message-box .message-content").innerHTML = directTxt.value;
		}


		totalPrice();
	});

	editAddrBtn.addEventListener("click", function() {
		saveBox.classList.toggle("hidden");
		editBox.classList.toggle("hidden");
	});
	saveAddrBtn.addEventListener("click", function() {
		let addrName = document.querySelector(".addr-name");
		let addrRecipient = document.querySelector(".addr-recipient");
		let addrPhone = document.querySelector(".addr-phone");
		if (addrName.value === "") {
			console.log("배송지명을 입력해주세요.");
			return false;
		}
		if (addrRecipient.value === "") {
			console.log("수령자를 입력해주세요.");
			return false;
		}
		if (addrPhone.value === "") {
			console.log("휴대전화를 입력해주세요.");
			return false;
		}
		saveBox.classList.remove("hidden");
		editBox.classList.add("hidden");
	});

	
	// $(function() {
	// 	$("#postcodify").postcodify({
	// 		insertPostcode: "#postcode",
	// 		insertAddress: "#address",
	// 		insertDetails: "#details",
	// 		insertExtraInfo: "#extra_info",
	// 		hideOldAddresses: false,
	// 		afterSelect: function(selectedEntry) {
	// 			$("#postcodify div.postcode_search_result").remove();
	// 			$("#postcodify div.postcode_search_status.summary").hide();
	// 			$("#entry_box").show();
	// 			$("#entry_details").focus();
	// 		}
	// 	});
	// });


	function checkboxAll(allCheck) {
		let selfChecks = document.querySelectorAll(".terms-service .check-self");
		selfChecks.forEach(el => {
			el.checked = allCheck.checked;
		});
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
			let set = 5000
			delPrice.dataset.delprice = set;
			delPrice.innerHTML = set.toLocaleString("ko-KR");;
		} else {
			delPrice.dataset.delprice = 0;	
			delPrice.innerHTML = 0;
		}
		totalPrice();
	}
	function totalPrice() {
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