<style>
.gray__checkbox{
    width: 10px;
    height: 10px;
    margin-top:3px;
    margin-right:4px;
    border-radius: 1px;
    border: solid 1px #dcdcdc;
}
.login__checkbox .gray div{
    width: 10px;
    height: 10px;
    border-radius: 1px;
    border: solid 1px #dcdcdc;
}
.login__main input[type="checkbox"]{
    display:none;
}
.text__align__center{
    text-align:center;
}
.login__font__small{
    height: 16px;
    object-fit: contain;
    font-family: var(--ft-no);
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #343434;
}
.login__font__underline{
    text-decoration: underline;
    height: 16px;
    object-fit: contain;
    font-family: var(--ft-no);
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    float: right;
    color: #343434;
}
.login__main .login__sub__title{
    margin-top:10px;
    margin-bottom:10px;
}
.login__btn__area{
    margin-top:20px;
    margin-bottom:10px;
}
.black__btn span{
    object-fit: contain;
    font-family: var(--ft-no);
    font-size: 11px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    color: #fff;
}
.other__account__login__btn{
    width:70px;
    margin:auto;
    margin-top:20px;
}
.kakao__btn{
    float:left;
    margin-right:10px;
}
@media (min-width: 1024px){
    .login__font__large{
        height:19px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #343434;
    }
    .login__main{
        width:470px;
        margin: 0 auto;
        height:575px;
        margin-top:229.5px;
        margin-bottom:231px;
    }
    .login__main .login__title{
        margin-bottom:50px;
    }
    .login__main .login__input{
        margin-bottom:10px;
    }
    .login__main input[type="text"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-fu);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__main input[type="number"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__main input[type="password"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .black__btn{
        width: 470px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .contour__line{
        width: 470px;
        height: 1px;
        margin-top: 39.5px;
        margin-bottom: 49.5px;
        object-fit: contain;
        background-color: #eee;
    }
    .other__account__login__area{
        margin-top:66px;
    }
}
@media (max-width: 1024px){
    .login__font__large{
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.2rem;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #343434;
    }
    .login__main{
        width:340px;
        margin: 0 auto;
        height:581px;
        margin-top:10px;
        margin-bottom:100px;
    }
    .login__main .login__title{
        margin-bottom:60px;
    }
    .login__main input[type="text"]{
        width: 340px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-fu);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__main input[type="number"]{
        width: 340px;
        height: 40px;
        font-size: 1.1rem;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__main input[type="password"]{
        width: 340px;
        height: 40px;
        font-size: 1.1rem;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .black__btn{
        width: 340px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .contour__line{
        width: 340px;
        height: 1px;
        margin-top: 40.5px;
        margin-bottom: 49.5px;
        object-fit: contain;
        background-color: #eee;
    }
    .other__account__login__area{
        margin-top:67px;
    }
}
</style>
<main>
    <div class="login__main">
        <div class="login__title">
            <p class="login__font__large">로그인</p>
        </div>
        <div class="login__sub__title">
            <p class="login__font__small">이메일</p>
        </div>
        <div class="login__input">
            <input type="text" value="">
        </div>
        <div class="login__sub__title">
            <p class="login__font__small">비밀번호</p>
        </div>
        <div class="login__input">
            <input type="password" value="">
        </div>
        <div class="login__btn__area">
            <button class="black__btn"><span>로그인</span></botton>
        </div>
        <div class="login__option">
            <div style="float:left">
                <div class="gray__checkbox"></div>
                <input type="checkbox" value="">
            </div>
            <span class="login__font__small">이메일 저장</span>
            <span class="login__font__underline" style="cursor:pointer;" onclick="location.href='/login/search'">비밀번호 찾기</span>
        </div>
        <div class="other__account__login__area">
            <div class="login__font__large text__align__center">SNS 계정으로 로그인하기</div>
            <div class="other__account__login__btn">
                <img class="kakao__btn" src="/images/login/kakao.jpg">
                <img class="naver__btn" src="/images/login/btnG_icon_square.jpg">
            </div>
        </div>
        <div class="contour__line"></div>
        <div>
            <p class="login__font__large text__align__center" style="clear:both;">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
        </div>
        <div class="login__btn__area">
            <button class="black__btn" onclick="location.href='/login/join'"><span>회원가입</span></botton>
        </div>
    </div>
</main>




