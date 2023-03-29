let delay = 300;
let timer = null;
let breakpoint = window.matchMedia('screen and (min-width:1025px)');
const urlParams = new URL(location.href).searchParams;
const productIdx = urlParams.get('product_idx');
const productDetailInfoArr = getProductDetailInfo(productIdx);
const sizeGuideData = getSizeGudieApi(productIdx);



function getSizeGudieApi(productIdx) {
    let result;
    $.ajax({
        type: "post",
        data: {
            "country": getLanguage(),
            product_idx: productIdx
        },
        async: false,
        dataType: "json",
        url: "http://116.124.128.246/_api/product/size/get",
        error: function () {
            alert("error");
        },
        success: function (d) {
            result = d.data;
        }
    });
    return result;
}


const getProductApi = (productIdx) => {
    const main = document.querySelector("main");
    let country = getLanguage();
    let result;
    $.ajax({
        type: "post",
        data: {
            "product_idx": productIdx,
            "country": getLanguage(),
        },
        async: false,
        dataType: "json",
        url: "http://116.124.128.246:80/_api/product/get",
        error: function () {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
            makeProductListFlag(d);
            result = d.data;
            let recent_img_location = result[0].img_thumbnail[result[0].img_thumbnail.length - 1].img_location !== undefined
                ?
                result[0].img_thumbnail[result[0].img_thumbnail.length - 1].img_location
                :
                result[0].img_thumbnail[0].img_location;

            const recentProduct = {
                product_idx: result[0].product_idx,
                img_main: recent_img_location,
                product_name: result[0].product_name,
                stock_status: result[0].stock_status
            };
            saveRecentlyViewed(recentProduct);
        }
    });
    return result;
}
function makeProductListFlag(d) {
    let data = d.data;
    const domFrag = document.createDocumentFragment();
    const infoWrap = document.querySelector(".info__wrap");
    const thumbnailImgWrap = document.querySelector(".thumbnail_img_wrapper");
    const navigationWrap = document.querySelector(".navigation__wrap");
    const mainImgWrap = document.querySelector(".main_img_wrapper");
    let infoBoxHtml = "";
    data.forEach((el) => {
        let sold_out_flg = el.sold_out_flg;
        let refund_msg_flg = el.refund_msg_flg;
        let refund = el.refund;

        infoWrap.dataset.soldflg = sold_out_flg;
        infoWrap.dataset.refund_msg_flg = refund_msg_flg;


        let img_thumbnail = el.img_thumbnail;
        let imgThumbnailHtml = "";
        img_thumbnail.forEach((thumbnail, index) => {
            const imgLocation = index === 0 || !thumbnail.img_location ? img_thumbnail[0].img_location : thumbnail.img_location;
            const displayNumText = thumbnail.display_num == 1 ? "착용이미지" : "디테일";
            const imgThumbnailHtml = `<img src="${img_root}${imgLocation}"/><span>${displayNumText}</span>`;
            const thumbnailBox = document.createElement("div");
            thumbnailBox.classList.add("thumb__box");
            thumbnailBox.dataset.type = thumbnail.display_num;
            thumbnailBox.innerHTML = imgThumbnailHtml;
            domFrag.appendChild(thumbnailBox);
        });
        
        //가상돔에 사이트 썸네일 추가 
        navigationWrap.appendChild(domFrag);

        let img_main = el.img_main;
        let imgMainHtml = "";
        img_main.forEach((main) => {
            imgMainHtml = `
                <img class="detail__img" data-imgtype="${main.img_type}" data-size="${main.img_size}" src="${main.img_url}"/>
            `;

            const mainInfo = document.createElement("div");
            mainInfo.classList.add("swiper-slide");
            mainInfo.dataset.imgtype = main.img_type;
            mainInfo.dataset.imgsize = main.img_size;
            mainInfo.innerHTML = imgMainHtml;
            domFrag.appendChild(mainInfo);

        });
        
        //가상돔에 메인 상품이미지 추가
        mainImgWrap.appendChild(domFrag);
        let productColorHtml = () => {
            let product_color = el.product_color;
            let productColorHtml = "";
            if(!product_color){
                product_color.forEach(color => {
                    let colorData = color.color_rgb;
                    if(!colorData) {
                        return '컬러 없음';
                    }
                    let multi = colorData.split(";");
                    if (multi.length === 2) {
                        productColorHtml += `
                            <div class="color-line" data-idx="${color.product_idx}" data-stock="${color.stock_status}" style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                                <p class="color-name">${color.color}</p>
                                <div class="color multi" data-title="${color.color}"></div>
                            </div>
                        `;
                        return productColorHtml;
                    } else {
                        productColorHtml += `
                            <div class="color-line" data-idx="${color.product_idx}" data-stock="${color.stock_status}" data-title="${color.color}" style="--background-color:${multi[0]}">
                                <p class="color-name">${color.color}</p>
                                <div class="color" data-title="${color.color}"></div>
                            </div>
                        `;
                        return productColorHtml;
                    }
                });
            }else {
                productColorHtml ='컬러 없음' 
            }
            return productColorHtml;
        }
        // 사이즈 html 생성
        let productSizeHtml = () => {
            let sizeHtml = '';
            let product_size = el.product_size;
            let productSizeHtml = "";
            product_size.forEach(size => {
                sizeHtml += `
                    <li class="size" data-sizetype="${size.size_type}" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">
                        ${size.option_name}
                        ${size.stock_status == 'STCL' ? '<div class="red-dot"></div>' : ''}
                        ${size.stock_status == 'STSC' ? '<div class="sold-line"></div>' : ''}
                    </li>
                `;
            });
            return sizeHtml;
        }


        let whish_img = "";
        let whish_function = "";

        let whish_flg = `${el.whish_flg}`;
            let login_status = getLoginStatus();

            if (login_status == "true") {
                if (whish_flg == 'true') {
                    whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="">';
                    whish_function = "deleteWhishListBtn(this);";
                } else if (whish_flg == 'false') {
                    whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
                    whish_function = "setWhishListBtn(this);";
                }
            } else {
                whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
            whish_function = "return false;";

            }
        let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
        infoBoxHtml = `
            <div class="product__title">${el.product_name}</div>
            ${el.discount == 0 ?
                `<div class="product__price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">
                    <span>${el.price.toLocaleString('ko-KR')}</span>
                </div>`
                :
                `<div class="product__price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-dis="true">
                    <span class="sp">${saleprice}</span>
                    <span class="cp" data-discount="${el.discount}" >${el.price.toLocaleString('ko-KR')}</span>
                    <span class="di">${el.discount}%</span>
                </div>`
            } 
            <div class="color__box">
                ${productColorHtml()}
            </div>
            <div class="product__size">
                <div style="width: 40px;">Size</div>
                <div class="size__box">
                    ${productSizeHtml()}
                </div>
            </div>
            
            <div class="basket__wrap--btn">
                <div class="basket__box--btn">
                    <div class="basket-btn" >
                        <img src="/images/svg/basket.svg" alt="">
                        <span class="basket-title" data-i18n="pd_basket_msg_05">쇼핑백에 담기</span>
                    </div>
                    <div class="whish-btn" product_idx="${el.product_idx}" onClick="${whish_function}">
                        ${whish_img}
                    </div>
                </div>
                ${refund_msg_flg == 1 ?
                `<div class="detail__refund__box"> 
                        <div class='close-box'>
                            <div class="close-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12.707" height="12.707" viewBox="0 0 12.707 12.707">
                                    <path data-name="선 1772" transform="rotate(135 6.103 2.736)" style="fill:none;stroke:#343434" d="M16.969 0 0 .001"></path>
                                    <path data-name="선 1787" transform="rotate(45 -.25 .606)" style="fill:none;stroke:#343434" d="M16.969.001 0 0"></path>
                                </svg>
                            </div>
                        </div>
                        <div class='refund__msg' data-i18n="pd_refund_msg_01">제품의 특성상 교환 / 환불이 불가합니다.<br> 동의하시겠습니까?</div>
                        <div class="refund-basket-btn"> 
                            <img src="/images/svg/basket.svg" alt=""> 
                            <span class="basket-title" data-i18n="pd_basket_msg_06">내용 확인 후 쇼핑백에 담기</span> 
                        </div> 
                    </div>`
                : ''}
            </div>

            <div class="detail__btn__wrap web">
                <div class="detail__btn__row web">
                    <div class="img-box">
                        <img src="/images/svg/sizeguide.svg" alt="">
                    </div>
                    <div class="btn-title" data-i18n="pd_size_guide">사이즈가이드</div>
                    <div class="detail__content__box"></div>
                </div>
                <div class="detail__btn__row web">
                    <div class="img-box">
                        <img src="/images/svg/material.svg" alt=""></div>
                    <div class="btn-title" data-i18n="pd_material">소재</div>
                    <div class="detail__content__box"></div>
                </div>
                <div class="detail__btn__row web">
                    <div class="img-box">
                        <img src="/images/svg/information.svg" alt="">
                    </div>
                    <div class="btn-title" data-i18n="pd_details">상세정보</div>
                    <div class="detail__content__box"></div>
                </div>
                <div class="detail__btn__row web">
                    <div class="img-box">
                        <img src="/images/svg/precaution.svg" alt="">
                    </div>
                    <div class="btn-title" data-i18n="pd_care">취급 유의사항</div>
                    <div class="detail__content__box"></div>
                </div>
            </div>
            <div class="detail__refund__msg"></div>
            
        `;
        //모바일 전용 쇼핑백담기버튼 추가
        let mobileBasketBtnWrap = document.createElement("div");
        let whishlistTitle = "<div class='whislist-tilte'>whislist</div>"
        mobileBasketBtnWrap.className = "basket__wrap--btn nav";

        mobileBasketBtnWrap.innerHTML = `
        <div class="basket__box--btn">
            <div class="basket-btn" >
                <img src="/images/svg/basket.svg" alt="">
                <span class="basket-title" data-i18n="pd_basket_msg_05">쇼핑백에 담기</span>
            </div>
            <div class="whish-btn" product_idx="${el.product_idx}" onClick="${whish_function}">
                ${whish_img}
                ${whish_flg == 'true' ? whishlistTitle : ""}
            </div>
        </div>
        ${refund_msg_flg == 1 ?
                `<div class="detail__refund__box"> 
                <div class='close-box'>
                    <div class="close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12.707" height="12.707" viewBox="0 0 12.707 12.707">
                            <path data-name="선 1772" transform="rotate(135 6.103 2.736)" style="fill:none;stroke:#343434" d="M16.969 0 0 .001"></path>
                            <path data-name="선 1787" transform="rotate(45 -.25 .606)" style="fill:none;stroke:#343434" d="M16.969.001 0 0"></path>
                        </svg>
                    </div>
                </div>
                <div class='refund__msg' data-i18n="pd_refund_msg_01">제품의 특성상 교환 / 환불이 불가합니다.<br> 동의하시겠습니까?</div>
                <div class="refund-basket-btn"> 
                    <img src="/images/svg/basket.svg" alt=""> 
                    <span class="basket-title" data-i18n="pd_basket_msg_06">내용 확인 후 쇼핑백에 담기</span> 
                </div> 
            </div>`
                : ''}
        
        `
        document.querySelector(".rM-detail-containner").appendChild(mobileBasketBtnWrap);


        const prdInfo = document.createElement("div");
        prdInfo.classList.add("info__box");
        prdInfo.innerHTML = infoBoxHtml;
        domFrag.appendChild(prdInfo);
        infoWrap.appendChild(domFrag);

        if (infoWrap.dataset.refund_msg_flg == 1) {
            document.querySelectorAll(".detail__refund__msg").forEach(el => el.innerHTML = xssDecode(refund));
        }
    });
    let relevant_idx = data[0].relevant_idx;

    if (relevant_idx != null) {
        // getRelevantProductList(relevant_idx, country);
    }
    // getProductRecommendList();
    // sizeNodeCheck();
    // colorNodeCheck();
    // sizeBtnHandler();
    basketStatusBtn();
    // 컬러 표기
    followScrollBtn();
    viewportImg();
    // detailBtnHandler();

    //디테일 설명
    innerSideBar();
    webDetailBtnHanddler();

    if (infoWrap.dataset.soldflg == 1) {
        let $$productBtn = document.querySelectorAll(".basket-btn");
        basketBtnStatusChange($$productBtn, 0);
    }
}
//메인 스와이프 관련 함수 
// let mainSwiper = initMainSwiper();
// let pagingSwiper = initPagingSwiper();
let pd_mainSwiper = null;
let pd_pagingSwiper = null;
function pdResponsiveSwiper() {
    let breakpoint = window.matchMedia('screen and (min-width:1025px)');
    if (breakpoint.matches === true) {
        if (pd_mainSwiper !== null) {
            pd_mainSwiper.destroy();
            pd_mainSwiper = null;
        }
        if (pd_pagingSwiper !== null) {
            pd_pagingSwiper.destroy();
            pd_pagingSwiper = null;
        }
    } else if (breakpoint.matches === false) {
        if (pd_pagingSwiper == null) {
            pd_pagingSwiper = initPagingSwiper();
        }
        if (pd_mainSwiper == null) {
            pd_mainSwiper = initMainSwiper();
            pd_mainSwiper.on('slideChange', function () {
                $(".swiper-pagination-detail-fraction .swiper-pagination-current").html(pd_mainSwiper.activeIndex + 1);
            });
        }
        pd_pagingSwiper.controller.control = pd_mainSwiper;

    }

};
function initMainSwiper() {
    return new Swiper('#main__swiper-detail', {
        pagination: {
            el: ".swiper-pagination-detail-bullets",
            dynamicBullets: true,
            clickable: true,
            bulletWidth: 280,
        },
    });
}
function initPagingSwiper() {
    return new Swiper("#main__swiper-detail", {
        pagination: {
            el: ".swiper-pagination-detail-fraction",
            type: "fraction",
        },
    });
}
function styleSwiper() {
    return new Swiper(".style-swiper", {
        navigation: {
            nextEl: ".style-swiper .swiper-button-next",
            prevEl: ".style-swiper .swiper-button-prev",
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2.647
            },
            920: {
                slidesPerView: 5
            },
            1400: {
                slidesPerView: 5
            }
        }
    });
}
//스크롤 버튼 
function followScrollBtn() {
    const detailProduct = document.querySelectorAll(".main__swiper .swiper-slide");
    const thumbBtns = document.querySelectorAll(".thumb__box");
    thumbBtns.forEach(el => el.addEventListener("click", function () {
        let thumbIdx = (this.dataset.type) - 1;
        let result = [...detailProduct].find((el, idx) => idx === thumbIdx);
        let scrollTo = result.offsetTop;
        toScroll(scrollTo);
        if (pd_mainSwiper == null) {
            return false;
        }
        if (pd_mainSwiper.__swiper__ == true) {
            pd_mainSwiper.slideTo(thumbIdx)
        }
    }));
    function toScroll(targetValue) {
        window.scrollTo({
            top: targetValue,
            left: 0,
            behavior: 'smooth'
        });
    };
}
//이미지 확대 함수
function viewportImg() {
    let img = new Image();
    let $$slide = document.querySelectorAll(".detail__img__wrap .swiper-slide img");
    let closebtn = document.createElement("div");
    closebtn.innerHTML = `
        <img src="http://116.124.128.246:80/images/svg/img-close-btn.svg">
    `
    closebtn.className = "viewport__closebtn"
    let imageWrap = document.createElement("div");
    imageWrap.className = "viewport__wrap--img";
    $$slide.forEach(el => {
        el.addEventListener("click", function (e) {
            let src = e.target.getAttribute("src");
            img.className = "viewport-img";
            img.setAttribute("src", src)
            imageWrap.appendChild(img);
            imageWrap.appendChild(closebtn);
            document.body.appendChild(imageWrap);
            document.body.style.overflow = "hidden";
            let $viewportWrap = document.querySelector(".viewport__wrap--img")
            if (window.matchMedia('screen and (min-width:1025px)').matches) {
                $viewportWrap.addEventListener("click", webImgClose);
            } else {
                $viewportWrap.removeEventListener("click", webImgClose);
            }
        });

        function webImgClose() {
            document.body.style.overflow = "inherit";
            this.remove();
        }
    })

    closebtn.addEventListener("click", function () {
        document.body.style.overflow = "inherit";
        document.querySelector(".viewport__wrap--img").remove();
    });


}
/**
 * @author SIMJAE  
 * @description 쇼핑백에 추가하고 사이드바 오픈
 */
