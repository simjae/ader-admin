<style>
    .mileage__wrap {
        margin: 40px 0 100px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }

    .mileage__wrap table {
        width: 100%
    }

    .mileage__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        font-size: 11px;
        grid-template-columns: 50px 50px 50px 70px;
    }

    .mileage__notice__wrap .title {
        margin-bottom: 30px;
    }

    .mileage__wrap .title p {
        margin: 0;
        font-size: 13px !important;
    }

    .mileage__tab__wrap {
        grid-column: 1/17;
        margin: 0 auto;
        margin-top: 50px;
        width: 710px;
    }

    .mileage__tab__wrap .contents__table {
        border-top: none;
        border-bottom: none;
        margin-top: 40px;
        padding-top: 0;
    }

    .description.tab__total {
        padding-left: 6px;
        margin-top: 20px;
        margin-bottom: 60px;
    }

    .description.tab__notice {
        padding-left: 6px;
        margin-top: 40px;
        margin-bottom: 60px;
    }

    .mileage__tab__wrap table.border__bottom td {
        border-bottom: 1px solid #dcdcdc;
        padding: 20px 0 10px 0;
    }

    table.border__bottom__th {
        text-align: left;
    }

    table.border__bottom__th th {
        border-bottom: 1px solid #dcdcdc;
    }

    .mileage__table tr {
        height: 55px;
    }

    .mileage__table tbody p {
        margin-bottom: 0px;
    }

    .mileage__table thead p {
        margin-bottom: 0px;
    }

    @media (max-width: 1024px) {
        .mileage__wrap {
            margin: 20px 0 60px;
        }

        .mileage__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .notice_br {
            display: inline;
        }

        .mileage__wrap .title {
            margin-top: 0;
            font-size: 13px;
        }

        .mileage__tab__wrap .contents__table {
            margin-top: 30px;
        }

        .description.tab__notice {
            margin: 0;
        }
    }

    @media (min-width: 600px) {
        .mileage__tab__wrap {
            grid-column: 1/17;
            width: 580px;
            margin: 0 auto;
            margin-top: 40px;
        }
    }

    @media (min-width: 1024px) {
        .notice_br {
            display: none;
        }
    }

    .mileage__total__wrap .underline {
        width: 60px;
        word-break: break-all;
    }
