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
    .delivery_table_wrap {
        display: flex;
        flex-direction: column;
    }
    .default_destination {
        height: 290px;
        width: 470px;
        display: flex;
        flex-direction: column;
    }
    .other_destination {
        height: 290px;
        width: 470px;
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
        width:34px;
    }
    .order__to__update__wrap {
        width: 470px;
    }
    .keyword {
        height: 40px;
        width: 350px;
        /* float: left; */
    }
    .search_button {
        width: 110px;
        height: 40px;
        margin-left:  10px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        text-align: center;
        color: #fff;
        cursor:pointer;
        border-radius: 1px;
        background-color: #191919;
        float:right;
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
    }
    .post_change_result {
        width: 350px;
        max-height: 285px;
        margin: 0!important;
        background-color: #fff;
        overflow: auto;
        border: 1px solid #808080;
        border-top: 0px;
        top: -32px;
    }
    .postcodify_search_result {
        font-family: var(--ft-no);
        font-size: 11px;
        height:95px;
        border-bottom: solid 1px #dcdcdc;
        padding: 23px 19px;
    }
    .extra_info {
        display: none;
    }
    .old_addr-row span {
        color: #dcdcdc;
    }
    .addr-row > span {
        color: #dcdcdc;
    }
    /* .address_info {
        color: #191919;
    } */
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
        <div class="tab__btn__item" form-id="profile__delivery__wrap" onclick="getOrderToList()">
            <img src="/images/mypage/tab/default_delivery_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="profile__marketing__wrap" onclick="getMarketingCheck()">
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
                            <td>**************
                                <input class="user_update_pw" type="hidden">
                            </td>
                            <td>
                                <button class="update_btn" action-type="pw_update" onclick="buttonAction(this)">수정</button>
                            </td>
                        </tr>
                        <tr>
                            <td>휴대전화</td>
                            <td>
                                <?= $_SESSION['TEL_MOBILE'] ?>
                                <input class="user_update_tel" type="hidden">
                            </td>
                            <td>
                                <button class="update_btn" action-type="tel_update" onclick="buttonAction(this)">수정</button>
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
                <div class="close" onclick="closeTab(this)" action-type="close_pw_update">
                    <img src="/images/mypage/tmp_img/X-12.svg"/>
                </div>
            </div>
			
            <div class="pw_form">
                <input class="current_pw" type="password" placeholder="현재 비밀번호">
                <input class="tmp_update_pw" type="password" placeholder="새로운 비밀번호">
                <input class="tmp_update_pw_check none_margin_bottom" type="password" placeholder="새로운 비밀번호 확인">
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
                <div class="close" onclick="closeTab(this)" action-type="close_tel_update">
                    <img src="/images/mypage/tmp_img/X-12.svg"/>
                </div>
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
                <div class="close" onclick="closeTab(this)" action-type="close_tel_update_confirm">
                    <img src="/images/mypage/tmp_img/X-12.svg"/>
                </div>
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
                <div class="close" onclick="closeTab(this)" actiom-type="close_account_delete">
                    <img src="/images/mypage/tmp_img/X-12.svg"/>
                </div>
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
                <div class="" style="padding-top:40px;">
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
                <div class="" style="padding-top:40px;">
                    <button class="black__full__width__btn" style="font-size: 11px;">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__delivery__wrap">
            <div class="list__delivery__wrap" style="display: block;">
                <div>
                    <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                        <p style="font-size: 13px; padding-bottom: 9.5px">기본 배송지</p>
                    </div>
                    <table>
                        <tbody class="default__list delivery_table_wrap">
                        </tbody>
                    </table>
                </div>
                <div class="other_list_wrap">
                    <div class="tilte" style="border-bottom: solid 1px #dcdcdc;">
                        <p style="font-size: 13px; padding-bottom: 9.5px">다른 배송지</p>
                    </div>
                    <table>
                        <tbody class="other__list delivery_table_wrap">
                        </tbody>
                    </table>
                </div>
                <div style="padding-top: 19.5px" action-type="update_order_to" onclick="buttonAction(this)">
                    <img src="/images/mypage/tab/select_delivery_add_btn.svg">
                </div>
            </div>
        </div>

        <div class="input__form__wrap order__to__update__wrap" style="display:none; margin-top:20px;">
			<div class="close" onclick="closeTab(this)" action-type="close_order_to_update" style="float: right;">
				<img src="/images/mypage/tmp_img/X-12.svg"/>
			</div>
			<div class="input__form__rows">
				<input class="hidden_order_to_idx" type="hidden" value="0">
				<div class="rows__title">배송지명</div>
				<input class="order_to_place"></input>
			</div>
			<div class="input__form__rows">
				<div class="rows__title">이름</div>
				<input class="order_to_name"></input>
			</div>
			<div class="input__form__rows">
				<div class="rows__title">전화번호</div>
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
					<input type="text" class="order_to_detail_addr" placeholder="상세주소" style="margin-top:0px;margin-bottom:10px;"></input>
				</div>
			</div>
			<div class="input__form__rows">
				<label style="display: flex; align-items: center;">
					<input class="order_to_default_flg" type="checkbox">
					<span style="margin-left: 10px;">기본 배송지로 저장</span>
				</label>
			</div>
			<div style="padding-top:40px;">
				<button class="black__full__width__btn" onclick="checkOrderToAction()">저장</button>
			</div>
			<div class="footer"></div>
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
                        <input class="all_check" type="checkbox" onclick="marketingCheckAll()">
                        <span>전체동의</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check email_check" type="checkbox" onclick="marketingCheckOne()">
                        <span>이메일로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check sms_check" type="checkbox" onclick="marketingCheckOne()">
                        <span>SMS로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
                <div class="input__form__rows marketing__receive">
                    <label>
                        <input class="mkt_check tel_check" type="checkbox" onclick="marketingCheckOne()">
                        <span>전화로 마케팅 소식을 수신하는데 동의합니다.</span>
                    </label>
                </div>
            </div>
            <div class="description" style="margin-bottom:30px;">
                <p>·&nbsp;귀하의 개인정보를 이용하는 방법 및 귀하의 개인정보 접근, 변경 및 삭제 요청 방법에 대한<br>
                    &nbsp;&nbsp;자세한 정보는 <span class="underline">개인정보취급방침</span>을 확인하시기 바랍니다.
                </p>
            </div>
            <button class="black__full__width__btn" onclick="putMarketingCheck()">저장</button>
            <div class="footer"></div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#postcodify').postcodify({
            insertPostcode5 : ".order_to_zipcode",
            insertAddress : ".order_to_road_addr",
            insertDetails : ".order_to_detail_addr",
            insertJibeonAddress : ".order_to_lot_addr",
			hideOldAddresses: false,
			results:".post_change_result",
			hideSummary:true,
			useFullJibeon:true,
            onReady: function() {
                $('.post_change_result').hide();
                $(".postcodify_search_controls .keyword").attr("placeholder","예) 성동구 연무장길 53, 성수동2가 315-57");
            },
            onSuccess: function() {
                $('.post_change_result').show();
                $("#postcodify div.postcode_search_status.too_many").hide();
            },
            afterSelect: function(selectedEntry) {
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

    $(document).mouseup(function(e) {
        let wrap = $('.order__to__update__wrap');
        if(!wrap.is(e.target) && wrap.has(e.target).length == 0) {
            wrap.hide();
            $('.profile__delivery__wrap').show();
        }
    })

    function buttonAction(obj) {
        $('.profile__tab').hide();

        var action_type = $(obj).attr('action-type');
        let order_to_idx = $(obj).attr('idx');
        let str = '체크를 해주세요';
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
                if ($('#ck_sendcode_phone').is(':checked') == true) {
                    sendCode();
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
                break;
            case 'account_del':
                if ($('#ck_account_delete').is(':checked') == true) {
                    accountDel();
                    $('#ck_account_delete').prop('checked', false);
                }
                else {
                    $('.profile__account__delete__wrap').show();
                    $('.alertms_del').append(str);
                }
                break;
            case 'update_order_to':
                $('.hidden_order_to_idx').val(order_to_idx);
                getOrderTo();
                $('.order__to__update__wrap').show();
                break;
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
                    'member_idx':member_idx
                },
                error: function (data) {
                },
                success: function (data) {

                    if (data.code == "200") {
                        console.log('계정탈퇴에 성공했습니다.');
                        location.href('/main');
                        $('.alertms_del').html('');
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
        if(current_pw.length == 0 || tmp_update_pw.length == 0 || tmp_update_pw_check.length == 0) {
            console.log("현재 비밀번호 혹은 변경하려는 비밀번호를 전부 입력 한 경우만 비밀번호 변경이 가능합니다.");
            return false;
        }

        if(space_reg.test(tmp_update_pw) == true) {
            console.log("변경하려는 비밀번호의 공백을 확인해주세요.");
            return false;
        }

        if(password_reg.test(tmp_update_pw) == false) {
            console.log("변경하려는 비밀번호의 형식을 확인해주세요.");
            return false;
        }

        if(tmp_update_pw != tmp_update_pw_check) {
            console.log("비밀번호 확인란에 동일한 비밀번호를 입력해주세요.");
            return false;
        }

        if(current_pw == tmp_update_pw || current_pw == tmp_update_pw_check) {
            console.log("현재 비밀번호와 다르게 설정해주세요.");
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
                console.log("현재 비밀번호 조회에 실패했습니다.");
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
					console.log("비밀번호 체크가 완료되었습니다.");
                } else {
					console.log("현재 비밀번호와 일치하지 않습니다.");
                    return false;
				}
            }
        });
    }

    function putMemberPwAndTel() {
        let user_update_pw = $('.user_update_pw').val();
        let user_update_tel = $('.user_update_tel').val();
        if(user_update_pw.length > 0 || user_update_tel.length > 0){
            $.ajax({
                type: "post",
                data: {
                    "member_pw": user_update_pw,
                    "member_tel_mobile": user_update_tel
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/account/put",
                error: function () {
                    console.log("계정정보 변경에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        console.log("비밀번호, 휴대전화 번호 변경이 완료되었습니다.");
						$('.user_update_pw').val('');
                        $('.user_update_tel').val('');
                    }
                }
            });
        } else {
            console.log("수정된 정보가 없습니다.");
			return false;
        }
    }

    function getOrderToList() {
        $('.order__to__update__wrap').hide();
        $.ajax({
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/member/order_to/list/get",
            error: function () {
                console.log("배송지 목록을 불어오는데 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                if (code == 200) {
                    let data = d.data;
                    if (data != null) {
                        if(data.length == 1) {
                            $('.other_list_wrap').hide();
                        } else {
                            $('.other_list_wrap').show();
                        }
                        let headData = data[0];
                        let tailData = data.slice(1);
                        let defaultList = $('.default__list');
                        let otherList = $('.other__list');
                        let strDiv = '';

                        defaultList.html('');
                        strDiv += '<tr class="default_destination">';
                        strDiv +=     '<td>' + headData.to_place + '</td>';
                        strDiv +=     '<td>' + headData.to_name + '</td>';
                        strDiv +=     '<td>' + headData.to_mobile + '</td>';
                        let addr = headData.to_road_addr ? headData.to_road_addr : headData.to_lot_addr;
                        let detailAddr = headData.to_detail_addr ? (' ' + headData.to_detail_addr) : '';
                        strDiv +=     '<td>' + addr + detailAddr + '</td>';
                        strDiv +=     '<td>' + headData.to_zipcode + '</td>';
                        strDiv +=     '<td style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 10px;">';
                        strDiv +=         '<div class="order_to_idx" idx="' + headData.order_to_idx + '" action-type="update_order_to" onclick="buttonAction(this)">';
                        strDiv +=             '<img src="/images/mypage/tab/select_delivery_change_btn.svg">';
                        strDiv +=         '</div>';
                        strDiv +=         '<div class="order_to_idx" idx="' + headData.order_to_idx + '" action-type="delete_order_to" onclick="deleteOrderTO(this)">';
                        strDiv +=             '<img src="/images/mypage/tab/select_delivery_cancel_btn.svg">';
                        strDiv +=         '</div>';
                        strDiv +=    '</td>';
                        strDiv += '</tr>';
                        defaultList.append(strDiv);

                        strDiv = '';
                        otherList.html('');
                        tailData.forEach((row) => {
                            strDiv += '<tr class="other_destination">';
                            strDiv +=     '<td style="display: flex; justify-content: space-between;">';
                            strDiv +=          '<div>' + row.to_place + '</div>';
                            strDiv +=          '<div class="order_to_idx" idx="' + row.order_to_idx + '" onclick="changeDefaultOrderTo(this)">';
                            strDiv +=              '<img src="/images/mypage/tab/select_delivery_default_change_btn.svg">';
                            strDiv +=          '</div>';
                            strDiv +=     '</td>';
                            strDiv +=     '<td>' + row.to_name + '</td>';
                            strDiv +=     '<td>' + row.to_mobile + '</td>';
                            let addr = row.to_road_addr ? row.to_road_addr : row.to_lot_addr;
                            let detailAddr = row.to_detail_addr ? (' ' + row.to_detail_addr) : '';
                            strDiv +=     '<td>' + addr + detailAddr + '</td>';
                            strDiv +=     '<td>' + row.to_zipcode + '</td>';
                            strDiv +=     '<td style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 10px;">';
                            strDiv +=         '<div class="order_to_idx" idx="' + row.order_to_idx + '" action-type="update_order_to" onclick="buttonAction(this)">';
                            strDiv +=             '<img src="/images/mypage/tab/select_delivery_change_btn.svg">';
                            strDiv +=         '</div>';
                            strDiv +=         '<div class="order_to_idx" idx="' + row.order_to_idx + '" action-type="delete_order_to" onclick="deleteOrderTO(this)">';
                            strDiv +=             '<img src="/images/mypage/tab/select_delivery_cancel_btn.svg">';
                            strDiv +=         '</div>';
                            strDiv +=    '</td>';
                            strDiv += '</tr>';
                        });
                        otherList.append(strDiv);
                    }
                }
            }
        })
    }

    function getOrderTo() {
        let order_to_idx = $('.hidden_order_to_idx').val();
        if(order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/get",
                error: function() {
                    console.log("배송지 개별정보 조회에 실패했습니다.");
                },
                success: function(d) {
                    let code = d.code;
                    if(code == 200) {
                        let data = d.data;
                        if(data != null) {
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
                            console.log("배송지 개별정보 조회에 성공했습니다.");
                        }
                    }
                }
            })
        }
    }

    function deleteOrderTO(obj) {
        let order_to_idx = $(obj).attr('idx');
        if(order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/delete",
                error: function() {
                    console.log("배송지 삭제에 실패했습니다.");
                },
                success: function(d) {
                    let code = d.code;
                    if(code == 200) {
                        getOrderToList();
                        console.log("배송지 삭제에 성공했습니다.");
                    }
                }
            })
        }
    }

    function changeDefaultOrderTo(obj) {
        // let changeConfirm = confirm("기본 배송지를 변경하시겠습니까?");
        let order_to_idx = $(obj).attr('idx');
        let default_flg = true;
        if(order_to_idx != '' || order_to_idx != null) {
            $.ajax({
                type: "post",
                data: {
                    "order_to_idx": order_to_idx,
                    "default_flg": default_flg
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/mypage/member/order_to/put",
                error: function() {
                    console.log("기본 배송지 변경에 실패했습니다.");
                },
                success: function(d) {
                    let code = d.code;
                    if(code == 200) {
                        getOrderToList();
                        // $('.profile__delivery__wrap').show();
                        console.log("기본 배송지 변경에 성공했습니다.");
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
        let to_place = $('.order_to_place').val();
        if(to_place == '' || to_place == null) {
            console.log("배송지명을 작성해주세요.");
            return false;
        }
        let to_name = $('.order_to_name').val();
        if(to_name == '' || to_name == null) {
            console.log("이름을 작성해주세요.");
            return false;
        }
        let to_mobile = $('.order_to_mobile').val();
        if(to_mobile == '' || to_mobile == null) {
            console.log("전화번호를 작성해주세요.");
            return false;
        }
        let to_zipcode = $('.order_to_zipcode').val();
        if(to_zipcode == '' || to_zipcode == null) {
            console.log("우편번호를 작성해주세요.");
            return false;
        }
        let to_lot_addr = $('.order_to_lot_addr').val();
        if(to_lot_addr == '' || to_lot_addr == null) {
            console.log("지번주소를 작성해주세요.");
            return false;
        }
        let to_road_addr = $('.order_to_road_addr').val();
        if(to_road_addr == '' || to_road_addr == null) {
            console.log("도로명주소를 작성해주세요.");
            return false;
        }
        let to_detail_addr = $('.order_to_detail_addr').val();
        let default_flg = $('.order_to_default_flg').is(':checked');

        $.ajax({
            type: "post",
            data: {
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
            error: function() {
                console.log("배송지 추가에 실패했습니다.");
            },
            success: function(d) {
                let code = d.code;
                if(code == 200) {
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
                   
                    console.log("배송지 추가에 성공했습니다.");
                }
            }
        });
    }

    function putOrderToInfo(order_to_idx) {
        let to_place = $('.order_to_place').val();
        if(to_place == '' || to_place == null) {
            console.log("배송지명을 작성해주세요.");
            return false;
        }
        let to_name = $('.order_to_name').val();
        if(to_name == '' || to_name == null) {
            console.log("이름을 작성해주세요.");
            return false;
        }
        let to_mobile = $('.order_to_mobile').val();
        if(to_mobile == '' || to_mobile == null) {
            console.log("전화번호를 작성해주세요.");
            return false;
        }
        let to_zipcode = $('.order_to_zipcode').val();
        if(to_zipcode == '' || to_zipcode == null) {
            console.log("우편번호를 작성해주세요.");
            return false;
        }
        let to_lot_addr = $('.order_to_lot_addr').val();
        if(to_lot_addr == '' || to_lot_addr == null) {
            console.log("지번주소를 작성해주세요.");
            return false;
        }
        let to_road_addr = $('.order_to_road_addr').val();
        if(to_road_addr == '' || to_road_addr == null) {
            console.log("도로명주소를 작성해주세요.");
            return false;
        }
        let to_detail_addr = $('.order_to_detail_addr').val();
        let default_flg = $('.order_to_default_flg').is(':checked');
        
        $.ajax({
            type: "post",
            data: {
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
            error: function() {
                console.log("배송지 정보 변경에 실패했습니다.");
            },
            success: function(d) {
                let code = d.code;
                if(code == 200) {
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
                    
                    console.log("배송지 정보 변경에 성공했습니다.");
                }
            }
        })
    }
    function marketingCheckAll() {
        let all_check_flg = $('.all_check').is(':checked');
        if(all_check_flg == true) {
            $('.mkt_check').prop('checked', true);
        } else {
            $('.mkt_check').prop('checked', false);
        }
    }
    function marketingCheckOne() {
        let checkCnt = $('.mkt_check:checked').length;
        if(checkCnt == 3) {
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
            error: function() {
                console.log("마케팅 정보 조회에 실패했습니다.");
            },
            success: function(d) {
                let code = d.code;
                if(code == 200) {
                    let data = d.data;
                    if(data != null) {
                        let mktData = data[0];
                        let emailFlg = mktData.receive_email_flg == 1 ? true : false;
                        let smsFlg = mktData.receive_sms_flg == 1 ? true : false;
                        let telFlg = mktData.receive_tel_flg == 1 ? true : false;
                        $('.email_check').prop('checked', emailFlg);
                        $('.sms_check').prop('checked', smsFlg);
                        $('.tel_check').prop('checked', telFlg);
                        marketingCheckOne();
                        console.log("마케팅 정보 조회에 성공했습니다.");
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
            error: function() {
                console.log("마케팅 정보 변경에 실패했습니다.");
            },
            success: function(d) {
                let code = d.code;
                if(code == 200) {
                    console.log("마케팅 정보 변경에 성공했습니다.");
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