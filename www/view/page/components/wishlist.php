
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
        width: 60px;
        order: 2;
        border: solid 1px #000;
    }
    .wish__content__wrap {
        order: 1;
        width: 200px;
        display: none;
        border-bottom: solid 1px #000;
        border-top: solid 1px #000;
        border-left: solid 1px #000;
    }
    .wish__content__wrap.open {
        display: block;
    }
    .wish__btn__wrap .btn__box {
        display: flex;
        flex-direction: column;
        height: 50px;
        border-bottom: solid 1px #000;
        padding: 7px 0 0px 7px;
        justify-content: space-evenly;
    }
    .wish__btn__wrap .btn__box:last-child {
        border-bottom: solid 0px #000;
    }
    .wish__btn__wrap .btn__box img {
        width: 13px;
        height: 13px;
    }
    .wish__btn__wrap .btn__box p {
        visibility: hidden;
        margin: 4px 0 0 1px;
        font-family: FuturaLTPro;
        font-size: 10px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.1;
        text-align: left;
        color: #343434;
    }
    .btn__box[data-quick="recent"].select img{
        content:url("/images/svg/wish-recent-bk.svg");
    }
    .btn__box[data-quick="real"].select img{
        content:url("/images/svg/wish-real-bk.svg");
    }
    .btn__box[data-quick="list"].select img{
        content:url("/images/svg/wish-list-bk.svg");
    }
    .btn__box[data-quick="faq"].select img{
        content:url("/images/svg/wish-faq-bk.svg");
    }
    .btn__box[data-quick="recent"].select p{
        visibility: visible;    
    }
    .btn__box[data-quick="real"].select p{
        visibility: visible;
    }
    .btn__box[data-quick="list"].select p{
        visibility: visible;
    }
    .btn__box[data-quick="faq"].select p{
        visibility: visible;
    }
    .btn__box[data-quick="recent"]:hover img{
    content:url("/images/svg/wish-recent-bk.svg");
    }
    .btn__box[data-quick="real"]:hover img{
        content:url("/images/svg/wish-real-bk.svg");
    }
    .btn__box[data-quick="list"]:hover img{
        content:url("/images/svg/wish-list-bk.svg");
    }
    .btn__box[data-quick="faq"]:hover img{
        content:url("/images/svg/wish-faq-bk.svg");
    }
    .btn__box[data-quick="recent"]:hover p{
        visibility: visible;    
    }
    .btn__box[data-quick="real"]:hover p{
        visibility: visible;
    }
    .btn__box[data-quick="list"]:hover p{
        visibility: visible;
    }
    .btn__box[data-quick="faq"]:hover p{
        visibility: visible;
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
    .title__box img{
        width: 13px;
        height: 13px;
    }
    
</style>
<div data-modal="wish">
    <div class="wish__box">
        <div class="wish__btn__wrap">
            <div class="btn__box recent__btn" data-quick="recent">
                <img src="/images/svg/wish-recent.svg" alt="">
                <p>Recently<br>viewed</p>
            </div>
            <div class="btn__box real__btn" data-quick="real">
                <img src="/images/svg/wish-real.svg" alt="">
                <p>Top</p>
            </div>
            <div class="btn__box list__btn" data-quick="list">
                <img src="/images/svg/wish-list.svg" alt="">
                <p>Wishlist</p>
            </div>
            <div class="btn__box faq__btn" data-quick="faq">
                <img src="/images/svg/wish-faq.svg" alt="">
                <p>Livechat</p>
            </div>
        </div>
        <div class="wish__content__wrap">
            <div class="title__box">
                <img src="" alt="">
                <span></span>
            </div>    
            <div class="swipe__box"></div>
            <div class="flex" onclick="location.href='http://116.124.128.246:80/order/wish'">
                <img src="" alt="">
                <span>전체보기</span>
            </div>
        </div>
    </div>
</div>

<script>

// (() => {
//     window.addeventlistener("scroll", function() {
//         const scrolledHeight = window.scrolly;
//         const windowHeight = window.innerheight;
//         const docTotalHeight = document.body.offsetheight;
//         const isBottom = windowHeight + scrolledHeight === docTotalHeight;
//         const $wishbox = document.queryselector(".wish__box");

//         if (isBottom) {
//             $wishbox.style.bottom = "200px";
//             $wishbox.style.transitionduration="0.5s";
//         }else {
//             $wishbox.style.bottom = "0px";
//             $wishbox.style.transitionduration = "0.5s";
//         }
//     });
// })();
(() => {
    let $btnBox = document.querySelector(".btn__box");
    let $btnBoxImg = document.querySelector(".btn__box img");
    let $btnBoxP = document.querySelector(".btn__box p");
    let $$btnBox = document.querySelectorAll(".btn__box");

    let $titleBox = document.querySelector(".title__box");
    let $titleBoxSpan = document.querySelector(".title__box span");
    let $titleBoxImg = document.querySelector(".title__box img");
    
    let $contentWrap = document.querySelector(".wish__content__wrap");

    $$btnBox.forEach((el) =>  {
        el.addEventListener("click" , function(e) {
            let $currentTarget = e.currentTarget;
            let $target = e.target;
            let targetData = e.currentTarget.dataset.quick;
            if(e.currentTarget.classList.contains("select")) {
                    e.currentTarget.classList.remove("select");
                    $contentWrap.classList.remove("open");
            }else {
                removeSelect();
                if(targetData == "recent") {
                    $titleBoxSpan.innerText= "최근 본 제품";
                    $titleBoxImg.src = "/images/svg/wish-recent-bk.svg";
                    e.currentTarget.classList.add("select");
                    $contentWrap.classList.add("open");
                }
                if(targetData == "real") {
                    $titleBoxSpan.innerText= "실시간 인기 제품";
                    $titleBoxImg.src = "/images/svg/wish-real-bk.svg";
                    e.currentTarget.classList.add("select");
                    $contentWrap.classList.add("open");
                }
                if(targetData == "list") {
                    $titleBoxSpan.innerText= "위시리스트";
                    $titleBoxImg.src = "/images/svg/wish-list-bk.svg";
                    e.currentTarget.classList.add("select");
                    $contentWrap.classList.add("open");
                }
                if(targetData == "faq") {
                    $titleBoxSpan.innerText= "문의하기";
                    $titleBoxImg.src = "/images/svg/wish-faq-bk.svg";
                    e.currentTarget.classList.add("select");
                    $contentWrap.classList.add("open");
                }
            }
        });
    });
    function removeSelect() {
        $$btnBox.forEach((el) =>  {
            el.classList.remove("select");
        });
    }
})();


</script>