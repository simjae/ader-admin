 <!-- foryou -->
    <section>
        <div class="foryou-wrap ">
            <div class="foryou-text"><span>For you</span>></div>
            <div class="foryou-swiper">
                <div class="swiper-wrapper product_recommend_wrapper">

                </div>
                <div class="navigation">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const getProductRecommendList = () => {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/recommend/get",
            error: function() {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
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