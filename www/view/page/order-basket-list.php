<style>
    main {
        overflow: visible;
    }
    .basket__wrap{
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        font-family: NotoSansCJKKR;
        font-size: 1.1rem;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        margin-bottom: 200px;
    }
    .basket__box{
        display: flex;
        flex-wrap: wrap;
        grid-column: 4 / 14;
        justify-content: space-between;
    }
    .ufont{
        font-weight: 400;
    }
    .dash{
        grid-column: 9 / 10;
        border-left: 1px solid #dcdcdc;
        margin: auto 0;
        min-height: 200px;
        height: 200px;
    }
    .list__box {
        grid-column: 4 / 8;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: auto 0;
        min-height: 200px;
        gap: 14px;
        width: 47rem;
    }
    .list__header {
        width: 100%;
        display: flex;
        height: 120px;
        padding-top: 40px;
        position: sticky;
        top: 50px;
        z-index: 1;
        background: #ffffff;
        flex-direction: column;
        border-bottom: 1px solid #dcdcdc;
    }
    .sold__list__box {
        background-color: #f9f9f9;
    }
    .sold__list__box .list__header {
        margin-bottom: 14px;
        padding: 10px 16px 0px 5px;
        margin-top: 20px;
        height: auto;
        background-color: #f9f9f9;
        z-index: 0;
        position: static;
    }
    .list__header .icon__box {
        display: flex;
        gap: 5px;
        align-items: center;
        padding-bottom: 30px;
    }
    .list__header .checkbox__box{
        display: flex;
        padding: 0 5px;
        justify-content: space-between;
        align-items: center;
    }
    .sold__list__box .list__header .checkbox__box{
        display: flex;
        padding: 10px 5px;
        justify-content: space-between;
        align-items: center;
    }
    .list__body {
    }
    .list__body .product__box {
        display: flex;
        position: relative;
        gap: 10px;
        height: 100%;
        width: 100%;
        padding: 14px 0;
        border-top: 1px solid #dcdcdc;
        font-family: FuturaLTPro;
    }
    .list__body .product__box:first-child {
        border-top: 0px;
        padding-top: 0px;
    }
    

    .product__box .prd__img {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-color: #f9f9f9;
        width: 110px;
        height: 140px;
    }
    .product__box .prd__content {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 4px 0;
        flex-grow: 1;
    }
    .product__box .prd__title {
        font-size: 1.2rem;
    }
    .pay__box {
        display: flex;
        height: 97vh;
        position: sticky;
        top: 70px;
        flex-direction: column;
        justify-content: center;
        grid-column: 11 / 14;
    }
    .pay__row {
        display: flex;
        justify-content: space-between;
        padding-bottom: 30px;
    }
    .pay__row:nth-child(2){
        margin-bottom: 30px;
        border-bottom:1px solid #dcdcdc;
    }
    .pay__btn {
        background-color: #000;
        display: flex;
        justify-content: center;
        padding: 10px 20px;
        color: #fff;
        margin-bottom: 10px;
    }
    
    .prd__size .size__box {
        display: flex;
        gap: 30px;
        list-style: none;
        align-items: flex-end;
    }
    .prd__qty {
        display: flex;
        gap: 30px;
        justify-content: right;
    }
    .prd__qty .count__val {
        width: 10px;
        text-align: center;
    }
    .prd__qty .minus__btn {
        cursor: pointer;
    }
    .prd__qty .plus__btn {
        cursor: pointer;
    }
    .count__val:focus{
    outline: none;
    }
    .disableBtn {
        pointer-events: none;
        opacity: 0.4;
    }
    .option__box{
        display: flex;
        justify-content: right;
        align-items: center;
        gap: 30px;
        padding-right: 24px;
    }
    .option__change__btn {
        display: flex;
        gap: 5px;
    }
    .reorder__btn {
        display: flex;
        gap: 5px;
    }
    .option__select__head {
        display: flex;
        justify-content: space-between;
    }
    .option__select__box {
        font-family: FuturaLTPro;
        font-size: 1.1rem;
        color: #343434;
        padding: 10px 10px 4px 16px;
        width: 60%;
        height: 65%;
        right: 20px;
        bottom: 10px;
        background-color: #fff;
        position: absolute;
        border: solid 1px #343434;
    }
    .option__select__box.hide {
        display: none;
    }
    .option__size__box {
        display: flex;
        list-style: none;
        gap: 20px;
        padding-bottom: 20px;
    }

    .color__chip{
        display: flex;
        gap: 30px;
        align-items: center;
        font-family: FuturaLTPro;
        font-size: 11px;
        text-align: left;
        color: #343434;
        padding-bottom: 20px;
    }
    .color__chip .color__outline.select {
        padding: 3px;
        outline-style: auto;
        outline-width: 1px;
        outline-color: #7a7a7a;
        border-radius:50%;
        
    }
    .color__chip .color__outline {
        display: flex;
        gap: 30px;
        padding-left: 4px;
    }
    .color__chip .color {
        width: 0.8rem;
        height: 0.8rem;
        border-radius: 50%;
    }

    /*체크박스 공통 */
    .product__box .prd__cb {
        position: absolute;
        margin: 5px;
        opacity: 0;
    }
    .cb__custom.self{
        position: absolute;
    }
    .sold__list__box .cb__custom.self{
        position: absolute;
        padding: 5px;
    }
    .cb__custom .all__cb {
        opacity: 0;
        position: absolute;
    }
    .cb__custom.self .cb__mark{
        margin: 5px;
    }
    .cb__mark {
        height: 13px;
        width: 13px;
        border-radius: 2px;
        background-color: #fff;
        border: 1px solid #343434;
    }
    .cb__mark:after {
        content: "";
        display: none;
    }

    .cb__custom input:checked ~ .cb__mark:after {
        display: block;
    }
    .cb__custom .cb__mark::after {
        width: 100%;
        height: 100%;
        background-color: #000;
        border: 1px solid #343434;
    }

    @media (max-width: 1025px) {
        .basket__wrap{
            display: flex;
            flex-direction: column;
            margin-bottom: 100px;
        }
        .list__box {
            width: 100%;
            padding: 0 10px;
        }
        .list__header{
            top: 42px;
            height: 80px;
            padding-top: 10px;
        }
        .pay__box{
            height: auto;
            padding: 20px 10px 0 10px;
            bottom: 0;
            background-color: #ffffff;
        }
        .pay__row{
            padding-bottom: 10px;
        }
        .pay__row:nth-child(2) {
            margin-bottom: 10px;
        }
    }
