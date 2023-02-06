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
.page__wrap__old {
    width: 100%;
    display: grid;
    grid-template-columns: 2fr 500px;
    column-gap: 10px;
}
.page__wrap table td{
    height:180px;
    padding:10px;
    vertical-align: top;
}
.page__wrap .rd__square{
    margin-right:40px;
}
.page__wrap .btn{
    margin-left: 20px;
}
.page__wrap .temp__btn{
    margin-left: 50px;
}
.page__wrap .action__area{
    display:flex;
    justify-content: space-between;
}
.page__wrap .action__area .left__area{
    display:flex;
    justify-content: center;
}
.page__wrap .action__area .right__area{
    display:flex;
    justify-content: center;
}
.page__wrap .image{
    display:grid;
    grid-template-columns: 50% 50%;
    padding:20px;
}
.page__wrap .image__type{
    display:grid;
    grid-template-columns:100px 1fr;
}
.page__wrap .thumbnail img, .page__wrap .thumbnail video{
    max-height:150px;
}
.page__wrap .contents img, .page__wrap .contents video{
    max-height:220px;
}
.regist__wrap .info{
    display:flex;
    padding:20px;
    margin-top:20px;
    align-items: center;
}
.regist__wrap .info span{
    margin-right:20px;
}
.regist__wrap .info input[type="text"]{
    width:30%;
    max-width:400px;
    border: solid 1px #bfbfbf;
    height:28px;
}
.regist__wrap .info button{
    margin-left:20px;
}
.regist__wrap .table__wrap table{
    width:350px;
    margin-top:40px;
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
<?php
    function getUrlParamter($url, $sch_tag) {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return $query[$sch_tag];
    }
    
    $page_url = $_SERVER['REQUEST_URI'];
    $page_idx = getUrlParamter($page_url, 'page_idx');

    if($page_idx != null){
        $sql = "SELECT 
                    MAX(DISPLAY_NUM) AS MAX 
                FROM 
                    dev.EDITORIAL_THUMB 
                WHERE 
                    PAGE_IDX = ".$page_idx." 
                AND
                    DEL_FLG = FALSE 
        ";
        $db->query($sql);
        $display_num_max = 0;
        foreach($db->fetch() as $data){
            $display_num_max = $data['MAX'];
        }
    }
    else{
        echo '비정상적인 접근입니다.';
    }
    
?>
<div class="content__card url__wrap">
    <input type="hidden" id="page_idx" value="<?=$page_idx?>">
    <input type="hidden" id="display_num_max" value="<?=$display_num_max?>">
    <div class="card__header">  
        <div class="flex justify-between">
            <h3>에디토리얼 정보</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title"><h4>이름</h4></div>
                <div class="content__row">
                    <span id="page_title"></span>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title"><h4>적용몰</h4></div>
                <div class="content__row">
                    <span id="store_country"></span>
                </div>
            </div>
        </div>
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title"><h4>URL</h4></div>
                <div class="content__row">
                    <span id="page_url"></span>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title"><h4>비고</h4></div>
                <div class="content__row">
                    <span id="page_memo"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content__card regist__wrap">
    <div class="card__header">  
        <div class="flex justify-between">
            <h3>에디토리얼 등록</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap">
            <div class="content__title">
                서버경로
            </div>
            <div class="content__row">
                <input type="text" name="ftp_dir"></input>
                <button class="btn image_check_btn" chk-flg="false" onclick="checkFtpImage()">체크</button>
                <button class="btn" onclick="addEditorialImage()">등록</button>
            </div>
        </div>
        <div class="table__wrap editorial__image__cnt" >
            
        </div>
    </div>
</div>
<div class="content__card page__wrap">
    <div class="card__header">  
        <div class="flex justify-between">
            <h3>에디토리얼 목록</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="table__wrap">
            <table id="editorial_result_table">
                <tr>
                    <td>
                        <div class="action__area">
                            <div class="left__area">
                                <label class="rd__square">
                                    <input type="radio" name="size_type_1" value="web" checked="checked">
                                    <div><div></div></div>
                                    <span>웹 버전</span>
                                </label>
                                <label class="rd__square">
                                    <input type="radio" name="size_type_1" value="mobile">
                                    <div><div></div></div>
                                    <span>모바일 버전</span>
                                </label>
                            </div>
                            <div class="right__area">
                                <div class="btn" onclick="">            
                                    <i class="xi-angle-up"></i>            
                                    <span class="tooltip top">위로</span>       
                                </div>
                                <div class="btn" onclick="">            
                                    <i class="xi-angle-down"></i>            
                                    <span class="tooltip top">위로</span>       
                                </div>
                                <button class="btn">삭제</button>
                            </div>
                        </div>
                        <div class="image">
                            <div class="image__type thumbnail" >
                                <div>
                                    썸네일    
                                </div>
                                <div>
                                    <img src="/images/display/editorial/sample0.jpeg" alt="">
                                </div>
                            </div>
                            <div class="image__type contents">
                                <div>
                                    컨텐츠
                                </div>
                                <div>
                                    <video src="https://player.vimeo.com/progressive_redirect/playback/727657869/rendition/1080p/file.mp4?loc=external&amp;signature=cb780646bec5d87513b30fbaa578a9522461b3463a6975285792f78a0c0c6bf2" loop="" autoplay="" muted="" playsinline=""></video>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="action__area">
                            <div class="left__area">
                                <label class="rd__square">
                                    <input type="radio" name="size_type_2" value="web" checked="checked">
                                    <div><div></div></div>
                                    <span>웹 버전</span>
                                </label>
                                <label class="rd__square">
                                    <input type="radio" name="size_type_2" value="mobile">
                                    <div><div></div></div>
                                    <span>모바일 버전</span>
                                </label>
                            </div>
                            <div class="right__area">
                                <div class="btn" onclick="">            
                                    <i class="xi-angle-up"></i>            
                                    <span class="tooltip top">위로</span>       
                                </div>
                                <div class="btn" onclick="">            
                                    <i class="xi-angle-down"></i>            
                                    <span class="tooltip top">위로</span>       
                                </div>
                                <button class="btn">삭제</button>
                            </div>
                        </div>
                        <div class="image">
                            <div class="image__type thumbnail" >
                                <div>
                                    썸네일    
                                </div>
                                <div>
                                    <img src="http://116.124.128.246:81/images/display/editorial/sample1.jpeg" alt="">
                                </div>
                            </div>
                            <div class="image__type contents">
                                <div>
                                    컨텐츠
                                </div>
                                <div>
                                    <video src="https://player.vimeo.com/progressive_redirect/playback/727657869/rendition/1080p/file.mp4?loc=external&amp;signature=cb780646bec5d87513b30fbaa578a9522461b3463a6975285792f78a0c0c6bf2" loop="" autoplay="" muted="" playsinline=""></video>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        getEditorialImageList();
    })
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

    $('input[name="ftp_dir"]').keyup(function(){
        $('.image_check_btn').attr('chk-flg', 'false');
    })

