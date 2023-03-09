
let timer = null;
//api 관련 
const getCollectionProjectList = () => {
    let country = getLanguage();
	
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/posting/collection/project/get",
        data: {
            'country': country
        },
        async: false,
        dataType: "json",
        error: function () {
            alert('컬렉션 프로젝트 조회처리중 오류가 발생했습니다.');
        },
        success: function (d) {
            result = d.data;
        }
    });
	
    return result;
}

const getCollectionProductList = (project_idx, last_idx) => {
    let result;
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/posting/collection/product/list/get",
        data: {
            'project_idx': project_idx,
            'last_idx': last_idx
        },
        async: false,
        dataType: "json",
        error: function () {
            alert('컬렉션 상품 이미지 조회처리중 오류가 발생했습니다.');
        },
        success: function (d) {
            result = d.data;
        }
    })
    return result;
}
const getCollectionProduct = (project_idx) => {
    let result;
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/posting/collection/product/get",
        data: {
            'project_idx': project_idx
        },
        async: false,
        dataType: "json",
        error: function () {
            alert('컬렉션 상품 개별 조회처리중 오류가 발생했습니다.');
        },
        success: function (d) {
            result = d.data;
        }
    })
    return result;
}
const getRelevantProduct = (c_product_idx) => {
    let result;
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/posting/collection/relevant/get",
        data: {
            'c_product_idx': c_product_idx
        },
        async: false,
        dataType: "json",
        error: function () {
            alert('컬렉션 관련상품 조회처리중 오류가 발생했습니다.');
        },
        success: function (d) {
            result = d.data;
        }
    })
    return result;
}

// append 관련
function appendLookbookCategory() {
    let lookbookSwiperWrapper = document.querySelector(".lookCategory-swiper .swiper-wrapper");
    let data = getCollectionProjectList();
    data.forEach((el, idx) => {
        let { project_desc, project_idx, project_name, project_title, thumb_location } = el;
        let slide = makeCategorySlide(project_idx, thumb_location, project_name, idx);
        lookbookSwiperWrapper.appendChild(slide);
        if(idx === lookbookCategorySwiper.activeIndex){
            let $lookbookResult = document.querySelector(".lookbook-result");
            let titleBox = makeTitleBox(project_idx,project_name,project_title);
            $lookbookResult.insertBefore(titleBox, $lookbookResult.firstChild);
            projectTitleBoxChange(project_name, project_title)
        }
    });
}
function appendLookbook(projectIdx, last_idx) {
    let lookbookResult = document.querySelector(".lookbook-result");
    let data = getCollectionProductList(projectIdx, last_idx);
    if (data === undefined) return;
    data.forEach(( el) => {
        let { c_product_idx, img_location, relevant_flg } = el;
        let list = makeLookbookHtml(c_product_idx, img_location);
        lookbookResult.appendChild(list);
    });
    const items = document.querySelectorAll('.lookbook-result .lookbook');
    const ioCallback = (entries, io) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                let lastIdx = document.querySelectorAll('.lookbook-result .lookbook').length;
                io.unobserve(entry.target);
                appendLookbook(projectIdx, lastIdx);
                observeLastItem(io, document.querySelectorAll('.lookbook-result .lookbook'));
            }
        });
    };
    const observeLastItem = (io, items) => {
        const lastItem = items[items.length - 1];
        io.observe(lastItem);
        return lastItem;
    };
    const lookbookObserve = new IntersectionObserver(ioCallback, { threshold: 0.7 });
    observeLastItem(lookbookObserve, items);
}
function appendDetailSwiper(data) {
    let lookbookDetailSwiperWrapper = document.querySelector(".lookbook-detail-swiper .swiper-wrapper");
    lookbookDetailSwiperWrapper.innerHTML= "";
    data.forEach(el => {
        let {
            c_product_idx,
            img_url,
            relevant_flg
        } = el;
        let slide = makeDetailSlide(c_product_idx, img_url);
        lookbookDetailSwiperWrapper.appendChild(slide);
    })
}
function appendRelated(data) {
    let relatedSwiperWrapper = document.querySelector(".related-product-swiper .swiper-wrapper");
    relatedSwiperWrapper.innerHTML= "";
    console.log("🏂 ~ file: lookbook.js:378 ~ appendRelated ~ data", data)
    if(data !== undefined){
        document.querySelector("#related-wrap").style.display="block";
        data.forEach(el => {
            let {
                product_idx,
                img_location,
                product_name,
                sold_out_flg
            } = el;
            let slide = makeRelatedSlide(product_idx,img_location, product_name,sold_out_flg);
            relatedSwiperWrapper.appendChild(slide);
        })
    } else {
        console.log("관련상품이 없습니다.")
        document.querySelector("#related-wrap").style.display="none";
    }

}

