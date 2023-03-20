<style>
    #quickview {
        position: absolute;
        transition-duration: 0.3s;
        z-index: 2;
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
        width: 37vw;
        right: 0;

        /* height: 200px; */
        min-height: 202px;

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
        /* quickview_contents height에 종속되지 않기 위함  */
        position: absolute;

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
        
        /*FAQ 클릭시 퀵메뉴영역 아래로 고정*/
        bottom: 0;
    }

    .quickview__content__wrap {
        background-color: #ffffff;
        transform: translateX(500px);
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
    .hidden{display:none}

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
    .common-contents-container.hidden{display:none}
    .chat-box{
        position:relative;
        display: flex;
        justify-content: flex-end;
    }
    .arrow_box {
        position: relative;
        background: #ffffff;
        border: 1px solid #000;
        max-width:310px;
        border-radius:2px;
        padding:15px 20px;
    }
    .arrow_box :after, .arrow_box :before {
        left: 100%;
        top: 50%;
        border: solid ;
        content: "";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }

    .arrow_box :after {
        border-color: rgba(255, 255, 255, 0);
        border-left-color: #ffffff;
        border-width: 10px;
        margin-top: -10px;
    }
    .arrow_box :before {
        border-color: rgba(128, 128, 128, 0);
        border-left-color: #000;
        border-width: 11px;
        margin-top: -11px;
    }
    .common-contents-container p, .common-contents-container span,.common-contents-container input{font-size:11px;}
    .contents-btn{font-size:11px;}
    .quickview__content__wrap .faq-btn-wrap.member .btn{float:right;vertical-align:middle}
    .contents-footer{display:flex;padding:10px;gap:10px;}
    .contents-footer .file-upload-btn{width:60px;height:40px;border:1px solid #000}
    #inquiryTextBox{height:40px;width:100%;border:1px solid #000;padding:10px;outline: none;}
    .contents-footer .submit_btn{width:95px;height:40px;border:1px solid #000;background-color:#191919;color:#fff;}
    .parent-move-link{float:right;text-decoration:underline;cursor:pointer}
    
    .quickview__content__wrap .faq-btn-wrap.admin .contents{margin-bottom:20px}
    .quickview__content__wrap .faq-btn-wrap.admin .question{margin-top:24px;}
    .quickview__content__wrap .faq-btn-wrap.admin .answer{margin-top:16px;}
    .quickview__content__wrap .faq-btn-wrap.member{
        min-height:46px;
        margin-right:10px;
        margin-bottom:22px;
    }
    .quickview__content__wrap.faq.open .all-btn.mobile{display:none;}
    @media (min-width: 1024px){
        .common-contents-container{width:420px;}
        .quickview__content__wrap.open{margin-right:60px;border:1px solid #000;overflow:none}
        .quickview__content__wrap.faq.open{height:100%;min-height:202px;max-height:calc(100vh - 52px);display:flex;flex-direction:column;width:420px;}
        .quickview__content__wrap.faq.open .common-contents-container{flex: 1;overflow-y:auto;overflow-x:hidden;}
        .quickview__content__wrap .faq-btn-wrap.admin{
            width:310px;
            margin-left:27px;
            background-color:#f8f8f8;
            margin-bottom:22px;
            padding:20px
        }
        .quickview__content__wrap .faq-btn-wrap.admin .contents-btn{
            width:270px;
            height:30px;
            border:1px solid #dcdcdc;
            margin-top:10px;
            text-align:center;
            line-height:30px;
            cursor:pointer;
        }
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
            transform: translateY(calc(100vh - 252px));
            border-bottom: 0;
            border-left: 0;
            visibility: hidden;
        }

        .quickview__content__wrap.open {
            height: 110px;
            max-width: 100vw;
            visibility: visible;
            margin-bottom:46px;
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

        .quickview__content__wrap.faq.open{height:100%;min-height:100px;max-height:calc(100vh - 205px);z-index:10;display:flex;flex-direction:column;}
        .quickview__content__wrap.faq.open .common-contents-container{flex: 1;overflow-y:auto;overflow-x:hidden;}
        .quickview__content__wrap .faq-btn-wrap.admin{
            width:calc(100% - 40px);
            background-color:#f8f8f8;
            margin:20px 0 20px 20px;
            padding:20px;
        }
        .quickview__content__wrap .faq-btn-wrap.admin .contents-btn{
            width:100%;
            height:30px;
            padding:0 20px 0 20px;
            border:1px solid #dcdcdc;
            margin-top:10px;
            text-align:center;
            line-height:30px;
            cursor:pointer;
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
            <input type="hidden" id="sel_category_no" value="">
            <input type="hidden" id="sel_category_title" value="">
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
            <div class="common-contents-container hidden">
            </div>
            <div class="contents-footer hidden">
                <input type="hidden" id="inquiry_type" name="inquiry_type">
                <input type="hidden" id="inquiry_title" name="inquiry_title">
                <div class="file-upload-btn">
                    <img src="/images/svg/file_clip_btn.svg" style="width:22px;height:22px;margin:5px auto;margin-left:11px">
                </div>
                <input type="text" id="inquiryTextBox" name="inquiryTextBox">
                
                <button class="submit_btn" onclick="registQuickViewInquiry()">확인</button>
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
    
    function quickViewTimer() {
        setTimeout(function() {
            contentWrap.classList.remove('open');
            swiperContainer.classList.add('close-swiper');
        }, 5000);
    }
    let observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            if(target.value == 'close') {
                setTimeout(function() {
                    contentWrap.classList.remove('open');
                    swiperContainer.classList.add('close-swiper');
                    $('.common-contents-container').html('');
                }, 5000);
            } 
            if(target.value == 'open') {
                contentWrap.classList.add('open');
                swiperContainer.classList.remove('close-swiper');
            }
        })
    })

    let obConfig = {
        attributes: true
    }

    observer.observe(target, obConfig);

    // btnWrap.addEventListener('mouseenter', function() {
    //     target.value = 'open';
    // })
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
        
        let commonContents = document.querySelector('.common-contents-container');
        let contents_footer = document.querySelector('.contents-footer');

        let $contentWrap = document.querySelector(".quickview__content__wrap");
        const whishSwiperWrap = document.querySelector(".quickview-whish-swiper");
        
        $$btnBox.forEach((el) => {
            el.addEventListener("click", function (e) {
                let $currentTarget = e.currentTarget;
                let $target = e.target;
                let targetData = e.currentTarget.dataset.quick;
                let $$allBtn = document.querySelectorAll(".quickview__box .all-btn");
                
                $$allBtn[1].style.display = "flex";
                swiper.style.display="flex";
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
                        $contentWrap.classList.remove('faq');
                        $contentWrap.classList.add("open");
                        commonContents.classList.add('hidden');
                        contents_footer.style.display = 'none';
                        const recentlyViewedStr = localStorage.getItem('recentlyViewed'); 
                        const recentlyViewedArr = JSON.parse(recentlyViewedStr);
                        console.log("🏂 ~ file: quickview.php:610 ~ recentlyViewedArr:", recentlyViewedArr)
                        if (recentlyViewedArr && recentlyViewedArr.length > 0) {
                            const recentObj = recentlyViewedArr.filter(item => typeof(JSON.parse(item)) === 'object');
                            recentWriteSwiperHtml(recentObj);
                        } else {
                            recentWriteSwiperHtml([]);
                        }
                    }
                    if (targetData == "real") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "실시간 인기 제품";
                        $titleBoxImg.src = "/images/svg/wish-real-bk.svg";
                        getPopularProductList();
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.remove('faq');
                        $contentWrap.classList.add("open");
                        commonContents.classList.add('hidden');
                        contents_footer.style.display = 'none';
                    }
                    if (targetData == "list") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "위시리스트";
                        $titleBoxImg.src = "/images/svg/wish-list-bk.svg";
                        getWhishlistProductList();
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.remove('faq');
                        $contentWrap.classList.add("open");
                        commonContents.classList.add('hidden');
                        contents_footer.style.display = 'none';
                    }
                    if (targetData == "faq") {
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "문의하기";
                        $titleBoxImg.src = "/images/svg/wish-faq-bk.svg";
                        e.currentTarget.classList.add("select");
                        $contentWrap.classList.add('faq');
                        $contentWrap.classList.add("open");
                        commonContents.classList.remove('hidden');
                        contents_footer.style.display = 'flex';
                        swiper.classList.add("close-swiper");
                        swiper.style.display="none";
                        $$allBtn[1].style.display = "none";
                        $('.common-contents-container').html('');
                        getFaqCategoryList();
                        contents_footer.style.display = 'none';
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
        let country = getLanguage();
        $.ajax({
            type: "post",
            data: {'country':country },
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
        let country = getLanguage();
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
        let arrowWidth = 30;
        let width = 420;
        if (dataCnt >= 6) {
            width = (420 - arrowWidth) + "px";
        }
        if (dataCnt < 5) {
            width = (375 - arrowWidth) + "px";
        }
        if (dataCnt < 4) {
            width = (290 - arrowWidth) + "px";
        }
        if (dataCnt < 3) {
            width = (200 - arrowWidth) + "px";
        }
        console.log("🏂 ~ file: quickview.php:713 ~ resizeWidth ~ width:", width)
        
        $(".swiper-quick-container .quickview-swiper-wrapper").css('width',width);
    }
    function recentWriteSwiperHtml(data) {
        if(data != null){
            let dataCnt = 0;
            dataCnt = data.length;
            console.log("🏂 ~ file: quickview.php:718 ~ recentWriteSwiperHtml ~ dataCnt:", dataCnt)
            console.log("Object.keys Length : ",Object.keys(data).length);
            const whishDomFlag = document.createDocumentFragment();
            const swiperWrapper = document.createElement("div");
            const swiperWrap = document.querySelector(".quickview-whish-swiper");
            const nextBtn = document.createElement("div");

            if (data.length === 0) {
                let msgDiv = `<div class="wish-msg">최근 본 상품이 비어있습니다.</div>`;
                swiperWrap.innerHTML = msgDiv;
                $('.quickview__content__wrap .all-btn').hide();
            } else {
                // $('.quickview__content__wrap .all-btn').show();
                nextBtn.className = "swiper-button-next";
                swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";
                let slideDiv = "";
                data = Array.from(data).reverse();
                data.forEach((product, idx) => {
                    let data = JSON.parse(product);
                    let { product_idx, product_name, img_main, stock_status } = data;
                    //const domain = img_main.replace(/^(http(s)?:\/\/)?[\d\.]+(:\d+)?/, "");
                    slideDiv += `<div class="swiper-slide" data-productidx="${product_idx}">
                                    <a href="">
                                        <div class="swiper-box"><img src="${img_root}${img_main}" alt="">
                                            <span class="product-name">${product_name}</span>
                                        </div>
                                    </a>
                                </div>`;
                });
                swiperWrapper.innerHTML = slideDiv;
                whishDomFlag.appendChild(swiperWrapper);
                swiperWrap.innerHTML = "";
                swiperWrap.appendChild(whishDomFlag);
                swiperWrap.appendChild(nextBtn);
                resizeWidth(dataCnt);
                let el = ".quickview-whish-swiper";
                // let el = ".swiper-quick-container";
                responsiveQuickSwiper(el);
            }
        }
    }
    function writeSwiperHtml(data) {
        if(data != null){
            let dataCnt = 0;
            dataCnt = data.length;
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
    }
    function writeWishlistSwiperHtml(data) {
        if(data != null){
            let dataCnt = 0;
            dataCnt = data.length;
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
        $('.common-contents-container').html('');
        $contentWrap.classList.remove("open");
        $listBtn.classList.remove("select");
    }

    function getFaqCategoryList(){
        let country = getLanguage();
        $.ajax({
            type: "post",
            data:{ 
                    'country': country,
                    'category_type' : 'FAQ'
                },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/category/get",
            error: function () {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                if(d != null){
                    if(d.data != null && d.data.length > 0){
                        strDiv = `
                            <div class="faq-btn-wrap admin">
                                <div class="contents-header"><p>무엇을 도와드릴까요?</p></div>
                                <div class="contents-body">
                            `;
                        d.data.forEach(function(row){
                            strDiv += `
                                    <div class="contents-btn" onclick="getQuickViewFaqList(${row.idx}, '${row.title}')">${row.title}</div>
                            `;
                        });
                        strDiv += `
                                    <div class="contents-btn" onclick="getInquiryCategory()">직접 문의하기</div>
                                </div>
                            </div>
                        `;
                        $('.quickview__content__wrap .common-contents-container').append(strDiv);

                        let scroll_height = $(".common-contents-container").prop('scrollHeight');
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400);
                        $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                    }
                    else{

                    }
                }
                else{

                }
            }
        });
    }
    function getQuickViewFaqList(category_no, category_title){
        let country = getLanguage();
        
        $('#sel_category_no').val(category_no);
        $('#sel_category_title').val(category_title);

        $.ajax({
            type: "post",
            data:{ 
                    'country': country,
                    'category_no' : category_no
                },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/list/get",
            error: function () {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                if(d != null){
                    if(d.data != null && d.data.length > 0){
                        strDiv = '';
                        strDiv += `
                            <div class="faq-btn-wrap member">
                                <div class="chat-box">
                                    <div class="arrow_box">
                                        <span>${category_title}</span>
                                    </div>		
                                </div>
                            </div>
                            <div class="faq-btn-wrap admin">
                                <div class="contents-header">
                                    <span>${category_title}</span>
                                    <span class="parent-move-link" onclick="getFaqCategoryList()"><상위메뉴보기</span>    
                                </div>
                            </div>
                         `;
                        strDiv += `
                            <div class="faq-btn-wrap admin">
                                <div class="contents-body">
                            `;
                        d.data.forEach(function(row){
                            strDiv += `
                                    <div class="contents-btn" onclick="getFaqContents(${row.idx}, '${row.subcategory}')">${row.subcategory}</div>
                            `;
                        });
                        strDiv += `
                                </div>
                            </div>
                        `;
                        $('.quickview__content__wrap .common-contents-container').append(strDiv);

                        let scroll_height = $(".common-contents-container").prop('scrollHeight');
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400);
                        $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                    }
                    else{

                    }
                }
                else{

                }
            }
        });
    }
    function getFaqContents(faq_idx, subcategory){
        let country = getLanguage();
        
        let prev_category_no = $('#sel_category_no').val();
        let prev_category_tilte = $('#sel_category_title').val();
        $.ajax({
            type: "post",
            data:{ 
                    'country': country,
                    'faq_idx' : faq_idx
                },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/get",
            error: function () {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                if(d != null){
                    if(d.data != null){
                        strDiv = '';
                        strDiv += `
                            <div class="faq-btn-wrap member">
                                <div class="chat-box">
                                    <div class="arrow_box">
                                        <span>${subcategory}</span>
                                    </div>		
                                </div>
                            </div>
                            <div class="faq-btn-wrap admin">
                                <div class="contents-header">
                                    <span>${subcategory}</span>
                                    <span class="parent-move-link" onclick="getQuickViewFaqList(${prev_category_no},'${prev_category_tilte}')"><상위메뉴보기</span> 
                                </div>
                                <div class="contents-body">
                                    <div class="question">
                                        Q. ${d.data.question}
                                    </div>
                                    <div class="answer">
                                        <span>A. </span>${d.data.answer}
                                    </div>
                                </div>
                            </div>

                            <div class="faq-btn-wrap admin">
                                <div class="contents-header">
                                    <p>다른 도움이 더 필요하신가요?</p>
                                </div>
                                <div class="contents-body">
                                    <div class="contents-btn" onclick="getFaqCategoryList()">예</div>
                                    <div class="contents-btn" onclick="quickviewContentClose();">아니요</div>
                                </div>
                            </div>
                        `;
                        $('.quickview__content__wrap .common-contents-container').append(strDiv);

                        let scroll_height = $(".common-contents-container").prop('scrollHeight');
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400);
                        $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                    }
                    else{

                    }
                }
                else{
                }
            }
        });
    }
    function getInquiryCategory(){
        let country = getLanguage();
        
        $.ajax({
            type: "post",
            data:{ 
                    'country': country,
                    'category_type' : 'INQ'
                },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/category/get",
            error: function () {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                if(d != null){
                    if(d.data != null && d.data.length > 0){
                        strDiv = `
                            <div class="faq-btn-wrap member">
                                <div class="chat-box">
                                    <div class="arrow_box">
                                        <span>직접 문의하기</span>
                                    </div>		
                                </div>
                            </div>
                            <div class="faq-btn-wrap admin">
                                <div class="contents-header">
                                    <span>문의유형을 선택해주세요.</span>
                                    <span class="parent-move-link" onclick="getFaqCategoryList()"><상위메뉴보기</span>    
                                </div>
                                <div class="contents-body">
                            `;
                        d.data.forEach(function(row){
                            strDiv += `
                                    <div class="contents-btn" onclick="moveInquiryForm('${row.code_value}','${row.code_name}')">${row.code_name}</div>
                            `;
                        });
                        strDiv += `
                                </div>
                            </div>
                        `;
                        $('.quickview__content__wrap .common-contents-container').append(strDiv);

                        let scroll_height = $(".common-contents-container").prop('scrollHeight');
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400);
                        $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                    }
                    else{

                    }
                }
                else{

                }
            }
        });
    }
    function moveInquiryForm(code_value,code_name){
        let country = getLanguage();
    
        strDiv = `
                <div class="faq-btn-wrap member">
                    <div class="chat-box">
                        <div class="arrow_box">
                            <span>${code_name}</span>
                        </div>		
                    </div>
                </div>
                <div class="faq-btn-wrap admin">
                    <div class="contents-header">
                        <span>문의 내용을 입력해주세요.</span>
                        <span class="parent-move-link" onclick="getFaqCategoryList('${code_name}')"><상위메뉴보기</span>    
                    </div>
                </div>
        `;
        $('.quickview__content__wrap .common-contents-container').append(strDiv);
        $('#inquiry_type').val(code_value);
        $('#inquiry_title').val(code_name);
        let contents_footer = document.querySelector('.contents-footer');
        contents_footer.style.display = "flex";

        let scroll_height = $(".common-contents-container").prop('scrollHeight');
        $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400);
        $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
    }
    function registQuickViewInquiry(){
        let inquiry_type = $('#inquiry_type').val();
        let inquiry_title = $('#inquiry_title').val();
        let inquiryTextBox = $('#inquiryTextBox').val();
        let country = getLanguage();

        if(inquiryTextBox != null && inquiryTextBox.length > 0){
            strDiv = `
                <div class="faq-btn-wrap member">
                    <div class="chat-box">
                        <div class="arrow_box">
                            <span>${inquiryTextBox}</span>
                        </div>		
                    </div>
                </div>
            `;
            $.ajax({
                type: "post",
                data: {
                    'inquiry_type' : inquiry_type,
                    'inquiry_title' : inquiry_title,
                    'inquiryTextBox' :  inquiryTextBox,
                    'country' : country
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/inquiry/add",
                error: function () {
                },
                success: function (d) {
                    if(d != null){
                        if(d.code == 200){
                            strDiv += `
                                <div class="faq-btn-wrap admin">
                                    <div class="contents-header">
                                        <p style="margin-bottom:20px">문의가 등록되었습니다.</p>   
                                    </div>
                                    <div class="contents-body" style="padding-left:6px;">
                                        <p style="margin-bottom:10px;text-indent:-6px;">
                                            ·&nbsp;C/S 운영시간 Mon-Fri AM10:00 - PM5:00
                                        </p>
                                        <p style="margin-bottom:10px;text-indent:-6px;">
                                            ·&nbsp;매월 15일 (공휴일인 경우 직전 영업일)은 당사의 CS 및 배송 시스템 점검일입니다. 보다 나은 서비스를 제공하기 위하여 위 점검일에는 CS 및 배송 업무가 중단됩니다. 고객 여러분들의 양해를 부탁드립니다. 오프라인 스토어는 정상 운영됩니다.
                                        </p>
                                        <p style="margin-bottom:10px;text-indent:-6px;">
                                            ·&nbsp;답변이 완료된 문의내역은 수정이 불가능합니다.
                                        </p>
                                        <div class="contents-btn" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=inquiry_list'">나의 문의내역 보러가기</div>
                                    </div>
                                </div>
                            `; 
                            $('.quickview__content__wrap .common-contents-container').append(strDiv);

                            let scroll_height = $(".common-contents-container").prop('scrollHeight');
                            $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400); 
                            $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                        }
                        else{
                            strDiv += `
                                <div class="faq-btn-wrap admin">
                                    <div class="contents-header">
                                        <p style="margin-bottom:20px">${d.msg}</p>   
                                    </div>
                                    <div class="contents-body">
                                        <div class="contents-btn" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=inquiry_list'">로그인 창으로 이동</div>
                                    </div>
                                </div>
                            `; 
                            $('.quickview__content__wrap .common-contents-container').append(strDiv);

                            let scroll_height = $(".common-contents-container").prop('scrollHeight');
                            $(".quickview__content__wrap.faq.open .common-contents-container").animate({scrollTop : scroll_height}, 400); 
                            $(".quickview__content__wrap.faq.open").animate({scrollTop : scroll_height}, 400);
                        }
                    }
                }
            });
        }
    }
</script>