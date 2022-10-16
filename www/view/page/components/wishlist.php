
<style>
    .wish__box {
        position: fixed;
        bottom: 0;
        right: 0;
        z-index: 10;
        height: 200px;
        background: #fff;
        display: flex;
    }
    .wish__btn__wrap{
        order: 2;
        border: solid 1px #000;
    }
    .wish__wrap {
        order: 1;
        width: 200px;
        border-bottom: solid 1px #000;
        border-top: solid 1px #000;
        border-left: solid 1px #000;
    }
    .wish__btn__wrap .btn__box {
        border-bottom: solid 1px #000;
        padding: 8px 0 9px 8px;
    }
    .wish__btn__wrap .btn__box:last-child {
        border-bottom: solid 0px #000;
    }
    .wish__btn__wrap .btn__box img {
        height: 35px;
    }
    .wish__box .title__box {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 10px;
        font-family: NotoSansKR;
        font-size: 1.2rem;
        color: #343434;
    }
</style>
<div data-modal="wish">
    <div class="wish__box">
        <div class="wish__btn__wrap">
            <div class="btn__box">
                <img src="/images/wish/wish-recent.svg" alt="">
            </div>
            <div class="btn__box">
                <img src="/images/wish/wish-real.svg" alt="">
            </div>
            <div class="btn__box">
                <img src="/images/wish/wish-list.svg" alt="">
            </div>
            <div class="btn__box">
                <img src="/images/wish/wish-faq.svg" alt="">
            </div>
        </div>
        <div class="wish__wrap">
            <div>
                <div class="title__box">
                    <img src="/images/nav/wishlist.svg" alt="" style="width:15px;">
                    <span>위시리스트</span>
                    <div class="flex" onclick="location.href='http://116.124.128.246:80/order/wish'">
                        <img src="" alt="">
                        <span>전체보기</span>
                    </div>
                </div>
            </div>
            <div class="swipe">
            </div>
        </div>
    </div>
</div>

<script>

(()=> {
    window.addEventListener("scroll", function () {
    const SCROLLED_HEIGHT = window.scrollY;
    const WINDOW_HEIGHT = window.innerHeight;
    const DOC_TOTAL_HEIGHT = document.body.offsetHeight;
    const IS_BOTTOM = WINDOW_HEIGHT + SCROLLED_HEIGHT === DOC_TOTAL_HEIGHT;
    const $wishBox = document.querySelector(".wish__box");
    
    
    if (IS_BOTTOM) {
        $wishBox.style.bottom = "200px";
        $wishBox.style.transitionDuration="0.5s";
    }else {
        $wishBox.style.bottom = "0px";
        $wishBox.style.transitionDuration = "0.5s";
    }
    
    });
})()


</script>