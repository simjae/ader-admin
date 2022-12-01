<style> 
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.content__wrap{
    margin-top:10px;
    margin-bottom:10px;
}
.content__wrap.checkbox__area{
    margin-top:20px;
    margin-bottom:50px;
    clear:both;
}
.content__wrap .content__title{
    margin-bottom:10px;
    height: 16px;
    object-fit: contain;
    font-family: var(--ft-no);
    font-size: 11px;
    color: #343434;
}
.content__wrap .content__row{
    margin-bottom:10px;
}
.content__title.warm__msg__area{
    margin-top:10px;
    margin-bottom:0px!important;
    height:26px;
}
.warm__msg__area .font__small{
    float:left;
}
.warm__msg__area .font__underline{
    margin-top:8px;
}
.contnet__row.warm__msg__area{
    clear:both;
} 
.warn__msg{
    float:right;
    color:#ff0000!important;
    visibility:hidden;
    margin-bottom:2px;
}
input[name="email"]{
    font-family: var(--ft-fu)!important;
}
input[type="checkbox"] + label{
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-top:3px;
    margin-right:4px;
    border-radius: 1px;
    border: solid 1px #808080;
    cursor:pointer;
}
input[type="checkbox"]:checked + label{
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-top:3px;
    margin-right:4px;
    border-radius: 1px;
    border: solid 1px #000000;
    cursor:pointer;
}
.join__card input[type="checkbox"]{
    display:none;
}
input[type="button"]{
    object-fit: contain;
    font-family: var(--ft-no);
    font-size: 11px;
    text-align: center;
    color: #fff;
    cursor:pointer;
}
input::placeholder{
    font-size:11px;
    color: #dcdcdc;
}
.short__input.address__input{
    text-align:right;
    padding-right:10px;
}
.grid__three .left__area__wrap input{
    float:left;
}
.grid__three .middle__area__wrap input{
    float:left;
    margin-left:10px;
}
.grid__three .right__area__wrap input{
    float:right;
}
@media (min-width: 1024px){
    .join__card .card__header{
        margin-bottom:50px;
    }
    .text__align__center{
        text-align:center;
    }
    .font__large{
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
        color: #343434;
    }
    .join__card{
        width:470px;
        margin: 0 auto;
        height:869px;
        margin-top:200px;
        margin-bottom:290px;
    }
    .join__card input[type="text"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .join__card input[type="number"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .join__card input[type="password"]{
        width: 470px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .join__card .grid__two{
        width:470px;
        height:40px
    }
    .join__card .grid__two .left__area__wrap{
        height:40px;
        width:350px;
        float:left;
    }
    .join__card .grid__two .right__area__wrap{
        height:40px;
        width:110px;
        float:right;
    }
    .grid__two input[type="text"]{
        width: 350px!important;
    }
    .grid__three{
        width:470px;
        height:40px
    }
    .short__input{
        width: 150px!important;
    }
    .black__small__btn{
        width: 110px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
        float:right;
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
        margin-bottom: 39.5px;
        object-fit: contain;
        background-color: #eee;
    }
}
@media (max-width: 1024px){
    .join__card .card__header{
        margin-bottom:40px;
    }
    .text__align__center{
        text-align:center;
    }
    .font__large{
        object-fit: contain;
        font-family: var(--ft-no);
        font-size: 12px;
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
        color: #343434;
    }
    .join__card{
        width:340px;
        margin: 0 auto;
        height:857px;
        margin-top:10px;
        margin-bottom:100px;
    }
    .join__card .margin__top__50px{
        margin-top:50px;
    }
    .join__card .margin__top__40px{
        margin-top:40px;
    }
    .join__card .margin__top__20px{
        margin-top:20px;
    }
    .join__card .margin__top__10px{
        margin-top:10px;
    }
    .join__card input[type="text"]{
        width: 340px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .join__card input[type="number"]{
        width: 340px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 10px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }
    .join__card input[type="password"]{
        width: 340px;
        height: 40px;
        font-size: 11px;
        font-family: var(--ft-no);
        padding-left: 12px;
        object-fit: contain;
        border-radius: 1px;
        border: solid 1px #808080;
    }

    .join__card .grid__two{
        width:340px;
        height:40px
    }
    .join__card .grid__two .left__area__wrap{
        height:40px;
        width:215px;
        float:left;
    }
    .join__card .grid__two .right__area__wrap{
        height:40px;
        width:115px;
        float:right;
    }
    .grid__two input[type="text"]{
        width: 215px!important;
    }
    .grid__three{
        width:340px;
        height:40px
    }
    .grid__two input[type="text"]{
        width: 215px!important;
    }
    .short__input{
        width: 106px!important;
    }
    .black__small__btn{
        width: 115px;
        height: 39px;
        border-radius: 1px;
        background-color: #191919;
        float:right;
    }
    .black__btn{
        width: 340px;
        height: 40px;
        border-radius: 1px;
        background-color: #191919;
    }
    .contour__line{
        width: 470px;
        height: 1px;
        margin-top: 39.5px;
        margin-bottom: 39.5px;
        object-fit: contain;
        background-color: #eee;
    }
}
</style>
<main>
    <div class="join__card">
        <div class="card__header">
            <p class="font__large">비밀번호 변경하기</p>
        </div>
        <form id="frm-update" method="post">
        <?php
                function getUrlParamter($url, $sch_tag) {
                    $parts = parse_url($url);
                    parse_str($parts['query'], $query);
                    return $query[$sch_tag];
                }
                
                $page_url = $_SERVER['REQUEST_URI'];
                $member_idx = getUrlParamter($page_url, 'member_idx');
		?>
				<input id="member_idx" type="hidden" name="member_idx" value="<?=$member_idx?>">
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title warm__msg__area">
                        <p class="font__small">새로운 비밀번호</p>
                        <p class="font__underline warn__msg password">비밀번호를 정확하게 기입해주세요</p>
                    </div>
                    <div class="contnet__row warm__msg__area">
                        <input type="password" name="password">
                    </div>  
                </div>
                <div class="content__wrap">
                    <div class="content__title warm__msg__area">
                        <p class="font__small">비밀번호 확인</p>
                        <p class="font__underline warn__msg password_confirm">비밀번호가 일치하지 않습니다</p>
                    </div>
                    <div class="contnet__row warm__msg__area">
                        <input type="password" name="password_confirm">
                    </div>  
                </div>
            </div>
            <div class="card__footer">
                <div>
                    <input type="button" class="black__btn" onclick="updatePassword()" value="저장하기">
                </div>
            </div>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {
    $('input[name="password"]').keyup(function(){
		if(passwordConfirm($(this).val()) || $(this).val().length == 0){
            $('.font__underline.warn__msg.password').css('visibility','hidden');
        }
        else{
            $('.font__underline.warn__msg.password').css('visibility','visible');
        };
	});
    urlParsing();
});
function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");
		if(data_arr[0] == 'member_idx'){
			$('input [name="idx"]').val(data_arr[1]);
            console.log($('input [name="idx"]').val());
		}
	}
}
function passwordConfirm(str){    
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
//.css('visibility','hidden');
function updatePassword(){
    var member_idx = $('input[name="member_idx"]').val();
    var password = $('input[name="password"]').val();
    var password_confirm = $('input[name="password_confirm"]').val();

    $('.warn__msg').css('visibility','hidden');
    
    if(passwordConfirm(password) == false){
        $('.font__underline.warn__msg.password').css('visibility','visible');
        return false;
    }
    if(password != password_confirm){
        $('.warn__msg.password_confirm').css('visibility','visible');
        return false;
    }

    $.ajax(
        {
            url: "http://116.124.128.246:80/_api/account/put",
            type:'POST',
            data: { 'member_idx' : member_idx,
                    'password' : password },
            error:function(data){
            },
            success:function(data){
                if(data.code == "200") {
                    //location.reload();
                    console.log('비밀번호 변경 성공');
                    location.href='/login';
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




