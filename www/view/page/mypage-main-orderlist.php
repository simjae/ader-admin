<style>
.orderlist__wrap{
    margin-top:40px;
    width:100%;
    display:grid;
    grid-template-columns:repeat(16,1fr);
}  
.orderlist__tab__wrap{
    grid-column:5/13;
}
.orderlist__tab__btn__container{
    grid-column: 8/10;
    margin: 0 auto;
    width:230px;
    display:grid;
    place-items: center;
    grid-template-columns: 60px 60px 60px 50px;
}
.orderlist__tab__contents{
    margin: 0 auto;
    grid-column: 1/15;
    padding-top:50px;
    padding-bottom:50px;
}
.info__title{
    margin-right:10px;
}
.info__value{
    margin-right:30px;
}
.orderlist__wrap table{
    width:100%;
}
@media (min-width: 1024px){
    .orderlist__tab__contents{width:100%;}
}
@media (max-width: 1024px){
    .orderlist__tab__wrap{grid-column:1/17;}
    .orderlist__tab__btn__container{grid-column:1/17;}
    .orderlist__tab__contents{width:100%;}
    .contents__info .info span{
        font-size:10px;
    }
}
</style>
<div class="orderlist__wrap">
    <div class="orderlist__tab__btn__container">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
                    <table>
                        <colsgroup>
                            <col style="width:12.5%;">
                            <col style="width:25%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12%;">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
                    <table>
                        <colsgroup>
                            <col style="width:12.5%;">
                            <col style="width:25%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12%;">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
                    <table>
                        <colsgroup>
                            <col style="width:12.5%;">
                            <col style="width:25%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12%;">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
                    <table>
                        <colsgroup>
                            <col style="width:12.5%;">
                            <col style="width:25%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12%;">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
                </div>
                <div class="contents__table">
                    <table>
                        <colsgroup>
                            <col style="width:12.5%;">
                            <col style="width:25%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12.5%;">
                            <col style="width:12%;">
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
                    <div class="detail__btn"><span>자세히보기</span></div>
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
                    <div class="detail__btn"><span>자세히보기</span></div>
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
                    <div class="detail__btn"><span>자세히보기</span></div>
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
                    <div class="detail__btn"><span>자세히보기</span></div>
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
                    <div class="detail__btn"><span>자세히보기</span></div>
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
</div>
<script>
</script>