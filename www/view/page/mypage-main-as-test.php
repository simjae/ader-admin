<style>
    .as_container {
        width: 100%;
        margin: 100px auto;
    }


    .as_tab_btn {
        display: flex;
        justify-content: center;
    }

    .as__tab__btn__container {
        display: flex;
        justify-content: center;
        margin-top: 100px;
        margin-bottom: 50px;
    }

    .as__tab__btn__container li {
        list-style: none;
        width: 100px;
        cursor: pointer;
        text-align: center;
    }

    .as__tab__btn__container li.selected {
        border: 1px solid #343434;
        height: 24px;
        width: 72px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
    }

    .as_tab_btn li {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        width: 86px;
        height: 24px;
        padding: 10px 15px;
        cursor: pointer;
    }

    .as_tab_btn li.on {
        border: 1px solid #dcdcdc;
    }

    .as__tab__wrap {
        display: flex;
        justify-content: center;
        clear: both;
    }

    .as__service__btn {
        display: flex;
        justify-content: center;
        margin: 30px 0 20px
    }

    .as__service__btn li {
        border: 1px solid #dcdcdc;
        height: 40px;
        width: 230px;
        margin-right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .as__tab__wrap div.on {
        display: block;
    }

    .as__wrap__content__container {
        display: grid;
        margin-top: 80px;

    }

    .as__table__container {
        display: grid;
        justify-content: center;
        padding-bottom: 10px;
    }

    .as__table__container .contents__table tr {
        border-bottom: 1px solid #dcdcdc;
    }

    .as__table__container .contents__table td {
        padding: 10px 0;
    }

    .content__table {
        margin: 10px 0;
    }

    .order_status_box {
        border: 1px solid #343434;
        width: 56px;
        height: 23px;
        margin-left: 10px;
        padding: 5px 0;
    }

    .as_buying_wrap {
        width: 710px;
        margin: 0 auto;
    }

    .asTextBox {
        border: 1px solid #808080;
        width: 710px;
        height: 250px;
        padding: 10px;
        margin: 10px 0 20px;
    }

    .bluemark_serialcode {
        height: 40px;
        width: 470px;
        border: 1px solid #808080;
        margin-right: 10px;
        padding: 12px 10px;
    }

    .as__contents {
        display: grid;
    }

    .as__info.as__photo {
        display: grid;
    }

    .as__info.as__photo__unconfirm {
        display: flex;
    }

    .as__photo__container {
        display: flex;
        margin-right: 55px;
    }

    .black__btn {
        width: 100%;
        height: 40px;
        background-color: #191919;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .white__btn {
        width: 100%;
        height: 40px;
        border: 1px solid #dcdcdc;
        color: #343434;
    }

    .order_status_box.as_cancel {
        width: 110px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 40px;
    }

    .btn_step {
        width: 100%;
        height: 30px;
        border: 1px solid #dcdcdc;
        color: #999999;
        margin-bottom: 10px;
    }

    .as_step_contents {
        padding: 20px 261px;
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

    .detail__btn span {
        text-decoration: underline;
    }

    .contents__table_as_payment tr {
        margin: 19.5px 0;
        border-bottom: 1px solid #dcdcdc;
    }

    .contents__table_as_payment table {
        border-collapse: separate;
        border-spacing: 20px;
    }

    .as__tab__wrap .title {
        font-size: 13px;
        margin-bottom: 30px;
    }

    .as__tab__wrap .description p {
        font-size: 11px;
        margin-bottom: 10px;
    }
</style>

<div class="as_container">
    <ul class="as_tab_btn">
        <li class="on" onclick="clickAsTab (this)" tab_num="one">A/S 신청</li>
        <li onclick="clickAsTab (this)" tab_num="two">A/S 현황</li>
        <li onclick="clickAsTab (this)" tab_num="three">A/S 내역</li>
        <li onclick="clickAsTab (this)" tab_num="four">약관 및 요금</li>
    </ul>
    <div class="as__tab__wrap">
        <div class="tab one">
            <div class="as__wrap__content__container">
                <div style="font-size: 13px;">A/S 서비스 접수</div>
                <ul class="as__service__btn">
                    <li class="selected" onclick="clickAsServiceTab (this)" service_tab_num="one_one">구매 목록</li>
                    <li onclick="clickAsServiceTab (this)" service_tab_num="one_two">블루마크 인증</li>
                    <li onclick="clickAsServiceTab (this)" service_tab_num="one_three">확인 불가 제품</li>
                </ul>
            </div>
            <div class="as_buying_wrap one_one">
                <div class="as__table__container">
                    <div style="margin-bottom: 30px; font-size: 11px;">·&nbsp; 회원님의
                        구매 목록에서 A/S 접수할 제품을 선택해주세요.</div>
                    <div class="contents__table">
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
                                <tr style="border-top: 1px solid #dcdcdc;">
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                    </td>
                                    <td>
                                        <p>Color</p>
                                    </td>
                                    <td>
                                        <p>A2</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-bottom: 10px;">
                                        <button class="order_status_box" onclick="asApply()">A/S 신청</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWS203BR_1.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                    </td>
                                    <td>
                                        <p>Color</p>
                                    </td>
                                    <td>
                                        <p>UK35</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-bottom: 10px;">
                                        <button class="order_status_box" onclick="asApply()">A/S 신청</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="as_buying_wrap apply">
                    <div style="margin-bottom: 30px; font-size: 11px;">·&nbsp;A/S 접수할 내용을 입력해주세요.</div>
                    <div class="as__table__container">
                        <div class="contents__table">
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
                                    <tr style="border-top: 1px solid #dcdcdc;">
                                        <td>
                                            <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                        </td>
                                        <td>
                                            <p>Product name</p>
                                        </td>
                                        <td>
                                            <p>Color</p>
                                        </td>
                                        <td>
                                            <p>A2</p>
                                        </td>
                                        <td>
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
                    <div class="as__contents">
                        <form id="as_apply">
                            <div>
                                <textarea placeholder="내용을 입력하세요. (최대 1,000자)" id="asTextBox" class="asTextBox"
                                    type="text"></textarea>
                            </div>
                            <div class="as__info as__photo">
                                <p class="description">사진첨부</p>
                                <div class="as__photo__container">
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                    <div class="as__photo__item"><img src="/images/mypage/mypage_photo_btn.svg"></div>
                                </div>
                                <p class="description">
                                    ·&nbsp;A/S 필요한 해당 제품 사진을 등록 부탁드립니다.</p>
                                <p style="margin-top: 10px;">
                                    ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.</p>
                            </div>
                            <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
                            <button class="black__btn" onclick="asApplyComplete()">A/S 신청</button>
                            <button class="white__btn">취소</button>
                        </form>
                    </div>
                </div>


            </div>
            <div class="as_buying_wrap one_two">
                <div class='title'>
                    <ul>Bluemark 입력하기</ul>
                </div>
                <div>·&nbsp;Bluemark 시리얼 코드를 입력하여 A/S를 접수해주세요.</div>
                <div style="display: flex;">
                    <input type="text" class="bluemark_serialcode" placeholder="BLUE MARK 시리얼 코드">
                    <button class="black__btn" onclick="bludemarkSeorch()" style="width: 230px !important;">검색</button>
                </div>
                <div style="font-size: 11px;">·&nbsp;회원님의 Bluemark 인증 목록에서 A/S 접수할 제품을 선택해주세요.</div>
                <div class="contents__table">
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
                            <tr style="border-top: 1px solid #dcdcdc;">
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>A2</p>
                                </td>
                                <td>
                                    <p>000,000</p>
                                </td>
                                <td style="padding-bottom: 10px;">
                                    <button class="order_status_box" onclick="asApply()">A/S 신청</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWS203BR_1.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>UK35</p>
                                </td>
                                <td>
                                    <p>000,000</p>
                                </td>
                                <td style="padding-bottom: 10px;">
                                    <button class="order_status_box" onclick="asApply()">A/S 신청</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="as_buying_wrap one_three">
                <div>·&nbsp;확인 불가 제품은 상황에 따라 A/S가 불가할 수도 있습니다.</div>
                <div class="as__tab as__action__wrap">
                    <form id="frm-as">
                        <div class="title">
                            <p>문의하기</p>
                        </div>
                        <div class="as__info as__title">
                            <span>
                                <select class="category__select">
                                    <option class="inquiry_select_placeholder">취소/환불</option>
                                    <option>주문/결제</option>
                                    <option>출고/배송</option>
                                    <option>반품/교환</option>
                                    <option>환불/품절</option>
                                    <option>A/S</option>
                                </select>
                            </span>
                            <span>
                                <select class="category__select">
                                    <option class="as_select_placeholder">취소/환불</option>
                                    <option>주문/결제</option>
                                    <option>출고/배송</option>
                                    <option>반품/교환</option>
                                    <option>환불/품절</option>
                                    <option>A/S</option>
                                </select>
                            </span>
                        </div>

                        <div class="as__info as__contents">
                            <textarea placeholder="내용을 입력하세요. (최대 1,000자)" id="asTextBox" class="asTextBox"
                                type="text"></textarea>
                        </div>
                        <div class="as__info as__photo__unconfirm">
                            <div>
                                <p class="description">사진첨부</p>
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
                                <p class="description">구매 이력, 증빙 이미지 첨부</p>
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
                            ·&nbsp;상품 불량 및 오배송의 경우, 해당 제품 사진을 등록 부탁드립니다.</div>
                        <div style="margin-top: 10px;">
                            ·&nbsp;파일형식은 jpg, png, gif,jpeg,jpe 파일용량은 10MB이하 최대 5개까지만 가능합니다.</div>

                        <div style="border-top:1px solid #dcdcdc;padding-top:20px;"></div>
                        <button class="black__btn">A/S 신청</button>
                        <button class="white__btn">취소</button>
                    </form>
                    <div class="footer"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab two">
            접수 진행중
            <div class="contents__table">
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
                        <tr style="border-top: 1px solid #dcdcdc;">
                            <td>
                                <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                            </td>
                            <td>
                                <p>Product name</p>
                            </td>
                            <td>
                                <p>Color</p>
                            </td>
                            <td>
                                <p>A2</p>
                            </td>
                            <td>
                                <p>000,000</p>
                            </td>
                            <td>
                                <p>A/S 요금 00.000</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn_step" style="margin-top: 20px; background-color:black; color: #ffffff;">STEP 01.
                접수</button>

            <div class="as_step_contents">
                <p>A/S 서비스를 위해 접수가 진행중입니다.</p>
                <p>요일일 2022.12.08</p>
                요청내용 수선요청</p>
                <div class="order_status_box as_cancel">A/S 신청 취소하기</div>
            </div>

            <button class="btn_step">STEP 02. 회수</button>
            <button class="btn_step">STEP 03. 진행</button>
            <button class="btn_step">STEP 04. 요금</button>
            <button class="btn_step">STEP 05. 제품 출고</button>
            <button class="btn_step">STEP 06. 완료</button>
        </div>
    </div>
    <div class="as__tab__wrap">
        <div class="tab three" style="margin-top:50px;">
            <div class="as_contents_list_wrap">
                <div class="contents__info">
                    <div class="info">
                        <span class="info__title">접수일</span>
                        <span class="info__value">2022.12.14</span>
                    </div>
                    <div class="detail__btn" onclick=""><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
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
                            <tr style="border-top: 1px solid #dcdcdc;">
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>A2</p>
                                </td>
                                <td>
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
            <div class="as_contents_list_wrap">
                <div class="contents__info">
                    <div class="info">
                        <span class="info__title">접수일</span>
                        <span class="info__value">2022.12.14</span>
                    </div>
                    <div class="detail__btn" onclick=""><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
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
                            <tr style="border-top: 1px solid #dcdcdc;">
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>A2</p>
                                </td>
                                <td>
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
            <div class="as_contents_list_wrap">
                <div class="contents__info">
                    <div class="info">
                        <span class="info__title">접수일</span>
                        <span class="info__value">2022.12.14</span>
                    </div>
                    <div class="detail__btn" onclick=""><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
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
                            <tr style="border-top: 1px solid #dcdcdc;">
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>A2</p>
                                </td>
                                <td>
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
            <div class="as_contents_list_wrap">
                <div class="contents__info">
                    <div class="info">
                        <span class="info__title">접수일</span>
                        <span class="info__value">2022.12.14</span>
                    </div>
                    <div class="detail__btn" onclick=""><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
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
                            <tr style="border-top: 1px solid #dcdcdc;">
                                <td>
                                    <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                </td>
                                <td>
                                    <p>Product name</p>
                                </td>
                                <td>
                                    <p>Color</p>
                                </td>
                                <td>
                                    <p>A2</p>
                                </td>
                                <td>
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
    </div>
    <div class="as__tab__wrap">
        <div class="tab four">
            <div style="margin: 50px 0;">
                <div class="title">A/S 유의사항</div>
                <div class="description">
                    <p>· ADER 제품의 품질보증기간은 제품이 속한 컬렉션의 발매일로부터 1년입니다.​</p>
                    <p>· A/S는 ADER의 공식 판매처에서 구매한 정품에 한 해 서비스 제공이 가능합니다.</p>
                    <p>· 제품 사용 전/후 상황에 따라 발생할 수 있는 요금이 다를 수 있습니다.</p>
                    <p>· 제품에 사용된 원자재의 상황에 따라 A/S 가능 여부가 달라질 수 있습니다.</p>
                    <p>· 제품의 디자인 및 디테일의 변경을 요청하는 AS는 접수가 불가합니다.</p>
                    <p>· 제품 상태에 따라 유선상 안내가 어려울 수 있습니다.</p>
                    <p>· 실 제품 입고 이후 제품 상태에 따라 금액 변동이 있을 수 있습니다.</p>
                    <p>· 정품 인증이 어려운 제품의 경우, AS 비용이 상이할 수 있습니다.</p>
                </div>
            </div>
            <div>
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
                                    <p>Blue mark 포함</p>
                                </td>
                                <td>
                                    <p>Blue mark 미포함</p>
                                </td>
                            <tr>
                                <td>
                                    <p>의류</p>
                                </td>
                                <td>
                                    <p>봉제,부자재 등</p>
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
                                    <p>봉제,부자재 등</p>
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
</div>
<div class="as_bluemark_wrap apply_complete">
    <div>A/S 서비스 신청이 완료되었습니다.</div>
    <div>
        <p class="description">
            ·&nbsp;상단의 A/S 현황 탭에서 해당 제품의 A/S 진행 과정을 열람하실 수 있습니다.</p>
        <p style="margin-top: 10px;">
            ·&nbsp;제품 회수 후에는 A/S 신청을 취소하실 수 없습니다.</p>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('.tab').hide();
        $('.tab.one').show();

    })

    function clickAsTab(obj) {
        var tab_num = $(obj).attr('tab_num');
        $('.tab').hide();
        $(`.tab.${tab_num}`).show();
    }


    function clickAsServiceTab(obj) {
        var tab_num = $(obj).attr('service_tab_num');
        $(`.as_buying_wrap`).hide();
        $(`.as_buying_wrap.${tab_num}`).show();
    }

    function asApply() {
        $('.as_buying_wrap.one_one').hide();
        $('.as_buying_wrap.apply').show();
    }
    function asApplyComplete() {
        $('.as_buying_wrap.one_one').hide();
        $('.as_buying_wrap.apply_complete').show();
    }
</script>

<!-- function clickAsTab(obj) {
        var tab_num = $(obj).attr('tab_num');
        $('.tab').hide();
        $(`.tab.${tab_num}`).addClass('on').show();
    } -->