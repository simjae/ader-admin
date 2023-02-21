<style>
    @media (max-width: 1024px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }
    }

    @media (min-width: 600px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width: 470px;
            margin: 0 auto;
            margin-top: 40px;
        }
    }

    @media (min-width: 1024px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width: 950px;
            margin: 0 auto;
            margin-top: 50px;
        }
    }
</style>

<div class="inquiry__tab__wrap">
    <div class="inquiry__tab inquiry__faq__wrap">
        <div class="search">
            <input class="search__keyword" type="text" placeholder="무엇을 도와드릴까요?">
            <img class="search__icon__img" src="/images/mypage/mypage_search_icon.svg" onclick="searchAction(this)">
        </div>
        <div class="category"></div>
        <div class="footer"></div>
    </div>
    <div class="inquiry__tab inquiry__faq__detail__wrap">
        <div class="inquiry__faq__detail__container">
            <div class="inquiry__faq__detail__area">
                <div class="search__small">
                    <input class="search__keyword" type="text">
                    <img class="search__icon__img" src="/images/mypage/mypage_search_icon.svg"
                        onclick="searchAction(this)">
                    <div class="close" onclick="deleteResult()">
                        <img src="/images/mypage/tmp_img/X-12.svg" />
                    </div>
                </div>
                <div class="pc__view">
                    <div class="category__small"></div>
                </div>
                <div class="mobile__view">
                    <div class="category__small__mobile">
                        <div class="inquiry__category" style="width:100%;position:relative">
                            <select id="inq_cate">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inquiry__faq__detail__area">
                <div class="toggle__list">
                    <div class="toggle__list__tab 02"></div>
                </div>
            </div>
        </div>
        <div class="footer"></div>
    </div>
    <div class="inquiry__tab inquiry__action__wrap">
        <form id="frm-inquiry">
            <div class="title">
                <p font-size: 13px;>문의하기</p>
            </div>
            <div class="inquiry__info inquiry__title">
                <span>
                    <p class="title">문의유형</p>
                    <div class="inquiry__type" style="width:110px;margin-right:10px;margin-top:10px;">
                        <select id="inquiry__type" name="inquiry__type" style="display:none">
                            <option name="inquiry__type" value="KR" selected>취소/환불</option>
                            <option name="inquiry__type" value="EN">주문/결제</option>
                            <option name="inquiry__type" value="CN">출고/배송</option>
                            <option name="inquiry__type" value="CN">반품/교환</option>
                            <option name="inquiry__type" value="CN">A/S</option>
                        </select>
                    </div>
                </span>
                <span style="width:100%;">
                    <p class="title">제목</p>
                    <input id="inquiry_title" placeholder="제목을 입력하세요.">
                </span>
            </div>

            <div class="inquiry__info inquiry__contents">
                <textarea placeholder="내용을 입력하세요. (최대 1,000자)" id="inquiryTextBox" class="inquiryTextBox"
                    type="text"></textarea>
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
                    ·&nbsp;상품 불량 및 오배송의 경우, 해당 제품 사진을 등록 부탁드립니다.</p>
                <p style="margin-top: 10px;">
                    ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.</p>
            </div>
            <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
            <button class="black__full__width__btn">등록</button>
            <button class="white__full__width__btn">취소</button>
        </form>
        <div class="footer"></div>
    </div>
    <div class="inquiry__tab inquiry__list__wrap">
        <div class="title">
            <p font-size: 13px;>나의 문의내역</p>
        </div>
        <div class="description">
            <p>
                ·&nbsp;C/S 운영시간 Mon-Fri AM10:00 - PM5:00
            </p>
            <p>
                ·&nbsp;매월 15일 (공휴일인 경우 직전 영업일)은 당사의 CS 및 배송 시스템 점검일입니다.<br>
                보다 나은 서비스를 제공하기 위하여 위 점검일에는 CS 및 배송 업무가 중단됩니다.<br>
                고객 여러분들의 양해를 부탁드립니다. 오프라인 스토어는 정상 운영됩니다.
            </p>
            <p>
                ·&nbsp;답변이 완료된 문의내역은 수정이 불가능합니다.
            </p>
        </div>
    </div>
</div>