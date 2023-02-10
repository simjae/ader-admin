<style>
    main {
        padding-top: 0px;
    }

    header {
        color: var(--wh);
        background-color: RGBA(255, 255, 255, 0);
        border-bottom: 0px;
        transition: background 0.3s;
    }

    header .logo {
        content: url("/images/svg/logo.svg");
    }

    header .search-svg {
        content: url("/images/svg/search-wh.svg");
    }

    header .earth-svg {
        content: url("/images/svg/earth-wh.svg");
    }

    header .alg__c {
        color: #FFF;
    }

    header .wishlist-svg {
        content: url("/images/svg/wishlist-wh.svg");
    }

    header .basket-svg {
        content: url("/images/svg/basket-wh.svg");
    }

    header .bluemark-svg {
        content: url("/images/svg/bluemark-wh.svg");
    }

    header .user-svg {
        content: url("/images/svg/user-wh.svg");
    }

    header .header__grid {
        color: var(--wh);
    }
	body.sidebar_open header,
	body.m_menu_open header,
    header.hover, header.scroll {
        background-color: #fff;
        color: var(--bk);
        border-bottom: 1px solid #eeeeee;
        transition: background 0.3s;
    }
	body.sidebar_open header .logo,
	body.m_menu_open header .logo,
	body.sidebar_open header .logo,
    header.hover .logo, header.scroll .logo {
        content: url("/images/svg/logo-bk.svg");
    }
	body.sidebar_open header .search-svg,
	body.m_menu_open header .search-svg,
    header.hover .search-svg, header.scroll .search-svg {
        content: url("/images/svg/search-bk.svg");
    }
	body.sidebar_open header .earth-svg,
	body.m_menu_open header .earth-svg,
    header.hover .earth-svg, header.scroll .earth-svg {
        content: url("/images/svg/earth-bk.svg");
    }
	body.sidebar_open header .alg__c,
	body.m_menu_open header .alg__c,
	header.hover .alg__c, header.scroll .alg__c {
		color: #000;
	}
	body.sidebar_open header .wishlist-svg,
	body.m_menu_open header .wishlist-svg,
    header.hover .wishlist-svg,
    header.scroll .wishlist-svg {
        content: url("/images/svg/wishlist-bk-line.svg");
    }
	
	body.sidebar_open header .wishlist__btn.open .wishlist-svg,
	body.m_menu_open header .wishlist__btn.open .wishlist-svg,
	header .wishlist__btn.open .wishlist-svg {
		margin-top: 28px;
		content: url("/images/svg/wishlist-wh-fill.svg");
	}
	body.sidebar_open header .wishlist__btn.open .wishlist-svg,
	body.m_menu_open header .wishlist__btn.open .wishlist-svg,
	header.hover .wishlist__btn.open .wishlist-svg,
	header.scroll .wishlist__btn.open .wishlist-svg {
		margin-top: 28px;
		content: url("/images/svg/wishlist-fill.svg");
	}
	body.sidebar_open header .basket-svg,
	body.m_menu_open header .basket-svg,
    header.hover .basket-svg, header.scroll .basket-svg {
        content: url("/images/svg/basket-bk.svg");
    }
	body.sidebar_open header .bluemark-svg,
	body.m_menu_open header .bluemark-svg,
    header.hover .bluemark-svg, header.scroll .bluemark-svg {
        content: url("/images/svg/bluemark-bk.svg");
    }
	body.sidebar_open header .user-svg,
	body.m_menu_open header .user-svg,
    header.hover .user-svg, header.scroll .user-svg {
        content: url("/images/svg/user-bk.svg");
    }
	body.sidebar_open header .header__grid,
	body.m_menu_open header .header__grid,
    header.hover .header__grid, header.scroll .header__grid {
        color: var(--bk);
    }
	body.sidebar_open header .hamburger .line,
	body.m_menu_open header .hamburger .line,
    header.hover .hamburger .line, header.scroll .hamburger .line {
        background-color: var(--bk);
    }

    .header__wrap {
        color: var(--wh);
        background-color: transparent;
    }

    .hamburger .line {
        background-color: var(--wh);
    }

    .btn__wrap {
        font-family: var(--no);
        font-size: 13px;
        font-weight: normal;
        line-height: 1.46;
        letter-spacing: normal;
        display: flex;
    }

    .swiper-wrapper {
        height: auto;
    }

    /* new project */
    .new__project__wrap {
        position: relative;
    }

    .new__project__wrap img {
        width: 100%;
    }

    .new__project__img {
        width: 100%;
        height: 900px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .new__project__content {
        color: #fff;
        position: absolute;
        bottom: 0;
        width: 100%;
        /* top: calc(100% - 24%); */
        padding-bottom: 110px;
    }

    .new__project__content .cnt-box {
        position: relative;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }

    .new__project__swiper {
        overflow-x: hidden;
        position: relative;
    }

    .swiper-button-next,
    .swiper-button-prev {
        z-index: 9;
    }

    .new__project__swiper .swiper-button-next,
    .swiper-button-prev {
        top: 82%;
        color: #fff;
    }

    .new__project__swiper .swiper-button-next {
        right: 2%;
    }

    .new__project__swiper .swiper-button-prev {
        left: 2%;
    }

    .new__project__content .season__title {
        grid-column: 2 / 17;
        font-family: var(--ft-fu);
        font-size: 13px;
        font-weight: normal;
        line-height: 1.4;
        letter-spacing: normal;
        text-align: left;
    }

    .new__project__content .title {
        grid-column: 2 / 17;
        padding-bottom: 25px;
        font-family: var(--ft-fu);
        font-size: 20px;
        font-weight: normal;
        line-height: 1.4;
        letter-spacing: 0.75px;
        text-align: left;
    }

    .new__project__swiper .btn__wrap {
        grid-column: 2 / 17;
        gap: 65px;
    }

    /* .new__project__swiper .btn__wrap > div::after{
        content: "";
        display: block;
        width: 100%;
        border-bottom: 2px solid #fff;
    } */

    /* exhibtion */
    .exhibtion__wrap {
        display: flex;
        width: 100%;
    }

    .exhibtion__wrap>div {
        width: 50%;
    }

    .exhibtion__content {
        order: 1;
        display: flex;
        background-color: #ffffff;
        align-items: flex-end;
    }

    .exhibtion__wrap:hover .exhibtion__content {
        background-color: #fbfbfb;
    }

    .exhibtion__img {
        order: 2;
        width: 50%;
    }

    .ex__box {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(8, 1fr);
    }

    .exhibtion__content .title {
        grid-column: 2/ 9;
        font-family: var(--no);
        font-size: 12px;
        font-weight: normal;
        line-height: 1.46;
        letter-spacing: normal;
        text-align: left;
        color: #000;
    }

    .exhibtion__content .title .fu-font {
        font-family: var(--ft-fu);
    }

    .exhibtion__content .season__title {
        grid-column: 2/ 9;
        font-family: var(--ft-fu);
        font-size: 2rem;
        font-weight: normal;
        line-height: 1.45;
        letter-spacing: 0.6px;
        text-align: left;
        color: var(--bk);
        padding-bottom: 23px;
    }

    .exhibtion__content .btn__wrap {
        grid-column: 2/ 9;
        font-family: var(--ft-fu);
        font-size: 1.2rem;
        font-weight: normal;
        line-height: 1.45;
        text-align: left;
        color: var(--bk);
        padding-bottom: 106px;
        gap: 65px;
    }





    /* 스타일링 */
    .styling-wrap {
        position: relative;
    }

    .styling-text {
        padding: 0 0 20px 10px;
        font-family: var(--ft-fu);
        font-size: 13px;
        font-weight: normal;
        line-height: normal;
        letter-spacing: 0.4px;
        text-align: left;
        color: var(--bk);
    }

    .styling-text span {
        margin-right: 15px;
        text-decoration: underline;
    }

    .styling-swiper {
        position: relative;
        width: 100%;
        margin-bottom: 200px;
    }

    .styling-swiper .styling__img {
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        height: auto;
        width: 100%;
    }

    .styling-swiper .btn__wrap {
        padding-left: 0px;
    }

    .styling-swiper .btn__wrap>div::after {
        content: "";
        display: block;
        width: 100%;
        border-bottom: 2px solid #000;
    }

    .styling-swiper .title {
        padding: 0px;
        font-family: var(--ft-fu);
        font-size: 16px;
        font-weight: normal;
        line-height: 1.45;
        letter-spacing: normal;
        text-align: left;
        color: var(--bk);
    }

    .styling-swiper .t-box {
        padding-left: calc(100% - 80%);
        padding-bottom: 30px;
        padding-top: 25px;
    }

    .styling-swiper .under-line {
        font-size: 13px;
    }

    /* recommand */
    .recommand-wrap {
        padding-bottom: 170px;
    }

    .re-swiper {
        position: relative;
        display: block;
    }

    .re-swiper .swiper-slide:hover {
        background-color: #FBFBFB;
    }

    .slide-box {
        box-sizing: border-box;
        position: relative;
    }

    .slide-box .slide__title {
        text-align: center;
        position: absolute;
        font-family: var(--ft-fu);
        font-size: 13px;
        color: var(--bk);
        font-weight: 500;
        left: 50%;
        top: 91.5%;
        transform: translate(-50%, -50%);
    }

    .slide-box .center-box {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    .foryou-wrap {
        display: block;
        padding-bottom: 200px;
        position: relative;
    }

    .foryou-wrap .foryou-text {
        position: static;
        /* padding: 18px 0 0 15px; */
        padding: 0 0 20px 10px;
        z-index: 10;
        font-family: var(--ft-fu);
        font-size: 13px;
        font-weight: normal;
        letter-spacing: 0.33px;
        color: var(--bk);
    }

    .foryou-wrap .foryou-text span {
        margin-right: 15px;
        text-decoration: underline;
    }

    .foryou-wrap .foryou-swiper {
        position: relative;
    }

    .foryou-wrap .wish__btn {
        position: absolute;
        right: 0;
        padding: 22px;
    }

    .foryou-wrap .swiper-slide {
        border-top: solid 1px #dcdcdc;
        border-bottom: solid 1px #dcdcdc;
    }

    .foryou-wrap .swiper-slide:not(:last-child) {
        border-inline-end: solid 1px #dcdcdc;
    }

    .foryou-wrap img {
        width: 100%;
        background-color: #fbfbfb;
    }

    .foryou-wrap .prd-title {
        height: 40px;
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--ft-fu);
        font-size: 12px;
        font-weight: 400;
        line-height: 1.33;
        text-align: center;
        color: var(--bk);
    }

    .foryou-wrap .whish_img {
        width: 15px;
        height: 12.5px;
    }

    /* 스와이프 네비게이션 */
    .new__project__swiper .navigation .swiper-button-next {
        width: 13px;
        content: url("/images/svg/sw-ar-wh.svg");
        right: 3%;
        bottom: 0;
        top: auto;
        color: var(--bk);
        height: 25px;
        margin-bottom: 162px;
    }

    .new__project__swiper .navigation .swiper-button-prev {
        width: 13px;
        content: url("/images/svg/sw-ar-wh.svg");
        transform: rotate(180deg);
        left: 3%;
        bottom: 0;
        top: auto;
        color: var(--bk);
        height: 25px;
        margin-bottom: 162px;
    }

    .re-swiper .navigation .swiper-button-next {
        width: 1.2rem;
        content: url('/images/svg/sw-ar-bk.svg');
        top: calc(100% - 50%);
        right: 2%;
        color: var(--bk);
    }

    .re-swiper .navigation .swiper-button-prev {
        display: none;
        content: url('/images/svg/sw-ar-bk.svg');
        transform: rotate(180deg);
        top: calc(100% - 50%);
        color: var(--bk);
    }

    .styling-swiper .navigation .swiper-button-next {

        top: auto;
        height: 110px;
        right: 0;
        bottom: 0;
        color: var(--bk);
        background-color: var(--wh);
    }

    .styling-swiper .navigation .swiper-button-next::after {
        visibility: visible;
        content: url('/images/svg/sw-ar-bk.svg');
        transform: rotate(0deg);
        position: relative;
    }

    .styling-swiper .navigation .swiper-button-prev {

        transform: rotate(180deg);
        left: 0;
        top: auto;
        bottom: 0;
        color: var(--bk);
    }

    .styling-swiper .navigation .swiper-button-prev::after {
        visibility: visible;
        content: url('/images/svg/sw-ar-bk.svg');
        position: relative;
    }

    .foryou-swiper .navigation .swiper-button-next {
        content: url('/images/svg/sw-ar-bk.svg');
        top: calc(100% - 50%);
        right: 2%;
        color: var(--bk);
        width: 12px;
    }

    .foryou-swiper .navigation .swiper-button-prev {
        display: none;
        content: url('/images/svg/sw-ar-bk.svg');
        transform: rotate(180deg);
        top: calc(100% - 50%);
        color: var(--bk);
    }

    .foryou-wrap .swiper-slide:first-child {
        border-left: 1px solid #dcdcdc;
    }

    .swiper-button-prev.swiper-button-disabled {
        opacity: 0;
    }

    /* .styling-swiper .swiper-button-prev.swiper-button-disabled {
    } */
    .recommand-mobile {
        display: none;
    }

    .recommand-mobile .slide-box.half {
        display: flex;
        width: 100%;
        justify-content: center;
    }

    .recommand-mobile .slide-box.half .center-box {
        width: 50%;
    }

    @media (max-width: 1441px) {
        .new__project__content .cnt-box {
            grid-template-columns: repeat(14, 1fr);
        }

        .ex__box {
            grid-template-columns: repeat(7, 1fr);
        }
    }

    @media (max-width: 1025px) {

        .under-line.bk::after {
            background-color: var(--bk);
        }

        .under-line.wh::after {
            background-color: #ffffff;
        }

        .new__project__content {
            /* top: calc(100% - 18%); */
            top: auto;
            padding-bottom: 50px;
        }

        .new__project__content .cnt-box {
            padding-left: 10px;
        }

        .new__project__content .season__title {
            grid-column: 1 / 17;
            font-family: var(--ft-fu);
            font-size: 1.2rem;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.33;
            letter-spacing: 0.3px;
            text-align: left;
            color: #fff;
        }

        .new__project__content .title {
            grid-column: 1 / 17;
            padding-bottom: 30px;
            font-family: var(--ft-fu);
            font-size: 1.6rem;
            font-weight: 500;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.38;
            letter-spacing: 0.4px;
            text-align: left;
            color: #fff;
        }

        .new__project__swiper .btn__wrap {
            grid-column: 1 / 17;
            gap: 35px;
        }

        .new__project__swiper img {
            height: 180vmin;
            object-fit: cover;
        }

        .new__project__img {
            max-height: 675px;
        }

        .new__project__swiper .navigation {
            display: none;
        }

        .recommand-wrap .navigation {
            display: none;
        }

        .exhibtion__wrap {
            flex-direction: column;
        }

        .exhibtion__wrap>div {
            width: 100%;
        }

        .exhibtion__content {
            order: 2;
            padding: 10px;
            background-color: #fbfbfb;
        }

        .exhibtion__img {
            order: 1;
            margin-top: 100px;
            width: 100%;
        }

        .exhibtion__content .title {
            grid-column: 1 / 9;
            font-family: var(--ft-no);
            font-size: 1.2rem;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.42;
            letter-spacing: normal;
            text-align: left;
            color: #000;
        }

        .exhibtion__content .season__title {
            grid-column: 1 / 9;
            font-family: var(--ft-fu);
            padding-bottom: 30px;
            font-weight: 500;
            font-size: 1.6rem;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.38;
            letter-spacing: 0.4px;
            text-align: left;
            color: var(--bk);
        }

        .exhibtion__content .btn__wrap {
            padding-bottom: 15px;
            grid-column: 1 / 9;
            font-size: 1.2rem;
            gap: 35px;
        }

        .recommand-wrap {
            padding-bottom: 120px;
        }

        .recommand-mobile {
            display: flex;
            flex-wrap: wrap;
            background-color: #fbfbfb;
            padding-bottom: 50px;
        }

        .recommand-mobile .title {
            display: flex;
            margin: 20px auto;
            width: 50%;
            font-family: var(--ft-fu);
            font-size: 1.2rem;
            font-weight: 500;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.31;
            letter-spacing: normal;
            text-align: center;
            color: var(--bk);
            justify-content: center;
        }

        .recommand-mobile a {
            width: 50%;
        }

        .re-swiper {
            background-color: #fbfbfb;
            padding-bottom: 50px;
            display: none;
        }

        .re-swiper .swiper-wrapper {
            flex-wrap: wrap;
        }

        .re-swiper .swiper-slide {
            width: 50% !important;
            margin-right: 0px !important;
            height: 80vmin;
        }

        .slide-box .slide__title {
            top: 115%;
            font-family: var(--ft-fu);
            font-size: 1.3rem;
            font-weight: 500;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.31;
            letter-spacing: normal;
            text-align: center;
            color: var(--bk);
        }

        .styling-swiper {
            margin-bottom: 110px;
        }

        .styling-swiper .swiper-slide .t-box {
            padding-left: 0px;
            padding-top: 21px;
            padding-bottom: 12px;
        }

        .styling-swiper .swiper-slide .btn__wrap {
            gap: 0;
        }

        .styling-swiper .btn__wrap {
            padding-left: 10px;
        }

        .styling-text {
            padding: 0 0 10px 10px;
        }

        .styling-text span {
            text-decoration: none;
            font-family: var(--ft-fu);
            font-size: 1.3rem;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.46;
            letter-spacing: 0.33px;
            text-align: left;
            color: var(--bk);
        }

        .styling-swiper .title {
            padding: 0 0 0 10px;
            font-family: var(--ft-fu);
            font-size: 1.6rem;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.38;
            letter-spacing: 0.4px;
            text-align: left;
            color: var(--bk);
        }

        .styling-swiper .btn__wrap a {
            font-size: 1.2rem;
        }

        .styling-swiper .navigation .swiper-button-next::before {
            background-color: #ffffff;
        }

        .styling-swiper .navigation .swiper-button-next::after {
            visibility: hidden;
        }

        .styling-swiper .navigation .swiper-button-prev::after {
            visibility: hidden;
        }

        .styling-swiper .navigation .swiper-button-next {
            top: auto;
            height: 90px;
            right: 0;
            bottom: 0;
            color: var(--bk);
            background-color: var(--wh);
        }

        .foryou-wrap {
            padding-bottom: 140px;
            overflow-x: hidden;
        }

        .foryou-wrap .foryou-text {
            position: static;
            padding: 0 0 20px 10px;
        }

        .foryou-wrap .foryou-text span {
            text-decoration: none;
        }

        .foryou-wrap .wish__btn {
            padding: 15px 12px;
        }

        .foryou-wrap .whish_img {
            width: 14.4px;
            height: 12px;
        }

        .foryou-wrap .prd-title {
            font-family: var(--ft-fu);
            font-size: 1rem;
            height: 30px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.4;
            letter-spacing: normal;
            text-align: center;
            color: var(--bk);
        }
    }
</style>
<main>
    <!-- banner -->
    <section class="new__project__wrap">
        <div class="new__project__swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <!-- <div class="new__project__img" style="background-image:url('/images/landing/bg.jpeg') ;"> -->
                    <img class="" src="/images/sample/section1.jpg" alt="">
                    <div class="new__project__content">
                        <div class="cnt-box">
                            <div class="season__title">2022 Spring Summer Collection</div>
                            <div class="title">After blue</div>
                            <div class="btn__wrap">
                                <a href="" class="read__more under-line wh">자세히보기</a>
                                <a href="" class="go__product under-line wh">제품 보러 가기</a>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="swiper-slide">
                    <img class="" src="/images/sample/section1.jpg" alt="">
                    <div class="new__project__content">
                        <div class="cnt-box">
                            <div class="season__title">2022 Spring Summer Collection</div>
                            <div class="title">After blue</div>
                            <div class="btn__wrap">
                                <a href="" class="read__more under-line wh">자세히보기</a>
                                <a href="" class="go__product under-line wh">제품 보러 가기</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!-- <div class="new__project__img" style="background-image:url('/images/landing/intro1.jpeg') ;"></div> -->
                    <img class="" src="/images/sample/section1.jpg" alt="">
                </div>
            </div>
            <div class="navigation">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- exhibtion -->
    <section>
        <div class="exhibtion__wrap">
            <img class="exhibtion__img" src="/images/sample/section2.jpg" alt="">
            <div class="exhibtion__content">
                <div class="ex__box">
                    <div class="title">아더에러 <span class="fu-font">22 SS</span> 컬렉션 2차 드롭</div>
                    <div class="season__title">22S/S 'Self Expression'</div>
                    <div class="btn__wrap">
                        <a href="" class="under-line bk">자세히보기</a>
                        <a href="" class="under-line bk">제품 보러 가기</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- re product -->
    <section>
        <div class="recommand-wrap">
            <div class="re-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="slide-box">
                            <div class="center-box">
                                <img src="/images/product/img_product_product_BLASSTB18BL_mdl_1661837024.png" alt="">
                                <div class="slide__title">Shopper bag</div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="slide-box">
                            <div class="center-box">
                                <img src="/images/product/img_product_product_PRDTEST0001_mdl_1661773069.png" alt="">
                                <div class="slide__title">Shopper bag</div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="slide-box">
                            <div class="center-box">
                                <img src="/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png" alt="">
                                <div class="slide__title">Shopper bag</div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="slide-box">
                            <div class="center-box">
                                <img src="/images/product/img_product_wear_BLASSTB18BL_mdl_1661837025.png" alt="">
                                <div class="slide__title">Shopper bag</div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="slide-box">
                            <div class="center-box">
                                <img src="/images/product/img_product_wear_BLASSTB18BL_mdl_1661837025.png" alt="">
                                <div class="slide__title">Shopper bag</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="navigation">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="recommand-mobile">
                <a class="slide-box">
                    <div class="center-box">
                        <img src="/images/product/img_product_product_BLASSTB18BL_mdl_1661837024.png" alt="">
                        <div class="title">Shopper bag</div>
                    </div>
                </a>
                <a class="slide-box">
                    <div class="center-box">
                        <img src="/images/product/img_product_product_PRDTEST0001_mdl_1661773069.png" alt="">
                        <div class="title">Shopper bag</div>
                    </div>
                </a>
                <a class="slide-box">
                    <div class="center-box">
                        <img src="/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png" alt="">
                        <div class="title">Shopper bag</div>
                    </div>
                </a>
                <a class="slide-box">
                    <div class="center-box">
                        <img src="/images/product/img_product_wear_BLASSTB18BL_mdl_1661837025.png" alt="">
                        <div class="title">Shopper bag</div>
                    </div>
                </a>
                <a class="slide-box">
                    <div class="center-box">
                        <img src="/images/product/img_product_wear_BLASSTB18BL_mdl_1661837025.png" alt="">
                        <div class="title">Shopper bag</div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- Styling -->
    <section>
        <div class="styling-wrap">
            <div class="styling-text"><span>Styling</span>></div>
            <div class="styling-swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling4.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling2.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling3.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling2.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling4.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling2.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling3.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="styling__card">
                            <div class="styling-box">
                                <a href="">
                                    <img class="styling__img" src="/images/styling/styling1.jpg" alt="">
                                    <div class="t-box">
                                        <p class="title">Metal line</p>
                                        <div class="btn__wrap">
                                            <a href="" class="under-line bk">자세히보기</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- foryou -->
    <section>
        <div class="foryou-wrap ">
            <div class="foryou-text"><span>For you</span>></div>
            <div class="foryou-swiper">
                <div class="swiper-wrapper product_recommend_wrapper">
                </div>
            </div>
        </div>
    </section>
</main>


<script>
    // http://116.124.128.246/_api/common/recommend/get
    //swiper
    window.addEventListener('DOMContentLoaded', () => {
        swiperResize();
        headerColorChange();
        getProductRecommendList();
        mobileRecommandGrid();

    });

    window.addEventListener('resize', () => {
        document.querySelector("body").dataset
        swiperResize();
    });
    let mobileRecommandGrid = () => {
        let $$mobileRecommandBox = document.querySelectorAll(".recommand-mobile .slide-box");
        $$mobileRecommandBox.forEach((el, idx, arr) => {
            let arrLen = arr.length;
            if (arrLen === 1) {
                el.classList.add("half");
                console.log("1", arrLen);
            } else if (arrLen === 2) {
                el.classList.add("half");
                console.log("2", arrLen);
            } else if (arrLen === 3) {
                if (idx === 0) {
                    el.classList.add("half");
                    console.log("3", arrLen);
                }
            } else if (arrLen === 4) {
                el.classList.remove("half");

            } else {
                if (idx === arrLen - 1) {
                    if (arrLen % 2 === 0) {
                        el.classList.remove("half");
                    } else {
                        el.classList.add("half");
                    }
                }

            }


        });
    }
    let newSwiper = new Swiper(".new__project__swiper", {
        navigation: {
            nextEl: ".new__project__swiper .swiper-button-next",
            prevEl: ".new__project__swiper .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
        slidesPerView: 1
    });
    let recommendSwiper = new Swiper(".recommend-swiper", {
        navigation: {
            nextEl: ".recommend-swiper .swiper-button-next",
            prevEl: ".recommend-swiper .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2.5
            },
            920: {
                slidesPerView: 3.5
            },
            1400: {
                slidesPerView: 4.5
            }
        }
    });
    let stylingSwiper = new Swiper(".styling-swiper", {
        navigation: {
            nextEl: ".styling-swiper .swiper-button-next",
            prevEl: ".styling-swiper .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1.32,
                spaceBetween: 10
            },
            1024: {
                slidesPerView: 3.2,
                spaceBetween: 0
            }
        },
        // centeredSlides: true,
        on: {
            activeIndexChange: function () {
                if (1 == this.realIndex) {

                }
                if (1 <= this.realIndex) {
                    // stylingSwiper.extendDefaults({
                    //     centeredSlides: true
                    // });
                    console.log(stylingSwiper.passedParams.centeredSlides);
                    stylingSwiper.passedParams.centeredSlides = true;
                    console.log(stylingSwiper.passedParams.centeredSlides);
                    this.update();
                    this.updateSize();
                    this.updateSlides();
                    console.log(this)
                }
                console.log(this)
            }
        }
    });

    var colaboSetting = {
        navigation: {
            nextEl: ".re-swiper .swiper-button-next",
            prevEl: ".re-swiper .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
        breakpoints: {
            1024: {
                slidesPerView: 4,
            }
        },
        on: {
            init: function () {
                console.log('swiper 초기화 될때 실행');

            },
            destroy: function () {
                console.log("파괴됨")
            }
        }
    }
    let ex = new Swiper(".re-swiper", colaboSetting);

    (() => {
        let $slide = document.querySelectorAll('.recommend-swiper .swiper-slide');
        $slide.forEach((el) => {
            el.addEventListener('click', () => {
                location.href = "http://116.124.128.246:80/product/list";
            });
        });
    })();

    function swiperResize() {
        let screenWidth = document.querySelector(".styling-wrap").offsetWidth
        let nextbtn = document.querySelector(".styling-swiper .navigation .swiper-button-next");
        let prevbtn = document.querySelector(".styling-swiper .navigation .swiper-button-prev");
        let styleTboxHeight = stylingSwiper.el.querySelector(".t-box").offsetHeight;
        let oneGridSize = 0;
        let mobileOneGridSize = 0;

        if (screenWidth >= 1024) {
            oneGridSize = (screenWidth / 16);
            nextbtn.style.width = `${oneGridSize}px`;
            nextbtn.style.height = `${styleTboxHeight}px`;
            prevbtn.style.width = `${oneGridSize}px`;
            prevbtn.style.height = `${styleTboxHeight}px`;
            ex.update();
        } else {

            // let screenWidth = window.screen.width;
            let screenWidth = document.querySelector("body").offsetWidth;
            console.log("screenWidth", screenWidth);
            mobileOneGridSize = (screenWidth / 8) * 2 - 20;
            nextbtn.style.width = `${mobileOneGridSize}px`;
            nextbtn.style.height = `${styleTboxHeight}px`;


        }
    }

    const headerColorChange = () => {
        let header = document.querySelector("header");
        let headerGrid = document.querySelector(".header__grid");
        window.addEventListener('scroll', () => {
            let height = window.scrollY;
            if (height > 50) {
                header.classList.add("scroll");
            } else {
                header.classList.remove("scroll");
            }
        });
    };


    function setWhishList(obj) {
        let product_idx = $(obj).attr('product_idx');

        if (product_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "product_idx": product_idx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/whish/add",
                error: function () {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    let msg = d.msg;

                    if (code == "200") {
                        let whish_img = $(obj).find('.whish_img');
                        whish_img.attr('src', '/images/svg/wishlist-bk.svg');
                        whish_img.attr('style', 'width:19px');
                        $(obj).attr('onClick', 'deleteWhishList(this)');
                    }
                }
            });
        }
    }

    function deleteWhishList(obj) {
        let product_idx = $(obj).attr('product_idx');

        if (product_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "product_idx": product_idx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/whish/delete",
                error: function () {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    let msg = d.msg;

                    if (code == "200") {
                        let whish_img = $(obj).find('.whish_img');
                        whish_img.attr('src', '/images/svg/wishlist.svg');
                        $(obj).attr('onClick', 'setWhishList(this)');
                    }
                }
            });
        }
    }

    const getProductRecommendList = () => {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/recommend/get",
            error: function () {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                let imgUrl = "http://116.124.128.246:81";

                let data = d.data;

                let productRecommendListHtml = "";
                let imgDiv = "";
                const domFrag = document.createDocumentFragment();

                const prdListWrapper = document.querySelector(".product_recommend_wrapper");

                data.forEach(el => {
                    const prdListSlide = document.createElement("div");
                    prdListSlide.classList.add("swiper-slide");

                    let product_link = "/product/detail?product_idx=" + `${el.product_idx}`;

                    let whish_img = "";
                    let whish_function = "";

                    let whish_flg = `${el.whish_flg}`;
                    if (whish_flg == 'true') {
                        whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">';
                        whish_function = "deleteWhishList(this);";
                    } else if (whish_flg == 'false') {
                        whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
                        whish_function = "setWhishList(this);";
                    }

                    productRecommendListHtml = `
                        <div>
                            <div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="${whish_function}">
                                ${whish_img}
                            </div>
                            <div onClick="location.href='${product_link}'">
                                <img src="${imgUrl}${el.product_img}" alt="">
                                <div class="prd-title">${el.product_name}</div>
                            </div>
                        </div>
                    `;

                    prdListSlide.innerHTML = productRecommendListHtml;
                    domFrag.appendChild(prdListSlide);
                });

                prdListWrapper.appendChild(domFrag);
            }
        });

        let foryou = new Swiper(".foryou-swiper", {
            navigation: {
                nextEl: ".foryou-swiper .swiper-button-next",
                prevEl: ".foryou-swiper .swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            grabCursor: true,
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2.64
                },
                1024: {
                    slidesPerView: 5.318
                }
            }
        });
    }
</script>