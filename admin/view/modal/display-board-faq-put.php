

<div class="body" style="width:100%;margin: 0;">
	<h1>
		FAQ 추가
		<a onclick="close_modal();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	<div class="content__card" style="width:100%;margin: 0;">
		<form id="frm-update" action="page/board/faq/put">
            <input type="hidden" name="faq_idx" value="<?=$faq_idx?>">
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">분류</div>
                    <div class="content__row">
<?php 
                        $get_category_sql = "
                            SELECT 
                                PARENT.TITLE    AS PARENT_TITLE,
                                CHILD.TITLE     AS CHILD_TITLE
                            FROM
                                dev.FAQ_CATEGORY PARENT LEFT JOIN
                                dev.FAQ_CATEGORY CHILD 
                            ON
                                PARENT.IDX = CHILD.FATHER_NO LEFT JOIN
                                (SELECT
                                    IDX,
                                    CATEGORY_NO
                                FROM
                                    dev.FAQ
                                WHERE
                                    IDX = ".$faq_idx.") FAQ
                            ON
                                CHILD.IDX = FAQ.CATEGORY_NO
                            WHERE
                                FAQ.IDX IS NOT NULL
                        ";

                        $db->query($get_category_sql);
                        
                        $parent_title = "";
                        $child_title = "";
                        foreach($db->fetch() as $data){
                            $parent_title = $data['PARENT_TITLE'];
                            $child_title = $data['CHILD_TITLE'];
                        }
                        
?>
                        <input type='text' value="<?=$parent_title?>" disabled>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">상세 분류</div>
                    <div class="content__row">     
                        <input type='text' value="<?=$child_title?>" disabled>
                    </div>
                </div>
            </div>
            <div class="card__body">
            <div class="content__wrap">
<?php 
            $get_faq_sql = "
                SELECT 
                    QUESTION,
                    ANSWER
                FROM
                    dev.FAQ
                WHERE
                    IDX = ".$faq_idx."
            ";
            $db->query($get_faq_sql);

            $question = '';
            $answer = '';
            foreach($db->fetch() as $faq_info){
                $question = $faq_info['QUESTION'];
                $answer = $faq_info['ANSWER'];
            }
?>
                <div class="content__title">질문</div>
                    <div class="content__row">
                       <input type='text' name="question" value="<?=$question?>"> 
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title" style="vertical-align:top!important;">답변</div>
                    <div class="content__row">
                        <textarea class="width-100p" id="answer" name="answer" required style="width:100%; min-height:150px;" ><?=$answer?></textarea>
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
	var question 			= $('input[name="question"]');
    var answer_html 		= $('#answer');
    answer.getById["answer"].exec("UPDATE_CONTENTS_FIELD", []);
    

    if(question.val().length == 0){
        alert("질문을 입력해주세요", question.focus());
		return false;
    }
    if(answer_html.val() == '<p>&nbsp;</p>'){
        alert("답변을 입력해주세요", answer_html.focus());
		return false;
    }
    insertLog("전시관리 > 게시판 관리 ", "FAQ 수정: [" + question.val() + "]", null);
    modal_submit(null, 'initFaq');
}
function close_modal(){
    modal_cancel();
    initFaq();
}
</script>
