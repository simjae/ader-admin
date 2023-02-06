<style>
#answer{
	margin-top : 50px;
}
</style>
<div class="content__card" style="width:950px;margin: 0;">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>1:1문의 내용</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap">
            <div class="content__title">유저 ID</div>
            <div class="content__row">
                <span name="creater" style="width:150px;color:green"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">문의 카테고리</div>
            <div class="content__row">
                <span name="category" style="width:120px"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">title</div>
            <div class="content__row">
                <span name="title" style="width:200px"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">작성일</div>
            <div class="content__row">
                <span name="create_date" style="width:200px"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title content">문의 상세내용</div>
            <div class="content__row" style="width:100%;overflow:scroll;">
                <p name="contents" style="min-height:200px;width:100%;border: 1px solid #000;"></p>
            </div>
        </div>
    </div>
	<div id="reply_div"></div>
	<div class="card__body">
		<form id="frm-update" action="page/board/put">
			<input id="page_idx" type="hidden" name="page_idx" value="<?=$idx?>">
			<input type="hidden" name="put_type" value="answer">
			<div class="card__header" id="answer">
				<div class="flex justify-between">
					<h3>1:1문의 답변</h3>
				</div>
				<div class="drive--x"></div>
			</div>
			<div class="card__body">
				<div class="content__wrap">
					<div class="content__title" style="vertical-align:top!important;">답변내용</div>
					<div class="content__row">
						<textarea class="width-100p" id="answer_contents" name="answer_contents" required style="width:650%; min-height:150px;"></textarea>
					</div>
				</div>
			</div>
			<div class="card__footer">
				<div class="footer__btn__wrap" style="grid: none;">
					<div class="btn__wrap--lg">
						<div onclick="answerUpdateCheck();"  class="blue__color__btn"><span>저장</span></div>
						<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
var answer_contents = [];
var infoHtml = "Company ADER | Business Name FIVE SPACE CO.,LTD | Business License 760-87-01757 |MAIL-ORDER LICENSE NO. 2021-서울성동-01588 | CEO HANN| office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, KoreaC/S office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea TEL. 02-792-2232 | Office hour Mon - Fri AM 10:00 - PM 5:00 ©2021 ADER All Rights Reserved";

$(document).ready(function() {
	var page_idx = $('#page_idx').val();

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: answer_contents,
		elPlaceHolder: "answer_contents",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});

	$.ajax({
		type: "post",
		data: {
			'board_idx' : page_idx,
            'tab_num' : '01',
		},
		dataType: "json",
		url: config.api + "page/board/get",
		error: function() {
			alert("1:1문의 불러오기 처리에 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
                $("span[name='creater']").text(data['data'][0].creater_name+'('+data['data'][0].creater_level+')');
                $("span[name='category']").text(data['data'][0].category);
                $("span[name='title']").text(data['data'][0].title);
                $("span[name='create_date']").text(data['data'][0].create_date);
				$("p[name='contents']").html(data['data'][0].contents);

				var reply = data['data'][0].reply;
                
                if(reply.length > 0){
                    reply.forEach(function(row){
                        var writer_color = '';
                        if(row.admin_flg == true){
                            writer_color = "blue";
                        }
                        else{
                            writer_color = "green";
                        }
                        var replyDiv = `
                                <div class="card__header">
                                    <div class="flex justify-between">
                                        <h3 id='reply_title'></h3>
                                    </div>
                                    <div class="drive--x"></div>
                                </div>
                                <div class="card__body">
                                    <div class="content__wrap">
                                        <div class="content__title">작성자</div>
                                        <div class="content__row">
                                            <span name="reply_writer" style="width:200px;color:${writer_color}">${row.member_name}</span>
                                        </div>
                                    </div>
                                    <div class="content__wrap">
                                        <div class="content__title">작성시간</div>
                                        <div class="content__row">
                                            <span name="reply_create_date" style="width:100%">${row.create_date}</span>
                                        </div>
                                    </div>
                                    <div class="content__wrap">
                                    <div class="content__title content">답변내용</div>
                                        <div class="content__row" style="width:100%;overflow:scroll;min-height:200px;width:100%;border:1px solid #000;">
                                            ${row.contents}
                                        </div>
                                    </div>
                                </div>
                        `;
                        $('#reply_div').append(replyDiv);
                        //$("p[name='reply_contents']").html(row.contents);
                    });
                }
			}
		}
	});
});	

function answerUpdateCheck(){
	answer_contents.getById["answer_contents"].exec("UPDATE_CONTENTS_FIELD", []);
	modal_submit($('#frm-list'),'getBoardTabInfo_01');
}
</script>