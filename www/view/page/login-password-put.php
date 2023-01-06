<style>
input{outline: none;}

input::placeholder{
    font-size:11px;
    color: #dcdcdc;
}
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
    color: #343434;
}
.content__title.warm__msg__area{
    margin-top:10px;
    margin-bottom:0px!important;
    height:26px;
}
.warn__msg{
    float:right;
    color:#ff0000!important;
    visibility:hidden;
    margin-bottom:2px;
}
.font__underline.font__red{
    color:red;
    text-align:right;
}
.right__area__wrap{
    float:right;
}
.other__platform__btn{
    width:70px;
    margin:auto;
    margin-top:20px;
}
.kakao__btn{
    float:left;
    margin-right:10px;
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
    .password__update__card{
        width:470px;
        margin: 0 auto;
        height:324px;
        margin-top:229.5px;
        margin-bottom:554px;
    }
    .password__update__card .card__header{
       margin-bottom:50px; 
    }
    .pc__sns__msg{
        height:19px!important;
        text-align:center;
    }
    .moblie__sns__msg{
        display:none;
    }
    .font__large{
        height:19px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 13px;
        color: #343434;
    }
    .font__small{
        height: 16px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        color: #343434;
    }
    .font__underline{
        text-decoration: underline;
        height: 16px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        float: right;
        color: #343434;
    }
    .password__update__card .member_id__check{
        margin-top:21px;
        width:470px;
        height:58px
    }
    .content__wrap.grid__two{
        margin-top:21px;
        width:470px;
        height:58px
    }
    .password__update__card input[type="password"]{
        width: 470px;
        height: 40px;
        font-family: var(--ft-fu);
        font-size: 11px;
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
        clear:both;
    }
}
@media (max-width: 1024px){
    input[type="button"]{
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 11px;
        text-align: center;
        color: #fff;
        cursor:pointer;
        width: 340px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .password__update__card{
        width:341px;
        margin: 0 auto;
        height:413px;
        margin-top:10px;
        margin-bottom:207px;
    }
    .password__update__card .card__header{
        margin-bottom:143px;
    }
    .pc__sns__msg{
        display:none;
    }
    .moblie__sns__msg{
        height:33px!important;
        text-align:center;
    }
    .font__large{
        height:17px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.2rem;
        color: #343434;
    }
    .font__small{
        height: 16px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.1rem;
        color: #343434;
    }
    .font__underline{
        text-decoration: underline;
        height: 16px;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.1rem;
        float: right;
        color: #343434;
    }
    .content__wrap.grid__two{
        margin-top:6px;
        width:341px;
        height:58px;
    }
    .password__update__card input[type="password"]{
        width: 340px;
        height: 40px;
        font-family: var(--ft-fu);
        font-size: 1.1rem;
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .contour__line{
        width: 340px;
        height: 1px;
        margin-top: 39.5px;
        margin-bottom: 49.5px;
        object-fit: contain;
        background-color: #eee;
        clear:both;
    }
}
</style>
<main>
    <div class="password__update__card">
        <div class="card__header">
            <p class="font__large">비밀번호 변경하기</p>
        </div>
        <div class="card__body">
            <form id="frm-update">
                <input type="hidden" name="country" value="KR">
                <div class="content__wrap">
                    <div class="content__title warm__msg__area">
                        <p class="font__small">비밀번호</p>
                        <p class="font__underline warn__msg member_pw">비밀번호를 정확하게 기입해주세요</p>
                    </div>
                    <div class="content__row">
                        <input type="password" name="member_pw">
                        <div id="pw_desciption" style="height:154px;border: solid 1px #808080;font-size: 11px;padding-top:10px;padding-left:10px">
                            <div class="pw__desc__title" style="margin-bottom:10px;">
                                <img src="/images/login/point_icon.svg" style="padding-top:9px;padding-right:7px;margin-bottom:8px;float:left">
                                <span>비밀번호 입력 조건</span>
                            </div>
                            <div class="pw__desc__content" style="margin-bottom:10px;">
                                <img src="/images/login/point_icon.svg" style="padding-top:9px;padding-right:7px;margin-bottom:8px;float:left">
                                <span>대소문자/숫자/특수문자 중 3가지 이상 조합, 8자~16자</span>
                            </div>
                            <div class="pw__desc__content" style="margin-bottom:10px;">
                                <img src="/images/login/point_icon.svg" style="padding-top:9px;padding-right:7px;margin-bottom:8px;float:left">
                                <span>입력 가능 특수문자</span>
                                <p>!@#$%^()_-={}[]|;:<>,.?/</p>
                            </div>
                            <div class="pw__desc__content" style="margin-bottom:10px;">
                                <img src="/images/login/point_icon.svg" style="padding-top:9px;padding-right:7px;margin-bottom:8px;float:left">
                                <span>공백 입력 불가능</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title">새로운 비밀번호 확인
                    <p class="font__underline font__red member_id_msg"></p>
                    </div>
                    <div class="content__row">
                        <input type="password" id="member_pw_confirm" value="">
                    </div>
                </div>
            </form>
            <div style="margin-top:20px">
                <input type="button" class="black_btn" value="저장">
            </div>        
        </div>
    </div>
</main>


<script>
$(document).ready(function() {
    $('#pw_desciption').hide();
    $('input[name="member_pw"]').keyup(function(){
		if(memberPwConfirm($(this).val()) || $(this).val().length == 0){
            $('.font__underline.warn__msg.member_pw').css('visibility','hidden');
            hidePwDescription();
        }
        else{
            $('.font__underline.warn__msg.member_pw').css('visibility','visible');
            showPwDescription();
        };
	});
});
function memberPwConfirm(str){    
    //  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
    //  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/                    
    var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
    //  공백 입력 불가능
    var space_reg = /\s/g;
    //var password_str = $('input[name="password"]').eq(0).val();

    if(space_reg.test(str) == false){
        return password_reg.test(str)
            return true;
    }
    else{
        return false;
        //공백 포함 예외처리
    }
}
function showPwDescription(){
    $('#pw_desciption').show();
    $('#hide_area').hide();
}
function hidePwDescription(){
    $('#pw_desciption').hide();
    $('#hide_area').show();
}
</script>




