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
//슬라이더별 헤더색상 변경
let header_color = [];

let main_newSwiper = new Swiper(".new__project__swiper", {
    navigation: {
        nextEl: ".new__project__swiper .swiper-button-next",
        prevEl: ".new__project__swiper .swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    grabCursor: true,
    slidesPerView: 1,
    on: {
        slideChange : function() {
            $("header").removeClass("BL");
            $("header").removeClass("WH");
            $("header").addClass(header_color[main_newSwiper.activeIndex]);
        }		
    }
});

let main_recommendSwiper = new Swiper(".recommend-swiper", {
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

let main_stylingSwiper = new Swiper(".styling-swiper", {
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
                // main_stylingSwiper.extendDefaults({
                //     centeredSlides: true
                // });
                console.log(main_stylingSwiper.passedParams.centeredSlides);
                main_stylingSwiper.passedParams.centeredSlides = true;
                console.log(main_stylingSwiper.passedParams.centeredSlides);
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

let main_reSwiper = new Swiper(".re-swiper", colaboSetting);

(() => {
    let $slide = document.querySelectorAll('.recommend-swiper .swiper-slide');
    $slide.forEach((el) => {
        el.addEventListener('click', () => {
            location.href = "http://116.124.128.246:80/product/list";
        });
    });
})();

function main_swiperResize() {
    let screenWidth = document.querySelector(".styling-wrap").offsetWidth
    let nextbtn = document.querySelector(".styling-swiper .navigation .swiper-button-next");
    let prevbtn = document.querySelector(".styling-swiper .navigation .swiper-button-prev");
    
    let styleTboxHeight = 0;
    let oneGridSize = 0;
    let mobileOneGridSize = 0;

    if(main_stylingSwiper.el.querySelector(".t-box") != null){
        styleTboxHeight = main_stylingSwiper.el.querySelector(".t-box").offsetHeight;
    }

    if (screenWidth >= 1024) {
        oneGridSize = (screenWidth / 16);
        nextbtn.style.width = `${oneGridSize}px`;
        nextbtn.style.height = `${styleTboxHeight}px`;
        prevbtn.style.width = `${oneGridSize}px`;
        prevbtn.style.height = `${styleTboxHeight}px`;
        main_reSwiper.update();
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
const getMainInfo = () => {
    let country = getLanguage();
    $.ajax({
        type: "post",
        data: {
            'country' : country
        },
        dataType: "json",
        url: "http://116.124.128.246:80/_api/landing/get",
        error: function () {
            alert("메인 랜딩 불러오기 처리중 오루가 발생했습니다.");
        },
        success: function (d) {
            if (d.code == 200) {
                let data = d.data;
                if (data != null) {
                    let tmp_header_color = data.banner_info.map(function(bannerRow) {
                        return bannerRow.background_color;
                    });
                
                    $('header').addClass(tmp_header_color[0]);
                
                    let bannerSlides = data.banner_info.map(function(bannerRow) {
                        let bannerLocation = bannerRow.content_type === "mov" ? bannerRow.banner_location_mov : bannerRow.banner_location;
                        let btn1Html = bannerRow.btn1_display_flg ? `<a href="${bannerRow.btn1_url}" class="read__more under-line wh">${bannerRow.btn1_name}</a>` : "";
                        let btn2Html = bannerRow.btn2_display_flg ? `<a href="${bannerRow.btn2_url}" class="read__more under-line wh">${bannerRow.btn2_name}</a>` : "";
                        
                        return `
                            <div class="swiper-slide">
                                ${bannerRow.content_type === "IMG" ? `
                                    <picture>
                                        <source media="(max-width: 1024px)" srcset="${cdn_img}${bannerRow.banner_location_mob}">
                                        <img class="" src="${cdn_img}${bannerLocation}" alt="">
                                    </picture>
                                ` : `
                                    <video autoplay loop muted>
                                        <source src="${cdn_vid}${bannerLocation}" type="video/mp4">
                                    </video>
                                `}
                                <div class="new__project__content">
                                    <div class="cnt-box">
                                        <div class="season__title">${bannerRow.title}</div>
                                        <div class="title">${bannerRow.sub_title}</div>
                                        <div class="btn__wrap">
                                            ${btn1Html}
                                            ${btn2Html}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#main_banner_swiper').append(bannerSlides.join(""));
                
                    let contentsInfo = data.contents_info;
                    $('#contents_img').attr('src', cdn_img + contentsInfo.img_location);
                    $('#contents_title').text(contentsInfo.title);
                    $('#contents_sub_title').text(contentsInfo.sub_title);
                
                    let contentsBtn1Html = contentsInfo.btn1_display_flg ? `<a href="${contentsInfo.btn1_url}" class="btn under-line bk">${contentsInfo.btn1_name}</a>` : "";
                    let contentsBtn2Html = contentsInfo.btn2_display_flg ? `<a href="${contentsInfo.btn2_url}" class="btn under-line bk">${contentsInfo.btn2_name}</a>` : "";
                
                    $('#contents_btn1').html(contentsBtn1Html).toggle(contentsBtn1Html !== "");
                    $('#contents_btn2').html(contentsBtn2Html).toggle(contentsBtn2Html !== "");
                
                    let productSlidesWeb = data.product_info.map(function(productRow) {
                        return `
                            <div class="swiper-slide" onClick="location.href='/product/detail?product_idx=${productRow.product_idx}'">
                                <a class="slide-box">
                                    <div class="center-box">
                                        <img src="${img_root}${productRow.img_location}" alt="">
                                        <div class="slide__title">${productRow.product_name}</div>
                                    </div>
                                </a>
                            </div>
                        `;
                    });
                
                    let productSlidesMobile = data.product_info.map(function(productRow) {
                        return `
                            <a class="slide-box">
                                <div class="center-box">
                                    <img src="${img_root}${productRow.img_location}" alt="">
                                    <div class="title">${productRow.product_name}</div>
                                </div>
                            </a>
                        `;
                    });
                
                    $('#contents_wrapper_web').append(productSlidesWeb.join(""));
                    $('#contents_wrapper_mobile').append(productSlidesMobile.join(""));
                
                    let imageSlides = data.img_info.map(function(imgRow) {
                        return `
                            <div class="swiper-slide">
                                <div class="styling__card">
                                    <div class="styling-box">
                                        <a href="${imgRow.btn_url}">
                                            <img class="styling__img" src="${cdn_img}${imgRow.img_location}" alt
                                            <div class="t-box">
                                                <div class="btn__wrap">
                                                    <a href="" class="under-line bk styling-title">
                                                        <p class="title">${imgRow.title}</p>
                                                        ${imgRow.btn_name}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                
                    $('#main_image_swiper').append(imageSlides.join(""));
                
                    main_newSwiper.update();
                    main_swiperResize();
                }
                
            }
        }
    });
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

                let wishBtnHtml = () => {
                        let wishObj = {
                            location : 'foryou',
                            wishStatus: el.whish_flg,
                            productIdx: el.product_idx,
                            url: new URL(location.href)
                        }
                        let whish_flg = `${el.whish_flg}`;
                        let whish_img = "";
                        let whish_function = "";
                        let login_status = getLoginStatus();
                        console.log("🏂 ~ file: foryou.js:55 ~ wishBtnHtml ~ login_status:", login_status)
                        if (login_status == "true") {
                            if (whish_flg == 'true') {
                                whish_img = `<img class="whish_img" data-status=${el.whish_flg} src="/images/svg/wishlist-bk.svg" alt="">`;
                                whish_function = `updateWishlist(this,${JSON.stringify(wishObj)});`;
                            } else if (whish_flg == 'false') {
                                whish_img = `<img class="whish_img" data-status=${el.whish_flg} src="/images/svg/wishlist.svg" alt="">`;
                                whish_function = `updateWishlist(this,${JSON.stringify(wishObj)});`;
                            }
                        } else {
                            whish_img = `<img class="whish_img" data-status=${el.whish_flg} src="/images/svg/wishlist.svg" alt="">`;
                            whish_function = `updateWishlist(this,${JSON.stringify(wishObj)});`;
                        }

                        return ` <div class="wish__btn" product_idx="${el.product_idx}" onClick=${whish_function}>${whish_img}</div>`
                    }

                productRecommendListHtml = `
                    <div>
                        ${wishBtnHtml()}
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

    let main_foryouSwiper = new Swiper(".foryou-swiper", {
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
window.addEventListener('DOMContentLoaded', () => {
    headerColorChange();
    getMainInfo();
    getProductRecommendList();
    mobileRecommandGrid();

});
window.addEventListener('resize', () => {
    document.querySelector("body").dataset
    main_swiperResize();
});