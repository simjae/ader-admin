<div class="content__card" style="width:1024px">
	<h3>
        회원등급 정보 수정
		<a onclick="modal_close();" class="btn-close" style="float:right;">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body" style="margin-top:40px;">
		<form id="frm-put" action="member/info/level/add">
            <input type="hidden" id="level_idx" name="level_idx" value="<?=$level_idx?>">
            <div class="content__wrap grid__half">
				<div class="half__box__wrap">
                    <div class="content__title">회원등급 명</div>
                    <div class="content__row">
                        <input type="text" id="title" name="title"> 
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">마일리지 적립 비율</div>
                    <div class="content__row">
                        <input type="number" id="mileage_per" name="mileage_per" style="width:110px;">
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="memberLevelUpdate();"><span>회원등급 정보 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    getLevelInfo();

});
function getLevelInfo(){
    let level_idx = $('#level_idx').val();
    $.ajax({
		type: "post",
		data: {'level_idx' : level_idx},
		dataType: "json",
		url: config.api + "member/info/level/get",
		error: function() {
			
		},
		success: function(d) {
			if(d != null){
                if(d.code == 200 && d.data !=null){
                    $('#title').val(d.data[0].level_title!=null?d.data[0].level_title:'');
                    $('#mileage_per').val(d.data[0].mileage_per!=null?d.data[0].mileage_per:0);
                }
                else{
                    alert(d.msg);
                }
            }
            else{
                alert('회원등급정보가 존재하지 않습니다.');
            }
		}
	});
}
function memberLevelUpdate() {	
    confirm('회원등급 정보를 수정하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-put").serializeObject();
        
        let title = formData['title']!=null?formData['title'].trim():'';
        if(title.length == 0){
            alert('회원등급명을 입력해주세요.');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "member/info/level/put",
            error: function() {
                alert('회원등급 수정에 실패했습니다.');
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200){
                        alert('회원등급 정보를 수정했습니다.', function(){
                            getMemberLevelList()
                            modal_close();
                        });
                    }
                    else{
                        alert(data.msg);
                    }
                }
                else{
                    alert('회원정보 수정작업이 실패했습니다.');
                }
            }
        });
        insertLog("멤버관리 > 회원등급", "회원등급 정보 변경", null);
    })
}
</script>