<style>
    :root {
        --order-header--height: 150px;
        --header--content--gap: 50px;

        --solid-bk: #808080;
    }

    main {
        overflow-x: unset;
    }

    html {
        scroll-behavior: smooth;
    }

    input {
        padding: 0;
        box-sizing: border-box;
    }

    ul,
    li {
        padding: 0;
        margin: 0;
    }

    input:focus {
        border: 0;
    }

    .content input:focus {
        caret-color: var(--bk);
        outline: 0;
    }

    body {
        font-family: var(--ft-no-fu);
        /* background-color: #222; */
        /* color: #ffffff; */
        color: var(--bk);
    }

    .height-eraser {
        height: auto !important;
    }

    .no-whishlist-section {
        margin-bottom: 0 !important;
        border-bottom: 0 !important;
    }

    .no-whishlist-wrap {
        width: 87.6vw;
        height: 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        margin: 0 auto;
    }

    .no-whishlist-msg {}

    .no-whishlist-btn {
        width: 470px;
        height: 40px;
        margin-top: 40px;
        border: solid 1px #000000;
        cursor: pointer;
        text-align: center;
        line-height: 40px;
    }

    .boder-eraser {
        border-right: 0 !important;
        border-left: 0 !important;
    }

    .hidden {
        display: none !important;
    }

    .banner-wrap {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        position: fixed;
        width: 100%;
        height: var(--order-header--height);
        z-index: 10;
        background-color: #ffffff;
        border-bottom: 1px solid #dcdcdc;

        -webkit-transition: height 0.3s;
        -moz-transition: height 0.3s;
        transition: height 0.3s;
    }

    .shrink-banner {
        height: 40px;
    }

    .banner-wrap .banner-box {
        display: flex;
        align-items: center;
        grid-column: 2/17;
        font-size: 13px;
        font-family: var(--ft-no-fu);
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: var(--bk);
    }

    .banner-title {
        font-family: NotoSansCJKKR;
        font-size: 12px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: var(--bk);
        margin-left: 5px;
    }

    .whishlist-section {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        margin-bottom: 200px;
        border-bottom: solid 1px #dcdcdc;
    }

    /* 상품 내용 */
    .temp-div {
        grid-column: 1/2;
    }

    .content.left {
        top: var(--order-header--height);
        margin-top: 150px;
        align-self: start;
        grid-column: 2/14;
        border-right: solid 1px #dcdcdc;
    }

    .content.left .body-wrap.list {
        min-height: 100vh;
        border-left: 1px solid #dcdcdc;
    }

    .content.right {
        position: sticky;
        height: 100vh;
        top: 40px;
        grid-column: 14/17;
        min-width: 36rem;
    }

    .add-list-wrap {
        display: none;
    }

    .content.right.open {
        display: grid;
    }

    .content.right.open .add-list-wrap {
        /* display: block; */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        top: 200px;
        position: sticky;
        width: 360px;
        height: 85vh;
        -webkit-transition: top 0.3s;
        -moz-transition: top 0.3s;
        transition: top 0.3s;
    }

    .shrink-list {
        top: 90px !important;
        height: 93vh !important;
    }

    .content.right .header-wrap {
        margin-bottom: 80px;
        padding: 20px 15px;
    }

    .content.right .body-wrap {}

    .product-wrap {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
    }

    .whishlist-section .product .product-info {
        padding: 0px !important;
        border-top: 0;
    }

    .product-info .prd-img {
        background-color: #f8f8f8;
    }

    .info-box {
        padding: 10px;
    }

    .info-box>.info-row:nth-child(1) {
        padding-bottom: 10px;

    }

    .info-box>.info-row:nth-child(2) {
        padding-bottom: 14px;
        justify-content: left;
        gap: 5px;
    }

    .info-box .option-wrap {
        border: 1px solid #dcdcdc;
    }

    .info-box .option-box {
        display: flex;
        height: 60px;
        padding: 0 10px;
        flex-direction: column;
        justify-content: center;
    }

    .info-box .option-box .info-row .size__box {
        display: flex !important;
        min-height: 40px;
        align-items: center;
        gap: 15px;
    }

    .info-box .option-box .size__box .size.select {
        border-bottom: 1px solid #343434;
    }
    .info-box .option-box .size__box .size[data-soldout="STSC"].select {
        border-bottom: 0px;
    }

    .info-box .option-box .count__btn__box {
        min-height: 40px;
    }

    .count__btn__box {
        display: flex;
        gap: 20px;
        align-items: center;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        text-align: left;
        color: var(--bk);
    }

    .count__val {
        width: 10px;
        text-align: center;
    }

    .count__val:focus {
        outline: none;
    }

    .disableBtn {
        pointer-events: none;
        opacity: 0.4;
    }

    .disable {
        pointer-events: none;
    }

    /* 상품 삭제 버튼 */
    .whishlist-section .remove-btn {
        display: flex;
        position: absolute;
        right: 0;
        margin: 20px;
        width: 13px;
    }

    .remove-btn img:nth-of-type(2) {
        position: absolute;
        transform: rotate(90deg);
    }

    .whishlist-section .product {
        border-bottom: 1px solid #dcdcdc;
        border-right: 1px solid #dcdcdc;
    }

    .product-select-btn {
        cursor: pointer;
        border-top: 1px solid #dcdcdc;
        display: flex;
        justify-content: center;
        height: 30px;
        align-items: center;
    }

    .product-select-btn[data-status='0'] {
        background-color: #dcdcdc;
        pointer-events: none;
    }

    .product-select-btn[data-status='1'] {
        background-color: #dcdcdc;
    }

    .product-select-btn[data-status='1'].select {
        background-color: #000000;
        color: #fff;
    }


    .product-select-btn[data-status='1'] span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: invert(1);
        position: relative;
        bottom: -3px;
        padding-right: 5px;
    }

    .product-select-btn.option span::before {
        background-color: #dcdcdc;
        content: none;
    }

    .product-select-btn[data-status='1'].select span::before {
        filter: none;
    }

    .product-select-btn[data-status='1'].reorder {
        background-color: #000000;
        color: #ffffff;
    }

    .product-select-btn[data-status='1'].reorder span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: none;
    }

    .option-wrap .option {
        background-color: #dcdcdc;
        color: #343434;
    }

    .product-select-btn.select {
        background-color: #000000;
        color: #ffffff;
    }

    .plus__btn {
        cursor: pointer;
    }

    .minus__btn {
        cursor: pointer;
    }

    .product .product-info .info-row .name {
        width: auto;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.28px;
        text-align: left;
        color: var(--bk);
    }

    .product .product-info .info-row .price {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.28px;
        text-align: right;
        color: var(--bk);
    }

    .size__box li {
        cursor: pointer;
        height: 15px;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: center;
        color: var(--bk);
    }

    .size__box li:after {
        display: block;
        content: '';
        border-bottom: solid 1px #343434;
        transform: scaleX(0);
        transition: transform 250ms ease-in-out;
    }

    .size__box li:hover:after {
        transform: scaleX(1);
    }

    .size__box li:after {
        margin-top: 0.5px;
        transform-origin: 0% 50%;
    }

    .size__box li[data-soldout="STSO"]::after {
        top: -2px;
    }

    .size__box .stock-stcl:hover::before {
        content: "Only a few left";
        position: absolute;
        width: 80px;
        top: 17px;
        left: -5px !important;
        color: red;
        background-color: #ffffff;
    }

    .size__box li[data-soldout="STCL"]:hover::before {
        content: "Only a few left";
        position: absolute;
        width: 80px;
        top: 17px;
        left: -35px;
        color: red;
        background-color: #ffffff;
    }

    .size__box li[data-soldout="STCL"]::after {
        content: '';
        position: unset;
        bottom: 0;
        right: 0;
    }

    .size__box li[data-soldout="STCL"] p {
        content: url(/images/svg/wish-redsold.svg);
        position: absolute;
        top: -3px;
        bottom: 15px;
        right: -3px;
        pointer-events: none;
    }

    .size__box li[data-soldout="STSC"]:hover::after {
        content: url(/images/svg/sold-line.svg);
        position: absolute;
        right: 1px;
        top: -2px;
    }
    .size__box li[data-soldout="STSO"]::after {
        border: 0;
    }

    .size__box .size.select[data-soldout="STSC"]::after {
        content: url(/images/svg/sold-line.svg);
        position: absolute;
        right: 1px;
        top: -2px;
    }

    .size__box .stock-stsc:hover::before {
        content: "Re-order";
        position: absolute;
        width: 50px;
        bottom: -15px;
        left: -5px !important;
    }

    .size__box li[data-soldout="STSC"]:hover::before {
        content: "Re-order";
        position: absolute;
        width: 50px;
        bottom: -15px;
        left: -15px;
    }

    .size__box li[data-soldout="STSC"]:hover {
        color: #808080;
        opacity: 1;
    }

    .add-list-wrap .header-wrap .header-box {
        text-align: right;
    }

    .add-list-wrap .header-wrap .header-box .hd-title {
        text-decoration: underline;
        cursor: pointer;
    }

    .add-list-wrap .body-wrap {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        padding: 0 40px;
        column-gap: 20px;
        flex-wrap: wrap;
        row-gap: 40px;
        margin-bottom: 35rem;
    }

    .add-list-wrap .body-wrap .add-box {
        max-width: 80px;
        width: 33%;
        text-align: center;
    }

    .add-list-wrap .body-wrap .add-box img {
        background-color: #fbfbfb;
    }

    .add-list-wrap .body-wrap .add-box .size-list {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        column-gap: 5px;
    }

    .add-list-wrap .basket-link-btn {
        margin: 20px;
        background-color: #000000;
        color: #ffffff;
        display: flex;
        justify-content: center;
        height: 40px;
        align-items: center;
        font-family: NotoSansCJKKR;
        font-size: 11px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        cursor: pointer;
    }

    .add-list-wrap .basket-link-btn-wrap {
        display: flex;
        flex-direction: column;
    }

    .option-noti {
        position: absolute;
        display: flex;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: flex-end;
    }

    .option-noti .noti-text {
        /* background-color: #ffffff; */
        width: 80%;
        text-align: right;
        text-decoration: underline;
    }

    .quick-menu-wrap {
        display: none;
    }

    @media (max-width:1025px) {
        .no-whishlist-btn {
            width: 90%;
        }
        .add-list-wrap .basket-link-btn-wrap {
            align-items: center;
        }
        .shrink-list {
            height: 0!important;
        }
        .size__box .size[data-soldout="STCL"]:hover::before {
            content: "";
            position: absolute;
            width: 80px;
            top: 17px;
            left: -35px;
            background-color: #ffffff;
        }
        .size__box .size.select[data-soldout="STCL"]:hover::before {
            content: "Only a few left";
            position: absolute;
            width: 80px;
            top: 17px;
            left: -35px;
            color: red;
            background-color: #ffffff;
        }
        .size__box li:after {
            border-bottom: 0;
        }
        .content.right.open .add-list-wrap {
            position: sticky;
            height: auto!important;
        }

        .product .product-info .info-row .name {
            width: 50%;
        }

        .info-box .info-row .name span {
            display: block;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .info-box .option-box {
            display: flex;
            height: 70px;
            padding: 0 10px;
            flex-direction: column;
            justify-content: center;
        }

        .info-box .option-box .info-row .size__box {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr);
            min-height: 40px;
            align-items: center;
            gap: 15px;
        }

        .product-wrap {
            margin-top: 27px;
        }

        .banner-wrap {
            top: 42px;
            height: 37px;
        }

        .content.left {
            grid-column: 1/17;
            margin-top: 0px;
        }

        .content.right {
            background-color: #ffffff;
            position: fixed;
            bottom: 0;
            top: auto;
            height: 160px;
            grid-column: 1/17;
            width: 100%;
            z-index: 20;

        }

        .content.right .header-wrap {
            margin-bottom: 10px;
            padding: 0px 10px;
        }

        .add-list-wrap {
            overflow-x: hidden;
            padding: 10px 0 10px 10px;
            position: relative;
            z-index: 20;
        }

        .add-list-wrap .body-wrap {
            display: none;
        }

        .add-list-wrap .quick-menu-wrap {
            width: calc(100% - 45px);
        }

        .whishlist-section .product {
            width: 50%;
        }

        .whishlist-section .product .product-info {
            height: auto;
        }

        .quick-menu-wrap {
            display: block;
        }

        .add-list-wrap .basket-link-btn {
            height: 30px;
            position: absolute;
            width: calc(100% - 20px);
            margin-bottom: 10px;
            bottom: 0;
        }

        .swiper {
            height: 100%;
        }

        .quick-menu-wrap .swiper-button-next::after {
            position: relative;
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(270deg);
        }

        .quick-menu-wrap .swiper-button-prev::after {
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(90deg);
        }

        .quick-swiper .quick-img {
            max-width: 60px;
        }

        .quick-menu-wrap .swiper-button-next {
            right: 20px;
            height: 10%;
            /* top: -5px;
            margin: 0; */
        }

        .quick-menu-wrap .swiper-button-prev {
            display: none;
        }
    }
