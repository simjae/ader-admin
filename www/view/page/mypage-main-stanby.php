<style>
.stanby__wrap{
    margin-top:40px;
    width:100%;
    display:grid;
    grid-template-columns:repeat(16,1fr);
}
.stanby__wrap td p{
    height:auto;
}
.stanby__tab__btn__container{
    grid-column: 1/17;
    margin: 0 auto;
    width:230px;
    display:grid;
    place-items: center;
    grid-template-columns: 80px 80px 70px;
}
.stanby__tab__wrap{
    grid-column:6/12;
    width:100%;
    margin:0 auto;
    margin-top:50px;
    display:grid;
    grid-template-columns:repeat(6,1fr);
}
.stanby__apply__form__wrap, .stanby__result__form__wrap{
    grid-column:1/7;
    width:100%;
}
.stanby__notice__wrap{
    grid-column:2/6;
    width:100%;
}
.stanby__container{
    margin: 0 auto;
    width:100%;
    display:grid;
    place-items: center;
    grid-template-columns: 1fr 1fr 1fr
}
.stanby__item{
    width:100%;
    padding-top:30px;
}
.stanby__wrap img{
    width:100%;
}
.stanby__item .item__title{
    margin-top:15px;
    font-size: 13px;
    font-family:var(--ft-no-fu);
}
.stanby__item .item__description{
    margin-top:10px;
    font-size: 11px;
    font-family:var(--ft-no-fu);
}
.stanby__item .item__status{
    margin-top:20px;
    font-size: 11px;
    font-family:var(--ft-no-fu);
    margin-bottom:30px;
}
.stanby__wrap img{
    max-width: 100%;
}
.stanby__tab__contents{
    width:100%;
    margin: 0 auto;
    padding-top:50px;
    padding-bottom:50px;
}
.stanby__wrap .contents__table{
    margin-bottom:10px;
}
.stanby__wrap .footer{
    margin-bottom:100px;
}
.date__cols__title{
    margin-top:10px;
}
.date__cols__info{
    margin-top:40px;
}
.stanby__notice__wrap{
    margin:0 auto;
}
@media (min-width: 1024px){
    .orderlist__tab__contents{width:950px;}
}
@media (max-width: 1024px){
    .stanby__notice__wrap{
        grid-column:1/7;
        width:100%;
    }
    .stanby__tab__wrap{grid-column:1/17;width:100%}
    .stanby__tab__contents{width:100%}
    .stanby__container{
        margin: 0 auto;
        width:100%;
        gap:10px;
        display:grid;
        place-items: center;
        grid-template-columns: repeat(2,1fr);
    }
    .contents__info .info span{
        font-size:11px;
    }
    .stanby__notice__wrap{width:100%;}
}
</style>
<div class="stanby__wrap">
    <div class="stanby__tab__btn__container">
        <div class="tab__btn__item" form-id="stanby__apply__form__wrap" onclick="getTotalStandby()">
            <img src="/images/mypage/tab/select_stanby_apply_btn.svg">
        </div>
        <div class="tab__btn__item"  form-id="stanby__result__form__wrap" onclick="getEntryStandby()">
            <img src="/images/mypage/tab/default_stanby_result_btn.svg">
        </div>
        <div class="tab__btn__item" form-id="stanby__notice__wrap">
            <img src="/images/mypage/tab/default_notice_btn.svg">
        </div>
    </div>
    <div class="stanby__tab__wrap">
        <div class="stanby__tab stanby__apply__form__wrap">
            <div class="title">
                <p>스탠바이 응모하기</p>
            </div>
            <div class="description">
                <div class="pc__view">
                    <p>·&nbsp;새롭게 도입하는 아더의 스탠바이(STAND BY)는 사전 예약 시스템으로,</p>
                    <p>&nbsp;&nbsp;정식 런칭 전 구매자로 등록하여 등록된 사람에 한해 개별 링크 발송 및 구매할 수 있는 권한을 부여하는 시스템입니다.</p>
                    <p>&nbsp;&nbsp;해당 시스템은 무분별한 제품 사재기와 제품 선점을 근절하기 위해 도입된 시스템으로,</p>
                    <p>&nbsp;&nbsp;과열 상품 및 한정 에디션의 원활한 구매를 돕고자 합니다.</p>
                </div>
                <div class="mobile__view">
                    <p>·&nbsp;새롭게 도입하는 아더의 스탠바이(STAND BY)는 사전 예약 시스템으로,</p>
                    <p>&nbsp;&nbsp;정식 런칭 전 구매자로 등록하여 등록된 사람에 한해 개별 링크 발송 및 구매할 수 있는 권한을 부여하는 시스템입니다.</p>
                    <p>&nbsp;&nbsp;해당 시스템은 무분별한 제품 사재기와 제품 선점을 근절하기 위해 도입된<br>&nbsp;&nbsp;시스템으로, 과열 상품 및 한정 에디션의 원활한 구매를 돕고자 합니다.</p>
                </div>
            </div>
            <div class="info__wrap">
                <div class="stanby__container">
                </div>
            </div>
            <div class="footer"></div>
        </div>

        <div class="stanby__tab stanby__result__form__wrap">
            <div class="info__wrap">
                <div class="pc__view">
                </div>
                <div class="mobile__view">
                </div>
            </div>
            <div class="footer"></div>
        </div>

        <div class="stanby__tab stanby__notice__wrap">
            <div class="title">
                <p>스탠바이 유의사항</p>
            </div>
            <div class="description">
                <p>·&nbsp;STAND BY 는 ‘아더 공식 온라인 스토어 회원가입 대상자’만 신청 가능합니다.</p>
                <p>·&nbsp;STAND BY 는 선착순으로 진행되며, 한정 수량 종료 시, 구매가 어려울 수 있는 점 참고 바랍니다.</p>
                <p class="next__line__exist">·&nbsp;회원 정보의 전화번호로 구매 링크가 발송되오니 참여 전</p>
                <p>&nbsp;&nbsp;고객님의 회원정보의 전화번호가 현재의 번호와 동일한지 확인 바랍니다.</p>
                <p>·&nbsp;정보 오기입으로 인해 발생되는 불이익에 대해서는 책임지지 않으니 정보 입력 후 재확인 부탁드립니다.</p>
                <p>·&nbsp;STANDBY 참여자는 개별 문자(LMS)로 구매 링크가 전송됩니다.</p>
                <p>·&nbsp;STANDBY 참여자라 하더라도 재고 소진 시 구매 기회는 보장되지 않습니다.</p>
                <p>·&nbsp;구매는 STANDBY 참여 시 로그인 한 아이디로 구매 가능합니다.​</p>
                <p>·&nbsp;STANDBY 참여 제품은 교환/환불 불가하며 바우처를 사용할 수 없습니다.</p>
                <p>·&nbsp;구매링크는 문자로만 확인 가능하며, 별도로 오프라인 채널에서 확인이 어렵습니다.</p>
                <p class="next__line__exist">·&nbsp;모바일 기기의 무선 및 네트워크 환경에 따라 문자 수신 시점에 차이가 있을 수 있으며,</p>
                <p>&nbsp;&nbsp;해당 이슈로 인한 불이익은 책임지지 않습니다.</p>
                <p>·&nbsp;SMS는 휴대폰을 통한 정보 수신에 동의한 회원에 한해 발송됩니다.</p>
                <p>·&nbsp;구매 가능 시간 이후에는 구매가 불가합니다.</p>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>