</style>
<div class="mileage__wrap">
    <div class="mileage__tab__btn__container">
        <div class="tab__btn__item" form-id="mileage__total__wrap" onclick="mileageGetInfo('total')">
            <span>전체</span>
        </div>
        <div class="tab__btn__item" form-id="mileage__save__wrap" onclick="mileageGetInfo('save')">
            <span>적립</span>
        </div>
        <div class="tab__btn__item" form-id="mileage__use__wrap" onclick="mileageGetInfo('use')">
            <span>사용</span>
        </div>
        <div class="tab__btn__item" form-id="mileage__notice__wrap">
            <span>유의사항</span>
        </div>
    </div>
    <div class="mileage__tab__wrap">
        <div class="mileage__tab mileage__total__wrap">
            <div class="title">
                <p>적립포인트 현황</p>
            </div>
            <div class="contents__table bluemark total">
                <table class="border__bottom__th" style="width:100%">
                    <colsgroup>
                        <col style="width:240px;">
                        <col style="width:240px;">
                        <col style="width:230px;">
                    </colsgroup>
                    <thead>
                        <th>
                            <p>현재 적립포인트</p>
                        </th>
                        <th>
                            <p>사용된 포인트</p>
                        </th>
                        <th>
                            <p>환불예정 포인트</p>
                        </th>
                    </thead>
                    <tbody id="mileage_summary_table">
                        <td id="mileage_point">
                            <p>0</p>
                        </td>
                        <td id="uesd_mileage">
                            <p>0</p>
                        </td>
                        <td id="refund_scheduled">
                            <p>0</p>
                        </td>
                    </tbody>
                </table>
            </div>
            <div class="description tab__total">
                <p>·&nbsp;주문으로 발생한 적립금은 배송완료 후 7일 부터 실제 사용 가능한 <br class="notice_br">적립금으로 전환됩니다.</p>
                <p>·&nbsp;적립 포인트의 적립, 사용은 ADER 자사제품에 한하여 사용가능합니다.</p>
                <p>·&nbsp;적립 포인트는 1,000단위로 사용하실 수 있습니다.</p>
                <p>·&nbsp;적립 포인트는 바우처와 함께 사용하실 수 없습니다.</p>
            </div>
            <div class="contents__table bluemark all_list">
                <form id="frm-mileage-total-list">
                    <input type="hidden" name="rows" value="10">
                    <input type="hidden" name="page" value="1">
                    <input type="hidden" name="list_type" value="total">
                    <div class="pc__view">
                        <table class="border__bottom border__bottom__th">
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
                            <tbody id="mileage_total_result">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                    <div class="mobile__view">
                        <table class="border__bottom border__bottom__th">
                            <colsgroup>
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                            </colsgroup>
                            <thead>
                                <th>
                                    <p>주문번호</p>
                                </th>
                                <th>
                                    <p>일자</p>
                                </th>
                                <th>
                                    <p>내용</p>
                                </th>
                                <th>
                                    <p>포인트</p>
                                </th>
                            </thead>
                            <tbody id="mileage_total_result_mobile">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mileage__tab mileage__save__wrap">
            <div class="title">
                <p>적립된 포인트</p>
            </div>
            <form id="frm-mileage-save-list">
                <input type="hidden" name="rows" value="10">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="list_type" value="save">
                <div class="contents__table">
                    <div class="pc__view">
                        <table class="border__bottom border__bottom__th">
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
                            <tbody id="mileage_save_result">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                    <div class="mobile__view">
                        <table class="border__bottom border__bottom__th">
                            <colsgroup>
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                            </colsgroup>
                            <thead>
                                <th>
                                    <p>주문번호</p>
                                </th>
                                <th>
                                    <p>일자</p>
                                </th>
                                <th>
                                    <p>내용</p>
                                </th>
                                <th>
                                    <p>포인트</p>
                                </th>
                            </thead>
                            <tbody id="mileage_save_result_mobile">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                </div>
                </from>
        </div>
        <div class="mileage__tab mileage__use__wrap">
            <div class="title">
                <p>사용된 포인트</p>
            </div>
            <form id="frm-mileage-use-list">
                <input type="hidden" name="rows" value="10">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="list_type" value="use">
                <div class="contents__table">
                    <div class="pc__view">
                        <table class="border__bottom border__bottom__th">
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
                            <tbody id="mileage_use_result">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                    <div class="mobile__view">
                        <table class="border__bottom border__bottom__th">
                            <colsgroup>
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                                <col style="width:25%;">
                            </colsgroup>
                            <thead>
                                <th>
                                    <p>주문번호</p>
                                </th>
                                <th>
                                    <p>일자</p>
                                </th>
                                <th>
                                    <p>내용</p>
                                </th>
                                <th>
                                    <p>포인트</p>
                                </th>
                            </thead>
                            <tbody id="mileage_use_result_mobile">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="mileage__tab mileage__notice__wrap">
            <div class='title'>
                <p>적립포인트 유의사항</p>
            </div>
            <div class='description tab__notice'>
                <p>·&nbsp;주문으로 발생한 적립금은 배송완료 후 7일 부터 실제 사용 가능한 <br class="notice_br">적립금으로 전환됩니다.</p>
                <p>·&nbsp;적립 포인트의 적립, 사용은 ADER 자사제품에 한하여 사용가능합니다.</p>
                <p>·&nbsp;적립 포인트는 1,000단위로 사용하실 수 있습니다.</p>
                <p>·&nbsp;적립 포인트는 바우처와 함께 사용하실 수 없습니다.</p>
            </div>
        </div>
    </div>
