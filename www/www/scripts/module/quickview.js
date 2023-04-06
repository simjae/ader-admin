    let quickNowData;
    let target = document.getElementById("quickview_observer");
    let contentWrap = document.querySelector(".quickview__content__wrap");
    let quickViewWarp = document.querySelector(".quickview__box");
    contentWrap.addEventListener('mouseenter', function() {
        target.value = 'open';
    })
    quickViewWarp.addEventListener('mouseleave', function() {
        target.value = 'close';
    })



    // ------------- 스와이프  ------------- //
    let quickviewBreakpoint = window.matchMedia('screen and (min-width:1025px)'); //미디어 쿼리 
    let sideQuickSwiper; //스와이퍼 변수
    const webSideQuickSwiperOption = {
        autoHeight: false,
        navigation: {
            nextEl: ".swiper-quick-container .swiper-button-next",
            prevEl: ".swiper-quick-container .swiper-button-prev",
        },
        breakpointsBase: "container",
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
        navigation: {
            nextEl: ".quickview-whish-swiper .swiper-button-next",
            prevEl: ".quickview-whish-swiper .swiper-button-prev",
        },
        autoHeight: true,
        spaceBetween: 5,
        slidesPerView: 6.2
    }
    function initSideQuickSwiper(el, option) {
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
    // ------------- 스와이프  ------------- //


    
    //인기상품 API
    function getPopularProductList() {
        let country = getLanguage();
        $.ajax({
            type: "post",
            data: {
                'country': country
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/popular/get",
            error: function() {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                writeSwiperHtml(data);
            }
        });
    }
    //위시리스트 API
    function getWhishlistProductList() {
        let country = getLanguage();
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/list/get",
            error: function() {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                if (data != null) {
                    writeWishlistSwiperHtml(data);
                    quickNowData = data;
                } else {
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
                    $('.quickview-whish-swiper .swiper-button-next').hide();
                    $('.all-btn').hide();

                }
            }
        });
    }
    //퀵뷰 UI 넓이 계산 
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

        $(".swiper-quick-container .quickview-swiper-wrapper").css('width', width);
    }
    //최근본상품 슬라이드 HTML 
    function recentWriteSwiperHtml(data) {
        if (data != null) {
            let dataCnt = 0;
            dataCnt = data.length;
            const whishDomFlag = document.createDocumentFragment();
            const swiperWrapper = document.createElement("div");
            const swiperWrap = document.querySelector("#quickview .quickview-whish-swiper");
            const nextBtn = document.createElement("div");

            if (data.length === 0) {
                let msgDiv = `<div class="wish-msg">최근 본 상품이 비어있습니다.</div>`;
                swiperWrap.innerHTML = msgDiv;
                $('.quickview__content__wrap .all-btn').hide();
            } else {
                nextBtn.className = "swiper-button-next";
                swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";
                let slideDiv = "";
                data = Array.from(data).reverse();
                data.forEach((product, idx) => {
                    let data = JSON.parse(product);
                    let {
                        product_idx,
                        product_name,
                        img_main,
                        stock_status
                    } = data;
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
                responsiveQuickSwiper(el);
            }
        }
    }
    // 위시리스트 템플릿 HTML
    function writeWishlistSwiperHtml(data) {
        const mobileWishDom = () => {
            const whishMoDomFlag = document.createElement("div");
            whishMoDomFlag.classList.add("quickview__content__wrap", "open");

            const contentHeader = document.createElement("div");
            contentHeader.classList.add("content-header");

            const titleBox = document.createElement("div");
            titleBox.classList.add("title__box");

            const titleImg = document.createElement("img");
            titleImg.setAttribute("src", "/images/svg/wish-list-bk.svg");
            titleImg.setAttribute("alt", "");

            const titleSpan = document.createElement("span");
            titleSpan.innerText = "위시리스트";

            titleBox.appendChild(titleImg);
            titleBox.appendChild(titleSpan);

            const titleBoxBtn = document.createElement("div");
            titleBoxBtn.classList.add("title__box--btn");

            const allBtn = document.createElement("div");
            allBtn.classList.add("all-btn", "mobile");
            allBtn.innerText = "+ 전체 보기";
            allBtn.setAttribute("onclick", "location.href='http://116.124.128.246:80/order/whish'");

            const removeBtn = document.createElement("div");
            removeBtn.classList.add("remove-btn");
            const removeImg1 = document.createElement("img");
            removeImg1.setAttribute("src", "/images/svg/sold-line.svg");

            const removeImg2 = document.createElement("img");
            removeImg2.setAttribute("src", "/images/svg/sold-line.svg");

            removeBtn.appendChild(removeImg1);
            removeBtn.appendChild(removeImg2);

            titleBoxBtn.appendChild(allBtn);
            titleBoxBtn.appendChild(removeBtn);

            contentHeader.appendChild(titleBox);
            contentHeader.appendChild(titleBoxBtn);

            const swiperQuickContainer = document.createElement("div");
            swiperQuickContainer.classList.add("swiper-quick-container");

            const quickviewWhishSwiper = document.createElement("div");
            quickviewWhishSwiper.classList.add("quickview-whish-swiper");

            swiperQuickContainer.appendChild(quickviewWhishSwiper);

            whishMoDomFlag.appendChild(contentHeader);
            whishMoDomFlag.appendChild(swiperQuickContainer);
           
            return whishMoDomFlag;

        }
        if (data != null) {
            let dataCnt = data.length;

            const swiperWrapper = document.createElement("div");
            swiperWrapper.className = "swiper-wrapper quickview-swiper-wrapper";

            const nextBtn = document.createElement("div");
            nextBtn.className = "swiper-button-next";

            let slideDiv = "";
            data.forEach((product, idx) => {
                let { product_idx, product_name, product_img } = product;
                slideDiv += `
                    <div class="swiper-slide" data-productidx="${product_idx}">
                    <a href="116.124.128.246:80/product/detail?product_idx=${product_idx}">
                        <div class="swiper-box">
                        <img src="${img_root}${product_img}" alt="">
                        <span class="product-name">${product_name}</span>
                        </div>
                    </a>
                    </div>
                `;
            });

            swiperWrapper.innerHTML = slideDiv;
            console.log("🏂 ~ file: quickview.js:292 ~ writeWishlistSwiperHtml ~ swiperWrapper:", swiperWrapper)

            const whishDomFlag = document.createDocumentFragment();
            whishDomFlag.appendChild(swiperWrapper);
            console.log("🏂 ~ file: quickview.js:295 ~ writeWishlistSwiperHtml ~ whishDomFlag:", whishDomFlag)

            const whishSwiperWrap = document.querySelector("#quickview .quickview-whish-swiper");
            whishSwiperWrap.innerHTML = "";
            whishSwiperWrap.appendChild(whishDomFlag);
            whishSwiperWrap.appendChild(nextBtn);
            
            const whishMoSwiperWrap = document.querySelector(".mobile-whishlist-wrap");
            if(whishMoSwiperWrap !== null){
                whishMoSwiperWrap.innerHTML = "";
                const swiperMoWrapper = swiperWrapper.cloneNode(true);
                let mobileResult = mobileWishDom();
                mobileResult.querySelector('.quickview-whish-swiper').appendChild(swiperMoWrapper);
                whishMoSwiperWrap.appendChild(mobileResult)
                mobileQuickviewContentClose()
            }
            resizeWidth(dataCnt);
            responsiveQuickSwiper(".quickview-whish-swiper");
        }
        function mobileQuickviewContentClose() {
            $('.basket__wrap--btn.nav .remove-btn').on('click', () => {
                $('.mobile-whishlist-wrap .quickview__content__wrap').removeClass('open');
                $('.mobile-whishlist-wrap').html('');

            })
        }
    }
      // 퀵뷰 공통 템플릿 HTML
    function writeSwiperHtml(data) {
        if (data != null) {
            let dataCnt = 0;
            dataCnt = data.length;
            const whishDomFlag = document.createDocumentFragment();
            const swiperWrapper = document.createElement("div");
            const whishSwiperWrap = document.querySelector("#quickview .quickview-whish-swiper");
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
            responsiveQuickSwiper(el);
        }
    }
    // 로그인 체크 문구 표출 HTML
    function writeWhishlistLoginHtml(){
        const whishSwiperWrap = document.querySelector(".quickview-whish-swiper");
        whishSwiperWrap.innerHTML = 
        `
        <div class='quick-login-wrap'>
            <div class='quick-login-box'>
                <div class='quick-login-msg'>로그인 후 이용 가능합니다.</div>
                <a href="/login"><span class='quick-login-btn'>로그인</span></a>
            </div>
        </div>
        `
        $('.all-btn').hide();
        quickviewContentClose(3000,'list');
    }




    /**
     * @param {*} time 종료 시간 
     * @description 퀵뷰 정한시간후 종료
     */
    function quickviewContentClose(time,currentClick) {
        if(!time){time = 0;}
        setTimeout(() => {
            let $contentWrap = document.querySelector("#quickview .quickview__content__wrap");
            let $listBtn = document.querySelector("#quickview .btn__box.list__btn");
            let $quickviewSwiper = document.querySelector("#quickview .quickview-whish-swiper");
            let $titleBoxImg = document.querySelector(".title__box img");
            $quickviewSwiper.innerHTML = "";
            $('.common-contents-container').html('');
            $contentWrap.classList.remove("open");
            $listBtn.classList.remove("select");
            switch (currentClick) {
                case 'recent ':
                    $titleBoxImg.src = "/images/svg/wish-recent.svg";
                    break;
                case 'real ':
                    $titleBoxImg.src = "/images/svg/wish-real.svg";
                    break;
                case 'list ':
                    $titleBoxImg.src = "/images/svg/wish-list.svg";
                    break;
                case 'faq ':
                    $titleBoxImg.src = "/images/svg/wish-faq.svg";
                    break;
            }
        },time)

    }
    // 퀵뷰 클릭 이벤트 모음( 위시, 인기, 최근, FAQ 분기처리 )
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
            el.addEventListener("click", function(e) {
                let targetData = e.currentTarget.dataset.quick;
                let $$allBtn = document.querySelectorAll(".quickview__box .all-btn");

                $$allBtn[1].style.display = "flex";
                swiper.style.display = "flex";
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
                        if (recentlyViewedArr && recentlyViewedArr.length > 0) {
                            const recentObj = recentlyViewedArr.filter(item => typeof(JSON.parse(item)) === 'object');
                            recentWriteSwiperHtml(recentObj);
                        } else {
                            recentWriteSwiperHtml([]);
                        }
                        $('.all-btn').hide();
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
                        $('.all-btn').hide();
                    }
                    if (targetData == "list") {
                        console.log('list')
                        console.log(e)
                        whishSwiperWrap.innerHTML = "";
                        $titleBoxSpan.innerText = "위시리스트";
                        $titleBoxImg.src = "/images/svg/wish-list-bk.svg";
                        sessionStorage.login_session == 'true' ? getWhishlistProductList() : writeWhishlistLoginHtml();
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
                        swiper.style.display = "none";
                        $$allBtn[1].style.display = "none";
                        $('.common-contents-container').html('');
                        getFaqCategoryList();
                        contents_footer.style.display = 'none';
                        $('.all-btn').hide();
                    }
                    // quickviewContentClose(5000, targetData);
                }
            });
        });

        function removeSelect() {
            $$btnBox.forEach((el) => {
                el.classList.remove("select");
            });
        }
    };
    

    
    // ------------- FQA api  ------------- //
    function getFaqCategoryList() {
        let country = getLanguage();
        $.ajax({
            type: "post",
            data: {
                'country': country,
                'category_type': 'FAQ'
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/category/get",
            error: function() {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                if (d != null) {
                    if (d.data != null && d.data.length > 0) {
                        strDiv = `
                            <div class="faq-btn-wrap admin">
                                <div class="contents-header"><p>무엇을 도와드릴까요?</p></div>
                                <div class="contents-body">
                            `;
                        d.data.forEach(function(row) {
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
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                            scrollTop: scroll_height
                        }, 400);
                        $(".quickview__content__wrap.faq.open").animate({
                            scrollTop: scroll_height
                        }, 400);
                    } else {

                    }
                } else {

                }
            }
        });
    }
    function getQuickViewFaqList(category_no, category_title) {
        let country = getLanguage();

        $('#sel_category_no').val(category_no);
        $('#sel_category_title').val(category_title);

        $.ajax({
            type: "post",
            data: {
                'country': country,
                'category_no': category_no
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/list/get",
            error: function() {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                if (d != null) {
                    if (d.data != null && d.data.length > 0) {
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
                        d.data.forEach(function(row) {
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
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                            scrollTop: scroll_height
                        }, 400);
                        $(".quickview__content__wrap.faq.open").animate({
                            scrollTop: scroll_height
                        }, 400);
                    } else {

                    }
                } else {

                }
            }
        });
    }
    function getFaqContents(faq_idx, subcategory) {
        let country = getLanguage();

        let prev_category_no = $('#sel_category_no').val();
        let prev_category_tilte = $('#sel_category_title').val();
        $.ajax({
            type: "post",
            data: {
                'country': country,
                'faq_idx': faq_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/get",
            error: function() {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                if (d != null) {
                    if (d.data != null) {
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
                                    <div class="contents-btn" onclick="quickviewContentClose(0,'faq');">아니요</div>
                                </div>
                            </div>
                        `;
                        $('.quickview__content__wrap .common-contents-container').append(strDiv);

                        let scroll_height = $(".common-contents-container").prop('scrollHeight');
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                            scrollTop: scroll_height
                        }, 400);
                        $(".quickview__content__wrap.faq.open").animate({
                            scrollTop: scroll_height
                        }, 400);
                    } else {

                    }
                } else {}
            }
        });
    }
    function getInquiryCategory() {
        let country = getLanguage();

        $.ajax({
            type: "post",
            data: {
                'country': country,
                'category_type': 'INQ'
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/quickview/inquiry/category/get",
            error: function() {
                alert("FAQ 카테고리 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                if (d != null) {
                    if (d.data != null && d.data.length > 0) {
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
                        d.data.forEach(function(row) {
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
                        $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                            scrollTop: scroll_height
                        }, 400);
                        $(".quickview__content__wrap.faq.open").animate({
                            scrollTop: scroll_height
                        }, 400);
                    } else {

                    }
                } else {

                }
            }
        });
    }
    function moveInquiryForm(code_value, code_name) {
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
        $(".quickview__content__wrap.faq.open .common-contents-container").animate({
            scrollTop: scroll_height
        }, 400);
        $(".quickview__content__wrap.faq.open").animate({
            scrollTop: scroll_height
        }, 400);
    }
    function registQuickViewInquiry() {
        let inquiry_type = $('#inquiry_type').val();
        let inquiry_title = $('#inquiry_title').val();
        let inquiryTextBox = $('#inquiryTextBox').val();
        let country = getLanguage();

        if (inquiryTextBox != null && inquiryTextBox.length > 0) {
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
                    'inquiry_type': inquiry_type,
                    'inquiry_title': inquiry_title,
                    'inquiryTextBox': inquiryTextBox,
                    'country': country
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/inquiry/add",
                error: function() {},
                success: function(d) {
                    if (d != null) {
                        if (d.code == 200) {
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
                            $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                                scrollTop: scroll_height
                            }, 400);
                            $(".quickview__content__wrap.faq.open").animate({
                                scrollTop: scroll_height
                            }, 400);
                        } else {
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
                            $(".quickview__content__wrap.faq.open .common-contents-container").animate({
                                scrollTop: scroll_height
                            }, 400);
                            $(".quickview__content__wrap.faq.open").animate({
                                scrollTop: scroll_height
                            }, 400);
                        }
                    }
                }
            });
        }
    }
    // ------------- FQA api  ------------- //




    window.addEventListener('resize', function() {
        let delay = 500;
        let timer = null;
        clearTimeout(timer);
        timer = setTimeout(function() {
            let breakpoint = window.matchMedia('screen and (min-width:1025px)');
            let el = ".swiper-quick-container";
            if (quickNowData != null) {
                writeWishlistSwiperHtml(quickNowData);
            }
        }, delay);
    });
    window.addEventListener('DOMContentLoaded', function() {
        quickClickHandler();
    });
