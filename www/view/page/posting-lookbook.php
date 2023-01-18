<style>
    :root{
        --grid-column:1/17;
        --lookbookGrid: repeat(3,1fr);
    }   
body{
    margin: 0;
    padding: 0;
}
main {
    display: grid;
    grid-template-columns: repeat(16,1fr);
    overflow: hidden;
}
.lock-wrap{
    position: relative;
}
/*
lookbook-wrap
----------------------------------------------------
*/
.lookbook-wrap {
    grid-column: 2/17;
    display: none;
}
.lookbook-wrap.open{
    display: block;
}
.lookbook-wrap .image-type-btn{
    cursor: pointer;
    display: flex;
    gap: 8px;
    align-self: flex-end;
    margin: 20px 0;
}
.look-body {
    display: grid;
    grid-template-columns: repeat(16,1fr);
}
.lookbook-wrap .lookbook-result {
    display: grid;
    grid-template-columns: var(--lookbookGrid);
    grid-column: var(--grid-column);
    width: 100%;
    gap: 10px;
}
/*
lookbook
----------------------------------------------------
*/
.lookbook-wrap .lookbook {
    cursor: pointer;
    position: relative;    
    flex-grow: 1;
}
.lookbook-wrap .lookbook img {
    max-width: 100%;
    height: 100%;
    object-fit: cover;
    width: 100%;
}
.lookbook-wrap .lookbook-title{
    position: absolute;
    bottom:0;
}

/*
swiper 
----------------------------------------------------
*/
.lookbook-wrap .look-header-wrap {
    display: flex;
    justify-content: space-between;
}
.lookbook-wrap .lookCategory-swiper{
    margin: 20px 0;
    position: relative;

}
.lookbook-result .lookbook-subtitle{
    position: fixed;
    z-index: 20;
    bottom: 10%;
}
.lookbook-wrap .lookCategory-swiper .swiper-wrapper {
    max-width: 890px;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide{
    cursor: pointer;
    display: flex;
    flex-direction: column;
    height: 100px;
    text-align: center;
    justify-content: space-between;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide span {
    opacity: 0.4;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide .lookCategory-box{
    display: flex;
    justify-content: center;
    align-items: center;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide.select .lookCategory-box{
    border: 1px solid #808080;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide.select span{
    opacity: 1;
}
.lookbook-wrap .lookCategory-swiper .swiper-slide .lookCategory-box img{
    margin: 5px;
}
.lookbook-wrap .lookCategory-swiper img {
    margin: 5px;
    max-width: 100%;
    height: 100%;
    width: 65px;
    height: 65px;
}


.lookbook-wrap .arrow-wrap{
    position: relative;
}
.lookbook-wrap .arrow-wrap .swiper-button-prev:after{
    display: none;
}
.lookbook-wrap .arrow-wrap .swiper-button-prev{
    left: -35px;
    background: url("/images/svg/arrow-left.svg") no-repeat;
    background-position: center;
}
.lookbook-wrap .arrow-wrap .swiper-button-next::after{
    display: none;
}
.lookbook-wrap .arrow-wrap .swiper-button-next{
    right: -35px;
    background: url("/images/svg/arrow-right.svg") no-repeat;
    background-position: center;
}

/*
top-btn
----------------------------------------------------
*/
.lookbook-wrap .lookbook-top-btn {
    cursor: pointer;
    display: flex;
    justify-content: center;
    margin: 100px 0 140px 0;
}

/*
lookbook-detail
----------------------------------------------------
*/
.lookbook-detail-wrap{
    display: none;
    background-color: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 20;
}
.lookbook-detail-wrap.open{
    display: block;
}
.lookbook-detail-wrap.open .lookbook-subtitle{
    position: absolute;
    z-index: 20;
    top: 50%;
    left: 10%;
}
.lookbook-detail-wrap .back-btn.web {
    position: absolute;
    right: 0;
    margin: 20px 20px 0 0;
    width: 90px;
    height: 20px;
    border-radius: 1px;
    border: solid 1px #343434;
    text-align: center;
    z-index: 20;
}
.lookbook-detail-wrap .back-btn.mobile{
    display: none;
}
.lookbook-detail-wrap .lookbook-detail-swiper img{
    width: 100%;
}
.lookbook-detail-wrap .lookbook-detail{
    max-width: 100%;
    height: 100vh;
    overflow: auto;
}
.lookbook-detail-wrap .lookbook-title{
    position: static;
}

.lookbook-detail-wrap .arrow-wrap{
    position: relative;
}
.lookbook-detail-wrap .swiper-button-prev:after{
    display: none;
}
.lookbook-detail-wrap .swiper-button-prev{
    top: 30%;
    background: url("/images/svg/arrow-left.svg") no-repeat;
    background-position: center;
    background-size: 40% auto;
    margin: 0px 70px;
}
.lookbook-detail-wrap .swiper-button-next::after{
    display: none;
}
.lookbook-detail-wrap .swiper-button-next{
    top: 30%;
    margin: 0px 70px;
    background: url("/images/svg/arrow-right.svg") no-repeat;
    background-position: center;
    background-size: 40% auto;
}
.lookbook-detail-wrap .swiper-pagination{
    bottom: auto;
    right: 50px;
    left: auto;
    text-align: end;
    top: 80px;
}

#related-wrap {
    width: 100%;
    padding: 10px 0px 10px 10px;
    position: absolute;
    bottom: 40%;
    right: 0;
    width: 300px;
    border: solid 1px #dcdcdc;
    background-color: #fff;
    z-index: 21;
}
#related-wrap .wrap-title{
    margin-bottom: 10px;
}
#related-wrap .related-title{
    text-align: center;
    margin-bottom: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
#related-wrap .related-box img{
    max-width: 100%;
    max-height: 100px;
    width: 80px;
    height: auto;
}
#related-wrap  .related-product-swiper{
    margin: 0;
    width: 260px;
}
#related-wrap .swiper-button-prev{
    display: none;
}
#related-wrap .swiper-button-next::after{
    display: none;
}
#related-wrap .swiper-button-next{
    right: 0px;
    top: 35%;
    margin: 0px;
    background: url('/images/svg/arrow-right.svg') no-repeat;
    background-position: center;
    background-size: 40% auto;
}
#related-wrap .swiper-pagination{
    bottom: auto;
    right: 50px;
    left: auto;
    text-align: end;
    top: 80px;
}

