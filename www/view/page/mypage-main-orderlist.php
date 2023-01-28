<style>
    .orderlist__wrap {
        margin-top: 40px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }

    .orderlist__tab__wrap {
        grid-column: 1/17;
        width: 950px;
        margin: 0 auto;
    }

    .orderlist__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        place-items: center;
        grid-template-columns: 50px 50px 50px 50px;
    }

    .orderlist__tab__contents {
        margin: 0 auto;
        grid-column: 1/17;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .info__title {
        margin-right: 10px;
    }

    .info__value {
        margin-right: 30px;
    }

    .orderlist__wrap table {
        width: 100%;
    }

    .contents__table {
        padding-top: 10px;
    }

    .orderlist__wrap table td {
        padding-top: 0 !important;
    }

    .order_status_box {
        border: 1px solid #343434;
        width: 56px;
        height: 23px;
        margin-left: 10px;
        padding: 5px 0;
    }

    .title_orderlist_info {
        font-size: 13px;
        line-height: 1.15;
        margin-bottom: 10px;
        margin: 0;
    }

    .list_orderlist_info p {
        font-size: 11px;
        margin-top: 10px;
    }

    .list_orderlist_info .underline {
        margin-left: 7px;
    }

    .orderlist__tab__contents .title {
        margin-bottom: 0;
    }

    .oderlist_info_table {
        margin-top: 60px;
        display: grid;
        grid-template-columns: 600px 350px;
    }

    .oderlist_info_table .contents__table td {
        padding: 0;
    }

    .oderlist_payment_info {
        display: flex;
        justify-content: space-between;
    }
    .oderlist_payment_info p{

        font-size: 11px;
        margin-bottom: 10px;
    }
    .oderlist_payment_info_border {
        border-top: 1px solid #dcdcdc;
        border-bottom: 1px solid #dcdcdc;
        margin:10px 0;
        padding-top: 10px;
    }

    @media (max-width: 1024px) {
        .orderlist__tab__wrap {
            width: 100%;
        }

        .orderlist__tab__btn__container {
            grid-column: 1/17;
        }

        .orderlist__tab__contents {
            width: 100%;
        }

        .contents__info .info span {
            font-size: 10px;
        }
    }

    @media (min-width: 600px) {
        .orderlist__tab__wrap {
            grid-column: 1/17;
            width: 580px;
            margin: 0 auto;
        }
    }

    @media (min-width: 1024px) {
        .orderlist__tab__wrap {
            width: 100%;
        }
    }
</style>
<div class="orderlist__wrap">
    <div class="orderlist__tab__btn__container" onclick="viewOrderList()">
        <div class="tab__btn__item">
            <img src="/images/mypage/tab/select_order_btn.svg">
        </div>
        <div class="tab__btn__item">
            <img src="/images/mypage/tab/default_cancel_btn.svg">
        </div>
        <div class="tab__btn__item">
            <img src="/images/mypage/tab/default_exchange_btn.svg">
        </div>
        <div class="tab__btn__item">
            <img src="/images/mypage/tab/default_return_btn.svg">
        </div>
    </div>
    <div class="orderlist__tab__wrap">
        <div class="orderlist__tab order__list">
            <div class="pc__view">
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000031586</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.14</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:240px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
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
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 45px !important; padding-right:0;">
                                        <div style="padding-bottom: 13px;">
                                            <p>결제완료<button class="order_status_box" onclick="">주문취소</button>
                                        </div>
                                        <p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>
                                        </p>
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
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 45px !important; padding-right:0;">
                                        <div style="padding-bottom: 13px;">
                                            <p>결제완료<button class="order_status_box" onclick="">주문취소</button>
                                        </div>
                                        <p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">DRAW</span>
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.13</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:240px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLASSTB18BK.png">
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
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 25px !important;">
                                        <p>배송중</p>
                                        <p>CJ대한통운<br>652013628816</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">652013628816</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.11</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:240px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWLK15BL_8.png">
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
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 45px !important; padding-right:0;">
                                        <div style="padding-bottom: 13px;">
                                            <p>배송완료<button class="order_status_box" onclick="">반품접수</button>
                                        </div>
                                        <p style="font-size: 10px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWHT04BK_10.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                    </td>
                                    <td>
                                        <p>Color</p>
                                    </td>
                                    <td>
                                        <p>A1</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 45px !important; padding-right:0;">
                                        <div style="padding-bottom: 13px;">
                                            <p>배송완료<button class="order_status_box" onclick="">반품접수</button>
                                        </div>
                                        <p style="font-size: 10px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWJE11BL_12.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                    </td>
                                    <td>
                                        <p>Color</p>
                                    </td>
                                    <td>
                                        <p>A1</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td style="padding-top: 45px !important; padding-right:0;">
                                        <div style="padding-bottom: 13px;">
                                            <p>배송완료<button class="order_status_box" onclick="">반품접수</button>
                                        </div>
                                        <p style="font-size: 10px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.02</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:240px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWOC03GR_11.png">
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
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td>
                                        <p>취소완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.02</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:240px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:130px;">
                                <col style="width:120px;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWTB07BL_1.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                    </td>
                                    <td>
                                        <p>Color</p>
                                    </td>
                                    <td>
                                        <p>Onesize</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>000,000</p>
                                    </td>
                                    <td>
                                        <p>취소완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mobile__view">
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000031586</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.14</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:16%;">
                                <col style="width:30%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWBZ05BG_12.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A2</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWS203BR_1.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>UK35</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">DRAW</span>
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.13</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:16%;">
                                <col style="width:30%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLASSTB18BK.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A2</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000031556</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.11</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:16%;">
                                <col style="width:30%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWLK15BL_8.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A2</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWHT04BK_10.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A1</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWJE11BL_12.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A1</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.02</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:16%;">
                                <col style="width:30%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWOC03GR_11.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>A2</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orderlist__tab__contents">
                    <div class="contents__info">
                        <div class="info">
                            <span class="info__title">주문번호</span>
                            <span class="info__value">000032458</span>
                        </div>
                        <div class="info">
                            <span class="info__title">주문일</span>
                            <span class="info__value">2022.12.02</span>
                        </div>
                        <div class="detail__btn" onclick="viewDetailOrder()"><span>자세히보기</span></div>
                    </div>
                    <div class="contents__table">
                        <table>
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:16%;">
                                <col style="width:30%;">
                            </colsgroup>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/images/mypage/sample_product/BLAFWTB07BL_1.png">
                                    </td>
                                    <td>
                                        <p>Product name</p>
                                        <p>000,000</p>
                                        <p>Color</p>
                                        <p>Onesize</p>
                                    </td>
                                    <td>
                                        <p>Qty:1</p>
                                    </td>
                                    <td>
                                        <p>결제완료</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="orderlist__tab order__detail">
            <div class="orderlist__tab__contents">
                <div class="title" style="margin-bottom: 30px;">
                    <p>주문 상세</p>
                </div>
                <div class="contents__info">
                    <div class="info">
                        <span class="info__title">주문번호</span>
                        <span class="info__value">000031586</span>
                    </div>
                    <div class="info">
                        <span class="info__title">주문일</span>
                        <span class="info__value">2022.12.14</span>
                    </div>
                </div>
                <div class="contents__table" style="margin-top: 9.5px !important;">
                    <table>
                        <colsgroup>
                            <col style="width:120px;">
                            <col style="width:240px;">
                            <col style="width:130px;">
                            <col style="width:130px;">
                            <col style="width:130px;">
                            <col style="width:130px;">
                            <col style="width:120px;">
                        </colsgroup>
                        <tbody>
                            <tr>
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
                                    <p>Qty:1</p>
                                </td>
                                <td>
                                    <p>000,000</p>
                                </td>
                                <td style="padding-top: 45px !important; padding-right:0;">
                                    <div style="padding-bottom: 13px;">
                                        <p>결제완료<button class="order_status_box" onclick="">주문취소</button>
                                    </div>
                                    <p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>
                                    </p>
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
                                    <p>Qty:1</p>
                                </td>
                                <td>
                                    <p>000,000</p>
                                </td>
                                <td style="padding-top: 45px !important; padding-right:0;">
                                    <div style="padding-bottom: 13px;">
                                        <p>결제완료<button class="order_status_box" onclick="">주문취소</button>
                                    </div>
                                    <p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="oderlist_info_table">
                    <div style="width:350px;">
                        <div class="title">
                            <p>
                                배송정보
                            </p>
                        </div>
                        <div class="contents__table">
                            <p>문혜린</p>
                            <p>01055565655</p>
                            <p>(04782) 서울특별시 성동구 연무장길 53 3층</p>
                            <p>부재 시 문 앞에 놓아주세요</p>
                        </div>
                    </div>
                    <div style="width:350px;">
                        <div class="title">
                            <p>
                                결제정보
                            </p>
                        </div>
                        <div class="oderlist_payment_info_border">
                            <div class="oderlist_payment_info">
                                <p>제품합계</p>
                                <p>000,000</p>
                            </div>
                            <div class="oderlist_payment_info">
                                <p>배송비</p>
                                <p>0</p>
                            </div>
                            <div class="oderlist_payment_info">
                                <p>바우처</p>
                                <p>-2,000</p>
                            </div>
                            <div class="oderlist_payment_info">
                                <p>충전포인트</p>
                                <p>-200,000</p>
                            </div>
                        </div>
                        <div class="oderlist_payment_info" style="margin-top: 9.5px;">
                            <p>합계</p>
                            <p>000,000</p>
                        </div>
                    </div>
                </div>
                <div style="width:600px; margin-top: 100px;">
                    <div class="title_orderlist_info">
                        <p>주문 취소 안내</p>
                    </div>
                    <div class="list_orderlist_info">
                        <p>·&nbsp;주문 접수 및 결제 완료 단계: 주문내역에서 취소 가능합니다.</p>
                        <p>·&nbsp;배송 준비중 이후 단계: 주문취소 불가하며, 제품 수령 후 반품 진행 부탁드립니다.</p>
                    </div>
                    <div class="title_orderlist_info" style="margin-top: 50px !important;">
                        <p>반품 안내</p>
                    </div>
                    <div class="list_orderlist_info">
                        <p>·&nbsp;반품 접수는 제품 수령 후 7일 이내 가능합니다.</p>
                        <p>·&nbsp;주문 상태가 배송 완료일 경우 주문내역에서 반품 접수가능하며, 배송중으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍니다.</p>
                        <p class="underline">교환 및 반품 안내 바로 가기</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function viewOrderList() {
        $('.orderlist__tab').hide();
        $('.orderlist__tab.order__list').show();
    }
    function viewDetailOrder() {
        $('.orderlist__tab').hide();
        $('.orderlist__tab.order__detail').show();
    }
</script>