<style>
    .product {
        width: 100%;
        border-left: solid 1px #dcdcdc;
    }
    .prd-img {
		/* max-width: 3.65vw; */
		max-width: 360px;
		max-height: 530px;
	}
    .foryou-wrap {
        padding-bottom: 200px;
        position: relative;
    }
    .foryou__wrapper .title{
        margin-left: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.33px;
        text-align: left;
        color: #343434;
    }
    .foryou-wrap img{
        width: 360px;
        height: 530px;
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
</style>

<div style="margin-bottom:50px;"></div>
<aside class="foryou__wrapper">
    <div class="title"><p>For you   ></p></div>
    <div class="foryou-wrap">
        <div class="foryou-swiper swiper">

        </div>
    </div>
</aside>

<script>
    window.addEventListener('DOMContentLoaded', function() {
		getProductRecommendList();
		
	});
    const getProductRecommendList = () => {		
        $.ajax({ 
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/recommend/get",
            error: function() {
                alert("추천상품정보 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let imgUrl ="http://116.124.128.246:81";
                
				let data = d.data;
				
				let productRecommendListHtml = "";
                let imgDiv="";
                const domFrag = document.createDocumentFragment();
					
				const foryouWrap = document.querySelector(".foryou-swiper");
                
				const prdRecommendListSlide = document.createElement("div");
				prdRecommendListSlide.classList.add("swiper-wrapper");
				
                data.forEach(el => {
					
					let product_link = "/product/detail?product_idx=" + `${el.product_idx}`;
					
					let wish_img = "";
					let wish_function = "";
					
					let wish_flg = `${el.wish_flg}`;
					if (wish_flg == 'true') {
						wish_img = '<img class="wish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">';
						wish_function = "deleteWishList(this);";
					} else if (wish_flg == 'false') {
						wish_img = '<img class="wish_img" src="/images/svg/wishlist.svg" alt="">';
						wish_function = "setWishList(this);";
					}
					
					let product_size = el.product_size;
					
					let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
					let colorCtn = el.product_color.length;

					productRecommendListHtml +=
					`<div class="swiper-slide">
						<div class="product">
							<div class="wish__btn" wish_idx="" product_idx="${el.product_idx}" onClick="">
								${wish_img}
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
						</div>
					</div>
					`;
					
					prdRecommendListSlide.innerHTML = productRecommendListHtml;
                });
				domFrag.appendChild(prdRecommendListSlide);
				console.log(domFrag);
				foryouWrap.appendChild(domFrag);
				foryouSwiper();
            }
        });
    }
	function foryouSwiper() {
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
</script>