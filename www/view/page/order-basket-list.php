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
        height: 10vh;
        padding-top: 40px;
        position: sticky;
        top: 70px;
        z-index: 10;
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
        top: 0;
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
</style>
<main>
    <div class="basket__wrap">
        <div class="basket__box">
            <div class="list__header">
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
            </div>
            <div class="list__box">
                <div class="list__header">
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
                </div>
                <div class="list__body">
                    <div class="product__box">
                        <input class="prd__cb self__cb" type="checkbox" name="basket">
                        <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">Product name</div>
                            <div class="prd__price">000,000</div>
                            <div class="prd__color">Color</div>
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                                <div class="totalPrice">000,000</div>
                            </div>
                        </div>
                    </div>
                    <div class="product__box">
                        <input class="prd__cb self__cb" type="checkbox" name="basket">
                        <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">Product name</div>
                            <div class="prd__price">000,000</div>
                            <div class="prd__color">색상</div>
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                                <div class="totalPrice">000,000</div>
                            </div>
                        </div>
                    </div>
                    <div class="product__box">
                        <input class="prd__cb self__cb" type="checkbox" name="basket">
                        <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">Product name</div>
                            <div class="prd__price">000,000</div>
                            <div class="prd__color">색상</div>
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                                <div class="totalPrice">000,000</div>
                            </div>
                        </div>
                    </div>
                    <div class="product__box">
                        <input class="prd__cb self__cb" type="checkbox" name="basket">
                        <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">Product name</div>
                            <div class="prd__price">000,000</div>
                            <div class="prd__color">색상</div>
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                                <div class="totalPrice">000,000</div>
                            </div>
                        </div>
                    </div>
                    <div class="product__box">
                        <input class="prd__cb self__cb" type="checkbox" name="basket">
                        <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__content">
                            <div class="prd__title">Product name</div>
                            <div class="prd__price">000,000</div>
                            <div class="prd__color">색상</div>
                            <div class="prd__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="prd__qty">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                                <div class="totalPrice">000,000</div>
                            </div>
                        </div>
                    </div>
                    <div class="sold__list__box">
                        <div class="list__header">
                            <div class="icon__box">
                                <img src="/images/svg/basket.svg" alt="">
                                <div>품절제품</div>
                            </div>
                            <div class="checkbox__box">
                                <input class="prd_cb all__cb" type="checkbox" name="basket">
                                <div class="flex gap-10">
                                    <u class="ufont">선택 삭제</u>
                                    <u class="ufont">모두 삭제</u>
                                </div>            
                            </div>
                        </div>
                        <div class="list__body">
                            <div class="product__box">
                                <input class="prd__cb self__cb" type="checkbox" name="basket">
                                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                                <div class="prd__content">
                                    <div class="prd__title">Product name</div>
                                    <div class="prd__price">000,000</div>
                                    <div class="prd__color">색상</div>
                                    <div class="prd__size">
                                        <div class="size__box">
                                            <li data-soldout="stcl">A1</li>
                                            <li data-soldout="stin">A2</li>
                                            <li data-soldout="STSC">A3</li>
                                            <li data-soldout="STSO">A4</li>
                                        </div>
                                    </div>
                                    <div class="prd__qty">
                                        <div>Qty</div>
                                        <div class="minus__btn">-</div>
                                        <input class="count__val" type="text" value="1" onchange="countChange()">
                                        <div class="plus__btn">+</div>
                                        <div class="totalPrice">000,000</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__box">
                                <input class="prd__cb self__cb" type="checkbox" name="basket">
                                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                                <div class="prd__content">
                                    <div class="prd__title">Product name</div>
                                    <div class="prd__price">000,000</div>
                                    <div class="prd__color">색상</div>
                                    <div class="prd__size">
                                        <div class="size__box">
                                            <li data-soldout="stcl">A1</li>
                                            <li data-soldout="stin">A2</li>
                                            <li data-soldout="STSC">A3</li>
                                            <li data-soldout="STSO">A4</li>
                                        </div>
                                    </div>
                                    <div class="prd__qty">
                                        <div>Qty</div>
                                        <div class="minus__btn">-</div>
                                        <input class="count__val" type="text" value="1" onchange="countChange()">
                                        <div class="plus__btn">+</div>
                                        <div class="totalPrice">000,000</div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__box">
                                <input class="prd__cb self__cb" type="checkbox" name="basket">
                                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                                <div class="prd__content">
                                    <div class="prd__title">Product name</div>
                                    <div class="prd__price">000,000</div>
                                    <div class="prd__color">색상</div>
                                    <div class="prd__size">
                                        <div class="size__box">
                                            <li data-soldout="stcl">A1</li>
                                            <li data-soldout="stin">A2</li>
                                            <li data-soldout="STSC">A3</li>
                                            <li data-soldout="STSO">A4</li>
                                        </div>
                                    </div>
                                    <div class="prd__qty">
                                        <div>Qty</div>
                                        <div class="minus__btn">-</div>
                                        <input class="count__val" type="text" value="1" onchange="countChange()">
                                        <div class="plus__btn">+</div>
                                        <div class="totalPrice">000,000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash"></div>
            <div class="pay__box">
                <div class="pay__row">
                    <div>제품합계</div>
                    <div>2,182,000</div>
                </div>
                <div class="pay__row">
                    <div>배송비</div>
                    <div>0</div>
                </div>
                <div class="pay__row">
                    <div>총 합계</div>
                    <div>2,182,000</div>
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
        // putBasketProduct();
        // deleteBasketProduct();
    });
    const deleteBasketProduct = () => {
        $.ajax({
            type: "post",
            data: {
                "basket_idx":basket_idx
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
                console.log(data);
            }
        });
    }
    (function() {
        const $listBox = document.querySelector(".list__box");
        let height = $listBox.offsetHeight
        document.querySelector(".dash").style.height = height;
    })();

    (function() {
        const $allCheckBox = document.querySelector(".all__cb"); 
        const $selfCheckBox = document.querySelectorAll(".self__cb"); 
        
        $allCheckBox.addEventListener("click" , function() {
            let getName = $allCheckBox.getAttribute("name");
            allSelect(getName)
        });
        
        //체크박스 전체선택 
        function allSelect(value) {
            document.querySelector("input[name="+value+"]").addEventListener("change", function (e) {
                e.preventDefault();
                let list = document.querySelectorAll("input[name="+value+"]");
                
                for (var i = 0; i < list.length; i++) {
                    list[i].checked = this.checked;
                }
            });
        }
        
        function getSelectData() {
            
        }




        
    })();


       
</script>