</div>
<script>
    $('.mileage__alarm__wrap').hide();
    $('.mileage__cancel__wrap').hide();

    function mileageGetInfo(str) {
        var list_type = str;
        var country = 'KR';

        if (str == 'total') {
            mileageGetSummary();
        }
        var use_form = $('#frm-mileage-' + str + '-list');

        var result_table = $('#mileage_' + list_type + '_result');
        var result_table_mobile = $('#mileage_' + list_type + '_result_mobile')

        result_table.html('');
        result_table_mobile.html('');
        result_table.html(`
    <tr>
        <td colspan="6" style="text-align:center">
            <p>조회결과가 없습니다.</p>
        </td>
    </tr>
    `);
        result_table_mobile.html(`
    <tr>
        <td colspan="4" style="text-align:center">
            <p>조회결과가 없습니다.</p>
        </td>
    </tr>
    `);

        var rows = use_form.find('input[name="rows"]').val();
        var page = use_form.find('input[name="page"]').val();

        if (rows == null) {
            rows = 10;
        }
        if (page == null) {
            page = 1;
        }
        $.ajax({
            type: "post",
            data: {
                'country': 'KR',
                'list_type': str,
                'rows': rows,
                'page': page
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/mileage/list/get",
            error: function (d) {
                exceptionHandling("마일리지", '마일리지 정보조회에 실패했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('#mileage_' + list_type + '_result').html('');
                        $('#mileage_' + list_type + '_result_mobile').html('');

                        d.data.forEach(function (row) {
                            var price_str = '';

                            var mileage_usable_inc = parseInt(row.mileage_usable_inc);
                            var mileage_usable_dec = parseInt(row.mileage_usable_dec);

                            var mileage_usable_val = mileage_usable_inc - mileage_usable_dec;
                            var mileage_usable_str = mileage_usable_val.toLocaleString('ko-KR');
                            if (mileage_usable_val > 0) {
                                mileage_usable_str = '+ ' + mileage_usable_str;
                            }
                            else if (mileage_usable_val < 0) {
                                mileage_usable_str = '- ' + mileage_usable_str;
                            }

                            if (row.price_total != "") {
                                row.price_total = parseInt(row.price_total).toLocaleString('ko-KR');
                            }

                            var strDiv =
                                `
                            <tr>
                                <td>
                                    <p>${row.update_date}</p>
                                </td>
                                <td>
                                    <p class="underline">${row.order_code}</p>
                                </td>
                                <td>
                                    <p>${row.mileage_type}</p>
                                </td>
                                <td>
                                    <p>${row.price_total}</p>
                                </td>
                                <td>
                                    <p>+ ${parseInt(row.mileage_usable_inc).toLocaleString('ko-KR')}</p>
                                </td>
                                <td>
                                    <p>${parseInt(row.mileage_usable_dec).toLocaleString('ko-KR')}</p>
                                </td>
                            </tr> 
                        `;
                            $('#mileage_' + list_type + '_result').append(strDiv);

                            var strMobileDiv =
                                `
                            <tr>
                                <td>
                                    <p class="underline">${row.order_code}</p>
                                </td>
                                <td>
                                    <p>${row.update_date}</p>
                                </td>
                                <td>
                                    <p>${row.mileage_type}</p>
                                </td>
                                <td>
                                    <p>${mileage_usable_str}</p>
                                </td>
                            </tr> 
                        `;
                            $('#mileage_' + list_type + '_result_mobile').append(strMobileDiv);

                            var showing_page = Math.ceil(d.total / rows);
                            mypagePaging({
                                total: d.total,
                                el: use_form.find(".mypage__paging"),
                                page: page,
                                row: rows,
                                show_paging: showing_page,
                                use_form: use_form,
                                list_type: str
                            });
                        })
                    }
                }
                else {
                    let err_str = '마일리지 정보조회에 실패했습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("마일리지", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        });
    }

    function mileageGetSummary() {
        $.ajax({
            type: "post",
            data: { 'country': 'KR' },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/mileage/get",
            error: function (d) {
                exceptionHandling("마일리지", '마일리지 정보조회에 실패했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null) {
                        var data = d.data;

                        var mileage_point
                        var uesd_mileage
                        var refund_scheduled
                        $('#mileage_point').find('p').text(parseInt(data.mileage_balance).toLocaleString('ko-KR'));
                        $('#uesd_mileage').find('p').text(parseInt(data.refund_scheduled).toLocaleString('ko-KR'));
                        $('#refund_scheduled').find('p').text(parseInt(data.used_mileage).toLocaleString('ko-KR'));
                    }
                }
                else {
                    let err_str = '마일리지 정보조회에 실패했습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("마일리지", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        });
    }

    function mypagePaging(obj) {
        if (typeof obj != 'object' || 'total' in obj == false || 'el' in obj == false) {
            return;
        }
        if ('page' in obj == false) obj.page = 1;
        if ('row' in obj == false) obj.row = 10;
        if ('show_paging' in obj == false) obj.show_paging = 9;

        let total_page = Math.ceil(obj.total / obj.row);

        // 이전 페이징
        let prev = obj.page - obj.show_paging;
        if (prev < 1) prev = 1;

        // 다음 페이징
        let next = obj.page + obj.show_paging;
        if (next > total_page) next = total_page;

        // 페이지 시작 번호
        let start = obj.page - Math.ceil(obj.show_paging / 2) + 1;
        if (start < 1) start = 1;

        // 페이지 끝 번호
        let end = start + obj.show_paging - 1;
        if (end > total_page) {
            end = total_page;
            start = end - obj.show_paging + 1;
            if (start < 1) start = 1;
        }
        if (end < 1) {
            total_page = 1;
            end = 1;
            next = 1;
            prev = 1;
            start = 1;
        }
        let paging = [];
        for (var i = start; i <= end; i++) {
            paging.push(`<div class="page ${((i == obj.page) ? 'now' : '')}" data-page="${i}" style="${((i == obj.page) ? 'color: black' : 'color: #dcdcdc')}">${i}</div>`);
        }
        $(obj.el).html(`
            <div class="mypage--paging">
                <div class="page prev" data-page="${prev}" style="${((obj.page == 1) ? 'color: #dcdcdc' : 'color: black')}"><</div>
                ${paging.join("")}
                <div class="page next" data-page="${next}" style="${((obj.page == end) ? 'color: #dcdcdc' : 'color: black')}">></div>
            </div>
        `);
        $(obj.el).find(".mypage--paging .page").click(function () {
            var new_page = $(this).data("page");
            $(obj.use_form).find('input[name="page"]').val(new_page);
            mileageGetInfo(obj.list_type);
        });
    }
</script>