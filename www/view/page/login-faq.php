<style>
    .inquiry__wrap .description::-webkit-scrollbar {
        width: 5px;
    }

    .inquiry__wrap .description::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .inquiry__wrap .description::-webkit-scrollbar-thumb {
        background-color: #dcdcdc;
    }

    .inquiry__wrap {
        margin: 150px auto;
    }

    .inquiry_title {
        font-size: 13px;
        text-align: center;
        margin-bottom: 150px;
    }

    .toggle__list.inquiry__list {
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.36;
        letter-spacing: normal;
        text-align: left;
        margin-bottom: 0px;
    }

    .inquiry__tab.title p {
        font-size: 13px;
    }

    .inquiry__category .select-items.select-hide {
        height: 175px;
        overflow-y: scroll;
    }

    .inquiry__faq__wrap {
        max-width: 470px;
        margin: 0 auto;
    }

    .inquiry__faq__detail__wrap {
        max-width: 940px;
        margin: 0 auto;
    }

    .inquiry__faq__detail__container {
        margin: 0 auto;
        width: 100%;
        display: grid;
        grid-template-columns: 110px 710px;
        gap: 130px;
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

    .child__category__btn.click__btn {
        color: #343434;
    }

    .child__category__btn {
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
        color: #999;
        font-family: var(--ft-no-fu);
        text-align: left;
        line-height: 30px;
        padding-left: 10px;
        border-radius: 1px;
        border-top: 1px solid #dcdcdc;
    }

    .inquiry__category .select-items.select-hide {
        height: 175px;
        overflow-y: scroll;
        border-bottom: 1px solid #dcdcdc;
        margin-right: -4px;
    }

    .toggle__list {
        width: 710px;
        float: right;
    }

    .float__none {
        float: none !important;
    }

    .toggle__list span {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.36;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .toggle__list .category__title {
        margin-bottom: 10px;
    }

    .toggle__list .question {
        margin-bottom: 20px;
    }

    .toggle__list .request {
        margin-bottom: 20px;
    }

    .toggle__item {
        border-bottom: 1px solid #dcdcdc;
        margin-bottom: 20px;
    }

    /* Style items (options): */
    .select-items {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
    }

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

    .search__keyword ::placeholder {
        color: #dcdcdc;
    }

    @media (max-width: 1024px) {
        .pc__view {
            display: none
        }

        .mobile__view {
            display: block
        }

        .inquiry__wrap {
            margin: 75px auto;
        }

        .inquiry_title {
            font-size: 13px;
            text-align: center;
            margin-bottom: 100px;
        }

        .search__small {
            width: 100%;
        }

        .inquiry__faq__detail__container {
            width: 100%
        }

        .inquiry__faq__detail__container {
            display: block;
        }

        .inquiry__faq__wrap {
            margin: 0 auto;
            padding: 0 10px;
        }

        .inquiry__faq__detail__wrap {
            margin: 0 auto;
            padding: 0 10px;
        }

        .inquiry__list__wrap {
            width: 100%;
            margin: 0 auto;
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

        .category__small__mobile {
            margin-top: 20px;
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }

        .select-selected {
            color: #343434;
            background-color: #fff;
            padding: 12px 0 12px 10px;
            border: solid 1px #dcdcdc;
            cursor: pointer;
            border-radius: 1px;
        }

        .select-items div {
            color: #343434;
            background-color: #fff;
            padding: 12px 10px;
            border: solid 1px #dcdcdc;
            cursor: pointer;
            border-top: none;
        }

        .toggle__list {
            float: none;
            width: unset;
        }

    }

    @media (min-width: 1024px) {
        .pc__view {
            display: block
        }

        .mobile__view {
            display: none
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

    }
</style>
<div class="inquiry__wrap">
    <div class="inquiry_title">자주 묻는 질문</div>
    <div class="inquiry__faq__wrap">
        <div class="search">
            <input class="search__keyword" type="text" placeholder="무엇을 도와드릴까요?">
            <img class="search__icon__img" src="/images/mypage/mypage_search_icon.svg" onclick="searchAction(this)">
        </div>
        <div class="category"></div>
    </div>
    <div class="inquiry__faq__detail__wrap">
        <div class="inquiry__faq__detail__container">
            <div class="inquiry__faq__detail__area">
                <div class="search__small">
                    <input class="search__keyword" type="text" placeholder="무엇을 도와드릴까요?">
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
                            <select id="inq_cate"></select>
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
    </div>
</div>


<script>

    $(document).ready(function () {

        $('#country').val(getLanguage());

        $('.inquiry__faq__detail__wrap').hide();
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
                                    <div class="children__category">
                            `;
                            if (row.children != null && row.children.length > 0) {
                                var child_data = row.children;
                                var child_data_len = child_data.length;

                                child_data.forEach(function (child_row) {
                                    var cateChildDiv = `<div class="child__category__btn" category-no="${child_row.no}" onclick="childCateBtnAction(this)">${child_row.title}</div>`;
                                    smallCateDiv += cateChildDiv;
                                })
                            }
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
        getInquiry();
    })

    function makeSelect(divId) {

        var selectDiv = $('.' + divId);
        selectDiv.css('position', 'relative');
        var SelLen = selectDiv.find('select option').length;

        var selectedDiv = ` <div class="select-selected">${selectDiv.find('select option:selected').text()}</div><img src="/images/mypage/mypage_down_tab_btn.svg" style="width:10px;height:5px;position: absolute;right:10px;top:18px;">`;
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

            if ($(this).parent().parent().attr('class') == 'inquiry__category') {
                var category_no = $('#inq_cate').val();
                getFaqList('click', category_no);
                $('.category__small').find('.faq__category__btn').removeClass('click__btn');
                $('.category__small').find('.faq__category__btn[category-no=' + category_no + ']').addClass('click__btn');
            }
        })

        selectDiv.find('.select-selected').on('click', function () {
            selectDiv.find('.select-items').toggle();
        });
    }

    function deleteResult() {
        $('.search__keyword').val('');
    }

    function getInquiry() {
        $('.toggle__list.inquiry__list').find('.toggle__list__tab').html('');

        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/inquiry/get",
            error: function (d) {
            },
            success: function (d) {
                if (d != null) {
                    if (d.code == 200) {
                        let data = d.data;

                        if (data != null && data.length > 0) {
                            data.forEach(function (row) {
                                let strDiv = '';
                                switch (row.category) {
                                    case 'CAR':
                                        category_str = '취소/환불';
                                        break;
                                    case 'OAP':
                                        category_str = '주문/결제';
                                        break;
                                    case 'OAD':
                                        category_str = '출고/배송';
                                        break;
                                    case 'RAE':
                                        category_str = '반품/교환';
                                        break;
                                    case 'AFS':
                                        category_str = 'A/S';
                                        break;
                                    case 'DAE':
                                        category_str = '배송/기타문의';
                                        break;
                                    case 'RST':
                                        category_str = '재입고';
                                        break;
                                    case 'PIQ':
                                        category_str = '제품문의';
                                        break;
                                    case 'BAR':
                                        category_str = '블루마크';
                                        break;
                                    case 'VUC':
                                        category_str = '바우처';
                                        break;
                                    case 'ETC':
                                        category_str = '기타서비스';
                                        break;
                                }
                                $('.toggle__list.inquiry__list').find('.toggle__list__tab').append(strDiv);
                            })
                        }
                    }
                }
            }
        });
    }
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
        if (keyword.length == 0 || keyword == '') {
            return false;
        }

        $('.inquiry__faq__wrap').hide();
        $('.inquiry__faq__detail__wrap').show();

        $('.category__small').find('.children__category').hide();
        $('.category__small .click__btn').removeClass('click__btn');

        $('.search__keyword').val(keyword);

        getFaqList('search', keyword);
    }

    function cateBtnAction(obj) {
        $('.inquiry__faq__wrap').hide();
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

            var cate_name = $('#inq_cate option[value=' + cate_no + ']').text();
            $('.inquiry__category .select-items div:contains("' + cate_name + '")').click();
            $('.inquiry__category img').attr('src', '/images/mypage/mypage_down_tab_btn.svg');
            $('.inquiry__category .select-items.select-hide').css('display', 'none');

        }
        $('.search__keyword').val('');
    }
    function childCateBtnAction(obj) {
        var cate_no = $(obj).attr('category-no');

        $(obj).parent().find('.child__category__btn').removeClass('click__btn');
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

</script>