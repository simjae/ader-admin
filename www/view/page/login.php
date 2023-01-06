<style>
input{outline: none;}

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
<main>
    <div class="login__card">
        <div class="card__header">
            <p class="font__large">로그인</p>
            <span class="font__underline font__red result_msg"></span>
        </div>
        <div class="card__body">
            <form id="frm-login" method="post" onSubmit="login();return false;">
                <input type="hidden" name="country" value="KR">
                <div class="content__wrap">
                    <div class="content__title">이메일
                    <p class="font__underline font__red member_id_msg"></p>
                    </div>
                    <div class="content__row">
                        <input type="text" id="member_id" name="member_id" value="">
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title">비밀번호
                    <p class="font__underline font__red member_pw_msg"></p>
                    </div>
                    <div class="content__row">
                        <input type="password" id="member_pw" name="member_pw" value="">
                    </div>
                </div>
                <div class="content__wrap login_btn">
                    <input type="button" class="black_btn" id="login_btn" onclick="login()" value="로그인">
                </div>
            </form>
            <div class="content__wrap">
                <div class="content__row">
                    <div class="checkbox__label">
                        <input type="checkbox" id="member_id_flg">
                        <label for="member_id_flg"></label>
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

<script>
$(document).ready(function() {
    $('#member_id').val('');
    var usermember_id = getCookie("usermember_id");
    $('#member_id').val(usermember_id);

    if($('#member_id').val() != ""){
        $("input:checkbox[id='member_id_flg']").prop("checked", true);
    }

    $("input:checkbox[id='member_id_flg']").change(function(){
        if($("input:checkbox[id='member_id_flg']").is(":checked")){
            setCookie("usermember_id", $('#member_id').val(), 7);
        }
        else{
            deleteCookie("usermember_id");
        }
    })

    $('#member_id').keyup(function(){
        if($('input:checked[id="member_id_flg"]').is(":checked")){
            setCookie("usermember_id", $('#member_id').val(), 7);
        }
    })
});

function login() {
    var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    var member_id = $('#member_id').val();
    var member_pw = $('#member_pw').val();
    mail_regex.test(member_id);

    $('.font__underline.font__red').text('');
    if(member_id == ''){
        $('.member_id_msg').text('이메일을 입력해주세요');
    
        return false;
    }
    else{
        if(!mail_regex.test(member_id)){
            $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

            return false;
        }
    }

    if(member_pw == ''){
        $('.member_pw_msg').text('비밀번호를 입력해주세요');

        return false;
    }

    
    $.ajax(
        {
            url: "http://116.124.128.246:80/_api/account/login",
            type: 'POST',
            data: $("#frm-login").serialize(),
            error:function(jqxhr){
                console.warn(jqxhr.responseText)
                $('.result_msg').text("모듈에 문제가 발생했습니다.");
            },
            success:function(data){
                if(data.code == "200") { // 로그인 성공
                    location.href='main';
                    //location.href='main';
                }
                else {	// 로그인 실패
                    $('.result_msg').text("로그인 실패입니다. 로그인정보 재확인 후 다시 시도하여 주십시오.");
                }
            },
            complete:function(data){
                //$("#result1").html(data.responseText);
            }
        }
    );
}

function setCookie(cookieName, value, exdays){
    let exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    let cookieValue = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

//쿠키값 delete
function deleteCookie(cookieName){
    let expireDate = new Date();
    expireDate.setDate(expireDate.getDate() -1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

//쿠키값 get
function getCookie(cookieName){
    cookieName = cookieName + "=";
    let cookieData = document.cookie;
    let start = cookieData.indexOf(cookieName);
    let cookieValue = '';
    if(start != -1){
        start += cookieName.length;
        let end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue); //unescape로 디코딩 후 값 리턴
}

</script>





