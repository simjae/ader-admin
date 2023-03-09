<style>
    .reorder__wrap {
        margin-top: 40px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    .reorder__wrap .title p{
        font-size: 13px;
    }
    .reorder__wrap .title {
        margin-bottom: 10px;
    }

    .reorder__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        grid-template-columns: 70px 70px 70px;
        font-size: 11px;
    }

    .reorder__tab__wrap {
        grid-column: 1/17;
        width: 470px;
        margin: 0 auto;
    }

    .reorder__tab__wrap .contents__table {
        border-bottom: none;
        margin-top: 30px !important;
    }

    .reorder__tab__wrap .contents__table p {
        margin-bottom: 0px;
    }

    table.border__bottom td {
        border-bottom: 1px solid #dcdcdc;
        padding-right: 0px;
    }

    .reorder__tab__wrap .footer {
        margin-bottom: 100px;
    }

    #alarm_reorder_result_table p {
        margin-bottom: 10px;
    }

    .color_wrap {
        display: flex;
    }

    .color_chip {
        width: 6px;
        height: 6px;
        margin: 3px 5px 6px 3px;
        object-fit: contain;
        border-radius: 3px;
    }

    .text__btn__area {
        display: flex;
        align-items: center;
    }

    .text__btn__area.mobile {
        display: block;
        width: 56px;
        text-align: center;
    }

    .text__btn__area.mobile.cancel {
        display: grid;
    }

    .reorder__apply__wrap .description {
        padding-left: 6px;
    }

    .reorder_reapply_btn {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #808080;
        cursor: pointer;
        height: 23px;
        margin-left: 10px;
    }

    @media (max-width: 1024px) {
        .reorder__wrap {
            width: 100%;
            margin-top: 20px;
        }

        .reorder__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .description.reorder__apply_pc {
            display: none;
        }

        .description.reorder__apply_mobile {
            display: block;
            margin-bottom: 30px;
        }

        .reorder__tab__wrap .contents__table p {
            margin-bottom: 6px
        }

        .reorder__tab__wrap .contents__table {
            border-bottom: none;
            margin-top: 30px !important;
        }

        .reorder_reapply_btn {
            margin-left: 0;
        }

        .text__btn__area.mobile.cancel {
            display: grid;
            justify-items: center;
        }
        .reorder__wrap .title {margin-top: 0;}
    }

    @media (min-width: 600px) {
        .reorder__tab__wrap {
            width: 580px;
            margin: 0 auto;
            margin-top: 40px;
        }
    }

    @media (min-width: 1024px) {
        .reorder__tab__wrap {
            width: 710px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .description.reorder__apply_pc {
            display: block;
            margin-bottom: 39.5px;
        }

        .description.reorder__apply_mobile {
            display: none;
        }
    }
</style>

<div class="reorder__wrap">
    <div class="reorder__tab__btn__container">
        <div class="tab__btn__item" form-id="reorder__apply__wrap" onclick="getreorderList('apply')">
            <span>신청완료</span>
        </div>
        <div class="tab__btn__item" form-id="reorder__alarm__wrap" onclick="getreorderList('alarm')">
            <span>알림완료</span>
        </div>
        <div class="tab__btn__item" form-id="reorder__cancel__wrap" onclick="getreorderList('cancel')">
            <span>취소완료</span>
        </div>
    </div>
    <div class="reorder__tab__wrap">
        <div class="reorder__tab reorder__apply__wrap">
            <div class="title">
                <p>재입고알림 신청내역</p>
            </div>
            <div class="description reorder__apply_pc">
                <p>·&nbsp;해당제품이 재입고되면 메시지를 발송해드립니다.</p>
                <p>·&nbsp;스팸메시지로 등록 시 SMS 발송이 제한될 수 있습니다.</p>
                <p>·&nbsp;재입고알림을 신청하시면 회원님의 SMS 수신 동의여부와 관계없이 발송됩니다.</p>
            </div>
            <div class="description reorder__apply_mobile">
                <p>·&nbsp;해당제품이 재입고되면 메시지를 발송해드립니다.</p>
                <p>·&nbsp;스팸메시지로 등록 시 SMS 발송이 제한될 수 있습니다.</p>
                <p>·&nbsp;재입고알림을 신청하시면 회원님의 SMS 수신 동의여부와<br> 관계없이 발송됩니다.</p>
            </div>
            <form id="frm-reorder-list">
                <input type="hidden" name="rows" value="10">
                <input type="hidden" name="page" value="1">
                <div class="contents__table" style="padding: 0;">
                    <div class="pc__view">
                        <table class="border__bottom">
                            <colsgroup>
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:120px;">
                                <col style="width:110px;">
                            </colsgroup>
                            <tbody id="apply_reorder_result_table" class="reorder__result__table">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                    <div class="mobile__view">
                        <table class="border__bottom">
                            <colsgroup>
                                <col style="width:27%;">
                                <col style="width:27%;">
                                <col style="width:20%;">
                                <col style="width:26%;">
                            </colsgroup>
                            <tbody id="apply_reorder_result_table_mobile" class="reorder__result__table">
                            </tbody>
                        </table>
                        <div class="mypage__paging"></div>
                    </div>
                </div>
            </form>
            <div class="footer"></div>
        </div>
        <div class="reorder__tab reorder__alarm__wrap">
            <div class="title">
                <p>재입고알림 완료내역</p>
            </div>
            <div class="contents__table">
                <div class="pc__view">
                    <table class="border__bottom">
                        <colsgroup>
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:110px;">
                        </colsgroup>
                        <tbody id="alarm_reorder_result_table" class="reorder__result__table">
                        </tbody>
                    </table>
                </div>
                <div class="mobile__view">
                    <table class="border__bottom">
                        <colsgroup>
                            <col style="width:27%;">
                            <col style="width:27%;">
                            <col style="width:20%;">
                            <col style="width:26%;">
                        </colsgroup>
                        <tbody id="alarm_reorder_result_table_mobile" class="reorder__result__table">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        <div class="reorder__tab reorder__cancel__wrap">
            <div class="title">
                <p>재입고알림 취소내역</p>
            </div>
            <div class="contents__table">
                <div class="pc__view">
                    <table class="border__bottom">
                        <colsgroup>
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:120px;">
                            <col style="width:110px;">
                        </colsgroup>
                        <tbody id="cancel_reorder_result_table" class="reorder__result__table">
                        </tbody>
                    </table>
                </div>
                <div class="mobile__view">
                    <table class="border__bottom">
                        <colsgroup>
                            <col style="width:27%;">
                            <col style="width:27%;">
                            <col style="width:20%;">
                            <col style="width:26%;">
                        </colsgroup>
                        <tbody id="cancel_reorder_result_table_mobile" class="reorder__result__table">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
    $('.reorder__alarm__wrap').hide();
    $('.reorder__cancel__wrap').hide();

    function getreorderList(str) {
        var country = 'KR';
        var use_form = $('#frm-reorder-list');
        var list_type = str
        var table_id = list_type + '_reorder_result_table';
        var mobile_table_id = list_type + '_reorder_result_table_mobile';

        $('#' + table_id).html('');
        $('#' + table_id).html(`
        <tr>
            <td colspan="6" style="text-align:center">
                <p>조회결과가 없습니다.</p>
            </td>
        </tr>
    `);

        $('#' + mobile_table_id).html('');
        $('#' + mobile_table_id).html(`
        <tr>
            <td colspan="4" style="text-align:center">
                <p>조회결과가 없습니다.</p>
            </td>
        </tr>
    `);
        var rows = use_form.find('input[name="rows"]').val();
        var page = use_form.find('input[name="page"]').val();

        var param = {};
        param = {
            'country': country,
            'list_type': list_type
        };
        if (list_type == 'apply') {
            param.rows = rows;
            param.page = page;
        }

        $.ajax({
            type: "post",
            data: param,
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/reorder/get",
            error: function (d) {
                exceptionHandling("리오더", "재주문 목록을 불러오지 못했습니다.");
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.reorder__result__table').html('');
                        d.data.forEach(function (row) {
                            var text_btn_area = '<div class="text__btn__area"> ';
                            var text_btn_area_mobile = '<div class="text__btn__area mobile cancel"> ';
                            var strBtn = '';
                            switch (list_type) {
                                case 'apply':
                                    strBtn = `
                                        <p>신청완료</p>
                                        <div class="reorder_reapply_btn" style="width: 56px;" no="${row.reorder_idx}" action-type="cancel" onclick="reorderBtnAction(this)">신청취소</div>
                                    </div>
                                `;

                                    break;
                                case 'alarm':
                                    strBtn = `
                                        <p>알림완료</p>
                                        <p>${row.update_date}</p>
                                `;
                                    text_btn_area = '';
                                    text_btn_area_mobile = '';
                                    break;
                                case 'cancel':
                                    strBtn = `
                                        <p>취소완료</p>
                                        <div class="reorder_reapply_btn" style="width: 48px;" no="${row.reorder_idx}" action-type="re_apply" onclick="reorderBtnAction(this)">재신청</div>
                                    </div>
                                `;

                                    break;
                            }
                            var img_location = 'http://116.124.128.246:81' + row.img_location;
                            var strDiv = `
                            <tr>
                                <td>
                                    <img src="${img_location}">
                                </td>
                                <td>
                                    <p>${row.product_name}</p>
                                </td>
                                <td>
                                    <div class="color_wrap">
                                        <p>${row.color}</p>
                                        <div class="color_chip" style="background-color:${row.color_rgb}"></div>
                                    </div>
                                </td>
                                <td>
                                    <p>${row.option_name}</p>
                                </td>
                                <td>
                                    <p>${parseInt(row.sales_price_kr).toLocaleString('ko-KR')}</p>
                                </td>
                                <td>
                                    ${text_btn_area}
                                    ${strBtn}
                                </td>
                            </tr>
                        `;
                            $('#' + table_id).append(strDiv);

                            strDivMobile = `
                            <tr>
                                <td>
                                    <img src="${img_location}" style="object-fit:contain">
                                </td>
                                <td class="vertical__top">
                                    <p style="white-space:nowrap;">${row.product_name}</p>
                                    <p>${parseInt(row.sales_price_kr).toLocaleString('ko-KR')}</p>
                                    <div class="color_wrap">
                                        <p>${row.color}</p>
                                        <div class="color_chip" style="background-color:${row.color_rgb}"></div>
                                    </div>
                                    <p>${row.option_name}</p>
                                </td>
                                <td>
                                    <p>Qty: 1</p>
                                </td>
                                <td>
                                    ${text_btn_area_mobile}
                                    ${strBtn}
                                </td>
                            </tr>
                        `;
                            $('#' + mobile_table_id).append(strDivMobile);

                            if (list_type == 'apply') {
                                var showing_page = Math.ceil(d.total / rows);
                                reorderPaging({
                                    total: d.total,
                                    el: use_form.find(".mypage__paging"),
                                    page: page,
                                    row: rows,
                                    show_paging: showing_page,
                                    use_form: use_form,
                                    list_type: list_type
                                });
                            }
                        })
                    }
                }
                else {
                    let err_str = '재주문 목록을 불러오지 못했습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("리오더", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        });
    }

    function reorderBtnAction(obj) {
        var action_type = $(obj).attr('action-type');
        var no = $(obj).attr('no');
        var country = 'KR';

        $.ajax({
            type: "post",
            data: {
                'country': country,
                'no': no,
                'action_type': action_type
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/reorder/put",
            error: function (d) {
            },
            success: function (d) {
            }
        });
        var seq = 0;
        switch (action_type) {
            case 'cancel':
                seq = 0;
                break;
            case 're_apply':
                seq = 2;
                break;
        }
        $('.reorder__wrap').find('.tab__btn__item').eq(seq).click();
    }
    function reorderPaging(obj) {
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
            paging.push(`<div class="page ${((i == obj.page) ? 'now' : '')}" data-page="${i}">${i}</div>`);
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
            getreorderList(obj.list_type);
        });
    }
</script>