function basketStatusBtn() {
    const sizeResult = sizeStatusCheck();
    console.log("🏂 ~ file: detail.js:404 ~ basketStatusBtn ~ sizeResult:", sizeResult)
    const $$productBtn = document.querySelectorAll(".basket-btn");
    const $$size = document.querySelectorAll(".detail__wrapper .size");
    basketBtnStatusChange($$productBtn, sizeResult);
    $$productBtn.forEach(el => {
        // el.addEventListener("click", (e) => {
        //     let { status } = e.currentTarget.dataset;
        //     if (status == 2) {
        //         let option_idx = [];
        //         let selectResult = [...$$size].map(size => {
        //             if (size.classList.contains("select") == true) {
        //                 option_idx.push(size.dataset.optionidx);
        //             }
        //         });
        //         console.log("🏂 ~ file: detail.js:444 ~ selectResult ~ option_idx", option_idx)
        //         if (option_idx.length == 0) {
        //             basketBtnStatusChange($$productBtn, 4);
        //         }
        //         if (option_idx.length > 0) {
        //             if($('.info__wrap').data('refund_msg_flg') == 1){
        //                 $('.detail__refund__box').addClass('open');
        //                 $('.detail__refund__box .close-btn').on("click",function(){
        //                     $('.detail__refund__box').removeClass('open');
        //                 })
        //                 $('.detail__refund__box .refund-basket-btn').on("click",function(){
        //                     addBasketApi();
        //                     $('.detail__refund__box').removeClass('open');
        //                 })
        //             } else{
        //                 addBasketApi();
        //             }

        //             function addBasketApi(){
        //                 console.log("🏂 ~ file: detail.js:454 ~ $ ~ option_idx:123123", option_idx)
        //                 $.ajax({
        //                     type: "post",
        //                     url: "http://116.124.128.246:80/_api/order/basket/add",
        //                     data: {
        //                         'add_type': 'product',
        //                         'product_idx': productIdx,
        //                         'option_idx': option_idx
        //                     },
        //                     dataType: "json",
        //                     error: function () {
        //                         alert("쇼핑백 추가처리에 실패했습니다.");
        //                     },
        //                     success: function (d) {
        //                         if (d.code == 200 && $('.basket-btn').data('status') == 2) {
        //                             // 사이드바
        //                             let sideContainer = document.querySelector("#sidebar");
        //                             let sideBg = document.querySelector(".side__background");
        //                             let sideWrap = document.querySelector(".side__wrap");

        //                             if(getLoginStatus() == 'false'){
        //                                 location.href='/login';
        //                                 return 
        //                             } else {
        //                                 let sideBarCloseBtn = document.querySelector('.sidebar-close-btn');
        //                                 sideBarCloseBtn.addEventListener("click",sidebarClose);
        //                                 const basket = new Basket("basket",true);
        //                                 basket.writeHtml();
        //                                 if(sideContainer.classList.contains("open")){
        //                                     sidebarClose();
        //                                 } else {
        //                                     sidebarOpen();
        //                                 }
        //                                 function sidebarClose(){
        //                                     sideContainer.classList.remove("open");
        //                                     sideWrap.classList.remove("open");
        //                                     sideBg.classList.remove("open");
        //                                     $("#dimmer").removeClass("show");
        //                                 }	
        //                                 function sidebarOpen(){
        //                                     sideContainer.classList.add("open");
        //                                     sideWrap.classList.add("open");
        //                                     sideBg.classList.add("open");
        //                                     $("#dimmer").addClass("show");
        //                                 }	
        //                                 addCartForGA(option_idx);
        //                             }
        //                         } else {
        //                             exceptionHandling("[ 디자인 필요 ]", d.msg);
        //                         }
        //                     }
        //                 });
        //             }

        //         }
        //     }
        // })
        // el.addEventListener("mouseenter", (e) => {
        //     let { status } = e.currentTarget.dataset;
        //     let sizeSelectResult = $('.size__box .select').length;
        //     if(status == 2 && sizeSelectResult == 0){
        //         e.currentTarget.querySelector("span").dataset.i18n = "pd_choose_an_option";
        //         e.currentTarget.querySelector("span").innerHTML = "옵션을 선택해주세요";
        //         e.currentTarget.querySelector("span").textContent = i18next.t("pd_choose_an_option");
        //         e.currentTarget.querySelector("img").setAttribute("src", "/images/svg/pd-unoption.svg");
        //         e.currentTarget.querySelector("img").classList.remove("hidden");
        //     }
        // })
        // el.addEventListener("mouseleave", (e) => {
        //     let { status } = e.currentTarget.dataset;
        //     let sizeSelectResult = $('.size__box .select').length;
        //     if(status == 2 && sizeSelectResult == 0){
        //         e.currentTarget.querySelector("span").dataset.i18n = "pd_basket_msg_05";
        //         e.currentTarget.querySelector("span").innerHTML = "쇼핑백에 담기";
        //         e.currentTarget.querySelector("span").textContent = i18next.t("pd_basket_msg_05");
        //         e.currentTarget.querySelector("img").classList.remove("hidden");
        //         e.currentTarget.querySelector("img").setAttribute("src", "/images/svg/basket.svg");
        //     }   
        // })
    });

}
function basketBtnStatusChange(el, idx) {
    el.forEach(btn => {
        switch (parseInt(idx)) {
            case 0:
                btn.querySelector("span").dataset.i18n = "pd_basket_msg_01";
                btn.querySelector("span").innerHTML = "품절";
                btn.querySelector("img").setAttribute("src", "");
                btn.querySelector("img").classList.add("hidden");
                btn.parentNode.dataset.status = 0;
                btn.dataset.status = 0;
                break;
            case 1:
                btn.querySelector("span").dataset.i18n = "pd_basket_msg_02";
                btn.querySelector("span").innerHTML = "재입고 알림 신청하기";
                btn.querySelector("img").classList.remove("hidden");
                btn.querySelector("img").setAttribute("src", "/images/svg/reflesh-bk.svg");
                btn.parentNode.dataset.status = 1;
                btn.dataset.status = 1;
                break;
            case 2:
                btn.querySelector("span").dataset.i18n = "pd_basket_msg_05";
                btn.querySelector("span").innerHTML = "쇼핑백에 담기";
                btn.querySelector("img").classList.remove("hidden");
                btn.querySelector("img").setAttribute("src", "/images/svg/basket.svg");
                btn.parentNode.dataset.status = 2;
                btn.dataset.status = 2;
                break;
            case 3:
                btn.querySelector("span").dataset.i18n = "pd_basket_msg_03";
                btn.querySelector("img").classList.add("hidden");
                btn.querySelector("span").innerHTML = "comming soon";
                btn.parentNode.dataset.status = 3;
                btn.dataset.status = 3;
                break;
            case 4:
                btn.querySelector("span").dataset.i18n = "pd_basket_msg_04";
                btn.querySelector("span").dataset.i18n = "pd_choose_an_option";
                btn.querySelector("span").innerHTML = "옵션을 선택해주세요";
                btn.querySelector("img").setAttribute("src", "/images/svg/pd-unoption.svg");
                btn.querySelector("img").classList.remove("hidden");
                btn.parentNode.dataset.status = 4;
                btn.dataset.status = 4;
                break;
        }
        let key = btn.querySelector("span").dataset.i18n;
        btn.querySelector("span").textContent = i18next.t(key);
    })

}
/**
 * @author SIMJAE  
 * @description 사이즈 선택 이벤트
 */
