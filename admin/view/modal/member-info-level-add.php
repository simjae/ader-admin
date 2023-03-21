<div class="content__card" style="width:1024px">
	<h3>
		회원등급 추가
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body" style="margin-top:40px;">
		<form id="frm-add" action="member/info/level/add">
            <div class="content__wrap grid__half">
				<div class="half__box__wrap">
                    <div class="content__title">회원등급 명</div>
                    <div class="content__row">
                        <input type="text" name="title"> 
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">마일리지 적립 비율</div>
                    <div class="content__row">
                        <input type="number" name="mileage_per" style="width:110px;">
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="memberLevelAdd();"><span>회원등급 추가</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
});
function memberLevelAdd() {	
	confirm('회원등급 정보를 등록하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-add").serializeObject();
        
        let title = formData['title']!=null?formData['title'].trim():'';
        if(title.length == 0){
            alert('회원등급명을 입력해주세요.');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "member/info/level/add",
            error: function() {
                alert('회원등급 등록에 실패했습니다.');
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200){
                        alert('회원등급 정보를 등록했습니다.', function(){
                            getMemberLevelList()
                            modal_close();
                        });
                    }
                    else{
                        alert(data.msg);
                    }
                }
                else{
                    alert('회원정보 등록작업이 실패했습니다.');
                }
            }
        });
        insertLog("멤버관리 > 회원등급", "회원등급 추가", null);
    })
}
</script>