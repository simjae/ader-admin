<style>
.bluemark__wrap{
    margin-top:40px;
    width:100%;
}

.bluemark__wrap .title{
    color:#0000c5;
}

.bluemark__tab__btn__container{
    margin: 0 auto;
    width:110px;
    display:grid;
    place-items: center;
    grid-template-columns: 60px 50px;
}
.verify__form__wrap{
    width:470px;
    margin:0 auto;
    margin-top:50px;
}

.verify__form__wrap .description{
    width:520px;
    text-align:left;
    color:#343434;
    margin-top:20px;
}
.verify__form__wrap .description{
    width:520px;
    text-align:left;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#343434;
    margin-top:20px;
    padding-bottom:20px;
}
.verify__form__wrap .form{
    width:470px;
}
.verify__form__wrap .button{
    margin-top:10px;
    margin-bottom:100px;
}
.verify__form__wrap .button button{
    width: 470px;
    height: 40px;
    border-radius: 1px;
    background-color: #0000c5;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#fff;
    line-height: 40px;
}

.verify__success__wrap{
    width:470px;
    margin:0 auto;
    margin-top:50px;
}
.verify__success__wrap .description{
    width:470px;
    text-align:center;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#343434;
    margin-top:60px;
    padding-bottom:40px;
}
.verify__success__wrap .button{
    margin-bottom: 100px;
}
.verify__success__wrap .button button{
    width: 470px;
    height: 40px;
    border-radius: 1px;
    background-color: #0000c5;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#fff;
    line-height: 40px;
}

.verify__fail__wrap{
    width:470px;
    margin:0 auto;
    margin-top:50px;
}
.verify__fail__wrap .description{
    width:470px;
    text-align:center;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#343434;
    margin-top:30px;
    padding-bottom:30px;
}
.verify__fail__wrap .button{
    margin-bottom: 40px;
}
.verify__fail__wrap .button button{
    width: 470px;
    height: 40px;
    border-radius: 1px;
    background-color: #000000;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#fff;
    line-height: 40px;
}
.verify__fail__wrap .footer{
    text-align:center;
    font-family:var(--ft-no-fu);
    font-size:11px;
    margin-bottom:100px;
}

.verify__list__wrap{
    width:480px;
    margin:0 auto;
    margin-top:50px;
}
.verify__list__wrap .description{
    width:100%;
    text-align:left;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    color:#343434;
    margin-top:20px;
}
.verify__list__wrap .description p{
    margin-bottom:10px;
}
.verify__list__wrap .contents__table{
    border-bottom:none;
}
table.border__bottom td{
    border-bottom: 1px solid #dcdcdc;
}
.verify__list__wrap .footer{
    margin-bottom:100px;
}
</style>
<div class="bluemark__wrap">
    <div class="bluemark__tab__btn__container">
        <div class="tab__btn__item" form-id="verify__form__wrap">
            <img src="/images/mypage/tab/select_verify_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="verify__list__wrap">
            <img src="/images/mypage/tab/default_list_btn.svg">
        </div>
    </div>
    <div class="bluemark__tab__wrap">
        <div class="bluemark__tab verify__form__wrap">
            <div class="title">
                <p>Bluemark</p>
            </div>
            <div class="description">
                <p>BLUE MARK는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해 제공되는 정품 인증 서비스입니다.</p>
                <p>ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기 위하여 적극적으로 대응중입니다.</p>
            </div>
            <div class="form">
                <input type="text" name="member_id" placeholder="아이디">
                <input type="text" name="bluemark_code" placeholder="BLUE MARK 시리얼 코드">
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
                <p>·인증된 블루마크 이력을 아래에서 확인할 수 있습니다.</p>
                <p>·블루마크 코드 양도를 희망하시는 경우 제품 양도하기를 클릭하여 정보 등록을 완료해 주시길 바랍니다.</p>
            </div>
            <div class="contents__table">
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
                                <p>2022.12.14</p>
                            </td>
                            <td>
                                <p>제품양도하기</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="/images/mypage/sample_product/BLAFWHT04BK_10.png">
                            </td>
                            <td class="vertical__top">
                                <p>Product name</p>
                                <p>000,000</p>
                                <p>Color</p>
                                <p>A2</p>
                            </td>
                            <td>
                                <p>2022.12.14</p>
                            </td>
                            <td>
                                <p>제품양도하기</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="/images/mypage/sample_product/BLAFWJE11BL_12.png">
                            </td>
                            <td class="vertical__top">
                                <p>Product name</p>
                                <p>000,000</p>
                                <p>Color</p>
                                <p>A2</p>
                            </td>
                            <td>
                                <p>2022.12.14</p>
                            </td>
                            <td>
                                <p>제품양도하기</p>
                            </td>
                        </tr>
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
                                <p>2022.12.14</p>
                            </td>
                            <td>
                                <p>제품양도하기</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
$('.bluemark__tab').hide();
$('.verify__form__wrap').show();

function verifyBluemark(){
    if($('input[name="member_id"]').val() == '1'){
        $('.bluemark__tab').hide();
        $('.verify__fail__wrap').show();
    }
    else{
        $('.bluemark__tab').hide();
        $('.verify__success__wrap').show();
    }
}
</script>