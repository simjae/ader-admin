<!-- <div class="notice__wrap">
    <Marquee width="90%">
        <div class="notice__marquee">
            <div class="notice__title">cs 및 배송 시스템 개편 안내</div>
            <div class="notice__a"><u>자세히보기</u></div>
            <div class="notice__svg"><img src="/images/landing/left-arrow.svg" alt=""></div>
        </div>
    </Marquee>
    <div class="notice__close"><img src="/images/landing/close.svg" alt=""></div>
</div> -->
<nav class="header__wrap"></nav>
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
    <div class="lg:hidden side__menu"></div>
</nav>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        getMenuListApi();
    });
    window.addEventListener('resize', () => {
        windowResponsive()
    });
    

    const getMenuListApi = () => {
        let country = "KR";
        $.ajax({
            type: "post",
            data: {
                "country": country
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/menu/get",
            error: function() {
                alert("메뉴 리스트를 불러오는데 실패 하였습니다.");
            },
            success: function(d) {
                let data = d.data;
                webWriteNavHtml(data);
                mobileWriteNavHtml(data);
                basketBtn();
            }
        });
    }
    const webWriteNavHtml = (data) => {
        let menuList = document.createElement("ul")
        menuList.classList.add("header__grid");
        menuHtml = "";
        let domfrag = document.createDocumentFragment(menuList);
        domfrag.appendChild(menuList)

        console.log(data);
        let colaboImg = ["/sample/colabo1.png","/sample/colabo2.png","/sample/colabo3.png","/sample/colabo4.png","/sample/colabo5.png"];

        menuHtml +=
            `<li class="header__logo" onClick="location.href='/'">
                <img class="logo"src="/images/landing/logo.png" alt="">
        </li>`
        
        data.forEach((el, idx) => {
            let lrgDiv = document.createElement("div");
            let lrg = el.menu_lrg;
            let mdl = lrg.menu_mdl;
            if( el.menu_lrg.menu_type =="PR") {
                menuHtml +=
                `<li class="drop web" data-tpye="${lrg.menu_type}" data-lrg="${idx}">
                    <a href="${lrg.menu_link}">${lrg.menu_title}</a>
                    <div class="drop__menu">
                        <ul class="cont">
                            <li class="swiper-li">
                                <div class="swiper swiper__box" data-id="${idx}" id="menuSwiper${idx}">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div>
                                                <img src="https://www.adererror.com/upload/2022fw/nav-collection2.jpg" alt="">
                                                <span class="swiper__title">TNNN line</span>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div>
                                                <img src="https://www.adererror.com/upload/2022fw/nav-curve.jpg" alt="">
                                                <span class="swiper__title">TNNN line</span>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div>
                                                <img src="https://www.adererror.com/upload/2022fw/nav.jpg" alt="">
                                                <span class="swiper__title">TNNN line</span>
                                                </div>
                                            </div>
                                        <div class="swiper-slide">
                                            <div>
                                                <img src="https://www.adererror.com/upload/2022fw/nav-tenit.jpg" alt="">
                                                <span class="swiper__title">TNNN line</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </li>
                            ${
                                mdl.map((el , idx)=> {
                                return`<li data-mdl="${idx}">
                                    <a class="mid-a" href="${el.menu_link}">${el.menu_title}</a>
                                    <ul class="sma__wrap">
                                    ${
                                        el.menu_sml.map((el, idx)=> {
                                            return`<li><a href="${el.menu_link}">${el.menu_title}</a></li>`
                                        }).join("")
                                    }
                                    </ul>
                                </li>`
                            }).join("")
                            }
                        </ul>
                    </div>
                </li>`
            }
            if( el.menu_lrg.menu_type =="PO") {
                menuHtml +=
                `<li class="hidden lg:block drop web" data-tpye="${lrg.menu_type}" data-lrg="${idx}">
                <a href="${lrg.menu_link}">${lrg.menu_title}</a>
                <div class="drop__menu">
                    <ul class="cont">
                        ${
                            mdl.map((el , idx)=> {
                            return`<li class="pobox"  data-mdl="${idx}">
                                <div class="colaboBox">
                                    <a class="mid-a" href="${el.menu_link}">${el.menu_title}</a>
                                    <img src ='http://116.124.128.246:80/images/${colaboImg[idx]}'>
                                </div>
                            </li>`
                        }).join("")
                        }
                    </ul>
                </div>
            </li>`
            }
        });
        menuHtml +=
                `<li class="drop web" style="grid-column: 12/13; font-size: 1.2rem;" data-large="6">
                    <a href="">스토리</a>
                </li>
                <li class="drop web" style="grid-column: 13/14; font-size: 1.2rem;">
                    <a href="">매장찾기</a>
                </li>
                <ul class="right__nav">
                    <li class="web">
                        <div class="flex" style="width: 37px;">
                            <img class="search-svg" style="width: 11px;" src="/images/svg/search.svg" alt="">
                            <span class="pl-1" style="font-size: 1.2rem;">검색</span>
                        </div>
                    </li>
                    <li class="web"><img class="earth-svg" style="width:17px; height:17px" src="/images/svg/earth.svg" alt=""></li>
                    <li class="flex"><img class="wishlist-svg" style="width:18px; height:15px" src="/images/svg/wishlist.svg" alt=""><span class="wish count">12</span></li>
                    <li class="flex basket__btn "><img class="basket-svg" style="width:12px; height:18px" src="/images/svg/basket.svg" alt=""><span class="basket count">14</span></li>
                    <li class="web"><img class="bluemark-svg" src="/images/svg/bluemark.svg" alt=""></li>
                    <li class="web"><img class="user-svg" style="width:20px; height:20px" src="/images/svg/user-bk.svg" alt=""></li>
                    <li class="flex pr-3 lg:hidden mobileMenu">
                        <div class="hamburger" id="hamburger">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </li>
            </ul>`
        menuList.innerHTML = menuHtml;
        document.querySelector(".header__wrap").appendChild(domfrag);
        mobileMenu();
        let $$webMenu = document.querySelectorAll(".web");
        let $webMenu = document.querySelector(".web");
        $$webMenu.forEach(el => {
            el.addEventListener("mouseover", function(e) {
                dropMenuAllSwiper();
                
            },{ once : true });
        });
    }
    const mobileWriteNavHtml = (data) => {
        let mobileMenu = document.createElement("div");
        mobileMenu.classList.add("mobile__menu");
        let domfrag = document.createDocumentFragment(mobileMenu);
        domfrag.appendChild(mobileMenu);
        let menuHtml = 
        `<ul class="top">`
        
        data.forEach((el, idx) => {
        let lrg = el.menu_lrg;
        let mdl = lrg.menu_mdl;
        menuHtml += 
        
        `<li class="lrg">
            <div class="lrg__title">${lrg.menu_title}</div>
            <div class="mdlBox">
                <ul class="mdl">
                    <a class="mdl__title" href="${lrg.menu_link}">전체보기</a>
                    ${
                    mdl.map((el,idx) => {
                            return `<a class="mdl__title"  href="${el.menu_link}">${el.menu_title}</a>`
                    }).join("")
                    }
                    <li class="swiper-li">
                        <div class="swiper m__swiper__box" data-id="${idx}" id="mobileMenuSwiper${idx}">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="slide-box">
                                        <img src="https://www.adererror.com/upload/2022fw/nav-collection2.jpg" alt="">
                                        <span class="swiper__title">TNNN line</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-box">
                                        <img src="https://www.adererror.com/upload/2022fw/nav-curve.jpg" alt="">
                                        <span class="swiper__title">TNNN line</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-box">
                                        <img src="https://www.adererror.com/upload/2022fw/nav.jpg" alt="">
                                        <span class="swiper__title">TNNN line</span>
                                        </div>
                                    </div>
                                <div class="swiper-slide">
                                    <div class="slide-box">
                                        <img src="https://www.adererror.com/upload/2022fw/nav-tenit.jpg" alt="">
                                        <span class="swiper__title">TNNN line</span>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </li>
                </ul>
            </div>
        </li>`
        });
        menuHtml +=
        `
        </ul>
        <ul class="mid">
                <li><span>스토리</span></li>
                <li><span>매장찾기</span></li>
            </ul>
            <ul class="bottom">
                <li class="flex gap-2 w-7 mobile__search__btn"><img src="/images/svg/search.svg" style="width:18px" alt=""><span>검색</span></li>
                <li class="flex gap-2"><img src="/images/svg/earth.svg" style="width:18px" alt=""><span>한국어</span></li>
                <li class="flex gap-2"><img src="/images/svg/blue-tag.svg" alt=""><img src="/images/svg/mobile-bluemark.svg" style="width:85px; margin-left: 7px; " alt=""></li>
                <li class="flex gap-2"><img src="/images/svg/user.svg" style="width:18px" alt=""><span>사용자</span></li>
            </ul>
            <div class="mobile__search">
                <div class="seach__input">
                    <img src="/images/svg/mobile-search.svg" alt="">
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
            </div>`
        mobileMenu.innerHTML = menuHtml;
        console.log(domfrag);
        document.querySelector(".side__menu").appendChild(domfrag);
        menuLrgClick();
        
    }
    function mobileMdlSwipe() {
        const $$swiperBox = document.querySelectorAll(".m__swiper__box");
        $$swiperBox.forEach((el, idx)=> {
            let mobileMenuSwiper = new Swiper(`#mobileMenuSwiper${idx}`,{
                observer:true,
                observeParents:true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: true
                }
            });
        });
    }
    function dropMenuAllSwiper() {
        const buildSwiperSlider = sliderEl => {
            const sliderIdentifier = sliderEl.dataset.id;
            return new Swiper(`#${sliderEl.id}`, {
                navigation: {
                    nextEl: `.swiper-button-next-${sliderIdentifier}`,
                    prevEl: `.swiper-button-prev-${sliderIdentifier}`
                },
                pagination: {
                    el: `.swiper-pagination-${sliderIdentifier}`,
                    type: 'progressbar',
                },
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: true,
                }
            });
        }
        const $$allSliders = document.querySelectorAll('.swiper__box');
        $$allSliders.forEach(slider => buildSwiperSlider(slider));
        
    }
    /*모바일 관련*/
    const menuLrgClick = () => {
        let $$lrgBtn = document.querySelectorAll(".lrg__title");
        $$lrgBtn.forEach(el => {
            el.addEventListener("click", (e) => {
                e.target.classList.toggle("open");
                if (e.target.classList.contains("open")) {
                    e.target.nextElementSibling.style.display = "block"
                    mobileMdlSwipe();
                } else {
                    e.target.nextElementSibling.style.display = "none"
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
    const mobileMenu = () => {
        const mobileMenuBtn = document.querySelector('.mobileMenu');
        const mobileSide = document.querySelector('#mobile');
        const hamburgerBtn = document.querySelector(".hamburger");
        let header = document.querySelector("header");
        mobileMenuBtn.addEventListener('click', (ev) => {
            mobileSide.classList.toggle('menu__on');
            hamburgerBtn.classList.toggle("is-active");
            header.classList.toggle("scroll");
        });
    };
    /*디바이스 체크*/
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

    function windowResponsive() {
        let width = window.screen.width;
        const $body = document.querySelector("body");
        // console.log(width);
        if (width >= 1200) {
            $body.dataset.view = "rW"
        } else {
            $body.dataset.view = "rM"
        }
    }
    function basketBtn(){
        const basketWrap = document.querySelector("#basket__side__wrap");
        const basketBtn = document.querySelector(".basket__btn");
        const modalBg= document.querySelector(".modal__background");
        const modalWrap = document.querySelector(".modal__wrap");
        basketBtn.addEventListener("click",() => {
            basketWrap.classList.toggle("open")
            modalBg.classList.toggle("open");
            modalWrap.classList.toggle("open");
        });
    }
    // const webMenu = () => {
    //     const navBtn = document.querySelectorAll('.webMenu');
    //     const web = document.querySelector('#web');
    //     navBtn.forEach((el) => {
    //         el.addEventListener('click', (ev) => {
    //             let slected = event.target.classList.contains('slected');
    //             console.log(contain);
    //             if (slected) {
    //                 ev.target.classList.remove('slected');
    //                 web.style.display = 'none';
    //             } else {
    //                 ev.target.classList.add('slected');
    //                 web.style.display = 'block';
    //             }
    //         });
    //     });
    // }
</script>