<?php
/*
 +=============================================================================
 | 
 | FAQ 작성
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016.08.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../../../_resource/head.php';

?>
<div class="body">
	<h1>FAQ 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="modules/site/faq/?m=add">
		<input type="hidden" name="no" value="<?=$_GET['no']?>">

		<div class="row">
			<div class="form-group padding-bottom-10">
				<select name="category" id="faq-category" class="width-100p"></select>
				<label class="control-label">분류</label>
			</div>

			<div class="form-group padding-bottom-10">
				<textarea name="question" title="질문" required></textarea>
				<label class="control-label">제목</label>
			</div>

			<div class="form-group">
				<textarea class="form-control" id="faq-answer-contents" name="answer" title="내용" required></textarea>
				<label class="control-label">답변</label>
			</div>
		</div>

		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="faq_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	var f = $("form").last();
	$(f).find("input[name='lang']").eq(0).prop("checked",true);
	$(f).find("input[name='type'][value='layer']").prop("checked",true);

	$.ajax({
		type: "post",
		url: "modules/site/faq/",
		data: {
			"m" : "category",
			"no" : $(f).find("input[name=no]").val()
		},
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var html = "";
			for(var i=0;i<d.data.length;i++) {
				html += '<option value="' + d.data[i].no + '" ';
				if(d.data[i].is_select == true) html += 'selected';
				html += '>' + d.data[i].title + '</option>';
			}
			$("#faq-category").html(html);
		}
	});

	if($(f).find("input[name=no]").val() != "") {
		$.ajax({
			type: "post",
			url: "modules/site/faq/",
			data: "no=" + $(f).find("input[name=no]").val(),
			dataType: "json",
			error: function() {
				alert("데이터를 불러들이는데 실패하였습니다.");
			},
			success: function(d) {
				$(f).find("input[name='question']").val(d.data[0].question);
				$(f).find("input[name='answer']").val(d.data[0].answer);
				$(f).find("select[name='category'] > option[value='" + d.data[0].cateogry + "']").prop("checked",true);
			}
		});
	}
});

var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "faq-answer-contents",
	sSkinURI: "../assets/js/smarteditor2/SmartEditor2Skin.html"
});

function insertIMG(irid,fileame) {
    var sHTML = "<img src='" + fileame + "' border='0'>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);
}

function pasteHTMLDemo(){
	sHTML = "<span style='color:#FF0000'>이미지 등도 이렇게 삽입하면 됩니다.</span>";
	oEditors.getById["ARTICLES_CONTENTS"].exec("PASTE_HTML", [sHTML]);
}

function showHTML(){
	alert(oEditors.getById["faq-answer-contents"].getIR());
}

function faq_submit(){
	oEditors.getById["faq-answer-contents"].exec("UPDATE_CONTENTS_FIELD", []);
	modal_submit();
}
</script>