function getEditorialImageList(){
    var page_idx = $('#page_idx').val();
    $('#editorial_result_table').html('');
    $.ajax({
		type: "post",
		data: {
                'page_idx' : page_idx,
                'editorial_type' : 'W'
            },
		dataType: "json",
		url: config.api + "display/posting/editorial/list/get",
		error: function(d) {
			alert(d.msg);
		},
		success: function(d) {
            if(d.code == 200){
                var data = d.data;
                if(data != null){
                    $('#editorial_result_table').html('');
                    var info = data.info[0];
                    var store_country = '';
                    switch(info.country){
                        case 'KR':
                            store_country = '한국몰';
                            break;
                        case 'EN':
                            store_country = '영문몰';
                            break;
                        case 'CN':
                            store_country = '중국몰';
                            break;
                    }
                    $('#page_title').text(info.page_title);
                    $('#store_country').text(store_country);
                    $('#page_url').text(info.page_url);
                    $('#page_memo').text(info.page_memo);

                    data.list.forEach(function (row){
                        var thumb_type_tag = ``;
                        if(row.thumb_type == 'IMG'){
                            thumb_type_tag = `<img src="${row.thumb_location}" alt="">`;
                        }
                        else if(row.thumb_type == 'VID'){
                            thumb_type_tag = `<video src="${row.thumb_location}" loop="" autoplay="" muted="" playsinline=""></video>`;
                        }

                        var contents_type_tag = ``;
                        if(row.contents_type == 'IMG'){
                            contents_type_tag = `<img src="${row.contents_location}" alt="">`;
                        }
                        else if(row.contents_type == 'VID'){
                            contents_type_tag = `<video src="${row.contents_location}" loop="" autoplay="" muted="" playsinline=""></video>`;
                        }
                        
                        var strDiv = '';
                        strDiv = `
                <tr>
                    <td>
                        <div class="action__area">
                            <div class="left__area">
                                <label class="rd__square">
                                    <input type="radio" name="size_type_${row.display_num}" display_num="${row.display_num}" value="W" checked="checked" onchange="convertSizeType(this)">
                                    <div><div></div></div>
                                    <span>웹 버전</span>
                                </label>
                                <label class="rd__square">
                                    <input type="radio" name="size_type_${row.display_num}" display_num="${row.display_num}" value="M" onchange="convertSizeType(this)">
                                    <div><div></div></div>
                                    <span>모바일 버전</span>
                                </label>
                            </div>
                            <div class="right__area">
                                <div class="btn" onclick="displayNumCheck(this)" display_num="${row.display_num}"  action_type="up">            
                                    <i class="xi-angle-up"></i>            
                                    <span class="tooltip top">위로</span>       
                                </div>
                                <div class="btn" onclick="displayNumCheck(this)" display_num="${row.display_num}"  action_type="down">            
                                    <i class="xi-angle-down"></i>            
                                    <span class="tooltip top">아래로</span>       
                                </div>
                                <button class="btn" display_num="${row.display_num}" thumb_idx="${row.thumb_idx}" contents_idx="${row.contents_idx}" onclick="deleteEditorialImage(this)">삭제</button>
                            </div>
                        </div>
                        <div class="image">
                            <div class="image__type thumbnail" >
                                <div>
                                    썸네일    
                                </div>
                                <div>
                                    ${thumb_type_tag}
                                </div>
                            </div>
                            <div class="image__type contents">
                                <div>
                                    컨텐츠
                                </div>
                                <div>
                                    ${contents_type_tag}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                        `;
                        $('#editorial_result_table').append(strDiv);
                    })
                }
            }
            else{
                alert(d.msg); 
            }
		}
	});
}

