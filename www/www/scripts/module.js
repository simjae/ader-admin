/**
 * @author SIMJAE
 * @description 사이드바 생성자 함수 (즉시실행함수)
 */
function Sidebar() {
    this.appendSidebar = (() => {
        const sidebar = document.createElement("div");
        sidebar.id = "sidebar";
        document.body.appendChild(sidebar);
    })();
    this.makeSidebar = (() => {
        const docflag = document.createDocumentFragment();
        const $sidebar = document.getElementById("sidebar");
        const sideWrap = document.createElement('div');
        let sideContent = "";
        sideWrap.className = "side__background";
        sideContent = `<div class="side__wrap">
        <div class="sidebar-close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="12.707" height="12.707" viewBox="0 0 12.707 12.707">
                <path data-name="선 1772" transform="rotate(135 6.103 2.736)" style="fill:none;stroke:#343434" d="M16.969 0 0 .001"/>
                <path data-name="선 1787" transform="rotate(45 -.25 .606)" style="fill:none;stroke:#343434" d="M16.969.001 0 0"/>
            </svg>
        </div>
        <div class="side__box">
        
        
        </div>
        
        
        </div>`;
        sideWrap.innerHTML = sideContent;
        docflag.appendChild(sideWrap);
        $sidebar.appendChild(docflag);
    })();

}

/**
 * @author SIMJAE
 * @description 쇼핑백 생성자 함수
 * @param {String} el 클래스이름 
 * @param {boolean} useSidebar true: 사이드바 , false: 쇼핑백페이지 
 */
