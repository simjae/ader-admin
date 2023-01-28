<style>
    .inquiry__wrap .description::-webkit-scrollbar {
        width: 5px;
    }
    .inquiry__wrap .title{margin-top:0px;margin-bottom:30px;}
    .inquiry__wrap .description::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .inquiry__wrap .description::-webkit-scrollbar-thumb {
        background-color: #dcdcdc;
    }

    .select-selected {
        color: #343434;
        border-radius: 1px;
        border: solid 1px #808080
    }

    .select-items div,
    .select-selected {
        color: #343434;
        background-color: #fff;
        padding: 12px 0 12px 10px;
        border: solid 1px #808080;
        cursor: pointer;
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
        color: #f5f5f5;
    }

    .mobile__view select {
        display: none;
    }
    .inquiry__title .title{
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.36;
        letter-spacing: normal;
        text-align: left;
        margin-bottom:0px;
    }
    .inquiry__wrap {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        width: 100%;
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
        gap:10px;
        place-items: center;
        grid-template-columns: 86px 70px 70px;
    }
    .inquiry__faq__wrap {
        width:470px;
        margin: 0 auto;
    }
    .inquiry__action__wrap{
        width:710px;
        margin: 0 auto;
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
    .inquiry__list__wrap .description{
        padding-left:6px;
    }
    .inquiry__list__wrap .description p{    
        text-indent: -6px;
        word-break: break-all;
    }
    .search {
        position: relative;
    }

    .search__small {
        position: relative;
        width: 110px;
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
        float:right;
    }
    @media (max-width: 1024px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width:100%;
            margin-top:40px;
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
        .inquiry__faq__wrap {width:100%;margin:0 auto;}
        .inquiry__action__wrap{width:100%;margin: 0 auto;}
        .inquiry__list__wrap {width:100%;margin: 0 auto;}
        .inquiry__info.inquiry__title select{width:100px;}
        .inquiry__info.inquiry__title input{width:100%;}
        .black__full__width__btn.inquiry__btn {width: 100%;margin-top:10px;}
    }
    @media (min-width: 600px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width:580px;
            margin:0 auto;
            margin-top:40px;
        }
    }
    @media (min-width: 1024px) {
        .inquiry__tab__wrap {
            grid-column: 1/17;
            width:950px;
            margin:0 auto;
            margin-top: 50px;
        }
    }