function checkFtpImage(){
    var ftp_dir = $('input[name="ftp_dir"]').val();

    if(ftp_dir == null || ftp_dir.length == 0){
        alert('서버경로를 기입해주세요');
        return false;
    }

    $('.editorial__image__cnt').html('');
    $.ajax({
		type: "post",
		data: {'ftp_dir' : ftp_dir},
		dataType: "json",
		url: config.api + "display/posting/editorial/check",
		error: function() {
			alert('FTP 서버 내 에디토리얼 이미지 체크작업이 실패했습니다.');
		},
		success: function(d) {
            if(d.code == 200){
                var data = d.data;
                if(data != null){
                    var strDiv = '';
                    strDiv = `
                        <table>
                            <colgroup>
                                <col width="30%">
                                <col width="30%">
                                <col width="40%">
                            </colgroup>
                            <tr>
                                <td rowspan="2">
                                    <span>썸네일 수량</span>
                                </td>
                                <td>
                                    <span>웹</span>
                                </td>
                                <td>
                                    <span>${data.thmb_web_cnt}개</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>모바일</span>
                                </td>
                                <td>
                                    <span>${data.thmb_mobile_cnt}개</span>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <span>컨텐츠 수량</span>
                                </td>
                                <td>
                                    <span>웹</span>
                                </td>
                                <td>
                                    <span>${data.cnts_web_cnt}개</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>모바일</span>
                                </td>
                                <td>
                                    <span>${data.cnts_mobile_cnt}개</span>
                                </td>
                            </tr>
                        </table>
                    `;
                    $('.editorial__image__cnt').append(strDiv);
                    $('.image_check_btn').attr('chk-flg', 'true');
                }
            }
            else{
                alert(d.msg); 
            }
		}
	});
}
function addEditorialImage(){
    confirm('이전의 사진은 모두 삭제 됩니다. 새로 등록하시겠습니까?', function (){
        var page_idx = $('#page_idx').val();
        var ftp_dir = $('input[name="ftp_dir"]').val();
        var chk_flg = $('.image_check_btn').attr('chk-flg');

        if(chk_flg == 'false'){
            alert('경로체크를 먼저 진행해주세요');
            return false;
        }
        $.ajax({
            type: "post",
            data: {'ftp_dir' : ftp_dir, 'page_idx': page_idx},
            dataType: "json",
            url: config.api + "display/posting/editorial/add",
            error: function() {
                alert('FTP 서버 내 에디토리얼 이미지 체크작업이 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200){
                    var data = d.data;
                    if(data != null){
                        alert(d.msg);
                    }
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}

function displayNumCheck(obj) {
	var display_num_max = $('.url__wrap').find('#display_num_max').val();
	var page_idx = $('.url__wrap').find('#page_idx').val();
    var action_type = $(obj).attr('action_type');
	var num = $(obj).attr('display_num');
	

	if (action_type == "up") {
		if (num == 1) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('up',num,page_idx);
		}
	} else if (action_type == "down") {
		if (num == display_num_max) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('down',num,page_idx);
		}
	}
}

function updateDisplayNum(action, num, idx){
	var preorder_idx = idx;

	$.ajax({
		url: config.api + "display/posting/editorial/put",
		type: "post",
		data: {
			'recent_idx': idx,
			'recent_num': num,
			'action_type': action
		},
		dataType: "json",
		error: function() {
			alert('에디토리얼 순서번경 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
            getEditorialImageList();
		}
	})
}
function deleteEditorialImage(obj){
    var page_idx = $('#page_idx').val();
    var display_num = $(obj).attr('display_num');
    var thumb_idx = $(obj).attr('thumb_idx');
    var contents_idx = $(obj).attr('contents_idx');


    $.ajax({
		url: config.api + "display/posting/editorial/delete",
		type: "post",
		data: {
			'page_idx': page_idx,
			'display_num': display_num,
            'thumb_idx': thumb_idx,
			'contents_idx': contents_idx
		},
		dataType: "json",
		error: function() {
			alert('에디토리얼 썸네일/컨텐츠 삭제 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
            if(d.data.max_display_num > 0){
                $('#display_num_max').val(d.data.max_display_num);
            }
            getEditorialImageList();
		}
	})
}
function convertSizeType(obj){
    var page_idx = $('#page_idx').val();
    var display_num = $(obj).attr('display_num');
    var size_type = $(obj).val();

    $.ajax({
		url: config.api + "display/posting/editorial/get",
		type: "post",
		data: {
			'page_idx': page_idx,
			'display_num': display_num,
			'size_type': size_type
		},
		dataType: "json",
		error: function() {
			alert('에디토리얼 썸네일/컨텐츠 이미지 불러오기 중 오류가 발생했습니다.');
		},
		success: function(d) {
            if(d.data != null){
                var data = d.data[0];
                $(obj).parents('td').find('.image__type.thumbnail img').attr('src',data.thumb_location);
                $(obj).parents('td').find('.image__type.thumbnail video').attr('src',data.thumb_location);
                $(obj).parents('td').find('.image__type.contents img').attr('src',data.contents_location);
                $(obj).parents('td').find('.image__type.contents video').attr('src',data.contents_location);
            }
            else{
                alert('선택한 사이즈의 사진정보가 없습니다.');
            }
            
		}
	})
}
</script>