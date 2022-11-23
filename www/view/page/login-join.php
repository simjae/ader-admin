<style> 
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
.password__warn__msg, .confirm__warn__msg{
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
        padding-left: 12px;
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
            <p class="font__large">회원가입</p>
        </div>
        <div class="card__body">
            <div class="content__wrap">
                <div class="content__title">이메일</div>
                <div class="contnet__row">
                    <input type="text" name="email">
                </div>   
            </div>
            <div class="content__wrap">
                <div class="content__title warm__msg__area">
                    <p class="font__small">비밀번호</p>
                    <p class="font__underline password__warn__msg">비밀번호를 정확하게 기입해주세요</p>
                </div>
                <div class="contnet__row warm__msg__area">
                    <input type="password" name="password">
                </div>  
            </div>
            <div class="content__wrap">
                <div class="content__title warm__msg__area">
                    <p class="font__small">비밀번호 확인</p>
                    <p class="font__underline confirm__warn__msg">비밀번호가 일치하지 않습니다</p>
                </div>
                <div class="contnet__row warm__msg__area">
                    <input type="password" name="password_confirm">
                </div>  
            </div>
            <div class="content__wrap">
                <div class="content__title">이름</div>
                <div class="contnet__row">
                    <input type="text" name="name">
                </div>   
            </div>
            <div class="content__wrap">
                <div class="content__title">주소</div>
                <div class="content__wrap grid__two">
                    <div class="left__area__wrap">
                        <input type="text" name="addr" value="" placeholder="예) 성동구 연무장길 52, 성수동2가 315-57">
                    </div>
                    <div class="right__area__wrap">
                        <input type="button" class="black__small__btn" value="검색">
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__row">
                    <input type="text" name="addr_detail" placeholder="상세주소">
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__row">
                    <span class="font__small" name="default_addr_flg" style="float:right">기본 배송지로 추가</span>
                    <div style="float:right">
                        <input type="checkbox" id="default_addr_flg">
                        <label for="default_addr_flg"></label>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">휴대전화</div>
                <div class="content__wrap grid__two">
                    <div class="left__area__wrap">
                        <input type="text" name="phone" value="" placeholder="( - ) 없이 숫자만 입력">
                    </div>
                    <div class="right__area__wrap">
                        <input type="button" class="black__small__btn" value="인증">
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">생년월일</div>
                <div class="grid__three">
                    <div class="left__area__wrap">
                        <input class="short__input address__input" type="text" name="birth_year" value="" placeholder="년">
                    </div>
                    <div class="middle__area__wrap">
                        <input class="short__input address__input" type="text" name="birth_month" value="" placeholder="월">
                    </div>
                    <div class="right__area__wrap">
                        <input class="short__input address__input" type="text" name="birth_day" value="" placeholder="일">
                    </div>
                </div>
            </div>
            <div class="content__wrap checkbox__area">
                <div class="content__row">
                    <div style="float:left">
                        <input type="checkbox" id="select_all" class="login__check__option select__all" onclick="selectAllClick(this)">
                        <label for="select_all"></label>
                    </div>
                    <span class="font__small" name="default_addr_flg">전체동의</span>
                </div>
                <div class="content__row">
                    <div style="float:left">
                        <input type="checkbox" id="terms_of_service_flg" class="login__check__option component">
                        <label for="terms_of_service_flg"></label>
                    </div>
                    <span class="font__underline">이용약관,</span>
                    <span class="font__small"> </span> 
                    <span class="font__underline">개인정보수집 및 이용</span>
                    <span class="font__small">에 동의합니다. (필수)</span>
                </div>
                <div class="content__row">
                    <div style="float:left">
                        <input type="checkbox" id="sns_receive_flg" class="login__check__option component">
                        <label for="sns_receive_flg"></label>
                    </div>
                    <span class="font__small" name="default_addr_flg">SMS 마케팅정보 수신을 동의합니다 (선택)</span> 
                </div>
                <div class="content__row">
                    <div style="float:left">
                        <input type="checkbox" id="mobile_receive_flg" class="login__check__option component">
                        <label for="mobile_receive_flg"></label>
                    </div>
                    <span class="font__small" name="default_addr_flg">이메일 마케팅정보 수신을 동의합니다 (선택)</span> 
                </div>
            </div>
        </div>
        <div class="card__footer">
            <div>
                <input type="button" class="black__btn" onclick="joinAction()" value="가입하기">
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('input[name="password"]').keyup(function(){
		if(passwordConfirm($(this).val()) || $(this).val().length == 0){
            $('.font__underline.password__warn__msg').css('visibility','hidden');
        }
        else{
            $('.font__underline.password__warn__msg').css('visibility','visible');
        };
	});
	$('.component').click(function(){
        var sel_cnt = $('.component:checked').length;
        if(sel_cnt == 3){
            $('.select__all').prop('checked',true);
        }
        else{
            $('.select__all').prop('checked',false);
        }
    });
});
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$(".login__check__option").prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$(".login__check__option").prop('checked',false);
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
        if(password_reg.test(str)){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
        //공백 포함 예외처리
    }
}
//.css('visibility','hidden');
function joinAction(){
    var password = $('input[name="password"]').val();
    var password_confirm = $('input[name="password_confirm"]').val();
    if(password != password_confirm){
        $('.confirm__warn__msg').css('visibility','visible');
        return false;
    }
    else{
        $('.confirm__warn__msg').css('visibility','hidden');
    }
}
</script>




