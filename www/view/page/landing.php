<link rel=stylesheet href='/css/landing/style.css' type='text/css'>
<link rel=stylesheet href='/css/product/style.css' type='text/css'>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<main>
    <!-- banner -->
    <section class="new__project__wrap">
        <div class="new__project__swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="new__project__img" style="background-image:url('/images/landing/bg.jpeg') ;">
                        <div class="new__project__content">
                            <div class="season__title">2020 Spring Summer Collection</div>
                            <div class="title">After Blue</div>
                            <div class="btn__wrap">
                                <div class="read__more">자세히보기</div>
                                <div class="go__product">제품보러가기</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="new__project__img" style="background-image:url('/images/landing/intro.jpeg') ;"></div>
                </div>
                <div class="swiper-slide">
                    <div class="new__project__img" style="background-image:url('/images/landing/intro1.jpeg') ;"></div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- recommend -->
    <section class="lg:flex" style="">
        <div class="text-left for__you__box lg:text-right"><u>For you</u><span class="ml-3">></span></div>
        <div class="recommend-swiper swiper">
            <div class="swiper-wrapper">
            </div>
        </div>
    </section>
    <!-- exhibtion -->
    <section>
        <div class="exhibtion__wrap">
            <div class="exhibtion__img" style="background-image:url('/images/landing/main.jpeg') ;"></div>
            <div class="exhibtion__content">
                <div class="title">아더에러 22 SS 컬렉션 2차 드롭</div>
                <div class="season__title">22S/S 'Self Expression'</div>
                <div class="btn__wrap">
                    <div>자세히보기</div>
                    <div>제품보러가기</div>
                </div>
            </div>
        </div>
    </section>
    <!-- exhibtion product -->
    <section>
        <div class="exhibtion__prd__wrap">
            <div class="prd__box">
                <div class="prd__card">
                    <div class="prd__img__wrap">
                        <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                    </div>
                    <p class="prd__title">Standic airpods
                        leather case</p>
                </div>
                <div class="prd__card">
                    <div class="prd__img__wrap">
                        <div class="prd__img" style="background-image: url('/images/product/prd2.png');"></div>
                    </div>
                    <p class="prd__title">Standic airpods
                        leather case</p>
                </div>
            </div>
            <div class="prd__box">
                <div class="prd__card">
                    <div class="prd__img__wrap">
                        <div class="prd__img" style="background-image: url('/images/product/prd3.png');"></div>
                    </div>
                    <p class="prd__title">Standic airpods
                        leather case</p>
                </div>
                <div class="prd__card">
                    <div class="prd__img__wrap">
                        <div class="prd__img" style="background-image: url('/images/product/prd4.png');"></div>
                    </div>
                    <p class="prd__title">Standic airpods
                        leather case</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Styling -->
    <section class="lg:flex" style="">
        <div class="text-left for__you__box lg:text-right"><u>Styling</u><span class="ml-3">></span></div>
        <div class="styling-swiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="styling__card">
                        <div class="styling__img" style="background-image: url('/images/styling/styling4.jpeg');"></div>
                        <p class="title">Metal line</p>
                        <div class="btn__wrap">
                            <div>자세히보기</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="styling__card">
                        <div class="styling__img" style="background-image: url('/images/styling/styling3.jpeg');"></div>
                        <p class="title">Exclusive t-shirts edition</p>
                        <div class="btn__wrap">
                            <div>자세히보기</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="styling__card">
                        <div class="styling__img" style="background-image: url('/images/styling/styling2.jpeg');"></div>
                        <p class="title">Wide shopper bag</p>
                        <div class="btn__wrap">
                            <div>자세히보기</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="styling__card">
                        <div class="styling__img" style="background-image: url('/images/styling/styling4.jpeg');"></div>
                        <p class="title">shopper bag</p>
                        <div class="btn__wrap">
                            <div>자세히보기</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product__list__wrap">
        <div class="top__banner"></div>
        <div class="prd__meun">
            <div>
                스와이퍼 
            </div>
            <div>
                <li>정렬</li>
                <li>필터</li>
                <li>아이템보기</li>
                <li>2칸보기</li>
            </div>
        </div>
        <div class="product__list__box grid grid-cols-4">
            <div class="prd__list">
                <div class="absolute right-0 p-5">
                    <img src="/images/nav/wishlist.svg" alt="">
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
            <div class="prd__list">
                <div class="absolute right-0 p-5">
                    <img src="/images/nav/wishlist.svg" alt="">
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
            <div class="prd__list">
                <div class="absolute right-0 p-5">
                    <img src="/images/nav/wishlist.svg" alt="">
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
            <div class="prd__list">
                <div class="absolute right-0 p-5">
                    <img src="/images/nav/wishlist.svg" alt="">
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
        mobileMenu();
        webMenu();
        dropMenu();
        mobileSearch();
        productLoadApi();
    });
    class product {
    constructor(height, width) {
        this.height = height;
        this.width = width;
    }
}

    const productLoadApi = () => {
        let pram_arr = [5];
        $.ajax({
            type: "post",
            data: {
                "product_idx":pram_arr 
            }, 
            dataType: "json",
            url: "http://116.124.128.246:81/_api/display/product/grid/lib/get",
            error: function() {
                alert("상품 이미지 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                let productHtml =""
                let imagesUrl = "/images/landing/"
                let productWrap = document.querySelector('.recommend-swiper .swiper-wrapper');
                data.forEach(function(index) {
                    productHtml += `
                    <div class="swiper-slide">
                        <div class="relative recommend__prd">
                            <div class="absolute right-0 p-5">
                                <img src="/images/nav/wishlist.svg" alt="">
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
                    </div>`
                });
                productWrap.innerHTML = productHtml;
                console.log(productWrap);
            }
            
        }); 
    }


    const webMenu = () => {
        const navBtn = document.querySelectorAll('.webMenu');
        const web = document.querySelector('#web');
        navBtn.forEach((el) => {
            el.addEventListener('click', (ev) => {
                let slected = event.target.classList.contains('slected');
                console.log(contain);
                if (slected) {
                    ev.target.classList.remove('slected');
                    web.style.display = 'none';
                } else {
                    ev.target.classList.add('slected');
                    web.style.display = 'block';
                }
            });
        });
    }
    const mobileMenu = () => {
        const mobileMenuBtn = document.querySelector('.mobileMenu');
        const mobileSide = document.querySelector('#mobile');
        const hamburgerBtn = document.querySelector(".hamburger");

        mobileMenuBtn.addEventListener('click', (ev) => {
            mobileSide.classList.toggle('menu__on');
            hamburgerBtn.classList.toggle("is-active");
        });
    };
    let newSwiper = new Swiper(".new__project__swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        slidesPerView: 1
    });
    let recommendSwiper = new Swiper(".recommend-swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2.5
            },
            640: {
                slidesPerView: 4.5
            }
        }
    });
    let stylingSwiper = new Swiper(".styling-swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px
            320: {
                spaceBetween: 10,
                slidesPerView: 1.5
            },
            640: {
                slidesPerView: 3.2
            }
        }
    });
    let dropMenu = () => {
        const menuBtn = document.querySelectorAll('.drop__menu');
        const miusSvg = "css/images/footer/minus.svg";
        const plusSvg = "css/images/nav/plus.svg";
        menuBtn.forEach((el) => {
            el.addEventListener("click", function(ev) {
                let dropStatus = this.querySelector('.drop__down__content').dataset.dropdown;
                if (dropStatus === "none") {
                    console.log();
                    this.querySelector('.drop__down__wrap img').src = miusSvg;
                    this.querySelector('.drop__down__content').dataset.dropdown = "show";
                } else {
                    this.querySelector('.drop__down__wrap img').src = plusSvg;
                    this.querySelector('.drop__down__content').dataset.dropdown = "none";
                }
            });
        });
    }

    const mobileSearch = () => {
        let mobile = document.querySelector("#mobile");
        let mobileSearchBtn = document.querySelector(".mobile__search__btn");
        let mobileMenuWrap = document.querySelector(".mobile__menu");
        let mobileSearchWrap = document.querySelector(".mobile__search");
        mobileSearchBtn.addEventListener("click", () => {
            mobileMenuWrap.style.display = "none";
            mobileSearchWrap.style.display = "block";
            mobile.classList.add('search');
        });


    }

    function checkMobileDevice() {
        var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
        for (var info in mobileKeyWords) {
            if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
                //mobile
                return true;
            }
        }
        //web
        return false;
    }
</script>