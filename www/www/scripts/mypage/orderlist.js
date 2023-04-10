$(document).ready(function () {
    getOrderInfoList('ALL');
    getOrderInfoList('OC');
    getOrderInfoList('OE');
    getOrderInfoList('OR');
});
// 주문, 취소, 교환, 반품 탭 
function viewOrderList(obj) {
    let action = $(obj).attr('action-type');
    $('#param_status').val(action);
    $('.orderlist__tab__wrap').hide();
    $('.tab_' + action).show();
    $('.order_list_' + action).show();
}
//주문건당 자세히보기 
function viewDetailOrder(order_idx) {
    let now = $('#param_status').val();
    $('.order_list_' + now).hide();
    $('.order__detail').show();

    getOrderInfo(order_idx);
}
// 결제 상태에따라서 데이터 불러오는 API
function getOrderInfoList(order_status) {
    $('#param_status').val(order_status);
    $.ajax({
        type: "post",
        url: "http://116.124.128.246:80/_api/mypage/order/list/get",
        data: {
            'order_status': order_status
        },
        dataType: "json",
        error: function (d) {
        },
        success: function (d) {
            if (d.code == 200) {
                let data = d.data;
                if (data != null) {
                    console.log(data);
                    setOrderInfoList(order_status, data);
                }
            }
        }
    });
}
//주문내역 그려주는 function 
function setOrderInfoList(param_status, data) {
    let order_list = $('.order_list_' + param_status);

    let div_list_pc = $('.w_view_' + param_status);
    div_list_pc.html('');

    let rows = order_list.find('input[name="rows"]').val();
    let page = order_list.find('input[name="page"]').val();

    let str_div = '';
    let slicedData = data.slice(parseInt(page - 1) * rows, rows * page);

    if (data.length == 0) {
        str_div =
            `<div class="orderlist__tab__contents">
                <div class="no_orderlist_msg" data-i18n="o_no_history_msg">주문 정보가 존재하지 않습니다.</div>
            </div>`;

        div_list_pc.append(str_div);
    } else {
        console.log("🏂 ~ file: orderlist.js:146 ~ slicedData:", slicedData)
        slicedData.forEach(function (row) {
            str_div += '<div class="orderlist__tab__contents">';
            str_div += '    <div class="contents__info">';
            str_div += '        <div class="info">';
            str_div += '            <span class="info__title" data-i18n="o_order_number">주문번호</span>';
            str_div += '            <span class="info__value order__code">' + row.order_code + '</span>';
            str_div += '        </div>';
            str_div += '        <div class="info">';
            str_div += '            <span class="info__title" data-i18n="o_order_date">주문일</span>';
            str_div += '            <span class="info__value">' + row.order_date + '</span>';
            str_div += '        </div>';
            str_div += '        <div class="detail__btn" onclick="viewDetailOrder(' + row.order_idx + ')"><span data-i18n="o_view_details">자세히보기</span></div>';
            str_div += '    </div>';
            str_div += '    <div class="contents__table">';
            str_div += '        <table>';
            str_div += '            <colsgroup>';
            str_div += '                <col style="width:120px;">';
            str_div += '                <col style="width:230px;">';
            str_div += '                <col style="width:120px;">';
            str_div += '                <col style="width:120px;">';
            str_div += '                <col style="width:120px;">';
            str_div += '                <col style="width:120px;">';
            str_div += '                <col style="width:190px;">';
            str_div += '            </colsgroup>';
            str_div += '            <tbody>';

            let order_product = row.order_product;
            order_product.forEach(function (product) {
                let order_status = product.order_status;
                let txt_order_status = getOrderStatus(order_status);

                let order_btn = "";
                let order_cancel_msg = "";

                let display = "";
                if (order_status == "PCP" || order_status == "PPR") {
                    display = "flex";
                    // data-i18n ="o_payment_complete";
                    order_btn = '<button class="order_status_box" data-i18n="o_canel_order" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'OCC\')">주문취소</button>';
                    order_cancel_msg = '<p class="order_cancel_msg">제품 준비 중 단계로 변경될 경우, 취소가 불가합니다.</p>';
                } else if (order_status == "DPR" || order_status == "DPG") {
                    display = "block";
                    order_btn = '<div class="delivery_num" style="margin-top:10px;"><p style="margin-bottom:3px;">' + row.company_name + '</p><p>652013628816</p></div>';
                } else if (order_status == "DCP") {
                    display = "flex";
                    order_btn += '<div style= "width: 75px; display: grid; justify-content: right;">';
                    order_btn += '    <button class="order_status_box" style="margin-bottom: 5px;" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'ORF\')">반품접수</button>';
                    order_btn += '    <button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'OEX\')">교환접수</button>';
                    order_btn += '</div>';
                    order_cancel_msg = '<p style="font-size: 10px; width: 110px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>';
                }

                str_div += '        <tr id="order_product_' + product.order_product_idx + '">';
                str_div += '            <td>';
                str_div += '                <img src=' + img_root + product.img_location + ' style="cursor: default;">';
                str_div += '            </td>';
                str_div += '            <td><p>' + product.product_name + '</p></td>';
                str_div += '            <td>';
                str_div += '                <div class="color_wrap">';
                str_div += '                    <p>' + product.color + '</p>';
                str_div += '                    <div class="color_chip" style="background-color: ' + product.color_rgb + '"></div>';
                str_div += '                </div>';
                str_div += '            </td>';
                str_div += '            <td><p>' + product.option_name + '</p></td>';
                str_div += '            <td><p>Qty: ' + product.product_qty + '</p></td>';
                str_div += '            <td><p>' + product.product_price + '</p></td>';
                str_div += '            <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                str_div += '                <div style="float:right;">';
                str_div += '                    <div style="display:' + display + ';align-items:center;margin-bottom:10px;line-height:0.3;">' + txt_order_status + order_btn + '</div>'
                str_div += '                    ' + order_cancel_msg;
                str_div += '                </div>';
                str_div += '            </td>'
                str_div += '        <tr>';
            });

            str_div += '            </tbody>';
            str_div += '        </table>';
            str_div += '    </div>';
            str_div += '</div>';
        });

        // div_list_pc.append(str_div);

        let totalCnt = data.length;
        let showing_page = Math.ceil(totalCnt / rows);

        orderListPaging({
            total: totalCnt,
            el: order_list.find('.orderlist__paging'),
            page: page,
            row: rows,
            show_paging: showing_page,
            use_form: order_list
        });
    }

}



