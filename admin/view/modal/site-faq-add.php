<?php
/*
 +=============================================================================
 | 
 | FAQ 작성
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016.08.03
 | 최종 수정일	: 2021.11.13
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
?>
<div class="body">
	<h1>FAQ 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="site/faq/put">
		<input type="hidden" name="no" value="<?=$no?>">

		<div class="row">
			<div class="form-group padding-bottom-10">
				<select name="category" class="width-100p"></select>
				<label class="control-label">분류</label>
			</div>

			<div class="form-group padding-bottom-10">
				<textarea name="question" title="질문" required></textarea>
				<label class="control-label">제목</label>
			</div>

			<textarea class="width-100p" id="faq-answer-contents" name="answer" title="내용" required></textarea>
		</div>

		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="faq_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
var oEditors = [];
$(document).ready(function() {
	var f = $("form").last();

	$("#category > li").each(function() {
		$(f).find("select[name='category']").append(`<option value="${$(this).data("no")}" ${$(this).hasClass("on")?'selected':''}>${$(this).text()}</option>`);
	});

	$.ajax({
		url: config.api + "faq/get",
		data: {
			no : $(f).find("input[name='no']").val()
		},
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			if($(f).find("input[name='no']").val() != "") {
				$(f).find("input[name='subtitle']").val(d.data[0].subtitle);
				$(f).find("textarea[name='question']").val(d.data[0].question);
				$(f).find("textarea[name='answer']").val(d.data[0].answer);
				$(f).find("select[name='category'] > option[value='" + d.data[0].cateogry + "']").prop("selected",true);
			}

			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "faq-answer-contents",
				sSkinURI: "/js/smarteditor2/SmartEditor2Skin.html"
			});

		}
	});
});

function faq_submit(){
	oEditors.getById["faq-answer-contents"].exec("UPDATE_CONTENTS_FIELD", []);
	modal_submit();
}
</script>