function Basket(el, useSidebar) {
    const prototypes = { el, useSidebar }
    prototypes.el = el;
    prototypes.useSidebar = useSidebar;

    let parm = prototypes;

    //슬라이드 사용시 
    if (parm.useSidebar === true) {
        // this.writeHtml = () => {
        // 	let sideBox = document.querySelector(`.side__box`);
        // 	let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        // 	sideWrap.dataset.module = "basket";
        // 	const basketContent = document.createElement("section");
        // 	basketContent.className = "basket__wrap";
        // 	basketContent.innerHTML = `
        // 		<div class="list__box">
        // 			<div class="list__header">
        // 				<div class="icon__box">
        // 					<img src="/images/svg/basket.svg" alt="">
        // 					<div class="basket_title">쇼핑백</div>
        // 				</div>
        // 				<div class="checkbox__box">
        // 					<label class="cb__custom all" for="">
        // 						<input class="prd_cb all__cb" type="checkbox" name="stock">
        // 						<div class="cb__mark"></div>
        // 					</label>
        // 					<div class="flex gap-10">
        // 						<u class="ufont st__checked__btn" btn="stock">선택 삭제</u>
        // 						<u class="ufont st__all__btn" btn="stock">모두 삭제</u>
        // 					</div>			
        // 				</div>
        // 			</div>
        // 			<div class="list__body"></div>
        // 		</div>
        // 		<div class="pay__box">
        // 			<div class="pay__row">
        // 				<div>제품합계</div>
        // 				<div class="product__total__price">0</div>
        // 			</div>
        // 			<div class="pay__row">
        // 				<div>배송비</div>
        // 				<div class="deli__price" data-price_delivery="5000">0</div>
        // 			</div>
        // 			<div class="pay__row">
        // 				<div>총 합계</div>
        // 				<div class="pay__total__price">0</div>
        // 			</div>
        // 			<div class="pay__btn"><span>결제하기</span></div>
        // 			<p class="pay__notiy">&nbsp;</p> 
        // 		</div>
        // 	`;

        // 	sideBox.appendChild(basketContent);
        // };

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
                        <div class="pay__row" style="display:none;">
                        <div>제품합계</div>
                    <div class="product__total__price">0</div>
                     </div>
						<div class="pay__row">
							<div>배송비</div>
							<div class="deli__price" data-price_delivery="5000">0</div>
						</div>
						<div class="pay__row">
							<div>합계</div>
							<div class="pay__total__price">0</div>
						</div>
						<div class="pay__btn" id="pay_btn"><span>결제하기</span></div>
                        <div class="check_basket_btn" onClick="location.href='/order/basket/list'"><img src="/images/svg/basket-bk_v1.0.svg" alt=""><span>쇼핑백 보러가기</span></div>
					</div>
				</section>
			`;

            sideBox.innerHTML = contentHtml;
        };
    }

    //쇼핑백 상품 리스트 조회
    getBasketProductList();

    //쇼핑백 상품 리스트 조회
    function getBasketProductList() {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/order/basket/list/get",
            dataType: "json",
            error: function () {
                alert("쇼핑백 상품 리스트 조회처리중 오류가 발생했습니다.");
            },
            success: function (d) {
                let data = d.data;

                let basket_so_info = data.basket_so_info;
                let basket_st_info = data.basket_st_info;

                if (basket_so_info.length > 0 || basket_st_info.length > 0) {
                    writeProductListDomTree(basket_st_info, basket_so_info);
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
    function writeProductListDomTree(st_info, so_info) {
        $('.product__wrap').remove();
        $('.sold__list__box').remove();

        let bodyWidth = document.getElementsByTagName("body")[0].offsetWidth;
        let docFrag = document.createDocumentFragment();
        let stin_html = "";
        let stso_html = "";

        let stin_product_wrap = document.createElement("div");
        stin_product_wrap.classList.add("product__wrap");

        let stso_product_wrap = document.createElement("div");
        stso_product_wrap.classList.add("sold__list__box");

        docFrag.appendChild(stin_product_wrap);
        //재고상품 있는 경우 
        if (st_info.length > 0) {
            st_info.forEach(el => {
                let color_html = "";

                let sales_price = (el.sales_price).toLocaleString('ko-KR');
                let color_rgb = el.color_rgb;

                let multi = color_rgb.split(";");
                if (multi.length === 2) {
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
                            ${el.refund_flg && bodyWidth >= 1024 ? `<div class="prd__title">${el.product_name}<p class="refund_msg">교환 반품 불가</p></div>` : `<div class="prd__title">${el.product_name}</div>`}
							<div class="price">${sales_price}</div>
							${color_html}
							<div class="prd__size">
								<div class="size__box">
									<li data-soldout="${el.stock_status}">${el.option_name}</li>
                                    </div>
                                ${el.refund_flg && bodyWidth < 1024 ? `<p class="refund_msg">교환 반품 불가</p>` : ``}
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
            // 첫 화면은 모든 체크박스 체크
            let selfCheck = document.querySelectorAll('.prd__cb');
            let allCheck = document.querySelector('.all__cb');
            selfCheck.forEach(el => el.setAttribute("checked", true));
            allCheck.setAttribute("checked", true);
            let price_product = calcCheckedPrice();
            payBoxSumPrice(price_product);
        }

        deleteBasketInfo();
        deleteAllBasketInfo();

        if (so_info.length > 0) {
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

            so_info.forEach(el => {
                let color_html = "";

                let sales_price = (el.sales_price).toLocaleString('ko-KR');
                let color_rgb = el.color_rgb;
                let multi = color_rgb.split(";");
                if (multi.length === 2) {
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
                    let optionColorMulti = optionColorData.split(";");
                    if (optionColorMulti.length === 2) {
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
                let reorder_text = el.reorder_flg ? "재입고 알림 신청완료" : "재입고 알림 신청하기";

                product_html += `
					<div class="product__box" data-basket_idx="${el.basket_idx}" data-stock_status="${el.stock_status}" data-product_idx="${el.product_idx}" data-option_idx="${el.option_idx}" data-reorder_flg="${el.reorder_flg}">
						<label class="cb__custom self" for="">
							<input class="prd__cb self__cb" type="checkbox" name="sold">
							<div class="cb__mark"></div>
						</label>
						<a href="http://116.124.128.246:80/product/detail?product_idx=${el.product_idx}"><div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div></a>
						<div class="prd__content">
                            <div class="prd__title">${el.product_name}</div>
							${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-sales_price="${sales_price}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>` : `<div class="price" data-soldout="${el.stock_status}" data-sales_price="${sales_price}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
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
								${el.product_size.map((size) => {
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
        let $$checkedSelfBox = document.querySelectorAll(`.self__cb[name='${status}']${checked ? ":checked" : ""}`);

        let basket_idx = [];
        $$checkedSelfBox.forEach(el => {
            let tmp_idx = el.parentNode.parentNode.dataset.basket_idx;
            basket_idx.push(tmp_idx);

            el.parentNode.parentNode.remove();
        });

        deleteBasketProduct(basket_idx);

        let price_product = calcCheckedPrice();
        payBoxSumPrice(price_product);
    }

    //재고상품 선택삭제 버튼
    function deleteBasketInfo() {
        const $checkedDelete = document.querySelector(".st__checked__btn");
        $checkedDelete.addEventListener("click", () => {
            selfCheckbox("stock", true);
        });
    };

    //재고상품 전체삭제 버튼
    function deleteAllBasketInfo() {
        const $checkedDelete = document.querySelector(".st__all__btn");
        $checkedDelete.addEventListener("click", () => {
            selfCheckbox("stock", false);
        });
    };

    //품절상품 선택삭제 버튼
    function soldCheckedDeleteBtn() {
        const $checkedDelete = document.querySelector(".so__checked__btn");
        $checkedDelete.addEventListener("click", (e) => {
            selfCheckbox("sold", true);
        });
    };

    //품절상품 전체삭제 버튼
    function soldAllDeleteBtn() {
        const $checkedDelete = document.querySelector(".so__all__btn");
        $checkedDelete.addEventListener("click", () => {
            selfCheckbox("sold", false);
        });
    };

    //삭제 api
    const deleteBasketProduct = (basketIdx) => {
        $.ajax({
            type: "post",
            data: {
                "basket_idx": basketIdx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/basket/delete",
            error: function () {
                alert("장바구니 상품 정보 삭제 처리에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code != 200) {
                    alert(d.msg);
                }
            }
        });
    }

    //쇼핑백 상품 수량 변경
    const putBasketQty = (basket_idx, basket_qty, product_idx) => {
        $.ajax({
            type: "post",
            data: {
                "basket_idx": basket_idx,
                "stock_status": "STIN",
                "basket_qty": basket_qty,
                "product_idx": product_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/basket/put",
            error: function () {
                alert("장바구니 상품 정보 수정 처리에 실패했습니다.");
            },
            success: function (d) {
                if (d.code != 200) {
                    exceptionHandling("디자인 필요", d.msg)
                }
            }
        });
    }

    //쇼핑백 리스트 그려주는 함수
    function payBtnEvent() {
        let payBtn = document.querySelector(".pay__box .pay__btn");
        payBtn.addEventListener("click", function () {
            let selfBox = document.querySelectorAll(".self__cb[name='stock']");
            let soldSelfBox = document.querySelectorAll(".self__cb[name='sold']:checked");
            let msgBox = document.querySelector(".pay__notiy");
            let selectArr = [];
            let checkCnt = 0;
            let country = "KR";

            selfBox.forEach(el => {
                if (el.checked) {
                    checkCnt++;
                    selectArr.push(el.parentNode.parentNode.dataset.basket_idx);
                }
            })

            if (soldSelfBox.length > 0) {
                msgBox.innerText = '품절제품을 삭제 후 결제를 진행해주세요.';
                return false;
            }
            if (checkCnt == 0) {
                msgBox.innerText = '결제하실 상품을 선택해주세요.';
            }

            if (selectArr.length > 0) {
                location.href = "/order/confirm?&basket_idx=" + selectArr;
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
            if (tmp_cnt == 1) {
                el.parentNode.querySelector(".minus__btn").classList.add('disableBtn');
            }

            if (tmp_cnt == 9) {
                el.parentNode.querySelector(".plus__btn").classList.add('disableBtn');
            }
        });

        //수량 다운버튼 클릭이벤트
        $$minus_btn.forEach(el => {
            el.addEventListener("click", function () {
                let $plus_btn = this.parentNode.querySelector(".plus__btn");

                let basket_idx = this.offsetParent.dataset.basket_idx;
                let stock_status = this.offsetParent.dataset.stock_status;
                //let basket_qty = this.offsetParent.dataset.basket_qty;
                let product_idx = this.offsetParent.dataset.product_idx;

                let price_total = parseInt(this.parentNode.querySelector(".price_total").textContent.replace(/,/g, ''));
                price_total -= parseInt(this.parentNode.dataset.init);

                this.parentNode.querySelector('.price_total').dataset.price_total = price_total;

                let tmp_cnt = this.parentNode.querySelector(".count__val").value;
                tmp_cnt = parseInt(tmp_cnt) - 1;
                let basket_qty = tmp_cnt;

                this.parentNode.querySelector(".count__val").value = tmp_cnt;
                this.parentNode.querySelector(".price_total").textContent = price_total.toLocaleString('ko-KR');

                if (tmp_cnt == "1") {
                    this.classList.add('disableBtn');
                    setTotalPrice = this.parentNode.dataset.init;
                } else {
                    $plus_btn.classList.remove('disableBtn');
                }

                let price_product = calcCheckedPrice();
                payBoxSumPrice(price_product);
                putBasketQty(basket_idx, basket_qty, product_idx);

            });
        });

        //수량 업버튼 클릭 이벤트
        $$plus_btn.forEach(el => {
            el.addEventListener("click", function () {
                let $minus_btn = this.parentNode.querySelector(".minus__btn");

                let basket_idx = this.offsetParent.dataset.basket_idx;
                let stock_status = this.offsetParent.dataset.stock_status;
                //let basket_qty = this.offsetParent.dataset.basket_qty;
                let product_idx = this.offsetParent.dataset.product_idx;

                let price_total = parseInt(this.parentNode.querySelector(".price_total").textContent.replace(/,/g, ''));
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
                putBasketQty(basket_idx, basket_qty, product_idx);
            });
        });

    };

    //재고있음(STIN) 체크박스 클릭 이벤트
    function clickCheckboxSTIN() {
        const $all_stin_checkbox = document.querySelector(".side__box .all input[name='stock']"); //
        const $stin_checkbox = document.querySelectorAll(".side__box .product__wrap .self__cb");
        const $$productBox = document.querySelectorAll(".product__box");

        let checkbox_name = $all_stin_checkbox.getAttribute("name");
        let price_product = 0;

        //전체선택 체크박스 클릭 이벤트
        $all_stin_checkbox.addEventListener("click", function () {
            let stock_list = document.querySelectorAll("input[name='stock']");
            stock_list.forEach(el => {
                el.checked = this.checked;
            });

            let price_product = calcCheckedPrice();
            payBoxSumPrice(price_product);
        });

        //개별 체크박스 클릭 이벤트
        $stin_checkbox.forEach(el => {
            el.addEventListener("click", (e) => {
                let input_name = e.currentTarget.getAttribute("name");
                if (input_name == "stock") {

                    let product_box = e.currentTarget.parentNode.parentNode;
                    let price_total = parseInt(product_box.querySelector(".price_total").dataset.price_total);

                    if (e.target.checked) {
                        //체크시
                        if (checkbox_name == "stock") {
                            let checked_stin = document.querySelectorAll("input[name='stock']:checked");
                            if ($stin_checkbox.length == checked_stin.length) {
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
    function clickCheckboxSTSO() {
        let $all_soldout_checkbox = document.querySelector(".sold__list__box .all__cb[name='sold']");
        if ($all_soldout_checkbox != null) {
            $all_soldout_checkbox.addEventListener("click", function () {
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
    function payBoxSumPrice(price_product) {
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

        if (price_total == 0) {
            price_delivery = 0;
        }

        $txt_price_product.textContent = price_product.toLocaleString('ko-KR');;
        $txt_price_total.textContent = price_total.toLocaleString('ko-KR');

        $txt_price_total.textContent = price_total.toLocaleString('ko-KR');
        $txt_price_delivery.textContent = price_delivery.toLocaleString('ko-KR');
    }

    function optionBoxCloseBtn() {
        const $$closeBtn = document.querySelectorAll(".close__btn.option");
        $$closeBtn.forEach(el => {
            el.addEventListener("click", function () {
                this.offsetParent.querySelectorAll(".color-line").forEach(el => el.classList.remove("select"));
                this.offsetParent.querySelectorAll(".option__size").forEach(el => el.classList.remove("select"));
                this.offsetParent.classList.add("hide");
            });
        });
    }

    function clickPutBasketOption() {
        const $$option_change_btn = document.querySelectorAll(".option__change__btn");
        $$option_change_btn.forEach(el => {
            el.addEventListener("click", function (ev) {
                setBasketOption();

                if (this.classList.contains("apply")) {
                    let basket_idx = this.parentNode.parentNode.parentNode.dataset.basket_idx;

                    let colorValue = [...this.parentNode.querySelectorAll(".color-line")].find(el => el.classList.contains("select"));
                    let product_idx = colorValue?.dataset.product_idx;

                    let sizeValue = [...this.parentNode.querySelectorAll(".option__size")].find(el => el.classList.contains("select"));
                    let option_idx = sizeValue?.dataset.option_idx;

                    if (product_idx === undefined || option_idx === undefined) {
                        return false;
                    }

                    this.offsetParent.classList.add("hide");

                    putBasketOption(basket_idx, product_idx, option_idx);
                } else if (this.classList.contains("open")) {
                    let $$option_select_box = document.querySelectorAll(".option__select__box");
                    $$option_select_box.forEach(el => el.classList.add("hide"));
                    this.parentNode.nextElementSibling.classList.remove("hide");
                }
            });
        });
    }

    function putBasketOption(basket_idx, product_idx, option_idx) {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/order/basket/put",
            data: {
                'basket_idx': basket_idx,
                'stock_status': 'STSO',
                'product_idx': product_idx,
                'option_idx': option_idx
            },
            dataType: "json",
            error: function () {
                alert("쇼핑백 옵션 변경처리중 오류가 발생했습니다.");
            },
            success: function (d) {
                if (d.code == 200) {
                    getBasketProductList();
                } else {
                    exceptionHandling("디자인 필요", d.msg);
                }
            }
        });
    }

    function setBasketOption() {
        const $$option_color = document.querySelectorAll(".option__select__box .color-line");
        $$option_color.forEach(el => el.addEventListener("click", (ev) => {
            let { product_idx } = ev.currentTarget.dataset;

            $$option_color.forEach(el => el.classList.remove("select"));
            ev.currentTarget.classList.add("select");

            if (ev.currentTarget.classList.contains("select")) {
                $.ajax({
                    type: "post",
                    url: "http://116.124.128.246:80/_api/order/basket/get",
                    data: {
                        "product_idx": product_idx
                    },
                    dataType: "json",
                    error: function () {
                    },
                    success: function (d) {
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
                            exceptionHandling("디자인 필요", d.msg)
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
            el.addEventListener("click", (ev) => {
                let { basket_idx, product_idx, option_idx, reorder_flg } = ev.currentTarget.offsetParent.dataset;

                if (reorder_flg == false) {
                    addReorderInfo(basket_idx, product_idx, option_idx);
                }
            });
        });
    }

    function addReorderInfo(basket_idx, product_idx, option_idx) {
        let country = "KR";
        $.ajax({
            type: "POST",
            url: "http://116.124.128.246:80/_api/order/reorder/add",
            data: {
                "country": country,
                "add_type": "basket",
                "product_idx": product_idx,
                "basket_idx": basket_idx,
                "option_idx": option_idx
            },
            dataType: "json",
            error: function () {
            },
            success: function (d) {
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
/**
 * @author SIMJAE
 * @description 블무마크 생성자 함수
 */
function Bluemark() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "bluemark";
        const bluemarkContent = document.createElement("section");
        bluemarkContent.className = "bluemark-wrap";
        bluemarkContent.innerHTML =
            `<div class="bluemark-logo"><div class="bluemark-title"><span class="bluemark-square"></span><span class="bluemark-name">Bluemark</span></div></div>
            <p class="bluemark-content">BLUE MARK는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해<br> 제공되는 정품 인증 서비스입니다.<br>
                ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기<br> 위하여 적극적으로 대응중입니다.</p>
            <div class="bluemark-btn-box">
                <a href="http://116.124.128.246/mypage?mypage_type=bluemark_verify"><div class="certification-btn"><span>블루마크 인증</span></div></a>
                <a href="http://116.124.128.246/mypage?mypage_type=bluemark_list"><div class="certification-detail-btn"><span>블루마크 인증 내역</span></div></a>
            </div>`
        sideBox.appendChild(bluemarkContent)
    };
}
/**
 * @author SIMJAE
 * @description 언어번경 생성자 함수
 */
function Language() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "language";
        const languageContent = document.createElement("section");
        languageContent.className = "language-wrap";
        languageContent.innerHTML =
            `
            <div class="language-title">언어선택</div>
            <p class="language-content">아래 옵션에서 선택해 주세요.<br>
                선택한 언어에 해당되는 홈페이지로 리디렉션됩니다.</p>
            <div class="language-btn-box">
                <div class="language-btn korea"><span>한국어</span></div>
                <div class="language-btn english"><span>English</span></div>
                <div class="language-btn china"><span>中文</span></div>
            </div>
        `
        sideBox.appendChild(languageContent);
    };
    this.addSelectEvent = () => {
        let $$languageBtn = document.querySelectorAll(".language-btn");
        $$languageBtn.forEach(el => {
            el.addEventListener("click", function () {
                $$languageBtn.forEach(el => el.classList.remove("select"));
                this.classList.add("select");
            })
        })
    }
}
/**
 * @author SIMJAE
 * @description 검색 생성자 함수
 */
function Search() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "search";
        const searchContent = document.createElement("section");
        searchContent.className = "search-wrap";
        searchContent.innerHTML =
            `
                <div class="search-header">
                    <img class="search-svg" src="/images/svg/search.svg" alt="">
                    <input id="search-input" type="search" placeholder="검색 해주세요!">
                </div>
                <div class="search-body">
                    <div class="search-content current" >
                        <ul class="search-recommend">
                            <div class="search-recommend-title">추천검색어</div>
                            <li>쇼퍼백</li>
                            <li>트윈하트로고티셔츠</li>
                            <li>키링</li>
                            <li>The new is not new</li>
                            <li>버켄스탁 콜라보레이션</li>
                        </ul>
                        <div class="search-recommend-title">실시간 인기 제품</div>
                        <div class="popular-wrap">
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                        </div>
                    </div>
                    <div class="search-content result hidden" >
                        <div class="search-result-title">검색 결과</div>
                        <div class="search-result-wrap">
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                        </div>
                        <div class="search-all-btn"><span>검색 결과 전체보기</span></div>
                    </div>
                </div>
        `
        sideBox.appendChild(searchContent);
    };
    this.mobileWriteHtml = () => {
        let mobileSearchWrap = document.querySelector(`.search__cont`);
        mobileSearchWrap.innerHTML = "";
        const mdlBox = document.createElement("div");
        mdlBox.className = "mdlSearchBox";
        mdlBox.innerHTML =
            `
                    <div class="search-header">
                        <img class="search-svg" src="/images/svg/search.svg" alt="">
                        <input id="search-input" type="search" placeholder="검색 해주세요!">
                    </div>
                    <div class="search-body">
                        <div class="search-content current" >
                            <ul class="search-recommend">
                                <div class="search-recommend-title">추천검색어</div>
                                <li>쇼퍼백</li>
                                <li>트윈하트로고티셔츠</li>
                                <li>키링</li>
                                <li>The new is not new</li>
                                <li>버켄스탁 콜라보레이션</li>
                            </ul>
                            <div class="search-popular-title">실시간 인기 제품</div>
                            <div class="popular-wrap">
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="popular-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt="">
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                            </div>
                        </div>
                        <div class="search-content result hidden" >
                            <div class="search-result-title">검색 결과</div>
                            <div class="search-result-wrap">
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                                <div class="search-result-box">
                                    <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                    <span class="product-name">Twin heart hoodie</span>
                                </div>
                            </div>
                            <div class="search-all-btn"><span>검색 결과 전체보기</span></div>
                        </div>
                    </div>
            `
        mobileSearchWrap.append(mdlBox);
    };
    this.addSearchEvent = () => {
        let input = document.getElementById("search-input");
        let searchResult = document.querySelector(".search-content.result")
        let searchCurrent = document.querySelector(".search-content.current")
        input.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                searchCurrent.classList.add("hidden");
                searchResult.classList.remove("hidden");
            }
        });
    }
}



function Login() {
    (() => {
        // $(document).ready(function() {
        //     console.log('getCookie');
        //     $('#member_id').val('');
        //     var usermember_id = getCookie("usermember_id");
        //     if(usermember_id) {
        //         $('#member_id').val(usermember_id);
        //     } else {
        //         $('#member_id').val('');
        //     }

        //     if($('#member_id').val() != ""){
        //         $("input:checkbox[id='member_id_flg']").prop("checked", true);
        //     }

        //     $("input:checkbox[id='member_id_flg']").change(function(){
        //         if($("input:checkbox[id='member_id_flg']").is(":checked")){
        //             setCookie("usermember_id", $('#member_id').val(), 7);
        //         }
        //         else{
        //             deleteCookie("usermember_id");
        //         }
        //     })

        //     $('#member_id').keyup(function(){
        //         if($('input:checked[id="member_id_flg"]').is(":checked")){
        //             setCookie("usermember_id", $('#member_id').val(), 7);
        //         }
        //     })
        // });

        function login() {
            var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var member_id = $('#member_id').val();
            var member_pw = $('#member_pw').val();
            mail_regex.test(member_id);

            $('.font__underline.font__red').text('');
            if (member_id == '') {
                $('.member_id_msg').text('이메일을 입력해주세요');

                return false;
            }
            else {
                if (!mail_regex.test(member_id)) {
                    $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

                    return false;
                }
            }

            if (member_pw == '') {
                $('.member_pw_msg').text('비밀번호를 입력해주세요');

                return false;
            }


            $.ajax(
                {
                    url: "http://116.124.128.246:80/_api/account/login",
                    type: 'POST',
                    data: $("#frm-login").serialize(),
                    error: function (jqxhr) {
                        console.warn(jqxhr.responseText)
                        $('.result_msg').text("모듈에 문제가 발생했습니다.");
                    },
                    success: function (data) {
                        if (data.code == "200") { // 로그인 성공
                            location.href = 'main';
                            //location.href='main';
                        }
                        else {	// 로그인 실패
                            var err_msg = '로그인 실패입니다. 로그인정보 재확인 후 다시 시도하여 주십시오.';
                            if (data.msg != null) {
                                err_msg = data.msg;
                            }
                            $('.result_msg').text(err_msg);
                        }
                    },
                    complete: function (data) {
                        //$("#result1").html(data.responseText);
                    }
                }
            );
        }

        function setCookie(cookieName, value, exdays) {
            let exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            let cookieValue = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toGMTString());
            document.cookie = cookieName + "=" + cookieValue;
        }

        //쿠키값 delete
        function deleteCookie(cookieName) {
            let expireDate = new Date();
            expireDate.setDate(expireDate.getDate() - 1);
            document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
        }

        //쿠키값 get
        function getCookie(cookieName) {
            cookieName = cookieName + "=";
            let cookieData = document.cookie;
            let start = cookieData.indexOf(cookieName);
            let cookieValue = '';
            if (start != -1) {
                start += cookieName.length;
                let end = cookieData.indexOf(';', start);
                if (end == -1) end = cookieData.length;
                cookieValue = cookieData.substring(start, end);
            }
            return unescape(cookieValue); //unescape로 디코딩 후 값 리턴
        }

        // search
        function password_find() {
            var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var member_id = $('#member_id').val();
            mail_regex.test(member_id);

            $('.font__underline.font__red').css('visibility', 'hidden');
            if (member_id == '') {

                $('.member_id_msg').css('visibility', 'visible');
                $('.member_id_msg').text('이메일을 입력해주세요');

                return false;
            }
            else {
                if (!mail_regex.test(member_id)) {

                    $('.member_id_msg').css('visibility', 'visible');
                    $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

                    return false;
                }
            }

            //Test용 STMP APP Password : wnaqvncvlugpjdvl
            /*
            Email.send({
                Host: "smtp@gmail.com",
                Username : "dhpark3610@gmail.com",
                Password : "psh1300411!",
                To: "shpark@bvdev.co.kr",
                From: "dhpark3610@gmail.com",
                Subject: "SMTP Test",
                Body : "SMTP Test context",
        
            }).then(
                message => alert(message)
            );
            */

            $.ajax(
                {
                    url: "http://116.124.128.246:80/_api/account/search/get",
                    type: 'POST',
                    data: $("#frm-find").serialize(),
                    error: function (data) {
                        $('.member_id_msg').css('visibility', 'hidden');
                        $('.result_msg').css('visibility', 'visible');
                        $('.result_msg').text("모듈에 문제가 발생했습니다.");
                    },
                    success: function (data) {
                        if (data.code == "200") { // 이메일검사 성공
                            $('.member_id_msg').css('visibility', 'hidden');
                            $('.result_msg').css('visibility', 'visible');
                            $('.result_msg').text(data.data.temp_password);
                        }
                        else {	// 이메일검사 실패
                            $('.member_id_msg').css('visibility', 'visible');
                            $('.member_id_msg').text('존재하지 않는 이메일입니다');
                        }
                    },
                    complete: function (data) {
                        //$("#result1").html(data.responseText);
                    },
                    dataType: 'json'
                }
            );

        }
        // check
        function password_find_check() {
            var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var member_id = $('#member_id').val();
            mail_regex.test(member_id);

            $('.font__underline.font__red').css('visibility', 'hidden');
            if (member_id == '') {

                $('.member_id_msg').css('visibility', 'visible');
                $('.member_id_msg').text('이메일을 입력해주세요');

                return false;
            }
            else {
                if (!mail_regex.test(member_id)) {

                    $('.member_id_msg').css('visibility', 'visible');
                    $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

                    return false;
                }
            }

            //Test용 STMP APP Password : wnaqvncvlugpjdvl
            /*
            Email.send({
                Host: "smtp@gmail.com",
                Username : "dhpark3610@gmail.com",
                Password : "psh1300411!",
                To: "shpark@bvdev.co.kr",
                From: "dhpark3610@gmail.com",
                Subject: "SMTP Test",
                Body : "SMTP Test context",
        
            }).then(
                message => alert(message)
            );
            */

            $.ajax(
                {
                    url: "http://116.124.128.246:80/_api/account/check/check",
                    type: 'POST',
                    data: $("#frm-find").serialize(),
                    error: function (data) {
                        $('.member_id_msg').css('visibility', 'hidden');
                        $('.result_msg').css('visibility', 'visible');
                        $('.result_msg').text("모듈에 문제가 발생했습니다.");
                    },
                    success: function (data) {
                        if (data.code == "200") { // 이메일검사 성공
                            $('.member_id_msg').css('visibility', 'hidden');
                            $('.result_msg').css('visibility', 'visible');
                            $('.result_msg').text(data.data.temp_password);
                        }
                        else {	// 이메일검사 실패
                            $('.member_id_msg').css('visibility', 'visible');
                            $('.member_id_msg').text('존재하지 않는 이메일입니다');
                        }
                    },
                    complete: function (data) {
                        //$("#result1").html(data.responseText);
                    },
                    dataType: 'json'
                }
            );

        }

        //login-update
        $(document).ready(function () {
            $('input[name="password"]').keyup(function () {
                if (memberPwConfirm($(this).val()) || $(this).val().length == 0) {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'hidden');
                }
                else {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'visible');
                };
            });
            urlParsing();
        });
        function urlParsing() {
            var url = location.href;
            var idx = url.indexOf("?");

            if (idx >= 0) {
                var data = url.substring(idx + 1, url.length);
                var data_arr = data.split("=");
                if (data_arr[0] == 'member_idx') {
                    $('input [name="idx"]').val(data_arr[1]);
                    console.log($('input [name="idx"]').val());
                }
            }
        }
        function memberPwConfirm(str) {
            //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
            //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
            var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
            //  공백 입력 불가능
            var space_reg = /\s/g;
            //var password_str = $('input[name="password"]').eq(0).val();

            if (space_reg.test(str) == false) {
                return password_reg.test(str)
                return true;
            }
            else {
                return false;
                //공백 포함 예외처리
            }
        }
        //.css('visibility','hidden');
        function updateMemberPw() {
            var member_idx = $('input[name="member_idx"]').val();
            var member_pw = $('input[name="member_pw"]').val();
            var member_pw_confirm = $('input[name="member_pw_confirm"]').val();

            $('.warn__msg').css('visibility', 'hidden');

            if (memberPwConfirm(member_pw) == false) {
                $('.font__underline.warn__msg.member_pw').css('visibility', 'visible');
                return false;
            }
            if (member_pw != member_pw_confirm) {
                $('.warn__msg.member_pw_confirm').css('visibility', 'visible');
                return false;
            }

            $.ajax(
                {
                    url: "http://116.124.128.246:80/_api/account/put",
                    type: 'POST',
                    data: {
                        'member_idx': member_idx,
                        'member_pw': member_pw
                    },
                    error: function (data) {
                    },
                    success: function (data) {
                        if (data.code == "200") {
                            //location.reload();
                            console.log('비밀번호 변경 성공');
                            location.href = '/login';
                        }
                    },
                    complete: function (data) {
                        //$("#result1").html(data.responseText);
                    },
                    dataType: 'json'
                }
            );
        }
        //login-password-pub 
        $(document).ready(function () {
            $('#pw_desciption').hide();
            $('input[name="member_pw"]').keyup(function () {
                if (memberPwConfirm($(this).val()) || $(this).val().length == 0) {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'hidden');
                    hidePwDescription();
                }
                else {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'visible');
                    showPwDescription();
                };
            });
        });
        function memberPwConfirm(str) {
            //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
            //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
            var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
            //  공백 입력 불가능
            var space_reg = /\s/g;
            //var password_str = $('input[name="password"]').eq(0).val();

            if (space_reg.test(str) == false) {
                return password_reg.test(str)
                return true;
            }
            else {
                return false;
                //공백 포함 예외처리
            }
        }
        function showPwDescription() {
            $('#pw_desciption').show();
            $('#hide_area').hide();
        }
        function hidePwDescription() {
            $('#pw_desciption').hide();
            $('#hide_area').show();
        }

        //join
        $(document).ready(function () {
            $('#pw_desciption').hide();
            $('input[name="member_pw"]').keyup(function () {
                if (memberPwConfirm($(this).val()) || $(this).val().length == 0) {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'hidden');
                    hidePwDescription();
                }
                else {
                    $('.font__underline.warn__msg.member_pw').css('visibility', 'visible');
                    showPwDescription();
                };
            });
            $('.component').click(function () {
                var sel_cnt = $('.component:checked').length;
                if (sel_cnt == 3) {
                    $('.select__all').prop('checked', true);
                }
                else {
                    $('.select__all').prop('checked', false);
                }
            });
        });
        $(function () {
            /*
            if($('#postcodify').find('postcodify_search_controls').length == 0){
                $("#postcodify").postcodify({
                    insertPostcode5 : "#zipcode",
                    insertAddress : "#road_addr",
                    insertDetails : "#detail_ddr",
                    insertJibeonAddress : "#lot_addr",
                    hideOldAddresses: false,
                    results:".post-change-result",
                    hideSummary:true,
                    useFullJibeon:true,
                    onReady:function(){
                        document.querySelector(".post-change-result").style.display="none";
                        $(".postcodify_search_controls .keyword").attr("placeholder","예) 성동구 연무장길 53, 성수동2가 315-57");
                        // $(".post-change-result").hide();
                    },
                    onSuccess:function(){
                        document.querySelector(".post-change-result").style.display="block";
                        $("#postcodify div.postcode_search_status.too_many").hide();
                        // $(".post-change-result").hide();
                    },
                    afterSelect: function(selectedEntry) {
        
                        $("#postcodify div.postcode_search_result").remove();
                        $("#postcodify div.postcode_search_status.too_many").hide();
                        $("#postcodify div.postcode_search_status.summary").hide();
                        document.querySelector(".post-change-result").style.display="none";
                        $("#entry_box").show();
                        $("#entry_details").focus();
                        $(".postcodify_search_controls .keyword").val($("#road_addr").val());
                    }
                });
                $('.postcodify_search_controls .keyword').keyup(function(){
                    $('.postcodify_search_controls .keyword').attr('chk-flg', 'false');
                });
                
                $('.post-change-result.postcodify_search_form.postcode_search_form').on('click',function(){
                    $('.postcodify_search_controls .keyword').attr('chk-flg', 'true');
                });
            }
            */
        });
        function selectAllClick(obj) {
            if ($(obj).prop('checked') == true) {
                $(obj).prop('checked', true);
                $(".login__check__option").prop('checked', true);
            } else {
                $(obj).attr('checked', false);
                $(".login__check__option").prop('checked', false);
            }
        }
        function memberPwConfirm(str) {
            //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
            //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
            var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
            //  공백 입력 불가능
            var space_reg = /\s/g;
            //var password_str = $('input[name="password"]').eq(0).val();

            if (space_reg.test(str) == false) {
                return password_reg.test(str)
                return true;
            }
            else {
                return false;
                //공백 포함 예외처리
            }
        }
        //.css('visibility','hidden');
        function joinAction() {
            var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var member_id = $('input[name="member_id"]').val();
            var member_pw = $('input[name="member_pw"]').val();
            var member_pw_confirm = $('input[name="member_pw_confirm"]').val();
            var member_name = $('input[name="member_name"]').val();
            var birth_year = $('input[name="birth_year"]').val();
            var birth_month = $('input[name="birth_month"]').val();
            var birth_day = $('input[name="birth_day"]').val();
            var terms_of_service_flg = $('#terms_of_service_flg').is(':checked');

            mail_regex.test(member_id);

            $('.warn__msg').css('visibility', 'hidden');
            if (memberPwConfirm(member_pw) == false) {
                $('.font__underline.warn__msg.member_pw').css('visibility', 'visible');
                showPwDescription();
                return false;
            }
            if (member_id == '' || !mail_regex.test(member_id)) {
                $('.warn__msg.member_id').css('visibility', 'visible');
                return false;
            }
            else if (member_pw != member_pw_confirm) {
                $('.warn__msg.member_pw_confirm').css('visibility', 'visible');
                return false;
            }
            else if (member_name == '') {
                $('.warn__msg.member_name').css('visibility', 'visible');
                return false;
            }
            else if (birth_year == '' || birth_month == '' || birth_day == '') {
                $('.warn__msg.birth').css('visibility', 'visible');
                return false;
            }
            else if (terms_of_service_flg == false) {
                $('.warn__msg.essential').css('visibility', 'visible');
                $('.warn__msg.essential').text('필수항목을 선택해주세요');
                return false;
            }

            $.ajax(
                {
                    url: "http://116.124.128.246:80/_api/account/add",
                    type: 'POST',
                    data: $("#frm-regist").serialize(),
                    error: function (data) {
                    },
                    success: function (data) {
                        if (data.code == "200") {
                            //location.reload();
                            location.href = '/main';
                            console.log('회원가입 성공');
                        }
                        else {
                            if (data.code == "303") {
                                $('.warn__msg.essential').css('visibility', 'visible');
                                $('.warn__msg.essential').text(data.msg);
                            }
                        }
                    },
                    complete: function (data) {
                        //$("#result1").html(data.responseText);
                    },
                    dataType: 'json'
                }
            );
        }

        function showPwDescription() {
            $('#pw_desciption').show();
            $('#hide_area').hide();
        }
        function hidePwDescription() {
            $('#pw_desciption').hide();
            $('#hide_area').show();
        }
    })();
}
/**
 * @author SIMJAE
 * @description 로그인 , 유저 생성자 함수 
 * 
 */
function User() {
    this.userLoad = () => {
        $.ajax({
            type: "post",
            data: {
                "country": "KR"
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/menu/get ",
            error: function () {
            },
            success: function (d) {
                let code = d.code;
                let memberInfo = d.member_info;
                if (code == "200") {
                    if (memberInfo === undefined) {
                        writeLoginHtml();
                    } else {
                        writeUserHtml(memberInfo);
                    }
                }
            }
        });
    }
    let writeUserHtml = (data) => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "user";
        const userContent = document.createElement("section");
        let { member_id, member_mileage, member_name, member_voucher, whish_cnt, basket_cnt } = data
        userContent.className = "user-wrap";
        userContent.innerHTML =
            `
        <div class="user-body">
            <div class="user-logo">
                <img src="/images/mypage/mypage_member_icon.svg">
            </div>
            <div class="content-row">
                <div>
                    <p>${member_name}</p>
                </div>
                <div>
                    <p>${member_id}</p>
                </div>
            </div>
            <div class="user-content">
                <div class="content-point left">
                    <div>적립포인트</div>
                    <a class="content-link" href="http://116.124.128.246/mypage?mypage_type=mileage_first">
                        <div class="user-mileage">${member_mileage}</div>
                    </a>
                </div>
                <div class="content-point center">
                    <div>충전포인트</div>
                    <a class="content-link" href="http://116.124.128.246/mypage">
                        <div class="user-point">600,000</div>
                    </a>
                </div>
                <div class="content-point right">
                    <div>바우처</div>
                    <a class="content-link" href="http://116.124.128.246/mypage?mypage_type=voucher_first">
                        <div class="user-voucher">${member_voucher}</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="user-mypage-area">
            <div class="icon__item" btn-type="orderlist">
                <a href="http://116.124.128.246/mypage?mypage_type=orderlist">
                    <div class="icon">
                        <img src="/images/mypage/mypage_orderlist_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>주문조회</p>
                </div>
            </div>
            <div id="mileage_icon" class="icon__item" btn-type="mileage">
                <a href="http://116.124.128.246/mypage?mypage_type=mileage_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_point_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>적립포인트</p>
                </div>
            </div>
            <div id="voucher_icon" class="icon__item" btn-type="voucher">
                <a href="http://116.124.128.246/mypage?mypage_type=voucher_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_voucher_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>바우처</p>
                </div>
            </div>
            <div class="icon__item" btn-type="bluemark">
                <a href="http://116.124.128.246/mypage?mypage_type=bluemark_verify">
                    <div class="icon">
                        <img src="/images/mypage/mypage_bluemark_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>블루마크</p>
                </div>
            </div>
            <div class="icon__item" btn-type="stanby">
                <a href="http://116.124.128.246/mypage?mypage_type=stanby_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_stanby_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>스탠바이</p>
                </div>
            </div>
            <div class="icon__item" btn-type="preorder">
                <a href="http://116.124.128.246/mypage?mypage_type=preorder_first">
                    <div id="preorder_icon" class="icon">
                        <img src="/images/mypage/mypage_preorder_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>프리오더</p>
                </div>
            </div>
            <div class="icon__item" btn-type="reorder">
                <a href="http://116.124.128.246/mypage?mypage_type=reorder_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_reorder_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>재입고알림</p>
                </div>
            </div>
            <div class="icon__item" btn-type="draw">
                <a href="http://116.124.128.246/mypage?mypage_type=draw_first">
                    <div id="draw_icon" class="icon">
                        <img src="/images/mypage/mypage_draw_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>드로우</p>
                </div>
            </div>
            <div class="icon__item" btn-type="membership">
                <a href="http://116.124.128.246/mypage?mypage_type=membership_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_membership_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>멤버쉽</p>
                </div>
            </div>
            <div class="icon__item" btn-type="inquiry">
                <a href="http://116.124.128.246/mypage?mypage_type=inquiry_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_inquiry_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>문의</p>
                </div>
            </div>
            <div class="icon__item" btn-type="as">
                <a href="http://116.124.128.246/mypage?mypage_type=as_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_as_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>A/S</p>
                </div>
            </div>
            <div class="icon__item" btn-type="service">
                <a href="http://116.124.128.246/mypage?mypage_type=service_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_service_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>고객서비스</p>
                </div>
            </div>
            <div class="icon__item" btn-type="profile">
                <a href="http://116.124.128.246/mypage?mypage_type=profile_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_profile_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>회원정보</p>
                </div>
            </div>
        </div>
        <div class="user-button-area">
            <a href="http://116.124.128.246/mypage">
                <div class="user-button mypageBtn">마이페이지 홈 가기</div>
            </a>
            <div class="user-button logoutBtn" onclick="logout()">로그아웃</div>
        </div>
        `
        sideBox.appendChild(userContent);
    };
    let writeLoginHtml = () => {
        let login = new Login();
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "login";
        const loginContent = document.createElement("section");
        loginContent.className = "user-wrap";
        loginContent.innerHTML = `
        <div class="login__card">
            <div class="card__header">
                <p class="font__large">로그인</p>
                <span class="font__underline font__red result_msg"></span>
            </div>
            <div class="card__body">
                <form id="frm-login" method="post" onSubmit="login();return false;">
                    <input type="hidden" name="country" value="KR">
                    <input type="hidden" name="member_ip" value="0.0.0.0">
                    <div class="content__wrap">
                        <div class="content__title">이메일
                        <p class="font__underline font__red member_id_msg"></p>
                        </div>
                        <div class="content__row">
                            <input type="text" id="member_id" name="member_id" value="">
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">비밀번호
                        <p class="font__underline font__red member_pw_msg"></p>
                        </div>
                        <div class="content__row">
                            <input type="password" id="member_pw" name="member_pw" value="">
                        </div>
                    </div>
                    <div class="content__wrap login_btn">
                        <input type="button" class="black_btn" id="login_btn" onclick="login()" value="로그인">
                    </div>
                </form>
                <div class="content__wrap">
                    <div class="content__row">
                        <div class="checkbox__label">
                            <input type="checkbox" id="member_id_flg">
                            <label for="member_id_flg"></label>
                            </div>
                        <span class="font__small">이메일 저장</span>
                        <span class="font__underline" style="cursor:pointer;" onclick="location.href='/login/check'">비밀번호 찾기</span>
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title sns__account__login">
                        <div class="font__large text__align__center">SNS 계정으로 로그인하기</div>
                    </div>
                    <div class="content__row sns__account__login">
                        <img class="kakao__btn" src="/images/login/kakao.jpg">
                        <img class="naver__btn" src="/images/login/btnG_icon_square.jpg">
                    </div>
                </div>
                <div class="contour__line"></div>
                <div class="content__wrap">
                    <p class="font__large text__align__center">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
                </div>
            </div>
            <div class="card__footer">
                <input type="button" class="black_btn" onclick="location.href='/login/join'" value="회원가입">
            </div>
            <div class="customer-title">고객서비스</div>
            <div class="customer-btn-box">
                <div class="customer-btn" onclick="location.href='/login/service'"><span>공지사항</span></div>
                <div class="customer-btn" onclick="location.href='/login/faq'"><span>자주 묻는 질문</span></div>
                <div class="customer-btn" onclick="location.href='/login'"><span>문의하기</span></div>
            </div>
        </div>
        
        
        `
        sideBox.appendChild(loginContent);

        $(document).ready(function () {

            $('#member_id').val('');
            var usermember_id = getCookie("usermember_id");
            if (usermember_id) {
                $('#member_id').val(usermember_id);
            } else {
                $('#member_id').val('');
            }

            if ($('#member_id').val() != "") {
                $("input:checkbox[id='member_id_flg']").prop("checked", true);
            }

            $("input:checkbox[id='member_id_flg']").change(function () {
                if ($("input:checkbox[id='member_id_flg']").is(":checked")) {
                    setCookie("usermember_id", $('#member_id').val(), 7);
                }
                else {
                    deleteCookie("usermember_id");
                }
            })

            $('#member_id').keyup(function () {
                if ($('input:checked[id="member_id_flg"]').is(":checked")) {
                    setCookie("usermember_id", $('#member_id').val(), 7);
                }
            })
        });
        $('#member_pw, #member_id').on('keypress', function (e) {
            if (e.keyCode == '13') {
                var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
                var member_id = $('#member_id').val();
                var member_pw = $('#member_pw').val();
                mail_regex.test(member_id);

                $('.font__underline.font__red').text('');
                if (member_id == '') {
                    $('.member_id_msg').text('이메일을 입력해주세요');

                    return false;
                }

                if (!mail_regex.test(member_id)) {
                    $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

                    return false;
                }

                if (member_pw == '') {
                    $('.member_pw_msg').text('비밀번호를 입력해주세요');

                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: "http://116.124.128.246:80/_api/account/login",
                    data: $("#frm-login").serialize(),
                    dataType: "json",
                    error: function () {
                        alert("로그인 처리중 오류가 발생했습니다.");
                    },
                    success: function (d) {
                        if (d.code == "200") {
                            sessionStorage.login_session = "true";
                            location.href = '/main';
                        } else {
                            $('.result_msg').text("로그인정보 재확인 후 다시 시도해주세요.");
                        }
                    }
                });
            }
        })
    }
}


/**
 * @author SIMJAE
 * @param {String} el 필수값(.vplayer) 비디오태그를 감싸고 있는 부모 wrapper
 * @description 비디오 커스텀 컨트롤러
 */
function Vctrbox(el) {
    let videoArr = new Array();
    let elem = document.querySelectorAll(el);
    if (elem === 1) {
        elem = document.querySelector(el);
    } else {
        elem = document.querySelectorAll(el);
    }
    console.log(elem)
    this.el = el;
    this.makeController = (function () {
        elem.forEach((video, idx) => {
            let controllbox = document.createElement("div");
            controllbox.dataset.index = idx;
            controllbox.classList = `vcontroll`;
            controllbox.innerHTML =
                `   
                <ul>
                    <li class="play">Play  ></li>
                    <li class="pause">Pause ||</li>
                </ul>
                <ul>
                    <li class="mute">Mute</li>
                    <li class="full">Full screen</li>
                </ul>
            `
            video.appendChild(controllbox);
            console.log("커스텀 비디오박스 append")
            video.addEventListener("click", function (e) {
                let clickTarget = e.target.classList.value;
                let videoTarget = e.currentTarget.querySelector("video")
                if (clickTarget === "play") {
                    videoTarget.currentTime = 0;
                    videoTarget.play();
                } else if (clickTarget === "pause") {
                    togglePlay(videoTarget);
                } else if (clickTarget === "mute") {
                    updateVolume(videoTarget);
                } else if (clickTarget === "full") {
                    toggleFullScreen(videoTarget)
                }
            });
            function togglePlay(target) {
                if (target.paused || target.ended) {
                    target.play();
                } else {
                    target.pause();
                }
            }

            function updateVolume(target) {
                if (target.muted) {
                    target.muted = false;
                } else {
                    target.muted = true;
                }
            }

            function toggleFullScreen(target) {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else if (document.webkitFullscreenElement) {
                    // Need this to support Safari
                    document.webkitExitFullscreen();
                } else if (target.webkitRequestFullscreen) {
                    // Need this to support Safari
                    target.webkitRequestFullscreen();
                } else {
                    target.requestFullscreen();
                }

            }
            videoArr.push(video);
            return videoArr;
        });
    })();
}