function putOrderInfo(order_idx, order_product_idx, order_status) {
    let confirm_msg = "";
    if (order_status == "OCC") {
        confirm_msg = "선택한 주문을 취소하시겠습니까?";
    } else if (order_status == "OEX") {
        confirm_msg = "선택한 주문을 교환접수 하시겠습니까?";
    } else if (order_status == "ORF") {
        confirm_msg = "선택한 주문을 반품접수 하시겠습니까?";
    }

    if (confirm(confirm_msg) == true) {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/mypage/order/put",
            data: {
                'order_idx': order_idx,
                'order_product_idx': order_product_idx,
                'order_status': order_status,
            },
            dataType: "json",
            error: function (d) {
                alert('주문 상태변경 처리중 오류가 발생했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    getOrderInfoByIdx(order_idx, order_product_idx);
                    getOrderInfoList('OC');
                } else {
                    exceptionHandling("디자인 필요", d.msg);
                }
            }
        });
    }
}

function getOrderInfoByIdx(order_idx, order_product_idx) {
    $.ajax({
        type: "post",
        url: "http://116.124.128.246:80/_api/mypage/order/product/get",
        data: {
            'order_idx': order_idx,
            'order_product_idx': order_product_idx
        },
        dataType: "json",
        error: function (d) {
        },
        success: function (d) {
            if (d.code == 200) {
                let data = d.data;
                if (data != null) {
                    data.forEach(function (row) {
                    });
                }
            }
        }
    });
}

function getOrderInfo(order_idx) {
    $.ajax({
        type: "post",
        data: {
            "order_idx": order_idx
        },
        dataType: "json",
        url: "http://116.124.128.246:80/_api/mypage/order/get",
        error: function (d) {
        },
        success: function (d) {
            if (d.code == 200) {
                let data = d.data;
                if (data != null) {
                    setOrderInfo(data);
                }
            }
        }
    });
}

