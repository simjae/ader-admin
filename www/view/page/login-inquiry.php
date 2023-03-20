<style>
    .inquiry__wrap .description::-webkit-scrollbar {
        width: 5px;
    }

    .inquiry__wrap .title {
        margin-top: 0px;
        margin-bottom: 30px;
    }

    .inquiry__wrap .description::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .inquiry__wrap .description::-webkit-scrollbar-thumb {
        background-color: #dcdcdc;
    }

    select:focus {
        outline: none;
    }

    select {
        width: 100%;
        padding-left: 10px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        height: 40px;
        margin-top: 10px;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    input:focus {
        outline: none;
    }

    textarea:focus {
        outline: none;
    }

    textarea {
        padding-left: 10px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        width: 100%;
        margin-top: 10px;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    input {
        padding-left: 10px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        width: 100%;
        height: 40px;
        margin-top: 10px;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    .select-selected {
        color: #343434;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    .select-items div,
    .select-selected {
        color: #343434;
        background-color: #fff;
        padding: 12px 0 12px 10px;
        border: solid 1px #808080;
        cursor: pointer;
        border-top: none;
    }

    .inquiry__category .select-items.select-hide {
        height: 175px;
        overflow-y: scroll;
        border-bottom: 1px solid;
    }

    /* Style items (options): */
    .select-items {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
    }

    /* Hide the items when the select box is closed: */
    .select-hide {
        display: none;
    }

    .select-items div:hover {
        background-color: #dcdcdc;
        border: solid 1px #808080;
        border-top: none;
    }

    .mobile__view select {
        display: none;
    }

    .inquiry__title .title {
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.36;
        letter-spacing: normal;
        text-align: left;
        margin-bottom: 0px;
    }

    .inquiry__wrap {
        margin-top: 200px;
        display: grid;
        width: 100%;
    }

    .inquiry__tab.title p {
        font-size: 13px;
    }

    textarea {
        padding: 10px;
    }

    textarea::placeholder {
        color: #dcdcdc;
    }

    .inquiry__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        font-size: 11px;
        grid-template-columns: 86px 70px 70px;
    }

    .inquiry__faq__wrap {
        width: 470px;
        margin: 0 auto;
    }

    .inquiry__action__wrap {
        width: 710px;
        margin: 150px auto;
    }

    .inquiry__faq__detail__wrap {
        width: 100%;
        margin: 0 auto;
    }

    .inquiry__faq__detail__container {
        margin: 0 auto;
        width: 100%;
        display: grid;
        grid-template-columns: 110px 840px
    }

    .inquiry__list__wrap {
        width: 710px;
        margin: 0 auto;
    }

    .inquiry__list__wrap .description {
        padding-left: 6px;
    }

    .inquiry__list__wrap .description p {
        text-indent: -6px;
        word-break: break-all;
    }

    .description p {
        margin-bottom: 10px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.65;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        text-indent: -6px;
        word-break: break-all;
    }

    .title p,
    .title span {
        font-size: 13px;
        line-height: 1.15;
        margin-bottom: 10px;
    }

    .search {
        position: relative;
        display: flex;
    }

    .search__small {
        position: relative;
        width: 110px;
        display: flex;
    }

    .inquiry__wrap .close {
        border-bottom: 1px solid #dcdcdc;
    }

    .inquiry__wrap .close img {
        width: 14px;
        height: 14px;
    }

    .search input {
        width: 100%;
        height: 20px;
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        border: none;
        border-bottom: 1px solid #dcdcdc;
        margin: 0;
        padding-left: 20px;
        padding-bottom: 5px;
    }

    .search__small input {
        width: 100%;
        height: 20px;
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        border: none;
        border-bottom: 1px solid #dcdcdc;
        margin: 0;
        padding-left: 20px;
        padding-bottom: 5px;
    }

    .search__icon__img {
        position: absolute;
        width: 14px;
        height: 14px;
        left: 0px;
        top: 0px;
        margin: 0;
    }

    .category {
        margin-top: 30px;
    }

    .category__small {
        margin-top: 20px;
    }



    .faq__category__btn.click__btn {
        background-color: #dcdcdc;
    }

    .btn__row {
        margin-bottom: 10px;
    }

    .category__title span {
        color: #999 !important;
    }

    .inquiry__tab__wrap .footer {
        margin-bottom: 100px;
    }

    .inquiry__info {
        margin-bottom: 20px;
    }

    .inquiry__info .description {
        margin-top: 20px;
    }

    .inquiry__info.inquiry__title {
        display: flex;
    }

    .inquiry__info.inquiry__title select {
        width: 110px;
        margin-right: 10px;
    }

    .inquiry__info.inquiry__title input {
        width: 590px;
    }

    .inquiry__info.inquiry__email input {
        width: 230px;
        margin-right: 10px;
    }

    .inquiry__info.inquiry__email select {
        width: 225px;
    }

    .inquiry__info.inquiry__request__flg .description {
        margin-bottom: 12px;
    }

    .inquiry__info.inquiry__contents textarea {
        margin-top: 0px;
        height: 250px;
        resize: none;
    }

    .inquiry__photo__container {
        width: 310px;
        display: grid;
        place-items: left;
        grid-template-columns: 63px 63px 63px 63px 53px;
        margin-top: 10px;
    }

    .inquiry__photo__item {
        width: 53px;
        height: 53px;
    }

    .inquiry__action__wrap button {
        margin-bottom: 10px;
    }

    .black__full__width__btn.inquiry__btn {
        width: 110px;
        float: right;
    }

    .black__full__width__btn {
        width: 100%;
        height: 40px;
        background-color: #191919;
        color: #ffffff;
        text-align: center;
        border-radius: 1px;
        font-size: 11px;
    }

    .white__full__width__btn {
        width: 100%;
        height: 40px;
        background-color: #ffffff;
        color: #343434;
        text-align: center;
        border-radius: 1px;
        border: solid 1px #dcdcdc;
        font-size: 11px;
    }

    .footer p {
        margin-bottom: 10px;
    }

    @media (max-width: 1024px) {
        .inquiry__tab__wrap {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            margin-top: 40px;
        }


        .inquiry__wrap {
            margin-top: 20px;
        }

        .search__small {
            width: 100%;
        }

        .inquiry__faq__detail__container {
            width: 100%
        }

        .inquiry__faq__detail__wrap {
            width: 100%
        }

        .inquiry__faq__detail__container {
            display: block;
        }

        .category__small__mobile {
            margin-top: 20px;
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }

        .inquiry__faq__wrap {
            width: 100%;
            margin: 0 auto;
        }

        .inquiry__action__wrap {
            margin: 0 auto;
        }

        .inquiry__list__wrap {
            width: 100%;
            margin: 0 auto;
        }

        .inquiry__info.inquiry__title select {
            width: 100px;
        }

        .inquiry__info.inquiry__title input {
            width: 100%;
        }

        .black__full__width__btn.inquiry__btn {
            width: 100%;
            margin-top: 10px;
        }

        .faq__category__btn {
            cursor: pointer;
            width: 100%;
            height: 40px;
            background-color: white;
            font-size: 11px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #343434;
            font-family: var(--ft-no-fu);
            text-align: center;
            line-height: 40px;
            border-radius: 1px;
            border: 1px solid #dcdcdc;
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
        .faq__category__btn {
            cursor: pointer;
            width: 100%;
            height: 30px;
            background-color: white;
            font-size: 11px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #343434;
            font-family: var(--ft-no-fu);
            text-align: center;
            line-height: 30px;
            border-radius: 1px;
            border: 1px solid #dcdcdc;
        }

        .inquiry__tab__wrap {
            grid-column: 1/17;
            width: 950px;
            margin: 0 auto;
            margin-top: 50px;
        }
    }

    .inquiry__wrap .select-items div,
    .select-selected {
        margin-bottom: -1px;
    }

    .inquiry__wrap .select-hide {
        margin-top: -1px;
    }
</style>

<div class="inquiry__action__wrap">
    <form id="frm-inquiry">
        <div class="title" style="font-size: 13px; text-align: center;">
            <p data-i18n="lm_inquiry">문의하기</p>
        </div>
        <div class="inquiry__info inquiry__title">
            <span>
                <p class="title">문의유형</p>
                <div class="inquiry__type" style="width:110px;margin-right:10px;">
                    <select id="inquiry__type" name="inquiry__type">
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

<script>
changeLanguageR();
</script>