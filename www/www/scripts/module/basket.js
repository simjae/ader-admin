export function Basket(el, useSidebar) {
    const prototypes = {el,useSidebar}
    prototypes.el = el;
    prototypes.useSidebar = useSidebar;
    let parm = prototypes;
    //슬라이드 사용시 
    if(parm.useSidebar === true){
        this.makeContent = (() => {
            let sideBox = document.querySelector(`.side__box`);
            console.log("🏂 ~ file: sidebar.js:73 ~ Basket ~ sideBox", sideBox)

            let contentHtml = `<section class="basket__wrap">
                <div class="list__box">
                    <div class="list__header">
                        <div class="icon__box">
                            <img src="/images/svg/basket.svg" alt="">
                            <div>쇼핑백</div>
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
                        <div class="deli__price" data-deli="5000">0</div>
                    </div>
                    <div class="pay__row">
                        <div>총 합계</div>
                        <div class="pay__total__price">0</div>
                    </div>
                    <div class="pay__btn"><span>결제하기</span></div>
                    <p class="pay__notiy">품절제품을 삭제 후 결제를 진행해주세요.</p> 
                </div>
            </section>`
            sideBox.innerHTML = contentHtml;
    })();
    }
    //basket 상품 불러옴
    this.loadContent = (() => {
        getBasketProductList();
        function writeProductListDomTree(stock, sold) {
            let docFrag = document.createDocumentFragment();
            let stockHtml  = "";
            let soldHeadHtml = "";
            let productWrap = document.createElement("div");
            productWrap.classList.add("product__wrap");
            let soldProductWrap = document.createElement("div");
            soldProductWrap.classList.add("sold__list__box");
            
            docFrag.appendChild(productWrap);
            //재고상품 있는 경우 
            if(stock.length > 0 ) {
                stock.forEach( el => {
                    let saleprice = (el.sales_price).toLocaleString('ko-KR');
    
                    let product_color = el.color_rgb;
                    let productColorHtml = "";
                    let colorData = product_color;
                    let multi= colorData.split(";");
                    if(multi.length === 2){
                        productColorHtml += `
                        <div class="color__box">
                            <div class="color-title">${el.color}</div>
                            <div class="color-line" data-basketidx="${el.basket_idx}"  style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                            <div class="color multi" data-title="${el.color}"></div>
                            </div>
                        </div>
                    `;
                    } else {
                        productColorHtml += `
                        <div class="color__box">
                            <div class="color-title">${el.color}</div>
                            <div class="color-line" data-basketidx="${el.basket_idx}" data-title="${el.color}" style="--background-color:${multi[0]}" >
                                <div class="color" data-title="${el.color}"></div>
                            </div>
                        </div>
                        `;
                    }
    
    
                    stockHtml += 
                    `<div class="product__box" data-optionidx="${el.option_idx}" data-status="${el.stock_status}"  data-basketidx="${el.basket_idx}" data-basketqty="${el.basket_qty}" data-productidx="${el.product_idx}" data-productqty="${el.product_qty}">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="checkbox" name="stock">
                            <div class="cb__mark"></div>
                        </label>
                        <div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div>
                        <div class="prd__content" data-salesprice="${el.sales_price}" >
                            <div class="prd__title">${el.product_name}</div>
                            <div class="price">${el.sales_price}</div>
                            ${productColorHtml}
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="${el.stock_status}">${el.option_name}</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="${el.basket_qty}" readonly>
                                <div class="plus__btn">+</div>
                                <div class="totalPrice data-stat="${saleprice}" stock">${saleprice}</div>
                            </div>
                        </div>
                    </div>`
                });
                docFrag.querySelector('.product__wrap').innerHTML = stockHtml;
                document.querySelector('.list__box .list__body').appendChild(docFrag);
            } 
            stockCheckedDeleteBtn();
            stockAllDeleteBtn();
            if(sold.length > 0 ){
                //품절상품이 있을 경우  
                let productHtml = "";
                let docFrag = document.createDocumentFragment();
                docFrag.appendChild(soldProductWrap);
                soldHeadHtml +=
                `
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
                `
                soldProductWrap.innerHTML = soldHeadHtml;
    
                sold.forEach( el => {
                    let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
                    let product_color = el.color_rgb;
                    let productColorHtml = "";
                    let colorData = product_color;
                    let multi= colorData.split(";");
                    if(multi.length === 2){
                        productColorHtml += `
                        <div class="color__box">
                            <div class="color-title">${el.color}</div>
                            <div class="color-line" data-basketidx="${el.basket_idx}"  style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                            <div class="color multi" data-soldout="${el.stock_status}" data-title="${el.color}"></div>
                            </div>
                        </div>
                    `;
                    } else {
                        productColorHtml += `
                        <div class="color__box">
                            <div class="color-title">${el.color}</div>
                            <div class="color-line" data-basketidx="${el.basket_idx}" data-title="${el.color}" style="--background-color:${multi[0]}" >
                                <div class="color" data-soldout="${el.stock_status}" data-title="${el.color}"></div>
                            </div>
                        </div>
                        `;
                    }
    
                    let optionColor = el.product_color;
                    let optionColorHtml = "";
                    
                    optionColor.forEach(color => {
                        let optionColorData = color.color_rgb;
                        let optionColorMulti= optionColorData.split(";");
                        if(optionColorMulti.length === 2){
                            optionColorHtml += `
                            <div class="color-line" data-idx="${color.product_idx}"   style="--background:linear-gradient(90deg, ${optionColorMulti[0]} 50%, ${optionColorMulti[1]} 50%);">
                                <div class="color multi"data-title="${color.color}"data-soldout="${color.stock_status}"></div>
                            </div>
                        `;
                        } else {
                            optionColorHtml += `
                                <div class="color-line" data-idx="${color.product_idx}"  style="--background-color:${optionColorMulti[0]}" >
                                    <div class="color"data-title="${color.color}" data-soldout="${color.stock_status}"></div>
                                </div>
                            `;
                        }
                    });    
                    
    
    
                    let reorderText  = el.reorder_flg ? "재입고 알림 신청완료" : "재입고 알림 신청하기";
    
                    productHtml += 
                    `<div class="product__box" data-reflg="${el.reorder_flg}"  data-optionidx="${el.option_idx}" data-status="${el.stock_status}" data-basketidx="${el.basket_idx}" data-basketqty="${el.basket_qty}" data-productidx="${el.product_idx}" data-productqty="${el.product_qty}">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="checkbox" name="sold">
                            <div class="cb__mark"></div>
                        </label>
                        <div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">${el.product_name}</div>
                            ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                            ${productColorHtml}
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
                                <div class="reorder__btn">
                                    <img src="/images/svg/reflesh.svg" alt="">
                                    <u>${reorderText}</u>
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
                                <div class="color__box">${optionColorHtml}</div>
                                <div class="size__box">
                                ${
                                    el.product_size.map((size) => {
                                        return`<li class="option__size" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
                                    }).join("")
                                }
                                </div>
                                <div class="option__change__btn apply">
                                    <img src="/images/svg/edit.svg" alt="">
                                    <u>옵션 변경하기</u>
                                </div>
                            </div>
                        </div>
                    </div>`
                    docFrag.querySelector(".list__body").innerHTML = productHtml;
                });
                document.querySelector('.list__box .list__body').appendChild(docFrag);
                soldCheckBoxEvent();
                soldCheckedDeleteBtn();
                soldAllDeleteBtn();
            }
            inputCheckBoxEvent();
            setCountBtnEvent();
            optionBoxCloseBtn();
            optionChangeBtn();
            optionColorSelect();
            payBtnEvent();
            reorderHandler();
            layoutClick();
            
        }
        const selfCheckbox = (status, checked) => {
            let $$checkedSelfBox = document.querySelectorAll(`.self__cb[name='${status}']${checked ? ":checked":""}`);
            $$checkedSelfBox.forEach( el => {
                let basketIdx = el.parentNode.parentNode.dataset.basketidx;
                el.parentNode.parentNode.remove();
                deleteBasketProduct(basketIdx);
                let getCheckedPrice = checkedProductPrice();
                payBoxSumPrice(getCheckedPrice);
            });
        }
            //재고상품 선택삭제 버튼
        function stockCheckedDeleteBtn(){
            const $checkedDelete = document.querySelector(".st__checked__btn");
            $checkedDelete.addEventListener("click", () => {
                selfCheckbox("stock",true);
            });
        };
        //재고상품 전체삭제 버튼
        function stockAllDeleteBtn(){
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
                    if (code == 200) {
                        alert(d.msg)
                    }
                }
            });
        }
        //수정 api
        const putBasketProduct = (basketIdx, productIdx, basketQty,optionIdx, stockStatus) => {
            $.ajax({
                type: "post",
                data: {
                    "basket_idx":basketIdx,
                    "product_idx":productIdx,
                    "basket_qty":basketQty,
                    "option_idx":optionIdx,
                    "stock_status":stockStatus
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/basket/put",
                error: function() {
                    console.log("장바구니 상품 정보 수정 처리에 실패했습니다.");
                },
                success: function(d) {
                    let code = d.code;
                    if (code == 403) {
                        console.log(d.msg)
                    }
                }
            });
        }
        //가져오기 api
        function getBasketProductList (){
            let country = "KR";
            $.ajax({
                type: "post",
                data: {
                    "country": country
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/basket/list/get",
                error: function() {
                    alert("장바구니 상품 정보불러오기 처리에 실패했습니다.");
                },
                success: function(d) {
                    let data = d.data;
                    let sold = data.basket_so_info;
                    let stock = data.basket_st_info;
                    
                    writeProductListDomTree( stock, sold );
    
                }
            });
        }
        //쇼핑백 리스트 그려주는 함수
        function payBtnEvent() {
            let payBtn = document.querySelector(".pay__box .pay__btn");
            payBtn.addEventListener("click", function() {
                let selfBox = document.querySelectorAll(".self__cb[name='stock']");
                let selectArr =[];
                let country = "KR";
                selfBox.forEach(el => {
                    if(el.checked){
                        selectArr.push(el.parentNode.parentNode.dataset.basketidx);
                    }
                })
                location.href="/order/confirm?country="+country+"&basket_idx=" + selectArr;
            });
        }
        //쇼핑백 상품 수량 init,up,down 이벤트 
        function setCountBtnEvent() {
            let $$minusBtn = document.querySelectorAll(".minus__btn");
            let $$plusBtn = document.querySelectorAll(".plus__btn");
            let $$Cnt = document.querySelectorAll(".count__val");
            let setTotalPrice = 0;
    
            //업&다운 버튼 css 초기화 
            $$Cnt.forEach(el => {
                el.value = 1;
                let salesPrice = el.offsetParent.querySelector(".prd__content").dataset.salesprice;
                el.parentNode.dataset.init = salesPrice;
                let getBasketQty = el.offsetParent.dataset.basketqty;
                let getprice = el.offsetParent.dataset.basketqty;
                let totalPrice = salesPrice * getBasketQty;
                el.parentNode.querySelector(".totalPrice").textContent = totalPrice.toLocaleString('ko-KR');
    
                let cntVal = el.value;
                if(cntVal == "1"){
                    el.parentNode.querySelector(".minus__btn").classList.add('disableBtn');
                }
                if(cntVal == "9"){
                    el.parentNode.querySelector(".plus__btn").classList.add('disableBtn');
                }
            });
            
            //수량 다운버튼 클릭이벤트
            $$minusBtn.forEach(el => {
                el.addEventListener("click", function() {
                    let basketIdx = this.offsetParent.dataset.basketidx;
                    let productIdx = this.offsetParent.dataset.productidx;
                    let basketQty = this.offsetParent.dataset.basketqty;
                    let optionIdx = this.offsetParent.dataset.optionidx;
                    let stockStatus = this.offsetParent.dataset.status;
    
                    let cntVal = this.parentNode.querySelector(".count__val").value;
                    let $plusBtn = this.parentNode.querySelector(".plus__btn");
                    let transferPrice = this.parentNode.querySelector(".totalPrice").textContent.replace(/,/g ,'');
                    let getProductPrice = parseInt(transferPrice);
    
                    cntVal = parseInt(cntVal) - 1;
                    this.parentNode.querySelector(".count__val").value = cntVal;
                    getProductPrice -= parseInt(this.parentNode.dataset.init);
    
                    if(cntVal == "1"){
                        this.classList.add('disableBtn');
                        setTotalPrice = this.parentNode.dataset.init;
                    }else{
                        $plusBtn.classList.remove('disableBtn');
                    }
                    this.parentNode.querySelector(".totalPrice").textContent = getProductPrice.toLocaleString('ko-KR');
                    let getCheckedPrice = checkedProductPrice();
                    payBoxSumPrice(getCheckedPrice);
                    putBasketProduct(basketIdx, productIdx, cntVal ,optionIdx, stockStatus);
                });
            });
            //수량 업버튼 클릭 이벤트
            $$plusBtn.forEach(el => {
                el.addEventListener("click", function() {
                    let basketIdx = this.offsetParent.dataset.basketidx;
                    let productIdx = this.offsetParent.dataset.productidx;
                    let basketQty = this.offsetParent.dataset.basketqty;
                    let stockStatus = this.offsetParent.dataset.status;
                    let optionIdx = this.offsetParent.dataset.optionidx;
    
                    let cntVal = this.parentNode.querySelector(".count__val").value;
                    let $minusBtn = this.parentNode.querySelector(".minus__btn");
                    let transferPrice = this.parentNode.querySelector(".totalPrice").textContent.replace(/,/g , '');
                    let getProductPrice = parseInt(transferPrice);
                    getProductPrice += parseInt(this.parentNode.dataset.init);
                    
                    
                    cntVal = parseInt(cntVal) + 1;
                    this.parentNode.querySelector(".count__val").value = cntVal;
                    this.parentNode.querySelector(".totalPrice").innerText = getProductPrice.toLocaleString('ko-KR');
                    if(cntVal == "9"){
                        this.classList.add('disableBtn');
                    }else{
                        $minusBtn.classList.remove('disableBtn');
                    }
                    let getCheckedPrice = checkedProductPrice();
                    payBoxSumPrice(getCheckedPrice);
                    putBasketProduct(basketIdx, productIdx, cntVal ,optionIdx,stockStatus);
                });
            });
            
        };
        //input 체크박스 클릭(전체, 개별)
        function inputCheckBoxEvent () {
            const $allCheckBox = document.querySelector(".all__cb"); //
            const $$selfCheckBox = document.querySelectorAll(".self__cb"); 
            const $$productBox = document.querySelectorAll(".product__box"); 
            let getCheckboxName = $allCheckBox.getAttribute("name");
            let productPrice = 0;
            //전체 체크박스 클릭시에 
            $allCheckBox.addEventListener("click" , function() {
                let stockList = document.querySelectorAll("input[name='stock']");
                stockList.forEach(el => {
                    el.checked = this.checked;
                });  
                let getCheckedPrice = checkedProductPrice();
                payBoxSumPrice(getCheckedPrice);  
            });
            $$selfCheckBox.forEach( el => {
                el.addEventListener("click", (e) => {
                    let getInputName = e.currentTarget.getAttribute("name");
                    if(getInputName == "stock"){
                        let currentPrice = parseInt(e.path[2].querySelector(".totalPrice").innerText.replace(/,/g , ''));
                        if(e.target.checked){
                            //체크시
                            if(getCheckboxName == "stock") {
                                productPrice += currentPrice;
                            } else if (getCheckboxName == "sold") { 
                                //재고가 없는 체크된 상품 
                            }
    
                        }else {
                            //체크 해제됬을떄
                            productPrice -= currentPrice;
                        }
                        let getCheckedPrice = checkedProductPrice();
                        payBoxSumPrice(getCheckedPrice);
                    }else if(getInputName == "sold") {
    
                    }
                    
                });
            });
        }
        function soldCheckBoxEvent(){
            let $allCheckBox = document.querySelector(".sold__list__box .all__cb[name='sold']"); 
            if($allCheckBox != null){
                $allCheckBox.addEventListener("click" , function() {
                    let soldList = document.querySelectorAll(".sold__list__box .self__cb[name='sold']");
                    soldList.forEach(el => {
                        el.checked = this.checked;
                    });  
                });
            }
        }
        /************************* 공통함수 **************************/
        //선택한 상품만 가격 합산
        function checkedProductPrice() {
            let productPrice = 0;
            let $$checkedInput = document.querySelectorAll(".self__cb[name='stock']:checked");
            $$checkedInput.forEach(el => {
                let checkedPrice = parseInt(el.parentNode.parentNode.querySelector(".totalPrice").innerText.replace(",", ""));
                productPrice += checkedPrice;
            });
            return productPrice;
        }
        //선택한 상품 결제박스 합계 표기
        function payBoxSumPrice (value){
            let $productTotalText = document.querySelector(".product__total__price");
            let $payTotalText = document.querySelector(".pay__total__price");
            let $deliText = document.querySelector(".deli__price");
            
            let productPrice = value;//int 
            let freeDeliPrice = 80000;
            // let deliPrice = parseInt($deliText.innerText);
            let deliPrice = parseInt($deliText.dataset.deli);
            let totalPrice = (productPrice + deliPrice);    
    
            if(totalPrice == deliPrice){
                totalPrice = 0;
            }   
            if(freeDeliPrice <= productPrice) {
                totalPrice -= deliPrice;
                deliPrice = 0;
            }     
            if(totalPrice == 0 ) {
                deliPrice = 0 ;
            }
    
            $productTotalText.textContent = productPrice;
            $deliText.textContent = deliPrice.toLocaleString('ko-KR');
            $payTotalText.textContent = totalPrice.toLocaleString('ko-KR');
        }
        function optionBoxCloseBtn(){
            const $$closeBtn = document.querySelectorAll(".close__btn.option");
            $$closeBtn.forEach(el => {
                el.addEventListener("click", function() {
                    this.offsetParent.querySelectorAll(".color-line").forEach(el => el.classList.remove("select"));
                    this.offsetParent.querySelectorAll(".option__size").forEach(el => el.classList.remove("select"));
                    this.offsetParent.classList.add("hide");
                });
            })
        }
        function optionChangeBtn() {
            const $$optionChangeBtn = document.querySelectorAll(".option__change__btn");
            let $$optionSelectBox = document.querySelectorAll(".option__select__box");
            $$optionChangeBtn.forEach(el => {
                el.addEventListener("click", function(ev) {
                    optionSizeSelect();
    
                    if(this.classList.contains("apply")){
                        let basketValue = this.parentNode.parentNode.parentNode.dataset.basketidx;
                        let colorValue = [...this.parentNode.querySelectorAll(".color-line")].find(el => el.classList.contains("select"));
                        let sizeValue = [...this.parentNode.querySelectorAll(".option__size")].find(el => el.classList.contains("select"));
                        
                        this.offsetParent.classList.add("hide");
                        let optionData = { 
                            country :"KR",
                            stock_status :"STSO",
                            product_idx : colorValue?.dataset.idx,
                            basket_idx : basketValue, 
                            option_idx : sizeValue?.dataset.optionidx
                        }
                        if(optionData.product_idx === undefined || optionData.option_idx === undefined) return;
                        putOptionValue(optionData);
                        console.log("🏂 ~ file: order-basket-list.php:1026 ~ el.addEventListener ~ 옵션객체", optionData)
                        console.log("🏂 ~ file: order-basket-list.php:1025 ~ el.addEventListener ~ 옵션결과 ", JSON.stringify(optionData))
                    } else if(this.classList.contains("open")){
                        $$optionSelectBox.forEach(el => el.classList.add("hide"));
                        this.parentNode.nextElementSibling.classList.remove("hide");
                    }
                });
            });
        }
        function putOptionValue(data) {
            $.ajax({
                type: "post",
                data: data,
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/basket/put",
                error: function() {
                },
                success: function(d) {
                }
            });
        }
        function selectColorGetSize(productIdx) {
            let country = "KR";
            $.ajax({
                type: "post",
                data: {
                    "country": country,
                    "product_idx":productIdx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/basket/get",
                error: function() {
                },
                success: function(d) {
                    let data = d.data.product_size;
                    let sizeResult = data.map(el => `<li class="option__size" data-idx="${el.product_idx}" data-optionidx="${el.option_idx}" data-soldout="${el.stock_status}">${el.option_name}</li>`).join("");
                }
            });
        }
        function optionColorSelect() {
            const $$color = document.querySelectorAll(".option__select__box .color-line");
            $$color.forEach(el => el.addEventListener("click", (ev) => {
                let {idx} = ev.currentTarget.dataset;
                let country = "KR"
    
                $$color.forEach(el => el.classList.remove("select"));
                ev.currentTarget.classList.add("select");
    
                if(ev.currentTarget.classList.contains("select")){
                    $.ajax({
                        type: "post",
                        data: {
                            "country": country,
                            "product_idx":idx
                        },
                        dataType: "json",
                        url: "http://116.124.128.246:80/_api/order/basket/get",
                        error: function() {
                        },
                        success: function(d) {
                            let data = d.data.product_size;
                            let colorName = data[0].color;
                            let sizeResult = data.map(el => `<li class="option__size" data-idx="${el.product_idx}" data-optionidx="${el.option_idx}" data-soldout="${el.stock_status}">${el.option_name}</li>`).join("");
                            ev.target.offsetParent.querySelector(".option__color").innerHTML = colorName;
                            ev.target.offsetParent.querySelector(".size__box").innerHTML = sizeResult;
                            optionSizeSelect();
                        }
                    });
                }
            }));
        }
        function optionSizeSelect() {
            let $$optionSize = document.querySelectorAll(".option__size");
            $$optionSize.forEach(el => {if(el.dataset.soldout == "STSO" ||el.dataset.soldout == "STSC"){el.classList.add("disableBtn")}});
            $$optionSize.forEach(el => el.addEventListener("click", (ev) => {
                let eventTarget = ev.currentTarget;
                let soldout = eventTarget.dataset.soldout;
                $$optionSize.forEach(el => el.classList.remove("select"));
                eventTarget.classList.add("select");
            }));
        }
        function reorderHandler() {
            const $$reorderBtn = document.querySelectorAll(".reorder__btn");
            $$reorderBtn.forEach(el => {
                el.addEventListener("click",(ev) => {
                    let {productidx,basketidx,optionidx,reflg} = ev.currentTarget.offsetParent.dataset;
                    if(reflg == 0){
                        reorderAdd(productidx,basketidx,optionidx);                    
                    }
                });
            });
        }
        function reorderAdd(productIdx,basketIdx,optionIdx){
            let country = "KR";
            let addType = "basket";
            $.ajax({
                type: "post",
                data: {
                    "country": country,
                    "add_type":addType,
                    "product_idx":productIdx,
                    "basket_idx":basketIdx,
                    "option_idx":optionIdx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/reorder/add",
                error: function() {
                },
                success: function(d) {
                    let result = d.data;
                    reorderFlag(productIdx);
                }
            });
    
        }
        function reorderFlag(productIdx) {
            const productBox = [...document.querySelectorAll(".sold__list__box .product__box")].find(el => el.dataset.productidx == productIdx);
            productBox.dataset.reflg = 1;
            productBox.querySelector(".reorder__btn u").innerHTML ="재입고 알림 신청완료";
        }
        function layoutClick () {
            let sideWrap = document.querySelector(".side__wrap");
            let sideBg = document.querySelector(".side__background");
            sideBg.addEventListener("click" ,(e) =>{
                if(e.target == sideBg){
                    document.querySelector("#sidebar").classList.remove("open")
                    document.querySelector(".side__background").classList.remove("open")
                    document.querySelector(".side__wrap").classList.remove("open")
                }
            } )

        }
    })();
}