/*
반은형
----------------------------------------------------
*/
@media(max-width:1025px){
    /*
    lookbook-wrap
    ----------------------------------------------------
    */
    .lookbook-wrap {
        grid-column: 1/17;
    }
    .lookbook-wrap .lookbook-result {
        grid-template-columns: repeat(3 , 1fr);
        grid-column: 1/17;
    }
    .lookbook-wrap .image-type-btn {
        display: none;
    }
    .lookbook-result .lookbook-subtitle{
        display:none;
    }
    /*
    swiper 
    ----------------------------------------------------
    */
    .lookbook-wrap .lookCategory-swiper .swiper-slide{
        height: 90px;
    }
    .lookbook-wrap .lookCategory-swiper img{
        width: 55px;
        height: 55px;
    }
    .lookbook-wrap .arrow-wrap .swiper-button-prev{
        display: none;
    }
    .lookbook-wrap .arrow-wrap .swiper-button-next{
        display: none;
    }
    /*
    lookbook-detail-wrap
    ----------------------------------------------------
    */
    
    .lookbook-detail-wrap {
        position: static;
        height: 100%;
    }
    .lookbook-detail-wrap .back-btn{
        position: relative;
    }
    .lookbook-detail-wrap .back-btn.mobile{
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .lookbook-detail-wrap .back-btn.web{
        display: none;
    }
    .lookbook-detail-wrap .lookbook-detail{
        height: 100%;
    }
    .lookbook-detail-wrap .swiper-pagination {
        top: 20px;
        right: 20px;
    }
    .lookbook-detail-wrap .swiper-button-prev {
        top:50%;
        margin: 0;
    }
    .lookbook-detail-wrap .swiper-button-next {
        top:50%;
        margin: 0;
    }
    .lookbook-detail-wrap.open .lookbook-subtitle{
        position: static;
        margin-bottom: 20px;
        margin-left: 10px;
    }
    
    /*
    related-wrap
    ----------------------------------------------------
    */
    #related-wrap{
        position: relative;
        bottom: 0;
        width: 100%;
        margin-bottom: 65px;
    }
    #related-wrap .related-product-swiper{
        width: 325px;
    }
}
</style>
<main>
    <section class="lookbook-wrap open">
        <div class="look-header-wrap">
            <div class="arrow-wrap">
                <div class="lookCategory-swiper swiper">
                    <div class="swiper-wrapper"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="image-type-btn" data-type="L">
                <img src="/images/svg/grid-cols-4.svg" alt="">
                <span>작게보기</span>
            </div>
        </div>
        <div class="look-body">
            <div class="lookbook-result">
                <div class="lookbook-subtitle">
                    2022 Fall Winter Collection<br>
                    Phenomenon Communication
                </div>
            </div>
        </div>
        <div class="look-footer">
            <div class="add-btn"></div>
        </div>
        <div class="lookbook-top-btn">
            <img src="/images/svg/top-btn.svg" alt="">
        </div>
    </section>
    <section class="lookbook-detail-wrap">
        <div class="back-btn web"><span>list</span></div>
        <div class="back-btn mobile">
            <img src="/images/svg/arrow-back.svg" alt="">
            <span class="lookbook-title">
                project 1
            </span>
        </div>
        <div class="lookbook-subtitle">
            2022 Fall Winter Collection<br>
            Phenomenon Communication
        </div>
        <div class="lock-wrap">
            <div class="lookbook-detail-swiper swiper">
                <div class="swiper-wrapper"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div id="related-wrap">
            <div class="related-product-swiper swiper">
                <div class="wrap-title">Related products</div>
                <div class="swiper-wrapper"></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