function sizeBtnHandler() {
    let infoWrap = document.querySelector('.info__wrap');
    const $$productBtn = document.querySelectorAll(".basket-btn");
    const sizes = document.querySelectorAll(".detail__wrapper .size__box .size");
    let basketBtn = document.querySelector('.rM-detail-containner .basket-btn');
    let webBasketBtn = document.querySelector('.info__box .basket-btn');
    sizes.forEach(el => {
        el.addEventListener("click", function (e) {
            let { productidx, optionidx, status } = e.currentTarget.dataset;
            if (status == 2) {
                sizes.forEach(el => { if (el.dataset.status !== "2") { el.classList.remove("select") }; })
                e.currentTarget.classList.toggle("select");
                if ($(".size.select[data-status='2']").length == 0) {
                    basketBtn.className = 'basket-btn';
                    webBasketBtn.className = 'basket-btn';
                } else {
                    basketBtn.className = 'basket-btn basket';
                    webBasketBtn.className = 'basket-btn basket';
                }
                basketBtnStatusChange($$productBtn, status);
            } else if (status == 1) {
                sizes.forEach(el => { if (el.dataset.status !== "1") { el.classList.remove("select") }; })
                e.currentTarget.classList.toggle("select");
                if ($(".size.select[data-status='1']").length == 0) {
                    basketBtn.className = 'basket-btn';
                    webBasketBtn.className = 'basket-btn';
                    basketBtnStatusChange($$productBtn, 2);
                } else {
                    basketBtn.className = 'basket-btn reorder';
                    webBasketBtn.className = 'basket-btn reorder';
                    basketBtnStatusChange($$productBtn, status);
                }
            } else if (status == 0) {
                basketBtnStatusChange($$productBtn, status);
            }
        });
    });
}
/**
 * @author SIMJAE
 * @description 사이즈 상태를 숫자로 반환
 */