<script>
$('.stanby__result__form__wrap').hide();
$('.stanby__notice__wrap').hide();

$(document).ready(function(){

})

function getTotalStandby(){
    $('.stanby__container').html('');
    $.ajax({
        url: config.api + "mypage/standby/list/get",
        type: "post",
        data: {},
        dataType: "json",
        error: function() {
            alert('스탠바이 등록 처리중 오류가 발생했습니다.');
        },
        success: function(d) {
            let code = d.code;
            if(code == 200){
                $('.stanby__container').html('');
                var data = d.data;
                if(data != null && data.length > 0){
                    data.forEach(function(row){
                        var usable_class = '';
                        if(row.entry_status == '종료'){
                            usable_class = 'non__usable__info'
                        }

                        var entry_date_str = '';
                        if(row.entry_status == 'Comming soon'){
                            entry_date_str = 'Comming soon';
                            row.entry_status = '';
                        }
                        else{
                            var entry_start_date_arr = []; 
                            var entry_end_date_arr = [];
                            entry_start_data_arr = row.entry_start_date.split(' ');
                            entry_end_data_arr = row.entry_end_date.split(' ');

                            var entry_date_str = '';
                            if(entry_start_data_arr[0] == entry_end_data_arr[0]){
                                entry_date_str = entry_start_data_arr[0]+' '+entry_start_data_arr[1]+' ~ '+entry_end_data_arr[1]; 
                            }
                            else{
                                entry_date_str = row.entry_start_date+' ~ '+row.entry_end_date;
                            }
                        }
                        
                        var strDiv = '';
                        strDiv = `
                            <div class="stanby__item ${usable_class}">
                                <img src="http://116.124.128.246:81${row.img_location}">
                                <p class="item__title">${row.product_name}</p>
                                <p class="item__description">${entry_date_str}</p>
                                <p class="item__status">${row.entry_status}</p>
                            </div>
                        `;
                        $('.stanby__container').append(strDiv);
                    })
                }
            }
        }
    });
}
function getEntryStandby(){
    console.log('11');
    $('.stanby__result__form__wrap .pc__view').html('');
    $('.stanby__result__form__wrap .mobile__view').html('');
    $.ajax({
        url: config.api + "mypage/standby/entry/get",
        type: "post",
        dataType: "json",
        error: function() {
            alert('스탠바이 신청내역 오류가 발생했습니다.');
        },
        success: function(d) {
            let code = d.code;
            if(code == 200){
                $('.stanby__result__form__wrap .pc__view').html('');
                $('.stanby__result__form__wrap .mobile__view').html('');
                var data = d.data;
                if(data != null && data.length > 0){
                    data.forEach(function(row){
                        var btnStr = '';
                        var winStr = '';
                        if(row.purchase_status == '구매하기'){
                            btnStr = `<button class="black__full__width__btn">${row.purchase_status}</button>`;
                            winStr = '당첨';
                        }
                        else{
                            btnStr = `<button class="white__full__width__btn">${row.purchase_status}</button>`;
                            if(row.purchase_status == '스탠바이 종료'){
                                winStr = '미당첨';
                            }
                            else{
                                winStr = '당첨';
                            }
                        }

                        strDivPc = `
                            <div class="info">
                                <div class="stanby__tab__contents">
                                    <div class="contents__info">
                                        <div class="info">
                                            <span class="info__title">응모일시</span>
                                            <span class="info__value">${row.apply_date == null?'':row.apply_date}</span>
                                        </div>
                                        <div class="detail__btn"><span>자세히보기</span></div>
                                    </div>
                                    <div class="contents__table">
                                        <table>
                                            <colsgroup>
                                                <col style="width:17%;">
                                                <col style="width:17%;">
                                                <col style="width:33%;">
                                                <col style="width:32%;">
                                            </colsgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="http://116.124.128.246:81${row.img_location}">
                                                    </td>
                                                    <td>
                                                        <p>${row.product_name}</p>
                                                        <p>${parseInt(row.sales_price).toLocaleString('ko-KR')}</p>
                                                        <p>${row.color}</p>
                                                        <p>${row.option_name}</p>
                                                    </td>
                                                    <td class="vertical__top">
                                                        <div class="date__cols__title">
                                                            <p>응모 기간</p>
                                                        </div>
                                                        <div class="date__cols__info">
                                                            <p>${row.entry_start_date}</p>
                                                            <p>- ${row.entry_end_date}</p>
                                                        </div>
                                                    </td>
                                                    <td class="vertical__top">
                                                        <div class="date__cols__title">
                                                            <p>구매 기간</p>
                                                        </div>
                                                        <div class="date__cols__info">
                                                            <p>${row.purchase_start_date}</p>
                                                            <p>- ${row.purchase_end_date}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    ${btnStr}
                                </div>
                            </div>
                        `;
                        var order_detail_str = '';
                        switch(row.order_status){
                            case '주문완료':
                                order_detail_str = `
                                    <div class="detail__btn" style="display:flex;align-items: center;gap: 10px;justify-content: space-between;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">주문완료</p>
                                        <img src="/images/mypage/mypage_order_cancel_btn.svg">
                                    </div>
                                    <p class="detail__info">배송준비 단계로 넘어가면 취소 불가합니다.</p>
                                `;
                                break;
                            case '배송중':
                                order_detail_str = `
                                    <div class="detail__btn" style="display:flex;justify-content:space-between;gap: 10px;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">배송중</p>
                                        
                                    </div>
                                    <p class="detail__info underline">${company_name}<br>${company_tel}</p>
                                `;
                                break;
                            case '배송완료':
                                order_detail_str = `
                                    <div class="detail__btn" style="display:flex;align-items: center;gap: 10px;justify-content: space-between;margin-bottom:10px;">
                                        <p style="margin-bottom:0px;">배송완료</p>
                                        <img src="/images/mypage/mypage_return_apply_btn.svg">
                                    </div>
                                    <p class="detail__info">반품접수는 제품 수령 후 7일 이내 가능합니다.</p>
                                `;
                        }
                        strDivMobile = `
                            <div class="info">
                                <div class="stanby__tab__contents">
                                    <div class="contents__info">
                                        <div class="info">
                                            <span class="info__title">응모일시</span>
                                            <span class="info__value">${row.apply_date == null?'':row.apply_date}</span>
                                        </div>
                                        <div class="detail__btn"><span>자세히보기</span></div>
                                    </div>
                                    <div class="contents__table">
                                        <table>
                                            <colsgroup>
                                                <col style="width:27%;">
                                                <col style="width:43%;">
                                                <col style="width:20%;">
                                            </colsgroup>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="http://116.124.128.246:81${row.img_location}">
                                                    </td>
                                                    <td>
                                                        <p>${row.product_name}</p>
                                                        <p>${parseInt(row.sales_price).toLocaleString('ko-KR')}</p>
                                                        <p>${row.color}</p>
                                                        <p>${row.option_name}</p>
                                                    </td>
                                                    <td>
                                                        <p>${winStr}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>
                                                            응모 기간
                                                        </p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p>${row.entry_start_date} - ${row.entry_end_date}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>
                                                            구매 기간
                                                        </p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p>${row.purchase_start_date} - ${row.purchase_end_date}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    ${btnStr}
                                </div>
                            </div>
                        `;
                        $('.stanby__result__form__wrap .pc__view').append(strDivPc);
                        $('.stanby__result__form__wrap .mobile__view').append(strDivMobile);
                    })
                }
            }
        }
    });
}
</script>