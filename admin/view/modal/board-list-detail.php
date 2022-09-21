<div class="body">
	<h1>게시글 보기<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form id="frm-article">
			<input type="hidden" name="no" value="<?=$no?>">
			<input type="hidden" name="bbscode" value="<?=BBSCODE?>">

			<div class="form-group">
				<div class="value" id="article-title"></div>
				<label class="control-label">제목</label>
			</div>
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<div class="value" id="article-writer"></div>
						<label class="control-label">작성자</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<div class="value" id="article-regdate"></div>
						<label class="control-label">작성일</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="value" id="article-email"></div>
				<label class="control-label">이메일</label>
			</div>
			<div class="form-group">
				<div class="value" id="article-contents"></div>
				<label class="control-label">내용</label>
			</div>
			<div class="form-group">
				<div class="value" id="article-image"></div>
				<label class="control-label">이미지</label>
			</div>
			<div class="form-group">
				<div class="value" id="article-file"></div>
				<label class="control-label">첨부파일</label>
			</div>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_close();" class="btn"><i class="xi-close"></i>닫기</a>
	</div>
</div>
<script>
$(document).ready(function() {
	let f = $("#frm-article");
	$.ajax({
		url: config.api + "board/get",
		data: $(f).serialize(),
		success: function(d) {
			if(d.code == 200) {
				$("#article-title").text(d.data[0].title);
				$("#article-writer").text(d.data[0].writer);
				$("#article-email").text(d.data[0].email);
				$("#article-regdate").text(d.data[0].reg_datetime);
				$("#article-contents").html(d.data[0].contents);
			}
		}
	});
});
</script>