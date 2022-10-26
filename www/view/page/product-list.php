<link rel=stylesheet href='/css/product/list.css' type='text/css'>
<main>
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$page_idx = getUrlParamter($page_url, 'page_idx');
	?>
	<input id="page_idx" type="hidden" value="<?=$page_idx?>">
	<input id="country" type="hidden" value="KR">
	
    <section class="product__list__wrap">
        <div class="top__banner"></div>
        <div class="prd__meun">
            <div class="prd__meun__grid">
                <div class="swiper-button-prev"></div>
                <div class="prd__meun__swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">전체보기</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">의류</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">액세서리</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">Twinheart line</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">티셔츠</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">스웨트셔츠 & 후드</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">수트</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">신발</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">기타</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">홈웨어</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">전체보기</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="prd__meun__box">
                                <div class="prd__img__wrap">
                                    <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                                </div>
                                <p class="prd__title">전체보기</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="prd__meun__sort">
                <li class="flex">
                    <img src="/images/svg/sort-bottom.svg" alt="" style="width: 10px;">
                    <span>정렬</span>
                </li>
                <li class="flex">
                    <img src="/images/svg/filter.svg" alt="" style="width: 15px;">
                    <span>필터</span>
                </li>
                <li class="flex">
                    <img src="/images/svg/cloth.svg" alt="" style="width: 11px;">
                    <span>아이템보기</span>
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
		
        <div class="product__list__box" data-grid="4">
            
			<div class="prd__list">
                <div class="absolute right-0 p-5">
                    <img src="/images/svg/wishlist.svg" alt="">
                </div>
                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01YG_mdl_1661843858.png') ;"></div>
                <div class="px-2 py-3">
                    <div class="flex justify-between">
                        <div>${index.product_code}</div>
                        <div>529.000</div>
                    </div>
                    <div>Gray</div>
                    <div class="flex justify-between">
                        <div class="color__chip">
                            <li class="bg-slate-500"></li>
                            <li class="bg-orange-600"></li>
                            <li class="bg-emerald-400"></li>
                        </div>
                        <div class="flex gap-3">
                            <div>A1</div>
                            <div>A2</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</main>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        productListSelectGrid();
        getProductList();

    });
    const getProductList = () => {
		let page_idx = $('#page_idx').val();
		let country = $('#country').val();
		
        $.ajax({
            type: "post",
            data: {
                "page_idx": page_idx,
				"country": country,
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/product/list/get",
            error: function() {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                /*let productHtml = ""
                let imagesUrl = "/images/product/"
                let productWrap = document.querySelector('.recommend-swiper .swiper-wrapper');*/
                
				data.forEach(function(index) {
					/*productHtml += `
					<div class="swiper-slide">
						<div class="relative recommend__prd">
							<div class="absolute right-0 p-5">
								<img src="/images/svg/wishlist.svg" alt="">
							</div>
							<div class="recommend__img" style="background-image:url('${index.img_location}') ;"></div>
							<div class="px-2 py-3">
								<div class="flex justify-between">
									<div>${index.product_code}</div>
									<div>529.000</div>
								</div>
								<div>Gray</div>
								<div class="flex justify-between">
									<div class="color__chip">
										<li class="bg-slate-500"></li>
										<li class="bg-orange-600"></li>
										<li class="bg-emerald-400"></li>
									</div>
									<div class="flex gap-3">
										<div>A1</div>
										<div>A2</div>
									</div>
								</div>
							</div>
						</div>
					</div>`*/
                });
                //productWrap.innerHTML = productHtml;
            }
        });
    }
	
    //모바일 & 웹 그리드별 보기 기능
    let productListSelectGrid = () => {
        let $body =document.querySelector("body");
        let $prdListBox = document.querySelector(".product__list__box");
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
        //웹 sort 버튼 클릭
        $webSortGrid.addEventListener("click", ()=> {
            let currentGrid = document.querySelector(".product__list__box").dataset.grid;
            switch (currentGrid){
                case "2": //4칸으로 바꿔야함 2칸보기로 바꾸기
                    //그리드 박스 변경
                    $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                    $prdListBox.dataset.grid = 4;
                    //그리드 버튼 변경
                    $webSortGrid.dataset.grid = 2;
                    $websortSpan.innerText = '2칸보기';
                    $websortImg.src = '/images/svg/grid-cols-2.svg';
                    break;
                
                case "4": 
                    //그리드 박스 변경
                    $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                    $prdListBox.dataset.grid = 2;
                    //그리드 버튼 변경
                    $webSortGrid.dataset.grid = 4;
                    $websortSpan.innerText = '4칸보기';
                    $websortImg.src = '/images/svg/grid-cols-4.svg';
                    break;
            }
        });
        //모바일 sort 버튼 클릭
        $mobileSortGrid.addEventListener("click", ()=> {
            currentGrid = document.querySelector(".product__list__box").dataset.grid;
            switch (currentGrid){
                case "3": 
                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 2;
                    
                    $mobileSortGrid.dataset.grid = 1;
                    $mobileSortSpan.innerText = '1칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-2.svg';
                    break;
                
                case "2": 
                    $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                    $prdListBox.dataset.grid = 1;

                    $mobileSortGrid.dataset.grid = 3;
                    $mobileSortSpan.innerText = '3칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-3.svg';
                    break;
                case "1": 
                    $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                    $prdListBox.dataset.grid = 3;

                    $mobileSortGrid.dataset.grid = 2;
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-2.svg';
                    break;
                }
        });
        //사이즈 변경시 그리드 대응
        window.addEventListener('resize', function() {
            if (mql.matches) {
                $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                $prdListBox.dataset.grid = 3;
                $mobileSortSpan.innerText = '2칸보기';
            } else {
                $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
                $prdListBox.dataset.grid = 4;
            }
        });
    } 
    (() => {
        const $$prd__list = document.querySelectorAll('.prd__list');
            $$prd__list.forEach((el) => {
                el.addEventListener("click", () => {
                    location.href="http://116.124.128.246:80/product/detail"
                });
            })
    })()
    /* 모바일 & 웹 상품 카테고리 스와이프 */
    let productListSwiper = new Swiper(".prd__meun__swiper", {
        navigation: {
            nextEl: ".prd__meun__grid .swiper-button-next",
            prevEl: ".prd__meun__grid .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 5,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 8,
                spaceBetween: 10
            }
        }

    });
</script>