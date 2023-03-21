

<div class="body">
	<h1>
		FAQ 추가
		<a onclick="close_modal();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	<div class="content__card" style="width:100%;margin: 0;">
		<form id="frm-update" action="page/board/faq/add">
            <input type="hidden" name="category_idx" value="<?=$category_idx?>">
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">분류</div>
                    <div class="content__row">
<?php 
                        $get_category_sql = "
                            SELECT
                                IDX,
                                TITLE
                            FROM
                                dev.FAQ_CATEGORY
                            WHERE
                                IDX = ".$category_idx."
                        ";

                        $db->query($get_category_sql);
                        
                        $parent_idx = 0;
                        foreach($db->fetch() as $data){
                            $parent_idx = $data['IDX'];
                        
?>
                        <input type='text' value="<?=$data['TITLE']?>" disabled>
                        <input type='hidden' name="parent_idx" value="<?=$data['IDX']?>" disabled>
<?php 
                        }
?>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">상세 분류</div>
                    <div class="content__row">
                        <select name="subcategory_idx" id="subcategory_idx" style="width:163px;">
                            <option value="">상세 분류 선택</option>
<?php 
                        $get_child_sql = "
                            SELECT
                                IDX,
                                TITLE
                            FROM
                                dev.FAQ_CATEGORY
                            WHERE
                                FATHER_NO = ".$parent_idx."
                            ORDER BY SEQ
                        ";
                        $db->query($get_child_sql);
                        foreach($db->fetch() as $child_data){

                        
?>
                            <option value="<?=$child_data['IDX']?>"><?=$child_data['TITLE']?></option>
<?php 
                        }
?>
                            
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
                        <textarea class="width-100p" id="answer" name="answer" required style="width:100%; min-height:150px;"></textarea>
                    </div>
                </div>
            </div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="close_modal();" class="btn"><i class="xi-close"></i>작성 취소</a>
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
function close_modal(){
    modal_cancel();
    initFaq();
}
</script>
