<div class="body">
	<h1>팝업 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="popup/put">
			<input type="hidden" name="no" value="<?=$no?>">
			<input type="hidden" name="type" value="layer">

			<div class="form-group">
				<input type="text" name="title" maxlength="50" required>
				<label class="control-label">제목</label>
			</div>

			<!--
			<textarea name="contents" id="contents" required></textarea>
			-->

			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input type="file" name="image" accept=".jpg,.jpeg,.png,.gif" class="input-image">
				</span><img class="preview">
				<label class="control-label">이미지</label>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-5 col-5-4">
						<input type="text" name="url">
					</div>
					<div class="col-5">
						<label><input type="checkbox" name="target" value="new"><span>새창</span></label>
					</div>
				</div>
				<label class="control-label">링크</label>
			</div>

			<div class="form-group">
				<input type="date" name="start_date" placeholder="From" required style="width:150px">
				<span class="input-group-btn">~</span>
				<input type="date" name="end_date" placeholder="To" required style="width:150px">
				<label class="control-label">게시기간</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="status" value="Y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">사용여부</label>
			</div>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit($('#frm-list'));" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	var f = $("form").last();
	$(f).find("input[name='lang']").eq(0).prop("checked",true);
	$(f).find("input[name='type'][value='layer']").prop("checked",true);

	$.ajax({
		type: "post",
		url: config.api + "popup/get",
		data: {
			no : $(f).find("input[name=no]").val()
		},
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			if(d.total && $(f).find("input[name=no]").val() != "") {
				$(f).find("input[name='title']").val(d.data[0].title);
				$(f).find("input[name='url']").val(d.data[0].url);
				$(f).find("input[name='start_date']").val(d.data[0].start_date);
				$(f).find("input[name='end_date']").val(d.data[0].end_date);
				$(f).find("img.preview").attr("src",d.data[0].image.url);
				$(f).find("input[name='status']").prop("checked",d.data[0].status);
			}

			/*
			var oEditors = [];
			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "contents",
				sSkinURI: "/js/smarteditor2/SmartEditor2Skin.html",
				fCreator: "createSeditor2"
			});
			*/
		}
	});
});
</script>