</style>
<link rel="stylesheet" href="/css/module/foryou.css">
<main>
    <section class="basket__wrap">
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
    </section>
    <section class="recommend-wrap"></section>
</main>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        getBasketProductList();
    });
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
    (function stockCheckedDeleteBtn(){
        const $checkedDelete = document.querySelector(".st__checked__btn");
        $checkedDelete.addEventListener("click", () => {
            selfCheckbox("stock",true);
        });
    })();
    //재고상품 전체삭제 버튼
    (function stockAllDeleteBtn(){
        const $checkedDelete = document.querySelector(".st__all__btn");
        $checkedDelete.addEventListener("click", () => {
            selfCheckbox("stock",false);
        });
    })();
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
    const getBasketProductList = () => {
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
                    <div class="color-line" data-idx="${color.product_idx}"  style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                        <div class="color multi" data-title="${color.color}"></div>
                    </div>
                `;
                } else {
                    productColorHtml += `
                        <div class="color-line" data-idx="${color.product_idx}" data-title="${color.color}" style="--background-color:${multi[0]}" >
                            <div class="color" data-title="${color.color}"></div>
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
                        <div class="prd__price">${el.sales_price}</div>
                        ${productColorHtml}
                        <div class="color__chip">
                            <div class="color__outline">
                                <div class="color"style="background-color:${el.color_rgb}"></div>
                            </div>
                        </div>
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
        if(sold.length > 0 ){
            //품절상품이 있을 경우  
            let productHtml = "";
            let docFrag = document.createDocumentFragment();
            docFrag.appendChild(soldProductWrap);
            soldHeadHtml +=
            `<div class="sold__list__box">
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
            </div>`
            soldProductWrap.innerHTML = soldHeadHtml;

            sold.forEach( el => {
                productHtml += 
                `<div class="product__box" data-optionidx="${el.option_idx}" data-status="${el.stock_status}" data-basketidx="${el.basket_idx}" data-basketqty="${el.basket_qty}" data-productidx="${el.product_idx}" data-productqty="${el.product_qty}">
                    <label class="cb__custom self" for="">
                        <input class="prd__cb self__cb" type="checkbox" name="sold">
                        <div class="cb__mark"></div>
                    </label>
                    <div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div>
                    <div class="prd__content">
                        <div class="prd__title">${el.product_name}</div>
                        <div class="prd__price">${el.sales_price}</div>
                        <div class="color__chip">
                            <div class="color__outline">
                                <div class="color"style="background-color:${el.color_rgb}"></div>
                            </div>
                        </div>
                        <div class="prd__size">
                            <div class="size__box">
                                <li data-soldout="${el.sold_status}">${el.option_name}</li>
                            </div>
                        </div>
                        <div class="option__box">
                            <div class="option__change__btn open">
                                <img src="/images/svg/edit.svg" alt="">
                                <u>옵션 변경하기</u>
                            </div>
                            <div class="reorder__btn">
                                <img src="/images/svg/reflesh.svg" alt="">
                                <u>재입고 알림 신청하기</u>
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
                            <div class="color__chip">
                                <div class="color__outline">
                                ${
                                    el.product_color.map((color) => {
                                        return `<div class="color" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
                                    }).join("")
                                }
                                </div>
                            </div>
                            <div class="option__size__box">
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
        }
        soldCheckBoxEvent();
        inputCheckBoxEvent();
        setCountBtnEvent();
        optionBoxCloseBtn();
        optionChangeBtn();
        soldCheckedDeleteBtn();
        soldAllDeleteBtn();
        payBtnEvent();
    }
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
            let salesPrice = el.offsetParent.querySelector(".prd__content").dataset.salesprice;
            el.parentNode.dataset.init = salesPrice;
            let getBasketQty = el.offsetParent.dataset.basketqty;
            let getprice = el.offsetParent.dataset.basketqty;
            let totalPrice = salesPrice * getBasketQty;
            el.parentNode.querySelector(".totalPrice").textContent = totalPrice.toLocaleString('ko-KR');

            cntVal = el.value;
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
        $allCheckBox.addEventListener("click" , function() {
            let soldList = document.querySelectorAll(".sold__list__box .self__cb[name='sold']");
            soldList.forEach(el => {
                el.checked = this.checked;
            });  
        });
    }
    /************************* 공통함수 **************************/
    //선택한 상품만 가격 합산
    function    checkedProductPrice() {
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
                this.offsetParent.classList.add("hide");
            })
        })
    }
    function optionChangeBtn() {
        const $$optionChangeBtn = document.querySelectorAll(".option__change__btn");
        $$optionChangeBtn.forEach(el => {
            el.addEventListener("click", function(e) {
                if(this.classList.contains("apply")){
                    this.offsetParent.classList.add("hide");
                } else if(this.classList.contains("open")){
                    this.parentNode.nextElementSibling.classList.remove("hide");
                }
            });
        });
    }
</script>
<script type="module">
    import ForyouRender  from '/scripts/module/foryou.js';
    const foryou = new ForyouRender();
    foryou.makeHtml();
    foryou.load();
    foryou.swiper();
</script>