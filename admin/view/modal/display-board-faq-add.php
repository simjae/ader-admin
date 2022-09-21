<div class="body">
	<h1>
		FAQ 추가
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	<div class="content__card" style="width:100%;margin: 0;">
		<form id="frm-update" action="display/board/faq/add">
            <input type="hidden" name="category_info" value="<?=$category_info?>">
            <input type="hidden" name="category_idx" value="">
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">분류</div>
                    <div class="content__row">
                        <input type='text' name="category" value="" disabled>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">상세 분류</div>
                    <div class="content__row">
                        <select name="subcategory_idx" id="subcategory_idx" style="width:163px;">
                            <option value="">상세 분류 선택</option>
						</select>
                    </div>
                </div>
            </div>
            <div class="card__body">
            <div class="content__wrap">
                <div class="content__title">질문</div>
                    <div class="content__row">
                       <input type='text' name="question"> 
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title" style="vertical-align:top!important;">답변</div>
                    <div class="content__row">
                        <textarea class="width-100p" id="answer" name="answer" required style="width:650%; min-height:150px;"></textarea>
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="faqAddCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
var answer = [];
var infoHtml = "Company ADER | Business Name FIVE SPACE CO.,LTD | Business License 760-87-01757 |MAIL-ORDER LICENSE NO. 2021-서울성동-01588 | CEO HANN| office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, KoreaC/S office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea TEL. 02-792-2232 | Office hour Mon - Fri AM 10:00 - PM 5:00 ©2021 ADER All Rights Reserved";

$(document).ready(function() {
    nhn.husky.EZCreator.createInIFrame({
		oAppRef: answer,
		elPlaceHolder: "answer",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	if($(this).prop("checked")) {
		$("#goods-ticket-cnt,#goods-ticket-add-text").removeClass("hidden");
	}
    var category_info = $("input[name='category_info']").val();
    var category_info_arr = category_info.split('|');

    $("input[name='category_idx']").val(category_info_arr[0]);
    $("input[name='category']").val(category_info_arr[1]);

    $.ajax({
		type: "post",
		data: {
			'category_idx' : category_info_arr[0]
		},
		dataType: "json",
		url: config.api + "display/board/faq/category/get",
		error: function() {
			alert("상세 카테고리 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
                d.data.forEach(function(row) {
                    $('#subcategory_idx').append(`<option value="${row.idx}">${row.title}</option>`);
                })
			}
		}
	});
});

function faqAddCheck() {
    var subcategory_idx 	= $('#subcategory_idx');
	var question 			= $('input[name="question"]');
    var answer_html 		= $('#answer');
    answer.getById["answer"].exec("UPDATE_CONTENTS_FIELD", []);
    

    if(subcategory_idx.val().length == 0){
        alert("상세분류를 선택해주세요", subcategory_idx.focus());
		return false;
    }
    if(question.val().length == 0){
        alert("질문을 입력해주세요", question.focus());
		return false;
    }
    if(answer_html.val() == '<p>&nbsp;</p>'){
        alert("답변을 입력해주세요", answer_html.focus());
		return false;
    }
    insertLog("전시관리 > 게시판 관리 ", "FAQ 추가: [" + question.val() + "]", null);
    modal_submit(null, 'initFaq');
}
</script>
