
<div class="content__card" style="width:1024px">
	<h3>
		배송업체 추가
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body" style="margin-top:40px;">
		<form id="frm-add">
            <input type="hidden" name="country" value="<?=$country?>">
            <div class="content__wrap">
                <div class="content__title">배송업체명</div>
                <div class="content__row">
                    <input type="text" name="company_name"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">배송가능 국가</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="delivery_country_add_KR" class="radio__input" value="KR" name="delivery_country" checked>
                        <label for="delivery_country_add_KR">국내배송</label>
                        
                        <input type="radio" id="delivery_country_add_KF" class="radio__input" value="KF" name="delivery_country">
                        <label for="delivery_country_add_KF">국/내외배송</label>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">대표 연락처</div>
                <div class="content__row">
                    <input type="text" name="company_tel"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">보조 연락처</div>
                <div class="content__row">
                    <input type="text" name="company_sub_tel"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">이메일</div>
                <div class="content__row">
                    <input type="text" name="company_email"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">기본 배송비</div>
                <div class="content__row">
                    <input type="number" name="delivery_price"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">홈페이지</div>
                <div class="content__row">
                    <input type="text" name="homepage"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">기본 설정</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="default_flg_add_FALSE" class="radio__input" value="FALSE" name="default_flg" checked>
                        <label for="default_flg_add_FALSE">일반배송사</label>
                        
                        <input type="radio" id="default_flg_add_FALSE" class="radio__input" value="TRUE" name="default_flg">
                        <label for="default_flg_add_FALSE">기본배송사</label>
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="deliveryCompanyAdd();"><span>배송업체 추가</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
});
function deliveryCompanyAdd() {	
	confirm('배송업체를 등록하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-add").serializeObject();
        
        let title = formData['company_name']!=null?formData['company_name'].trim():'';
        if(title.length == 0){
            alert('배송업체명을 입력해주세요.');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "order/delivery/company/add",
            error: function() {
                alert('배송업체 등록에 실패했습니다.');
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200){
                        alert('배송업체를 등록했습니다.', function(){
                            getDeliveryCompanyList(formData.country)
                            modal_close();
                        });
                    }
                    else{
                        alert(data.msg);
                    }
                }
                else{
                    alert('배송업체 등록작업이 실패했습니다.');
                }
            }
        });
        insertLog("주문 > 배송 설정", "배송업체 추가", null);
    })
}
</script>