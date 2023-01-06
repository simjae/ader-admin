
export default function ForyouRender() {
    // this.section = section;


    this.makeHtml = () => {
        const sectionWrap = document.querySelector(".recommend-wrap")
        const wrap = document.createElement("aside");
        wrap.classList.add("foryou-wrap");
        const dom = 
            `
                <div class="left__title"><span>For you   ></span></div>
                <div class="swiper-grid">
                    <div class="foryou-swiper swiper">
                        <div class="swiper-wrapper">
        
                        </div>
                    </div>
                </div>
            `
        wrap.innerHTML = dom;
        sectionWrap.appendChild(wrap);
    } 
    
    this.load = () =>{
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/recommend/get",
            error: function() {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let imgUrl ="http://116.124.128.246:81";
                
				let data = d.data;
				
				let productRecommendListHtml = "";
				const swiperWrap = document.querySelector(".foryou-swiper .swiper-wrapper");
                const domFrag = document.createDocumentFragment();
               
                
                data.forEach(el => {
                    let prdListSlide = document.createElement("div");
                    prdListSlide.classList.add("swiper-slide");
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

					let product_size = el.product_size;

					let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
					let colorCtn = el.product_color.length;

					productRecommendListHtml =
                        `<div class="product">
                            <div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="">
                                ${whish_img}
                            </div>
                            <a href="http://116.124.128.246:80/">
                                <div class="product-img swiper" onClick="location.href=''">
                                    <img class="prd-img" cnt="${el.product_idx}" src="${imgUrl}${el.product_img}" alt="">
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
                        </div>`;
                    prdListSlide.innerHTML  = productRecommendListHtml;
                    domFrag.appendChild(prdListSlide);
                });
                swiperWrap.appendChild(domFrag);
            }
        });
    }
    this.swiper = () => {
        return new Swiper(".foryou-swiper", {
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
}