<!-- START RESPONSE CARD -->
<style>


input::placeholder {
    color: #707070;
    text-align: center;
}

textarea {
    padding: 10px;
    border: 1px solid #000;
}

textarea::placeholder {
    color: #707070;
}

textarea:focus {
    outline: none;
}

.page__wrap {
    width: 100%;
    display: grid;
    grid-template-columns: 2fr 500px;
    column-gap: 10px;
}

.edit__wrap {
    border: 1px dashed #000;
    padding: 10px;
}

.edit__contnet__wrap {
    display: grid;
    row-gap: 20px;
}

.edit__contnet__wrap > div {
    text-align: center;
}

.edit__img {
    display: contents;
}

.edit__img img {
    width: 100%;
}

.preview__wrap {
    border: 1px dashed #000;
    padding: 10px;
}

.edit__input__wrap {
    display: grid;
    justify-content: center;
}

.edit__intpu__btn.preview {
    width: 200px;
}

.edit__title__wrap {
    margin: 10px;
    padding: 10px;
    align-items: center;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #000;

}

.edit__input__wrap input {
    padding: 5px;
    border: 1px #adadad solid;
    cursor: pointer;
    overflow: visible;
    -ms-user-select: none;
    -moz-user-select: -moz-none;
    user-select: none;
    color: #adadad;
}

.edit__input__wrap input:focus {
    outline: none;
}

.edit__textarea__wrap {
    display: grid;
}

.edit__btn {
    text-align: center;
    cursor: pointer;
    width: 100px;
    height: 30px;
    background-color: #000;
    line-height: 2;
    color: #fff;
}

.edit__script {
    padding-right: 2px;
    display: grid;
}

.edit__product__wrap {
    margin: 10px 0 20px 0;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    column-gap: 10px;
    row-gap: 10px;
}