</main>
<script>
    const related  = [
    {
        img_location:"/images/sample/22-fw-001.jpg",
        img_type:"P",
        title:"Ortei blazer"
    },
    {
        img_location:"/images/sample/22-fw-002.jpg",
        img_type:"P",
        title:"Small calliotote bag"
    },
    {
        img_location:"/images/sample/22-fw-003.jpg",
        img_type:"P",
        title:"Ation slacks"
    },
    {
        img_location:"/images/sample/22-fw-004.jpg",
        img_type:"P",
        title:"Ortei blazer"
    },
    {
        img_location:"/images/sample/22-fw-005.jpg",
        img_type:"P",
        title:"Small calliotote bag"
    },
    {
        img_location:"/images/sample/22-fw-006.jpg",
        img_type:"P",
        title:"Ation slacks"
    }
]
const lookbook  = [
    {
        img_location:"/images/sample/22-fw-001.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-002.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-003.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-004.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-005.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-006.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-007.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-008.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-009.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-010.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-011.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-012.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-013.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-014.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-015.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-016.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-017.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-018.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-001.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-002.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-003.jpg",
        img_type:"P",
        title:"2022 Fall Winter Collection<br>Phenomenon Communication"
    },
    {
        img_location:"/images/sample/22-fw-004.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-005.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-006.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-007.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-008.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-009.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-010.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-011.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-012.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-013.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-014.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-015.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-016.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-017.jpg",
        img_type:"P"
    },
    {
        img_location:"/images/sample/22-fw-018.jpg",
        img_type:"P"
    }
]
const lookbookCate = [
    {
        img_location:"/images/svg/Project1.svg",
        img_title:"product 1"
    },
    {
        img_location:"/images/svg/Project2.svg",
        img_title:"product 2"
    },
    {
        img_location:"/images/svg/Project3.svg",
        img_title:"product 3"
    },
    {
        img_location:"/images/svg/Project4.svg",
        img_title:"product 4"
    },
    {
        img_location:"/images/svg/Project5.svg",
        img_title:"product 5"
    },
    {
        img_location:"/images/svg/Project6.svg",
        img_title:"product 6"
    },
    {
        img_location:"/images/svg/Project7.svg",
        img_title:"product 7"
    },
    {
        img_location:"/images/svg/Project8.svg",
        img_title:"product 8"
    },
    {
        img_location:"/images/svg/Project9.svg",
        img_title:"product 9"
    },
    {
        img_location:"/images/svg/Project10.svg",
        img_title:"product 10"
    },
    {
        img_location:"/images/svg/Project11.svg",
        img_title:"product 11"
    },
    {
        img_location:"/images/svg/Project12.svg",
        img_title:"product 12"
    },
    {
        img_location:"/images/svg/Project13.svg",
        img_title:"product 13"
    },
    {
        img_location:"/images/svg/Project14.svg",
        img_title:"product 14"
    },
    {
        img_location:"/images/svg/Project15.svg",
        img_title:"product 15"
    }
]

