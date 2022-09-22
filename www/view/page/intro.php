<style>
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    @import url(//fonts.googleapis.com/earlyaccess/notosanskr.css);

    /* common */

    html {}

    body {
        width: 100%;
        overflow-x: hidden;
    }

    main {
        padding-top: 70px;
    }

    nav li {
        list-style-type: none;
    }

    .btn__wrap {
        font-family: NotoSansCJKkr;
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.46;
        letter-spacing: normal;
        display: flex;
        gap: 30px;
    }

    /* 햄버거 */
    .hamburger .line {
        width: 20px;
        height: 1px;
        background-color: #000;
        display: block;
        margin: 5px 0;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .hamburger:hover {
        cursor: pointer;
    }

    #hamburger.is-active .line:nth-child(2) {
        opacity: 0;
    }

    #hamburger.is-active .line:nth-child(1) {
        -webkit-transform: translateY(6px) rotate(45deg);
        -ms-transform: translateY(6px) rotate(45deg);
        -o-transform: translateY(6px) rotate(45deg);
        transform: translateY(6px) rotate(45deg);
    }

    #hamburger.is-active .line:nth-child(3) {
        -webkit-transform: translateY(-6px) rotate(-45deg);
        -ms-transform: translateY(-6px) rotate(-45deg);
        -o-transform: translateY(-6px) rotate(-45deg);
        transform: translateY(-6px) rotate(-45deg);
    }



    .new__project__swiper .btn__wrap>div::after {
        content: "";
        display: block;
        width: 100%;
        border-bottom: 2px solid #fff;
    }

    .exhibtion__wrap .btn__wrap>div::after {
        content: "";
        display: block;
        width: 100%;
        border-bottom: 2px solid #000;
    }

    .styling-swiper .btn__wrap {
        padding-left: 10px;
    }

    .styling-swiper .btn__wrap>div::after {
        content: "";
        display: block;
        width: 100%;
        border-bottom: 2px solid #000;
    }

    /* notice */
    .notice__marquee {
        display: flex;
        gap: 20px;
        align-items: center;
        justify-content: space-between;
    }

    .notice__wrap {
        font-family: "Noto Sans KR", sans-serif;
        display: flex;
        align-items: center;
        gap: 20px;
        justify-content: space-between;
        padding: 0 10px;
        height: 30px;
        border-bottom-width: 1px;
    }

    .notice__wrap .notice__title {
        font-size: 11px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        letter-spacing: normal;
        color: #000;
    }

    .notice__wrap .notice__a {
        font-size: 11px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.45;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    header {
        z-index: 20;
        background-color: #fff;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
    }



    /* nav */
    #web {
        border-top: solid 1px #dcdcdc;
    }

    #mobile span,
    img {
        cursor: pointer;
    }

    #mobile .side__menu {
        position: absolute;
        overflow: hidden;
        top: 72px;
        /* 노티스 닫으면 top-30px해야함 */
        width: 100%;
        left: -100%;
        height: 100vh;
        background: #Fff;
        padding: 70px 55px 0 55px;
        z-index: 10;
        transform: translate(0, 0);
        transition: transform 300ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    #mobile.menu__on .side__menu {
        transform: translate(100%, 0);
    }

    #mobile .text1 {
        display: flex;
        gap: 24px;
        flex-direction: column;
        font-family: NotoSansCJKkr;
        font-size: 18px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.44;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        padding-bottom: 48px;
    }

    #mobile .text2 {
        display: flex;
        gap: 12px;
        flex-direction: column;
        font-family: NotoSansCJKkr;
        font-size: 17px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.47;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        padding-bottom: 36px;
    }

    #mobile .text3 {
        display: flex;
        gap: 16px;
        flex-direction: column;
        font-family: NotoSansCJKkr;
        font-size: 17px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.47;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    #mobile .text3>li {
        width: 180px;
    }

    .header__logo {
        margin-left: 10px;
    }

    /* 검색화면 */
    .mobile__search {
        display: none;
    }

    .mobile__search .seach__input {
        display: flex;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid #dcdcdc;
        padding: 5px;
        margin-bottom: 27px;
    }

    .mobile__search .seach__input input:focus {
        outline: none;
    }

    .mobile__search .seach__input input::placeholder {
        color: #dcdcdc;
    }

    .mobile__search .recommend__search ul>li {
        padding: 10px 0;
    }

    .mobile__search .recommend__search .recommend__search__title {
        font-family: FuturaLTPro;
        font-size: 15px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.46;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .mobile__search .recommend__search .search__result {
        font-family: NotoSansCJKkr;
        font-size: 13px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.44;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .mobile__search .recommend__prd {
        padding-top: 40px;
    }

    .mobile__search .prd__content {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mobile__search .prd__card {
        width: 100%;
        width: 80px;
    }

    .mobile__search .prd__img__wrap {
        background-color: #fbfbfb;

    }

    .mobile__search .prd__img {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 100px;
        margin: 10px;

    }

    .mobile__search .prd__title {
        text-align: center;
        font-family: FuturaLTPro;
        font-size: 15px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.31;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        margin-bottom: 24px;
    }

    .mobile__search .prd__img__title {
        text-align: center;
        font-family: FuturaLTPro;
        font-size: 13px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.31;
        letter-spacing: normal;
        text-align: center;
        color: #343434;
    }











    /* new project */
    .new__project__img {
        width: 100%;
        height: 615px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .new__project__content {
        color: #fff;
        position: relative;
        top: 70%;
        left: 10px;
    }

    .new__project__swiper {
        overflow-x: auto;
    }

    .new__project__swiper .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        top: 40%;
    }

    .new__project__content .season__title {
        font-family: FuturaLTPro;
        font-size: 15px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.4;
        letter-spacing: normal;
        text-align: left;
    }

    .new__project__content .title {
        font-family: FuturaLTPro;
        font-size: 25px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.4;
        letter-spacing: 0.75px;
        text-align: left;
    }

    /* recommend */
    .recommend-swiper {
        padding-bottom: 80px;
    }

    .recommend-swiper .recommend__prd {
        border-right-width: 0px;
        border-left-width: 1px;
        border-bottom-width: 1px;
        border-left-color: #dcdcdc;
    }

    .for__you__box {
        width: 240px;
        text-align: right;
        padding: 20px;
    }

    .recommend-swiper .recommend__img {
        width: 100%;
        height: 215px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .recommend-swiper .color__chip {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .recommend-swiper .color__chip li {
        list-style-type: none;
        width: 8px;
        height: 8px;
    }

    /* exhibtion */
    .exhibtion__content {
        padding: 10px;
        background-color: #fbfbfb;
    }

    .exhibtion__content .title {
        font-family: NotoSansCJKkr;
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.46;
        letter-spacing: normal;
        text-align: left;
        color: #000;
    }

    .exhibtion__content .season__title {
        font-family: FuturaLTPro;
        font-size: 20px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.45;
        letter-spacing: 0.6px;
        text-align: left;
        color: #343434;
        padding-bottom: 30px;
    }

    .exhibtion__img {
        width: 100%;
        height: 360px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    /* 기획전 상품 */
    .exhibtion__prd__wrap {
        background-color: #fbfbfb;
    }

    .exhibtion__prd__wrap .prd__box {
        display: flex;
        width: 100%;
    }

    .exhibtion__prd__wrap .prd__card {
        flex-grow: 1;
    }

    .exhibtion__prd__wrap .prd__img__wrap {
        width: 100%;
        height: 225px;
        padding: 20px;
    }

    .exhibtion__prd__wrap .prd__img {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 100%;
    }

    .exhibtion__prd__wrap .prd__title {
        text-align: center;
        font-family: FuturaLTPro;
        font-size: 13px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.31;
        letter-spacing: normal;
        text-align: center;
        color: #343434;
        margin-bottom: 24px;
    }

    /* 스타일링 */
    .styling-swiper {
        padding-bottom: 100px;
    }

    .styling-swiper .styling__img {
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 270px;
        width: 100%;
    }

    .styling-swiper .title {
        padding: 20px 0 10px 10px;
        font-family: FuturaLTPro;
        font-size: 20px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.45;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }


    /* footer */
    footer {
        background-color: #191919;

    }

    footer ul>li .drop__down__wrap {
        align-items: center;
        height: 45px;
        display: flex;
        justify-content: space-between;
        color: #fff;

    }

    footer .drop__down__content.about .about {
        font-family: NotoSansCJKkr;
        font-size: 10px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 2.1;
        letter-spacing: 0.25px;
        text-align: left;
    }

    footer .drop__down__content .disclaimer {
        align-items: center;
        display: flex;
        height: 45px;
        border-bottom: 1px solid #464646;
        font-family: NotoSansCJKkr;
        font-size: 10px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #fff;
    }

    footer .drop__down__content .service {
        font-family: NotoSansCJKkr;
        font-size: 10px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 2.1;
        letter-spacing: normal;
        text-align: left;
        color: #fff;
    }

    footer .drop__down__content .info {
        font-family: NotoSansCJKkr;
        font-size: 10px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 2.1;
        letter-spacing: normal;
        text-align: left;
        color: #fff;
    }

    footer .drop__down__content ul>li:last-child {
        border-bottom: 0px;
    }

    footer span {
        padding-left: 10px;
    }

    footer img {
        padding-right: 20px;
    }

    footer .drop__down__wrap {
        border-bottom: solid 1px #fff;

    }

    footer .about {
        font-family: FuturaLTPro;
        font-size: 13px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.31;
        letter-spacing: normal;
        text-align: left;
    }

    footer .last {
        font-family: FuturaLTPro;
        font-size: 13px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.31;
        letter-spacing: normal;
        text-align: left;
    }

    footer [data-dropdown="none"] {
        color: #fff;
        padding: 10px;
        display: none;
    }

    footer [data-dropdown="show"] {
        display: block;
        color: #fff;
        padding: 10px;
    }

    .footer__content {
        font-family: NotoSansCJKkr;
        font-size: 12px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.42;
        letter-spacing: normal;
        text-align: left;
    }

    @media (min-width: 1024px) {
        header {
            max-width: 1920px;
            min-width: 320px;
            margin: 0 auto;
        }

        main {
            max-width: 1920px;
            min-width: 320px;
            margin: 0 auto;
            overflow: hidden;
        }

        .nav__bar {
            display: grid;
            justify-content: space-between;
            grid-template-columns: repeat(16, 120px);
            gap: 10px;
        }

        .exhibtion__wrap {
            display: flex;
        }

        .exhibtion__box {
            width: 50%;
        }

        .exhibtion__box.content {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-left: 80px;
        }
    }
</style>

<body>
    <header data-screen="mobile">
        <div class="notice__wrap">
            <Marquee width="90%">
                <div class="notice__marquee">
                    <div class="notice__title">cs 및 배송 시스템 개편 안내</div>
                    <div class="notice__a"><u>자세히보기</u></div>
                    <div class="notice__svg"><img src="/images/landing/left-arrow.svg" alt=""></div>
                </div>
            </Marquee>
            <div class="notice__close"><img src="/images/landing/close.svg" alt=""></div>
        </div>
        <nav class="flex items-start justify-between h-12 pt-3 lg:mr-12 lg:ml-32">
            <ul class="flex">
                <li class="cursor-pointer header__logo">
                    <img src="/images/landing/logo.png" alt="">
                </li>
                <li class="hidden w-32 cursor-pointer lg:block">베스트</li>
                <li class="hidden w-32 cursor-pointer lg:block">남성</li>
                <li class="hidden w-32 cursor-pointer lg:block">여성 </li>
                <li class="hidden w-32 cursor-pointer lg:block">라이프스타일</li>
                <li class="hidden w-32 cursor-pointer lg:block">콜라보레이션</li>
            </ul>
            <ul class="flex items-center gap-3 pr-4">
                <li class="hidden w-32 cursor-pointer lg:block">스토리</li>
                <li class="hidden w-32 cursor-pointer lg:block">매장보기</li>
                <li class="flex hidden w-16 cursor-pointer "><img src="/images/nav/search.svg" alt=""><span class="pl-1">검색</span></li>
                <li class="hidden w-16 cursor-pointer lg:block">지구</li>
                <li class="flex cursor-pointer "><img src="/images/nav/wishlist.svg" alt=""><span class="pl-1">12</span></li>
                <li class="flex cursor-pointer "><img src="/images/nav/basket.svg" alt=""><span class="pl-1">15</span></li>
                <li class="hidden w-16 cursor-pointer lg:block">
                    <img src="/images/landing/6554.png" alt="">
                </li>
                <li class="hidden w-16 cursor-pointer lg:block">사용자</li>
                <li class="flex cursor-pointer lg:hidden mobileMenu">
                    <div class="hamburger" id="hamburger">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </li>
            </ul>
        </nav>
        <nav class="hidden lg:hidden" id="web">
            <div class="right-0 w-full mt-2 origin-top-right">
                <div class="grid w-full pt-2 pb-4 h-96 gap-x-8" style="grid-template-columns: repeat(15, minmax(0, 1fr));">
                    <div class="col-start-4">
                        <div class="">컬렉션</div>
                    </div>
                    <div>오리진</div>
                    <div>잡화</div>
                </div>
            </div>
        </nav>
        <nav class="lg:hidden" id="mobile">
            <div class="lg:hidden side__menu">
                <div class="mobile__menu">
                    <ul class="text1">
                        <li><span>베스트</span></li>
                        <li><span>남성</span></li>
                        <li><span>여성</span></li>
                        <li><span>라이프스타일</span></li>
                        <li><span>콜라보레이션</span></li>
                    </ul>
                    <ul class="text2">
                        <li><span>스토리</span></li>
                        <li><span>매장찾기</span></li>
                    </ul>
                    <ul class="text3">
                        <li class="flex gap-2 w-7 mobile__search__btn"><img class="w-4" src="/images/nav/search.svg" alt=""><span>검색</span></li>
                        <li class="flex gap-2"><img class="w-4" src="/images/nav/earth.svg" alt=""><span>한국어</span></li>
                        <li class="flex gap-2"><img class="w-4" src="/images/nav/blue-tag.svg" alt=""><img src="/images/nav/mobile-bluemark.svg" alt=""></li>
                        <li class="flex gap-2"><img class="w-4" src="/images/nav/user.svg" alt=""><span>사용자</span></li>
                    </ul>
                </div>
                <div class="mobile__search">
                    <div class="seach__input">
                        <img src="/images/nav/mobile-search.svg" alt="">
                        <input type="text" placeholder="검색어를 입력하세요">
                    </div>
                    <div class="recommend__search">
                        <ul>
                            <li class="recommend__search__title">추천 검색어</li>
                            <li class="search__result">쇼퍼백</li>
                            <li class="search__result">트윈하트로고 티셔츠</li>
                            <li class="search__result">키링</li>
                            <li class="search__result">The new is not new</li>
                            <li class="search__result">버켄스탁 콜라보레이션</li>
                        </ul>
                    </div>
                    <div class="recommend__prd">
                        <div class="prd__title">추천 상품</div>
                        <div class="prd__content">
                            <div class="prd__card">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd2.png');"></div>
                                </div>
                                <p class="prd__img__title">shopper bag</p>
                            </div>
                            <div class="prd__card">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd4.png');"></div>
                                </div>
                                <p class="prd__img__title">shopper bag</p>
                            </div>
                            <div class="prd__card">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__img__title">shopper bag</p>
                            </div>
                            <div class="prd__card">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd3.png');"></div>
                                </div>
                                <p class="prd__img__title">shopper bag</p>
                            </div>
                        </div>




                    </div>

                </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- banner -->
        <section class="new__project__wrap">
            <div class="new__project__swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="new__project__img" style="background-image:url('/images/landing/bg.jpeg') ;">
                            <div class="new__project__content">
                                <div class="season__title">2020 Spring Summer Collection</div>
                                <div class="title">After Blue</div>
                                <div class="btn__wrap">
                                    <div class="read__more">자세히보기</div>
                                    <div class="go__product">제품보러가기</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="new__project__img" style="background-image:url('/images/landing/intro.jpeg') ;"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="new__project__img" style="background-image:url('/images/landing/intro1.jpeg') ;"></div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <!-- recommend -->
        <section class="lg:flex" style="">
            <div class="text-left for__you__box lg:text-right"><u>For you</u><span class="ml-3">></span></div>
            <div class="recommend-swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
                            </div>
                            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
                            <div class="px-2 py-3">
                                <div class="flex justify-between">
                                    <div>tnnn blazer</div>
                                    <div>529.000</div>
                                </div>
                                <div>Gray</div>
                                <div class="flex justify-between">
                                    <div class="color__chip">
                                        <li class="bg-slate-500"></li>
                                        <li class="bg-orange-600"></li>
                                        <li class="bg-emerald-400"></li>
                                    </div>
                                    <div class="flex gap-3">
                                        <div>A1</div>
                                        <div>A2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
                            </div>
                            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
                            <div class="px-2 py-3">
                                <div class="flex justify-between">
                                    <div>tnnn blazer</div>
                                    <div>529.000</div>
                                </div>
                                <div>Gray</div>
                                <div class="flex justify-between">
                                    <div class="color__chip">
                                        <li class="bg-slate-500"></li>
                                        <li class="bg-orange-600"></li>
                                        <li class="bg-emerald-400"></li>
                                    </div>
                                    <div class="flex gap-3">
                                        <div>A1</div>
                                        <div>A2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
                            </div>
                            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
                            <div class="px-2 py-3">
                                <div class="flex justify-between">
                                    <div>tnnn blazer</div>
                                    <div>529.000</div>
                                </div>
                                <div>Gray</div>
                                <div class="flex justify-between">
                                    <div class="color__chip">
                                        <li class="bg-slate-500"></li>
                                        <li class="bg-orange-600"></li>
                                        <li class="bg-emerald-400"></li>
                                    </div>
                                    <div class="flex gap-3">
                                        <div>A1</div>
                                        <div>A2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
                            </div>
                            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
                            <div class="px-2 py-3">
                                <div class="flex justify-between">
                                    <div>tnnn blazer</div>
                                    <div>529.000</div>
                                </div>
                                <div>Gray</div>
                                <div class="flex justify-between">
                                    <div class="color__chip">
                                        <li class="bg-slate-500"></li>
                                        <li class="bg-orange-600"></li>
                                        <li class="bg-emerald-400"></li>
                                    </div>
                                    <div class="flex gap-3">
                                        <div>A1</div>
                                        <div>A2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
                            </div>
                            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
                            <div class="px-2 py-3">
                                <div class="flex justify-between">
                                    <div>tnnn blazer</div>
                                    <div>529.000</div>
                                </div>
                                <div>Gray</div>
                                <div class="flex justify-between">
                                    <div class="color__chip">
                                        <li class="bg-slate-500"></li>
                                        <li class="bg-orange-600"></li>
                                        <li class="bg-emerald-400"></li>
                                    </div>
                                    <div class="flex gap-3">
                                        <div>A1</div>
                                        <div>A2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- exhibtion -->
        <section>
            <div class="exhibtion__wrap">
                <div class="exhibtion__img" style="background-image:url('/images/landing/main.jpeg') ;"></div>
                <div class="exhibtion__content">
                    <div class="title">아더에러 22 SS 컬렉션 2차 드롭</div>
                    <div class="season__title">22S/S 'Self Expression'</div>
                    <div class="btn__wrap">
                        <div>자세히보기</div>
                        <div>제품보러가기</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- exhibtion product -->
        <section>
            <div class="exhibtion__prd__wrap">
                <div class="prd__box">
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                        </div>
                        <p class="prd__title">Standic airpods
                            leather case</p>
                    </div>
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd2.png');"></div>
                        </div>
                        <p class="prd__title">Standic airpods
                            leather case</p>
                    </div>
                </div>
                <div class="prd__box">
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd3.png');"></div>
                        </div>
                        <p class="prd__title">Standic airpods
                            leather case</p>
                    </div>
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd4.png');"></div>
                        </div>
                        <p class="prd__title">Standic airpods
                            leather case</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Styling -->
        <section class="lg:flex" style="">
            <div class="text-left for__you__box lg:text-right"><u>Styling</u><span class="ml-3">></span></div>
            <div class="styling-swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling__img" style="background-image: url('/images/styling/styling4.jpeg');"></div>
                            <p class="title">Metal line</p>
                            <div class="btn__wrap">
                                <div>자세히보기</div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling__img" style="background-image: url('/images/styling/styling3.jpeg');"></div>
                            <p class="title">Exclusive t-shirts edition</p>
                            <div class="btn__wrap">
                                <div>자세히보기</div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling__img" style="background-image: url('/images/styling/styling2.jpeg');"></div>
                            <p class="title">Wide shopper bag</p>
                            <div class="btn__wrap">
                                <div>자세히보기</div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling__img" style="background-image: url('/images/styling/styling4.jpeg');"></div>
                            <p class="title">shopper bag</p>
                            <div class="btn__wrap">
                                <div>자세히보기</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <ul class="">
            <li class="about drop__menu">
                <div class="drop__down__wrap">
                    <span>About ADERERROR</span><img src="/images/nav/plus.svg" alt="">
                </div>
                <div class="drop__down__content" data-dropdown="none">
                    <p class="about">ADERERROR (아더에러)는 2014년 설립되었으며 패션을 기반으로 한 문화 커뮤니케이션 브랜드입니다. ADERERROR는 ‘but near missed things’ 이라는 브랜드 슬로건, 철학을 바탕으로 사람들이 일상에서 쉽게 놓치고 있는 것들을 익숙하지만 낯설고, 새롭게 느낄 수 있도록 표현하는 활동에 집중하고 있으며, 사진, 영상, 공간, 디자인, 예술, 가구 등 문화 콘텐츠를 우리의 방식으로 재편집하여 새로운 문화를 제안합니다. ADER는 모든 영역 간의 커뮤니케이션 디자인하는 것을 브랜드 핵심 가치로서 추구합니다.</p>
                </div>
            </li>
            <li class="footer__content drop__menu">
                <div class="drop__down__wrap">
                    <span>법적 고지사항</span><img src="/images/nav/plus.svg" alt="">
                </div>
                <div class="drop__down__content" data-dropdown="none">
                    <ul>
                        <li class="disclaimer">온라인 스토어 이용가이드</li>
                        <li class="disclaimer">이용 약관</li>
                        <li class="disclaimer">개인정보 처리방침</li>
                    </ul>
                </div>
            </li>
            <li class="footer__content drop__menu">
                <div class="drop__down__wrap">
                    <span>소셜 미디어</span><img src="/images/nav/plus.svg" alt="">
                </div>
                <div class="drop__down__content" data-dropdown="none">
                    <div class="social">
                        <div class="flex ">
                            <img class="m-4" src="/images/footer/wechat.svg" alt="">
                            <img class="m-4" src="/images/footer/facebook.svg" alt="">
                            <img class="m-4" src="/images/footer/instagram.svg" alt="">
                            <img class="m-4" src="/images/footer/youtube.svg" alt="">
                        </div>
                        <div class="flex ">
                            <img class="m-4" src="/images/footer/kakao-ch.svg" alt="">
                            <img class="m-4" src="/images/footer/pinterest.svg" alt="">
                            <img class="m-4" src="/images/footer/vimeo.svg" alt="">
                            <img class="m-4" src="/images/footer/weibo.svg" alt="">
                        </div>
                    </div>
                </div>
            </li>
            <li class="footer__content drop__menu">
                <div class="drop__down__wrap">
                    <span>고객센터</span><img src="/images/nav/plus.svg" alt="">
                </div>
                <div class="drop__down__content" data-dropdown="none">
                    <p class="service">ADER 3F 53, Yeonmujang-gil,</p>
                    <p class="service">Seongdong-gu, Seoul, Korea</p>
                    <p class="service">TEL. 02-792-2232</p>
                    <p class="service">Office hour Mon - Fri AM 10:00 - PM 5:00</p>
                </div>
            </li>
            <li class="footer__content drop__menu">
                <div class="drop__down__wrap">
                    <span>회사정보</span><img src="/images/nav/plus.svg" alt="">
                </div>
                <div class="drop__down__content" data-dropdown="none">
                    <p class="info">Company | ADER</p>
                    <p class="info">Business Name | FIVE SPACE CO.,LTD</p>
                    <p class="info">Business License | 760-87-01757</p>
                    <p class="info">Mail-order License No. | 제 2021-서울성동-01588호</p>
                    <p class="info">CEO | HANN </p>
                    <p class="info">OFFICE | ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea</p>
                </div>
            </li>
            <li class="last">
                <div class="drop__down__wrap">
                    <span>© ADERERROR 2022</span>
                </div>
            </li>
        </ul>

    </footer>
</body>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        mobileMenu();
        webMenu();
        dropMenu();
        hamburger();
        mobileSearch();
    });
    const hamburger = () => {
        let hamburgerBtn = document.querySelector(".hamburger");
        hamburgerBtn.addEventListener("click", (ev) => {
            hamburgerBtn.classList.toggle("is-active");
        });
    }
    const webMenu = () => {
        const navBtn = document.querySelectorAll('.webMenu');
        const web = document.querySelector('#web');
        navBtn.forEach((el) => {
            el.addEventListener('click', (ev) => {
                let slected = event.target.classList.contains('slected');
                console.log(contain);
                if (slected) {
                    ev.target.classList.remove('slected');
                    web.style.display = 'none';
                } else {
                    ev.target.classList.add('slected');
                    web.style.display = 'block';
                }
            });
        });
    }
    const mobileMenu = () => {
        const mobileMenuBtn = document.querySelector('.mobileMenu');
        const mobileSide = document.querySelector('#mobile');
        const hamburgerSvg = "css/images/nav/hamburger.svg";
        const closeSvg = "css/images/landing/close.svg";
        mobileMenuBtn.addEventListener('click', (ev) => {
            mobileSide.classList.toggle('menu__on');
        });
    };
    let newSwiper = new Swiper(".new__project__swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        slidesPerView: 1
    });
    let recommendSwiper = new Swiper(".recommend-swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2.5
            },
            640: {
                slidesPerView: 4.5
            }
        }
    });
    let stylingSwiper = new Swiper(".styling-swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                spaceBetween: 10,
                slidesPerView: 1.5
            },
            640: {
                slidesPerView: 4.5
            }
        }
    });
    let dropMenu = () => {
        const menuBtn = document.querySelectorAll('.drop__menu');
        const miusSvg = "css/images/footer/minus.svg";
        const plusSvg = "css/images/nav/plus.svg";
        menuBtn.forEach((el) => {
            el.addEventListener("click", function(ev) {
                let dropStatus = this.querySelector('.drop__down__content').dataset.dropdown;
                if (dropStatus === "none") {
                    console.log();
                    this.querySelector('.drop__down__wrap img').src = miusSvg;
                    this.querySelector('.drop__down__content').dataset.dropdown = "show";
                } else {
                    this.querySelector('.drop__down__wrap img').src = plusSvg;
                    this.querySelector('.drop__down__content').dataset.dropdown = "none";
                }
            });
        });
    }

    const mobileSearch = () => {
        let mobile = document.querySelector("#mobile");
        let mobileSearchBtn = document.querySelector(".mobile__search__btn");
        let mobileMenuWrap = document.querySelector(".mobile__menu");
        let mobileSearchWrap = document.querySelector(".mobile__search");
        mobileSearchBtn.addEventListener("click", () => {
            mobileMenuWrap.style.display = "none";
            mobileSearchWrap.style.display = "block";
            mobile.classList.add('search');
        });


    }

    function checkMobileDevice() {
        var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
        for (var info in mobileKeyWords) {
            if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
                //mobile
                return true;
            }
        }
        //web
        return false;
    }
</script>