function sizeStatusCheck() {
    let stockStatus = 0;
    const sizes = document.querySelectorAll(".detail__wrapper .size__box .size");
    let result = [...sizes].map(el => {
        let tmp_soldout_str = el.dataset.soldout;
        if (tmp_soldout_str == 'STSO') {
            el.dataset.status = 0;
            return stockStatus = 0;
        } else if (tmp_soldout_str == 'STSC') {
            el.dataset.status = 1;
            return stockStatus = 1;
        } else if (tmp_soldout_str == 'STCL' || tmp_soldout_str == 'STIN') {
            el.dataset.status = 2;
            return stockStatus = 2;
        }
    })
    return statusArrCheck(result);
}
/**
 * @author SIMJAE
 * @param {Array} list 사이즈 status 배열
 * @description 사이즈 상태에서 구매가능한 사이즈가 있을시 리턴값 max값
 * @returns result
 */
const statusArrCheck = (list) => {
    // 0 : 완전품절 || 1: 리오더가능 || 2: 재고 선택가능 || 3: commin-soon
    let result = Math.max(...list);
    return result;
}
//현재 상품 컬러 체크 && 패아자 이동
function colorNodeCheck() {
    const colorBox = document.querySelector(".color__box");
    const colors = document.querySelectorAll(".color-line");
    let product_idx = document.querySelector("main").dataset.productidx;
    colors.forEach(el => {
        if (el.dataset.idx === product_idx) {
            el.classList.add("select");
            el.remove();
            let cloneNode = el.cloneNode(true);
            colorBox.prepend(cloneNode);
        }

        el.addEventListener("mouseover", function (e) {
            document.querySelector(".color-line.select").classList.remove("select");
            // document.querySelector(".color-line .color-name.select").classList.remove("select");
        });
        el.addEventListener("mouseout", function (e) {
            document.querySelector(".color-line").classList.add("select");
            // document.querySelector(".color-line .color-name").classList.add("select");
        });
        el.addEventListener("click", function (e) {
            let stock_status = el.dataset.stock;
            if (stock_status == "STSO") {
                return false
            } else {
                let targetIdx = e.currentTarget.dataset.idx;
                window.location.href = `http://116.124.128.246/product/detail?product_idx=${targetIdx}`
            }
        });
    });
}
/**
 * @author SIMJAE  
 * @description 모바일 상품 상세정보 이벤트 핸들러 
 */
