document.addEventListener("DOMContentLoaded", function () {
    loadEditorialData();
    loadEditorialDetailData();
});

function getApiEditorial() {
    const url = "/scripts/story/json/editorial.json";
    return fetch(url)
        .then((response) => response.json())
        .then((json) => json.editorial);
}
function getApiEditorialDetail() {
    const url = "/scripts/story/json/editorial-detail.json";
    return fetch(url)
        .then((response) => response.json())
        .then((json) => json.data);
}
function loadEditorialData() {
    getApiEditorial()
    .then((editorial) => {
        editorial.forEach((el, idx) => {
            let { thumbnail_background, title, content, detail_img } = el;
            appendThumbnailTitle(title);
            appendThumbnailBackground(thumbnail_background, title, idx)
            asideClickEvent();
            bannerClickEvent();
            backBtn();
            responsive();
        });
    })
}
function loadEditorialDetailData() {
    getApiEditorialDetail().then((data) => {
        let { thumbnail_background, title, content, detail_img } = data;
        let detailTitle = document.querySelector(".editorial-contet-title");
        let detailSubitle = document.querySelector(".editorial-contet-subtitle");
        appendSlide(detail_img);
        detailTitle.innerHTML = title
        detailSubitle.innerHTML = content
    })
}
function appendThumbnailTitle(title) {
    let titleUl = document.querySelector(".thumbnail-side nav ul");
    let titleLi = document.createElement("li");
    titleLi.className = "thumbnail-title"
    titleLi.innerHTML = title;
    titleUl.appendChild(titleLi);
}
function appendSlide(detail_img) {
    let controllerWrap = document.querySelector(".editorial-controller-swiper .swiper-wrapper");
    let previewWrap = document.querySelector(".editorial-preview-swiper .swiper-wrapper");
    let docFrag = document.createDocumentFragment("div");
    let url = "http://116.124.128.246:80";
    detail_img.forEach(el => {
        let slide = document.createElement("div");
        slide.className = "swiper-slide";
        slide.innerHTML = `
            <img  src="${url}${el}" alt="">
        `
        docFrag.appendChild(slide);
    })
    let cloneNode = docFrag.cloneNode(true);
    controllerWrap.appendChild(docFrag)
    previewWrap.appendChild(cloneNode)
}
function appendThumbnailBackground(thumbnail_background, title, idx) {
    let backgroundHtml;
    let backgroundType = thumbnail_background.split('.', 2)[1];
    let editorialWrap = document.querySelector(".editorial-wrap");
    let article = document.createElement("article");
    let url = "http://116.124.128.246:80";
    article.className = "banner";
    if (idx > 0) article.classList.add("hidden")

    if (backgroundType === "mp4") {
        backgroundHtml = `<video controls autoplay muted loop src="${url}${thumbnail_background}"></video>`
    } else {
        backgroundHtml = `<img class="object-fit" src="http://116.124.128.246:80${thumbnail_background}" alt="">`
    }


    article.innerHTML = `
        <figure>
            ${backgroundHtml}
            <figcaption>${title}</figcation>
        </figure>
    `;
    editorialWrap.appendChild(article);
}



function asideClickEvent() {
    let banner = document.querySelectorAll(".editorial-wrap .banner");
    let thumTitle = document.querySelectorAll(".thumbnail-title");
    thumTitle.forEach((el, idx) => el.addEventListener("click", function () {
        banner.forEach(el => el.classList.add("hidden"));
        bannerTarget(idx).classList.remove("hidden");
    }))
    function bannerTarget(tidx) {
        return [...banner].find((el, idx) => idx === tidx);
    }
}

function backBtn() {
    let backBtn = document.querySelectorAll(".back-btn");
    let aside = document.querySelector(".thumbnail-side");
    let editorialWrap = document.querySelector(".editorial-wrap");
    let editorialDetailWrap = document.querySelector(".editorial-detail-wrap");

    backBtn.forEach(el => {
        el.addEventListener("click", function () {
            editorialWrap.classList.add("open");
            aside.classList.add("open");
            editorialDetailWrap.classList.remove("open");
        })
    })
}

function bannerClickEvent() {
    let aside = document.querySelector(".thumbnail-side");
    let editorialWrap = document.querySelector(".editorial-wrap");
    let editorialDetailWrap = document.querySelector(".editorial-detail-wrap");
    let banners = document.querySelectorAll(".editorial-wrap .banner");
    banners.forEach((el, idx) => el.addEventListener("click", function () {
        console.log(idx)
        aside.classList.remove("open");
        editorialWrap.classList.remove("open");
        editorialDetailWrap.classList.add("open");
    }))
}
var editorialControllerSwiper = new Swiper(".editorial-controller-swiper", {
    spaceBetween: 10,
    slidesPerView: 16.5,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 8.2,
            spaceBetween: 10
        },
        // when window width is >= 480px
        480: {
            spaceBetween: 10,
            slidesPerView: 9.2
        },
        // when window width is >= 640px
        640: {
            spaceBetween: 10,
            slidesPerView: 10.2
        },
        740: {
            spaceBetween: 10,
            slidesPerView: 11.2
        },
        840: {
            spaceBetween: 10,
            slidesPerView: 12.2
        },
        940: {
            spaceBetween: 10,
            slidesPerView: 14.2
        }
    }

});
var editorialPreviewSwiper = new Swiper(".editorial-preview-swiper", {
    slidesPerView: 1,
    autoHeight: true,
    thumbs: {
        swiper: editorialControllerSwiper,
    },
    navigation: {
        nextEl: ".preview-swiper-wrap .swiper-button-next",
        prevEl: ".preview-swiper-wrap .swiper-button-prev",
    },
    pagination: {
        el: '.preview-swiper-wrap .swiper-pagination',
        type: 'fraction',
    }
});

window.addEventListener("resize", function () {
    responsive()
});
function responsive(){
    let breakpoint = window.matchMedia('screen and (max-width:1025px)');
    if (breakpoint.matches === true) {
            let banner = document.querySelectorAll(".editorial-wrap .banner");
            banner.forEach(el => el.classList.remove("hidden"));
    } else if (breakpoint.matches === false) {
        
    }


 


}