</style>

<?php
$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
    $member_idx = $_SESSION['MEMBER_IDX'];
}

if ($member_idx == 0) {
    echo "
			<script>
				location.href='/login?r_url=/order/whish';
			</script>
		";
}
?>

<link rel="stylesheet" href="/css/module/foryou.css">
<main data-basketStr="<?= $basket_idx ?>" data-country="<?= $country ?>">
    <div class="banner-wrap">
        <div class="banner-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12.499" viewBox="0 0 15 12.499">
                <path data-name="패스 6645"
                    d="M72.632 66.861a4.25 4.25 0 0 0-4.154-4.34 4.111 4.111 0 0 0-3.338 1.717 4.113 4.113 0 0 0-3.327-1.738 4.249 4.249 0 0 0-4.181 4.313 4.389 4.389 0 0 0 1.446 3.287l4.856 4.9 1.81-1.61.8.856 4.7-4.168a4.386 4.386 0 0 0 1.388-3.217z"
                    transform="translate(-57.632 -62.5)" style="fill:var(--bk)" />
            </svg>
            <span class="banner-title">위시리스트</span>
        </div>
    </div>
    <section class="whishlist-section">
        <div class="temp-div"></div>
        <div class="content left">
            <div class="body-wrap list">
                <input id="wish-product-cnt" type="hidden" />
            </div>
        </div>
        <div class="content right hidden">
            <div class="add-list-wrap">
                <div>
                    <div class="header-wrap">
                        <div class="header-box" onclick="removeAddListAll()">
                            <span class="hd-title">모두 선택해제</span>
                        </div>
                    </div>
                    <div class="body-wrap"></div>
                    <div class="quick-menu-wrap">
                        <div class="swiper mySwiper quick-swiper">
                            <div class="swiper-wrapper"></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="basket-link-btn-wrap">
                    <div class="basket-link-btn" onclick="basketAddBtnHandler();">
                        <span data-i18n="w_basket_msg_03">선택 제품 쇼핑백으로 이동하기</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="recommend-wrap"></section>
