<style>

.notice__privacy__wrap p, .notice__privacy__wrap span, .notice__privacy__wrap li {
    font-family:var(--ft-no-fu);
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.6;
    letter-spacing: normal;
    color: #343434; 
}
.notice__privacy__wrap h2, .notice__privacy__wrap h3{
    font-family:var(--ft-no-fu);
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.6;
    letter-spacing: normal;
    color: #343434; 
}
.notice__privacy__wrap .in__text{
    margin-left:10px;
    text-indent:-10px;
} 
    .notice__privacy__wrap .title{
        margin-bottom:30px;
    }
    .notice__privacy__wrap .title.primary{
        font-family:var(--ft-no-fu);
        font-size:13px;
        font-weight:normal;
        font-stretch:normal;
        font-style:normal;
        line-height:1.15;
        letter-spacing:normal;
        text-align:center;
        color:#343434;
    }
    .notice__privacy__wrap .tab__wrap{display:grid;gap:10px;grid-template-columns:134px 70px 100px;align-items:center;margin:0 auto;width:320px;}
        .notice__privacy__wrap .tab__btn{border:none;height:24px;cursor:pointer;}
        .notice__privacy__wrap .tab__btn span{line-height: 24px;}
        .notice__privacy__wrap .tab__btn.selected{border:1px solid;}
            .notice__privacy__wrap .tab__btn span{color:#B6B6B6;}
            .notice__privacy__wrap .tab__btn.selected span{color:black;}
    .notice__privacy__wrap .info__wrap{margin-top:70px;text-align:left;height:650px;margin-bottom:80px;}
    .notice__privacy__wrap .info__wrap::-webkit-scrollbar{width:5px;}
    .notice__privacy__wrap .info__wrap::-webkit-scrollbar-track {background-color: transparent;}
    .notice__privacy__wrap .info__wrap::-webkit-scrollbar-thumb {background-color: #dcdcdc;}
        .notice__privacy__wrap .info__wrap .header{}
        .notice__privacy__wrap .info__wrap .item{}
        .notice__privacy__wrap .info__wrap p{margin-bottom:5px;font-size:11px}
        .notice__privacy__wrap .info__wrap li{margin-bottom:5px;font-size:11px}
        .notice__privacy__wrap .info__wrap span{margin-bottom:5px;font-size:11px}
        .notice__privacy__wrap .info__wrap h2{margin-bottom:10px;font-size: 13px;}
            .notice__privacy__wrap .info__wrap .title h3{margin-bottom:10px;font-size: 13px;}
            .notice__privacy__wrap .info__wrap .info__contents h2{margin-bottom:10px;font-size: 13px;}
            .notice__privacy__wrap .info__wrap .info__contents h3{margin-bottom:5px;font-size: 11px;}
            .notice__privacy__wrap .info__wrap .info__contents{margin-bottom:20px;}
            .notice__privacy__wrap .info__wrap.online_store .info__contents{margin-bottom:30px;}
            .notice__privacy__wrap .info__wrap .info__scroll__wrap{overflow-y:scroll;height:100%;} 
            .notice__privacy__wrap .info__wrap .info__scroll__wrap::-webkit-scrollbar{width:5px;}
            .notice__privacy__wrap .info__wrap .info__scroll__wrap::-webkit-scrollbar-track {background-color: transparent;}
            .notice__privacy__wrap .info__wrap .info__scroll__wrap::-webkit-scrollbar-thumb {background-color: #dcdcdc;}
@media (max-width: 1024px){
    .notice__privacy__wrap .info__wrap{margin-top:30px;}
    .notice__privacy__wrap{
        width:calc(100% - 20px);
        margin-left:10px;
        margin-right:10px;
        margin: 0 auto;
        text-align:center;
        margin-top:40px;
    }  
}
@media (min-width: 600px) {
    .notice__privacy__wrap{
        width:580px;
        margin: 0 auto;
        text-align:center;
        margin-top:40px;
    }  
}
@media (min-width: 1024px){
    .notice__privacy__wrap{
        width:710px;
        margin: 0 auto;
        text-align:center;
        margin-top:100px;
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
$notice_type = getUrlParamter($page_url, 'notice_type');
?>
<main>
    <input type="hidden" id="notice_type" value="<?=$notice_type?>">
    <div class="notice__privacy__wrap">
        <div class="title primary"><p>법적고지사항</p></div>
        <div class="tab__wrap">
            <div class="tab__btn online_store selected" onclick="clickTabPrivacy('online_store')">
                <span>온라인스토어 이용가이드</span>
            </div>
            <div class="tab__btn terms_of_use" onclick="clickTabPrivacy('terms_of_use')">
                <span>이용약관</span>
            </div>
            <div class="tab__btn privacy_policy" onclick="clickTabPrivacy('privacy_policy')">
                <span>개인정보처리방침</span>
            </div>
        </div>
        <div class="info__wrap online_store_info"></div>
        <div class="info__wrap terms_of_use_info"></div>
        <div class="info__wrap privacy_policy_info"></div>
    </div>
</main>

<script>
$(document).ready(function (){
    $('.info__wrap').hide();
    $('.tab__btn').removeClass('selected');
    var notice_type = $('#notice_type').val();
    if(notice_type == null || notice_type.length <= 0){
        $('.info__wrap.online_store_info').show();
        $('.tab__btn.online_store').addClass('selected');
    }
    else{
        $('.info__wrap.' + notice_type + '_info').show();
        $('.tab__btn.' + notice_type).addClass('selected');
    }
})

function clickTabPrivacy(type){
    var notice_primary_wrap = $('.notice__privacy__wrap');

    notice_primary_wrap.find('.tab__btn').removeClass('selected');
    notice_primary_wrap.find('.tab__btn.' + type).addClass('selected');

    notice_primary_wrap.find('.info__wrap').hide();
    notice_primary_wrap.find('.info__wrap.' + type + '_info').show();

}

let language = getLanguage();

$.ajax({
    type: "post",
    data: {
        "country": language
    },
    dataType: "json",
    url: "http://116.124.128.246:80/_api/policy/page/get",
    error: function() {
        alert("법적 고지사항 조회에 실패했습니다.");
    },
    success: function(d) {
        let data = d.data;
        if(data != null) {
            data.forEach(el => {
                if(el.policy_type == "GUD") {
                    let gudText = document.querySelector(".notice__privacy__wrap .online_store_info");
                    gudText.innerHTML = el.policy_txt;
                }
                else if(el.policy_type == "PNL") {
                    let pnlText = document.querySelector(".notice__privacy__wrap .privacy_policy_info");
                    pnlText.innerHTML = el.policy_txt;
                }
                else if(el.policy_type == "TRM") {
                    let trmText = document.querySelector(".notice__privacy__wrap .terms_of_use_info");
                    trmText.innerHTML = el.policy_txt;
                }
            })
        } else {
            alert("법적 고지사항 정보가 존재하지 않습니다.");
        }
    }
})

</script>