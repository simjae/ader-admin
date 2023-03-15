<style>
    .profile__wrap {
        margin: 40px 0 100px;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }

    .profile__wrap .title p {
        font-size: 13px;
    }

    .profile__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: grid;
        gap: 10px;
        grid-template-columns: 80px 80px 80px 90px 80px;
        font-size: 11px;
    }

    .profile__tab__wrap {
        width: 470px;
        margin: 0 auto;
    }

    .profile__wrap .contents__table {
        border: none;
        width: 100%;
        padding: 0;
        margin: 0;
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
    }

    .list__delivery__wrap {
        display: block;
        font-size: 11px;
        color: #343434;
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
        margin-bottom: 10px;
    }

    .profile__tab .title {
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
        padding: 0 20px 20px;
    }

    .update_btn {
        height: 24px;
        width: 50px;
        border: 1px solid #808080;
    }

    .pw_form input {
        margin-bottom: 10px;
    }

    .pw_form .none_margin_bottom {
        margin-bottom: 0;
    }

    .profile__tel__update__wrap {
        border: 1px solid #808080;
        padding: 0 20px;
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

    .delivery_table_wrap {
        display: flex;
        flex-direction: column;
    }

    .profile__wrap .default_destination {
        width: 100%;
        display: flex;
        flex-direction: column;
        margin: 0;
    }

    .profile__wrap .other_destination {
        height: auto;
        width: auto;
        display: flex;
        flex-direction: column;
        border-bottom: solid 1px #dcdcdc;
    }

    .keyword_label {
        display: none;
    }

    .code6 {
        display: none;
    }

    .code5 {
        font-size: 11px;
        font-family: var(--ft-fu);
        width: 34px;
    }

    .order__to__update__wrap {
        width: 470px;
    }

    .profile__wrap .keyword {
        height: 40px;
    }

    .profile__wrap .search_button {
        width: 110px;
        height: 40px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        text-align: center;
        color: #fff;
        cursor: pointer;
        border-radius: 1px;
        background-color: #191919;
        float: right;
    }

    .postcode_search_status {
        font-family: var(--ft-no);
        font-size: 11px;
        border: solid 1px #dcdcdc;
        padding: 23px 19px;
    }

    .postcode_search_controls {
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
        gap: 10px;
    }

    .post_change_result {
        width: 350px;
        max-height: 285px;
        margin: 0 !important;
        background-color: #fff;
        overflow: auto;
        border: 1px solid #808080;
        border-top: 0px;
        top: -32px;
    }

    .postcodify_search_result {
        font-family: var(--ft-no);
        font-size: 11px;
        height: 95px;
        border-bottom: solid 1px #dcdcdc;
        padding: 23px 19px;
    }

    .extra_info {
        display: none;
    }

    .old_addr-row span {
        color: #dcdcdc;
    }

    .addr-row>span {
        color: #dcdcdc;
    }

    .black__full__width__btn.new__delivery {
        width: 100%;
        margin-top: 20px;
    }

    .profile__tab {
        width: 100%;
        height: 100%;
    }

    .btn__area.profile {
        margin-top: 10px;
    }

    .black__full__width__btn.profile_save_btn,
    .white__full__width__btn.profile_save_btn {
        margin: 20px 0;
    }

    .btn_padding {
        border-bottom: 1px solid #dcdcdc;
    }

    .default_destination td,
    .other_destination td {
        padding-bottom: 0;
    }

    .profile_btn_padding {
        padding-top: 40px;
    }

    @media (max-width: 1024px) {

        .profile__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .profile__wrap {
            margin: 20px 0 60px;
        }

        .profile__tab__btn__container {
            gap: 5px;
            grid-template-columns: 60px 60px 60px 70px 70px;
        }

        .profile__wrap .contents__table {
            width: 100%;
        }

        .profile__tab__wrap table {
            width: 100%;
        }

        .btn__area.profile {
            width: 100%;
        }

        .profile__pw__update__wrap {
            width: 100%;
            padding: 20px;
        }

        .pw_form input {
            width: 100%;
        }

        .profile__tel__update__wrap {
            padding: 20px 20px 0;
        }

        .profile__tel__update__wrap .black__btn {
            width: 100%;
        }

        .profile__delivery__wrap {
            width: 100%
        }

        .profile__account__delete__wrap {
            width: 100%;
            height: 100%;
        }

        .black__full__width__btn.profile_save_btn,
        .white__full__width__btn.profile_save_btn {
            margin: 10px 0;
        }

        .notice_br {
            display: inline;
        }

        .profile__tab .title {
            margin-top: 0;
        }

        .profile_btn_padding {
            padding-top: 30px;
        }
    }

    @media (min-width: 600px) {
        .profile__tab__wrap {
            width: 470px;
            margin: 0 auto;
            margin-top: 60px;
        }
    }

    @media (min-width: 1024px) {
        .profile__tab__wrap {
            grid-column: 1/17;
            width: 470px;
            margin: 0 auto;
            margin-top: 80px;
        }

        .notice_br {
            display: none;
        }
    }

    @media (max-width: 445px) {
        .profile__tab__btn__container {
            display: none;
        }
    }

    @media (min-width: 445px) {
        .profile__wrap .swiper.tab__btn {
            display: none;
        }
    }
</style>
<div class="profile__wrap">
    <div class="profile__tab__btn__container">
        <div class="tab__btn__item" form-id="profile__set__wrap">
            <span data-i18n="p_information">계정설정</span>
        </div>
        <div class="tab__btn__item" form-id="profile__credit__update__wrap">
            <span data-i18n="p_payment_method">결제수단</span>
        </div>
        <div class="tab__btn__item" form-id="profile__customize__purchase__wrap">
            <span data-i18n="p_preference">맞춤구매</span>
        </div>
        <div class="tab__btn__item" form-id="profile__delivery__wrap" onclick="getOrderToList()">
            <span data-i18n="p_address">배송지목록</span>
        </div>
        <div class="tab__btn__item" form-id="profile__marketing__wrap" onclick="getMarketingCheck()">
            <span data-i18n="p_subscription">마케팅설정</span>
        </div>
    </div>
    <div class="swiper tab__btn">
        <div class="swiper-wrapper">
            <div class="swiper-slide tab__btn__item" form-id="profile__set__wrap">
                <span>계정설정</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="profile__credit__update__wrap">
                <span>결제수단</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="profile__customize__purchase__wrap">
                <span>맞춤구매</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="profile__delivery__wrap" onclick="getOrderToList()">
                <span>배송지목록</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="profile__marketing__wrap" onclick="getMarketingCheck()">
                <span>마케팅설정</span>
            </div>
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
                            <td style="padding-top:0px;" data-i18n="p_full_name">이름</td>
                            <td style="padding-top:0px;">
                                <?= $_SESSION['MEMBER_NAME'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-i18n="p_email">이메일</td>
                            <td>
                                <?= $_SESSION['MEMBER_EMAIL'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-i18n="p_password">비밀번호</td>
                            <td>**************
                                <input class="user_update_pw" type="hidden">
                            </td>
                            <td>
                                <button class="update_btn" action-type="pw_update"
                                    onclick="buttonAction(this)">수정</button>
                            </td>
                        </tr>
                        <tr>
                            <td data-i18n="p_mobile">휴대전화</td>
                            <td>
                                <?= $_SESSION['TEL_MOBILE'] ?>
                                <input class="user_update_tel" type="hidden">
                            </td>
                            <td>
                                <button class="update_btn" action-type="tel_update"
                                    onclick="buttonAction(this)">수정</button>
                            </td>
                        </tr>
                        <tr>
                            <td data-i18n="p_birth">생년월일</td>
                            <td>
                                <?= $_SESSION['MEMBER_BIRTH'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="btn__area profile">
                <div class="btn_padding">
                    <button class="black__full__width__btn profile_save_btn" action-type="to_main" data-i18n="p_save"
                        onclick="putMemberPwAndTel()">저장</button>
                </div>
                <div>
                    <button class="white__full__width__btn profile_save_btn" action-type="move_account_del"
                        data-i18n="p_delete_account_01" onclick="buttonAction(this)">계정삭제</button>
                </div>
            </div>
            <div class="footer"></div>
        </div>

        <div class="profile__tab profile__pw__update__wrap">
            <div class="title" style="height:20px;">
                <p style="margin-bottom: 20px;">비밀번호 변경</p>
                <div class="close" onclick="closeTab(this)" action-type="close_pw_update">
                    <img src="/images/mypage/tmp_img/X-12.svg" />
                </div>
            </div>
            <div class="description pw_update_error" style="width:100%;height:16.5px;">
                <p style="color:red;text-align:right;">&nbsp;</p>
            </div>
            <div class="pw_form">
                <input class="current_pw" type="password" placeholder="현재 비밀번호"
                data-i18n="ns:key" data-i18n-target=".current_pw">
                <input class="tmp_update_pw" type="password" placeholder="새로운 비밀번호">
                <input class="tmp_update_pw_check none_margin_bottom" type="password" placeholder="새로운 비밀번호 확인">
            </div>

            <div style="margin-top:10px;" class="contents_margin">
                <p data-i18n="p_password_requirements">비밀번호 입력 조건</p>
            </div>

            <div class="contents_margin" style="margin-bottom:5px;">
                <p data-i18n="p_password_msg_01">·&nbsp;&nbsp;대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자</p>
                <p data-i18n="p_special_character_msg">·&nbsp;&nbsp;입력 가능 특수문자</p>
                <p data-i18n="p_change_password">&nbsp;&nbsp;&nbsp;!@#$%^()_-={}[]|;:<>,.?/</p>
                <p data-i18n="p_blank_character_msg">·&nbsp;&nbsp;공백 입력 불가능</p>
            </div>

            <div>
                <button class="black__btn" action-type="fin_pw_update" style="margin-top: 15px;" data-i18n="p_change"
                    onclick="checkMemberPw()">변경</button>
            </div>
        </div>
        <div class="profile__tab profile__tel__update__wrap">
            <div class="title">
                <p style="margin-bottom: 40px;" data-i18n="p_change_mobile_number">휴대전화 번호 변경</p>
                <div class="close" onclick="closeTab(this)" action-type="close_tel_update">
                    <img src="/images/mypage/tmp_img/X-12.svg" />
                </div>
            </div>
            <div>
                <p data-i18n="p_member_msg_01"> 일회성 인증번호 발송을 위해 휴대폰 번호를 입력해 주세요.</p>
            </div>
            <div class="description tel_update_error" style="width:100%;height:16.5px;margin-bottom: 4px;">
                <p style="color:red;text-align:right;">&nbsp;</p>
            </div>
            <div class="pw_form" style="margin-bottom: 10px;">
                <input type="text" name="tel_certificate" placeholder="( - ) 없이 숫자만 입력">
            </div>
            <div>
                <p data-i18n="p_member_msg_03" style="margin-bottom: 5px;">·&nbsp;&nbsp;통신 요금제에 따라 문자메시지 발송 비용이 발생할 수
                    있으며,</p>
                <p style="margin-bottom: 10px;">&nbsp;&nbsp;&nbsp;통신사의 문제로 인해 문자 메시지 발송이 지연될 수 있습니다.</p>
                <p data-i18n="p_privacy_policy_01" style="margin-bottom: 36px;">·&nbsp;&nbsp;<span
                        class="underline">개인정보처리방침</span> 및 <span class="underline">이용약관</span></p>
            </div>
            <div class="input__form__rows">
                <label>
                    <input id="ck_sendcode_phone" type="checkbox" style="margin:0 10px 3px 0;">
                    <span data-i18n="p_member_msg_04">문자메시지 1회 수신을 위한 개인정보처리방침 및 이용약관 동의</span><span class="alertms_tel"
                        style="color:red;text-align:right;"></span>
                </label>
            </div>
            <button class="black__btn" style="margin: 20px 0;" action-type="send_code"
                onclick="buttonAction(this)">코드전송</button>
        </div>
        <div class="profile__tab profile__tel__update__confirm__wrap">
            <div class="title" style="margin-bottom: 14px;">
                <p data-i18n="p_change_mobile_number">휴대전화 번호 변경</p>
                <div class="close" onclick="closeTab(this)" action-type="close_tel_update_confirm">
                    <img src="/images/mypage/tmp_img/X-12.svg" />
                </div>
            </div>
            <div>
                <p style="margin: 0;">·&nbsp;&nbsp;+82 01055665656</p>
                <p style="margin: 5px 0 10px 0;" data-i18n="p_member_msg_05">&nbsp;&nbsp;인증 코드가 전송되었습니다.</p>
            </div>
            <div class="pw_form">
                <input type="text" name="tel_insert" placeholder="인증 번호 입력" style="margin-bottom: 5px;">
                <p style="float: right;" data-i18n="p_resend_in_30">30초 내에 재전송</p>
            </div>
            <div class="contents_margin">
                <p data-i18n="p_member_msg_03">·&nbsp;&nbsp;통신 요금제에 따라 문자메시지 발송 비용이 발생할 수 있으며,</p>
                <p data-i18n="">&nbsp;&nbsp;통신사의 문제로 인해 문자 메시지 발송이 지연될 수 있습니다.</p>
            </div>
            <div>
                <button class="white__btn" style="margin-top: 48px;" data-i18n="p_resend_the_code">인증 코드
                    재전송</button>
                <button class="black__btn" style="margin: 10px 0 20px 0;" action-type="fin_check"
                    onclick="buttonAction(this)" data-i18n="p_verified">인증완료</button>
            </div>
        </div>
        <div class="profile__tab profile__account__delete__wrap">
            <div class="title" style="height:19px;">
                <p data-i18n="p_delete_account_02">계정삭제</p>
                <div class="close" onclick="closeTab(this)" action-type="close_account_delete">
                    <img src="/images/mypage/tmp_img/X-12.svg" />
                </div>
            </div>
            <div class="contents_margin">
                <p data-i18n="p_member_msg_06">·&nbsp;&nbsp;부정 이용을 방지하기 위하여 회원탈퇴 후 48시간 이내로 재가입이 불가합니다.</p>
                <p data-i18n="p_member_msg_07">·&nbsp;&nbsp;탈퇴 즉시 개인정보가 삭제되고 어떠한 방법으로도 복원할 수 없습니다.</p>
                <p data-i18n="p_member_msg_08" style="margin-bottom:53px;line-height:2;">·&nbsp;&nbsp;교환, 반품, 환불 및
                    사후처리(A/S)등을 위하여 전자상거래 등에서의</br>
                    &nbsp;&nbsp;&nbsp;소비자보호에 관한 법률에 의거해 일정 기간동안 보관 후 파기됩니다.</p>
            </div>
            <div class="input__form__rows">
                <label>
                    <input id="ck_account_delete" type="checkbox" style="margin:0 10px 3px 0;">
                    <span data-i18n="p_member_msg_09">위 유의사항을 모두 확인하였고, 계정 삭제에 동의합니다.</span>
                </label>
            </div>
            <div style="text-align:right;">
                <p class="alertms_del" style="color:red;">&nbsp;</p>
            </div>
            <div>
                <button class="white__btn" style="margin: 10px 0;" action-type="del_cancel"
                    onclick="buttonAction(this)">취소</button>
                <button class="black__btn" action-type="account_del" onclick="buttonAction(this)"
                    data-i18n="p_delete_account_02">계정삭제</button>
            </div>
        </div>
        <div class="profile__tab profile__credit__update__wrap">
            <div class="title">
                <p style="margin-bottom: 10px;" data-i18n="p_save_pay">결제수단 저장</p>
            </div>
            <div class="description">
                <p data-i18n="p_member_msg_10">&nbsp;&nbsp;빠른 주문 결제를 위해 결제수단을 미리 입력해두세요.</p>
            </div>
            <div class="input__form__wrap" style="margin-top:20px;">
                <div class="input__form__rows">
                    <div class="rows__title" data-i18n="p_card_full_name">카드 명의</div>
                    <input placeholder="이름"></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title" data-i18n="p_card_number">카드번호</div>
                    <input placeholder="( - ) 없이 숫자만 입력"></input>
                </div>
                <div class="input__form__rows">
                    <div class="rows__title" data-i18n="p_expiration_date">유효기간</div>
                    <div style="display:flex; margin-bottom:10px;">
                        <select id="inquiry__type" name="inquiry__type" style="margin-right:10px;">
                            <option name="inquiry__type" selected>1</option>
                            <option name="inquiry__type">2</option>
                            <option name="inquiry__type">3</option>
                            <option name="inquiry__type">4</option>
                            <option name="inquiry__type">5</option>
                            <option name="inquiry__type">6</option>
                            <option name="inquiry__type">7</option>
                            <option name="inquiry__type">8</option>
                            <option name="inquiry__type">9</option>
                            <option name="inquiry__type">10</option>
                            <option name="inquiry__type">11</option>
                            <option name="inquiry__type">12</option>
                        </select>
                        <select id="inquiry__type" name="inquiry__type">
                            <option name="inquiry__type" selected>2023</option>
                            <option name="inquiry__type">2024</option>
                            <option name="inquiry__type">2025</option>
                            <option name="inquiry__type">2026</option>
                            <option name="inquiry__type">2027</option>
                        </select>
                    </div>
                </div>
                <div class="input__form__rows">
                    <label>
                        <input type="checkbox">
                        <span data-i18n="p_default_pay_method">기본 결제수단으로 저장</span>
                    </label>
                </div>
                <div class="profile_btn_padding">
                    <button class="black__full__width__btn account" data-i18n="p_save">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__credit__list__wrap">
        </div>
        <div class="profile__tab profile__customize__purchase__wrap">
            <div class="title">
                <p style="margin-bottom: 10px;" data-i18n="p_set_preferences">구매 맞춤 정보 설정</p>
            </div>
            <div class="description" data-i18n="p_payment_msg_01">
                <p>&nbsp;&nbsp;구매 전 사이즈를 선택할 수 있도록 사이즈 정보를 제공해 주세요.</p>
            </div>
            <div class="input__form__wrap" style="margin-top:20px;">
                <div class="input__form__rows">
                    <div class="rows__title" data-i18n="p_gender">성별</div>
                    <div style="margin-top:10px;margin-bottom:30px;">
                        <label>
                            <input type="radio" name="gender" checked>
                            <span data-i18n="p_woman">여성</span>
                        </label>
                        <div style="height:10px;"></div>
                        <label>
                            <input type="radio" name="gender">
                            <span data-i18n="p_man">남성</span>
                        </label>
                    </div>
                </div>
                <div class="input__form__rows">
                    <div data-i18n="p_top_size" class="rows__title">상의 사이즈</div>
                    <select></select>
                </div>
                <div class="input__form__rows">
                    <div data-i18n="p_bottom_size" class="rows__title">하의 사이즈</div>
                    <select></select>
                </div>
                <div class="input__form__rows">
                    <div data-i18n="p_shoes_size" class="rows__title">신발 사이즈</div>
                    <select></select>
                </div>
                <div class="profile_btn_padding">
                    <button class="black__full__width__btn" style="font-size: 11px;" data-i18n="p_save">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__delivery__wrap">
            <div class="list__delivery__wrap">
                <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                    <p data-i18n="p_default_address" style="font-size: 13px; padding-bottom: 9.5px"
                        data-i18n="p_default_address">기본 배송지</p>
                </div>
                <table style="width:100%">
                    <tbody class="default__list delivery_table_wrap">
                    </tbody>
                </table style="width:100%">
                <div class="other_list_wrap">
                    <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                        <p data-i18n="p_other_address" style="font-size: 13px; padding-bottom: 9.5px"
                            data-i18n="p_other_address">다른 배송지</p>
                    </div>
                    <table style="width:100%">
                        <tbody class="other__list delivery_table_wrap">
                        </tbody>
                    </table>
                </div>
                <button class="black__full__width__btn new__delivery" action-type="add_order_to"
                    data-i18n="p_add_address" onclick="buttonAction(this)" data-i18n="p_add_address">새로운 배송지 추가</button>
            </div>
        </div>

        <div class="profile__tab input__form__wrap order__to__update__wrap" style="display:none; margin-top:20px;">
            <div class="close" onclick="closeTab(this)" action-type="close_order_to_update" style="float: right;">
                <img src="/images/mypage/tmp_img/X-12.svg" />
            </div>
            <div class="description delivery_regist_error" style="width:100%;height:16.5px;margin-bottom: 4px;">
                <p style="clear:both;color:red;text-align:right;">&nbsp;</p>
            </div>
            <div class="input__form__rows">
                <input class="hidden_order_to_idx" type="hidden" value="0">
                <div class="rows__title">배송지명</div>
                <input class="order_to_place"></input>
            </div>
            <div class="input__form__rows">
                <div data-i18n="p_full_name" class="rows__title">이름</div>
                <input class="order_to_name"></input>
            </div>
            <div class="input__form__rows">
                <div data-i18n="p_mobile" class="rows__title">전화번호</div>
                <input class="order_to_mobile"></input>
            </div>
            <div class="input__form__rows">
                <div class="rows__title" style="margin-top: 3px;">주소</div>
                <div id="postcodify" class="input_row"></div>
                <div class="input_row" style="clear: both; position: absolute;">
                    <div class="post_change_result"></div>
                </div>
                <div class="rows__contnets" style="margin: 10px 0 0 0;">
                    <input type="hidden" class="order_to_zipcode" name="zipcode">
                    <input type="hidden" class="order_to_lot_addr" name="lot_addr">
                    <input type="hidden" class="order_to_road_addr" name="road_addr">
                    <input type="text" class="order_to_detail_addr" placeholder="상세주소"
                        style="margin-top:0px;margin-bottom:10px;"></input>
                </div>
            </div>
            <div class="input__form__rows">
                <label style="display: flex; align-items: center;">
                    <input class="order_to_default_flg" type="checkbox">
                    <span style="margin-left: 10px;">기본 배송지로 저장</span>
                </label>
            </div>
            <div class="profile_btn_padding">
                <button class="black__full__width__btn" onclick="checkOrderToAction()" data-i18n="p_save">저장</button>
            </div>
            <div class="footer"></div>
        </div>

        <div class="profile__tab profile__delivery__lsit__wrap">
        </div>
        <div class="profile__tab profile__marketing__wrap">
            <div class="title">
                <p style="margin-bottom: 10px;" data-i18n="p_subscription_preferences">마케팅 정보 수신 및 활용 동의</p>
            </div>
            <div class="description">
                <p data-i18n="p_receive_news">&nbsp;&nbsp;제품, 할인 정보, 멤버 혜택 관련 최신 소식을 받아보세요.</p>
            </div>
            <div style="margin-top:20px; margin-bottom:20px;">
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="all_check" type="checkbox" onclick="marketingCheckAll()">
                        <span data-i18n="p_select_all">전체동의</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check email_check" type="checkbox" onclick="marketingCheckOne()">
                        <span data-i18n="p_subscribe_email">이메일로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check sms_check" type="checkbox" onclick="marketingCheckOne()">
                        <span data-i18n="p_subscribe_sms">SMS로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check tel_check" type="checkbox" onclick="marketingCheckOne()">
                        <span data-i18n="p_subscribe_call">전화로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
            </div>
            <div class="description" style="margin-bottom:40px; width: 420px;">
                <p> · 귀하의 개인정보를 이용하는 방법 및 귀하의 개인정보 접근,<br class="notice_br">변경 및 삭제 요청 방법에 대한
                    자세한 정보는<br class="notice_br"><span class="underline" style="cursor:pointer"
                        onclick="mypageTabBtnClick('service', 3)">개인정보취급방침</span>을 확인하시기 바랍니다.
                </p>
            </div>
            <button class="black__full__width__btn" onclick="putMarketingCheck()" data-i18n="p_save">저장</button>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
    //$(".pw_form").localize();
    $(function () {
        $('#postcodify').postcodify({
            insertPostcode5: ".order_to_zipcode",
            insertAddress: ".order_to_road_addr",
            insertDetails: ".order_to_detail_addr",
            insertJibeonAddress: ".order_to_lot_addr",
            hideOldAddresses: false,
            results: ".post_change_result",
            hideSummary: true,
            useFullJibeon: true,
            onReady: function () {
                $('.post_change_result').hide();
                $(".postcodify_search_controls .keyword").attr("placeholder", "예) 성동구 연무장길 53, 성수동2가 315-57");
            },
            onSuccess: function () {
                $('.post_change_result').show();
                $("#postcodify div.postcode_search_status.too_many").hide();
            },
            afterSelect: function (selectedEntry) {
                $("#postcodify div.postcode_search_result").remove();
                $("#postcodify div.postcode_search_status.too_many").hide();
                $("#postcodify div.postcode_search_status.summary").hide();
                $('.post_change_result').hide();
                $("#entry_box").show();
                $("#entry_details").focus();
                $(".postcodify_search_controls .keyword").val($('.order_to_road_addr').val());
            }
        })
    })

    $('.profile__tab').hide();
    $('.profile__set__wrap').show();

    function buttonAction(obj) {
        $('.tel_update_error p').html('&nbsp');
        $('.pw_update_error p').html('&nbsp');
        $('.profile__tab').hide();
        $('.alertms_del').html('');

        var action_type = $(obj).attr('action-type');
        let order_to_idx = $(obj).attr('idx');
        let tel_err_str = '';
        let drop_err_str = '';
        switch (action_type) {
            case 'pw_update':
                $('.profile__pw__update__wrap').show();
                break;
            case 'tel_update':
                $('.profile__tel__update__wrap').show();
                $('#ck_sendcode_phone').prop('checked', false);
                $('.alertms_del').html('');
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
                if ($('input[name="tel_certificate"]').val() == '') {
                    $('.profile__tel__update__wrap').show();
                    tel_err_str = '휴대전화 번호를 입력해주세요';
                }
                else {
                    if ($('#ck_sendcode_phone').is(':checked') == true) {
                        sendCode();
                    }
                    else {
                        $('.profile__tel__update__wrap').show();
                        tel_err_str = '약관동의를 체크해주세요';
                    }
                }
                $('.tel_update_error p').text(tel_err_str);
                break;
            case 'fin_check':
                $('.profile__set__wrap').show();
                break;
            case 'close':
                $('.profile__tel__update__confirm__wrap').show();
                break;
            case 'move_account_del':
                $('.profile__account__delete__wrap').show();
                break;
            case 'account_del':
                drop_err_str = '계정 삭제 동의란을 선택해주세요';
                if ($('#ck_account_delete').is(':checked') == true) {
                    accountDel();
                    $('#ck_account_delete').prop('checked', false);
                }
                else {
                    $('.profile__account__delete__wrap').show();
                    $('.alertms_del').text(drop_err_str);
                }
                break;
            case 'update_order_to':
                $('.hidden_order_to_idx').val(order_to_idx);
                getOrderTo();
                $('.order__to__update__wrap').show();
                break;
            case 'add_order_to':
                $('.order__to__update__wrap').show();
        }
    }

    function accountDel() {
        let country = ''
        let member_idx = ''
        $.ajax(
            {
                url: "http://116.124.128.246:80/_api/account/delete",
                type: 'POST',
                data: {
                    'country': country,
                    'member_idx': member_idx
                },
                error: function (data) {
                    exceptionHandling("계정", "계정 탈퇴를 수행하지 못했습니다.");
                },
                success: function (data) {

                    if (data.code == "200") {
                        exceptionHandling("계정", "계정탈퇴를 완료했습니다.");
                        $('.alertms_del').html('');
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                    else {
                        let err_str = '계정 탈퇴를 수행하지 못했습니다.';
                        if (d.msg != null) {
                            err_str = d.msg;
                        }
                        exceptionHandling("계정", err_str);
                        if (d.code = 401) {
                            $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                        }
                    }
                },
                complete: function (data) {

                },
                dataType: 'json'
            }
        );
    }

    function sendCode() {
        console.log("코드전송")
        $('.profile__tel__update__confirm__wrap').show();
    }

    function checkMemberPw() {
        let current_pw = $('.current_pw').val();
        let tmp_update_pw = $('.tmp_update_pw').val();
        let tmp_update_pw_check = $('.tmp_update_pw_check').val();

        //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
        //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
        var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)`!^\-_<>@\#$%\=\(]{8,16}/;
        //  공백 입력 불가능
        var space_reg = /\s/g;

        // if문 정리 ajax는 현재 비밀번호와 체크하는 것만 / 나머지는 뷰 쪽에서 처리 하도록
        if (current_pw.length == 0 || tmp_update_pw.length == 0 || tmp_update_pw_check.length == 0) {
            $('.pw_update_error p').text('모든 항목을 기입해야만 비밀번호 변경이 가능합니다.');
            return false;
        }

        if (space_reg.test(tmp_update_pw) == true) {
            $('.pw_update_error p').text('변경하려는 비밀번호의 공백을 확인해주세요.');
            return false;
        }

        if (password_reg.test(tmp_update_pw) == false) {
            $('.pw_update_error p').text('변경하려는 비밀번호의 형식을 확인해주세요.');
            return false;
        }

        if (tmp_update_pw != tmp_update_pw_check) {
            $('.pw_update_error p').text('비밀번호 확인란에 동일한 비밀번호를 입력해주세요.');
            return false;
        }

        if (current_pw == tmp_update_pw || current_pw == tmp_update_pw_check) {
            $('.pw_update_error p').text('현재 비밀번호와 다르게 설정해주세요.');
            return false;
        }

        $.ajax({
            type: "post",
            data: {
                "member_pw": current_pw
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/account/check",
            error: function () {
                exceptionHandling("계정", '회원정보가 올바르지 않습니다.');
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    $('.user_update_pw').val(tmp_update_pw);
                    $('.current_pw').val('');
                    $('.tmp_update_pw').val('');
                    $('.tmp_update_pw_check').val('');
                    $('.profile__pw__update__wrap').hide();
                    $('.profile__set__wrap').show();
                } else {
                    let err_str = '회원정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                    return false;
                }
            }
        });
    }

    function putMemberPwAndTel() {
        let user_update_pw = $('.user_update_pw').val();
        let user_update_tel = $('.user_update_tel').val();
        if (user_update_pw.length > 0 || user_update_tel.length > 0) {
            $.ajax({
                type: "post",
                data: {
                    "member_pw": user_update_pw,
                    "member_tel_mobile": user_update_tel
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/account/put",
                error: function () {
                    exceptionHandling("계정", "계정정보 변경에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        $('.user_update_pw').val('');
                        $('.user_update_tel').val('');
                    }
                    else {
                        let err_str = '회원정보가 올바르지 않습니다.';
                        if (d.msg != null) {
                            err_str = d.msg;
                        }
                        exceptionHandling("계정", err_str);
                        if (d.code = 401) {
                            $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                        }
                    }
                }
            });
        } else {
            exceptionHandling("계정", "수정된 정보가 없습니다.");
            return false;
        }
    }
    let countryData = getLanguage();
    function getOrderToList() {
        $('.order__to__update__wrap').hide();

        let delivery_table = $('.delivery_table_wrap');
        delivery_table.html('');
        $.ajax({
            type: "post",
            data: {
                "country": countryData
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/order_to/list/get",
            error: function () {
                exceptionHandling("계정", "배송지 목록을 불어오는데 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data;
                    if (data != null) {
                        if (data.length <= 1) {
                            $('.other_list_wrap').hide();
                            $('.profile__wrap .default__list').css('margin-bottom', '0px');
                        } else {
                            $('.other_list_wrap').show();
                            $('.profile__wrap .default__list').css('margin-bottom', '100px');
                        }
                        let headData = data[0];
                        let tailData = data.slice(1);
                        let defaultList = $('.default__list');
                        let otherList = $('.other__list');
                        let strDiv = '';

                        defaultList.html('');
                        strDiv += '<tr class="default_destination">';
                        strDiv += '<td>' + headData.to_place + '</td>';
                        strDiv += '<td>' + headData.to_name + '</td>';
                        strDiv += '<td>' + headData.to_mobile + '</td>';
                        let addr = headData.to_road_addr ? headData.to_road_addr : headData.to_lot_addr;
                        let detailAddr = headData.to_detail_addr ? (' ' + headData.to_detail_addr) : '';
                        strDiv += '<td>' + addr + detailAddr + '</td>';
                        strDiv += '<td>' + headData.to_zipcode + '</td>';
                        strDiv += '<td style="padding-right: 0; margin-top: 20px;">';
                        strDiv += '     <div style="width: 100%; display: grid; grid-template-columns: 1fr 1fr; column-gap: 10px;">';
                        strDiv += '     <button class="gray__mypage__btn" idx="' + headData.order_to_idx + '" action-type="update_order_to" onclick="buttonAction(this)">수정</button>';
                        strDiv += '     <button class="white__full__width__btn" idx="' + headData.order_to_idx + '" action-type="delete_order_to" onclick="deleteOrderTO(this)">삭제</button>';
                        strDiv += '</div>';
                        strDiv += '</td>';
                        strDiv += '</tr>';
                        defaultList.append(strDiv);

                        strDiv = '';
                        otherList.html('');
                        tailData.forEach((row) => {
                            strDiv += '<tr class="other_destination">';
                            strDiv += '<td style="display: flex; justify-content: space-between; padding-right: 0;">';
                            strDiv += '<div>' + row.to_place + '</div>';
                            // strDiv +=          '<div class="order_to_idx" idx="' + row.order_to_idx + '" onclick="changeDefaultOrderTo(this)">';
                            // strDiv +=              '<img src="/images/mypage/tab/select_delivery_default_change_btn.svg">';
                            // strDiv +=          '</div>';
                            strDiv += '<button class="order_to_idx" idx="' + row.order_to_idx + '" onclick="changeDefaultOrderTo(this)" style="text-decoration: underline;" data-i18n="p_set_default_address" >기본 배송지로 설정</button>';
                            strDiv += '</td>';
                            strDiv += '<td>' + row.to_name + '</td>';
                            strDiv += '<td>' + row.to_mobile + '</td>';
                            let addr = row.to_road_addr ? row.to_road_addr : row.to_lot_addr;
                            let detailAddr = row.to_detail_addr ? (' ' + row.to_detail_addr) : '';
                            strDiv += '<td>' + addr + detailAddr + '</td>';
                            strDiv += '<td>' + row.to_zipcode + '</td>';
                            strDiv += '<td style="padding-right: 0; margin-top: 20px; padding-bottom: 20px;">';
                            strDiv += '<div style="width: 100%; display: grid; grid-template-columns: 1fr 1fr; column-gap: 10px;">';
                            strDiv += '     <button class="gray__mypage__btn" idx="' + row.order_to_idx + '" action-type="update_order_to" onclick="buttonAction(this)">수정</button>';
                            strDiv += '     <button class="white__full__width__btn" idx="' + row.order_to_idx + '" action-type="delete_order_to" onclick="deleteOrderTO(this)">삭제</button>';
                            strDiv += '</div>';
                            strDiv += '</td>';
                            strDiv += '</tr>';
                        });
                        otherList.append(strDiv);
                    }
                    else {
                        $('.other_list_wrap').hide();
                    }
                }
                else {
                    let err_str = '회원정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        })
    }

    function getOrderTo() {
        let order_to_idx = $('.hidden_order_to_idx').val();
        if (order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx,
                    "country": countryData
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/get",
                error: function () {
                    exceptionHandling("계정", '배송지 개별정보 조회에 실패했습니다');
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        let data = d.data;
                        if (data != null) {
                            let row = data[0];
                            $('.order_to_place').val(row.to_place);
                            $('.order_to_name').val(row.to_name);
                            $('.order_to_mobile').val(row.to_mobile);
                            $('.order_to_zipcode').val(row.to_zipcode);
                            $('.order_to_lot_addr').val(row.to_lot_addr);
                            $('.order_to_road_addr').val(row.to_road_addr);
                            let addr = row.to_road_addr ? row.to_road_addr : row.to_lot_addr;
                            $('.keyword').val(addr);
                            $('.order_to_detail_addr').val(row.to_detail_addr);
                            let flg = row.default_flg == 1 ? true : false;
                            $('.order_to_default_flg').prop('checked', flg);
                        }
                    }
                    else {
                        let err_str = '회원정보가 올바르지 않습니다.';
                        if (d.msg != null) {
                            err_str = d.msg;
                        }
                        exceptionHandling("계정", err_str);
                        if (d.code = 401) {
                            $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                        }
                    }
                }
            })
        }
    }

    function deleteOrderTO(obj) {
        let order_to_idx = $(obj).attr('idx');
        if (order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx,
                    "country": countryData
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/delete",
                error: function () {
                    exceptionHandling("계정", '배송지 삭제에 실패했습니다.');
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        getOrderToList();
                    }
                    else {
                        let err_str = '회원정보가 올바르지 않습니다.';
                        if (d.msg != null) {
                            err_str = d.msg;
                        }
                        exceptionHandling("계정", err_str);
                        if (d.code = 401) {
                            $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                        }
                    }
                }
            })
        }
    }

    function changeDefaultOrderTo(obj) {
        // let changeConfirm = confirm("기본 배송지를 변경하시겠습니까?");
        let order_to_idx = $(obj).attr('idx');
        let default_flg = true;
        if (order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx,
                    "default_flg": default_flg,
                    "country": countryData
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/put",
                error: function () {
                    exceptionHandling("계정", '기본 배송지 변경에 실패했습니다.');
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        getOrderToList();
                        // $('.profile__delivery__wrap').show();
                    }
                    else {
                        let err_str = '회원정보가 올바르지 않습니다.';
                        if (d.msg != null) {
                            err_str = d.msg;
                        }
                        exceptionHandling("계정", err_str);
                        if (d.code = 401) {
                            $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                        }
                    }
                }
            })
        }
    }

    function checkOrderToAction() {
        let order_to_idx = $('.hidden_order_to_idx').val();
        if (order_to_idx > 0) {
            putOrderToInfo(order_to_idx);
        } else {
            addOrderToInfo();
        }
    }

    function addOrderToInfo() {
        $('.delivery_regist_error p').html('&nbsp');

        let to_place = $('.order_to_place').val();
        if (to_place == '' || to_place == null) {
            $('.delivery_regist_error p').text("배송지명을 작성해주세요.");
            return false;
        }
        let to_name = $('.order_to_name').val();
        if (to_name == '' || to_name == null) {
            $('.delivery_regist_error p').text("이름을 작성해주세요.");
            return false;
        }
        let to_mobile = $('.order_to_mobile').val();
        if (to_mobile == '' || to_mobile == null) {
            $('.delivery_regist_error p').text("전화번호를 작성해주세요.");
            return false;
        }
        let to_zipcode = $('.order_to_zipcode').val();
        if (to_zipcode == '' || to_zipcode == null) {
            $('.delivery_regist_error p').text("우편번호를 작성해주세요.");
            return false;
        }

        let to_lot_addr = $('.order_to_lot_addr').val();
        if (to_lot_addr == '' || to_lot_addr == null) {
            $('.delivery_regist_error p').text("지번명주소를 작성해주세요.");
            return false;
        }

        let to_road_addr = $('.order_to_road_addr').val();
        if (to_road_addr == '' || to_road_addr == null) {
            $('.delivery_regist_error p').text("도로명주소를 작성해주세요.");
            return false;
        }

        let to_detail_addr = $('.order_to_detail_addr').val();
        let default_flg = $('.order_to_default_flg').is(':checked');

        $.ajax({
            type: "post",
            data: {
                "country": countryData,
                "to_place": to_place,
                "to_name": to_name,
                "to_mobile": to_mobile,
                "to_zipcode": to_zipcode,
                "to_lot_addr": to_lot_addr,
                "to_road_addr": to_road_addr,
                "to_detail_addr": to_detail_addr,
                "default_flg": default_flg
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/order_to/add",
            error: function () {
                exceptionHandling("배송지 추가에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    $('.order_to_place').val('');
                    $('.order_to_name').val('');
                    $('.order_to_mobile').val('');
                    $('.keyword').val('');
                    $('.order_to_zipcode').val('');
                    $('.order_to_lot_addr').val('');
                    $('.order_to_road_addr').val('');
                    $('.order_to_detail_addr').val('');
                    $('.order_to_default_flg').prop('checked', false);
                    $('.order__to__update__wrap').hide();

                    getOrderToList();

                    $('.other_list_wrap').show();
                    $('.profile__delivery__wrap').show();
                }
                else {
                    let err_str = '배송지정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        });
    }

    function putOrderToInfo(order_to_idx) {
        let to_place = $('.order_to_place').val();
        if (to_place == '' || to_place == null) {
            console.log("배송지명을 작성해주세요.");
            return false;
        }
        let to_name = $('.order_to_name').val();
        if (to_name == '' || to_name == null) {
            console.log("이름을 작성해주세요.");
            return false;
        }
        let to_mobile = $('.order_to_mobile').val();
        if (to_mobile == '' || to_mobile == null) {
            console.log("전화번호를 작성해주세요.");
            return false;
        }
        let to_zipcode = $('.order_to_zipcode').val();
        if (to_zipcode == '' || to_zipcode == null) {
            console.log("우편번호를 작성해주세요.");
            return false;
        }
        let to_lot_addr = $('.order_to_lot_addr').val();
        if (to_lot_addr == '' || to_lot_addr == null) {
            console.log("지번주소를 작성해주세요.");
            return false;
        }
        let to_road_addr = $('.order_to_road_addr').val();
        if (to_road_addr == '' || to_road_addr == null) {
            console.log("도로명주소를 작성해주세요.");
            return false;
        }
        let to_detail_addr = $('.order_to_detail_addr').val();
        let default_flg = $('.order_to_default_flg').is(':checked');

        $.ajax({
            type: "post",
            data: {
                "country": countryData,
                "order_to_idx": order_to_idx,
                "to_place": to_place,
                "to_name": to_name,
                "to_mobile": to_mobile,
                "to_zipcode": to_zipcode,
                "to_lot_addr": to_lot_addr,
                "to_road_addr": to_road_addr,
                "to_detail_addr": to_detail_addr,
                "default_flg": default_flg
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/order_to/put",
            error: function () {
                exceptionHandling("계정", "배송지 정보 변경에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    $('.hidden_order_to_idx').val(0);
                    $('.order_to_place').val('');
                    $('.order_to_name').val('');
                    $('.order_to_mobile').val('');
                    $('.keyword').val('');
                    $('.order_to_zipcode').val('');
                    $('.order_to_lot_addr').val('');
                    $('.order_to_road_addr').val('');
                    $('.order_to_detail_addr').val('');
                    $('.order_to_default_flg').prop('checked', false);
                    $('.order__to__update__wrap').hide();

                    getOrderToList();

                    $('.other_list_wrap').show();
                    $('.profile__delivery__wrap').show();
                }
                else {
                    let err_str = '배송지정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        })
    }
    function marketingCheckAll() {
        let all_check_flg = $('.all_check').is(':checked');
        if (all_check_flg == true) {
            $('.mkt_check').prop('checked', true);
        } else {
            $('.mkt_check').prop('checked', false);
        }
    }
    function marketingCheckOne() {
        let checkCnt = $('.mkt_check:checked').length;
        if (checkCnt == 3) {
            $('.all_check').prop('checked', true);
        } else {
            $('.all_check').prop('checked', false);
        }
    }
    function getMarketingCheck() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/marketing/get",
            error: function () {
                exceptionHandling("계정", "마케팅 정보 조회에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data;
                    if (data != null) {
                        let mktData = data[0];
                        let emailFlg = mktData.receive_email_flg == 1 ? true : false;
                        let smsFlg = mktData.receive_sms_flg == 1 ? true : false;
                        let telFlg = mktData.receive_tel_flg == 1 ? true : false;
                        $('.email_check').prop('checked', emailFlg);
                        $('.sms_check').prop('checked', smsFlg);
                        $('.tel_check').prop('checked', telFlg);
                        marketingCheckOne();
                    }
                }
                else {
                    let err_str = '배송지정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        })
    }
    function putMarketingCheck() {
        let receive_email_flg = $('.email_check').is(':checked');
        let receive_sms_flg = $('.sms_check').is(':checked');
        let receive_tel_flg = $('.tel_check').is(':checked');

        $.ajax({
            type: "post",
            data: {
                "receive_email_flg": receive_email_flg,
                "receive_sms_flg": receive_sms_flg,
                "receive_tel_flg": receive_tel_flg
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/marketing/put",
            error: function () {
                exceptionHandling("계정", "마케팅 정보 변경에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                }
                else {
                    let err_str = '회원정보가 올바르지 않습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("계정", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
            }
        })
    }
    // 닫기버튼
    function closeTab(obj) {
        let actionType = $(obj).attr('action-type');
        switch (actionType) {
            case 'close_pw_update':
                $('.current_pw').val('');
                $('.tmp_update_pw').val('');
                $('.tmp_update_pw_check').val('');
                $('.profile__pw__update__wrap').hide();
                $('.profile__set__wrap').show();
                break;
            case 'close_tel_update':
                $('.profile__tel__update__wrap').hide();
                $('.profile__set__wrap').show();
                break;
            case 'close_tel_update_confirm':
                $('.profile__tel__update__confirm__wrap').hide();
                $('.profile__set__wrap').show();
                break;
            case 'close_account_delete':
                $('.profile__account__delete__wrap').hide();
                $('.profile__set__wrap').show();
                break;
            case 'close_order_to_update':
                $('.hidden_order_to_idx').val(0);
                $('.order_to_place').val('');
                $('.order_to_name').val('');
                $('.order_to_mobile').val('');
                $('.keyword').val('');
                $('.order_to_zipcode').val('');
                $('.order_to_lot_addr').val('');
                $('.order_to_road_addr').val('');
                $('.order_to_detail_addr').val('');
                $('.order_to_default_flg').prop('checked', false);
                $('.post_change_result').hide();
                $('.order__to__update__wrap').hide();
                $('.profile__delivery__wrap').show();
        }
    }
</script>