function mobileDetailBtnHanddler() {
    let $$btn = document.querySelectorAll(".rM-detail-containner .detail__btn__row");
    let controllBtn = document.querySelector(".rM-detail-containner .detail__btn__control");
    let prevBtn = document.querySelector(".rM-detail-containner .detail-btn-prev");
    let nextBtn = document.querySelector(".rM-detail-containner .detail-btn-next");
    let currentIdx = 0;

    $$btn.forEach((btn, idx) => {
        btn.addEventListener("click", function (e) {
            if (e.currentTarget.classList.contains("select")) {
                document.querySelector(".rM-detail-containner .content-body").innerHTML = "";
                document.querySelector(".rM-detail-containner .content-header span").innerHTML = "";
                e.currentTarget.classList.remove("select");
                e.currentTarget.offsetParent.classList.remove("open");

            } else {
                $$btn.forEach(el => el.classList.remove("select"));
                btn.classList.add("select");
                e.currentTarget.offsetParent.classList.add("open");

                mobileSizeGuideContentBody(idx);
            }

            currentIdx = clickControllBtnEvent();
            updateControllBtnCss(idx);
            sizeguideBtnEvent();
        });
    });

    prevBtn.addEventListener("click", function (e) {
        if (currentIdx == 0) { return false; }
        currentIdx--
        updateSelectElem(currentIdx);
        updateControllBtnCss(currentIdx);
        mobileSizeGuideContentBody(currentIdx);
    });
    nextBtn.addEventListener("click", function (e) {
        if (currentIdx == 4) { return false; }
        currentIdx++
        updateSelectElem(currentIdx);
        updateControllBtnCss(currentIdx);
        mobileSizeGuideContentBody(currentIdx);
    });

    function updateSelectElem(current) {
        $$btn.forEach(el => el.classList.remove("select"));
        document.querySelectorAll(".rM-detail-containner .detail__btn__row")[current].classList.add("select");
    }
    //컨트롤러 버튼 css 갱신
    function updateControllBtnCss(idx) {
        let prevBtn = document.querySelector(".rM-detail-containner .detail-btn-prev");
        let nextBtn = document.querySelector(".rM-detail-containner .detail-btn-next");
        if (idx == 0) {
            prevBtn.style.opacity = "0";
        } else if (idx == 3) {
            nextBtn.style.opacity = "0";
        } else {
            nextBtn.style.opacity = "inherit";
            prevBtn.style.opacity = "inherit";
        }
    }
    //선택되어있는 idx불러오기
    function clickControllBtnEvent() {
        let currentIdx;
        [...$$btn].find((el, idx) => {
            if (el.classList.contains("select")) { currentIdx = idx; }
        });
        return currentIdx;
    }
    function mobileSizeGuideContentBody(idx) {
        let contentHeader = document.querySelector(".rM-detail-containner .content-header span");
        let contentBody = document.querySelector(".rM-detail-containner .content-body");
        let detailContentWrap = document.querySelector(".rM-detail-containner .detail-content");
        if (idx == 0) {
            detailContentWrap.className = "detail-content sizeguide";
            contentHeader.dataset.i18n = "pd_size_guide";
            contentHeader.innerHTML = "사이즈가이드";
            contentBody.innerHTML = '';
            contentBody.appendChild(makeSizeGuideHtml());
        } else if (idx == 1) {
            detailContentWrap.className = "detail-content material";
            contentHeader.dataset.i18n = "pd_material";
            contentHeader.innerHTML = "소재";
            contentBody.innerHTML = xssDecode(productDetailInfoArr[idx]);
        } else if (idx == 2) {
            detailContentWrap.className = "detail-content productinfo";
            contentHeader.dataset.i18n = "pd_details";
            contentHeader.innerHTML = "제품 상세 정보";
            contentBody.innerHTML = xssDecode(productDetailInfoArr[idx]);
        } else if (idx == 3) {
            detailContentWrap.className = "detail-content precaution";
            contentHeader.dataset.i18n = "pd_care";
            contentHeader.innerHTML = "취급 유의 사항";
            contentBody.innerHTML = xssDecode(productDetailInfoArr[idx]);
        }
        let key = contentHeader.dataset.i18n;
        contentHeader.textContent = i18next.t(key);
    }
    function sizeguideBtnEvent() {
        let $$sizeBtn = document.querySelectorAll(".rM-detail-containner .sizeguide-btn");
        $$sizeBtn.forEach((el, idx) => el.addEventListener("click", function () {
            $$sizeBtn.forEach(el => el.classList.remove("select"));
            this.classList.add("select");
        }));
    }
}
/**
 * @author SIMJAE  
 * @description 웹 상품 상세정보 이벤트 핸들러 
 */
