<style>
    #quickview {
        position: absolute;
        transition-duration: 0.3s;
    }
    
    .remove-btn {
        display: flex;
        position: relative;
        right: 0;
        margin: 10px;
        width: 9px;
    }

    .remove-btn img:nth-of-type(2) {
        position: absolute;
        transform: rotate(90deg);
    }

    .quickview__box {
        position: fixed;
        margin: 0 auto;
        margin-right: 0;
        bottom: 0;
        left: 0;
        max-width: 2560px;
        width: 30vw;
        right: 0;
        z-index: 10;
        /* height: 200px; */
        display: flex;
        justify-content: flex-end;
        overflow: hidden;
    }
    .wish-msg {
        display: flex;
        justify-content: center;
        margin-left: 20px;
    }
    .quickview__box.on {
        position: absolute;
    }

    .quickview__btn__wrap {
        width: 60px;
        order: 2;
        z-index: 20;
        border: solid 1px #000;
        transform: translateX(60px);
        transition: all 0.5s;
        background-color: #ffffff;
    }

    .quickview__btn__wrap.open {
        transform: translateX(0px);
    }

    .quickview__content__wrap {
        background-color: #ffffff;
        transform: translateX(200px);
        transition: all 0.5s;
        order: 1;
        /* display: none; */
        border-bottom: solid 1px #000;
        border-top: solid 1px #000;
        border-left: solid 1px #000;
    }

    .quickview__content__wrap.open {
        height: 202px;
        min-width: 205px;
        max-width: 430px;
        /* display: block; */
        transform: translateX(0px);
        overflow-x: hidden;
        position: relative;
    }

    .swiper-quick-container {
        /* max-width: 400px; */
        min-height: 150px;
        overflow-x: hidden;
        margin-right: 30px;
        margin-left: 10px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .title__box--btn {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .quickview__btn__wrap .btn__box {
        display: flex;
        flex-direction: column;
        width:60px;
        height: 50px;
        border-bottom: solid 1px #000;
        padding: 7px 0 0px 7px;
        justify-content: space-evenly;
    }

    .quickview__btn__wrap .btn__box:last-child {
        border-bottom: solid 0px #000;
    }

    .quickview__btn__wrap .btn__box img {
        width: 13px;
        height: 13px;
    }

    .quickview__btn__wrap .btn__box p {
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

    .btn__box[data-quick="recent"].select img {
        content: url("/images/svg/wish-recent-bk.svg");
    }

    .btn__box[data-quick="real"].select img {
        content: url("/images/svg/wish-real-bk.svg");
    }

    .btn__box[data-quick="list"].select img {
        content: url("/images/svg/wish-list-bk.svg");
    }

    .btn__box[data-quick="faq"].select img {
        content: url("/images/svg/wish-faq-bk.svg");
    }

    .btn__box[data-quick="recent"].select p {
        visibility: visible;
    }

    .btn__box[data-quick="real"].select p {
        visibility: visible;
    }

    .btn__box[data-quick="list"].select p {
        visibility: visible;
    }

    .btn__box[data-quick="faq"].select p {
        visibility: visible;
    }

    .btn__box[data-quick="recent"]:hover img {
        content: url("/images/svg/wish-recent-bk.svg");
    }

    .btn__box[data-quick="real"]:hover img {
        content: url("/images/svg/wish-real-bk.svg");
    }

    .btn__box[data-quick="list"]:hover img {
        content: url("/images/svg/wish-list-bk.svg");
    }

    .btn__box[data-quick="faq"]:hover img {
        content: url("/images/svg/wish-faq-bk.svg");
    }

    .btn__box[data-quick="recent"]:hover p {
        visibility: visible;
    }

    .btn__box[data-quick="real"]:hover p {
        visibility: visible;
    }

    .btn__box[data-quick="list"]:hover p {
        visibility: visible;
    }

    .btn__box[data-quick="faq"]:hover p {
        visibility: visible;
    }

    .quickview__box .title__box {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 7px 10px;
        font-family: NotoSansKR;
        font-size: 1rem;
        color: #343434;
    }

    .title__box img {
        width: 13px;
        height: 13px;
    }

    .all-btn {
        cursor: pointer;
    }

    .all-btn.web {
        color: #000;
        display: flex;
        justify-content: flex-end;
        margin-right: 30px;
    }

    .all-btn.mobile {
        color: #000;
        display: none;
        text-decoration: underline;
    }





    /* 스와이프 css */
    .quickview-whish-swiper .swiper-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .quickview-whish-swiper .swiper-box img {
        background-color: #fbfbfb;
    }

    .quickview-whish-swiper a {
        -ms-user-select: none;
        -moz-user-select: -moz-none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .quickview-whish-swiper .product-name {
        width: 85%;
        display: -webkit-box;
        overflow: hidden;
        word-break: break-word;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

        font-family: var(--ft-no-fu);
        text-align: center;
        color: #343434;
        letter-spacing: 0.25px;
        font-size: 10px;

    }

    .swiper-button-next::after {
        content: url('/images/svg/sort-bottom.svg');
        transform: rotate(270deg);
        left: 5px;
    }

    .quickview-whish-swiper .swiper-slide {
        width: 80px;
    }
    .close-swiper {
        max-width: 0;
    }
    @media (max-width: 1024px) {
        .quickview__btn__wrap .btn__box p {
            visibility: hidden;
            margin: 2px 0 0 1px;
            font-family: FuturaLTPro;
            font-size: 10px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.1;
            text-align: left;
            color: #343434;
        }
        .btn__box .btn_icon_wrap {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }
        .quickview__box {
            position: fixed;
            margin: 0 auto;
            bottom: 0;
            left: 0;
            max-width: 2560px;
            width: 100vw;
            right: 0;
            z-index: 10;
            /* height: 200px; */
            display: flex;
            justify-content: flex-end;
            overflow: hidden;
        }
        .swiper-quick-container {
            min-height: auto;
        }

        .all-btn.web {
            display: none;
        }

        .all-btn.mobile {
            display: block;
        }

        .quickview__box {
            bottom: 0;
            height: auto;
            flex-direction: column;
        }

        .quickview__content__wrap {
            /* visibility: hidden; */
            transform: translateX(0px);
            transform: translateY(50px);
            border-bottom: 0;
            border-left: 0;
            visibility: hidden;
        }

        .quickview__content__wrap.open {
            height: 110px;
            max-width: 100vw;
            visibility: visible;
        }

        .quickview__btn__wrap {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            border: 0;
            border-top: 1px solid #000;
            transform: translateX(0px);
            transform: translateY(60px);
            border-left: 1px solid #808080;
        }

        .quickview__btn__wrap.open {
            transform: translateX(0px);
        }

        .btn__box {
            border-right: 1px solid #808080;
            box-sizing: border-box;
            display: flex;
            flex: auto;
            flex-direction: row !important;
            /* align-items: center; */
            border-bottom: none !important;
            justify-content: flex-start !important;
            margin-left: 10px;
            gap: 5px;
            width: 25%;
        }

        .btn__box p {
            display: none;
        }

        .btn__box.select p {
            display: block;
        }

        .quickview__btn__wrap .btn__box {
            padding: 0;
            height: 45px;
        }

        .quickview__btn__wrap .btn__box p {
            visibility: visible;
        }

        /* swiper css */
        .quickview-whish-swiper .product-name {
            display: none;
        }

        .quickview-whish-swiper .swiper-box img {
            max-height: 55px;
        }
    }
</style>
<div id="quickview" class="hidden">
    <div class="quickview__box">
        <input id="quickview_observer" type="hidden" />
        <div class="quickview__btn__wrap open">
            <div class="btn__box recent__btn" data-quick="recent">
                <div class="btn_icon_wrap recent_view">
                    <img src="/images/svg/wish-recent.svg" alt="">
                    <p>Recently<br>viewed</p>
                </div>
            </div>
            <div class="btn__box real__btn" data-quick="real">
                <div class="btn_icon_wrap">    
                    <img src="/images/svg/wish-real.svg" alt="">
                    <p>Top</p>
                </div>
            </div>
            <div class="btn__box list__btn" data-quick="list">
                <div class="btn_icon_wrap">
                    <img src="/images/svg/wish-list.svg" alt="">
                    <p>Wishlist</p>
                </div>
            </div>
            <div class="btn__box faq__btn" data-quick="faq">
                <div class="btn_icon_wrap">
                    <img src="/images/svg/wish-faq.svg" alt="">
                    <p>Livechat</p>
                </div>
            </div>
        </div>
        <div class="quickview__content__wrap">
            <div class="content-header">
                <div class="title__box">
                    <img src="" alt="">
                    <span></span>
                </div>
                <div class="title__box--btn">
                    <div class="all-btn mobile" onclick="location.href='http://116.124.128.246:80/order/whish'">+ 전체 보기
                    </div>
                    <div id="quickview-close-btn" onclick="quickviewContentClose();" class="remove-btn">
                        <img src="/images/svg/sold-line.svg">
                        <img src="/images/svg/sold-line.svg">
                    </div>
                </div>
            </div>
            <div class="swiper-quick-container">
                <div class="quickview-whish-swiper"></div>
            </div>
            <div class="all-btn web" onclick="location.href='http://116.124.128.246:80/order/whish'">+ 전체 보기</div>
        </div>
    </div>
</div>

<script>
    let target = document.getElementById("quickview_observer");
    let btnWrap = document.querySelector(".quickview__btn__wrap");
    let contentWrap = document.querySelector(".quickview__content__wrap");
    let quickViewWarp = document.querySelector(".quickview__box");
    let swiperContainer = document.querySelector(".swiper-quick-container");
    
    let observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            if(target.value == 'close') {
                setTimeout(function() {
                contentWrap.classList.remove('open');
                swiperContainer.classList.add('close-swiper');
                btnWrap.classList.remove('open');
            }, 30000);
            } else {
                contentWrap.classList.add('open');
                swiperContainer.classList.remove('close-swiper');
                btnWrap.classList.add('open');
            }
        })
    })

    let obConfig = {
        attributes: true
    }

    observer.observe(target, obConfig);

    btnWrap.addEventListener('mouseenter', function() {
        target.value = 'open';
    })
    contentWrap.addEventListener('mouseenter', function() {
        target.value = 'open';
    })
    quickViewWarp.addEventListener('mouseleave', function() {
        target.value = 'close';
    })
    
    let quickviewBreakpoint = window.matchMedia('screen and (min-width:1025px)');//미디어 쿼리 
    let sideQuickSwiper; //스와이퍼 변수
    const webSideQuickSwiperOption = {
        // observer: true,
        // observeParents: true,
        autoHeight:false,
        navigation: {
            nextEl: ".swiper-quick-container .swiper-button-next",
            prevEl: ".swiper-quick-container .swiper-button-prev",
        },
        breakpointsBase: "container",
        grabCursor: true,
        breakpoints: {
            170: {
                spaceBetween: 5,
                slidesPerView: 2
            },
            260: {
                spaceBetween: 5,
                slidesPerView: 3
            },
            345: {
                spaceBetween: 5,
                slidesPerView: 4
            },
            380: {
                spaceBetween: 5,
                slidesPerView: 5.2
            }
        }
    }
    const mobileSideQuickSwiperOption = {
        // observer: true,
        // observeParents: true,
        navigation: {
            nextEl: ".quickview-whish-swiper .swiper-button-next",
            prevEl: ".quickview-whish-swiper .swiper-button-prev",
        },
        autoHeight: true,
        grabCursor: true,
        // slidesPerView: 'auto',
        spaceBetween: 5,
        slidesPerView: 5.2,
        breakpoints: {
            320: {
                spaceBetween: 5,
                slidesPerView: 5.2
            },
            400: {
                spaceBetween: 5,
                slidesPerView: 6.2
            },
            500: {
                spaceBetween: 5,
                slidesPerView: 10
            }

        }
    }
    function initSideQuickSwiper(el, option) {
        if (sideQuickSwiper !== undefined) {
            if (typeof (sideQuickSwiper) == 'object') {
                sideQuickSwiper.destroy();
                sideQuickSwiper = null;
            }
        }
        sideQuickSwiper = new Swiper(el, option);
        return sideQuickSwiper;
    }
    function responsiveQuickSwiper(el) {
        if (quickviewBreakpoint.matches === true) {
            return initSideQuickSwiper(el, webSideQuickSwiperOption);
        } else if (quickviewBreakpoint.matches === false) {
            return initSideQuickSwiper(el, mobileSideQuickSwiperOption);
        }
    };
    function quickClickHandler() {
        let $btnBox = document.querySelector(".btn__box");
        let $btnBoxImg = document.querySelector(".btn__box img");
        let $btnBoxP = document.querySelector(".btn__box p");
        let $$btnBox = document.querySelectorAll(".btn__box");

        let $titleBox = document.querySelector(".title__box");
        let $titleBoxSpan = document.querySelector(".title__box span");
        let $titleBoxImg = document.querySelector(".title__box img");
        let swiper = document.querySelector(".swiper-quick-container");
        
        let $contentWrap = document.querySelector(".quickview__content__wrap");
        const whishSwiperWrap = document.querySelector(".quickview-whish-swiper");
        
        $$btnBox.forEach((el) => {
            el.addEventListener("click", function (e) {
                let $currentTarget = e.currentTarget;
                let $target = e.target;
                let targetData = e.currentTarget.dataset.quick;
                let $$allBtn = document.querySelectorAll(".quickview__box .all-btn");
                
                swiper.classList.remove("close-swiper");

                if (e.currentTarget.classList.contains("select")) {
                    e.currentTarget.classList.remove("select");
                    $contentWrap.classList.remove("open");
                    whishSwiperWrap.innerHTML = "";
                } else {
                    removeSelect();
                    if (targetData == "recent") {
                        // $$allBtn.setAttribute("onclick", "location.href='http://116.124.128.246:80/order/whish'")
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "최근 본 제품";
                        $titleBoxImg.src = "/images/svg/wish-recent-bk.svg";
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.add("open");
                        const recentlyViewedStr = localStorage.getItem('recentlyViewed'); 
                        const recentlyViewedArr = JSON.parse(recentlyViewedStr);
                        console.log("🏂 ~ file: quickview.php:610 ~ recentlyViewedArr:", recentlyViewedArr)
                    }
                    if (targetData == "real") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "실시간 인기 제품";
                        $titleBoxImg.src = "/images/svg/wish-real-bk.svg";
                        getPopularProductList();
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.add("open");
                    }
                    if (targetData == "list") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "위시리스트";
                        $titleBoxImg.src = "/images/svg/wish-list-bk.svg";
                        getWhishlistProductList();
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.add("open");
                    }
                    if (targetData == "faq") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "문의하기";
                        $titleBoxImg.src = "/images/svg/wish-faq-bk.svg";
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.add("open");
                    }
                }
            });
        });

        function removeSelect() {
            $$btnBox.forEach((el) => {
                el.classList.remove("select");
            });
        }

    };
    function getPopularProductList() {
        let country = "KR"
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/popular/get",
            error: function () {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                let data = d.data;
                writeSwiperHtml(data);
            }
        });
    }
    let nowData;
    function getWhishlistProductList() {
        let country = "KR"
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/list/get",
            error: function () {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                let data = d.data;
                if (data != null) {
                    writeWishlistSwiperHtml(data);
                    nowData = data;
                } else {
                    // let quickviewWrap = document.querySelector(".quickview__content__wrap");
                    const whishDomFlag = document.createDocumentFragment();
                    const swiperWrapper = document.createElement("div");
                    const nextBtn = document.createElement("div");
                    nextBtn.className = "swiper-button-next";
                    swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";
                    let quickviewWrap = document.querySelector(".quickview-whish-swiper");
                    let msgDiv = `<div class="wish-msg">위시리스트가 비어있습니다.</div>`;
                    quickviewWrap.innerHTML = msgDiv;
                    whishDomFlag.appendChild(swiperWrapper);
                    quickviewWrap.appendChild(whishDomFlag);
                    quickviewWrap.appendChild(nextBtn);
                }
            }
        });
    }
    function resizeWidth(dataCnt) {
        // const el = document.querySelector(".quickview-whish-swiper .quickview-swiper-wrapper");
        const el = document.querySelector(".swiper-quick-container .quickview-swiper-wrapper");
        let arrowWidth = 30;
        if (dataCnt > 6) {
            el.style.width = (420 - arrowWidth) + "px";
        }
        if (dataCnt < 5) {
            el.style.width = (375 - arrowWidth) + "px";
        }
        if (dataCnt < 4) {
            el.style.width = (290 - arrowWidth) + "px";
        }
        if (dataCnt < 3) {
            el.style.width = (200 - arrowWidth) + "px";
        }
    }
    function writeSwiperHtml(data) {
        let dataCnt = data.length;
        const whishDomFlag = document.createDocumentFragment();
        const swiperWrapper = document.createElement("div");
        const whishSwiperWrap = document.querySelector(".quickview-whish-swiper");
        const nextBtn = document.createElement("div");
        nextBtn.className = "swiper-button-next";
        swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";
        let slideDiv = "";
        data.forEach((product, idx) => {
            let { product_idx, product_name, img_location, product_link } = product;
            slideDiv += `<div class="swiper-slide" data-productidx="${product_idx}">
                            <a href="116.124.128.246:80${product_link}">
                                <div class="swiper-box"><img src="${img_root}${img_location}" alt="">
                                    <span class="product-name">${product_name}</span>
                                </div>
                            </a>
                        </div>`;
        });
        swiperWrapper.innerHTML = slideDiv;
        whishDomFlag.appendChild(swiperWrapper);
        whishSwiperWrap.innerHTML = "";
        whishSwiperWrap.appendChild(whishDomFlag);
        whishSwiperWrap.appendChild(nextBtn);
        resizeWidth(dataCnt);
        let el = ".quickview-whish-swiper";
        // let el = ".swiper-quick-container";
        responsiveQuickSwiper(el);
    }
    function writeWishlistSwiperHtml(data) {
        let dataCnt = data.length;
        const whishDomFlag = document.createDocumentFragment();
        const swiperWrapper = document.createElement("div");
        const whishSwiperWrap = document.querySelector(".quickview-whish-swiper");
        const nextBtn = document.createElement("div");
        nextBtn.className = "swiper-button-next";
        swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";
        let slideDiv = "";
        data.forEach((product, idx) => {
            let { product_idx, product_name, product_img } = product;
            slideDiv += `<div class="swiper-slide" data-productidx="${product_idx}">
                            <a href="116.124.128.246:80/product/detail?product_idx=${product_idx}">
                                <div class="swiper-box"><img src="${img_root}${product_img}" alt="">
                                    <span class="product-name">${product_name}</span>
                                </div>
                            </a>
                        </div>`;
        });
        
        swiperWrapper.innerHTML = slideDiv;
        whishDomFlag.appendChild(swiperWrapper);
        whishSwiperWrap.innerHTML = "";
        whishSwiperWrap.appendChild(whishDomFlag);
        whishSwiperWrap.appendChild(nextBtn);
        resizeWidth(dataCnt);
        let el = ".quickview-whish-swiper";
        // let el = ".swiper-quick-container";
        responsiveQuickSwiper(el);

    }



    window.addEventListener('resize', function () {
        let delay = 500;
        let timer = null;
        clearTimeout(timer);
        timer = setTimeout(function () {
            let breakpoint = window.matchMedia('screen and (min-width:1025px)');
            let el = ".swiper-quick-container";
            if(nowData != null) {
                writeWishlistSwiperHtml(nowData);
            }
        }, delay);
    });
    window.addEventListener('DOMContentLoaded', function () {
        // elemScrollFooterUpEvent(".quickview__box");
        quickClickHandler();
    });
    function quickviewContentClose() {
        let $contentWrap = document.querySelector("#quickview .quickview__content__wrap");
        let $listBtn = document.querySelector("#quickview .btn__box.list__btn");
        let $quickviewSwiper = document.querySelector("#quickview .quickview-whish-swiper");
        $quickviewSwiper.innerHTML = "";
        $contentWrap.classList.remove("open");
        $listBtn.classList.remove("select");
    }

</script>