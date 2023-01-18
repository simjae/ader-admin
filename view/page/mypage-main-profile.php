<style>
.profile__wrap{
    margin-top:40px;
    width:100%;
}
.profile__tab__btn__container{
    margin: 0 auto;
    width:410px;
    display:grid;
    place-items: center;
    grid-template-columns: 80px 80px 80px 90px 80px;
}
.profile__tab__wrap{
    width:490px;
    margin:0 auto;
    margin-top:80px;
}   
.profile__wrap .contents__table{
    border:none;
}
.profile__wrap .contents__table td{
    border:none;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #343434;
}
.profile__tab__wrap .footer{
    margin-bottom:100px;
}
.input__form__wrap{
    font-size: 11px;
    font-family:var(--ft-no-fu);
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #343434;
}
.rows__title{
    padding-top:10px;
}
.rows__contnets{
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom:10px;
}
.black__btn{
    height:40px;
    background-color: black;
    color:white;
    text-align: center;
    border-radius: 1px;
}
.profile__delivery__wrap{
    width:470px;
    margin:0 auto;
}
.input__form__rows.marketing__receive{
    font-family:var(--ft-no-fu);
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #343434;
    margin-bottom:10px;
}
.profile__wrap .description p{
    line-height: 2;
}
</style>
<div class="profile__wrap">
    <div class="profile__tab__btn__container">
        <div class="tab__btn__item"  form-id="profile__set__wrap">
            <img src="/images/mypage/tab/select_profile_set_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="profile__credit__update__wrap">
            <img src="/images/mypage/tab/default_credit_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="profile__customize__purchase__wrap">
            <img src="/images/mypage/tab/default_customize_purchase_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="profile__delivery__wrap">
            <img src="/images/mypage/tab/default_delivery_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="profile__marketing__wrap">
            <img src="/images/mypage/tab/default_marketing_btn.svg">
        </div>
    </div>
    <div class="profile__tab__wrap">
        <div class="profile__tab profile__set__wrap">
            <div class="contents__table">
                <table class="border__bottom">
                    <colsgroup>
                        <col style="width:120px;">
                        <col style="width:350px;">
                    </colsgroup>
					
                    <tbody>
                        <tr>
                            <td>이름</td>
                            <td><?=$_SESSION['MEMBER_NAME']?></td>
                            
                        </tr>
                        <tr>
                            <td>이메일</td>
                            <td><?=$_SESSION['MEMBER_EMAIL']?></td>
                        </tr>
                        <tr>
                            <td>비밀번호</td>
                            <td>**************</td>
                        </tr>
                        <tr>
                            <td>휴대전화</td>
                            <td><?=$_SESSION['TEL_MOBILE']?></td>
                        </tr>
                        <tr>
                            <td>생년월일</td>
                            <td>19950728</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="" style="padding-top:30px;padding-bottom:20px;border-bottom:1px solid #dcdcdc">
                <button class="black__full__width__btn">저장</button>
            </div>
            <div class="" style="padding-top:20px;">
                <button class="white__full__width__btn">계정삭제</button>
            </div>
            <div class="footer"></div>
        </div>
        <div class="profile__tab profile__pw__update__wrap">
        </div>
        <div class="profile__tab profile__tel__update__wrap">
        </div>
        <div class="profile__tab profile__pw__update__confirm__wrap">
        </div>
        <div class="profile__tab profile__member__drop__wrap">
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
                    <button class="black__full__width__btn">저장</button>
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
                    <button class="black__full__width__btn">저장</button>
                </div>
                <div class="footer"></div>
            </div>
        </div>
        <div class="profile__tab profile__delivery__wrap">
            <div class="input__form__wrap" style="margin-top:20px;">
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
                <div class="" style="padding-top:40px;">
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
            <div class="description"><p>제품, 할인 정보, 멤버 혜택 관련 최신 소식을 받아보세요.</p></div>
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

</script>