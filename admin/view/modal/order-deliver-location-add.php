
<div class="content__card" style="width:1024px">
	<h3>
		지역별 배송비 정보 추가
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body" style="margin-top:40px;">
		<form id="frm-add">
            <input type="hidden" name="country" value="<?=$country?>">
            <div class="content__wrap">
                <div class="content__title">지역명</div>
                <div class="content__row">
                    <input type="text" name="area_name"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">지역 타입</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="isolated_flg_add_TURE" class="radio__input" value="TRUE" name="isolated_flg" checked>
                        <label for="isolated_flg_add_TURE">도서 산간 지역</label>
                        
                        <input type="radio" id="isolated_flg_add_FALSE" class="radio__input" value="FALSE" name="isolated_flg">
                        <label for="isolated_flg_add_FALSE">공통</label>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">우편번호 시작구간</div>
                <div class="content__row">
                    <input type="text" name="start_zipcode"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">우편번호 끝구간</div>
                <div class="content__row">
                    <input type="text" name="end_zipcode"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">배송비</div>
                <div class="content__row">
                    <input type="text" name="delivery_price"> 
                </div>
            </div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="deliveryLocationAdd();"><span>지역별 배송비 정보 추가</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
});
function deliveryLocationAdd() {	
	confirm('지역별 배송비 정보를 등록하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-add").serializeObject();
        
        let title = formData['area_name']!=null?formData['area_name'].trim():'';
        if(title.length == 0){
            alert('지역명을 입력해주세요.');
            return false;
        }
        if(formData['start_zipcode'] == null){
            alert('우편번호 시작구간을 입력해주세요');
            return false;
        }
        else{
            if(formData['end_zipcode'] != null && formData['start_zipcode'] > formData['end_zipcode']){
                alert('우편번호 시작/끝 구간을 제대로 입력해주세요');
                return false;
            }
        }
        if(formData['delivery_price'] == null){
            alert('배송비를 입력해주세요');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "order/delivery/location/add",
            error: function() {
                alert('지역별 배송비 정보 등록에 실패했습니다.');
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200){
                        alert('지역별 배송비 정보를 등록했습니다.', function(){
                            getDeliveryLocationList(formData.country)
                            modal_close();
                        });
                    }
                    else{
                        alert(data.msg);
                    }
                }
                else{
                    alert('지역별 배송비 정보 등록작업이 실패했습니다.');
                }
            }
        });
        insertLog("주문 > 배송 설정", "지역별 배송비 정보 추가", null);
    })
}
</script>