<style>
    .product__list__wrap{
    }
    .product__body{
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    .product__header{
        border-bottom:1px solid #fbfbfb;
        padding: 20px;
    }
    .product__header .prd__btn__wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product__header .basket__btn__box{
        display: flex;
        gap: 10px;
    }
    .product__list__box {
        grid-column: 3/14;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    .product__list__box .prd__list{
        border-right-width: 0px;
        border-left-width: 1px;
        position: relative;
    }
    .product__list__box[data-grid="4"] .prd__list{
        grid-column: span 4;
    }
    .product__list__box[data-grid="2"] .prd__list:nth-child(odd){
        grid-column: 2 / span 7;
    }
    .product__list__box[data-grid="2"] .prd__list:nth-child(even){
        grid-column : span 7;
    }
    .product__list__box .prd__list:first-child{
        border-left-width: 0px;
    }
    .product__list__box .prd__img{
        width: 100%;
        height: 600px;
        background-color: #fbfbfb;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }
    .product__list__box.grid-cols-2 .prd__list .prd__img{
        background-size: contain;
    }
    .product__list__box .prd__checkBox {
        position: absolute;
        left: 0;
        padding: 10px;
    }
    .product__info__wrap {
        padding: 10px;
    }
    .product__info__1{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product__info__2{
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .product__title {
    font-family: FuturaLTPro;
    font-size: 13px;
    text-align: left;
    color: #343434;
}
.product__price {
    font-family: FuturaLTPro;
    font-size: 12px;
    text-align: left;
    color: #343434;
}
/* 컬러칩 */
.product__color {
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
}
.color__chip{
    display: flex;
    gap: 30px;
    align-items: center;
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
}
.color__chip .color__outline.select {
    padding: 3px;
    outline-style: auto;
    outline-width: 1px;
    outline-color: #7a7a7a;
    border-radius:50%;

}
.color__chip .color {
    width: 0.8rem;
    height: 0.8rem;
    border-radius: 50%;
}

/* 사이즈 */

.product__size {
    display: flex;
    font-family: FuturaLTPro;
    font-size: 11px;
    justify-content: space-between;
    color: #343434;
}
.product__size .size__box {
    display: flex;
    gap: 30px;
    padding-left: 30px;
}
.product__size li {
    list-style: none;
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
}

</style>
<main>
    <section class="product__list__wrap">
        <div class="product__header">
            <h1>
                위시리스트
            </h1>
            <div class="prd__btn__wrap">
                <label class="flex">
                    <input type="checkbox">
                    <u>전체선택</u>
                </label>    
                <div class="basket__btn__box">
                    <u>쇼핑백으로 이동</u>
                    <u>선택삭제</u>
                    <u>모두삭제</u>
                </div>
            </div>
            <div></div>
        </div>
        <div class="product__body">
            <div class="product__list__box" data-grid="4">
                <div class="prd__list">
                    <div class="">
                        <label class="prd__checkBox" for=""><input type="checkbox" name="" id=""></label>
                        <img class="absolute right-0 p-5" src="/images/nav/wishlist.svg" alt="">
                    </div>
                    <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01YG_mdl_1661843858.png') ;"></div>
                    <div class="product__info__wrap">
                        <div class="product__info__1">
                            <div>${index.product_code}</div>
                            <div>529.000</div>
                        </div>
                        <div class="product__info__2">
                            <div class="product__color">gray</div>
                            <div class="color__chip">
                                <div class="color__outline">
                                    <div class="color" style="background-color:slateblue"></div>
                                </div>
                            </div>
                            <div class="product__size">
                                <div class="size__box">
                                    <li>A1</li>
                                    <li>A2</li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>