//html make 관련 
function makeLookbookHtml(c_product_idx, src) {
    let lookbook = document.createElement("div");
    // let titleText = title !== undefined ? title : "";
    let imgHtml = ` <img idx="${c_product_idx}" src="http://116.124.128.246:81/${src}" alt="">`;
    lookbook.className = "lookbook";
    lookbook.innerHTML = imgHtml;
    lookbook.setAttribute('product', c_product_idx);
    return lookbook;
}
function makeCategorySlide(project_idx, src, title, idx) {
    let categorySwiperSlide = document.createElement("div");
    let imgHtml = ` <div class="lookCategory-box">
                        <img src="http://116.124.128.246:81${src}" alt="">
                    </div>
                    <span>${title}</span>
    `;
    categorySwiperSlide.className = "swiper-slide";
    categorySwiperSlide.dataset.projectidx = project_idx;
    if (categorySwiperSlide.dataset.projectidx == getUrlParamValue('project_idx')) {
        categorySwiperSlide.classList.add("select");
    }
    categorySwiperSlide.innerHTML = imgHtml;
    return categorySwiperSlide;
}
function makeDetailSlide(c_product_idx ,src, title) {
    let detailSwiperSlide = document.createElement("div");
    let titleText = title !== undefined ? title : "";
    let imgHtml = ` <div class="lookbook-detail" product=${c_product_idx}>
                        <img src="${src}" alt="">
                    </div>
    `;
    detailSwiperSlide.className = "swiper-slide";
    detailSwiperSlide.setAttribute('product', c_product_idx);
    detailSwiperSlide.innerHTML = imgHtml;
    return detailSwiperSlide;
}
function makeRelatedSlide(product_idx,src, title,sold_out_flg) {
    let relatedSwiperSlide = document.createElement("div");
    let imgHtml = ` <div class="related-box">
                        <img src="http://116.124.128.246:81${src}" alt="">
                    </div>
                    <span class="related-title" >${title}</span>
    `;
    relatedSwiperSlide.className = "swiper-slide";
    relatedSwiperSlide.innerHTML = imgHtml;
    return relatedSwiperSlide;
}
function makeTitleBox(project_idx,project_name, project_title) {
    let titleBox = document.createElement("div");
    let imgHtml = `
        <div>
            <div class="lookbook-main__title">${project_name}</div>
            <div class="lookbook-sub__title">
                ${project_title}
            </div>
        </div> 
    `;
    titleBox.className = "lookbook-title-box hidden";
    titleBox.innerHTML = imgHtml;
    titleBox.dataset.project = project_idx;
    return titleBox;
}

