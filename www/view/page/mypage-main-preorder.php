<style>
    .preorder__wrap {
        margin-top: 40px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }

    .preorder__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        grid-template-columns: 70px 70px 70px;
        font-size: 11px;
    }

    .preorder__tab__wrap {
        grid-column: 1/17;
        width: 950px;
        margin: 0 auto;
    }

    .preorder__apply__form__wrap {
        width: 710px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .preorder__result__form__wrap {
        width: 950px;
        margin: 0 auto;
    }

    .preorder__notice__wrap {
        width: 470px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .preorder__notice__wrap .title {
        margin-bottom: 10px;
    }

    .preorder__container {
        margin: 0 auto;
        width: 100%;
        display: grid;
        gap: 10px;
        place-items: center;
        align-items: start;
        grid-template-columns: 1fr 1fr 1fr;
    }

    .preorder__item {
        width: 100%;
        padding-top: 30px;
    }

    .preorder__item img {
        width: 100%;
        image-rendering: -webkit-optimize-contrast;
        transform: translateZ(0);
        backface-visibility: hidden;
    }

    .preorder__item .item__title {
        margin-top: 15px;
        font-size: 13px;
        font-family: var(--ft-no-fu);
    }

    .preorder__item .item__description {
        margin-top: 3.5px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
    }

    .preorder__item .item__status {
        margin-top: 14.5px;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        margin-bottom: 20px;
    }

    .preorder__wrap .contents__table {
        margin-top: 6px;
        padding-top: 0;
    }

    .preorder__wrap .footer {
        margin-bottom: 100px;
    }

    .date__cols__title {
        margin-top: 10px;
    }

    .date__cols__info {
        margin-top: 40px;
    }

    .preorder__tab__contents img {
        width: 100%;
        min-width: 80px;
    }
    .preorder__apply__form__wrap .description,.preorder__notice__wrap .description {
        padding-left: 6px;
    }

    @media (max-width: 1024px) {
        .preorder__tab__wrap {
            grid-column: 1/17;
            width: 100%;
        }
        .preorder__wrap {
            margin-top: 20px;
        }

        .preorder__tab__wrap .contents__info .info span {
            font-size: 11px;
        }

        .preorder__apply__form__wrap {
            grid-column: 1/9;
            width: 100%;
        }

        .preorder__result__form__wrap {
            grid-column: 1/9;
            width: 100%;
        }

        .preorder__notice__wrap {
            grid-column: 1/9;
            width: 100%;
        }

        .preorder__result__form__wrap {
            width: 100%
        }

        .preorder__apply__form__wrap {
            width: 100%;
            margin-top: 40px;
        }

        .preorder__notice__wrap {
            width: 100%;
            margin-top: 40px;
        }

        .preorder__container {
            margin: 0 auto;
            width: 100%;
            gap: 10px;
            display: grid;
            place-items: center;
            grid-template-columns: repeat(2, 1fr);
        }

        .preorder__notice__wrap {
            width: 100%
        }

        .detail__info {
            font-size: 10px;
        }

        .preorder__tab__contents {
            padding-top: 40px;
            padding-bottom: 10px;
        }

        .preorder__tab__contents .contents__info {
            height: 16px;
            font-size: 11px;
            white-space: nowrap;
        }

        .preorder__tab__contents .info__title {
            margin-right: 10px;
        }

        .preorder__tab__contents .info__value {
            margin-right: 20px;
        }
    }

    @media (min-width: 600px) {
        .preorder__tab__wrap {
            grid-column: 1/17;
            width: 580px;
            margin: 0 auto;
        }
    }

    @media (min-width: 1024px) {
        .preorder__tab__wrap {
            grid-column: 1/17;
            width: 950px;
            margin: 0 auto;
        }

        .preorder__tab__contents {
            padding-top: 50px;
            padding-bottom: 50px;
        }
    }

    .preorder__apply__form__wrap .title {
        margin-bottom: 10px;
    }

    .preorder_product_name {
        width: 68px;
        height: 11px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .preorder_info_mob p {
        margin-bottom: 6px;
    }
</style>
<div class="preorder__wrap">
    <div class="preorder__tab__btn__container">
        <div class="tab__btn__item" form-id="preorder__apply__form__wrap" onclick="getTotalPreorder()">
            <span>신청하기</span>
        </div>
        <div class="tab__btn__item" form-id="preorder__result__form__wrap" onclick="getEntryPreorder()">
            <span>신청내역</span>
        </div>
        <div class="tab__btn__item" form-id="preorder__notice__wrap">
            <span>유의사항</span>
        </div>
    </div>
    <div class="preorder__tab__wrap">
        <div class="preorder__tab preorder__apply__form__wrap">
            <div class="title">
                <p>프리오더 신청하기</p>
            </div>
            <div class="description">
                <div class="pc__view">
                    <p>·&nbsp;프리오더 제품은 정해진 기간에만 주문 가능합니다. 제품별 주문 가능 기간을 확인해주세요.</p>
                    <p>·&nbsp;주문 취소 및 사이즈 교환은 프리오더 기간 내에만 가능합니다.<br>
                        단, 사이즈 교환은 재고가 있는 제품에 한하여 처리 가능합니다.</p>
                    <p>·&nbsp;주문과 동시에 배송되는 제품이 아니니 유의해주세요.</p>
                    <p>·&nbsp;재고 소진 시, 프리오더 신청이 조기 종료될 수 있습니다.</p>
                    <p>·&nbsp;프리오더 제품은 충전 포인트로 결제 가능합니다.</p>
                </div>
                <div class="mobile__view">
                    <p>·&nbsp;프리오더 제품은 정해진 기간에만 주문 가능합니다.<br>
                        제품별 주문 가능 기간을 확인해주세요.</p>
                    <p>·&nbsp;주문 취소 및 사이즈 교환은 프리오더 기간 내에만 가능합니다.<br>
                        단, 사이즈 교환은 재고가 있는 제품에 한하여 처리 가능합니다.</p>
                    <p>·&nbsp;주문과 동시에 배송되는 제품이 아니니 유의해주세요.</p>
                    <p>·&nbsp;재고 소진 시, 프리오더 신청이 조기 종료될 수 있습니다.</p>
                    <p>·&nbsp;프리오더 제품은 충전 포인트로 결제 가능합니다.</p>
                </div>
            </div>
            <div class="info__wrap">
                <div class="preorder__container">
                </div>
            </div>
            <div class="footer"></div>
        </div>

        <div class="preorder__tab preorder__result__form__wrap">
            <div class="info__wrap">
                <div class="pc__view">

                </div>
                <div class="mobile__view">

                </div>
            </div>
            <div class="footer"></div>
        </div>

        <div class="preorder__tab preorder__notice__wrap">
            <div class="title">
                <p>프리오더 유의사항</p>
            </div>
            <div class="description">
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
    $('.preorder__result__form__wrap').hide();
    $('.preorder__notice__wrap').hide();

    function getTotalPreorder() {
        $('.preorder__container').html('');
        $.ajax({
            url: config.api + "mypage/preorder/list/get",
            type: "post",
            data: {},
            dataType: "json",
            error: function () {
                alert('스탠바이 등록 처리중 오류가 발생했습니다.');
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    $('.preorder__container').html('');
                    var data = d.data;
                    if (data != null && data.length > 0) {
                        data.forEach(function (row) {
                            var usable_class = '';
                            if (row.entry_status == '종료') {
                                usable_class = 'non__usable__info'
                            }


                            var entry_date_str = '';
                            if (row.entry_status == 'Comming soon') {
                                entry_date_str = 'Comming soon';
                                row.entry_status = '';
                            }
                            else {
                                var entry_start_date_arr = [];
                                var entry_end_date_arr = [];
                                entry_start_data_arr = row.entry_start_date.split(' ');
                                entry_end_data_arr = row.entry_end_date.split(' ');

                                var entry_date_str = '';

                                if (row.entry_start_date == null) {
                                    entry_date_str = 'Coming soon';
                                }
                                else {
                                    if (entry_start_data_arr[0] == entry_end_data_arr[0]) {
                                        entry_date_str = entry_start_data_arr[0];
                                    }
                                    else {
                                        entry_date_str = entry_start_data_arr[0] + ' - ' + entry_end_data_arr[0];
                                    }
                                }
                            }

                            var strDiv = '';
                            strDiv = `
                            <div class="preorder__item ${usable_class}">
                                <img src="http://116.124.128.246:81${row.img_location}">
                                <p class="item__title">${row.product_name}</p>
                                <p class="item__description">${entry_date_str}</p>
                                <p class="item__status">${row.entry_status}</p>
                            </div>
                        `;
                            $('.preorder__container').append(strDiv);
                        })
                    }
                }
            }
        });
    }
    function getEntryPreorder() {
        $('.preorder__result__form__wrap .pc__view').html('');
        $('.preorder__result__form__wrap .mobile__view').html('');
        $.ajax({
            url: config.api + "mypage/preorder/entry/get",
            type: "post",
            dataType: "json",
            error: function () {
                alert('프리오더 내역불러오기 오류가 발생했습니다.');
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    $('.preorder__result__form__wrap .pc__view').html('');
                    $('.preorder__result__form__wrap .mobile__view').html('');
                    var data = d.data;
                    if (data != null && data.length > 0) {
                        data.forEach(function (row) {
                            var order_status_str = '';
                            if (row.order_status != null) {
                                var order_status_str = '';
                                switch (row.order_status) {
                                    case 'PCP':
                                        order_status_str = '결제완료';
                                        break;
                                    case 'PPR':
                                        order_status_str = '상품준비';
                                        break;
                                    case 'DPR':
                                        order_status_str = '배송준비';
                                        break;
                                    case 'DPG':
                                        order_status_str = '배송중';
                                        break;
                                    case 'DCP':
                                        order_status_str = '배송완료';
                                        break;
                                    case 'POP':
                                        order_status_str = '프리오더 준비';
                                        break;
                                    case 'POD':
                                        order_status_str = '프리오더 상품 생산';
                                        break;
                                    case 'OCC':
                                        order_status_str = '주문 취소';
                                        break;
                                    case 'OEX':
                                        order_status_str = '주문 교환';
                                        break;
                                    case 'OEP':
                                        order_status_str = '주문 교환 완료';
                                        break;
                                    case 'ORF':
                                        order_status_str = '주문 환불';
                                        break;
                                    case 'ORP':
                                        order_status_str = '주문 환불 완료';
                                        break;
                                }
                            }

                            strDivPc = `
                            <div class="info">
                                <div class="preorder__tab__contents">
                                    <div class="contents__info">
                                        <div class="info">
                                            <span class="info__title">주문번호</span>
                                            <span class="info__value">${row.order_code == null ? '' : row.order_code}</span>
                                        </div>
                                        <div class="info">
                                            <span class="info__title">주문일</span>
                                            <span class="info__value">${row.order_date == null ? '' : row.order_date.split(' ')[0]}</span>
                                        </div>
                                        <div class="detail__btn"><span>자세히보기</span></div>
                                    </div>
                                    <div class="contents__table">
                                        <table>
                                            <colsgroup>
                                                <col style="width:120px">
                                                <col style="width:240px">
                                                <col style="width:120px">
                                                <col style="width:120px">
                                                <col style="width:120px">
                                                <col style="width:120px">
                                                <col style="width:110px">
                                            </colsgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="http://116.124.128.246:81${row.img_location}">
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
                                                        <p>Qty: ${row.product_qty}</p>
                                                    </td>
                                                    <td>
                                                        <p>${parseInt(row.sales_price).toLocaleString('ko-KR')}</p>
                                                    </td>
                                                    <td>
                                                        <p>${order_status_str}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                            var order_detail_str = '';
                            switch (row.order_status) {
                                case '주문완료':
                                    order_detail_str = `
                                    <div class="detail__btn" style="display:flex;align-items: center;gap: 10px;justify-content: space-between;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">주문완료</p>
                                        <img src="/images/mypage/mypage_order_cancel_btn.svg">
                                    </div>
                                    <p class="detail__info">배송준비 단계로 넘어가면 취소 불가합니다.</p>
                                `;
                                    break;
                                case '배송중':
                                    order_detail_str = `
                                    <div class="detail__btn" style="display:flex;justify-content:space-between;gap: 10px;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">배송중</p>
                                        
                                    </div>
                                    <p class="detail__info underline">${company_name}<br>${company_tel}</p>
                                `;
                                    break;
                                case '배송완료':
                                    order_detail_str = `
                                    <div class="detail__btn" style="display:flex;align-items: center;gap: 10px;justify-content: space-between;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">배송완료</p>
                                        <img src="/images/mypage/mypage_return_apply_btn.svg">
                                    </div>
                                    <p class="detail__info">반품접수는 제품 수령 후 7일 이내 가능합니다.</p>
                                `;
                            }
                            strDivMobile = `
                            <div class="info">
                                <div class="preorder__tab__contents">
                                    <div class="contents__info">
                                        <div class="info">
                                            <span class="info__title">주문번호</span>
                                            <span class="info__value">${row.order_code == null ? '' : row.order_code}</span>
                                        </div>
                                        <div class="info">
                                            <span class="info__title">주문일</span>
                                            <span class="info__value">${row.order_date == null ? '' : row.order_date.split(' ')[0]}</span>
                                        </div>
                                        <div class="detail__btn"><span>자세히보기</span></div>
                                    </div>
                                    <div class="contents__table" style="margin-top: 10px;">
                                        <table>
                                            <colsgroup>
                                                <col style="width:27%;">
                                                <col style="width:30%;">
                                                <col style="width:10%;">
                                                <col style="width:33%;">
                                            </colsgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="http://116.124.128.246:81${row.img_location}">
                                                    </td>
                                                    <td class="preorder_info_mob">
                                                        <p class="preorder_product_name">${row.product_name}</p>
                                                        <p>${parseInt(row.sales_price).toLocaleString('ko-KR')}</p>
                                                        <div class="color_wrap">
                                                            <p>${row.color}</p>
                                                            <div class="color_chip" style="background-color:${row.color_rgb}"></div>
                                                        </div>
                                                        <p>${row.option_name}</p>
                                                    </td>
                                                    <td>
                                                        <p>Qty:${row.product_qty}</p>
                                                    </td>
                                                    <td class="status__info">
                                                        ${order_detail_str}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                            $('.preorder__result__form__wrap .pc__view').append(strDivPc);
                            $('.preorder__result__form__wrap .mobile__view').append(strDivMobile);
                        })
                    }
                }
            }
        });
    }
</script>