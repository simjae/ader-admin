<?php
        $country = '';
        $company_name = '';
        $delivery_country = '';
        $company_tel = '';
        $company_sub_tel = '';
        $company_email = '';
        $delivery_price = '';
        $homepage = '';
        $default_flg = '';
        $get_sql = "
                SELECT 
                    COUNTRY,
                    COMPANY_NAME,
                    DELIVERY_COUNTRY,
                    COMPANY_TEL,
                    COMPANY_SUB_TEL,
                    COMPANY_EMAIL,
                    DELIVERY_PRICE,
                    HOMEPAGE,
                    DEFAULT_FLG
                FROM
                    dev.DELIVERY_COMPANY
                WHERE
                    IDX = ".$sel_idx;

        $db->query($get_sql);

        foreach($db->fetch() as $data){
            $country            = $data['COUNTRY'];
            $company_name       = $data['COMPANY_NAME'];
            $delivery_country   = $data['DELIVERY_COUNTRY'];
            $company_tel        = $data['COMPANY_TEL'];
            $company_sub_tel    = $data['COMPANY_SUB_TEL'];
            $company_email      = $data['COMPANY_EMAIL'];
            $delivery_price     = $data['DELIVERY_PRICE'];
            $homepage           = $data['HOMEPAGE'];
            $default_flg        = $data['DEFAULT_FLG'];
        }
?>
<div class="content__card" style="width:1024px">
	<h3>
		배송업체 추가
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body" style="margin-top:40px;">
		<form id="frm-update">
            <input type="hidden" name="country" value="<?=$country?>">
            <input type="hidden" name="sel_idx" value="<?=$sel_idx?>">
            <div class="content__wrap">
                <div class="content__title">배송업체명</div>
                <div class="content__row">
                    <input type="text" name="company_name" value="<?=$company_name?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">배송가능 국가</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="delivery_country_put_KR" class="radio__input" value="KR" name="delivery_country" <?=$delivery_country=='KR'?'checked':''?>>
                        <label for="delivery_country_put_KR">국내배송</label>
                        
                        <input type="radio" id="delivery_country_put_KF" class="radio__input" value="KF" name="delivery_country" <?=$delivery_country=='KF'?'checked':''?>>
                        <label for="delivery_country_put_KF">국/내외배송</label>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">대표 연락처</div>
                <div class="content__row">
                    <input type="text" name="company_tel" value="<?=$company_tel?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">보조 연락처</div>
                <div class="content__row">
                    <input type="text" name="company_sub_tel" value="<?=$company_tel?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">이메일</div>
                <div class="content__row">
                    <input type="text" name="company_email" value="<?=$company_email?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">기본 배송비</div>
                <div class="content__row">
                    <input type="number" name="delivery_price" value="<?=$delivery_price?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">홈페이지</div>
                <div class="content__row">
                    <input type="text" name="homepage" value="<?=$homepage?>"> 
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">기본 설정</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="default_flg_put_FALSE" class="radio__input" value="FALSE" name="default_flg" <?=$default_flg==false?'checked':''?>>
                        <label for="default_flg_put_FALSE">일반배송사</label>
                        
                        <input type="radio" id="default_flg_put_TRUE" class="radio__input" value="TRUE" name="default_flg" <?=$default_flg==true?'checked':''?>>
                        <label for="default_flg_put_TRUE">기본배송사</label>
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="deliveryCompanyUpdate();"><span>배송업체정보 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
});
function deliveryCompanyUpdate() {	
	confirm('배송업체를 수정하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-update").serializeObject();
        
        let title = formData['company_name']!=null?formData['company_name'].trim():'';
        if(title.length == 0){
            alert('배송업체명을 입력해주세요.');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "order/delivery/company/put",
            error: function() {
                alert('배송업체 수정에 실패했습니다.');
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200){
                        alert('배송업체정보를 수정했습니다.', function(){
                            getDeliveryCompanyList(formData.country);
                            modal_close();
                        });
                    }
                    else{
                        alert(data.msg);
                    }
                }
                else{
                    alert('배송업체 수정작업이 실패했습니다.');
                }
            }
        });
        insertLog("주문 > 배송 설정", "배송업체정보 수정", null);
    })
}
</script>