//이벤트 관련 
function slideClickEvent() {
    let slide = document.querySelectorAll(".lookCategory-swiper .swiper-slide");
    let lookCategory = document.querySelector(".lookCategory-swiper");
    let lookbookTitle = document.querySelectorAll(".lookbook-title");
    lookCategory.addEventListener("click", function (e) {
        let $lookbookResult = document.querySelector(".lookbook-result");
        e.preventDefault();
        slide.forEach(el => { el.classList.remove("select") });
        e.target.offsetParent.classList.add("select");
        let title = document.querySelector(".lookCategory-swiper .swiper-slide.select").querySelector('span').innerHTML;
        let thumbIdx = lookbookCategorySwiper.clickedIndex;
        
        //카테고리 
        let thumData = getCollectionProjectList();
        let {project_idx,project_name,project_title} = thumData[thumbIdx];
        let projectIdx = e.target.offsetParent.dataset.projectidx;
        
        $lookbookResult.innerHTML = "";
        lookbookDetailSwiper.removeAllSlides();
        lookbookDetailSwiper = new Swiper(".lookbook-detail-swiper", {
            slidesPerView: 'auto',
            slidesPerView: 1,
            navigation: {
                nextEl: ".lookbook-detail-wrap .swiper-button-next",
                prevEl: ".lookbook-detail-wrap .swiper-button-prev",
            },
            pagination: {
                el: '.lookbook-detail-wrap .swiper-pagination',
                type: 'fraction',
            },
            on:{
                activeIndexChange: function () {
                    let idx = this.realIndex;
                    let current_idx = this.slides[idx].querySelector('.lookbook-detail').getAttribute("product");
                    let data = getRelevantProduct(current_idx);
                    console.log(data)
                    appendRelated(data);
                }
            }
        });
        
        appendLookbook(projectIdx);
        
        let titleBox = makeTitleBox(project_idx,project_name,project_title);
        $lookbookResult.insertBefore(titleBox, $lookbookResult.firstChild);
        projectTitleBoxChange(project_name, project_title)
    })
}
function lookbookClickEvent() {
    let lookbookWrap = document.querySelector(".lookbook-wrap");
    let lookbookDetailWrap = document.querySelector(".lookbook-detail-wrap");
    let lookbooks = document.querySelectorAll(".lookbook-wrap .lookbook");
    let lbResult = document.querySelector('.lookbook-result');
    let lookbookDetailSwiperWrapper = document.querySelector(".lookbook-detail-swiper .swiper-wrapper");
    // let relatedSwiperWrapper = document.querySelector(".related-product-swiper .swiper-wrapper");
    lbResult.addEventListener('click', function (ev) {
        let project_idx = document.querySelector(".lookCategory-swiper .swiper-slide.select").dataset.projectidx;
        let c_product_idx = ev.target.offsetParent.getAttribute("product");
        let detailData = getCollectionProduct(project_idx);
        let relevantData = getRelevantProduct(c_product_idx);
        appendDetailSwiper(detailData);
        appendRelated(relevantData)
        let target = ev.target.offsetParent;
        let productIdx = target.getAttribute('product');
        lookbookWrap.classList.remove("open");
        lookbookDetailWrap.classList.add("open");
        document.querySelector('.lookbook-title-box').classList.remove('hidden');
        console.log(idx)
        // lookbookDetailSwiper.slideTo(idx);
    });
}
function imgTypeBtn() {
    let imgBtn = document.querySelector(".image-type-btn");
    imgBtn.addEventListener("click", function () {
        let theme = document.querySelector(':root');
        let styles = getComputedStyle(theme);
        styles.getPropertyValue('--lookbookGrid');
        if (this.dataset.type == "L") {
            theme.style.setProperty('--lookbookGrid', 'repeat(6,1fr)')
            theme.style.setProperty('--grid-column', '1/15');
            this.dataset.type = "S";
            this.children[1].innerHTML = "크게보기"
            this.children[0].src = "/images/svg/grid-cols-3.svg"
        } else if (this.dataset.type == "S") {
            theme.style.setProperty('--lookbookGrid', 'repeat(3,1fr)')
            theme.style.setProperty('--grid-column', '1/17');
            this.dataset.type = "L";
            this.children[1].innerHTML = "작게보기"
            this.children[0].src = "/images/svg/grid-cols-4.svg"

        }
    })
}
function scrollTop() {
    let topBtn = document.querySelector(".lookbook-top-btn");
    topBtn.addEventListener("click", function () {
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    })
}
function backBtn() {
    let backBtn = document.querySelectorAll(".back-btn");
    let lookbookWrap = document.querySelector(".lookbook-wrap");
    let lookbookDetailWrap = document.querySelector(".lookbook-detail-wrap");
    backBtn.forEach(el => {
        el.addEventListener("click", function () {
            lookbookWrap.classList.add("open");
            lookbookDetailWrap.classList.remove("open");
            document.querySelector('.lookbook-title-box').classList.add('hidden');
        })
    })
}
function titleFooterObserver() {
    let observer;
    let options = {
        root: null,
        rootMargin: '0px',
        threshold: 0
    }
    let target = document.querySelector("footer")
    observer = new IntersectionObserver((entries) => {
        const $body = document.querySelector("body");
        let titlebox = document.getElementsByClassName("lookbook-title-box");
        entries.forEach(entry => {
            if (entry.isIntersecting && !$body.classList.contains("m_menu_open")) {
                let footerHeight = entry.boundingClientRect.height;
                let topbtn = document.querySelector(".lookbook-top-btn").offsetHeight;
                titlebox[0].style.bottom = "43%";
                if (document.querySelector("#related-wrap.mobile") !== null) {
                    document.querySelector("#related-wrap.mobile").style.bottom = `${footerHeight}px`;
                }
            } else {
                titlebox[0].style.bottom = "10%";
                if (document.querySelector("#related-wrap.mobile") !== null) {
                    document.querySelector("#related-wrap.mobile").style.bottom = `0px`;
                }
            }
        });
    }, options);
    observer.observe(target);
}
function responsive() {
    let breakpoint = window.matchMedia('screen and (max-width:1025px)');
    if (breakpoint.matches === true) {
        document.getElementById("related-wrap").classList.add("mobile");
        document.getElementById("related-wrap").classList.remove("web");
    } else if (breakpoint.matches === false) {
        document.getElementById("related-wrap").classList.add("web");
        document.getElementById("related-wrap").classList.remove("mobile");
    }
}