.edit__product__wrap.preview {
    margin: 20px 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.description__text {
    text-align: start;
    margin-bottom: 5px;
    font-weight: 600;
}

.product__img {
    position: relative;
}

.product__img img {
    width: 100%;
    height: 400px;
}

.product__box {
    border: 1px solid #f0f0f0;
    grid-template-rows: 10fr 1fr 1fr;
}

.product__title {
    padding: 5px;
}

.product__content {
    display: flex;
    padding: 5px;
    justify-content: space-between;
}

.flex__wrap {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.edit__intpu__btn {
    display: grid;
    justify-content: center;
    text-align: center;
    width: 100%;
    cursor: pointer;
    height: 30px;
    line-height: 2;
    border-radius: 4px;
    border: solid 1px #000;
    color: #000;
}

/*--------------- 저장버튼 -------------------------*/
.apply__btn__wrap {
    display: flex;
    position: sticky;
    top: 0;
    justify-content: center;
    margin: 20px 0;
    gap: 20px;
}

.temp__apply__btn {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 270px;
    border-radius: 2px;
    color: #fff;
    padding: 10px;
    background-color: rgb(135, 135, 135);
    height: 36px;
}

.apply__btn {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 270px;
    border-radius: 2px;
    color: #fff;
    padding: 10px;
    background-color: #140f82;
    height: 36px;
}

.reset__btn {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 270px;
    border-radius: 2px;
    padding: 10px;
    border: solid 1px #707070;
    height: 36px;
}

.edit__input__box {
    display: grid;
    justify-content: center;
    row-gap: 10px;
    margin: 20px 0;
}

.edit__input {
    display: flex;
    gap: 20px;

}

.temp__btn {
    text-align: center;
    cursor: pointer;
    height: 30px;
    padding: 0 10px;
    border: 1px solid #000;
    border-radius: 5px;
    line-height: 2;
    color: #000;
}

.preview__call__btn {
    text-align: center;
    cursor: pointer;
    height: 30px;
    padding: 0 10px;
    border: 1px solid #000;
    border-radius: 5px;
    line-height: 2;
    color: #000;
}

.product__call__btn {
    text-align: center;
    cursor: pointer;
    width: 130px;
    height: 30px;
    padding: 0 10px;
    border: 1px solid #000;
    border-radius: 5px;
    line-height: 2;
    color: #000;
}

.remove__btn {
    position: absolute;
    text-align: right;
    top: 15px;
    right: 15px;
    cursor: pointer;
    -moz-transform: scale(0);
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
}

.product__img:hover>.remove__btn {
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

.collaboration__wrap {
    grid-template-rows: 400px;
    align-items: center;
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
}

.collaboration__wrap.preview {
    grid-template-rows: 200px;
    align-items: center;
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
}

.next__colabo__img {
    width: 100%;
}

.url__wrap {
    display: grid;
    border: 1px dashed #000;
    grid-template-columns: 1fr 1fr;
    row-gap: 10px;
    margin: 20px 0px;
    padding: 10px;
}

/* 파일 */
input[type=file]::file-selector-button {
  width: 100px;
  height: 30px;
  background: #fff;
  border: 1px solid #4d4d4d;
  border-radius: 10px;
  cursor: pointer;
  margin: 0 10px;
}
input[type=file]::file-selector-button:hover {
  background: #4d4d4d;
  color: #fff;
}
.img__row{
    display: flex;
}
.removeImg{
    color: #fff;
    border: 1px solid #000;
    border-radius: 4px;
    text-align: center;
    width: 30px;
    height: 30px;
}
.img__wrap{
    list-style: none;
    padding-left:0px;
}
.img__wrap li{
    display: flex;
    padding: 10px 0;
}



/* 스와이퍼 */
    .swiper {
        width: 100%;
        height: 100%;
        padding: 20px 0;
    }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .thumb__swiper .swiper-slide img {
    display: block;
    width: 100%;
    height: 100px;
    object-fit: cover;
  }
  .main__swiper .swiper-slide img {
    display: block;
    width: 100%;
    height: 300px;
    object-fit: cover;
  }
  .thumb__swiper .swiper-slide video {
    display: block;
    width: 100%;
    height: 100px;
    object-fit: cover;
  }
  .main__swiper .swiper-slide video {
    display: block;
    width: 100%;
    height: 300px;
    object-fit: cover;
  }
  .swiper-slide-thumb-active img{
    position: relative;
    transform: translateY(-20px);
  }
</style>
<div class="content__card">
    <div class="url__wrap">
        <div>이름 :<span>2022 S/S ADER x BIRKENSTOCK 'Too passionate to stop'</span></div>
        <div>적용몰 :<span>한국몰</span></div>
        <div>URL :<span>https://www.adererror.com/editorial/index.html?cate_no=73</span></div>
        <div>비고 :<span></span></div>
    </div>
    <div class="page__wrap">
        <div class="edit__wrap">
            <div class="edit__title__wrap">
                <div>
                    <h3 class="edit__title">editorial Page</h3>
                </div>
                <div style="display: flex;gap: 10px;">
                    <div class="temp__btn">임시저장 불러오기</div>
                    <div class="temp__btn appendImg">이미지 추가</div>
                    <div class="preview__call__btn">프리뷰</div>
                    <button class="add-slide">Add new slide</button>
                </div>
            </div>
            <div class="edit__contnet__wrap">
                <form name="imgForm" action="/ex/ex2.html">
                    <ul class="img__wrap">
                        <li>
                            <label>video<input type="file" name="" value=""></label>
                        </li>
                        <li>
                            <label>image<input type="file" name="img[]" value=""></label>
                            <div class="removeImg" onclick="removeImg()" data-idx='0'><img src="/images/minus.svg" alt=""></div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <div class="preview__wrap">
            <div class="edit__title__wrap">
                <h3 class="edit__title">preview Page</h3>
            </div>
            <div class="slider-wrap">
                <!-- 메인 사진 슬라이더 -->
                <div class="swiper thumb__swiper">
                    <div class="swiper-wrapper">
                    </div>
                </div>
                <div class="swiper main__swiper">
                    <div class="swiper-wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 이미지 input append
    const appendImg = () => {
        let appendImgBtn = document.querySelector('.appendImg');
        let imgWrap = document.querySelector('.img__wrap');
        let idx = 0;

        appendImgBtn.addEventListener('click', () => {
            let li = document.createElement('li');
            let imgDiv = `
                    <label>image<input type="file" name="img[]" value=""></label>
                    <div class="removeImg" onclick="removeImg(event)" data-idx=${idx}><img src="/images/minus.svg" alt=""></div>
                `
            li.innerHTML = imgDiv;
            imgWrap.appendChild(li);
            idx++;
        });
    }
    // 이미지 input remove
    const removeImg = () => {
        let imgWrap = document.querySelector('.img__wrap');
        let el = event.target;
        let remove = el.parentNode;
        imgWrap.removeChild(remove);
    }
    //썸네일 스와이프  
    let thumbSwiper = new Swiper(".thumb__swiper", {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slideToClickedSlide: true,
        slidesPerView: 3,
        spaceBetween: 30,
        watchSlidesProgress: true,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
    });
    //메인 스와이프
    let mainSwiper = new Swiper(".main__swiper", {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
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
    //슬아이드 이미지 동적 추가 
    let imgName = 1; // 
    function addSlide(imgName) {
        let addslide = document.querySelector('.add-slide');
        addslide.addEventListener('click', () => {
            thumbSwiper.appendSlide(`
                <div class="swiper-slide">
                    <img src="/images/display/editorial/sample${imgName}.jpeg" alt="">
                </div>
            `)
            mainSwiper.appendSlide(`
                <div class="swiper-slide">
                    <img src="/images/display/editorial/sample${imgName}.jpeg" alt="">
                </div>
            `)
        });
    }
    // 문서 로드 후 파일질라 이미지 명기준으로 썸네일, 메인 스와이퍼 그려주는 함수
    function imgDataCall(){
        let length = 7; //등록한 사진의 길이로 변경
        let htmlArr = [];
        let video = true;
        if(video){
            htmlArr.push(`
                <div class="swiper-slide">
                    <video src="https://player.vimeo.com/progressive_redirect/playback/727657869/rendition/1080p/file.mp4?loc=external&amp;signature=cb780646bec5d87513b30fbaa578a9522461b3463a6975285792f78a0c0c6bf2" loop="" autoplay="" muted="" playsinline=""></video>
                </div>
            `);
        }

        for (let imgNum = 0; imgNum < length; imgNum++) {
            htmlArr.push(`
                <div class="swiper-slide">
                    <img src="/images/display/editorial/sample${imgNum}.jpeg" alt="">
                </div>
            `);
        }
        mainSwiper.appendSlide(htmlArr);
        thumbSwiper.appendSlide(htmlArr);
        mainSwiper.update();  
        thumbSwiper.update();  
    }

    document.addEventListener("DOMContentLoaded", function () {
        imgDataCall();
        appendImg();
        addSlide(imgName);
    });
</script>