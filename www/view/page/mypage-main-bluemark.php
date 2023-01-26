<style>
    .bluemark__wrap {
        margin-top: 40px;
        width: 100%;
        display:grid;
        grid-template-columns:repeat(16,1fr);
    }
    .bluemark__wrap .title {
        color: #0000c5;
    }
    .bluemark__tab__wrap{
        grid-column:7/11;
        width:100%;
        margin: 0 auto;
    }
    .bluemark__tab__btn__container {
        grid-column: 8/10;
        margin: 0 auto;
        display: grid;
        place-items: center;
        grid-template-columns: 60px 50px;
    }

    .verify__form__wrap {
        margin-top: 50px;
        width: 100%;
    }

    .verify_form {
        display: block;
    }

    .verify__form__wrap .form {
        width: 100%;
    }

    .verify__form__wrap .description {
        width: 100%;
        text-align: left;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #343434;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        margin-top: 20px;
    }

    .verify__form__wrap .button {
        margin-top: 10px;
        margin-bottom: 100px;
    }

    .verify__form__wrap .button button {
        width: 100%;
        height: 40px;
        border-radius: 1px;
        background-color: #0000c5;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .verify__success__wrap {
        width: 100%;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__success__wrap .description {
        width: 100%;
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
        width: 100%;
        height: 40px;
        border-radius: 1px;
        background-color: #0000c5;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        color: #fff;
        line-height: 40px;
    }

    .verify__fail__wrap {
        width: 100%;
        margin: 0 auto;
        margin-top: 50px;
    }

    .verify__fail__wrap .description {
        width: 100%;
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
        width: 100%;
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
        width: 100%;
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
        margin-bottom: 49.5px;
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
        padding-top: 9.5px;
    }

    .vertical__top p {
        margin-bottom: 10px;
    }

    .pc__view .bluemark_list_tr {
        height: 156px;
    }
    .mobile__view  .bluemark_list_tr {
        height: 119px;
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
        background-color: #fff;
        display: none;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 60%;
        transform: translate(-50%, -50%);
        overflow: auto;

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
        width: 430px;
        height: 66px;
        display: flex;
        flex-wrap: wrap;
    }

    .certified_table p {
        flex: 1 1 50%;
    }

    ..certified_table td {
        display: flex;
        justify-content: center;
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

    .title_transfer {
        display: flex;
        justify-content: space-between;
    }



    .description_transfer {
        margin-top: 20px;
        font-size: 11px;
    }

    .description_transfer p {
        margin-bottom: 10px;
    }

    .form {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
    }

    .form input {
        height: 40px;
        width: 300px;
        border: 1px solid #808080;
        padding: 10px;
    }

    /* 국가별 선택옵션 */
    .bluemark_country {
        position: relative;
    }

    .bluemark_country select {
        display: none;
    }

    .select-selected {
        color: #343434;
        border-radius: 1px;
        border: solid 1px #808080
    }

    /* style the items (options), including the selected item: */
    .select-items div,
    .select-selected {
        color: #343434;
        background-color: #fff;
        padding: 12px 0 12px 10px;
        border: solid 1px #808080;
        cursor: pointer;
    }

    /* Style items (options): */
    .select-items {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
    }

    /* Hide the items when the select box is closed: */
    .select-hide {
        display: none;
    }

    .select-items div:hover,
    .same-as-selected {
        background-color: #f5f5f5;
        border: solid 1px #808080;
    }
    .form input{
        margin-top:0px;
    }
    .handover__btn{text-align:center;}
     
    .description.fail_pc p{ width:100%; text-align: center;margin-bottom:0px;}
    .description.fail_mobile p{ width:100%; text-align: center;margin-bottom:0px;}
    .description.verify_pc p{ margin-bottom:0px; }
    .description.verify_mobile p{ margin-bottom:0px; }
@media (min-width: 1024px){
    .description.fail_pc{ display:block; }
    .description.fail_mobile{ display:none; }
    .description.verify_pc{ display:block; width:100%;}
    .description.verify_mobile{ display:none; }
}
@media (max-width: 1024px){
    .bluemark__tab__wrap{grid-column:1/17;width:100%}
    .bluemark__tab__btn__container{grid-column:1/17;width:100%}
    .verify__form__wrap .description{
        width:100%; 
    }
    .description.fail_pc{ display:none; }
    .description.fail_mobile{ display:block;}
    .description.verify_pc{ display:none; }
    .description.verify_mobile{ display:block;}

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
        <div class="bluemark__tab verify__form__wrap">
            <div class="title">
                <p class="title_name">Bluemark</p>
            </div>
            <div class="description">
                <p>BLUE MARK는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해 제공되는 정품 인증 서비스입니다.
                ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기 위하여 적극적으로 대응중입니다.</p>
                <div class="bluemark__err__msg" style="width:100%;height:16.5px;">
                    <p style="color:red;text-align:right;"></p>
                </div>
                
            </div>
            <div class="verify_form">
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
            <div class="description fail_pc">
                <p>BLUE MARK가 인증되지 않은 해당 제품은 ADER 브랜드의 정품이 아닌 가품입니다.</p>
                <p>가품으로 의심되는 제품 또는 판매처를 발견하셨을 때에는 ADER 측에 문의 바랍니다.</p>
            </div>
            <div class="description fail_mobile">
                <p>BLUE MARK가 인증되지 않은 해당 제품은</p>
                <p>ADER 브랜드의 정품이 아닌 가품입니다.</p>
                <p>가품으로 의심되는 제품 또는 판매처를 발견하셨을 때에는</p>
                <p>ADER 측에 문의 바랍니다.</p>
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
            <div class="description verify_pc">
                <p>·인증된 블루마크 이력을 아래에서 확인할 수 있습니다.</p>
                <p>·블루마크 코드 양도를 희망하시는 경우 제품 양도하기를 클릭하여 정보 등록을 완료해 주시길 바랍니다.</p>
            </div>
            <div class="description verify_mobile">
                <p>·인증된 블루마크 이력을 아래에서 확인할 수 있습니다.</p>
                <p>·블루마크 코드 양도를 희망하시는 경우 제품 양도하기를 클릭하여<br>정보 등록을 완료해 주시길 바랍니다.</p>
            </div>
            <div class="contents__table">
                <div class="pc__view">
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
                <div class="mobile__view">
                    <table class="border__bottom">
                        <colsgroup>
                            <col style="width:27%;">
                            <col style="width:39%;">
                            <col style="width:34%;">
                        </colsgroup>
                        <tbody class="bluemark_list_table_mobile">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        <div class="bluemark__tab voucher__handover__wrap">
            <div class="voucher__handover__wrap_container">
                <div class="title_transfer">
                    <p style="font-size: 13px;">제품 양도하기</p>
                    <div class="close" onclick="close()"><img src='/images/mypage/tmp_img/X-12.svg' /></div>
                </div>
                <div class="description_transfer">
                    <p>·&nbsp;하단에 양도받을 아이디를 입력 후 버튼 클릭 시 블루마크 양도신청이 접수됩니다.</p>
                    <p>·&nbsp;정보는 향후 변경이 불가능하니 신청 전에 반드시 확인해 주시길 바랍니다.</p>
                </div>
                <div>
                    <p style="margin-bottom: 10px;">양도 받을 아이디</p>
                </div>
                <div class="form">
                    <div class="bluemark_country" style="width:140px;">
                        <select id="handover_country" name="bluemark_country">
                            <option name="bluemark_country" value="KR" selected>한국몰</option>
                            <option name="bluemark_country" value="EN">영문몰</option>
                            <option name="bluemark_country" value="CN">중문몰</option>
                        </select>
                    </div>
                    <input id="handover_id" type="text" name="bluemark_handover_id" class="bluemark_handover_id"
                        placeholder="한/영/중 몰을 선택 후 이곳에 아이디를 입려해주세요.">
                </div>
                <div class="black_transfer_btn">
                    <button class="bluemark_idx" onclick="handoverBluemark(this)">양도하기</button>
                </div>
                <p>인증내역</p>
                <div class="certified__wrap">
                    <div class="handover__info">
                        <table>
                            <tbody id="handover__info__table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    makeSelect('bluemark_country');
    
    $('.bluemark__tab').not('.verify__form__wrap').hide();

    $('.handover__btn').on('click', function () {
        $('.bluemark__tab').hide();
        $('.voucher__handover__wrap').show();
    });
})
    

function getBluemarkInfo(obj) {
    $('.bluemark__tab').not('.verify__list__wrap').hide();
    $('.voucher__handover__wrap').show();

    var idx = $(obj).attr('bluemark_idx');
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
                $('#handover__info__table').html('');
                let data = d.data[0];
                $('.bluemark_idx').attr('bluemark_idx', data.bluemark_idx);
                var strDiv = `
                    <div class="certified_table">
                    <tr>
                        <td><p>${data.product_name}</p>
                        <p>${data.member_id}</p></td>
                    </tr>
                    <tr>
                        <td><p>${data.color}</p>
                        <p>${data.update_date}</p></td>
                    </tr>
                    <tr>
                        <td><p><span class="certified_btn">CERTIFIED</span></p>
                    <p>${data.serial_code}</p></td>
                    </tr>
                    </div>
                `;
                $('#handover__info__table').append(strDiv);
            }
        }
    });
}

