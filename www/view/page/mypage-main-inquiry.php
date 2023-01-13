<style>
.inquiry__wrap{
    margin-top:40px;
    width:100%;
}
.inquiry__tab__btn__container{
    margin: 0 auto;
    width:212px;
    display:grid;
    place-items: center;
    grid-template-columns: 62px 80px 70px
}
.inquiry__tab__wrap{
    margin-top:50px;
}
.inquiry__faq__wrap{
    width:470px;
    margin: 0 auto;
}
.inquiry__faq__detail__wrap{
    width:950px;
    margin: 0 auto;
}
.inquiry__faq__detail__container{
    margin: 0 auto;
    width:950px;
    display:grid;
    grid-template-columns: 110px 840px
}
.inquiry__list__wrap{
    width:710px;
    margin: 0 auto;
}
.search{
    position:relative;
    width:470px;
}
.search__small{
    position:relative;
    width:110px;
}
.search input{
    width:100%;
    height:20px;
    font-size: 13px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #343434;
    border:none;
    border-bottom:1px solid #dcdcdc;
    margin:0;
    padding-left:20px;
    padding-bottom:5px;
}
.search__small input{
    width:100%;
    height:20px;
    font-size: 13px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #343434;
    border:none;
    border-bottom:1px solid #dcdcdc;
    margin:0;
    padding-left:20px;
    padding-bottom:5px;
}
.search__icon__img{
    position:absolute;
    width:14px;
    height:14px;
    left:0px;
    top:0px;
    margin:0;
}
.category{
    margin-top:30px;
}
.category__small{
    margin-top:20px;
}
.faq__category__btn{
    cursor:pointer;
    width:100%;
    height:30px;
    background-color: white;
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color:#343434;
    font-family:var(--ft-no-fu);
    text-align: center;
    line-height:30px;
    border-radius: 1px;
    border:1px solid #dcdcdc;
}
.faq__category__btn.click__btn{
    background-color: #dcdcdc;
}
.child__category__btn{
    cursor:pointer;
    width:100%;
    height:30px;
    background-color: white;
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color:#999;
    font-family:var(--ft-no-fu);
    text-align: left;
    line-height:30px;
    padding-left:10px;
    border-radius: 1px;
    border-top:1px solid #dcdcdc;
}
.child__category__btn.click__btn{
    color:#343434;
}
.btn__row{
    margin-bottom:10px;
}
.category__title span{
    color:#999!important;
}
.inquiry__tab__wrap .footer{
    margin-bottom:100px;
}
.inquiry__action__wrap{
    width:710px;
    margin: 0 auto;
}