document.addEventListener("DOMContentLoaded", function() {
    loadLookbook();
    imgTypeBtn();
    loadLookbookDetail();
    scrollTop();
    backBtn();
    lookbookClickEvent() 
    loadLookbookCategory();
    loadRelated();
    slideClickEvent();
});
function imgTypeBtn (){
    let imgBtn = document.querySelector(".image-type-btn");
    imgBtn.addEventListener("click", function(){
        let theme = document.querySelector(':root'); 
        let styles = getComputedStyle(theme); 
        styles.getPropertyValue('--lookbookGrid');
        if(this.dataset.type == "L"){
            theme.style.setProperty('--lookbookGrid', 'repeat(6,1fr)')
            theme.style.setProperty('--grid-column', '1/15');
            this.dataset.type = "S";
            this.children[1].innerHTML="크게보기"
            this.children[0].src = "/images/svg/grid-cols-3.svg"
        } else if(this.dataset.type == "S"){
            theme.style.setProperty('--lookbookGrid', 'repeat(3,1fr)')
            theme.style.setProperty('--grid-column', '1/17');
            this.dataset.type = "L";
            this.children[1].innerHTML="작게보기"
            this.children[0].src = "/images/svg/grid-cols-4.svg"

        }
    })
}
function loadLookbookCategory(){
    let lookbookSwiperWrapper = document.querySelector(".lookCategory-swiper .swiper-wrapper");
    lookbookCate.forEach(el => {
        let {img_location, img_title} = el;
        let slide = appendCategorySlide(img_location,img_title);
        lookbookSwiperWrapper.appendChild(slide);
    })
}
function loadRelated(){
    let relatedSwiperWrapper = document.querySelector(".related-product-swiper .swiper-wrapper");
    related.forEach(el => {
        let {img_location, title} = el;
        let slide = appendRelatedSlide(img_location,title);
        relatedSwiperWrapper.appendChild(slide);
    })
}
function loadLookbook() {
    let lookbookResult = document.querySelector(".lookbook-result");
    lookbook.forEach( el => {
        let {img_location, img_type,title} = el;
        let data = appendLookbookHtml(img_location,title);
        lookbookResult.appendChild(data);
    })
}
function loadLookbookDetail() {
    let lookbookDetailSwiperWrapper = document.querySelector(".lookbook-detail-swiper .swiper-wrapper");
    lookbook.forEach( el => {
        let {img_location, img_type,title} = el;
        let slide = appendDetailSlide(img_location,title);
        
        lookbookDetailSwiperWrapper.appendChild(slide);
    })
}

function appendLookbookHtml (src,title) {
    let lookbook = document.createElement("div");
    let titleText = title !== undefined ? title : "";
    let imgHtml  = ` <img src="${src}" alt="">`;
    lookbook.className ="lookbook";
    lookbook.innerHTML = imgHtml;
    return lookbook;
}
function appendCategorySlide(src,title) {
    let categorySwiperSlide = document.createElement("div");
    let imgHtml  = ` <div class="lookCategory-box">
                        <img src="${src}" alt="">
                    </div>
                    <span>${title}</span>
    `;
    categorySwiperSlide.className ="swiper-slide";
    categorySwiperSlide.innerHTML = imgHtml;
    return categorySwiperSlide;
}

