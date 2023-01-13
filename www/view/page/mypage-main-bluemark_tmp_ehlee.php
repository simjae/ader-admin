<style>
    .bluemark__wrap {
        margin-top: 40px;
        width: 100%;
    }

    .bluemark__wrap .title {
        color: #0000c5;
    }

    .bluemark__tab__btn__container {
        margin: 0 auto;
        width: 110px;
        display: grid;
        place-items: center;
        grid-template-columns: 60px 50px;
    }

    .verify__form__wrap {
        width: 470px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__form__wrap .description {
        width: 520px;
        text-align: left;
        color: #343434;
        margin-top: 20px;
    }

    .verify__form__wrap .description {
        width: 520px;
        text-align: left;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #343434;
        margin-top: 20px;
        padding-bottom: 20px;
    }

    .verify__form__wrap .form {
        width: 470px;
    }

    .verify__form__wrap .button {
        margin-top: 10px;
        margin-bottom: 100px;
    }

    .verify__form__wrap .button button {
        width: 470px;
        height: 40px;
        border-radius: 1px;
        background-color: #0000c5;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .verify__success__wrap {
        width: 470px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__success__wrap .description {
        width: 470px;
        text-align: center;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #343434;
        margin-top: 60px;
        padding-bottom: 40px;
    }

    .verify__success__wrap .button {
        margin-bottom: 100px;
    }

    .verify__success__wrap .button button {
        width: 470px;
        height: 40px;
        border-radius: 1px;
        background-color: #0000c5;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .verify__fail__wrap {
        width: 470px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__fail__wrap .description {
        width: 470px;
        text-align: center;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #343434;
        margin-top: 30px;
        padding-bottom: 30px;
    }

    .verify__fail__wrap .button {
        margin-bottom: 40px;
    }

    .verify__fail__wrap .button button {
        width: 470px;
        height: 40px;
        border-radius: 1px;
        background-color: #000000;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .verify__fail__wrap .footer {
        text-align: center;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        margin-bottom: 100px;
    }

    .verify__list__wrap {
        width: 480px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__list__wrap .description {
        width: 100%;
        text-align: left;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #343434;
        margin-top: 20px;
    }

    .verify__list__wrap .description p {
        margin-bottom: 10px;
    }

    .verify__list__wrap .contents__table {
        border-bottom: none;
    }

    table.border__bottom td {
        border-bottom: 1px solid #dcdcdc;
    }

    .verify__list__wrap .footer {
        margin-bottom: 100px;
    }

    .vertical__top {
        padding-left: 10px;
    }

    .title_name {
        color: #0000c5;
    }

    .color_wrap {
        display: flex;
    }

    .color_chip {
        width: 6px;
        height: 6px;
        margin: 3px 5px 6px 2px;
        object-fit: contain;
        border-radius: 3px;
    }

    .voucher__handover__wrap {
        height: 389px;
        width: 490px;
        border: 1px solid #808080;
        padding: 20px;
        margin: 0 auto;
    }

    .voucher__handover__wrap__container {
        margin: 0 auto;
    }

    .certified__wrap {
        height: 86px;
        width: 450px;
        border: 1px solid #808080;
        padding: 10px;
        margin-top: 10px;
    }

    .certified_btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 69px;
        height: 23px;
        border-radius: 1px;
        background-color: #0000c5;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .certified_table {
        display: flex;
        justify-content: space-between;
    }

    .certified_row {
        width: 225px;
    }

    .black_transfer_btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 450px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        margin: 10px 0 20px 0;
    }

    .title_transfer p {
        color: #343434;
    }

    .description_transfer {
        margin-top: 20px;
        font-size: 11px;
    }

    .description_transfer p {
        margin-bottom: 10px;
    }

    .form input {
        height: 40px;
        width: 450px;
        border: 1px solid #808080;
        padding: 10px;
        margin-top: 10px;
    }
</style>
<div class="bluemark__wrap">
    <div class="bluemark__tab__btn__container">
        <div class="tab__btn__item" form-id="verify__form__wrap" onclick="tabClickTmp(this);">
            <img src="/images/mypage/tab/select_verify_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="verify__list__wrap" onclick="getBluemarkList();">
            <img src="/images/mypage/tab/default_list_btn.svg">
        </div>
    </div>
    <div class="bluemark__tab__wrap">
        <!-- <div class="bluemark__tab verify__form__wrap">
            <div class="title">
                <p>Bluemark</p>
            </div>
            <div class="description">
                <p>BLUE MARK는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해 제공되는 정품 인증 서비스입니다.</p>
                <p>ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기 위하여 적극적으로 대응중입니다.</p>
            </div>
            <div class="form">
                <input class="bluemark_member_id" type="text" name="member_id" placeholder="아이디">
                <input class="bluemark_serial_code" type="text" name="serial_code" placeholder="BLUE MARK 시리얼 코드">
            </div>
            <div class="button">
                <button onclick="verifyBluemark()">VERIFY</button>
            </div>
        </div>
        <div class="bluemark__tab verify__success__wrap">
            <div class="title">
                <p>Bluemark</p>
            </div>
            <div class="description">
                <p>BLUE MARK가 인증 된 해당 제품은 ADER 브랜드의 정품입니다.</p>
            </div>
            <div class="button">
                <button>VERIFY</button>
            </div>
        </div>
        <div class="bluemark__tab verify__fail__wrap">
            <div class="title">
                <p>Bluemark</p>
            </div>
            <div class="description">
                <p>BLUE MARK가 인증되지 않은 해당 제품은 ADER 브랜드의 정품이 아닌 가품입니다.</p>
                <p>가품으로 의심되는 제품 또는 판매처를 발견하셨을 때에는 ADER 측에 문의 바랍니다.</p>
            </div>
            <div class="button">
                <button>UNCERTIFIED</button>
            </div>
            <div class="footer">
                <p style="margin-bottom:10px;">문의사항이 있으실 경우, 고객센터로 연락 주시기 바랍니다.</p>
                <p>customer_care@adererror.com</p>
            </div>
        </div>
        <div class="bluemark__tab verify__list__wrap">
            <div class="title">
                <p>Bluemark</p>
            </div>
            <div class="description">
                <p>· 인증된 블루마크 이력을 아래에서 확인할 수 있습니다.</p>
                <p>· 블루마크 코드 양도를 희망하시는 경우 제품 양도하기를 클릭하여 정보 등록을 완료해 주시길 바랍니다.</p>
            </div>
            <div class="contents__table">
                <table class="border__bottom">
                    <colsgroup>
                        <col style="width:110px;">
                        <col style="width:120px;">
                        <col style="width:120px;">
                        <col style="width:130px;">
                    </colsgroup>
                    <tbody class="bluemark_list_table">
                    </tbody>
                </table>
            </div>
        </div> -->
        <div class="bluemark__tab voucher__handover__wrap">
            <div class="voucher__handover__wrap_container">
                <div class="title_trasfer">
                    <p style="font-size: 13px;">제품 양도하기</p>
                </div>
                <div class="description_transfer">
                    <p>·&nbsp;하단에 양도받을 아이디를 입력 후 버튼 클릭 시 블루마크 양도신청이 접수됩니다.</p>
                    <p>·&nbsp;정보는 향후 변경이 불가능하니 신청 전에 반드시 확인해 주시길 바랍니다.</p>
                </div>
                <div class="form">
                    <p style="margin-bottom: 10px;">양도 받을 아이디</p>
                    <input type="text" name="member_id" class="bluemark_member_id">
                </div>
                <div class="black_transfer_btn">
                    <button>양도하기</button>
                </div>
                <p>인증내역</p>
                <div class="certified__wrap">
                    <div id="handover__info">
                        <div class="certified_table">
                            <div class="certified_row">
                                <span>${data.product_name}</span>
                                <span>${data.member_id}</span>
                            </div>
                            <div class="certified_row">
                                <span>${data.color}</span>
                                <span>${data.update_date}</span>
                            </div>
                            <div class="certified_row">
                                <span class="certified_btn">
                                    CERTIFIED</span>
                                <span>${data.serial_code}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="contents__table" style="display: grid; justify-content: center;">
            <table class="border__bottom">
                <colsgroup>
                    <col style="width:110px;">
                    <col style="width:120px;">
                    <col style="width:120px;">
                    <col style="width:130px;">
                </colsgroup>
                <tbody>
                    <tr>
                        <td>
                            <img src="/images/mypage/sample_product/BLAFWLK15BL_8.png">
                        </td>
                        <td class="vertical__top">
                            <p>Product name</p>
                            <p>000,000</p>
                            <p>Color</p>
                            <p>A2</p>
                        </td>
                        <td>
                            <p>2022.11.44</p>
                        </td>
                        <td onclick="getBluemarkInfo(param)">
                            <img src="/images/mypage/mypage_product_transfer_btn.svg">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="footer"></div>
        </div> -->

    </div>
</div>
<script>
    $('.verify__form__wrap').show();

    $('.handover__btn').on('click', function () {
        $('.bluemark__tab').hide();
        $('.voucher__handover__wrap').show();
    })

    function getBluemarkInfo(obj) {
        var idx = $(obj).attr('idx');
        var country = 'KR';
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/product/bluemark/get",
            data: {
                'bluemark_idx': idx,
                'country': country
            },
            dataType: "json",
            error: function () {
                alert("블루마크 인증내역 조회에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data[0];
                    console.log(data);

                    var strDiv = `
                //    <div class="certified_table">
                //         <div class="certified_row">
                //             <span>${data.product_name}</span>
                //             <span>${data.member_id}</span>
                //         </div>
                //         <div class="certified_row">
                //             <span>${data.color}</span>
                //             <span>${data.update_date}</span>
                //         </div>
                //         <div class="certified_row">
                //         <span class="certified_btn">
                //             CERTIFIED</span>
                //         <span>${data.serial_code}</span>
                //         </div>
                //     </div>
                   `;


                    $('#handover__info').append(strDiv);
                }
            }
        });

    }

    function verifyBluemark() {
        let bluemark_member_id = $('.bluemark_member_id').val();
        let bluemark_serial_code = $('.bluemark_serial_code').val();

        if (
            (bluemark_member_id != "" && bluemark_member_id != null) &&
            (bluemark_serial_code != "" && bluemark_serial_code != null)
        ) {
            $.ajax({
                type: "post",
                url: "http://116.124.128.246:80/_api/product/bluemark/put",
                data: {
                    "country": "KR",
                    "member_id": bluemark_member_id,
                    "serial_code": bluemark_serial_code
                },
                dataType: "json",
                error: function () {
                    alert("블루마크 인증처리에 실패했습니다.");
                },
                success: function (d) {
                    $('.bluemark__tab').hide();

                    let code = d.code;
                    if (code == 200) {
                        $('.verify__success__wrap').show();
                    } else {
                        $('.verify__fail__wrap').show();
                    }
                }
            });
        }
    }

    function getBluemarkList() {
        $.ajax({
            type: "post",
            data: {
                "country": "KR"
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/product/bluemark/list/get",
            error: function () {
                alert("블루마크 내역 조회처리에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data;
                    if (data != null) {
                        let listTable = $('.bluemark_list_table');

                        listTable.html('');
                        let strDiv = '';
                        data.forEach((row) => {
                            strDiv += '<tr class="bluemark_list_tr">';
                            strDiv += '<td>';
                            strDiv += '<img src="http://116.124.128.246:81' + row.img_location + '" style="object-fit:contain">';
                            strDiv += '</td>';
                            strDiv += '<td class="vertical__top">';
                            strDiv += '<p style="white-space:nowrap;">' + row.product_name + '</p>';
                            strDiv += '<p>' + row.sales_price + '</p>';
                            strDiv += '<div class="color_wrap"><p>' + row.color + '</p><div class="color_chip" style="background-color:' + row.color_rgb + '"></div></div>';
                            strDiv += '<p>' + row.option_name + '</p>';
                            strDiv += '</td>';
                            strDiv += '<td>';
                            strDiv += '<p style="margin-top:11px">' + row.update_date + '</p>';
                            strDiv += '</td>';
                            strDiv += '<td class="handover__btn">';
                            strDiv += '<img src="/images/mypage/mypage_product_transfer_btn.svg">';
                            strDiv += '</td>';
                            strDiv += '</tr>';
                        })
                        listTable.append(strDiv);
                    }
                }
            }
        })
    }
</script>