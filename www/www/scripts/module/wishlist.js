
export default function WishlistRender() {
    this.makeHtml = (() => {
        const sectionWrap = document.querySelector(".wishlist-wrap")
        const wrap = document.createElement("aside");
        wrap.classList.add("wish-wrap");
        const dom =
            `
                <div class="left__title"><span class = "allview">Wish list&nbsp;&nbsp;&nbsp;></span>
                <span class= "allview_under" onclick="location.href='/order/whish'" data-i18n="lm_view_all">전체보기</span></div>
                <div class="swiper-grid">
                    <div class="wish-swiper swiper">
                        <div class="swiper-wrapper">
        
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            `
        wrap.innerHTML = dom;
        sectionWrap.appendChild(wrap);
    })();

    this.load = (() => {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/list/get",
            error: function () {
                // alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function (d) {
                let imgUrl = "http://116.124.128.246:81";

                let data = d.data;

                if(data == null) {
                    let swiperContainer = document.querySelector(".swiper-grid");
                    let swiperMsgWrap = document.createElement("div");
                    swiperMsgWrap.className = "no_whishlist_msg";
                    swiperMsgWrap.textContent = "위시리스트가 비어있습니다."
                    swiperContainer.appendChild(swiperMsgWrap);
                } else {
                    let productRecommendListHtml = "";
                    const swiperWrap = document.querySelector(".wish-swiper .swiper-wrapper");
                    const domFrag = document.createDocumentFragment();
    
                    data.forEach(el => {
                        let prdListSlide = document.createElement("div");
                        prdListSlide.classList.add("swiper-slide");
                        let whish_img = "";
                        let whish_function = "";
    
                        let login_status = getLoginStatus();
    
                        if (login_status == "true") {
                            whish_img = `
                                        <div class="remove-btn"> 
                                            <img src="/images/svg/sold-line.svg">
                                            <img src="/images/svg/sold-line.svg">
                                        </div>
                                        `;
                            whish_function = `deleteWhish(this);`;
                        } else {
                            whish_img = `
                                        <div class="remove-btn"> 
                                            <img src="/images/svg/sold-line.svg">
                                            <img src="/images/svg/sold-line.svg">
                                        </div>
                                        `;
                            whish_function = `return false;`;
                        }
    
                        let product_size = el.product_size;
    
                        let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
                        let colorCtn = el.product_color.length;
    
                        productRecommendListHtml =
                            `<div class="product whish_list_mp">
                                <div class="wish__btn hidden" product_idx="${el.product_idx}" onClick="${whish_function}">
                                    ${whish_img}
                                </div>
                                
                                <a href="http://116.124.128.246:80/product/detail?product_idx=${el.product_idx}">
                                    <div class="product-img swiper">
                                        <img class="prd-img" cnt="${el.product_idx}" src="${imgUrl}${el.product_img}" alt="">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <div class="info-row">
                                        <div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
                                        ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>` : `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                                    </div>
                                    <div class="color-title"><span>${el.color}</span></div>
                                    <div class="info-row">
                                        <div class="color__box" data-maxcount="${colorCtn < 6 ? "" : "over"}" data-colorcount="${colorCtn < 6 ? colorCtn : colorCtn - 5}">
                                            ${el.product_color.map((color, idx) => {
                                                let maxCnt = 5;
                                                if (idx < maxCnt) {
                                                    return `<div class="color" data-color="${color.color_rgb}" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
                                                }
                                            }).join("")
                                            }
                                        </div>
                                        <div class="size__box">
                                            ${el.product_size.map((size) => {
                                                return `<li class="size" data-sizetype="" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
                                            }).join("")
                                            }  
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        prdListSlide.innerHTML = productRecommendListHtml;
                        domFrag.appendChild(prdListSlide);
                    });
                    swiperWrap.appendChild(domFrag);
                    let whish_list = document.querySelectorAll(".whish_list_mp");
                    whish_list.forEach(list => list.addEventListener("mouseenter", function() {
                        let remove_btn = list.querySelector(".wish__btn");
                        remove_btn.classList.remove("hidden");
                    }))
                    whish_list.forEach(list => list.addEventListener("mouseleave", function() {
                        let remove_btn = list.querySelector(".wish__btn");
                        remove_btn.classList.add("hidden");
                    }))
                }
            }
        });
    })();

    this.swiper = (() => {
        return new Swiper(".swiper-grid .wish-swiper", {
            watchOverflow: true,
            navigation: {
                nextEl: ".wish-swiper .swiper-button-next",
                prevEl: ".wish-swiper .swiper-button-prev",
            },
            pagination: {
                el: ".wish-swiper .swiper-pagination",
                clickable: true,
                disabledClass: 'swiper-button-disabled'
            },
            autoplayDisableOnInteraction: false,
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
    })();
}