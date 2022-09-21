<h1>
	약관
	<div class="tools hidden">
		<a onclick="modal('site/term/add');"><i class="xi-plus"></i><span class="tooltip left">약관 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>환경설정</li>
		<li>약관</li>
	</ul>
</div>

<div class="row margin-top-20">
	<div class="float-left">
		<ul class="tab green">
			<li><a data-role="tab-terms">이용약관</a></li>
		</ul>
	</div>
	<div class="float-right">
		<a class="btn btn-large green has-tooltip" id="btn-terms-modify"><i class="xi-pen-o"></i><span class="tooltip top">약관 수정</span></a>
		<a class="btn btn-large red hidden has-tooltip" id="btn-terms-modify-ok"><i class="xi-check"></i><span class="tooltip top">수정 완료</span></a>
	</div>
</div>

<form id="frm" name="frm">
<input type="hidden" name="CATEGORY">
<input type="hidden" name="CONTENTS">
<div class="row">
	<div class="tab-content margin-top-20" id="tab-terms">
		<div id="tab-terms-1" data-category="">
		</div>
	</div>
</div>
</form>


<script>
var id;
var category;
var val;
var oEditors = [];

$("#btn-terms-modify").click(function() {
	$(this).addClass("hidden");
	$("#btn-terms-modify-ok").removeClass("hidden");
	changeEditorForm();
});

$("#btn-terms-modify-ok").click(function() {
	$(this).addClass("hidden");
	$("#btn-terms-modify").removeClass("hidden");
	submitEditorForm();
});

function changeEditorForm() {
	$("#tab-terms > div").each(function() {
		if($(this).css("display") == "block") {
			loading(true);

			id = $(this).attr("id");
			category = $(this).data("category");
			val = $(this).html();

			frm.CATEGORY.value = category;

			$(this).html("<textarea id='_text_tmp' style='width:100%;height:500px;opacity:0'>" + val + "</textarea>");

			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "_text_tmp",
				sSkinURI: "/assets/js/smarteditor2/SmartEditor2Skin.html",
				fCreator: "createSeditor2"
			});

			loading(false);
		}
	});
}

function submitEditorForm() {
	// 에디터 내용 반영
	oEditors.getById["_text_tmp"].exec("UPDATE_CONTENTS_FIELD", []);
	val = $("#_text_tmp").val();

	// 인풋폼 반영
	frm.CONTENTS.value = val;

	// 폼 전송
	$.ajax({
		type: "post",  
		dataType: "json",
		url: "modules/site/term/?m=add",
		data: $("#frm").serialize(),
		success: function(d) {
			loading(false);
			if(d.code == 200) {
				// 보기 화면으로 전환
				$("#" + id).html(val);
			}
			else {
				alert("오류",d.msg,1);
			}
		},
		error: function() {
			alert("데이터 저장을 실패했습니다.");
		}
	});
}
</script>