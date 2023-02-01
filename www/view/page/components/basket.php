<link rel="stylesheet" href="/css/common/basket.css">
<link rel="stylesheet" href="/css/module/foryou.css">
<style>

main {overflow-x: initial;}

</style>
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
