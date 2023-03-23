<style>
    .profile__wrap {
        margin-top: 40px;
        width: 100%;
    }

    .profile__tab__btn__container {
        margin: 0 auto;
        width: 410px;
        display: grid;
        place-items: center;
        grid-template-columns: 80px 80px 80px 90px 80px;
    }

    .profile__tab__wrap {
        width: 490px;
        margin: 0 auto;
        margin-top: 80px;
    }

    .profile__wrap .contents__table {
        border: none;
        width: 470px;
    }

    .profile__wrap .contents__table td {
        border: none;
        font-size: 11px;
        font-family: var(--ft-no-fu);
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .profile__tab__wrap .footer {
        margin-bottom: 100px;
    }

    .input__form__wrap {
        font-size: 11px;
        font-family: var(--ft-no-fu);
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .rows__title {
        padding-top: 10px;
    }

    .rows__contnets {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
    }

    .black__btn {
        width: 100%;
        height: 40px;
        background-color: black;
        font-size: 11px;
        color: white;
        text-align: center;
        border-radius: 1px;
        border: solid 1px #dcdcdc;
    }

    .white__btn {
        width: 100%;
        height: 40px;
        background-color: white;
        font-size: 11px;
        color: black;
        text-align: center;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    .profile__delivery__wrap {
        width: 470px;
        margin: 0 auto;
    }

    .input__form__rows.marketing__receive {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        margin-bottom: 10px;
    }

    .title {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .title img {
        height: 12px;
    }

    .profile__wrap .description p {
        line-height: 2;
    }

    .profile__pw__update__wrap {
        height: 409px;
        width: 490px;
        border: 1px solid #808080;
        margin: 80px 0 51px 0;
        padding: 0 20px 20px 20px;
    }

    .update_btn {
        height: 24px;
        width: 50px;
        border: 1px solid #808080;
    }

    .pw_form input {
        height: 40px;
        width: 450px;
        border: 1px solid #808080;
        margin: 0 0 10px 0;
    }

    .pw_form .none_margin_bottom {
        margin-bottom: 0;
    }

    .profile__tel__update__wrap {
        height: 360px;
        width: 490px;
        border: 1px solid #808080;
        margin: 80px 0 51px 0;
        padding: 0 20px 20px 20px;
    }

    .underline span {
        text-decoration: underline;
    }

    .profile__tel__update__confirm__wrap {
        height: 360px;
        width: 490px;
        border: 1px solid #808080;
        margin: 80px 0 51px 0;
        padding: 0 20px 20px 20px;

    }

    .profile__account__delete__wrap {
        height: 360px;
        width: 490px;
        border: 1px solid #808080;
        margin: 80px 0 51px 0;
        padding: 0 20px 20px 20px;

    }

    .profile__account__delete__wrap .title {
        margin-bottom: 20px;
    }

    .contents_margin p {
        margin-bottom: 10px;
    }
</style>
<div class="profile__wrap">
    <div class="profile__tab__btn__container">
        <div class="tab__btn__item" form-id="profile__set__wrap">
            <img src="/images/mypage/tab/select_profile_set_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="profile__credit__update__wrap">
            <img src="/images/mypage/tab/default_credit_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="profile__customize__purchase__wrap">
            <img src="/images/mypage/tab/default_customize_purchase_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="profile__delivery__wrap">
            <img src="/images/mypage/tab/default_delivery_btn.svg" onclick="getOrderToList()">
        </div>
        <div class="tab__btn__item" form-id="profile__marketing__wrap">
            <img src="/images/mypage/tab/default_marketing_btn.svg">
        </div>
    </div>
    <div class="profile__tab__wrap">
        <div class="profile__tab profile__set__wrap">
            <div class="contents__table">
                <table class="border__bottom">
                    <colsgroup>
                        <col style="width:120px;">
                        <col style="width:300px;">
                        <col style="width:50px;">
                    </colsgroup>
                    <tbody>
                        <tr>
                            <td>이름</td>
                            <td>
                                <?= $_SESSION['MEMBER_NAME'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>이메일</td>
                            <td><?= $_SESSION['MEMBER_EMAIL'] ?></td>
                        </tr>
                        <tr>
                            <td>비밀번호</td>
                            <td>**************</td>
                            <input type="hidden" name="user_update_pw">
                            <td>
                                <button class="update_btn" action-type="pw_update"
                                    onclick="buttonAction(this)">수정</button>
                            </td>
                        </tr>
                        <tr>
                            <td>휴대전화</td>
                            <td class="user_tel_mobile">
                                <?= $_SESSION['TEL_MOBILE'] ?>
                            </td>
                            <td>
                                <button class="update_btn" action-type="tel_update"
                                    onclick="buttonAction(this)">수정</button>
                            </td>
                        </tr>
                        <tr>
                            <td>생년월일</td>
                            <td><?= $_SESSION['MEMBER_BIRTH'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 470px;">
                <div style="padding:30px 0 20px 0;border-bottom:1px solid #dcdcdc">
                    <button class="black__btn" action-type="to_main" onclick="putMemberPwAndTel()">저장</button>
                </div>
                <div style="padding-top:20px;">
                    <button class="white__btn" action-type="move_account_del" onclick="buttonAction(this)">계정삭제</button>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        <div class="profile__tab profile__pw__update__wrap">
            <div class="title">
                <p style="font-size: 13px; margin-bottom: 20px;">비밀번호 변경</p>
                <div class="close" onclick="close()" action-type="close_pw_update"><img
                        src='/images/mypage/tmp_img/X-12.svg' /></div>
            </div>
            <div class="pw_form">
                <input type="password" name="current_pw" placeholder="현재 비밀번호">
                <input type="password" name="update_pw" placeholder="새로운 비밀번호">
                <input class="none_margin_bottom" type="password" name="check_update_pw" placeholder="새로운 비밀번호 확인">
            </div>
            <div style="margin-top:10px;" class="contents_margin">
                <p>비밀번호 입력 조건</p>
            </div>
            <div class="contents_margin" style="margin-bottom:5px;">
                <p>·&nbsp;&nbsp;대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자</p>
                <p>·&nbsp;&nbsp;입력 가능 특수문자</p>
                <p>&nbsp;&nbsp;&nbsp;!@#$%^()_-={}[]|;:<>,.?/</p>
                <p>·&nbsp;&nbsp;공백 입력 불가능</p>
            </div>
            <div>
                <button class="black__btn" action-type="fin_pw_update" style="margin-top: 15px;"
                    onclick="checkMemberPw()">변경</button>
            </div>
        </div>
        <div class="profile__tab profile__tel__update__wrap">
            <div class="title">
                <p style="font-size: 13px; margin-bottom: 40px;">휴대전화 번호 변경</p>
                <div class="close" onclick="close()" action-type="close_tel_update"><img
                        src='/images/mypage/tmp_img/X-12.svg' action-type="close" onclick="buttonAction(this)" /></div>
            </div>
            <div>
                <p style="margin-bottom: 10px;"> 일회성 인증번호 발송을 위해 휴대폰 번호를 입력해 주세요.</p>
            </div>
            <div class="pw_form" style="margin-bottom: 10px;">
                <input type="text" name="tel_certificate" placeholder="( - ) 없이 숫자만 입력">
            </div>
            <div>
                <p style="margin-bottom: 5px;">·&nbsp;&nbsp;통신 요금제에 따라 문자메시지 발송 비용이 발생할 수 있으며,</p>
                <p style="margin-bottom: 10px;">&nbsp;&nbsp;&nbsp;통신사의 문제로 인해 문자 메시지 발송이 지연될 수 있습니다.</p>
                <p style="margin-bottom: 36px;">·&nbsp;&nbsp;<span class="underline">개인정보처리방침</span> 및 <span
                        class="underline">이용약관</span></p>
            </div>
            <div class="input__form__rows">
                <label>
                    <input id="ck_sendcode_phone" type="checkbox" style="margin:0 10px 3px 0;">
                    <span>문자메시지 1회 수신을 위한 개인정보처리방침 및 이용약관 동의</span><span class="alertms_tel"
                        style="color:red;text-align:right;"></span>
                </label>
            </div>
            <div style="width: 450px;">
                <button class="black__btn" style="margin: 20px 0;" action-type="send_code"
                    onclick="buttonAction(this)">코드전송</button>
            </div>
        </div>
        <div class="profile__tab profile__tel__update__confirm__wrap">
            <div class="title" style="margin-bottom: 14px;">
                <p style="font-size: 13px;">휴대전화 번호 변경</p>
                <div class="close" onclick="close()"><img src='/images/mypage/tmp_img/X-12.svg'
                        action-type="close_tel_update" onclick="buttonAction(this)" /></div>
            </div>
            <div>
                <p style="margin: 0;">·&nbsp;&nbsp;+82 01055665656</p>
                <p style="margin: 5px 0 10px 0;">&nbsp;&nbsp;인증 코드가 전송되었습니다.</p>
            </div>
            <div class="pw_form">
                <input type="text" name="tel_insert" placeholder="인증 번호 입력" style="margin-bottom: 5px;">
                <p style="float: right;">30초 내에 재전송</p>
            </div>
            <div class="contents_margin">
                <p>·&nbsp;&nbsp;통신 요금제에 따라 문자메시지 발송 비용이 발생할 수 있으며,</p>
                <p>&nbsp;&nbsp;통신사의 문제로 인해 문자 메시지 발송이 지연될 수 있습니다.</p>
            </div>
            <div>
                <button class="white__btn" style="margin-top: 48px;">인증 코드
                    재전송</button>
                <button class="black__btn" style="margin: 10px 0 20px 0;" action-type="fin_check"
                    onclick="buttonAction(this)">인증완료</button>
            </div>
        </div>
        <div class="profile__tab profile__account__delete__wrap">
            <div class="title" style="height:19px;">
                <p style="font-size: 13px;">계정삭제</p>
                <div class="close" onclick="close()"> <img src='/images/mypage/tmp_img/X-12.svg' /></div>
            </div>
            <div class="contents_margin">
                <p>·&nbsp;&nbsp;부정 이용을 방지하기 위하여 회원탈퇴 후 48시간 이내로 재가입이 불가합니다.</p>
                <p>·&nbsp;&nbsp;탈퇴 즉시 개인정보가 삭제되고 어떠한 방법으로도 복원할 수 없습니다.</p>
                <p style="margin-bottom:53px;line-height:2;">·&nbsp;&nbsp;교환, 반품, 환불 및 사후처리(A/S)등을 위하여 전자상거래 등에서의</br>
                    &nbsp;&nbsp;&nbsp;소비자보호에 관한 법률에 의거해 일정 기간동안 보관 후 파기됩니다.</p>
            </div>
            <div class="input__form__rows">
                <label>
                    <input id="ck_account_delete" type="checkbox" style="margin:0 10px 3px 0;">
                    <span>위 유의사항을 모두 확인하였고, 계정 삭제에 동의합니다.</span><span class="alertms_del"
                        style="color:red;text-align:right;"></span>
                </label>
            </div>
            <div>
                <button class="white__btn" style="margin: 20px 0 10px 0;" action-type="del_cancel"
                    onclick="buttonAction(this)">취소</button>
                <button class="black__btn" action-type="account_del" onclick="buttonAction(this)">계정삭제</button>
            </div>
        </div>
        <div class="profile__tab profile__credit__update__wrap">
            <div class="title">
                <p>결제수단 저장</p>
            </div>
            <div class="description">
                <p>빠른 주문 결제를 위해 결제수단을 미리 입력해두세요.</p>
            </div>
            <div class="input__form__wrap" style="margin-top:20px;">
                <div class="input__form__rows">
                    <div class="rows__title">카드 명의</div>
                    <input></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">카드번호</div>
                    <input></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">유효기간</div>
                    <div class="rows__contnets">
                        <select class="rows__item"></select>
                        <select class="rows__item"></select>
                    </div>
                </div>
                <div class="input__form__rows">
                    <label>
                        <input type="checkbox">
                        <span>기본 결제수단으로 저장</span>
                    </label>
                </div>
                <div style="padding-top:40px;">
                    <button class="black__full__width__btn account">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__credit__list__wrap">
        </div>
        <div class="profile__tab profile__customize__purchase__wrap">
            <div class="title">
                <p>구매 맞춤 정보 설정</p>
            </div>
            <div class="description">
                <p>구매 전 사이즈를 선택할 수 있도록 사이즈 정보를 제공해 주세요.</p>
            </div>
            <div class="input__form__wrap" style="margin-top:20px;">
                <div class="input__form__rows">
                    <div class="rows__title">성별</div>
                    <div style="margin-top:10px;margin-bottom:30px;">
                        <label>
                            <input type="radio" name="gender">
                            <span>여성</span>
                        </label>
                        <div style="height:10px;"></div>
                        <label>
                            <input type="radio" name="gender">
                            <span>남성</span>
                        </label>
                    </div>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">상의 사이즈</div>
                    <select></select>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">하의 사이즈</div>
                    <select></select>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">신발 사이즈</div>
                    <select></select>
                </div>
                <div style="padding-top:40px;">
                    <button class="black__full__width__btn" style="font-size: 11px;">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__delivery__wrap">
            <div class="list__delivery__wrap default__list" style="display: block;">
                <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                    <p style="font-size: 13px; padding-bottom: 9.5px">기본 배송지</p>
                </div>
            </div>
            <div class="list__delivery__wrap other__list" style="display: block;">
                <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                    <p style="font-size: 13px; padding-bottom: 9.5px">다른 배송지</p>
                </div>
            </div>
            <div class="input__form__wrap" style="display:none; margin-top:20px;">
                <div class="input__form__rows">
                    <div class="rows__title">배송지명</div>
                    <input></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">이름</div>
                    <input></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">전화번호</div>
                    <input></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title">주소</div>
                    <div class="rows__contnets">
                        <input style="width:350px"></input>
                        <button class="black__btn" style="width:110px;margin-top:10px;">검색</button>
                    </div>
                    <input style="margin-top:0px;margin-bottom:10px;"></input>
                </div>
                <div class="input__form__rows">
                    <label>
                        <input type="checkbox">
                        <span>기본 결제수단으로 저장</span>
                    </label>
                </div>
                <div style="padding-top:40px;">
                    <button class="black__full__width__btn">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__delivery__lsit__wrap">
        </div>
        <div class="profile__tab profile__marketing__wrap">
            <div class="title">
                <p>마케팅 정보 수신 및 활용 동의</p>
            </div>
            <div class="description">
                <p>제품, 할인 정보, 멤버 혜택 관련 최신 소식을 받아보세요.</p>
            </div>
            <div style="margin-top:20px; margin-bottom:20px;">
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input type="checkbox">
                        <span>전체동의</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input type="checkbox">
                        <span>이메일로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input type="checkbox">
                        <span>SMS로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input type="checkbox">
                        <span>전화로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
            </div>
            <div class="description" style="margin-bottom:30px;">
                <p>·&nbsp;귀하의 개인정보를 이용하는 방법 및 귀하의 개인정보 접근, 변경 및 삭제 요청 방법에 대한<br>
                    &nbsp;&nbsp;자세한 정보는 <span class="underline">개인정보취급방침</span>을 확인하시기 바랍니다.
                </p>
            </div>
            <button class="black__full__width__btn">저장</button>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
    $('.profile__tab').hide();
    $('.profile__set__wrap').show();

    function buttonAction(obj) {
        $('.profile__tab').hide();

        var action_type = $(obj).attr('action-type');
        let str = '체크를 해주세요';
        switch (action_type) {
            case 'pw_update':
                $('.profile__pw__update__wrap').show();
                break;
            case 'tel_update':
                $('.profile__tel__update__wrap').show();
                $('#ck_sendcode_phone').prop('checked', false);
                $('.alertms_tel').html('');
                break;
            case 'fin_pw_update':
                $('.profile__set__wrap').show();
                break;
            case 'to_main':
                location.href = "/main";
                break;
            case 'del_cancel':
                $('.profile__set__wrap').show();
                break;
            case 'send_code':
                if ($('#ck_sendcode_phone').is(':checked') == true) {
                    $('.profile__tel__update__confirm__wrap').show();
                }
                else {
                    $('.profile__tel__update__wrap').show();
                    $('.alertms_tel').append(str);
                }
                break;
            case 'fin_check':
                $('.profile__set__wrap').show();
                break;
            case 'close':
                $('.profile__tel__update__confirm__wrap').show();
                break;
            case 'move_account_del':
                $('.profile__account__delete__wrap').show();
                $('.alertms_del').html('');
                break;
            case 'account_del':
                if ($('#ck_account_delete').is(':checked') == true) {
                    
                    $.ajax(
                        {
                        url: "http://116.124.128.246:80/_api/mypage/member/account/delete",
                        type: 'POST',
                        dataType: 'json',
                        error: function () {
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                $.ajax(
                        {
                            url: "http://116.124.128.246:80/_api/account/logout",
                            type: 'POST',
                            dataType: 'json',
                            error: function () {
                            },
                            success: function (data) {
                            console.log(data.code);
                            if (data.code == 200) {
                            location.href = '/main';
                            }}
                        });
                    }}
                });
                    $('#ck_account_delete').prop('checked', false);
                }
                else {
                    $('.profile__account__delete__wrap').show();
                    $('.alertms_del').append(str);
                }
                break;
    }}

    function checkMemberPw() {
        //  현재 비밀번호
        let nowPassword = $('input[name=current_pw]').val();
        //  새로 바꿀 비밀번호
        let newPassword = $('input[name=update_pw]').val();
        //  새로 바꿀 비밀번호 확인
        let newPasswordCheck = $('input[name=check_update_pw]').val();
        //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
        //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
        var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
        //  공백 입력 불가능
        var space_reg = /\s/g;

        $.ajax({
            type: "post",
            data: {
                "country": getLanguage(),
                "member_pw": nowPassword
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/account/check",
            error: function () {
                alert("현재 비밀번호 조회에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    if (space_reg.test(newPassword) == false && password_reg.test(newPassword) == true) {
                        if (newPassword === newPasswordCheck) {
                            if (newPassword !== nowPassword) {
                                $('input[name=user_update_pw]').val(newPassword);
                                $('.profile__pw__update__wrap').hide();
                                $('.profile__set__wrap').show();
                                $('input[name=current_pw]').val('');
                                $('input[name=update_pw]').val('');
                                $('input[name=check_update_pw]').val('');
                            } else {
                                console.log("현재 비밀번호와 다르게 설정해주세요.");
                            }
                        } else {
                            console.log("새로운 비밀번호를 다시 확인해주세요.");
                        }
                    } else {
                        console.log("새로운 비밀번호의 공백과 특수문자를 확인해주세요.");
                    }
                } else {
                    console.log("현재 비밀번호와 일치하지 않습니다.");
                }
            }

        })
    }

    function putMemberPwAndTel() {
        let newPassword = $('input[name=user_update_pw]').val();
        let newTelMobile = $('.user_tel_mobile').text();
        $.ajax({
            type: "post",
            data: {
                "country": getLanguage(),
                "member_pw": newPassword,
                "member_tel_mobile": newTelMobile
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/account/put",
            error: function () {
                alert("비밀번호와 휴대전화 번호 변경에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    alert("비밀번호, 휴대전화 번호 변경이 완료되었습니다.");
                }
            }
        })
    }
    function getOrderToList() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/order_to/list/get",
            error: function () {
                alert("배송지 목록을 불어오는데 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data;
                    if (data != null) {
                        let defaultData = data[0];
                        let otherData = data.slice(1);
                        let defaultList = $('.default__list');
                        let orderList = $('.other__list');
                        let strDiv = '';

                    }
                }
            }
        })
    }
    // 닫기버튼
    $('.close').on("click", function () {
        $('.profile__pw__update__wrap').hide();
        $('input[name=current_pw]').val('');
        $('input[name=update_pw]').val('');
        $('input[name=check_update_pw]').val('');
        $('.profile__tel__update__wrap').hide();
        $('.profile__tel__update__confirm__wrap').hide();
        $('.profile__account__delete__wrap').hide();
        $('.profile__set__wrap').show();
    });


</script>