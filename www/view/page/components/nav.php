<div class="notice__wrap">
    <Marquee width="90%">
        <div class="notice__marquee">
            <div class="notice__title">cs 및 배송 시스템 개편 안내</div>
            <div class="notice__a"><u>자세히보기</u></div>
            <div class="notice__svg"><img src="/images/landing/left-arrow.svg" alt=""></div>
        </div>
    </Marquee>
    <div class="notice__close"><img src="/images/landing/close.svg" alt=""></div>
</div>
<nav class="header__wrap">
    <ul class="header__grid">
        <li class="cursor-pointer header__logo">
            <img src="/images/landing/logo.png" alt="">
        </li>
        <li class="hidden w-24 cursor-pointer lg:block web">베스트</li>
        <li class="hidden w-24 cursor-pointer lg:block web">남성</li>
        <li class="hidden w-24 cursor-pointer lg:block web">여성</li>
        <li class="hidden w-24 cursor-pointer lg:block web">라이프스타일</li>
        <li class="hidden w-24 cursor-pointer lg:block web">콜라보레이션</li>
        <li class="hidden w-24 cursor-pointer lg:block web" style="grid-column: 12/13;">스토리</li>
        <li class="hidden w-24 cursor-pointer lg:block web" style="grid-column: 13/14;">매장보기</li>
        <ul class="right__nav">
            <li class="w-13 hidden cursor-pointer lg:block web">
                <div class="flex">
                    <img src="/images/nav/search.svg" alt="">
                    <span class="pl-1">검색</span>
                </div>
            </li>
            <li class="hidden cursor-pointer lg:block web"><img class="w-4" src="/images/nav/earth.svg" alt=""></li>
            <li class="flex cursor-pointer "><img src="/images/nav/wishlist.svg" alt=""><span class="pl-1">12</span></li>
            <li class="flex cursor-pointer "><img src="/images/nav/basket.svg" alt=""><span class="pl-1">15</span></li>
            <li class="hidden cursor-pointer w-13 lg:block web">
                <div class="flex gap-1">
                    <img src="/images/nav/blue-tag.svg" alt="">
                    <img src="/images/landing/6554.png" alt="">
                </div>
            </li>
            <li class="hidden cursor-pointer lg:block web">사</li>
            <li class="flex cursor-pointer lg:hidden mobileMenu pr-3">
                <div class="hamburger" id="hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </li>
        </ul>
    </ul>
</nav>
<nav class="hidden lg:hidden" id="web">
    <div class="right-0 w-full mt-2 origin-top-right">
        <div class="grid w-full pt-2 pb-4 h-96 gap-x-8" style="grid-template-columns: repeat(16,1fr);gap: 10px;">
            <div style="grid-column: 4/5;">
                <div class="">컬렉션</div>
            </div>
            <div>오리진</div>
            <div>잡화</div>
        </div>
    </div>
</nav>
<nav class="lg:hidden" id="mobile">
    <div class="lg:hidden side__menu">
        <div class="mobile__menu">
            <ul class="text1">
                <li><span>베스트</span></li>
                <li><span>남성</span></li>
                <li><span>여성</span></li>
                <li><span>라이프스타일</span></li>
                <li><span>콜라보레이션</span></li>
            </ul>
            <ul class="text2">
                <li><span>스토리</span></li>
                <li><span>매장찾기</span></li>
            </ul>
            <ul class="text3">
                <li class="flex gap-2 w-7 mobile__search__btn"><img class="w-4" src="/images/nav/search.svg" alt=""><span>검색</span></li>
                <li class="flex gap-2"><img class="w-4" src="/images/nav/earth.svg" alt=""><span>한국어</span></li>
                <li class="flex gap-2"><img class="w-4" src="/images/nav/blue-tag.svg" alt=""><img src="/images/nav/mobile-bluemark.svg" alt=""></li>
                <li class="flex gap-2"><img class="w-4" src="/images/nav/user.svg" alt=""><span>사용자</span></li>
            </ul>
        </div>
        <div class="mobile__search">
            <div class="seach__input">
                <img src="/images/nav/mobile-search.svg" alt="">
                <input type="text" placeholder="검색어를 입력하세요">
            </div>
            <div class="recommend__search">
                <ul>
                    <li class="recommend__search__title">추천 검색어</li>
                    <li class="search__result">쇼퍼백</li>
                    <li class="search__result">트윈하트로고 티셔츠</li>
                    <li class="search__result">키링</li>
                    <li class="search__result">The new is not new</li>
                    <li class="search__result">버켄스탁 콜라보레이션</li>
                </ul>
            </div>
            <div class="recommend__prd">
                <div class="prd__title">추천 상품</div>
                <div class="prd__content">
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd2.png');"></div>
                        </div>
                        <p class="prd__img__title">shopper bag</p>
                    </div>
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd4.png');"></div>
                        </div>
                        <p class="prd__img__title">shopper bag</p>
                    </div>
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
                        </div>
                        <p class="prd__img__title">shopper bag</p>
                    </div>
                    <div class="prd__card">
                        <div class="prd__img__wrap">
                            <div class="prd__img" style="background-image: url('/images/product/prd3.png');"></div>
                        </div>
                        <p class="prd__img__title">shopper bag</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
      window.addEventListener('DOMContentLoaded', function() {
        mobileMenu();
        webMenu();
        dropMenu();
        mobileSearch();
        windowResponsive()
        //productLoadApi();
    });
    window.addEventListener('resize', () => {
        windowResponsive()
    });
    function windowResponsive(){
        let width = window.screen.width;
        const $body = document.querySelector("body");
        console.log(width);
        if(width  >= 1200){
            $body.dataset.view = "rW"
        }else{
            $body.dataset.view = "rM"
        }
    }
    (() => {
        const $headerWeb = document.querySelectorAll('.header__grid .web');
        const $web = document.querySelector('#web');
        const $header = document.querySelector('header');
        $headerWeb.forEach((el) => {
            el.addEventListener('mouseover', () => {
                $web.style.display = "block";
            });
        });
        $web.addEventListener('mouseleave', () => {
            $web.style.display = "none";
        });
        $header.addEventListener('mouseleave', () => {
            $web.style.display = "none";
        });
    })();
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
    let dropMenu = () => {
        const menuBtn = document.querySelectorAll('.drop__menu');
        const miusSvg = "images/footer/minus.svg";
        const plusSvg = "images/nav/plus.svg";
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