function webDetailBtnHanddler() {
    let $$detailBtn = document.querySelectorAll(".info__box .detail__btn__row");
    let $detailWrap = document.querySelector(".info__box .detail__btn__wrap.web");
    let currentIdx = 0;
    $$detailBtn.forEach((btn, idx) => {
        btn.addEventListener("click", function (e) {
            if (e.currentTarget.classList.contains("select")) {
                // unSelectBtn(btn,e);
                sideBarClose();
            } else {
                stylingOversever();
                sideBarOpen(e);
                selectBtn(btn);
            }
            currentIdx = clickControllBtnEvent();
            mobileSizeGuideContentBody(idx);
            changeLanguageR();
        });
    });
    //선택되어있는 idx불러오기
    function clickControllBtnEvent() {
        let currentIdx;
        [...$$detailBtn].find((el, idx) => {
            if (el.classList.contains("select")) { currentIdx = idx; }
        });
        return currentIdx;
    }
    const $detailSidebarWrap = document.querySelector(".detail__sidebar__wrap");
    const $sidebarBg = document.querySelector(".detail__sidebar__wrap .sidebar__background");
    const $sidebarWrap = document.querySelector(".detail__sidebar__wrap .sidebar__wrap");
    const $sidebarCloseBtn = document.querySelector(".detail__sidebar__wrap .sidebar__close__btn");

    function unSelectBtn(btn, e) {
        e.currentTarget.offsetParent.classList.remove("open");
        e.currentTarget.classList.remove("select");
    }
    function selectBtn(btn) {
        $$detailBtn.forEach(el => el.classList.remove("select"));
        btn.classList.add("select");
    }
    function mobileSizeGuideContentBody(idx) {
        let contentHeader = document.querySelector(".detail__sidebar__wrap .content-header span");
        let contentBody = document.querySelector(".detail__sidebar__wrap .content-body");
        contentBody.innerHTML = xssDecode(productDetailInfoArr[idx]);
        let detailContentWrap = document.querySelector(".detail__sidebar__wrap .detail-content");
        if (idx == 0) {
            detailContentWrap.className = "detail-content sizeguide";
            contentHeader.dataset.i18n = "pd_size_guide";
            contentHeader.innerHTML = "사이즈가이드";
            contentBody.innerHTML = '';
            contentBody.appendChild(makeSizeGuideHtml());
        } else if (idx == 1) {
            detailContentWrap.className = "detail-content material";
            contentHeader.dataset.i18n = "pd_material";
            contentHeader.innerHTML = "소재";
        } else if (idx == 2) {
            detailContentWrap.className = "detail-content productinfo";
            contentHeader.dataset.i18n = "pd_details";
            contentHeader.innerHTML = "제품 상세 정보";
        } else if (idx == 3) {
            detailContentWrap.className = "detail-content precaution";
            contentHeader.dataset.i18n = "pd_care";
            contentHeader.innerHTML = "취급 유의 사항";
        }
        let key = contentHeader.dataset.i18n;
        contentHeader.textContent = i18next.t(key);
    }
    //이벤트 달기
    function sideBarOpen(e) {
        e.target.offsetParent.classList.add("open");
        $detailSidebarWrap.classList.add("open");
        $sidebarBg.classList.add("open");
        $sidebarWrap.classList.add("open");
        $sidebarCloseBtn.addEventListener("click", sideBarClose)
    }
    function sideBarClose() {
        $detailWrap.classList.remove("open");
        $detailSidebarWrap.classList.remove("open");
        $sidebarBg.classList.remove("open");
        $sidebarWrap.classList.remove("open");
        $$detailBtn.forEach(el => el.classList.remove("select"));
    }
    function sizeguideBtnEvent() {
        let $$sizeBtn = document.querySelectorAll(".detail__sidebar__wrap .sizeguide-btn");
        $$sizeBtn.forEach((el, idx) => el.addEventListener("click", function () {
            $$sizeBtn.forEach(el => el.classList.remove("select"));
            this.classList.add("select");
        }));
    }
    function stylingOversever() {
        const target = document.querySelector('.styling-with-wrap');
        const ioCallback = (entries, io) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sideBarClose();
                }
            });
        };
        const stylingObserve = new IntersectionObserver(ioCallback, { threshold: 0.4 });
        stylingObserve.observe(target);
    }
}
/**
 * @author SIMJAE  
 * @description 모바일 상품 상세정보 데이터 요청
 */
