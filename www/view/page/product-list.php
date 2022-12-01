<?php include $_CONFIG['PATH']['PAGE'] . '/components/wishlist.php';?>
<link rel=stylesheet href='/css/product/list.css' type='text/css'>
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
                <div class="sort-title">22FW 전체보기</div>
                <div class="sort-wrap">
                    <li class="sort-btn">
                        <img src="/images/svg/sort-bottom.svg" alt="">
                        <span>정렬</span>
                    </li>
                    <li class="sort-btn">
                        <img src="/images/svg/filter.svg" alt="">
                        <span>필터</span>
                    </li>
                    <li class="sort-btn type-btn" onClick="changeImgType();">
                        <img src="/images/svg/cloth.svg" alt="">
                        <input type="hidden" id="img_param" value="P">
                        <span id="img_type_text">착용보기</span>
                    </li>
                    <div class="sort-btn web rW sort__grid" data-grid="4">
                            <img src="/images/svg/grid-cols-2.svg" alt="">
                            <span>2칸보기</span>
                    </div>
                    <div class="sort-btn mobile rM sort__grid" data-grid="3">
                            <img src="/images/svg/grid-cols-2.svg" alt="">
                            <span>2칸보기</span>
                        </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="prd__category__wrap">
                <div class="prd__meun__category">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="title">다운</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">자켓</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">가죽</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">코드</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">블레이저</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">조끼</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="title">니트</div>
                        </div>
                    </div>
                </div>
            <div class="line"></div>
            </div>

        </div>

        <div class="product__list__body"></div>
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

    // window.addEventListener('resize', function() {
    //         console.log("product-resize");
    //         let screenWidth = document.querySelector("body").offsetWidth;
    //         if (1024 <= screenWidth ) {
    //             console.log("web");

    //         }else {
    //             console.log("mobile");
    //         }
    //      
    //     });
    window.addEventListener("scroll", function () {
        const scrollHeight = window.scrollY;
        const windowHeight = window.innerHeight;
        const docTotalHeight = document.body.offsetHeight;
        const isBottom = windowHeight + scrollHeight === docTotalHeight;
        
        if (isBottom) { 
            //getMoreProduct();
        }
    });

    function changeImgType() {
        $('#last_idx').val(0);
        let imgType = "imgType"
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
        getProductList(imgType);
    }

    const getProductList = (imgType) => {
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
                "last_idx": last_idx,
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
                prdListBox.dataset.webpre = "4";
                prdListBox.dataset.mobilepre = "3";

                let menu_info = data.menu_info;

                let img_name = [
                    'product-list_Thumb_1.png', 
                    'product-list_Thumb_2.png', 
                    'product-list_Thumb_3.png', 
                    'product-list_Thumb_4.png', 
                    'product-list_Thumb_5.png', 
                    'product-list_Thumb_6.png', 
                    'product-list_Thumb_7.png', 
                    'product-list_Thumb_8.png', 
                    'product-list_Thumb_9.png', 
                    'product-list_Thumb_10.png', 
                    'product-list_Thumb_11.png', 
                    'product-list_Thumb_1.png', 
                    'product-list_Thumb_2.png', 
                    'product-list_Thumb_3.png', 
                    'product-list_Thumb_4.png', 
                    'product-list_Thumb_5.png', 
                    'product-list_Thumb_6.png', 
                    'product-list_Thumb_7.png', 
                    'product-list_Thumb_8.png', 
                    'product-list_Thumb_9.png', 
                    'product-list_Thumb_10.png', 
                    'product-list_Thumb_11.png'
                ];

                let menuHtml = `
                
                <div class="prd__meun__swiper">
						<div class="swiper-wrapper">`

                    img_name.forEach((el, idx) => {
                    menuHtml += `
							<div class="swiper-slide" onClick="location.href='${el.menu_link}'">
								<div class="prd__meun__box">
									<div class="prd__img__wrap">
                                        <img class="prd__img" src="/images/sample/${img_name[idx]}" alt="">
									</div>
									<p class="prd__title">컬렉션</p>
								</div>
							</div>`;
                });

                menuHtml += `
                        </div>
                    <div class="swiper-scrollbar"></div>
                    <div class="navigation">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                        
                </div>`;
                menuList.innerHTML = menuHtml;

                let product_info = data.product_info;
                product_length = product_info.length;

                let productwriteData = productWriteHtml(product_info);
                prdListBox.innerHTML = productwriteData;
                domFrag.appendChild(prdListBox);
                prdListBody.appendChild(domFrag);
                productListSelectGrid(imgType);
                imgSwiper();
                productCategorySwiper();
                productSml();
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
                productListSelectGrid(imgType);
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
            `<div class="product">
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
                        <div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
                        ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                    </div>
                    <div class="color-title"><span>${el.color}</span></div>
                    <div class="info-row">
                        <div class="color__box" data-maxcount="${colorCtn < 6 ?"":"over"}" data-colorcount="${colorCtn < 6 ? colorCtn: colorCtn - 5}">
                            ${
                                el.product_color.map((color, idx) => {
                                    let maxCnt = 5;
                                    if(idx < maxCnt){
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
            scrollbar: {
                el: '.prd__meun__swiper .swiper-scrollbar',
                draggable: true,
                dragSize:45
            },
            grabCursor: true,
            breakpoints: {
                320: {
                slidesPerView: 5.5
                },
                1024: {
                    slidesPerView: 10.5,
                    spaceBetween: 10
                }
            }
        });
    }
    const productSml = () => {
        let productListSwiper = new Swiper(".prd__meun__category", {
            grabCursor: true,
            slidesPerView: 10,
            pagination: {
                el: ".prd__meun__category .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                slidesPerView: 5.9,
                spaceBetween: 10
                },
                1024: {
                    slidesPerView: 15,
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
            slidesPerView: 1,
            on:{
                update:function(){
                },
                updateSlides:function(){
                }
            }
        });
        // productImgSwiper.forEach(el => {
        //     //el.disable();
        // })
        return productImgSwiper;
    }
    const productListSelectGrid = (imgType) => {
        let $body = document.querySelector("body");
        let $prdListBox = document.querySelector(".product-wrap");
        let mql = window.matchMedia("screen and (max-width: 1024px)");

        let $webSortGrid = document.querySelector(".rW.sort__grid");
        let $websortSpan = document.querySelector(".rW.sort__grid").querySelector('span');
        let $websortImg = document.querySelector(".rW.sort__grid").querySelector('img');

        let $mobileSortGrid = document.querySelector(".rM.sort__grid");
        let $mobileSortSpan = document.querySelector(".rM.sort__grid").querySelector('span');
        let $mobileSortImg = document.querySelector(".rM.sort__grid").querySelector('img');
        let resizeTimer = null;
        let imgParam = document.getElementById("img_param").value;
        
        //그리드 초기화 
        if (mql.matches) {
            mobileGridEvent();
        } else {
            webGridEvent();
        }
        
        //웹 sort 버튼 클릭
        $webSortGrid.addEventListener("click", () => {
            webGridEvent();
        });
        //모바일 sort 버튼 클릭
        $mobileSortGrid.addEventListener("click", () => {
            mobileGridEvent();
        });
        window.addEventListener('resize', function() {
            
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(gridResize);
        }, false);


        function productSwiperUpdate() {
            let grid = $prdListBox.dataset.grid;
            const backgroundImg = imgSwiper();
            backgroundImg.forEach(el => {

            });
        }
        function webGridEvent() {
            const $productWrapEl = document.querySelector(".product-wrap");
            let currentWebGrid = document.querySelector(".rW.sort__grid").dataset.grid;
            switch (currentWebGrid) {
                case "2":
                    $prdListBox.dataset.grid = 2;
                    $prdListBox.dataset.webpre = 2;
                    
                    //그리드 버튼 변경
                    //그리드 박스 변경
                    if(imgType === "imgType"){
                        $prdListBox.dataset.grid = 2;
                    }
                    else{
                        console.log("탐?")
                        $webSortGrid.dataset.grid = 4;
                        $websortSpan.innerText = '4칸보기';
                        $websortImg.src = '/images/svg/grid-cols-4.svg';
                        productSwiperUpdate();
                    }
                break;

                case "4":
                    //그리드 버튼 변경
                    $prdListBox.dataset.grid = 4;
                    $prdListBox.dataset.webpre = 4;

                    //그리드 박스 변경
                    if(imgType ==="imgType"){
                        $prdListBox.dataset.grid = 4;
                    }else {
                        $webSortGrid.dataset.grid = 2;
                        $websortSpan.innerText = '2칸보기';
                        $websortImg.src = '/images/svg/grid-cols-2.svg';
                        productSwiperUpdate();
                    }
                break;
            }
        }
        function mobileGridEvent() {
            currentGrid = document.querySelector(".rM.sort__grid").dataset.grid;
            switch (currentGrid) {
                case "1":
                    $prdListBox.dataset.mobilepre = 1;
                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 1;


                    if(imgType ==="imgType"){
                        $mobileSortGrid.dataset.grid = 1;
                    }else {
                        $mobileSortGrid.dataset.grid = 3;
                        $mobileSortSpan.innerText = '3칸보기';
                        $mobileSortImg.src = '/images/svg/grid-cols-3.svg';
                    }
                    let swiper = productSwiperUpdate();
                    
                    break;

                case "2":
                    $prdListBox.dataset.mobilepre = 2;
                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 2;

                    if(imgType ==="imgType"){
                        $mobileSortGrid.dataset.grid = 2;
                    }else {
                        $mobileSortGrid.dataset.grid = 1;
                        $mobileSortSpan.innerText = '1칸보기';
                        $mobileSortImg.src = '/images/svg/grid-cols-1.svg';
                    }
                    productSwiperUpdate();
                    break;
                case "3":
                    $prdListBox.dataset.mobilepre = 3;
                    $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                    $prdListBox.dataset.grid = 3;

                    if(imgType ==="imgType"){
                        $mobileSortGrid.dataset.grid = 3;
                    }else {
                        $mobileSortGrid.dataset.grid = 2;
                        $mobileSortSpan.innerText = '2칸보기';
                        $mobileSortImg.src = '/images/svg/grid-cols-2.svg';
                    }
                    productSwiperUpdate();
                    break;
            }
            return currentGrid;
        }
        //사이즈 변경시 그리드 대응
        function gridResize() {
            let webBeforeGrid = $prdListBox.dataset.webpre;
            let mobileBeforeGrid = $prdListBox.dataset.mobilepre; 
            let screenWidth = document.querySelector("body").offsetWidth;
            
            if (1024 <= screenWidth ) {
                $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                $prdListBox.dataset.grid = webBeforeGrid;
                
            } else {
                if(mobileBeforeGrid === 1){
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;    
                }else if(mobileBeforeGrid === 2){
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;    
                } else{
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;    
                }
                $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                $prdListBox.dataset.grid = mobileBeforeGrid;
            }
        }
    }
    const imgResize = (ratioX, ratioY, width) => {
        return (ratioY * width) / ratioX;
    }
</script>