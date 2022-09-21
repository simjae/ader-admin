<div class="body">
	<h1>회원 정보<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form id="frm-member" action="member/put">
			<input type="hidden" name="no" value="<?=$no?>">

			<div class="form-group">
				<label><input type="radio" name="level" value="일반"><span>일반 회원</span></label>
				<label><input type="radio" name="level" value="파트너"><span>파트너 회원</span></label>
				<label class="control-label">회원 유형</label>
			</div>

			<div class="form-group">
				<input type="text" name="id" minlength="3" maxlength="15" required>
				<label class="control-label">아이디</label>
			</div>

			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="pw" minlength="4" maxlength="20">
						<label class="control-label">비밀번호 변경</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="pw_confirm" minlength="4" maxlength="20">
						<label class="control-label">비밀번호 확인</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="name" minlength="2" maxlength="10" required>
						<label class="control-label">이름</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="nick" minlength="2" maxlength="10">
						<label class="control-label">닉네임</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input type="file" name="profile_image" class="input-image">
				</span><br>
				<img class="preview">
				<label class="control-label">프로필사진</label>
			</div>

			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="email" name="email">
						<label class="control-label">이메일</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="tel" name="tel">
						<label class="control-label">연락처</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="date" name="birthday">
						<label class="control-label">생년월일</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="tel_certify" readonly>
						<label class="control-label">연락처 인증</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>
					<input type="checkbox" name="receive_sms" value="y"><span>SMS 수신 동의</span>
				</label>
				<label>
					<input type="checkbox" name="receive_tel" value="y"><span>전화 수신 동의</span>
				</label>
				<label>
					<input type="checkbox" name="receive_push" value="y"><span>푸시메시지 수신 동의</span>
				</label>
				<label>
					<input type="checkbox" name="receive_email" value="y"><span>이메일 수신 동의</span>
				</label>
				<label class="control-label">마케팅 수신동의</label>
			</div>

			<div class="form-group">
				<label><input type="radio" name="status" value="휴면"><span>휴면</span></label>
				<label><input type="radio" name="status" value="정상"><span>정상</span></label>
				<label><input type="radio" name="status" value="정지"><span>정지</span></label>
				<label><input type="radio" name="status" value="퇴출"><span>퇴출</span></label>
				<label><input type="radio" name="status" value="탈퇴"><span>탈퇴</span></label>
				<label><input type="radio" name="status" value="탈퇴신청"><span>탈퇴신청</span></label>
				<label class="control-label">상태</label>
			</div>

			<div class="form-group">
				<textarea name="remark"></textarea>
				<label class="control-label">관리 메모</label>
			</div>

		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>적용</a>
	</div>
</div>

<script>
$(document).ready(function() {
	let f = $("#frm-member");
	$.ajax({
		url: config.api + "member/get",
		data: { no : $(f).find("input[name='no']").val() },
		success: function(d) {
			if(d.code == 200 && $(f).find("input[name='no']").val() != '' && isNaN($(f).find("input[name='no']").val()) == false) {
				$(f).find("input[name='id']").val(d.data[0].id).prop("readonly",true);
				$(f).find("input[name='name']").val(d.data[0].name);
				$(f).find("input[name='nick']").val(d.data[0].nick);
				$(f).find("input[name='email']").val(d.data[0].email);
				$(f).find("input[name='tel']").val(d.data[0].tel);
				$(f).find("input[name='birthday']").val(d.data[0].birthday);
				$(f).find("textarea[name='remark']").val(d.data[0].remark);
				$(f).find("input[name='profile_image']").parent().parent().find("img").attr("src",d.data[0].image);
				$(f).find(`input[name='receive_tel']`).prop("checked",d.data[0].receive.tel);
				$(f).find(`input[name='receive_push']`).prop("checked",d.data[0].receive.push);
				$(f).find(`input[name='receive_email']`).prop("checked",d.data[0].receive.email);
				$(f).find(`input[name='receive_sms']`).prop("checked",d.data[0].receive.sms);
				$(f).find(`input[name='level'][value='${d.data[0].level}']`).prop("checked",true);
				$(f).find(`input[name='status'][value='${d.data[0].status}']`).prop("checked",true);
			}
		}
	});
});
</script>