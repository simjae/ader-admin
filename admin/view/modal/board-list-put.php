<div class="body">
	<h1>게시글 작성<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">

		<form action="board/put">
			<input type="hidden" name="bbscode" value="<?=BBSCODE?>">
			<input type="hidden" name="no" value="<?=$no?>">
			<div class="form-group">
				<input type="text" name="title" required>
				<label class="control-label">제목</label>
			</div>
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="text" name="name" required>
						<label class="control-label">작성자</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<input type="date" name="reg_date">
						<label class="control-label">작성일</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="email" name="email">
				<label class="control-label">이메일</label>
			</div>
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="notice" value="y">
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<label class="control-label">공지사항</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="status" value="y">
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<label class="control-label">노출여부</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<textarea name="contents" class="tiny"></textarea>
				<label class="control-label">내용</label>
			</div>
			<div class="form-group">
				<div class="goods-image-upload">
					<div class="item disabled add-image">
						<input type="file" name="img[]" multiple="multiple" accept=".jpg,.jpeg,.png,.gif">
						<i class="xi-mouse"></i><br>
						<span>파일 열기를 통해<br>이미지를 추가해주세요.</span>
					</div>
				</div>
				<label class="control-label">이미지</label>
			</div>
			<div class="form-group">
				<div class="goods-image-upload">
					<div class="item disabled add-image">
						<input type="file" name="file[]" multiple="multiple">
						<i class="xi-mouse"></i><br>
						<span>파일 열기를 통해<br>파일을 추가해주세요.</span>
					</div>
				</div>
				<label class="control-label">파일첨부</label>
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
	$.ajax({
		url: config.api + "board/get",
		data: $(f).serialize(),
		success: function(d) {
			if(d.code == 200 & $(f).find("input[name='no']").val() != "" && isNaN($(f).find("input[name='no']").val()) == false) {
				$(f).find("input[name='title']").val(d.data[0].title);
				$(f).find("input[name='name']").val(d.data[0].writer);
				$(f).find("input[name='email']").val(d.data[0].email);
				$(f).find("input[name='reg_date']").val(d.data[0].reg_date);
				$(f).find("textarea[name='contents']").val(d.data[0].contents);
				$(f).find(`input[name='notice']`).prop("checked",d.data[0].notice);
				$(f).find(`input[name='status']`).prop("checked",d.data[0].status);
			}
		}
	});
});
</script>