function setOrderInfo(data) {
    let param_status = $('#param_status').val();

    let div_list_pc = $('.w_detail_view_' + param_status);
    div_list_pc.html('');

    let str_div = "";
    data.forEach(function (row) {
        str_div += '<div class="orderlist__tab__contents">';
        str_div += '    <div class="title" style="margin-bottom: 30px;">';
        str_div += '        <p>주문 상세</p>';
        str_div += '    </div>';
        str_div += '    <div class="contents__info">';
        str_div += '        <div class="info">';
        str_div += '            <span class="info__title" data-i18n="o_order_number">주문번호</span>';
        str_div += '            <span class="info__value">' + row.order_code + '</span>';
        str_div += '        </div>';
        str_div += '        <div class="info">';
        str_div += '            <span class="info__title" data-i18n="o_order_date">주문일</span>';
        str_div += '            <span class="info__value">' + row.order_date + '</span>';
        str_div += '        </div>';
        str_div += '    </div>';
        str_div += '    <div class="contents__table" style="margin-top: 9.5px !important;">';
        str_div += '        <table>';
        str_div += '            <colsgroup>';
        str_div += '                <col style="width:120px;">';
        str_div += '                <col style="width:240px;">';
        str_div += '                <col style="width:130px;">';
        str_div += '                <col style="width:130px;">';
        str_div += '                <col style="width:130px;">';
        str_div += '                <col style="width:130px;">';
        str_div += '                <col style="width:120px;">';
        str_div += '            </colsgroup>';
        str_div += '            <tbody>';

        let order_product = row.order_product;
        order_product.forEach(function (product) {
            let order_status = product.order_status;
            let txt_order_status = getOrderStatus(order_status);

            let order_btn = "";
            let order_cancel_msg = "";

            if (order_status == "PCP") {
                order_btn = '<button class="order_status_box" data-i18n="o_canel_order" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'' + order_status + '\')">주문취소</button>';
                order_cancel_msg = '<p style="font-size: 10px; width: 110px;">제품 준비 중 단계로 변경될 경우, 취소가 불가합니다.</p>';
            } else if (order_status == "DPR" || order_status == "DCP") {
                display = "flex";
                order_btn += '<div style= "width: 75px; display: grid; justify-content: right;">';
                order_btn += '    <button class="order_status_box" style="margin-bottom: 5px;" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'ORF\')">반품접수</button>';
                order_btn += '    <button class="order_status_box" onclick="putOrderInfo(' + row.order_idx + ',' + product.order_product_idx + ',\'OEX\')">교환접수</button>';
                order_btn += '</div>';
                order_cancel_msg = '<p style="font-size: 10px; width: 110px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>';
            }

            str_div += '             <tr id="order_product_' + product.order_product_idx + '_detail">';
            str_div += '                 <td>';
            str_div += '                     <img src=' + img_root + product.img_location + ' style="cursor: default;">';
            str_div += '                 </td>';
            str_div += '                 <td>';
            str_div += '                     <p>' + product.product_name + '</p>';
            str_div += '                 </td>';
            str_div += '                 <td>';
            str_div += '                     <div class="color_wrap">';
            str_div += '                         <p>' + product.color + '</p>';
            str_div += '                         <div class="color_chip" style="background-color: ' + product.color_rgb + ';"></div>';
            str_div += '                     </div>';
            str_div += '                 </td>';
            str_div += '                 <td>';
            str_div += '                     <p>' + product.option_name + '</p>';
            str_div += '                 </td>';
            str_div += '                 <td>';
            str_div += '                     <p>Qty: ' + product.product_qty + '</p>';
            str_div += '                 </td>';
            str_div += '                 <td>';
            str_div += '                     <p>' + product.product_price + '</p>';
            str_div += '                 </td>';
            str_div += '                 <td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">';
            str_div += '                     <div style="padding-bottom:13px;">';
            str_div += '                         <div style="display:flex; align-items:center; margin-bottom:10px; line-height:0.3;">' + txt_order_status + order_btn + '</div>'
            str_div += '                     ' + order_cancel_msg;
            str_div += '                     </div>';
            str_div += '                 </td>';
            str_div += '             </tr>';
        });

        str_div += '             </tbody>';
        str_div += '        </table>';
        str_div += '    </div>';
        str_div += '    <div class="oderlist_info_table">';
        str_div += '        <div style="width:350px;">';
        str_div += '            <div class="title">';
        str_div += '                <p>배송정보</p>';
        str_div += '            </div>';
        str_div += '            <div class="contents__table">';
        str_div += '                <p>' + row.member_name + '</p>';
        str_div += '                <p>' + row.member_mobile + '</p>';
        str_div += '                <p>(' + row.to_zipcode + ')' + row.to_addr + ' ' + row.to_detail_addr + '</p>';
        str_div += '                <p>' + row.order_memo + '</p>';
        str_div += '            </div>';
        str_div += '        </div>';
        str_div += '        <div style="width:350px;">';
        str_div += '            <div class="title">';
        str_div += '                <p>결제정보</p>';
        str_div += '            </div>';
        str_div += '            <div class="oderlist_payment_info_border">';
        str_div += '                <div class="oderlist_payment_info">';
        str_div += '                    <p>제품합계</p>';
        str_div += '                    <p>' + row.price_product + '</p>';
        str_div += '                </div>';
        str_div += '                <div class="oderlist_payment_info">';
        str_div += '                    <p>배송비</p>';
        str_div += '                    <p>' + row.price_delivery + '</p>';
        str_div += '                </div>';
        str_div += '                <div class="oderlist_payment_info">';
        str_div += '                    <p>바우처</p>';
        str_div += '                    <p>' + row.price_discount + '</p>';
        str_div += '                </div>';
        str_div += '                <div class="oderlist_payment_info">';
        str_div += '                    <p>적립포인트</p>';
        str_div += '                    <p>' + row.price_mileage_point + '</p>';
        str_div += '                </div>';
        str_div += '            </div>';
        str_div += '            <div class="oderlist_payment_info" style="margin-top: 9.5px;">';
        str_div += '                <p>합계</p>';
        str_div += '                <p>' + row.price_total + '</p>';
        str_div += '            </div>';
        str_div += '        </div>';
        str_div += '    </div>';
        str_div += '    <div style="width:600px; margin-top: 90px;">';
        str_div += '        <div class="title_orderlist_info">';
        str_div += '            <p>주문 취소 안내</p>';
        str_div += '        </div>';
        str_div += '        <div class="list_orderlist_info">';
        str_div += `           <p>·&nbsp;'결제 완료' 단계에서만 취소가 가능합니다.</p>`;
        str_div += '            <p>·&nbsp;주문 취소는 [마이페이지 - 주문내역] 에서 직접 취소가 가능합니다.</p>';
        str_div += '        </div>';
        str_div += '        <div class="title_orderlist_info" style="margin-top: 50px !important;">';
        str_div += '            <p>교환 및 반품 안내</p>';
        str_div += '        </div>';
        str_div += '        <div class="list_orderlist_info">';
        str_div += '            <p>·&nbsp;교환 및 반품 접수는 제품 수령일로부터 7일 이내 신청 가능합니다.</p>';
        str_div += `            <p>·&nbsp;주문 상태가 '배송 완료' 일 경우, [마이페이지 - 주문내역] 에서 교환 및 반품 신청이 가능합니다.</p>`;
        str_div += `            <p class="underline">주문 상태가 '배송 중' 으로 보여질 경우, 1:1 문의를 통하여 접수 부탁드립니다.</p>`;
        str_div += '        </div>';
        str_div += '    </div>';
        str_div += '</div>';
    });

    div_list_pc.append(str_div);
    $('html, body').scrollTop(0);
}