function mobileTilteChange(project_idx,project_name,project_title){
    let projectName = document.querySelector(".back-btn.mobile .lookbook-title");
}
function projectTitleBoxChange(project_name, project_title) {
    document.querySelector(".back-btn.mobile .lookbook-title").innerHTML = project_name;
    document.querySelectorAll('.lookbook-main__title').forEach(el => el.innerHTML = project_name);
    document.querySelectorAll('.lookbook-sub__title').forEach(el => el.innerHTML = project_title);
}

function categoryStickyEvent(){
    let header = document.querySelector('header');
    let main = document.querySelector('main');
    let category = document.querySelector('.look-header-wrap');
    let prevScrollpos = window.pageYOffset;

    window.onscroll = function() {
        let currentScrollPos = window.pageYOffset;

        if (prevScrollpos > currentScrollPos + 15) {
            // 스크롤을 15만큼 올릴 때
            main.style.overflow = 'initial';
            category.classList.add('hidden');
        } else if (prevScrollpos < currentScrollPos - 15) {
            // 스크롤을 15만큼 내릴 때
            category.style.top = `${header.offsetHeight}px`;
            main.style.overflow = 'hidden';
            category.classList.remove('hidden');
        }

        prevScrollpos = currentScrollPos;
    };
}
//스와이프 인스턴스  관련 
let lookbookCategorySwiper = new Swiper(".lookCategory-swiper", {
    // slidesPerView:'auto',
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
        nextEl: ".look-header-wrap .swiper-button-next",
        prevEl: ".look-header-wrap .swiper-button-prev",
    }

})
let lookbookDetailSwiper = new Swiper(".lookbook-detail-swiper", {
    slidesPerView: 'auto',
    slidesPerView: 1,
    navigation: {
        nextEl: ".lookbook-detail-wrap .swiper-button-next",
        prevEl: ".lookbook-detail-wrap .swiper-button-prev",
    },
    pagination: {
        el: '.lookbook-detail-wrap .swiper-pagination',
        type: 'fraction',
    },
    on:{
        activeIndexChange: function () {
            let idx = this.realIndex;
            let current_idx = this.slides[idx].querySelector('.lookbook-detail').getAttribute("product");
            let data = getRelevantProduct(current_idx);
            console.log(data)
            appendRelated(data);
        }
    }
})
let relatedSwiper = new Swiper(".related-product-swiper", {
    slidesPerView: 'auto',
    slidesPerView: 3.5,
    spaceBetween: 10,
    navigation: {
        nextEl: "#related-wrap .swiper-button-next",
        prevEl: "#related-wrap .swiper-button-prev",
    }
})

document.addEventListener("DOMContentLoaded", function () {
    let param_value = getUrlParamValue('project_idx');
    appendLookbookCategory();
    imgTypeBtn();
    appendLookbook(param_value);
    // appendLookbookDetail();
    scrollTop();
    backBtn();
    lookbookClickEvent()
    // appendRelated();
    slideClickEvent();
    titleFooterObserver();
    responsive();
    categoryStickyEvent();

    if(getUrlParamValue('project_idx') === null){
        $('.lookCategory-swiper .swiper-slide')[0].classList.add('select');
        let productIdx = $('.lookCategory-swiper .swiper-slide')[0].dataset.projectidx;
        appendLookbook(productIdx);
    }
});
window.addEventListener('resize', function () {
    clearTimeout(timer);
    timer = setTimeout(function () {
        responsive();
    }, 300);
});