</main>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        getWhishProductList();
        
    });
    
    let shirinkStart = 10;
    $(window).scroll(function () {
        let scroll = currentScroll();
        let banner = document.querySelector(".banner-wrap");
        let addList = document.querySelector(".add-list-wrap");
        if (scroll >= shirinkStart) {
            banner.classList.add("shrink-banner");
            addList.classList.add("shrink-list");
        } else {
            banner.classList.remove("shrink-banner");
            addList.classList.remove("shrink-list");
        }
    })

    function currentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }


    let addListBox = [];
    const wish_quickSwiper = new Swiper(".quick-swiper", {
        observeParents: true,
        observeSlideChildren: true,
        slidesPerView: "auto",
        breakpoints: {
            320: {
                spaceBetween: 10,
                slidesPerView: 4.6
            },
            420: {
                spaceBetween: 10,
                slidesPerView: 6
            },
            520: {
                spaceBetween: 10,
                slidesPerView: 7
            },
            620: {
                spaceBetween: 10,
                slidesPerView: 8
            },
        },
        navigation: {
            nextEl: ".quick-swiper .swiper-button-next",
            prevEl: ".quick-swiper .swiper-button-prev"
        }
    });
    
    wish_quickSwiper.on("click", function() {
        let idx = wish_quickSwiper.clickedIndex;
        if(idx != null) {
            let whishIdx = wish_quickSwiper.wrapperEl.children[idx].children[0].dataset.no;
            elementScroll("body-list", whishIdx);
        }
    });
    
    const getWhishProductList = () => {
        let country = "KR"
        $.ajax({
            type: "post",
            data: {
                "country": getLanguage(),
                "MEMBER_IDX": 1
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/list/get",
            error: function () {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                let data = d.data;
                if (data == null) {
                    let contentWrap = document.querySelector(".whishlist-section .left");
                    let bodyWrap = document.querySelector(".whishlist-section .body-wrap");
                    let wishlistSection = document.querySelector(".whishlist-section");
                    contentWrap.classList.add("boder-eraser");
                    bodyWrap.classList.add("boder-eraser");
                    wishlistSection.classList.add("no-whishlist-section");
                    contentWrap.innerHTML = `
                    <div class="no-whishlist-wrap">
                        <div class="no-whishlist-msg">위시리스트가 비어있습니다</div>
                        <div class="no-whishlist-btn" onclick="location.href='/product/list?page_idx=1&menu_sort=L&menu_idx=1'">쇼핑 계속하기</div>
                    </div>
                `;
                } else {
                    whishListWrite(data);
                    productAddBtnClickHandler();
                    sizeSelectHandler();
                    removeProductBtnHandler();
                    productBtnStatus();
                    changeLanguageR();
                }
            }
        });
    }
    /*-------------------------화면 그리기-------------------------- */
    function whishListWrite(whishlist) {
        const bodyWrap = document.querySelector(".content .body-wrap.list");
        let productWrap = document.createElement("div");
        productWrap.classList.add("product-wrap");
        let productHtml = "";
        let url = "http://116.124.128.246:81";

        whishlist.forEach(el => {
            let productColorHtml = "";
            let colorData = el.color_rgb;
            let multi = colorData.split(";");

            if (multi.length === 2) {
                productColorHtml += `
                    <div class="color-line" style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                        <div class="color multi" data-title="${multi}"></div>
                    </div>
                `;
            } else {
                productColorHtml += `
                    <div class="color-line" style="--background-color:${multi[0]}" >
                        <div class="color" data-title="${multi}"></div>
                    </div>
                `;
            }

            let product_size = el.product_size;
            let product_size_head = product_size[0];
            let product_size_tail = product_size.slice(1);
            let productSizeHtml = "";
            if (product_size_head.stock_status == "STCL") {
                productSizeHtml += `
                    <li class="size stock-stcl" data-reorder="false" data-sizetype="${product_size_head.size_type}" data-optionidx="${product_size_head.option_idx}" data-soldout="${product_size_head.stock_status}">${product_size_head.option_name}<p></p></li>
                `;
            } else if (product_size_head.stock_status == "STSC") {
                productSizeHtml += `
                    <li class="size stock-stsc" data-reorder="false" data-sizetype="${product_size_head.size_type}" data-optionidx="${product_size_head.option_idx}" data-soldout="${product_size_head.stock_status}">${product_size_head.option_name}<p></p></li>
                `;
            } else {
                productSizeHtml += `
                    <li class="size" data-reorder="false" data-sizetype="${product_size_head.size_type}" data-optionidx="${product_size_head.option_idx}" data-soldout="${product_size_head.stock_status}">${product_size_head.option_name}<p></p></li>
                `;
            }
            product_size_tail.forEach(size => {
                productSizeHtml += `
                    <li class="size" data-reorder="false" data-sizetype="${size.size_type}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}<p></p></li>
                `;
            });

            productHtml += `
                <div class="body-list product" data-whish=${el.whish_idx}>
                    <div class="product-info">
                        <div class="remove-btn"> 
                            <img src="/images/svg/sold-line.svg">
                            <img src="/images/svg/sold-line.svg">
                        </div>
                        <a href="/product/detail?product_idx=${el.product_idx}" class="docs-creator"><img class="prd-img" cnt="1" src="${url}${el.product_img}" alt=""></a>
                        <div class="info-box">
                            <div class="info-row">
                                <div class="name" data-soldout=""><span>${el.product_name}</span></div>
                                ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${el.sales_price.toLocaleString('ko-KR')}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>` : `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${el.sales_price.toLocaleString('ko-KR')}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                            </div>
                            <div class="info-row">
                                <div class="color-title"><span>${el.color}</span></div>
                                <div class="color__box" data-maxcount="" data-colorcount="1">
                                    ${productColorHtml}
                                </div>
                            </div>
                            <div class="option-wrap">
                                <div class="option-box">
                                    <div class="info-row">
                                        <div class="size__box">
                                            ${productSizeHtml}
                                        </div>
                                    </div>
                                </div>
                                <div data-optionidx="" data-idx="${el.product_idx}" class="product-select-btn">
                                    <span data-i18n="w_select">선택하기</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            `;
        });
        productWrap.innerHTML = productHtml;
        bodyWrap.appendChild(productWrap);
        let productCnt = bodyWrap.querySelectorAll(".list .product").length;
        let hiddenCnt = document.querySelector("#wish-product-cnt");
        hiddenCnt.value = productCnt;
    }

    function writeAddBoxHtml(add) {
        let bodyWrap = document.querySelector(".add-list-wrap .body-wrap");
        let swiperWrap = document.querySelector(".add-list-wrap .quick-swiper .swiper-wrapper");
        let addBoxs = bodyWrap.querySelectorAll(".add-box");

        let addBoxEl = document.createElement("div");
        let slideEl = document.createElement("div");
        let sizeIdxArr = add.sizeidx.toString();
        let sizeHtml = "";
        addBoxEl.dataset.whish_idx = add.whish;
        addBoxEl.dataset.option_idx = sizeIdxArr;
        //사이즈 선택이 1개이상일떄 
        if (sizeIdxArr.length > 0) {
            let sizeResult = add.sizeText.map(el => {
                let sizeSpan = `<span>${el}</span>`
                return sizeSpan;
            }).join("");
            sizeHtml = sizeResult;
        }

        //동일한 위시리스트 idx가 찜리시트에 있을경우 
        let whishStatus = addIsProductEl(add.whish);
        if (whishStatus.length) {
            let thisSizeList = whishStatus[0].querySelector(".size-list");
            whishStatus[0].dataset.size = sizeIdxArr;

            while (thisSizeList.hasChildNodes()) { //자식 요소가 있는지 확인-false가 될때까지 반복
                thisSizeList.removeChild(thisSizeList.firstChild); // 첫번째 자식 요소를 삭제
            }
            add.sizeText.forEach(el => {
                let sizeSpan = document.createElement("span");
                sizeSpan.innerHTML = el;
                thisSizeList.appendChild(sizeSpan);
            });
            return
        }

        addboxHtml = `
        <img src="${add.img}" alt="">
        <div class="product-title">
            <span>${add.name}</span>
            <div class="size-list">
            ${sizeHtml}
            </div>
        </div>
    `;

        quickHtml = `<img class="quick-img" data-no="${add.whish}" src="${add.img}" alt="">`;



        addBoxEl.innerHTML = addboxHtml;
        slideEl.innerHTML = quickHtml;
        addBoxEl.classList.add("add-box");
        slideEl.classList.add("swiper-slide");
        slideEl.dataset.no = add.whish;

        bodyWrap.appendChild(addBoxEl);
        swiperWrap.appendChild(slideEl);
        wish_quickSwiper.update();
        if (bodyWrap.querySelectorAll(".add-box").length !== 0) {
            showAddWrapBtns();
        }
    }
    /*-------------------------예외 처리-------------------------- */
    const addIsProductEl = (whishIdx) => {
        let addboxEl = document.querySelectorAll(".add-list-wrap .add-box");
        let result = [...addboxEl].filter(el => el.dataset.whish == whishIdx);
        return result
    }

    /*-------------------------이벤트 핸들러-------------------------- */
    // 상품 사이즈 선택 
    function sizeSelectHandler() {
        let sizes = document.querySelectorAll(".size__box .size");
        let sizeBox = document.querySelectorAll(".size__box");

        sizes.forEach(el => {
            el.addEventListener("click", function (e) {
                let szieTarget = e.target;
                let whishIdx = szieTarget.offsetParent.dataset.whish;
                let sizeLen = sizeIsSelectEl(e).length;
                let sizeEl = szieTarget.offsetParent.querySelectorAll(".size__box .size");
                let targetBtn = szieTarget.offsetParent.querySelector(".product-select-btn");
                let sizeStatus = szieTarget.dataset.status;
                let notTaget;
                let optionidxResult = szieTarget.dataset.optionidx;
                targetBtn.dataset.optionidx = optionidxResult;

                //상품 재고 상태 반영
                if (szieTarget.dataset.soldout != "STSO") {
                    szieTarget.classList.toggle("select");
                    if (sizeStatus == 0) {
                        notTaget = [...sizeEl].filter(el => el.dataset.status != 0)
                    } else if (sizeStatus == 1) {
                        notTaget = [...sizeEl].filter(el => {
                            reorderCheck();
                            return el.dataset.status != 1;
                        });
                    } else if (sizeStatus == 2) {
                        notTaget = [...sizeEl].filter(el => el.dataset.status != 2)
                    } else if (sizeStatus == 3) {
                        notTaget = [...sizeEl].filter(el => el.dataset.status != 3)
                    }
                    notTaget.forEach(el => el.classList.remove("select"));
                    
                }

                productBtnStatus(whishIdx, sizeStatus);
                function reorderCheck() {
                    let reorder = document.querySelectorAll(".size[data-reorder='true']");
                    reorder.forEach(el => el.offsetParent.querySelector(".product-select-btn").classList.add("reorder"));
                }
            });
        });
    }
    //오른쪽사이드에 상품 추가하는 버튼 
    function productAddBtnClickHandler() {
        let $$prdAddBtn = document.querySelectorAll(".product-select-btn");
        let addBoxs = document.querySelectorAll(".add-list-wrap .add-box");
        let addList = [];
        let addProduct = {}
        $$prdAddBtn.forEach((el, index) => {
            el.addEventListener("click", function (e) {
                let whish_idx = el.offsetParent.dataset.whish;
                let sizeEl = sizeIsSelectEl(e);
                let szieTextArr = sizeEl.map(el => el.innerHTML);
                let szieIdxArr = sizeEl.map(el => el.dataset.optionidx);

                let getSrc = e.target.offsetParent.querySelector(".prd-img").getAttribute("src");
                let getName = e.target.offsetParent.querySelector(".name span").innerHTML;
                let getSizeText = szieTextArr;
                let getSizeIdx = szieIdxArr;
                let getProduct = e.currentTarget.dataset.idx;
                if (e.currentTarget.classList.contains("select")) {
                    //사이즈가 1개이상 선택되어 있고, 버튼이 선택해제로 활성화 상태
                    
                    resetSizeBox(whish_idx);
                    removeAddList(whish_idx);
                    e.currentTarget.classList.remove("select");
                    e.currentTarget.querySelector("span").innerHTML = "선택하기";
                    e.currentTarget.querySelector("span").dataset.i18n = "w_select";
                    e.currentTarget.querySelector("span").textContent = i18next.t("w_select");
                } else {
                    //사이즈가 선택이 안되어있고, 버튼이 선택하기로 비활성화 상태
                    
                    /* --------사이즈 선택없이 버튼 누를경우 --------*/
                    
                    if (!sizeEl.length) {
                        e.currentTarget.classList.remove("select");
                        e.currentTarget.classList.add("option");
                        e.currentTarget.children[0].innerHTML = "옵션을 선택해주세요";
                        e.currentTarget.children[0].dataset.i18n = "w_select_option";
                        e.currentTarget.children[0].textContent = i18next.t("w_select_option");
                        return false;
                    }


                    /* --------품절, 리오더 사이즈를 선택하고 버튼을 눌렀을때 --------*/
                    if (el.dataset.status == 1 || el.dataset.status == 0) {
                        let reorder = sizeEl.map(el => {
                            el.dataset.reorder = "true"
                            return el
                        });
                    } else {
                        addProduct.idx = getProduct;
                        addProduct.sizeidx = getSizeIdx;
                        addProduct.sizeText = getSizeText;
                        addProduct.img = getSrc;
                        addProduct.name = getName;
                        addProduct.whish = whish_idx;

                        e.currentTarget.classList.add("select");
                        writeAddBoxHtml(addProduct);

                        // document.querySelector(".add-list-wrap .header-box").classList.remove("hidden");
                        // document.querySelector(".add-list-wrap .basket-link-btn").classList.remove("hidden");

                        el.offsetParent.querySelector(".size__box").classList.add("disable");
                        el.querySelector("span").innerHTML = "선택해제";
                        el.querySelector("span").dataset.i18n = "w_remove";
                        el.querySelector("span").textContent = i18next.t("w_remove");
                    }

                }
                showAddWrapBtns();
            });
        })
    }

    //쇼핑백에 담기 버튼
    function basketAddBtnHandler() {
        let basketBtn = document.querySelector(".add-list-wrap .basket-link-btn");
        const addType = "whish";
        let addBox = document.querySelectorAll(".add-list-wrap .add-box");

        let whish_info = [];
        addBox.forEach(el => {
            let { whish_idx, option_idx } = el.dataset;

            let tmp_option_idx = option_idx.split(",");

            let tmp_arr = {
                'whish_idx': whish_idx,
                'option_idx': tmp_option_idx
            };

            whish_info.push(tmp_arr);
        });

        if (whish_info != null) {
            $.ajax({
                type: "post",
                url: "http://116.124.128.246:80/_api/order/basket/add",
                data: {
                    'add_type': 'whish',
                    'whish_info': whish_info
                },
                dataType: "json",
                error: function () {
                    alert("쇼핑백 추가처리에 실패했습니다.");
                },
                success: function (d) {
                    if (d.code == 200) {
                        location.href = '/order/basket/list';
                    } else {
                        notiModal(d.msg);
                    }
                }
            });
        }
    }

    /*------------------------- 삭제 & 초기화 -------------------------- */
    //찜리스트에 추가된 상품 제거 
    const removeAddList = (whish_idx) => {
        let add_box = document.querySelectorAll(".add-list-wrap .add-box");
        let slide = document.querySelectorAll(".quick-swiper .swiper-slide");
        [...add_box].filter(el => {
            if (el.dataset.whish_idx == whish_idx) {
                el.remove();
            }
        });

        slide.forEach((el, idx) => {
            if (el.dataset.no == whish_idx) {
                wish_quickSwiper.removeSlide(idx);
                wish_quickSwiper.update();
            }
        });
    }

    function removeProductBtnHandler() {
        const removeBtn = document.querySelectorAll(".remove-btn");

        removeBtn.forEach(el => {
            el.addEventListener("click", function (e) {
                let hiddenCnt = document.querySelector("#wish-product-cnt");
                targetwhishIdx = e.currentTarget.offsetParent.dataset.whish;
                removeProduct(targetwhishIdx);
                hiddenCnt.value--;
            });
        });
    }

    function removeProduct(whishIdx) {
        let country = "KR"
        $.ajax({
            type: "post",
            data: {
                "country": getLanguage(),
                "whish_idx": whishIdx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/delete",
            error: function () { },
            success: function (d) {
                
                let product = document.querySelectorAll(".product-wrap .product");
                
                let result = [...product].find(el => el.dataset.whish === whishIdx);
                if(result != null) {
                    result.remove();
                    removeAddList(whishIdx);
                }
            }
        });
    }

    //개별 위시리스트 상품 사이즈 버튼 초기화 
    const resetSizeBox = (whishIdx) => {
        let sizeBoxs = document.querySelectorAll(".whishlist-section .size__box");
        let $$addboxEl = document.querySelectorAll(".add-list-wrap .add-box");
        let $$slideEl = document.querySelectorAll(".quick-swiper .swiper-slide");

        // let allRemoveBtn = document.querySelector(".add-list-wrap .header-wrap")
        let basketBtn = document.querySelector(".add-list-wrap .basket-link-btn")

        sizeBoxs.forEach((el, index) => {
            let targetWhishIdx = el.offsetParent.dataset.whish;
            if (targetWhishIdx == whishIdx) {
                el.classList.remove("disable");
                [...el.children].map(size => size.classList.remove("select"));
            }
        });

        if ($$addboxEl.length == 0 || $$slideEl.length == 0) {
            // allRemoveBtn.classList.add("hidden");
            // allRemoveBtn.classList.add("hidden");
        }
    }
    //찜리스트에 추가된상품 모두 제거 
    const removeAddListAll = () => {
        let $$productSelectBtn = document.querySelectorAll(".product-select-btn.select");

        let $$addBox = document.querySelectorAll(".body-wrap .add-box");
        $$addBox.forEach(el => {
            let whish_idx = el.dataset.whish_idx;
            el.remove();

            resetSizeBox(whish_idx);

            wish_quickSwiper.removeAllSlides();
            wish_quickSwiper.update();

            showAddWrapBtns();
        })
        $$productSelectBtn.forEach(el => {
            el.classList.remove("select");
            el.querySelector("span").innerHTML = "선택하기";
            el.querySelector("span").dataset.i18n = "w_select";
            el.querySelector("span").textContent = i18next.t("w_select");
        });
    }

    //매개변수가 없을시에 위시리시트 전체 상품 상태 체크 
    const productBtnStatus = (whishIdx, status) => {
        const $$productBtn = document.querySelectorAll(".product-select-btn");
        const $$sizeBox = document.querySelectorAll(".size__box");
        let stockStatus = 0;
        //위시리스트 인덱스 체크 
        if (whishIdx != undefined) {
            let whishEl = [...$$productBtn].find(el => el.offsetParent.dataset.whish == whishIdx);
            whishEl.classList.remove("option");
            let statusIdx = whishEl.dataset.status;
            addBtnChange(whishEl, status);
        } else {
            let result = [...$$sizeBox].map(el => {
                let sizeArr = el.querySelectorAll(".size");
                let statusResultArr = [...sizeArr].map(size => {
                    let tmp_soldout_str = size.dataset.soldout;
                    if (tmp_soldout_str == 'STSO') {
                        size.dataset.status = 0;
                        return stockStatus = 0;
                    } else if (tmp_soldout_str == 'STSC') {
                        size.dataset.status = 1;
                        return stockStatus = 1;
                    } else if (tmp_soldout_str == 'STCL' || tmp_soldout_str == 'STIN') {
                        size.dataset.status = 2;
                        return stockStatus = 2;
                    }
                });
                return statusArrCheck(statusResultArr);
            });

            $$productBtn.forEach((el, index) => {
                el.dataset.status = result[index];
                addBtnChange(el, result[index]);
            });
        }

        function addBtnChange(el, idx) {
            switch (parseInt(idx)) {
                case 0:
                    el.querySelector("span").innerHTML = "품절된 제품입니다.";
                    el.querySelector("span").dataset.i18n = "w_basket_msg_02";
                    el.querySelector("span").textContent = i18next.t("w_basket_msg_02");
                    el.dataset.status = 0;
                    break;
                case 1:
                    el.querySelector("span").innerHTML = "재입고 알림 신청하기";
                    el.dataset.status = 1;
                    break;
                case 2:
                    el.querySelector("span").innerHTML = "선택하기";
                    el.querySelector("span").dataset.i18n = "w_select";
                    el.querySelector("span").textContent = i18next.t("w_select");
                    el.dataset.status = 2;
                    break;
                case 3:
                    el.querySelector("span").innerHTML = "comming soon";
                    el.dataset.status = 3;
                    break;
            }
        }
    }
    const statusArrCheck = (list) => {
        // 0 : 완전품절 || 1: 리오더가능 || 2: 재고 선택가능 || 3: commin-soon
        let result = Math.max(...list);
        return result;
    }
    //사이즈 선택 체크 
    const sizeIsSelectEl = (e) => {
        let sizeEl = e.target.offsetParent.querySelectorAll(".size__box .size");
        let result = [...sizeEl].filter(el => el.classList.contains("select"));

        return result
    }

    /*------------------------- css 조작 스크립트 -------------------------- */
    const showAddWrapBtns = () => {
        let contentRight = document.querySelector(".content.right");
        let addListWrap = document.querySelector(".add-list-wrap");
        let addbox = addListWrap.querySelectorAll(".body-wrap .add-box");

        let allRemoveBtn = addListWrap.querySelector(".hd-title");
        let basketLinkBtn = addListWrap.querySelector(".basket-link-btn");
        addListWrap.classList.remove("hidden");
        allRemoveBtn.classList.remove("hidden");


        if (addbox.length > 0) {
            contentRight.classList.add("open");

            addListWrap.classList.remove("hidden");
            allRemoveBtn.classList.remove("hidden");
            contentRight.classList.remove("hidden");
        } else {
            contentRight.classList.remove("open");

            addListWrap.classList.add("hidden");
            allRemoveBtn.classList.add("hidden");
            contentRight.classList.add("hidden");
        }
    }
    //퀵슬라이드 클릭시 스크롤 이동
    function elementScroll(el, idx) {

        const headerHeight = document.querySelector("header").offsetHeight;
        const bannerHeight = document.querySelector(".banner-wrap").offsetHeight;
        // let elemTop = document.querySelectorAll(`.${el}`)[idx].offsetTop;
        let elemTop = [...document.querySelectorAll(`.body-list`)].find(el => el.dataset.whish == idx).offsetTop;
        let result = elemTop - (headerHeight + bannerHeight);
        window.scrollTo(0, result);
    }
    let cntTarget = document.getElementById("wish-product-cnt");
    let tempWrap = document.querySelector(".whishlist-section .body-wrap");
    let bodyWrapL = document.querySelector(".whishlist-section .left");
    let bodyWrapR = document.querySelector(".whishlist-section .right");
    let wishlistSection = document.querySelector(".whishlist-section");

    let btnObserver = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            if (cntTarget.value === '0') {
                // wishlistSection.innerHTML = "<div><div>위시리스트가 비어있습니다</div><div>쇼핑 계속하기</div></div>";
                tempWrap.classList.add("boder-eraser");
                bodyWrapL.classList.add("boder-eraser");
                wishlistSection.classList.add("no-whishlist-section");
                bodyWrapR.innerHTML = "";
                bodyWrapR.classList.add("height-eraser");
                bodyWrapL.innerHTML = `
                <div class="no-whishlist-wrap">
                    <div class="no-whishlist-msg">위시리스트가 비어있습니다</div>
                    <div class="no-whishlist-btn" onclick="location.href='/product/list?page_idx=1&menu_sort=L&menu_idx=1'">쇼핑 계속하기</div>
                </div>
            `;
            } else {
                tempWrap.classList.remove("boder-eraser");
                bodyWrapL.classList.remove("boder-eraser");
                wishlistSection.classList.remove("no-whishlist-section");
                bodyWrapR.classList.remove("height-eraser");
            }
        })
    });
    let btnObConfig = {
        attributes: true
    }
    btnObserver.observe(cntTarget, btnObConfig);
/*------------------------- css조작 스크립트 -------------------------- */
</script>

<script type="module">
    import ForyouRender from '/scripts/module/foryou.js';
    const foryou = new ForyouRender();
</script>