//결제상태 리턴 
function getOrderStatus(param_status) {
    let order_status = "";
    switch (param_status) {
        case "PCP":
            order_status = '<div data-i18n="o_payment_complete">결제 완료</div>';
            break;

        case "PPR" || "POD":
            order_status = "제품 준비 중";
            break;

        case "DPR":
            order_status = "배송 준비 중";
            break;

        case "DPG":
            order_status = '<div data-i18n="o_shipped">배송 중</div>';
            break;

        case "DCP":
            order_status = '<div data-i18n="o_delivered">배송 완료</div>';
            break;

        case "OCC":
            order_status = '<div data-i18n="o_cancelled">취소 완료</div>';
            break;

        case "OEX":
            order_status = "주문교환";
            break;

        case "OEP":
            order_status = '<div data-i18n="o_exchanged">교환 완료</div>';
            break;

        case "ORF":
            order_status = "주문환불";
            break;

        case "ORP":
            order_status = "환불완료";
            break;
    }

    return order_status;
}

function orderListPaging(obj) {
    if (typeof obj != 'object' || 'total' in obj == false || 'el' in obj == false) {
        return;
    }

    if ('page' in obj == false) {
        obj.page = 1;
    }

    if ('row' in obj == false) {
        obj.row = 5;
    }

    if ('show_paging' in obj == false) {
        obj.show_paging = 4;
    }

    let total_page = Math.ceil(obj.total / obj.row);

    // 이전 페이징
    let prev = obj.page - obj.show_paging;
    if (prev < 1) {
        prev = 1;
    }

    // 다음 페이징
    let next = obj.page + obj.show_paging;
    if (next > total_page) {
        next = total_page;
    }

    // 페이지 시작 번호
    let start = obj.page - Math.ceil(obj.show_paging / 2) + 1;
    if (start < 1) {
        start = 1;
    }

    // 페이지 끝 번호
    let end = start + obj.show_paging - 1;
    if (end > total_page) {
        end = total_page;
        start = end - obj.show_paging + 1;

        if (start < 1) {
            start = 1;
        }
    }

    if (end < 1) {
        total_page = 1;
        end = 1;
        next = 1;
        prev = 1;
        start = 1;
    }

    let paging = [];
    for (let i = start; i <= end; i++) {
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
        let order_status = $('#param_status').val();
        $(obj.use_form).find('input[name="page"]').val(new_page);
        getOrderInfoList(order_status);
        $('html, body').scrollTop(0);
    });
}