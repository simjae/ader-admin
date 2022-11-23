<style>
.content__wrap{
    margin-top:10px;
    margin-bottom:10px;
}
.content__wrap .content__title{
    margin-top:10px;
    margin-bottom:10px;
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
.content__wrap.login_btn{
    margin-top:20px;
    margin-bottom:10px;
}
.content__row .checkbox__label{
    float:left;
}
.login__card input[type="checkbox"] + label{
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-top:3px;
    margin-right:4px;
    border-radius: 1px;
    border: solid 1px #dcdcdc;
    position: relative;
    cursor:pointer;
}
.login__card input[type="checkbox"]:checked + label{
    border: solid 1px #000000;
}
.login__card input[type="checkbox"]{
    display:none;
}
.text__align__center{
    text-align:center;
}
.font__small{
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
.font__underline{
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
.card__footer{
    margin-top:20px;
}
.kakao__btn{
    float:left;
    margin-right:10px;
}
.content__row.sns__account__login{
    width:70px;
    margin:auto;
    margin-top:20px;
}
@media (min-width: 1024px){
    input[type="button"]{
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        text-align: center;
        color: #fff;
        cursor:pointer;
        width: 470px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .font__large{
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
    .login__card{
        width:470px;
        margin: 0 auto;
        height:575px;
        margin-top:229.5px;
        margin-bottom:231px;
    }
    .login__card .card__header{
        margin-bottom:50px;
    }
    .login__card input[type="text"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-fu);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__card input[type="number"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__card input[type="password"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .contour__line{
        width: 470px;
        height: 1px;
        margin-top: 39.5px;
        margin-bottom: 49.5px;
        object-fit: contain;
        background-color: #eee;
    }
    .content__title.sns__account__login{
        margin-top:40px;
    }
}
@media (max-width: 1024px){
    input[type="button"]{
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.1rem;
        text-align: center;
        color: #fff;
        cursor:pointer;
        width: 340px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .font__large{
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
    .login__card{
        width:340px;
        margin: 0 auto;
        height:581px;
        margin-top:10px;
        margin-bottom:100px;
    }
    .login__card .card__header{
        margin-bottom:60px;
    }
    .login__card input[type="text"]{
        width: 340px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-fu);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__card input[type="number"]{
        width: 340px;
        height: 40px;
        font-size: 1.1rem;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .login__card input[type="password"]{
        width: 340px;
        height: 40px;
        font-size: 1.1rem;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .contour__line{
        width: 340px;
        height: 1px;
        margin-top: 40.5px;
        margin-bottom: 49.5px;
        object-fit: contain;
        background-color: #eee;
    }
    .content__title.sns__account__login{
        margin-top:41px;
    }
}
</style>
<main>
    <div class="login__card">
        <div class="card__header">
            <p class="font__large">로그인</p>
        </div>
        <div class="card__body">
            <div class="content__wrap">
                <div class="content__title">이메일</div>
                <div class="content__row">
                    <input type="text" value="">
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">비밀번호</div>
                <div class="content__row">
                    <input type="password" value="">
                </div>
            </div>
            <div class="content__wrap login_btn">
                <input type="button" class="black_btn" value="로그인">
            </div>
            <div class="content__wrap">
                <div class="content__row">
                    <div class="checkbox__label">
                        <input type="checkbox" id="email_flg">
                        <label for="email_flg"></label>
                    </div>
                    <span class="font__small">이메일 저장</span>
                    <span class="font__underline" style="cursor:pointer;" onclick="location.href='/login/search'">비밀번호 찾기</span>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title sns__account__login">
                    <div class="font__large text__align__center">SNS 계정으로 로그인하기</div>
                </div>
                <div class="content__row sns__account__login">
                    <img class="kakao__btn" src="/images/login/kakao.jpg">
                    <img class="naver__btn" src="/images/login/btnG_icon_square.jpg">
                </div>
            </div>
            <div class="contour__line"></div>
            <div class="content__wrap">
                <p class="font__large text__align__center">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
            </div>
        </div>
        <div class="card__footer">
            <input type="button" class="black_btn" onclick="location.href='/login/join'" value="회원가입">
        </div>
    </div>
</main>