function verifyBluemark() {
    let bluemark_serial_code = $('.bluemark_serial_code').val();

    if (bluemark_serial_code != "" && bluemark_serial_code != null) 
    {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/product/bluemark/put",
            data: {
                "country": "KR",
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
    else{
        if(bluemark_serial_code == "" || bluemark_serial_code == null){
            $('.bluemark__err__msg p').text('시리얼 코드를 입력해주세요');
        }
    }
}

function getBluemarkList() {
    let listTable = $('.bluemark_list_table');
    let listTableMobile = $('.bluemark_list_table_mobile');

    $('.verify__form__wrap').hide();
    $('.verify__list__wrap').show();

    
    listTable.html('');
    listTableMobile.html('');

    listTable.append(`
        <tr>
            <td colspan="4" style="text-align:center">
                <p>조회결과가 없습니다.</p>
            </td>
        </tr>
    `);
    listTableMobile.append(`
        <tr>
            <td colspan="3" style="text-align:center">
                <p>조회결과가 없습니다.</p>
            </td>
        </tr>
    `);

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

                    listTable.html('');
                    listTableMobile.html('');
                    let strDiv = '';
                    let strMobileDiv = '';
                    data.forEach((row) => {
                        strDiv += `
                            <tr class="bluemark_list_tr">
                                <td>
                                    <img src="http://116.124.128.246:81${row.img_location}" style="object-fit:contain">
                                </td>
                                <td class="vertical__top">
                                    <p style="white-space:nowrap;">${row.product_name}</p>
                                    <p>${row.sales_price}</p>
                                    <div class="color_wrap">
                                        <p>${row.color}</p>
                                        <div class="color_chip" style="background-color:${row.color_rgb}"></div>
                                    </div>
                                    <p>${row.option_name}</p>
                                </td>
                                <td>
                                    <p style="margin-top:11px">${row.update_date}</p>
                                </td>
                                <td class="handover__btn">
                                    <img src="/images/mypage/mypage_product_transfer_btn.svg" bluemark_idx="${row.bluemark_idx}" onclick="getBluemarkInfo(this);">
                                </td>
                            </tr>
                        `;
                        
                        strMobileDiv += `
                            <tr class="bluemark_list_tr">
                                <td>
                                    <img src="http://116.124.128.246:81${row.img_location}" style="object-fit:contain">
                                </td>
                                <td class="vertical__top">
                                    <p style="white-space:nowrap;">${row.product_name}</p>
                                    <p>${row.sales_price}</p>
                                    <div class="color_wrap">
                                        <p>${row.color}</p>
                                        <div class="color_chip" style="background-color:${row.color_rgb}"></div>
                                    </div>
                                    <p>${row.option_name}</p>
                                </td>
                                <td class="handover__btn">
                                    <p style="margin-bottom:10px;">${row.update_date}</p>
                                    <img src="/images/mypage/mypage_product_transfer_btn.svg" bluemark_idx="${row.bluemark_idx}" style="margin:0 auto" onclick="getBluemarkInfo(this);">
                                </td>
                            </tr>
                        `;
                    })
                    listTable.append(strDiv);
                    listTableMobile.append(strMobileDiv);
                }
            }
        }
    })
}
function handoverBluemark(obj) {
    let bluemark_idx = $(obj).attr('bluemark_idx');
    let handover_id = $('#handover_id').val();
    let country = $('#handover_country').val();

    if (
        (handover_id != "" && handover_id != null) &&
        (country != "" && country != null)
    ) {
        console.log(country);
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/product/bluemark/put",
            data: {
                "bluemark_idx": bluemark_idx,
                "handover_id": handover_id,
                "country": country
            },
            dataType: "json",
            error: function () {
                alert("블루마크 양도처리에 실패했습니다.");
            },
            success: function (d) {

                let code = d.code;
                if (code == 200) {
                    $('.voucher__handover__wrap').show();
                }
            }
        });
    }
}


function tabClickTmp() {
    $('.verify__list__wrap').hide();
    $('.verify__form__wrap').show();

    $('.bluemark__err__msg p').text(' ');
}

function closeAllSelect(elmnt) {

    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}

document.addEventListener("click", closeAllSelect);


// 닫기버튼
$('.close').on("click", function () {
    $('.voucher__handover__wrap').hide();
});

</script>