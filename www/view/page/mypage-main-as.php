<style>
    .as_container {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        width: 100%;
        margin: 40px 0 100px;
        color: #343434;
    }

    .as_tab_btn {
        grid-column: 1/17;
        margin: 0 auto;
        display: flex;
        gap: 10px;
    }

    .as_tab_btn li {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        width: 72px;
        height: 24px;
        cursor: pointer;
        font-size: 11px;
        color: #343434;
        opacity: 0.5;
    }

    .as_tab_btn li.on {
        border: 1px solid #808080;
        color: #343434;
        opacity: 1;
    }

    .as__tab__wrap {
        clear: both;
    }

    .as__wrap__content__container {
        display: grid;
        margin-top: 50px;
    }

    .as_buying_wrap_apply {
        margin-top: 46px;
    }

    .as__service__btn {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 10px;
        width: 100%;
        margin: 30px auto 20px
    }

    .as__service__btn li {
        border: 1px solid #dcdcdc;
        height: 40px;
        width: 100%;
        font-size: 11px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .as__service__btn li.selected {
        background-color: #dcdcdc;
    }

    .as__tab__wrap div.on {
        display: block;
    }

    .bluemark_mini_title {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .bluemark_mini_description {
        margin-bottom: 20px;
    }

    .as__table__container {
        padding-bottom: 10px;
    }

    .as_order_status_box {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #808080;
        height: 23px;
        margin: auto;
        padding: 5px 10px;
        cursor: pointer;
        float: right;
    }

    .bluemark_input_wrap {
        display: flex;
        width: 100%;
        border-bottom: 1px solid #dcdcdc;
        margin-bottom: 59.5px;
    }

    .bluemark_serialcode {
        height: 40px;
        width: 67%;
        border: 1px solid #808080;
        margin-bottom: 20px;
        margin-right: 10px;
        padding: 12px 10px;
        margin-top: 0;
    }

    .as__info.as__title {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 10px;
        width: 100%;
    }

    .asTextBox {
        border: 1px solid #808080;
        height: 250px;
        padding: 10px;
        margin: 10px 0 20px;
    }

    .as__info.as__photo__unconfirm {
        display: flex;
        width: 100%;
    }

    .as__photo__container {
        display: flex;
        margin: 10px 55px 20px 0;
    }

    .category__select.as {
        width: 100%;
        margin-top: 30px;
    }

    .as__contents,
    .as__info.as__photo {
        display: grid;
    }

    .as__photo__item,
    .as_step_contents.step_five span {
        margin-right: 10px;
    }

    .as__black__btn {
        width: 100%;
        height: 40px;
        background-color: #191919;
        color: #ffffff;
        font-size: 11px;
        margin-bottom: 10px;
    }

    .as__white__btn {
        width: 100%;
        height: 40px;
        border: 1px solid #dcdcdc;
        color: #343434;
        font-size: 11px;
    }

    .btn_step {
        width: 100%;
        height: 30px;
        border: 1px solid #dcdcdc;
        color: #999999;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .btn_step.on {
        width: 100%;
        height: 30px;
        background-color: #191919;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .as_step_contents {
        padding: 10px 0 30px;
        display: flex;
        justify-content: center;
        align-content: center;
        text-align: center;
    }

    .as_step_contents p {
        margin-bottom: 10px;
    }

    .as_contents_list_wrap {
        margin-bottom: 102px;
    }

    .as_contents_list_wrap .contents__info {
        display: flex;
        margin-bottom: 9.5px;
    }

    .as_contents_list_wrap .detail__btn {
        margin-left: auto;
    }

    .detail__btn span,
    .underline p {
        text-decoration: underline;
    }

    .contents__table_as_payment tr {
        margin: 19.5px 0;
        border-bottom: 1px solid #dcdcdc;
    }

    .contents__table_as_payment table {
        border-collapse: collapse;
        border-spacing: 20px;
    }

    .as__contents__table tr {
        border-top: 1px solid #dcdcdc;
        border-bottom: 1px solid #dcdcdc;
    }

    .as__tab__wrap .title {
        font-size: 13px;
        margin: 0 0 30px;
    }

    .as__tab__wrap .description p {
        font-size: 11px;
        margin-bottom: 10px;
    }

    .select-hide {
        display: none;
    }

    .select-items div:hover {
        background-color: #dcdcdc;
        border: solid 1px #808080;
        color: #f5f5f5;
    }


    .as_status_title {
        margin: 50px 0 10px;
        font-size: 13px;
    }

    .as_table_align_l p {
        text-align: left;
    }

    .as__wrap__content__container .description {
        padding-left: 6px;
    }

    .as_buying_wrap.one_one>p {
        font-size: 11px;
        margin-bottom: 30px;
    }

    .as_payment_container {
        margin-top: 40px;
    }

    .apply_complete__wrap {
        grid-column: 1/17;
       
        margin: 0 auto;
    }

    .apply_complete {
        text-align: center ;
    }
    .as_com_title {
        font-size: 13px;
        margin: 100px 0 30px;
    }
    .as_com_contents {
        font-size: 11px;
    }

    @media (max-width: 1024px) {
        .as__tab__wrap {
            width: 100%;
            grid-column: 1/17;
        }

        .as__wrap__content__container {
            margin-top: 40px;
        }

        .as__table__container.first .as__contents__table .mobile__view,
        .as__table__container .as__contents__table .mobile__view {
            margin-top: 30px;
        }

        .as_status_title {
            margin: 40px 0 20px;
        }

        .as_container {
            margin: 20px 0 60px;
        }

        .as__wrap__content__container p {
            width: 100%;
        }

        .as_buying_wrap {
            width: 100%;
            margin: 0 auto;
        }

        .bluemark_input_wrap {
            margin-bottom: 29.5px;
        }

        .as__info.as__photo__unconfirm {
            display: grid;
        }

        .table_colspan_td {
            display: flex;
        }

        .table_colspan_td p {
            margin-bottom: 0;
            height: 0;
        }

        .as__contents__table tr {
            height: 100px;
        }

        .as_img_fixed {
            height: 100px;
            width: 80px !important;
            max-width: initial;
        }

        .as_contents_list_wrap {
            margin-bottom: 52.5px;
        }

        .as__tab__wrap .title {
            margin: 0 0 20px;
        }

        .as_payment_container {
            margin-top: 30px;
        }

        .as_buying_wrap_apply {
            margin-top: 46.5px;
        }
    }

    @media (min-width: 1024px) {
        .as__tab__wrap {
            grid-column: 1/17;
            width: 710px;
            margin: 0 auto;
        }
    }

    @media (max-width: 350px) {
        .as_container .swiper-slide.tab__btn__item {
            padding: 0 15px 0 15px
        }

        .as_tab_btn {
            display: none;
        }
    }

    @media (min-width: 350px) {
        .as_container .swiper.tab__btn {
            display: none;
        }
    }
</style>

<div class="as_container">
    <ul class="as_tab_btn">
        <li class="on" onclick="clickAsTab (this)" tab_num="one" style="width: 86px;" form-id="as__notice__wrap">약관 및 요금</li>
        <li onclick="clickAsTab (this)" tab_num="two" form-id="as__apply__wrap">A/S 신청</li>
        <li onclick="clickAsTab (this)" tab_num="three" form-id="as__condition__wrap">A/S 현황</li>
        <li onclick="clickAsTab (this)" tab_num="four" form-id="as__history__wrap">A/S 내역</li>
    </ul>
    <div class="swiper tab__btn">
        <div class="swiper-wrapper">
            <div class="swiper-slide tab__btn__item" onclick="clickAsTab (this)" tab_num="one" form-id="as__notice__wrap">
                <span>약관 및 요금</span>
            </div>
            <div class="swiper-slide tab__btn__item" onclick="clickAsTab (this)" tab_num="two" form-id="as__apply__wrap">
                <span>A/S 신청</span>
            </div>
            <div class="swiper-slide tab__btn__item" onclick="clickAsTab (this)" tab_num="three" form-id="as__condition__wrap">
                <span>A/S 현황</span>
            </div>
            <div class="swiper-slide tab__btn__item" onclick="clickAsTab (this)" tab_num="four" form-id="as__history__wrap">
                <span>A/S 내역</span>
            </div>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab two">
            <div class="as__wrap__content__container">
                <div style="font-size: 13px;">A/S 서비스 신청</div>
                <ul class="as__service__btn">
                    <li class="selected" onclick="clickAsServiceTab (this)" service_tab_num="one_one">주문 내역</li>
                    <li onclick="clickAsServiceTab (this)" service_tab_num="one_two">Bluemark 인증 내역</li>
                    <li onclick="clickAsServiceTab (this)" service_tab_num="one_three">인증 불가 제품</li>
                </ul>
            </div>
            <div class="as_buying_wrap one_one">
                <p>·&nbsp; 회원님의 주문 내역에서 A/S 접수할 제품을 선택해 주세요.</p>
                <div class="as__table__container first">
                    <div class="as__contents__table">
                        <div class="pc__view">
                            <table>
                                <colsgroup>
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:110px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWS203BR_1.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>UK35</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile__view">
                            <table>
                                <colsgroup>
                                    <col style="width:27%;">
                                    <col style="width:39%;">
                                    <col style="width:34%;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWS203BR_1.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>UK35</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="as_buying_wrap_apply">
                <div class="as__table__container">
                    <div class="as__contents__table">
                        <div class="pc__view">
                            <table>
                                <colsgroup>
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:110px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td>
                                            <p>A/S 요금 00.000</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile__view">
                            <table>
                                <colsgroup>
                                    <col style="width:27%;">
                                    <col style="width:39%;">
                                    <col style="width:34%;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td>
                                            <p>A/S 요금 00.000</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="as__contents">
                    <form id="as_apply">
                        <div>
                            <textarea placeholder="내용을 최대한 자세하게 입력해 주세요. (최대 1,000자)" id="asTextBox" class="asTextBox"
                                type="text"></textarea>
                        </div>
                        <div class="as__info as__photo">
                            <p class="description">사진 첨부</p>
                            <div class="as__photo__container">
                                <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                            </div>
                            <p class="description">
                                ·&nbsp;제품 전체 및 상세 사진과 파손 부분의 사진을 함께 첨부해주시면 더욱 정확한 확인이 가능합니다.</p>
                            <p style="margin: 10px 0 19.5px;">
                                ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.</p>
                        </div>
                        <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
                        <button class="as__black__btn" onclick="asApplyComplete(this)">A/S 신청</button>
                        <button class="as__white__btn">취소</button>
                    </form>
                </div>
            </div>
            <div class="as_buying_wrap one_two">
                <div class="bluemark_mini_title">
                    <p>Bluemark 입력하기</p>
                </div>
                <div class="bluemark_mini_description">·&nbsp;Bluemark 시리얼 코드를 입력하여 인증과 함께 A/S 신청이 가능합니다.</div>
                <div class="bluemark_input_wrap">
                    <input type="text" class="bluemark_serialcode" placeholder="Bluemark 시리얼 코드">
                    <button class="as__black__btn" style="width: 33%;" onclick="asSearch(this)">코드 확인</button>
                </div>
                <div class="bluemark_search_return" style="display: none;">
                    <div class="as__contents__table">
                        <div class="pc__view">
                            <table>
                                <colsgroup>
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:110px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile__view">
                            <table>
                                <colsgroup>
                                    <col style="width:27%;">
                                    <col style="width:39%;">
                                    <col style="width:34%;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='bluemark_mini_title'>
                    <ul>Bluemark 인증 내역</ul>
                </div>
                <div class="as__table__container">
                    <div class="bluemark_mini_description">·&nbsp;회원님의 Bluemark 인증 내역에서 A/S 접수할 제품을 선택해 주세요.</div>
                    <div class="as__contents__table">
                        <div class="pc__view">
                            <table>
                                <colsgroup>
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                    <col style="width:110px;">
                                    <col style="width:120px;">
                                    <col style="width:120px;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWS203BR_1.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>UK35</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile__view">
                            <table>
                                <colsgroup>
                                    <col style="width:27%;">
                                    <col style="width:39%;">
                                    <col style="width:34%;">
                                </colsgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                class="as_img_fixed">
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Product name</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>Color</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>A2</p>
                                        </td>
                                        <td class="table_colspan_td">
                                            <p>000,000</p>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <div class="as_order_status_box" onclick="asApply(this)">A/S 신청</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="as_buying_wrap one_three">
                <div>·&nbsp;정품 여부 확인이 어려운 제품은 A/S가 불가할 수 있습니다.</div>
                <div class="as__contents__table">
                    <form id="frm-as">
                        <div class="as__info as__title">
                            <span>
                                <select class="category__select as">
                                    <option class="as_select_type">의류</option>
                                    <option class="as_select_type">의류</option>
                                    <option class="as_select_type">의류</option>
                                </select>
                            </span>
                            <span>
                                <select class="category__select as">
                                    <option class="as_select_type">아우터</option>
                                    <option class="as_select_type">아우터</option>
                                    <option class="as_select_type">아우터</option>
                                </select>
                            </span>
                        </div>

                        <div class="as__info as__contents">
                            <textarea placeholder="내용을 최대한 자세하게 입력해 주세요. (최대 1,000자)" id="asTextBox" class="asTextBox"
                                type="text"></textarea>
                        </div>


                        <div class="as__info as__photo__unconfirm">
                            <div>
                                <p class="description">사진 첨부</p>
                                <div class="as__photo__container">
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="description">구매 이력, 증빙 또는 영수증 이미지 첨부</p>
                                <div class="as__photo__container">
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="description">
                            ·&nbsp;제품 전체 및 상세 사진과 파손 부분의 사진을 함께 첨부해주시면 더욱 정확한 확인이 가능합니다.</div>
                        <div style="margin: 10px 0 20px;">
                            ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.</div>

                        <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
                        <button class="as__black__btn">A/S 신청</button>
                        <button class="as__white__btn">취소</button>
                    </form>
                    <div class="footer"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab three">
            <p class="as_status_title">A/S 현황</p>
            <div class="as__table__container">
                <div class="as__contents__table" id="as_table">
                    <div class="pc__view">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:110px;">
                                <col style="width:120px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                            class="as_img_fixed">
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>Product name</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>Color</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>A2</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>000,000</p>
                                    </td>
                                    <td>
                                        <p>진행 현황 STEP 0X.XX</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile__view">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:39%;">
                                <col style="width:34%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                            class="as_img_fixed">
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>Product name</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>Color</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>A2</p>
                                    </td>
                                    <td class="table_colspan_td">
                                        <p>000,000</p>
                                    </td>
                                    <td>
                                        <p>A/S 요금 00.000</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn_step on" step_num="step_one" style="margin-top: 10px;" onclick="asStepBtn(this)">STEP
                01. 신청</button>
            <div class="as_step_contents step_one">
                <div style="margin-bottom:10px;">
                    <p>제품 A/S 신청이 완료되었습니다.</P>
                    <P>신청 내역 검토 이후 다음 단계로 변경됩니다.</p>
                    <p>요청일: 2022.12.08</p>
                    <p>요청내용: 수선요청</p>
                    <div class="as_order_status_box" id="as_step_btn_one" onclick="asStatusStep(this)"
                        style="width: 110px;">A/S 신청 취소
                    </div>
                </div>
            </div>
            <div class="as_step_contents step_one_return" style="display: none;">
                <div style="margin-bottom:10px;">
                    <p>A/S 서비스 접수가 완료되었으며 회수 준비 중입니다.</p>
                    <p>요청일 2022.12.08</p>
                    <p>요청내용 수선요청</p>
                </div>
            </div>
            <button class="btn_step" step_num="step_two" onclick="asStepBtn(this)">STEP 02. 회수</button>
            <div class="as_step_contents step_two" style="display: none;">
                <div>
                    <p>제품의 A/S를 위하여 발송 후 배송 정보를 입력해 주세요.</p>
                    <div class="as_order_status_box" id="as_step_btn_two" onclick="asStatusStep(this)"
                        style="width: 106px; margin-bottom: 10px;">배송정보 입력
                    </div>
                    <p>발송 주소: 서울시 성동구 연무장길 53 삼영빌딩 3층 ADER A/S</p>
                    <p>연락처: 02-792-2232</p>
                </div>
            </div>
            <div class="as_step_contents step_two_return" style="display: none;">
                <div style="margin-bottom:10px;">
                    <p>A/S 신청하신 제품의 입고 대기 중입니다.</p>
                    <p>입고 및 제품 확인 이후 다음 단계로 변경됩니다.</p>
                    <P>입력일시: 2023.02.27 7:14 PM</p>
                    <P>배송사: GS25편의점택배(CJ대한통운)</p>
                    <P style="cursor: pointer;">
                        <a href="https://www.cjlogistics.com/ko/tool/parcel/tracking" id="sample_a"
                            target="_blank">운송장번호: 520136281865</a>
                    </p>
                </div>
            </div>

            <button class="btn_step" step_num="step_three" onclick="asStepBtn(this)">STEP 03. 수선</button>
            <div class="as_step_contents step_three" style="display: none;">
                <div>
                    <p>제품이 입고되어 수선 중입니다.</p>
                    <p>최대 3주 소요될 수 있습니다.</p>
                    <div style="display: flex; justify-content:space-between; margin-top: 20px;">
                        <div class="as_table_align_l" style="margin-right:10px;">
                            <p>입고확인</p>
                            <p>요청사항</p>
                            <p>수선 방법</p>
                            <p>예상 완료일</p>
                        </div>
                        <div class="as_table_align_l">
                            <p>2023.02.28 (화)</p>
                            <p>전면 우측 손목 로고 봉제 파손</p>
                            <p>봉제 확인 및 수선</p>
                            <p>2023.03.20 (월)</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn_step" step_num="step_four" onclick="asStepBtn(this)">STEP 04. 결제</button>
            <div class="as_step_contents step_four" style="display: none;">
                <div>
                    <p>수선이 완료되었습니다.</p>
                    <p>결제 이후 영업일 2일 내 제품 배송이 시작됩니다.</p>
                    <p>요금(배송비 포함) 20,000원</p>
                    <div>
                        <span style="margin-right: 10px;">A/S 요금</span><span>배송비 포함 10,000원</span>
                    </div>
                    <div class="as_order_status_box" onclick="" id="as_step_btn_four"
                        style="width: 110px; margin: 20px auto 10px;">
                        결제하기
                    </div>
                </div>
            </div>

            <button class="btn_step" step_num="step_five" onclick="asStepBtn(this)">STEP 05. 배송</button>
            <div class="as_step_contents step_five" style="display: none;">
                <div>
                    <p>제품 배송이 시작되었습니다.</p>
                    <p>영업일 기준 1-3일 소요되며, 택배사 현황에 따라 변동될 수 있습니다.</p>
                    <div style="display: flex; justify-content: center; margin-top: 10px;">
                        <div class="as_table_align_l" style="margin-right:10px;">
                            <p>택배사</p>
                            <p>운송장번호</p>
                            <p>출고일</p>
                        </div>
                        <div class="as_table_align_l">
                            <p>CJ대한통운</p>
                            <p>346578941562</p>
                            <p>2023.03.03</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="as_step_contents step_five_return" style="display: none;">
                <div>
                    <p>A/S 완료 후 제품 배송 중입니다.</p>
                    <div style="display: flex; justify-content:space-between; margin-top: 10px;">
                        <div style="margin-top: 10px;">
                            <p>요청사항</p>
                            <p>A/S 요금</p>
                            <p>결제수단</p>
                            <p>결제일시</p>
                            <p>배송일</p>
                            <p>송장번호</p>
                        </div>
                        <div class="as_table_align_l" style="margin-top: 10px;">
                            <p>오른쪽 암홀 부분 올 풀림</p>
                            <p>배송비 포함 10,000원</p>
                            <p>신용카드</p>
                            <p>2022.12.30</p>
                            <p>2022.12.24</P>
                            <p>CJ대한통운 53013628817</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn_step" step_num="step_six" onclick="asStepBtn(this)">STEP 06. 완료</button>
            <div class="as_step_contents step_six" style="display: none;">
                <p>A/S가 완료되었습니다.</p>
            </div>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab four">
            <div class="as__wrap__content__container">
                <div class="as_contents_list_wrap">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">접수 2023.02.01</span>
                            <span class="info__value">완료 A/S 진행 중</span>
                        </div>
                        <div class="detail__btn" onclick=""><span data-i18n="o_view_details">자세히보기</span></div>
                    </div>
                    <div class="as__table__container">
                        <div class="as__contents__table">
                            <div class="pc__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:110px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00,000</p>
                                            </td>
                                            <td>
                                                <p>진행 현황 STEO 0X. XX</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:27%;">
                                        <col style="width:39%;">
                                        <col style="width:34%;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00,000</p>
                                            </td>
                                            <td>
                                                <p>접수 진행중</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="as_contents_list_wrap">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">접수일</span>
                            <span class="info__value">2022.12.14</span>
                        </div>
                        <div class="detail__btn" onclick=""><span data-i18n="o_view_details">자세히보기</span></div>
                    </div>
                    <div class="as__table__container">
                        <div class="as__contents__table">
                            <div class="pc__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:110px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00.000</p>
                                            </td>
                                            <td>
                                                <p>배송 진행중</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:27%;">
                                        <col style="width:39%;">
                                        <col style="width:34%;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00.000</p>
                                            </td>
                                            <td>
                                                <p>배송 진행중</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="as_contents_list_wrap">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">접수일</span>
                            <span class="info__value">2022.12.14</span>
                        </div>
                        <div class="detail__btn" onclick=""><span data-i18n="o_view_details">자세히보기</span></div>
                    </div>
                    <div class="as__table__container">
                        <div class="as__contents__table">
                            <div class="pc__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                        <col style="width:110px;">
                                        <col style="width:120px;">
                                        <col style="width:120px;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00.000</p>
                                            </td>
                                            <td>
                                                <p>A/S 완료</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile__view">
                                <table>
                                    <colsgroup>
                                        <col style="width:27%;">
                                        <col style="width:39%;">
                                        <col style="width:34%;">
                                    </colsgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png"
                                                    class="as_img_fixed">
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Product name</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>Color</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A2</p>
                                            </td>
                                            <td class="table_colspan_td">
                                                <p>A/S 요금 00.000</p>
                                            </td>
                                            <td>
                                                <p>A/S 완료</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab one">
            <div class="as__wrap__content__container">
                <div class="title">A/S 유의사항</div>
                <div class="description">
                    <p>· ADER 제품의 품질보증기간은 제품이 속한 컬렉션의 발매일로부터 1년입니다.​</p>
                    <p>· A/S는 Bluemark 인증이 완료되거나 ADER의 공식 판매 및 유통처에서 구매한 정품에 한 해 서비스 제공이 가능합니다.</p>
                    <p>· 제품 사용 전/후 상황에 따라 발생할 수 있는 요금이 다를 수 있습니다.</p>
                    <p>· 제품에 사용된 원자재의 상황에 따라 A/S 가능 여부가 달라질 수 있습니다.</p>
                    <p>· 제품의 디자인 및 디테일의 변경을 요청하는 A/S는 접수가 불가합니다.</p>
                    <p>· 제품 상태에 따라 유선상 안내가 어려울 수 있습니다.</p>
                    <p>· 실 제품 입고 이후 제품 상태에 따라 금액 변동이 있을 수 있습니다.</p>
                    <p>· 정품 여부 확인이 어려운 제품의 경우, A/S비용이 상이할 수 있습니다.</p>
                </div>
            </div>
            <div class="as_payment_container">
                <div class="title">A/S 요금표</div>
                <div class="contents__table_as_payment">
                    <table>
                        <colsgroup>
                            <col style="width:120px;">
                            <col style="width:112px;">
                            <col style="width:120px;">
                            <col style="width:110px;">
                        </colsgroup>
                        <tbody>
                            <tr>
                                <td>
                                    <p>분류</p>
                                </td>
                                <td>
                                    <p>항목</p>
                                </td>
                                <td>
                                    <p>Bluemark 포함</p>
                                </td>
                                <td>
                                    <p>Bluemark 미포함</p>
                                </td>
                            <tr>
                                <td>
                                    <p>의류</p>
                                </td>
                                <td>
                                    <p>봉제, 부자재 등</p>
                                </td>
                                <td>
                                    <p>30,000~</p>
                                </td>
                                <td>
                                    <p>60,000~</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>신발</p>
                                </td>
                                <td>
                                    <p>원단, 봉제 등</p>
                                </td>
                                <td>
                                    <p>40,000~</p>
                                </td>
                                <td>
                                    <p>80,000~</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>가방</p>
                                </td>
                                <td>
                                    <p>봉제, 부자재 등</p>
                                </td>
                                <td>
                                    <p>40,000~</p>
                                </td>
                                <td>
                                    <p>80,000~</p>
                                </td>
                            </tr>
                            <tr style="border-bottom: none;">
                                <td>
                                    <p>주얼리</p>
                                </td>
                                <td>
                                    <p>소재 등</p>
                                </td>
                                <td>
                                    <p>40,000~</p>
                                </td>
                                <td>
                                    <p>80,000~</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="apply_complete__wrap">
        <div class="apply_complete" style="display: none;">
            <div class="as_com_title">A/S 서비스 신청이 완료되었습니다.</div>
            <div class="as_com_contents">
                <p>·&nbsp;상단의 A/S 현황 탭에서 해당 제품의 A/S 진행 과정을 열람하실 수 있습니다.</p>
                <p style="margin-top: 10px;">·&nbsp;제품 회수 후에는 A/S 신청을 취소하실 수 없습니다.</p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.tab.two').hide();
        $('.tab.three').hide();
        $('.tab.four').hide();
        $('.as_buying_wrap').hide();
        $('.as_buying_wrap_apply').hide();
        $('.as_buying_wrap.one_one').show();
    })

    function clickAsTab(obj) {
        var tab_num = $(obj).attr('tab_num');
        $('.tab').hide();
        $(`.tab.${tab_num}`).show();
        $('.as_tab_btn li').removeClass('on');
        $(obj).addClass('on');
    }

    function clickAsServiceTab(obj) {
        var tab_num = $(obj).attr('service_tab_num');
        $('.as_buying_wrap').hide();
        $('.as_buying_wrap_apply').hide();
        $(`.as_buying_wrap.${tab_num}`).show();
        $('.as__service__btn li').removeClass('selected');
        $(obj).addClass('selected');
    }

    function asApply(obj) {
        $('.as_buying_wrap.one_one').hide();
        $('.as_buying_wrap.one_two').hide();
        $('.as_buying_wrap_apply').show();
    }

    function asApplyComplete(obj) {
        $('.as__tab__wrap').hide();
        if ($('.apply_complete').css('display') == 'none') {
            $('.apply_complete').css('display', 'show');
            $('.apply_complete').show();
            event.preventDefault();
        }
    }

    function asSearch(obj) {
        if ($('.bluemark_search_return').css('display') == 'none') {
            $('.bluemark_search_return').show();
            $('.as__black__btn').text('취소');
            $('.bluemark_input_wrap').css('border-bottom', 'none');
            $('.bluemark_input_wrap').css('margin-bottom', '0');
            $('.bluemark_search_return').css('margin-bottom', '59.5px');
        }
        else {
            $('.bluemark_search_return').hide();
            $('.as__black__btn').text('검색');
        }
    }

    function asStepBtn(obj) {
        var step_num = $(obj).attr('step_num');
        $('.as_step_contents').hide();
        $('.btn_step').removeClass('on');
        $(obj).addClass('on');
        $(`.as_step_contents.${step_num}`).show();

        if (`${step_num}` === 'step_one') {
            $('.as_status_title').text('A/S 현황');
        }
        else if (`${step_num}` === 'step_two') {
            $('.as_status_title').text('A/S 현황');
        }
        else if (`${step_num}` === 'step_three') {
            $('.as_status_title').text('A/S 진행중');
        }
        else if (`${step_num}` === 'step_four') {
            $('.as_status_title').text('결제 진행중');
        }
        else if (`${step_num}` === 'step_five') {
            $('.as_status_title').text('배송 진행중');
        }
        else {
            $('.as_status_title').text('A/S 완료');
        }
    }

    $('.as_order_status_box').on('click', function (e) {
        $('.as_step_contents').hide();
        if (e.target.id === 'as_step_btn_one') {
            $('.as_step_contents.step_one_return').show();
        }
        if (e.target.id === 'as_step_btn_two') {
            $('.as_step_contents.step_two_return').show();
        }
    })

</script>