function getProductDetailInfo(product_idx) {
    const main = document.querySelector("main");
    let country = getLanguage();
    let sizeGuideArr = new Array();
    let sizeGuide;
    $.ajax({
        type: "post",
        data: {
            "product_idx": product_idx,
            "country": getLanguage(),
        },
        async: false,
        dataType: "json",
        url: "http://116.124.128.246:80/_api/product/get",
        error: function () {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
            let { care, detail, material } = d.data[0];

            sizeGuideArr.push(sizeGuide);
            sizeGuideArr.push(material);
            sizeGuideArr.push(detail);
            sizeGuideArr.push(care);
        }
    });
    return sizeGuideArr;
}
function makeSizeGuideHtml() {
    const sizeData = sizeGuideData;
    const sizeKeys = Object.keys(sizeData.dimensions);
    const firstSizeKey = sizeKeys[0];
    let dom = document.createDocumentFragment();
    let sizeguideBox = document.createElement('div');
    sizeguideBox.id = 'sizeguide-box';
    sizeguideBox.className = 'sizeguide-box';

    let sizeguideNoti = document.createElement('div');
    sizeguideNoti.id = 'sizeguide-noti';
    sizeguideNoti.className = 'sizeguide-noti';

    let sizeguideImg = document.createElement('div');
    sizeguideImg.id = 'sizeguide-img';
    sizeguideImg.className = 'sizeguide-img';

    let sizeguideDct = document.createElement('ul');
    sizeguideDct.id = 'sizeguide-dct';
    sizeguideDct.className = 'sizeguide-dct';

    dom.appendChild(sizeguideBox);
    dom.appendChild(sizeguideNoti);
    dom.appendChild(sizeguideImg);
    dom.appendChild(sizeguideDct);


    function createSizeButtons() {
        const sizeBox = dom.querySelector('#sizeguide-box');
        const sizeKeys = Object.keys(sizeData.dimensions);

        sizeKeys.forEach(size => {
            const btn = document.createElement('div');
            btn.classList.add('sizeguide-btn');
            btn.dataset.size = size;
            btn.textContent = size;
            if (size === firstSizeKey) {
                btn.classList.add('select');
            }
            btn.addEventListener('click', function () {
                document.querySelector('.sizeguide-btn.select').classList.remove('select');
                this.classList.add('select');
                updateSizeGuide(this.dataset.size);
            });
            sizeBox.appendChild(btn);
        });
    }

    function domUpdateSizeGuide(size) {
        const data = sizeData.dimensions[size];
        const noti = dom.querySelector('#sizeguide-noti');
        const img = dom.querySelector('#sizeguide-img');
        const dct = dom.querySelector('#sizeguide-dct');
        if (!sizeData.model || !sizeData.model_wear) {
            noti.innerHTML = '';
        } else {
            noti.innerHTML = `<span data-i18n="pd_model_msg_01">모델 신장 </span><span>${sizeData.model}</span><span data-i18n="pd_model_msg_02">, 착용 사이즈는 </span><span>${sizeData.model_wear}</span><span data-i18n="pd_model_msg_03">입니다.</span>`;
        }
        img.style.backgroundImage = `url('http://116.124.128.246:81/${sizeData.img_file_name}')`;
        dct.innerHTML = data.map(dimension => `
            <li class="dct-row">
                <span>${dimension.title}</span>
                <span>${dimension.desc}</span>
                <span class="dct-value">${dimension.value}</span>
            </li>
        `).join('');
    }
    function updateSizeGuide(size) {
        const data = sizeData.dimensions[size];
        const noti = document.querySelector('#sizeguide-noti');
        const img = document.querySelector('#sizeguide-img');
        const dct = document.querySelector('#sizeguide-dct');

        if (!sizeData.model || !sizeData.model_wear) {
            noti.innerHTML = '';
        } else {
            noti.innerHTML = `<span data-i18n="pd_model_msg_01">모델 신장 </span><span>${sizeData.model}</span><span data-i18n="pd_model_msg_02">, 착용 사이즈는 </span><span>${sizeData.model_wear}</span><span data-i18n="pd_model_msg_03">입니다.</span>`;
        }
        img.style.backgroundImage = `url('http://116.124.128.246:81/${sizeData.img_file_name}')`;
        dct.innerHTML = data.map(dimension => `
            <li class="dct-row">
                <span>${dimension.title}</span>
                <span>${dimension.desc}</span>
                <span class="dct-value">${dimension.value}</span>
            </li>
        `).join('');
    }

    createSizeButtons();
    domUpdateSizeGuide(firstSizeKey);

    // document.querySelector('.detail__sidebar__wrap .sidebar__body .detail__content__box .content-body').innerHTML = '';
    // document.querySelector('.detail__sidebar__wrap .sidebar__body .detail__content__box .content-body').appendChild(dom);

    return dom;

}
/**
 * @author SIMJAE
 * @description 웹 상품정보 사이드바 
 */
