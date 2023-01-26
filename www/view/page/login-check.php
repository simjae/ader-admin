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
    .password__search__card{
        width:470px;
        margin: 0 auto;
        height:324px;
        margin-top:229.5px;
        margin-bottom:554px;
    }
    .password__search__card .card__header{
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
    .password__search__card .member_id__check{
        margin-top:21px;
        width:470px;
        height:58px
    }
    .content__wrap.grid__two{
        margin-top:21px;
        width:470px;
        height:58px
    }
    .password__search__card .grid__two .left__area__wrap{
        height:58px;
        width:350px;
        float:left;
    }
    .password__search__card input[type="text"]{
        width: 350px;
        height: 40px;
        font-family: var(--ft-fu);
        font-size: 11px;
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .right__area__wrap .black__small__btn{
        width: 110px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
        margin-top:18px;
        object-fit: contain;
        font-family: var(--ft-no);
        text-align: center;
        font-size: 11px;
        text-align: center;
        color: #fff;
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
    .password__search__card{
        width:341px;
        margin: 0 auto;
        height:413px;
        margin-top:10px;
        margin-bottom:207px;
    }
    .password__search__card .card__header{
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
    .password__search__card .grid__two .left__area__wrap{
        height:58px;
        width:216px;
        float:left;
    }
    .password__search__card input[type="text"]{
        width: 216px;
        height: 40px;
        font-family: var(--ft-fu);
        font-size: 1.1rem;
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .right__area__wrap .black__small__btn{
        width: 115px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
        margin-top:18px;
        text-align: center;
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 1.1rem;
        text-align: center;
        color: #fff;
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
    <div class="password__search__card">
        <div class="card__header">
            <p class="font__large">비밀번호 찾기</p>
            <span class="font__underline font__red result_msg"></span>
        </div>
        <div class="card__body">
            <div class="content__wrap" style="margin-bottom:0px!important">
                <div class="content__title" style="margin-bottom:0px!important">비밀번호 재설정 링크를 등록된 메일 주소로 보내드립니다.</div>
            </div>
            <form id="frm-find" method="post" onSubmit="password_find();return false;">
                <input type="hidden" name="country" value="KR">
                <div class="content__wrap grid__two">
                    <div class="left__area__wrap">
                        <p class="font__underline font__red member_id_msg" style="visibility:hidden;">존재하지 않는 이메일입니다</p>
                        <input style="margin-top:2px;" type="text" value="" id="member_id" name="member_id" placeholder="이메일을 입력해주세요">
                    </div>
                    <div class="right__area__wrap">
                        <input type="button" class="black__small__btn" id="link_btn" onclick="password_find()" value="링크 받기" style="cursor:pointer;">
                    </div>
                </div>
            </form>
            <div class="contour__line"></div>
        <div class="card__footer">
            <div class="content__wrap">
                <p class="font__large pc__sns__msg">SNS 계정을 연동하시면 비밀번호를 찾을 필요 없이 이용하실 수 있습니다.</p>
                <p class="font__large moblie__sns__msg">SNS 계정을 연동하시면 비밀번호를<br>찾을 필요 없이 이용하실 수 있습니다.</p> 
            </div>
            <div class="other__platform__btn">
                <img class="kakao__btn" src="/images/login/kakao.jpg">
                <img class="naver__btn" src="/images/login/btnG_icon_square.jpg">
            </div>
        </div>
    </div>
</main>


<script>
$(document).ready(function() {
});

function password_find() {
    var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    var member_id = $('#member_id').val();
    mail_regex.test(member_id);

    $('.font__underline.font__red').css('visibility','hidden');
    if(member_id == ''){
        
        $('.member_id_msg').css('visibility','visible');
        $('.member_id_msg').text('이메일을 입력해주세요');
    
        return false;
    }
    else{
        if(!mail_regex.test(member_id)){
            
            $('.member_id_msg').css('visibility','visible');
            $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

            return false;
        }
    }

    //Test용 STMP APP Password : wnaqvncvlugpjdvl
    /*
    Email.send({
        Host: "smtp@gmail.com",
        Username : "dhpark3610@gmail.com",
        Password : "psh1300411!",
        To: "shpark@bvdev.co.kr",
        From: "dhpark3610@gmail.com",
        Subject: "SMTP Test",
        Body : "SMTP Test context",

    }).then(
        message => alert(message)
    );
    */
    
    $.ajax(
        {
            url: "http://116.124.128.246:80/_api/account/check/check",
            type:'POST',
            data:$("#frm-find").serialize(),
            error:function(data){
                $('.member_id_msg').css('visibility','hidden');
                $('.result_msg').css('visibility','visible');
                $('.result_msg').text("모듈에 문제가 발생했습니다.");
            },
            success:function(data){
                if(data.code == "200") { // 이메일검사 성공
                    $('.member_id_msg').css('visibility','hidden');
                    $('.result_msg').css('visibility','visible');
                    $('.result_msg').text(data.data.temp_password);
                }
                else {	// 이메일검사 실패
                    $('.member_id_msg').css('visibility','visible');
                    $('.member_id_msg').text('존재하지 않는 이메일입니다');
                }
            },
            complete:function(data){
                //$("#result1").html(data.responseText);
            },
            dataType:'json'
        }
    );
    
}
</script>