function appendDetailSlide(src,title) {
    let detailSwiperSlide = document.createElement("div");
    let titleText = title !== undefined ? title : "";
    let imgHtml  = ` <div class="lookbook-detail">
                        <img src="${src}" alt="">
                    </div>
    `;
    detailSwiperSlide.className ="swiper-slide";
    detailSwiperSlide.innerHTML = imgHtml;
    return detailSwiperSlide;
}
function appendRelatedSlide(src,title) {
    let relatedSwiperSlide = document.createElement("div");
    let imgHtml  = ` <div class="related-box">
                        <img src="${src}" alt="">
                    </div>
                    <span class="related-title">${title}</span>
    `;
    relatedSwiperSlide.className ="swiper-slide";
    relatedSwiperSlide.innerHTML = imgHtml;
    return relatedSwiperSlide;
}
function slideClickEvent() {
    let slide = document.querySelectorAll(".lookCategory-swiper .swiper-slide");
    let lookbookTitle = document.querySelectorAll(".lookbook-title");
    slide.forEach(el => el.addEventListener("click", function(){
        slide.forEach(el => {el.classList.remove("select")});
        this.classList.add("select");
        let title = this.children[1].innerHTML;
        let click = lookbookCategorySwiper.clickedIndex;
        console.log("🏂 ~ file: lookbook.js:368 ~ slide.forEach ~ click", click)
        lookbookTitle.forEach(el => el.innerHTML = title)
    })) 
}


function scrollTop() {
    let topBtn = document.querySelector(".lookbook-top-btn");
    topBtn.addEventListener("click", function (){
        window.scroll({ top: 0,left: 0,behavior: 'smooth'});
    })
}


function backBtn() {
    let backBtn = document.querySelectorAll(".back-btn");
    let lookbookWrap = document.querySelector(".lookbook-wrap");
    let lookbookDetailWrap = document.querySelector(".lookbook-detail-wrap");
    backBtn.forEach(el => {
        el.addEventListener("click", function(){
            lookbookWrap.classList.add("open");
            lookbookDetailWrap.classList.remove("open");
        })
    })
}

function lookbookClickEvent() {
    let lookbookWrap = document.querySelector(".lookbook-wrap");
    let lookbookDetailWrap = document.querySelector(".lookbook-detail-wrap");
    let lookbooks = document.querySelectorAll(".lookbook-wrap .lookbook");
    lookbooks.forEach((el,idx) => el.addEventListener("click", function(){
        lookbookWrap.classList.remove("open");
        lookbookDetailWrap.classList.add("open");
        lookbookDetailSwiper.slideTo(idx);
    }))
}





let lookbookCategorySwiper = new Swiper(".lookCategory-swiper" ,{
    // slidesPerView:'auto',
    slidesPerView: 10.4,
    spaceBetween: 10,
    navigation: {
        nextEl: ".look-header-wrap .swiper-button-next",
        prevEl: ".look-header-wrap .swiper-button-prev",
    }
  
})
let lookbookDetailSwiper = new Swiper(".lookbook-detail-swiper" ,{
    slidesPerView:'auto',
    slidesPerView: 1,
    navigation: {
        nextEl: ".lookbook-detail-wrap .swiper-button-next",
        prevEl: ".lookbook-detail-wrap .swiper-button-prev",
    },
    pagination: {
        el: '.lookbook-detail-wrap .swiper-pagination',
        type: 'fraction',
    }
})
let relatedSwiper = new Swiper(".related-product-swiper" ,{
    slidesPerView:'auto',
    slidesPerView: 3.5,
    spaceBetween: 10,
    navigation: {
        nextEl: "#related-wrap .swiper-button-next",
        prevEl: "#related-wrap .swiper-button-prev",
    }
})

</script>