function innerSideBar() {
    let sideWrap = document.createElement("div");
    sideWrap.className = "detail__sidebar__wrap"
    sideWrap.innerHTML = `
        <div class="sidebar__background" data-modal="detail">
            <div class="sidebar__wrap" data-modal="detail">
                <div class="detail--box--btn"></div>
                <div class="sidebar__box" data-modal="detail">
                    <div class="sidebar__header">
                        <img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">
                    </div>
                    <div class="sidebar__body">
                        <div class="detail__content__box">
                            <div class="detail-content precaution">
                                <div class="content-header"><span data-i18n=""></span></div>
                                <div class="content-body"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `
    document.querySelector(".info__wrap").appendChild(sideWrap);
}

function addProductForGA(data) {
    const main = document.querySelector("main");
    let country = getLanguage();
    if (data[0] != null && country != null) {
        let d = data[0];
        var productNo = d.product_idx;
        var productBrand = d.brand;
        var productName = d.product_name;
        var productPrice = d.sales_price;//.replace(/[^0-9]/g,''); // replace 필요할 경우 사용

        let currency_str = null;
        if (country == 'KR') {
            currency_str = 'KRW';
        }
        else if (country == 'EN' || country == 'CN') {
            currency_str = 'USD';
        }

        dataLayer.push({
            'event': 'view_item',
            'ecommerce': {
                'items': [{
                    'item_id': productNo,
                    'item_name': productName,
                    'item_brand': productBrand,
                    'item_category': '',
                    'item_variant': '',
                    'currency': currency_str,
                    'price': productPrice,
                    'quantity': 1
                }]
            }
        });
    }
}

function addCartForGA(option_arr) {
    const main = document.querySelector("main");
    let country = getLanguage();

    let currency_str = null;
    if (country == 'KR') {
        currency_str = 'KRW';
    }
    else if (country == 'EN' || country == 'CN') {
        currency_str = 'USD';
    }
    getOptionProductList(option_arr, currency_str);
}

//장바구니 담기를 할 수 있는지와 장바구니에 담을 목록을 구한다.
function getOptionProductList(option_arr, currency_str) {
    const main = document.querySelector("main");
    let country = getLanguage();
    var pList = [];
    $.ajax({
        type: "post",
        data: {
            "option_idx_arr": option_arr,
            "country": getLanguage(),
        },
        async: false,
        dataType: "json",
        url: "http://116.124.128.246:80/_api/product/option/get",
        error: function () {
            return {
                'totalList': pList.length,
                'list': pList
            };
        },
        success: function (d) {
            if (d != null && d.data != null) {
                let data = d.data;
                data.forEach(function (row) {
                    var pName = row.product_name;
                    var pVariant = row.option_name;
                    var pCategory = '';
                    var pBrand = row.brand;
                    var pQuantity = 1;
                    var pPrice = row.sales_price;
                    var productNo = row.product_code;
                    pList.push({
                        'item_name': pName,
                        'item_variant': pVariant,
                        'item_id': productNo,
                        'price': pPrice,
                        'quantity': pQuantity,
                        'item_brand': pBrand,
                        'item_category': pCategory
                    });
                });
                dataLayer.push({
                    'event': 'add_to_cart',
                    'ecommerce': {
                        'currencyCode': currency_str,
                        'items': pList
                    }
                });
            }
        }
    });
}

window.addEventListener('DOMContentLoaded', function () {
    let product_idx = document.querySelector("main").dataset.productidx;
    addProductForGA(getProductApi(product_idx));
    pdResponsiveSwiper();
    mobileDetailBtnHanddler();
    $('#quickview').removeClass("hidden");
    changeLanguageR();
});

window.addEventListener('resize', function () {
    clearTimeout(timer);
    timer = setTimeout(function () {
        pdResponsiveSwiper();
    }, delay);
});
