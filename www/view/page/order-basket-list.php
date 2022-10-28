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
        top: 70px;
        z-index: 1;
        background: #ffffff;
        flex-direction: column;
    }
    .sold__list__box {
        background-color: #f9f9f9;
    }
    .sold__list__box .list__header {
        margin-bottom: 14px;
        padding: 10px 5px 0px 5px;
        margin-top: 20px;
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
    
    .product__box .prd__cb {
        position: absolute;
        margin: 5px;
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
        gap: 13px;
        padding: 4px 0;
        flex-grow: 1;
    }
    .product__box .prd__title {
        font-size: 1.2rem;
    }
    .pay__box {
        display: flex;
        width: 35rem;
        height: 97vh;
        position: sticky;
        top: 70px;
        flex-direction: column;
        justify-content: center;
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
</style>
<main>
    <div class="basket__wrap">
        <div class="basket__box">
            <!-- <div class="list__header">
                <div class="icon__box">
                    <img src="/images/svg/basket.svg" alt="">
                    <div>쇼핑백</div>
                </div>
                <div class="checkbox__box">
                    <input class="prd_cb all__cb" type="checkbox" name="basket">
                    <div class="flex gap-10">
                        <u class="ufont">선택 삭제</u>
                        <u class="ufont">모두 삭제</u>
                    </div>            
                </div>
            </div> -->
            <div class="list__box">
                <div class="list__header">
                    <div class="icon__box">
                        <img src="/images/svg/basket.svg" alt="">
                        <div>쇼핑백</div>
                    </div>
                    <div class="checkbox__box">
                        <input class="prd_cb all__cb" type="checkbox" name="stock">
                        <div class="flex gap-10">
                            <u class="ufont st__checked__btn" btn="stock">선택 삭제</u>
                            <u class="ufont st__all__btn" btn="stock">모두 삭제</u>
                        </div>            
                    </div>
                </div>
                <div class="list__body">
                    
                </div>
            </div>
            <div class="dash"></div>
            <div class="pay__box">
                <div class="pay__row">
                    <div>제품합계</div>
                    <div class="product__total__price"></div>
                </div>
                <div class="pay__row">
                    <div>배송비</div>
                    <div class="deli__price">0</div>
                </div>
                <div class="pay__row">
                    <div>총 합계</div>
                    <div class="pay__total__price"></div>
                </div>
                <div class="pay__btn"><span>결제하기</span></div>
                <p class="pay__notiy">품절제품을 삭제 후 결제를 진행해주세요.</p> 
            </div>
        </div>
    </div>
</main>
<script>
    


    window.addEventListener('DOMContentLoaded', function() {
        getBasketProductList();
    });
     //재고상품 선택삭제 버튼
    (function stockCheckedDeleteBtn(){
        const $checkedDelete = document.querySelector(".st__checked__btn");
        $checkedDelete.addEventListener("click", () => {
            console.log("선택삭제");
            const $$checkedSelfBox = document.querySelectorAll(".self__cb:checked");
            $$checkedSelfBox.forEach( el => {
                let basketIdx = el.parentElement.dataset.basketidx;
                el.parentElement.remove();
                deleteBasketProduct(basketIdx);
                let productPrice = getProductListSumPrice();
                payBoxSumPrice(productPrice);
            });
        });
    })();
    //재고상품 전체삭제 버튼
    (function stockAllDeleteBtn(){
        const $checkedDelete = document.querySelector(".st__all__btn");
        $checkedDelete.addEventListener("click", () => {
            let $inputbox = document.querySelectorAll(".self__cb[name='stock']");
            $inputbox.forEach(el => {
                let basketIdx = el.parentNode.dataset.basketidx;
                el.checked = true;
            })
        });
    })();
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
    const putBasketProduct = () => {
        $.ajax({
            type: "post",
            data: {
                "basket_idx":basket_idx,
                "product_idx":product_idx,
                "basket_qty":basket_qty,
                "stock_status":stock_status
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/basket/put",
            error: function() {
                alert("장바구니 상품 정보 수정 처리에 실패했습니다.");
            },
            success: function(d) {
                let code = d.code;
                if (code == 403) {
                    alert(d.msg)
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
                let sold = data[0].basket_so_info;
                let stock = data[0].basket_st_info;
                
                writeProductListDomTree( stock, sold );
            }
        });
    }

    //쇼핑백 리스트 그려주는 함수
    function writeProductListDomTree(stock, sold) {
        let docFrag = document.createDocumentFragment();
        let stockHtml  = ""
        let soldHtml = ""
        let productWrap = document.createElement("div");
        let soldProductWrap = document.createElement("div");
        productWrap.classList.add("product__wrap");
        soldProductWrap.classList.add("sold__list__box");
        
        docFrag.appendChild(productWrap);
        //품절상품이 있을 경우  
        if(sold.length > 0 ){
            docFrag.appendChild(soldProductWrap);
            soldHtml +=
            `<div class="sold__list__box">
                <div class="list__header">
                    <div class="icon__box">
                        <img src="/images/svg/basket.svg" alt="">
                        <div>품절제품</div>
                    </div>
                    <div class="checkbox__box">
                        <input class="prd_cb all__cb" type="checkbox" name="sold">
                        <div class="flex gap-10">
                            <u class="ufont">선택 삭제</u>
                            <u class="ufont">모두 삭제</u>
                        </div>            
                    </div>
                </div>
                <div class="list__body">
                </div>
            </div> `
            soldProductWrap.innerHTML = soldHtml;
        }
        //재고상품 있는 경우 
        else if(stock.length > 0 ) {
            stock.forEach( el => {
                stockHtml += 
                `<div class="product__box" data-basketidx="${el.basket_idx}" data-basketqty="${el.basket_qty}" data-productidx="${el.product_idx}" data-productqty="${el.product_qty}">
                    <input class="prd__cb self__cb" type="checkbox" name="stock">
                    <div class="prd__img" style="background-image:url('http://116.124.128.246:81${el.product_img}') ;"></div>
                    <div class="prd__content">
                        <div class="prd__title">${el.product_name}</div>
                        <div class="prd__price">${el.sales_price}</div>
                        <div class="prd__color">${el.color}</div>
                        <div class="prd__size">
                            <div class="size__box">
                                <li data-soldout="${el.stock_status}">${el.option_name}</li>
                            </div>
                        </div>
                        <div class="prd__qty">
                            <div>Qty</div>
                            <div class="minus__btn">-</div>
                            <input class="count__val" type="text" value="1" readonly>
                            <div class="plus__btn">+</div>
                            <div class="totalPrice stock">${el.sales_price}</div>
                        </div>
                    </div>
                </div>`
            });
            docFrag.querySelector('.product__wrap').innerHTML = stockHtml;
            document.querySelector('.list__box .list__body').appendChild(docFrag);
        }
        //품절도 재고도 없을 경우 
        else {
            console.log("쇼핑백에 상품이 없습니다.");
        }

        (function() {
            const $allCheckBox = document.querySelector(".all__cb"); 
            const $$selfCheckBox = document.querySelectorAll(".self__cb"); 
            const $$productBox = document.querySelectorAll(".product__box"); 
            let getCheckboxName = $allCheckBox.getAttribute("name");
            $allCheckBox.addEventListener("click" , function() {
                allCheckedBox(getCheckboxName);
            });
            $$selfCheckBox.forEach( el => {
                el.addEventListener("change", (e) => {
                    console.log(e.path[1].querySelector(".totalPrice").innerText);
                });
            });
            $$productBox.forEach( el => {
                
            });
            //name 값 별 체크박스 전체선택 
        })();
        setCountBtnEvent();
        let productPrice = getProductListSumPrice();
        payBoxSumPrice(productPrice);
    }
    //체크박스 전체 선택 함수 
    function allCheckedBox(value) {
        document.querySelector("input[name="+value+"]").addEventListener("change", function (e) {
            e.preventDefault();
            let list = document.querySelectorAll("input[name="+value+"]");
            for (var i = 0; i < list.length; i++) {
                list[i].checked = this.checked;
            }
        });
    }
    
    //쇼핑백 상품 수량 이벤트 
    function setCountBtnEvent() {
        let $$minusBtn = document.querySelectorAll(".minus__btn");
        let $$plusBtn = document.querySelectorAll(".plus__btn");
        let $$Cnt = document.querySelectorAll(".count__val")
        //업&다운 버튼 css 초기화 
        $$Cnt.forEach(el => {
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
                let cntVal = this.parentNode.querySelector(".count__val").value;
                let $plusBtn = this.parentNode.querySelector(".plus__btn");

                cntVal = parseInt(cntVal) - 1;
                this.parentNode.querySelector(".count__val").value = cntVal;

                if(cntVal == "1"){
                    this.classList.add('disableBtn');
                }else{
                    $plusBtn.classList.remove('disableBtn');
                }
            });
        });
        //수량 업버튼 클릭 이벤트
        $$plusBtn.forEach(el => {
            el.addEventListener("click", function() {
                let cntVal = this.parentNode.querySelector(".count__val").value;
                let $minusBtn = this.parentNode.querySelector(".minus__btn");
                
                cntVal = parseInt(cntVal) + 1;
                this.parentNode.querySelector(".count__val").value = cntVal;

                if(cntVal == "9"){
                    this.classList.add('disableBtn');
                }else{
                    $minusBtn.classList.remove('disableBtn');
                }
            });
        });
    };
    
    //제품합계 함수
    function getProductListSumPrice(){
        let $$productBox = document.querySelectorAll(".product__box .totalPrice.stock");
        let sumPrice = 0;
        let totalPrice = 0;

        $$productBox.forEach(el => {
            sumPrice += parseInt(el.innerText);
            
        });
        return sumPrice;
    }
    //결제박스 합계 
    function payBoxSumPrice (value){
        let $productTotalText = document.querySelector(".product__total__price");
        let $payTotalText = document.querySelector(".pay__total__price");
        let $deliText = document.querySelector(".deli__price");

        let productPrice = value;//int 
        let deliPrice = parseInt($deliText.innerText); //0
        
        $productTotalText.innerText = productPrice.toLocaleString('ko-KR')
        let totalPrice = (productPrice + deliPrice).toLocaleString('ko-KR');        
        $payTotalText.innerText = totalPrice;
    }
</script>