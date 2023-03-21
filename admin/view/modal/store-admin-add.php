<style>
.table__toggle__btn {
	background-color:#000;color:#fff;width:110px;height:28px;text-align:center;font-size:12px;font-weight:300;border-radius:2px;line-height:2.4;
	cursor:pointer;
}
.modal > .con > .body.modal__wrap{height:90vh!important;display:flex;flex-direction:column;}
.modal__wrap, .modal__wrap .modal__body{height:90vh}
.modal__wrap .modal__body{flex: 1;overflow-y:scroll}
.xi-close{float:right;}
</style>

<div class="body modal__wrap">
	<div class="modal__header">
		<h1>
			운영자 정보 등록
			<a onclick="modal_close();" class="btn-close">
				<i class="xi-close" ></i>
			</a>
		</h1>
	</div>
	
	
    <div class="contents modal__body" >
		<form id="frm-add" action="store/admin/add">
			<input class="admin_idx" type="hidden" name="admin_idx" value="">
			
			<h2>기본 정보</h2>
			<div class="form-group">
				<input type="text" name="admin_id" value="" required="">
				<label class="control-label">아이디</label>
			</div>

			<div class="form-group">
				<input type="text" name="admin_name" minlength="2" maxlength="10" value="" class="width-150" required="">
				<label class="control-label">이름</label>
			</div>

			<div class="form-group">
				<input type="password" name="admin_pw" minlength="4" maxlength="20">
				<label class="control-label">비밀번호</label>
			</div>
			
			<h2>추가 정보</h2>
			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input class="input-image profile_img" type="file" name="profile_img">
				</span><br>
				<img id="profile_img" class="preview" src="/images/ico-avatar.png">
				<label class="control-label">프로필사진</label>
			</div>
			<div class="form-group">
				<input type="text" name="admin_nick" value="" minlength="2" maxlength="10" class="width-150">
				<label class="control-label">닉네임</label>
			</div>
			<div class="form-group">
				<input type="text" name="admin_email" value="">
				<label class="control-label">이메일</label>
			</div>
			<div class="form-group">
				<label class="control-label">연락처</label>
				<div class="form-row">
					<input type="text" name="tel_mobile" value="" maxlength="13" class="width-150 phone">
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="admin_fax" value="" maxlength="13" class="width-150 phone">
				<label class="control-label">팩스</label>
			</div>
		</form>
	</div>
	
	<div class="footer modal__footer">
		<a class="btn" onclick="modal_cancel();"><i class="xi-close"></i>작성 취소</a>
		<a class="btn red" onClick="addAdminInfo();"><i class="xi-check"></i>적용</a>
	</div>
</div>
<script>
$(document).ready(function() {	
	$('.profile_img').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			file = $(this).prop("files")[0];
			
			blobURL = window.URL.createObjectURL(file);
			
			$('#profile_img').attr('src', blobURL);
			$('#profile_img').slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
});

function addAdminInfo(){
	let frm = $('#frm-add');
	let admin_id = frm.find('input[name=admin_id]');
	let admin_name = frm.find('input[name=admin_name]');
	let admin_pw = frm.find('input[name=admin_pw]');
	let admin_email = frm.find('input[name=admin_email]');
	
	let reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
	let spl_id = admin_id.val().search(/\s/g);

	if(admin_id.val().length == 0){
		alert("아이디를 입력해주세요", admin_id.focus());
		return false;
	}
	
	if(admin_id.val().search(/[a-z]/ig) < 0){
		alert("아이디에 영문과 숫자가 조합되어야 합니다.",admin_id.focus());
		return false;
	}
	
	if(spl_id >= 0){
		alert("아이디에 공백이 포함될 수 없습니다.",admin_id.focus());
		return false;
	}
	
	if(admin_name.val().length == 0){
		alert("이름를 입력해주세요",admin_name.focus());
		return false;
	}
	
	if(admin_pw.val().length == 0){
		alert("비밀번호를 입력해주세요",admin_pw.focus());
		return false;
	}
	
	if(admin_email.val().length == 0){
		alert("이메일을 입력해주세요", admin_email.focus());
		return false;
	}
	
	if(reg_email.test(admin_email.val()) == false){
		alert("이메일을 정확히 입력해주세요", admin_email.focus());
		return false;
	}
	
	let formData = new FormData();
	formData = $("#frm-add").serializeObject();
	
	confirm(
		'운영자 정보를 등록하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "store/admin/add",
				error: function() {
					alert("운영자 정보 등록처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert(
							"운영자 정보가 등록되었습니다.",
							function() {
								insertLog("상점관리 > 운영자 관리 > 운영자 목록","운영자 등록: ",1);
								getAdminInfoList();
								modal_close();
							}
						)
					} else {
						alert("운영자 정보 등록처리에 실패했습니다. 등록하려는 운영자 정보를 확인해주세요.");
						return false;
					}
				}
			});
		}
	)
}

</script>