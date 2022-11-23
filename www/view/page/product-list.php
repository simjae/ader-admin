<?php include $_CONFIG['PATH']['PAGE'] . '/components/wishlist.php';?>
<style>
    /* web */
    .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__img {
    height: 100px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    }

    .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__title {
        text-align: center;
    }

    .product__list__wrap .prd__meun__swiper .prd__meun__box {
        width: 100px;
    }

    .product__list__wrap .prd__meun {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        padding-bottom: 15px;
    }

    .product__list__wrap .prd__meun .prd__meun__grid {
        display: flex;
        grid-column: 2/10;
        justify-content: space-around;
        border: none;
    }

    .product__list__wrap .prd__meun .prd__meun__swiper {
        display: flex;
        width: 100%;
        overflow: hidden;
    }

    .prd__meun__grid .prd__meun__box .prd__title {
        font-family: var(--ft-no);
        font-size: 12px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.42;
        opacity: 0.5;
        color: #343434;
    }

    .prd__meun__grid .prd__meun__sort span {
        font-family: var(--ft-no);
        font-size: 12px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.42;
        color: #343434;
    }

    .rW.sort__grid[data-grid='2'] img {
        width: 21px !important;
    }

    .rW.sort__grid[data-grid='4'] img {
        width: 40px !important;
    }

    .prd__meun__grid .swiper-button-prev {
        position: relative;
        left: -50px;
        top: 67px;
        color: #000;
        height: 30px;
        width: 10px;
    }

    .prd__meun__grid .swiper-button-prev::after {
        content: url('/images/svg/sort-bottom.svg');
        transform: rotate(90deg);
    }

    .prd__meun__grid .swiper-button-next::after {
        content: url('/images/svg/sort-bottom.svg');
        transform: rotate(270deg);
    }

    .prd__meun__grid .swiper-button-next {
        position: relative;
        left: 30px;
        color: #000;
    }

    .prd__meun__grid .swiper-slide:first-child .prd__meun__box .prd__img__wrap {
        border: 1px solid #dcdcdc;
    }

    .prd__meun__grid .swiper-slide .prd__meun__box {
        padding: 0 10px;
    }



    .product__list__wrap .prd__meun .prd__meun__sort {
        display: flex;
        grid-column: 13/17;
        justify-content: space-around;
        align-items: end;
    }

    .product__list__wrap .prd__meun li {
        list-style: none;
        align-items: center;
        gap: 10px;
    }

    .product__list__wrap .prd__meun li img {
        width: 20px;
    }

    .addProductBtn {
        border: 1px solid #dcdcdc;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: var(--ft-no);
        font-size: 13px;
        letter-spacing: normal;
        color: #000;
        padding: 90px;
        margin-bottom: 200px;
    }

    .prd__meun__grid .swiper-slide .prd__meun__box .prd__img__wrap {
        width: auto;
    }

    .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__title {
        width: auto;
    }

    /* 여기부터 상품 */
    .product-wrap {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    .product {
        width: 25%;
    }
    .product .whish_img {
        width: 16px;
        height: 14px;
    }
    .product-img{
        background-color:#F8F8F8;
    }
    .add-btn{
        font-family: var(--ft-no);
        font-size: 13px;
        font-weight: 400;
        line-height: 1.46;
        text-align: center;
        color:var(--bk)
    }

    @media (max-width:1025px) {
        .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__img {
            height: 100px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__title {
            text-align: center;
            width: 55px;
        }

        .product__list__wrap .prd__meun__swiper .prd__meun__box {
            width: 100px;
        }

        .product__list__wrap .prd__meun {
            display: flex;
            flex-direction: column;
            padding-bottom: 15px;
            padding-top: 20px;
        }

        .product__list__wrap .prd__meun .prd__meun__grid {
            display: flex;
            grid-column: 2/10;
            justify-content: space-around;
            padding-bottom: 6px;
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 10px;
        }

        .product__list__wrap .prd__meun .prd__meun__swiper {
            display: flex;
            width: 100%;
            overflow: hidden;
        }

        .prd__meun__grid .prd__meun__box .prd__title {
            font-family: var(--ft-no);
            font-size: 1rem;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.42;
            color: #343434;
            opacity: 0.5;
        }

        .prd__meun__grid .prd__meun__sort span {
            font-family: var(--ft-no);
            font-size: 12px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.42;
            color: #343434;
        }

        .sort__grid {
            display: flex;
            gap: 10px;
        }

        .sort__grid[data-grid='2'] img {
            width: 21px !important;
        }

        .sort__grid[data-grid='4'] img {
            width: 41px !important;
        }

        .prd__meun__grid .swiper-button-prev {
            position: relative;
            left: -50px;
            top: 67px;
            color: #000;
            height: 30px;
            width: 10px;
        }

        .prd__meun__grid .swiper-button-prev::after {
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(90deg);
        }

        .prd__meun__grid .swiper-button-next::after {
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(270deg);
        }

        .prd__meun__grid .swiper-button-next {
            position: relative;
            left: 30px;
            color: #000;
        }

        .prd__meun__grid .swiper-slide:first-child .prd__meun__box .prd__img__wraps {
            border: 1px solid #dcdcdc;
        }

        .prd__meun__grid .swiper-slide .prd__meun__box {
            padding: 0 10px;
        }



        .product__list__wrap .prd__meun .prd__meun__sort {
            display: flex;
            grid-column: 13/17;
            justify-content: space-around;
            align-items: end;
        }

        .product__list__wrap .prd__meun li {
            list-style: none;
            align-items: center;
            gap: 10px;
        }

        .product__list__wrap .prd__meun li img {
            width: 20px;
        }

        [data-sold="true"]::after {
            content: url('/images/svg/sold-line.svg');
            position: relative;
            right: 13px;
            top: 4px;
        }

        .addProductBtn {
            border: 1px solid #dcdcdc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: var(--ft-no);
            font-size: 1.3rem;
            letter-spacing: normal;
            color: #000;
            background-color: #fbfbfb;
            padding: 40px;
            margin-bottom: 150px;
        }

        .product__list__wrap .prd__meun__swiper .prd__meun__box .prd__img {
            height: 60px;
        }

        .prd__meun__grid .swiper-slide .prd__meun__box .prd__img__wrap {
            width: 55px;
        }

        .prd__meun__grid .swiper-slide:first-child .prd__meun__box .prd__img__wrap {
            border: 1px solid #dcdcdc;
        }

        .prd__meun__grid .prd__meun__box.select .prd__title {
            opacity: 1;
        }

    }
</style>
<main>
    <?php
    function getUrlParamter($url, $sch_tag)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return $query[$sch_tag];
    }

    $page_url = $_SERVER['REQUEST_URI'];
    $page_idx = getUrlParamter($page_url, 'menu_sort');
    $page_idx = getUrlParamter($page_url, 'menu_idx');
    $page_idx = getUrlParamter($page_url, 'page_idx');
    if ($page_idx == null) {
        $page_idx = 1;
    }
    ?>
    <input id="menu_sort" type="hidden" value="<?= $menu_sort ?>">
    <input id="menu_idx" type="hidden" value="<?= $menu_idx ?>">
    <input id="page_idx" type="hidden" value="<?= $page_idx ?>">
    <input id="country" type="hidden" value="KR">
    <input id="last_idx" type="hidden" value="0">

    <section class="product__list__wrap">
        <div class="top__banner"></div>
        <div class="prd__meun">
            <div class="prd__meun__grid"></div>

            <div class="prd__meun__sort">
                <li class="flex">
                    <img src="/images/svg/sort-bottom.svg" alt="" style="width: 10px;">
                    <span>정렬</span>
                </li>
                <li class="flex">
                    <img src="/images/svg/filter.svg" alt="" style="width: 15px;">
                    <span>필터</span>
                </li>
                <li class="flex" style="cursor:pointer;" onClick="changeImgType();">
                    <img src="/images/svg/cloth.svg" alt="" style="width: 11px;">
                    <input type="hidden" id="img_param" value="P">
                    <span id="img_type_text">착용보기</span>
                </li>
                <li class="hidden lg:block">
                    <div class="rW sort__grid" data-grid="2">
                        <img src="/images/svg/grid-cols-2.svg" alt="">
                        <span>2칸보기</span>
                    </div>
                </li>
                <li class="lg:hidden">
                    <div class="rM sort__grid" data-grid="2">
                        <img src="/images/svg/grid-cols-2.svg" alt="">
                        <span>2칸보기</span>
                    </div>
                </li>
            </div>
        </div>

        <div class="product__list__body">
            <!-- <div class="product-wrap" data-grid="4">
                <div class="product">
                    <div class="wish__btn" whish_idx="" product_idx="1" onclick="deleteWhishList(this)">
                        <img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">
                    </div>
                    <a href="">
                        <div class="product-img swiper" >
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="info-row">
                            <div class="name" data-soldout="STCL">Sample BLAFWTB09GN</div>
                            <div class="price" data-soldout="STSO">150,000</div>
                        </div>
                        <div class="info-row">
                            <div class="color-title">Green</div>
                        </div>
                        <div class="info-row">
                            <div class="color__box" data-maxcount="true" data-colorcount="2">
                                <div class="color" data-color="#ffffff" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STSO" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STSO" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background: linear-gradient(90deg, blue ,red);"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                            </div>
                            <div class="size__box">
                                <li class="size" data-productidx="2" data-optionidx="" data-sizetype="O" data-soldout="STSO">One size</li>
                                <li class="size" data-productidx="2" data-optionidx="" data-sizetype="S" data-soldout="STSO">UK8</li>
                                <li class="size" data-productidx="2" data-optionidx="" data-sizetype="" data-soldout="STSO">UK8</li>
                                <li class="size" data-productidx="2" data-optionidx="" data-soldout="STCL">A1</li>
                                <li class="size" data-productidx="2" data-optionidx="" data-soldout="STSC">A3</li>
                                <li class="size" data-productidx="2" data-optionidx="" data-soldout="STSO">A4</li>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="product">
                    <div class="wish__btn" whish_idx="" product_idx="1" onclick="deleteWhishList(this)">
                        <img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">
                    </div>
                    <a href="">
                        <div class="product-img swiper" >
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img class="prd-img" src="http://116.124.128.246:81/images/product/img_BLAFWKV01BL_01_P_M_202210210000.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="info-row">
                            <div class="name">Sample BLAFWTB09GN</div>
                            <div class="price" data-saleprice="100000" data-discount="15" data-dis="true">150,000</div>
                        </div>
                        <div class="info-row">
                            <div class="color-title">Green</div>
                        </div>
                        <div class="info-row">
                            <div class="color__box" data-maxcount="true" data-colorcount="2">
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STSO" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STSO" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                                <div class="color" data-productidx="2" data-soldout="STIN" style="background-color:#379E57"></div>
                            </div>
                            <div class="size__box">
                                <li class="size" data-productidx="2" data-optionidx="null" data-soldout="STIN">A1</li>
                                <li class="size" data-productidx="2" data-optionidx="null" data-soldout="STCL">A1</li>
                                <li class="size" data-productidx="2" data-optionidx="null" data-soldout="STSC">A3</li>
                                <li class="size" data-productidx="2" data-optionidx="null" data-soldout="STSO">A4</li>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div> -->
        </div>
        <div class="addProductBtn" style="cursor:pointer;" onClick="getMoreProduct();">
            <span class="add-btn">더보기 +</span>
            <img src="" alt="">
        </div>
    </section>
</main>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        getProductList();
        imgSwiper();
    });
    window.addEventListener("scroll", function () {
        const scrollHeight = window.scrollY;
        const windowHeight = window.innerHeight;
        const docTotalHeight = document.body.offsetHeight;
        const isBottom = windowHeight + scrollHeight === docTotalHeight;
        
        if (isBottom) { 
            getMoreProduct();
        }
    });

    function changeImgType() {
        $('#last_idx').val(0);

        let img_param = $('#img_param');
        let img_type_text = "";

        if (img_param.val() == "P") {
            img_param.val('O');
            img_type_text = "아이템보기";
        } else if (img_param.val() == "O") {
            img_param.val('P');
            img_type_text = "착용보기";
        }
        $('#img_type_text').text(img_type_text);

        $('.product__list__body').html('');

        getProductList();
    }

    const getProductList = () => {
        let menu_sort = $('#menu_sort').val();
        let menu_idx = $('#menu_idx').val();
        let page_idx = $('#page_idx').val();
        let country = $('#country').val();
        let img_param = $('#img_param').val();
        let last_idx = $('#last_idx').val();

        $.ajax({
            type: "post",
            data: {
                "menu_sort": menu_sort,
                "menu_idx": menu_idx,
                "page_idx": page_idx,
                "country": country,
                "img_param": img_param,
                "last_idx": last_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/product/list/get",
            error: function() {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let imgUrl = "http://116.124.128.246:81";
                let pageIdx = "?page_idx=" + page_idx;

                let data = d.data;

                let productListHtml = "";
                let imgDiv = "";
                const domFrag = document.createDocumentFragment();

                const menuList = document.querySelector(".prd__meun__grid");

                const prdListBox = document.createElement("div");
                const prdListBody = document.querySelector(".product__list__body");
                prdListBox.classList.add("product-wrap");
                prdListBox.dataset.grid = "4";

                let menu_info = data.menu_info;

                let img_name = ['img_d_02_221107000000.png', 'img_d_03_221107000000.png', 'img_d_04_221107000000.png', 'img_d_05_221107000000.png', 'img_d_06_221107000000.png', 'img_d_07_221107000000.png', 'img_d_08_221107000000.png',
                    'img_d_02_221107000000.png', 'img_d_03_221107000000.png', 'img_d_04_221107000000.png', 'img_d_05_221107000000.png', 'img_d_06_221107000000.png', 'img_d_07_221107000000.png', 'img_d_08_221107000000.png'
                ];

                let menuHtml = `
					<div class="swiper-button-prev"></div>

					<div class="prd__meun__swiper">
						<div class="swiper-wrapper">
                            <div class="swiper-slide" onClick="location.href=''">
								<div class="prd__meun__box select">
									<div class="prd__img__wrap">
										<div class="prd__img" style="background-image: url('/images/menu/dtl/img_d_01_221107000000.png');"></div>
									</div>
									<p class="prd__title">전체보기</p>
								</div>
							</div>`

                menu_info.forEach((el, idx) => {
                    menuHtml += `
							<div class="swiper-slide" onClick="location.href='${el.menu_link}'">
								<div class="prd__meun__box">
									<div class="prd__img__wrap">
										<div class="prd__img" style="background-image: url('/images/menu/dtl/${img_name[idx]}');"></div>
									</div>
									<p class="prd__title">${el.menu_title}</p>
								</div>
							</div>`;
                });

                menuHtml += `
							</div>
						</div>

						<div class="swiper-button-next"></div>`;
                menuList.innerHTML = menuHtml;

                let product_info = data.product_info;
                product_length = product_info.length;

                let productwriteData = productWriteHtml(product_info);
                prdListBox.innerHTML = productwriteData;
                domFrag.appendChild(prdListBox);
                prdListBody.appendChild(domFrag);
                // productListSelectGrid();
                imgSwiper();
                productCategorySwiper();
            }
        });
    }

    function getMoreProduct() {
        let last_idx = parseInt($('#last_idx').val());
        last_idx++;

        $('#last_idx').val(last_idx);

        let menu_sort = $('#menu_sort').val();
        let menu_idx = $('#menu_idx').val();
        let page_idx = $('#page_idx').val();
        let country = $('#country').val();
        let img_param = $('#img_param').val();

        $.ajax({
            type: "post",
            data: {
                "menu_sort": menu_sort,
                "menu_idx": menu_idx,
                "page_idx": page_idx,
                "country": country,
                "img_param": img_param,
                "last_idx": last_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/product/list/get",
            error: function() {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let pageIdx = "?page_idx=" + page_idx;
                let data = d.data;
                let imgDiv = "";
                let product_info = data.product_info;
                let productwriteData = productWriteHtml(product_info);
                $(".product-wrap").append(productwriteData);
                // productListSelectGrid();
            }
        });
    }
    function productWriteHtml(productInfo){
        let productListHtml ="";
        let imgUrl = "http://116.124.128.246:81";

        productInfo.forEach(el => {
            let whish_img = "";
            let whish_function = "";

            let whish_flg = `${el.whish_flg}`;
            if (whish_flg == 'true') {
                whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="">';
                whish_function = "deleteWhishList(this)";
            } else if (whish_flg == 'false') {
                whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
                whish_function = "setWhishList(this)";
            }
            let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
            let colorCtn = el.product_color.length;
            
            productListHtml +=
            `<div class="product" style="cursor:pointer;">
                <div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="${whish_function}">
                    ${whish_img}
                </div>
                <a href="http://116.124.128.246:80/${el.link_url}">
                    <div class="product-img swiper" onClick="location.href='/product/detail?product_idx=${el.product_idx}'">
                        <div class="swiper-wrapper">
                        ${
                            el.product_img.map((img) => {
                                if(img.img_type="p"){
                                    imgDiv = `<div class="swiper-slide">
                                        <img class="prd-img" cnt="${el.product_idx}" src="${imgUrl}${img.img_location}" alt="">
                                    </div>`
                                }
                                return imgDiv;
                            }).join("")
                        }
                        </div>
                    </div>
                </a>
                <div class="product-info">
                    <div class="info-row">
                        <div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}>${el.product_name}</div>
                        ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true">${el.price.toLocaleString('ko-KR')}</div>`} 
                    </div>
                    <div class="info-row">
                        <div class=""></div>
                    </div>
                    <div class="color-title">${el.color}</div>
                    <div class="info-row">
                        <div class="color__box" data-maxcount="${colorCtn < 6 ?"ture":"false"}" data-colorcount="${colorCtn}">
                            ${
                                el.product_color.map((color, idx) => {
                                    let maxCnt = 5;
                                    if(idx <= maxCnt){
                                        return `<div class="color" data-color="${color.color_rgb}" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
                                    }
                                }).join("")
                            }
                        </div>
                        <div class="size__box">
                            ${
                            el.product_size.map((size) => {
                                return`<li class="size" data-sizetype="" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
                                }).join("")
                            }   
                        </div>
                    </div>
                </div>
            </div>
            `;
        });
        imgSwiper();
        return productListHtml;
    }
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
                error: function() {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function(d) {
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
                error: function() {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function(d) {
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
    //모바일 & 웹 그리드별 보기 기능
    () => {
        const $$product = document.querySelectorAll('.product');
        $$product.forEach((el) => {
            el.addEventListener("click", () => {
                location.href = "http://116.124.128.246:80/product/detail"
            });
        })
    }

    /* 모바일 & 웹 상품 카테고리 스와이프 */
    const productCategorySwiper = () => {
        let productListSwiper = new Swiper(".prd__meun__swiper", {
            navigation: {
                nextEl: ".prd__meun__swiper .swiper-button-next",
                prevEl: ".prd__meun__swiper .swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            grabCursor: true,
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 5.5,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 5.5,
                    spaceBetween: 10

                },
                768: {
                    slidesPerView: 8,
                    spaceBetween: 10

                }
            }
        });
    }
    const imgSwiper = () => {
        let productImgSwiper = new Swiper(".product-img", {
            navigation: {
                nextEl: ".product-img .swiper-button-next",
                prevEl: ".product-img .swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoHeight: true,
            grabCursor: true,
            slidesPerView: 1
        });
        // productImgSwiper.forEach(el => {
        //     //el.disable();
        // })
        return productImgSwiper;
    }
    const productListSelectGrid = () => {
        let $body = document.querySelector("body");
        let $prdListBox = document.querySelector(".product-wrap");
        let mql = window.matchMedia("screen and (max-width: 1024px)");

        let $webSortGrid = document.querySelector(".rW.sort__grid");
        let $websortSpan = document.querySelector(".rW.sort__grid").querySelector('span');
        let $websortImg = document.querySelector(".rW.sort__grid").querySelector('img');

        let $mobileSortGrid = document.querySelector(".rM.sort__grid");
        let $mobileSortSpan = document.querySelector(".rM.sort__grid").querySelector('span');
        let $mobileSortImg = document.querySelector(".rM.sort__grid").querySelector('img');
        //그리드 초기화 
        if (mql.matches) {
            $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
            $prdListBox.dataset.grid = 3;
            $mobileSortSpan.innerText = '2칸보기';
        } else {
            $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
            $prdListBox.dataset.grid = 4;
        }
        const backgroundImg = imgSwiper();
        //웹 sort 버튼 클릭
        $webSortGrid.addEventListener("click", () => {
            let currentGrid = document.querySelector(".product-wrap").dataset.grid;
            switch (currentGrid) {
                case "2":
                    //그리드 버튼 변경
                    $webSortGrid.dataset.grid = 2;
                    $websortSpan.innerText = '2칸보기';
                    $websortImg.src = '/images/svg/grid-cols-2.svg';
                    //그리드 박스 변경
                    $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                    $prdListBox.dataset.grid = 4;
                    swiperDisable($prdListBox.dataset.grid);
                    break;

                case "4":
                    //그리드 버튼 변경
                    $webSortGrid.dataset.grid = 4;
                    $websortSpan.innerText = '4칸보기';
                    $websortImg.src = '/images/svg/grid-cols-4.svg';
                    //그리드 박스 변경
                    $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                    $prdListBox.dataset.grid = 2;
                    swiperDisable($prdListBox.dataset.grid);
                    break;
            }
        });
        //모바일 sort 버튼 클릭
        $mobileSortGrid.addEventListener("click", () => {
            currentGrid = document.querySelector(".product-wrap").dataset.grid;
            switch (currentGrid) {
                case "3":
                    $mobileSortGrid.dataset.grid = 1;
                    $mobileSortSpan.innerText = '1칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-2.svg';

                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 2;
                    swiperDisable($prdListBox.dataset.grid);
                    break;

                case "2":
                    $mobileSortGrid.dataset.grid = 3;
                    $mobileSortSpan.innerText = '3칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-3.svg';

                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 1;
                    swiperDisable($prdListBox.dataset.grid);
                    break;
                case "1":
                    $mobileSortGrid.dataset.grid = 2;
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-2.svg';

                    $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                    $prdListBox.dataset.grid = 3;
                    swiperDisable($prdListBox.dataset.grid);
                    break;
            }
            return currentGrid;
        });
        //사이즈 변경시 그리드 대응
        window.addEventListener('resize', function() {
            if (mql.matches) {
                $mobileSortSpan.innerText = '2칸보기';

                $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                $prdListBox.dataset.grid = 3;
                swiperDisable($prdListBox.dataset.grid);
            } else {
                $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                $prdListBox.dataset.grid = 4;
                swiperDisable($prdListBox.dataset.grid);
            }
        });

        // function swiperDisable(value) {
        //     let height_per = 0;

        //     let img_param = $('#img_param').val();

        //     if (img_param == "P") {
        //         height_per = 1.7
        //     } else if (img_param == "O") {
        //         height_per = 2.25
        //     }

        //     backgroundImg.forEach(el => {
        //         if (value == "4") {
        //             el.disable();

        //             let el_height = 600;
        //             $('.product').find('.prd__img').css('height', el_height + 'px');

        //             el.update();
        //         }
        //         if (value == "3") {
        //             el.disable();

        //             let el_height = 225;
        //             $('.product').find('.prd__img').css('height', el_height + 'px');

        //             el.update();
        //         }
        //         if (value == "2") {
        //             el.enable();

        //             let el_height = imgResize(1, height_per, el.width);
        //             $('.product').find('.prd__img').css('height', el_height + 'px');

        //             el.update();
        //         }
        //         if (value == "1") {
        //             el.enable();

        //             let el_height = imgResize(1, height_per, el.width);
        //             $('.product').find('.prd__img').css('height', el_height + 'px');

        //             el.update();
        //         }
        //     });
        // }
    }

    const imgResize = (ratioX, ratioY, width) => {
        //console.log(ratioX)
        //console.log(ratioY)
        //console.log(width)
        return (ratioY * width) / ratioX;
    }
</script>