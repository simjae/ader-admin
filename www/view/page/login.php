<style>
input{outline: none;}
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active  {
    -webkit-box-shadow: 0 0 0 30px white inset !important;
}
.content__wrap{
    margin-top:10px;
    margin-bottom:10px;
}
.font__underline.font__red{
    color:red;
    text-align:right;
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
.login__card [type="checkbox"] {
  vertical-align: middle;
  appearance: none;
  border: 1px solid gray;
  width: 10px;
  height: 10px;
  margin: 2px 0 0 0;
  padding: 0px;
}
.login__card [type="checkbox"]:checked {
    background-color: #000000;
}

.login__card label p,label span{
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
    .login__card label {
        padding-right: 10px;
        vertical-align: middle;
    }
    .content__row .email_checkbox {
        display: flex;
        justify-content: space-between;
    }
    .email_checkbox .checkbox__label {
        display: flex;
        align-items: center;
    }
    input[type="password"], input[type="text"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        padding-left: 12px;
        object-fit: contain;
        border-top: none;
        border-bottom: solid 1px #808080;
        border-left: none;
        border-right: none;
    }
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
        font-family: var(--ft-fu);
    }
    .login__card input[type="password"]{
        font-family: var(--ft-no);
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
    .login__card label {
        padding-right: 4px;
        vertical-align: middle;
    }
    .content__row .email_checkbox {
        display: flex;
        justify-content: space-between;
    }
    .email_checkbox .checkbox__label {
        display: flex;
        align-items: center;
    }

    input[type="password"], input[type="text"]{
        width: 340px;
        height: 40px;
        font-size: 1.1rem;
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }

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
        font-family: var(--ft-fu);
    }
    .login__card input[type="password"]{
        font-family: var(--ft-no);
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
<?php
    function getUrlParamter($url, $sch_tag) {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return $query[$sch_tag];
    }
    $page_url = $_SERVER['REQUEST_URI'];
    $r_url = getUrlParamter($page_url, 'r_url');

	if (isset($_SESSION['MEMBER_IDX'])) {
        if($r_url != null){
            $url_str = $r_url;
        }
        else{
            $url_str = '/main';
        }
		echo "
			<script>
				location.href='".$url_str."';
			</script>
		";
	}

    $page_url = $_SERVER['REQUEST_URI'];
    $r_url = getUrlParamter($page_url, 'r_url');

?>
<main>
    <div class="login__card">
        <div class="card__header">
            <p class="font__large" data-i18n="m_login">로그인</p>
            <span class="font__underline font__red result_msg"></span>
        </div>
        <div class="card__body">
            <form id="frm-login">
                <input type="hidden" name="country" value="">
                <input type="hidden" name="member_ip" value="0.0.0.0">
                <input type="hidden" name="r_url" value="<?=$r_url?>">
                <div class="content__wrap">
                    <div class="content__wrap__msg">
                        <div class="content__title" data-i18n="p_email">이메일</div>
                        <div class="font__underline font__red member_id_msg"></div>
                    </div>
                    <div class="content__row">
                        <input type="text" id="member_id" name="member_id" value="">
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__wrap__msg">
                        <div class="content__title" data-i18n="p_password">비밀번호</div>
                        <div class="font__underline font__red member_pw_msg"></div>
                    </div>
                    <div class="content__row">
                        <input type="password" id="member_pw" name="member_pw" value="">
                    </div>
                </div>
                <div class="content__wrap login_btn" onClick="login();">
                    <input type="button" class="black_btn" id="login_btn" value="로그인">
                </div>
            </form>
            <div class="content__wrap">
                <div class="content__row email_checkbox">
                    <div class="checkbox__label">
                        <input type="checkbox" id="member_id_flg">
                        <label for="member_id_flg"></label>
                        <span class="font__small">이메일 저장</span>
                    </div>
                    <span class="font__underline" style="cursor:pointer;" onclick="location.href='/login/check'">비밀번호 찾기</span>
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
                <p class="font__large text__align__center" data-i18n="lm_menu_msg_02">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
            </div>
        </div>
        <div class="card__footer">
            <input type="button" class="black_btn" onclick="location.href='/login/join'" value="회원가입">
        </div>
    </div>
</main>

<script src="/scripts/member/login.js"></script>

