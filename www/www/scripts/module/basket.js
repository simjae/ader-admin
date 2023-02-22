export function Basket(el, useSidebar) {
	const prototypes = {el,useSidebar}
	prototypes.el = el;
	prototypes.useSidebar = useSidebar;

	let parm = prototypes;

	//슬라이드 사용시 
	if(parm.useSidebar === true){
		this.writeHtml = () => {
			let sideBox = document.querySelector(`.side__box`);
			let sideWrap = document.querySelector(`#sidebar .side__wrap`);
			sideWrap.dataset.module = "basket";
			const basketContent = document.createElement("section");
			basketContent.className = "basket__wrap";
			basketContent.innerHTML = `
				<div class="list__box">
					<div class="list__header">
						<div class="icon__box">
							<img src="/images/svg/basket.svg" alt="">
							<div class="basket_title">쇼핑백</div>
						</div>
						<div class="checkbox__box">
							<label class="cb__custom all" for="">
								<input class="prd_cb all__cb" type="checkbox" name="stock">
								<div class="cb__mark"></div>
							</label>
							<div class="flex gap-10">
								<u class="ufont st__checked__btn" btn="stock">선택 삭제</u>
								<u class="ufont st__all__btn" btn="stock">모두 삭제</u>
							</div>			
						</div>
					</div>
					<div class="list__body"></div>
				</div>
				<div class="pay__box">
					<div class="pay__row">
						<div>제품합계</div>
						<div class="product__total__price">0</div>
					</div>
					<div class="pay__row">
						<div>배송비</div>
						<div class="deli__price" data-price_delivery="5000">0</div>
					</div>
					<div class="pay__row">
						<div>총 합계</div>
						<div class="pay__total__price">0</div>
					</div>
					<div class="pay__btn"><span>결제하기</span></div>
					<p class="pay__notiy">&nbsp;</p> 
				</div>
			`;
			
			sideBox.appendChild(basketContent);
		};
		
		this.writeHtml = () => {
			let sideBox = document.querySelector(`.side__box`);
			let sideWrap = document.querySelector(`#sidebar .side__wrap`);
			sideWrap.dataset.module = "basket";
			let contentHtml = `
				<section class="basket__wrap">
					<div class="list__box">
						<div class="list__header">
							<div class="icon__box">
								<img src="/images/svg/basket.svg" alt="">
								<div class="basket_title">쇼핑백</div>
							</div>
							<div class="checkbox__box">
								<label class="cb__custom all" for="">
									<input class="prd_cb all__cb" type="checkbox" name="stock">
									<div class="cb__mark"></div>
								</label>
								<div class="flex gap-10">
									<u class="ufont st__checked__btn" btn="stock">선택 삭제</u>
									<u class="ufont st__all__btn" btn="stock">모두 삭제</u>
								</div>			
							</div>
						</div>
						<div class="list__body"></div>
					</div>
					<div class="pay__box">
						<div class="pay__row">
							<div>제품합계</div>
							<div class="product__total__price">0</div>
						</div>
						<div class="pay__row">
							<div>배송비</div>
							<div class="deli__price" data-price_delivery="5000">0</div>
						</div>
						<div class="pay__row">
							<div>총 합계</div>
							<div class="pay__total__price">0</div>
						</div>
						<div class="pay__btn"><span>결제하기</span></div>
						<p class="pay__notiy">&nbsp;</p> 
					</div>
				</section>
			`;
			
			sideBox.innerHTML = contentHtml;
		};
	}
	
	//쇼핑백 상품 리스트 조회
	getBasketProductList();
	
	//쇼핑백 상품 리스트 조회
	function getBasketProductList (){
		$.ajax({
			type: "post",
			url: "http://116.124.128.246:80/_api/order/basket/list/get",
			dataType: "json",
			error: function() {
				alert("쇼핑백 상품 리스트 조회처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				let data = d.data;
				
				let basket_so_info = data.basket_so_info;
				let basket_st_info = data.basket_st_info;
				
				if (basket_so_info.length > 0 || basket_st_info.length > 0){
					writeProductListDomTree(basket_st_info,basket_so_info);
				} else {
					productNull();
				}
			}
		});
		
		function productNull() {
			let list__body = document.querySelector(".basket__wrap .list__body");
			let tungDiv = document.createElement("div");
			tungDiv.className = "tung-data";
			tungDiv.innerHTML = `<h1>쇼핑백이 비어있습니다.</h1>`
			list__body.appendChild(tungDiv);
		}
	}
	
	function writeProductListDomTree(st_info,so_info) {
		$('.product__wrap').remove();
		$('.sold__list__box').remove();
		
		let docFrag = document.createDocumentFragment();
		let stin_html  = "";
		let stso_html = "";
		
		let stin_product_wrap = document.createElement("div");
		stin_product_wrap.classList.add("product__wrap");
		
		let stso_product_wrap = document.createElement("div");
		stso_product_wrap.classList.add("sold__list__box");
		
		docFrag.appendChild(stin_product_wrap);
		
		//재고상품 있는 경우 
		if (st_info.length > 0 ) {
			st_info.forEach( el => {
				let color_html = "";
				
				let sales_price = (el.sales_price).toLocaleString('ko-KR');
				let color_rgb = el.color_rgb;
				
				let multi = color_rgb.split(";");
				if(multi.length === 2) {
					color_html += `
						<div class="color__box">
							<div class="color-title">${el.color}</div>
							<div class="color-line" data-basket_idx="${el.basket_idx}" style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
							<div class="color multi" data-title="${el.color}"></div>
							</div>
						</div>
					`;
				} else {
					color_html += `
						<div class="color__box">
							<div class="color-title">${el.color}</div>
							<div class="color-line" data-basket_idx="${el.basket_idx}" data-title="${el.color}" style="--background-color:${multi[0]}" >
								<div class="color" data-title="${el.color}"></div>
							</div>
						</div>
					`;
				}

				stin_html += `
					<div class="product__box" data-stock_status="${el.stock_status}"  data-basket_idx="${el.basket_idx}" data-basket_qty="${el.basket_qty}" data-product_idx="${el.product_idx}" data-option_idx="${el.option_idx}" data-product_qty="${el.product_qty}">
						<label class="cb__custom self" for="">
							<input class="prd__cb self__cb" type="checkbox" name="stock">
							<div class="cb__mark"></div>
						</label>
						<a href="http://116.124.128.246:80/product/detail?product_idx=${el.product_idx}"><div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div></a>
						<div class="prd__content" data-sales_price="${el.sales_price}" >
							<div class="prd__title">${el.product_name}</div>
							<div class="price">${sales_price}</div>
							${color_html}
							<div class="prd__size">
								<div class="size__box">
									<li data-soldout="${el.stock_status}">${el.option_name}</li>
								</div>
							</div>
							<div class="prd__qty">
								<div>Qty</div>
								<div class="minus__btn"><img src="/images/svg/minus-basket.svg"></div>
								<input class="count__val" type="text" value="${el.basket_qty}" readonly>
								<div class="plus__btn"><img src="/images/svg/plus-basket.svg"></div>
								<div class="price_total" data-price_total="${el.sales_price * el.basket_qty}" data-stock_status="${el.stock_status}">${sales_price}</div>
							</div>
						</div>
					</div>
				`
			});
			
			docFrag.querySelector('.product__wrap').innerHTML = stin_html;
			document.querySelector('.list__box .list__body').appendChild(docFrag);
		}
		
		deleteBasketInfo();
		deleteAllBasketInfo();
		
		if (so_info.length > 0 ) {
			//품절상품이 있을 경우  
			let product_html = "";
			let docFrag = document.createDocumentFragment();
			docFrag.appendChild(stso_product_wrap);
			
			stso_html += `
				<div class="list__header">
					<div class="icon__box">
						<img src="/images/svg/basket.svg" alt="">
						<div>품절제품</div>
					</div>
					<div class="checkbox__box">
						<label class="cb__custom all" for="">
							<input class="prd_cb all__cb" type="checkbox" name="sold">
							<div class="cb__mark"></div>
						</label>
						<div class="flex gap-10">
							<u class="ufont so__checked__btn" btn="stock">선택 삭제</u>
							<u class="ufont so__all__btn" btn="stock">모두 삭제</u>
						</div>			
					</div>
				</div>
				<div class="list__body">
				</div>
			`;
			
			stso_product_wrap.innerHTML = stso_html;

			so_info.forEach( el => {
				let color_html = "";
				
				let sales_price = (el.sales_price).toLocaleString('ko-KR');
				let color_rgb = el.color_rgb;
				let multi = color_rgb.split(";");
				if(multi.length === 2){
					color_html += `
						<div class="color__box">
							<div class="color-title">${el.color}</div>
							<div class="color-line" data-basket_idx="${el.basket_idx}" style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
							<div class="color multi" data-soldout="${el.stock_status}" data-title="${el.color}"></div>
							</div>
						</div>
					`;
				} else {
					color_html += `
						<div class="color__box">
							<div class="color-title">${el.color}</div>
							<div class="color-line" data-basket_idx="${el.basket_idx}" data-title="${el.color}" style="--background-color:${multi[0]}" >
								<div class="color" data-soldout="${el.stock_status}" data-title="${el.color}"></div>
							</div>
						</div>
					`;
				}

				let product_color_html = "";
				
				let product_color = el.product_color;
				product_color.forEach(color => {
					let optionColorData = color.color_rgb;
					let optionColorMulti= optionColorData.split(";");
					if(optionColorMulti.length === 2){
						product_color_html += `
						<div class="color-line" data-product_idx="${color.product_idx}" style="--background:linear-gradient(90deg, ${optionColorMulti[0]} 50%, ${optionColorMulti[1]} 50%);">
							<div class="color multi"data-title="${color.color}"data-soldout="${color.stock_status}"></div>
						</div>
					`;
					} else {
						product_color_html += `
							<div class="color-line" data-product_idx="${color.product_idx}" style="--background-color:${optionColorMulti[0]}" >
								<div class="color"data-title="${color.color}" data-soldout="${color.stock_status}"></div>
							</div>
						`;
					}
				});

				let reorder_class = el.reorder_flg ? "" : "disaBleBtn";
				let reorder_text  = el.reorder_flg ? "재입고 알림 신청완료" : "재입고 알림 신청하기";

				product_html += `
					<div class="product__box" data-basket_idx="${el.basket_idx}" data-stock_status="${el.stock_status}" data-product_idx="${el.product_idx}" data-option_idx="${el.option_idx}" data-reorder_flg="${el.reorder_flg}">
						<label class="cb__custom self" for="">
							<input class="prd__cb self__cb" type="checkbox" name="sold">
							<div class="cb__mark"></div>
						</label>
						<a href="http://116.124.128.246:80/product/detail?product_idx=${el.product_idx}"><div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div></a>
						<div class="prd__content">
							<div class="prd__title">${el.product_name}</div>
							${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-sales_price="${sales_price}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-sales_price="${sales_price}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
							${color_html}
							<div class="prd__size">
								<div class="size__box">
									<li data-soldout="${el.stock_status}">${el.option_name}</li>
								</div>
							</div>
							<div class="option__box">
								<div class="option__change__btn open">
									<img src="/images/svg/edit.svg" alt="">
									<u>옵션 변경하기</u>
								</div>
								<div class="reorder__btn ${reorder_class}">
									<img src="/images/svg/reflesh.svg" alt="">
									<u>${reorder_text}</u>
								</div>
							</div>
							<div class="option__select__box hide">
								<div class="option__select__head">
									<div class="option__color">${el.color}</div>
									<div class="close__btn option">
										<span class="line"></span>
										<span class="line"></span>
									</div>
								</div>
								<div class="color__box">${product_color_html}</div>
								<div class="size__box">
								${
									el.product_size.map((size) => {
										return `<li class="option__size" data-product_idx="${size.product_idx}" data-option_idx="${size.option_idx}" data-stock_status="${size.stock_status}">${size.option_name}</li>`;
									}).join("")
								}
								</div>
								<div class="option__change__btn apply">
									<img src="/images/svg/edit.svg" alt="">
									<u>옵션 변경하기</u>
								</div>
							</div>
						</div>
					</div>
				`;
				
				docFrag.querySelector(".list__body").innerHTML = product_html;
			});
			
			document.querySelector('.list__box .list__body').appendChild(docFrag);
			soldCheckedDeleteBtn();
			soldAllDeleteBtn();
		}
		
		clickCheckboxSTIN();
		clickCheckboxSTSO();
		
		clickCntBtn();
		
		optionBoxCloseBtn();
		clickPutBasketOption();
		setBasketOption();
		payBtnEvent();
		clickReorderBtn();
	}
	
	const selfCheckbox = (status, checked) => {
		let $$checkedSelfBox = document.querySelectorAll(`.self__cb[name='${status}']${checked ? ":checked":""}`);
		
		let basket_idx = [];
		$$checkedSelfBox.forEach( el => {
			let tmp_idx = el.parentNode.parentNode.dataset.basket_idx;
			basket_idx.push(tmp_idx);
			
			el.parentNode.parentNode.remove();
		});
		
		deleteBasketProduct(basket_idx);
		
		let price_product = calcCheckedPrice();
		payBoxSumPrice(price_product);
	}

	//재고상품 선택삭제 버튼
	function deleteBasketInfo(){
		const $checkedDelete = document.querySelector(".st__checked__btn");
		$checkedDelete.addEventListener("click", () => {
			selfCheckbox("stock",true);
		});
	};

	//재고상품 전체삭제 버튼
	function deleteAllBasketInfo(){
		const $checkedDelete = document.querySelector(".st__all__btn");
		$checkedDelete.addEventListener("click", () => {
			selfCheckbox("stock",false);
		});
	};

	//품절상품 선택삭제 버튼
	function soldCheckedDeleteBtn(){
		const $checkedDelete = document.querySelector(".so__checked__btn");
		$checkedDelete.addEventListener("click", (e) => {
			selfCheckbox("sold",true);
		});
	};

	//품절상품 전체삭제 버튼
	function soldAllDeleteBtn(){
		const $checkedDelete = document.querySelector(".so__all__btn");
		$checkedDelete.addEventListener("click", () => {
			selfCheckbox("sold",false);
		});
	};

	//삭제 api
	const deleteBasketProduct = (basketIdx) => {
		$.ajax({
			type: "post",
			data: {
				"basket_idx":basketIdx
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/order/basket/delete",
			error: function() {
				alert("장바구니 상품 정보 삭제 처리에 실패했습니다.");
			},
			success: function(d) {
				let code = d.code;
				if (code != 200) {
					alert(d.msg);
				}
			}
		});
	}

	//쇼핑백 상품 수량 변경
	const putBasketQty = (basket_idx,basket_qty,product_idx) => {
		$.ajax({
			type: "post",
			data: {
				"basket_idx":basket_idx,
				"stock_status":"STIN",
				"basket_qty":basket_qty,
				"product_idx":product_idx
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/order/basket/put",
			error: function() {
				alert("장바구니 상품 정보 수정 처리에 실패했습니다.");
			},
			success: function(d) {
				if (d.code != 200) {
					exceptionHandling("디자인 필요",d.msg)
				}
			}
		});
	}

	//쇼핑백 리스트 그려주는 함수
	function payBtnEvent() {
		let payBtn = document.querySelector(".pay__box .pay__btn");
		payBtn.addEventListener("click", function() {
			let selfBox = document.querySelectorAll(".self__cb[name='stock']");
			let soldSelfBox = document.querySelectorAll(".self__cb[name='sold']");
			let msgBox = document.querySelector(".pay__notiy");
			let selectArr =[];
			let checkCnt = 0;
			let country = "KR";
			
			selfBox.forEach(el => {
				if(el.checked){
					checkCnt++;
					selectArr.push(el.parentNode.parentNode.dataset.basket_idx);
				}
			})

			if(soldSelfBox.length > 0) {
				msgBox.innerText = '품절제품을 삭제 후 결제를 진행해주세요';
			}
			if(checkCnt == 0) {
				msgBox.innerText = '결제하실 상품을 선택해주세요.';
			}

			if (selectArr.length > 0) {
				location.href="/order/confirm?&basket_idx=" + selectArr;
			}
		});
	}

	//쇼핑백 상품 수량 수량 변경
	function clickCntBtn() {
		let $$minus_btn = document.querySelectorAll(".minus__btn");
		let $$plus_btn = document.querySelectorAll(".plus__btn");
		
		let $$basket_cnt = document.querySelectorAll(".count__val");
		
		let setTotalPrice = 0;

		//업 & 다운버튼 CSS 초기화 
		$$basket_cnt.forEach(el => {
			//el.value = 1;
			let sales_price = el.offsetParent.querySelector(".prd__content").dataset.sales_price;
			el.parentNode.dataset.init = sales_price;
			
			let basket_qty = el.offsetParent.dataset.basket_qty;
			let price_product = sales_price * basket_qty;
			
			el.parentNode.querySelector(".price_total").textContent = price_product.toLocaleString('ko-KR');

			let tmp_cnt = parseInt(el.value);
			if(tmp_cnt == 1){
				el.parentNode.querySelector(".minus__btn").classList.add('disableBtn');
			}
			
			if(tmp_cnt == 9){
				el.parentNode.querySelector(".plus__btn").classList.add('disableBtn');
			}
		});
		
		//수량 다운버튼 클릭이벤트
		$$minus_btn.forEach(el => {
			el.addEventListener("click", function() {
				let $plus_btn = this.parentNode.querySelector(".plus__btn");
				
				let basket_idx = this.offsetParent.dataset.basket_idx;
				let stock_status = this.offsetParent.dataset.stock_status;
				//let basket_qty = this.offsetParent.dataset.basket_qty;
				let product_idx = this.offsetParent.dataset.product_idx;
				
				let price_total = parseInt(this.parentNode.querySelector(".price_total").textContent.replace(/,/g ,''));
				price_total -= parseInt(this.parentNode.dataset.init);
				
				this.parentNode.querySelector('.price_total').dataset.price_total = price_total;
				
				let tmp_cnt = this.parentNode.querySelector(".count__val").value;
				tmp_cnt = parseInt(tmp_cnt) - 1;
				let basket_qty = tmp_cnt;
				
				this.parentNode.querySelector(".count__val").value = tmp_cnt;
				this.parentNode.querySelector(".price_total").textContent = price_total.toLocaleString('ko-KR');
				
				if(tmp_cnt == "1"){
					this.classList.add('disableBtn');
					setTotalPrice = this.parentNode.dataset.init;
				} else {
					$plus_btn.classList.remove('disableBtn');
				}
				
				let price_product = calcCheckedPrice();
				payBoxSumPrice(price_product);
				putBasketQty(basket_idx,basket_qty,product_idx);
				
			});
		});
		
		//수량 업버튼 클릭 이벤트
		$$plus_btn.forEach(el => {
			el.addEventListener("click", function() {
				let $minus_btn = this.parentNode.querySelector(".minus__btn");
				
				let basket_idx = this.offsetParent.dataset.basket_idx;
				let stock_status = this.offsetParent.dataset.stock_status;
				//let basket_qty = this.offsetParent.dataset.basket_qty;
				let product_idx = this.offsetParent.dataset.product_idx;
				
				let price_total = parseInt(this.parentNode.querySelector(".price_total").textContent.replace(/,/g , ''));
				price_total += parseInt(this.parentNode.dataset.init);
				
				this.parentNode.querySelector('.price_total').dataset.price_total = price_total;
				
				let tmp_cnt = this.parentNode.querySelector(".count__val").value;
				tmp_cnt = parseInt(tmp_cnt) + 1;
				let basket_qty = tmp_cnt;
				
				this.parentNode.querySelector(".count__val").value = tmp_cnt;
				this.parentNode.querySelector(".price_total").innerText = price_total.toLocaleString('ko-KR');
				
				if (tmp_cnt == "9") {
					this.classList.add('disableBtn');
				} else {
					$minus_btn.classList.remove('disableBtn');
				}
			
				let price_product = calcCheckedPrice();
				
				payBoxSumPrice(price_product);
				putBasketQty(basket_idx,basket_qty,product_idx);
			});
		});
		
	};

	//재고있음(STIN) 체크박스 클릭 이벤트
	function clickCheckboxSTIN () {
		const $all_stin_checkbox = document.querySelector(".all__cb"); //
		const $stin_checkbox = document.querySelectorAll(".self__cb"); 
		const $$productBox = document.querySelectorAll(".product__box"); 
		
		let checkbox_name = $all_stin_checkbox.getAttribute("name");
		let price_product = 0;
		
		//전체선택 체크박스 클릭 이벤트
		$all_stin_checkbox.addEventListener("click" , function() {
			let stock_list = document.querySelectorAll("input[name='stock']");
			stock_list.forEach(el => {
				el.checked = this.checked;
			});
			
			let price_product = calcCheckedPrice();
			payBoxSumPrice(price_product);
		});
		
		//개별 체크박스 클릭 이벤트
		$stin_checkbox.forEach( el => {
			el.addEventListener("click", (e) => {
				let input_name = e.currentTarget.getAttribute("name");
				if(input_name == "stock"){
					
					let product_box = e.currentTarget.parentNode.parentNode;
					let price_total = parseInt(product_box.querySelector(".price_total").dataset.price_total);
					
					if(e.target.checked){
						//체크시
						if(checkbox_name == "stock") {
							let checked_stin = document.querySelectorAll("input[name='stock']:checked");
							if($stin_checkbox.length == checked_stin.length) {
								$all_stin_checkbox.checked = true;
							}
							price_total += price_total;
						}
					} else {
						//체크 해제됬을떄
						$all_stin_checkbox.checked = false;
						price_total -= price_total;
					}
					
					let price_product = calcCheckedPrice();
					payBoxSumPrice(price_product);
				}
			});
		});
	}

	//재고없음(STSO) 전체선택 체크박스 클릭 이벤트
	function clickCheckboxSTSO(){
		let $all_soldout_checkbox = document.querySelector(".sold__list__box .all__cb[name='sold']"); 
		if($all_soldout_checkbox != null){
			$all_soldout_checkbox.addEventListener("click" , function() {
				let soldout_list = document.querySelectorAll(".sold__list__box .self__cb[name='sold']");
				soldout_list.forEach(el => {
					el.checked = this.checked;
				});  
			});
		}
	}

	/************************* 공통함수 **************************/
	//선택한 상품만 가격 합산
	function calcCheckedPrice() {
		let price_product = 0;
		
		let $$basket_checkbox = document.querySelectorAll(".self__cb[name='stock']:checked");
		$$basket_checkbox.forEach(el => {
			let tmp_price = parseInt(el.parentNode.parentNode.querySelector(".price_total").dataset.price_total);
			price_product += tmp_price;
		});
		
		return price_product;
	}

	//선택한 상품 결제박스 합계 표기
	function payBoxSumPrice (price_product){
		let $txt_price_product = document.querySelector(".product__total__price");
		let $txt_price_total = document.querySelector(".pay__total__price");
		let $txt_price_delivery = document.querySelector(".deli__price");
		
		let free_delivery = 80000;
		let price_delivery = parseInt($txt_price_delivery.dataset.price_delivery);
		let price_total = (price_product + price_delivery);

		if (price_total == price_delivery) {
			price_total = 0;
		}
		
		if (free_delivery <= price_product) {
			price_total -= price_delivery;
			price_delivery = 0;
		}
		
		if (price_total == 0 ) {
			price_delivery = 0;
		}
		
		$txt_price_product.textContent = price_product.toLocaleString('ko-KR');;
		$txt_price_total.textContent = price_total.toLocaleString('ko-KR');
		
		$txt_price_total.textContent = price_total.toLocaleString('ko-KR');
		$txt_price_delivery.textContent = price_delivery.toLocaleString('ko-KR');
	}

	function optionBoxCloseBtn(){
		const $$closeBtn = document.querySelectorAll(".close__btn.option");
		$$closeBtn.forEach(el => {
			el.addEventListener("click", function() {
				this.offsetParent.querySelectorAll(".color-line").forEach(el => el.classList.remove("select"));
				this.offsetParent.querySelectorAll(".option__size").forEach(el => el.classList.remove("select"));
				this.offsetParent.classList.add("hide");
			});
		});
	}

	function clickPutBasketOption() {
		const $$option_change_btn = document.querySelectorAll(".option__change__btn");
		$$option_change_btn.forEach(el => {
			el.addEventListener("click", function(ev) {
				setBasketOption();

				if(this.classList.contains("apply")){
					let basket_idx = this.parentNode.parentNode.parentNode.dataset.basket_idx;
					
					let colorValue = [...this.parentNode.querySelectorAll(".color-line")].find(el => el.classList.contains("select"));
					let product_idx = colorValue?.dataset.product_idx;
					
					let sizeValue = [...this.parentNode.querySelectorAll(".option__size")].find(el => el.classList.contains("select"));
					let option_idx = sizeValue?.dataset.option_idx;
					
					if (product_idx === undefined || option_idx === undefined) {
						return false;
					}
					
					this.offsetParent.classList.add("hide");
					
					putBasketOption(basket_idx,product_idx,option_idx);
				} else if (this.classList.contains("open")) {
					let $$option_select_box = document.querySelectorAll(".option__select__box");
					$$option_select_box.forEach(el => el.classList.add("hide"));
					this.parentNode.nextElementSibling.classList.remove("hide");
				}
			});
		});
	}

	function putBasketOption(basket_idx,product_idx,option_idx) {
		$.ajax({
			type: "post",
			url: "http://116.124.128.246:80/_api/order/basket/put",
			data: {
				'basket_idx' : basket_idx,
				'stock_status' : 'STSO',
				'product_idx' : product_idx,
				'option_idx' : option_idx
			},
			dataType: "json",
			error: function() {
				alert("쇼핑백 옵션 변경처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if (d.code == 200) {
					getBasketProductList();
				} else {
					exceptionHandling("디자인 필요",d.msg);
				}
			}
		});
	}

	function setBasketOption() {
		const $$option_color = document.querySelectorAll(".option__select__box .color-line");
		$$option_color.forEach(el => el.addEventListener("click", (ev) => {
			let {product_idx} = ev.currentTarget.dataset;

			$$option_color.forEach(el => el.classList.remove("select"));
			ev.currentTarget.classList.add("select");
			
			if(ev.currentTarget.classList.contains("select")){
				$.ajax({
					type: "post",
					url: "http://116.124.128.246:80/_api/order/basket/get",
					data: {
						"product_idx":product_idx
					},
					dataType: "json",
					error: function() {
					},
					success: function(d) {
						if (d.code == 200) {
							let data = d.data.product_size;
							let colorName = data[0].color;
							let sizeResult = data.map(el =>
								`<li class="option__size" data-product_idx="${el.product_idx}" data-option_idx="${el.option_idx}" data-stock_status="${el.stock_status}">${el.option_name}</li>`
							).join("");
							
							ev.target.offsetParent.querySelector(".option__color").innerHTML = colorName;
							ev.target.offsetParent.querySelector(".size__box").innerHTML = sizeResult;
							
							setBasketOptionSTSC();
						} else {
							exceptionHandling("디자인 필요",d.msg)
						}
					}
				});
			}
		}));
	}

	function setBasketOptionSTSC() {
		let $$option_size = document.querySelectorAll(".option__size");
		
		$$option_size.forEach(el => {
			if (el.dataset.stock_status == "STSO" || el.dataset.stock_status == "STSC") { 
				el.classList.add("disableBtn")
			}
		});
		
		$$option_size.forEach(el => el.addEventListener("click", (ev) => {
			let event_target = ev.currentTarget;
			
			$$option_size.forEach(el => el.classList.remove("select"));
			event_target.classList.add("select");
		}));
	}

	function clickReorderBtn() {
		const $$reorderBtn = document.querySelectorAll(".reorder__btn");
		$$reorderBtn.forEach(el => {
			el.addEventListener("click",(ev) => {
				let {basket_idx,product_idx,option_idx,reorder_flg} = ev.currentTarget.offsetParent.dataset;
				
				if (reorder_flg == false) {
					addReorderInfo(basket_idx,product_idx,option_idx);					
				}
			});
		});
	}

	function addReorderInfo(basket_idx,product_idx,option_idx){
		let country = "KR";
		$.ajax({
			type: "POST",
			url: "http://116.124.128.246:80/_api/order/reorder/add",
			data: {
				"country" : country,
				"add_type" : "basket",
				"product_idx" : product_idx,
				"basket_idx" : basket_idx,
				"option_idx" : option_idx
			},
			dataType: "json",
			error: function() {
			},
			success: function(d) {
				let result = d.data;
				setReorderFlg(product_idx);
			}
		});
	}

	function setReorderFlg(productIdx) {
		const productBox = [...document.querySelectorAll(".sold__list__box .product__box")].find(el => el.dataset.product_idx == productIdx);
		productBox.dataset.reflg = true;
		productBox.querySelector(".reorder__btn u").innerHTML = "재입고 알림 신청완료";
		productBox.querySelector(".reorder__btn u").classList.add('disableBtn');
	}
}