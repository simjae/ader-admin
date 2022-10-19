<style>
.modal__background{
    position: fixed;
    display: grid;
    grid-template-columns: var(--w-g);
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.8);
}
.modal__wrap{
    background-color: white;
    height: 100vh;
    gap: 10px;
    transform: translateX(0%);
    grid-column: 13/17;
    transition: auto;
}
.basket__img{
    width: 12px;
    height: 12px;
}
.basket__header {
    display: flex;
    padding: 150px 80px 0 10px;
    justify-content: space-between;
    align-content: center;
}
.basket__content{
    padding: 20px 110px 0 10px;
    display: flex;
    gap: 10px;
    max-height: 60vh;
    flex-direction: column;
    overflow-y: auto;
}
.basket__content .prd__img{
    width: 110px;
    height: 120px;
    margin-right: 10px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #fbfbfb;
}
.basket__content .basket__box{
    display: flex;
    align-items: center;
}
.basket__content .basket__box:last-child{
    margin-bottom: 10px;
}
.basket__content .prd__info{
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex-grow: 1;
}
.basket__footer{
    border-top: 1px solid #dcdcdc;
    font-family: NotoSansKR;
    font-size: 13px;
    font-weight: 300;
    padding: 20px 110px 0 130px;
}
.basket__footer .payment__wrap {
    padding-top: 32px;
}
.payment__wrap .purchase__btn{
    background: #000;
    height: 40px;
    text-align: center;
    display: flex;
    justify-content: center;
    color: #fff;
    align-items: center;
}
.payment__wrap .basket__btn{
    background: #fff;
    height: 40px;
    margin-top: 10px;
    text-align: center;
    display: flex;
    justify-content: center;
    color: #000;
    border:1px solid #000;
    align-items: center;
}
</style>



<div id="basket__wrap" class="modal__background">
    <div class="modal__wrap">
        <div class="modal__box">
            <div class="basket__header">
                <div class="flex text-algin">
                    <img class="basket__img" src="/images/svg/basket.svg" alt="">
                    <span>쇼핑백</span>
                </div>
                <div>
                    X
                </div>
            </div>
            <div class="basket__content">
                <div class="basket__box">
                    <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png');"></div>
                    <div class="prd__info">
                        <span class="prd__title">Groce tote bag</span>
                        <span class="prd__price">389,000</span>
                        <div class="flex">
                            <span class="prd__color__name">Multi</span>
                            <div class="prd__color">컬러칩</div>
                        </div>
                        <span class="prd__size">Onesize</span>
                        <div class="flex justify-between text-algin">
                            <div>
                                <span class="prd__qty">Qty</span>
                                <select name="product__qty" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div>
                                [x]
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="basket__footer">
                <div class="calc__wrap">
                    <div class="flex justify-between">
                        <span>배송비</span>
                        <span>0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>합계</span>
                        <span>2,123,123</span>
                    </div>
                </div>
                <div class="payment__wrap">
                    <div class="purchase__btn"><span>결제하기</span></div>
                    <div class="basket__btn">
                        <img class="basket__img" src="/images/svg/basket.svg" alt="">
                        <span>쇼핑백 보러가기</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

   
   
    
    (function getProduct() {
    
    const config = {
        method: "get",
        credentials: 'include'
        
    };
    
    fetch("http://192.168.0.10:5000/product", config)
        .then((response) => response.json())
        .then((data) => {
        function getbasket (data) {
            var div = document.createElement('div');
            var docFrag = document.createDocumentFragment();
            const flag = `
                <div class="basket__box">
                    <div class="prd__img" style="background-image:url('${data.product_img.img_location[0]}');"></div>
                    <div class="prd__info">
                        <span class="prd__title">${data.product_name}</span>
                        <span class="prd__price">${data.sales_price_kr}</span>
                        <div class="flex">
                            <span class="prd__color__name"></span>
                            ${data.map( color => ` <div class="prd__color">${color}</div>`)}
                        </div>
                        ${data.map( product_size => ` <span class="prd__size">${product_size}</span>`)}
                        <div class="flex justify-between text-algin">
                            <div>
                                <span class="prd__qty">Qty</span>
                                <select name="product__qty" id="">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div>
                                [x]
                            </div>
                        </div>
                    </div>
                </div>
                `
                
        }
        

        // DocumentFragment에 div를 추가
        docFrag.appendChild(div);

        // 문자열로부터 DOM 구조를 생성
        docFrag.querySelector('div').innerHTML = flag;
        
        })
        .catch((error) => {
        console.error('실패:', error);
        });

    })();
</script>