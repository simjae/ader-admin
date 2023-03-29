<div class="body">
	<h1>관리자 정보 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="admin/put" autocomplete="false">
			<h2>기본 정보</h2>
			<div class="form-group">
				<input type="text" name="id" value="<?=$id?>" minlength="3" maxlength="15" required>
				<label class="control-label">아이디</label>
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
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input style="display:none" aria-hidden="true">
						<input type="password" name="pw" minlength="4" autocomplete="new-password" maxlength="20">
						<label class="control-label">비밀번호</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="password" name="pw_confirm" minlength="4" maxlength="20">
						<label class="control-label">비밀번호 확인</label>
					</div>
				</div>
			</div>

			<h2>추가 정보</h2>
			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input type="file" name="img" class="input-image">
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
						<input type="tel" name="mobile">
						<label class="control-label">휴대폰</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="tel" name="tel">
						<label class="control-label">연락처</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="tel" name="fax">
						<label class="control-label">팩스</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="number" name="zipcode" class="zipcode" style="width:100px" readonly>
				<a class="btn blue" onclick="zipcode(this);">우편번호 검색</a><br>
				<input type="text" name="address1" class="margin-top-5">
				<input type="text" name="address2" class="margin-top-5" placeholder="상세 주소">
				<label class="control-label">주소</label>
			</div>

			<h2>권한</h2>
			<div class="form-group">
				<select name="permit">
					<option value="0">모든 권한</option>
				</select>
				<label class="control-label">권한 설정</label>
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
	let f = $("form").last();
	if($(f).find("input[name='id']").val() != '') {
		$(f).find("input[name='id']").attr("readonly",true);
		$.ajax({
			url: config.api + "admin/get",
			data: { id : $(f).find("input[name='id']").val() },
			success: function(d) {
				if(d.code == 200) {
					$(f).find("input[name='name']").val(d.data[0].name);
					$(f).find("input[name='nick']").val(d.data[0].nick);
					$(f).find("input[name='email']").val(d.data[0].email);
					$(f).find("input[name='fax']").val(d.data[0].fax);
					$(f).find("input[name='tel']").val(d.data[0].tel);
					$(f).find("input[name='mobile']").val(d.data[0].mobile);
					$(f).find("input[name='zipcode']").val(d.data[0].address[0]);
					$(f).find("input[name='address1']").val(d.data[0].address[1]);
					$(f).find("input[name='address2']").val(d.data[0].address[2]);

					$(f).find("input[name='img']").parent().parent().find("img").attr("src",d.data[0].profile_image);
				}
			}
		});
	}
});
</script>