.inquiry__info{
    margin-bottom:20px;
}
.inquiry__info .description{
    margin-top:20px;
}
.inquiry__info.inquiry__title select{
    width:110px;
    margin-right:10px;
}
.inquiry__info.inquiry__title input{
    width:587px!important;
}
.inquiry__info.inquiry__email input{
    width:230px;
    margin-right:10px;
}
.inquiry__info.inquiry__email select{
    width:225px;
}
.inquiry__info.inquiry__request__flg .description{
    margin-bottom:12px;
}
.inquiry__info.inquiry__contents textarea{
    margin-top:0px;
    height:250px;
    resize: none;
}
.inquiry__photo__container{
    width:310px;
    display:grid;
    place-items: left;
    grid-template-columns: 63px 63px 63px 63px 53px;
    margin-top:10px;
}
.inquiry__photo__item{
    width:53px;
    height:53px;
}
.inquiry__action__wrap button{
    margin-bottom:10px;
}
.black__full__width__btn.inquiry__btn{
    width:110px;
    margin-left: 600px;
}
</style>
<div class="inquiry__wrap">
    <div class="inquiry__tab__btn__container">
        <div class="tab__btn__item" form-id="inquiry__faq__wrap">
            <img src="/images/mypage/tab/select_faq_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="inquiry__action__wrap">
            <img src="/images/mypage/tab/default_inquiry_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="inquiry__list__wrap">
            <img src="/images/mypage/tab/default_inquiry_list_btn.svg">
        </div>
    </div>
    <div class="inquiry__tab__wrap">
        <div class="inquiry__tab inquiry__faq__wrap">
            <div class="search">
                <input class="search__keyword" type="text">
                <img class="search__icon__img" src="/images/mypage/mypage_search_icon.svg" onclick="searchFaq(this)">
            </div>
            <div class="category">
                <div class="btn__row">
                    <div class="faq__category__btn">회원</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">주문 / 결제</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">제품</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">배송</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">교환 / 반품</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">환불 / 품절</div>
                </div>
                <div class="btn__row">
                    <div class="faq__category__btn">A/S</div>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        <div class="inquiry__tab inquiry__faq__detail__wrap">
            <div class="inquiry__faq__detail__container">
                <div class="inquiry__faq__detail__area">
                    <div class="search__small">
                        <input class="search__keyword" type="text">
                        <img class="search__icon__img" src="/images/mypage/mypage_search_icon.svg" onclick="searchFaq(this)">
                    </div>
                    <div class="category__small">
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">회원</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">주문 / 결제</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">제품</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">배송</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">교환 / 반품</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">환불 / 품절</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn">A/S</div>
                            </div>
                            <div class="children__category">
                                <div class="child__category__btn click__btn">회원 가입 및 이용</div>
                                <div class="child__category__btn">국가 별 로그인</div>
                                <div class="child__category__btn">ADER 정보</div>
                                <div class="child__category__btn">본인인증</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inquiry__faq__detail__area">
                    <div class="toggle__list">
                        <div class="toggle__list__tab 02">
                            <div class="toggle__item">
                                <div class="category__title"><span>가입 방법 및 혜택</span></div>
                                <div class="question">
                                    <span>회원 가입은 어떻게 하나요?</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                                </div>
                                <div class="request" style="display:none"><span>공식 홈페이지의 오른쪽 위 로그인 메뉴 방문 이후 화면 중앙에 있는 회원가입 버튼을 통해 가입할 수 있습니다.</span></div>
                            </div>
                            <div class="toggle__item">
                                <div class="category__title"><span>마이페이지 이용</span></div>
                                <div class="question">
                                    <span>마이페이지에서는 무엇을 확인할 수 있나요?</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                                </div>
                                <div class="request" style="display:none"><span>답변 미정</span></div>
                            </div>
                            <div class="toggle__item">
                                <div class="category__title"><span>등급 체계 및 혜택</span></div>
                                <div class="question">
                                    <span>회원 탈퇴를 하고 싶어요.</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                                </div>
                                <div class="request" style="display:none"><span>답변 미정</span></div>
                            </div>
                            <div class="toggle__item">
                                <div class="category__title"><span>간편 로그인</span></div>
                                <div class="question">
                                    <span>소셜 계정을 통한 로그인이 가능한가요?</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                                </div>
                                <div class="request" style="display:none"><span>답변 미정</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        <div class="inquiry__tab inquiry__action__wrap">
            <form id="frm-inquiry">
                <div class="inquiry__info inquiry__title">
                    <p class="description">제목</p>
                    <div>
                        <select class="category__select">
                            <option>회원</option>
                            <option>주문 / 결제</option>
                            <option>제품</option>
                            <option>배송</option>
                            <option>교환 / 반품</option>
                            <option>환불 / 품절</option>
                            <option>A/S</option>
                        </select>
                        <input class="title__input">
                    </div>
                </div>
                <div class="inquiry__info inquiry__email">
                    <p class="description">이메일</p>
                    <div>
                        <input>
                        <input>
                        <select>
                            <option></option>
                            <option></option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="inquiry__info inquiry__request__flg">
                    <p class="description">답변여부를 메일로 받으시겠습니까?</p>
                    <div>
                        <label>
                            <input type="radio" name="request_flg" value="TRUE" checked />
                            <span>예</span>
                        </label>
                        <label>
                            <input type="radio" name="request_flg" value="FALSE" />
                            <span>아니오</span>
                        </label>
                    </div>
                </div>
                <div class="inquiry__info inquiry__contents">
                    <textarea></textarea>
                </div>
                <div class="inquiry__info inquiry__photo">
                    <p class="description">사진첨부</p>
                    <div class="inquiry__photo__container">
                        <div class="inquiry__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                        <div class="inquiry__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                        <div class="inquiry__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                        <div class="inquiry__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                        <div class="inquiry__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                    </div>
                    <p class="description">
                        ·&nbsp;상품 불량 및 오배송의 경우, 해당 제품 사진을 등록 부탁드립니다.<br>
                        ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.
                    </p>
                </div>
                <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
                <button class="black__full__width__btn">등록</button>
                <button class="white__full__width__btn">취소</button>
            </form>
            <div class="footer"></div>
        </div>
        <div class="inquiry__tab inquiry__list__wrap">
            <div class="title">
                <p>
                    나의 문의내역
                </p>
            </div>
            <div class="description">
                <p>
                    ·&nbsp;C/S 운영시간 Mon-Fri AM10:00 - PM5:00
                </p>
                <p>
                    ·&nbsp;매월 15일 (공휴일인 경우 직전 영업일)은 당사의 CS 및 배송 시스템 점검일입니다.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;보다 나은 서비스를 제공하기 위하여 위 점검일에는 CS 및 배송 업무가 중단됩니다.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;고객 여러분들의 양해를 부탁드립니다. 오프라인 스토어는 정상 운영됩니다.
                </p>
                <p>
                    ·&nbsp;답변이 완료된 문의내역은 수정이 불가능합니다.
                </p>
            </div>
            <button class="black__full__width__btn inquiry__btn">문의하기</button>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
    $('.inquiry__tab').hide();
    $('.inquiry__faq__wrap').show();

    $.ajax({
        type: "post",
        data: {'country': 'KR'},
        dataType: "json",
        url: "http://116.124.128.246:80/_api/mypage/faq/category/get",
        error: function(d) {
        },
        success: function(d) {
            if(d.data != null && d.data.length > 0 ){
                $('.category').html('');
                $('.category__small').html('');
                var data = d.data;
                var data_len = data.length;

                for(var i = 0; i < data_len; i++){
                    var cateDiv = `
                        <div class="btn__row">
                            <div class="faq__category__btn" category-no="${data[i].no}" onclick="cateBtnAction(this)">${data[i].title}</div>
                        </div>
                    `;
                    $('.category').append(cateDiv);

                    var smallCateDiv = `
                        <div class="btn__row">
                            <div class="parents__category">
                                <div class="faq__category__btn" category-no="${data[i].no}" onclick="smallCateBtnAction(this)">${data[i].title}</div>
                            </div>
                            <div class="children__category">
                    `;
                    if(data[i].children != null && data[i].children.length > 0 ){
                        var child_data = data[i].children;
                        var child_data_len = child_data.length;

                        for(var j = 0; j < child_data_len; j++){
                            var cateChildDiv = `<div class="child__category__btn" category-no="${child_data[j].no}" onclick="childCateBtnAction(this)">${child_data[j].title}</div>`;
                            smallCateDiv += cateChildDiv;
                        }
                    }
                    smallCateDiv += `
                            </div>
                        </div>
                    `;
                    $('.category__small').append(smallCateDiv);
                }
            }
            $('.children__category').hide();
        }
    });
})
function cateBtnAction(obj){
    $('.inquiry__tab').hide();
    $('.inquiry__faq__detail__wrap').show();
    var cate_no = $(obj).attr('category-no');

    $('.category__small').find('[category-no=' + cate_no + ']').click();
}
function smallCateBtnAction(obj){
    if($(obj).hasClass('click__btn')){
        $('.category__small').find('.children__category').hide();
        $(obj).removeClass('click__btn');
    }
    else{
        var cate_no = $(obj).attr('category-no');
        $('.category__small').find('.children__category').hide();
        $(obj).parent().parent().find('.children__category').show();

        $('.category__small').find('.faq__category__btn').removeClass('click__btn');
        $(obj).addClass('click__btn');

        printFaqList(cate_no);
    }
    $('.search__keyword').val('');
}
function childCateBtnAction(obj){
    var cate_no = $(obj).attr('category-no');
    
    $(obj).parent().find('.child__category__btn').removeClass('click__btn');
    $(obj).addClass('click__btn');

    printFaqList(cate_no);
    $('.search__keyword').val('');
} 
function printFaqList(cate_no){
    $.ajax({
        type: "post",
        data: {'category_no': cate_no},
        dataType: "json",
        url: "http://116.124.128.246:80/_api/mypage/faq/get",
        error: function(d) {
        },
        success: function(d) {
            if(d.data != null && d.data.length > 0){
                var data = d.data
                $('.toggle__list__tab.02').html('');
                for(var i = 0; i < data.length; i++){
                    strDiv = `
                        <div class="toggle__item">
                            <div class="category__title"><span>${data[i].title}</span></div>
                            <div class="question" style="cursor:pointer;" onclick="faqQuestionClick(this)">
                                <span>${data[i].question}</span>
                                <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                            </div>
                            <div class="request" style="display:none">${data[i].answer}</div>
                        </div>
                    `;
                    $('.toggle__list__tab.02').append(strDiv);
                }
            }
        }
    });
}
function faqQuestionClick(obj){
    if($(obj).next().css('display') == 'none'){
        console.log($(this).find('img.top__down__icon'));
        $(obj).find('img.down__up__icon').attr('src','/images/mypage/mypage_up_tab_btn.svg');
    }
    else{
        $(obj).find('img.down__up__icon').attr('src','/images/mypage/mypage_down_tab_btn.svg');
    }
    $(obj).next().toggle();
}
function searchFaq(obj){
    $('.inquiry__tab').hide();
    $('.inquiry__faq__detail__wrap').show();

    $('.category__small').find('.children__category').hide();
    $('.category__small .click__btn').removeClass('click__btn');

    var keyword = $(obj).parent().find('input').eq(0).val();
    $('.search__keyword').val(keyword);

    $.ajax({
        type: "post",
        data: {'keyword': keyword},
        dataType: "json",
        url: "http://116.124.128.246:80/_api/mypage/faq/get",
        error: function(d) {
        },
        success: function(d) {
            if(d.data != null && d.data.length > 0){
                var data = d.data
                $('.toggle__list__tab.02').html('');
                for(var i = 0; i < data.length; i++){
                    strDiv = `
                        <div class="toggle__item">
                            <div class="category__title"><span>${data[i].title}</span></div>
                            <div class="question" style="cursor:pointer;" onclick="faqQuestionClick(this)">
                                <span>${data[i].question}</span>
                                <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                            </div>
                            <div class="request" style="display:none">${data[i].answer}</div>
                        </div>
                    `;
                    $('.toggle__list__tab.02').append(strDiv);
                }
            }
        }
    });
}
</script>