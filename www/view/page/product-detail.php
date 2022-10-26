<link rel=stylesheet href='/css/product/detail.css' type='text/css'>
<main>
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$product_idx = getUrlParamter($page_url,'product_idx');
	?>
	<input id="product_idx" type="hidden" value="<?=$product_idx?>">
	<input id="country" type="hidden" value="KR">
	
    <div class="detail__sidebar__wrap">
        <div class="sidebar__background" data-modal="detail">
            <div class="sidebar__wrap" data-modal="detail">
                <div class="sidebar__box" data-modal="detail">
                    <div class="sidebar__header">
                        <img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">
                    </div>
                    <div class="sidebar__body">
                        <div class="content__btn__wrap">
                            <div class="tap__btn material__btn"><span>소재</span></div>
                            <div class="tap__btn product__info__btn"><span>제품 상세정보</span></div>
                            <div class="tap__btn precaution__btn"><span>제품 취급 유의사항</span></div>
                        </div>
                        <div class="content__box">
                            <div class="material"></div>
                            <div class=""></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="detail__wrapper">
        <div class="navigation__wrap">
            <div class="thumb__swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_1.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_2.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_3.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_4.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_5.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_6.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_7.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_8.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_9.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_10.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_11.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumb__img" style="background-image:url('/images/sample/BLASSHD03BL_12.jpeg');"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__img__wrap">
            <div class="main__swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_1.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_2.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_3.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_4.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_5.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_6.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_7.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_8.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_9.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_10.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_11.jpeg');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="detail__img" style="background-image:url('/images/sample/BLASSHD03BL_12.jpeg');"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="info__wrap">
            <div class="product__title">Twin heart hoodie</div>
            <div class="product__price">289,000</div>
            <div class="product__color">컬러색상</div>
            <div class="color__chip">
                <div class="color__outline select">
                    <div class="color" style="background-color:pink"></div>
                </div>
                <div class="color__outline">
                    <div class="color" style="background-color:slateblue"></div>
                </div>
                <div class="color__outline">
                    <div class="color" style="background-color:orange"></div>
                </div>
                <div class="color__outline">
                    <div class="color" style="background-color:greenyellow"></div>
                </div>
            </div>
            <div class="product__size">
                <div>Size</div>
                <div class="size__box">
                    <li>A1</li>
                    <li>A2</li>
                    <li>A3</li>
                    <li>A4</li>
                </div>
            </div>
            <div class="product__size__guide">
                <li><img src="/images/svg/size-guide.svg" alt=""></li>
                <li>사용자 가이즈</li>
            </div>
            <div class="basket__wrap">
                <div class="basket__box">
                    <div class="flex gap-2" style="align-items: center;padding: 10px;width: 80%;justify-content: center;border-right: 1px solid;">
                        <img src="/images/svg/basket.svg" alt="">
                        <span style="">쇼핑백에 담기</span>
                    </div>
                    <div style="justify-content: center;display: flex;width: 20%;">
                        <img src="/images/svg/basket-heart.svg" alt="" style="">
                    </div>
                </div>
                <div class="detail__info__wrap">
                    <div>소재</div>
                    <div>제품 상세 정보</div>
                    <div>제품 취급 유의 사항</div>
                </div>
            </div>
        </div>
    </section>
    <!-- styling -->
    <section class="swiper__wrapper lg:flex">
        <div class="text-left prd__left__side lg:text-right"><u>Styling with</u><span class="ml-3">></span></div>
        <div class="styling-swiper prd__list__swiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <div class="color__outline select">
                                        <div class="color" style="background-color:pink"></div>
                                    </div>
                                    <div class="color__outline">
                                        <div class="color" style="background-color:slateblue"></div>
                                    </div>
                                    <div class="color__outline">
                                        <div class="color" style="background-color:orange"></div>
                                    </div>
                                    <div class="color__outline">
                                        <div class="color" style="background-color:greenyellow"></div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- For you -->
    <section class="swiper__wrapper lg:flex">
        <div class="text-left prd__left__side lg:text-right"><u>For you</u><span class="ml-3">></span></div>
        <div class="recommend-swiper prd__list__swiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="prd__list__wrap">
                        <div class="prd__option__wrap">
                            <div class="absolute right-0 p-5">
                                <img src="/images/svg/wishlist.svg" alt="">
                            </div>
                        </div>
                        <div class="prd__list__img" style="background-image:url('/images/product/img_product_product_BLASSHD01KK_mdl_1661844466.png') ;"></div>
                        <div class="prd__list__content">
                            <div class="flex justify-between">
                                <div class="product__title">BLASSHD01KK</div>
                                <div class="product__price">529.000</div>
                            </div>
                            <div class="product__color">Gray</div>
                            <div class="flex justify-between">
                                <div class="color__chip">
                                    <li class="color bg-slate-500"></li>
                                    <li class="bg-orange-600 color"></li>
                                    <li class="color bg-emerald-400"></li>
                                </div>
                                <div class="flex gap-3">
                                    <div class="product__size">A1</div>
                                    <div class="product__size">A2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
	window.addEventListener('DOMContentLoaded', function() {
		getProduct();
		getRecommendProductList();
	});
	
	const getProduct = () => {
		let product_idx = $('#product_idx').val();
		let country = $('#country').val();
		
		$.ajax({
			type: "post",
			data: {
				"product_idx": product_idx,
				"country": country,
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/product/get",
			error: function() {
				alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;
				
				let relevant_idx = data[0].relevant_idx;
				console.log(relevant_idx);
				if (relevant_idx != null) {
					getRelevantProductList(relevant_idx,country);
				}
			}
		});
	}
	
	const getRelevantProductList = (relevant_idx,country) => {
		$.ajax({
			type: "post",
			data: {
				"relevant_idx": relevant_idx,
				"country": country
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/common/relevant/get",
			error: function() {
				alert("관련 상품 정보불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;
				console.log(data);
			}
		});
	}
	
	const getRecommendProductList = () => {
		let country = $('#country').val();
		
		$.ajax({
			type: "post",
			data: {
				"country": country
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/common/recommend/get",
			error: function() {
				alert("관련 상품 정보불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;
				console.log(data);
			}
		});
	}
	
    (function() {
        const data = {
            product :[
                {
                    PRODUCT_IDX:"1",
                    PRODUCT_CODE:"BLASSHD03BL",
                    PRODUCT_NAME:"Twin heart hoodie",
                    SALES_PRICE_KR:"289,000",
                    SALES_PRICE_EN:"289,000",
                    SALES_PRICE_CN:"289,000",
                    PRODUCT_IMG:[
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_1.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_2.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_3.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_4.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_5.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_6.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_7.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_8.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_9.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_10.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_11.jpeg"],//아마자  URL
                        },
                        {
                            IMG_TYPE:"product", //이미지 타입
                            IMG_LOCATION:"", //이미지 위치
                            IMG_URL:["/images/sample/BLASSHD03BL_12.jpeg"],//아마자  URL
                        }
                    ],//이미지 12개
                    COLOR:[
                        {
                            "productidx" : 2,
                            "name":"white",
                            "rgb":"#000000"
                        },
                        {
                            "productidx" : 3,
                            "name":"white",
                            "rgb":"#0000"
                        },
                        {
                            "productidx" : 4,
                            "name":"white",
                            "rgb":"#0000"
                        },
                    ],
                    PRODUCT_SIZE:{
                        A1:{
                            idx:1,
                            optioncode:"",
                            soldout : true,
                            qty : "0",
                        },
                        A2:{
                            idx:2,
                            optioncode:"",
                            sold : false,
                            count : "23",
                        },
                        A3:{
                            text: "A1",
                            sold : false,
                            count : "23",
                        },
                        A4:{
                            text: "A1",
                            sold : true,
                            count : "23",
                        }
                    },
                    LIMIT_MEMBER: "23",//구매제한 수량
                    관련상품:"",
                    추천상품:"",
                }
            ]   
        }
		
        data.product.forEach((el, idx)=> { 
            console.log(`${idx} : ${el.PRODUCT_CODE}`);
        });
		
		let detailPrdHtml = `
            <div class="img__box">
                <div class="img"
                    style="background-image:url('/images/product/img_product_product_BLASSHD01YG_mdl_1661843858.png');">
                </div>
            </div>
            <div class="info__wrap">
                <div class="product__title">Twin heart hoodie</div>
                <div class="product__price">289,000</div>
                <div class="product__color">컬러색상</div>
                <div class="color__chip">
                    <li class="bg-slate-500"></li>
                    <li class="bg-orange-600"></li>
                    <li class="bg-emerald-400"></li>
                    <li class="bg-sky-500"></li>
                </div>
                <div class="product__size">
                    <div>Size</div>
                    <div class="flex gap-4 pl-28">
                        <li>A1</li>
                        <li>A2</li>
                        <li>A3</li>
                        <li>A4</li>
                    </div>
                </div>
                <div class="product__size__guide">
                    <li><img src="/images/svg/size-guide.svg" alt=""></li>
                    <li>사용자 가이즈</li>
                </div>
                <div class="basket__wrap">
                    <div class="basket__box">
                        <div class="flex gap-2" style="align-items: center;padding: 10px;width: 80%;justify-content: center;border-right: 1px solid;">
                            <img src="/images/svg/basket.svg" alt="">
                            <span style="">쇼핑백에 담기</span>
                        </div>
                        <div style="justify-content: center;display: flex;width: 20%;">
                            <img src="/images/svg/basket-heart.svg" alt="" style="">
                        </div>
                    </div>
                    <div class="detail__info__wrap">
                        <div>소재</div>
                        <div>제품 상세 정보</div>
                        <div>제품 취급 유의 사항</div>
                    </div>
                </div>
            </div>
        `;
    }());
    //제품 소재, 상세정보, 취급유의사항 슬라이드
    (function(){
        
        let recommendSwiper = new Swiper(".recommend-swiper", {
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
        let stylingSwiper = new Swiper(".styling-swiper", {
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
        let thumbSwiper = new Swiper(".thumb__swiper", {
            navigation: {
                nextEl: '.thumb__swiper .swiper-button-next',
                prevEl: '.thumb__swiper .swiper-button-prev',
            },
            slideToClickedSlide: true,
            slidesPerView: 10,
            spaceBetween: 10,
            watchSlidesProgress: true,
            freeMode: true,
            direction : "vertical",
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,

            },
        });
        //메인 스와이프
        let mainSwiper = new Swiper(".main__swiper", {
            slidesPerView: 1,
            navigation: {
                nextEl: '.main__swiper .swiper-button-next',
                prevEl: '.main__swiper .swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },
            // normalizeSlideIndex:true,
            centeredSlides: true,
            slideToClickedSlide: true,
            thumbs: {
                swiper: thumbSwiper
            },
        });

        const $detailSidebarWrap = document.querySelector(".detail__sidebar__wrap");
        const $sidebarBg= document.querySelector(".detail__sidebar__wrap .sidebar__background");
        const $sidebarWrap = document.querySelector(".detail__sidebar__wrap .sidebar__wrap");
        const $detailInfoWrap = document.querySelector(".detail__info__wrap");
        const $sidebarCloseBtn = document.querySelector(".sidebar__close__btn");
        let $$contentBtn = document.querySelectorAll(".sidebar__body .content__btn__wrap .tap__btn");

        $detailInfoWrap.addEventListener("click",() => {
            $detailSidebarWrap.classList.toggle("open")
            $sidebarBg.classList.toggle("open");
            $sidebarWrap.classList.toggle("open");
            $detailInfoWrap.classList.toggle("open")
        });
        $sidebarCloseBtn.addEventListener("click",sideBarClose);
        //sidebar__wrap 외부 클릭 종료
        $sidebarBg.addEventListener("mouseup",function(e) {
            if(!$sidebarWrap.contains(e.target)) {
                sideBarClose();
            }
        });
        $$contentBtn.forEach((el) => {
            el.addEventListener("click", function(){
                removeTapSelect();
                this.querySelector("span").classList.add("select");
            });
        });

        function sideBarClose() {
            $detailSidebarWrap.classList.remove("open")
            $sidebarBg.classList.remove("open");
            $sidebarWrap.classList.remove("open");
            $detailInfoWrap.classList.remove("open");
        }
        function removeTapSelect() {
            $$contentBtn.forEach((el) => {
                el.querySelector("span").classList.remove("select");
            });
        }
    })();
</script>