</style>
<div class="inquiry__wrap">
    <div class="inquiry__tab__btn__container">
        <div class="tab__btn__item" form-id="inquiry__faq__wrap">
            <img src="/images/mypage/tab/select_question_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="inquiry__action__wrap">
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
                    <p>문의하기</p>
                </div>
                <div class="inquiry__info inquiry__title">
                    <span>
                        <p class="title">문의유형</p>
                        <select class="category__select">
                            <option class="inquiry_select_placeholder">취소/환불</option>
                            <option>주문/결제</option>
                            <option>출고/배송</option>
                            <option>반품/교환</option>
                            <option>환불/품절</option>
                            <option>A/S</option>
                        </select>
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
                    보다 나은 서비스를 제공하기 위하여 위 점검일에는 CS 및 배송 업무가 중단됩니다.<br>
                    고객 여러분들의 양해를 부탁드립니다. 오프라인 스토어는 정상 운영됩니다.
                </p>
                <p>
                    ·&nbsp;답변이 완료된 문의내역은 수정이 불가능합니다.
                </p>
            </div>
            <div style="width:100%">
                <button class="black__full__width__btn inquiry__btn">문의하기</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('.inquiry__tab').hide();
        $('.inquiry__faq__wrap').show();

        $.ajax({
            type: "post",
            data: { 'country': 'KR' },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/faq/category/get",
            error: function (d) {
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.category').html('');
                        $('.category__small').html('');

                        d.data.forEach(function (row, index) {
                            $('#inq_cate').append(`<option value="${row.no}">${row.title}</option>`);

                            var cateDiv = `
                            <div class="btn__row">
                                <div class="faq__category__btn" category-no="${row.no}" onclick="cateBtnAction(this)">${row.title}</div>
                            </div>
                        `;
                            $('.category').append(cateDiv);

                            var smallCateDiv = `
                            <div class="btn__row">
                                <div class="parents__category">
                                    <div class="faq__category__btn" category-no="${row.no}" onclick="smallCateBtnAction(this)">${row.title}</div>
                                </div>
                        `;
                            smallCateDiv += `
                            </div>
                        `;
                            $('.category__small').append(smallCateDiv);
                        })
                        $('.children__category').hide();
                    }
                    makeSelect('inquiry__category');
                    makeSelect('inquiry__subcategory');
                }
            }
        });
    })

    function getFaqList(type, param) {
        var country = 'KR';
        var param_json = {};

        if (type == 'click') {
            param_json = { 'country': country, 'category_no': param };
        }
        else if (type == 'search') {
            param_json = { 'country': country, 'keyword': param };
        }
        $.ajax({
            type: "post",
            data: param_json,
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/faq/get",
            error: function (d) {
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.toggle__list__tab.02').html('');
                        d.data.forEach(function (row) {
                            strDiv = `
                            <div class="toggle__item">
                                <div class="category__title"><span>${row.title}</span></div>
                                <div class="question" style="cursor:pointer;" onclick="faqQuestionClick(this)">
                                    <span>${row.question}</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right">
                                </div>
                                <div class="request" style="display:none">${row.answer}</div>
                            </div>
                        `;
                            $('.toggle__list__tab.02').append(strDiv);
                        })
                    }
                }
            }
        });
    }

    function searchAction(obj) {
        var keyword = $(obj).parent().find('input').eq(0).val();
        if(keyword.length == 0 || keyword == ''){
            return false;
        }

        $('.inquiry__tab').hide();
        $('.inquiry__faq__detail__wrap').show();

        $('.category__small').find('.children__category').hide();
        $('.category__small .click__btn').removeClass('click__btn');

        $('.search__keyword').val(keyword);

        getFaqList('search', keyword);
    }

    function cateBtnAction(obj) {
        $('.inquiry__tab').hide();
        $('.inquiry__faq__detail__wrap').show();
        var cate_no = $(obj).attr('category-no');

        $('.category__small').find('[category-no=' + cate_no + ']').click();
    }
    function smallCateBtnAction(obj) {
        if ($(obj).hasClass('click__btn')) {
            $('.category__small').find('.children__category').hide();
            $(obj).removeClass('click__btn');
        }
        else {
            var cate_no = $(obj).attr('category-no');
            $('.category__small').find('.children__category').hide();
            $(obj).parent().parent().find('.children__category').show();

            $('.category__small').find('.faq__category__btn').removeClass('click__btn');
            $(obj).addClass('click__btn');

            getFaqList('click', cate_no);
        }
        $('.search__keyword').val('');
    }
    function childCateBtnAction(obj) {
        var cate_no = $(obj).attr('category-no');

        $(obj).addClass('click__btn');

        getFaqList('click', cate_no);
        $('.search__keyword').val('');
    }

    function faqQuestionClick(obj) {
        if ($(obj).next().css('display') == 'none') {
            $(obj).find('img.down__up__icon').attr('src', '/images/mypage/mypage_up_tab_btn.svg');
        }
        else {
            $(obj).find('img.down__up__icon').attr('src', '/images/mypage/mypage_down_tab_btn.svg');
        }
        $(obj).next().toggle();
    }

    function makeSelect(divId) {
        var selectDiv = $('.' + divId);
        selectDiv.css('position', 'relative');
        var SelLen = selectDiv.find('select option').length;

        var selectedDiv = ` <div class="select-selected">${selectDiv.find('select option:selected').text()}</div>`;
        selectDiv.append(selectedDiv);

        var selectHideDiv = `<div class="select-items select-hide">`;
        for (var i = 0; i < SelLen; i++) {
            selectHideDiv += `  
                            <div>${selectDiv.find(`select option:eq(${i})`).text()}</div>
                        `;
        }
        selectHideDiv += `  </div>`;
        selectDiv.append(selectHideDiv);

        selectDiv.find('.select-items').find('div').on('click', function () {
            var clickCountryText = $(this).text();

            var sameCountryOption = selectDiv.find(`select option:contains("${clickCountryText}")`);
            sameCountryOption.prop('selected', true);

            selectDiv.find('.select-selected').text(clickCountryText);

            selectDiv.find('.select-items').toggle();
        })

        selectDiv.find('.select-selected').on('click', function () {
            selectDiv.find('.select-items').toggle();
        });
    }
</script>