<style>
.mileage__wrap{
    margin-top:40px;
    width:100%;
}
.mileage__tab__btn__container{
    margin: 0 auto;
    width:230px;
    display:grid;
    place-items: center;
    grid-template-columns: 60px 60px 60px 70px;
}
.mileage__tab__wrap{
    width:710px;
    margin:0 auto;
    margin-top:50px;
}   
.mileage__notice__wrap .title{
    margin-bottom:30px;
}
.mileage__tab__wrap .contents__table{
    border-top:none;
    border-bottom:none;
    margin-top:40px!important;
}
.mileage__tab__wrap .description{
    margin-top:40px;
    margin-bottom:60px;
}
table.border__bottom td{
    border-bottom: 1px solid #dcdcdc;
}
table.border__bottom__th{
    text-align: left;
}
table.border__bottom__th th{
    border-bottom: 1px solid #dcdcdc;
}
.mileage__tab__wrap .footer{
    margin-bottom:100px;
}
.mileage__table tr{
    height:55px;
}
.mileage__table tbody p{
    margin-bottom:0px;
}
.mileage__table thead p{
    margin-bottom:0px;
}
</style>
<div class="mileage__wrap">
    <div class="mileage__tab__btn__container">
        <div class="tab__btn__item"  form-id="mileage__total__wrap">
            <img src="/images/mypage/tab/select_total_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="mileage__save__wrap">
            <img src="/images/mypage/tab/default_save_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="mileage__use__wrap">
            <img src="/images/mypage/tab/default_use_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="mileage__notice__wrap">
            <img src="/images/mypage/tab/default_notice_btn.svg">
        </div>
    </div>
    <div class="mileage__tab__wrap">
        <div class="mileage__tab mileage__total__wrap">
            <div class="title">
                <p>적립포인트 현황</p>
            </div>
            <div class="contents__table">
                <table class="border__bottom__th">
                    <colsgroup>
                        <col style="width:240px;">
                        <col style="width:240px;">
                        <col style="width:230px;">
                    </colsgroup>
                    <thead>
                        <th><p>현재 적립포인트</p></th>
                        <th><p>사용된 포인트</p></th>
                        <th><p>사용된 포인트</p></th>
                    </thead>
                    <tbody>
                        <td><p>3,000</p></td>
                        <td><p>- 225,000</p></td>
                        <td><p>0</p></td>
                    </tbody>
                </table>
            </div>
            <div class="description">
                <p>·&nbsp;주문으로 발생한 적립금은 배송완료 후 7일 부터 실제 사용 가능한 적립금으로 전환됩니다.</p>
                <p>·&nbsp;적립 포인트의 적립, 사용은 ADER 자사제품에 한하여 사용가능합니다.</p>
                <p>·&nbsp;적립 포인트는 1,000단위로 사용하실 수 있습니다.</p>
                <p>·&nbsp;적립 포인트는 바우처와 함께 사용하실 수 없습니다.</p>
            </div>
            <div class="contents__table">
                <table class="border__bottom border__bottom__th mileage__table">
                    <colsgroup>
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:110px;">
                    </colsgroup>
                    <thead>
                        <th>
                            <p>일자</p>
                        </th>
                        <th>
                            <p>주문번호</p>
                        </th>
                        <th>
                            <p>내용</p>
                        </th>
                        <th>
                            <p>구매금액</p>
                        </th>
                        <th>
                            <p>적립</p>
                        </th>
                        <th>
                            <p>사용</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>2022.12.13</p>
                            </td>
                            <td>
                                <p class="underline">000031586</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 10,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.12.10</p>
                            </td>
                            <td>
                                <p class="underline">000031564</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>430,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 5,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.07.06</p>
                            </td>
                            <td>
                                <p class="underline">000020154</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>80,000</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>- 5,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>신규회원 적립금</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.12.13</p>
                            </td>
                            <td>
                                <p class="underline">000031586</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 10,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.12.10</p>
                            </td>
                            <td>
                                <p class="underline">000031564</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>430,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 5,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.07.06</p>
                            </td>
                            <td>
                                <p class="underline">000020154</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>80,000</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>- 5,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>신규회원 적립금</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer"></div>
        </div>
        <div class="mileage__tab mileage__save__wrap">
            <div class="title">
                <p>적립포인트 현황</p>
            </div>
            
            <div class="contents__table">
                <table class="border__bottom border__bottom__th mileage__table">
                    <colsgroup>
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:110px;">
                    </colsgroup>
                    <thead>
                        <th>
                            <p>일자</p>
                        </th>
                        <th>
                            <p>주문번호</p>
                        </th>
                        <th>
                            <p>내용</p>
                        </th>
                        <th>
                            <p>구매금액</p>
                        </th>
                        <th>
                            <p>적립</p>
                        </th>
                        <th>
                            <p>사용</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>2022.12.13</p>
                            </td>
                            <td>
                                <p class="underline">000031586</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 10,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>299,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>234,100</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>599,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>신규회원 적립금</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.12.13</p>
                            </td>
                            <td>
                                <p class="underline">000031586</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>+ 10,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>299,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>234,100</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문적립</p>
                            </td>
                            <td>
                                <p>599,200</p>
                            </td>
                            <td>
                                <p>+ 3,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>신규회원 적립금</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>+ 5,000</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer"></div>
        </div>
        <div class="mileage__tab mileage__use__wrap">
            <div class="title">
                <p>사용된 포인트</p>
            </div>
            
            <div class="contents__table">
                <table class="border__bottom border__bottom__th mileage__table">
                    <colsgroup>
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:110px;">
                    </colsgroup>
                    <thead>
                        <th>
                            <p>일자</p>
                        </th>
                        <th>
                            <p>주문번호</p>
                        </th>
                        <th>
                            <p>내용</p>
                        </th>
                        <th>
                            <p>구매금액</p>
                        </th>
                        <th>
                            <p>적립</p>
                        </th>
                        <th>
                            <p>사용</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>2022.12.13</p>
                            </td>
                            <td>
                                <p class="underline">000031586</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>99,200</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 10,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>102,200</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 3,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.06.15</p>
                            </td>
                            <td>
                                <p class="underline">000020100</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>215,600</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 5,000</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2022.08.05</p>
                            </td>
                            <td>
                                <p class="underline">000030562</p>
                            </td>
                            <td>
                                <p>주문사용</p>
                            </td>
                            <td>
                                <p>235,200</p>
                            </td>
                            <td>
                                <p>0</p>
                            </td>
                            <td>
                                <p>- 8,000</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer"></div>
        </div>
        <div class="mileage__tab mileage__notice__wrap">
            <div class='title'><p>적립포인트 유의사항</p></div>
            <div class='description'>
                <p>·&nbsp;프리오더 제품은 정해진 기간에만 주문 가능합니다. 제품별 주문 가능 기간을 확인해주세요.</p>
                <p class="next__line__exist">·&nbsp;주문 취소 및 사이즈 교환은 프리오더 기간 내에만 가능합니다.</p>
                <p>&nbsp;&nbsp;단, 사이즈 교환은 재고가 있는 제품에 한하여 처리 가능합니다.</p>
                <p>·&nbsp;주문과 동시에 배송되는 제품이 아니니 유의해주세요.</p>
                <p>·&nbsp;재고 소진 시, 프리오더 신청이 조기 종료될 수 있습니다.</p>
                <p>·&nbsp;프리오더 제품은 충전 포인트로 결제 가능합니다.</p>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
$('.mileage__alarm__wrap').hide();
$('.mileage__cancel__wrap').hide();

</script>