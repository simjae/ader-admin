<style> 
input{outline: none;}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.code6{display: none;}
.code5{font-size: 11px;font-family: var(--ft-fu);width:34px;}
.keyword_label{display:none}
.search_button{
    width: 110px;
    height: 40px;
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

.postcode_search_status{
    font-family: var(--ft-no);
    font-size: 11px;
    border: solid 1px #dcdcdc;
    padding: 23px 19px;
}
.postcodify_search_result{
    font-family: var(--ft-no);
    font-size: 11px;
    min-height:95px;
    border-bottom: solid 1px #dcdcdc;
    padding: 23px 19px;
}
.post-change-result::-webkit-scrollbar{width:5px;}
.post-change-result::-webkit-scrollbar-track {background-color: transparent;}
.post-change-result::-webkit-scrollbar-thumb {background-color: #dcdcdc;}
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
.join__card input[name="member_id"]{
    font-family: var(--ft-fu)!important;
}

.join__card [type="checkbox"] {
  vertical-align: middle;
  appearance: none;
  border: 1px solid gray;
  width: 10px;
  height: 10px;
  margin: 0px;
  padding: 0px;
}
.join__card [type="checkbox"]:checked {
    background-color: #000000;
}
.join__card label{
    padding-right: 10px;
    vertical-align: middle;
}
.join__card label p,label span{
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
    .post-change-result{
        width: 74.5%;
        margin: 0!important;
        background-color: #fff;
        overflow: auto;
        max-height: 285px;
        border: 1px solid #808080;
        border-top: 0px;
        top: -32px;
    }
    .keyword{
        height:40px;
        width:350px!important;
        float:left;
    }
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
    .post-change-result{
        width: 340px;
        margin: 0!important;
        background-color: #fff;
        overflow: auto;
        max-height: 285px;
        border: 1px solid #808080;
        border-top: 0px;
        top: -32px;
    }
    .keyword{
        height:40px;
        width:215px!important;
        float:left;
    }
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
            <p class="font__large">회원가입</p>
        </div>
        <form id="frm-regist" method="post">
        <input type="hidden" name="country" value="KR">
        <div class="card__body">
            <div class="content__wrap">
                <div class="content__title warm__msg__area">
                    <p class="font__small">이메일</p>
                    <p class="font__underline warn__msg member_id">이메일를 정확하게 기입해주세요</p>
                </div>
                <div class="contnet__row warm__msg__area">
                    <input type="text" name="member_id">
                </div> 
            </div>
            <div class="content__wrap">
                <div class="content__title warm__msg__area">
                    <p class="font__small">비밀번호</p>
                    <p class="font__underline warn__msg member_pw">비밀번호를 정확하게 기입해주세요</p>
                </div>
                <div class="contnet__row">
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
            <div id="hide_area">
                <div class="content__wrap">
                    <div class="content__title warm__msg__area">
                        <p class="font__small">비밀번호 확인</p>
                        <p class="font__underline warn__msg member_pw_confirm">비밀번호가 일치하지 않습니다</p>
                    </div>
                    <div class="contnet__row warm__msg__area">
                        <input type="password" name="member_pw_confirm">
                    </div>  
                </div>
                <div class="content__wrap">
                    <div class="content__title warm__msg__area">
                        <p class="font__small">이름</p>
                        <p class="font__underline warn__msg member_name">이름을 기입해주세요</p>
                    </div>
                    <div class="contnet__row warm__msg__area">
                        <input type="text" name="member_name">
                    </div>
                </div>
            </div>
            
            <div class="content__wrap">
                <div class="content__title">주소</div>
                <div id="postcodify" class="input-row"></div>
                <div class="input-row" style="clear:both;">
                    <div class="post-change-result"></div>
                </div>
                <!--
                <div class="content__wrap grid__two">
                    
                    <div class="left__area__wrap">
                        <input type="text" id="addr_str" value="" placeholder="예) 성동구 연무장길 52, 성수동2가 315-57">
                    </div>
                    <div class="right__area__wrap">
                        <input type="button" id="addr_search_button" class="black__small__btn" value="검색">
                    </div>
                </div>
-->
            </div>
            <div class="content__wrap">
                <div class="content__row">
                    <input type="hidden" id="zipcode" name="zipcode">
                    <input type="hidden" id="lot_addr" name="lot_addr">
                    <input type="hidden" id="road_addr" name="road_addr">
                    <input type="text" id="addr_detail" name="addr_detail" placeholder="상세주소">
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
                        <input type="text" name="tel_mobile" value="" placeholder="( - ) 없이 숫자만 입력">
                    </div>
                    <div class="right__area__wrap">
                        <input type="button" class="black__small__btn" value="인증">
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title warm__msg__area">
                    <p class="font__small">생년월일</p>
                    <p class="font__underline warn__msg birth">생년월일을 정확하게 기입해주세요</p>
                </div>
                <div class="contnet__row warm__msg__area">
                    <div class="grid__three">
                        <div class="left__area__wrap">
                            <input class="short__input address__input" type="number" step="1" name="birth_year" value="" placeholder="년">
                        </div>
                        <div class="middle__area__wrap">
                            <input class="short__input address__input" type="number" step="1"name="birth_month" value="" placeholder="월">
                        </div>
                        <div class="right__area__wrap">
                            <input class="short__input address__input" type="number" step="1" name="birth_day" value="" placeholder="일">
                        </div>
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
                    <span class="font__underline" style="cursor:pointer" onclick="location.href='/notice/privacy?notice_type=terms_of_use'">이용약관,</span>
                    <span class="font__small"> </span> 
                    <span class="font__underline" style="cursor:pointer" onclick="location.href='/notice/privacy?notice_type=privacy_policy'">개인정보수집 및 이용</span>
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
                <p class="font__underline warn__msg essential">필수항목을 선택해주세요</p>
            </div>
        </div>
        <div class="card__footer">
            <div>
                <input type="button" class="black__btn" onclick="joinAction()" value="가입하기">
            </div>
        </div>
    </div>
</main>

<script src="/scripts/member/login.js"></script>

<script>
$(function() {
	$("#postcodify").postcodify({
		insertPostcode5 : "#zipcode",
		insertAddress : "#road_addr",
		insertDetails : "#detail_ddr",
		insertJibeonAddress : "#lot_addr",
		hideOldAddresses: false,
		results:".post-change-result",
		hideSummary:true,
		useFullJibeon:true,
		onReady:function(){
			document.querySelector(".post-change-result").style.display="none";
			$(".postcodify_search_controls .keyword").attr("placeholder","예) 성동구 연무장길 53, 성수동2가 315-57");
			$('.postcodify_search_controls .keyword').attr('chk-flg','false');
            // $(".post-change-result").hide();
		},
		onSuccess:function(){
			document.querySelector(".post-change-result").style.display="block";
			$("#postcodify div.postcode_search_status.too_many").hide();
			// $(".post-change-result").hide();
			
			$('.input-row').css('position','relative');
			$('.post-change-result').css('position','absolute');
			$('.post-change-result').css('top','0px');
		},
		afterSelect: function(selectedEntry) {

			$("#postcodify div.postcode_search_result").remove();
			$("#postcodify div.postcode_search_status.too_many").hide();
			$("#postcodify div.postcode_search_status.summary").hide();
			document.querySelector(".post-change-result").style.display="none";
			$("#entry_box").show();
			$("#entry_details").focus();
			$(".postcodify_search_controls .keyword").val($("#road_addr").val());
			
			$('.input-row').css('position','relative');
			$('.post-change-result').css('position','absolute');
			$('.post-change-result').css('top','0px');
		}
	});
	
    $('.postcodify_search_controls .keyword').keyup(function(){
        $('.postcodify_search_controls .keyword').attr('chk-flg', 'false');
    });
	
    $('.post-change-result.postcodify_search_form.postcode_search_form').on('click',function(){
        $('.postcodify_search_controls .keyword').attr('chk-flg', 'true');
    });
});
</script>