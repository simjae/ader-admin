<style>
    .info table {
        width: 100%;
    }

    .voucher__wrap {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        margin: 40px 0 100px;
        width: 100%;
        color: #343434;
    }

    .voucher__wrap.title p {
        font-size: 13px;
    }

    .voucher__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        font-size: 11px;
        grid-template-columns: 84px 84px 84px 70px;
    }

    .voucher__tab {
        width: 100%;
        margin-top: 50px;
        font-family: var(--ft-no-fu);
        font-size: 11px;
    }

    .voucher__tab__wrap .title p {
        font-size: 13px;
    }

    .voucher__tab__wrap .description {

        margin-top: 0px;
    }

    .voucher__tab__wrap .info {
        font-size: 11px;
    }

    .form.voucher_input_wrap {
        display: grid;
        grid-template-columns: 1.87fr 1fr;
        column-gap: 10px;
        width: 100%;
        margin-top: 10px
    }

    .date__info {
        text-align: right;
    }

    .voucher__tab__wrap td {
        vertical-align: top;
    }

    .gray__font {
        color: #808080;
    }

    .use__voucher__form__wrap .table__wrap {
        padding-bottom: 0px;
        margin: 10px 0 60px;
        border-top: 1px solid #dcdcdc;
        border-bottom: 1px solid #dcdcdc;
    }

    .use__voucher__form__wrap .info {
        border: none;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .info__title__container {
        margin: 0 auto;
        width: 470px;
        display: grid;
        grid-template-columns: 215px 255px;
        margin-top: 40px;
    }

    .voucher__notice__form__wrap .non__border {
        padding-left: 6px
    }

    .voucher__notice__form__wrap .non__border p {
        text-indent: -6px;
        word-break: break-all;
    }

    .info .non__usable__info {
        color: #dcdcdc;
    }

    .info__wrap.possession {
        border-bottom: 1px solid #dcdcdc;
    }

    @media (max-width: 1024px) {
        .voucher__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .voucher__tab__btn__container {
            grid-template-columns: 74px 74px 74px 60px;
        }

        .voucher__wrap {
            margin: 20px 0 60px;
        }

        .info__title__container {
            width: 100%;
            grid-template-columns: 57% 43%;
            margin-top: 0;
        }

        .voucher__tab {
            margin-top: 0;
        }

        .voucher__wrap .title {
            margin-top: 0;
        }

        .info__wrap table {
            width: 100%;
        }

        .info__wrap.possession table td:nth-child(1) {
            width: 63%;
        }

        .info__wrap.possession table td:nth-child(2) {
            width: 37%;
        }

        .voucher__regist__form__wrap .form {
            display: grid;
            grid-template-columns: 1.87fr 1fr;
            column-gap: 10px;
            width: 100%;
        }

        .voucher__regist__form__wrap .form input,
        .voucher__regist__form__wrap .form button {
            width: 100%;
        }

        .notice_br {
            display: inline;
        }

        .use__voucher__form__wrap .table__wrap {
            margin-bottom: 52.5px;
        }
    }

    @media (min-width: 600px) {
        .voucher__tab__wrap {
            grid-column: 1/17;
            width: 580px;
            margin: 0 auto;
            margin-top: 40px;
        }
    }

    @media (min-width: 1024px) {
        .voucher__tab__wrap {
            grid-column: 1/17;
            width: 470px;
            margin: 0 auto;
        }

        .info__wrap.possession table td:nth-child(1) {
            width: 330px;
        }

        .info__wrap.possession table td:nth-child(2) {
            width: 140px;
        }

        .use__voucher__form__wrap .info {
            margin-top: 0;
        }

        .notice_br {
            display: none;
        }
    }

    .voucher__regist__form__wrap .title {
        margin-bottom: 30px;
    }

    .voucher__amount__form__wrap .title {
        padding-bottom: 29.5px;
    }

    .voucher__amount__form__wrap .info {
        margin-top: 0;
    }

    .use__voucher__form__wrap .title {
        padding-bottom: 20px;
    }

    .use__voucher__form__wrap .info {
        font-size: 11px;
    }

    .use__voucher__form__wrap .info__title__container {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        margin-left: 0;
    }

    .use__voucher__form__wrap .table__wrap {
        padding-top: 10px;
    }

    .use__voucher__form__wrap td {
        padding: 0;
        width: 100%;
    }

    .info .non__usable__info {
        margin-top: 22px;
    }

    .voucher__notice__form__wrap .title {
        margin-bottom: 30px;
    }

    .voucher__notice__form__wrap .non__border {
        padding-top: 0;
        margin-top: 0;
    }

    .info.non__usable__info {
        font-size: 11px;
        color: #dcdcdc;
    }

    .info.non__border p {
        margin-bottom: 10px;
    }
</style>
<div class="voucher__wrap">
    <div class="voucher__tab__btn__container">
        <div class="tab__btn__item" form-id="voucher__amount__form__wrap" onclick="voucherListGet('possession')">
            <span data-i18n="v_my_voucher">보유 현황</span>
        </div>
        <div class="tab__btn__item" form-id="use__voucher__form__wrap" onclick="voucherListGet('use')">
            <span data-i18n="v_used_history">사용 현황</span>
        </div>
        <div class="tab__btn__item" form-id="voucher__regist__form__wrap" onclick="issueVoucherFormPrint()">
            <span data-i18n="v_registration">바우처 등록</span>
        </div>
        <div class="tab__btn__item" form-id="voucher__notice__form__wrap">
            <span data-i18n="ml_notice">유의사항</span>
        </div>
    </div>
    <div class="voucher__tab__wrap">
        <div class="voucher__tab voucher__regist__form__wrap">
            <div class='title'>
                <p data-i18n="v_registration">바우처 등록</p>
            </div>
            <div class='description'>
                <span data-i18n="v_voucher_msg_01">발급받은 바우처 번호를 입력하세요.</span>
            </div>
            <div class="form voucher_input_wrap">
                <input type="text" id="voucher_issue_code">
                <button class="black__full__width__btn" data-i18n="v_register" onclick="voucherIssue()">받기</button>

            </div> <span id="voucher_err_msg" data-i18n="v_register" style="float:right;color:red;display:none;">존재하지 않는 바우처 코드입니다.</span>
            <div class="footer">
                <span class="flex_text">·&nbsp;<p data-i18n="v_voucher_msg_02">바우처의 발급 및 사용 기간을 꼭 확인해주세요.</p></span>
                <span class="flex_text">·&nbsp;<p data-i18n="v_voucher_msg_03" style="margin-top: 0px">대소문자를 구분하여 입력해 주세요.</p></span>
            </div>
        </div>
        <div class="voucher__tab voucher__amount__form__wrap">
            <div class='title'>
                <p data-i18n="v_redeemable_voucher">사용 가능 바우처</p>
            </div>
            <div class="info__wrap possession"></div>
            <div class="footer"></div>
        </div>
        <div class="voucher__tab use__voucher__form__wrap">
            <div class='title'>
                <p data-i18n="v_voucher_history">바우처 사용 내역</p>
            </div>
            <div class="info__wrap use"></div>
            <div class="footer"></div>
        </div>
        <div class="voucher__tab voucher__notice__form__wrap">
            <div class='title'>
                <p data-i18n="v_voucher_notice">바우처 유의사항</p>
            </div>
            <div class='info non__border'>
            <span class="flex_text" style="margin-left: -6px;">·&nbsp;&nbsp;&nbsp;<p data-i18n="v_voucher_msg_04">1개의 주문 건에 1개의 바우처 사용이 가능합니다.</p></span>
            <span class="flex_text" style="margin-left: -6px;">·&nbsp;&nbsp;&nbsp;<p data-i18n="v_voucher_msg_05">바우처의 사용 기한 만료 이후 사용 및 주문이 불가합니다.</p></span>
            <span class="flex_text" style="margin-left: -6px;">·&nbsp;&nbsp;&nbsp;<p data-i18n="v_voucher_msg_06">주문 취소 이후 바우처 복원은 최대 40분이 소요됩니다.</p></span>
            <span class="flex_text" style="margin-left: -6px;">·&nbsp;&nbsp;&nbsp;<p data-i18n="v_voucher_msg_07">유효기간이 지난 바우처는 재발행 되지 않습니다.</p></span>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>

<script>
    $('#voucher_err_msg').hide();
    $('.voucher__tab').hide();
    $('.voucher__regist__form__wrap').show();

    function voucherIssue() {
        var country = 'KR';
        var voucher_issue_code = $('#voucher_issue_code').val()

        if (voucher_issue_code == '') {
            $('#voucher_err_msg').text('바우처 번호를 입력해주세요');
            $('#voucher_err_msg').show();

            return false;
        }
        $.ajax({
            type: "post",
            data: { 'country': country, 'voucher_issue_code': voucher_issue_code },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/voucher/issue/add",
            error: function (d) {
                exceptionHandling("바우처", "응모에 실패했습니다. 다시 진행해주세요.");
            },
            success: function (d) {
                if (d.code == 200) {
                    $('#voucher_err_msg').hide();
                }
                else {
                    let err_str = '응모에 실패했습니다. 다시 진행해주세요.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    if (d.code = 401) {
                        exceptionHandling("드로우", err_str);
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                    $('#voucher_err_msg').text(err_str);
                    $('#voucher_err_msg').show();
                }
            }
        });
    }

    function voucherListGet(str) {
        //info__wrap possession
        var country = 'KR';
        $('.info__wrap.' + str).html('');
        $('.info__wrap.' + str).html(`
        <div class="info">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align:center">
                            <p data-i18n="v_no_history_msg">조회결과가 없습니다.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    `);
        $.ajax({
            type: "post",
            data: { 'country': country, 'list_type': str },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/voucher/list/get",
            error: function (d) {
                exceptionHandling("바우처", "목록을 불러오지 못했습니다.");
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.info__wrap.' + str).html('');
                        d.data.forEach(function (row) {
                            if (str == 'possession') {
                                var strDiv = `
                                    <div class="info">
                                        <table>
                                            <colsgroup>
                                                <col width="60%"></col>
                                                <col width="40%"></col>
                                            </colsgroup>
                                            <tbody>
                                                <tr style="border-top: 1px solid #dcdcdc;">
                                                    <td style="width:100%; padding: 9.5px 0 39.5px;">
                                                        <div style="display:flex;justify-content: space-between; margin-bottom: -1px">
                                                            <p>${row.voucher_issue_code}</p>
                                                            <p>${row.usable_start_date} - ${row.usable_end_date}</p>
                                                        </div>
                                                        <div style="display:flex;justify-content: space-between; margin-bottom: -1px">
                                                            <p>${row.voucher_name}</p>
                                                            <span style="display:flex;"> ${row.date_interval}<p class="gray__font"; data-i18n="v_days_left">일 남음</p></span>
                                                        </div>
                                                        <span>${row.sale_price_type}<p data-i18n="v_percent_off"></p></span> 
                                                        <span style="display:flex;"><p data-i18n="v_voucher_limit_price_01">· 바우처 대상 제품</p>&nbsp;${parseInt(row.min_price).toLocaleString('ko-KR')}<p data-i18n="v_voucher_limit_price_02">원 초과 구매 시 사용 가능</p></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                `;
                                $('.info__wrap.' + str).append(strDiv);
                                changeLanguageR();
                            }
                            else if (str == 'use') {
                                var divClass = '';
                                var useDate = '';
                                if (row.date_interval < 0 && row.used_flg == 0) {
                                    divClass = 'info non__usable__info';
                                    useDate = '사용기간 만료';
                                }
                                else {
                                    divClass = 'info';
                                    useDate = `<span data-i18n="v_used_on">사용일</span><span style="margin-left: 10px">${row.update_date}</span>`;
                                }
                                var strDiv = `
                                <div class="${divClass}">
                                    <div class="info__title__container">
                                        <div class="info__title__item"><span data-i18n="v_voucher_code">바우처번호</span><span style="margin-left: 10px">${row.voucher_issue_code}</span></div>
                                        <div class="info__title__item">${useDate}</div>
                                    </div>
                                    <div class="table__wrap">
                                        <table>
                                            <colsgroup>
                                                <col style="width:345px;">
                                                <col style="width:125px;">
                                            </colsgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p>${row.voucher_name}</p>
                                                        <p>${row.sale_price_type}</p> 
                                                        <span style="display:flex;"><p data-i18n="v_voucher_limit_price_01">· 바우처 대상 제품</p>&nbsp;${parseInt(row.min_price).toLocaleString('ko-KR')}<p data-i18n="v_voucher_limit_price_02">원 초과 구매 시 사용 가능</p></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            `;
                                $('.info__wrap.' + str).append(strDiv);
                                changeLanguageR();
                            }
                        })
                    }
                }
                else {
                    let err_str = '목록을 불러오지 못했습니다.';
                    if (d.msg != null) {
                        err_str = d.msg
                    }
                    exceptionHandling("바우처", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
                changeLanguageR();
            }
        });
    }
    function issueVoucherFormPrint() {
        $('#voucher_err_msg').hide();
    }
</script>