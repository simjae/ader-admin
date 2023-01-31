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
    .orderlist__wrap .detail__btn {
        cursor : pointer;
    }
    .mypage--paging {
        gap: 10px;
    }
    .mypage--paging .page {
        font-size: 11px;
        cursor: pointer;
    }
</style>
<div class="orderlist__wrap">
    <div class="orderlist__tab__btn__container" onclick="viewOrderList()">
        <div class="tab__btn__item" onclick="getOrderInfoList()">
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
            <input type="hidden" name="rows" value="5">
            <input type="hidden" name="page" value="1">
            <div class="pc__view">
                <div class="orderlist__paging"></div>
            </div>
            <div class="mobile__view">
                <div class="orderlist__paging"></div>
            </div>
                <!-- <div class="orderlist__tab__contents">
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
                    </div> -->                
            </div>
        </div>
        <div class="orderlist__tab order__detail">
        </div>
    </div>
</div>
<script>
    function viewOrderList() {
        $('.orderlist__tab').hide();
        $('.orderlist__tab.order__list').show();
    }
    function viewDetailOrder(order_idx) {
        $('.orderlist__tab').hide();
        $('.orderlist__tab.order__detail').show();
        getOrderInfo(order_idx);
    }
    function getOrderInfoList() {
        // 일단 모든 주문 다 나오도록(플래그 구분 없이)orderlist__tab__contents
        let order_list = $('.order__list');
        let div_list_pc = $('.orderlist__tab .pc__view');
        let div_list_mobile = $('.orderlist__tab .mobile__view');
        let rows = order_list.find('input[name="rows"]').val();
        let page = order_list.find('input[name="page"]').val();
        $.ajax({
            type: "post",
            data:{
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/order/list/get",
            error: function(d) {
            },
            success: function(d) {
                if (d.code == 200) {
                    let data = d.data;
                    div_list_pc.html('');
                    div_list_mobile.html('');
                    if (data != null) {
                        let strDiv = '';
                        
                        let slicedData = data.slice(parseInt(page - 1) * rows, rows * page);
                        slicedData.forEach(function(row) {
                            strDiv += '<div class="orderlist__tab__contents">'
                            strDiv +=                '<div class="contents__info">'
                            strDiv +=                         '<div class="info">'
                            strDiv +=                             '<span class="info__title">주문번호</span>'
                            strDiv +=                             '<span class="info__value order__code">' + row.order_code + '</span>'
                            strDiv +=           '</div>'
                            strDiv +=           '<div class="info">'
                            strDiv +=               '<span class="info__title">주문일</span>'
                            strDiv +=               '<span class="info__value">' + row.order_date + '</span>'
                            strDiv +=           '</div>'
                            strDiv +=           '<div class="detail__btn" onclick="viewDetailOrder(' + row.order_idx + ')"><span>자세히보기</span></div>'
                            strDiv +=       '</div>'
                            strDiv +=       '<div class="contents__table">'
                            strDiv +=           '<table>'
                            strDiv +=               '<colsgroup>'
                            strDiv +=                   '<col style="width:120px;">'
                            strDiv +=                   '<col style="width:240px;">'
                            strDiv +=                   '<col style="width:130px;">'
                            strDiv +=                   '<col style="width:130px;">'
                            strDiv +=                   '<col style="width:130px;">'
                            strDiv +=                   '<col style="width:130px;">'
                            strDiv +=                   '<col style="width:120px;">'
                            strDiv +=               '</colsgroup>'
                            strDiv +=               '<tbody>'
                            let status = row.order_status;                     
                                for(let product of row.order_product) {
                                    strDiv +=                   '<tr>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<img src=' + img_root + product.img_location + ' style="cursor: default;">'
                                    strDiv +=                       '</td>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<p>' + product.product_name + '</p>'
                                    strDiv +=                       '</td>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<p>' + product.color + '</p>'
                                    strDiv +=                       '</td>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<p>' + product.option_name + '</p>'
                                    strDiv +=                       '</td>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<p>Qty:' + product.product_qty + '</p>'
                                    strDiv +=                       '</td>'
                                    strDiv +=                       '<td>'
                                    strDiv +=                           '<p>' + product.product_price.toLocaleString('ko-KR') + '</p>'
                                    strDiv +=                       '</td>'
                                    if(status == 'PCP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>결제완료<button class="order_status_box" onclick="">주문취소</button></p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                     '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'PPR') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>상품준비</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DPR') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>배송준비</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">' + row.company_name + '<br>652013628816</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DPG') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>배송중</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">' + row.company_name + '<br>652013628816</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DCP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        if(row.update_flg == 'FALSE') {
                                            strDiv +=                                         '<p>배송완료<button class="order_status_box" onclick="">반품접수</button></p>'
                                        } else {
                                            strDiv +=                                         '<p>배송완료</p>'
                                        }
                                        strDiv +=                                             '<p style="font-size: 10px; width: 110px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'POP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>프리오더 준비</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'POD') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>프리오더 상품 생산</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OCC') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 취소</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OEX') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 교환</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OEP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 교환 완료</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'ORF') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 환불</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'ORP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 환불 완료</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }                       
                            }
                            strDiv +=                         '</tbody>'
                            strDiv +=                     '</table>'
                            strDiv +=                '</div>'
                            strDiv +=             '</div>'
                        });
                        div_list_pc.append(strDiv);
                        div_list_mobile.append(strDiv);
                        let totalCnt = data.length;
                        let showing_page = Math.ceil(totalCnt/rows);
                        orderListPaging({
                            total: totalCnt,
                            el: order_list.find('.orderlist__paging'),
                            page: page,
                            row: rows,
                            show_paging: showing_page,
                            use_form: order_list
                        })
                    }
                }
            }
        });
    }

    function getOrderInfo(order_idx) {
        let div_list = $('.order__detail');
        $.ajax({
            type: "post",
            data:{
                "order_idx": order_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/order/get",
            error: function(d) {
            },
            success: function(d) {
                if (d.code == 200) {
                    let data = d.data;
            
                    div_list.html('');
            
                    if (data != null) {
                        let strDiv = '';
                        data.forEach(function(row) {
                            strDiv += '<div class="orderlist__tab__contents">'
                            strDiv +=            '<div class="title" style="margin-bottom: 30px;">'
                            strDiv +=                '<p>주문 상세</p>'
                            strDiv +=            '</div>'
                            strDiv +=            '<div class="contents__info">'
                            strDiv +=                '<div class="info">'
                            strDiv +=                    '<span class="info__title">주문번호</span>'
                            strDiv +=                    '<span class="info__value">' + row.order_code + '</span>'
                            strDiv +=                '</div>'
                            strDiv +=                '<div class="info">'
                            strDiv +=                   '<span class="info__title">주문일</span>'
                            strDiv +=                   '<span class="info__value">' + row.order_date + '</span>'
                            strDiv +=                '</div>'
                            strDiv +=           '</div>'
                            strDiv +=            '<div class="contents__table" style="margin-top: 9.5px !important;">'
                            strDiv +=                '<table>'
                            strDiv +=                    '<colsgroup>'
                            strDiv +=                        '<col style="width:120px;">'
                            strDiv +=                        '<col style="width:240px;">'
                            strDiv +=                        '<col style="width:130px;">'
                            strDiv +=                        '<col style="width:130px;">'
                            strDiv +=                        '<col style="width:130px;">'
                            strDiv +=                        '<col style="width:130px;">'
                            strDiv +=                        '<col style="width:120px;">'
                            strDiv +=                    '</colsgroup>'
                            strDiv +=                    '<tbody>'
                            let status = row.order_status;
                            for(let product of row.order_product) {
                                strDiv +=                        '<tr>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<img src=' + img_root + product.img_location + ' style="cursor: default;">'
                                strDiv +=                            '</td>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<p>' + product.product_name + '</p>'
                                strDiv +=                            '</td>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<p>' + product.color + '</p>'
                                strDiv +=                            '</td>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<p>' + product.option_name + '</p>'
                                strDiv +=                            '</td>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<p>Qty:' + product.product_qty + '</p>'
                                strDiv +=                            '</td>'
                                strDiv +=                            '<td>'
                                strDiv +=                                '<p>' + product.product_price.toLocaleString('ko-KR') + '</p>'
                                strDiv +=                            '</td>'
                                if(status == 'PCP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>결제완료<button class="order_status_box" onclick="">주문취소</button></p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                     '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'PPR') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>상품준비</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">배송준비 단계로 넘어가면<br>취소 불가합니다.</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DPR') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>배송준비</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">' + row.company_name + '<br>652013628816</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DPG') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>배송중</p>'
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">' + row.company_name + '<br>652013628816</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'DCP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        if(row.update_flg == 'FALSE') {
                                            strDiv +=                                         '<p>배송완료<button class="order_status_box" onclick="">반품접수</button></p>'
                                        } else {
                                            strDiv +=                                         '<p>배송완료</p>'
                                        }
                                        strDiv +=                                         '<p style="font-size: 10px; width: 110px;">반품접수는 제품 수령 후<br>7일 이내 가능합니다.</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'POP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>프리오더 준비</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'POD') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>프리오더 상품 생산</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OCC') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 취소</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OEX') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 교환</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'OEP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 교환 완료</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'ORF') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 환불</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                                    if(status == 'ORP') {
                                        strDiv +=                                 '<td style="padding-top: 10px !important; padding-right:0; margin: 0 auto;">'
                                        strDiv +=                                     '<div style="padding-bottom: 13px;">'
                                        strDiv +=                                         '<p>주문 환불 완료</p>'
                                        strDiv +=                                     '</div>'
                                        strDiv +=                                 '</td>'
                                        strDiv +=                             '</tr>'
                                    }
                            }
                            strDiv +=                    '</tbody>'
                            strDiv +=               '</table>'
                            strDiv +=            '</div>'
                            strDiv +=            '<div class="oderlist_info_table">'
                            strDiv +=                '<div style="width:350px;">'
                            strDiv +=                    '<div class="title">'
                            strDiv +=                        '<p>배송정보</p>'
                            strDiv +=                    '</div>'
                            strDiv +=                    '<div class="contents__table">'
                            strDiv +=                        '<p>' + row.member_name + '</p>'
                            strDiv +=                        '<p>' + row.member_mobile + '</p>'
                            strDiv +=                        '<p>(' + row.to_zipcode + ')' + row.to_addr + ' ' + row.to_detail_addr + '</p>'
                            strDiv +=                        '<p>' + row.order_memo + '</p>'
                            strDiv +=                   '</div>'
                            strDiv +=                '</div>'
                            strDiv +=                '<div style="width:350px;">'
                            strDiv +=                   '<div class="title">'
                            strDiv +=                        '<p>결제정보</p>'
                            strDiv +=                    '</div>'
                            strDiv +=                    '<div class="oderlist_payment_info_border">'
                            strDiv +=                        '<div class="oderlist_payment_info">'
                            strDiv +=                            '<p>제품합계</p>'
                            strDiv +=                            '<p>' + row.price_product.toLocaleString('ko-KR') + '</p>'
                            strDiv +=                        '</div>'
                            strDiv +=                        '<div class="oderlist_payment_info">'
                            strDiv +=                            '<p>배송비</p>'
                            strDiv +=                            '<p>' + row.price_delivery.toLocaleString('ko-KR') + '</p>'
                            strDiv +=                       '</div>'
                            strDiv +=                        '<div class="oderlist_payment_info">'
                            strDiv +=                           '<p>바우처</p>'
                            strDiv +=                           '<p>' + row.price_discount.toLocaleString('ko-KR') + '</p>'
                            strDiv +=                        '</div>'
                            strDiv +=                        '<div class="oderlist_payment_info">'
                            strDiv +=                           '<p>적립포인트</p>'
                            strDiv +=                           '<p>' + row.price_charge_point.toLocaleString('ko-KR') + '</p>'
                            strDiv +=                        '</div>'
                            strDiv +=                  '</div>'
                            strDiv +=                  '<div class="oderlist_payment_info" style="margin-top: 9.5px;">'
                            strDiv +=                      '<p>합계</p>'
                            strDiv +=                      '<p>' + row.price_total.toLocaleString('ko-KR') + '</p>'
                            strDiv +=                  '</div>'
                            strDiv +=               '</div>'
                            strDiv +=            '</div>'
                            strDiv +=         '<div style="width:600px; margin-top: 100px;">'
                            strDiv +=             '<div class="title_orderlist_info">'
                            strDiv +=                  '<p>주문 취소 안내</p>'
                            strDiv +=              '</div>'
                            strDiv +=              '<div class="list_orderlist_info">'
                            strDiv +=                  '<p>·&nbsp;주문 접수 및 결제 완료 단계: 주문내역에서 취소 가능합니다.</p>'
                            strDiv +=                  '<p>·&nbsp;배송 준비중 이후 단계: 주문취소 불가하며, 제품 수령 후 반품 진행 부탁드립니다.</p>'
                            strDiv +=              '</div>'
                            strDiv +=              '<div class="title_orderlist_info" style="margin-top: 50px !important;">'
                            strDiv +=                  '<p>반품 안내</p>'
                            strDiv +=              '</div>'
                            strDiv +=              '<div class="list_orderlist_info">'
                            strDiv +=                  '<p>·&nbsp;반품 접수는 제품 수령 후 7일 이내 가능합니다.</p>'
                            strDiv +=                  '<p>·&nbsp;주문 상태가 배송 완료일 경우 주문내역에서 반품 접수가능하며, 배송중으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍니다.</p>'
                            strDiv +=                  '<p class="underline">교환 및 반품 안내 바로 가기</p>'
                            strDiv +=              '</div>'
                            strDiv +=           '</div>'
                            strDiv +=         '</div>'
                        });
                        div_list.append(strDiv);
                    }
                }
            }
        });
    }
    function orderListPaging(obj) {
        if(typeof obj != 'object' || 'total' in obj == false || 'el' in obj == false) {
            return;
        }
        if('page' in obj == false) obj.page = 1;
        if('row' in obj == false) obj.row = 5;
        if('show_paging' in obj == false) obj.show_paging = 4;

        let total_page = Math.ceil(obj.total / obj.row);

        // 이전 페이징
        let prev = obj.page - obj.show_paging;
        if(prev < 1) prev = 1;
        // 다음 페이징
        let next = obj.page + obj.show_paging;
        if(next > total_page) next = total_page;
        // 페이지 시작 번호
        let start = obj.page - Math.ceil(obj.show_paging / 2) + 1;
        if(start < 1) start = 1;
        // 페이지 끝 번호
        let end = start + obj.show_paging - 1;
        if(end > total_page) {
            end = total_page;
            start = end - obj.show_paging + 1;
            if(start < 1) start = 1;
        }
        if(end < 1) {
            total_page = 1;
            end = 1;
            next = 1;
            prev = 1;
            start = 1;
        }
        let paging = [];
        for(let i = start; i <= end; i++) {
            paging.push(`<div class="page ${((i == obj.page) ? 'now' : '')}" data-page="${i}" style="${((i == obj.page) ? 'color: black' : 'color: #dcdcdc')}">${i}</div>`);
        }
        $(obj.el).html(`
            <div class="mypage--paging">
                <div class="page prev" data-page="${prev}"><</div>
				${paging.join("")}
				<div class="page next" data-page="${next}">></div>
			</div>
		`);
        $(obj.el).find(".mypage--paging .page").click(function() {
            var new_page = $(this).data("page");
            $(obj.use_form).find('input[name="page"]').val(new_page);
            getOrderInfoList();
        });
    }
</script>