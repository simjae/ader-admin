<style>
    .as__apply__wrap {
        width: 100%;
        color: #343434;
    }

    .as__tab__btn__container {
        display: flex;
        justify-content: center;
        margin-top: 100px;
        margin-bottom: 50px;
    }

    .as__tab__btn__container .tab__btn__item {
        border: 1px solid #343434;
        height: 24px;
        width: 72px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;

    }

    .as__wrap__content__container {
        display: grid;
        justify-content: center;
        margin-top: 80px;

    }

    .as__table__container .contents__table tr {
        border-bottom: 1px solid #dcdcdc;
    }

    .as__table__container .contents__table td {
        padding: 10px 0;
    }

    .as__service__btn__container {
        display: flex;
        justify-content: center;
        margin: 30px 0 20px
    }

    .as__service__btn {
        border: 1px solid #dcdcdc;
        height: 40px;
        width: 230px;
        margin-right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .order_status_box {
        border: 1px solid #343434;
        width: 56px;
        height: 23px;
        margin-left: 10px;
        padding: 5px 0;
    }

    .as__table__container {
        display: flex;
        justify-content: center;
        padding-bottom: 10px;
    }

    .content__table {
        margin: 10px 0;
    }

    .selected__btn {}
</style>
<div class="as__wrap">
    <div class="as__tab__btn__container">
        <div class="tab__btn__item" form-id="as__apply__wrap">A/S 신청</div>
        <div class="tab__btn__item selected__btn" onclick="tabAction(this)" form-id="as__situation__wrap">A/S 현황</div>
        <div class="tab__btn__item" form-id="as__history__wrap">A/S 내역</div>
        <div class="tab__btn__item" form-id="as__fee__wrap">약관 및 요금</div>
    </div>

    <div class="as__tab__wrap">
        <div class="as__tab as__apply__wrap">
            <div class="as__wrap__content__container">
                <div style="font-size: 13px;">A/S 서비스 접수</div>
                <div class="as__service__btn__container">
                    <div class="as__service__btn">구매 목록</div>
                    <div class="as__service__btn" onclick="smallTab(this)" form-id="bluemark_certification">블루마크 인증
                    </div>
                    <div class="as__service__btn">확인 불가 제품</div>
                </div>
            </div>
            <div style="margin-bottom: 30px; font-size: 11px; display: grid; justify-content: center;">·&nbsp; 회원님의 구매 목록에서 A/S 접수할 제품을 선택해주세요.</div>
            <div class="buying_list">
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
                                    <td style="padding-bottom: 10px;">
                                        <button class="order_status_box" onclick="">A/S 신청</button>
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
                                        <button class="order_status_box" onclick="">A/S 신청</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="as__tab as__situation__wrap">
            <div>현황</div>
        </div>
        <div class="as__tab as__history__wrap">

        </div>
        <div class="as__tab as__fee__wrap">

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.as__tab').hide();
        $('.as__apply__wrap').show();
    })

    function tabAction(obj) {
        $('.as__situation__wrap').hide();
        $('buying_list').show();
    }

    function smallTab(obj) {

    }

</script>
<!-- $('.tab__btn__as__apply').removeClass('as__apply__wrap');

$(this).addClass('selected__btn');
or
$(obj).addClass('selected__btn'); -->